<?php 
class ControllerToolmasspattrupd extends Controller { 
	private $error = array();
	
	public function index() {
		
    		$this->load->language('tool/masspattrupd');
		
		$this->document->addStyle('view/template/tool/masspattrupd.css');

		$data['heading_title'] = $this->language->get('heading_title');
		
		// Filters
		$data['masstxt_p_filters_h'] = $this->language->get('masstxt_p_filters_h');
		$data['masstxt_name'] = $this->language->get('masstxt_name');
		$data['masstxt_name_help'] = $this->language->get('masstxt_name_help');
		$data['masstxt_model'] = $this->language->get('masstxt_model');
		$data['masstxt_model_help'] = $this->language->get('masstxt_model_help');
		$data['masstxt_tag'] = $this->language->get('masstxt_tag');
		$data['masstxt_tag_help'] = $this->language->get('masstxt_tag_help');
		$data['masstxt_categories'] = $this->language->get('masstxt_categories');
		$data['masstxt_manufacturers'] = $this->language->get('masstxt_manufacturers');
		$data['masstxt_price'] = $this->language->get('masstxt_price');
		$data['masstxt_price_help'] = $this->language->get('masstxt_price_help');
		$data['masstxt_discount'] = $this->language->get('masstxt_discount');
		$data['masstxt_customer_group'] = $this->language->get('masstxt_customer_group');
		$data['masstxt_special'] = $this->language->get('masstxt_special');
		$data['masstxt_tax_class'] = $this->language->get('masstxt_tax_class');
		$data['masstxt_quantity'] = $this->language->get('masstxt_quantity');
		$data['masstxt_minimum_quantity'] = $this->language->get('masstxt_minimum_quantity');
		$data['masstxt_subtract_stock'] = $this->language->get('masstxt_subtract_stock');
		$data['masstxt_out_of_stock_status'] = $this->language->get('masstxt_out_of_stock_status');
		$data['masstxt_requires_shipping'] = $this->language->get('masstxt_requires_shipping');
		$data['masstxt_date_available'] = $this->language->get('masstxt_date_available');
		$data['masstxt_date_added'] = $this->language->get('masstxt_date_added');
		$data['masstxt_date_modified'] = $this->language->get('masstxt_date_modified');
		$data['masstxt_status'] = $this->language->get('masstxt_status');
		$data['masstxt_store'] = $this->language->get('masstxt_store');
		$data['masstxt_with_attribute'] = $this->language->get('masstxt_with_attribute');
		$data['masstxt_with_attribute_value'] = $this->language->get('masstxt_with_attribute_value');
		$data['masstxt_with_attribute_value_help'] = $this->language->get('masstxt_with_attribute_value_help');
		$data['masstxt_with_this_option'] = $this->language->get('masstxt_with_this_option');
		$data['masstxt_with_this_option_value'] = $this->language->get('masstxt_with_this_option_value');
		$data['masstxt_filter_products_button'] = $this->language->get('masstxt_filter_products_button');
		$data['masstxt_table_name'] = $this->language->get('masstxt_table_name');
		$data['masstxt_table_model'] = $this->language->get('masstxt_table_model');
		$data['masstxt_table_price'] = $this->language->get('masstxt_table_price');
		$data['masstxt_table_quantity'] = $this->language->get('masstxt_table_quantity');
		$data['masstxt_table_status'] = $this->language->get('masstxt_table_status');
		$data['masstxt_max_prod_pag1'] = $this->language->get('masstxt_max_prod_pag1');
		$data['masstxt_max_prod_pag2'] = $this->language->get('masstxt_max_prod_pag2');
		$data['masstxt_show_page_of1'] = $this->language->get('masstxt_show_page_of1');
		$data['masstxt_show_page_of2'] = $this->language->get('masstxt_show_page_of2');
		$data['masstxt_total_prod_res'] = $this->language->get('masstxt_total_prod_res');
		$data['masstxt_prod_sel_for_upd'] = $this->language->get('masstxt_prod_sel_for_upd');
		
		$data['masstxt_yes'] = $this->language->get('masstxt_yes');
		$data['masstxt_no'] = $this->language->get('masstxt_no');
		$data['masstxt_enabled'] = $this->language->get('masstxt_enabled');
		$data['masstxt_disabled'] = $this->language->get('masstxt_disabled');
		$data['masstxt_select_all'] = $this->language->get('masstxt_select_all');
		$data['masstxt_unselect_all'] = $this->language->get('masstxt_unselect_all');
		$data['masstxt_none'] = $this->language->get('masstxt_none');
		$data['masstxt_none_cat'] = $this->language->get('masstxt_none_cat');
		$data['masstxt_none_fil'] = $this->language->get('masstxt_none_fil');
		$data['masstxt_all'] = $this->language->get('masstxt_all');
		$data['masstxt_default'] = $this->language->get('masstxt_default');
		$data['masstxt_unselect_all_to_ignore'] = $this->language->get('masstxt_unselect_all_to_ignore');
		$data['masstxt_ignore_this'] = $this->language->get('masstxt_ignore_this');
		$data['masstxt_leave_empty_to_ignore'] = $this->language->get('masstxt_leave_empty_to_ignore');
		$data['masstxt_greater_than_or_equal'] = $this->language->get('masstxt_greater_than_or_equal');
		$data['masstxt_less_than_or_equal'] = $this->language->get('masstxt_less_than_or_equal');
		
		// Attributes updates
		$data['masstxt_p_attributes_updates'] = $this->language->get('masstxt_p_attributes_updates');
		$data['masstxt_load_existing_attributes'] = $this->language->get('masstxt_load_existing_attributes');
		$data['masstxt_name_autocomplete'] = $this->language->get('masstxt_name_autocomplete');
		$data['masstxt_model_autocomplete'] = $this->language->get('masstxt_model_autocomplete');
		$data['masstxt_new_attributes'] = $this->language->get('masstxt_new_attributes');
		$data['masstxt_table_attribute'] = $this->language->get('masstxt_table_attribute');
		$data['masstxt_table_text'] = $this->language->get('masstxt_table_text');
		$data['masstxt_remove'] = $this->language->get('masstxt_remove');
		$data['masstxt_add_attribute'] = $this->language->get('masstxt_add_attribute');
		
		$data['entry_attribute'] = $this->language->get('entry_attribute');
		$data['entry_text'] = $this->language->get('entry_text');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_attribute_add'] = $this->language->get('button_attribute_add');
		
		$data['masstxt_update_mode'] = $this->language->get('masstxt_update_mode');
		$data['masstxt_upd_mode_ad'] = $this->language->get('masstxt_upd_mode_ad');
		$data['masstxt_upd_mode_ad_help'] = $this->language->get('masstxt_upd_mode_ad_help');
		$data['masstxt_upd_mode_re'] = $this->language->get('masstxt_upd_mode_re');
		$data['masstxt_upd_mode_de'] = $this->language->get('masstxt_upd_mode_de');
		$data['masstxt_upd_mode_de_help'] = $this->language->get('masstxt_upd_mode_de_help');
		
		$data['masstxt_mass_update_button'] = $this->language->get('masstxt_mass_update_button');
		$data['masstxt_mass_update_button_help'] = $this->language->get('masstxt_mass_update_button_help');
		$data['masstxt_mass_update_button_top1'] = $this->language->get('masstxt_mass_update_button_top1');
		$data['masstxt_mass_update_button_top2'] = $this->language->get('masstxt_mass_update_button_top2');
		$data['masstxt_mass_update_button_top3'] = $this->language->get('masstxt_mass_update_button_top3');
		
		$this->document->setTitle($data['heading_title']);
		
		$this->load->model('catalog/category');
		
		$this->load->model('catalog/manufacturer');
		
		$this->load->model('localisation/tax_class');
		
		$this->load->model('localisation/stock_status');
		
		$this->load->model('localisation/language');
		
		$this->load->model('catalog/attribute');
		
		$this->load->model('setting/store');
		
		$this->load->model('sale/customer_group');
		
		$data['masstxt_p_filters'] = $this->language->get('masstxt_p_filters');
		$data['masstxt_p_filters_none'] = $this->language->get('masstxt_p_filters_none');
		
		$sql = "SELECT f.filter_id AS `filter_id`, fd.name AS `name`, fgd.name AS `group` FROM " . DB_PREFIX . "filter f 
		LEFT JOIN " . DB_PREFIX . "filter_description fd ON (f.filter_id = fd.filter_id) 
		LEFT JOIN " . DB_PREFIX . "filter_group_description fgd ON (f.filter_group_id = fgd.filter_group_id) 
		LEFT JOIN " . DB_PREFIX . "filter_group fg ON (f.filter_group_id = fg.filter_group_id) 
		WHERE fd.language_id = '" . (int)$this->config->get('config_language_id') . "' 
		AND fgd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		$sql .= " ORDER BY fg.sort_order, fgd.name, f.sort_order, fd.name";
		$query_pf = $this->db->query($sql);
		$data['p_filters'] = $query_pf->rows;

		if (isset($this->request->post['filters_ids'])) {
			$data['filters_ids'] = $this->request->post['filters_ids'];
		} else {
			$data['filters_ids'] = array();
		}
		
		$data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();
		
		$filter_data_getCategories = array('sort' => 'name');
		$data['categories'] = $this->model_catalog_category->getCategories($filter_data_getCategories);
		if (isset($this->request->post['product_category'])) {
			$data['product_category'] = $this->request->post['product_category'];
		} else {
			$data['product_category'] = array();
		}
		
		$data['manufacturers'] = $this->model_catalog_manufacturer->getManufacturers();
		if (isset($this->request->post['manufacturer_ids'])) {
      			$data['manufacturer_ids'] = $this->request->post['manufacturer_ids'];
		} else {
      			$data['manufacturer_ids'] = array();
    		}
		
		$data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();
		
		$data['stock_statuses'] = $this->model_localisation_stock_status->getStockStatuses();
		
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		$data['all_attributes'] = $this->model_catalog_attribute->getAttributes();
		
		$data['stores'] = $this->model_setting_store->getStores();
		
		// all options names + id-s for filter
		$query_all_options = $this->db->query("SELECT od.option_id, od.name FROM " . DB_PREFIX . "option_description od 
		WHERE od.language_id = '" . (int)$this->config->get('config_language_id') . "'
		ORDER BY od.name");
		$data['all_options'] = $query_all_options->rows;
		
		// all options values + id-s for filter
		$query_all_optval = $this->db->query("SELECT ovd.option_value_id, ovd.name AS ov_name, od.name AS o_name 
		FROM " . DB_PREFIX . "option_value_description ovd 
		LEFT JOIN " . DB_PREFIX . "option_description od ON (ovd.option_id = od.option_id) 
		WHERE ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY ovd.option_value_id ORDER BY od.name, ovd.name");
		$data['all_optval'] = $query_all_optval->rows;
		
		////
		
		if (isset($this->request->post['price_mmarese'])) {
      			$data['price_mmarese'] = $this->request->post['price_mmarese'];
		} else {
      			$data['price_mmarese'] = '';
    		}

		if (isset($this->request->post['price_mmicse'])) {
      			$data['price_mmicse'] = $this->request->post['price_mmicse'];
		} else {
      			$data['price_mmicse'] = '';
    		}

		if (isset($this->request->post['d_cust_group_filter'])) {
      			$data['d_cust_group_filter'] = $this->request->post['d_cust_group_filter'];
		} else {
      			$data['d_cust_group_filter'] = 'any';
    		}
		
		if (isset($this->request->post['s_cust_group_filter'])) {
      			$data['s_cust_group_filter'] = $this->request->post['s_cust_group_filter'];
		} else {
      			$data['s_cust_group_filter'] = 'any';
    		}

		if (isset($this->request->post['d_price_mmarese'])) {
      			$data['d_price_mmarese'] = $this->request->post['d_price_mmarese'];
		} else {
      			$data['d_price_mmarese'] = '';
    		}

		if (isset($this->request->post['d_price_mmicse'])) {
      			$data['d_price_mmicse'] = $this->request->post['d_price_mmicse'];
		} else {
      			$data['d_price_mmicse'] = '';
    		}

		if (isset($this->request->post['s_price_mmarese'])) {
      			$data['s_price_mmarese'] = $this->request->post['s_price_mmarese'];
		} else {
      			$data['s_price_mmarese'] = '';
    		}

		if (isset($this->request->post['s_price_mmicse'])) {
      			$data['s_price_mmicse'] = $this->request->post['s_price_mmicse'];
		} else {
      			$data['s_price_mmicse'] = '';
    		}

		if (isset($this->request->post['tax_class_filter'])) {
      			$data['tax_class_filter'] = $this->request->post['tax_class_filter'];
		} else {
      			$data['tax_class_filter'] = 'any';
    		}

		if (isset($this->request->post['stock_mmarese'])) {
      			$data['stock_mmarese'] = $this->request->post['stock_mmarese'];
		} else {
      			$data['stock_mmarese'] = '';
    		}

		if (isset($this->request->post['stock_mmicse'])) {
      			$data['stock_mmicse'] = $this->request->post['stock_mmicse'];
		} else {
      			$data['stock_mmicse'] = '';
    		}

		if (isset($this->request->post['min_q_mmarese'])) {
      			$data['min_q_mmarese'] = $this->request->post['min_q_mmarese'];
		} else {
      			$data['min_q_mmarese'] = '';
    		}

		if (isset($this->request->post['min_q_mmicse'])) {
      			$data['min_q_mmicse'] = $this->request->post['min_q_mmicse'];
		} else {
      			$data['min_q_mmicse'] = '';
    		}

		if (isset($this->request->post['subtract_filter'])) {
      			$data['subtract_filter'] = $this->request->post['subtract_filter'];
		} else {
      			$data['subtract_filter'] = 'any';
    		}

		if (isset($this->request->post['stock_status_filter'])) {
      			$data['stock_status_filter'] = $this->request->post['stock_status_filter'];
		} else {
      			$data['stock_status_filter'] = 'any';
    		}

		if (isset($this->request->post['shipping_filter'])) {
      			$data['shipping_filter'] = $this->request->post['shipping_filter'];
		} else {
      			$data['shipping_filter'] = 'any';
    		}

		if (isset($this->request->post['date_mmarese'])) {
      			$data['date_mmarese'] = $this->request->post['date_mmarese'];
		} else {
      			$data['date_mmarese'] = '';
    		}

		if (isset($this->request->post['date_mmicse'])) {
      			$data['date_mmicse'] = $this->request->post['date_mmicse'];
		} else {
      			$data['date_mmicse'] = '';
    		}

		if (isset($this->request->post['date_added_mmarese'])) {
      			$data['date_added_mmarese'] = $this->request->post['date_added_mmarese'];
		} else {
      			$data['date_added_mmarese'] = '';
    		}

		if (isset($this->request->post['date_added_mmicse'])) {
      			$data['date_added_mmicse'] = $this->request->post['date_added_mmicse'];
		} else {
      			$data['date_added_mmicse'] = '';
    		}
    		
    		if (isset($this->request->post['date_modified_mmarese'])) {
      			$data['date_modified_mmarese'] = $this->request->post['date_modified_mmarese'];
		} else {
      			$data['date_modified_mmarese'] = '';
    		}

		if (isset($this->request->post['date_modified_mmicse'])) {
      			$data['date_modified_mmicse'] = $this->request->post['date_modified_mmicse'];
		} else {
      			$data['date_modified_mmicse'] = '';
    		}


		if (isset($this->request->post['prod_status'])) {
      			$data['prod_status'] = $this->request->post['prod_status'];
		} else {
      			$data['prod_status'] = 'any';
    		}

    		if (isset($this->request->post['store_filter'])) {
      			$data['store_filter'] = $this->request->post['store_filter'];
		} else {
      			$data['store_filter'] = 'any';
    		}

		if (isset($this->request->post['filter_attr'])) {
      			$data['filter_attr'] = $this->request->post['filter_attr'];
		} else {
      			$data['filter_attr'] = 'any';
    		}
    		
    		if (isset($this->request->post['filter_opti'])) {
      			$data['filter_opti'] = $this->request->post['filter_opti'];
		} else {
      			$data['filter_opti'] = 'any';
    		}
    		
    		if (isset($this->request->post['filter_attr_val'])) {
      			$data['filter_attr_val'] = $this->request->post['filter_attr_val'];
		} else {
      			$data['filter_attr_val'] = '';
    		}
    		
    		if (isset($this->request->post['filter_opti_val'])) {
      			$data['filter_opti_val'] = $this->request->post['filter_opti_val'];
		} else {
      			$data['filter_opti_val'] = 'any';
    		}
    		
    		if (isset($this->request->post['filter_name'])) {
      			$data['filter_name'] = $this->request->post['filter_name'];
		} else {
      			$data['filter_name'] = '';
    		}
    		
    		if (isset($this->request->post['filter_namex'])) {
      			$data['filter_namex'] = $this->request->post['filter_namex'];
		} else {
      			$data['filter_namex'] = '';
    		}

    		if (isset($this->request->post['filter_modelx'])) {
      			$data['filter_modelx'] = $this->request->post['filter_modelx'];
		} else {
      			$data['filter_modelx'] = '';
    		}
    		
     		if (isset($this->request->post['product_id_to_attr'])) {
      			$data['product_id_to_attr'] = $this->request->post['product_id_to_attr'];
		} else {
      			$data['product_id_to_attr'] = '';
    		}   		
    		
    		if (isset($this->request->post['filter_model'])) {
      			$data['filter_model'] = $this->request->post['filter_model'];
		} else {
      			$data['filter_model'] = '';
    		}
    		
    		if (isset($this->request->post['filter_tag'])) {
      			$data['filter_tag'] = $this->request->post['filter_tag'];
		} else {
      			$data['filter_tag'] = '';
    		}
    		
    		////
    		
    		if (isset($this->request->post['load_product_attr']) AND isset($this->request->post['product_id_to_attr'])) { // load product attributes
    		
    		$product_attribute_data = array();
		
		$product_attribute_query = $this->db->query("SELECT pa.attribute_id, ad.name FROM " . DB_PREFIX . "product_attribute pa LEFT JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id) LEFT JOIN " . DB_PREFIX . "attribute_description ad ON (a.attribute_id = ad.attribute_id) WHERE pa.product_id = '" . (int)$this->request->post['product_id_to_attr'] . "' AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY pa.attribute_id");
		
		foreach ($product_attribute_query->rows as $product_attribute) {
			$product_attribute_description_data = array();
			
			$product_attribute_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$this->request->post['product_id_to_attr'] . "' AND attribute_id = '" . (int)$product_attribute['attribute_id'] . "'");
			
			foreach ($product_attribute_description_query->rows as $product_attribute_description) {
				$product_attribute_description_data[$product_attribute_description['language_id']] = array('text' => $product_attribute_description['text']);
			}
			
			$product_attribute_data[] = array(
				'attribute_id'                  => $product_attribute['attribute_id'],
				'name'                          => $product_attribute['name'],
				'product_attribute_description' => $product_attribute_description_data
			);
		}
    			$data['product_attributes'] = $product_attribute_data;
    		
    		} elseif (isset($this->request->post['product_attribute'])) {
      			$data['product_attributes'] = $this->request->post['product_attribute'];
		} else {
      			$data['product_attributes'] = array();
    		}
    		
    		
    		if (isset($this->request->post['upd_mode'])) {
      			$data['upd_mode'] = $this->request->post['upd_mode'];
		} else {
      			$data['upd_mode'] = 'ad';
    		}

    		////



if (isset($this->request->post['load_product_attr'])) { /// load product attributes button

$this->session->data['success'] = $this->language->get('masstxt_succes_attributes_loaded');

} /// end load product attributes button

if (isset($this->request->post['mass_update'])) { /// update button

if ($this->user->hasPermission('modify', 'tool/masspattrupd')) { /// modify permision

if (isset($this->request->post['selected'])) { /// avem produse selectate

if ($this->request->post['upd_mode']=='de' OR (isset($this->request->post['product_attribute']) AND ($this->request->post['upd_mode']=='ad' OR $this->request->post['upd_mode']=='re'))) { /// avem attribute update

foreach ($this->request->post['selected'] as $product_id) { /// scanare produse

switch ($this->request->post['upd_mode']) { /// update mode
    case "ad": // keep old attr and add new
		if (!empty($this->request->post['product_attribute'])) {
			foreach ($this->request->post['product_attribute'] as $product_attribute) {
				if ($product_attribute['attribute_id']) {
					$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' AND attribute_id = '" . (int)$product_attribute['attribute_id'] . "'");
					foreach ($product_attribute['product_attribute_description'] as $language_id => $product_attribute_description) {				
						$this->db->query("INSERT INTO " . DB_PREFIX . "product_attribute SET product_id = '" . (int)$product_id . "', attribute_id = '" . (int)$product_attribute['attribute_id'] . "', language_id = '" . (int)$language_id . "', text = '" .  $this->db->escape($product_attribute_description['text']) . "'");
					}
				}
			}
		}
        break;
    
    case "re": // remove old attr and add new
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "'");
		if (!empty($this->request->post['product_attribute'])) {
			foreach ($this->request->post['product_attribute'] as $product_attribute) {
				if ($product_attribute['attribute_id']) {
					$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' AND attribute_id = '" . (int)$product_attribute['attribute_id'] . "'");
					foreach ($product_attribute['product_attribute_description'] as $language_id => $product_attribute_description) {				
						$this->db->query("INSERT INTO " . DB_PREFIX . "product_attribute SET product_id = '" . (int)$product_id . "', attribute_id = '" . (int)$product_attribute['attribute_id'] . "', language_id = '" . (int)$language_id . "', text = '" .  $this->db->escape($product_attribute_description['text']) . "'");
					}
				}
			}
		}
        break;

    case "de": // Just remove old attributes.
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "'");
        break;
	
	} /// end update mode

$this->db->query("UPDATE " . DB_PREFIX . "product p SET date_modified = NOW() WHERE product_id = '" . (int)$product_id . "'");

} /// end scanare produse

$this->cache->delete('product');

$this->session->data['success'] = $this->language->get('masstxt_succes_mass_update');

} else {  /// nu avem update

$this->session->data['error'] = $this->language->get('masstxt_error_nothing_set_for_update');

} /// end avem attribute update

} else {  /// nu avem produse selectate

$this->session->data['error'] = $this->language->get('masstxt_error_no_products_selected');

} /// end avem produse selectate

} else {

$this->session->data['error'] = $this->language->get('masstxt_error_permission');

} /// end modify permision

} /// end update button



$data['arr_lista_prod'] = array();

$prfx="";
$plus_join="";
$plus_where="";

if (isset($this->request->post['lista_prod']) OR isset($this->request->post['mass_update'])) { /// data filters

if (isset($this->request->post['product_category'])) { // categories
$plus_join=" LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id)";
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
	if (in_array(0,$this->request->post['product_category'])) {
	$plus_join.=" LEFT JOIN " . DB_PREFIX . "product_to_category p2c0x ON (p.product_id = p2c0x.product_id)";
	$plus_where=$prfx."(p2c.category_id IN ('" .implode("', '", $this->request->post['product_category']). "') OR p2c0x.category_id IS NULL)";
	} else {
	$plus_where=$prfx."p2c.category_id IN ('" .implode("', '", $this->request->post['product_category']). "')";
	}
}

if (isset($this->request->post['manufacturer_ids'])) { // manufacturers
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.manufacturer_id IN ('" .implode("', '", $this->request->post['manufacturer_ids']). "')";
}

if (isset($this->request->post['filters_ids'])) { // filters
$plus_join.=" LEFT JOIN " . DB_PREFIX . "product_filter prfil ON (p.product_id = prfil.product_id)";
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
	if (in_array(0,$this->request->post['filters_ids'])) {
	$plus_join.=" LEFT JOIN " . DB_PREFIX . "product_filter pf0x ON (p.product_id = pf0x.product_id)";
	$plus_where.=$prfx."(prfil.filter_id IN ('" .implode("', '", $this->request->post['filters_ids']). "') OR pf0x.filter_id IS NULL)";
	} else {
	$plus_where.=$prfx."prfil.filter_id IN ('" .implode("', '", $this->request->post['filters_ids']). "')";
	}
}

if ($this->request->post['price_mmarese']!="") { // price greater than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.price >= '" . (float)$this->request->post['price_mmarese'] . "'";
}

if ($this->request->post['price_mmicse']!="") { // price less than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.price <= '" . (float)$this->request->post['price_mmicse'] . "'";
}

// discount price
if ($this->request->post['d_price_mmarese']!="" OR $this->request->post['d_price_mmicse']!="" OR $this->request->post['d_cust_group_filter']!="any") {
$plus_join.=" LEFT JOIN " . DB_PREFIX . "product_discount pdisc ON (p.product_id = pdisc.product_id)";
}
if ($this->request->post['d_cust_group_filter']!="any") { // cusomer group
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."pdisc.customer_group_id = '" . (int)$this->request->post['d_cust_group_filter'] . "'";
}
if ($this->request->post['d_price_mmarese']!="") { // greater than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."pdisc.price >= '" . (float)$this->request->post['d_price_mmarese'] . "'";
}
if ($this->request->post['d_price_mmicse']!="") { // less than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."pdisc.price <= '" . (float)$this->request->post['d_price_mmicse'] . "'";
}
//

// special price
if ($this->request->post['s_price_mmarese']!="" OR $this->request->post['s_price_mmicse']!="" OR $this->request->post['s_cust_group_filter']!="any") {
$plus_join.=" LEFT JOIN " . DB_PREFIX . "product_special pspec ON (p.product_id = pspec.product_id)";
}
if ($this->request->post['s_cust_group_filter']!="any") { // cusomer group
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."pspec.customer_group_id = '" . (int)$this->request->post['s_cust_group_filter'] . "'";
}
if ($this->request->post['s_price_mmarese']!="") { // greater than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."pspec.price >= '" . (float)$this->request->post['s_price_mmarese'] . "'";
}
if ($this->request->post['s_price_mmicse']!="") { // less than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."pspec.price <= '" . (float)$this->request->post['s_price_mmicse'] . "'";
}
//

if ($this->request->post['tax_class_filter']!="any") { // tax class
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.tax_class_id = '" . (int)$this->request->post['tax_class_filter'] . "'";
}

if ($this->request->post['stock_mmarese']!="") { // stock greater than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.quantity >= '" . (int)$this->request->post['stock_mmarese'] . "'";
}

if ($this->request->post['stock_mmicse']!="") { // stock less than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.quantity <= '" . (int)$this->request->post['stock_mmicse'] . "'";
}

if ($this->request->post['min_q_mmarese']!="") { // Minimum Quantity greater than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.minimum >= '" . (int)$this->request->post['min_q_mmarese'] . "'";
}

if ($this->request->post['min_q_mmicse']!="") { // Minimum Quantity less than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.minimum <= '" . (int)$this->request->post['min_q_mmicse'] . "'";
}

if ($this->request->post['stock_status_filter']!="any") { // Subtract Stock
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.stock_status_id = '" . (int)$this->request->post['stock_status_filter'] . "'";
}

if ($this->request->post['subtract_filter']!="any") { // Out Of Stock Status
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.subtract = '" . (int)$this->request->post['subtract_filter'] . "'";
}

if ($this->request->post['shipping_filter']!="any") { // Requires Shipping
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.shipping = '" . (int)$this->request->post['shipping_filter'] . "'";
}

if ($this->request->post['date_mmarese']!="") { // Date Available greater than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.date_available >= '" . $this->db->escape($this->request->post['date_mmarese']) . "'";
}

if ($this->request->post['date_mmicse']!="") { // Date Available less than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.date_available <= '" . $this->db->escape($this->request->post['date_mmicse']) . "'";
}

if ($this->request->post['date_added_mmarese']!="") { // Date added greater than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.date_added >= '" . $this->db->escape($this->request->post['date_added_mmarese']) . "'";
}

if ($this->request->post['date_added_mmicse']!="") { // Date added less than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.date_added <= '" . $this->db->escape($this->request->post['date_added_mmicse']) . "'";
}

if ($this->request->post['date_modified_mmarese']!="") { // Date modified greater than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.date_modified >= '" . $this->db->escape($this->request->post['date_modified_mmarese']) . "'";
}

if ($this->request->post['date_modified_mmicse']!="") { // Date modified less than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.date_modified <= '" . $this->db->escape($this->request->post['date_modified_mmicse']) . "'";
}


if ($this->request->post['prod_status']!="any") { // status
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.status = '" . (int)$this->request->post['prod_status'] . "'";
}

if ($this->request->post['store_filter']!="any") { // store
$plus_join.=" LEFT JOIN " . DB_PREFIX . "product_to_store pts ON (p.product_id = pts.product_id)";
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."pts.store_id = '" . (int)$this->request->post['store_filter'] . "'";
}

if ($this->request->post['filter_attr']!="any") { // attribute
$plus_join.=" LEFT JOIN " . DB_PREFIX . "product_attribute pattr ON (p.product_id = pattr.product_id)";
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."pattr.attribute_id = '" . (int)$this->request->post['filter_attr'] . "'";
}

if ($this->request->post['filter_opti']!="any") { // option
$plus_join.=" LEFT JOIN " . DB_PREFIX . "product_option po ON (p.product_id = po.product_id)";
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."po.option_id = '" . (int)$this->request->post['filter_opti'] . "'";
}

if ($this->request->post['filter_attr_val']!="") { // attribute value (text)
if ($this->request->post['filter_attr']=="any") { $plus_join.=" LEFT JOIN " . DB_PREFIX . "product_attribute pattr ON (p.product_id = pattr.product_id)"; }
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."pattr.text LIKE '%" . $this->db->escape($this->request->post['filter_attr_val']) . "%'";
}

if ($this->request->post['filter_opti_val']!="any") { // option value
$plus_join.=" LEFT JOIN " . DB_PREFIX . "product_option_value pov ON (p.product_id = pov.product_id)";
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."pov.option_value_id = '" . (int)$this->request->post['filter_opti_val'] . "'";
}

if ($this->request->post['filter_name']!="") { // part of name
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
if(version_compare(VERSION, '1.5.4.1', '>')) {
	$plus_where.=$prfx."pd.name LIKE '%" . $this->db->escape($this->request->post['filter_name']) . "%'";
	} elseif (version_compare(VERSION, '1.5.1.2', '>')) {
	$plus_where.=$prfx."LCASE(pd.name) LIKE '%" . $this->db->escape(utf8_strtolower($this->request->post['filter_name'])) . "%'";
	} else {
	$plus_where.=$prfx."LCASE(pd.name) LIKE '%" . $this->db->escape(strtolower($this->request->post['filter_name'])) . "%'";
	}
}

if ($this->request->post['filter_model']!="") { // part of model
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
if(version_compare(VERSION, '1.5.4.1', '>')) {
	$plus_where.=$prfx."p.model LIKE '%" . $this->db->escape($this->request->post['filter_model']) . "%'";
	} elseif (version_compare(VERSION, '1.5.1.2', '>')) {
	$plus_where.=$prfx."LCASE(p.model) LIKE '%" . $this->db->escape(utf8_strtolower($this->request->post['filter_model'])) . "%'";
	} else {
	$plus_where.=$prfx."LCASE(p.model) LIKE '%" . $this->db->escape(strtolower($this->request->post['filter_model'])) . "%'";
	}
}

if ($this->request->post['filter_tag']!="") { // tag
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
if(version_compare(VERSION, '1.5.3.1', '>')) {
	$plus_where.=$prfx."LCASE(pd.tag) LIKE '%" . $this->db->escape(utf8_strtolower($this->request->post['filter_tag'])) . "%'";
	} else {
	$plus_join.=" LEFT JOIN " . DB_PREFIX . "product_tag ptag ON (p.product_id = ptag.product_id)";	
	$plus_where.=$prfx."LCASE(ptag.tag) LIKE '%" . $this->db->escape(utf8_strtolower($this->request->post['filter_tag'])) . "%'";
	}
}

} /// end data filters


if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

$final_query="SELECT p.product_id, p.model, p.price, p.quantity, p.status, pd.name FROM " . DB_PREFIX . "product p 
LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) 
".$plus_join.$plus_where." 
GROUP BY p.product_id 
ORDER BY pd.name ASC";



