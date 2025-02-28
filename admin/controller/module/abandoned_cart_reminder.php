<?php
class ControllerModuleAbandonedCartReminder extends Controller {
	private $version = '1.4.3'; 
	private $error = array(); 
	
	public function install(){		
        $this->load->model('module/abandoned_cart_reminder');
		
		$this->model_module_abandoned_cart_reminder->createTables();
	}
	
	public function uninstall(){		
        $this->load->model('module/abandoned_cart_reminder');
		
		$this->model_module_abandoned_cart_reminder->removeTables();
	}
	
	public function index() {   
		$this->load->language('module/abandoned_cart_reminder');

		$this->document->setTitle($this->language->get('heading_title'));
		$this->document->addStyle('view/stylesheet/abandoned_cart_reminder.css');
		
		$this->load->model('setting/setting');
		$this->load->model('tool/image');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('abandoned_cart_reminder', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		// set currency to default currency - to avoid getting wrong default currency if was changed in front store
		if ($this->currency->getCode() != $this->config->get('config_currency')) {
			$this->currency->set($this->config->get('config_currency'));		
		}		
				
		$data['heading_title'] = $this->language->get('heading_title') . ' ' . $this->version;
				
		$data['tab_setting'] = $this->language->get('tab_setting');
		$data['tab_coupon'] = $this->language->get('tab_coupon');
		$data['tab_email'] = $this->language->get('tab_email');
		$data['tab_abandoned_cart'] = $this->language->get('tab_abandoned_cart');
		$data['tab_history'] = $this->language->get('tab_history');
		$data['tab_help']    = $this->language->get('tab_help');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		
		$data['text_days'] = $this->language->get('text_days');
		$data['text_hours'] = $this->language->get('text_hours');
		$data['text_fixed'] = $this->language->get('text_fixed');
		$data['text_percent'] = $this->language->get('text_percent');
		$data['text_all_products'] = $this->language->get('text_all_products');
		$data['text_cart_products'] = $this->language->get('text_cart_products');
		
		$data['text_preview_info'] = $this->language->get('text_preview_info');
		$data['text_special_keyword'] = $this->language->get('text_special_keyword');
		
		$data['entry_secret_code']   = $this->language->get('entry_secret_code');
		$data['entry_delay']         = $this->language->get('entry_delay');
		$data['entry_hide_out_stock']= $this->language->get('entry_hide_out_stock');
		$data['entry_max_reminders'] = $this->language->get('entry_max_reminders');
		$data['entry_use_html_email'] = $this->language->get('entry_use_html_email');
		$data['entry_add_coupon']    = $this->language->get('entry_add_coupon');
		$data['entry_coupon_type']   = $this->language->get('entry_coupon_type');
		$data['entry_coupon_amount'] = $this->language->get('entry_coupon_amount');
		$data['entry_coupon_total']  = $this->language->get('entry_coupon_total');
		$data['entry_coupon_expire'] = $this->language->get('entry_coupon_expire');
		$data['entry_coupon_usage'] = $this->language->get('entry_coupon_usage');
		$data['entry_reward_limit']  = $this->language->get('entry_reward_limit');
		$data['entry_subject'] = $this->language->get('entry_subject');
		$data['entry_special_keyword'] = $this->language->get('entry_special_keyword');
		$data['entry_message_reward'] = $this->language->get('entry_message_reward');
		$data['entry_message_no_reward'] = $this->language->get('entry_message_no_reward');
		
		$data['help_secret_code']   = $this->language->get('help_secret_code');
		$data['help_delay']         = $this->language->get('help_delay');
		$data['help_hide_out_stock']= $this->language->get('help_hide_out_stock');
		$data['help_max_reminders'] = $this->language->get('help_max_reminders');
		$data['help_use_html_email'] = $this->language->get('help_use_html_email');
		$data['help_add_coupon']    = $this->language->get('help_add_coupon');
		$data['help_coupon_total']  = $this->language->get('help_coupon_total');
		$data['help_reward_limit']  = $this->language->get('help_reward_limit');
		$data['help_special_keyword'] = $this->language->get('help_special_keyword');
		$data['help_message_reward'] = $this->language->get('help_message_reward');
		$data['help_message_no_reward'] = $this->language->get('help_message_no_reward');		
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_preview'] = $this->language->get('button_preview');
		$data['button_send'] = $this->language->get('button_send');
		
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = array();
		}
				
		if (isset($this->error['secret_code'])) {
			$data['error_secret_code'] = $this->error['secret_code'];
		} else {
			$data['error_secret_code'] = '';
		}
		
		if (isset($this->error['delay'])) {
			$data['error_delay'] = $this->error['delay'];
		} else {
			$data['error_delay'] = '';
		}
		
		if (isset($this->error['max_reminders'])) {
			$data['error_max_reminders'] = $this->error['max_reminders'];
		} else {
			$data['error_max_reminders'] = '';
		}
		
		if (isset($this->error['use_html_email'])) {
			$data['error_use_html_email'] = $this->error['use_html_email'];
		} else {
			$data['error_use_html_email'] = '';
		}
		
		if (isset($this->error['coupon_amount'])) {
			$data['error_coupon_amount'] = $this->error['coupon_amount'];
		} else {
			$data['error_coupon_amount'] = '';
		}

		if (isset($this->error['coupon_expire'])) {
			$data['error_coupon_expire'] = $this->error['coupon_expire'];
		} else {
			$data['error_coupon_expire'] = '';
		}
		
		if (isset($this->error['subject'])) {
			$data['error_subject'] = $this->error['subject'];
		} else {
			$data['error_subject'] = array();
		}	

		if (isset($this->error['message_reward'])) {
			$data['error_message_reward'] = $this->error['message_reward'];
		} else {
			$data['error_message_reward'] = array();
		}	

		if (isset($this->error['message_no_reward'])) {
			$data['error_message_no_reward'] = $this->error['message_no_reward'];
		} else {
			$data['error_message_no_reward'] = array();
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
			'href'      => $this->url->link('module/abandoned_cart_reminder', 'token=' . $this->session->data['token'], 'SSL')
   		);
		
		$data['action'] = $this->url->link('module/abandoned_cart_reminder', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->update_check();
		
		if (isset($this->error['update'])) {
			$data['update'] = $this->error['update'];
		} else {
			$data['update'] = '';
		}		
		
		if (isset($this->request->post['abandoned_cart_reminder_secret_code'])) {
			$data['abandoned_cart_reminder_secret_code'] = $this->request->post['abandoned_cart_reminder_secret_code'];
		} elseif ($this->config->get('abandoned_cart_reminder_secret_code')) { 
			$data['abandoned_cart_reminder_secret_code'] = $this->config->get('abandoned_cart_reminder_secret_code');
		} else {
			$data['abandoned_cart_reminder_secret_code'] = '';
		}
		
		if (isset($this->request->post['abandoned_cart_reminder_delay'])) {
			$data['abandoned_cart_reminder_delay'] = $this->request->post['abandoned_cart_reminder_delay'];
		} elseif ($this->config->get('abandoned_cart_reminder_delay')) { 
			$data['abandoned_cart_reminder_delay'] = $this->config->get('abandoned_cart_reminder_delay');
		} else {
			$data['abandoned_cart_reminder_delay'] = 3;
		}
		
		if (isset($this->request->post['abandoned_cart_reminder_max_reminders'])) {
			$data['abandoned_cart_reminder_max_reminders'] = $this->request->post['abandoned_cart_reminder_max_reminders'];
		} elseif ($this->config->get('abandoned_cart_reminder_max_reminders')) { 
			$data['abandoned_cart_reminder_max_reminders'] = $this->config->get('abandoned_cart_reminder_max_reminders');
		} else {
			$data['abandoned_cart_reminder_max_reminders'] = 3;
		}
		
		if (isset($this->request->post['abandoned_cart_reminder_hide_out_stock'])) {
			$data['abandoned_cart_reminder_hide_out_stock'] = $this->request->post['abandoned_cart_reminder_hide_out_stock'];
		} elseif ($this->config->get('abandoned_cart_reminder_hide_out_stock')) { 
			$data['abandoned_cart_reminder_hide_out_stock'] = $this->config->get('abandoned_cart_reminder_hide_out_stock');
		} else {
			$data['abandoned_cart_reminder_hide_out_stock'] = '';
		}		
		
		if (isset($this->request->post['abandoned_cart_reminder_use_html_email'])) {
			$data['abandoned_cart_reminder_use_html_email'] = $this->request->post['abandoned_cart_reminder_use_html_email'];
		} elseif ($this->config->get('abandoned_cart_reminder_use_html_email')) { 
			$data['abandoned_cart_reminder_use_html_email'] = $this->config->get('abandoned_cart_reminder_use_html_email');
		} else {
			$data['abandoned_cart_reminder_use_html_email'] = '';
		}
		
		if (isset($this->request->post['abandoned_cart_reminder_add_coupon'])) {
			$data['abandoned_cart_reminder_add_coupon'] = $this->request->post['abandoned_cart_reminder_add_coupon'];
		} elseif ($this->config->get('abandoned_cart_reminder_add_coupon')) { 
			$data['abandoned_cart_reminder_add_coupon'] = $this->config->get('abandoned_cart_reminder_add_coupon');
		} else {
			$data['abandoned_cart_reminder_add_coupon'] = 0;
		}
		
		if (isset($this->request->post['abandoned_cart_reminder_coupon_type'])) {
			$data['abandoned_cart_reminder_coupon_type'] = $this->request->post['abandoned_cart_reminder_coupon_type'];
		} elseif ($this->config->get('abandoned_cart_reminder_coupon_type')) { 
			$data['abandoned_cart_reminder_coupon_type'] = $this->config->get('abandoned_cart_reminder_coupon_type');
		} else {
			$data['abandoned_cart_reminder_coupon_type'] = 0;
		}
		
		if (isset($this->request->post['abandoned_cart_reminder_coupon_amount'])) {
			$data['abandoned_cart_reminder_coupon_amount'] = $this->request->post['abandoned_cart_reminder_coupon_amount'];
		} elseif ($this->config->get('abandoned_cart_reminder_coupon_amount')) { 
			$data['abandoned_cart_reminder_coupon_amount'] = $this->config->get('abandoned_cart_reminder_coupon_amount');
		} else {
			$data['abandoned_cart_reminder_coupon_amount'] = '';
		}
		
		if (isset($this->request->post['abandoned_cart_reminder_coupon_total'])) {
			$data['abandoned_cart_reminder_coupon_total'] = $this->request->post['abandoned_cart_reminder_coupon_total'];
		} elseif ($this->config->get('abandoned_cart_reminder_coupon_total')) { 
			$data['abandoned_cart_reminder_coupon_total'] = $this->config->get('abandoned_cart_reminder_coupon_total');
		} else {
			$data['abandoned_cart_reminder_coupon_total'] = '';
		}
		
		if (isset($this->request->post['abandoned_cart_reminder_coupon_usage'])) {
			$data['abandoned_cart_reminder_coupon_usage'] = $this->request->post['abandoned_cart_reminder_coupon_usage'];
		} elseif ($this->config->get('abandoned_cart_reminder_coupon_usage')) { 
			$data['abandoned_cart_reminder_coupon_usage'] = $this->config->get('abandoned_cart_reminder_coupon_usage');
		} else {
			$data['abandoned_cart_reminder_coupon_usage'] = '';
		}
		
		if (isset($this->request->post['abandoned_cart_reminder_coupon_expire'])) {
			$data['abandoned_cart_reminder_coupon_expire'] = $this->request->post['abandoned_cart_reminder_coupon_expire'];
		} elseif ($this->config->get('abandoned_cart_reminder_coupon_expire')) { 
			$data['abandoned_cart_reminder_coupon_expire'] = $this->config->get('abandoned_cart_reminder_coupon_expire');
		} else {
			$data['abandoned_cart_reminder_coupon_expire'] = 2;
		}
		
		if (isset($this->request->post['abandoned_cart_reminder_reward_limit'])) {
			$data['abandoned_cart_reminder_reward_limit'] = $this->request->post['abandoned_cart_reminder_reward_limit'];
		} elseif ($this->config->get('abandoned_cart_reminder_reward_limit')) { 
			$data['abandoned_cart_reminder_reward_limit'] = $this->config->get('abandoned_cart_reminder_reward_limit');
		} else {
			$data['abandoned_cart_reminder_reward_limit'] = '';
		}
		
		if (isset($this->request->post['abandoned_cart_reminder_mail'])) {
			$data['abandoned_cart_reminder_mail'] = $this->request->post['abandoned_cart_reminder_mail'];
		} elseif ($this->config->get('abandoned_cart_reminder_mail')) { 
			$data['abandoned_cart_reminder_mail'] = $this->config->get('abandoned_cart_reminder_mail');
		} else {
			$data['abandoned_cart_reminder_mail'] = array();
		}		
		
		$currency_symbol_left = $this->currency->getSymbolLeft();
		$currency_symbol_right = $this->currency->getSymbolRight();
		
		if (!empty($currency_symbol_left)) {
			$data['currency_symbol'] = $currency_symbol_left;
		} else {
			$data['currency_symbol'] = $currency_symbol_right;
		}		
		
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		$data['token'] = $this->session->data['token'];
				
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/abandoned_cart_reminder.tpl', $data));
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/abandoned_cart_reminder')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		$dinamic_strlen = 'utf8_strlen';
		 
		if ( !function_exists('utf8_strlen') ) {
			$dinamic_strlen = 'strlen';
		}
		
		if ($dinamic_strlen($this->request->post['abandoned_cart_reminder_secret_code']) < 5) {
			$this->error['secret_code'] = $this->language->get('error_secret_code');
			$this->error['warning'] = sprintf($this->language->get('error_in_tab'), $this->language->get('tab_setting'));
		}

		if ($dinamic_strlen($this->request->post['abandoned_cart_reminder_delay']) < 1) {
			$this->error['delay'] = $this->language->get('error_delay');
			$this->error['warning'] = sprintf($this->language->get('error_in_tab'), $this->language->get('tab_setting'));
		}	

		if ($dinamic_strlen($this->request->post['abandoned_cart_reminder_max_reminders']) < 1) {
			$this->error['max_reminders'] = $this->language->get('error_max_reminders');
			$this->error['warning'] = sprintf($this->language->get('error_in_tab'), $this->language->get('tab_setting'));
		}	
		
		if ($this->request->post['abandoned_cart_reminder_use_html_email'] == 1 && !$this->isHTMLEmailExtensionInstalled() ) {
			$this->error['use_html_email'] = $this->language->get('error_html_email_not_installed');
			$this->error['warning'] = sprintf($this->language->get('error_in_tab'), $this->language->get('tab_setting'));
		}

		if ($this->request->post['abandoned_cart_reminder_add_coupon']){
			if ($dinamic_strlen($this->request->post['abandoned_cart_reminder_coupon_amount']) < 1) {
				$this->error['coupon_amount'] = $this->language->get('error_coupon_amount');
				$this->error['warning'] = sprintf($this->language->get('error_in_tab'), $this->language->get('tab_coupon'));
			}
			
			if ($dinamic_strlen($this->request->post['abandoned_cart_reminder_coupon_expire']) < 1) {
				$this->error['coupon_expire'] = $this->language->get('error_coupon_expire');
				$this->error['warning'] = sprintf($this->language->get('error_in_tab'), $this->language->get('tab_coupon'));
			}
		}
		
		foreach ($this->request->post['abandoned_cart_reminder_mail'] as $language_id => $value) {
			if ($dinamic_strlen($value['subject']) < 1) {
        		$this->error['subject'][$language_id] = $this->language->get('error_subject');
				$this->error['warning'] = sprintf($this->language->get('error_in_tab'), $this->language->get('tab_email'));
      		}

			if ($dinamic_strlen(html_entity_decode($value['message_reward'], ENT_QUOTES, 'UTF-8')) < 20) {
        		$this->error['message_reward'][$language_id] = $this->language->get('error_message');
				$this->error['warning'] = sprintf($this->language->get('error_in_tab'), $this->language->get('tab_email'));
      		}
			
			if ($dinamic_strlen(html_entity_decode($value['message_no_reward'], ENT_QUOTES, 'UTF-8')) < 20) {
        		$this->error['message_no_reward'][$language_id] = $this->language->get('error_message');
				$this->error['warning'] = sprintf($this->language->get('error_in_tab'), $this->language->get('tab_email'));
      		}
		}		
		
		return !$this->error;	
	}
	
	private function isHTMLEmailExtensionInstalled() {
		$installed = false;
		
		if ($this->config->get('html_email_default_word') && file_exists(DIR_APPLICATION . 'model/tool/html_email.php') && file_exists(DIR_CATALOG . 'model/tool/html_email.php')) {
			$installed = true;	
		}
		
		return $installed;
	}
	
	public function getAbandonedCarts() {
	    $this->load->language('module/abandoned_cart_reminder');
		
		$this->load->model('module/abandoned_cart_reminder');
		$this->load->model('catalog/product');
		
		$data['column_customer']     = $this->language->get('column_customer');
		$data['column_cart_content'] = $this->language->get('column_cart_content');
		$data['column_last_visit']   = $this->language->get('column_last_visit');
		$data['column_reminder_sent']= $this->language->get('column_reminder_sent');
		$data['column_reward_sent']  = $this->language->get('column_reward_sent');
		$data['column_action']  = $this->language->get('column_action');
		
		$data['text_reminder_preview'] = $this->language->get('text_reminder_preview');
		$data['text_reminder_send'] = $this->language->get('text_reminder_send');
		
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_send_all'] = $this->language->get('text_send_all');
		
		$data['button_preview'] = $this->language->get('button_preview');
		$data['button_send'] = $this->language->get('button_send');
		$data['button_send_all'] = $this->language->get('button_send_all');
		$data['button_refresh'] = $this->language->get('button_refresh');
		
		$data['reminders'] = array();
		
		$reminders = $this->filterCustomers($this->model_module_abandoned_cart_reminder->getCustomersForReminder());
		
		if ($reminders) {
			foreach ($reminders as $reminder) {
				$data['reminders'][] = array(
					'customer_id'   => $reminder['customer_id'],
					'firstname'     => $reminder['firstname'],
					'lastname'      => $reminder['lastname'],
					'email'         => $reminder['email'],
					'telephone'     => $reminder['telephone'],
					'cart_products' => $this->getCartProducts($reminder['cart']), 
					'last_action'   => date($this->language->get('date_format_short') . ' H:i:s', strtotime($reminder['date_last_action'])),
					'reminder_sent' => $reminder['number_reminder_sent'],
					'reward_sent'   => $reminder['number_reward_sent']
				);
			}
		}
		
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$data['front_base_url'] = defined('HTTPS_CATALOG')? HTTPS_CATALOG : HTTP_CATALOG;
		} else {
			$data['front_base_url'] = HTTP_CATALOG;
		}		
		
		$data['abandoned_cart_reminder_secret_code'] = $this->config->get('abandoned_cart_reminder_secret_code');
		
		$data['token'] = $this->session->data['token'];
		
		$this->response->setOutput($this->load->view('module/abandoned_cart_list.tpl', $data));
	}
	
