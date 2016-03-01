<?php
class Bootstrap{
	public function __construct(){
	
	  if(isset($_GET['url'])){
		  $url=rtrim($_GET['url'],"/");
		  $url=explode('/',$url);
		  $c=$url[0];
	  }else{
		  $c="index";
	  }
	  require_once __LIB_PATH."Process.php";

	  $file_controller=__CONTROLLER_PATH.$c."_Controller.php";
	  
	  if(file_exists($file_controller)){
		
	      include $file_controller;
	  }
	  else{
		$this->error();
	   exit();
	  }
	  $name_controller=$c."_Controller";
	  $controller=new $name_controller;
	  $controller->LoadModel($c);//autoload model
		
	  $controller->model->isLogged();

		
		
		  if(isset($url[2])){
		  
			if($url[0]=='admin')
			{
			if($this->existFunction($controller,$url[1]))
			$controller->{$url[1]}($url[2]);
			else{
					$this->error();
					return;
				}
			
			}
			else
			if($this->existFunction($controller,$url[2]))
			{
				
			  $controller->{$url[1]}($url[2]);
			 }
			  else{
					$this->error();
					return;
				}

		  }else{
			
			  if(isset($url[1])){
		
				if($this->existFunction($controller,$url[1]))
					$controller->{$url[1]}("index") ;
				else{
					$this->error();
					exit();
				}
			  
			  }else{
			  if($this->existFunction($controller,"index"))
			  $controller->{"index"}();
			  else
			  {
			  $this->error();
					exit();
			  }
			  }
		  }
		
		  
	}
	
	public function existFunction($object,$name){
	if(method_exists($object,$name))
	return true;
	else
	return false;
	}
	
	
	public function error(){
	 require_once __CONTROLLER_PATH."error_Controller.php";
		$controller=new error_Controller;
	   $controller->index();
	}
}
?>