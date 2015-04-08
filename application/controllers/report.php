<?php

class Report extends MY_Controller {
	
	function __construct() {
		parent::__construct();
	}

	function index() {
		$this->set_layout();
	}

	function customer_card() {
		/*if(isset($_GET['file_id'])) {
			if($this->manifest_model->get_by_file_id($_GET['file_id'])) {
				$file_id = $_GET['file_id'];
				$data = array(
					'valid_file' => TRUE,
					'data'	=> $this->manifest_model->get_by_file_id($file_id),
					'total_pp' => $this->manifest_model->get_total('prepaid',$file_id),
					'total_cc' => $this->manifest_model->get_total('collect',$file_id),
					'total_pkg' => $this->manifest_model->get_total('pkg',$file_id),
					'total_pcs' => $this->manifest_model->get_total('pcs',$file_id),
					'total_kg' => $this->manifest_model->get_total('kg',$file_id),
					'total_value' => $this->manifest_model->get_total('value',$file_id),
					'total_oth_chr_tata' => $this->manifest_model->get_total('other_charge_tata',$file_id),
					'total_oth_chr_pml' => $this->manifest_model->get_total('other_charge_pml',$file_id)
				);
			}
		}
		$data['list_file'] = $this->manifest_model->get_all_file();*/
		$this->set_layout('report/snow_card');
	}

	function snow(){
		$date = $_GET['date'];
		$from = $_GET['from'];
		$to = $_GET['to'];

		switch ($from) {
			case 'taiwan':
				switch ($to) {
					case 'jakarta':
						$this->snow_taiwan_jakarta();
						break;					
					default:
						echo 'Not Found';
						break;
				}
				break;
			case 'vietnam':
				switch($to) {
					case 'jakarta':
						$this->snow_vietnam_jakarta();
						break;
					default:
						echo 'Not Found!';
						break;
				}
				break;
			case 'jakarta':
				switch ($to) {
					case 'taiwan':
						$this->snow_jakarta_taiwan();
						break;
					case 'vietnam':
						$this->snow_jakarta_vietnam();
						break;
					default:
						echo 'Not Found';
						break;
				}
				break;
			default:
				echo 'Not Found';
				break;
		}


		/*
		$file_id = $_GET['file_id'];

		//Get all data without pouchen, fengtay and pibk
		if($this->manifest_model->get_by_file_id($file_id)) {
			$data = $this->manifest_model->get_by_file_id($file_id);

			if(strtolower($data->flight_from) == 'taiwan') {
				$snow['header']						= $data;

				#=================================================================================================================================================================================================================
				$no = 0;
				$snow['host'][$no]['date'] 					= substr($data->created_date,0,10);
				$snow['host'][$no]['host'] 					= $data->mawb_no;
				$snow['host'][$no]['gw_hc'] 				= $this->manifest_model->get_total_where('kg',$file_id,'mawb_type',array('hc'));
				$snow['host'][$no]['gw_ftz'] 				= $this->manifest_model->get_total_where('kg',$file_id,'mawb_type',array('ftz'));
				$snow['host'][$no]['gw_docftz']				= $this->manifest_model->get_count_where($file_id,'mawb_type',array('ftz'));
				$snow['host'][$no]['gw_total']				= $snow['host'][$no]['gw_hc'] + $snow['host'][$no]['gw_ftz'];

				$snow['host'][$no]['in_pp'] 				= $this->manifest_model->get_total('prepaid',$file_id);
				$snow['host'][$no]['in_cc']					= $this->manifest_model->get_total('collect',$file_id);
				$snow['host'][$no]['in_total']				= $snow['host'][$no]['in_pp'] + $snow['host'][$no]['in_cc'];
				
				$snow['host'][$no]['cost_pml_charge'] 		= $this->manifest_model->get_total('other_charge_pml',$file_id);
				$snow['host'][$no]['cost_pml_freight'] 		= $snow['host'][$no]['gw_total'] * 56;

				$snow['host'][$no]['cost_tata_hc']			= $snow['host'][$no]['gw_hc'] * 192;
				$snow['host'][$no]['cost_tata_ftz']			= ($snow['host'][$no]['gw_ftz'] * 16) + (640 * $snow['host'][$no]['gw_docftz']);
				$snow['host'][$no]['cost_tata_charge'] 		= $this->manifest_model->get_total('other_charge_tata',$file_id);

				$snow['host'][$no]['cost_total']			= $snow['host'][$no]['cost_pml_charge'] + $snow['host'][$no]['cost_pml_freight'] + $snow['host'][$no]['cost_tata_hc'] + $snow['host'][$no]['cost_tata_ftz'] + $snow['host'][$no]['cost_tata_charge'];

				$snow['host'][$no]['profit'] 				= $snow['host'][$no]['in_total'] - $snow['host'][$no]['cost_total'];

				$debit_credit 							= ($snow['host'][$no]['profit']/2) + $snow['host'][$no]['cost_pml_charge'] + $snow['host'][$no]['cost_pml_freight'] - $snow['host'][$no]['in_pp'];
				$snow['host'][$no]['debit_credit']		= ($debit_credit < 0) ? number_format($debit_credit,1) : number_format($debit_credit,1);
				#=================================================================================================================================================================================================================
				$list_mawb_type = array('pouchen','fengtay');
				$no++;
				foreach ($list_mawb_type as $val) {
					if($this->manifest_model->search_mawb_type($val)){
						$snow['host'][$no]['date'] 				= '';
						$snow['host'][$no]['host'] 				= $val;
						$snow['host'][$no]['gw_hc'] 			= $this->manifest_model->get_total_where('kg',$file_id,'mawb_type',array($val . '_hc'));
						$snow['host'][$no]['gw_ftz'] 			= $this->manifest_model->get_total_where('kg',$file_id,'mawb_type',array($val . '_ftz'));
						$snow['host'][$no]['gw_docftz']			= $this->manifest_model->get_count_where($file_id,'mawb_type',array($val . '_ftz'));
						$snow['host'][$no]['gw_total']			= $snow['host'][$no]['gw_hc'] + $snow['host'][$no]['gw_ftz'];

						$snow['host'][$no]['in_pp'] 			= $this->manifest_model->get_total_where('prepaid',$file_id,'mawb_type',array($val . '_ftz',$val . '_hc'));
						$snow['host'][$no]['in_cc']				= $this->manifest_model->get_total_where('prepaid',$file_id,'mawb_type',array($val . '_ftz',$val . '_hc'));
						$snow['host'][$no]['in_total']			= $snow['host'][$no]['in_pp'] + $snow['host'][$no]['in_cc'];
						
						$snow['host'][$no]['cost_pml_charge'] 	= $this->manifest_model->get_total_where('other_charge_pml',$file_id,'mawb_type',array($val . '_ftz',$val . '_hc'));
						$snow['host'][$no]['cost_pml_freight'] 	= $snow['host'][$no]['gw_total'] * 56;

						$snow['host'][$no]['cost_tata_hc']		= $snow['host'][$no]['gw_hc'] * 192;
						$snow['host'][$no]['cost_tata_ftz']		= ($snow['host'][$no]['gw_ftz'] * 16) + (640 * $snow['host'][$no]['gw_docftz']);
						$snow['host'][$no]['cost_tata_charge'] 	= $this->manifest_model->get_total_where('other_charge_tata',$file_id,'mawb_type',array($val . '_ftz',$val . '_hc'));

						$snow['host'][$no]['cost_total']		= $snow['host'][$no]['cost_pml_charge'] + $snow['host'][$no]['cost_pml_freight'] + $snow['host'][$no]['cost_tata_hc'] + $snow['host'][$no]['cost_tata_ftz'] + $snow['host'][$no]['cost_tata_charge'];

						$snow['host'][$no]['profit'] 			= $snow['host'][$no]['in_total'] - $snow['host'][$no]['cost_total'];

						$profit_split							= ($val == 'pouchen') ? 3 : 2;

						$debit_credit 							= ($snow['host'][$no]['profit']/$profit_split) + $snow['host'][$no]['cost_pml_charge'] + $snow['host'][$no]['cost_pml_freight'] - $snow['host'][$no]['in_pp'];
						$snow['host'][$no]['debit_credit']		= ($debit_credit < 0) ? number_format($debit_credit,1) : number_format($debit_credit,1);

						$no++;
					}
				}
				if($this->manifest_model->search_mawb_type('pibk')) {
					$pibk = $this->manifest_model->get_manifest_by_mawb_type('pibk');
					foreach ($pibk as $key => $row) {
						$snow['host'][$no]['date'] 				= '';
						$snow['host'][$no]['host']	 			= $row->hawb_no .' P.I.B.K';
						$snow['host'][$no]['gw_hc'] 			= $this->manifest_model->get_total_where_by_hawb('kg',$row->hawb_no,'mawb_type',array('hc'));
						$snow['host'][$no]['gw_ftz'] 			= $this->manifest_model->get_total_where_by_hawb('kg',$row->hawb_no,'mawb_type',array('ftz'));
						$snow['host'][$no]['gw_docftz']			= '';
						$snow['host'][$no]['gw_total']			= $snow['host'][$no]['gw_hc'] + $snow['host'][$no]['gw_ftz'];

						$snow['host'][$no]['in_pp'] 			= $row->prepaid;
						$snow['host'][$no]['in_cc']				= $row->collect;
						$snow['host'][$no]['in_total']			= $snow['host'][$no]['in_pp'] + $snow['host'][$no]['in_cc'];

						$snow['host'][$no]['cost_pml_charge'] 	= $row->other_charge_pml;
						$snow['host'][$no]['cost_pml_freight'] 	= $snow['host'][$no]['gw_total'] * 56;

						$snow['host'][$no]['cost_tata_hc']		= $snow['host'][$no]['gw_hc'] * 192;
						$snow['host'][$no]['cost_tata_ftz']		= ($snow['host'][$no]['gw_ftz'] * 16) + (640 * $snow['host'][$no]['gw_docftz']);
						$snow['host'][$no]['cost_tata_charge'] 	= $row->other_charge_tata;

						$snow['host'][$no]['cost_total']		= $snow['host'][$no]['cost_pml_charge'] + $snow['host'][$no]['cost_pml_freight'] + $snow['host'][$no]['cost_tata_hc'] + $snow['host'][$no]['cost_tata_ftz'] + $snow['host'][$no]['cost_tata_charge'];

						$snow['host'][$no]['profit'] 			= $snow['host'][$no]['in_total'] - $snow['host'][$no]['cost_total'];

						$debit_credit 							= ($snow['host'][$no]['profit']/2) + $snow['host'][$no]['cost_pml_charge'] + $snow['host'][$no]['cost_pml_freight'] - $snow['host'][$no]['in_pp'];
						$snow['host'][$no]['debit_credit']		= ($debit_credit < 0) ? $debit_credit : $debit_credit;

						$no++;
					}
				}
				$this->set_layout('report/snow_taiwan',$snow);
			} else if(strtolower($data->flight_from) == 'vietnam') {
				$no = 0;
				$manifest_from_vietnam = $this->manifest_model->manifest_from_vietnam($data->file_id);
				if($manifest_from_vietnam) {
					foreach ($manifest_from_vietnam as $key => $row) {
						$snow['host'][$no]['date'] 				= '';
						$snow['host'][$no]['host']	 			= $row->hawb_no;
						$snow['host'][$no]['gw_hc'] 			= $this->manifest_model->get_total_where_by_hawb('kg',$row->hawb_no,'mawb_type',array('hc'));
						$snow['host'][$no]['gw_ftz'] 			= $this->manifest_model->get_total_where_by_hawb('kg',$row->hawb_no,'mawb_type',array('ftz'));
						$snow['host'][$no]['gw_docftz']			= $this->manifest_model->get_count_where_by_hawb($row->hawb_no,'mawb_type',array('ftz'));
						$snow['host'][$no]['gw_total']			= $snow['host'][$no]['gw_hc'] + $snow['host'][$no]['gw_ftz'];

						$snow['host'][$no]['in_pp'] 			= $row->prepaid;
						$snow['host'][$no]['in_cc']				= $row->collect;
						$snow['host'][$no]['in_total']			= $snow['host'][$no]['in_pp'] + $snow['host'][$no]['in_cc'];

						$snow['host'][$no]['cost_pml_charge'] 	= $row->other_charge_pml;
						$snow['host'][$no]['cost_pml_freight'] 	= $snow['host'][$no]['gw_total'] * 56;

						$snow['host'][$no]['cost_tata_hc']		= $snow['host'][$no]['gw_hc'] * 192;
						$snow['host'][$no]['cost_tata_ftz']		= ($snow['host'][$no]['gw_ftz'] * 16) + (640 * $snow['host'][$no]['gw_docftz']);
						$snow['host'][$no]['cost_tata_tpe']		= $snow['host'][$no]['gw_total'] * (56+26);
						$snow['host'][$no]['cost_tata_charge'] 	= $row->other_charge_tata;

						$snow['host'][$no]['cost_total']		= $snow['host'][$no]['cost_pml_charge'] + $snow['host'][$no]['cost_pml_freight'] + $snow['host'][$no]['cost_tata_hc'] + $snow['host'][$no]['cost_tata_ftz'] + $snow['host'][$no]['cost_tata_charge'];

						$snow['host'][$no]['profit'] 			= $snow['host'][$no]['in_total'] - $snow['host'][$no]['cost_total'];

						$snow['host'][$no]['tata'] 				= $snow['host'][$no]['in_total'] - $snow['host'][$no]['cost_total'];
						$snow['host'][$no]['lita'] 				= $snow['host'][$no]['in_total'] - $snow['host'][$no]['cost_total'];
						$snow['host'][$no]['pml'] 				= $snow['host'][$no]['in_total'] - $snow['host'][$no]['cost_total'];

						$no++;
					}
				}

				$this->set_layout('report/snow_vietnam',$snow);
			} else echo 'Not Found';
		} else echo 'Not Found';
		*/
	}

