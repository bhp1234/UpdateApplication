<?php

class user_Controller extends Controller{
	public function __construct(){
		parent::__construct();
		
	}
	public function index(){
		
		if(!isset($_SESSION["isLogin"]) || $_SESSION["isLogin"]==false)
		{	
			$this->view->redirect("user/login");		
			exit();
		}
		$user=$_SESSION["user"];
		$this->view->user=$this->model->getUser($user["user"]);
		$this->view->model=$this->model;
		if(!isset($_GET["id"]) ||$_GET["id"]==1)
		{
		$tag="user/useraccount";
		}
		else
		{
			if($_GET["id"]==2)
			$tag="user/userinfo";
			else
			{
			if($this->view->user["loaind"]<=2)
			{
			$page=1;
			$tag="user/userbills";
			if(isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"]>0)
			$page=$_GET["page"];
			$this->view->page=$page;
			$this->view->pageSize=$this->model->getPageSize();
			$this->view->bills=$this->model->getBills($page);
			}
			else
			$this->view->redirect("user/index");
			}
		}
		
		if(isset($_POST["type"]))
		{
		$type=$_POST["type"];
		
		switch($type)
		{
		case "changePw":$oldpw=$_POST["pwo"];
						$newpw=$_POST["pwn"];
						$conpw=$_POST["pwc"];
						if($newpw!=$conpw)
						{
						$_SESSION["MsError"]="Mật khẩu nhập lại không chính xác";
						}
						else
						{	
							if(strlen($newpw)<6 || strlen($newpw)>24)
							{
							$_SESSION["MsError"]="Mật khẩu phải lớn hơn 6 và nhor hơn 24 kí tự";
							}
							else
							{
								if($this->model->changePassword($oldpw,$newpw)==false)
								{
									$_SESSION["MsError"]="Mật khẩu cũ không chính xác";
								}
							}
							
						};break;
		case "changeAd":$address=$_POST["address"];	
						$this->model->updateInfo("diachi='$address'",$this->view->user["loaind"]);break;
		case "changePn":$phonenumber=$_POST["phonenumber"];	
						$this->model->updateInfo("dienthoai='$phonenumber'",$this->view->user["loaind"]);break;
		case "changeEm":$email=$_POST["email"];	
						$this->model->updateInfo("email='$email'",$this->view->user["loaind"]);break;
		case "Billdelete":$Billid=$_POST["Billid"];$this->model->destroyBill($Billid);break;
		
		}		
		$this->view->redirect("user/index".(isset($_GET["id"])?"?id=".$_GET["id"]:""));
		exit();
		}
		$this->view->render($tag,"userindex");
	}
	
	public function login(){
		if(!isset($_SESSION))
			session_start();
		if(isset($_SESSION["isLogin"]) && $_SESSION["isLogin"]==1)
		{
			$this->view->redirect("index/index");
			exit();
		}
		if(!isset($_POST['logined']))
		{	
			$this->view->render("user/login");
			
			exit();
		}
		
		$username=$_POST["username"];
		$password=$_POST["password"];
		$retUrl=$_POST["retUrl"];
		if(empty($retUrl))
		$retUrl="index/index";
		$remember=false;
		if(isset($_POST["remember"]))
			$remember=$_POST["remember"];
		
		if(!$this->model->exist_user($username,$password))
		{

			$_SESSION["MsError"]="Tài khoản hoặc mật khẩu không chính xác.";	

			$this->view->redirect("user/login?retUrl=$retUrl");		
			exit();
		}
		else
		{

			if($this->model->isBlocked($username,$password))
			{
			
				echo "<script>alert('Tài khoản của bạn đã bị khóa!');window.location.href='".__SITE_PATH."user/login?retUrl=$retUrl';</script>";		
				exit();
			}	
			$user=$this->model->getUser($username);

			$_SESSION["user"]=$user;
			$_SESSION["isLogin"]=true;


			if($remember==true)
			{
			$key=__KEY_CODE;
				$encoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $user["user"], MCRYPT_MODE_CBC, md5(md5($key))));
				setcookie("user",$encoded,time()+24*3600,"/");
		
			}
			header("location:$retUrl");
			exit();	
		
		}
	}
	
	public function register(){
	if(isset($_SESSION["isLogin"]) && $_SESSION["isLogin"]==1)
		{
			$this->view->redirect("index/index");
			exit();
		}
		if(!isset($_POST['registered']))
		{
			$this->view->render("user/register");
			exit();
		}
		if(isset($_POST["g-recaptcha-response"]))
		{	
			$secret=__SECRET_CAPTCHA;
			$response=$_POST["g-recaptcha-response"];
			$ip=$_SERVER["REMOTE_ADDR"];
			$rsp=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$ip");
			$arr=json_decode($rsp);
			if($arr->success==false)
			{
			$_SESSION["MsError"]="Bạn chưa xác nhận captcha.Hãy xác nhận lại.";
			$this->view->redirect('user/register');
			exit();
			}
		}
		else
		{

		$_SESSION["MsError"]="Bạn chưa xác nhận captcha.Hãy xác nhận lại.";
			$this->view->redirect('user/register');
			exit();
		}
		$retUrl="index/index";
		$username=$_POST["username"];
		if($this->model->exist_user($username," ",2))
		{

			$_SESSION["MsError"]="Tài khoản đã tồn tại.";

			$this->view->redirect('user/register');
			exit();
		}
		else
		{		
			$parameter= array();
			array_push($parameter,$_POST["username"],$_POST["password"],$_POST["email"],$_POST["name"],$_POST["date"],$_POST["address"],$_POST["phonenumber"]);
			$this->model->addMember($parameter);
			$this->view->redirect($retUrl);
			exit();
		}
	}
	
	public function logout(){
		$retUrl="index";
		if(isset($_GET["retUrl"]))
		$retUrl=$_GET["retUrl"];
		Process::logOut();
		header("location: $retUrl");
		exit();
	}
	

}
?>