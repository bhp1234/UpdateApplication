<?php
include '../config/connect.php';
if(!isset($_SESSION))
	session_start();
try{
	$username=$_POST["username"];
	$password=$_POST["password"];
	$email=$_POST["email"];
	$name=$_POST["name"];
	$date=$_POST["date"];
	$address=$_POST["address"];
	$phonenumber=$_POST["phonenumber"];
}catch (Exception $e) {
    header("location: ../register.php");
	return false;
}

$query="select * from thanhvien where user='$username'";
$result=mysql_query($query);
$kq=mysql_num_rows($result);
if($kq!=0)
{
	header("location: ../register.php?error=Tài khoản đã tồn tại.");
	return false;
}
else
{
	$password=md5($password);
	$query="insert into thanhvien(user,pass,hoten,diachi,email,dienthoai,hieuluc,capquyen) values ('$username','$password','$name','$address','$email','$phonenumber',1,3)";
	$result=mysql_query($query);
	if(!$result)
	{
		die ("Could not connect ".mysql_error());
	}
}
?>