<?php
class ModelShippingEzweight extends Model {
	function getQuote($address) {
		$this->load->language('shipping/ezweight');
		

		$quote_data = array();
	
		$weight = $this->cart->getWeight();
		$sub_total = $this->cart->getSubTotal();
		
		$modules = $this->config->get('ezweight_module');
		
		foreach($modules as $module) {
			// Get whether this geozone is valid
			if (!$module['geo_zone_id']) {
				$module['geo_zone_id'] = "0";
			}
			
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$module['geo_zone_id'] . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

			if($module['geo_zone_id'] == "0") {
				$status = true;
			} elseif ($query->num_rows) {
				$status = true;
			} else {
				$status = false;
			}
			
			if ($status) {
				if($module['status']) {
					$cost = -1;
					
					foreach($module['rates'] as $rate) {
						if($rate['weight'] >= $weight) {
							if(isset($rate['price'])) {
								$cost = $rate['price'];
							}
							break;
						}
					}
					
					if((float)$cost >= 0) {
						$title = $module['title'];
						
						if ($this->config->get('ezweight_display_weight')) {
							$title .= ' (' . $this->language->get('text_weight') . ' ' . $this->weight->format($weight, $this->config->get('config_weight_class_id')) . ')';
						}

						$quote_data[$module['title']] = array(
							'code'         => 'ezweight.' . $module['title'],
							'title'        => $title,
							'cost'         => $cost,
							'tax_class_id' => $this->config->get('ezweight_tax_class_id'),
							'text'         => $this->currency->format($this->tax->calculate($cost, $this->config->get('ezweight_tax_class_id'), $this->config->get('config_tax')))
						);

					}
				}
			}
					
		}
		
		$method_data = array();
		
		if ($quote_data) {
			$method_data = array(
				'code'       => 'ezweight',
				'title'      => $this->language->get('text_title'),
				'quote'      => $quote_data,
				'sort_order' => $this->config->get('ezweight_sort_order'),
				'error'      => false
			);
		}
			
		return $method_data;
	}
}
?>