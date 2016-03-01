<?php

class product_Model extends Model{

	public function __construct(){
		 parent::__construct();
    }
	
	
	
	public function getRelatedproducts($id){
	
		$this->query("SELECT * FROM sanpham WHERE id_loai=$id and tontai=1 ORDER BY rand() LIMIT 9");
		$data=$this->fetch();
		
		return $data;
	}
	

	
	public function getProByCateId($idCate,$page){
	$startIndex=($page-1)*__PAGE_SIZE;
	$this->query("SELECT sp.* FROM sanpham sp,nhomsanpham nsp,loaisanpham lsp WHERE nsp.id_nhom=$idCate and nsp.id_nhom=lsp.id_nhom and sp.id_loai=lsp.id_loai and sp.tontai=1 limit $startIndex,".__PAGE_SIZE);
		$data=$this->fetch();
		
		return $data;
	}
	
	public function getProByKindId($idKind,$page){
	$startIndex=($page-1)*__PAGE_SIZE;
	$this->query("SELECT * FROM sanpham WHERE id_loai=$idKind and tontai=1 limit $startIndex,".__PAGE_SIZE);
		$data=$this->fetch();
		
		return $data;
	}
	
	public function getProByKey($key,$page){
	$startIndex=($page-1)*__PAGE_SIZE;

		
	$dataRs=self::arraySplit($key," -");
			if(count($dataRs)<=2)
			{
			switch(count($dataRs))
			{
			case 1:if(is_numeric($key)) 
					$this->query("select * from sanpham where gia<=$key and tontai=1 order by gia desc limit $startIndex,".__PAGE_SIZE);
					else $this->query("select * from sanpham where tensp like '$key%' and tontai=1 order by tensp limit $startIndex,".__PAGE_SIZE);break;
			case 2:if(is_numeric($dataRs[0]) && is_numeric($dataRs[1]))
					$this->query("select * from sanpham where gia>=$dataRs[0] and gia<=$dataRs[1] and tontai=1 order by gia desc limit $startIndex,".__PAGE_SIZE);break;
			}	
			}	
		$data=$this->fetch();
		return $data;
	}
	
	public function getPageSize($id,$type){
	if($type=="Category")
	{
	$this->query("SELECT sp.* FROM sanpham sp,nhomsanpham nsp,loaisanpham lsp WHERE nsp.id_nhom=$id and nsp.id_nhom=lsp.id_nhom and sp.id_loai=lsp.id_loai and sp.tontai=1");
	}
	else
	{
		if($type=="Kind")
		{
		$this->query("SELECT * FROM sanpham WHERE id_loai=$id and tontai=1");
		}
		else
		{
		$dataRs=self::arraySplit($id," -");
			if(count($dataRs)<=2)
			{
			switch(count($dataRs))
			{
			case 1:if(is_numeric($id)) 
					$this->query("select * from sanpham where gia<=$id and tontai=1 order by gia desc ");
					else $this->query("select * from sanpham where tensp like '$id%' order by tensp ");break;
			case 2:if(is_numeric($dataRs[0]) && is_numeric($dataRs[1]))
					$this->query("select * from sanpham where gia>=$dataRs[0] and gia<=$dataRs[1] and tontai=1 order by gia desc");break;
			}	
			}
		}
	}
	$row=$this->num_rows();
	$this->num_results=$row;
	$pageSize=intval($row/__PAGE_SIZE);
	if($row%__PAGE_SIZE!=0)
	$pageSize+=1;
	return $pageSize;
	}
	
	public function arraySplit($data,$chars)
	{
		$arr=array();
		$tok=strtok($data,$chars);
		while($tok!=null)
		{
		$arr[]=$tok;
		$tok=strtok($chars);
		}
		return $arr;
	}
	
	
	public function num_results()
	{
	return $this->num_results;
	}
	
	public function getNameType($id,$type)
	{
	$query='';
	if($type=="Category")
	{
	$query="SELECT * FROM nhomsanpham WHERE id_nhom=$id ";
	$this->query($query);
	return $this->fetch()[0]["tennhom"];	
	}
	else
	{
		if($type=="Kind")
		{
		$query="SELECT * FROM loaisanpham WHERE id_loai=$id";
		$this->query($query);
		return $this->fetch()[0]["tenloaisp"];	
		}
	}
	return '';
	}
}
?>