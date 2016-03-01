<?php 	echo '<script src="'.__SITE_PATH.'public/Admin/plugins/datatables/jquery.dataTables.min.js"></script>';
		echo '<script src="'.__SITE_PATH.'public/Admin/plugins/datatables/dataTables.bootstrap.min.js"></script>'; 
		echo '<link href="'.__SITE_PATH.'public/sweetalert/lib/sweet-alert.css" rel="stylesheet">';
		echo '<script src="'.__SITE_PATH.'public/sweetalert/lib/sweet-alert.min.js"></script>';
		?>
<script>
function checforkAll(){
var value=document.getElementById("checkAll").checked;
var inputs=document.getElementsByTagName("input");
for(var i = 0; i < inputs.length; i++) {
    if(inputs[i].type == "checkbox" && inputs[i].id!="checkAll") {
        inputs[i].checked = value; 
    }  
}
}


function action(type){
	$('#type').val(type);
	$('input:checkbox').each(function(){
	if($(this).attr('name')!="checkAll" && $(this).attr('name')!=null)
	{
	var value=$(this).is(':checked');
	if(value==false)
	$('#'+$(this).attr('id')+'field').remove();
	}
	document.bills.submit();
	});

}

function confirmDel(id){
	swal({   
	title: "Bạn muốn xóa sản phẩm này ?",   
	text: "Hãy chắc chắn!",   
	type: "warning",   
	showCancelButton: true,   
	confirmButtonColor: "#DD6B55",   
	confirmButtonText: "Đồng ý!",   
	closeOnConfirm: false }, 
	function(){ 
	action(id);
	  });
}

</script>

 <section class="content-header">
          <h1>
            Danh sách hóa đơn
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
</section>
<section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title" ></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				<form action="" method="post" name="bills">
					<input type="hidden" name="type" id="type" />
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
						<th><input type="checkbox" id="checkAll" onclick="checforkAll()" />&nbsp;</th>
						<th>STT</th>
                        <th>ID</th>
                        <th>Ngày đặt</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
						<th>Tổng cộng</th>
                        <th>Trạng thái</th>
                      </tr>
                    </thead>
                    <tbody>
					
					<?php
					$result=$this->result;
					$index=1;
					if(count($result)>0)
					{
					foreach($result as $item)
					{
					$user=$this->model->getUser($item["makh"]);
					$chietkhau=0;
					if(isset($user["chietkhau"]))
					{
					$chietkhau=$user["chietkhau"];
					}
					echo '<tr>';
					echo '<td><input type="checkbox" id="'.$item["id_hoadon"].'" name="check'.$item["id_hoadon"].'"  ><input type="hidden" name="billId[]" id="'.$item["id_hoadon"].'field" value="'.$item["id_hoadon"].'" /></td>';
					echo'<td>'.$index.'</td>';
					echo '<td><a href="'.__SITE_PATH.'admin/bill/view?billId='.$item["id_hoadon"].'">'.$item["id_hoadon"].'</a></td>';
					echo '<td>'.$item["ngaydat"].'</td>';
					echo '<td>'.$item["soluong"].'</td>';
					echo '<td>'.number_format($item["thanhtien"]-$item["thanhtien"]*$chietkhau/100, 0, ',', ',').' VNĐ</td>';
					echo '<td>'.number_format($item["thanhtien"], 0, ',', ',').' VNĐ</td>';
					echo'		<td class="cart_product">';
					switch($item["matinhtrang"])
					{
					case 1:echo '<span class="label label-default">'.$item["tinhtrang"].'</span>';break;
					case 2:echo '<span class="label label-primary">'.$item["tinhtrang"].'</span>';break;
					case 3:echo '<span class="label label-success">'.$item["tinhtrang"].'</span>';break;
					case 4:echo '<span class="label label-danger">'.$item["tinhtrang"].'</span>';break;
					}
					echo'</td> </tr>';
					$index+=1;
					}
					}
					?>
					</tbody>
                    <tfoot>
                      <tr>
						<th>&nbsp;</th>
						<th>STT</th>
                        <th>ID</th>
                        <th>Ngày đặt</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
						<th>Tổng cộng</th>
                        <th>Trạng thái</th>
                      </tr>
                    </tfoot>
                  </table>
				 </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			  
			  <div class="box">
                <div class="box-header">
                  <h3 class="box-title" >Thay đổi trạng thái (chọn những hàng bên trên để thay đổi trạng thái)</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				<table  >
				<tr>
                        <td width="200px"><button type="button" onclick="action(2)" class="btn btn-primary">Đang giao hàng</button></td>
                        <td width="200px"><button type="button" onclick="action(3)" class="btn btn-success">Đã giao hàng</button></td>
						<td><button type="button" onclick="confirmDel(4)" class="btn btn-danger">Hủy đơn hàng</button></td>
                 </tr>
				</table>
				</div>
			 </div>
			  
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
<script>
    $(document).ready( function(){
	 $("#example1").DataTable({
      "order": [],
        "aoColumnDefs": [
            { 'bSortable': false, 'aTargets': [ 0] }
            ],
});
	});
    </script>