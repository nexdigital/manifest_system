<script>
$(document).ready(function() {
    var panels = $('.user-infos');
    var panelsButton = $('.dropdown-user');
    panels.hide();

    //Click dropdown
    panelsButton.click(function() {
        //get data-for attribute
        var dataFor = $(this).attr('data-for');
        var idFor = $(dataFor);

        //current button
        var currentButton = $(this);
        idFor.slideToggle(400, function() {
            //Completed slidetoggle
            if(idFor.is(':visible'))
            {
                currentButton.html('<i class="glyphicon glyphicon-chevron-up text-muted"></i>');
            }
            else
            {
                currentButton.html('<i class="glyphicon glyphicon-chevron-down text-muted"></i>');
            }
        })
    });


    $('[data-toggle="tooltip"]').tooltip();

    
});


</script>


<style>


.user-row {
    margin-bottom: 14px;
}

.user-row:last-child {
    margin-bottom: 0;
}

.dropdown-user {
    margin: 13px 0;
    padding: 5px;
    height: 100%;
}

.dropdown-user:hover {
    cursor: pointer;
}

.table-user-information > tbody > tr {
    border-top: 1px solid rgb(221, 221, 221);
}

.table-user-information > tbody > tr:first-child {
    border-top: 0;
}


.table-user-information > tbody > tr > td {
    border-top: 0;
}


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
                        <div class="table-responsive">
                        
                                         
 <div class="well col-xs-8" style="width:100%">
        <div class="row user-row">
        
        		<?php
					$infouser = "2";
					foreach ($list_user as $key => $row) {
						if(strtolower($row->type) == 'admin') $disabled = 'disabled'; else $disabled = '';
						echo '
                                                   <div class="row user-row">
            <div class="col-xs-3 col-sm-2 col-md-1 col-lg-1">
                <img class="img-circle"
                     src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=50"
                     alt="User Pic">
            </div>
            <div class="col-xs-8 col-sm-9 col-md-10 col-lg-10">
                <strong>'.$row->username.'</strong><br>
                <span class="text-muted">User level: '.$row->type.'</span>
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 dropdown-user" data-for=".user'.$infouser.'">
                <i class="glyphicon glyphicon-chevron-down text-muted"></i>
            </div>
        </div>
        <div class="row user-infos user'.$infouser.'">
            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">User information</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 hidden-xs hidden-sm">
                                <img class="img-circle"
                                     src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100"
                                     alt="User Pic">
                            </div>
                            <div class="col-xs-2 col-sm-2 hidden-md hidden-lg">
                                <img class="img-circle"
                                     src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=50"
                                     alt="User Pic">
                            </div>
                            <div class="col-xs-10 col-sm-10 hidden-md hidden-lg">
                                <strong>Cyruxx</strong><br>
                                <dl>
                                    <dt>User level:</dt>
                                    <dd>Administrator</dd>
                                    <dt>Registered since:</dt>
                                    <dd>11/12/2013</dd>
                                    <dt>Topics</dt>
                                    <dd>15</dd>
                                    <dt>Warnings</dt>
                                    <dd>0</dd>
                                </dl>
                            </div>
                            <div class=" col-md-9 col-lg-9 hidden-xs hidden-sm">
                                <strong>'.$row->username.'</strong><br>
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>User level:</td>
                                        <td>'.$row->type.'</td>
                                    </tr>
                                     <tr>
                                        <td>email</td>
                                        <td>'.$row->email.'</td>
                                    </tr>
                                    <tr>
                                        <td>Registered since:</td>
                                        <td>'.$row->created_date.'</td>
                                    </tr>
                                    <tr>
                                        <td>Last Activity</td>
                                        <td>'.$row->last_activity.'</td>
                                    </tr>
                                   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-sm btn-primary" type="button"
                                data-toggle="tooltip"
                                data-original-title="Send message to user"><a href=""><i class="glyphicon glyphicon-envelope"></i></a></button>
                        <span class="pull-right">
                            <button  data-original-title="Edit this user" username="'.$row->username.'" user_id="'.$row->user_id.'" email = "'.$row->email.'"type="'.$row->type.'" password="'.$row->password.'" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning edit-user"><i class="glyphicon glyphicon-edit" "></i></button>
                             <button type="button" class="btn btn-danger '.$disabled.' delete-user" username="'.$row->username.'" user_id="'.$row->user_id.'">Delete</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>';
                                    $infouser++;
									  }
                                    ?>
        
        
    </div>

                           
                        <div class="btn-group btn-group-s">
                            <button type="button" class="btn btn-primary btn-sm add-user">Add User</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>








