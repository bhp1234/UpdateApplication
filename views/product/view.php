<script type="text/javascript">

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
			


 <div class="col-sm-9 padding-right" style="border:1px solid #9E9E9E;margin-top:-34px"">
	<div style="margin-top:20px">
	<div class="features_items"><!--features_items-->
			<h2 class="title text-center" style="padding-top:15px">
			Có <?php echo $this->num_results; ?> kết quả  
			<?php if($this->type!="SearchKey") echo 'từ '.$this->nameType; else echo 'của từ khóa '.$this->id; ?> 			
			</h2>
			
			<?php 
			if(isset($_SESSION["MsError"]) && !empty($_SESSION["MsError"]))
			{
			echo "<script>showError()</script>";
			$_SESSION["MsError"]="";
			}
			$result=$this->listProduct;
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
				if($kq["ghichu"]=="new")
				echo '					<img src="'.__SITE_PATH.'public/images/new.png" class="new" alt="'.$kq["tensp"]."-".__DNS.'" />';
				else
				{
					if($kq["ghichu"]=="hienthi")
					echo '				<img src="'.__SITE_PATH.'public/images/sale.png" class="new" alt="'.$kq["tensp"]."-".__DNS.'" />';
				}
				echo '				</div></div></div>';
			
			}
			?>
		
	</div>
	<div class="pagination-area">
			<ul class="pagination">
			<?php
			$page=$this->page;
			$pageSize=$this->pageSize;
			$type=$this->type;
			$id=$this->id;
			if($pageSize>1)
			{				
				
				$startPage=$page-3;
				$endPage=$page+3;
				if($startPage<1)
					$startPage=1;
				if($endPage>$pageSize)
					$endPage=$pageSize;
				if($startPage!=1)
				{
					echo '<li><a href="'.__SITE_PATH.'product/view?'.$type.'Id='.$id.'&Page=1"><<</a></li>';
					echo '<li><a>...</a></li>';
				}
				for(;$startPage<=$endPage;$startPage++)
				{
					echo '<li><a href="'.__SITE_PATH.'product/view?'.$type.'Id='.$id.'&Page='.$startPage.'" ';
					if($startPage==$page)
					echo 'class="active"';
					echo '>'.$startPage.'</a></li>';
				}
				
				if($endPage!=$pageSize)
				{
					echo '<li><a>...</a></li>';
					echo '<li><a href="'.__SITE_PATH.'product/view?'.$type.'Id='.$id.'&Page='.$pageSize.'">>></a></li>';					
				}
				
			}
				
			?>
			</ul>
		</div>	
 </div>