	function snow_taiwan_jakarta(){
		$date = $_GET['date'];
		$get_file_id = $this->manifest_model->get_file_id_by_upload_date($date,array('taiwan','china','hongkong'));

		$snow['host'] = array();

		if($get_file_id) {
			foreach ($get_file_id as $key => $row) {
				#GW
				$gw_hc 					= $this->manifest_model->get_total_where('kg',$row->file_id,'mawb_type',array('hc'),strtolower($row->flight_from));
				$gw_ftz 				= $this->manifest_model->get_total_where('kg',$row->file_id,'mawb_type',array('ftz'),strtolower($row->flight_from));
				$gw_docftz				= $this->manifest_model->get_count_where($row->file_id,'mawb_type',array('ftz'),strtolower($row->flight_from));
				$gw_total				= $gw_hc + $gw_ftz;

				#INCOME
				$in_pp 					= $this->manifest_model->get_total('prepaid',$row->file_id,strtolower($row->flight_from));
				$in_cc					= $this->manifest_model->get_total('collect',$row->file_id,strtolower($row->flight_from));
				$in_total				= $in_pp + $in_cc;

				#COST
				$cost_pml_charge 		= $this->manifest_model->get_total('other_charge_pml',$row->file_id,strtolower($row->flight_from));
				$cost_pml_freight 		= $gw_total * 56;
				$cost_tata_hc			= $gw_hc * 192;
				$cost_tata_ftz			= ($gw_ftz * 16) + (640 * $gw_docftz);
				$cost_tata_charge 		= $this->manifest_model->get_total('other_charge_tata',$row->file_id,strtolower($row->flight_from));
				$cost_total				= $cost_pml_charge + $cost_pml_freight + $cost_tata_hc + $cost_tata_ftz + $cost_tata_charge;

				$profit 				= $in_total - $cost_total;

				$debit_credit 			= ($profit/2) + $cost_pml_charge + $cost_pml_freight - $in_pp;


				$snow['host'][] = array(
					'date' 					=> substr($row->created_date,0,10),
					'host' 					=> $row->mawb_no,
					'gw_hc' 				=> $gw_hc,
					'gw_ftz' 				=> $gw_ftz,
					'gw_docftz'				=> $gw_docftz,
					'gw_total'				=> $gw_total,

					'in_pp' 				=> $in_pp,
					'in_cc'					=> $in_cc,
					'in_total'				=> $in_total,

					'cost_pml_charge' 		=> $cost_pml_charge,
					'cost_pml_freight' 		=> $cost_pml_freight,

					'cost_tata_hc'			=> $cost_tata_hc,
					'cost_tata_ftz'			=> $cost_tata_ftz,
					'cost_tata_charge' 		=> $cost_tata_charge,
					'cost_total'			=> $cost_total,

					'profit' 				=> $profit,
					'debit_credit'			=> $debit_credit
				);

				//Pouchen Fengtay
				$list_mawb_type = array('pouchen','fengtay');
				foreach ($list_mawb_type as $type) {
					if($this->manifest_model->get_manifest_by_mawb_type_and_file_id($row->file_id,$type,strtolower($row->flight_from))) {
						#GW
						$gw_hc 					= $this->manifest_model->get_total_where('kg',$row->file_id,'mawb_type',array($type . '_hc'),strtolower($row->flight_from));
						$gw_ftz 				= $this->manifest_model->get_total_where('kg',$row->file_id,'mawb_type',array($type . '_ftz'),strtolower($row->flight_from));
						$gw_docftz				= $this->manifest_model->get_count_where($row->file_id,'mawb_type',array($type . '_ftz'),strtolower($row->flight_from));
						$gw_total				= $gw_hc + $gw_ftz;

						#INCOME
						$in_pp 					= $this->manifest_model->get_total_where('prepaid',$row->file_id,'mawb_type',array($type . '_ftz',$type . '_hc'),strtolower($row->flight_from));
						$in_cc					= $this->manifest_model->get_total_where('collect',$row->file_id,'mawb_type',array($type . '_ftz',$type . '_hc'),strtolower($row->flight_from));
						$in_total				= $in_pp + $in_cc;

						#COST
						$cost_pml_charge 		= $this->manifest_model->get_total_where('other_charge_pml',$row->file_id,'mawb_type',array($type . '_ftz',$type . '_hc'),strtolower($row->flight_from));
						$cost_pml_freight 		= $gw_total * 56;
						$cost_tata_hc			= $gw_hc * 192;
						$cost_tata_ftz			= ($gw_ftz * 16) + (640 * $gw_docftz);
						$cost_tata_charge 		= $this->manifest_model->get_total_where('other_charge_tata',$row->file_id,'mawb_type',array($type . '_ftz',$type . '_hc'),strtolower($row->flight_from));
						$cost_total				= $cost_pml_charge + $cost_pml_freight + $cost_tata_hc + $cost_tata_ftz + $cost_tata_charge;

						$profit 				= $in_total - $cost_total;

						$profit_split			= ($type == 'pouchen') ? 3 : 2;

						$debit_credit 			= ($profit/$profit_split) + $cost_pml_charge + $cost_pml_freight - $in_pp;


						$snow['host'][] = array(
								'date' 					=> '',
								'host' 					=> ucwords($type),
								'gw_hc' 				=> $gw_hc,
								'gw_ftz' 				=> $gw_ftz,
								'gw_docftz'				=> $gw_docftz,
								'gw_total'				=> $gw_total,

								'in_pp' 				=> $in_pp,
								'in_cc'					=> $in_cc,
								'in_total'				=> $in_total,

								'cost_pml_charge' 		=> $cost_pml_charge,
								'cost_pml_freight' 		=> $cost_pml_freight,

								'cost_tata_hc'			=> $cost_tata_hc,
								'cost_tata_ftz'			=> $cost_tata_ftz,
								'cost_tata_charge' 		=> $cost_tata_charge,
								'cost_total'			=> $cost_total,

								'profit' 				=> $profit,
								'debit_credit'			=> $debit_credit
						);
					}
				}

				//PIBK
				if($pibk_data = $this->manifest_model->get_manifest_by_mawb_type_and_file_id($row->file_id,'pibk',strtolower($row->flight_from))) {
					foreach ($pibk_data as $key => $pibk_row) {
						#GW
						$gw_hc 					= $this->manifest_model->get_total_where_by_hawb('kg',$pibk_row->hawb_no,'mawb_type',array('hc'),strtolower($row->flight_from));
						$gw_ftz 				= $this->manifest_model->get_total_where_by_hawb('kg',$pibk_row->hawb_no,'mawb_type',array('ftz'),strtolower($row->flight_from));
						$gw_docftz				= $this->manifest_model->get_count_where_by_hawb($pibk_row->hawb_no,'mawb_type',array('ftz'),strtolower($row->flight_from));
						$gw_total				= $gw_hc + $gw_ftz;

						#INCOME
						$in_pp 					= $pibk_row->prepaid;
						$in_cc					= $pibk_row->collect;
						$in_total				= $in_pp + $in_cc;

						#COST
						$cost_pml_charge 		= $pibk_row->other_charge_pml;
						$cost_pml_freight 		= $gw_total * 56;
						$cost_tata_hc			= $gw_hc * 192;
						$cost_tata_ftz			= ($gw_ftz * 16) + (640 * $gw_docftz);
						$cost_tata_charge 		= $pibk_row->other_charge_tata;
						$cost_total				= $cost_pml_charge + $cost_pml_freight + $cost_tata_hc + $cost_tata_ftz + $cost_tata_charge;

						$profit 				= $in_total - $cost_total;

						$debit_credit 			= ($profit/2) + $cost_pml_charge + $cost_pml_freight - $in_pp;


						$snow['host'][] = array(
								'date' 					=> '',
								'host' 					=> $pibk_row->hawb_no .' P.I.B.K',
								'gw_hc' 				=> $gw_hc,
								'gw_ftz' 				=> $gw_ftz,
								'gw_docftz'				=> $gw_docftz,
								'gw_total'				=> $gw_total,

								'in_pp' 				=> $in_pp,
								'in_cc'					=> $in_cc,
								'in_total'				=> $in_total,

								'cost_pml_charge' 		=> $cost_pml_charge,
								'cost_pml_freight' 		=> $cost_pml_freight,

								'cost_tata_hc'			=> $cost_tata_hc,
								'cost_tata_ftz'			=> $cost_tata_ftz,
								'cost_tata_charge' 		=> $cost_tata_charge,
								'cost_total'			=> $cost_total,

								'profit' 				=> $profit,
								'debit_credit'			=> $debit_credit
						);
					}
				}

				$get_from_other_country = $this->manifest_model->get_data_by_other_country($row->file_id,strtolower($row->flight_from));
				if($get_from_other_country) {
					foreach ($get_from_other_country as $key => $other_country_row) {
						#GW
						$gw_hc 					= $this->manifest_model->get_total_where_by_hawb('kg',$other_country_row->hawb_no,'mawb_type',array('hc'));
						$gw_ftz 				= $this->manifest_model->get_total_where_by_hawb('kg',$other_country_row->hawb_no,'mawb_type',array('ftz'));
						$gw_docftz				= $this->manifest_model->get_count_where_by_hawb($other_country_row->hawb_no,'mawb_type',array('ftz'));
						$gw_total				= $gw_hc + $gw_ftz;

						#INCOME
						$in_pp 					= $pibk_row->prepaid;
						$in_cc					= $pibk_row->collect;
						$in_total				= $in_pp + $in_cc;

						#COST
						$cost_pml_charge 		= $pibk_row->other_charge_pml;

						if(strtolower($other_country_row->country) == 'china') {
							if($gw_total <= 45) {
								$cost_pml_freight = $gw_total * 87;
							}
							if($gw_total > 45 && $gw_total <= 250) {
								$cost_pml_freight = $gw_total * 78;
							}
							if($gw_total > 250 && $gw_total <= 500) {
								$cost_pml_freight = $gw_total * 77;
							}
							if($gw_total > 500) {
								$cost_pml_freight = $gw_total * 76;
							}								
						} else {
							$cost_pml_freight 		= $gw_total * 56;
						}

						$cost_tata_hc			= $gw_hc * 192;
						$cost_tata_ftz			= ($gw_ftz * 16) + (640 * $gw_docftz);
						$cost_tata_charge 		= $pibk_row->other_charge_tata;
						$cost_total				= $cost_pml_charge + $cost_pml_freight + $cost_tata_hc + $cost_tata_ftz + $cost_tata_charge;

						$profit 				= $in_total - $cost_total;

						$debit_credit 			= ($profit/2) + $cost_pml_charge + $cost_pml_freight - $in_pp;


						$snow['host'][] = array(
								'date' 					=> '',
								'host' 					=> $other_country_row->hawb_no,
								'gw_hc' 				=> $gw_hc,
								'gw_ftz' 				=> $gw_ftz,
								'gw_docftz'				=> $gw_docftz,
								'gw_total'				=> $gw_total,

								'in_pp' 				=> $in_pp,
								'in_cc'					=> $in_cc,
								'in_total'				=> $in_total,

								'cost_pml_charge' 		=> $cost_pml_charge,
								'cost_pml_freight' 		=> $cost_pml_freight,

								'cost_tata_hc'			=> $cost_tata_hc,
								'cost_tata_ftz'			=> $cost_tata_ftz,
								'cost_tata_charge' 		=> $cost_tata_charge,
								'cost_total'			=> $cost_total,

								'profit' 				=> $profit,
								'debit_credit'			=> $debit_credit
						);
					}
				}
			}
		}
		$this->set_layout('report/snow_taiwan',$snow);
	}

