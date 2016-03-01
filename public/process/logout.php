<?php include 'Currencontext.php';
if(!isset($_SESSION))
session_start();

$retUrl=$_GET["retUrl"];
logOut();
header("location: $retUrl");
exit();
?>