	public function getRemindersHistory() {
		$this->load->language('module/abandoned_cart_reminder');
		
		$this->load->model('module/abandoned_cart_reminder');
		$this->load->model('catalog/product');

		if (isset($this->request->get['filter_customer'])) {
			$filter_customer = $this->request->get['filter_customer'];
		} else {
			$filter_customer = null;
		}
		
		if (isset($this->request->get['filter_coupon_code'])) {
			$filter_coupon_code = $this->request->get['filter_coupon_code'];
		} else {
			$filter_coupon_code = null;
		}

		if (isset($this->request->get['filter_date_added'])) {
			$filter_date_added = $this->request->get['filter_date_added'];
		} else {
			$filter_date_added = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'ah.acr_history_id';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_coupon_code'])) {
			$url .= '&filter_coupon_code=' . urlencode(html_entity_decode($this->request->get['filter_coupon_code'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$data['reminders'] = array();
		
		$filter_data = array(
			'filter_customer'	     => $filter_customer,
			'filter_coupon_code'	 => $filter_coupon_code,
			'filter_date_added'      => $filter_date_added,
			'sort'                   => $sort,
			'order'                  => $order,
			'start'                  => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'                  => $this->config->get('config_limit_admin')
		);
		
		$reminder_total = $this->model_module_abandoned_cart_reminder->getTotalHistories($filter_data);
		
		$reminders = $this->model_module_abandoned_cart_reminder->getHistories($filter_data);
		
		if ($reminders) {
			foreach ($reminders as $reminder) {
				$data['reminders'][] = array(
					'acr_history_id'=> $reminder['acr_history_id'],
					'customer_id'   => $reminder['customer_id'],
					'customer_name' => $reminder['customer_name'],
					'telephone' 	=> $reminder['telephone'],
					'coupon_code'   => $reminder['coupon_code'],
					//'coupon_link'   => $this->url->link('sale/coupon/update', 'coupon_id=' . $reminder['coupon_id'] . '&token=' . $this->session->data['token'], 'SSL'),
					'coupon_used'   => ($reminder['coupon_used'] == 1)? $this->language->get('text_yes') : $this->language->get('text_no'),
					'date_sent'     => date($this->language->get('date_format_short') . ' H:i:s', strtotime($reminder['date_added'])),
				);
			}
		}
		 
		$data['entry_customer']     = $this->language->get('entry_customer');
		$data['entry_coupon_code']  = $this->language->get('entry_coupon_code');
		$data['entry_email']        = $this->language->get('entry_email');
		$data['entry_date_sent']    = $this->language->get('entry_date_sent');		
		
		$data['column_customer']     = $this->language->get('column_customer');
		$data['column_coupon_code']  = $this->language->get('column_coupon_code');
		$data['column_coupon_used']  = $this->language->get('column_coupon_used');
		$data['column_email']        = $this->language->get('column_email');
		$data['column_date_sent']    = $this->language->get('column_date_sent');
		$data['column_action']       = $this->language->get('column_action');
		
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_reminder_message'] = $this->language->get('text_reminder_message');
		
		$data['button_view_reminder'] = $this->language->get('button_view_reminder');
		$data['button_filter']        = $this->language->get('button_filter');
		
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$data['front_base_url'] = defined('HTTPS_CATALOG')? HTTPS_CATALOG : HTTP_CATALOG;
		} else {
			$data['front_base_url'] = HTTP_CATALOG;
		}		
		
		$data['abandoned_cart_reminder_secret_code'] = $this->config->get('abandoned_cart_reminder_secret_code');
		
		$data['token'] = $this->session->data['token'];
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$url = '';

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_coupon_code'])) {
			$url .= '&filter_coupon_code=' . urlencode(html_entity_decode($this->request->get['filter_coupon_code'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$pagination = new Pagination();
		$pagination->total = $reminder_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('module/abandoned_cart_reminder/getRemindersHistory', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();
		
		$data['results'] = sprintf($this->language->get('text_pagination'), ($reminder_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($reminder_total - $this->config->get('config_limit_admin'))) ? $reminder_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $reminder_total, ceil($reminder_total / $this->config->get('config_limit_admin')));

		$data['filter_customer'] = $filter_customer;
		$data['filter_coupon_code'] = $filter_coupon_code;
		$data['filter_date_added'] = $filter_date_added;		

		$this->response->setOutput($this->load->view('module/abandoned_cart_history.tpl', $data));
	}
	
	public function getReminderEmail() {	
		$this->load->model('module/abandoned_cart_reminder');
	
		$json = array();
		
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
		
			$reminder_info = $this->model_module_abandoned_cart_reminder->getHistory($this->request->post['acr_history_id']);
			
			if ($reminder_info) {
				$json['customer_name']     = $reminder_info['firstname'] . ' ' . $reminder_info['lastname'];
				$json['date_added']        = $reminder_info['date_added'];
				$json['email_description'] = html_entity_decode($reminder_info['email_description'], ENT_QUOTES, 'UTF-8'); 
			}
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function getTotalRecovered() {	
		$this->load->language('module/abandoned_cart_reminder');
		$this->load->model('module/abandoned_cart_reminder');
	
		$json = array();
		
		$total_recovered = $this->model_module_abandoned_cart_reminder->getTotalRecovered();
		
		if ((int)$total_recovered > 0) {
			$json['total_recovered'] = sprintf($this->language->get('text_total_recovered'), $this->currency->format($total_recovered));
		}	
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	private function getCartProducts($customer_cart){
		$this->load->model('tool/image');
		
		$cart_products = array();
		
		if ($customer_cart && is_string($customer_cart)) {
			$cart = unserialize($customer_cart);
		
			foreach ($cart as $key => $quantity) {
				$product = unserialize(base64_decode($key));

				$product_id = $product['product_id'];

				$stock = true;

				// Options
				if (!empty($product['option'])) {
					$options = $product['option'];
				} else {
					$options = array();
				}

				// Profile
				if (!empty($product['recurring_id'])) {
					$recurring_id = $product['recurring_id'];
				} else {
					$recurring_id = 0;
				}

				$product_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.date_available <= NOW() AND p.status = '1'");

				if ($product_query->num_rows) {
					
					if ($product_query->row['image']) {
						$image = $this->model_tool_image->resize($product_query->row['image'], 30, 30);
					} else {
						$image = $this->model_tool_image->resize('no_image.png', 30, 30);
					}
					
					$option_data = array();

					foreach ($options as $product_option_id => $value) {
						$option_query = $this->db->query("SELECT po.product_option_id, po.option_id, od.name, o.type FROM " . DB_PREFIX . "product_option po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE po.product_option_id = '" . (int)$product_option_id . "' AND po.product_id = '" . (int)$product_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "'");

						if ($option_query->num_rows) {
							if ($option_query->row['type'] == 'select' || $option_query->row['type'] == 'radio' || $option_query->row['type'] == 'image') {
								$option_value_query = $this->db->query("SELECT pov.option_value_id, ovd.name, pov.quantity, pov.subtract, pov.price, pov.price_prefix, pov.points, pov.points_prefix, pov.weight, pov.weight_prefix FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_option_value_id = '" . (int)$value . "' AND pov.product_option_id = '" . (int)$product_option_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

								if ($option_value_query->num_rows) {
									$option_data[] = array(
										'name'  => $option_query->row['name'],
										'value' => $option_value_query->row['name']
									);
								}
							} elseif ($option_query->row['type'] == 'checkbox' && is_array($value)) {
								foreach ($value as $product_option_value_id) {
									$option_value_query = $this->db->query("SELECT pov.option_value_id, ovd.name, pov.quantity, pov.subtract, pov.price, pov.price_prefix, pov.points, pov.points_prefix, pov.weight, pov.weight_prefix FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_option_value_id = '" . (int)$product_option_value_id . "' AND pov.product_option_id = '" . (int)$product_option_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

									if ($option_value_query->num_rows) {
										$option_data[] = array(
											'name'  => $option_query->row['name'],
											'value' => $option_value_query->row['name']
										);
									}
								}
							} elseif ($option_query->row['type'] == 'text' || $option_query->row['type'] == 'textarea' || $option_query->row['type'] == 'file' || $option_query->row['type'] == 'date' || $option_query->row['type'] == 'datetime' || $option_query->row['type'] == 'time') {
								$option_data[] = array(
									'name'  => $option_query->row['name'],
									'value' => $value
								);
							}
						}
					}

					$cart_products[] = array(
						'product_id'      => $product_query->row['product_id'],
						'name'            => $product_query->row['name'],
						'image'           => $image,
						'options'         => $option_data,
						'quantity'        => $quantity
					);
				}
			}			
		}
		
		return $cart_products;
	}	
	
	private function hasActiveProducts($customer_info) {
		$active_products = 0;
		
		if ($customer_info['cart'] && is_string($customer_info['cart'])) {		
			$cart = unserialize($customer_info['cart']);
			
			foreach ($cart as $key => $value) {
				$product = unserialize(base64_decode($key));
				$product_id = $product['product_id'];
				
				$product_info = $this->model_catalog_product->getProduct($product_id);
				
				if ($product_info){ 
					if ($this->config->get('abandoned_cart_reminder_hide_out_stock')) {
						if ($product_info['quantity'] > 0) {
							$active_products++;
						}
					} else {
						$active_products++;
					}	
				}
			}			
		}
		
		return $active_products;
	}
	
	private function isPreviousOrder($customer_info) {
		$is_previous_order = false;
		
		$last_order_id = $this->model_module_abandoned_cart_reminder->getLastOrderId($customer_info['customer_id']);
		
		if ($last_order_id) {
			$last_order_products = $this->model_module_abandoned_cart_reminder->getLastOrderProducts($last_order_id);
		
			if ($customer_info['cart'] && is_string($customer_info['cart'])) {
				$cart = unserialize($customer_info['cart']);
				
				if ($this->hasSameProducts($cart, $last_order_products)) {
					$is_previous_order = true;
				}				
			}
		}
	
		return $is_previous_order;
	}
	
	private function hasSameProducts($cart, $last_order_products) {
		$same_products = true;  
		
		if (count($cart) != count($last_order_products)) {
			$same_products = false;
		} else {
		
			foreach ($cart as $key => $value) {
				$product = unserialize(base64_decode($key));
				$product_id = $product['product_id'];
				
				if (!in_array($product_id, $last_order_products)) {
					$same_products = false;
				}
			}	
		}
		
		return $same_products;
	}
	
	private function filterCustomers($customers) {
		$filtred_customers = array();
		
		if ($customers) {
			foreach($customers as $customer) {
				if ($this->hasActiveProducts($customer) && !$this->isPreviousOrder($customer)) {
					$filtred_customers[] = $customer; 
				}
			}			
		}
		
		return $filtred_customers;
	}
	
	private function update_check() {
		$data = 'v=' . $this->version . '&ex=15&e=' . $this->config->get('config_email') . '&ocv=' . VERSION;
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