<?php
class index_Model extends Model{
	public $table="user";
	public function __construct(){
		 parent::__construct();
    }
	
	public function getCategory(){
	$this->query("select * from nhomsanpham");

	return $this->fetch();
	}
	
	public function getProductType($id=-1){
	if($id!=-1)
	$this->query("select * from loaisanpham where id_nhom=$id order by tenloaisp asc");
	else
	$this->query("SELECT * FROM loaisanpham group by tenloaisp order by luotmua desc, tenloaisp asc limit 0,5");

	return $this->fetch();
	}
	
	public function getProducts($query){
	$this->query("$query");
	return $this->fetch();
	}
}
?>