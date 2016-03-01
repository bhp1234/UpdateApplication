<?php
class user_Model extends Model{

	public function __construct(){
		 parent::__construct();
    }
	public function login(){
		$user=$_POST['user'];
		$pass=md5($_POST['password']);
		$where=array('user_name'=>$user,'pass'=>$pass);
		$this->select($this->table,$where);
		if($this->num_rows()==0){
         return false;
		}else{
		return true;
		}	
	}
	

	
	public function exist_user($username,$password,$type=1)
	{
		if($type=1)
		{
		$pass=md5($_POST['password']);
		$this->query("select * from thanhvien where binary user= binary '$username' and pass= binary '$pass'");
		if($this->num_rows()==0)
		return false;
		}
		else{

			$this->query("select * from thanhvien where binary user='$username'");
			if($this->num_rows()==0)
			return false;
		}
		return true;
	}
	
	public function isBlocked($username,$password)
	{
		if($this->resultEmpty())
		{
		
		$user=$username;
		$pass=md5($password);
		$this->query("select * from thanhvien where  binary user= '$username' and pass='$pass'");
		
		}
		else{
		$this->setTobegin();
		}
		$data=$this->fetch();
		if($data[0]["hieuluc"]==1)
		return false;
		return true;
	}
	
	

	
	public function changePassword($oldpw,$newpw)
	{
		$user=Process::getIdUser();
		$opw=md5($oldpw);
		$this->query("select * from thanhvien where user= binary '$user' and pass='$opw'");
		$num_rows=$this->num_rows();
		if($num_rows==0)
		return false;
		$npw=md5($newpw);
		$this->query("update thanhvien set pass='$npw' where user= binary '$user'");
		return true;
	}
	
	public function updateInfo($query,$idloai)
	{
		$user=Process::getIdUser();

		if($idloai<=2)
		$this->query("update khachhang set ".$query." where mauser= binary '$user'");
		else{
		$this->query("update nhanvien set ".$query." where mauser= binary '$user'");
		}
	}
	
	public function addMember($parameter)
	{
		$username=$parameter[0];
		$password=md5($parameter[1]);
		$email=$parameter[2];
		$name=$parameter[3];
		$birthdate=new DateTime($parameter[4]);
		$address=$parameter[5];
		$phonenumber=$parameter[6];
		$date=new DateTime();
		$query="insert into thanhvien(user,pass,loaind,ngaytao,hieuluc) values ('$username','$password',1,'".$date->format("Y/m/d H:i:s")."',1)";
		if($this->query($query)==false)
		{
		$_SESSION["MsError"]="Tài khoản đã tồn tại";
		exit();
		}

		$query="insert into khachhang(diachi,dienthoai,email,ngaysinh,tenkh,mauser,chietkhau) values ('$address','$phonenumber','$email','".$birthdate->format("Y/m/d")."','$name','$username',1)";
		$this->query($query);
	}
	
	public function getBills($page)
	{
	$startIndex=($page-1)*__BILLPAGE_SIZE;
	$user=Process::getIdUser();
	$sql="select hd.id_hoadon,hd.ngaydat,hd.tinhtrang as matinhtrang,tt.tinhtrang,sum(ct.soluong) as soluong,sum(ct.soluong*sp.gia) as thanhtien from hoadon hd left join tinhtranghoadon tt on hd.tinhtrang=tt.id inner join chitiethoadon ct on ct.mahd=hd.id_hoadon inner join sanpham sp on ct.masp=sp.id and hd.makh=binary '$user' group by hd.id_hoadon ORDER BY hd.ngaydat desc  limit $startIndex,".__BILLPAGE_SIZE;
	
	$this->query($sql);
	return $this->fetch();
	}
	
	public function destroyBill($id)
	{
	$sql="Update hoadon set tinhtrang=4 where id_hoadon=$id and tinhtrang<=2";
	$this->query($sql);
	if($this->affected_rows()>0)
	{
	$date=new DateTime();
	$sql="insert into thongbao_admin(mahd,moi,ngay) values($id,0,'".$date->format("Y/m/d H:i:s")."')";
	$this->query($sql);
	}
	}
	
	public function getPageSize(){
	$user=Process::getIdUser();
	$sql="select hd.id_hoadon,hd.ngaydat,hd.tinhtrang as matinhtrang,tt.tinhtrang,sum(ct.soluong) as soluong,sum(ct.soluong*sp.gia) as thanhtien from hoadon hd left join tinhtranghoadon tt on hd.tinhtrang=tt.id inner join chitiethoadon ct on ct.mahd=hd.id_hoadon inner join sanpham sp on ct.masp=sp.id and hd.makh=binary '$user' group by hd.id_hoadon";
	$this->query($sql);
	$row=$this->num_rows();
	$pageSize=intval($row/__BILLPAGE_SIZE);
	if($row%__BILLPAGE_SIZE!=0)
	$pageSize+=1;
	return $pageSize;
	}
}
?>