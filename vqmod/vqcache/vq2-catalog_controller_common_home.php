<?php
class ControllerCommonHome extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));

			if (!isset($can_url)) {
				$can_url=$this->url->link('common/home');
				$can_url=str_replace('index.php?route=common/home', '', $can_url);
			}
            $cparse_url=parse_url($this->config->get('config_url'));
			$proper_url=str_ireplace(array('http://'.$cparse_url['host'].'/', 'https://'.$cparse_url['host'].'/'), '', $can_url);
			$actual_url=preg_replace('@^/@', '', rawurldecode($_SERVER['REQUEST_URI']));

			//comment this next line out to deduplicate ALL query strings (can break some opencart features)
		    $actual_url=preg_replace('@\?(.*)$@', '', $actual_url);

            //*** redirect default request options, i.e. page=1
            $requests=$_GET;
            unset($requests['_route_']); unset($requests['path']);
            if (!empty($requests)) {
                $do_redir=false;
                foreach ($requests as $key=>$val) {
                    if ($key=='route') {
                        unset($requests[$key]); $do_redir=true;
                    }
                }

                if ($do_redir) {
                    if (substr($can_url,-1)<>'/') $can_url.='/'; //force homepage canonical to end in a slash to prevent duplication
                    $can_url=$can_url . (!empty($requests) ? '?'.http_build_query($requests) : '');
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$can_url);
                    exit;
                }
            }

			//uncomment next line for debugging if you're getting redirect loops
			//exit("<br>Actual url is &quot;$actual_url&quot;, Proper URL is: &quot;$proper_url&quot;");

            $GLOBALS['spc_proper_url']=$proper_url;  //Super Page Cache compatibility

			if ($actual_url!=$proper_url && !isset($GLOBALS['dont_dedupe'])) {
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: ".$can_url);
				exit;
			}


		
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		if (isset($this->request->get['route'])) {
			$this->document->addLink(HTTP_SERVER, 'canonical');
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/home.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/home.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/home.tpl', $data));
		}
	}
}