	function snow_vietnam_jakarta() {
		$date = $_GET['date'];
		$get_file_id = $this->manifest_model->get_file_id_by_upload_date($date,'vietnam');

		$snow['host'] = array();

		if($get_file_id) {
			foreach ($get_file_id as $key => $row) {
					#GW
					$gw_hc 					= $this->manifest_model->get_total_where('kg',$row->file_id,'mawb_type',array('hc'),'vietnam');
					$gw_ftz 				= $this->manifest_model->get_total_where('kg',$row->file_id,'mawb_type',array('ftz'),'vietnam');
					$gw_docftz				= $this->manifest_model->get_count_where($row->file_id,'mawb_type',array('ftz'),'vietnam');
					$gw_total				= $gw_hc + $gw_ftz;

					#INCOME
					$in_pp 					= $this->manifest_model->get_total('prepaid',$row->file_id,'vietnam');
					$in_cc					= $this->manifest_model->get_total('collect',$row->file_id,'vietnam');
					$in_total				= $in_pp + $in_cc;

					#COST
					$cost_pml_charge 		= $this->manifest_model->get_total('other_charge_pml',$row->file_id,'vietnam');

					if($gw_total < 100) {
						$cost_pml_freight 		= $gw_total * (39 + 38);
					}
					if($gw_total >= 100 && $gw_total < 300) {
						$cost_pml_freight 		= $gw_total * (34 + 38);
					}
					if($gw_total >= 300 && $gw_total < 500) {
						$cost_pml_freight 		= $gw_total * (28 + 38);
					}
					if($gw_total >= 500) {
						$cost_pml_freight 		= $gw_total * (26 + 38);
					}

					$cost_tata_hc			= $gw_hc * 64;
					$cost_tata_ftz			= ($gw_ftz * 16) + (640 * $gw_docftz);
					$cost_tata_charge 		= $this->manifest_model->get_total('other_charge_tata',$row->file_id,'vietnam');
					$cost_tata_tpe	 		= $gw_total * (56 + 26);
					$cost_total				= $cost_pml_charge + $cost_pml_freight + $cost_tata_hc + $cost_tata_ftz + $cost_tata_charge;

					$profit 				= $in_total - $cost_total;

					$tata 					= ($in_cc) ? $profit * 0.4 + $cost_tata_hc + $cost_tata_ftz - $in_cc : $profit * 0.3 + $cost_tata_hc + $cost_tata_ftz - $in_cc;
					$lita 					= ($in_pp) ? $profit * 0.4 + $cost_pml_charge + $cost_pml_freight - $in_pp : $profit * 0.3 + $cost_pml_charge + $cost_pml_freight - $in_pp;
					$pml 					= $profit * 0.3 + $cost_tata_tpe;

					$snow['host'][] = array(
						'date' 					=> substr($row->created_date,0,10),
						'host' 					=> $row->mawb_no,
						'gw_hc' 				=> $gw_hc,
						'gw_ftz' 				=> $gw_ftz,
						'gw_docftz'				=> $gw_docftz,
						'gw_total'				=> $gw_total,

						'in_pp' 				=> $in_pp,
						'in_cc'					=> $in_cc,
						'in_total'				=> $in_total,

						'cost_pml_charge' 		=> $cost_pml_charge,
						'cost_pml_freight' 		=> $cost_pml_freight,

						'cost_tata_hc'			=> $cost_tata_hc,
						'cost_tata_ftz'			=> $cost_tata_ftz,
						'cost_tata_charge' 		=> $cost_tata_charge,
						'cost_tata_tpe'			=> $cost_tata_tpe,
						'cost_total'			=> $cost_total,

						'profit' 				=> $profit,

						'tata'					=> $tata,
						'lita'					=> $lita,
						'pml'					=> $pml
				);

				//Pouchen Fengtay
				$list_mawb_type = array('pouchen','fengtay');
				foreach ($list_mawb_type as $type) {
					if($this->manifest_model->get_manifest_by_mawb_type_and_file_id($row->file_id,$type,'vietnam')) {
						#GW
						$gw_hc 					= $this->manifest_model->get_total_where('kg',$row->file_id,'mawb_type',array($type . '_hc'),'vietnam');
						$gw_ftz 				= $this->manifest_model->get_total_where('kg',$row->file_id,'mawb_type',array($type . '_ftz'),'vietnam');
						$gw_docftz				= $this->manifest_model->get_count_where($row->file_id,'mawb_type',array($type . '_ftz'),'vietnam');
						$gw_total				= $gw_hc + $gw_ftz;

						#INCOME
						$in_pp 					= $this->manifest_model->get_total_where('prepaid',$row->file_id,'mawb_type',array($type . '_ftz',$type . '_hc'),'vietnam');
						$in_cc					= $this->manifest_model->get_total_where('collect',$row->file_id,'mawb_type',array($type . '_ftz',$type . '_hc'),'vietnam');
						$in_total				= $in_pp + $in_cc;

						#COST
						$cost_pml_charge 		= $this->manifest_model->get_total_where('other_charge_pml',$row->file_id,'mawb_type',array($type . '_ftz',$type . '_hc'),'vietnam');
						

						if($gw_total < 100) {
							$cost_pml_freight 		= $gw_total * (39 + 38);
						}
						if($gw_total >= 100 && $gw_total < 300) {
							$cost_pml_freight 		= $gw_total * (34 + 38);
						}
						if($gw_total >= 300 && $gw_total < 500) {
							$cost_pml_freight 		= $gw_total * (28 + 38);
						}
						if($gw_total >= 500) {
							$cost_pml_freight 		= $gw_total * (26 + 38);
						}


						$cost_tata_hc			= $gw_hc * 64;
						$cost_tata_ftz			= ($gw_ftz * 16) + (640 * $gw_docftz);
						$cost_tata_charge 		= $this->manifest_model->get_total_where('other_charge_tata',$row->file_id,'mawb_type',array($type . '_ftz',$type . '_hc'),'vietnam');
						$cost_tata_tpe	 		= $gw_total * (56 + 26);
						$cost_total				= $cost_pml_charge + $cost_pml_freight + $cost_tata_hc + $cost_tata_ftz + $cost_tata_charge;

						$profit 				= $in_total - $cost_total;

						$tata 					= ($in_cc) ? $profit * 0.4 + $cost_tata_hc + $cost_tata_ftz - $in_cc : $profit * 0.3 + $cost_tata_hc + $cost_tata_ftz - $in_cc;
						$lita 					= ($in_pp) ? $profit * 0.4 + $cost_pml_charge + $cost_pml_freight - $in_pp : $profit * 0.3 + $cost_pml_charge + $cost_pml_freight - $in_pp;
						$pml 					= $profit * 0.3 + $cost_tata_tpe;


						$snow['host'][] = array(
								'date' 					=> '',
								'host' 					=> ucwords($type),
								'gw_hc' 				=> $gw_hc,
								'gw_ftz' 				=> $gw_ftz,
								'gw_docftz'				=> $gw_docftz,
								'gw_total'				=> $gw_total,

								'in_pp' 				=> $in_pp,
								'in_cc'					=> $in_cc,
								'in_total'				=> $in_total,

								'cost_pml_charge' 		=> $cost_pml_charge,
								'cost_pml_freight' 		=> $cost_pml_freight,

								'cost_tata_hc'			=> $cost_tata_hc,
								'cost_tata_ftz'			=> $cost_tata_ftz,
								'cost_tata_charge' 		=> $cost_tata_charge,
								'cost_tata_tpe'			=> $cost_tata_tpe,
								'cost_total'			=> $cost_total,

								'profit' 				=> $profit,

								'tata'					=> $tata,
								'lita'					=> $lita,
								'pml'					=> $pml
						);
					}
				}

				//PIBK
				if($pibk_data = $this->manifest_model->get_manifest_by_mawb_type_and_file_id($row->file_id,'pibk','vietnam')) {
					foreach ($pibk_data as $key => $pibk_row) {
						#GW
						$gw_hc 					= $this->manifest_model->get_total_where_by_hawb('kg',$pibk_row->hawb_no,'mawb_type',array('pibk'),'vietnam');
						$gw_ftz 				= $this->manifest_model->get_total_where_by_hawb('kg',$pibk_row->hawb_no,'mawb_type',array(''),'vietnam');
						$gw_docftz				= $this->manifest_model->get_count_where_by_hawb($pibk_row->hawb_no,'mawb_type',array(''),'vietnam');
						$gw_total				= $gw_hc + $gw_ftz;

						#INCOME
						$in_pp 					= $pibk_row->prepaid;
						$in_cc					= $pibk_row->collect;
						$in_total				= $in_pp + $in_cc;

						#COST
						$cost_pml_charge 		= $pibk_row->other_charge_pml;

						if($gw_total < 100) {
							$cost_pml_freight 		= $gw_total * (39 + 38);
						}
						if($gw_total >= 100 && $gw_total < 300) {
							$cost_pml_freight 		= $gw_total * (34 + 38);
						}
						if($gw_total >= 300 && $gw_total < 500) {
							$cost_pml_freight 		= $gw_total * (28 + 38);
						}
						if($gw_total >= 500) {
							$cost_pml_freight 		= $gw_total * (26 + 38);
						}
						
						$cost_tata_hc			= $gw_hc * 64;
						$cost_tata_ftz			= ($gw_ftz * 16) + (640 * $gw_docftz);
						$cost_tata_charge 		= $pibk_row->other_charge_tata;
						$cost_tata_tpe	 		= $gw_total * (56 + 26);
						$cost_total				= $cost_pml_charge + $cost_pml_freight + $cost_tata_hc + $cost_tata_ftz + $cost_tata_charge;

						$profit 				= $in_total - $cost_total;

						$tata 					= ($in_cc) ? $profit * 0.4 + $cost_tata_hc + $cost_tata_ftz - $in_cc : $profit * 0.3 + $cost_tata_hc + $cost_tata_ftz - $in_cc;
						$lita 					= ($in_pp) ? $profit * 0.4 + $cost_pml_charge + $cost_pml_freight - $in_pp : $profit * 0.3 + $cost_pml_charge + $cost_pml_freight - $in_pp;
						$pml 					= $profit * 0.3 + $cost_tata_tpe;


						$snow['host'][] = array(
								'date' 					=> '',
								'host' 					=> $pibk_row->hawb_no .' P.I.B.K',
								'gw_hc' 				=> $gw_hc,
								'gw_ftz' 				=> $gw_ftz,
								'gw_docftz'				=> $gw_docftz,
								'gw_total'				=> $gw_total,

								'in_pp' 				=> $in_pp,
								'in_cc'					=> $in_cc,
								'in_total'				=> $in_total,

								'cost_pml_charge' 		=> $cost_pml_charge,
								'cost_pml_freight' 		=> $cost_pml_freight,

								'cost_tata_hc'			=> $cost_tata_hc,
								'cost_tata_ftz'			=> $cost_tata_ftz,
								'cost_tata_charge' 		=> $cost_tata_charge,
								'cost_tata_tpe'			=> $cost_tata_tpe,
								'cost_total'			=> $cost_total,

								'profit' 				=> $profit,

								'tata'					=> $tata,
								'lita'					=> $lita,
								'pml'					=> $pml
						);
					}
				}
			}
		}

		$data_on_other_manifest = $this->manifest_model->get_file_id_by_upload_date_and_country($date,'vietnam');
		if($data_on_other_manifest) {
			foreach ($data_on_other_manifest as $key => $other_manifest) {
				#GW
				$gw_hc 					= $this->manifest_model->get_total_where_by_hawb('kg',$other_manifest->hawb_no,'mawb_type',array('hc'),'vietnam');
				$gw_ftz 				= $this->manifest_model->get_total_where_by_hawb('kg',$other_manifest->hawb_no,'mawb_type',array('ftz'),'vietnam');
				$gw_docftz				= $this->manifest_model->get_count_where_by_hawb($other_manifest->hawb_no,'mawb_type',array('ftz'),'vietnam');
				$gw_total				= $gw_hc + $gw_ftz;

				#INCOME
				$in_pp 					= $other_manifest->prepaid;
				$in_cc					= $other_manifest->collect;
				$in_total				= $in_pp + $in_cc;

				#COST
				$cost_pml_charge 		= $other_manifest->other_charge_pml;
				$cost_pml_freight 		= $gw_total * (50 + 38);
				$cost_tata_hc			= $gw_hc * 64;
				$cost_tata_ftz			= ($gw_ftz * 16) + (640 * $gw_docftz);
				$cost_tata_charge 		= $other_manifest->other_charge_tata;
				$cost_tata_tpe	 		= $gw_total * (56 + 26);
				$cost_total				= $cost_pml_charge + $cost_pml_freight + $cost_tata_hc + $cost_tata_ftz + $cost_tata_charge;

				$profit 				= $in_total - $cost_total;

				$tata 					= ($in_cc) ? $profit * 0.4 + $cost_tata_hc + $cost_tata_ftz - $in_cc : $profit * 0.3 + $cost_tata_hc + $cost_tata_ftz - $in_cc;
				$lita 					= ($in_pp) ? $profit * 0.4 + $cost_pml_charge + $cost_pml_freight - $in_pp : $profit * 0.3 + $cost_pml_charge + $cost_pml_freight - $in_pp;
				$pml 					= $profit * 0.3 + $cost_tata_tpe;


				$snow['host'][] = array(
						'date' 					=> '',
						'host' 					=> $other_manifest->hawb_no,
						'gw_hc' 				=> $gw_hc,
						'gw_ftz' 				=> $gw_ftz,
						'gw_docftz'				=> $gw_docftz,
						'gw_total'				=> $gw_total,

						'in_pp' 				=> $in_pp,
						'in_cc'					=> $in_cc,
						'in_total'				=> $in_total,

						'cost_pml_charge' 		=> $cost_pml_charge,
						'cost_pml_freight' 		=> $cost_pml_freight,

						'cost_tata_hc'			=> $cost_tata_hc,
						'cost_tata_ftz'			=> $cost_tata_ftz,
						'cost_tata_charge' 		=> $cost_tata_charge,
						'cost_tata_tpe'			=> $cost_tata_tpe,
						'cost_total'			=> $cost_total,

						'profit' 				=> $profit,

						'tata'					=> $tata,
						'lita'					=> $lita,
						'pml'					=> $pml
				);
			}
		}
		$this->set_layout('report/snow_vietnam',$snow);
	}

