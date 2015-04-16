<?php

class Download extends MY_Controller {
	
	function __construct(){
		parent::__construct();
	}

	public function pdf() {
		$name = md5(time());
		$file_path = PATH_PDF . $name . '.pdf';

		if(file_exists($file_path) == FALSE) {
			$this->load->library('pdf');
			$pdf = $this->pdf->load();

			$hawb_no = $_GET['hawb_no'];

			if(!$this->manifest_model->check_available_invoice($hawb_no)){
				$this->manifest_model->create_invoice($hawb_no);
			}

			$data['details'] = $this->manifest_model->get_last_invoice($hawb_no);
			$data['extra_charge'] = $this->manifest_model->get_extra_charge($hawb_no);

			$this->barcode_qrcode($hawb_no);
			$this->barcode_1d($hawb_no);

			$html = $this->load->view('download/airwaybill',$data,true);
			$pdf->WriteHTML($html);
			$pdf->Output($file_path, 'I');
		}
    }

    function excel(){
    	$filename = time() . '.xlsx';
		include PATH_APP . 'libraries/PHPExcel/IOFactory.php';
		$style = array(
			'font'  => array(
				'size'  => 8,
				'name'  => 'Arial'
			),
	        'alignment' => array(
	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	        ),
	        'borders' => array(
	          	'allborders' => array(
	            	'style' => PHPExcel_Style_Border::BORDER_THIN
	          	)
	      	)
	    );
		$objPHPExcel = new PHPExcel();

		$snow = $_POST['snow'];
		switch ($snow) {
			case 'vietnam':
				$objPHPExcel->getActiveSheet()->setCellValue('A1','DATE')
				    ->setCellValue('B1','MAWB NO')
				    ->setCellValue('C1','G.W (KGS)')
				    ->setCellValue('G1','INCOME')
				    ->setCellValue('J1','COST')
				    ->setCellValue('Q1','PROFIT')
				    ->setCellValue('R1','TATA')
				    ->setCellValue('S1','LITA')
				    ->setCellValue('T1','PML')
				    ->setCellValue('C2','H/C')
				    ->setCellValue('D2','FTZ')
				    ->setCellValue('E2','DOC FTZ')
				    ->setCellValue('F2','TOTAL')
				    ->setCellValue('G2','PP')
				    ->setCellValue('H2','CC')
				    ->setCellValue('I2','TOTAL')
				    ->setCellValue('J2','PML')
				    ->setCellValue('L2','JKT')
				    ->setCellValue('P2','TOTAL')
				    ->setCellValue('J3','OTHER CHARGE')
				    ->setCellValue('K3','FREIGHT')
				    ->setCellValue('L3','HC')
				    ->setCellValue('M3','FTZ')
				    ->setCellValue('N3','OTHER CHARGE')
				    ->setCellValue('O3','TPE');

				$sheet = $objPHPExcel->getActiveSheet();
				$sheet->mergeCells('A1:A3');
				$sheet->mergeCells('B1:B3');
				$sheet->mergeCells('C1:F1');
				$sheet->mergeCells('C2:C3');
				$sheet->mergeCells('D2:D3');
				$sheet->mergeCells('E2:E3');
				$sheet->mergeCells('F2:F3');
				$sheet->mergeCells('G1:I1');
				$sheet->mergeCells('G2:G3');
				$sheet->mergeCells('H2:H3');
				$sheet->mergeCells('I2:I3');
				$sheet->mergeCells('J1:P1');
				$sheet->mergeCells('J2:K2');
				$sheet->mergeCells('L2:O2');
				$sheet->mergeCells('P2:P3');
				$sheet->mergeCells('Q1:Q3');
				$sheet->mergeCells('R1:R3');
				$sheet->mergeCells('S1:S3');
				$sheet->mergeCells('T1:T3');
			    $sheet->getDefaultStyle()->applyFromArray($style);


			    #Insert Data
			    $cell = 4;
			    $cell_data = $_POST['data'];
			    foreach($cell_data as $row){

			    $get_data_from = $this->manifest_model->get_hawb_from($row['host']);

				$tata 					= ($row['in_cc']) ? 0.4 : 0.3;
				$lita 					= ($row['in_pp']) ? 0.4 : 0.3;


			    	$objPHPExcel->getActiveSheet()->setCellValue('A'.$cell,$row['date']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('B'.$cell,$row['host']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('C'.$cell,$row['gw_hc']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('D'.$cell,$row['gw_ftz']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('E'.$cell,$row['gw_docftz']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('F'.$cell,'=SUM(C'.$cell.':D'.$cell.')');
			    	$objPHPExcel->getActiveSheet()->setCellValue('G'.$cell,$row['in_pp']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('H'.$cell,$row['in_cc']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('I'.$cell,'=SUM(G'.$cell.':H'.$cell.')');
			    	$objPHPExcel->getActiveSheet()->setCellValue('J'.$cell,$row['cost_pml_charge']);

			    	$gw_total = $row['gw_hc'] + $row['gw_ftz'];
			    	if($get_data_from) {
				    	$objPHPExcel->getActiveSheet()->setCellValue('K'.$cell,'=(F'.$cell.'*(50+38))');
					} else {
						if($gw_total < 100) {
					    	$objPHPExcel->getActiveSheet()->setCellValue('K'.$cell,'=(F'.$cell.'*(39+38))');
						}
						if($gw_total >= 100 && $gw_total < 300) {
					    	$objPHPExcel->getActiveSheet()->setCellValue('K'.$cell,'=(F'.$cell.'*(34+38))');
						}
						if($gw_total >= 300 && $gw_total < 500) {
					    	$objPHPExcel->getActiveSheet()->setCellValue('K'.$cell,'=(F'.$cell.'*(28+38))');
						}
						if($gw_total >= 500) {
					    	$objPHPExcel->getActiveSheet()->setCellValue('K'.$cell,'=(F'.$cell.'*(26+38))');
						}
					}
			    	
			    	$objPHPExcel->getActiveSheet()->setCellValue('L'.$cell,'=(C'.$cell.'*64)');
			    	$objPHPExcel->getActiveSheet()->setCellValue('M'.$cell,'=(D'.$cell.'*16)+(640*E'.$cell.')');
			    	$objPHPExcel->getActiveSheet()->setCellValue('N'.$cell,$row['cost_tata_charge']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('O'.$cell,'=(F'.$cell.'*(56+26))');
			    	$objPHPExcel->getActiveSheet()->setCellValue('P'.$cell,'=SUM(J'.$cell.':O'.$cell.')');
			    	$objPHPExcel->getActiveSheet()->setCellValue('Q'.$cell,'=(I'.$cell.'-P'.$cell.')');
			    	$objPHPExcel->getActiveSheet()->setCellValue('R'.$cell,'=(Q'.$cell.'*'.$tata.'+L'.$cell.'+M'.$cell.'-H'.$cell.')');
			    	$objPHPExcel->getActiveSheet()->setCellValue('S'.$cell,'=(Q'.$cell.'*'.$lita.'+J'.$cell.'+K'.$cell.'-G'.$cell.')');
			    	$objPHPExcel->getActiveSheet()->setCellValue('T'.$cell,'=(Q'.$cell.'*0.3+O'.$cell.')');
			    	if($row['host'] == 'pouchen') {
				    	$objPHPExcel->getActiveSheet()->setCellValue('Q'.$cell,'=P'.$cell.'/3+J'.$cell.'+K'.$cell.'-G'.$cell.'');
				    } else {
				    	$objPHPExcel->getActiveSheet()->setCellValue('Q'.$cell,'=P'.$cell.'/2+J'.$cell.'+K'.$cell.'-G'.$cell.'');		    	
				    }
				    
				    $objPHPExcel->getActiveSheet()->getStyle('C'.$cell.':Q'.$cell)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

				    if(strtolower($row['host']) == 'pouchen') {
				    	$sheet->getStyle('A'.$cell.':T'.$cell)->applyFromArray(
						    array(
						        'fill' => array(
						            'type' => PHPExcel_Style_Fill::FILL_SOLID,
						            'color' => array('rgb' => 'F8E0E0')
						        )
						    )
						);
				    } else if(strtolower($row['host']) == 'fengtay') {
				    	$sheet->getStyle('A'.$cell.':T'.$cell)->applyFromArray(
						    array(
						        'fill' => array(
						            'type' => PHPExcel_Style_Fill::FILL_SOLID,
						            'color' => array('rgb' => 'A9BCF5')
						        )
						    )
						);
				    } else if(substr($row['host'], -7) == 'P.I.B.K') {
				    	$sheet->getStyle('A'.$cell.':T'.$cell)->applyFromArray(
						    array(
						        'fill' => array(
						            'type' => PHPExcel_Style_Fill::FILL_SOLID,
						            'color' => array('rgb' => 'A9F5F2')
						        )
						    )
						);		    	
				    }
			    	$cell++;
			    }
			    #End Insert Data

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				$objWriter->save(PATH_DOWNLOAD . $filename);
				echo base_url().'download/'.$filename;
			break;
			
			case 'taiwan':
				$objPHPExcel->getActiveSheet()->setCellValue('A1','DATE')
				    ->setCellValue('B1','MAWB NO')
				    ->setCellValue('C1','G.W (KGS)')
				    ->setCellValue('G1','INCOME')
				    ->setCellValue('J1','COST')
				    ->setCellValue('P1','PROFIT')
				    ->setCellValue('Q1','CREDIT (-) DEBIT (+)')
				    ->setCellValue('C2','H/C')
				    ->setCellValue('D2','FTZ')
				    ->setCellValue('E2','DOC FTZ')
				    ->setCellValue('F2','TOTAL')
				    ->setCellValue('G2','CC')
				    ->setCellValue('H2','PP')
				    ->setCellValue('I2','TOTAL')
				    ->setCellValue('J2','PML')
				    ->setCellValue('L2','JKT')
				    ->setCellValue('O2','TOTAL')
				    ->setCellValue('J3','OTHER CHARGE')
				    ->setCellValue('K3','FREIGHT')
				    ->setCellValue('L3','HC')
				    ->setCellValue('M3','FTZ')
				    ->setCellValue('N3','OTHER CHARGE');

				$sheet = $objPHPExcel->getActiveSheet();
				$sheet->mergeCells('A1:A3');
				$sheet->mergeCells('B1:B3');
				$sheet->mergeCells('C1:F1');
				$sheet->mergeCells('C2:C3');
				$sheet->mergeCells('D2:D3');
				$sheet->mergeCells('E2:E3');
				$sheet->mergeCells('F2:F3');
				$sheet->mergeCells('G1:I1');
				$sheet->mergeCells('G2:G3');
				$sheet->mergeCells('H2:H3');
				$sheet->mergeCells('I2:I3');
				$sheet->mergeCells('J1:O1');
				$sheet->mergeCells('J2:K2');
				$sheet->mergeCells('L2:N2');
				$sheet->mergeCells('O2:O3');
				$sheet->mergeCells('P1:P3');
				$sheet->mergeCells('Q1:Q3');

			    $sheet->getDefaultStyle()->applyFromArray($style);

			    $cell = 4;
			    $cell_data = $_POST['data'];
			    foreach($cell_data as $row){
			    	$get_data_from = $this->manifest_model->get_hawb_from($row['host']);

			    	$objPHPExcel->getActiveSheet()->setCellValue('A'.$cell,$row['date']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('B'.$cell,$row['host']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('C'.$cell,$row['gw_hc']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('D'.$cell,$row['gw_ftz']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('E'.$cell,$row['gw_docftz']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('F'.$cell,'=SUM(C'.$cell.':D'.$cell.')');
			    	$objPHPExcel->getActiveSheet()->setCellValue('G'.$cell,$row['in_pp']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('H'.$cell,$row['in_cc']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('I'.$cell,'=SUM(G'.$cell.':H'.$cell.')');
			    	$objPHPExcel->getActiveSheet()->setCellValue('J'.$cell,$row['cost_pml_charge']);
			    	
			    	$gw_total = $row['gw_hc'] + $row['gw_ftz'];
			    	if($get_data_from) {
						if(strtolower($get_data_from->country) == 'china') {
							if($gw_total <= 45) {
								$objPHPExcel->getActiveSheet()->setCellValue('K'.$cell,'=(F'.$cell.'*87)');
							}
							if($gw_total > 45 && $gw_total <= 250) {
								$cost_pml_freight = $gw_total * 78;
								$objPHPExcel->getActiveSheet()->setCellValue('K'.$cell,'=(F'.$cell.'*78)');
							}
							if($gw_total > 250 && $gw_total <= 500) {
								$objPHPExcel->getActiveSheet()->setCellValue('K'.$cell,'=(F'.$cell.'*77)');
							}
							if($gw_total > 500) {
								$objPHPExcel->getActiveSheet()->setCellValue('K'.$cell,'=(F'.$cell.'*76)');
							}								
						} else {
							$objPHPExcel->getActiveSheet()->setCellValue('K'.$cell,'=(F'.$cell.'*56)');
						}
					} else {
						$objPHPExcel->getActiveSheet()->setCellValue('K'.$cell,'=(F'.$cell.'*56)');
					}

			    	$objPHPExcel->getActiveSheet()->setCellValue('L'.$cell,'=(C'.$cell.'*192)');
			    	$objPHPExcel->getActiveSheet()->setCellValue('M'.$cell,'=(D'.$cell.'*16)+(640*E'.$cell.')');
			    	$objPHPExcel->getActiveSheet()->setCellValue('N'.$cell,$row['cost_tata_charge']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('O'.$cell,'=SUM(J'.$cell.':N'.$cell.')');
			    	$objPHPExcel->getActiveSheet()->setCellValue('P'.$cell,'=(I'.$cell.'-O'.$cell.')');
			    	if($row['host'] == 'pouchen') {
				    	$objPHPExcel->getActiveSheet()->setCellValue('Q'.$cell,'=P'.$cell.'/3+J'.$cell.'+K'.$cell.'-G'.$cell.'');
				    } else {
				    	$objPHPExcel->getActiveSheet()->setCellValue('Q'.$cell,'=P'.$cell.'/2+J'.$cell.'+K'.$cell.'-G'.$cell.'');		    	
				    }
				    
				    $objPHPExcel->getActiveSheet()->getStyle('C'.$cell.':Q'.$cell)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

				    if(strtolower($row['host']) == 'pouchen') {
				    	$sheet->getStyle('A'.$cell.':Q'.$cell)->applyFromArray(
						    array(
						        'fill' => array(
						            'type' => PHPExcel_Style_Fill::FILL_SOLID,
						            'color' => array('rgb' => 'F8E0E0')
						        )
						    )
						);
				    } else if(strtolower($row['host']) == 'fengtay') {
				    	$sheet->getStyle('A'.$cell.':Q'.$cell)->applyFromArray(
						    array(
						        'fill' => array(
						            'type' => PHPExcel_Style_Fill::FILL_SOLID,
						            'color' => array('rgb' => 'A9BCF5')
						        )
						    )
						);
				    } else if(substr($row['host'], -7) == 'P.I.B.K') {
				    	$sheet->getStyle('A'.$cell.':Q'.$cell)->applyFromArray(
						    array(
						        'fill' => array(
						            'type' => PHPExcel_Style_Fill::FILL_SOLID,
						            'color' => array('rgb' => 'A9F5F2')
						        )
						    )
						);		    	
				    }
			    	$cell++;
			    }



				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				$objWriter->save(PATH_DOWNLOAD . $filename);
				echo base_url().'download/'.$filename;
			break;

			case 'jakarta_taiwan':
				$objPHPExcel->getActiveSheet()->setCellValue('A1','DATE')
				    ->setCellValue('B1','MAWB NO')
				    ->setCellValue('C1','G.W (KGS)')
				    ->setCellValue('E1','INCOME')
				    ->setCellValue('H1','COST')
				    ->setCellValue('M1','PROFIT')
				    ->setCellValue('N1','CREDIT DUE TO THS')
				    ->setCellValue('O1','CREDIT DUE TO THS')
				    ->setCellValue('P1','ACU ACCOUNT')
				    ->setCellValue('C2','SELLING')
				    ->setCellValue('D2','MAWB')
				    ->setCellValue('E2','PP')
				    ->setCellValue('F2','CC')
				    ->setCellValue('G2','TOTAL')
				    ->setCellValue('H2','TATA')
				    ->setCellValue('J2','PML')
				    ->setCellValue('L2','TOTAL')
				    ->setCellValue('P2','TOTAL CC')
				    ->setCellValue('Q2','COST')
				    ->setCellValue('R2','REFUND TO MS ACU')
				    ->setCellValue('H3','OTHER CHARGE')
				    ->setCellValue('I3','FREIGHT')
				    ->setCellValue('J3','HANDLING')
				    ->setCellValue('K3','OTHER CHARGE');

				$sheet = $objPHPExcel->getActiveSheet();
				$sheet->mergeCells('A1:A3');
				$sheet->mergeCells('B1:B3');
				$sheet->mergeCells('C1:D1');
				$sheet->mergeCells('C2:C3');
				$sheet->mergeCells('D2:D3');
				$sheet->mergeCells('E1:G1');
				$sheet->mergeCells('E2:E3');
				$sheet->mergeCells('F2:F3');
				$sheet->mergeCells('G2:G3');
				$sheet->mergeCells('H1:L1');
				$sheet->mergeCells('H2:I2');
				$sheet->mergeCells('L2:L3');
				$sheet->mergeCells('J2:K2');
				$sheet->mergeCells('M1:M3');
				$sheet->mergeCells('N1:N3');
				$sheet->mergeCells('O1:O3');
				$sheet->mergeCells('P1:R1');
				$sheet->mergeCells('P2:P3');
				$sheet->mergeCells('Q2:Q3');
				$sheet->mergeCells('R2:R3');

			    $sheet->getDefaultStyle()->applyFromArray($style);

			    $cell = 4;
			    $cell_data = $_POST['data'];
			    foreach($cell_data as $row){
			    	$get_data_from = $this->manifest_model->get_hawb_from($row['host']);

			    	$objPHPExcel->getActiveSheet()->setCellValue('A'.$cell,$row['date']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('B'.$cell,$row['host']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('C'.$cell,$row['gw_selling']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('D'.$cell,$row['gw_mawb']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('E'.$cell,$row['in_pp']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('F'.$cell,$row['in_cc']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('G'.$cell,'=SUM(E'.$cell.':F'.$cell.')');
			    	$objPHPExcel->getActiveSheet()->setCellValue('H'.$cell,$row['cost_tata_charge']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('I'.$cell,'=(D'.$cell.'*96)'); //Need Formula

			    	if($row['snow_type'] == 'sub_chn') {
				    	$objPHPExcel->getActiveSheet()->setCellValue('J'.$cell,'=(D'.$cell.'*(20+92))'); //Need Formula
				    } else if($row['snow_type'] == 'sub_hkg') {
				    	$objPHPExcel->getActiveSheet()->setCellValue('J'.$cell,'=(D'.$cell.'*(20+55))'); //Need Formula
				    } else {
				    	$objPHPExcel->getActiveSheet()->setCellValue('J'.$cell,'=(D'.$cell.'*(20))'); //Need Formula				    	
				    }

			    	$objPHPExcel->getActiveSheet()->setCellValue('K'.$cell,$row['cost_pml_charge']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('L'.$cell,'=SUM(H'.$cell.':K'.$cell.')');
			    	$objPHPExcel->getActiveSheet()->setCellValue('M'.$cell,'=(G'.$cell.'-L'.$cell.')');
			    	$objPHPExcel->getActiveSheet()->setCellValue('N'.$cell,'=(M'.$cell.'/2+I'.$cell.'+H'.$cell.'-E'.$cell.')');
			    	$objPHPExcel->getActiveSheet()->setCellValue('O'.$cell,'=(M'.$cell.'/2+J'.$cell.'+K'.$cell.'-F'.$cell.')');
			    	$objPHPExcel->getActiveSheet()->setCellValue('P'.$cell,$row['acu_total_cc']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('Q'.$cell,$row['acu_cost']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('R'.$cell,'=(P'.$cell.'-Q'.$cell.')'); //Need Formula
			    	
			    	$cell++;
			    }

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				$objWriter->save(PATH_DOWNLOAD . $filename);
				echo base_url().'download/'.$filename;
			break;

			case 'jakarta_vietnam':
				$objPHPExcel->getActiveSheet()->setCellValue('A1','DATE')
				    ->setCellValue('B1','MAWB NO')
				    ->setCellValue('C1','G.W (KGS)')
				    ->setCellValue('E1','INCOME')
				    ->setCellValue('H1','COST')
				    ->setCellValue('N1','PROFIT')
				    ->setCellValue('O1','TATA')
				    ->setCellValue('P1','LITA')
				    ->setCellValue('Q1','PML')
				    ->setCellValue('R1','ACU ACCOUNT')
				    ->setCellValue('C2','SELLING')
				    ->setCellValue('D2','MAWB')
				    ->setCellValue('E2','PP')
				    ->setCellValue('F2','CC')
				    ->setCellValue('G2','TOTAL')
				    ->setCellValue('H2','TATA')
				    ->setCellValue('K2','PML')
				    ->setCellValue('L2','TOTAL')
				    ->setCellValue('M2','TOTAL')
				    ->setCellValue('R2','TOTAL CC')
				    ->setCellValue('S2','COST')
				    ->setCellValue('T2','REFUND TO MS ACU')
				    ->setCellValue('H3','TPE')
				    ->setCellValue('I3','OTHER CHARGE')
				    ->setCellValue('J3','FREIGHT')
				    ->setCellValue('K3','HANDLING')
				    ->setCellValue('L3','CHARGE');

				$sheet = $objPHPExcel->getActiveSheet();
				$sheet->mergeCells('A1:A3');
				$sheet->mergeCells('B1:B3');
				$sheet->mergeCells('C1:D1');
				$sheet->mergeCells('C2:C3');
				$sheet->mergeCells('D2:D3');
				$sheet->mergeCells('E1:G1');
				$sheet->mergeCells('E2:E3');
				$sheet->mergeCells('F2:F3');
				$sheet->mergeCells('G2:G3');
				$sheet->mergeCells('H1:M1');
				$sheet->mergeCells('H2:J2');
				$sheet->mergeCells('K2:L2');
				$sheet->mergeCells('M2:M3');
				$sheet->mergeCells('N1:N3');
				$sheet->mergeCells('O1:O3');
				$sheet->mergeCells('P1:P3');
				$sheet->mergeCells('Q1:Q3');
				$sheet->mergeCells('R1:T1');
				$sheet->mergeCells('R2:R3');
				$sheet->mergeCells('S2:S3');
				$sheet->mergeCells('T2:T3');
				$sheet->getDefaultStyle()->applyFromArray($style);

				$cell = 4;
			    $cell_data = $_POST['data'];
			    foreach($cell_data as $row){
			    	$get_data_from = $this->manifest_model->get_hawb_from($row['host']);
					$tata 					= ($row['in_pp']) ? 0.4 : 0.3;
					$lita 					= ($row['in_cc']) ? 0.4 : 0.3;
					$pml 					= 0.3;

			    	$objPHPExcel->getActiveSheet()->setCellValue('A'.$cell,$row['date']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('B'.$cell,$row['host']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('C'.$cell,$row['gw_selling']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('D'.$cell,$row['gw_mawb']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('E'.$cell,$row['in_pp']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('F'.$cell,$row['in_cc']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('G'.$cell,'=SUM(E'.$cell.':F'.$cell.')');
			    	$objPHPExcel->getActiveSheet()->setCellValue('H'.$cell,'=(D'.$cell.'*(26+52))');
			    	$objPHPExcel->getActiveSheet()->setCellValue('I'.$cell,$row['cost_tata_charge']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('J'.$cell,'=(D'.$cell.'*(64+33))'); //Need Formula
			    	$objPHPExcel->getActiveSheet()->setCellValue('K'.$cell,'=(D'.$cell.'*64)');
			    	$objPHPExcel->getActiveSheet()->setCellValue('L'.$cell,$row['cost_pml_charge']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('M'.$cell,'=SUM(H'.$cell.':L'.$cell.')');
			    	$objPHPExcel->getActiveSheet()->setCellValue('N'.$cell,'=(G'.$cell.'-M'.$cell.')');

		    		$objPHPExcel->getActiveSheet()->setCellValue('O'.$cell,'=((N'.$cell.'*'.$tata.')+(J'.$cell.'+I'.$cell.')-E'.$cell.')');
		    		$objPHPExcel->getActiveSheet()->setCellValue('P'.$cell,'=((N'.$cell.'*'.$lita.')+(K'.$cell.'+L'.$cell.')-F'.$cell.')'); 
			    	$objPHPExcel->getActiveSheet()->setCellValue('Q'.$cell,'=((N'.$cell.'*'.$pml.')+H'.$cell.')');

			    	$objPHPExcel->getActiveSheet()->setCellValue('R'.$cell,$row['acu_total_cc']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('S'.$cell,$row['acu_cost']);
			    	$objPHPExcel->getActiveSheet()->setCellValue('T'.$cell,'=(R'.$cell.'-S'.$cell.')'); //Need Formula
			    	
			    	$cell++;
			    }

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				$objWriter->save(PATH_DOWNLOAD . $filename);
				echo base_url().'download/'.$filename;
			break;
		}

    }

    function manifest($type = 'excel') {
    	if(count($_POST) > 0) {
    		switch ($type) {
				case 'excel':
					include PATH_APP . 'libraries/PHPExcel/IOFactory.php';
					$filename = 'MANIFEST '.substr(time(),-4).' - '.date('Y-m-d').'.xlsx';
					$style = array(
						'font'  => array('size'  => 8, 'name'  => 'Tahoma' ),
						'alignment' => array('wrap' => true, 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
						);

					$objPHPExcel = new PHPExcel();
					$objPHPExcel->getActiveSheet()->setCellValue('A1','HAWB NO')
								->setCellValue('B1','SHIPPER')
								->setCellValue('C1','CONSIGNEE')
								->setCellValue('D1','PKG')
								->setCellValue('E1','PCS')
								->setCellValue('F1','KG')
								->setCellValue('G1','VALUE')
								->setCellValue('H1','PP')
								->setCellValue('I1','CC')
								->setCellValue('J1','DESCRIPTION')
								->setCellValue('K1','REMARKS');

					#GETTING DATA
					$type = $_POST['type'];
					$start_date = $_POST['start_date'];
					$end_date = $_POST['end_date'];
					$this->db->where_in('manifest_type',$type);
					$this->db->where('LEFT(created_date,10) >=',str_ireplace('/','-',$start_date));
					$this->db->where('LEFT(created_date,10) <=',str_ireplace('/','-',$end_date));
					$this->db->where('LOWER(status)','valid');
					$get = $this->db->get('manifest_data_table');

					$idx = 2;
					foreach ($get->result() as $key => $row) {
						$shipper = $this->customers_model->get_by_id($row->shipper);
						$shipper = $shipper->name.' '.$shipper->address.' '.$shipper->country.' '.$shipper->phone.' '.$shipper->email.' '.$shipper->sort_name;

						$consignee = $this->customers_model->get_by_id($row->consignee);
						$consignee = $consignee->name.' '.$consignee->address.' '.$consignee->country.' '.$consignee->phone.' '.$consignee->email.' '.$consignee->sort_name;

						$objPHPExcel->getActiveSheet()->setCellValue('A'.$idx,$row->hawb_no)
								->setCellValue('B'.$idx,$shipper)
								->setCellValue('C'.$idx,$consignee)
								->setCellValue('D'.$idx,$row->pkg)
								->setCellValue('E'.$idx,$row->pcs)
								->setCellValue('F'.$idx,$row->kg)
								->setCellValue('G'.$idx,$row->value)
								->setCellValue('H'.$idx,$row->prepaid)
								->setCellValue('I'.$idx,$row->collect)
								->setCellValue('J'.$idx,$row->description)
								->setCellValue('K'.$idx,$row->remarks);
						$idx++;
					}

					$sheet = $objPHPExcel->getActiveSheet();
					$sheet->getDefaultStyle()->applyFromArray($style);
					$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
					$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('B')->setAutoSize(true);
					$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
					$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('C')->setAutoSize(true);
					$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
					$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('J')->setAutoSize(true);
					$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(25);
					$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('K')->setAutoSize(true);
					
					$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
					$objWriter->save(PATH_DOWNLOAD . $filename);
					echo base_url().'download/'.$filename;

    				break;
    			
    			default:
    				echo 'Not Found!';
    				break;
    		}

    	} else echo 'Not Found!';
    }

    function request_post() {
    	echo '<pre>';
    	print_r($_POST['data']);
    	echo '</pre>';
    }

    function debit(){
    	ini_set('memory_limit','-1');
    	$html = '<table border="1" cellspading="0">';
    	$html .=  $_POST['data'];
    	$html .= '</table>';
		
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		$name = md5(time());
		$file_path = PATH_PDF . $name . '.pdf';
		$pdf->WriteHTML($html);
		$pdf->Output($file_path, 'I');

    }

    function barcode($type = null,$value = null) {
    	if($type == '1D') {
    		$this->barcode_1d($value);
    	} else if($type == 'QRCODE') {
    		$this->barcode_qrcode($value);
    	} else echo redirect('');
    }

    function barcode_1d($string) {
		require_once(PATH_APP . 'libraries/phpbarcode/class/BCGFontFile.php');
		require_once(PATH_APP . 'libraries/phpbarcode/class/BCGColor.php');
		require_once(PATH_APP . 'libraries/phpbarcode/class/BCGDrawing.php');
		require_once(PATH_APP . 'libraries/phpbarcode/class/BCGcode39.barcode.php');

		$font = new BCGFontFile(PATH_APP . 'libraries/phpbarcode/font/Arial.ttf', 8);
		$color_black = new BCGColor(0, 0, 0);
		$color_white = new BCGColor(255, 255, 255);

		$drawException = null;
		try {
		    $code = new BCGcode39();
		    $code->setScale(1);
		    $code->setThickness(30);
		    $code->setForegroundColor($color_black);
		    $code->setBackgroundColor($color_white);
		    $code->setFont($font);
		    $code->parse($string);
		} catch(Exception $exception) {
		    $drawException = $exception;
		}

		$path = PATH_BARCODE.'1D_'.$string.'.png';

		$drawing = new BCGDrawing($path, $color_white);
		if($drawException) {
		    $drawing->drawException($drawException);
		} else {
		    $drawing->setBarcode($code);
		    $drawing->draw();
		}

		header('Content-Type: image/png');
		header('Content-Disposition: inline; filename="'.PATH_BARCODE.'1d_'.$string.'.png"');
		$drawing->finish(BCGDrawing::IMG_FORMAT_PNG,100);
    }

    function barcode_qrcode($string) {
    	require_once(PATH_APP . 'libraries/phpqrcode/qrlib.php');

    	$path = PATH_BARCODE.'QR_'.$string.'.png';
    	if(!file_exists($path)) {
	    	QRcode::png($string,$path);
	    }
    }
}

?>