

<script>
function showWarnning(text){
swal( text );
}


Number.prototype.formatMoney = function(c, d, t){
var n = this, 
    c = isNaN(c = Math.abs(c)) ? 2 : c, 
    d = d == undefined ? "." : d, 
    t = t == undefined ? "," : t, 
    s = n < 0 ? "-" : "", 
    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
    j = (j = i.length) > 3 ? j % 3 : 0;
   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
 };
 
function add(id,price){

	var elementTotal=document.getElementById('total'+id);
	var elementQuantity=document.getElementById('Quan'+id);
	var value=elementQuantity.value;
	elementQuantity.value=Number(value)+Number(1);
	elementTotal.value=(Number(elementQuantity.value)*Number(price)).formatMoney(0)+" VNĐ";
}

function sub(id,price){
	var elementTotal=document.getElementById('total'+id);
	var elementQuantity=document.getElementById('Quan'+id);
	var value=elementQuantity.value;
	var result=Number(value)-Number(1);
	if(result<1)
	result=1;
	elementQuantity.value=result;
	elementTotal.value=(Number(elementQuantity.value)*Number(price)).formatMoney(0)+" VNĐ";
}

function editValue(id,price){
	var elementTotal=document.getElementById('total'+id);
	var elementQuantity=document.getElementById('Quan'+id);
	elementTotal.value=(Number(elementQuantity.value)*Number(price)).formatMoney(0)+" VNĐ";

}

function confirmDel(id){
	swal({   
	title: "Bạn muốn hủy đơn này ?",   
	text: "Hãy chắc chắn!",   
	type: "warning",   
	showCancelButton: true,   
	confirmButtonColor: "#DD6B55",   
	confirmButtonText: "Đồng ý!",   
	closeOnConfirm: false }, 
	function(){ 
	document.getElementsByName("id")[0].value=id;
	document.acDel.submit();
	  });
}

function checkOut()
{
	document.getElementById('type').value='checkout';
	document.manaCart.submit();
}

function checkOutNon()
{
	if(document.getElementById('address').value.length==0)
	{
		showWarnning("Bạn chưa điền địa chỉ");
		document.getElementById('address').focus();
		document.getElementById('address').scrollIntoView();
		return false;
	}
	if(document.getElementById('phonenumber').value.length==0)
	{
		showWarnning("Bạn chưa điền điện thoại");
		document.getElementById('phonenumber').focus();
		document.getElementById('phonenumber').scrollIntoView();
		return false;
	}
	if(document.getElementById('email').value.length==0)
	{
		showWarnning("Bạn chưa điền email");
		document.getElementById('email').focus();
		document.getElementById('email').scrollIntoView();
		return false;
	}
	document.getElementById('type').value='checkoutNon';
	document.manaCart.submit();
}


</script>
<style>
.checkoutNonReg li{
margin-bottom:10px;

}
.checkoutNonReg input{
width:300px;
}
</style>
<?php 
			if(isset($_SESSION["MsError"]) && !empty($_SESSION["MsError"]))
			{
			echo "<script>showError('".$_SESSION["MsError"]."')</script>";
			$_SESSION["MsError"]="";
			}
			if(isset($_SESSION["success"]) && !empty($_SESSION["success"]))
			{
			echo "<script>showSuccess('".$_SESSION["success"]."')</script>";
			$_SESSION["success"]="";
			}
?>
<section id="cart_items">
<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="<?php echo __SITE_PATH.'index/index'; ?>">Trang chủ</a></li>
				  <li class="active">Giỏ hàng</li>
				</ol>
