<style type="text/css">
.tab-pane {
    padding: 10px 20px;
    border-left: 1px solid #e2e2e2;
    border-right: 1px solid #e2e2e2;
    border-bottom: 1px solid #e2e2e2;
}
</style>

<div id="page-wrapper">
    <div class="row">
    <div class="col-lg-12">
        <div class="col-lg-12">
            <div class="form-group">
                <label>Type Manifest</label>
                <div class="checkbox" style="padding:0px;">
                    <div class="checkbox" style="float:left; margin-right:50px; margin-top:-5px;">
                        <label>
                          <input type="checkbox" class="checkbox" name="type[]" value="import"> Import
                        </label>
                    </div>
                    <div class="checkbox" style="float:left; margin-right:50px">
                        <label>
                          <input type="checkbox" class="checkbox" name="type[]" value="export"> Export
                        </label>
                    </div>
                    <div class="checkbox" style="float:left; margin-right:50px">
                        <label>
                          <input type="checkbox" class="checkbox" name="type[]" value="other"> Other
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
           <!-- <div class="col-lg-6" style="padding:0px 10px 0px 0px;">
                <div class="form-group">
                    <label>Upload Date</label>
                    <input class="form-control" placeholder="Start Date" id="start-date">
                </div>
            </div>
            <div class="col-lg-6" style="padding:0px 0px 0px 10px;">
                <div class="form-group">
                    <label>&nbsp;</label>
                    <input class="form-control" placeholder="End Date" id="end-date">
                </div>
            </div>
        </div>-->

        <div class="col-lg-6" style="padding:0px 10px 0px 0px;">
                <div class="form-group">
                    <label>Upload Date</label>
                        <div class="input-append date form_datetime2">
                                    <input size="16" type="text" value=""  id="start-date"  class="form-control" readonly="">
                                    <span class="add-on"><i class="icon-th"></i></span>
                              </div>
                </div>
            </div>

            <div class="col-lg-6" style="padding:0px 10px 0px 0px;">
                <div class="form-group">
                    <label>Upload Date</label>
                      <div class="input-append date form_datetime2">
                                    <input size="16" type="text" value=""  id="end-date" class="form-control" readonly="">
                                    <span class="add-on"><i class="icon-th"></i></span>
                              </div>
                </div>
            </div>

        <div class="col-lg-12">
            <button type="submit" class="btn btn-success btn-sm" id="download-excel">Download to excel</button>
        </div>
    </div>
</div>

<script type="text/javascript">
var startDate = new Date('01/01/2012');
var FromEndDate = new Date();
var ToEndDate   = new Date();
ToEndDate.setDate(ToEndDate.getDate()+365);

$(document).ready(function(){

    $('select.form-control').select2();

    $('#download-excel').click(function(){
        var type_arr = [];
        $('input.checkbox:checked').each(function(){
            type_arr.push($(this).val());
        })

        $.post('<?=base_url()?>download/manifest/excel',{'type':type_arr,'start_date':$('#start-date').val(),'end_date':$('#end-date').val()},function(url){
            window.open(url,'_blank');
        })
    })

      $(".form_datetime2").datetimepicker({
      format: "yyyy-mm-dd ",
      todayBtn: true,
       minView: 2
  

    });

  /*  $('#start-date').datepicker({
        format:'yyyy-mm-dd',
        weekStart: 1,
        endDate: FromEndDate, 
        autoclose: true
    })
    .on('changeDate', function(selected){
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('#end-date').datepicker('setStartDate', startDate);
    }); 

    $('#end-date').datepicker({
        format:'yyyy-mm-dd',
        weekStart: 1,
        startDate: startDate,
        endDate: ToEndDate,
        autoclose: true
    })
    .on('changeDate', function(selected){
        FromEndDate = new Date(selected.date.valueOf());
        FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
        $('#start-date').datepicker('setEndDate', FromEndDate);
    });*/

})

</script>