 <!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin|Dashboard</title>
 <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 <?php
    echo '<link href="'.__SITE_PATH.'public/bootstrap/css/bootstrap.min.css" rel="stylesheet">';
	echo '<link href="'.__SITE_PATH.'public/font-awesome/css/font-awesome.min.css" rel="stylesheet">';
	echo '<link rel="stylesheet" href="'.__SITE_PATH.'public/Admin/dist/css/AdminLTE.min.css">';
	echo '<link rel="stylesheet" href="'.__SITE_PATH.'public/Admin/ionicons-2.0.1/css/ionicons.min.css">';
	echo '<link rel="stylesheet" href="'.__SITE_PATH.'public/Admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css">';
    echo '<link rel="stylesheet" href="'.__SITE_PATH.'public/Admin/dist/css/skins/_all-skins.min.css">';
	echo '<link rel="stylesheet" href="'.__SITE_PATH.'public/Admin/plugins/datatables/dataTables.bootstrap.css">';
	echo'<script src="'.__SITE_PATH.'public/jquery/jquery-2.1.4.min.js"></script>';
	echo'<script type="text/javascript" src="'.__SITE_PATH.'public/js/jquery.leanModal.min.js"></script>';
 ?>
</head>
 <body class="hold-transition skin-blue <?php if(isset($_COOKIE["layout"])) echo $_COOKIE["layout"]; ?> sidebar-mini">
 <?php
	$user=$_SESSION["user"];
	$user=$this->model->getUser($user["user"]);
?>
    <div class="wrapper" style="margin-top:-20px">
<header class="main-header">

        <!-- Logo -->
        <a href="<?php echo __SITE_PATH."admin/index" ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>L</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
		  <a href="<?php echo __SITE_PATH."index" ?>" style="color:white;"  >
            <i class="fa fa-home fa-2x" style="padding-left:15px;padding-top:8px"></i>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
                            <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li><!-- end message -->
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            AdminLTE Design Team
                            <small><i class="fa fa-clock-o"></i> 2 hours</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Developers
                            <small><i class="fa fa-clock-o"></i> Today</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Sales Department
                            <small><i class="fa fa-clock-o"></i> Yesterday</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Reviewers
                            <small><i class="fa fa-clock-o"></i> 2 days</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu" >
                <a href="<?php echo __SITE_PATH.'admin/bill/index' ?>"  >
                  <i class="fa fa-bell-o"></i>
                  <?php
						$numPending=$this->model->getBillsPending();
						if($numPending!=0)
						{
						echo '<span class="label label-warning">';
                        echo count($numPending);
						echo '</span>';
						}
						?>
					
                </a>
				

              </li>
  
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!--<img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">-->
                  <span class="hidden-xs"><?php echo $user["tennv"] ?></span>
                </a>
                <ul class="dropdown-menu" style="min-width:0px;width:150px;text-align:center;border-radius:4px;border:1px solid rgba(0, 0, 0, .15);box-shadow: 0 3px 8px rgba(0, 0, 0, .3);">
                 
                  <li class="user-footer">
                    <div class="row">
                      <a href="<?php echo __SITE_PATH.'user/index' ?>" style="width:100px" class="btn btn-default btn-flat">Thông tin</a>
                    </div>
					
                    <div class="row">
                      <a href="<?php echo __SITE_PATH.'user/logout' ?>"  style="width:100px" class="btn btn-default btn-flat">Đăng xuất</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>

        </nav>
      </header>
