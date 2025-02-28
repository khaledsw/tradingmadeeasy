<?php
class ControllerModuleWebbySearch extends Controller {

	public function index() {
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');

		$this->load->language('module/webby_search');

		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		$url = '';
		if (isset($this->request->get['search'])) {
			$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['search'])) {
			$search = $this->request->get['search'];
		} else {
			$search = '';
		}

		if (isset($this->request->get['tag'])) {
			$tag = $this->request->get['tag'];
		} elseif (isset($this->request->get['search'])) {
			$tag = $this->request->get['search'];
		} else {
			$tag = '';
		}

		if (isset($this->request->get['description'])) {
			$description = $this->request->get['description'];
		} else {
			$description = '1';
		}

		if (isset($this->request->get['category_id'])) {
			$category_id = $this->request->get['category_id'];
		} else {
			$category_id = 0;
		}

		if (isset($this->request->get['sub_category'])) {
			$sub_category = $this->request->get['sub_category'];
		} else {
			$sub_category = '';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.sort_order';
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

		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = $this->config->get('config_product_limit');
		}

		$data['products'] = array();

		if (isset($this->request->get['search']) || isset($this->request->get['tag'])) {
			$filter_data = array(
				'filter_name'         => $search,
				'filter_tag'          => $tag,
				'filter_description'  => $description,
				'filter_category_id'  => $category_id,
				'filter_sub_category' => $sub_category,
				'sort'                => $sort,
				'order'               => $order,
				'start'               => ($page - 1) * $limit,
				'limit'               => $limit,
			);

			$data['products'] = $this->getProducts($filter_data, $url);

			$data['text']['view_all_result'] = $this->language->get('view_all_result');
			$data['text']['text_tax']        = $this->language->get('text_tax');

			$missing_limit = $limit - count($data['products']);

			if ($missing_limit > 0) {
				$matched_categories = $this->getCategories($search);

				if (isset($matched_categories[0])) {
					foreach ($matched_categories as $category) {
						$filter_data = array(
							'filter_name'         => null,
							'filter_tag'          => null,
							'filter_description'  => null,
							'filter_category_id'  => $category['category_id'],
							'filter_sub_category' => null,
							'sort'                => $sort,
							'order'               => $order,
							'start'               => ($page - 1) * $missing_limit,
							'limit'               => $missing_limit,
						);

						$data['products'] = array_merge($data['products'], $this->getProducts($filter_data, $url, $category['name']));

						$missing_limit = $limit - count($data['products']);

						if ($missing_limit <= 0) {
							break;
						}
					}
				}
			}
		}

		echo json_encode($data);

	}

	private function getProducts($filter_data = array(), $url = '', $category_name = '') {

		$products = array();

		$product_total = $this->model_catalog_product->getTotalProducts($filter_data);

		$results = $this->model_catalog_product->getProducts($filter_data);

		foreach ($results as $result) {
			if ($result['image']) {
				$image = $this->model_tool_image->resize($result['image'], 50, 50);
			} else {
				$image = $this->model_tool_image->resize('placeholder.png', 50, 50);
			}

			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$price = false;
			}

			if ((float) $result['special']) {
				$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$special = false;
			}

			if ($this->config->get('config_tax')) {
				$tax = $this->currency->format((float) $result['special'] ? $result['special'] : $result['price']);
			} else {
				$tax = false;
			}

			if ($this->config->get('config_review_status')) {
				$rating = (int) $result['rating'];
			} else {
				$rating = false;
			}

			if (!empty($category_name)) {
				$result['name'] = $category_name . ' &gt; ' . $result['name'];
			}

			$products[$result['product_id']] = array(
				'product_id'  => $result['product_id'],
				'thumb'       => $image,
				'name'        => $result['name'],
				'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
				'price'       => $price,
				'special'     => $special,
				'tax'         => $tax,
				'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
				'rating'      => $result['rating'],
				'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'] . $url),
			);
		}

		return $products;
	}

	public function getCategories($filter_name = '') {
		$sql = '';
		if (!empty($filter_name)) {
			$sql .= " AND (";

			if (!empty($filter_name)) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $filter_name)));

				foreach ($words as $word) {
					$implode[] = "cd.name LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR cd.description LIKE '%" . $this->db->escape($filter_name) . "%'";
				}
			}

			$sql .= ")";
		}

		$result = $this->db->query("SELECT DISTINCT c.`category_id`,cd.`name` FROM
			" . DB_PREFIX . "category c
			LEFT JOIN " . DB_PREFIX . "category_description cd ON (cd.category_id = c.category_id)
			LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (cd.category_id = c2s.category_id)
		WHERE
			cd.language_id = '" . (int) $this->config->get('config_language_id') . "' AND
			c2s.store_id = '" . (int) $this->config->get('config_store_id') . "'  AND
			c.status = '1'
			" . $sql . "
		ORDER BY
			c.sort_order, LCASE(cd.name)
		LIMIT 20");

		if ($result->num_rows) {
			return $result->rows;
		} else {
			return array();
		}
	}

}
?>