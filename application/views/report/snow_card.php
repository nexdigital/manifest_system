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
                                 <div class="input-append date form_datetime2">
                                  <input size="16" type="text" value="" name="date" class="form-control" readonly="">
                                    <span class="add-on"><i class="icon-th"></i></span>
                              </div>
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

     $('a[href^="#"]').click(function(){  
        var the_id = $(this).attr("href");  
        $('html, body').animate({  
            scrollTop:$(the_id).offset().top  
        }, 'slow');  
        return false;  
    });

    $(".form_datetime1").datetimepicker({format: 'yyyy-mm-dd hh:ii', forceParse: true});
    $(".form_datetime2").datetimepicker({
      format: "yyyy-mm-dd ",
      todayBtn: true,
       minView: 2
  

    });
    
})
</script>