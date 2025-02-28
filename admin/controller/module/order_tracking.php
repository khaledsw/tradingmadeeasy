<?php
class ControllerModuleOrderTracking extends Controller {
	private $error = array(); 
	private $version = '1.4';
	
	public function install() {
		$this->load->model('module/order_tracking');
		
		$this->model_module_order_tracking->createTables();
	}
	
	public function index() {   
		$this->load->language('module/order_tracking');
		$this->load->model('module/order_tracking');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('order_tracking', $this->request->post);		
			$this->model_module_order_tracking->addCarriers($this->request->post['order_tracking_carriers']);
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$data['heading_title'] = $this->language->get('heading_title') . ' ' . $this->version;
		$data['text_edit'] = $this->language->get('text_edit');
		
		$data['tab_setting'] = $this->language->get('tab_setting');
		$data['tab_carrier'] = $this->language->get('tab_carrier');
		$data['tab_order_comment'] = $this->language->get('tab_order_comment');
		$data['tab_help'] = $this->language->get('tab_help');
		
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_use_total'] = $this->language->get('text_use_total');
		$data['text_use_subtotal'] = $this->language->get('text_use_subtotal');
		
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_order_status_shipped'] = $this->language->get('entry_order_status_shipped');
		$data['entry_carrier_name'] = $this->language->get('entry_carrier_name');
		$data['entry_tracking_url'] = $this->language->get('entry_tracking_url');
		$data['entry_comment_template'] = $this->language->get('entry_comment_template');
		
		$data['help_shipped_order_status'] = $this->language->get('help_shipped_order_status');
		$data['help_tracking_url'] = $this->language->get('help_tracking_url');
		$data['help_keywords'] = $this->language->get('help_keywords');
		$data['help_comment'] = $this->language->get('help_comment');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_add_carrier'] = $this->language->get('button_add_carrier');
		$data['button_remove_carrier'] = $this->language->get('button_remove_carrier');
		
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
 		if (isset($this->error['order_status_shipped'])) {
			$data['error_order_status_shipped'] = $this->error['order_status_shipped'];
		} else {
			$data['error_order_status_shipped'] = '';
		}		
		
		if (isset($this->error['carriers'])) {
			$data['error_carriers'] = $this->error['carriers'];
		} else {
			$data['error_carriers'] = '';
		}
		
		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}
		
		if (isset($this->error['tracking_url'])) {
			$data['error_tracking_url'] = $this->error['tracking_url'];
		} else {
			$data['error_tracking_url'] = array();
		}
		
