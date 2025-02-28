<?php
class ControllerModuleQtyBasedPricingBreakdown extends Controller {
	public function index() {
	//	print_r($setting);exit; 
		$this->load->language('module/qty_based_pricing_breakdown');
		
 		$this->load->model('catalog/product');
		$this->load->model('module/qty_based_pricing_breakdown'); 	
		
		$this->document->addScript('catalog/view/javascript/qtyprice_breakdown/jquery.countdown.js');	
		$this->document->addStyle('http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300');	
		$this->document->addStyle('catalog/view/javascript/qtyprice_breakdown/jquery.countdown.css');	 
 		
		$data['heading_title'] = $this->language->get('heading_title');
		$data['col_qty_from'] = $this->language->get('col_qty_from');
		$data['col_qty_to'] = $this->language->get('col_qty_to'); 
		$data['col_price_per_unit'] = $this->language->get('col_price_per_unit'); 
		$data['col_yousave'] = $this->language->get('col_yousave'); 
		$data['txt_time_left'] = $this->language->get('txt_time_left'); 
 
		$data['button_cart'] = $this->language->get('button_cart'); 
		
		if (isset($this->request->get['product_id'])) {
			$product_id = (int)$this->request->get['product_id'];
		} else {
			$product_id = 0;
		}
		//echo $product_id;exit;
 		$data['enddate'] = $this->model_module_qty_based_pricing_breakdown->getEnddateOfQtyData($product_id);
 		
  		$product_info = $this->model_catalog_product->getProduct($product_id);
 		if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
			$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
		} else {
			$price = false;
		}

		if ((float)$product_info['special']) {
			$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
		} else {
			$special = false;
		}
		
		$result_qtydata = $this->model_module_qty_based_pricing_breakdown->getQtyData($product_id);
		$data['qty_data'] = array();
		$prodprice = 0;
		$cnt = 0;
		foreach ($result_qtydata as $data_qty) { $cnt++; if($cnt == 1) { $prodprice = $data_qty['price_per_unit']; }
			$yousave = round( (100 - ( ( $data_qty['price_per_unit'] / $prodprice ) * 100)) ) . ' %';
 			$data['qty_data'][] = array(
				'qty_from' => $data_qty['qty_from'],
				'qty_to' => $data_qty['qty_to'],
				'yousave' => $yousave,
				'price_per_unit' => $this->currency->format($this->tax->calculate($data_qty['price_per_unit'], $product_info['tax_class_id'], $this->config->get('config_tax'))),
 			);
		}
		
 		$data['qtydata'] = $result_qtydata ;   	
		//print_r($result_qtydata);exit;
			
 		if ($data['qtydata']) {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/qty_based_pricing_breakdown.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/qty_based_pricing_breakdown.tpl', $data);
			} else {
				return $this->load->view('default/template/module/qty_based_pricing_breakdown.tpl', $data);
			}
		}
	}
}