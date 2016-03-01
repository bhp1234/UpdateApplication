<?php
class error_Controller extends Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
	$this->view->render("error/404","",1);
	
	exit();
	}
}
?>