<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Manifest extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
	}

	function index() {
		if($this->session->userdata('login') != TRUE) redirect(base_url());
		$this->set_layout(null);
	}
	
	function upload() {
		if($this->session->userdata('login') != TRUE) redirect(base_url());
		$data = array(
			'partner_list' 	=> $this->partner_model->get_partner_list(),
			'list_currency'	=> $this->master->get_list_currency('Kurs Transaction'),
			'title'		 	=> 'Upload Manifest'
			);
		$this->set_layout('manifest/upload',$data);
	}

	function verification() {
		if(!isset($_GET['file_id'])) {
			$data['get_file_not_verified'] = $this->manifest_model->get_file_not_verified();
			$this->set_layout('manifest/verification_list',$data);
		} else {
			$file_id = $_GET['file_id'];
			$where = array('D.file_id' => $file_id, 'D.shipper !=' => '\'\'', 'D.consignee !=' => '\'\'');
			$data = array('file' => $this->manifest_model->get_by_file_id($file_id), 'list_data' => $this->manifest_model->get_filtering_data(null,null,$where),'title' => 'Verification Manifest');
			$this->set_layout('manifest/verification_file',$data);			
		}
	}
	
	function current_rate(){
		$from = "TWD";
		$to = "IDR";
		$amount = 321;
		$url = "http://www.exchangerate-api.com/".$from."/".$to."/".$amount."?k=API_KEY";
		$result = file_get_contents($url);
		echo $result;
	}

	function data() {
		if($this->session->userdata('login') != TRUE) redirect(base_url());

		$data = array(
			'title' => 'Data Manifest',
			'get_all_data' => $this->manifest_model->get_all_data(), 
			'list_shipper' => $this->customers_model->get_list('shipper'), 
			'list_consignee' => $this->customers_model->get_list('consignee')
		);
		$this->set_layout('manifest/data',$data);
	}

	function download(){
		$this->set_layout('manifest/download',array('title' => 'Download Manifest'));
	}

	function payment($method = false){
		if($this->session->userdata('login') != TRUE) redirect(base_url());

		switch ($method) {
			case 'select':
				$this->set_layout('manifest/payment_select');
				break;
			case 'add':
				# code...
				break;			
			default:
				$data = array('list_payment' => $this->manifest_model->get_list_payment());
				$this->set_layout('manifest/manifest_payment',$data);
				break;
		}	
	}

	function ajax($method = null) {
		if($this->session->userdata('login') != TRUE) redirect(base_url());

		switch ($method) {
			case 'get':
				$limit 	= (isset($_POST['totalrows'])) ? $_POST['totalrows'] : 100;
				$page 	= (isset($_POST['page'])) ? $_POST['page'] : 1;
				$start 	= ($page - 1) * $limit;
				$data 	= $this->manifest_model->get_filtering_data($start,$limit,array('D.status' => 'VALID'));

				$return = false;
				if($data != false)
				{
					$index = 0;
					foreach ($data as $key => $value) 
					{
						$return[$index]['data_id'] 				= $value->data_id;
						$return[$index]['data_no'] 				= $value->data_no;
						$return[$index]['hawb_no'] 				= $value->hawb_no;
						$return[$index]['shipper'] 				= ($value->shipper && $value->consignee != 'null') ? $this->customers_model->get_by_id($value->shipper)->name : '';
						$return[$index]['consignee'] 			= ($value->consignee && $value->consignee != 'null') ? $this->customers_model->get_by_id($value->consignee)->name : '';
						$return[$index]['pkg'] 					= $value->pkg;
						$return[$index]['description'] 			= $value->description;
						$return[$index]['pcs'] 					= $value->pcs;
						$return[$index]['kg']					= $value->kg;
						$return[$index]['value'] 				= $value->value;
						$return[$index]['prepaid']				= $value->prepaid;
						$return[$index]['collect']				= $value->collect;
						$return[$index]['remarks'] 				= $value->remarks;
						$return[$index]['status']				= $value->status;
						$return[$index]['nt_kurs']				= $value->nt_kurs;
						$return[$index]['created_date']			= $value->created_date;
						$return[$index]['last_update']			= $value->last_update;
						$return[$index]['user_id']				= $this->session->userdata('user_id');
						$return[$index]['status_payment']		= $value->status_payment;
						$return[$index]['status_delivery']		= ucfirst(strtolower($value->status_delivery));
						$return[$index]['other_charge_tata']	= $value->other_charge_tata;
						$return[$index]['other_charge_pml']		= $value->other_charge_pml;
						$return[$index]['mawb_type']			= $value->mawb_type;
						$return[$index]['rand_data_id']			= $value->rand_data_id;
						$return[$index]['manifest_type']		= $value->manifest_type;

						$index++;
					}
				}

				echo json_encode($return);
			break;

			case 'get_verification_list':
				$limit 	= (isset($_POST['totalrows'])) ? $_POST['totalrows'] : 100;
				$page 	= (isset($_POST['page'])) ? $_POST['page'] : 1;
				$start 	= ($page - 1) * $limit;
				$data 	= $this->manifest_model->get_filtering_data($start,$limit,array('D.status' => 'Unverified'),'D.file_id');

				$return = false;
				if($data != false)
				{
					$index = 0;
					foreach ($data as $key => $value) 
					{
						$return[$index] = $this->manifest_model->get_by_file_id($value->file_id);
						$index++;
					}
				}

				echo json_encode($return);
			break;

			case 'upload':
				if(strtolower($_POST['manifest_type']) == 'import') {
					include PATH_APP . 'libraries/PHPExcel/IOFactory.php';
					$status = ''; $message = ''; $redirect = '';

					$config['allowed_types'] = '*';
					$config['upload_path'] = PATH_ATTACH;
					$this->load->library('upload', $config);

					if ($this->upload->do_upload()) {
						$file_data = $this->upload->data();
						if(count($_POST) > 0) {
							$file['file_id']		= 'FILE' . date('ymdhis') . $this->manifest_model->file_new_id();
							$file['file_name'] 		= $file_data['file_name'];
							$file['consign_to'] 	= $_POST['consign_to'];
							$file['flight_from'] 	= $_POST['flight_from'];
							$file['flight_to'] 		= $_POST['flight_to'];
							$file['mawb_no'] 		= $_POST['mawb_no'];
							$file['created_date'] 	= date('Y-m-d h:i:s');
							$file['user_id']	 	= $this->session->userdata('user_id');
							$file['mawb_no'] 		= $_POST['mawb_no'];
							$file['gross_weight'] 	= $_POST['gross_weight'];
							$file['partner_id'] 	= $_POST['partner_id'];

							if($this->manifest_model->check_mawb_no($file['mawb_no'])) {

								$inputFileName = PATH_ATTACH . $file_data['file_name'];
								$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
								$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
								
								$mergeData = $objPHPExcel->getActiveSheet()->getMergeCells();
								$merge_cell = array();
								foreach ($mergeData as $value) {
									$explode = explode(':', $value);
									$merge_cell[$explode[0]] = $explode[1];
								}

								$header_format = $this->manifest_model->get_header_format();
								$header = array();
								$error_header = array();
								foreach ($sheetData[1] as $key => $value) {
									$value_trim = strtolower(trim(str_ireplace(' ', '_', trim($value))));
									if(strlen($value_trim) > 0) {
										if(in_array(trim($value_trim), $header_format)) {
											$header[trim($value_trim)] = $key;
										} else {
											$error_header[] = $value;
										}
									}
								}
								unset($sheetData[1]);
								if(count($header_format) == count($header)) {
									$this->manifest_model->file_insert_new($file);
									$no = 1;

									$mawb_type_list = array('ftz','hc','pouchen_ftz','pouchen_hc','fengtay_ftz','fengtay_hc','pibk');

									foreach ($sheetData as $key => $value) {

										$mawb_type = trim(str_ireplace(' ','_',strtolower($value[$header['mawb_type']])));

										if($value[$header['hawb_no']] || in_array($header['hawb_no'].$key, $merge_cell)) {
											$new_data_id = 'THS' . date('ymdhis') . $this->manifest_model->data_new_id();
											$rand_data_id = str_shuffle($new_data_id.time());

											$mapping[$no]['hawb_no'] 			= (!in_array($header['hawb_no'].$key, $merge_cell)) ? $value[$header['hawb_no']] : $sheetData[$this->system->get_cell_key($header['hawb_no'].$key,$merge_cell)][$header['hawb_no']];
											$mapping[$no]['pkg'] 				= (!in_array($header['pkg'].$key, $merge_cell)) ? $value[$header['pkg']] : $sheetData[$this->system->get_cell_key($header['pkg'].$key,$merge_cell)][$header['pkg']];
											$mapping[$no]['pcs'] 				= (!in_array($header['pcs'].$key, $merge_cell)) ? $value[$header['pcs']] : $sheetData[$this->system->get_cell_key($header['pcs'].$key,$merge_cell)][$header['pcs']];
											$mapping[$no]['kg']					= (!in_array($header['kg'].$key, $merge_cell)) ? $this->tools->rounded($value[$header['kg']]) : $this->tools->rounded($sheetData[$this->system->get_cell_key($header['kg'].$key,$merge_cell)][$header['kg']]);
											$mapping[$no]['value'] 				= (!in_array($header['value'].$key, $merge_cell)) ? $value[$header['value']] : $sheetData[$this->system->get_cell_key($header['value'].$key,$merge_cell)][$header['value']];
											$mapping[$no]['prepaid']			= (!in_array($header['pp'].$key, $merge_cell)) ? $value[$header['pp']] : $sheetData[$this->system->get_cell_key($header['pp'].$key,$merge_cell)][$header['pp']];
											$mapping[$no]['collect']			= (!in_array($header['cc'].$key, $merge_cell)) ? $value[$header['cc']] : $sheetData[$this->system->get_cell_key($header['cc'].$key,$merge_cell)][$header['cc']];

											if($this->manifest_model->check_hawb_no($mapping[$no]['hawb_no'])) {
												if($value[$header['pkg']]) $this->manifest_model->upgrade_data($mapping[$no]['hawb_no'],'pkg',$value[$header['pkg']]);
												if($value[$header['pcs']]) $this->manifest_model->upgrade_data($mapping[$no]['hawb_no'],'pcs',$value[$header['pcs']]);
												if($value[$header['kg']]) $this->manifest_model->upgrade_data($mapping[$no]['hawb_no'],'kg',$value[$header['kg']]);
												if($value[$header['value']]) $this->manifest_model->upgrade_data($mapping[$no]['hawb_no'],'value',$value[$header['value']]);
												if($value[$header['pp']]) $this->manifest_model->upgrade_data($mapping[$no]['hawb_no'],'prepaid',$value[$header['pp']]);
												if($value[$header['cc']]) $this->manifest_model->upgrade_data($mapping[$no]['hawb_no'],'collect',$value[$header['cc']]);

												//$this->manifest_model->upgrade_data($mapping[$no]['hawb_no'],$mapping[$no]['pkg'],$mapping[$no]['pcs'],$mapping[$no]['kg'],$mapping[$no]['value'],$mapping[$no]['prepaid'],$mapping[$no]['collect']);
											} else {
												$mapping[$no]['data_id'] 			= $new_data_id;
												$mapping[$no]['file_id'] 			= $file['file_id'];
												$mapping[$no]['data_no'] 			= (!in_array($header['no'].$key, $merge_cell)) ? $value[$header['no']] : $sheetData[$this->system->get_cell_key($header['no'].$key,$merge_cell)][$header['no']];
												$mapping[$no]['shipper'] 			= (!in_array($header['shipper'].$key, $merge_cell)) ? $this->tools->remove_tags_excel($value[$header['shipper']]) : $this->tools->remove_tags_excel($sheetData[$this->system->get_cell_key($header['shipper'].$key,$merge_cell)][$header['shipper']]);
												$mapping[$no]['consignee'] 			= (!in_array($header['consignee'].$key, $merge_cell)) ? $this->tools->remove_tags_excel($value[$header['consignee']]) : $this->tools->remove_tags_excel($sheetData[$this->system->get_cell_key($header['consignee'].$key,$merge_cell)][$header['consignee']]);
												$mapping[$no]['description'] 		= (!in_array($header['description'].$key, $merge_cell)) ? $value[$header['description']] : $sheetData[$this->system->get_cell_key($header['description'].$key,$merge_cell)][$header['description']];
												$mapping[$no]['rate'] 				= (!in_array($header['rate'].$key, $merge_cell)) ? $value[$header['rate']] : $sheetData[$this->system->get_cell_key($header['rate'].$key,$merge_cell)][$header['rate']];
												$mapping[$no]['remarks'] 			= (!in_array($header['remarks'].$key, $merge_cell)) ? $value[$header['remarks']] : $sheetData[$this->system->get_cell_key($header['remarks'].$key,$merge_cell)][$header['remarks']];
												$mapping[$no]['status']				= 'Unverified';
												$mapping[$no]['exchange_rate']  	= $this->master->get_currency_value('NT','kurs Transaction');
												$mapping[$no]['created_date']		= date('Y-m-d h:i:s');
												$mapping[$no]['last_update']		= date('Y-m-d h:i:s');
												$mapping[$no]['user_id']			= $this->session->userdata('user_id');
                                                if($value[$header['pp']] == ""){
                                                  $s_payment = "Unpaid";
                                                }else{
                                                  $s_payment = "Paid";
                                                }
												$mapping[$no]['status_payment']		= $s_payment;
												$mapping[$no]['status_delivery']	= 'New data';
												$mapping[$no]['other_charge_tata']	= (!in_array($header['other_charge_tata'].$key, $merge_cell)) ? $value[$header['other_charge_tata']] : $sheetData[$this->system->get_cell_key($header['other_charge_tata'].$key,$merge_cell)][$header['other_charge_tata']];
												$mapping[$no]['other_charge_pml']	= (!in_array($header['other_charge_pml'].$key, $merge_cell)) ? $value[$header['other_charge_pml']] : $sheetData[$this->system->get_cell_key($header['other_charge_pml'].$key,$merge_cell)][$header['other_charge_pml']];
												$mapping[$no]['mawb_type']			= ($mawb_type && strlen($mawb_type) > 0 && in_array($mawb_type, $mawb_type_list)) ? $mawb_type : 'ftz';
												$mapping[$no]['rand_data_id']		= $rand_data_id;
												$mapping[$no]['deadline']			= $this->tools->deadline('+'.$this->tools->get_deadline_days());
												$mapping[$no]['currency']			= 'NT';
												if($mapping[$no]['hawb_no'] && $mapping[$no]['shipper'] && $mapping[$no]['consignee']) {
													$this->manifest_model->data_insert_new($mapping[$no]);
												} else {
													unset($mapping[$no]);
												}
											}
											$no++;
										}
									}
									$this->system->set_activity('Import Manifest #'.$file['mawb_no']);
									$message = '<strong>UPLOAD SUCCESS</strong><br/>Filename: '.$file['file_name'].'<br/>Total Rows: '.count($mapping).'<br/>Need Verification: <a href="'.site_url('manifest/verification?file_id=' . $file['file_id']).'">Click here for verification</a>';
									$redirect = site_url('manifest/verification?file_id=' . $file['file_id']);
								} else {
									$error_header = implode('</li><li>', $error_header);
									$error_header = '<ol><li>'.$error_header.'</li></ol>';
									$status = 'error';
									$message = '<strong>Upload Failed</strong><br/>Below is incorrect header, please fixing:<br>'.$error_header;
								}
								unlink(PATH_ATTACH . $file_data['file_name']);
							} else {
								$status = 'error';
								$message = '<strong>Upload Failed</strong><br/>Mawb with no. <strong>'.$file['mawb_no'].'</strong> has been to uploaded';
							}
						}
					} else {
						$status = 'error';
						$message = $this->upload->display_errors();
					}
					echo json_encode(array('status' => $status, 'message' => $message, 'redirect' => $redirect));
				} else if(strtolower($_POST['manifest_type']) == 'export') {
					echo 'test';
				}
			break;
		case 'insert':
			$rand_data_id = str_shuffle(time());

			$status_shipper = ($_POST['shipper']) ? true : false;
			$status_consignee = ($_POST['consignee']) ? true : false;

			if($status_shipper && $status_consignee) {
				$mapping['data_id'] 		= 'THS' . date('ymdhis') . $this->manifest_model->data_new_id();;
				$mapping['data_no'] 		= NULL;
				$mapping['hawb_no'] 		= $_POST['hawb_no'];
				$mapping['shipper'] 		= $_POST['shipper'];
				$mapping['consignee'] 		= $_POST['consignee'];
				$mapping['pkg'] 			= $_POST['pkg'];
				$mapping['description'] 	= $_POST['description'];
				$mapping['pcs'] 			= $_POST['pcs'];
				$mapping['kg']				= $this->tools->rounded($_POST['kg']);
				$mapping['value'] 			= $_POST['value'];
				$mapping['prepaid']			= ($_POST['type_payment'] == 'prepaid') ? str_ireplace(',', '', $_POST['amount']) : null;
				$mapping['collect']			= ($_POST['type_payment'] == 'collect') ? str_ireplace(',', '', $_POST['amount']) : null;
				$mapping['rate']			= $_POST['rate'];
				$mapping['remarks'] 		= $_POST['remarks'];
				$mapping['status']			= 'valid';
				$mapping['exchange_rate']	= $_POST['exchange_rate'];
				$mapping['created_date']	= date('Y-m-d h:i:s');
				$mapping['last_update']		= date('Y-m-d h:i:s');
				$mapping['user_id']			= $this->session->userdata('user_id');
				$mapping['status_payment']		= NULL;
				$mapping['status_delivery']		= NULL;
				$mapping['other_charge_tata']	= $_POST['other_charge_tata'];
				$mapping['other_charge_pml']	= $_POST['other_charge_pml'];
				$mapping['mawb_type']			= NULL;
				$mapping['rand_data_id']		= $rand_data_id;
				$mapping['manifest_type']		= $_POST['manifest_type'];
				$mapping['currency']			= $_POST['currency'];
				$mapping['status_delivery']		= 'New data';
				$this->manifest_model->data_insert_new($mapping);
				$this->system->set_activity('Insert Single Data #'.$mapping['hawb_no']);
				echo json_encode(array('status' => 'success'));
			} else {
				echo json_encode(array('status' => 'failed', 'message' => 'Please complete the shipper and consignee'));
			}
			break;
		case 'update':
			$hawb_no 					= $_POST['hawb_no'];
			$mapping['pkg'] 			= $_POST['pkg'];
			$mapping['description'] 	= $_POST['description'];
			$mapping['remarks']		 	= $_POST['remarks'];
			$mapping['pcs'] 			= $_POST['pcs'];
			$mapping['kg']				= $_POST['kg'];
			$mapping['value'] 			= $_POST['value'];
			$mapping['prepaid']			= ($_POST['type_payment'] == 'prepaid') ? str_ireplace(',', '', $_POST['amount']) : null;
			$mapping['collect']			= ($_POST['type_payment'] == 'collect') ? str_ireplace(',', '', $_POST['amount']) : null;
			$mapping['rate']			= $_POST['rate'];
			$mapping['other_charge_tata'] 	= $_POST['charge_tata'];
			$mapping['other_charge_pml'] 	= $_POST['charge_pml'];
			$this->manifest_model->data_update($mapping,$hawb_no);
			echo json_encode(array('hawb_no' => $hawb_no));
			break;

		case 'update_invoice':
			$mapping['hawb_no']			= $_POST['hawb_no'];
			$mapping['pkg'] 			= $_POST['pkg'];
			$mapping['pcs'] 			= $_POST['pcs'];
			$mapping['value'] 			= $_POST['value'];
			$mapping['kg']				= $_POST['kg'];
			$mapping['rate']			= $_POST['rate'];
			$mapping['currency']	= $_POST['currency'];
			$mapping['exchange_rate']	= $_POST['exchange_rate'];
			$mapping['type_payment']	= $_POST['type_payment'];
			$mapping['amount']	= $_POST['amount'];
			$mapping['shipper_name']	= $_POST['shipper_name'];
			$mapping['shipper_details']	= $_POST['shipper_details'];
			$mapping['consignee_name']	= $_POST['shipper_name'];
			$mapping['consignee_details']	= $_POST['consignee_details'];
			$mapping['description']	= $_POST['description'];
			$mapping['created_date']	= date('Y-m-d');
			$mapping['created_by']	= $this->session->userdata('user_id');
			$this->manifest_model->add_new_invoice($mapping);
			echo json_encode(array('hawb_no' => $mapping['hawb_no']));
			break;

		case 'get_data':
			$data_id = $_POST['data_id'];
			$data = $this->manifest_model->get_by_data_id($data_id);
			echo json_encode($data);
			break;

		case 'get_data_form':
			$data_id = $_POST['data_id'];
			$data = $this->load->view('manifest/data_form',array('data'=>$this->manifest_model->get_by_data_id($data_id)),true);
			echo $data;
			break;

		case 'verification':
			$file_id = $_POST['file_id'];
			$this->manifest_model->set_status_data($file_id,'VALID');
			break;

		case 'search_hawb':
			$keyword = $_POST['keyword'];
			$result = $this->manifest_model->search_hawb($keyword);
			if($result == FALSE) echo 0;
			else echo $this->load->view('manifest/hawb_result',array('result' => $result),true);
			break;

		case 'discount':
			$type = $_GET['type'];
			switch ($type) {
				case 'add':
					$discount['discount_id'] = time();
					$discount['data_id'] = $_POST['data_id'];
					$discount['type'] = $_POST['type_discount'];
					$discount['discount'] = $_POST['discount'];
					$discount['status'] = ($this->session->userdata('user_type') != 'Admin') ? 'Waiting Approval' : 'Approved';
					$discount['created_date'] = date('Y-m-d h:i:s');
					$discount['user_id'] = $this->session->userdata('user_id');

					if($this->discount->check($discount['data_id'],$discount['type'])) {
						if($this->discount->check_maximum_discount($discount['data_id'],$discount['type'],$discount['discount'])) {
							$this->discount->set($discount);
							$data = $this->manifest_model->get_by_data_id($discount['data_id']);
							$this->system->set_activity('Request discount for #'.$data->hawb_no);
							echo json_encode(array('status' => 'true','redirect' => base_url() . 'request/discount'));
						} else {
							echo json_encode(array('status' => 'false','message' => 'Discount is over from normal price'));							
						}
					} else {
						echo json_encode(array('status' => 'false','message' => 'Discount with type "'.$discount['type'].'" has been set to this data'));
					}
					break;
				case 'edit':
					$discount_id = $_GET['discount_id'];
					break;
				case 'cancel':
					$discount_id = $_POST['discount_id'];
					$this->discount->update_status($discount_id,'Cancelled');
					
					$data = $this->manifest_model->get_by_data_id($discount['data_id']);
					$this->system->set_activity('Cancel discount for #'.$discount_id);
					break;
				case 'approve':
					$discount_id = $_POST['discount_id'];
					$this->discount->update_status($discount_id,'Approved');
					
					$data = $this->manifest_model->get_by_data_id($discount['data_id']);
					$this->system->set_activity('Approve discount for #'.$discount_id);
					break;
				case 'reject':
					$discount_id = $_POST['discount_id'];
					$this->discount->update_status($discount_id,'Rejected');
					
					$data = $this->manifest_model->get_by_data_id($discount['data_id']);
					$this->system->set_activity('Reject discount for #'.$discount_id);
					break;
				default:
					echo 'false';
					break;
			}
			break;
		case 'extra_charge':
			$type = $_GET['type'];
			switch ($type) {
				case 'add':
					$charge['hawb_no'] 				= $_GET['hawb_no'];
					$charge['charge_type']		 	= $_POST['charge_type'];
					$charge['description'] 			= $_POST['description'];
					$charge['currency_name']		= $_POST['currency_name'];
					$charge['currency_value'] 		= $_POST['currency_value'];
					$charge['created_date'] 		= date('Y-m-d');
					$charge['user_id'] 				= $this->session->userdata('user_id');
					$charge['sync_debit'] 			= (isset($_POST['sync_debit'])) ? 'true' : 'false';

					if($this->manifest_model->check_extra_charge($charge['hawb_no'],$charge['charge_type']) == false) {
						$this->manifest_model->add_extra_charge($charge);
						$data = $this->manifest_model->get_by_hawb_no($charge['hawb_no']);
						$this->system->set_activity('Add extra charge '.$charge['charge_type'].' for #'.$data->hawb_no);
						echo json_encode(array('status' => 'true','message' => 'Charge has been add to manifest #'.$data->hawb_no));
					} else {
						echo json_encode(array('status' => 'false','message' => 'Type charge has been added!'));		
					}					
					break;
					
				case 'delete':
					$charge_id = $_POST['charge_id'];
					$this->manifest_model->delete_extra_charge($charge_id);
					$this->system->set_activity('Delete extra charge');
					echo json_encode(array('status' => 'true','message' => ''));
					break;
				default:
					# code...
					break;
			}
			break;
		case 'save_print_priview':
			$print_priview_id = $_POST['print_priview_id'];
			if($this->manifest_model->print_get($print_priview_id)) {
				unset($_POST['print_priview_id']);
				$this->manifest_model->print_update($print_priview_id,$_POST);
				echo 'Updated';
			} else {
				$this->manifest_model->print_add($_POST);
				echo 'Added';
			}
			break;
	
		case 'get_new_hawbno':

			#GET TOTAL TRANSACTION TODAY
			$get = $this->db->query("select count(data_id) as total_transaction from manifest_data_table where created_date = '2015-04-14' and lower(manifest_type) != 'import'");
			$total_transaction = $get->row('total_transaction');
			$total_transaction += 1;

			$new_hawb_no = 'T' . date('ymd');
			switch (strlen($total_transaction)) {
				case 1:
					$new_hawb_no = $new_hawb_no . '00' . $total_transaction;
					break;
				case 2:
					$new_hawb_no = $new_hawb_no . '0' . $total_transaction;
					break;	
				default:
					$new_hawb_no = $new_hawb_no . $total_transaction;
					break;
			}
			echo $new_hawb_no;
			break;

			default:
				# code...
				break;
		}
	}

	function modal($method = null){
		switch ($method) {
			case 'details':
				$hawb_no = $_GET['hawb_no'];

				$data['data'] = $this->manifest_model->get_by_hawb_no($hawb_no);
				$data['extra_charge'] = $this->manifest_model->get_extra_charge($hawb_no);
				$this->set_modal('manifest/details',$data);
				break;
			
			case 'edit':
				$hawb_no = $_GET['hawb_no'];

				$data['data'] = $this->manifest_model->get_by_hawb_no($hawb_no);
				$this->set_modal('manifest/edit',$data);
				break;

			case 'edit_invoice':
				$hawb_no = $_GET['hawb_no'];

				$data = $this->manifest_model->get_by_hawb_no($hawb_no);
				$this->set_modal('manifest/print_priview',array('data' => $data));
				break;

			case 'extra_charge':
				$hawb_no = $_GET['hawb_no'];

				$data['data'] = $this->manifest_model->get_by_hawb_no($hawb_no);
				$data['extra_charge'] = $this->manifest_model->get_extra_charge($hawb_no);
				$this->set_modal('manifest/extra_charge',$data);
				break;
			default:
				# code...
				break;
		}
	}

	function getMergeCell(){
		include PATH_APP . 'libraries/PHPExcel/IOFactory.php';
		$inputFileName = PATH_ATTACH . '297-1306 3035.xls';
		$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);

		$mergeData = $objPHPExcel->getActiveSheet()->getMergeCells();

		$merge_cell = array();
		foreach ($mergeData as $value) {
			$explode = explode(':', $value);
			$merge_cell[$explode[0]] = $explode[1];
		}

		echo '<pre>';
		print_r($merge_cell);
		echo '</pre>';

		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		$header_format = $this->manifest_model->get_header_format();
		$header = array();
		$error_header = array();
		foreach ($sheetData[1] as $key => $value) {
			$value = strtolower(trim(str_ireplace(' ', '_', trim($value))));
			if(strlen($value) > 0) {
				if(in_array(trim($value), $header_format)) {
					$header[trim($value)] = $key;
				} else {
					$error_header[] = $key .' => '.$value;
				}
			}
		}
		unset($sheetData[1]);

		foreach ($sheetData as $key => $value) {
			if(in_array($header['shipper'].$key,$merge_cell)) {
				$key = array_search($header['shipper'].$key,$merge_cell);
				preg_match_all('!\d+!', $key, $result);
				echo $result[0][0];
			}
		}
	}


	function print_priview($hawb_no){
		$data = $this->manifest_model->get_by_hawb_no($hawb_no);
		$this->set_modal('manifest/print_priview',array('data' => $data));
	}

	function formula($method = null) {
		if(count($_POST) > 0) {
			switch ($method) {
				case 'subtotal':
					$pkg 	= str_ireplace(',', '.', $_POST['pkg']);
					$kg 	= str_ireplace(',', '.', $_POST['kg']);
					$rate 	= str_ireplace(',', '.', $_POST['rate']);
					$kurs 	= $_POST['kurs'];
					$charge_tata = (isset($_POST['charge_tata'])) ? $_POST['charge_tata'] : 0;
					$charge_pml = (isset($_POST['charge_pml'])) ? $_POST['charge_pml'] : 0;

					$total 	= $kg * $rate;
					$amount = $total;
					$subtotal  = $total + $charge_tata + $charge_pml;
					$subtotal  = $subtotal * $kurs;

					echo json_encode(array('amount' => $amount, 'subtotal' => $subtotal));
					break;
				
				default:
					echo 'Not Found!';
					break;
			}
		} else echo 'Not Found!';
	}

    function sby_data($get_surabaya_import ="",  $get_surabaya_export = ""){

       $this->form_validation->set_rules('date','date','required');

            if($this->input->post('find')){

              if ($this->form_validation->run() == TRUE){
                    $date = explode('-',$_POST['date']);
                    $date_from = date("Y-m-d", strtotime($date[0]));
                    $date_end  = date("Y-m-d", strtotime($date[1]));

                    $get_surabaya_import = $this->manifest_model->get_surabaya_import($date_from,$date_end);
                    $get_surabaya_export = $this->manifest_model->get_surabaya_export($date_from,$date_end);
             }
            }

         
      $data['get_surabaya_import'] = $get_surabaya_import;
      $data['get_surabaya_export'] = $get_surabaya_export;
      $data['title'] = 'Data Surabaya';
      $this->set_layout('manifest/surabaya',$data);
    }


}