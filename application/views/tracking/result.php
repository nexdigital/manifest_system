<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tracking System</title>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <link rel="stylesheet" href="<?=base_url() ?>style/css/bootstrap.css">
    <link rel="stylesheet" href="<?=base_url() ?>style/css/bootstrap-theme.css">

    <script type="text/javascript" src="<?=base_url('asset/javascript/jquery-1.11.0.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('asset/javascript/bootstrap.min.js')?>"></script>
    <?php if($result != false) { ?>
    <script type="text/javascript">
    var id = []; var en = [];

    $( document ).ajaxStart(function() {
        console.log( "Ajax Loaded" );
        $('#ajax-loaded').fadeIn();
        $('.wrapper').hide();
    });

   $( document ).ajaxStop(function() {
        console.log( "Ajax Stoped" );
        $('#ajax-loaded').fadeOut();
        $('.wrapper').fadeIn();
    });

    $(document).ready(function(){
        $('table').addClass('table').addClass('table-bordered');
        $('table tr:eq(0), table tr:eq(3)').remove();
        $('table tr:eq(0) td').attr('colspan','4');

        for(var index = 3; index <= $('table tr').length - 1; index++)
        {
            $('table tr:eq( '+index+' ) td:eq(1)').attr('colspan','2').addClass('row-field');
            var string = $('table tr:eq( '+index+' ) td:eq(1) font').html();
            $('table tr:eq( '+index+' ) td:eq(1)').attr('real',string);
        }

        var indexRow = 0;
        $('td.row-field').each(function(){
            var real = $(this).attr('real');
            $.getJSON('<?=base_url('tracking/translate')?>',{'string':real,'to':'id','index':indexRow}, function(data) {
                id[data.index] = data.translation;
            })
            $.getJSON('<?=base_url('tracking/translate')?>',{'string':real,'to':'en','index':indexRow}, function(data) {
                en[data.index] = data.translation;
            })
            indexRow++;
        })
    })

    function translate(lang) {
        if(lang == 'default') {
           $('td.row-field').each(function(){
            var real = $(this).attr('real');
            $(this).find('font').html(real);
           })
        }
        else if(lang == 'id')
        {
            no = 0;
            $('td.row-field').each(function(){
                $(this).find('font').html(id[no]);
                no++;
            })
        }
        else if(lang == 'en')
        {
            no = 0;
            $('td.row-field').each(function(){
                $(this).find('font').html(en[no]);
                no++;
            })
        }
    }
    </script>
    <?php } ?>

</head>
<body>

<div id="ajax-loaded" style="display:none; top:0; right:0; padding:0px 10px; width:200px; height:25px; line-height:25px; z-index:9999; position:fixed; background-color:#ff0000; color:#fff; font-weight:bold; opacity:2em;">
Loading . . .
</div>

<div class="col-lg-12" style="margin-top:20px;">
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

<div class="wrapper col-lg-12">
    <?php if($result != false) { 
        echo $result; ?>
    <div class="col-lg-12">
        <a href="javascript:;" onCLick="translate('id')" title="Translate to Indonesian"><img src="<?=base_url('asset/images/indonesia-icon.png')?>" width="50px" height="30px" /></a>
        <a href="javascript:;" onCLick="translate('en')" title="Translate to English"><img src="<?=base_url('asset/images/english-icon.png')?>" width="50px" height="30px" /></a>
        <a href="javascript:;" onCLick="translate('default')" title="Translate to Default"><img src="<?=base_url('asset/images/china-icon.png')?>" width="50px" height="30px" /></a>
    </div>
    <?php } ?>
</div>
</body>
</html>