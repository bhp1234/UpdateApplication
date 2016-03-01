<?php
class index_Controller extends Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
	
	$this->view->model=$this->model;
	if(isset($_POST["ProId"]))
	{	
		$id=$_POST["ProId"];
		if(!$this->model->canBuy($id,1))
		{
		$_SESSION["MsError"]="Sản phẩm đã hết hàng.";
		}
		else
		{

		Process::addCartItem($id);
		}					
		
	}
	if(isset($_POST["ProId"]))
	{
	$this->view->redirect("index/index");
	exit();
	}
	$this->view->render("index/index","index");
	
	exit();
	}
	
}
?>