 		if (isset($this->error['comment'])) {
			$data['error_order_comment'] = $this->error['comment'];
		} else {
			$data['error_order_comment'] = array();
		}			
		
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
   		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/order_tracking', 'token=' . $this->session->data['token'], 'SSL')
   		);
		
		$data['action'] = $this->url->link('module/order_tracking', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$this->update_check();
		
		if (isset($this->error['update'])) {
			$data['update'] = $this->error['update'];
		} else {
			$data['update'] = '';
		}		
		
		if (isset($this->request->post['order_tracking_status'])){
			$data['order_tracking_status'] = $this->request->post['order_tracking_status'];
		} elseif ( $this->config->get('order_tracking_status')){
			$data['order_tracking_status'] = $this->config->get('order_tracking_status');
		} else {
			$data['order_tracking_status'] = '';
		}
		
		if (isset($this->request->post['order_tracking_shipped'])){
			$data['order_tracking_shipped'] = $this->request->post['order_tracking_shipped'];
		} elseif ( $this->config->get('order_tracking_shipped')){
			$data['order_tracking_shipped'] = $this->config->get('order_tracking_shipped');
		} else {
			$data['order_tracking_shipped'] = '';
		}
		
		if (isset($this->request->post['order_tracking_comment'])){
			$data['order_tracking_comment'] = $this->request->post['order_tracking_comment'];
		} elseif ( $this->config->get('order_tracking_comment')){
			$data['order_tracking_comment'] = $this->config->get('order_tracking_comment');
		} else {
			$data['order_tracking_comment'] = array();
		}
		
		$data['carriers'] = array();
		
		if (isset($this->request->post['order_tracking_carriers'])) {
			$data['carriers'] = $this->request->post['order_tracking_carriers'];
		} else { 
			$data['carriers'] = $this->model_module_order_tracking->getCarriers();
		}
		
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		$this->load->model('localisation/order_status');
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();		
		
		$data['token'] = $this->session->data['token'];
						
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/order_tracking.tpl', $data));
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/order_tracking')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		$dinamic_strlen = 'utf8_strlen';
		 
		if ( !function_exists('utf8_strlen') ) {
			$dinamic_strlen = 'strlen';
		}
		
		if ($this->request->post['order_tracking_shipped'] == ""){
			$this->error['order_status_shipped'] = $this->language->get('error_order_status_shipped');
			$this->error['warning'] = sprintf($this->language->get('error_in_tab'), $this->language->get('tab_setting'));
		}		
		
		if (!isset($this->request->post['order_tracking_carriers'])) {
			$this->error['carriers'] = $this->language->get('error_carriers');
			$this->error['warning'] = sprintf($this->language->get('error_in_tab'), $this->language->get('tab_carrier')) . ' (' . $this->language->get('error_carriers') . ')';
		}
		
		if (isset($this->request->post['order_tracking_carriers'])) {
			foreach ($this->request->post['order_tracking_carriers'] as $key => $value) {
				if ($dinamic_strlen($value['name']) < 1) {
					$this->error['name'][$key] = $this->language->get('error_carrier_name');
					$this->error['warning'] = sprintf($this->language->get('error_in_tab'), $this->language->get('tab_carrier'));
				}
				
				if ($dinamic_strlen($value['tracking_url']) < 1) {
					$this->error['tracking_url'][$key] = $this->language->get('error_tracking_url');
					$this->error['warning'] = sprintf($this->language->get('error_in_tab'), $this->language->get('tab_carrier'));
				}
				
				/*
				if ($dinamic_strlen($value['tracking_url']) > 10 && strpos($value['tracking_url'], "{tracking_number}") === false) {
					$this->error['tracking_url'][$key] = $this->language->get('error_tracking_url_no_number');
				}
				*/
			}	
		}

		foreach ($this->request->post['order_tracking_comment'] as $language_id => $value) {
			if ($dinamic_strlen($value['description']) < 1) {
        		$this->error['comment'][$language_id] = $this->language->get('error_order_comment');
				$this->error['warning'] = sprintf($this->language->get('error_in_tab'), $this->language->get('tab_order_comment'));
      		}
		}		
				
		return !$this->error;	
	}
	
	public function generateComment() {
		$this->load->model('module/order_tracking');
		
		$json = array();
		
		if (isset($this->request->post['carrier_id']) && isset($this->request->post['tracking_number']) && isset($this->request->post['order_id'])) {
			
			$carrier_info = $this->model_module_order_tracking->getCarrier($this->request->post['carrier_id']);
			
			$find = array(
				'{carrier_name}',
				'{tracking_number}',
				'{tracking_url}'
			);
			
			$replace = array(
				'carrier_name' 	  => $carrier_info['name'],
				'tracking_number' => $this->request->post['tracking_number'],
				'tracking_url'    => str_replace("{tracking_number}", $this->request->post['tracking_number'], html_entity_decode($carrier_info['tracking_url'], ENT_QUOTES, 'UTF-8'))
			);
			
			$order_language_id = $this->model_module_order_tracking->getOrderLanguageId($this->request->post['order_id']);
			$front_store_default_language_id = $this->model_module_order_tracking->getFrontStoreDefaultLanguageId();
			
			$language_id_to_use = $order_language_id;
			
			$comments_template = $this->config->get('order_tracking_comment');
			
			if (!isset($comments_template[$language_id_to_use])) {
				$language_id_to_use = $front_store_default_language_id;
			}
			
			$json['output'] = str_replace($find, $replace, $comments_template[$language_id_to_use]['description']); 
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	private function update_check() {
		$data = 'v=' . $this->version . '&ex=27&e=' . $this->config->get('config_email') . '&ocv=' . VERSION;
        $curl = false;
        
        if (extension_loaded('curl')) {
			$ch = curl_init();
			
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			curl_setopt($ch, CURLOPT_URL, 'https://www.oc-extensions.com/api/v1/update_check');
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
            curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'OCX-Adaptor: curl'));
			curl_setopt($ch, CURLOPT_REFERER, HTTP_CATALOG);
			
			if (function_exists('gzinflate')) {
				curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
			}
            
			$result = curl_exec($ch);
			$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
			
			if ($http_code == 200) {
				$result = json_decode($result);
				
                if ($result) {
                    $curl = true;
                }
                
                if ( isset($result->version) && ($result->version > $this->version) ) {
				    $this->error['update'] = 'A new version of this extension is available. <a target="_blank" href="' . $result->url . '">Click here</a> to see the Changelog.';
				}
			}
		}
        
        if (!$curl) {
			if (!$fp = @fsockopen('ssl://www.oc-extensions.com', 443, $errno, $errstr, 20)) {
				return false;
			}

			socket_set_timeout($fp, 20);
			
			$headers = array();
			$headers[] = "POST /api/v1/update_check HTTP/1.0";
			$headers[] = "Host: www.oc-extensions.com";
			$headers[] = "Referer: " . HTTP_CATALOG;
			$headers[] = "OCX-Adaptor: socket";
			if (function_exists('gzinflate')) {
				$headers[] = "Accept-encoding: gzip";
			}	
			$headers[] = "Content-Type: application/x-www-form-urlencoded";
			$headers[] = "Accept: application/json";
			$headers[] = 'Content-Length: '.strlen($data);
			$request = implode("\r\n", $headers)."\r\n\r\n".$data;
			fwrite($fp, $request);
			$response = $http_code = null;
			$in_headers = $at_start = true;
			$gzip = false;
			
			while (!feof($fp)) {
				$line = fgets($fp, 4096);
				
				if ($at_start) {
					$at_start = false;
					
					if (!preg_match('/HTTP\/(\\d\\.\\d)\\s*(\\d+)\\s*(.*)/', $line, $m)) {
						return false;
					}
					
					$http_code = $m[2];
					continue;
				}
				
				if ($in_headers) {

					if (trim($line) == '') {
						$in_headers = false;
						continue;
					}

					if (!preg_match('/([^:]+):\\s*(.*)/', $line, $m)) {
						continue;
					}
					
					if ( strtolower(trim($m[1])) == 'content-encoding' && trim($m[2]) == 'gzip') {
						$gzip = true;
					}
					
					continue;
				}
				
                $response .= $line;
			}
					
			fclose($fp);
			
			if ($http_code == 200) {
				if ($gzip && function_exists('gzinflate')) {
					$response = substr($response, 10);
					$response = gzinflate($response);
				}
				
				$result = json_decode($response);
				
                if ( isset($result->version) && ($result->version > $this->version) ) {
				    $this->error['update'] = 'A new version of this extension is available. <a target="_blank" href="' . $result->url . '">Click here</a> to see the Changelog.';
				}
			}
		}
	}
	
}
?>