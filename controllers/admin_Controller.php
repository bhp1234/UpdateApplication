<?php
class admin_Controller extends Controller{
	public function __construct(){
		parent::__construct();
	}
	
	public function checkPower(){
		if(!isset($_SESSION["isLogin"]) || $_SESSION["isLogin"]==false)
			{	
				$this->view->redirect("user/login");		
				exit();
			}	
		if($_SESSION["user"]["loaind"]!=4)
		{
		$this->view->redirect("index/index");		
		exit();
		}
	}
	
	public function index(){
		$this->checkPower();
		$this->view->model=$this->model;
		$this->view->render("admin/index","index",1);
		
		exit();
	}
	
	public function products($id){
		$this->checkPower();
		
		$this->view->model=$this->model;
		switch($id)
		{
		case "index":
					{
					if(!isset($_GET["CategoryId"]) && !isset($_GET["KindId"]) && !isset($_GET["SearchKeyId"]) && !isset($_GET["All"]) && !isset($_POST["type"]))
					{
							$this->view->redirect("admin/index");
					}
					if(isset($_GET["CategoryId"]))
					{
					$type="Category";
					$id=$_GET["CategoryId"];
					}
					else
					{
						if(isset($_GET["KindId"]))
						{
						$type="Kind";
						$id=$_GET["KindId"];
						}
						else
						{
							if(isset($_GET["SearchKey"]))
							{
							$type="SearchKey";
							$id=$_GET["SearchKeyId"];
							}
							else
							{
								if(isset($_GET["All"]))
								{
								$type="All";
								$id=$_GET["All"];
								}
								else
								{															
									$type="Process";							
								}
								
							}
						}
					}
					if(isset($_POST["type"]))
						$type=$_POST["type"];
					//Lấy bản ghi theo loại
					switch($type)
					{
					case "Category"	:$listPro=$this->model->getProByCateId($id);$this->view->title="Nhóm sản phẩm ".$this->model->getNameObject("Category",$id);break;
					case "Kind"		:$listPro=$this->model->getProByKindId($id);$this->view->title="Loại sản phẩm ".$this->model->getNameObject("Kind",$id);break;
					case "SearchKey":$listPro=$this->model->getProByKey($id);$this->view->title="Loại sản phẩm ".$this->model->getNameObject("Product",$id);break;
					case "All"		:$listPro=$this->model->getAll();$this->view->title="Tất cả";break;
					case "Process"	:if(!isset($_POST["retUrl"])) $this->view->redirect('admin/index'); header('Location: '.$_POST["retUrl"]);break;
					case "add"		:{if(empty($_POST["proName"]) || empty($_FILES["smallImg"]) || empty($_FILES["bigImg"]))
									{
									$_SESSION["MsError"]="Bạn chưa điền đầy đủ thông tin.";
									header('Location: '.$_POST["retUrl"]);
									exit();
									}
									$name=$_POST["proName"];
									$kind=$_POST["kind"];
									$price=$_POST["proPrice"];
									$quantity=$_POST["proQuan"];
									$des=$_POST["proDes"];
									$note=$_POST["proNote"];
									$smallimg=$_FILES["smallImg"];
									$bigimg=$_FILES["bigImg"];
									$uploadSmall = 'public/products/small/'. basename($smallimg['name']);
									if (file_exists($uploadSmall )) 
									{
									$_SESSION["MsError"]="Hình ảnh đã tồn tại. Hãy đổi tên hoặc thay hình ảnh khác";
									header('Location: '.$_POST["retUrl"]);
									exit();
									}
									if($this->model->checkName($name))
									{
									$_SESSION["MsError"]="Tên sản phẩm đã tồn tại.";
									header('Location: '.$_POST["retUrl"]);
									exit();
									}
									$uploadBig = 'public/products/large/' . basename($smallimg['name']);
									move_uploaded_file($smallimg["tmp_name"], $uploadSmall );
									move_uploaded_file($bigimg["tmp_name"], $uploadBig );
									$this->model->addProduct($name,$price,$quantity,$kind,$note,$des,basename($smallimg['name']));
									$_SESSION["MsSuccess"]="Thêm sản phẩm thành công";
									header('Location: '.$_POST["retUrl"]);
									exit();
									};break;
					case "delete"	:if(isset($_POST["Id"]))
									{
									$arrayBill=$_POST["Id"];
									foreach($arrayBill as $item)
									$this->model->deleteProduct($item);
									
									}
									header('Location: '.$_POST["retUrl"]);
									
									;break;
					}

					$this->view->result=$listPro;
					$this->view->render("admin/products/index"," ",1);exit();
					};break;
		case "view"	:{ $result=$this->model->getProById($_GET["Id"]);
					if($result==0)
					$this->view->redirect("admin/index");
					if(isset($_POST["type"]))
					{
					switch($_POST["type"])
					{
					case "edit"	:if(empty($_POST["proName"]) )
									{
									$_SESSION["MsError"]="Bạn chưa điền đầy đủ thông tin.";
									$this->view->redirect("admin/products/view?Id=".$_GET["Id"]);
									}
									$name=$_POST["proName"];
									$kind=$_POST["kind"];
									$price=$_POST["proPrice"];
									$quantity=$_POST["proQuan"];
									$des=$_POST["proDes"];
									$note=$_POST["proNote"];
									$smallimg=$_FILES["smallImg"];
									$bigimg=$_FILES["bigImg"];
									$imgname=$result["hinh"];
								if($name!=$result["tensp"] &&  $this->model->checkName($name))
									{
									$_SESSION["MsError"]="Tên sản phẩm đã tồn tại.";
									$this->view->redirect("admin/products/view?Id=".$_GET["Id"]);
									}
									$uploadSmall = 'public/products/small/'. $imgname;
									$uploadBig = 'public/products/large/' . $imgname;
									
									if(!empty($smallimg))
									move_uploaded_file($smallimg["tmp_name"], $uploadSmall );
									if(!empty($bigimg))
									move_uploaded_file($bigimg["tmp_name"], $uploadBig );
									if($this->model->updateProduct($name,$price,$quantity,$kind,$note,$des,$result["id"]))
									$_SESSION["MsSuccess"]="Thay đổi sản phẩm thành công";	
									else
									$_SESSION["MsError"]="Số lượng tồn bị âm";
									$this->view->redirect("admin/products/view?Id=".$_GET["Id"]);
									break;	
					}
					}
					$this->view->product=$result;
					$this->view->render("admin/products/view"," ",1);exit();	
					};break;
		default:$this->view->redirect("admin/index");
		}

	}
	
