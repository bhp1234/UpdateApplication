<?php
if(!isset($_SESSION))
	session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Đăng nhập</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php
	echo '<link href="'.__SITE_PATH.'public/bootstrap/css/bootstrap.min.css" rel="stylesheet">';
	echo '<link href="'.__SITE_PATH.'public/font-awesome/css/font-awesome.min.css" rel="stylesheet">';
	echo '<link rel="stylesheet" href="'.__SITE_PATH.'public/Admin/dist/css/AdminLTE.min.css">';
	echo '<link rel="stylesheet" href="'.__SITE_PATH.'public/Admin/ionicons-2.0.1/css/ionicons.min.css">';
	echo '<link rel="stylesheet" href="'.__SITE_PATH.'public/Admin/plugins/iCheck/square/blue.css">';
	?>

  </head>
  <body class="hold-transition login-page">
  <?php
	if( isset($_SESSION["isLogin"]) && $_SESSION["isLogin"]==true)
		  {
			$this->redirect("index/index");
		  }
	?>
    <div class="login-box">
      <div class="login-logo">
        <a href="../../index2.html"><b>ĐĂNG NHẬP</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body" style="width:400px;font-size:16px">
        <p class="login-box-msg">Tài khoản của bạn</p>
        <form action="" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="username" placeholder="Tài khoản">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Mật khẩu" name="password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
		  	<input type="hidden" name="retUrl"  style="display:none;" value="<?php 
			if(isset($_GET["retUrl"]))
			echo $_GET['retUrl'];
			else
			echo "";
			?>">
			<input type="hidden" name="logined" style="display:none;" value="true">
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox" name="remember"> Ghi nhớ đăng nhập
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng nhập</button>
            </div><!-- /.col -->
          </div>
        </form>
		<div style="clear: both;width:360px" id="error" align="left">
		<?php 
		
		if(isset($_SESSION["MsError"]) && !empty($_SESSION["MsError"]))
		echo '<h4><span class="label label-danger" >'.$_SESSION["MsError"].'</span></h4>';
		$_SESSION["MsError"]="";
		?>
		</div>
        <div class="social-auth-links text-center">
          <p>- Hoặc đăng nhập bằng -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Tài khoản FaceBook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="ion-social-googleplus"></i> Tài khoản Google+</a>
        </div><!-- /.social-auth-links -->

        <a  id="go" rel="leanModal" name="forgot" href="#forgot">Bạn quên mật khẩu ?</a><br>
        <a href="<?php echo __SITE_PATH.'user/register'; ?>" class="text-center">Đăng kí tài khoản mới.</a></br>
		<a href="<?php echo __SITE_PATH.'index'; ?>" >Trở về trang chủ.</a>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
	<div id="forgot" style="display:none;background:white;width:400px" >
			<div style="margin:10px">

					<h3 style="width:260px;float:left">Nhập email để khôi phục</h3>
					<button type="button" class="modal_close" style="border:none;float:right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

				
				<form action="" method="post" style="clear:both;display:block">
				<table>
				<tr>
				<td> Email:</td>
				<td>    <input id="" class="form-control" name="" type="email" style="width:250px" /></td>
				<td>	<input type="submit" class="btn btn-primary" style="margin-left:20px" value="Gửi"></td>
				</tr>
				</table>
				 </form>
			</div>
		</div>
	<?php
		echo'<script src="'.__SITE_PATH.'public/jquery/jquery-2.1.4.min.js"></script>';
		echo'<script src="'.__SITE_PATH.'public/bootstrap/js/bootstrap.min.js"></script>';
		echo'<script src="'.__SITE_PATH.'public/Admin/plugins/iCheck/icheck.min.js"></script>';
		echo'<script type="text/javascript" src="'.__SITE_PATH.'public/js/jquery.leanModal.min.js"></script>';
	?>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
		$('a[rel*=leanModal]').leanModal({ top : 200, closeButton: ".modal_close" });	
      });

    </script>
		<style>
	#lean_overlay {
		position: fixed;
		z-index: 10000;
		top: 0px;
		left: 0px;
		height:100%;
		width:100%;
		background: #000;
		display: none;
	
	}

     

	</style>
  </body>
</html>
