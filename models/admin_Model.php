<?php
class admin_Model extends Model{
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
	public function getBills()
	{
	$sql="select hd.id_hoadon,hd.ngaydat,hd.makh,hd.tinhtrang as matinhtrang,tt.tinhtrang,sum(ct.soluong) as soluong,sum(ct.soluong*sp.gia) as thanhtien from hoadon hd left join tinhtranghoadon tt on hd.tinhtrang=tt.id inner join chitiethoadon ct on ct.mahd=hd.id_hoadon inner join sanpham sp on ct.masp=sp.id group by hd.id_hoadon ORDER BY matinhtrang asc,hd.ngaydat desc ";
	
	$this->query($sql);
	return $this->fetch();
	}
	
	public function getBillsSoled(){
	$sql="select * from hoadon where tinhtrang=4";
	$this->query($sql);
	return $this->fetch();
	}
	
	public function getNewmembers()
	{
	$date=new DateTime();
	$date=$date->format("Y-m");
	$date=$date."-01";
	$sql="select * from thanhvien where '$date'<=DATE_FORMAT(ngaytao,'%Y-%m-%d') and DATE_FORMAT(ngaytao,'%Y-%m-%d')<=last_day('$date')";
	$this->query($sql);
	return $this->fetch();
	}
	
	public function getBillsPending()
	{
	$sql="select * from hoadon where tinhtrang=1";
	$this->query($sql);
	return $this->fetch();
	}
	
	public function getProducts($query){
	$this->query("$query");
	return $this->fetch();
	}
	
	public function changeBillState($id,$state)
	{
	$sql="update hoadon set tinhtrang=$state where id_hoadon=$id and tinhtrang<=2";
	$this->query($sql);
	}
	
	public function getAll(){
	$this->query("SELECT sp.*,lsp.tenloaisp,(sp.soluong-if(sum(ct.soluong) is null ,0,sum(ct.soluong))) as soluongton FROM sanpham sp inner join loaisanpham lsp on (sp.id_loai=lsp.id_loai and sp.tontai=1) left join chitiethoadon ct on ct.masp=sp.id group by sp.id order by sp.tensp asc");
		$data=$this->fetch();
		
		return $data;
	}
	
	public function getProById($id){
	$this->query("SELECT sp.*,lsp.tenloaisp,(sp.soluong-if(sum(ct.soluong) is null ,0,sum(ct.soluong))) as soluongton FROM sanpham sp inner join loaisanpham lsp on (sp.id_loai=lsp.id_loai and sp.tontai=1 and sp.id=$id) left join chitiethoadon ct on ct.masp=sp.id group by sp.id order by sp.tensp asc");
	if($this->num_rows()==0)
	return 0;
		$data=$this->fetch()[0];
		
		return $data;
	}
	
	public function getProByCateId($idCate){
	$this->query("SELECT sp.*,lsp.tenloaisp,(sp.soluong-if(sum(ct.soluong) is null ,0,sum(ct.soluong))) as soluongton FROM sanpham sp inner join loaisanpham lsp on (sp.id_loai=lsp.id_loai and sp.tontai=1) inner join nhomsanpham nsp on (lsp.id_nhom=nsp.id_nhom and nsp.id_nhom=$idCate) left join chitiethoadon ct on ct.masp=sp.id    group by sp.id order by sp.tensp asc");
		$data=$this->fetch();
		
		return $data;
	}
	
	public function getProByKindId($idKind){
	$this->query("SELECT sp.*,lsp.tenloaisp,(sp.soluong-if(sum(ct.soluong) is null ,0,sum(ct.soluong))) as soluongton FROM sanpham sp inner join loaisanpham lsp on (sp.id_loai=lsp.id_loai and sp.id_loai=$idKind and sp.tontai=1 ) left join chitiethoadon ct on  ct.masp=sp.id  group by sp.id");
		$data=$this->fetch();
		
		return $data;
	}
	
	public function checkName($name)
	{
	$sql="select * from sanpham where tensp='$name' and tontai=1";
	$this->query($sql);
	if( $this->num_rows()>0)
	return true;
	return false;
	}
	
	public function addProduct($name,$price,$quantity,$kind,$note,$des,$img)
	{
	$sql="insert into sanpham(tensp,gia,soluong,id_loai,ghichu,mota,hinh) values('$name',$price,$quantity,$kind,'$note','$des','$img')";
	$this->query($sql);
	}
	
	public function updateProduct($name,$price,$quantity,$kind,$note,$des,$id)
	{
	if($this->getProById($id)["soluongton"]<0)
	return false;
	$sql="update sanpham set tensp='$name',gia=$price,soluong=$quantity,id_loai=$kind,ghichu='$note',mota='$des' where id=$id";
	$this->query($sql);
	return true;
	}
	
	public function deleteProduct($id)
	{
	$sql="update sanpham set tontai=0 where id=$id";
	$this->query($sql);
	}
	
	function getNameObject($type,$id)
	{
	switch($type)
	{
	case "Category":$this->query("select * from nhomsanpham where id_nhom=$id");
					$name=$this->fetch()[0]["tennhom"];break;
	case "Kind":$this->query("select * from loaisanpham where id_loai=$id");
					$name=$this->fetch()[0]["tenloaisp"];break;
	case "Product":$this->query("select * from sanpham where id=$id");
					$name=$this->fetch()[0]["tensp"];break;
	}
	return $name;
	}
	
	public function addCategory($name)
	{
	$sql="insert into nhomsanpham(tennhom) values('$name')";
	$this->query($sql);
	}
	
	public function addKind($cateId,$name)
	{
	$sql="insert into loaisanpham(tenloaisp,id_nhom) values('$name',$cateId)";
	$this->query($sql);
	}
	
	public function renameCategory($id,$name)
	{
	if(empty($name))
	return;
	$sql="update nhomsanpham set tennhom='$name' where id_nhom=$id";
	$this->query($sql);
	}
	
	public function renameKind($id,$name)
	{
	if(empty($name))
	return;
	$sql="update loaisanpham set tenloaisp='$name' where id_loai=$id";
	$this->query($sql);
	}
	
	public function delCate($id)
	{
	$sql="select sp.* from sanpham sp,nhomsanpham nsp,loaisanpham lsp where nsp.id_nhom=$id and nsp.id_nhom=lsp.id_nhom and lsp.id_loai=sp.id_loai and sp.tontai=1";
	$this->query($sql);
	if($this->num_rows()>0)
	return false;
	$sql="delete from nhomsanpham where id_nhom=$id";
	$this->query($sql);
	return true;
	}
	
	public function delKind($id)
	{
	$sql="select sp.* from sanpham sp,loaisanpham lsp where lsp.id_loai=$id and lsp.id_loai=sp.id_loai and sp.tontai=1";
	$this->query($sql);
	if($this->num_rows()>0)
	return false;
	$sql="delete from loaisanpham where id_loai=$id";
	$this->query($sql);
	return true;
	}
	
	public function kindFromTo($from,$to)
	{
	$sql="update sanpham set id_loai=$to where id_loai=$from";
	$this->query($sql);
	}
}
?>