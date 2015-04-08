<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       Customer Form
                    </div>
                    <div class="panel-body">
                      <div class="stepwizard">
                        <div class="stepwizard-row setup-panel">
                          <div class="stepwizard-step">
                            <a href="#step-1" type="button" class="btn btn-primary btn-circle step-1">1</a>
                            <p>Step 1</p>
                          </div>
                          <div class="stepwizard-step">
                            <a href="#step-2" type="button" class="btn btn-default btn-circle step-2">2</a>
                            <p>Step 2</p>
                          </div>
                          <div class="stepwizard-step">
                            <a href="#step-3" type="button" class="btn btn-default btn-circle step-3">3</a>
                            <p>Step 3</p>
                          </div>
                        </div>
                      </div>
                      <div class="row setup-content step-content" id="step-1">
                        <form id="form_step_1">
                        <div class="col-xs-12">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Reference Id</label>
                              <input id="reference_id"  name="reference_id"  type="text"  class="form-control" value="<?= $refcust ?>" readonly="readonly">
                            </div>

                            <div class="form-group">
                              <label>Name</label>
                              <input id="name" name="name" required="required" type="text" class="form-control" required>
                            </div>

                            <div class="form-group">
                              <label >E-mail</label>
                              <input id="email" name="email" type="email" class="form-control" required>
                            </div>

                            <div class="form-group">
                              <label>Address</label>
                              <textarea class="form-control" name="cust_address" style="resize:none" required></textarea>
                            </div>

                            <div class="form-group">
                              <label>Attn</label>
                              <input id="attn" name="attn" type="text" class="form-control">
                            </div>     

                            <div class="form-group">
                              <label >State</label>
                              <input id="state" name="state" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                              <label>City</label>
                              <input id="city" name="city" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                              <label>Country</label>
                              <select class="form-control bfh-states country" name="country">
                              <?php
                              foreach ($this->customers_model->list_country() as $key => $value) {
                                  $selected = (strtolower($value) == 'indonesia') ? 'selected' : '';
                                  echo '<option value="'.$value.'" '.$selected.'>'.$value.'</option>';
                              }
                              ?>
                              </select>
                            </div>

                            <div class="form-group">
                              <label >Post Code</label>
                              <input id="post_code" name="post_code" type="text" class="form-control">
                            </div>
                            <nav>
                              <ul class="pager">
                                <li class="next"><a href="#" step="1">Next <span aria-hidden="true">&rarr;</span></a></li>
                              </ul>
                            </nav>
                          </div>
                        </div>
                        </form>
                      </div>
                      <div class="row setup-content step-content" id="step-2" style="display:none;">
                        <form id="form_step_2">
                        <div class="col-xs-12">
                          <div class="col-md-12">
                            <div class="form-group" >
                              <label>Phone</label>
                              <input id="phone" name="phone" type="phone" class="form-control" required>
                            </div>

                            <div class="form-group">
                              <label >Mobile</label>
                              <input id="mobile" name="mobile" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                              <label >Fax</label>
                              <input id="fax" name="fax" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                              <label >Bank Branch</label>
                              <input id="bank_branch" name="bank_branch" type="text" class="form-control"> 
                            </div>

                            <div class="form-group">
                              <label >Bank Code</label>
                              <input id="bank_code" name="bank_code" type="text" class="form-control">
                            </div>     

                            <div class="form-group">
                              <label >Bank Account</label>
                              <input id="bank_account" name="bank_account" type="text" class="form-control">
                            </div>
                            <nav>
                              <ul class="pager">
                                <li class="previous"><a href="#" step="2"><span aria-hidden="true">&larr;</span> Back</a></li>
                                <li class="next"><a href="#" step="2">Next <span aria-hidden="true">&rarr;</span></a></li>
                              </ul>
                            </nav>
                          </div>
                        </div>
                        </form>
                      </div>
                      <div class="row setup-content step-content" id="step-3" style="display:none;">
                        <form id="form_step_3">
                        <div class="col-xs-12">
                          <div class="col-md-12">
                            <div class="form-group" style="margin-top:10px;">
                              <label >Tax Class</label>
                              <select class="form-control tax_class" name="tax_class">
                                <option value="0">None</option>
                                <option value="1">1%</option>
                                <option value="10">10%</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label >VAT Doc</label>
                              <input id="vat_doc" name="vat_doc" type="text" placeholder="" class="form-control">
                            </div>

                            <div class="form-group">
                              <label>Type</label>
                              <select required class="form-control customer-type" name="type">
                                <option value="shipper">Shipper</option>
                                <option value="consignee">Consignee</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label>Status</label>
                              <select class="form-control" name="status" >
                                <option value="0">None</option>
                                <option value="regular">regular customer</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label >Register Doc</label>
                              <input id="register_doc" name="register_doc" type="text" placeholder="" class="form-control">	
                            </div>

                            <div class="form-group">
                              <label >Register Date</label>
                              <div class='input-group date' id='datetimepicker1'>
                                <input type="text" name="register_date" class="form-control" id="register_date" readonly>
                                <span class="input-group-addon datapicker"><i class="glyphicon glyphicon-th"></i></span>
                              </div>
                            </div>

                            <div class="form-group">
                              <label>Due Date Payment</label>
                              <div class='input-group date' id='datetimepicker1'>
                                <input type="text" class="form-control" id="due_date" name="due_date_payment" readonly>
                                <span class="input-group-addon datapicker"><i class="glyphicon glyphicon-th"></i></span>
                              </div>
                            </div>

                            <div class="form-group">
                              <label>Price Index</label>                 
                              <input id="price_index" name="price_index" type="text" placeholder="" class="form-control">      
                            </div>

                            <div class="form-group">
                              <label>Payment Type</label>
                              <select class="form-control" name="payment_type" class="payment-type">
                                <option value="cash">Cash</option>
                                <option value="transfer">transfer</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label>Payment Terms</label>
                              <input id="payment_terms" name="payment_terms" type="text" class="form-control">Days						
                            </div>

                            <div class="form-group">
                              <label>Credit Limit</label>
                              <input id="credit_limit" name="credit_limit" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                              <label>Discount per weight</label>
                              <input id="discount" name="discount" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                              <label >Remark</label>
                              <textarea class="form-control" id="remark" name="remark" rows="5" style="resize:none"></textarea>
                            </div>

                            <div class="form-group">
                              <label></label>
                              <div class="checkbox">
                                <label><input type="checkbox" value="active" name="active_status">Active Status</label>
                              </div>
                            </div>
                            <nav>
                              <ul class="pager">
                                <li class="previous"><a href="#" step="3"><span aria-hidden="true">&larr;</span> Back</a></li>
                                <li class="next"><a href="#" step="3">Register</a></li>
                              </ul>
                            </nav>
                          </div>
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
$(document).ready(function () {
  var step_elm = $('.stepwizard-step');
  var step_cont = $('.step-content');

  $('.country, .customer-type, .tax_class').select2();
  $('.input-group.date').datepicker({
    format: "yyyy-m-d",
    keyboardNavigation: false,
    forceParse: false,
    autoclose: true
  });

  $('li.next a').click(function(){
    step = $(this).attr('step');
    next = parseInt(step) + 1;
    if(step <= 3) {
      if($('#form_step_' + step).valid()) {
        if(step == 3) {
          data = $('#form_step_1, #form_step_2, #form_step_3').serialize();
          $.ajax({
            url: '<?=base_url()?>customers/ajax/register',
            type: 'post',
            dataType: 'json',
            data: data,
            success: function(json) {
              if(json.status == true) {
                bootbox.alert("Register success", function(){
                  window.location = '<?=base_url()?>';
                })
              }
            }
          })
        } else {
          step_elm.find('a').removeClass('btn-primary').addClass('btn-default');
          step_elm.find('.step-' + next).addClass('btn-primary');
          step_cont.hide();
          $('#step-' + next).show();
        }

      }
    }
  })
  $('li.previous a').click(function(){
    step = $(this).attr('step');
    prev = parseInt(step) - 1;
    if(step > 1) {
      step_elm.find('a').removeClass('btn-primary').addClass('btn-default');
      step_elm.find('.step-' + prev).addClass('btn-primary');
      step_cont.hide();
      $('#step-' + prev).show();
    }
  })
})
</script>
  