if (isset($this->request->post['max_prod_pag'])) {
  	$data['max_prod_pag'] = $this->request->post['max_prod_pag'];
	} else {
  	$data['max_prod_pag'] = 500; // defult max prod per pag
}
if (isset($this->request->post['curent_pag'])) {
  	$data['curent_pag'] = $this->request->post['curent_pag'];
	} else {
  	$data['curent_pag'] = 1;
}

$total_prod_query="SELECT COUNT(DISTINCT p.product_id) AS total FROM " . DB_PREFIX . "product p 
LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) 
".$plus_join.$plus_where;
$query = $this->db->query($total_prod_query);

$data['total_prod_filtered'] = $query->row['total'];

$data['total_pag'] = ceil($data['total_prod_filtered'] / $data['max_prod_pag']);

if ($data['curent_pag']>$data['total_pag']) { $data['curent_pag']=$data['total_pag']; }

if ($data['total_pag']>1) {
	$start_rec=($data['curent_pag']-1)*$data['max_prod_pag'];
	$plus_limit=" LIMIT " . (int)$start_rec . "," . (int)$data['max_prod_pag'];
	$final_query.=$plus_limit;
}


$query = $this->db->query($final_query);

$data['arr_lista_prod'] = $query->rows;

if (isset($this->request->post['lista_prod'])) { /// preview button

$this->session->data['success'] = $this->language->get('masstxt_succes_products_filtered');

} /// end preview button



		$data['token'] = $this->session->data['token']; ////
		
		if (isset($this->session->data['error'])) {
    		$data['error_warning'] = $this->session->data['error'];
    
			unset($this->session->data['error']);
 		} elseif (isset($this->error['warning'])) {
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
		
		$data['action'] = $this->url->link('tool/masspattrupd', 'token=' . $this->session->data['token'], 'SSL');

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('tool/masspattrupd.tpl', $data));
	}



	public function autocompletex() {
		$json = array();

		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_model']) || isset($this->request->get['filter_category_id'])) {
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
				$limit = 20;	
			}			

			$data = array(
				'filter_name'  => $filter_name,
				'filter_model' => $filter_model,
				'start'        => 0,
				'limit'        => $limit
			);

			$results = $this->model_catalog_product->getProducts($data);

			foreach ($results as $result) {
				$option_data = array();

				$product_options = $this->model_catalog_product->getProductOptions($result['product_id']);	

				foreach ($product_options as $product_option) {
					$option_info = $this->model_catalog_option->getOption($product_option['option_id']);

					if ($option_info) {				
						if ($option_info['type'] == 'select' || $option_info['type'] == 'radio' || $option_info['type'] == 'checkbox' || $option_info['type'] == 'image') {
							$option_value_data = array();

							foreach ($product_option['product_option_value'] as $product_option_value) {
								$option_value_info = $this->model_catalog_option->getOptionValue($product_option_value['option_value_id']);

								if ($option_value_info) {
									$option_value_data[] = array(
										'product_option_value_id' => $product_option_value['product_option_value_id'],
										'option_value_id'         => $product_option_value['option_value_id'],
										'name'                    => $option_value_info['name'],
										'price'                   => (float)$product_option_value['price'] ? $this->currency->format($product_option_value['price'], $this->config->get('config_currency')) : false,
										'price_prefix'            => $product_option_value['price_prefix']
									);
								}
							}

							$option_data[] = array(
								'product_option_id' => $product_option['product_option_id'],
								'option_id'         => $product_option['option_id'],
								'name'              => $option_info['name'],
								'type'              => $option_info['type'],
								'option_value'      => $option_value_data,
								'required'          => $product_option['required']
							);	
						} else {
							$option_data[] = array(
								'product_option_id' => $product_option['product_option_id'],
								'option_id'         => $product_option['option_id'],
								'name'              => $option_info['name'],
								'type'              => $option_info['type'],
								'option_value'      => $product_option['option_value'],
								'required'          => $product_option['required']
							);				
						}
					}
				}

				$json[] = array(
					'product_id' => $result['product_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),	
					'model'      => $result['model'],
					'option'     => $option_data,
					'price'      => $result['price']
				);	
			}
		}

		$this->response->setOutput(json_encode($json));
	}




}
?>
