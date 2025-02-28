<?php 
class ModelSaleQtyBasedPricingBreakdown extends Model {
	public function addQtyBasedPricingBreakdown($data) {	
		$this->event->trigger('pre.admin.qty_based_pricing_breakdown.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "qty_based_pricing_breakdown SET name = '" . $this->db->escape($data['name']) . "', date_start = '" . $this->db->escape($data['date_start']) . "', date_end = '" . $this->db->escape($data['date_end']) . "',  status = '" . (int)$data['status'] . "', date_added = NOW()");

		$qty_based_pricing_breakdown_id = $this->db->getLastId();
		
		//product
		
		if (isset($data['qty_based_pricing_breakdown_product'])) {
			foreach ($data['qty_based_pricing_breakdown_product'] as $product_id) {
				foreach ($data['data_qty'] as $qty_data) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "qty_based_pricing_breakdown_product SET qty_based_pricing_breakdown_id = '" . (int)$qty_based_pricing_breakdown_id . "', product_id = '" . (int)$product_id . "' , qty_from = '" . (int)$qty_data['qty_from'] . "' , qty_to = '" . (int)$qty_data['qty_to'] . "' , price_per_unit = '" . (float)$qty_data['price_per_unit'] . "' ");
				}
			}
		}
		 
		$this->event->trigger('post.admin.qty_based_pricing_breakdown.add', $qty_based_pricing_breakdown_id);

		return $qty_based_pricing_breakdown_id;
	}

	public function editQtyBasedPricingBreakdown($qty_based_pricing_breakdown_id, $data) {
		$this->event->trigger('pre.admin.qty_based_pricing_breakdown.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "qty_based_pricing_breakdown SET name = '" . $this->db->escape($data['name']) . "',  date_start = '" . $this->db->escape($data['date_start']) . "', date_end = '" . $this->db->escape($data['date_end']) . "',  status = '" . (int)$data['status'] . "' WHERE qty_based_pricing_breakdown_id = '" . (int)$qty_based_pricing_breakdown_id . "'");
		
		//product

		$this->db->query("DELETE FROM " . DB_PREFIX . "qty_based_pricing_breakdown_product WHERE qty_based_pricing_breakdown_id = '" . (int)$qty_based_pricing_breakdown_id . "'");

		if (isset($data['qty_based_pricing_breakdown_product'])) {
			foreach ($data['qty_based_pricing_breakdown_product'] as $product_id) {
				foreach ($data['data_qty'] as $qty_data) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "qty_based_pricing_breakdown_product SET qty_based_pricing_breakdown_id = '" . (int)$qty_based_pricing_breakdown_id . "', product_id = '" . (int)$product_id . "' , qty_from = '" . (int)$qty_data['qty_from'] . "' , qty_to = '" . (int)$qty_data['qty_to'] . "' , price_per_unit = '" . (float)$qty_data['price_per_unit'] . "' ");
				}
			}
		}
		
		$this->event->trigger('post.admin.qty_based_pricing_breakdown.edit', $qty_based_pricing_breakdown_id);
	}

	public function deleteQtyBasedPricingBreakdown($qty_based_pricing_breakdown_id) {
		$this->event->trigger('pre.admin.qty_based_pricing_breakdown.delete', $qty_based_pricing_breakdown_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "qty_based_pricing_breakdown WHERE qty_based_pricing_breakdown_id = '" . (int)$qty_based_pricing_breakdown_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "qty_based_pricing_breakdown_product WHERE qty_based_pricing_breakdown_id = '" . (int)$qty_based_pricing_breakdown_id . "'");
  		$this->db->query("DELETE FROM " . DB_PREFIX . "qty_based_pricing_breakdown_history WHERE qty_based_pricing_breakdown_id = '" . (int)$qty_based_pricing_breakdown_id . "'");

		$this->event->trigger('post.admin.qty_based_pricing_breakdown.delete', $qty_based_pricing_breakdown_id);
	}

	public function getQtyBasedPricingBreakdown($qty_based_pricing_breakdown_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "qty_based_pricing_breakdown WHERE qty_based_pricing_breakdown_id = '" . (int)$qty_based_pricing_breakdown_id . "'");

		return $query->row;
	}

	public function getQtyBasedPricingBreakdownByCode($code) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "qty_based_pricing_breakdown WHERE code = '" . $this->db->escape($code) . "'");

		return $query->row;
	}

	public function getQtyBasedPricingBreakdowns($data = array()) {
		$sql = "SELECT qty_based_pricing_breakdown_id, name, date_start, date_end, status FROM " . DB_PREFIX . "qty_based_pricing_breakdown";

		$sort_data = array(
			'name',
 			'date_start',
			'date_end',
			'status'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name";
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

	public function getQtyData($qty_based_pricing_breakdown_id) {
		$qty_based_pricing_breakdown_product_data = array();
 
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "qty_based_pricing_breakdown_product WHERE qty_based_pricing_breakdown_id = '" . (int)$qty_based_pricing_breakdown_id . "' order by qty_from asc");

		foreach ($query->rows as $result) {
			$qty_based_pricing_breakdown_product_data[] = array("qty_from" => $result['qty_from'], "qty_to" => $result['qty_to'], "price_per_unit" => $result['price_per_unit'] );
		}

		return $qty_based_pricing_breakdown_product_data;
	} 
	
	public function getQtyBasedPricingBreakdownProducts($qty_based_pricing_breakdown_id) {
		$qty_based_pricing_breakdown_product_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "qty_based_pricing_breakdown_product WHERE qty_based_pricing_breakdown_id = '" . (int)$qty_based_pricing_breakdown_id . "' limit 1");

		foreach ($query->rows as $result) {
			$qty_based_pricing_breakdown_product_data[] = $result['product_id'];
		}

		return $qty_based_pricing_breakdown_product_data;
	} 

	public function getTotalQtyBasedPricingBreakdowns() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "qty_based_pricing_breakdown");

		return $query->row['total'];
	}

	public function getQtyBasedPricingBreakdownHistories($qty_based_pricing_breakdown_id, $start = 0, $limit = 10) {
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 10;
		}

		$query = $this->db->query("SELECT ch.order_id, CONCAT(c.firstname, ' ', c.lastname) AS customer, ch.amount, ch.date_added FROM " . DB_PREFIX . "qty_based_pricing_breakdown_history ch LEFT JOIN " . DB_PREFIX . "customer c ON (ch.customer_id = c.customer_id) WHERE ch.qty_based_pricing_breakdown_id = '" . (int)$qty_based_pricing_breakdown_id . "' ORDER BY ch.date_added ASC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->rows;
	}

	public function getTotalQtyBasedPricingBreakdownHistories($qty_based_pricing_breakdown_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "qty_based_pricing_breakdown_history WHERE qty_based_pricing_breakdown_id = '" . (int)$qty_based_pricing_breakdown_id . "'");

		return $query->row['total'];
	}
}