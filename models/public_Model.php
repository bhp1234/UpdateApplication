<?php
class public_Model extends Model{
	public function __construct(){
		 parent::__construct();
    }
	
	public function getCategory(){
	$this->query("select * from nhomsanpham");

	return $this->fetch();
	}
	
	public function getProductType($id=-1){
	if($id!=-1)
	$this->query("select * from loaisanpham where id_nhom=$id");
	else
	$this->query("SELECT * FROM loaisanpham group by tenloaisp order by luotmua desc, tenloaisp asc limit 0,5");

	return $this->fetch();
	}	
	
	public function getProducts($query){
	$this->query("$query");
	return $this->fetch();
	}
	
	
	
	public function getCateIdfromKindId($id){
	$this->query("select * from loaisanpham where id_loai=$id");
	return $this->fetch()[0]["id_nhom"];
	}
	
	public function getCostByMonth($month)
	{
	$sql="CALL getCostByMonth($month)";
	$this->query($sql);
	return $this->fetch()[0]["tong"]/1000000;
	}
	
}
?>