<?PHP
if(!isset($_SESSION))
session_start();
$con=mysqli_connect(__HOST,__USER,__PASS,__DB_NAME);
if(!$con)
{
die ("Could not connect ".mysql_error());
}

mysqli_query($con,"set names 'utf8'");
//ALTER TABLE chitiethoadon MODIFY COLUMN id int AUTO_INCREMENT
?>