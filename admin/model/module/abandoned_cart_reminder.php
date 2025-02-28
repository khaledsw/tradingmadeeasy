<?php
class ModelModuleAbandonedCartReminder extends Model {
	public function createTables() {
		$this->db->query("ALTER TABLE  `" . DB_PREFIX . "customer` ADD  `date_last_action` DATETIME NOT NULL AFTER  `date_added` , ADD  `number_reminder_sent` INT NOT NULL AFTER  `date_last_action`, ADD  `number_reward_sent` INT NOT NULL AFTER  `number_reminder_sent`, ADD `acr_mail_language_id` INT NOT NULL AFTER  `number_reward_sent`");		
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET date_last_action=NOW()");
		
		$sql = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "acr_history` (
				  `acr_history_id` int(11) NOT NULL AUTO_INCREMENT,
				  `customer_id` int(11) NOT NULL,
				  `firstname` varchar(255) NOT NULL,
				  `lastname` varchar(255) NOT NULL,
				  `coupon_id` int(11) NOT NULL,
				  `coupon_code` varchar(32) NOT NULL,
				  `email_description` text NOT NULL,
				  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
				  PRIMARY KEY (`acr_history_id`)
				) DEFAULT CHARSET=utf8;";
				
		$this->db->query($sql);		
	}
	
	public function removeTables() {
		$this->db->query("ALTER TABLE `" . DB_PREFIX . "customer` DROP `date_last_action`, DROP `number_reminder_sent`, DROP `number_reward_sent`, DROP `acr_mail_language_id`;");		
	}
	
	public function getCustomersForReminder(){
		$sql = "SELECT * FROM " . DB_PREFIX . "customer 
				WHERE TIMESTAMPDIFF(HOUR, date_last_action, NOW()) >= " . (int)$this->config->get('abandoned_cart_reminder_delay') . "
				      AND number_reminder_sent < " . (int)$this->config->get('abandoned_cart_reminder_max_reminders') ."  
				      AND date_last_action !='0000-00-00 00:00:00' AND cart != 'a:0:{}' AND store_id = '" . (int)$this->config->get('config_store_id') . "'";
		
		$query = $this->db->query($sql);

		return $query->rows;	
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
	
	public function getHistory($acr_history_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "acr_history WHERE acr_history_id='" . (int)$acr_history_id . "'");
	
		return $query->row;
	}
	
	public function getHistories($data = array()) {
		$sql = "SELECT ah.*, CONCAT(ah.firstname, ' ', ah.lastname) AS customer_name, 
		               (SELECT COUNT(ch.coupon_id) FROM " . DB_PREFIX . "coupon_history ch WHERE ch.coupon_id = ah.coupon_id) AS coupon_used,						(SELECT c.telephone FROM " . DB_PREFIX . "customer c WHERE c.customer_id = ah.customer_id) AS telephone					   
			    FROM " . DB_PREFIX . "acr_history ah
				WHERE 1";
	
		if (!empty($data['filter_customer'])) {
			$sql .= " AND CONCAT(ah.firstname, ' ', ah.lastname) LIKE '%" . $this->db->escape($data['filter_customer']) . "%'";
		}

		if (!empty($data['filter_coupon_code'])) {
			$sql .= " AND UPPER(ah.coupon_code) = '" . $this->db->escape(strtoupper($data['filter_coupon_code'])) . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(ah.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}
		
		$sort_data = array(
			'ah.acr_history_id',
			'ah.date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY ah.acr_history_id";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;	
	}
	
	public function getTotalHistories($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "acr_history ah WHERE 1";
	
		if (!empty($data['filter_customer'])) {
			$sql .= " AND CONCAT(ah.firstname, ' ', ah.lastname) LIKE '%" . $this->db->escape($data['filter_customer']) . "%'";
		}

		if (!empty($data['filter_coupon_code'])) {
			$sql .= " AND UPPER(ah.coupon_code) = '" . $this->db->escape(strtoupper($data['filter_coupon_code'])) . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(ah.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}
		

		$query = $this->db->query($sql);

		return $query->row['total'];	
	}
	
	public function getTotalRecovered() {
		$sql = "SELECT SUM(o.total) as total_recovered FROM " . DB_PREFIX . "acr_history ah
				LEFT JOIN " . DB_PREFIX . "coupon_history ch ON (ah.coupon_id = ch.coupon_id)
				LEFT JOIN `" . DB_PREFIX . "order` o ON (ch.order_id = o.order_id)";
				
		$query = $this->db->query($sql);

		return $query->row['total_recovered'];	
	}
}
?>