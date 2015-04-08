<page style="font-size:12px;">
	<div style="width:100%; height:55px;">
		<img src="<?=base_url()?>asset/images/tata-logo.png" style="width:350px; height:55px; float:left;">
	</div>
	<div style="width:100%; height:15px; line-height:15px; border-bottom:1px solid #e2e2e2; background-color:#f9f9f9; padding:5px 0px; text-align:center;">
		<table style="width:100%; border-collapse: none; border-spacing: 0px">
		<tr>
			<td style="width:50%; text-align:left; font-weight:bold;">Airwaybill #<?=$details->data_id;?></td>
			<td style="width:50%; text-align:right;">Lembar untuk customer</td>
		</tr>
		</table>
	</div>
	<table style="width:100%; margin-top:10px; margin-bottom:10px; border-spacing:0px; border-collapse: none; border-spacing: 0px">
		<tr>
			<td style="width:50%; vertical-align:top;">
				<div>
					<div style="line-height:15px;">
						<strong>Pengirim:</strong><br/>
						<?php
			            $shipper = $this->customers_model->get_by_id($details->shipper);
			            echo ucwords(strtolower('
			            '.$shipper->name.'<br/>
			            '.$shipper->address.' '.$shipper->city.'<br/>
			            '.$shipper->country.'<br/>
			            Attn: '.$shipper->sort_name));
			            ?>
					</div>

					<div style="line-height:15px; margin-top:15px;">
						<strong>Penerima:</strong><br/>
						<?php
			            $consignee = $this->customers_model->get_by_id($details->consignee);
			            echo ucwords(strtolower('
			            '.$consignee->name.'<br/>
			            '.$consignee->address.' '.$shipper->city.'<br/>
			            '.$consignee->country.'<br/>
			            Attn: '.$consignee->sort_name));
			            ?>
					</div>

					<div style="line-height:15px; margin-top:15px;">
						<strong>Keterangan:</strong><br/>
						<?php
			            echo ucfirst(strtolower($details->description));
			            ?>
					</div>
				</div>
			</td>
			<td style="width:50%; vertical-align:top;">
				<table cellspacing="0" cellpadding="0" style="width:100%;">
					<tr style="background-color:#f9f9f9; height:40px;">
						<td style="width:25%; text-align:center; height:25px; vertical-align:middle; border:1px solid #ccc;">PKG</td>
						<td style="width:25%; text-align:center; height:25px; vertical-align:middle; border:1px solid #ccc;">PCS</td>
						<td style="width:25%; text-align:center; height:25px; vertical-align:middle; border:1px solid #ccc;">KG</td>
						<td style="width:25%; text-align:center; height:25px; vertical-align:middle; border:1px solid #ccc;">VALUE</td>
					</tr>
					<tr>
						<td style="text-align:center; text-align:center; height:25px; vertical-align:middle; border:1px solid #ccc;"><?=$details->pkg?></td>
						<td style="text-align:center; text-align:center; height:25px; vertical-align:middle; border:1px solid #ccc;"><?=$details->pcs?></td>
						<td style="text-align:center; text-align:center; height:25px; vertical-align:middle; border:1px solid #ccc;"><?=$details->kg?></td>
						<td style="text-align:center; text-align:center; height:25px; vertical-align:middle; border:1px solid #ccc;"><?=$details->value?></td>
					</tr>
				</table>

				<table cellspacing="0" cellpadding="0" style="width:100%; margin-top:20px;">
					<tr style="height:40px;">
						<td style="width:50%; height:20px;">NT$ Kurs</td>
						<td style="width:50%; text-align:right;"><?=$details->nt_kurs?></td>
					</tr>
					<tr style="height:40px;">
						<td style="width:50%; height:20px;"><strong>Total</strong></td>
						<td style="width:50%; text-align:right;"><?=number_format($details->prepaid * $details->nt_kurs)?></td>
					</tr>
				</table>

				<table cellspacing="0" cellpadding="0" style="width:100%; margin-top:30px;">
					<tr style="height:40px;">
						<td style="width:50%; text-align:center;">Petugas</td>
						<td style="width:50%; text-align:center;">Ttd Penerima</td>
					</tr>
				</table>
				<table cellspacing="0" cellpadding="0" style="width:100%; margin-top:50px;">
					<tr style="height:40px;">
						<td style="width:50%; text-align:center;">Petugas</td>
						<td style="width:50%; text-align:center;">Ttd Penerima</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<hr style="border:1px dashed #ccc;">
	<div style="width:100%; height:55px;">
		<img src="<?=base_url()?>asset/images/tata-logo.png" style="width:350px; height:55px; float:left;">
	</div>
	<div style="width:100%; height:15px; line-height:15px; border-bottom:1px solid #e2e2e2; background-color:#f9f9f9; padding:5px 0px; text-align:center;">
		<table style="width:100%; border-collapse: none; border-spacing: 0px">
		<tr>
			<td style="width:50%; text-align:left; font-weight:bold;">Airwaybill #<?=$details->data_id;?></td>
			<td style="width:50%; text-align:right;">Lembar untuk arsip</td>
		</tr>
		</table>
	</div>
	<table style="width:100%; margin-top:10px; margin-bottom:10px; border-spacing:0px; border-collapse: none; border-spacing: 0px">
		<tr>
			<td style="width:50%; vertical-align:top;">
				<div>
					<div style="line-height:15px;">
						<strong>Pengirim:</strong><br/>
						<?php
			            $shipper = $this->customers_model->get_by_id($details->shipper);
			            echo ucwords(strtolower('
			            '.$shipper->name.'<br/>
			            '.$shipper->address.' '.$shipper->city.'<br/>
			            '.$shipper->country.'<br/>
			            Attn: '.$shipper->sort_name));
			            ?>
					</div>

					<div style="line-height:15px; margin-top:15px;">
						<strong>Penerima:</strong><br/>
						<?php
			            $consignee = $this->customers_model->get_by_id($details->consignee);
			            echo ucwords(strtolower('
			            '.$consignee->name.'<br/>
			            '.$consignee->address.' '.$shipper->city.'<br/>
			            '.$consignee->country.'<br/>
			            Attn: '.$consignee->sort_name));
			            ?>
					</div>

					<div style="line-height:15px; margin-top:15px;">
						<strong>Keterangan:</strong><br/>
						<?php
			            echo ucfirst(strtolower($details->description));
			            ?>
					</div>
				</div>
			</td>
			<td style="width:50%; vertical-align:top;">
				<table cellspacing="0" cellpadding="0" style="width:100%;">
					<tr style="background-color:#f9f9f9; height:40px;">
						<td style="width:25%; text-align:center; height:25px; vertical-align:middle; border:1px solid #ccc;">PKG</td>
						<td style="width:25%; text-align:center; height:25px; vertical-align:middle; border:1px solid #ccc;">PCS</td>
						<td style="width:25%; text-align:center; height:25px; vertical-align:middle; border:1px solid #ccc;">KG</td>
						<td style="width:25%; text-align:center; height:25px; vertical-align:middle; border:1px solid #ccc;">VALUE</td>
					</tr>
					<tr>
						<td style="text-align:center; text-align:center; height:25px; vertical-align:middle; border:1px solid #ccc;"><?=$details->pkg?></td>
						<td style="text-align:center; text-align:center; height:25px; vertical-align:middle; border:1px solid #ccc;"><?=$details->pcs?></td>
						<td style="text-align:center; text-align:center; height:25px; vertical-align:middle; border:1px solid #ccc;"><?=$details->kg?></td>
						<td style="text-align:center; text-align:center; height:25px; vertical-align:middle; border:1px solid #ccc;"><?=$details->value?></td>
					</tr>
				</table>

				<table cellspacing="0" cellpadding="0" style="width:100%; margin-top:20px;">
					<tr style="height:40px;">
						<td style="width:50%; height:20px;">NT$ Kurs</td>
						<td style="width:50%; text-align:right;"><?=$details->nt_kurs?></td>
					</tr>
					<tr style="height:40px;">
						<td style="width:50%; height:20px;"><strong>Total</strong></td>
						<td style="width:50%; text-align:right;"><?=number_format($details->prepaid * $details->nt_kurs)?></td>
					</tr>
				</table>

				<table cellspacing="0" cellpadding="0" style="width:100%; margin-top:30px;">
					<tr style="height:40px;">
						<td style="width:50%; text-align:center;">Petugas</td>
						<td style="width:50%; text-align:center;">Ttd Penerima</td>
					</tr>
				</table>
				<table cellspacing="0" cellpadding="0" style="width:100%; margin-top:50px;">
					<tr style="height:40px;">
						<td style="width:50%; text-align:center;">Petugas</td>
						<td style="width:50%; text-align:center;">Ttd Penerima</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<hr style="border:1px dashed #ccc;">
	<div style="width:100%; height:55px;">
		<img src="<?=base_url()?>asset/images/tata-logo.png" style="width:350px; height:55px; float:left;">
	</div>
	<div style="width:100%; height:15px; line-height:15px; border-bottom:1px solid #e2e2e2; background-color:#f9f9f9; padding:5px 0px; text-align:center;">
		<table style="width:100%; border-collapse: none; border-spacing: 0px">
		<tr>
			<td style="width:50%; text-align:left; font-weight:bold;">Airwaybill #<?=$details->data_id;?></td>
			<td style="width:50%; text-align:right;">Lembar untuk accounting</td>
		</tr>
		</table>
	</div>
	<table style="width:100%; margin-top:10px; margin-bottom:10px; border-spacing:0px; border-collapse: none; border-spacing: 0px">
		<tr>
			<td style="width:50%; vertical-align:top;">
				<div>
					<div style="line-height:15px;">
						<strong>Pengirim:</strong><br/>
						<?php
			            $shipper = $this->customers_model->get_by_id($details->shipper);
			            echo ucwords(strtolower('
			            '.$shipper->name.'<br/>
			            '.$shipper->address.' '.$shipper->city.'<br/>
			            '.$shipper->country.'<br/>
			            Attn: '.$shipper->sort_name));
			            ?>
					</div>

					<div style="line-height:15px; margin-top:15px;">
						<strong>Penerima:</strong><br/>
						<?php
			            $consignee = $this->customers_model->get_by_id($details->consignee);
			            echo ucwords(strtolower('
			            '.$consignee->name.'<br/>
			            '.$consignee->address.' '.$shipper->city.'<br/>
			            '.$consignee->country.'<br/>
			            Attn: '.$consignee->sort_name));
			            ?>
					</div>

					<div style="line-height:15px; margin-top:15px;">
						<strong>Keterangan:</strong><br/>
						<?php
			            echo ucfirst(strtolower($details->description));
			            ?>
					</div>
				</div>
			</td>
			<td style="width:50%; vertical-align:top;">
				<table cellspacing="0" cellpadding="0" style="width:100%;">
					<tr style="background-color:#f9f9f9; height:40px;">
						<td style="width:25%; text-align:center; height:25px; vertical-align:middle; border:1px solid #ccc;">PKG</td>
						<td style="width:25%; text-align:center; height:25px; vertical-align:middle; border:1px solid #ccc;">PCS</td>
						<td style="width:25%; text-align:center; height:25px; vertical-align:middle; border:1px solid #ccc;">KG</td>
						<td style="width:25%; text-align:center; height:25px; vertical-align:middle; border:1px solid #ccc;">VALUE</td>
					</tr>
					<tr>
						<td style="text-align:center; text-align:center; height:25px; vertical-align:middle; border:1px solid #ccc;"><?=$details->pkg?></td>
						<td style="text-align:center; text-align:center; height:25px; vertical-align:middle; border:1px solid #ccc;"><?=$details->pcs?></td>
						<td style="text-align:center; text-align:center; height:25px; vertical-align:middle; border:1px solid #ccc;"><?=$details->kg?></td>
						<td style="text-align:center; text-align:center; height:25px; vertical-align:middle; border:1px solid #ccc;"><?=$details->value?></td>
					</tr>
				</table>

				<table cellspacing="0" cellpadding="0" style="width:100%; margin-top:20px;">
					<tr style="height:40px;">
						<td style="width:50%; height:20px;">NT$ Kurs</td>
						<td style="width:50%; text-align:right;"><?=$details->nt_kurs?></td>
					</tr>
					<tr style="height:40px;">
						<td style="width:50%; height:20px;"><strong>Total</strong></td>
						<td style="width:50%; text-align:right;"><?=number_format($details->prepaid * $details->nt_kurs)?></td>
					</tr>
				</table>

				<table cellspacing="0" cellpadding="0" style="width:100%; margin-top:30px;">
					<tr style="height:40px;">
						<td style="width:50%; text-align:center;">Petugas</td>
						<td style="width:50%; text-align:center;">Ttd Penerima</td>
					</tr>
				</table>
				<table cellspacing="0" cellpadding="0" style="width:100%; margin-top:50px;">
					<tr style="height:40px;">
						<td style="width:50%; text-align:center;">Petugas</td>
						<td style="width:50%; text-align:center;">Ttd Penerima</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</page>