</div>
<form action="" method="post" name="acDel" >
<input type="hidden" name="id" >
<input type="hidden" name="type" value="delete">
</form>
<div class="table-responsive cart_info">
		<form action="" method="post" name="manaCart">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image" >Sản phẩm</td>
							<td class="description " ></td>
							<td class="price" style="border-left:1px solid white"> Giá</td>
							<td class="quantity" style="border-left:1px solid white">Số lượng</td>
							<td class="total" style="border-left:1px solid white">Tổng cộng</td>
							<td style="border-left:1px solid white"></td>
						</tr>
					</thead>
					<tbody>
					<?php 
					$listItems=Process::getCart()->listCart;
					$totalPrice=$this->model->getTotalPrice($listItems);
					if(count($listItems)>0)
					{
					
					foreach($listItems as $item)
					{
					$kq=$this->model->getProductById($item->id);
					echo'	<tr style="border-bottom:1px solid #FE980F" >';
					echo'		<td class="cart_product">';
					if($item->active==false)
					echo '			<p style="border-radius: 20px;background-color:#d9534f;width:20px;height:20px"> </p>';
					echo'			<a href="'.__SITE_PATH.'product/detail?ProID='.$kq["id"].'"><img src="'.__SITE_PATH.'public/products/small/'.$kq["hinh"].'" width="140px" height="120px"  alt=""></a>';
					echo'		</td>';
					echo'		<td class="cart_description">';
					echo'			<h5><a href="'.__SITE_PATH.'product/detail?ProID='.$kq["id"].'">'.$kq["tensp"].'</a></h5>';
					echo'		</td>';
					echo'		<td class="cart_price">';
					echo'			<p>'.number_format($kq["gia"], 0, ',', ',') .' VNĐ</p>';
					echo'		</td>';
					echo'		<td class="cart_quantity">';
					echo'			<div class="cart_quantity_button">';
					echo'				<a class="cart_quantity_up" style="cursor:pointer"  onclick="add('.$kq["id"].','.$kq["gia"].')" > + </a>';
					echo'				<input class="cart_quantity_input" id="Quan'.$kq["id"].'" onchange="editValue('.$kq["id"].','.$kq["gia"].')" type="text" name="quantity'.$kq["id"].'" value="'.$item->quantity.'" autocomplete="off" size="2">';
					echo'				<a class="cart_quantity_down" style="cursor:pointer" onclick="sub('.$kq["id"].','.$kq["gia"].')" > - </a>';
					echo'			</div>';
					echo'		</td>';
					echo'		<td class="cart_total" style="width: 210px;">';
					echo'			<input type="text" id="total'.$kq["id"].'" readonly style="border:none" class="cart_total_price" value="'.number_format($item->quantity*$kq["gia"], 0, ',', ',') .' VNĐ" >';
					echo'		</td>';
					echo'		<td class="cart_delete">';
					echo'			<a class="cart_quantity_delete" align="center" style="cursor:pointer" onclick="confirmDel('.$kq["id"].')"><i class="fa fa-times"></i></a>';
					echo'		</td>';
					echo'	</tr>';
					}
					echo'<tr>';
					echo'		<td colspan="2">&nbsp;</td>';
					echo'		<td >';
					if($_SESSION["isLogin"]==false)
					{
					echo'		<ul style="border:1px solid rgba(254, 152, 15, 0.51);padding:20px;line-height:200%" class="checkoutNonReg">';
					echo'			<li><input type="text" name="address" id="address"  placeholder="Địa chỉ" required style="margin-top:10px" ></li>';
					echo'			<li><input type="text" name="phonenumber" id="phonenumber"  placeholder="Điện thoại" required ></li>';
					echo'			<li><input type="email" name="email" id="email" placeholder="Email" required ></li>';
					echo'			<li><a class="btn btn-default update" id="checkout" style="margin-left:0px" onclick="checkOutNon()" >Thanh toán</a></li>';		
					echo'		</ul>';
					}
					echo'		</td>';
					echo'		<td >&nbsp;</td>';
					echo'		<td colspan="2">';
					echo'			<table class="table table-condensed total-result">';
					echo'				<tr>';
					echo'					<td>Thành tiền :</td>';					
					echo'					<td>'.number_format($totalPrice,0,'',',').' VNĐ</td>';
					echo'				</tr>';
					echo'				<tr>';
					echo'					<td>Số lượng :</td>';
					echo'					<td>'.Process::getCart()->getTotalQuantity().'</td>';
					echo'				</tr>';
					echo'				<tr class="shipping-cost">';
					echo'					<td>Ship :</td>';
					echo'					<td>Free</td>';										
					echo'				</tr>';
					echo'				<tr>';
					echo'					<td>Tổng cộng :</td>';
					echo'					<td><span>'.number_format($totalPrice,0,'',',').' VNĐ</span></td>';
					echo'				</tr>';
					echo'				<tr >';
					echo'					<td><a class="btn btn-default update"  onclick="document.manaCart.submit();" style="margin-left:0px" >Cập nhập</a></td>';
					echo'					<input type="hidden" name="type" id="type" value="update">';
					if($_SESSION["isLogin"]==true)
					echo'					<td><a class="btn btn-default update" id="checkout" onclick="checkOut()" style="margin-left:0px" >Thanh toán</a></td>';					
					echo'				</tr>';
					echo'			</table>';
					echo'		</td>';
					echo'	</tr>';
					}
					else
					echo '<tr><td class="cart_product" >Bạn chưa đặt sản phẩm nào</td></tr>';
					
					?>	
					</tbody>
			</table>
			
			</form>
</div>
</section>