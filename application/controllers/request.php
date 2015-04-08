<?php

class Request extends MY_Controller {
	
	function __cosntruct() {
		parent::__construct();
	}

	function index() {
		$this->set_layout();
	}

	function discount($method = null){
		switch ($method) {
			case 'select':
				$data = array();
				$this->set_layout('request/discount_select',$data);
				break;

			case 'add':
				$data_id = $_GET['data_id'];
				$data['data'] = $this->manifest_model->get_by_data_id($data_id);
				$this->set_layout('request/discount_add',$data);
				break;
			
			default:
				$data['list_dicount'] = ($this->session->userdata('user_type') == 'Admin') ? $this->discount->get_list(null,array('Approved','Rejected','Cancelled')) : $this->discount->get_list($this->session->userdata('user_id'),array('Approved','Rejected','Waiting Approval','Cancelled'));
				$data['list_dicount_request'] = $this->discount->get_list(null,array('Waiting Approval'));
				$data['title'] = 'Request Discount';
				$this->set_layout('request/discount',$data);
				break;
		}
	}
	

}

?>