<?php 
ini_set('display_errors', 0);

if(!isset($_SESSION))
	session_start();
	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
    <meta name="author" content="">
	<title>Achiles</title>
	<?php
	echo '<link href="'.__SITE_PATH.'public/font-awesome/css/font-awesome.min.css" rel="stylesheet">';	
    echo '<link href="'.__SITE_PATH.'public/bootstrap/css/bootstrap.min.css" rel="stylesheet">';
	echo '<script src="'.__SITE_PATH.'public/bootstrap/js/bootstrap.min.js"></script>';
	echo '<link href="'.__SITE_PATH.'public/css/bootstrap.min.css" rel="stylesheet">';
    echo '<link href="'.__SITE_PATH.'public/css/font-awesome.min.css" rel="stylesheet">';
    echo '<link href="'.__SITE_PATH.'public/css/prettyPhoto.css" rel="stylesheet">';
    echo '<link href="'.__SITE_PATH.'public/css/price-range.css" rel="stylesheet">';
    echo '<link href="'.__SITE_PATH.'public/css/animate.css" rel="stylesheet">';
	echo '<link href="'.__SITE_PATH.'public/css/main.css" rel="stylesheet">';
	echo '<link href="'.__SITE_PATH.'public/css/responsive.css" rel="stylesheet">';
    echo '<link href="'.__SITE_PATH.'public/css/starter-template.css" rel="stylesheet">';
	echo '<script src="'.__SITE_PATH.'public/jquery/jquery-2.1.4.min.js"></script>';
	echo '<link href="'.__SITE_PATH.'public/sweetalert/lib/sweet-alert.css" rel="stylesheet">';
	echo '<script src="'.__SITE_PATH.'public/sweetalert/lib/sweet-alert.min.js"></script>';
	echo '<script src="'.__SITE_PATH.'public/js/myscriptHome.js"></script>';
	?>

	
  </head>
<script>
var __SITE_PATH="<?= __SITE_PATH ?>";
var __SPLIT_MEMBER="<?= __SPLIT_MEMBER ?>";
var __SPLIT_ROW="<?= __SPLIT_ROW ?>";
var __NEW_LINE="<?= __NEW_LINE ?>";
var __DNS="<?= __DNS ?>";
</script>
  <body>	
<nav class="navbar navbar-inverse navbar-fixed-top"  >
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="true" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?= __SITE_PATH."index/index" ?>">PC SHOP</a>
        </div>
        <div id="navbarA" class="collapse navbar-collapse" style="float:left">
          <ul class="nav navbar-nav" id="left">
            <li class="active"><a href="#"><i class="fa fa-home"></i>&nbsp;Trang chủ</a></li>
            <li><a href="#about"><i class="fa fa-info-circle"></i>&nbsp;Về chúng tôi</a></li>
            <li><a href="#contact"><i class="fa fa-question-circle"></i>&nbsp;Liên hệ</a></li>
          </ul>
        </div><!--/.nav-collapse -->
		<div id="navbar" class="collapse navbar-collapse" style="float:right">
          <ul class="nav navbar-nav" role="tablist">
		  <?php
		  $cart=Process::getCart();
		  $user=$_SESSION["user"];
		  if($this->model->getUser($user["user"])["loaind"]<=2)
		  echo '<li role="presentation"><a href="'.__SITE_PATH.'cart/index"><i class="fa fa-shopping-cart"></i> Giỏ hàng <span class="badge">'.$cart->countItem().'</span></a></li>';
		  else
		  {
		  echo '<li class="presentation" style="margin-top:5px" >';
          echo '     <a href="'.__SITE_PATH.'admin/bill/index"  >';
          echo '        <i class="fa fa-bell-o"></i>';		
		  $numPending=$this->model->getBillsPending();
				if($numPending!=0)
				{
		  echo '<span class="label label-warning"  style="padding:4px;margin-top:-15px">'.count($numPending).'</span>';
				}					
          echo '     </a>';				
          echo'    </li>';
		  echo '<li role="presentation"><a href="'.__SITE_PATH.'admin/index"><i class="fa fa-dashboard"></i> Trang quản lí</a></li>';
		  }
		  if(!$_SESSION["isLogin"])
		  {
		  
		   $retUrl="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
           echo '<li ><a href="'.__SITE_PATH.'user/login?retUrl= '.$retUrl.'"><i class="fa fa-sign-in"></i>&nbsp;Đăng nhập</a></li>';
           echo '<li><a href="'.__SITE_PATH.'user/register"><i class="fa fa-registered"></i>&nbsp;Đăng kí</a></li>';
		   }
		   else
		   {
		   $retUrl="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		   
		    
			echo '<li class="dropdown user user-menu"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>&nbsp;'.Process::getNameUser().'</a>';
			echo ' <ul class="dropdown-menu" style="min-width:0px;width:150px;text-align:center;border-radius:4px;border:1px solid rgba(0, 0, 0, .15);box-shadow: 0 3px 8px rgba(0, 0, 0, .3);">';
			echo '<li class="user-footer">';
            echo '       <div class="row">';
            echo '         <a href="'.__SITE_PATH.'user/index " style="width:100px" class="btn btn-default btn-flat">Thông tin</a>';
            echo '       </div>';
					
            echo '       <div class="row">';
            echo '         <a href="'.__SITE_PATH.'user/logout?retUrl='.$retUrl.'"  style="width:100px" class="btn btn-default btn-flat">Đăng xuất</a>';
            echo '       </div>';
            echo '     </li>';
			echo '</ul>';
			echo '</li>';

		   }
          ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	<div class="row">
	<div class="col-lg-6" style="float:right;width:500px;margin-right:10%">
    <div class="input-group" >
      <input type="text" id="search_box" class="form-control" placeholder="Tìm kiếm sản phẩm">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" onclick="searchKey()" >Tìm kiếm</button>
      </span>
    </div><!-- /input-group -->
	<div class="row" id="search_div" style="position:absolute;overflow:hidden;z-index: 100;background:#ffffff;width:387px;border-collapse: collapse;margin-left:0px" >
	<ul id="search_result">
	</ul>
	</div>
  </div><!-- /.col-lg-6 -->
	</div>