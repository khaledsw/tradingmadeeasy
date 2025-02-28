<?php
require_once(substr_replace(DIR_SYSTEM, '', -7) . 'vendor/equotix/add_to_cart_notification/equotix.php');
class ControllerModuleAddToCartNotification extends Equotix {
	protected $version = '1.1.2';
	protected $code = 'add_to_cart_notification';
	protected $extension = 'Add to Cart Notification';
	protected $extension_id = '1';
	protected $purchase_url = 'add-to-cart-notification';
	protected $purchase_id = '16492';
	protected $error = array();
	
	public function index() {   
		$this->language->load('module/add_to_cart_notification');

		$this->document->setTitle(strip_tags($this->language->get('heading_title')));
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_message'] = $this->language->get('text_message');
		$data['text_congratulations'] = $this->language->get('text_congratulations');
		$data['text_step_1'] = $this->language->get('text_step_1');
		$data['text_step_2'] = $this->language->get('text_step_2');
		$data['text_step_3'] = $this->language->get('text_step_3');
		
		$data['tab_general'] = $this->language->get('tab_general');
		
		$data['button_cancel'] = $this->language->get('button_cancel');

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
			'href'      => $this->url->link('module/add_to_cart_notification', 'token=' . $this->session->data['token'], 'SSL')
   		);
		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['search'] = "cart-total";
		$data['add'] = "trigger_overlay(json['success'], json['image']);";

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->generateOutput('module/add_to_cart_notification.tpl', $data);
	}
	
	public function install() {
		$this->language->load('module/add_to_cart_notification');

		$path = substr_replace(DIR_SYSTEM, '', -7);

		if (file_exists($path . 'vqmod/xml/add_to_cart_notification.xml_')) {
			rename($path . 'vqmod/xml/add_to_cart_notification.xml_', $path . 'vqmod/xml/add_to_cart_notification.xml');
			
			$this->session->data['success'] = $this->language->get('text_success');
		}
		
		$source = @file($path . 'catalog/view/javascript/common.js');
		
		if ($source) {
			$new_source = '';
			$added = false;

			foreach ($source as $line) {
				$new_source .= $line;;
				
				if (!$added && strpos($line, 'cart-total') !== false) {
					$new_source .= "trigger_overlay(json['success'], json['image']);\n";
					
					$added = true;
				}
			}
			
			file_put_contents($path . 'catalog/view/javascript/common.js', $new_source);
		}

		$this->response->redirect($this->url->link('module/add_to_cart_notification', 'token=' . $this->session->data['token'], 'SSL'));
	}
	
	public function uninstall() {
		$this->language->load('module/add_to_cart_notification');

		$path = substr_replace(DIR_SYSTEM, '', -7);

		if (file_exists($path . 'vqmod/xml/add_to_cart_notification.xml')) {
			rename($path . 'vqmod/xml/add_to_cart_notification.xml', $path . 'vqmod/xml/add_to_cart_notification.xml_');

			$this->session->data['success'] = $this->language->get('text_success');
		}
		
		$source = @file_get_contents($path . 'catalog/view/javascript/common.js');
		
		if ($source) {
			$new_source = str_replace("trigger_overlay(json['success'], json['image']);\n", '', $source);
			
			file_put_contents($path . 'catalog/view/javascript/common.js', $new_source);
		}
	}
}