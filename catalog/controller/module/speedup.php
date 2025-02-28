<?php
class ControllerModuleSpeedup extends Controller {
	public function index() {
 		$data['speedup_status'] = $this->config->get('speedup_status');
		$data['speedup_imglazyload_status'] = $this->config->get('speedup_imglazyload_status');
 		
		if($data['speedup_status'] == 1 && $data['speedup_imglazyload_status'] == 1) { 
 
 			$data['speedup_imglazyload_placeholder'] = $this->config->get('speedup_imglazyload_placeholder');
   			if (is_file(DIR_IMAGE . $data['speedup_imglazyload_placeholder'] )) {
				$data['imglazyload_placeholder_thmb'] = HTTP_SERVER . '/image/' . $data['speedup_imglazyload_placeholder'];
			} else {
				$data['imglazyload_placeholder_thmb'] = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC';
			}
			$data['speedup_imglazyload_delaytime'] = $this->config->get('speedup_imglazyload_delaytime');
 			
			$this->document->addScript('catalog/view/javascript/speedup/jquery.lazyload.js');			
 		 
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/speedup.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/speedup.tpl', $data);
			} else {
				return $this->load->view('default/template/module/speedup.tpl', $data);
			}
		}
	} 	
}