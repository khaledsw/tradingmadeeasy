<?php 
class ModelModuleQtyBasedPricingBreakdown extends Model {
	public function getQtyData($product_id) {
		$qty_based_pricing_breakdown_product_data = array(); 
		
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "qty_based_pricing_breakdown` bg left join " . DB_PREFIX . "qty_based_pricing_breakdown_product bgp on bg.qty_based_pricing_breakdown_id = bgp.qty_based_pricing_breakdown_id WHERE bgp.product_id = '" . (int)$product_id . "' AND ((bg.date_start = '0000-00-00' OR bg.date_start < NOW()) AND (bg.date_end = '0000-00-00' OR bg.date_end > NOW())) AND bg.status = '1' order by qty_from asc");

		foreach ($query->rows as $result) {
			$qty_based_pricing_breakdown_product_data[] = array("qty_from" => $result['qty_from'], "qty_to" => $result['qty_to'], "price_per_unit" => $result['price_per_unit'] );
		}

		return $qty_based_pricing_breakdown_product_data;
	} 
	
	public function getEnddateOfQtyData($product_id) {
		$qty_based_pricing_breakdown_product_data = array();
// echo "SELECT * FROM " . DB_PREFIX . "qty_based_pricing_breakdown_product WHERE product_id = '" . (int)$product_id . "' order by qty_from asc";exit;
  
		$query = $this->db->query("SELECT date_end FROM `" . DB_PREFIX . "qty_based_pricing_breakdown` bg left join " . DB_PREFIX . "qty_based_pricing_breakdown_product bgp on bg.qty_based_pricing_breakdown_id = bgp.qty_based_pricing_breakdown_id WHERE bgp.product_id = '" . (int)$product_id . "' AND ((bg.date_start = '0000-00-00' OR bg.date_start < NOW()) AND (bg.date_end = '0000-00-00' OR bg.date_end > NOW())) AND bg.status = '1' limit 1");
		
		return isset($query->row['date_end']) ? $query->row['date_end'] : '';  
	} 
	 
	public function getQtyBasedPricingBreakdown($qty_based_pricing_breakdown_product_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "qty_based_pricing_breakdown_product WHERE 1 and status = 1 and qty_based_pricing_breakdown_product_id = '" . (int)$qty_based_pricing_breakdown_product_id . "'");

		return $query->row;
	}
	
	public function getqtyDataFromProductIdQty($product_id, $qty) {
 		
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "qty_based_pricing_breakdown` bg left join " . DB_PREFIX . "qty_based_pricing_breakdown_product bgp on bg.qty_based_pricing_breakdown_id = bgp.qty_based_pricing_breakdown_id WHERE bgp.product_id = '" . (int)$product_id . "' AND ((bg.date_start = '0000-00-00' OR bg.date_start < NOW()) AND (bg.date_end = '0000-00-00' OR bg.date_end > NOW())) AND bg.status = '1' AND qty_from <= $qty AND qty_to >= $qty limit 1 ");

 		return $query->row;
	} 
}