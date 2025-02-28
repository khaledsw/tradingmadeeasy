<?php
class ControllerPaymentWPBusiness extends Controller { 
	private $error = array();
	
	public function index() {
		$this->language->load('payment/wp_business');

		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('setting/setting');


		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

			$this->model_setting_setting->editSetting('wp_business', $this->request->post);				

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_successful'] = $this->language->get('text_successful');
		$data['text_declined'] = $this->language->get('text_declined');
		$data['text_off'] = $this->language->get('text_off');
		$data['text_edit'] = $this->language->get('text_edit');

		$data['entry_merchant'] = $this->language->get('entry_merchant');
		$data['entry_password'] = $this->language->get('entry_password');
		$data['entry_callback'] = $this->language->get('entry_callback');
		$data['entry_test'] = $this->language->get('entry_test');
		$data['entry_total'] = $this->language->get('entry_total');	
		$data['entry_order_status'] = $this->language->get('entry_order_status');		
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_logoStatus'] = $this->language->get('entry_logoStatus');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['merchant'])) {
			$data['error_merchant'] = $this->error['merchant'];
		} else {
			$data['error_merchant'] = '';
		}

		if (isset($this->error['password'])) {
			$data['error_password'] = $this->error['password'];
		} else {
			$data['error_password'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/wp_business', 'token=' . $this->session->data['token'], 'SSL'),      		
			'separator' => ' :: '
		);

		$data['action'] = $this->url->link('payment/wp_business', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['wp_business_merchant'])) {
			$data['wp_business_merchant'] = $this->request->post['wp_business_merchant'];
		} else {
			$data['wp_business_merchant'] = $this->config->get('wp_business_merchant');
		}

		if (isset($this->request->post['wp_business_password'])) {
			$data['wp_business_password'] = $this->request->post['wp_business_password'];
		} else {
			$data['wp_business_password'] = $this->config->get('wp_business_password');
		}

		$data['callback'] = HTTP_CATALOG . 'index.php?route=payment/wp_business/callback';

		if (isset($this->request->post['wp_business_test'])) {
			$data['wp_business_test'] = $this->request->post['wp_business_test'];
		} else {
			$data['wp_business_test'] = $this->config->get('wp_business_test');
		}

		if (isset($this->request->post['wp_business_total'])) {
			$data['wp_business_total'] = $this->request->post['wp_business_total'];
		} else {
			$data['wp_business_total'] = $this->config->get('wp_business_total'); 
		} 

		if (isset($this->request->post['wp_business_order_status_id'])) {
			$data['wp_business_order_status_id'] = $this->request->post['wp_business_order_status_id'];
		} else {
			$data['wp_business_order_status_id'] = $this->config->get('wp_business_order_status_id'); 
		} 

		if (isset($this->request->post['wp_business_logoStatus'])) {
			$data['wp_business_logoStatus'] = $this->request->post['wp_business_logoStatus'];
		} else {
			$data['wp_business_logoStatus'] = $this->config->get('wp_business_logoStatus'); 
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['wp_business_geo_zone_id'])) {
			$data['wp_business_geo_zone_id'] = $this->request->post['wp_business_geo_zone_id'];
		} else {
			$data['wp_business_geo_zone_id'] = $this->config->get('wp_business_geo_zone_id'); 
		} 

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['wp_business_status'])) {
			$data['wp_business_status'] = $this->request->post['wp_business_status'];
		} else {
			$data['wp_business_status'] = $this->config->get('wp_business_status');
		}

		if (isset($this->request->post['wp_business_sort_order'])) {
			$data['wp_business_sort_order'] = $this->request->post['wp_business_sort_order'];
		} else {
			$data['wp_business_sort_order'] = $this->config->get('wp_business_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('payment/wp_business.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'payment/worldpay')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['wp_business_merchant']) {
			$this->error['merchant'] = $this->language->get('error_merchant');
		}

		if (!$this->request->post['wp_business_password']) {
			$this->error['password'] = $this->language->get('error_password');
		}

		return !$this->error;
	}

}
?>