	function snow_jakarta_taiwan(){
		$date = $_GET['date'];
		$snow['host'] = array();


		$get_manifest = $this->manifest_model->get_snow_jakarta_to_country_by_upload_date($date,'taiwan');
		if($get_manifest) {
			foreach ($get_manifest as $key => $row) {
				$snow_jakarta_taiwan = $this->manifest_model->get_snow_local_from_to($row->file_id,'jakarta','taiwan');
				if($snow_jakarta_taiwan) {
					$gw_selling 		= $this->manifest_model->snow_local_get_total_where($row->file_id,'jakarta','taiwan','kg');
					$gw_mawb    		= $this->manifest_model->snow_local_get_total_where($row->file_id,'jakarta','taiwan','kg');
					$in_pp 				= $this->manifest_model->snow_local_get_total_where($row->file_id,'jakarta','taiwan','prepaid');
					$in_cc 				= $this->manifest_model->snow_local_get_total_where($row->file_id,'jakarta','taiwan','collect');
					$in_total			= $in_pp + $in_cc;

					$cost_tata_charge	= $this->manifest_model->snow_local_get_total_where($row->file_id,'jakarta','taiwan','other_charge_tata');				
					$cost_tata_freight	= $gw_mawb * 96;
					$cost_pml_handling 	= $gw_mawb * 20;
					$cost_pml_charge	= $this->manifest_model->snow_local_get_total_where($row->file_id,'jakarta','taiwan','other_charge_pml');
					$cost_total			= $cost_tata_charge + $cost_tata_freight + $cost_pml_handling + $cost_pml_charge;

					$profit 			= $in_total - $cost_total;
					$credit_to_ths 		= $profit/2 + $cost_tata_freight + $cost_tata_charge - $in_pp;
					$credit_to_pml 		= $profit/2 + $cost_pml_handling + $cost_pml_charge - $in_cc;

					$acu_total_cc 		= 0;
					$acu_cost			= 0;
					$acu_refund			= $acu_total_cc - $acu_cost;

					$snow['host'][]		= array(
						'snow_type'			=> 'jkt_tw',
						'date'				=> substr($row->created_date,0,10),
						'host'				=> $row->mawb_no,
						'gw_selling' 		=> $gw_selling,
						'gw_mawb' 			=> $gw_mawb,
						'in_pp' 			=> $in_pp,
						'in_cc' 			=> $in_cc,
						'in_total' 			=> $in_total,
						'cost_tata_charge' 	=> $cost_tata_charge,
						'cost_tata_freight' => $cost_tata_freight,
						'cost_pml_handling' => $cost_pml_handling,
						'cost_pml_charge' 	=> $cost_pml_charge,
						'cost_total' 		=> $cost_total,
						'profit' 			=> $profit,
						'credit_to_ths' 	=> $credit_to_ths,
						'credit_to_pml' 	=> $credit_to_pml,
						'acu_total_cc' 		=> $acu_total_cc,
						'acu_cost' 			=> $acu_cost,
						'acu_refund' 		=> $acu_refund
						);
				}
				$snow_jakarta_hongkong = $this->manifest_model->get_snow_local_from_to($row->file_id,'jakarta','hongkong');
				if($snow_jakarta_hongkong) {
					$gw_selling 		= $this->manifest_model->snow_local_get_total_where($row->file_id,'jakarta','hongkong','kg');
					$gw_mawb    		= $this->manifest_model->snow_local_get_total_where($row->file_id,'jakarta','hongkong','kg');
					$in_pp 				= $this->manifest_model->snow_local_get_total_where($row->file_id,'jakarta','hongkong','prepaid');
					$in_cc 				= $this->manifest_model->snow_local_get_total_where($row->file_id,'jakarta','hongkong','collect');
					$in_total			= $in_pp + $in_cc;

					$cost_tata_charge	= $this->manifest_model->snow_local_get_total_where($row->file_id,'jakarta','hongkong','other_charge_tata');				
					$cost_tata_freight	= $gw_mawb * 96;
					$cost_pml_handling 	= $gw_mawb * 20;
					$cost_pml_charge	= $this->manifest_model->snow_local_get_total_where($row->file_id,'jakarta','hongkong','other_charge_pml');
					$cost_total			= $cost_tata_charge + $cost_tata_freight + $cost_pml_handling + $cost_pml_charge;

					$profit 			= $in_total - $cost_total;
					$credit_to_ths 		= $profit/2 + $cost_tata_freight + $cost_tata_charge - $in_pp;
					$credit_to_pml 		= $profit/2 + $cost_pml_handling + $cost_pml_charge - $in_cc;

					$acu_total_cc 		= 0;
					$acu_cost			= 0;
					$acu_refund			= $acu_total_cc - $acu_cost;

					$snow['host'][]		= array(
						'snow_type'			=> 'jkt_hkg',
						'date'				=> '',
						'host'				=> 'JKT - HKG',
						'gw_selling' 		=> $gw_selling,
						'gw_mawb' 			=> $gw_mawb,
						'in_pp' 			=> $in_pp,
						'in_cc' 			=> $in_cc,
						'in_total' 			=> $in_total,
						'cost_tata_charge' 	=> $cost_tata_charge,
						'cost_tata_freight' => $cost_tata_freight,
						'cost_pml_handling' => $cost_pml_handling,
						'cost_pml_charge' 	=> $cost_pml_charge,
						'cost_total' 		=> $cost_total,
						'profit' 			=> $profit,
						'credit_to_ths' 	=> $credit_to_ths,
						'credit_to_pml' 	=> $credit_to_pml,
						'acu_total_cc' 		=> $acu_total_cc,
						'acu_cost' 			=> $acu_cost,
						'acu_refund' 		=> $acu_refund
						);
				}
				$snow_jakarta_china = $this->manifest_model->get_snow_local_from_to($row->file_id,'jakarta','china');
				if($snow_jakarta_china) {
					$gw_selling 		= $this->manifest_model->snow_local_get_total_where($row->file_id,'jakarta','china','kg');
					$gw_mawb    		= $this->manifest_model->snow_local_get_total_where($row->file_id,'jakarta','china','kg');
					$in_pp 				= $this->manifest_model->snow_local_get_total_where($row->file_id,'jakarta','china','prepaid');
					$in_cc 				= $this->manifest_model->snow_local_get_total_where($row->file_id,'jakarta','china','collect');
					$in_total			= $in_pp + $in_cc;

					$cost_tata_charge	= $this->manifest_model->snow_local_get_total_where($row->file_id,'jakarta','china','other_charge_tata');				
					$cost_tata_freight	= $gw_mawb * 96;
					$cost_pml_handling 	= $gw_mawb * 20;
					$cost_pml_charge	= $this->manifest_model->snow_local_get_total_where($row->file_id,'jakarta','china','other_charge_pml');
					$cost_total			= $cost_tata_charge + $cost_tata_freight + $cost_pml_handling + $cost_pml_charge;

					$profit 			= $in_total - $cost_total;
					$credit_to_ths 		= $profit/2 + $cost_tata_freight + $cost_tata_charge - $in_pp;
					$credit_to_pml 		= $profit/2 + $cost_pml_handling + $cost_pml_charge - $in_cc;

					$acu_total_cc 		= 0;
					$acu_cost			= 0;
					$acu_refund			= $acu_total_cc - $acu_cost;

					$snow['host'][]		= array(
						'snow_type'			=> 'jkt_chn',
						'date'				=> '',
						'host'				=> 'JKT - CHN',
						'gw_selling' 		=> $gw_selling,
						'gw_mawb' 			=> $gw_mawb,
						'in_pp' 			=> $in_pp,
						'in_cc' 			=> $in_cc,
						'in_total' 			=> $in_total,
						'cost_tata_charge' 	=> $cost_tata_charge,
						'cost_tata_freight' => $cost_tata_freight,
						'cost_pml_handling' => $cost_pml_handling,
						'cost_pml_charge' 	=> $cost_pml_charge,
						'cost_total' 		=> $cost_total,
						'profit' 			=> $profit,
						'credit_to_ths' 	=> $credit_to_ths,
						'credit_to_pml' 	=> $credit_to_pml,
						'acu_total_cc' 		=> $acu_total_cc,
						'acu_cost' 			=> $acu_cost,
						'acu_refund' 		=> $acu_refund
						);
				}

				$snow_surabaya_taiwan = $this->manifest_model->get_snow_local_from_to($row->file_id,'surabaya','taiwan');
				if($snow_surabaya_taiwan) {
					$gw_selling 		= $this->manifest_model->snow_local_get_total_where($row->file_id,'surabaya','taiwan','kg');
					$gw_mawb    		= $this->manifest_model->snow_local_get_total_where($row->file_id,'surabaya','taiwan','kg');
					$in_pp 				= $this->manifest_model->snow_local_get_total_where($row->file_id,'surabaya','taiwan','prepaid');
					$in_cc 				= $this->manifest_model->snow_local_get_total_where($row->file_id,'surabaya','taiwan','collect');
					$in_total			= $in_pp + $in_cc;

					$cost_tata_charge	= $this->manifest_model->snow_local_get_total_where($row->file_id,'surabaya','taiwan','other_charge_tata');				
					$cost_tata_freight	= $gw_mawb * 96;
					$cost_pml_handling 	= $gw_mawb * 20;
					$cost_pml_charge	= $this->manifest_model->snow_local_get_total_where($row->file_id,'surabaya','taiwan','other_charge_pml');
					$cost_total			= $cost_tata_charge + $cost_tata_freight + $cost_pml_handling + $cost_pml_charge;

					$profit 			= $in_total - $cost_total;
					$credit_to_ths 		= $profit/2 + $cost_tata_freight + $cost_tata_charge - $in_pp;
					$credit_to_pml 		= $profit/2 + $cost_pml_handling + $cost_pml_charge - $in_cc;

					$total_kg_cc		= $this->manifest_model->snow_local_get_total_where_on_collect($row->file_id,'surabaya','taiwan','kg');

					$acu_total_cc 		= $total_kg_cc * 260;
					$acu_cost			= $total_kg_cc * 210;
					$acu_refund			= $acu_total_cc - $acu_cost;

					$snow['host'][]		= array(
						'snow_type'			=> 'sub_tw',
						'date'				=> '',
						'host'				=> 'SUB - TW',
						'gw_selling' 		=> $gw_selling,
						'gw_mawb' 			=> $gw_mawb,
						'in_pp' 			=> $in_pp,
						'in_cc' 			=> $in_cc,
						'in_total' 			=> $in_total,
						'cost_tata_charge' 	=> $cost_tata_charge,
						'cost_tata_freight' => $cost_tata_freight,
						'cost_pml_handling' => $cost_pml_handling,
						'cost_pml_charge' 	=> $cost_pml_charge,
						'cost_total' 		=> $cost_total,
						'profit' 			=> $profit,
						'credit_to_ths' 	=> $credit_to_ths,
						'credit_to_pml' 	=> $credit_to_pml,
						'acu_total_cc' 		=> $acu_total_cc,
						'acu_cost' 			=> $acu_cost,
						'acu_refund' 		=> $acu_refund
						);
				}
				$snow_surabaya_hongkong = $this->manifest_model->get_snow_local_from_to($row->file_id,'surabaya','hongkong');
				if($snow_surabaya_hongkong) {
					$gw_selling 		= $this->manifest_model->snow_local_get_total_where($row->file_id,'surabaya','hongkong','kg');
					$gw_mawb    		= $this->manifest_model->snow_local_get_total_where($row->file_id,'surabaya','hongkong','kg');
					$in_pp 				= $this->manifest_model->snow_local_get_total_where($row->file_id,'surabaya','hongkong','prepaid');
					$in_cc 				= $this->manifest_model->snow_local_get_total_where($row->file_id,'surabaya','hongkong','collect');
					$in_total			= $in_pp + $in_cc;

					$cost_tata_charge	= $this->manifest_model->snow_local_get_total_where($row->file_id,'surabaya','hongkong','other_charge_tata');				
					$cost_tata_freight	= $gw_mawb * 96;
					$cost_pml_handling 	= $gw_mawb * (20+55);
					$cost_pml_charge	= $this->manifest_model->snow_local_get_total_where($row->file_id,'surabaya','hongkong','other_charge_pml');
					$cost_total			= $cost_tata_charge + $cost_tata_freight + $cost_pml_handling + $cost_pml_charge;

					$profit 			= $in_total - $cost_total;
					$credit_to_ths 		= $profit/2 + $cost_tata_freight + $cost_tata_charge - $in_pp;
					$credit_to_pml 		= $profit/2 + $cost_pml_handling + $cost_pml_charge - $in_cc;

					$total_kg_cc		= $this->manifest_model->snow_local_get_total_where_on_collect($row->file_id,'surabaya','hongkong','kg');

					$acu_total_cc 		= ($total_kg_cc > 1) ? (($total_kg_cc-1) * 450) + 850 : 0;
					$acu_cost			= ($total_kg_cc > 1) ? (($total_kg_cc-1) * 400) + 800 : 0;
					$acu_refund			= $acu_total_cc - $acu_cost;

					$snow['host'][]		= array(
						'snow_type'			=> 'sub_hkg',
						'date'				=> '',
						'host'				=> 'SUB - HKG',
						'gw_selling' 		=> $gw_selling,
						'gw_mawb' 			=> $gw_mawb,
						'in_pp' 			=> $in_pp,
						'in_cc' 			=> $in_cc,
						'in_total' 			=> $in_total,
						'cost_tata_charge' 	=> $cost_tata_charge,
						'cost_tata_freight' => $cost_tata_freight,
						'cost_pml_handling' => $cost_pml_handling,
						'cost_pml_charge' 	=> $cost_pml_charge,
						'cost_total' 		=> $cost_total,
						'profit' 			=> $profit,
						'credit_to_ths' 	=> $credit_to_ths,
						'credit_to_pml' 	=> $credit_to_pml,
						'acu_total_cc' 		=> $acu_total_cc,
						'acu_cost' 			=> $acu_cost,
						'acu_refund' 		=> $acu_refund
						);
				}
				$snow_surabaya_china = $this->manifest_model->get_snow_local_from_to($row->file_id,'surabaya','china');
				if($snow_surabaya_china) {
					$gw_selling 		= $this->manifest_model->snow_local_get_total_where($row->file_id,'surabaya','china','kg');
					$gw_mawb    		= $this->manifest_model->snow_local_get_total_where($row->file_id,'surabaya','china','kg');;
					$in_pp 				= $this->manifest_model->snow_local_get_total_where($row->file_id,'surabaya','china','prepaid');
					$in_cc 				= $this->manifest_model->snow_local_get_total_where($row->file_id,'surabaya','china','collect');
					$in_total			= $in_pp + $in_cc;

					$cost_tata_charge	= $this->manifest_model->snow_local_get_total_where($row->file_id,'surabaya','china','other_charge_tata');				
					$cost_tata_freight	= $gw_mawb * 96;
					$cost_pml_handling 	= $gw_mawb * (20+92);
					$cost_pml_charge	= $this->manifest_model->snow_local_get_total_where($row->file_id,'surabaya','china','other_charge_pml');
					$cost_total			= $cost_tata_charge + $cost_tata_freight + $cost_pml_handling + $cost_pml_charge;

					$profit 			= $in_total - $cost_total;
					$credit_to_ths 		= $profit/2 + $cost_tata_freight + $cost_tata_charge - $in_pp;
					$credit_to_pml 		= $profit/2 + $cost_pml_handling + $cost_pml_charge - $in_cc;

					$total_kg_cc		= $this->manifest_model->snow_local_get_total_where_on_collect($row->file_id,'surabaya','china','kg');

					$acu_total_cc 		= ($total_kg_cc > 1) ? (($total_kg_cc-1) * 450) + 850 : 0;
					$acu_cost			= ($total_kg_cc > 1) ? (($total_kg_cc-1) * 400) + 800 : 0;
					$acu_refund			= $acu_total_cc - $acu_cost;

					$snow['host'][]		= array(
						'snow_type'			=> 'sub_chn',
						'date'				=> '',
						'host'				=> 'SUB - CHN',
						'gw_selling' 		=> $gw_selling,
						'gw_mawb' 			=> $gw_mawb,
						'in_pp' 			=> $in_pp,
						'in_cc' 			=> $in_cc,
						'in_total' 			=> $in_total,
						'cost_tata_charge' 	=> $cost_tata_charge,
						'cost_tata_freight' => $cost_tata_freight,
						'cost_pml_handling' => $cost_pml_handling,
						'cost_pml_charge' 	=> $cost_pml_charge,
						'cost_total' 		=> $cost_total,
						'profit' 			=> $profit,
						'credit_to_ths' 	=> $credit_to_ths,
						'credit_to_pml' 	=> $credit_to_pml,
						'acu_total_cc' 		=> $acu_total_cc,
						'acu_cost' 			=> $acu_cost,
						'acu_refund' 		=> $acu_refund
						);
				}
			}
		}


		$this->set_layout('report/snow_jakarta_taiwan',$snow);
	}

