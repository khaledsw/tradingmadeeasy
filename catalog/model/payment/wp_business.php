<?php
class ModelPaymentWPBusiness extends Model {
	public function getMethod($address, $total) {
		$this->language->load('payment/wp_business');

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('wp_business_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

		if ($this->config->get('wp_business_total') > 0 && $this->config->get('wp_business_total') > $total) {
			$status = false;
		} elseif (!$this->config->get('wp_business_geo_zone_id')) {
			$status = true;
		} elseif ($query->num_rows) {
			$status = true;
		} else {
			$status = false;
		}

		$method_data = array();

		if ( $this->config->get('wp_business_logoStatus') == 1) {
			$title = sprintf($this->language->get('text_title_withLogo'), $this->config->get('config_ssl') . 'image/cardwp.png');
		} else {
			$title = $this->language->get('text_title');
		}

		if ($status) {
			$method_data = array(
				'code'       => 'wp_business',
				'title'      => $title,
				'terms'      => '',
				'sort_order' => $this->config->get('wp_business_sort_order')
			);
		}

		return $method_data;
	}
}
?>
