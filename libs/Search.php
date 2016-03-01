<?php
require_once "../config/define_path.php";
require_once "../config/define_database.php";
require_once "../config/define_variable.php";
require_once "../config/connect.php";
require_once "Model.php";


	$value=$_POST["value"];
	if($value=='')
	{
		echo '';
		exit();
	}
	$dataRs=array();
	$tok=strtok($value,"-");
	while ($tok != null) {
    $dataRs[]=$tok;
    $tok = strtok("-");
	}
	
	$model=new Model;
	if(count($dataRs)<=2)
	{
	switch(count($dataRs))
	{
	case 1:if(is_numeric($value)) 
			$model->query("select * from sanpham where gia<=$value order by gia desc limit 0,5");
			else $model->query("select * from sanpham where tensp like '$value%' order by tensp asc limit 0,5");break;
	case 2:if(is_numeric($dataRs[0]) && is_numeric($dataRs[1]))
			$model->query("select * from sanpham where gia>=$dataRs[0] and gia<=$dataRs[1] order by gia desc limit 0,5");break;
	}	
	}

	
	
	$tableSp=$model->fetch();
	$model->query("select * from loaisanpham where tenloaisp  like '$value%' order by tenloaisp asc limit 0,2");
	$tableLsp=$model->fetch();
	$countSp=0;
	$countLsp=0;
	if($tableSp!=0)
	$countSp=count($tableSp);
	if($tableLsp!=0)
	$countLsp=count($tableLsp);
	
	if($countSp!=0)
	echo '<li><h4>Sản phẩm</h4></li>';
	for($i=0;$i<$countSp;$i++)
	{
		if(isset($tableSp[$i]))
		{
		echo $tableSp[$i]["id"].__SPLIT_MEMBER.$tableSp[$i]["hinh"].__SPLIT_MEMBER.$tableSp[$i]["tensp"];
		if($i!=$countSp-1)
		echo __SPLIT_ROW;
		}
	}
	
	if($countLsp!=0)
	echo __NEW_LINE;
	for($i=0;$i<$countLsp;$i++)
	{
	if(isset($tableLsp[$i]))
		echo $tableLsp[$i]["id_loai"].__SPLIT_MEMBER.$tableLsp[$i]["tenloaisp"];
		if($i!=$countLsp-1)
		echo __SPLIT_ROW;
	}
	
?>