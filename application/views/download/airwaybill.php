<?php
$manifest = $this->manifest_model->get_by_hawb_no($details->hawb_no);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Airway Bill</title>
<link rel="stylesheet" href="<?=base_url() ?>style/css/airwaybill.css">
</head>
<body>
<div class="paper">
    <div class="contaier border-line" style="max-height:96mm;">
        <div class="header">
            <img src="<?=base_url()?>download/barcode/QRCODE/<?=$details->hawb_no?>" class="barcode" style="float:left; height:60px; width:60px; margin-right:20px;">
            <img src="<?=base_url()?>asset/images/tata-logo.png" class="logo" style="float:left; height:55px; margin-top:5px;">
            <img src="<?=base_url()?>download/barcode/1D/<?=$details->hawb_no?>" class="barcode" style="float:right; margin-top:5px; height:50px;">
        </div>
        <div class="info">
            <table style="width:100%:"><tr>
            <td style="width:50%;">Airwaybill #<?=$details->hawb_no?></td>
            <td style="text-align:right;">Lembar THS</td>
            </tr></table>
        </div>
        <div class="content" style="height:20px;">
            <div class="shipment">
                <strong>From Sender:</strong> <?=ucwords(strtolower($details->shipper))?>

                <div style="margin:7px 0px;"><strong>To Consignee:</strong> <?=ucwords(strtolower($details->consignee))?>
                
                </div>

                <strong>Keterangan:</strong> <?=$details->description?>

            </div>

            <div class="details">
                <div class="item-field">                    
                    <div class="item">Pkg</div>
                    <div class="value"><?=$details->pkg?></div>
                    
                    <div class="item">Kg</div>
                    <div class="value"><?=$details->kg?></div>

                    <?php if($details->show_total == 'true') { ?>

                    <div class="item">Exchange Rate <?php if($this->discount->check($manifest->data_id,'rate',array('Approved')) == false) echo '<em>discount: '.$this->discount->get_by_data_id($details->data_id,'rate')->discount.'</em>';?></div>
                    <div class="value">
                        <?php
                        $kurs = $details->kurs;
                        if($this->discount->check($manifest->data_id,'kurs',array('Approved')) == false) {
                            $kurs = $kurs - $this->discount->get_by_data_id($manifest->data_id,'kurs')->discount;
                            echo '('.$details->kurs.') ';
                        }
                        echo $kurs;
                        ?>

                    </div>

                    <div class="item">Rate/kg <?php if($this->discount->check($manifest->data_id,'value',array('Approved')) == false) echo '<em>discount: '.$this->discount->get_by_data_id($manifest->data_id,'value')->discount.'</em>';?></div>
                    <div class="value">
                        <?php
                        $rate = $details->rate;
                        if($this->discount->check($manifest->data_id,'rate',array('Approved')) == false) {
                            $rate = $value - $this->discount->get_by_data_id($manifest->data_id,'rate')->discount;
                            echo '('.$details->rate.') ';
                        }
                        echo $rate;
                        ?>

                    </div>

                    <?php
                    $extra_total = 0;
                    if($extra_charge != false) {
                        foreach ($extra_charge as $row) {
                            echo '<div class="item">'.ucfirst(strtolower($row->type)).' <em>('.$row->description.')</em></div><div class="value">'.number_format($row->price).'</div>';
                            if($row->currency == 'nt') $rate = $rate + $row->price;
                            else $extra_total = $extra_total + $row->price; 
                        }
                    }
                    ?>
                    <div class="item"><strong>Total (Rp)</strong> <?php if($this->discount->check($manifest->data_id,'total',array('Approved')) == false) echo '<em>discount: '.$this->discount->get_by_data_id($details->data_id,'total')->discount.'</em>';?></div>
                    <div class="value">
                        <?php
                        $total = ($rate * $details->kg);
                        $total = $total * $kurs;
                        $total = $total + $extra_total;
                        echo number_format($total);
                        ?>

                    </div>
                    <?php } ?>
                </div>
                <div class="signature">
                    <div class="item">Jakarta, <?=date('dS m, Y')?></div><div class="value">Tanda tangan</div>
                    <div class="item" style="margin-top:40px;">Sales</div><div class="value" style="margin-top:40px;">Nama</div>
                </div>
            </div>
        </div>
    </div>

    <div class="contaier border-line" style="margin-top:7px; max-height:96mm;">
        <div class="header">
            <img src="<?=base_url()?>download/barcode/QRCODE/<?=$details->hawb_no?>" class="barcode" style="float:left; height:60px; width:60px; margin-right:20px;">
            <img src="<?=base_url()?>asset/images/tata-logo.png" class="logo" style="float:left; height:55px; margin-top:5px;">
            <img src="<?=base_url()?>download/barcode/1D/<?=$details->hawb_no?>" class="barcode" style="float:right; margin-top:5px; height:50px;">
        </div>
        <div class="info">
            <table style="width:100%:"><tr>
            <td style="width:50%;">Airwaybill #<?=$details->hawb_no?></td>
            <td style="text-align:right;">Lembar Arsip</td>
            </tr></table>
        </div>
        <div class="content" style="height:20px;">
            <div class="shipment">
                <strong>From Sender:</strong> <?=ucwords(strtolower($details->shipper))?>

                <div style="margin:7px 0px;"><strong>To Consignee:</strong> <?=ucwords(strtolower($details->consignee))?>
                
                </div>

                <strong>Keterangan:</strong> <?=$details->description?>

            </div>

            <div class="details">
                <div class="item-field">                    
                    <div class="item">Pkg</div>
                    <div class="value"><?=$details->pkg?></div>
                    
                    <div class="item">Kg</div>
                    <div class="value"><?=$details->kg?></div>

                    <?php if($details->show_total == 'true') { ?>

                    <div class="item">Exchange Rate <?php if($this->discount->check($manifest->data_id,'rate',array('Approved')) == false) echo '<em>discount: '.$this->discount->get_by_data_id($details->data_id,'rate')->discount.'</em>';?></div>
                    <div class="value">
                        <?php
                        $kurs = $details->kurs;
                        if($this->discount->check($manifest->data_id,'kurs',array('Approved')) == false) {
                            $kurs = $kurs - $this->discount->get_by_data_id($manifest->data_id,'kurs')->discount;
                            echo '('.$details->kurs.') ';
                        }
                        echo $kurs;
                        ?>

                    </div>

                    <div class="item">Rate/kg <?php if($this->discount->check($manifest->data_id,'value',array('Approved')) == false) echo '<em>discount: '.$this->discount->get_by_data_id($manifest->data_id,'value')->discount.'</em>';?></div>
                    <div class="value">
                        <?php
                        $rate = $details->rate;
                        if($this->discount->check($manifest->data_id,'rate',array('Approved')) == false) {
                            $rate = $value - $this->discount->get_by_data_id($manifest->data_id,'rate')->discount;
                            echo '('.$details->rate.') ';
                        }
                        echo $rate;
                        ?>

                    </div>

                    <?php
                    $extra_total = 0;
                    if($extra_charge != false) {
                        foreach ($extra_charge as $row) {
                            echo '<div class="item">'.ucfirst(strtolower($row->type)).' <em>('.$row->description.')</em></div><div class="value">'.number_format($row->price).'</div>';
                            if($row->currency == 'nt') $rate = $rate + $row->price;
                            else $extra_total = $extra_total + $row->price; 
                        }
                    }
                    ?>
                    <div class="item"><strong>Total (Rp)</strong> <?php if($this->discount->check($manifest->data_id,'total',array('Approved')) == false) echo '<em>discount: '.$this->discount->get_by_data_id($details->data_id,'total')->discount.'</em>';?></div>
                    <div class="value">
                        <?php
                        $total = ($rate * $details->kg);
                        $total = $total * $kurs;
                        $total = $total + $extra_total;
                        echo number_format($total);
                        ?>

                    </div>
                    <?php } ?>
                </div>
                <div class="signature">
                    <div class="item">Jakarta, <?=date('dS m, Y')?></div><div class="value">Tanda tangan</div>
                    <div class="item" style="margin-top:40px;">Sales</div><div class="value" style="margin-top:40px;">Nama</div>
                </div>
            </div>
        </div>
    </div>

    <div class="contaier" style="margin-top:7px; max-height:96mm;">
        <div class="header">
            <img src="<?=base_url()?>download/barcode/QRCODE/<?=$details->hawb_no?>" class="barcode" style="float:left; height:60px; width:60px; margin-right:20px;">
            <img src="<?=base_url()?>asset/images/tata-logo.png" class="logo" style="float:left; height:55px; margin-top:5px;">
            <img src="<?=base_url()?>download/barcode/1D/<?=$details->hawb_no?>" class="barcode" style="float:right; margin-top:5px; height:50px;">
        </div>
        <div class="info">
            <table style="width:100%:"><tr>
            <td style="width:50%;">Airwaybill #<?=$details->hawb_no?></td>
            <td style="text-align:right;">Lembar Penerima</td>
            </tr></table>
        </div>
        <div class="content" style="height:20px;">
            <div class="shipment">
                <strong>From Sender:</strong> <?=ucwords(strtolower($details->shipper))?>

                <div style="margin:7px 0px;"><strong>To Consignee:</strong> <?=ucwords(strtolower($details->consignee))?>
                
                </div>

                <strong>Keterangan:</strong> <?=$details->description?>

            </div>

            <div class="details">
                <div class="item-field">                    
                    <div class="item">Pkg</div>
                    <div class="value"><?=$details->pkg?></div>
                    
                    <div class="item">Kg</div>
                    <div class="value"><?=$details->kg?></div>

                    <?php if($details->show_total == 'true') { ?>

                    <div class="item">Exchange Rate <?php if($this->discount->check($manifest->data_id,'rate',array('Approved')) == false) echo '<em>discount: '.$this->discount->get_by_data_id($details->data_id,'rate')->discount.'</em>';?></div>
                    <div class="value">
                        <?php
                        $kurs = $details->kurs;
                        if($this->discount->check($manifest->data_id,'kurs',array('Approved')) == false) {
                            $kurs = $kurs - $this->discount->get_by_data_id($manifest->data_id,'kurs')->discount;
                            echo '('.$details->kurs.') ';
                        }
                        echo $kurs;
                        ?>

                    </div>

                    <div class="item">Rate/kg <?php if($this->discount->check($manifest->data_id,'value',array('Approved')) == false) echo '<em>discount: '.$this->discount->get_by_data_id($manifest->data_id,'value')->discount.'</em>';?></div>
                    <div class="value">
                        <?php
                        $rate = $details->rate;
                        if($this->discount->check($manifest->data_id,'rate',array('Approved')) == false) {
                            $rate = $value - $this->discount->get_by_data_id($manifest->data_id,'rate')->discount;
                            echo '('.$details->rate.') ';
                        }
                        echo $rate;
                        ?>

                    </div>

                    <?php
                    $extra_total = 0;
                    if($extra_charge != false) {
                        foreach ($extra_charge as $row) {
                            echo '<div class="item">'.ucfirst(strtolower($row->type)).' <em>('.$row->description.')</em></div><div class="value">'.number_format($row->price).'</div>';
                            if($row->currency == 'nt') $rate = $rate + $row->price;
                            else $extra_total = $extra_total + $row->price; 
                        }
                    }
                    ?>
                    <div class="item"><strong>Total (Rp)</strong> <?php if($this->discount->check($manifest->data_id,'total',array('Approved')) == false) echo '<em>discount: '.$this->discount->get_by_data_id($details->data_id,'total')->discount.'</em>';?></div>
                    <div class="value">
                        <?php
                        $total = ($rate * $details->kg);
                        $total = $total * $kurs;
                        $total = $total + $extra_total;
                        echo number_format($total);
                        ?>

                    </div>
                    <?php } ?>
                </div>
                <div class="signature">
                    <div class="item">Jakarta, <?=date('dS m, Y')?></div><div class="value">Tanda tangan</div>
                    <div class="item" style="margin-top:40px;">Sales</div><div class="value" style="margin-top:40px;">Nama</div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<html>
