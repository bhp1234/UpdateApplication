<?php
class Controller {
	public function __construct(){
	
		$this->view=new View;
    }
	public function LoadModel($name){
		$path=__MODEL_PATH.$name."_Model.php";
		if(file_exists($path)){
		require_once($path);
		$name=$name."_Model";
		$this->model=new $name;
		
		}
	}
}
?>