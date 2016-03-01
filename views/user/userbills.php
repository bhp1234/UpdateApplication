 <script>
 function confirmDel(id){
	swal({   
	title: "Bạn muốn hủy hóa đơn này ?",   
	text: "Hãy chắc chắn!",   
	type: "warning",   
	showCancelButton: true,   
	confirmButtonColor: "#DD6B55",   
	confirmButtonText: "Đồng ý!",   
	closeOnConfirm: false }, 
	function(){ 
	document.getElementsByName("Billid")[0].value=id;
	document.acDel.submit();
	  });
}

 </script>
<form action="" method="post" name="acDel" >
<input type="hidden" name="Billid" >
<input type="hidden" name="type" value="Billdelete">
</form>
 <div class="col-sm-9 padding-right" style="border:1px solid #9E9E9E;height:900px">
 <section id="cart_items">
 <div class="table-responsive cart_info" style="margin:10px;border:none">
 <table style="border-style:none;line-height: 150%;" class="table table-condensed" >
 <thead>
						<tr class="cart_menu">
							<td class="image" style="width:80px">ID</td>
							<td class="price" style="border-left:1px solid white;width:100px" >Ngày đặt</td>
							<td class="price" style="border-left:1px solid white;width:80px"> Số lượng</td>
							<td class="quantity" style="border-left:1px solid white">Thành tiền</td>
							<td class="total" style="border-left:1px solid white">Tổng cộng</td>
							<td style="border-left:1px solid white">Trạng thái</td>
						</tr>
</thead>
<tbody>
		<?php
		$bills=$this->bills;
		if($bills!=0)
		{
		foreach($bills as $item)
		{
		echo'	<tr style="border-bottom:1px solid #FE980F" >';
		echo'		<td class="cart_product">'.$item["id_hoadon"].'</td>';
		echo'		<td class="cart_product">'.$item["ngaydat"].'</td>';
		echo'		<td class="cart_product">'.$item["soluong"].'</td>';
		echo'		<td class="cart_product">'.number_format($item["thanhtien"]-$item["thanhtien"]*$this->user["chietkhau"]/100, 0, ',', ',').' VNĐ</td>';
		echo'		<td class="cart_product">'.number_format($item["thanhtien"], 0, ',', ',').' VNĐ</td>';
		echo'		<td class="cart_product">';
		switch($item["matinhtrang"])
		{
		case 1:echo '<span class="label label-default">'.$item["tinhtrang"].'</span>';break;
		case 2:echo '<span class="label label-primary">'.$item["tinhtrang"].'</span>';break;
		case 3:echo '<span class="label label-success">'.$item["tinhtrang"].'</span>';break;
		case 4:echo '<span class="label label-danger">'.$item["tinhtrang"].'</span>';break;
		}

		if($item["matinhtrang"]<=2)
		
		echo'&nbsp;&nbsp;<a class="cart_quantity_delete" align="center" style="cursor:pointer" onclick="confirmDel('.$item["id_hoadon"].')"><i class="fa fa-times"></i></a>';
		echo'</td>';
		echo'	</tr>';
		}
		}
		else
		{
		echo '<tr><td class="cart_product" >Bạn chưa có hóa đơn nào</td></tr>';
		}
		?>
<tbody>
 </table>
 </div>
 </section>
 <div class="pagination-area">
			<ul class="pagination">
			<?php
			$page=$this->page;
			$pageSize=$this->pageSize;
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
					echo '<li><a href="'.__SITE_PATH.'user/index?id=3&Page=1"><<</a></li>';
					echo '<li><a>...</a></li>';
				}
				for(;$startPage<=$endPage;$startPage++)
				{
					echo '<li><a href="'.__SITE_PATH.'user/index?id=3&Page='.$startPage.'" ';
					if($startPage==$page)
					echo 'class="active"';
					echo '>'.$startPage.'</a></li>';
				}
				
				if($endPage!=$pageSize)
				{
					echo '<li><a>...</a></li>';
					echo '<li><a href="'.__SITE_PATH.'user/index?id=3&Page='.$pageSize.'">>></a></li>';					
				}
				
			}
				
			?>
			</ul>
		</div>	
 </div>