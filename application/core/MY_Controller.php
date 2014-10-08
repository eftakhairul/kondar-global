<?php
class MY_Controller extends CI_Controller {
	protected $_configs;
	public function __construct(){
		parent::__construct();
		$this->_configs = array();
		$this->_configs['template'] = 'master/';
		$this->_configs['title'] = 'Welcome to KGT';
	}
	function check_lang(){
		$lang = $this->session->all_userdata();
		if(isset($lang['lang'])){
			if($lang['lang']=='english'){
				$this->lang->load("common","english");		
				$this->lang->load("user","english");		 
			}
			else if($lang['lang']=='russian'){
				$this->lang->load("common","russian");		
				$this->lang->load("user","russian");		 
			}
		}
		else{
			$this->lang->load("common","english");		
			$this->lang->load("user","english");		 
		}
	}
	protected function _header($css_e)
	{
		$header_data['title'] = $this->_configs['title'];
		$header_data['template'] = $this->_configs['template'];
		
		$header_data['css_src'] = array();
		foreach ($css_e as $css)
			$header_data['css_src'][] = $css;


		$this->load->view($this->_configs['template'].'include/header', $header_data);
		
	}
	protected function _content($viewName,$data)
	{
        $this->load->view($this->_configs['template'].$viewName, $data);
	}
	protected function _footer($js_e,$js_f)
	{
		$footer_data['js_element'] = array();
		$footer_data['js_functions'] = array();
		foreach ($js_e as $js)
			$footer_data['js_element'][] = $js;
		foreach ($js_f as $fn)
    		$footer_data['js_functions'][] = $fn;
        $this->load->view($this->_configs['template'].'include/footer', $footer_data);
	}
}