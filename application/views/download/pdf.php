<table width="580px">
	<tr>
		<td width="525px"><img src="<?=base_url()?>asset/images/tata-logo.png" style="width:350px;"></td>
		<td width="55px"><img src="<?=$qrcode?>" style="width:55px; height:55px; margin-top:50px;"></td>
	</tr>
</table>
<table width="580px">
	<tr>
		<td style="width:380px;">Airwaybill #<?=$details->data_id?></td>
		<td style="width:200px; text-align:right;">Lembar untuk customer</td>
	</tr>
	<tr><td rowspan="2">&nbsp;</td></tr>
</table>
<br/>
<table>
	<tr>
		<td style="width:50%; vertical-align:top;">
			<div>
				<?php
	            $shipper = $this->customers_model->get_by_id($details->shipper);
	            echo '<strong>Pengirim: </strong>'.ucwords(strtolower($shipper->name)).'<br/>';
	            echo ucwords(strtolower('
	            '.$shipper->address.' '.$shipper->city.'<br/>
	            '.$shipper->country.'<br/>
	            Attn: '.$shipper->sort_name));
	            ?><br/><br/>
				<?php
	            $consignee = $this->customers_model->get_by_id($details->consignee);
	            echo '<strong>Penerima: </strong>'.ucwords(strtolower($consignee->name)).'<br/>';
	            echo ucwords(strtolower('
	            '.$consignee->address.' '.$shipper->city.'<br/>
	            '.$consignee->country.'<br/>
	            Attn: '.$consignee->sort_name));
	            ?><br/><br/>
				<strong>Keterangan: </strong><?=ucfirst(strtolower($details->description));?>
			</div>
		</td>
		<td style="width:50%; vertical-align:top;">
			<table cellspacing="0" cellpadding="0" style="width:100%;">
				<tr style="background-color:#f9f9f9; height:40px;">
					<td style="width:25%; text-align:center; vertical-align:middle; border:1px solid #ccc;">pkg</td>
					<td style="width:25%; text-align:center; vertical-align:middle; border:1px solid #ccc;">pcs</td>
					<td style="width:25%; text-align:center; vertical-align:middle; border:1px solid #ccc;">kg</td>
					<td style="width:25%; text-align:center; vertical-align:middle; border:1px solid #ccc;">value</td>
				</tr>
				<tr>
					<td style="text-align:center; text-align:center; vertical-align:middle; border:1px solid #ccc;"><?=$details->pkg?></td>
					<td style="text-align:center; text-align:center; vertical-align:middle; border:1px solid #ccc;"><?=$details->pcs?></td>
					<td style="text-align:center; text-align:center; vertical-align:middle; border:1px solid #ccc;"><?=$details->kg?></td>
					<td style="text-align:center; text-align:center; vertical-align:middle; border:1px solid #ccc;"><?=$details->value?></td>
				</tr>
				<tr><td rowspan="4">&nbsp;</td></tr>
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
				<tr><td rowspan="2">&nbsp;</td></tr>
			</table>

			<table>
				<tr>
					<td style="text-align:center;">Jakarta, <?=date('d m, Y')?></td>
					<td style="text-align:center;">Ttd Penerima</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td style="text-align:center;">Petugas</td>
					<td style="text-align:center;">Ttd Penerima</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<span>.................................................................................................................................................................................................................</span>
<table width="580px">
	<tr>
		<td width="525px"><img src="<?=base_url()?>asset/images/tata-logo.png" style="width:350px;"></td>
		<td width="55px"><img src="<?=$qrcode?>" style="width:55px; height:55px; margin-top:50px;"></td>
	</tr>
</table>
<table width="580px">
	<tr>
		<td style="width:380px;">Airwaybill #<?=$details->data_id?></td>
		<td style="width:200px; text-align:right;">Lembar untuk customer</td>
	</tr>
	<tr><td rowspan="2">&nbsp;</td></tr>
</table>
<br/>
<table>
	<tr>
		<td style="width:50%; vertical-align:top;">
			<div>
				<?php
	            $shipper = $this->customers_model->get_by_id($details->shipper);
	            echo '<strong>Pengirim: </strong>'.ucwords(strtolower($shipper->name)).'<br/>';
	            echo ucwords(strtolower('
	            '.$shipper->address.' '.$shipper->city.'<br/>
	            '.$shipper->country.'<br/>
	            Attn: '.$shipper->sort_name));
	            ?><br/><br/>
				<?php
	            $consignee = $this->customers_model->get_by_id($details->consignee);
	            echo '<strong>Penerima: </strong>'.ucwords(strtolower($consignee->name)).'<br/>';
	            echo ucwords(strtolower('
	            '.$consignee->address.' '.$shipper->city.'<br/>
	            '.$consignee->country.'<br/>
	            Attn: '.$consignee->sort_name));
	            ?><br/><br/>
				<strong>Keterangan: </strong><?=ucfirst(strtolower($details->description));?>
			</div>
		</td>
		<td style="width:50%; vertical-align:top;">
			<table cellspacing="0" cellpadding="0" style="width:100%;">
				<tr style="background-color:#f9f9f9; height:40px;">
					<td style="width:25%; text-align:center; vertical-align:middle; border:1px solid #ccc;">pkg</td>
					<td style="width:25%; text-align:center; vertical-align:middle; border:1px solid #ccc;">pcs</td>
					<td style="width:25%; text-align:center; vertical-align:middle; border:1px solid #ccc;">kg</td>
					<td style="width:25%; text-align:center; vertical-align:middle; border:1px solid #ccc;">value</td>
				</tr>
				<tr>
					<td style="text-align:center; text-align:center; vertical-align:middle; border:1px solid #ccc;"><?=$details->pkg?></td>
					<td style="text-align:center; text-align:center; vertical-align:middle; border:1px solid #ccc;"><?=$details->pcs?></td>
					<td style="text-align:center; text-align:center; vertical-align:middle; border:1px solid #ccc;"><?=$details->kg?></td>
					<td style="text-align:center; text-align:center; vertical-align:middle; border:1px solid #ccc;"><?=$details->value?></td>
				</tr>
				<tr><td rowspan="4">&nbsp;</td></tr>
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
				<tr><td rowspan="2">&nbsp;</td></tr>
			</table>

			<table>
				<tr>
					<td style="text-align:center;">Jakarta, <?=date('d m, Y')?></td>
					<td style="text-align:center;">Ttd Penerima</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td style="text-align:center;">Petugas</td>
					<td style="text-align:center;">Ttd Penerima</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<span>.................................................................................................................................................................................................................</span>
<table width="580px">
	<tr>
		<td width="525px"><img src="<?=base_url()?>asset/images/tata-logo.png" style="width:350px;"></td>
		<td width="55px"><img src="<?=$qrcode?>" style="width:55px; height:55px; margin-top:50px;"></td>
	</tr>
</table>
<table width="580px">
	<tr>
		<td style="width:380px;">Airwaybill #<?=$details->data_id?></td>
		<td style="width:200px; text-align:right;">Lembar untuk customer</td>
	</tr>
	<tr><td rowspan="2">&nbsp;</td></tr>
</table>
<br/>
<table>
	<tr>
		<td style="width:50%; vertical-align:top;">
			<div>
				<?php
	            $shipper = $this->customers_model->get_by_id($details->shipper);
	            echo '<strong>Pengirim: </strong>'.ucwords(strtolower($shipper->name)).'<br/>';
	            echo ucwords(strtolower('
	            '.$shipper->address.' '.$shipper->city.'<br/>
	            '.$shipper->country.'<br/>
	            Attn: '.$shipper->sort_name));
	            ?><br/><br/>
				<?php
	            $consignee = $this->customers_model->get_by_id($details->consignee);
	            echo '<strong>Penerima: </strong>'.ucwords(strtolower($consignee->name)).'<br/>';
	            echo ucwords(strtolower('
	            '.$consignee->address.' '.$shipper->city.'<br/>
	            '.$consignee->country.'<br/>
	            Attn: '.$consignee->sort_name));
	            ?><br/><br/>
				<strong>Keterangan: </strong><?=ucfirst(strtolower($details->description));?>
			</div>
		</td>
		<td style="width:50%; vertical-align:top;">
			<table cellspacing="0" cellpadding="0" style="width:100%;">
				<tr style="background-color:#f9f9f9; height:40px;">
					<td style="width:25%; text-align:center; vertical-align:middle; border:1px solid #ccc;">pkg</td>
					<td style="width:25%; text-align:center; vertical-align:middle; border:1px solid #ccc;">pcs</td>
					<td style="width:25%; text-align:center; vertical-align:middle; border:1px solid #ccc;">kg</td>
					<td style="width:25%; text-align:center; vertical-align:middle; border:1px solid #ccc;">value</td>
				</tr>
				<tr>
					<td style="text-align:center; text-align:center; vertical-align:middle; border:1px solid #ccc;"><?=$details->pkg?></td>
					<td style="text-align:center; text-align:center; vertical-align:middle; border:1px solid #ccc;"><?=$details->pcs?></td>
					<td style="text-align:center; text-align:center; vertical-align:middle; border:1px solid #ccc;"><?=$details->kg?></td>
					<td style="text-align:center; text-align:center; vertical-align:middle; border:1px solid #ccc;"><?=$details->value?></td>
				</tr>
				<tr><td rowspan="4">&nbsp;</td></tr>
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
				<tr><td rowspan="2">&nbsp;</td></tr>
			</table>

			<table>
				<tr>
					<td style="text-align:center;">Jakarta, <?=date('d m, Y')?></td>
					<td style="text-align:center;">Ttd Penerima</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td style="text-align:center;">Petugas</td>
					<td style="text-align:center;">Ttd Penerima</td>
				</tr>
			</table>
		</td>
	</tr>
</table>