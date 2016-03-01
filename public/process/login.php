<?php include '../config/connect.php';
if(!isset($_SESSION))
session_start();
	$username=$_POST["username"];
	$password=md5($_POST["password"]);
	$remember=false;
	if(isset($_POST["remember"]))
		$remember=$_POST["remember"];
	$result=mysql_query("select * from thanhvien where user='$username' and pass='$password'");
	$num=mysql_num_rows($result);
	if($num==0)
	{
		$location="location: ../login.php?error=Tài khoản hoặc mật khẩu không chính xác.";
		if(isset($_POST["retUrl"]))
		$location.="&retUrl=".$_POST["retUrl"];
		header("$location");
		exit();
	}
	else
	{
		$user=mysql_fetch_array($result);
		if($user["hieuluc"]!=1)
		{
			$location="location: ../login.php?error=Tài khoản của bạn đã bị khóa.";
			if(isset($_POST["retUrl"]))
			$location.="&retUrl=".$_POST["retUrl"];
			echo "<script>alert('Tài khoản của bạn đã bị khóa!');window.location='../login.php?error=$location';</script>";
			exit();
		
		}	
		$_SESSION["user"]=$user;
		$_SESSION["isLogin"]=true;

		if($remember==true)
		{
			$key="achiles";
			$encoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $user["user"], MCRYPT_MODE_CBC, md5(md5($key))));
			setcookie("user",$encoded,time()+24*3600,"/");
		}

		if(isset($_POST["retUrl"]))
		{
			$retUrl=$_POST["retUrl"];
			header("location:$retUrl");
			exit();
		}
		else
			
		exit();
	}
?>