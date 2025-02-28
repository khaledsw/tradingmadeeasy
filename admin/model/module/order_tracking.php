<?php
class ModelModuleOrderTracking extends Model {
	
	public function createTables(){
		$sql = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "order_tracking_carriers` (
				  `carrier_id` int(11) NOT NULL AUTO_INCREMENT,
				  `name` varchar(255) NOT NULL,
				  `tracking_url` varchar(255) NOT NULL,
				  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
				   PRIMARY KEY (`carrier_id`)
				) DEFAULT CHARSET=utf8;";
		
		$query = $this->db->query($sql);
	}
	
	public function addCarriers($carriers) {
		$this->deleteCarriers();
	
		if ($carriers) {
			foreach($carriers as $carrier) {
				$sql = "INSERT INTO " . DB_PREFIX . "order_tracking_carriers 
						SET name         = '" . $this->db->escape($carrier['name']) . "',
							tracking_url = '" . $this->db->escape($carrier['tracking_url']) . "',
							date_added   = NOW()";
							
				$this->db->query($sql);			
			}
		}
	}
	
	public function deleteCarriers() {
		$sql = "DELETE FROM " . DB_PREFIX . "order_tracking_carriers";
		
		$this->db->query($sql);
	}
	
	public function getCarriers() {
		$sql = "SELECT * FROM " . DB_PREFIX . "order_tracking_carriers ORDER BY name";
		
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
	
	public function getCarrier($carrier_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "order_tracking_carriers WHERE carrier_id = '" . (int)$carrier_id . "'";
		
		$query = $this->db->query($sql);
		
		return $query->row;
	}
	
	public function getOrderLanguageId($order_id) {
		$sql = "SELECT language_id FROM `" . DB_PREFIX . "order` WHERE order_id ='" . (int)$order_id . "'";
		
		$query = $this->db->query($sql);
		
		return $query->row['language_id'];
	}
	
	public function getFrontStoreDefaultLanguageId() {
		$sql = "SELECT language_id FROM " . DB_PREFIX . "language WHERE code = '" . $this->config->get('config_language') . "'";
		
		$query = $this->db->query($sql);
		
		return $query->row['language_id'];
	}
}	
?>