<?php
class Model{

    public function __construct(){//kết nối
		$this->conn= mysqli_connect(__HOST,__USER,__PASS,__DB_NAME) or die ("Không thể kết nối server");
		mysqli_query($this->conn,"set names 'utf8'");
	}
	public function disconnect(){//ngắt kết nối
		if($this->conn){
			mysqli_close($this->conn);
		}
	}
	public function query($sql){//truy vấn
		
		$this->result=mysqli_query($this->conn,$sql); 
		
		if (mysqli_more_results($this->conn))
		$this->conn->next_result();
		if($this->result==false)
		return 0;
		return 1;
	}
	public function num_rows(){//đếm số dòng trả về từ câu lệnh truy vấn
		if($this->result){
		    $rows=mysqli_num_rows($this->result);
		}
		else{
		    $rows=0;
		}
		return $rows;
	}
	
	public function affected_rows()
	{
	return  mysqli_affected_rows($this->conn);
	}
	
	public function resultEmpty(){
	if(!isset($this->result) || empty($this->result))
	return true;
	return false;
	}
	
	public function fetch()
	{
		$this->data=array();
		if( isset($this->result) && $this->result)
		{
		
			if($this->num_rows()!=0 ){
				while($row=mysqli_fetch_array($this->result)){
					$this->data[]=$row;
				}
			}else{
				$this->data=0;
			}
		}
		return $this->data;
	 }
	 
	 public function setTobegin()
	 {
	 mysqli_data_seek($this->result,0);
	 }
	 
	public function select($table, $where='')
	{
		if($where != "")
		{
			if(is_array($where))
			{
				foreach($where as $k => $v)
				{
					$sql[]= "$k='$v'";
				}
				$where=implode(" and ",$sql);
				$where="where $where";
			}
			else
			{
				$where="where $where";
			}
		}
		$sql="select * from $table $where";
		$this->query($sql);
	}
	
	
	
	 public	function isLogged(){
	if(isset($_COOKIE["user"]))
	{
		$key=__KEY_CODE;
		$decoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($_COOKIE["user"]), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
		$query="call getUserInfo('$decoded')";
		//$query="select * from thanhvien where user= binary '$decoded'");
		$result=$this->query($query);
		
		if($result==false)
		{
			
			$_SESSION["user"]=null;
			unset($_COOKIE["user"]);
			$_SESSION["isLogin"]=false;
			return false;
		}
		else
		{
			
			$_SESSION["user"]=$this->fetch()[0];
			$_SESSION["isLogin"]=true;
			
			return true;
		}
	}

	$kq=false;
	if(isset($_SESSION["isLogin"]))
	$kq=$_SESSION["isLogin"];
		
	return  $kq;
	}
	// Những hàm xứ lí
	public function getQuantitySoled($id)
	{
	$this->query("select sp.*,sum(ct.soluong) as soluongsum from sanpham sp, chitiethoadon ct where sp.id=ct.masp and sp.id=$id group by sp.id");
	if($this->num_rows()==0)
	return 0;
	return $this->fetch()[0]["soluongsum"];
	}
	
	public function Availability($id)
	{

		$product=$this->getProductById($id);
		if($this->getQuantitySoled($product["id"]) >= $product["soluong"])
		return false;
		return true;
	}
	
	public function canBuy($id,$quantity){
	$product=$this->getProductById($id);	
		if(($this->getQuantitySoled($product["id"]) + $quantity)> $product["soluong"])
		return false;
		return true;
	}
	
	public function getProductById($id){
	$this->query("select * from sanpham where id=$id and tontai=1");
	if($this->num_rows()==0)
	return 0;
	$data=$this->fetch();
	return $data[0];
	}
	
	public function getUser($username){
	$this->query("CALL getUserInfo('$username')");
	return $this->fetch()[0];
	}
	
	public function getBillsPending()
	{
	$sql="select * from hoadon where tinhtrang=1";
	$this->query($sql);
	return $this->fetch();
	}
}
?>