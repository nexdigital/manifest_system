<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Manage Kurs
                </div>
                <div class="row" style="padding:5px;">
                    <div class="col-lg-12">
                        <form class="form-inline" id="manage_kurs" method="post" action="<?=base_url()?>administrator/ajax/update_kurs">
                            <div class="form-group">
                                <input type="text" class="form-control" name="kurs" value="<?=$kurs;?>" required>
                            </div>
                            <div class="btn-group btn-group-s">
                                <button type="submit" class="btn btn-primary btn-sm add-user">Update Kurs</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('#manage_kurs').ajaxForm({
        dataType: 'json',
        success: function(data){
            alert(data.message);
        }
    });
})
</script>