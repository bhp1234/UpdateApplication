<?php 

if(!isset($_SESSION))
	session_start();
	include 'config/connect.php';
?>
<?php echo 0123 ?>
<script type="text/javascript">
$(document).ready(function(){ 
  $('.myclass-right').first().trigger('click'); 
});
</script>
 <div class="col-sm-9 padding-right" style="border:1px solid #9E9E9E;margin-top:-20px">
	<div style="margin-top:20px">
	<div class="features_items"><!--features_items-->
			<h2 class="title text-center">Sản phẩm mới</h2>
			<?php 

			$query="select * from sanpham where ghichu='new' order by tensp asc limit 0,6";
			$result=mysql_query($query);

			while($kq=mysql_fetch_array($result))
			{

				echo '<div class="col-sm-4">';
				echo '			<div class="product-image-wrapper">';
				echo '				<div class="single-products">';
				echo '					<div class="productinfo text-center">';
				echo '						<img src="products/large/'.$kq["hinh"].'" alt="" />';
				echo '						<h2>'.number_format($kq["gia"], 0, ',', ',').' VNĐ</h2>';
				echo '						<p>'.$kq["tensp"].'</p>';
				echo '						<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>';
				echo '					</div>';
				echo '					<div class="product-overlay">';
				echo '						<div class="overlay-content">';
				echo '							<h2>'.number_format($kq["gia"], 0, ',', ',').' VNĐ</h2>';
				echo '							<p>'.$kq["tensp"].'</p>';
				echo '							<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>';
				echo '						</div>';
				echo '					</div>';
				echo '					<img src="images/new.png" class="new" alt="" />';
				echo '				</div></div></div>';
				
			}
			?>
			
			<a href="#" style="text-decoration: none;float:right;font-weight:bold;font-size:16px;margin:16px">Xem thêm >></a>
	</div>
	<div style="border:1px solid #9E9E9E;margin-bottom:10px;margin-right:10px"></div>
	<div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
							<?php

							$query="SELECT * FROM loaisanpham group by tenloaisp order by luotmua desc, tenloaisp asc limit 0,5";
							$result=mysql_query($query);
							while($kq=mysql_fetch_array($result))
							{
								echo'<li><a href="#a'.$kq["id_loai"].'" data-toggle="tab" class="myclass-right">'.$kq["tenloaisp"].'</a></li>';
							}
							?>
							</ul>
						</div>
						<div class="tab-content">
						<?php
						mysql_data_seek($result,0);
						while($kq=mysql_fetch_array($result))
						{	
							echo '<div class="tab-pane" id="a'.$kq["id_loai"].'" >';				
							$query="select * from sanpham where id_loai=".$kq["id_loai"]." order by tensp asc limit 0, 4";
							$result2=mysql_query($query);
							while($kq2=mysql_fetch_array($result2))
							{
								echo '<div class="col-sm-3" >';
								echo '<div class="product-image-wrapper">';
								echo '		<div class="single-products">';
								echo '			<div class="productinfo text-center" >';
								echo '				<img src="products/large/'.$kq2["hinh"].'" height="183px" alt="" />';
								echo '				<h2>'.number_format($kq2["gia"], 0, ',', ',').' VNĐ</h2>';
								echo '				<p>'.$kq2["tensp"].'</p>';
								echo '				<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>';
								echo '			</div>';
								echo '</div></div></div>';
							}
							echo '</div>';
						}
						?>
						</div>
	</div>
	<div style="border:1px solid #9E9E9E;margin-bottom:10px;margin-right:10px"></div>
	<div class="features_items"><!--features_items-->
		<h2 class="title text-center">Mua nhiều nhất</h2>
		<?php 

			$query="select * from sanpham group by tensp order by soluongban desc,tensp asc limit 0,6";
			$result=mysql_query($query);

			while($kq=mysql_fetch_array($result))
			{

				echo '<div class="col-sm-4">';
				echo '			<div class="product-image-wrapper">';
				echo '				<div class="single-products">';
				echo '					<div class="productinfo text-center">';
				echo '						<img src="products/large/'.$kq["hinh"].'" alt="" />';
				echo '						<h2>'.number_format($kq["gia"], 0, ',', ',').' VNĐ</h2>';
				echo '						<p>'.$kq["tensp"].'</p>';
				echo '						<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>';
				echo '					</div>';
				echo '					<div class="product-overlay">';
				echo '						<div class="overlay-content">';
				echo '							<h2>'.number_format($kq["gia"], 0, ',', ',').' VNĐ</h2>';
				echo '							<p>'.$kq["tensp"].'</p>';
				echo '							<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>';
				echo '						</div>';
				echo '					</div>';
				echo '					<img src="images/hot.png" class="new" alt="" />';
				echo '				</div></div></div>';
				
			}
			?>
			<a href="#" style="text-decoration: none;float:right;font-weight:bold;font-size:16px;margin:16px">Xem thêm >></a>
	</div>
	
	<div style="border:1px solid #9E9E9E;margin-bottom:10px;margin-right:10px"></div>
	<div class="features_items"><!--features_items-->
		<h2 class="title text-center">Xem nhiều nhất</h2>
		<?php 

			$query="select * from sanpham group by tensp order by luotxem desc,tensp asc limit 0,6";
			$result=mysql_query($query);

			while($kq=mysql_fetch_array($result))
			{

				echo '<div class="col-sm-4">';
				echo '			<div class="product-image-wrapper">';
				echo '				<div class="single-products">';
				echo '					<div class="productinfo text-center">';
				echo '						<img src="products/large/'.$kq["hinh"].'" alt="" />';
				echo '						<h2>'.number_format($kq["gia"], 0, ',', ',').' VNĐ</h2>';
				echo '						<p>'.$kq["tensp"].'</p>';
				echo '						<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>';
				echo '					</div>';
				echo '					<div class="product-overlay">';
				echo '						<div class="overlay-content">';
				echo '							<h2>'.number_format($kq["gia"], 0, ',', ',').' VNĐ</h2>';
				echo '							<p>'.$kq["tensp"].'</p>';
				echo '							<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>';
				echo '						</div>';
				echo '					</div>';
				echo '					<img src="images/sale.png" class="new" alt="" />';
				echo '				</div></div></div>';
				
			}
			?>
			<a href="#" style="text-decoration: none;float:right;font-weight:bold;font-size:16px;margin:16px">Xem thêm >></a>
	</div>
	
	</div>
</div>
