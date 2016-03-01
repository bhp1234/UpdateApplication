<script>
function addCart(id){
		document.getElementById("ProId").value=id;
		
		document.getElementById("Quantity").value=document.getElementById("number").value;
		document.Cart.submit();
		
	}
</script>
<form name="Cart" action="" method="post">
			<input type="hidden" id="ProId" name="ProId" value="">		
			<input type="hidden" id="Quantity" name="Quantity" value="">					
</form>
<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
							<?php	echo'<img src="'.__SITE_PATH.'public/products/large/'.$this->product["hinh"].'" alt="'.$this->product["tensp"]."-".__DNS.'" />' ?>
								<h3>ZOOM</h3>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel" >
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner" style="margin-left:20px;margin-right:20px">
									<?php 
									
									$firstTime=false;
									for($i=0;$i<count($this->listProduct);$i++)
									{
										echo '<div class="item';
										if($firstTime==false)
											{
											echo ' active';
											$firstTime=true;
											}
										
										echo '">';
										for($j=1;$i<count($this->listProduct) && $j<=3;$i++,$j++)
										{
										echo '  <a href="'.__SITE_PATH.'product/detail?ProID='.$this->listProduct[$i]["id"].'"><img src="'.__SITE_PATH.'public/products/small/'.$this->listProduct[$i]["hinh"].'" width="80px" height="80px"  alt="'.$this->listProduct[$i]["tensp"]."-".__DNS.'" ></a>';
										}
										echo' </div>';
									}
										?>
									
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev" style="padding-right:20px">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next" style="padding-left:20px">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
							<?php
								if($this->product["ghichu"]=="new")
								echo '<img src="'.__SITE_PATH.'public/images/new.png" class="newarrival" alt="'.$this->product["tensp"]."-".__DNS.'" />';
							?>
								<h2><?php echo $this->product["tensp"] ?></h2>
								
								<span>
									<span><?php echo number_format($this->product["gia"], 0, ',', ',') ?> VNĐ</span>
									<br/>
									<label>Số lượng:</label>
									<input type="number" id="number" value="1" min="1" max="<?php echo $this->product["soluong"]-$this->product["soluongban"]; ?>" />
									<button type="button" onclick="addCart('<?php echo $this->product["id"] ?>')" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Thêm vào
									</button>
								</span>
								<p><b>Trạng thái: </b><?php if($this->modelPro->Availability($this->product["id"])==true) echo 'Còn hàng '; else echo 'Hết hàng'; ?></p>
								<p><b>Tình trạng:</b> <?php echo $this->product["ghichu"] ?></p>
								<p><b>Brand:</b> E-SHOPPER</p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
								<div  id="error" align="left">
									<?php 									
									if(isset($_SESSION["MsError"]) && !empty($_SESSION["MsError"]))
									echo '<h3><span class="label label-danger" >'.$_SESSION["MsError"].'</span></h3>';
									$_SESSION["MsError"]="";
									?>
								</div>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->

					<?php require_once __VIEW_PATH."product/detail_footer/category_tab.php";
							require_once __VIEW_PATH."product/detail_footer/recommend_items.php";
					?>
					
</div>