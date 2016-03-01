<?php
class product_Controller extends Controller{
	public function __construct(){
		parent::__construct();
	}
	
	public function view(){
	
		if(!isset($_GET["CategoryId"]) && !isset($_GET["KindId"]) && !isset($_GET["SearchKeyId"]))
		{
			$this->view->redirect("index/index");
		}
		//Lấy kích thước trang và loại trang
		if(isset($_GET["CategoryId"]))
		{
		$type="Category";
		$id=$_GET["CategoryId"];
		$pageSize=$this->model->getPageSize($id,$type);
		}
		else
		{
			if(isset($_GET["KindId"]))
			{
			$type="Kind";
			$id=$_GET["KindId"];
			$pageSize=$this->model->getPageSize($id,$type);
			}
			else
			{
			$type="SearchKey";
			$id=$_GET["SearchKeyId"];
			$pageSize=$this->model->getPageSize($id,$type);
			}
		}
		
		//Lấy trang hiện tại
		if(isset($_GET["Page"]))
			$page=$_GET["Page"];
		else
			$page=1;
		if($page<=0)
			$page=1;
		if($page>$pageSize)
			$page=$pageSize;
		
		//Lấy bản ghi theo loại
		if($type=="Category")
		$listPro=$this->model->getProByCateId($id,$page);
		else
		{
			if($type=="Kind")
			$listPro=$this->model->getProByKindId($id,$page);
			else
			$listPro=$this->model->getProByKey($id,$page);
			
		}
		//Khai báo biến cho view
		$this->view->listProduct=$listPro;
		$this->view->page=$page;
		$this->view->pageSize=$pageSize;
		$this->view->type=$type;
		$this->view->id=$id;
		$this->view->num_results=$this->model->num_results();
		$this->view->nameType=$this->model->getNameType($id,$type);
		
		//Left-index
		require_once __MODEL_PATH."public_Model.php";
		$this->view->model=new public_Model;

		//Thêm vào giỏ hàng
		if(isset($_POST["ProId"]))
		{				
			$idi=$_POST["ProId"];
			if(!$this->model->canBuy($idi,1))
			{
				$_SESSION["MsError"]="Sản phẩm đã hết hàng.";
			}
			else
			{
				Process::addCartItem($idi);
			}
			
		}	
		if(isset($_POST["ProId"]))
		{

		$this->view->redirect("product/view?".$type."Id=$id");
		exit();
		}
		
		$this->view->render("product/view","product",0);
		
	exit();
	}
	
	public function detail(){
	if(!isset($_GET["ProID"]))
		$this->view->redirect("index/index");
	$product=$this->model->getProductById($_GET["ProID"]);
	$listProduct=$this->model->getRelatedproducts($product["id_loai"]);
	if($product==0)
		$this->view->redirect("index/index");
	$this->view->product=$product;
	$this->view->listProduct=$listProduct;
	$this->view->modelPro=new product_Model;
	require_once  __MODEL_PATH."public_Model.php";
	$this->view->model=new public_Model;

	if(isset($_POST["ProId"]) && isset($_POST["Quantity"]))
	{
		$id=$_POST["ProId"];
		$quantity=$_POST["Quantity"];		
		if(!$this->model->Availability($id))
		$_SESSION["MsError"]="Sản phẩm đã hết hàng.";
		else
		{
			if(!$this->model->canBuy($id,$quantity))
				$_SESSION["MsError"]="Số lượng vượt quá số lượng tồn.";
			else
			{
				if($quantity>=1)
				Process::addCartItem($id,$quantity);
				else
				$_SESSION["MsError"]="Số lượng mua không hợp lí.";
			}
		}
		
		
	}
	if(isset($_POST["ProId"]))
	{
	$this->view->redirect("product/detail?ProID=$id");
	exit();
	}	
	$this->view->render("product/detail","product",0);
	
	exit();
	}
		
}
?>