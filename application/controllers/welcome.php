<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('general');
	}

	function index() {
		if($this->session->userdata('login') == TRUE) redirect(base_url('home'));
		$this->set_page('auth/login');		
	}

	function home() {
		if($this->session->userdata('login') == TRUE) {
			$data['deadline']	= $this->manifest_model->deadline_data(7);
			$data['manifest']	= $this->manifest_model->get_filtering_data(null,null,array('D.status' => 'Unverified'),'D.file_id');
			$this->set_layout('content/home',$data);
		} else {
			$this->set_page('auth/login');
		}
	}
	
	function access_logs(){
		$this->db->where('url !=','access_logs');
		$this->db->where('url !=','');
		$this->db->where('user_id !=','');
		$this->db->where('user_id !=','0');
		$this->db->order_by('date','desc');
		$logs = $this->db->get('all_activity_log');
		$this->set_layout('report/access_logs',array('access_logs' => $logs->result()));
	}

	function login(){
		if($this->session->userdata('login') == TRUE) redirect(base_url('home'));

		if(count($_POST) > 0) {
			$username = $_POST['username'];
			$password = md5($_POST['password']);

			$user = $this->system->check_login($username,$password);
			if($user) {
				$this->system->set_session_login($user);
				$this->system->set_activity('User Signin');
				$status = 0;
			} else {
				$status = 1;
			}
			echo json_encode(array('status' => $status, 'redirect' => site_url('home')));
		} else {
			redirect('home');
		}
	}

	function logout() {
		$this->system->set_activity('User SignOut');
		$this->system->remove_session_login();
		redirect('');
	}
}

?>