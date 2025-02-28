<?php
class ControllerShippingEzweight extends Controller {
	private $error = array(); 
	 
	public function index() { 
		$this->document->addStyle('view/stylesheet/ezweight.css');
		$this->load->language('shipping/ezweight');
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
		$data['success'] = '';
		$data['current_tab'] = '0';
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$errormessage = $this->validateData($this->request->post);
			if($errormessage == '') {
			
				$this->request->post['ezweight_module'] = $this->sortData($this->request->post['ezweight_module']);
				$this->model_setting_setting->editSetting('ezweight', $this->request->post);		
				
				if($this->request->post['destination'] == 'exit') {
					$this->session->data['success'] = $this->language->get('text_success');
					$this->response->redirect($this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'));
				} else {
					$data['success'] = $this->language->get('text_success');
					$data['current_tab'] = $this->request->post['destination'];
				}
			}
			
		}
				
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_information'] = $this->language->get('text_information');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_edit'] = $this->language->get('text_edit');
		
		$data['entry_weight_limit'] = $this->language->get('entry_weight_limit');
		$data['entry_rate'] = $this->language->get('entry_rate');
		$data['entry_price'] = $this->language->get('entry_price');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_information'] = $this->language->get('entry_information');
		$data['entry_display_weight'] = $this->language->get('entry_display_weight');
		$data['entry_weight_class'] = $this->language->get('entry_weight_class');
		$data['entry_tax_class'] = $this->language->get('entry_tax_class');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		
		$data['help_title'] = $this->language->get('help_title');
		$data['help_display_weight'] = $this->language->get('help_display_weight');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_save_and_cont'] = $this->language->get('button_save_and_cont');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_add_module'] = $this->language->get('button_add_module');
		$data['button_add_row'] = $this->language->get('button_add_row');
		$data['button_remove'] = $this->language->get('button_remove');
		
		$data['tab_module'] = $this->language->get('tab_module');
		$data['tab_general'] = $this->language->get('tab_general');

		$data['token'] = $this->session->data['token'];

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if(isset($errormessage) && $errormessage != '') {
			$data['error_warning'] = $errormessage;
		}
		
  		$data['breadcrumbs'] = array();
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_shipping'),
			'href'      => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('shipping/ezweight', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$data['action'] = $this->url->link('shipping/ezweight', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['cancel'] = $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL');
		


		if (isset($this->request->post['ezweight_display_weight'])) {
			$data['ezweight_display_weight'] = $this->request->post['ezweight_display_weight'];
		} else {
			$data['ezweight_display_weight'] = $this->config->get('ezweight_display_weight');
		}
		
		if (isset($this->request->post['ezweight_weight_class_id'])) {
			$data['ezweight_weight_class_id'] = $this->request->post['ezweight_weight_class_id'];
		} else {
			$data['ezweight_weight_class_id'] = $this->config->get('ezweight_weight_class_id');
		}
		
		$this->load->model('localisation/weight_class');
		
		$data['weight_classes'] = $this->model_localisation_weight_class->getWeightClasses();
		
		if (isset($this->request->post['ezweight_tax_class_id'])) {
			$data['ezweight_tax_class_id'] = $this->request->post['ezweight_tax_class_id'];
		} else {
			$data['ezweight_tax_class_id'] = $this->config->get('ezweight_tax_class_id');
		}

		if (isset($this->request->post['ezweight_geo_zone_id'])) {
			$data['ezweight_geo_zone_id'] = $this->request->post['ezweight_geo_zone_id'];
		} else {
			$data['ezweight_geo_zone_id'] = $this->config->get('ezweight_geo_zone_id');
		}
		
		if (isset($this->request->post['ezweight_status'])) {
			$data['ezweight_status'] = $this->request->post['ezweight_status'];
		} else {
			$data['ezweight_status'] = $this->config->get('ezweight_status');
		}
		
		if (isset($this->request->post['ezweight_sort_order'])) {
			$data['ezweight_sort_order'] = $this->request->post['ezweight_sort_order'];
		} else {
			$data['ezweight_sort_order'] = $this->config->get('ezweight_sort_order');
		}				

		$this->load->model('localisation/tax_class');
		
		$data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();
		
		$this->load->model('localisation/geo_zone');
		
		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();


		if (isset($this->request->post['ezweight_module'])) {
			$data['ezweight_module'] = $this->request->post['ezweight_module'];
		} elseif ($this->config->get('ezweight_module')) { 
			$data['ezweight_module'] = $this->config->get('ezweight_module');
		} else {
			$data['ezweight_module'] = unserialize('a:3:{i:0;a:5:{s:5:"title";s:18:"Economy (3-5 days)";s:6:"status";s:1:"1";s:11:"geo_zone_id";s:1:"0";s:10:"sort_order";s:1:"1";s:5:"rates";a:10:{i:0;a:2:{s:6:"weight";s:3:"0.1";s:5:"price";s:4:"0.73";}i:1;a:2:{s:6:"weight";s:4:"0.25";s:5:"price";s:4:"1.17";}i:2;a:2:{s:6:"weight";s:3:"0.5";s:5:"price";s:4:"1.48";}i:3;a:2:{s:6:"weight";s:4:"0.75";s:5:"price";s:4:"2.01";}i:4;a:2:{s:6:"weight";s:3:"1.0";s:5:"price";s:4:"2.80";}i:5;a:2:{s:6:"weight";s:3:"2.0";s:5:"price";s:4:"3.80";}i:6;a:2:{s:6:"weight";s:3:"5.0";s:5:"price";s:5:"13.75";}i:7;a:2:{s:6:"weight";s:4:"10.0";s:5:"price";s:5:"20.25";}i:8;a:2:{s:6:"weight";s:4:"20.0";s:5:"price";s:5:"28.55";}i:9;a:2:{s:6:"weight";s:2:"30";s:5:"price";s:5:"35.00";}}}i:1;a:5:{s:5:"title";s:19:"Standard (2-3 days)";s:6:"status";s:1:"1";s:11:"geo_zone_id";s:1:"0";s:10:"sort_order";s:1:"2";s:5:"rates";a:9:{i:0;a:2:{s:6:"weight";s:3:"0.1";s:5:"price";s:4:"0.93";}i:1;a:2:{s:6:"weight";s:4:"0.25";s:5:"price";s:4:"1.24";}i:2;a:2:{s:6:"weight";s:3:"0.5";s:5:"price";s:4:"1.65";}i:3;a:2:{s:6:"weight";s:4:"0.75";s:5:"price";s:4:"2.38";}i:4;a:2:{s:6:"weight";s:3:"1.0";s:5:"price";s:4:"5.65";}i:5;a:2:{s:6:"weight";s:3:"2.0";s:5:"price";s:4:"8.90";}i:6;a:2:{s:6:"weight";s:3:"5.0";s:5:"price";s:5:"15.85";}i:7;a:2:{s:6:"weight";s:4:"10.0";s:5:"price";s:5:"21.90";}i:8;a:2:{s:6:"weight";s:4:"20.0";s:5:"price";s:5:"33.40";}}}i:2;a:5:{s:5:"title";s:8:"Next Day";s:6:"status";s:1:"1";s:11:"geo_zone_id";s:1:"0";s:10:"sort_order";s:1:"3";s:5:"rates";a:6:{i:0;a:2:{s:6:"weight";s:3:"0.1";s:5:"price";s:4:"6.40";}i:1;a:2:{s:6:"weight";s:3:"0.5";s:5:"price";s:4:"7.15";}i:2;a:2:{s:6:"weight";s:3:"1.0";s:5:"price";s:4:"8.45";}i:3;a:2:{s:6:"weight";s:3:"2.0";s:5:"price";s:5:"11.00";}i:4;a:2:{s:6:"weight";s:4:"10.0";s:5:"price";s:5:"26.60";}i:5;a:2:{s:6:"weight";s:4:"20.0";s:5:"price";s:5:"41.20";}}}}');
		}

		
		$data['module_row'] = array();
		
		$this->load->model('design/layout');
		
		$data['layouts'] = $this->model_design_layout->getLayouts();
		
		$this->load->model('localisation/language');
		
		$data['languages'] = $this->model_localisation_language->getLanguages();
				
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('shipping/ezweight.tpl', $data));
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'shipping/ezweight')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}

	private function validateData($data) {
	
		$errormessage = '';
		$module_data = $data['ezweight_module'];
		foreach($module_data as $module) {
			if(empty($module['title'])) {
				$errormessage = 'Please check your Shipping Method titles';
			}
		}
	
		return $errormessage;
	}

	private function sortData($module_data) {
		$sorted_data = array();
		$order = array();
		$sorted_rates = array();
		
		$ctr = 1;
		foreach($module_data as $key => $data) {
			$order[$key] = $data['sort_order'];
		}
		
		asort($order);
		foreach($order as $key => $value) {
			$rates = $module_data[$key]['rates'];
			$weight = array();
			$price = array();
			
			foreach($rates as $k => $v) {
				$weight[$k] = $v['weight'];
				$price[$k] = $v['price'];
			} 
			
			array_multisort($weight, SORT_ASC, $price, SORT_ASC, $rates);
			
			$sorted_data[] = array(
				'title'			=> $module_data[$key]['title'],
				'status'		=> $module_data[$key]['status'],
				'geo_zone_id'	=> $module_data[$key]['geo_zone_id'],
				'sort_order'	=> $module_data[$key]['sort_order'],
				'rates'			=> $rates
			);
		}
		return $sorted_data;
//		return $module_data;  // delete this when the function works correctly
	}
}
?>