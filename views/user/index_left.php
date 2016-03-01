<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="<?php echo __SITE_PATH.'index/index'; ?>">Trang chủ</a></li>
				  <li class="active">Thông tin người dùng</li>
				</ol>
</div>
<div class="col-sm-3" >
					<div class="left-sidebar" style="border:1px solid #9E9E9E">
					
					<div class="panel-group category-products"  id="accordian">
					<div class="panel panel-default">
					<div class="panel-heading">			
					<h4 class="panel-title" >
					<a  style="font-size:16px"   href="<?php echo __SITE_PATH."user/index" ?>">
					THÔNG TIN TÀI KHOẢN
					</a>
					</h4>					
					</div>
					</div>
					
					<div class="panel panel-default" style="margin-top:30px">
					<div class="panel-heading">			
					<h4 class="panel-title" >
					<a style="font-size:16px"    href="<?php echo __SITE_PATH."user/index?id=2" ?>">
					THÔNG TIN NGƯỜI DÙNG
					</a>
					</h4>					
					</div>
					</div>
					<?php if($this->user["loaind"]<=2){?>
					<div class="panel panel-default" style="margin-top:30px">
					<div class="panel-heading">			
					<h4 class="panel-title" >
					<a style="font-size:16px"    href="<?php echo __SITE_PATH."user/index?id=3" ?>">
					LỊCH SỬ MUA HÀNG
					</a>
					</h4>					
					</div>
					</div>
					<?php }?>
					</div>
					</div>
</div>

					