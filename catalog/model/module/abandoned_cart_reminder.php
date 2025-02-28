<?php
class ModelModuleAbandonedCartReminder extends Model {
	
	public function getCustomersForReminder($data = array()){
		$sql = "SELECT * FROM " . DB_PREFIX . "customer 
				WHERE TIMESTAMPDIFF(HOUR, date_last_action, NOW()) >= " . (int)$this->config->get('abandoned_cart_reminder_delay') . "
				      AND number_reminder_sent < " . (int)$this->config->get('abandoned_cart_reminder_max_reminders') ."  
				      AND date_last_action !='0000-00-00 00:00:00' AND cart != 'a:0:{}' AND store_id = '" . (int)$this->config->get('config_store_id') . "'";
					  
		if (isset($data['filter_customer_id']))	{
			$sql .= " AND customer_id = '" . (int)$data['filter_customer_id'] . "'";
		}		
		
		$query = $this->db->query($sql);

		return $query->rows;	
	}
	
	public function addCoupon($coupon_code, $customer_info, $cart_products) {
		$coupon_type = ($this->config->get('abandoned_cart_reminder_coupon_type') == 0) ? 'F' : 'P';
		
		$sql = "INSERT INTO " . DB_PREFIX . "coupon 
				SET name          ='" . $this->db->escape('CR ' . $customer_info['firstname'] . ' ' . $customer_info['lastname']) . "',
				    code          ='" . $this->db->escape($coupon_code) . "',
					type          ='" . $this->db->escape($coupon_type) . "',
					discount      ='" . (float)$this->config->get('abandoned_cart_reminder_coupon_amount') . "',
					logged        = 0,
					total         ='" . (float)$this->config->get('abandoned_cart_reminder_coupon_total') . "', 
					date_start    = CURRENT_DATE(),
					date_end      = DATE_ADD(CURRENT_DATE(), INTERVAL " . $this->config->get('abandoned_cart_reminder_coupon_expire') . " DAY),
					uses_total    = 1,
					uses_customer = 1,
					status        = 1,
					date_added    = NOW()";

		$query = $this->db->query($sql);

		$coupon_id = $this->db->getLastId();

		if ($cart_products && !$this->config->get('abandoned_cart_reminder_coupon_usage')) {
			foreach($cart_products as $product) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "coupon_product SET coupon_id = '" . (int)$coupon_id . "', product_id = '" . (int)$product['product_id'] . "'");
			}
		}		
	}
	
	public function increaseNumberReminderSent($customer_id){
		$sql = "UPDATE " . DB_PREFIX . "customer SET date_last_action=NOW(), number_reminder_sent = number_reminder_sent + 1 WHERE customer_id='" . (int)$customer_id . "'";
		$this->db->query($sql);
	}
	
	public function increaseNumberRewardSent($customer_id){
		$sql = "UPDATE " . DB_PREFIX . "customer SET number_reward_sent = number_reward_sent + 1 WHERE customer_id='" . (int)$customer_id . "'";
		$this->db->query($sql);
	}
	
	public function getLastOrderProducts($order_id) {
		$last_order_products = array();
		
		$sql = "SELECT product_id FROM `" . DB_PREFIX . "order_product` WHERE order_id = '" . (int)$order_id . "'";
		$query = $this->db->query($sql);
		
		if ($query->num_rows) {
			foreach($query->rows as $order_product) {
				$last_order_products[] = $order_product['product_id'];
			}
		}
		
		return $last_order_products;
	}
	
	public function getLastOrderId($customer_id) {
		$sql = "SELECT order_id FROM `" . DB_PREFIX . "order` WHERE customer_id ='" . (int)$customer_id . "' AND order_status_id != 0 ORDER BY order_id DESC LIMIT 0,1";
		
		$query = $this->db->query($sql);
		
		if ($query->num_rows) {
			return $query->row['order_id'];
		}
		
		return 0;
	}
	
	public function addHistory($customer_info, $coupon_attached, $html_email) {
		if ($coupon_attached) {
			$coupon_info = $this->getLastCouponInfo();
		}
		
		$sql = "INSERT INTO " . DB_PREFIX . "acr_history 
				SET customer_id       = '" . (int)$customer_info['customer_id'] . "',
					firstname         = '" . $this->db->escape($customer_info['firstname']) . "',
					lastname          = '" . $this->db->escape($customer_info['lastname']) . "',
					email_description = '" . $this->db->escape($html_email) . "',
					date_added        = NOW()";
		
		$this->db->query($sql);

		$history_id = $this->db->getLastId();

		if ($coupon_attached && $coupon_info) {
			$sql = "UPDATE " . DB_PREFIX . "acr_history 
					SET coupon_id   = '" . (int)$coupon_info['coupon_id'] . "',
						coupon_code = '" . $this->db->escape($coupon_info['code']) . "'
					WHERE acr_history_id ='" . (int)$history_id . "'";
						
			$this->db->query($sql);			
		}		
	}
	
	public function getHistory($acr_history_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "acr_history WHERE acr_history_id='" . (int)$acr_history_id . "'");
	
		return $query->row;
	}
	
	private function getLastCouponInfo() {
		$sql = "SELECT * FROM " . DB_PREFIX . "coupon ORDER BY coupon_id DESC LIMIT 0,1";
		$query = $this->db->query($sql);
		
		return $query->row;
	}
	
	public function deleteExpiredCoupons(){ // delete coupons with name CR ...
		$sql = "DELETE FROM " . DB_PREFIX . "coupon WHERE name LIKE 'CR %' AND DATE(date_end) < DATE (NOW())";
		$this->db->query($sql);
	}
	
}
?>