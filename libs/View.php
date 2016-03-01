<?php
class View{
	public function __construct(){
		}
	public function render($link="",$noInclude="",$admin=0){
	
		if($noInclude!="")
		{		
			if($admin==0)
			{
			include __TEMPLATES_PATH."Home/header.php";
			if($noInclude=="index")
			include __TEMPLATES_PATH."Home/slider.php";
			echo '<div class="container">';
			echo '<div class="row" style="margin-top:30px">';
			switch($noInclude)
			{
			case "index":{include __VIEW_PATH.$link."_left.php";
							include __VIEW_PATH.$link."_right.php";};break;
			case "product":include __VIEW_PATH."index/index_left.php";
							include __VIEW_PATH.$link.".php";break;
			case "userindex":include __VIEW_PATH."user/index_left.php";
							include __VIEW_PATH.$link.".php";break;
			default:include __VIEW_PATH.$link.".php";
			}
			
			echo '</div>';
			echo '</div>';
			include __TEMPLATES_PATH."Home/footer.php";
			}
			else
			{
			include __TEMPLATES_PATH."Admin/header.php";
			include __VIEW_PATH."admin/index_left.php";
			echo'<div class="content-wrapper" style="margin-top: -20px;">';
			switch($noInclude)
			{
			case "index":include __VIEW_PATH.$link."_right.php";break;
			case "product":include __VIEW_PATH."index/index_left.php";
							include __VIEW_PATH.$link.".php";break;
			case "userindex":include __VIEW_PATH."user/index_left.php";
							include __VIEW_PATH.$link.".php";break;
			default:include __VIEW_PATH.$link.".php";
			}
			echo'</div>';
			include __TEMPLATES_PATH."Admin/footer.php";
			}
		}
		else
			include __VIEW_PATH.$link.".php";
	}

	public function redirect($link=""){
		
		if($link=="")
		{
			$link=__SITE_PATH;
		}
		else
		{
			$link=__SITE_PATH.$link;
		}
		header("location:$link");
	
	}	
}
?>