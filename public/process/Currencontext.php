<?php
include 'Cart.php';
if(!isset($_SESSION))
	session_start();
	
function isLogged(){
	if(isset($_COOKIE["user"]))
	{
		$key="achiles";
		$decoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($_COOKIE["user"]), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
		$query="select * from thanhvien where user='$decoded'";
		$result=mysql_query($query);
		
		if($kq==0)
		{

			$_SESSION["user"]=null;
			unset($_COOKIE["user"]);
			$_SESSION["isLogin"]=false;
			return false;
		}
		else
		{
			$_SESSION["user"]=mysql_fetch_array($result);
			$_SESSION["isLogin"]=true;
			echo "<script>alert('".$_SESSION["isLogin"]."')</script>";
		}
		return true;
	}

	$kq=false;
	if(isset($_SESSION["isLogin"]))
	$kq=$_SESSION["isLogin"];
	return  $kq;
}

function getNameUser(){
	if($_SESSION["isLogin"])
	return $_SESSION["user"]["user"];
}

function logOut()
{
	$_SESSION["user"]=null;
	unset($_COOKIE["user"]);
	$_SESSION["isLogin"]=false;
}

function getCart(){
	if(!isset($_SESSION["cart"]))
	$_SESSION["cart"]=serialize(new Cart);
	$cart= unserialize($_SESSION["cart"]);
	return $cart;
}

?>