<script type="text/javascript">
  $(document).ready(function() {
    $('#example').dataTable();

     var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');

} );

</script>

<style>



</style>

<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Manage User
                </div>

                <div class="row" style="padding:5px;">
                    <div class="col-lg-12">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Company Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Country</th>
                <th>Zip Code</th>
                <th>Telephone</th>
                <th>Email</th>
                <th>Type Business</th>
                <th>Action</th>
            </tr>
        </thead>


        <tbody>
                <?php foreach($get_partner as $key => $val){

                 echo "<tr>";
                 echo "<td>".$val->company_name."</td>";
                 echo "<td>".$val->address."</td>";
                 echo "<td>".$val->city."</td>";
                 echo "<td>".$val->country."</td>";
                 echo "<td>".$val->zipcode."</td>";
                 echo "<td>".$val->telephone_number."</td>";
                 echo "<td>".$val->email."</td>";
                 echo "<td>".$val->type_business."</td>";
                  echo  "<td><a href='#'><i class='glyphicon glyphicon-pencil edit edit-modal' id=".$val->partner_id." company_name=".$val->company_name." address=".$val->address." city=".$val->city." country=".$val->country." zipcode=".$val->zipcode." telephone=".$val->telephone_number." email=".$val->email." type=".$val->type_business."> </i></a>
                            <a href='#'><i class='glyphicon glyphicon-remove remove' id=".$val->partner_id." company_name=".$val->company_name."></i></a>

                    </td>";

                } ?>


        </tbody>
    </table>

    <!-- Large modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span>Add Partner</button>


                    </div>
                </div>
              </div>
          </div>
     </div>
</div>

<!-- Modal -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form  method="post" action="<?=base_url()?>administrator/ajax_partner/add_partner" id="form_add_partner">

 <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Partner</h4>
      </div>
      <div class="modal-body">
           <p class="message-form-add" style="padding:15px 15px; display:none;"></p>
<div class="stepwizard">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
            <p>Step 1</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
            <p>Step 2</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
            <p>Step 3</p>
        </div>
    </div>
</div>
    <div class="row setup-content" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12">

                <div class="form-group">
                    <label class="control-label">Company Name</label>
                    <input  maxlength="100" name="company_name" type="text" required="required" class="form-control"   />
                </div>
                <div class="form-group">
                    <label class="control-label">Address</label>
                    <input maxlength="100" type="text" name="address" required="required" class="form-control"/>
                </div>
                <div class="form-group">
                    <label class="control-label">City</label>
                    <input maxlength="100" type="text" name="city" required="required" class="form-control "/>
                </div>
                <div class="form-group">
                                    <label class="control-label">Country</label>
                                    <select class="form-control" name="country" required>
                                <?php
                                    foreach ($this->customers_model->list_country() as $key => $value) {
                                        $selected = (strtolower($value) == 'indonesia') ? 'selected' : '';
                                        echo '<option value="'.$value.'" '.$selected.'>'.$value.'</option>';
                                    }
                                ?>
                                     </select>
                </div>

                <div class="form-group">
                    <label class="control-label">Zip Code</label>
                    <input maxlength="100" type="text" name="zipcode" required="required" class="form-control"/>
                </div>
                <button class="btn btn-primary nextBtn  pull-right" type="button" >Next</button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-2">
        <div class="col-xs-12">
            <div class="col-md-12">

                <div class="form-group">
                    <label class="control-label">Telephone Number</label>
                    <input maxlength="200" type="text" name="telephone_number" required="required" class="form-control" />
                </div>
                <div class="form-group">
                    <label class="control-label">Email</label>
                    <input maxlength="200" type="text" name="email" required="required" class="form-control"  />
                </div>
                <button class="btn btn-primary nextBtn pull-right" type="button" >Next</button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12">
              <div class="form-group">
                    <label class="control-label">Type Business</label>
                    <input maxlength="200" type="text" name="type_business" required="required" class="form-control"  />
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                <input type="submit" name="finish" value="Finish" class="btn btn-success" id="btn-finish">


             </div>
            </div>
        </div>
    </div>


      </div>

    </div>
  </div>
</form>
</div>
 <!-- Modal -->



 <!-- Modal Edit -->