	function snow_jakarta_vietnam(){
		$date = $_GET['date'];
		$snow['host'] = array();


		$get_manifest = $this->manifest_model->get_snow_jakarta_to_country_by_upload_date($date,'vietnam');
		if($get_manifest) {
			foreach ($get_manifest as $key => $row) {
				$snow_jakarta_vietnam = $this->manifest_model->get_snow_local_from_to($row->file_id,'jakarta','vietnam');
				if($snow_jakarta_vietnam) {
					$gw_selling 		= $this->manifest_model->snow_local_get_total_where($row->file_id,'jakarta','vietnam','kg');
					$gw_mawb    		= $this->manifest_model->snow_local_get_total_where($row->file_id,'jakarta','vietnam','kg');
					$in_pp 				= $this->manifest_model->snow_local_get_total_where($row->file_id,'jakarta','vietnam','prepaid');
					$in_cc 				= $this->manifest_model->snow_local_get_total_where($row->file_id,'jakarta','vietnam','collect');
					$in_total			= $in_pp + $in_cc;

					$cost_tata_tpe		= $gw_mawb * (26+52);				
					$cost_tata_charge	= $this->manifest_model->snow_local_get_total_where($row->file_id,'jakarta','vietnam','other_charge_tata');				
					$cost_tata_freight	= $gw_mawb * (64+33);
					$cost_pml_handling 	= $gw_mawb * 64;
					$cost_pml_charge	= $this->manifest_model->snow_local_get_total_where($row->file_id,'jakarta','vietnam','other_charge_pml');
					$cost_total			= $cost_tata_charge + $cost_tata_freight + $cost_pml_handling + $cost_pml_charge;

					$profit 			= $in_total - $cost_total;

					$tata 				= ($in_pp) ? ($profit * 0.4) + ($cost_tata_freight + $cost_tata_charge) - $in_pp : ($profit * 0.3) + ($cost_tata_freight + $cost_tata_charge) - $in_pp;
					$lita 				= ($in_cc) ? ($profit * 0.4) + ($cost_pml_handling + $cost_pml_charge) - $in_cc : ($profit * 0.3) + ($cost_pml_handling + $cost_pml_charge) - $in_cc;
					$pml 				= $profit * 0.3 + $cost_tata_tpe;

					$acu_total_cc 		= 0;
					$acu_cost			= 0;
					$acu_refund			= $acu_total_cc - $acu_cost;

					$snow['host'][]		= array(
						'snow_type'			=> 'jkt_vn',
						'date'				=> substr($row->created_date,0,10),
						'host'				=> $row->mawb_no,
						'gw_selling' 		=> $gw_selling,
						'gw_mawb' 			=> $gw_mawb,
						'in_pp' 			=> $in_pp,
						'in_cc' 			=> $in_cc,
						'in_total' 			=> $in_total,
						'cost_tata_tpe' 	=> $cost_tata_tpe,
						'cost_tata_charge' 	=> $cost_tata_charge,
						'cost_tata_freight' => $cost_tata_freight,
						'cost_pml_handling' => $cost_pml_handling,
						'cost_pml_charge' 	=> $cost_pml_charge,
						'cost_total' 		=> $cost_total,
						'profit' 			=> $profit,
						'tata' 				=> $tata,
						'lita' 				=> $lita,
						'pml' 				=> $pml,
						'acu_total_cc' 		=> $acu_total_cc,
						'acu_cost' 			=> $acu_cost,
						'acu_refund' 		=> $acu_refund
						);
				}

				$snow_surabaya_vietnam = $this->manifest_model->get_snow_local_from_to($row->file_id,'surabaya','vietnam');
				if($snow_surabaya_vietnam) {
					$gw_selling 		= $this->manifest_model->snow_local_get_total_where($row->file_id,'surabaya','vietnam','kg');
					$gw_mawb    		= $this->manifest_model->snow_local_get_total_where($row->file_id,'surabaya','vietnam','kg');
					$in_pp 				= $this->manifest_model->snow_local_get_total_where($row->file_id,'surabaya','vietnam','prepaid');
					$in_cc 				= $this->manifest_model->snow_local_get_total_where($row->file_id,'surabaya','vietnam','collect');
					$in_total			= $in_pp + $in_cc;

					$cost_tata_tpe		= $gw_mawb * (26+52);				
					$cost_tata_charge	= $this->manifest_model->snow_local_get_total_where($row->file_id,'surabaya','vietnam','other_charge_tata');				
					$cost_tata_freight	= $gw_mawb * (64+33);
					$cost_pml_handling 	= $gw_mawb * 64;
					$cost_pml_charge	= $this->manifest_model->snow_local_get_total_where($row->file_id,'surabaya','vietnam','other_charge_pml');
					$cost_total			= $cost_tata_charge + $cost_tata_freight + $cost_pml_handling + $cost_pml_charge;

					$profit 			= $in_total - $cost_total;

					$tata 				= ($in_pp) ? ($profit * 0.4) + ($cost_tata_freight + $cost_tata_charge) - $in_pp : ($profit * 0.3) + ($cost_tata_freight + $cost_tata_charge) - $in_pp;
					$lita 				= ($in_cc) ? ($profit * 0.4) + ($cost_pml_handling + $cost_pml_charge) - $in_cc : ($profit * 0.3) + ($cost_pml_handling + $cost_pml_charge) - $in_cc;
					$pml 				= $profit * 0.3 + $cost_tata_tpe;

					$total_kg_cc		= $this->manifest_model->snow_local_get_total_where_on_collect($row->file_id,'surabaya','vietnam','kg');

					$acu_total_cc 		= $total_kg_cc * 400;
					$acu_cost			= $total_kg_cc * 350;
					$acu_refund			= $acu_total_cc - $acu_cost;

					$snow['host'][]		= array(
						'snow_type'			=> 'sub_vn',
						'date'				=> '',
						'host'				=> 'SUB - VN',
						'gw_selling' 		=> $gw_selling,
						'gw_mawb' 			=> $gw_mawb,
						'in_pp' 			=> $in_pp,
						'in_cc' 			=> $in_cc,
						'in_total' 			=> $in_total,
						'cost_tata_tpe' 	=> $cost_tata_tpe,
						'cost_tata_charge' 	=> $cost_tata_charge,
						'cost_tata_freight' => $cost_tata_freight,
						'cost_pml_handling' => $cost_pml_handling,
						'cost_pml_charge' 	=> $cost_pml_charge,
						'cost_total' 		=> $cost_total,
						'profit' 			=> $profit,
						'tata' 				=> $tata,
						'lita' 				=> $lita,
						'pml' 				=> $pml,
						'acu_total_cc' 		=> $acu_total_cc,
						'acu_cost' 			=> $acu_cost,
						'acu_refund' 		=> $acu_refund
						);
				}
			}
		}


		$this->set_layout('report/snow_jakarta_vietnam',$snow);
	}