	public function bill($id){
		$this->checkPower();
		$this->view->model=$this->model;
		switch($id)
		{
		case "index":{$this->view->result=$this->model->getBills();
					if(isset($_POST["type"]))
					{
						if(isset($_POST["billId"]))
						{
							$arrayBill=$_POST["billId"];
							foreach($arrayBill as $item)
							{
							$this->model->changeBillState($item,$_POST["type"]);
							}
							$this->view->result=$this->model->getBills();
						}
						$this->view->redirect("admin/bill/index");
						exit();
					}
					$this->view->render("admin/bill/index"," ",1);exit();};break;
		default:$this->view->redirect("admin/index");
		}
		exit();
	}
	
	public function category($id){
		$this->checkPower();
		$this->view->model=$this->model;
		switch($id)
		{
		case "index":{
					if(isset($_POST["type"]))
					{
						switch($_POST["type"])
						{
						case "addCate"	:$this->model->addCategory($_POST["cateName"]);break;
						case "addKind"	:$this->model->addKind($_POST["cateId"],$_POST["kindName"]);break;
						case "editCate"	:$this->model->renameCategory($_POST["cateId"],$_POST["cateName"]);break;
						case "editKind"	:$this->model->renameKind($_POST["kindId"],$_POST["kindName"]);break;
						case "kindFromTo":$this->model->kindFromTo($_POST["kindFrom"],$_POST["kindTo"]);break;
						case "delCate"	:if(!$this->model->delCate($_POST["Id"])) 
										$_SESSION["MsError"]="Nhóm này chứa sản phẩm. Hãy xóa hết sản phẩm trong nhóm hoặc chuyển sản phẩm sang nhóm khác.";break;
						case "delKind"	:if(!$this->model->delKind($_POST["Id"])) 
										$_SESSION["MsError"]="Loại này chứa sản phẩm. Hãy xóa hết sản phẩm trong loại hoặc chuyển sản phẩm sang loại khác.";break;
						}
						$this->view->redirect("admin/category/index");exit();
					}
					$this->view->render("admin/category/index"," ",1);exit();
					};break;
		default:$this->view->redirect("admin/index");
		}
		exit();
	}


}
?>