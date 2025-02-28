<?php
class ControllerCommonSeoUrl extends Controller {
	public function index() {
		// Add rewrite to url class
		if ($this->config->get('config_seo_url')) {
			$this->url->addRewrite($this);
		}

		// Decode URL
		if (isset($this->request->get['_route_'])) {
			$parts = explode('/', $this->request->get['_route_']);

			// remove any empty arrays from trailing
			if (utf8_strlen(end($parts)) == 0) {
				array_pop($parts);
			}

			foreach ($parts as $part) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE keyword = '" . $this->db->escape($part) . "'");

				if ($query->num_rows) {
					$url = explode('=', $query->row['query']);

					if ($url[0] == 'product_id') {
						$this->request->get['product_id'] = $url[1];
					}

					if ($url[0] == 'category_id') {
						if (!isset($this->request->get['path'])) {
							$this->request->get['path'] = $url[1];
						} else {
							$this->request->get['path'] .= '_' . $url[1];
						}
					}

					if ($url[0] == 'manufacturer_id') {
						$this->request->get['manufacturer_id'] = $url[1];
					}

					if ($url[0] == 'information_id') {
						$this->request->get['information_id'] = $url[1];
					}

					if ($query->row['query'] && $url[0] != 'information_id' && $url[0] != 'manufacturer_id' && $url[0] != 'category_id' && $url[0] != 'product_id') {
						$this->request->get['route'] = $query->row['query'];
					}
				} else {
					$this->request->get['route'] = 'error/not_found';

					break;
				}
			}

			if (!isset($this->request->get['route'])) {
				if (isset($this->request->get['product_id'])) {
					$this->request->get['route'] = 'product/product';
				} elseif (isset($this->request->get['path'])) {
					$this->request->get['route'] = 'product/category';
				} elseif (isset($this->request->get['manufacturer_id'])) {
					$this->request->get['route'] = 'product/manufacturer/info';
				} elseif (isset($this->request->get['information_id'])) {
					$this->request->get['route'] = 'information/information';
				}
			}

			if (isset($this->request->get['route'])) {
				return new Action($this->request->get['route']);
			}
		}
	}

	public function rewrite($link) {
		$url_info = parse_url(str_replace('&amp;', '&', $link));

		$url = '';

		$data = array();

		parse_str($url_info['query'], $data);

		foreach ($data as $key => $value) {
			if (isset($data['route'])) {



			if (!function_exists('catGetParent')) {
                function catGetParent(&$th, $category_id) {   //can't use anonymous functions while PHP 5.2 is still in the wild :(
                    $q=$th->db->query("SELECT * FROM " . DB_PREFIX . "category
                                            LEFT JOIN ".DB_PREFIX."category_description USING (category_id)
                                            WHERE category_id='".(int)$category_id."' LIMIT 1");
                    return $q->rows[0];
                }
            }

            if (!isset($url_info)) $url_info=$url_data; //1.5.1 compatibility

			if ($data['route'] == 'product/product' && !isset($data['tracking']) && !isset($bens_routed_flag) && isset($data['product_id']) && isset($data['product_id'])) {
				$pid=$data['product_id'];
				$url_format=(int)$this->config->get('config_dedupe_format');

				//find the lowest sort_order # of categories this product is in
				$query = $this->db->query("SELECT *
													FROM " . DB_PREFIX . "product_to_category
													LEFT JOIN " . DB_PREFIX . "category USING (category_id)
													LEFT JOIN ".DB_PREFIX."category_description USING (category_id)
													WHERE product_id = '" . (int)$pid . "'
													ORDER BY " . DB_PREFIX . "category.sort_order ASC
													LIMIT 1");
				$cats=$query->rows;
				if (!empty($cats)) {
					//build a tree from $cats[0] to the top tier (parent_id=0)
					if (!function_exists('catGetParent')) {
						function catGetParent(&$th, $category_id) {   //can't use anonymous functions, PHP 5.2 is still in the wild :(
							$q=$th->db->query("SELECT * FROM " . DB_PREFIX . "category
													LEFT JOIN ".DB_PREFIX."category_description USING (category_id)
													WHERE category_id='".(int)$category_id."' LIMIT 1");
							return $q->rows[0];
						}
					}
					$cur_cat=$cats[0];
					$cat_tree=array($cur_cat);
					while ($cur_cat['parent_id']!=0) {
						$cur_cat=catGetParent($this, $cur_cat['parent_id']);
						$cat_tree[]=$cur_cat;
					}

					//get url_aliases and build a path
					$subdir=str_replace('index.php', '', $url_info['path']);
					$gpath=$subdir;
					$cat_tree=array_reverse($cat_tree);

					foreach ($cat_tree as &$cur_cat) {
						$q=$this->db->query("SELECT * FROM ".DB_PREFIX."url_alias WHERE query='category_id=".$cur_cat['category_id']."'");
						if ($q->num_rows>0) $gpath.='/'.$q->rows[0]['keyword'];

						if ($url_format==1) break;
					}
					unset($cur_cat);

					//get product seo key
					$q=$this->db->query("SELECT * FROM ".DB_PREFIX."url_alias WHERE query='product_id=".$pid."'");
					if ($q->num_rows==0) {
                        //yuck, product has no SEO url, we must return a gross link

                        return $url_info['scheme'] . '://' . $url_info['host'] . (isset($url_info['port']) ? ':' . $url_info['port'] : '') . $subdir . 'index.php?route=product/product&amp;product_id='.$pid;

                    } else {
                        if ($url_format==2) {
                            $gpath=$subdir.'/'.$q->rows[0]['keyword'];
                        } else {
                            $gpath.='/'.$q->rows[0]['keyword'];
                        }

                        $gpath=preg_replace('@/+@', '/', $gpath); //something went wrong; keep from breaking link
                        return $url_info['scheme'] . '://' . $url_info['host'] . (isset($url_info['port']) ? ':' . $url_info['port'] : '') . $gpath;
                    }
				}
			} elseif ($data['route'] == 'product/category' && !isset($data['tracking']) && !isset($bens_routed_flag) && isset($data['path'])) {
			    //*** Route categories
			    $is_non_seo=false;
			    $cid=explode('_',$data['path']);
			    $cid=array_pop($cid);

                $query = $this->db->query("SELECT *
													FROM " . DB_PREFIX . "category
													LEFT JOIN ".DB_PREFIX."category_description USING (category_id)
													WHERE category_id = '" . (int)$cid . "'
													LIMIT 1");
				$cats=$query->rows;
				if (!empty($cats)) {
					//build a tree from $cid to the top tier (parent_id=0)

					$cur_cat=$cats[0];
					$cat_tree=array($cur_cat);
					while ($cur_cat['parent_id']!=0) {
						$cur_cat=catGetParent($this, $cur_cat['parent_id']);
						$cat_tree[]=$cur_cat;
					}

					//get url_aliases and build a path
					$subdir=str_replace('index.php', '', $url_info['path']);
					$gpath=$subdir;
					$cat_tree=array_reverse($cat_tree);

					foreach ($cat_tree as &$cur_cat) {
						$q=$this->db->query("SELECT * FROM ".DB_PREFIX."url_alias WHERE query='category_id=".$cur_cat['category_id']."'");
						if ($q->num_rows==0) { $is_non_seo=true; break; } //every item must have an SEO url
						$gpath.='/'.$q->rows[0]['keyword'];
					}
					unset($cur_cat);

                    $gpath=preg_replace('@/+@', '/', $gpath); //something went wrong; keep from breaking link
                    if (!$is_non_seo) {
                        $params=array(); $pagestr='';
                        if (isset($data['page']) && $data['page']) $params[]='page='.$data['page'];
                        if (isset($data['sort']) && $data['sort']) $params[]='sort='.$data['sort'];
                        if (isset($data['order']) && $data['order']) $params[]='order='.$data['order'];
                        if (isset($data['limit']) && $data['limit']) $params[]='limit='.$data['limit'];
                        if (isset($data['filter']) && $data['filter']) $params[]='filter='.$data['filter'];
                        if (isset($data['bfilter']) && $data['bfilter']) $params[]='bfilter='.$data['bfilter'];
                        if (!empty($params)) $pagestr='?'.implode('&', $params);
                        return $url_info['scheme'] . '://' . $url_info['host'] . (isset($url_info['port']) ? ':' . $url_info['port'] : '') . $gpath . $pagestr;
                    }
                }
			}

			$bens_routed_flag=true; //keep from conflicting with my other products


		
				if (($data['route'] == 'product/product' && $key == 'product_id') || (($data['route'] == 'product/manufacturer/info' || $data['route'] == 'product/product') && $key == 'manufacturer_id') || ($data['route'] == 'information/information' && $key == 'information_id')) {
					$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = '" . $this->db->escape($key . '=' . (int)$value) . "'");

					if ($query->num_rows && $query->row['keyword']) {
						$url .= '/' . $query->row['keyword'];

						unset($data[$key]);
					}
				} elseif ($key == 'path') {
					$categories = explode('_', $value);

					foreach ($categories as $category) {
						$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = 'category_id=" . (int)$category . "'");

						if ($query->num_rows && $query->row['keyword']) {
							$url .= '/' . $query->row['keyword'];
						} else {
							$url = '';

							break;
						}
					}

					unset($data[$key]);
				}
			}
		}

		if ($url) {
			unset($data['route']);

			$query = '';

			if ($data) {
				foreach ($data as $key => $value) {
					$query .= '&' . rawurlencode((string)$key) . '=' . rawurlencode((string)$value);
				}

				if ($query) {
					$query = '?' . str_replace('&', '&amp;', trim($query, '&'));
				}
			}

			return $url_info['scheme'] . '://' . $url_info['host'] . (isset($url_info['port']) ? ':' . $url_info['port'] : '') . str_replace('/index.php', '', $url_info['path']) . $url . $query;
		} else {

			$link=str_replace('index.php?route=common/home', '', $link);
		
			return $link;
		}
	}
}