	function calc(){
		$host = $_POST['snow'];
		switch ($host) {
			case 'taiwan':
				$mawb_host = $_POST['host'];
				$get_data_from = $this->manifest_model->get_hawb_from($mawb_host);

				#GW
				$gw_hc 					= $_POST['gw_hc'];
				$gw_ftz 				= $_POST['gw_ftz'];
				$gw_docftz				= $_POST['gw_docftz'];
				$gw_total				= $gw_hc + $gw_ftz;

				#INCOME
				$in_pp 					= $_POST['in_pp'];
				$in_cc					= $_POST['in_cc'];
				$in_total				= $in_pp + $in_cc;

				#COST
				$cost_pml_charge 		= $_POST['cost_pml_charge'];

				if($get_data_from) {
					if(strtolower($get_data_from->country) == 'china') {
						if($gw_total <= 45) {
							$cost_pml_freight = $gw_total * 87;
						}
						if($gw_total > 45 && $gw_total <= 250) {
							$cost_pml_freight = $gw_total * 78;
						}
						if($gw_total > 250 && $gw_total <= 500) {
							$cost_pml_freight = $gw_total * 77;
						}
						if($gw_total > 500) {
							$cost_pml_freight = $gw_total * 76;
						}								
					} else {
						$cost_pml_freight 		= $gw_total * 56;
					}
				} else {
					$cost_pml_freight 		= $gw_total * 56;
				}
				
				$cost_tata_hc			= $gw_hc * 192;
				$cost_tata_ftz			= ($gw_ftz * 16) + (640 * $gw_docftz);
				$cost_tata_charge 		= $_POST['cost_tata_charge'];
				$cost_total				= $cost_pml_charge + $cost_pml_freight + $cost_tata_hc + $cost_tata_ftz + $cost_tata_charge;

				$profit 				= $in_total - $cost_total;

				$profit_split			= (trim($_POST['host'],'<br>') == 'pouchen') ? 3 : 2;

				$debit_credit 			= ($profit/$profit_split) + $cost_pml_charge + $cost_pml_freight - $in_pp;


				$snow = array(
					'date' 					=> '',
					'host' 					=> $mawb_host,
					'gw_hc' 				=> $gw_hc,
					'gw_ftz' 				=> $gw_ftz,
					'gw_docftz'				=> $gw_docftz,
					'gw_total'				=> $gw_total,

					'in_pp' 				=> $in_pp,
					'in_cc'					=> $in_cc,
					'in_total'				=> $in_total,

					'cost_pml_charge' 		=> $cost_pml_charge,
					'cost_pml_freight' 		=> $cost_pml_freight,

					'cost_tata_hc'			=> $cost_tata_hc,
					'cost_tata_ftz'			=> $cost_tata_ftz,
					'cost_tata_charge' 		=> $cost_tata_charge,
					'cost_total'			=> $cost_total,

					'profit' 				=> $profit,
					'debit_credit'			=> $debit_credit
				);				
				echo json_encode($snow);
			break;

			case 'vietnam':
				#GW
				$mawb_host = $_POST['host'];
				$get_data_from = $this->manifest_model->get_hawb_from($mawb_host);

				$gw_hc 					= $_POST['gw_hc'];
				$gw_ftz 				= $_POST['gw_ftz'];
				$gw_docftz				= $_POST['gw_docftz'];
				$gw_total				= $gw_hc + $gw_ftz;

				#INCOME
				$in_pp 					= $_POST['in_pp'];
				$in_cc					= $_POST['in_cc'];
				$in_total				= $in_pp + $in_cc;

				#COST
				$cost_pml_charge 		= $_POST['cost_pml_charge'];

				if($get_data_from) {
					$cost_pml_freight 		= $gw_total * (50 + 38);
				} else {
					if($gw_total < 100) {
						$cost_pml_freight 		= $gw_total * (39 + 38);
					}
					if($gw_total >= 100 && $gw_total < 300) {
						$cost_pml_freight 		= $gw_total * (34 + 38);
					}
					if($gw_total >= 300 && $gw_total < 500) {
						$cost_pml_freight 		= $gw_total * (28 + 38);
					}
					if($gw_total >= 500) {
						$cost_pml_freight 		= $gw_total * (26 + 38);
					}
				}

				$cost_tata_hc			= $gw_hc * 64;
				$cost_tata_ftz			= ($gw_ftz * 16) + (640 * $gw_docftz);
				$cost_tata_charge 		= $_POST['cost_tata_charge'];
				$cost_tata_tpe	 		= $gw_total * (56 + 26);
				$cost_total				= $cost_pml_charge + $cost_pml_freight + $cost_tata_hc + $cost_tata_ftz + $cost_tata_charge;

				$profit 				= $in_total - $cost_total;

				$tata 					= ($in_cc) ? $profit * 0.4 + $cost_tata_hc + $cost_tata_ftz - $in_cc : $profit * 0.3 + $cost_tata_hc + $cost_tata_ftz - $in_cc;
				$lita 					= ($in_pp) ? $profit * 0.4 + $cost_pml_charge + $cost_pml_freight - $in_pp : $profit * 0.3 + $cost_pml_charge + $cost_pml_freight - $in_pp;
				$pml 					= $profit * 0.3 + $cost_tata_tpe;

				$snow = array(
					'date' 					=> '',
					'host' 					=> $mawb_host,
					'gw_hc' 				=> $gw_hc,
					'gw_ftz' 				=> $gw_ftz,
					'gw_docftz'				=> $gw_docftz,
					'gw_total'				=> $gw_total,

					'in_pp' 				=> $in_pp,
					'in_cc'					=> $in_cc,
					'in_total'				=> $in_total,

					'cost_pml_charge' 		=> $cost_pml_charge,
					'cost_pml_freight' 		=> $cost_pml_freight,

					'cost_tata_hc'			=> $cost_tata_hc,
					'cost_tata_ftz'			=> $cost_tata_ftz,
					'cost_tata_charge' 		=> $cost_tata_charge,
					'cost_tata_tpe'			=> $cost_tata_tpe,
					'cost_total'			=> $cost_total,

					'profit' 				=> $profit,

					'tata'					=> $tata,
					'lita'					=> $lita,
					'pml'					=> $pml
			);
			echo json_encode($snow);
			break;

			case 'jakarta_taiwan':
				$snow_type = $_POST['snow_type'];
				switch ($snow_type) {
					default:
						$gw_mawb    		= $_POST['gw_mawb'];
						$in_pp 				= $_POST['in_pp'];
						$in_cc 				= $_POST['in_cc'];
						$in_total			= $in_pp + $in_cc;

						$cost_tata_charge	= $_POST['cost_tata_charge'];
						$cost_tata_freight	= $gw_mawb * 96;
						
						if($snow_type == 'sub_chn') {
							$cost_pml_handling 	= $gw_mawb * (20+92);
						} else if($snow_type == 'sub_hkg') {
							$cost_pml_handling 	= $gw_mawb * (20+55);
						} else {
							$cost_pml_handling 	= $gw_mawb * 20;
						}

						$cost_pml_charge	= $_POST['cost_pml_charge'];
						$cost_total			= $cost_tata_charge + $cost_tata_freight + $cost_pml_handling + $cost_pml_charge;

						$profit 			= $in_total - $cost_total;
						$credit_to_ths 		= $profit/2 + $cost_tata_freight + $cost_tata_charge - $in_pp;
						$credit_to_pml 		= $profit/2 + $cost_pml_handling + $cost_pml_charge - $in_cc;
						$snow		= array(
							'in_total' 			=> $in_total,
							'cost_tata_freight' => $cost_tata_freight,
							'cost_pml_handling' => $cost_pml_handling,
							'cost_total' 		=> $cost_total,
							'profit' 			=> $profit,
							'credit_to_ths' 	=> $credit_to_ths,
							'credit_to_pml' 	=> $credit_to_pml
							);
						echo json_encode($snow);
					break;
				}
			break;

			case 'jakarta_vietnam':
				$snow_type = $_POST['snow_type'];
				switch ($snow_type) {
					default:
						$gw_mawb    		= $_POST['gw_mawb'];
						$in_pp 				= $_POST['in_pp'];
						$in_cc 				= $_POST['in_cc'];
						$in_total			= $in_pp + $in_cc;

						$cost_tata_tpe		= $gw_mawb * (26+52);				
						$cost_tata_charge	= $_POST['cost_tata_charge'];
						$cost_tata_freight	= $gw_mawb * (64+33);
						$cost_pml_handling 	= $gw_mawb * 64;
						$cost_pml_charge	= $_POST['cost_tata_charge'];
						$cost_total			= $cost_tata_charge + $cost_tata_freight + $cost_pml_handling + $cost_pml_charge;

						$profit 			= $in_total - $cost_total;

						$tata 				= ($in_pp) ? ($profit * 0.4) + ($cost_tata_freight + $cost_tata_charge) - $in_pp : ($profit * 0.3) + ($cost_tata_freight + $cost_tata_charge) - $in_pp;
						$lita 				= ($in_cc) ? ($profit * 0.4) + ($cost_pml_handling + $cost_pml_charge) - $in_cc : ($profit * 0.3) + ($cost_pml_handling + $cost_pml_charge) - $in_cc;
						$pml 				= $profit * 0.3 + $cost_tata_tpe;
						$snow		= array(
							'in_total' 			=> $in_total,
							'cost_tata_tpe' 	=> $cost_tata_tpe,
							'cost_tata_freight' => $cost_tata_freight,
							'cost_pml_handling' => $cost_pml_handling,
							'cost_total' 		=> $cost_total,
							'profit' 			=> $profit,
							'tata'	 			=> $tata,
							'lita'	 			=> $lita,
							'pml' 				=> $pml
							);
						echo json_encode($snow);
					break;
				}
			break;
		}
	}

	function formula($formula){
		switch ($formula) {
			case 'sum':
				$val = $_POST['val'];
				$sum = 0;
				foreach ($val as $row) { $sum += $row; }
				echo $sum;
				break;
			
			default:
				echo 'Error';
				break;
		}
	}
}

?>