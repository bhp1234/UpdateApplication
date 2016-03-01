<?php 

if(!isset($_SESSION))
	session_start();
	include 'config/connect.php';

?>
<script type="text/javascript">
$(document).ready(function(){ 
  $('.myclass-left').first().trigger('click'); 
});
</script>
				<div class="col-sm-3">
					<div class="left-sidebar" style="border:1px solid #9E9E9E;">
					<h2 style="margin-top:15px">Category</h2>
					<div class="panel-group category-products" style="margin-top:-20px" id="accordian">
					<?php
					$query="select * from nhomsanpham";
					$result=mysql_query($query);
					while($kq=mysql_fetch_array($result))
					{
					echo '<div class="panel panel-default">';
					echo '<div class="panel-heading">';
					echo '<h4 class="panel-title" >';
					echo '<a data-toggle="collapse" style="font-size:20px" class="myclass-left" data-parent="#accordian" href="#'.$kq["id_nhom"].'">';
					echo	 '<span class="badge pull-right"><i class="fa fa-plus"></i></span>'.$kq["tennhom"].'</a></h4></div>';
					
						$query1='select * from loaisanpham where id_nhom='.$kq["id_nhom"];
						
						$result1=mysql_query($query1);
						$num=mysql_num_rows($result1);
						if($num>0)
						{
						
							echo '<div id="'.$kq["id_nhom"].'" class="panel-collapse collapse">';
							echo '<div class="panel-body" ><ul>';
							while($kq1=mysql_fetch_array($result1))
							{
						
								echo '<li ><a href="#" >'.$kq1["tenloaisp"].' </a></li>';
							}
							echo '</ul></div></div>';
						}
					echo '</div>';
					}

					?>
					</div>
					<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="1000" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 1000</b>
							</div>
					</div>
					
					<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
					</div>
					</div>
				</div>
<script>
$(document).ready( function(){

	$('.left-sidebar  a').addClass('left-color');
	});


</script>