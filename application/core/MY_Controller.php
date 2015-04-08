<?php

class MY_Controller extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->system->set_all_activity_log();
	}
	
	function set_page($page = null, $data = null) {
		$this->load->view('content/header');
		if($page != null) $this->load->view($page,$data);
		$this->load->view('content/footer');
	}

	function set_layout($page = null, $data = null) {
		$this->load->view('content/header',$data);
		$this->load->view('content/navigation-menu',$data);
		if($page != null) $this->load->view($page,$data); else $this->load->view('content/blank'); 
		$this->load->view('content/footer');
	}

	function set_modal($page = null,$data = null) {
		$this->load->view('content/header');
		if($page != null) $this->load->view($page,$data); else $this->load->view('content/blank'); 
		$this->load->view('content/footer');		
	}
}

?>