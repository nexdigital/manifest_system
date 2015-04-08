<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Snow
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <form method="get" action="<?=base_url()?>report/snow">
                            <div class="col-lg-12">
                                <div class="form-group">
                                <label>Select Date</label>
                                <input class="form-control datepicker" type="text" name="date" value="<?=date('Y-m-d')?>" required>
                                </div>
                            </div>
                            <div class="col-lg-12" style="padding:0px;">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Snow Type</label>
                                        <select class="form-control" name="from" required>
                                        <option value="taiwan">Taiwan</option>
                                        <option value="vietnam">Vietnam</option>
                                        <option value="jakarta">Jakarta</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Snow Type</label>
                                        <select class="form-control" name="to" required>
                                        <option value="jakarta">Jakarta</option>
                                        <option value="vietnam">Vietnam</option>
                                        <option value="taiwan">Taiwan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-sm btn-primary find-data">Find</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('select.form-control').select2();
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        autoclose: true
    })
})
</script>