<div class="modal fade" id="edit_form_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form  method="post" action="<?=base_url()?>administrator/ajax_partner/edit_partner" id="form_edit_partner">

 <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Partner</h4>
      </div>
      <div class="modal-body">
         <p class="message-form-edit" style="padding:15px 15px; display:none;"></p>
           <div class="tabbable-panel">
				<div class="tabbable-line">
					<ul class="nav nav-tabs ">
						<li class="active">
							<a href="#tab_default_1" data-toggle="tab">
							Tab 1 </a>
						</li>
						<li>
							<a href="#tab_default_2" data-toggle="tab">
							Tab 2 </a>
						</li>
						<li>
							<a href="#tab_default_3" data-toggle="tab">
							Tab 3 </a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_default_1">

                        <input type="hidden" class="id" name="partner_id">
							 <div class="form-group">
                                <label class="control-label">Company Name</label>
                                <input  maxlength="100" name="company_name" type="text" required="required" class="form-control company"   />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Address</label>
                                    <input maxlength="100" type="text" name="address" required="required" class="form-control address"/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">City</label>
                                    <input maxlength="100" type="text" name="city" required="required" class="form-control city"/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Country</label>
                                    <select class="form-control country" name="country" required>
                                <?php
                                    foreach ($this->customers_model->list_country() as $key => $value) {
                                        $selected = (strtolower($value) == 'indonesia') ? 'selected' : '';
                                        echo '<option value="'.$value.'" '.$selected.'>'.$value.'</option>';
                                    }
                                ?>
                                     </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Zip Code</label>
                                    <input maxlength="100" type="text" name="zipcode" required="required" class="form-control zipcode"/>
                                </div>
						</div>
						<div class="tab-pane" id="tab_default_2">
							<div class="form-group">
                                <label class="control-label">Telephone Number</label>
                                <input maxlength="200" type="text" name="telephone_number" required="required" class="form-control telephone" />
                            </div>
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <input maxlength="200" type="text" name="email" required="required" class="form-control email"  />
                            </div>
						</div>
						<div class="tab-pane" id="tab_default_3">
							 <div class="form-group">
                                <label class="control-label">Type Business</label>
                                <input maxlength="200" type="text" name="type_business" required="required" class="form-control type"  />
                            </div>
                             <input type="submit" name="edit" value="Finish" class="btn btn-success" id="btn-finish">
						</div>
					</div>
                </div>
           </div>


    </div>

    </div>
  </div>
</form>
</div>
 <!--/modal edit-->

 <!--Remove -->
<div class="modal fade" id="delete_partner_modal">
<form id="form_delete_user" method="post" action="<?=site_url('administrator/ajax_partner/remove_partner')?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Delete User</h4>
      </div>
      <div class="modal-body">
      <p class="message-form-edit" style="padding:15px 15px; display:none;"></p>
        <p class="message-form-delete" style="padding:15px 15px; display:none;"></p>
        <input type="hidden" name="partner_id" id="partner_id"/>
        Are you sure want to delete partner "<strong><span class="company"></span></strong>"?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-primary">Delete Partner</button>
      </div>
    </div>
  </div>
</form>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('.remove').click(function(){
      id = $(this).attr('id');
      company = $(this).attr('company_name');
     $('#delete_partner_modal').modal('show');

      $('#partner_id').val(id);
      $('.company').text(company);
    })


    $('.edit-modal').click(function(){
       $('#edit_form_modal').modal('show');
       id = $(this).attr('id');
       company = $(this).attr('company_name');
       address = $(this).attr('address');
       city = $(this).attr('city');
       country = $(this).attr('country');
       zipcode = $(this).attr('zipcode');
       telephone = $(this).attr('telephone');
       email = $(this).attr('email');
       type = $(this).attr('type');

        $('.id').val(id);
        $('.company').val(company);
        $('.address').val(address);
        $('.city').val(city);
        $('.country').val(country);
        $('.zipcode').val(zipcode);
        $('.telephone').val(telephone);
        $('.email').val(email);
        $('.type').val(type);

    })

    $('#form_add_partner').ajaxForm({
        dataType: 'json',
        success: function(data){

         if(data.error == 'error') {
                $('.message-form-add').html(data.message).addClass('bg-danger').removeClass('bg-success').fadeIn();
                setTimeout(function(){
                    $('.message-form-add').fadeOut();
                }, 3000);
            } else {
                $('.message-form-add').html(data.message).removeClass('bg-danger').addClass('bg-success').fadeIn();
                setTimeout(function(){
                    $('#myModal').modal('hide');
                    location.reload();
                }, 3000);
            }
        }
    })

    $('#form_edit_partner').ajaxForm({
        dataType: 'json',
        success: function(data){

         if(data.error == 'error') {
                $('.message-form-edit').html(data.message).addClass('bg-danger').removeClass('bg-success').fadeIn();
                setTimeout(function(){
                    $('.message-form-edit').fadeOut();
                }, 3000);
            } else {
                $('.message-form-edit').html(data.message).removeClass('bg-danger').addClass('bg-success').fadeIn();
                setTimeout(function(){
                    $('#edit_form_modal').modal('hide');
                    location.reload();
                }, 3000);
            }
        }
    })

     $('#delete_partner_modal').ajaxForm({
        dataType: 'json',
        success: function(data){

         if(data.error == 'error') {
                $('.message-form-delete').html(data.message).addClass('bg-danger').removeClass('bg-success').fadeIn();
                setTimeout(function(){
                    $('.message-form-edit').fadeOut();
                }, 3000);
            } else {
                $('.message-form-delete').html(data.message).removeClass('bg-danger').addClass('bg-success').fadeIn();
                setTimeout(function(){
                    $('#edit_form_modal').modal('hide');
                    location.reload();
                }, 3000);
            }
        }
    })


});


</script>

