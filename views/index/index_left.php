<?php 
    //Process::addCartItem(1);
    ?>
<script type="text/javascript">
$(document).ready(function(){ 
  <?php if(isset($_GET["KindId"])) echo '$(".myclass-left'.$this->model->getCateIdfromKindId($_GET["KindId"]).'").first().trigger("click");';
  else echo '$(".myclass-left1").first().trigger("click");'; ?>
  <?php if(isset($_GET["KindId"])) echo '$(function() {  $("#Kind'.$_GET["KindId"].'").focus();});'; ?>
});
</script>
			
				<div class="col-sm-3" >
					<div class="left-sidebar" style="border:1px solid #9E9E9E;">
					<h2 style="margin-top:15px">Category</h2>
					<div class="panel-group category-products" style="margin-top:-20px" id="accordian">
					<?php
					
					//for($i=0;$i<count($this->category);i++)
					foreach($this->model->getCategory() as $kq)
					{
					echo '<div class="panel panel-default">';
					echo '<div class="panel-heading">';
					echo '<h4 class="panel-title" >';
					echo '<a data-toggle="collapse" style="font-size:20px"  class="myclass-left'.$kq["id_nhom"].'" data-parent="#accordian" href="#'.$kq["id_nhom"].'">';
					echo	 ''.$kq["tennhom"].'</a><a href="'.__SITE_PATH.'product/view?CategoryId='.$kq["id_nhom"].'"><span class="badge pull-right"><i class="fa fa-asterisk"></i></span></a></h4></div>';
					$result= array();
					
					$result=$this->model->getProductType($kq["id_nhom"]);
					
						if(count($result>0))
						{
						
							echo '<div id="'.$kq["id_nhom"].'" class="panel-collapse collapse">';
							echo '<div class="panel-body" ><ul>';
							foreach($result as $kq1)
							{
						
								echo '<li ><a href="'.__SITE_PATH.'product/view?KindId='.$kq1["id_loai"].'" id="Kind'.$kq1["id_loai"].'" >'.$kq1["tenloaisp"].'  </a></li>';
							}
							echo '</ul></div></div>';
						}
					echo '</div>';
					}

					?>
					</div>
					<div class="shipping text-center"><!--shipping-->
						<?php //echo'	<img src="'.__SITE_PATH.'public/images/home/shipping.jpg" alt="" />'; ?>
					</div>
					</div>
				</div>
<script>
$(document).ready( function(){

	$('.left-sidebar  a').addClass('left-color');
	});


</script>


	
    
	

	
	