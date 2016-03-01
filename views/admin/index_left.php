<?php
	$user=$_SESSION["user"];
	$user=$this->model->getUser($user["user"]);
?>
<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel" style="padding-bottom: 60px;">
            <div class="pull-left image">
              <!--<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">-->
            </div>
            <div class="pull-left info">
              <p><?php echo $user["tennv"] ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">THANH CHỨC NĂNG</li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Tùy chọn giao diện</span>
                <span class="label label-primary pull-right">3</span>
              </a>
              <ul class="treeview-menu">
			    <li><a href="" onclick="changeLayout('')"><i class="fa fa-circle-o"></i> Mặc định</a></li>
                <li><a href="" onclick="changeLayout('layout-boxed')"><i class="fa fa-circle-o"></i> Boxed</a></li>
                <li><a href="" onclick="changeLayout('sidebar-collapse')"><i class="fa fa-circle-o"></i> Giấu thanh chức năng</a></li>
              </ul>
            </li>

			<li>
              <a href="<?php echo __SITE_PATH.'admin/category/index' ?>">
                <i class="fa fa-cubes"></i> <span>Nhóm/Loại hàng hóa</span>

              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Hàng hóa</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
			  <li ><a href="<?php echo __SITE_PATH.'admin/products/index?All=1'; ?>"><i class="fa fa-circle-o"></i> Xem hết</a></li>
			  <?php
					
					foreach($this->model->getCategory() as $kq)
					{					
					$result=$this->model->getProductType($kq["id_nhom"]);
					
						if(count($result>0))
						{
						echo '<li class="treeview" style="margin-bottom:9px"><a href="'.__SITE_PATH.'admin/products/index?CategoryId='.$kq["id_nhom"].'"  style="display:inline"><i class="fa fa-circle-o"></i> '.$kq["tennhom"].' </a><a href="#" style="display:inline;float:right;margin-top:5px;width:10px"><i class="fa fa-angle-left pull-right"></i></a>';
						echo '<ul class="treeview-menu">';
							foreach($result as $kq1)
							{
						
								echo '<li ><a href="'.__SITE_PATH.'admin/products/index?KindId='.$kq1["id_loai"].'" id="Kind'.$kq1["id_loai"].'" >'.$kq1["tenloaisp"].'  </a></li>';
							}
						echo '</ul></li>';
						}
						else
						{
						echo '<li><a href="#"><i class="fa fa-circle-o"></i> '.$kq["tennhom"].'</a></li>';
						}
					}

					?>           
              </ul>
            </li>

			<li>
              <a href="<?php echo __SITE_PATH.'admin/bill/index' ?>">
                <i class="fa fa-clipboard"></i> <span>Hóa đơn</span>
				
                <?php
				$numPending=$this->model->getBillsPending();
				if($numPending!=0)
				echo '<small class="label pull-right bg-red">'.count($numPending).'</small> ';
				?>
              </a>
            </li>
			
            <li>
              <a href="pages/calendar.html">
                <i class="fa fa-calendar"></i> <span>Lịch/Sự kiện</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>
            <li>
              <a href="pages/mailbox/mailbox.html">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>

			<li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Thông tin website</span>
				<i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
			    <li><a href="" ><i class="fa fa-circle-o"></i> Liên hệ</a></li>
                <li><a href="" ><i class="fa fa-circle-o"></i> Thông tin chung</a></li>
   
              </ul>
            </li>
            <li class="header">LABELS</li>
            <li><a ><i class="fa fa-circle-o text-red"></i> <span>Quan trọng</span></a></li>
            <li><a ><i class="fa fa-circle-o text-yellow"></i> <span>Cảnh báo</span></a></li>
            <li><a ><i class="fa fa-circle-o text-aqua"></i> <span>Thông tin</span></a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>