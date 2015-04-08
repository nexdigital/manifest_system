<?php

Class Customers extends MY_Controller {

	function __construct() {
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation','email'));
	}

	function index(){
		if($this->session->userdata('login') != TRUE) redirect(base_url());

		$dataResult = $this->customers_model->get_data();
		$data['dataResult'] = $dataResult;
		$data['title'] = 'Customer Data';
		$this->set_layout('customers/data',$data);
	}
	
	
	
	function register() {
		if($this->session->userdata('login') != TRUE) redirect(base_url());
		$refcust = $this->customers_model->customer_new_id();
		$array['refcust'] = $refcust;
		$array['title'] = 'Add Customer';
		$this->set_layout('customers/customer_input',$array);
	}

	function edit($cust_id = null)
	{

		if($this->input->post('edit')){
					$data['name'] = $this->input->post('name');
					$data['address'] = $this->input->post('address');
					$data['sort_name'] = $this->input->post('attn');
					$data['email'] = $this->input->post('email');
					$data['city'] = $this->input->post('city');
					$data['country'] = $this->input->post('country');
					$data['state'] = $this->input->post('state');
					$data['post_code'] = $this->input->post('post_code');


					$data['phone'] = $this->input->post('phone');
					$data['mobile'] = $this->input->post('mobile');
					$data['fax'] = $this->input->post('fax');

					$data['tax_class'] = $this->input->post('tax_class');
					$data['bank_branch'] = $this->input->post('bank_branch');
					$data['bank_code'] = $this->input->post('bank_code');
					$data['bank_account'] = $this->input->post('bank_account');

					$data['vat_doc'] = $this->input->post('vat_doc');
					$data['type'] = $this->input->post('type');
					$data['register_doc'] = $this->input->post('register_doc');
					$data['register_date'] = $this->input->post('register_date');
					$data['due_date_payment'] = $this->input->post('due_date_payment');

					$data['price_index'] = $this->input->post('price_index');
					$data['payment_type'] = $this->input->post('payment_type');
					$data['payment_terms'] = $this->input->post('payment_terms');
					$data['discount'] = $this->input->post('discount');

					$data['credit_limit'] = $this->input->post('credit_limit');
					$data['remark'] = $this->input->post('remark');
					$data['status'] = $this->input->post('status');

					$this->customers_model->customer_edit($cust_id,$data);
                    redirect ('customers');
		}




			$getUser 			= $this->customers_model->getuser($cust_id);
			$array['getUser'] 	= $getUser;
			$this->set_layout('customers/customer_editform',$array);
	}

	function customer_delete($cust_id = null){
          //  $reference_id = $this->uri->segment(3);
			$this->customers_model->customer_delete($cust_id);
			redirect ('customers');
	}

	function customer_view()
	{
		if($this->session->userdata('login') != TRUE) redirect(base_url());
		$this->set_layout('customers/customer_view');


	}

	function detail(){
        $reference_id = $this->uri->segment(3);
		if($this->input->post('subRegular')){
			$data['status'] 			= "regular";
            //$this->customers_model->customer_edit($cust_id,$data);
			$this->customers_model->customer_edit($reference_id,$data);
		}elseif($this->input->post('unRegular')){
			$data['status'] 			= "";
			$this->customers_model->customer_edit($reference_id,$data);
		}



		$data['customer_data']			= $this->customers_model->getuser($reference_id);
		$data['customer_paid']			= $this->customers_model->get_status_paid($reference_id);
        $data['customer_Unpaid']		= $this->customers_model->get_status_Unpaid($reference_id);
		$this->set_layout('customers/customer_view',$data);
	}

	function ajax($method = null) {

		switch ($method) {
			case 'register':
				$data['reference_id'] = $this->input->post('reference_id');
				$data['name'] = $this->input->post('name');
				$data['address'] = $this->input->post('cust_address');
				$data['sort_name'] = $this->input->post('attn');
				$data['email'] = $this->input->post('email');
				$data['city'] = $this->input->post('city');
				$data['country'] = $this->input->post('country');
				$data['state'] = $this->input->post('state');
				$data['post_code'] = $this->input->post('post_code');


				$data['phone'] = $this->input->post('phone');
				$data['mobile'] = $this->input->post('mobile');
				$data['fax'] = $this->input->post('fax');

				$data['tax_class'] = $this->input->post('tax_class');
				$data['bank_branch'] = $this->input->post('bank_branch');
				$data['bank_code'] = $this->input->post('bank_code');
				$data['bank_account'] = $this->input->post('bank_account');

				$data['vat_doc'] = $this->input->post('vat_doc');
				$data['type'] = $this->input->post('type');
				$data['register_doc'] = $this->input->post('register_doc');
				$data['register_date'] = $this->input->post('register_date');
				$data['due_date_payment'] = $this->input->post('due_date_payment');

				$data['price_index'] = $this->input->post('price_index');
				$data['payment_type'] = $this->input->post('payment_type');
				$data['payment_terms'] = $this->input->post('payment_terms');
				$data['discount'] = $this->input->post('discount');

				$data['credit_limit'] = $this->input->post('credit_limit');
				$data['remark'] = $this->input->post('remark');
				$data['available'] = $this->input->post('active_status');
				$data['status'] = $this->input->post('status');

				$this->customers_model->save_customer($data);
				echo json_encode(array('status' => true));
				break;

            case 'edit_customer':

                $cust_id = $this->input->post('cust_id');
                $reference_id = $this->input->post('reference_id');
				$data['reference_id'] = $reference_id;
				$data['name'] = $this->input->post('name');
				$data['address'] = $this->input->post('cust_address');
				$data['sort_name'] = $this->input->post('attn');
				$data['email'] = $this->input->post('email');
				$data['city'] = $this->input->post('city');
				$data['country'] = $this->input->post('country');
				$data['state'] = $this->input->post('state');
				$data['post_code'] = $this->input->post('post_code');


				$data['phone'] = $this->input->post('phone');
				$data['mobile'] = $this->input->post('mobile');
				$data['fax'] = $this->input->post('fax');

				$data['tax_class'] = $this->input->post('tax_class');
				$data['bank_branch'] = $this->input->post('bank_branch');
				$data['bank_code'] = $this->input->post('bank_code');
				$data['bank_account'] = $this->input->post('bank_account');

				$data['vat_doc'] = $this->input->post('vat_doc');
				$data['type'] = $this->input->post('type');
				$data['register_doc'] = $this->input->post('register_doc');
				$data['register_date'] = $this->input->post('register_date');
				$data['due_date_payment'] = $this->input->post('due_date_payment');

				$data['price_index'] = $this->input->post('price_index');
				$data['payment_type'] = $this->input->post('payment_type');
				$data['payment_terms'] = $this->input->post('payment_terms');
				$data['discount'] = $this->input->post('discount');

				$data['credit_limit'] = $this->input->post('credit_limit');
				$data['remark'] = $this->input->post('remark');
				$data['available'] = $this->input->post('active_status');
				$data['status'] = $this->input->post('status');

			   	$this->customers_model->customer_edit($reference_id,$data);
				echo json_encode(array('status' => true));
				break;

			case 'get':
				$limit 	= (isset($_POST['totalrows'])) ? $_POST['totalrows'] : 100;
				$page 	= (isset($_POST['page'])) ? $_POST['page'] : 1;
				$start 	= ($page - 1) * $limit;
				$data 	= $this->customers_model->get_list();
				echo json_encode($data);
				break;

			case 'get_new_cust_id':
				echo $this->customers_model->customer_new_id();
				break;

			case 'get_customer':
				$cust_id = $_POST['cust_id'];
				$data = $this->customers_model->get_by_id($cust_id);
				echo json_encode($data);
				break;
			case 'add_customer':
				#Set Customer To Data
				$data_id = $_POST['data_id'];
				$type 	= $_POST['data_type'];

				$data['reference_id'] 	= $_POST['cust_id'];
				$data['name'] 			= $_POST['cust_name'];
				$data['address'] 		= $_POST['cust_address'];
				$data['sort_name'] 		= $_POST['attn'];
				$data['state'] 			= $_POST['cust_state'];
				$data['city'] 			= $_POST['cust_city'];
				$data['country'] 		= $_POST['cust_country'];
				$data['email'] 			= $_POST['cust_email'];
				$data['phone'] 			= $_POST['cust_phone'];
				$data['tax_class'] 		= $_POST['tax_class'];
				$data['type'] 			= $type;
				$data['created_date']	= date('Y-m-d h:i:s');
				$data['user_id']		= $this->session->userdata('user_id');
				$this->customers_model->save_customer($data);

				$return_data = '
				<strong>'.$data['name'].'</strong><br/>
				'.$data['address'].'<br/>
				'.$data['country'].'<br/>
				';

				$this->manifest_model->set_data_customer($data['reference_id'],$data_id,$type);
				if($type == 'consignee') {
					$this->manifest_model->set_payment_data($data_id,$data['reference_id']);
				}

				$check_valid_status = $this->manifest_model->check_valid_status($data_id);
                switch ($check_valid_status) {
                    case '0': $status_class = ''; break;
                    case '1': $status_class = 'warning'; break;
                    case '2': $status_class = 'success'; break;
                    default: $status_class = ''; break;
                }

				echo json_encode(array('data' => $return_data, 'data_id' => $data_id, 'type' => $type, 'status' => $status_class));

				break;

			case 'get_similar_customer':
				$data_id 	= $_POST['data_id'];
				$type 		= $_POST['type'];

				$data = $this->manifest_model->get_by_data_id($data_id);

				$data = $this->customers_model->check_speeling_address($data->$type);
				$this->load->view('customers/get_similar_customer',array('customer' => $data, 'data_id' => $data_id, 'type' => $type));
				break;

			case 'set_customer_to_data':
				$cust_id = $_POST['cust_id'];
				$data_id = $_POST['data_id'];
				$type = $_POST['type'];
				$this->manifest_model->set_data_customer($cust_id,$data_id,$type);

				if($type == 'consignee') {
					$this->manifest_model->set_payment_data($data_id,$cust_id);
				}

				$cust = $this->customers_model->get_by_id($cust_id);

				$return_data = '
				<strong>'.$cust->name.'</strong><br/>
				'.$cust->address.'<br/>
				'.$cust->country.'<br/>
				';

				$check_valid_status = $this->manifest_model->check_valid_status($data_id);
                switch ($check_valid_status) {
                    case '0': $status_class = ''; break;
                    case '1': $status_class = 'warning'; break;
                    case '2': $status_class = 'success'; break;
                    default: $status_class = ''; break;
                }

				echo json_encode(array('data' => $return_data, 'data_id' => $data_id, 'type' => $type, 'status' => $status_class));
				break;

			case 'search_customer':
				$keyword = $_POST['keyword'];
				$type = $_POST['type'];
				$result = $this->customers_model->search($keyword);
				if($result == FALSE) echo 0;
				else echo $this->load->view('customers/search_result',array('result' => $result, 'type' => $type),true);
				break;

           	case 'payment_bill':
                  $data_id = $_POST['data_id'];
                  $data['status_payment'] = "Paid";
                  $this->manifest_model->data_update($data,$data_id);
                  $status = TRUE;
                  $message = "status payment has been updated. Please Wait...";
                  echo json_encode(array('status' =>$status,'message' => $message));
			break;

            case 'cancel_bill':
                  $data_id = $_POST['data_id'];
                  $data['status_payment'] = "Unpaid";
                  $this->manifest_model->data_update($data,$data_id);
                  $status = TRUE;
                  $message = "status payment has been updated. Please Wait...";
                  echo json_encode(array('status' =>$status,'message' => $message));
			break;

            case 'send_email':
                case 'delete_schedule':
                	$config = array(
					'protocol' => 'smtp',
					'smtp_host' => 'ssl://smtp.gmail.com',
					'smtp_port' => 465,
					'smtp_user' => 'tataharmoni18@gmail.com',
					'smtp_pass' => '1qwerty3',
					'mailtype'	=> 'html'
				);
                $this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from('tataharmoni18@gmail.com', 'No Reply');
                $this->email->to($_POST['to']);
                $message = $_POST['message'];
                $this->email->subject('Due Date Payment');
                $this->email->message($message);
                if (!$this->email->send()) {
                show_error($this->email->print_debugger());
               } else{
                    echo 'Your e-mail has been sent!';
                    redirect('customers');
                  }
                break;
			default:
				# code...
				break;
		}

	}

}

?>