<?php
class ModelModuleAlsoBought extends Model {
	public function getAlsoBoughtProducts($limit) {
		$product_data = array();
		
		if(isset($limit) && $limit>0)
		{
			if (isset($this->request->get['product_id'])) {
				$product_id = (int)$this->request->get['product_id'];
			} else {
				$product_id = 0;
			}
			
			if (isset($product_id) && $product_id > 0) {
				
				$cachestring = 'alsobought.product.L' . (int)$this->config->get('config_language_id') . '.S' . (int)$this->config->get('config_store_id') . '.G' . $this->config->get('config_customer_group_id') . '.P' .(int)$product_id . '.T' . (int)$limit;
				
				$product_data = $this->cache->get($cachestring);
				if (!$product_data) {
					$product_data = array();
						
					$query = $this->db->query("SELECT op.product_id FROM " . DB_PREFIX . "order_product op INNER JOIN `" . DB_PREFIX . "product` p ON (op.product_id = p.product_id) INNER JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id)  WHERE EXISTS (SELECT 1 FROM " . DB_PREFIX . "order_product op1  WHERE op1.order_id = op.order_id AND op1.product_id = '" .(int)$product_id . "' ) AND op.product_id <> '" . (int)$product_id . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' GROUP BY op.product_id LIMIT " . (int)$limit);
							
					foreach ($query->rows as $result) {
							$product_data[$result['product_id']] = $this->model_catalog_product->getProduct($result['product_id']);
					}					
					$this->cache->set($cachestring, $product_data);	
				}
			}
		}
		return $product_data;
	}

	public function getAlsoBoughtProductsForCart($limit) {
		$product_data = array();
		
		if(isset($limit) && $limit>0)
		{
			$productIds = array();		
			foreach ($this->cart->getProducts() as $product) {
				$productIds[] = $product['product_id'];
			}
			
			if (isset($productIds) && !empty($productIds) ) {
				sort($productIds);				
				$prodIdsS = implode(",", $productIds);
				$prodIdsS_c = "";
				
				$cachestring = 'alsobought.cart.L' . (int)$this->config->get('config_language_id') . '.S' . (int)$this->config->get('config_store_id') . '.G' . $this->config->get('config_customer_group_id') . '.C' . $this->session->getId() . '.T' . (int)$limit;;
				
				$cache_data = $this->cache->get($cachestring);
				if ($cache_data) 
				{
					$prodIdsS_c = $cache_data[0];
					$product_data = $cache_data[1];					
				}
				
				if(!$cache_data || strcmp($prodIdsS, $prodIdsS_c) != 0 || !$product_data)
				{
					$product_data = array();
				
					$query = $this->db->query("SELECT op.product_id FROM " . DB_PREFIX . "order_product op INNER JOIN `" . DB_PREFIX . "product` p ON (op.product_id = p.product_id) INNER JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE EXISTS (SELECT 1 FROM " . DB_PREFIX . "order_product op1  WHERE op1.order_id = op.order_id AND op1.product_id IN (" . $prodIdsS . ") ) AND op.product_id NOT IN (" . $prodIdsS . ") AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' GROUP BY op.product_id LIMIT " . (int)$limit);
					
					foreach ($query->rows as $result) {
							$product_data[$result['product_id']] = $this->model_catalog_product->getProduct($result['product_id']);
					}
					
					$cache_data = array();
					$cache_data[0]= $prodIdsS;
					$cache_data[1]= $product_data;
					$this->cache->set($cachestring, $cache_data);
				}
			}
		}
		return $product_data;
	}
}

