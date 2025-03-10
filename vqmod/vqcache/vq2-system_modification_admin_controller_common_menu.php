<?php
class ControllerCommonMenu extends Controller {
	public function index() {
		
	
    	
	$this->load->language('common/menu');
    	$this->load->language('tool/massptagsupd');
	$begin_code='<li><a class="parent">'.$this->language->get('masstxt_menu1').'</a><ul>';
	$end_code='</ul></li>';
	$middle_code='';
	if (!isset($mass_p_u_menus)) { $mass_p_u_menus=array(); }
	$mass_p_u_menus[1100]='<li><a href="'.$this->url->link('tool/massptagsupd', 'token=' . $this->session->data['token'], 'SSL').'">'.$this->language->get('masstxt_menu_tags').'</a></li>';
	ksort($mass_p_u_menus);
	foreach ($mass_p_u_menus as $mass_p_u_menu) { $middle_code.=$mass_p_u_menu; }
	$data['mass_p_u_code']=$begin_code.$middle_code.$end_code;
	
    	$this->load->language('tool/masspcategupd');
	$begin_code='<li><a class="parent">'.$this->language->get('masstxt_menu1').'</a><ul>';
	$end_code='</ul></li>';
	$middle_code='';
	if (!isset($mass_p_u_menus)) { $mass_p_u_menus=array(); }
	$mass_p_u_menus[1600]='<li><a href="'.$this->url->link('tool/masspcategupd', 'token=' . $this->session->data['token'], 'SSL').'">'.$this->language->get('masstxt_menu_categories').'</a></li>';
	ksort($mass_p_u_menus);
	foreach ($mass_p_u_menus as $mass_p_u_menu) { $middle_code.=$mass_p_u_menu; }
	$data['mass_p_u_code']=$begin_code.$middle_code.$end_code;
	
	$this->load->language('tool/masspattrupd');
	$begin_code='<li><a class="parent">'.$this->language->get('masstxt_menu1').'</a><ul>';
	$end_code='</ul></li>';
	$middle_code='';
	if (!isset($mass_p_u_menus)) { $mass_p_u_menus=array(); }
	$mass_p_u_menus[1800]='<li><a href="'.$this->url->link('tool/masspattrupd', 'token=' . $this->session->data['token'], 'SSL').'">'.$this->language->get('masstxt_menu_attributes').'</a></li>';
	ksort($mass_p_u_menus);
	foreach ($mass_p_u_menus as $mass_p_u_menu) { $middle_code.=$mass_p_u_menu; }
	$data['mass_p_u_code']=$begin_code.$middle_code.$end_code;
	

		$data['text_affiliate'] = $this->language->get('text_affiliate');
		$data['text_api'] = $this->language->get('text_api');
		$data['text_attribute'] = $this->language->get('text_attribute');
		$data['text_attribute_group'] = $this->language->get('text_attribute_group');
		$data['text_backup'] = $this->language->get('text_backup');
		$data['text_banner'] = $this->language->get('text_banner');
		$data['text_catalog'] = $this->language->get('text_catalog');
		$data['text_category'] = $this->language->get('text_category');
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['text_contact'] = $this->language->get('text_contact');
		$data['text_country'] = $this->language->get('text_country');
		$data['text_coupon'] = $this->language->get('text_coupon');
		$data['text_currency'] = $this->language->get('text_currency');
		$data['text_customer'] = $this->language->get('text_customer');
		$data['text_customer_group'] = $this->language->get('text_customer_group');
		$data['text_customer_field'] = $this->language->get('text_customer_field');
		$data['text_customer_ban_ip'] = $this->language->get('text_customer_ban_ip');
		$data['text_custom_field'] = $this->language->get('text_custom_field');
		$data['text_sale'] = $this->language->get('text_sale');
		$data['text_paypal'] = $this->language->get('text_paypal');
		$data['text_paypal_search'] = $this->language->get('text_paypal_search');
		$data['text_design'] = $this->language->get('text_design');
		$data['text_download'] = $this->language->get('text_download');
		$data['text_error_log'] = $this->language->get('text_error_log');
		$data['text_extension'] = $this->language->get('text_extension');
		$data['text_feed'] = $this->language->get('text_feed');
		$data['text_filter'] = $this->language->get('text_filter');
		$data['text_geo_zone'] = $this->language->get('text_geo_zone');
		$data['text_dashboard'] = $this->language->get('text_dashboard');
		$data['text_help'] = $this->language->get('text_help');
		$data['text_information'] = $this->language->get('text_information');
		$data['text_installer'] = $this->language->get('text_installer');
		$data['text_language'] = $this->language->get('text_language');
		$data['text_layout'] = $this->language->get('text_layout');
		$data['text_localisation'] = $this->language->get('text_localisation');
		$data['text_location'] = $this->language->get('text_location');
		$data['text_marketing'] = $this->language->get('text_marketing');
		$data['text_modification'] = $this->language->get('text_modification');
		$data['text_manufacturer'] = $this->language->get('text_manufacturer');
		$data['text_module'] = $this->language->get('text_module');
		$data['text_option'] = $this->language->get('text_option');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_order_status'] = $this->language->get('text_order_status');
		$data['text_opencart'] = $this->language->get('text_opencart');
		$data['text_payment'] = $this->language->get('text_payment');
		$data['text_product'] = $this->language->get('text_product');
		$data['text_reports'] = $this->language->get('text_reports');
		$data['text_report_sale_order'] = $this->language->get('text_report_sale_order');
		$data['text_report_sale_tax'] = $this->language->get('text_report_sale_tax');
		$data['text_report_sale_shipping'] = $this->language->get('text_report_sale_shipping');
		$data['text_report_sale_return'] = $this->language->get('text_report_sale_return');
		$data['text_report_sale_coupon'] = $this->language->get('text_report_sale_coupon');
		$data['text_report_sale_return'] = $this->language->get('text_report_sale_return');
		$data['text_report_product_viewed'] = $this->language->get('text_report_product_viewed');
		$data['text_report_product_purchased'] = $this->language->get('text_report_product_purchased');
		$data['text_report_customer_activity'] = $this->language->get('text_report_customer_activity');
		$data['text_report_customer_online'] = $this->language->get('text_report_customer_online');
		$data['text_report_customer_order'] = $this->language->get('text_report_customer_order');
		$data['text_report_customer_reward'] = $this->language->get('text_report_customer_reward');
		$data['text_report_customer_credit'] = $this->language->get('text_report_customer_credit');
		$data['text_report_customer_order'] = $this->language->get('text_report_customer_order');
		$data['text_report_affiliate'] = $this->language->get('text_report_affiliate');
		$data['text_report_affiliate_activity'] = $this->language->get('text_report_affiliate_activity');
		$data['text_review'] = $this->language->get('text_review');
		$data['text_return'] = $this->language->get('text_return');
		$data['text_return_action'] = $this->language->get('text_return_action');
		$data['text_return_reason'] = $this->language->get('text_return_reason');
		$data['text_return_status'] = $this->language->get('text_return_status');
		$data['text_shipping'] = $this->language->get('text_shipping');
		$data['text_setting'] = $this->language->get('text_setting');
		$data['text_stock_status'] = $this->language->get('text_stock_status');
		$data['text_system'] = $this->language->get('text_system');
		$data['text_tax'] = $this->language->get('text_tax');
		$data['text_tax_class'] = $this->language->get('text_tax_class');
		$data['text_tax_rate'] = $this->language->get('text_tax_rate');
		$data['text_tools'] = $this->language->get('text_tools');
		$data['text_total'] = $this->language->get('text_total');
		$data['text_upload'] = $this->language->get('text_upload');
		$data['text_tracking'] = $this->language->get('text_tracking');
		$data['text_user'] = $this->language->get('text_user');
		$data['text_user_group'] = $this->language->get('text_user_group');
		$data['text_users'] = $this->language->get('text_users');
		$data['text_voucher'] = $this->language->get('text_voucher');
		$data['text_voucher_theme'] = $this->language->get('text_voucher_theme');
		$data['text_weight_class'] = $this->language->get('text_weight_class');
		$data['text_length_class'] = $this->language->get('text_length_class');
		$data['text_zone'] = $this->language->get('text_zone');
		$data['text_recurring'] = $this->language->get('text_recurring');
		$data['text_order_recurring'] = $this->language->get('text_order_recurring');
		$data['text_openbay_extension'] = $this->language->get('text_openbay_extension');
		$data['text_openbay_dashboard'] = $this->language->get('text_openbay_dashboard');
		$data['text_openbay_orders'] = $this->language->get('text_openbay_orders');
		$data['text_openbay_items'] = $this->language->get('text_openbay_items');
		$data['text_openbay_ebay'] = $this->language->get('text_openbay_ebay');
		$data['text_openbay_etsy'] = $this->language->get('text_openbay_etsy');
		$data['text_openbay_amazon'] = $this->language->get('text_openbay_amazon');
		$data['text_openbay_amazonus'] = $this->language->get('text_openbay_amazonus');
		$data['text_openbay_settings'] = $this->language->get('text_openbay_settings');
		$data['text_openbay_links'] = $this->language->get('text_openbay_links');
		$data['text_openbay_report_price'] = $this->language->get('text_openbay_report_price');
		$data['text_openbay_order_import'] = $this->language->get('text_openbay_order_import');



								$result = $this->db->query("SELECT * FROM `" . DB_PREFIX . "extension` WHERE `code` = 'addLinksToAdminMenu'");
								if($result->num_rows) {

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

									$result3 = $this->db->query("SELECT * FROM " . DB_PREFIX . "imiw_categories ");

								    $data['category_array'] = $result3->rows;

								    $result2 = $this->db->query("SELECT " . DB_PREFIX . "imiw_links.*, " . DB_PREFIX . "imiw_categories.category_title as category_title FROM " . DB_PREFIX . "imiw_links left join " . DB_PREFIX . "imiw_categories on " . DB_PREFIX . "imiw_links.category_id = " . DB_PREFIX . "imiw_categories.id ");

								    $data['link_array'] = $result2->rows;

								    $this->load->language('module/addLinksToAdminMenu');
									$data['menu_title'] = $this->language->get('menu_title');

								}	
												

						
		$data['home'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL');
		$data['abandoned_cart_reminder'] = $this->url->link('module/abandoned_cart_reminder', 'token=' . $this->session->data['token'], 'SSL');
		$data['affiliate'] = $this->url->link('marketing/affiliate', 'token=' . $this->session->data['token'], 'SSL');
		$data['api'] = $this->url->link('user/api', 'token=' . $this->session->data['token'], 'SSL');
		$data['attribute'] = $this->url->link('catalog/attribute', 'token=' . $this->session->data['token'], 'SSL');
		$data['attribute_group'] = $this->url->link('catalog/attribute_group', 'token=' . $this->session->data['token'], 'SSL');
		$data['backup'] = $this->url->link('tool/backup', 'token=' . $this->session->data['token'], 'SSL');
		$data['banner'] = $this->url->link('design/banner', 'token=' . $this->session->data['token'], 'SSL');
		$data['category'] = $this->url->link('catalog/category', 'token=' . $this->session->data['token'], 'SSL');
		$data['country'] = $this->url->link('localisation/country', 'token=' . $this->session->data['token'], 'SSL');
		$data['contact'] = $this->url->link('marketing/contact', 'token=' . $this->session->data['token'], 'SSL');
		$data['coupon'] = $this->url->link('marketing/coupon', 'token=' . $this->session->data['token'], 'SSL');
		$data['currency'] = $this->url->link('localisation/currency', 'token=' . $this->session->data['token'], 'SSL');
		$data['customer'] = $this->url->link('sale/customer', 'token=' . $this->session->data['token'], 'SSL');
		$data['customer_fields'] = $this->url->link('sale/customer_field', 'token=' . $this->session->data['token'], 'SSL');
		$data['customer_group'] = $this->url->link('sale/customer_group', 'token=' . $this->session->data['token'], 'SSL');
		$data['customer_ban_ip'] = $this->url->link('sale/customer_ban_ip', 'token=' . $this->session->data['token'], 'SSL');
		$data['custom_field'] = $this->url->link('sale/custom_field', 'token=' . $this->session->data['token'], 'SSL');
		$data['download'] = $this->url->link('catalog/download', 'token=' . $this->session->data['token'], 'SSL');
		$data['error_log'] = $this->url->link('tool/error_log', 'token=' . $this->session->data['token'], 'SSL');
		$data['feed'] = $this->url->link('extension/feed', 'token=' . $this->session->data['token'], 'SSL');
		$data['filter'] = $this->url->link('catalog/filter', 'token=' . $this->session->data['token'], 'SSL');
		$data['geo_zone'] = $this->url->link('localisation/geo_zone', 'token=' . $this->session->data['token'], 'SSL');
		$data['information'] = $this->url->link('catalog/information', 'token=' . $this->session->data['token'], 'SSL');
		$data['installer'] = $this->url->link('extension/installer', 'token=' . $this->session->data['token'], 'SSL');
		$data['language'] = $this->url->link('localisation/language', 'token=' . $this->session->data['token'], 'SSL');
		$data['layout'] = $this->url->link('design/layout', 'token=' . $this->session->data['token'], 'SSL');
		$data['location'] = $this->url->link('localisation/location', 'token=' . $this->session->data['token'], 'SSL');
		$data['modification'] = $this->url->link('extension/modification', 'token=' . $this->session->data['token'], 'SSL');
		$data['manufacturer'] = $this->url->link('catalog/manufacturer', 'token=' . $this->session->data['token'], 'SSL');
		$data['marketing'] = $this->url->link('marketing/marketing', 'token=' . $this->session->data['token'], 'SSL');
		$data['module'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		$data['option'] = $this->url->link('catalog/option', 'token=' . $this->session->data['token'], 'SSL');
		$data['order'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'], 'SSL');
		$data['order_status'] = $this->url->link('localisation/order_status', 'token=' . $this->session->data['token'], 'SSL');
		$data['payment'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
		$data['paypal_search'] = $this->url->link('payment/pp_express/search', 'token=' . $this->session->data['token'], 'SSL');
		$data['product'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_sale_order'] = $this->url->link('report/sale_order', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_sale_tax'] = $this->url->link('report/sale_tax', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_sale_shipping'] = $this->url->link('report/sale_shipping', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_sale_return'] = $this->url->link('report/sale_return', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_sale_coupon'] = $this->url->link('report/sale_coupon', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_product_viewed'] = $this->url->link('report/product_viewed', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_product_purchased'] = $this->url->link('report/product_purchased', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_customer_activity'] = $this->url->link('report/customer_activity', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_customer_online'] = $this->url->link('report/customer_online', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_customer_order'] = $this->url->link('report/customer_order', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_customer_reward'] = $this->url->link('report/customer_reward', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_customer_credit'] = $this->url->link('report/customer_credit', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_marketing'] = $this->url->link('report/marketing', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_affiliate'] = $this->url->link('report/affiliate', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_affiliate_activity'] = $this->url->link('report/affiliate_activity', 'token=' . $this->session->data['token'], 'SSL');
		$data['review'] = $this->url->link('catalog/review', 'token=' . $this->session->data['token'], 'SSL');
		$data['return'] = $this->url->link('sale/return', 'token=' . $this->session->data['token'], 'SSL');
		$data['return_action'] = $this->url->link('localisation/return_action', 'token=' . $this->session->data['token'], 'SSL');
		$data['return_reason'] = $this->url->link('localisation/return_reason', 'token=' . $this->session->data['token'], 'SSL');
		$data['return_status'] = $this->url->link('localisation/return_status', 'token=' . $this->session->data['token'], 'SSL');
		$data['shipping'] = $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL');
		$data['setting'] = $this->url->link('setting/store', 'token=' . $this->session->data['token'], 'SSL');
		$data['stock_status'] = $this->url->link('localisation/stock_status', 'token=' . $this->session->data['token'], 'SSL');
		$data['tax_class'] = $this->url->link('localisation/tax_class', 'token=' . $this->session->data['token'], 'SSL');
		$data['tax_rate'] = $this->url->link('localisation/tax_rate', 'token=' . $this->session->data['token'], 'SSL');
		$data['total'] = $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL');
		$data['upload'] = $this->url->link('tool/upload', 'token=' . $this->session->data['token'], 'SSL');
		$data['user'] = $this->url->link('user/user', 'token=' . $this->session->data['token'], 'SSL');
		$data['user_group'] = $this->url->link('user/user_permission', 'token=' . $this->session->data['token'], 'SSL');
		$data['voucher'] = $this->url->link('sale/voucher', 'token=' . $this->session->data['token'], 'SSL');
		$data['voucher_theme'] = $this->url->link('sale/voucher_theme', 'token=' . $this->session->data['token'], 'SSL');
		$data['weight_class'] = $this->url->link('localisation/weight_class', 'token=' . $this->session->data['token'], 'SSL');
		$data['length_class'] = $this->url->link('localisation/length_class', 'token=' . $this->session->data['token'], 'SSL');
		$data['zone'] = $this->url->link('localisation/zone', 'token=' . $this->session->data['token'], 'SSL');
		$data['recurring'] = $this->url->link('catalog/recurring', 'token=' . $this->session->data['token'], 'SSL');
		$data['order_recurring'] = $this->url->link('sale/recurring', 'token=' . $this->session->data['token'], 'SSL');

		$data['openbay_show_menu'] = $this->config->get('openbaypro_menu');
		$data['openbay_link_extension'] = $this->url->link('extension/openbay', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_orders'] = $this->url->link('extension/openbay/orderlist', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_items'] = $this->url->link('extension/openbay/items', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_ebay'] = $this->url->link('openbay/ebay', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_ebay_settings'] = $this->url->link('openbay/ebay/settings', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_ebay_links'] = $this->url->link('openbay/ebay/viewitemlinks', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_etsy'] = $this->url->link('openbay/etsy', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_etsy_settings'] = $this->url->link('openbay/etsy/settings', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_etsy_links'] = $this->url->link('openbay/etsy_product/links', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_ebay_orderimport'] = $this->url->link('openbay/ebay/vieworderimport', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_amazon'] = $this->url->link('openbay/amazon', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_amazon_settings'] = $this->url->link('openbay/amazon/settings', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_amazon_links'] = $this->url->link('openbay/amazon/itemlinks', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_amazonus'] = $this->url->link('openbay/amazonus', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_amazonus_settings'] = $this->url->link('openbay/amazonus/settings', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_amazonus_links'] = $this->url->link('openbay/amazonus/itemlinks', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_markets'] = array(
			'ebay' => $this->config->get('ebay_status'),
			'amazon' => $this->config->get('openbay_amazon_status'),
			'amazonus' => $this->config->get('openbay_amazonus_status'),
			'etsy' => $this->config->get('etsy_status'),
		);

		return $this->load->view('common/menu.tpl', $data);
	}
}