<?php
class ControllerModuleAddLinksToAdminMenu extends Controller {
	private $error = array(); 

	public function index() {   

		$data['button_save'] = 'Save Changes';
		$data['button_cancel'] = 'Cancel';

		$this->check_the_tables();

		$this->document->setTitle('Add Links To Admin Menu');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

			$this->update_link_information($this->request->post);

			$this->session->data['success'] = 'Success: You have modified module Add Links To Admin Menu!';

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = 'Add Links To Admin Menu';

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => 'Home',
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => 'Module',
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$data['breadcrumbs'][] = array(
			'text'      => 'Add Links To Admin Menu',
			'href'      => $this->url->link('module/addLinksToAdminMenu', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$data['action'] = $this->url->link('module/addLinksToAdminMenu', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$data['modules'] = array();

		$data['existing_links'] = $this->get_links();
		$data['existing_categories'] = $this->get_categories();

		if (isset($this->request->post['addLinksToAdminMenu_module'])) {
			$data['modules'] = $this->request->post['addLinksToAdminMenu_module'];
		}


/* ************************************************************************************************* */

		$this->load->model('design/layout');
/*
		$data['layouts'] = $this->model_design_layout->getLayouts();

		$this->template = 'module/addLinksToAdminMenu.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
*/
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/addLinksToAdminMenu.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/addLinksToAdminMenu')) {
			$this->error['warning'] = 'Warning: You do not have permission to modify module Add Links To Admin Menu!';
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}

	protected function check_the_tables() {
		$query1 = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "imiw_links' ");
		$imiw_links_exist = count($query1->rows);

		if ($imiw_links_exist==0) {
			$this->db->query(" CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "imiw_links (id int(11) AUTO_INCREMENT, link_title varchar(255), link_href varchar(255), new_window int(3), category_id int(11), PRIMARY KEY (id) ) ");	
		}

		$query2 = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "imiw_categories' ");
		$imiw_categories_exist = count($query2->rows);

		if ($imiw_categories_exist==0) {
			$this->db->query(" CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "imiw_categories (id int(11) AUTO_INCREMENT, category_title varchar(255), PRIMARY KEY (id) ) ");	
		}

		return 1;
	}

	protected function get_categories() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "imiw_categories ");
		return $query->rows;
	}

	protected function get_links() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "imiw_links ");
		return $query->rows;
	}


	protected function update_link_information($array) {

		$this->db->query("DELETE FROM " . DB_PREFIX . "imiw_categories ");

		if ( (isset($array['existing_category'])) && (is_array($array['existing_category'])) ) {

			foreach ($array['existing_category'] as $category) {

				if (strlen($category['category_title'])==0) { $cat_title = '-'; } else { $cat_title = $category['category_title']; }

				if (isset($category['category_id'])) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "imiw_categories (id, category_title) VALUES (".$category['category_id'].", '".$cat_title."') ");
				} else {
					$this->db->query("INSERT INTO " . DB_PREFIX . "imiw_categories (category_title) VALUES ('".$cat_title."') ");
				}
			}
		}


		$this->db->query("DELETE FROM " . DB_PREFIX . "imiw_links ");

			if ( (isset($array['existing_link'])) && (is_array($array['existing_link'])) ) {

				foreach ($array['existing_link'] as $link) {

					if ( (isset($link['new_window'])) && ($link['new_window']==1) ) {
						$new_window = 1;
					} else $new_window = 0;

					$this->db->query("INSERT INTO " . DB_PREFIX . "imiw_links (link_title, link_href, category_id, new_window) VALUES ('".$link['link_title']."', '".$link['link_href']."', ".$link['category_id'].", ".$new_window.") ");
				}

			}

		return 1;
	}

}
?>