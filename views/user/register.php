<?php
if(!isset($_SESSION))
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Đăng kí</title>
	<?php
    echo '<link href="'.__SITE_PATH.'public/bootstrap/css/bootstrap.min.css" rel="stylesheet">';
	echo '<link href="'.__SITE_PATH.'public/bootstrap/css/bootstrap.css" rel="stylesheet">';
	echo '<script src="'.__SITE_PATH.'public/bootstrap/js/bootstrap.min.js"></script>';
	echo '<script src="'.__SITE_PATH.'public/jquery/jquery-2.1.4.min.js"></script>';	
	echo '<script src="'.__SITE_PATH.'public/jquery/jquery-2.1.4.js"></script>';	
	echo '<script src="'.__SITE_PATH.'public/js/prettify.js"></script>';
	echo '<script src="'.__SITE_PATH.'public/js/validate/jquery.validate.min.js"></script>';
	echo '<script src="'.__SITE_PATH.'public/datepicker/js/bootstrap-datepicker.js"></script>';
	?>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script type="text/javascript">
           $(document).ready(function() {
    var date = new Date();

    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();

    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;

    var today = year + "-" + month + "-" + day;       
    $("#date").attr("value", today);
});
        </script>
	<style>
		body {
	  padding-top: 40px;
	  padding-bottom: 40px;
	  background-color: #eee;
	}

	.form-signin {
	  max-width: 700px;
	  padding: 15px;
	  margin: 0 auto;
	}
	.form-signin .form-signin-heading,
	.form-signin .checkbox {
	  margin-bottom: 10px;
	}
	.form-signin .checkbox {
	  font-weight: normal;
	}
	.form-signin .form-control {
	  position: relative;
	  height: auto;
	  -webkit-box-sizing: border-box;
		 -moz-box-sizing: border-box;
			  box-sizing: border-box;
	  padding: 10px;
	  font-size: 16px;
	}
	.form-signin .form-control:focus {
	  z-index: 2;
	}

	.form-signin input {
	  margin-bottom: 10px;
	  border-top-left-radius: 0;
	  border-top-right-radius: 0;
	}
	</style>
	
	  <script>
           $(function () {
               $("#registerform").validate({
                   rules: {
                       username: { required: true,minlength: 6,maxlength:20},
					   date:{ required: true},
                       password: { required: true, minlength: 6,maxlength:20 },
						repassword: { required: true,equalTo:$("[name='password']") },
                       name: { required: true },
                       address: { required: true },
                       phonenumber: { required: true },
                   },
                   messages: {
                       username: { required: '<span class="label label-danger" >Chưa nhập tài khoản.</span>',minlength:'<span class="label label-danger" >Tài khoản phải nhiều hơn 6 kí tự</span>',maxlength:'<span class="label label-danger" >Tài khoản phải ít hơn 21 kí tự</span>' },
					   date: { required: '<span class="label label-danger" >Chưa nhập ngày sinh.</span>' },
                       password: { required: '<span class="label label-danger" >Chưa nhập mật khẩu</span>',minlength:'<span class="label label-danger" >Mật khẩu phải nhiều hơn 6 kí tự</span>',maxlength:'<span class="label label-danger" >Mật khẩu phải ít hơn 21 kí tự</span>' },
                       repassword: { required: '<span class="label label-danger" >Chưa nhập lại mật khẩu</span>',equalTo:'<span class="label label-danger" >Mật khẩu nhập lại không chính xác</span>' },
                       name: { required: '<span class="label label-danger" >Chưa nhập họ tên</span>' },
                       address: { required: '<span class="label label-danger" >Chưa nhập địa chỉ</span>' },
                       phonenumber: { required: '<span class="label label-danger" >Chưa nhập số điện thoại</span>' },
					   email: { required: '<span class="label label-danger" >Chưa nhập email</span>' },
                   },

                   errorPlacement:function(error,element){
                       error.appendTo($("#error"));
                   },
               });
           });
    </script>
  </head>

  <body>

	<?php
	if(isset($_SESSION["isLogin"]) && $_SESSION["isLogin"]==1)
		  {
			header("location:".__SITE_PATH."index/index");
		  }
	?>
 <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
		<div id="navbar" class="collapse navbar-collapse" style="float:right">
          <ul class="nav navbar-nav">
            <li ><a href="<?= __SITE_PATH."index/index" ?>"><i class="fa fa-home"></i>&nbsp;Trang chủ</a></li>
            <li><a href="<?= __SITE_PATH."user/login" ?>"><i class="fa fa-sign-in"></i>&nbsp;Đăng nhập</a></li>
          
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="container">

      <form class="form-signin" id="registerform" method="post" action="" >
		<div style="float:left">
        <h2 class="form-signin-heading">Thông tin tài khoản</h2>
		<input type="text" name="username"  class="form-control" placeholder="Tài khoản"  >
		
		<input type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu" required>
		
        <input type="password" name="repassword" id="repassword" class="form-control" placeholder="Nhập lại" required>
		</div>
		<div style="margin-left:50px;float:left;">
		<h2 class="form-signin-heading" >Thông tin người dùng</h2>
		
		<input type="text" name="name"  class="form-control" placeholder="Họ tên"  required>
		
		<input type="email" name="email" class="form-control" placeholder="Email" required>
		
		<input type="date" name="date" id="date" class="form-control"  required>
		<input type="text" name="address"  class="form-control" placeholder="Đia chỉ">
		<input type="text" name="phonenumber"  class="form-control" placeholder="Số điện thoại">
		<input type="hidden" name="registered" value="true">
		<div class="g-recaptcha" data-sitekey="<?= __KEY_CAPTCHA?>"></div>
		<button class="btn btn-lg btn-primary btn-block"   type="submit">Đăng kí</button>
		</div>
        <div style="clear: both;padding:40px;width:300px;font-size:20px" id="error">
		<?php 				
		if(isset($_SESSION["MsError"]) && !empty($_SESSION["MsError"]))
		echo '<h3><span class="label label-danger" >'.$_SESSION["MsError"].'</span></h3>';
		$_SESSION["MsError"]="";
		?>
		</div>
      </form>
		
    </div> <!-- /container -->


  </body>
</html>
