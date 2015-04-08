 <script> 
        // wait for the DOM to be loaded 
        $(document).ready(function() { 
            // bind 'myForm' and provide a simple callback function 
            $('#myForm').ajaxForm(function() { 
                alert("Register Success"); 
				
            }); 
        }); 
		
		
		
		
		
    </script> 
    <link rel="stylesheet" href="<?=base_url() ?>style/css/chat.css">
<form id="myform" method="post" action="<?= base_url()?>home">
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span> Chat
                   
                </div>
                <div class="panel-body" id="mychat">
                    <ul class="chat">
                         <?php 
						$userid = $this->session->userdata('user_id');
						foreach($getChat as $key => $val){
							if($val->user != $userid){ 
								echo " <li class='left clearfix'><span class='chat-img pull-left'>";
								echo " <img src='http://placehold.it/50/55C1E7/fff&text=U' alt='User Avatar' class='img-circle' />";
								echo "</span>";
								echo "<div class='chat-body clearfix'>";
								echo "  <div class='header'>
										<strong class='primary-font'>".$val->username."</strong> <small class='pull-right text-muted'>
												<span class='glyphicon glyphicon-time'></span>".$val->datepost."</small>
										</div>";
									
								echo "<p>".$val->message."</p>";
								echo "</div>";
								echo "</li>";
							}elseif($val->user == $userid)
							
							{
								
								echo " <li class='right clearfix'><span class='chat-img pull-right'>";
								echo " <img src='http://placehold.it/50/FA6F57/fff&text=ME' alt='User Avatar' class='img-circle' />";
								echo "</span>";
								echo "<div class='chat-body clearfix'>";
								echo "  <div class='header'>
										<strong class='primary-font'>".$val->username."</strong> <small class='pull-right text-muted'>
												<span class='glyphicon glyphicon-time'></span>".$val->datepost."</small>
										</div>";
									
								echo "<p>".$val->message."</p>";
								echo "</div>";
								echo "</li>";
								
							}
							
						 }?>
                       
                    </ul>
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                <input type="text" required class="form-control input-sm" placeholder="Type your message here..." name="message" maxlength="50"/>

                        <span class="input-group-btn">
                           <input type="submit" class="btn btn-warning btn-sm" name="btnchat" id="btn-chat" value="send">
                        </span>
                      
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
  </form>