<div class="modal fade" id="add_user_modal">
<form id="form_add_user" method="post" action="<?=site_url('administrator/ajax/add_user')?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Add User</h4>
      </div>
      <div class="modal-body">
        <p class="message-form-add" style="padding:15px 15px; display:none;"></p>
		
        <div class="form-group">
            <label>Username</label>
            <input class="form-control username" type="text" name="username" min-length="3" placeholder="Enter Username" required/>
        </div>                                             
        <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="password" name="password" min-length="8" placeholder="Enter Password" required/>
        </div>

          <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="email" name="email" min-length="8" placeholder="Enter Email" required/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</form>
</div>

<!-- edit user -->



<div class="modal fade" id="edit_user_modal">
<form id="form_edit_user" method="post" action="<?=site_url('administrator/ajax/edit_user')?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

        <h4 class="modal-title">Edit User</h4>
      </div>
      <div class="modal-body">
        <p class="message-form-edit" style="padding:15px 15px; display:none;"></p>
        <input type="hidden" name="user_id" class="form-control" id="USER_ID_EDIT"/>
        <div class="form-group">
            <label>Username</label>
            <input class="form-control username" type="text" name="username" min-length="3"  required/></span>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="form-control " id="password" type="password" name="password" min-length="8" disabled/>
            <a href="#" class="chg_pass">Change Password</a>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input class="form-control email" type="email" name="email" min-length="8" />
        </div>

		<div class="form-group">
            <label>User Level</label>
           <select name="type" class="form-control type">
				<option value=""></option>
				<option value="admin">admin</option>
				<option value="user">user</option>

			</select>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</form>
</div>



<!-- /edit user -->

<div class="modal fade" id="delete_user_modal">
<form id="form_delete_user" method="post" action="<?=site_url('administrator/ajax/delete_user')?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Delete User</h4>
      </div>
      <div class="modal-body">
        <p class="message-form-delete" style="padding:15px 15px; display:none;"></p>
        <input type="hidden" name="user_id" id="USER_ID_DELETE"/>
        Are you sure want to delete user "<strong><span class="delete-username"><span></strong>"?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</form>
</div>

<script type="text/javascript">
$(document).ready(function(){

    $('.type').select2();

    $('.chg_pass').click(function(){
            $("#password").prop('disabled', false);

    });

    $('.add-user').click(function(){
        $('#form_add_user').resetForm();
        $('#add_user_modal').modal('show');
    })
	$('.edit-user').click(function(){
        user_id = $(this).attr('user_id');
        username = $(this).attr('username');
		password = $(this).attr('password');
		type = $(this).attr('type');
        email = $(this).attr('email');


		$('#USER_ID_EDIT').val(user_id);
        $('.username').val(username);
        $('.email').val(email);
        $(".type").select2("val",type);
		$('.password').val(password);
        $('#edit_user_modal').modal('show');
		
		
    })

    $('.delete-user').click(function(){
        user_id = $(this).attr('user_id');
        username = $(this).attr('username');

        $('#USER_ID_DELETE').val(user_id);
        $('.delete-username').text(username);
        $('#delete_user_modal').modal('show');
		
    })

    $('#form_add_user').ajaxForm({
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
                    $('#add_user_modal').modal('hide');
                    location.reload();
                }, 3000);
            }
        }
    })


	  $('#form_edit_user').ajaxForm({
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
                    $('#edit_user_modal').modal('hide');
                    location.reload();
                }, 3000);
            }
        }
    })


    $('#form_delete_user').ajaxForm({
        dataType: 'json',
        success: function(data){
            if(data.error == 'error') {
                $('.message-form-delete').html(data.message).addClass('bg-danger').removeClass('bg-success').fadeIn();
                setTimeout(function(){
                    $('.message-form-delete').fadeOut();
                }, 3000);
            } else {
                $('.message-form-delete').html(data.message).removeClass('bg-danger').addClass('bg-success').fadeIn();
                setTimeout(function(){
                    $('#add_user_modal').modal('hide');
                    location.reload();
                }, 3000);
            }
        }
    })
})
</script>




          
                    