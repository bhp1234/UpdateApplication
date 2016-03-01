<?php
class cart_Model extends Model{
	public function __construct(){
		 parent::__construct();
    }	
	
	public function getTotalPrice($listItems){
	$total=0;
	foreach($listItems as $item)
	{
		$total+=$item->quantity*$this->getProductById($item->id)["gia"];
	}
	return $total;
	}
	
	public function update($cart){
	for($i=0;$i<count($cart->listCart);$i++)
	{
		if(($cart->listCart[$i]->quantity + $this->getQuantitySoled($cart->listCart[$i]->id)) > $this->getProductById($cart->listCart[$i]->id)["soluong"])
			$cart->listCart[$i]->active=false;
			else
			$cart->listCart[$i]->active=true;
			
	}
		
	}
	
	public function createBill()
	{
		$cart=Process::getCart();
		$user=Process::getIdUser();
		$date=new DateTime();
		
		$sql="Insert into hoadon(makh,ngaydat) values ('".$user."','".$date->format("Y/m/d H:i:s")."')";

		$this->query($sql);
		$sql="select * from hoadon where makh= binary '".$user."' and ngaydat='".$date->format("Y/m/d H:i:s")."' ";
		$this->query($sql);
		$bill=$this->fetch()[0];
		foreach($cart->listCart as $item)
		{
		 $sql="insert into chitiethoadon(mahd,masp,soluong) values(".$bill["id_hoadon"].",'".$item->id."',".$item->quantity.")";
		 $this->query($sql);
		}
		$sql="insert into thongbao_admin(mahd,ngay) values(".$bill["id_hoadon"].",'".$date->format("Y/m/d H:i:s")."')";
		$this->query($sql);
		
	}
	
	public function createBillNon($address,$phonenumber,$email)
	{
		$cart=Process::getCart();
		$user=Process::getIdUser();
		$date=new DateTime();
		
		$sql="Insert into hoadon(diachi,dienthoai,email,makh,ngaydat) values ('$address','$phonenumber','$email',' ','".$date->format("Y/m/d H:i:s")."')";

		$this->query($sql);
		$sql="select * from hoadon where diachi= binary '$address' and dienthoai= binary '$phonenumber' and email =binary '$email' and makh= binary ' ' and ngaydat='".$date->format("Y/m/d H:i:s")."' ";
		$this->query($sql);
		$bill=$this->fetch()[0];
		foreach($cart->listCart as $item)
		{
		 $sql="insert into chitiethoadon(mahd,masp,soluong) values(".$bill["id_hoadon"].",'".$item->id."',".$item->quantity.")";
		 $this->query($sql);
		}
		
		$sql="insert into thongbao_admin(mahd,ngay) values(".$bill["id_hoadon"].",'".$date->format("Y/m/d H:i:s")."')";
		$this->query($sql);
	}
}
?>