<script type="text/javascript">
$(document).ready(function(){ 
  $('.myclass-right').first().trigger('click'); 
});
function addCart(id){
		document.getElementById("ProId").value=id;
	
		document.Cart.submit();
		
	}
</script>
			<form name="Cart" action="" method="post">
			<input type="hidden" id="ProId" name="ProId" value="">			
			</form>
 <div class="col-sm-9 padding-right" style="border:1px solid #9E9E9E;margin-top:-34px"">
	<div style="margin-top:20px">
	<div class="features_items"><!--features_items-->
			<h2 class="title text-center">Sản phẩm mới</h2>
			<?php 
			$result=$this->listProduct;
			foreach($result as $kq)
			{

				echo '<div class="col-sm-4">';
				echo '			<div class="product-image-wrapper">';
				echo '				<div class="single-products">';
				echo '					<div class="productinfo text-center">';
				echo '						<img src="'.__SITE_PATH.'public/products/large/'.$kq["hinh"].'" alt="'.$kq["tensp"]."-".__DNS.'" />';
				echo '						<h2>'.number_format($kq["gia"], 0, ',', ',').' VNĐ</h2>';
				echo '						<p>'.$kq["tensp"].'</p>';
				
					
				echo '					</div>';
				echo '					<div class="product-overlay">';
				echo '						<div class="overlay-content">';
				echo '							<h2>'.number_format($kq["gia"], 0, ',', ',').' VNĐ</h2>';
				echo '							<p>'.$kq["tensp"].'</p>';
				echo '						<a href="'.__SITE_PATH.'product/detail?ProID='.$kq["id"].'" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Xem chi tiết</a>';
				echo '							<a onclick="addCart('.$kq["id"].')"  class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>';
				echo '						</div>';
				echo '					</div>';
				echo '					<img src="'.__SITE_PATH.'public/images/new.png" class="new" alt="'.$kq["tensp"]."-".__DNS.'" />';
				
				echo '				</div></div></div>';
			
			}
			?>
			
	</div>
 </div>