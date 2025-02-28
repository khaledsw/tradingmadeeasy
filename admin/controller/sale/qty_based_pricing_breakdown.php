<?php 
class ControllerSaleQtyBasedPricingBreakdown extends Controller {
	private $error = array();
	
	protected function db_qty_based_pricing_breakdown_tbl_Check(){
		$query = $this->db->query("SHOW TABLES LIKE '".DB_PREFIX."qty_based_pricing_breakdown' ");
		if(!$query->num_rows){
			$this->db->query("CREATE TABLE IF NOT EXISTS `".DB_PREFIX."qty_based_pricing_breakdown` (
				  `qty_based_pricing_breakdown_id` int(11) NOT NULL AUTO_INCREMENT,
				  `name` varchar(128) NOT NULL,
  				  `date_start` date NOT NULL DEFAULT '0000-00-00',
				  `date_end` date NOT NULL DEFAULT '0000-00-00',
				  `status` tinyint(1) NOT NULL,
				  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
				  PRIMARY KEY (`qty_based_pricing_breakdown_id`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			");
		}
	} 
   
 	protected function db_qty_based_pricing_breakdown_product_tbl_Check(){
 		$query = $this->db->query("SHOW TABLES LIKE '".DB_PREFIX."qty_based_pricing_breakdown_product' ");
		if(!$query->num_rows){
			$this->db->query("CREATE TABLE IF NOT EXISTS `".DB_PREFIX."qty_based_pricing_breakdown_product` (
			  `qty_based_pricing_breakdown_product_id` int(11) NOT NULL AUTO_INCREMENT,
			  `qty_based_pricing_breakdown_id` int(11) NOT NULL,
 			  `product_id` int(11) NOT NULL,
			  `qty_from` int(11) NOT NULL,
			  `qty_to` int(11) NOT NULL,
			  `price_per_unit` decimal(10,2),			  
			  PRIMARY KEY (`qty_based_pricing_breakdown_product_id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
		}
	}

	public function index() {
		$this->db_qty_based_pricing_breakdown_tbl_Check();
  		$this->db_qty_based_pricing_breakdown_product_tbl_Check();
		
		$this->load->language('sale/qty_based_pricing_breakdown');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/qty_based_pricing_breakdown');

		$this->getList();
	}

	public function add() {
		$this->load->language('sale/qty_based_pricing_breakdown');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/qty_based_pricing_breakdown');
 
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_sale_qty_based_pricing_breakdown->addQtyBasedPricingBreakdown($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('sale/qty_based_pricing_breakdown', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('sale/qty_based_pricing_breakdown');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/qty_based_pricing_breakdown');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_sale_qty_based_pricing_breakdown->editQtyBasedPricingBreakdown($this->request->get['qty_based_pricing_breakdown_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('sale/qty_based_pricing_breakdown', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('sale/qty_based_pricing_breakdown');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/qty_based_pricing_breakdown');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $qty_based_pricing_breakdown_id) {
				$this->model_sale_qty_based_pricing_breakdown->deleteQtyBasedPricingBreakdown($qty_based_pricing_breakdown_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('sale/qty_based_pricing_breakdown', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('sale/qty_based_pricing_breakdown', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('sale/qty_based_pricing_breakdown/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('sale/qty_based_pricing_breakdown/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['qty_based_pricing_breakdowns'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$qty_based_pricing_breakdown_total = $this->model_sale_qty_based_pricing_breakdown->getTotalQtyBasedPricingBreakdowns();

		$results = $this->model_sale_qty_based_pricing_breakdown->getQtyBasedPricingBreakdowns($filter_data);

		foreach ($results as $result) {
			$data['qty_based_pricing_breakdowns'][] = array(
				'qty_based_pricing_breakdown_id'  => $result['qty_based_pricing_breakdown_id'],
				'name'       => $result['name'],
 				'date_start' => date($this->language->get('date_format_short'), strtotime($result['date_start'])),
				'date_end'   => date($this->language->get('date_format_short'), strtotime($result['date_end'])),
				'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'view'       => $this->url->link('sale/qty_based_pricing_breakdown/view', 'token=' . $this->session->data['token'] . '&qty_based_pricing_breakdown_id=' . $result['qty_based_pricing_breakdown_id'] . $url, 'SSL'),
				'edit'       => $this->url->link('sale/qty_based_pricing_breakdown/edit', 'token=' . $this->session->data['token'] . '&qty_based_pricing_breakdown_id=' . $result['qty_based_pricing_breakdown_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
 		$data['column_date_start'] = $this->language->get('column_date_start');
		$data['column_date_end'] = $this->language->get('column_date_end');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');

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

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('sale/qty_based_pricing_breakdown', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
 		$data['sort_date_start'] = $this->url->link('sale/qty_based_pricing_breakdown', 'token=' . $this->session->data['token'] . '&sort=date_start' . $url, 'SSL');
		$data['sort_date_end'] = $this->url->link('sale/qty_based_pricing_breakdown', 'token=' . $this->session->data['token'] . '&sort=date_end' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('sale/qty_based_pricing_breakdown', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $qty_based_pricing_breakdown_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('sale/qty_based_pricing_breakdown', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($qty_based_pricing_breakdown_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($qty_based_pricing_breakdown_total - $this->config->get('config_limit_admin'))) ? $qty_based_pricing_breakdown_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $qty_based_pricing_breakdown_total, ceil($qty_based_pricing_breakdown_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('sale/qty_based_pricing_breakdown_list.tpl', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_form'] = !isset($this->request->get['qty_based_pricing_breakdown_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_percent'] = $this->language->get('text_percent');
		$data['text_amount'] = $this->language->get('text_amount');

		$data['entry_name'] = $this->language->get('entry_name');
 		$data['entry_product'] = $this->language->get('entry_product');
		$data['entry_date_start'] = $this->language->get('entry_date_start');
		$data['entry_date_end'] = $this->language->get('entry_date_end');
 		$data['entry_status'] = $this->language->get('entry_status');
		
		$data['entry_qty_from'] = $this->language->get('entry_qty_from');
		$data['entry_qty_to'] = $this->language->get('entry_qty_to');
		$data['entry_price_per_unit'] = $this->language->get('entry_price_per_unit');
   		$data['help_product'] = $this->language->get('help_product');
  
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_qty_add'] = $this->language->get('button_qty_add');
		$data['button_remove'] = $this->language->get('button_remove');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_history'] = $this->language->get('tab_history');
 		$data['token'] = $this->session->data['token'];

		if (isset($this->request->get['qty_based_pricing_breakdown_id'])) {
			$data['qty_based_pricing_breakdown_id'] = $this->request->get['qty_based_pricing_breakdown_id'];
		} else {
			$data['qty_based_pricing_breakdown_id'] = 0;
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}
		
		if (isset($this->error['qty_from'])) {
			$data['error_qty_from'] = $this->error['qty_from'];
		} else {
			$data['error_qty_from'] = '';
		}
		
		if (isset($this->error['qty_to'])) {
			$data['error_qty_to'] = $this->error['qty_to'];
		} else {
			$data['error_qty_to'] = '';
		}
		
		if (isset($this->error['price_per_unit'])) {
			$data['error_price_per_unit'] = $this->error['price_per_unit'];
		} else {
			$data['error_price_per_unit'] = '';
		}
 
		if (isset($this->error['date_start'])) {
			$data['error_date_start'] = $this->error['date_start'];
		} else {
			$data['error_date_start'] = '';
		}

		if (isset($this->error['date_end'])) {
			$data['error_date_end'] = $this->error['date_end'];
		} else {
			$data['error_date_end'] = '';
		}

		$url = '';

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('sale/qty_based_pricing_breakdown', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['qty_based_pricing_breakdown_id'])) {
			$data['action'] = $this->url->link('sale/qty_based_pricing_breakdown/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('sale/qty_based_pricing_breakdown/edit', 'token=' . $this->session->data['token'] . '&qty_based_pricing_breakdown_id=' . $this->request->get['qty_based_pricing_breakdown_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('sale/qty_based_pricing_breakdown', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['qty_based_pricing_breakdown_id']) && (!$this->request->server['REQUEST_METHOD'] != 'POST')) {
			$qty_based_pricing_breakdown_info = $this->model_sale_qty_based_pricing_breakdown->getQtyBasedPricingBreakdown($this->request->get['qty_based_pricing_breakdown_id']);
		}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($qty_based_pricing_breakdown_info)) {
			$data['name'] = $qty_based_pricing_breakdown_info['name'];
		} else {
			$data['name'] = '';
		}
   
		// product
		if (isset($this->request->post['qty_based_pricing_breakdown_product'])) {
			$products = $this->request->post['qty_based_pricing_breakdown_product'];
		} elseif (isset($this->request->get['qty_based_pricing_breakdown_id'])) {
			$products = $this->model_sale_qty_based_pricing_breakdown->getQtyBasedPricingBreakdownProducts($this->request->get['qty_based_pricing_breakdown_id']);
		} else {
			$products = array();
		}

		$this->load->model('catalog/product');

		$data['qty_based_pricing_breakdown_product'] = array();

		foreach ($products as $product_id) {
			$product_info = $this->model_catalog_product->getProduct($product_id);
			
			$special = false;

			$product_specials = $this->model_catalog_product->getProductSpecials($product_info['product_id']);

			foreach ($product_specials  as $product_special) {
				if (($product_special['date_start'] == '0000-00-00' || strtotime($product_special['date_start']) < time()) && ($product_special['date_end'] == '0000-00-00' || strtotime($product_special['date_end']) > time())) {
					$special = $product_special['price'];

					break;
				}
			}

			if ($product_info) {
				$data['qty_based_pricing_breakdown_product'][] = array(
					'product_id' => $product_info['product_id'],
					'name'       => $product_info['name'],
					'price'       => ($special) ? $special : $product_info['price'],
				);
			}
		}
		
		if (isset($this->request->post['data_qty'])) {
			$qty_data = $this->request->post['data_qty'];
		} elseif (isset($this->request->get['qty_based_pricing_breakdown_id'])) {
			$qty_data = $this->model_sale_qty_based_pricing_breakdown->getQtyData($this->request->get['qty_based_pricing_breakdown_id']);
		} else {
			$qty_data = array();
		}
		
		$data['qty_data'] = array();
		 
		foreach ($qty_data as $data_qty) {
 			$data['qty_data'][] = array(
				'qty_from' => $data_qty['qty_from'],
				'qty_to' => $data_qty['qty_to'],
				'price_per_unit' => $data_qty['price_per_unit'],
 			);
		}

		if (isset($this->request->post['date_start'])) {
			$data['date_start'] = $this->request->post['date_start'];
		} elseif (!empty($qty_based_pricing_breakdown_info)) {
			$data['date_start'] = ($qty_based_pricing_breakdown_info['date_start'] != '0000-00-00' ? $qty_based_pricing_breakdown_info['date_start'] : '');
		} else {
			$data['date_start'] = date('Y-m-d', time());
		}

		if (isset($this->request->post['date_end'])) {
			$data['date_end'] = $this->request->post['date_end'];
		} elseif (!empty($qty_based_pricing_breakdown_info)) {
			$data['date_end'] = ($qty_based_pricing_breakdown_info['date_end'] != '0000-00-00' ? $qty_based_pricing_breakdown_info['date_end'] : '');
		} else {
			$data['date_end'] = date('Y-m-d', strtotime('+1 month'));
		}
 
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($qty_based_pricing_breakdown_info)) {
			$data['status'] = $qty_based_pricing_breakdown_info['status'];
		} else {
			$data['status'] = true;
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('sale/qty_based_pricing_breakdown_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'sale/qty_based_pricing_breakdown')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		$product_priing_data = array();
		
		if (isset($this->request->post['qty_based_pricing_breakdown_product'])) {
			$products = $this->request->post['qty_based_pricing_breakdown_product'];
		} else {
			$products = array();
		}

		$this->load->model('catalog/product');
		
 		foreach ($products as $product_id) {  
			$product_info = $this->model_catalog_product->getProduct($product_id);
			
			$special = false;

			$product_specials = $this->model_catalog_product->getProductSpecials($product_info['product_id']);

			foreach ($product_specials  as $product_special) {
				if (($product_special['date_start'] == '0000-00-00' || strtotime($product_special['date_start']) < time()) && ($product_special['date_end'] == '0000-00-00' || strtotime($product_special['date_end']) > time())) {
					$special = $product_special['price'];

					break;
				}
			}
			
			if ($product_info) {
				$product_priing_data = array(
					'product_id' => $product_info['product_id'],
					'name'       => $product_info['name'],
					'price'       => ($special) ? $special : $product_info['price'],
				);
			}
		}
		
		if (isset($this->request->post['data_qty'])) {
			$qty_data = $this->request->post['data_qty'];
		} else {
			$qty_data = array();
		}
		//print_r($qty_data);exit;
		
	 	$qtcnt = 0;
		foreach($qty_data as $key => $dataqty) { $qtcnt++; if($qtcnt == 1) {continue;}
			if($dataqty['qty_from'] < 2) {
				$this->error['qty_from'][$key] = $this->language->get('error_qty_from');
			}
			
			if($dataqty['qty_to'] < 2 || $dataqty['qty_to'] <= $dataqty['qty_from']) {
				$this->error['qty_to'][$key] = $this->language->get('error_qty_to');
			}
			
			if($dataqty['price_per_unit'] >= $product_priing_data['price']) {
				$this->error['price_per_unit'][$key] = $this->language->get('error_price_per_unit');
			}
		}
  
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 128)) {
			$this->error['name'] = $this->language->get('error_name');
		}
   
		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'sale/qty_based_pricing_breakdown')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
	
	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_model'])) {
			$this->load->model('catalog/product');
			$this->load->model('catalog/option');

			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}

			if (isset($this->request->get['filter_model'])) {
				$filter_model = $this->request->get['filter_model'];
			} else {
				$filter_model = '';
			}

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = 5;
			}

			$filter_data = array(
				'filter_name'  => $filter_name,
				'filter_model' => $filter_model,
				'start'        => 0,
				'limit'        => $limit
			);

			$results = $this->model_catalog_product->getProducts($filter_data);

			foreach ($results as $result) {
				$option_data = array();
				
				$special = false;

				$product_specials = $this->model_catalog_product->getProductSpecials($result['product_id']);
	
				foreach ($product_specials  as $product_special) {
					if (($product_special['date_start'] == '0000-00-00' || strtotime($product_special['date_start']) < time()) && ($product_special['date_end'] == '0000-00-00' || strtotime($product_special['date_end']) > time())) {
						$special = $product_special['price'];
	
						break;
					}
				}

				$product_options = $this->model_catalog_product->getProductOptions($result['product_id']);

				foreach ($product_options as $product_option) {
					$option_info = $this->model_catalog_option->getOption($product_option['option_id']);

					if ($option_info) {
						$product_option_value_data = array();

						foreach ($product_option['product_option_value'] as $product_option_value) {
							$option_value_info = $this->model_catalog_option->getOptionValue($product_option_value['option_value_id']);

							if ($option_value_info) {
								$product_option_value_data[] = array(
									'product_option_value_id' => $product_option_value['product_option_value_id'],
									'option_value_id'         => $product_option_value['option_value_id'],
									'name'                    => $option_value_info['name'],
									'price'                   => (float)$product_option_value['price'] ? $this->currency->format($product_option_value['price'], $this->config->get('config_currency')) : false,
									'price_prefix'            => $product_option_value['price_prefix']
								);
							}
						}

						$option_data[] = array(
							'product_option_id'    => $product_option['product_option_id'],
							'product_option_value' => $product_option_value_data,
							'option_id'            => $product_option['option_id'],
							'name'                 => $option_info['name'],
							'type'                 => $option_info['type'],
							'value'                => $product_option['value'],
							'required'             => $product_option['required']
						);
					}
				}

				$json[] = array(
					'product_id' => $result['product_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
					'model'      => $result['model'],
					'option'     => $option_data,
					'price'      => ($special) ? $special : $result['price'],
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}