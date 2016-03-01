	
<script type="text/javascript">
$(document).ready(function(){ 
  $('.myclass-right').first().trigger('click'); 
});
function addCart(id){
		document.getElementById("ProId").value=id;
	
		document.Cart.submit();
		
	}
function showError(){
swal(   'Oops...',   'Hàng đã hết số lượng',   'error' );
}
</script>
			<form name="Cart" action="" method="post">
			<input type="hidden" id="ProId" name="ProId" value="">			
			</form>
 <div class="col-sm-9 padding-right" style="border:1px solid #9E9E9E;margin-top:-34px">
	<div >
	<div class="features_items"><!--features_items-->
			<h2 class="title text-center" style="padding-top:15px">Sản phẩm mới</h2>
			<?php 
			if(isset($_SESSION["MsError"]) && !empty($_SESSION["MsError"]))
			{
			echo "<script>showError()</script>";
			$_SESSION["MsError"]="";
			}
			$query="select * from sanpham where ghichu='new' and tontai=1 order by tensp asc limit 0,6";
			$result=$this->model->getProducts($query);
			foreach($result as $kq)
			{

				echo '<div class="col-sm-4">';
				echo '			<div class="product-image-wrapper">';
				echo '				<div class="single-products">';
				echo '					<div class="productinfo text-center">';
				echo '						<img src="'.__SITE_PATH.'public/products/large/'.$kq["hinh"].'" height="255px" alt="'.$kq["tensp"]."-".__DNS.'" />';
				echo '						<h2>'.number_format($kq["gia"], 0, ',', ',').' VNĐ</h2>';
				echo '						<p>'.$kq["tensp"].'</p>';				
					
				echo '					</div>';
				echo '					<div class="product-overlay">';
				echo '						<div class="overlay-content">';
				echo '							<h2>'.number_format($kq["gia"], 0, ',', ',').' VNĐ</h2>';
				echo '							<p>'.$kq["tensp"].'</p>';
				echo '						<a href="'.__SITE_PATH.'product/detail?ProID='.$kq["id"].'" class="btn btn-default add-to-cart"><i class="fa fa-info-circle"></i>Xem chi tiết</a>';
				echo '							<a onclick="addCart('.$kq["id"].')"  class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>';
				echo '						</div>';
				echo '					</div>';
				echo '					<img src="'.__SITE_PATH.'public/images/new.png" class="new" alt="'.$kq["tensp"]."-".__DNS.'" />';
				
				echo '				</div></div></div>';
			
			}
			?>
			
			<a href="#"  style="text-decoration: none;float:right;font-weight:bold;font-size:16px;margin:16px">Xem thêm >></a>
	</div>
	<div style="border:1px solid #9E9E9E;margin-bottom:10px;margin-right:10px"></div>
	<div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
							<?php

							$result=$this->model->getProductType();
							foreach($result as $kq)
							{
								echo'<li><a href="#a'.$kq["id_loai"].'" data-toggle="tab" class="myclass-right">'.$kq["tenloaisp"].'</a></li>';
							}
							?>
							</ul>
						</div>
						<div class="tab-content">
						<?php
						foreach($result as $kq)
						{	
							echo '<div class="tab-pane" id="a'.$kq["id_loai"].'" >';				
							$query="select * from sanpham where id_loai=".$kq["id_loai"]." and tontai=1 order by tensp asc limit 0, 4";
							$result2=$this->model->getProducts($query);
							foreach($result2 as $kq2)
							{
								echo '<div class="col-sm-3" >';
								echo '<div class="product-image-wrapper">';
								echo '		<div class="single-products">';
								echo '			<div class="productinfo text-center" >';
								echo '				<a href="'.__SITE_PATH.'product/detail?ProID='.$kq2["id"].'"> <img src="'.__SITE_PATH.'public/products/large/'.$kq2["hinh"].'" height="255px" alt="'.$kq2["tensp"]."-".__DNS.'" /></a>';
								echo '				<h2>'.number_format($kq2["gia"], 0, ',', ',').' VNĐ</h2>';
								echo '				<p>'.$kq2["tensp"].'</p>';
								echo '				<a onclick="addCart('.$kq2["id"].')" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>';
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
		<h2 class="title text-center" style="padding-top:15px">Mua nhiều nhất</h2>
		<?php 

			$query="select sp.*,sum(ct.soluong) as soluongsum from sanpham sp, chitiethoadon ct where sp.id=ct.masp and sp.tontai=1 group by sp.id order by soluongsum desc limit 0,6";
			$result=$this->model->getProducts($query);
			foreach($result as $kq)
			{

				echo '<div class="col-sm-4">';
				echo '			<div class="product-image-wrapper">';
				echo '				<div class="single-products">';
				echo '					<div class="productinfo text-center">';
				echo '						<img src="'.__SITE_PATH.'public/products/large/'.$kq["hinh"].'" height="255px" alt="'.$kq["tensp"]."-".__DNS.'" />';
				echo '						<h2>'.number_format($kq["gia"], 0, ',', ',').' VNĐ</h2>';
				echo '						<p>'.$kq["tensp"].'</p>';
				echo '						<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>';
				echo '					</div>';
				echo '					<div class="product-overlay">';
				echo '						<div class="overlay-content">';
				echo '							<h2>'.number_format($kq["gia"], 0, ',', ',').' VNĐ</h2>';
				echo '							<p>'.$kq["tensp"].'</p>';
				echo '						<a href="'.__SITE_PATH.'product/detail?ProID='.$kq["id"].'" class="btn btn-default add-to-cart"><i class="fa fa-info-circle"></i>Xem chi tiết</a>';
				echo '							<a onclick="addCart('.$kq["id"].')" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>';
				echo '						</div>';
				echo '					</div>';
				echo '					<img src="'.__SITE_PATH.'public/images/hot.png" class="new"  alt="'.$kq["tensp"]."-".__DNS.'" />';
				echo '				</div></div></div>';
				
			}
			?>
			<a href="#" style="text-decoration: none;float:right;font-weight:bold;font-size:16px;margin:16px">Xem thêm >></a>
	</div>
	
	<div style="border:1px solid #9E9E9E;margin-bottom:10px;margin-right:10px"></div>
	<div class="features_items" ><!--features_items-->
		<h2 class="title text-center" style="padding-top:15px">Xem nhiều nhất</h2>
		<?php 

			$query="select * from sanpham where tontai=1 group by tensp order by luotxem desc,tensp asc limit 0,6";
			$result=$this->model->getProducts($query);
			foreach($result as $kq)
			{

				echo '<div class="col-sm-4">';
				echo '			<div class="product-image-wrapper">';
				echo '				<div class="single-products">';
				echo '					<div class="productinfo text-center">';
				echo '						<img src="'.__SITE_PATH.'public/products/large/'.$kq["hinh"].'" height="255px" alt="'.$kq["tensp"]."-".__DNS.'" />';
				echo '						<h2>'.number_format($kq["gia"], 0, ',', ',').' VNĐ</h2>';
				echo '						<p>'.$kq["tensp"].'</p>';
				echo '						<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>';
				echo '					</div>';
				echo '					<div class="product-overlay">';
				echo '						<div class="overlay-content">';
				echo '							<h2>'.number_format($kq["gia"], 0, ',', ',').' VNĐ</h2>';
				echo '							<p>'.$kq["tensp"].'</p>';
				echo '						<a href="'.__SITE_PATH.'product/detail?ProID='.$kq["id"].'" class="btn btn-default add-to-cart"><i class="fa fa-info-circle"></i>Xem chi tiết</a>';
				echo '							<a onclick="addCart('.$kq["id"].')" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>';
				echo '						</div>';
				echo '					</div>';
				echo '					<img src="'.__SITE_PATH.'public/images/sale.png" class="new"  alt="'.$kq["tensp"]."-".__DNS.'" />';
				echo '				</div></div></div>';
				
			}
			?>
			<a href="#" style="text-decoration: none;float:right;font-weight:bold;font-size:16px;margin:16px">Xem thêm >></a>
	</div>
	
	</div>
</div>

	
    
	

	
	