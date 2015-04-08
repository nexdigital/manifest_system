<?php

Class Highchart extends MY_Controller {
	
	function __construct(){
		parent::__construct();
	}

	function get() {
		if(isset($_POST['status_payment']) && $_POST['status_payment'] != '') {
			$this->db->where('LOWER(status_payment)',strtolower($_POST['status_payment']));
		}

		//if(isset($_POST['sort_name']) && $_POST['sort_name'] != '') {
		//	$this->db->order_by($_POST['sort_name'],$_POST['sort_by']);
		//}

		if(isset($_POST['date_from']) && $_POST['date_from'] != '') {
			$this->db->where('LEFT(created_date,7) >=',$_POST['date_from']);
		}

		if(isset($_POST['date_to']) && $_POST['date_to'] != '') {
			$this->db->where('LEFT(created_date,7) <=',$_POST['date_to']);
		}

		if(isset($_POST['limit']) && $_POST['limit'] != '') {
			$this->db->limit($_POST['limit']);
		}

		$this->db->where('LOWER(status)','valid');
		$result = $this->db->get('manifest_data_table');

		$mapping = array();
		if($result->num_rows() > 0) {
			foreach ($result->result() as $row) {
				if(!isset($mapping['shipper'])) {
					$mapping['shipper'][] 	= $this->customers_model->get_by_id($row->shipper)->name;
					$mapping['kg'][] 		= $row->kg;
					$mapping['total'][] 	= ($row->value * $row->kg) * $row->nt_kurs;
				} else {
					if(!in_array($this->customers_model->get_by_id($row->shipper)->name, $mapping['shipper'])) {
						$mapping['shipper'][] 	= $this->customers_model->get_by_id($row->shipper)->name;
						$mapping['kg'][] 		= $row->kg;
						$mapping['total'][] 	= ($row->value * $row->kg) * $row->nt_kurs;
					} else {
						$key 					= array_search($this->customers_model->get_by_id($row->shipper)->name, $mapping['shipper']);
						$recent_kg 				= $mapping['kg'][$key];
						$recent_total 			= $mapping['total'][$key];

						$new_kg					= $row->kg + $recent_kg;
						$new_total				= (($row->value * $row->kg) * $row->nt_kurs) + $recent_total;
						$mapping['kg'][$key] 	= $new_kg;
						$mapping['total'][$key] = $new_total;
					}
				}
			}
		}

		if(count($mapping) > 0) {
			if(isset($_POST['sort_name']) && $_POST['sort_name'] == 'kg') {
				if(isset($_POST['sort_by']) && $_POST['sort_by'] == 'desc') {
					array_multisort($mapping['kg'],SORT_DESC,$mapping['shipper']);
				} else array_multisort($mapping['kg'],$mapping['shipper']);

				$cat =  implode('\',\'', $mapping['shipper']);
				$val =  implode(',', $mapping['kg']);

				$this->load->view('chart/bar',array('name'=>'KG','cat' => $cat, 'val' => $val));
			}

			if(isset($_POST['sort_name']) && $_POST['sort_name'] == 'total') {
				if(isset($_POST['sort_by']) && $_POST['sort_by'] == 'desc') {
					array_multisort($mapping['total'],SORT_DESC,$mapping['shipper']);
				} else array_multisort($mapping['total'],$mapping['shipper']);

				$cat =  implode('\',\'', $mapping['shipper']);
				$val =  implode(',', $mapping['total']);

				$this->load->view('chart/bar',array('name'=>'Total','cat' => $cat, 'val' => $val));
			}
		} else echo '<div class="col-lg-12 text-center">Data not found</div>';
	}
} 
?>