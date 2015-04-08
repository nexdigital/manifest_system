<!DOCTYPE html>
<html lang="en">
<head>
	<title>Tracking System</title>
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <link rel="stylesheet" href="<?=base_url() ?>style/css/bootstrap.css">
    <link rel="stylesheet" href="<?=base_url() ?>style/css/bootstrap-theme.css">

    <script type="text/javascript" src="<?=base_url('asset/javascript/jquery-1.11.0.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('asset/javascript/bootstrap.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('asset/javascript/ajax.form.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('asset/javascript/jquery.validate.js')?>"></script>

    <style type="text/css">
    label.error { font-size: 11px; font-family: Tahoma; color:#ff0000; }
    </style>

    <script type="text/javascript">;
    $(document).ready(function(){
    	$('#tracking').validate();
    });
    </script>
</head>
<body>
	<div id="wrapper" style="margin-top:20px;">
		<form id="tracking" method="get" action="<?=base_url()?>tracking/search">
			<div class="col-lg-2">
				<div class="form-group">
					<label>Mawb No</label>
					<input class="form-control" type="text" name="hawb" required>
				</div>
			</div>
			<div class="col-lg-1">
				<div class="form-group">
					<label>&nbsp;</label>
					<button type="submit" class="form-control btn-primary btn-md">Search</button>
				</div>
			</div>
		</form>
	</div>

	<div id="tracking_result">test</div>
</bod>
</html>