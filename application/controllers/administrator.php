<?php

class Administrator extends MY_Controller {
	
	
	function __construct(){
		parent::__construct();
        $this->load->model('administrator_model');
	}

	function index() {
		$this->set_layout();
	}

	function manage_user() {
		$data = array('list_user' => $this->user_model->get_list(),'title' => 'Manage User');
		$this->set_layout('administrator/manage_user',$data);
	}

	function manage_kurs() {
		$data = array('kurs' => $this->tools->get_kurs(),'title' => 'Manage Kurs');
		$this->set_layout('administrator/manage_kurs',$data);
	}

    function manage_partner(){

        $data['get_partner'] = $this->administrator_model->get_partner();
        $data['title'] = 'Manage Partner';
       	$this->set_layout('administrator/manage_partner',$data);

    }

    function setting() {
    	$this->set_layout('administrator/setting',array('title' => 'Setting'));
    }



    function ajax_partner($method = null) {
	  	switch ($method) {


         case 'add_partner':
            	$error = ''; $message = '';
                $this->administrator_model->add_partner();
			   	echo json_encode(array('error'=>$error,'message'=>$message));
		 break;

         case 'edit_partner':
            	$error = ''; $message = '';
                $partner_id = $_POST['partner_id'];
                $this->administrator_model->edit_partner($partner_id);
			   	echo json_encode(array('error'=>$error,'message'=>$message));
		 break;

          case 'remove_partner':
            	$error = ''; $message = '';
                $partner_id = $_POST['partner_id'];
                $this->administrator_model->remove_partner($partner_id);
			   	echo json_encode(array('error'=>$error,'message'=>$message));
		 break;


        }
    }

	function ajax($method = null) {
		switch ($method) {
        	case 'add_user':
				$error = ''; $message = '';

				$this->form_validation->set_error_delimiters('<div>', '</div>');
				$this->form_validation->set_rules('username', 'Username', 'required|trim|alpha|min_length[5]|max_length[12]');
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[12]');
				$this->form_validation->set_rules('email', 'email', 'required');
				if($this->form_validation->run() == TRUE) {
					if($this->user_model->check_username(set_value('username'))) {
						$this->user_model->create_user(set_value('username'),set_value('email'),md5(set_value('password')));
						$message = 'User has been created.';
					} else {
						$error = 'error';
						$message = 'Username has been used!';
					}
				} else {
					$error = 'error';
					$message = htmlspecialchars_decode(validation_errors());
				}
				echo json_encode(array('error'=>$error,'message'=>$message));
				break;

				case 'edit_user':
						$error = ''; $message = '';

						$this->form_validation->set_rules('username', 'Username', 'trim|alpha|min_length[5]|max_length[12]');
						$this->form_validation->set_rules('email', 'Email', 'required');
					//	$this->form_validation->set_rules('password', 'Password', 'min_length[8]|max_length[12]');

						if($this->form_validation->run() == TRUE) {
						$user_id = $this->input->post('user_id');
						$data['username'] = $this->input->post('username');
						$data['password'] = md5($this->input->post('password'));
						$data['email']	  = $this->input->post('email');
						$data['type']	  = $this->input->post('type');
						$this->user_model->edit_user($user_id,$data);
						$message = 'Edit User successful.';
						}else {

						$error = 'error';
						$message = htmlspecialchars_decode(validation_errors());
						}
						echo json_encode(array('error'=>$error,'message'=>$message));
				break;

			case 'delete_user':
				$error = ''; $message = '';
				$user_id = $_POST['user_id'];
				if($this->user_model->get_by_id($user_id) != FALSE) {
					$this->user_model->delete_user($user_id);
					$message = 'User has been deleted';
				} else {
					$error = 'error';
					$message = 'Failed to delete!';
				}
				echo json_encode(array('error'=>$error,'message'=>$message));
				break;

        	case 'set_nt_kurs':
				$this->tools->set_nt_kurs($_POST['value']);
				echo 'OK';
				break;
        	case 'set_usd_kurs':
				$this->tools->set_usd_kurs($_POST['value']);
				echo 'OK';
				break;
        	case 'set_deadline_days':
				$this->tools->set_deadline_days($_POST['value']);
				echo 'OK';
				break;

			default:
				exit;
				break;
		}
	}
}


?>