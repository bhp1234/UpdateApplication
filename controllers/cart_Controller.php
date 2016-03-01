<?php
class cart_Controller extends Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
	if($this->model->getUser(Process::getIdUser())["loaind"]>2)
	$this->view->redirect("index/index");
	$this->view->model=$this->model;
	$cart=Process::getCart();
	
	if(isset($_POST["type"]))
	{
	
	$type=$_POST["type"];
	switch($type)
	{
	case "update"		:for($i=0;$i<count($cart->listCart);$i++)
						{
							
								if(isset($_POST["quantity".$cart->listCart[$i]->id]))
								$cart->listCart[$i]->quantity=$_POST["quantity".$cart->listCart[$i]->id];							
						};break;
	case "delete"		:$cart->removeItem(-1,$_POST["id"]);break;
	case "checkout"		:$this->model->createBill();$cart=new Cart;
						$_SESSION["success"]="Đơn hàng của bạn được tạo thành công";break;
	case "checkoutNon"	:if(empty($_POST["address"]) || empty($_POST["phonenumber"]) || empty($_POST["email"]))
						{
						$_SESSION["error"]="Bạn chưa điền đầy đủ thông tin.";
						}
						else
						{
						$this->model->createBillNon($_POST["address"],$_POST["phonenumber"],$_POST["email"]);$cart=new Cart;
						$_SESSION["success"]="Đơn hàng của bạn được tạo thành công";
						}break;
	}
	
	$this->model->update($cart);
	Process::setCart($cart);
	$this->view->redirect("cart/index");
	exit();
	}
	$this->view->render("cart/index","cart",0);	
	exit();
	}
	
}
?>