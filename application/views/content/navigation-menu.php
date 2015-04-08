<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?=site_url()?>">Manifest System</a>
    </div>
    <!-- /.navbar-header -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">              
                <li>
                    <a href="#"><i class="glyphicon glyphicon-upload"></i>  Manifest<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?= site_url()?>manifest/upload">Upload</a></li>
                        <li><a href="<?=site_url()?>manifest/data">Data</a>
                        <ul class="nav nav-second-level">

                             <ul class="nav nav-third-level">
                                 <li><a href="<?=site_url()?>manifest/data">All Data </a></li>
                                 <li><a href="<?= site_url()?>manifest/sby_data">Bu Acu</a></li>
                             </ul>

                        </uL>


                        </li>
                        <li><a href="<?=site_url()?>manifest/verification">
                            <span class="badge pull-right"><?=$this->manifest_model->count_not_verified()?></span>
                            Verification
                        </a></li>
                        <li><a href="<?=site_url()?>manifest/download">Download Data</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="glyphicon glyphicon-envelope"></i>  Request<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?= site_url()?>request/discount">Discount</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="glyphicon glyphicon-briefcase"></i>  Bussines<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="#">Customers<span class="fa arrow"></span></a>
                             <ul class="nav nav-third-level">
                                 <li><a href="<?= site_url()?>customers">Data </a></li>
                                 <li><a href="<?= site_url()?>customers/register">Add Customer </a></li>
                             </ul>
                        </li>
                         <li>
                            <a href="#">Partner<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                               <li><a href="<?= site_url('administrator/manage_partner')?>">Manage Partner</a></li>
                            </ul>
                         </li>
                    </ul>
                </li>


                <li>
                    <a href="javascript"><i class="glyphicon glyphicon-folder-open"></i> Report <span class="fa arrow"></span></a>
                      <ul class="nav nav-second-level">
                        <li><a href="<?=site_url()?>report/customer_card"> Customers Card</a></li>
                    </ul>
                </li>


                <?php
                $user_id =  $this->session->userdata('user_id');
                $currentuser = $this->user_model->get_by_id($user_id);
                $currentuser= $currentuser->type;
                if($currentuser == "Admin" ){ ?>

                <li>
                    <a href="#"><i class="glyphicon glyphicon-user"></i>  Administrator<span class="fa arrow"></span></a>
					
                    <ul class="nav nav-second-level">
                        <li><a href="<?= site_url('administrator/manage_user')?>">Manage User</a></li>
                        <li><a href="<?= site_url('administrator/setting')?>">Setting</a></li>
                        <li><a href="<?= site_url('access_logs')?>">Access Logs</a></li>
                    </ul>
                </li>

                <?php } ?>

                <li><a href="<?=site_url('logout')?>"><i class="glyphicon glyphicon-user"></i>  Logout</a></li>
            </ul>
        </div>
    </div>
</nav>