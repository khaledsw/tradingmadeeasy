<?php
class ControllerModuleSpeedup extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/speedup');

		$this->document->setTitle($this->language->get('document_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			
			$this->model_setting_setting->editSetting('speedup', $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_imglazyload_status'] = $this->language->get('entry_imglazyload_status');
		$data['entry_imglazyload_placeholder'] = $this->language->get('entry_imglazyload_placeholder');
		$data['entry_imglazyload_delaytime'] = $this->language->get('entry_imglazyload_delaytime');
		$data['entry_speedup_compresscss'] = $this->language->get('entry_speedup_compresscss');
		$data['entry_speedup_compressjs'] = $this->language->get('entry_speedup_compressjs');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/speedup', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('module/speedup', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['speedup_status'])) {
			$data['speedup_status'] = $this->request->post['speedup_status'];
		} else {
			$data['speedup_status'] = $this->config->get('speedup_status');
		}
		
		if (isset($this->request->post['speedup_imglazyload_status'])) {
			$data['speedup_imglazyload_status'] = $this->request->post['speedup_imglazyload_status'];
		} else {
			$data['speedup_imglazyload_status'] = $this->config->get('speedup_imglazyload_status');
		}
		
		$this->load->model('tool/image');
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		//buy stciker img
		if (isset($this->request->post['speedup_imglazyload_placeholder'])) {
			$data['speedup_imglazyload_placeholder'] = $this->request->post['speedup_imglazyload_placeholder'];
		} else {
			$data['speedup_imglazyload_placeholder'] = $this->config->get('speedup_imglazyload_placeholder');
		}
  		
		if (is_file(DIR_IMAGE . $data['speedup_imglazyload_placeholder'] )) {
			$data['imglazyload_placeholder_thmb'] = $this->model_tool_image->resize($data['speedup_imglazyload_placeholder'], 100, 100) ;
		} else {
			$data['imglazyload_placeholder_thmb'] = $data['placeholder'];
		}
		//echo $data['imglazyload_placeholder_thmb'] ;exit;
		
		if (isset($this->request->post['speedup_imglazyload_delaytime'])) {
			$data['speedup_imglazyload_delaytime'] = $this->request->post['speedup_imglazyload_delaytime'];
		} else {
			$data['speedup_imglazyload_delaytime'] = $this->config->get('speedup_imglazyload_delaytime');
		}
		
		if (isset($this->request->post['speedup_compresscss'])) {
			$data['speedup_compresscss'] = $this->request->post['speedup_compresscss'];
		} else {
			$data['speedup_compresscss'] = $this->config->get('speedup_compresscss');
		}
		
		if (isset($this->request->post['speedup_compressjs'])) {
			$data['speedup_compressjs'] = $this->request->post['speedup_compressjs'];
		} else {
			$data['speedup_compressjs'] = $this->config->get('speedup_compressjs');
		}
		
		$data['speedup_index_status'] = $this->config->get('speedup_index_status');
		if($data['speedup_index_status'] == 0) {
			$this->checkindex($data['speedup_index_status']);
		}
  		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/speedup.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/speedup')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
	
	public function checkindex($speedup_index_status) {
		if($speedup_index_status == 0) {
 			$alltable_query = $this->db->query("SHOW TABLES");
			if ($alltable_query->num_rows) {
				$alltable_result = $alltable_query->rows;
				foreach($alltable_result as $altbl) {
					$tblnm = $altbl[key($altbl)];
					$colstrc_query = $this->db->query("show columns from `". $tblnm ."` where `Key` = 'PRI'");		
					$colstrc_result = $colstrc_query->row;
 					if ($colstrc_result['Field']) {
 						$this->db->query("ALTER TABLE `". $tblnm ."` ADD INDEX `index_". $colstrc_result['Field'] ."` (`".$colstrc_result['Field']."`) ");		
 					}
				}
				$this->db->query("update `" . DB_PREFIX . "setting` set value = 1 where `code` = 'speedup' and `key` = 'speedup_index_status'");						
			}
		}
	}
}