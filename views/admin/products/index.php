<?php echo '<link rel="stylesheet" href="'.__SITE_PATH.'public/Admin/plugins/select2/select2.min.css">'; 
	echo '<link href="'.__SITE_PATH.'public/sweetalert/lib/sweet-alert.css" rel="stylesheet">';
	echo '<script src="'.__SITE_PATH.'public/sweetalert/lib/sweet-alert.min.js"></script>';
?>
<script>

function showError(text){
swal(    text, '',   'error' );
}
function showSuccess(text){
swal(text, "", "success");
}

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
	document.products.submit();
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
<style>
	#lean_overlay {
		position: fixed;
		z-index: 10000;
		top: 0px;
		left: 0px;
		height:100%;
		width:100%;
		background: #000;
		display: none;
	
	}
 .example-modal .modal {
        position: relative;
        top: auto;
        bottom: auto;
        right: auto;
        left: auto;
        display: block;
        z-index: 1;
      }
      .example-modal .modal {
        background: transparent !important;
		
      }
	.select2-container--default .select2-selection--single {
	border-radius:0px;
	height:34px;
    }
	.select2-container{
	opacity: 1; z-index: 11000;

	}
</style>	
<?php
if(isset($_SESSION["MsError"]) && !empty($_SESSION["MsError"]))
			{
			echo "<script>showError('".$_SESSION["MsError"]."');</script>";
			$_SESSION["MsError"]="";
			}
			
if(isset($_SESSION["MsSuccess"]) && !empty($_SESSION["MsSuccess"]))
			{
			echo "<script>showSuccess('".$_SESSION["MsSuccess"]."');</script>";
			$_SESSION["MsSuccess"]="";
			}			
?>
 <section class="content-header">
          <h1>
            Danh sách hàng hóa (<?php echo $this->title; ?>)
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Hàng hóa</li>
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
				<form action="" method="post" name="products">
				<input type="hidden" name="type" id="type" />
				<input type="hidden" name="retUrl" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
					  <th><input type="checkbox" id="checkAll" onclick="checforkAll()" />&nbsp;</th>
						<th>STT</th>
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th>Tên hàng hóa</th>
                        <th>Loại</th>
						<th>Giá</th>
                        <th>Số lượng còn lại</th>
                      </tr>
                    </thead>
                    <tbody>
					
					<?php
					$result=$this->result;
					$index=1;
					if($result>0)
					{
					foreach($result as $item)
					{
					echo'<tr>';
					
					echo '<td><input type="checkbox" id="'.$item["id"].'" name="check'.$item["id"].'"  ><input type="hidden" name="Id[]" id="'.$item["id"].'field" value="'.$item["id"].'" /></td>';
					echo'<td>'.$index.'</td>';
					echo '<td>'.$item["id"].'</td>';
					echo '<td><img src="'.__SITE_PATH.'public/products/small/'.$item["hinh"].'" height="40px" width="40px" alt="'.$item["tensp"]."-".__DNS.'" /></td>';
					echo '<td><a href="'.__SITE_PATH.'admin/products/view?Id='.$item["id"].'">'.$item["tensp"].'</a></td>';
					echo '<td>'.$item["tenloaisp"].'</td>';
					echo '<td>'.number_format($item["gia"], 0, ',', ',').' VNĐ</td>';
					echo '<td class="cart_product">'.$item["soluongton"].'</td>';
					echo'</tr>';
					$index+=1;
					}
					}
					?>
                                           
                    </tbody>
                    <tfoot>
                      <tr>
						<th></th>
						<th>STT</th>
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th>Tên hàng hóa</th>
                        <th>Loại</th>
						<th>Giá</th>
                        <th>Số lượng còn lại</th>
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
                        <td width="200px"><button type="button" id="go" rel="leanModal" name="addnew" class="btn btn-primary" href="#addnew" >Thêm hàng hóa</button></td>
                        
						<td><button type="button" onclick="confirmDel('delete')" class="btn btn-danger">Xóa hàng hóa</button></td>
                 </tr>
				</table>
				</div>
			 </div>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>

		  <div class="example-modal" style="display:none"  id="addnew" >
            <div class="modal"  style="width:800px">
              <div class="modal-dialog" style="width:800px">
                <div class="modal-content" style="width:800px" >
                  <div class="modal-header" >
                    <button type="button" class="modal_close" style="border:none;float:right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Thêm sản phẩm</h4>
                  </div>
                  <div class="modal-body">
				  <form action="" method="post" enctype="multipart/form-data">
                   <table style="line-height:300%">
				   <tr><td>Tên sản phẩm <span style="color:red"><b>*</b></span>:&nbsp;</td><td > <input style="width:230px" class="form-control" type="text" name="proName" placeholder="Tên sản phẩm"></td>
				   <td>Loại sản phẩm :&nbsp;</td>
				   <td >
	
				    <select class="form-control select2" name="kind" data-placeholder="Chọn loại sản phẩm" style="width:150px;border-radius:0px;height:34px">
						<?php
						foreach($this->model->getCategory() as $kq)
						{
						$result=$this->model->getProductType($kq["id_nhom"]);
						
							if(count($result>0))
							{
							echo '<optgroup label="'.$kq["tennhom"].'">';
								foreach($result as $kq1)
								{
							
									echo '<option value="'.$kq1["id_loai"].'">'.$kq1["tenloaisp"].'</option>';
								}
							echo '</optgroup>';
							}
							
						}
						?>
                    </select>
					</td>
				   </tr>
					<tr><td>Giá :&nbsp;</td><td> <input style="width:230px" class="form-control" type="number" name="proPrice" min="1" value="1" placeholder="Giá"></td>
					<td>Số lượng :&nbsp;</td><td> <input style="width:100px" class="form-control" type="number" name="proQuan" min="1" value="1" placeholder="Số lượng"></td>
					</tr>
					
					<tr><td>Ghi chú :&nbsp;</td><td colspan="3"> <input  class="form-control" type="text" name="proNote"  placeholder="Ghi chú"></td></tr>
					<tr><td>Mô tả :&nbsp;</td><td colspan="3"><textarea id="editor1" name="proDes" rows="1" cols="40"></textarea></td></tr>
				   <tr><td>Ảnh nhỏ <span style="color:red"><b>*</b></span>:&nbsp;</td><td> <input style="width:200px;font-size:13px" type="file" onchange="showImgS()" name="smallImg" id="smallImg" accept=".jpg"></td>
					<td>Ảnh to <span style="color:red"><b>*</b></span>:&nbsp;</td><td> <input style="width:200px;font-size:13px" type="file" onchange="showImgB()" name="bigImg" id="bigImg" accept=".jpg"></td>
					</tr>
					<tr><td></td><td> <img src="<?php echo __SITE_PATH.'public/images/placehole_150x100.jpg' ?>" style="width:150px;height:100px" id="showsmall" /></td>
					<td></td><td> <img src="<?php echo __SITE_PATH.'public/images/placehole_150x100.jpg' ?>" style="width:150px;height:100px" id="showbig" /></td>
					</tr>
				   </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button"  class="modal_close" style="background-color: #f4f4f4;color: #444;border-radius: 3px;box-shadow: none; border: 1px solid #ddd;float: left !important;padding: 6px 12px;" data-dismiss="modal">Đóng</button>
					<input type="hidden" name="type" value="add">
					<input type="hidden" name="retUrl" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">
                    <input type="submit" class="btn btn-primary" id="btnAdd" onclick="checkAddProValue()" value="Thêm">
                  </div>
				 </form> 
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div><!-- /.example-modal -->

<?php 	echo '<script src="'.__SITE_PATH.'public/Admin/plugins/datatables/jquery.dataTables.min.js"></script>';
		echo '<script src="'.__SITE_PATH.'public/Admin/plugins/datatables/dataTables.bootstrap.min.js"></script>';		
		echo'<script type="text/javascript" src="'.__SITE_PATH.'public/Admin/plugins/ckeditor/ckeditor.js"></script>';
		echo '<script src="'.__SITE_PATH.'public/Admin/plugins/select2/select2.full.min.js"></script>'; 
		?>

<script>
    $(document).ready( function(){
	  $("#example1").DataTable({
      "order": [],
        "aoColumnDefs": [
            { 'bSortable': false, 'aTargets': [ 0] }
            ],
});
	 $('button[rel*=leanModal]').leanModal({ top:1, closeButton: ".modal_close" });	
	$(".select2").select2();
CKEDITOR.replace('editor1');
CKEDITOR.config.width = 559;
	});
    </script>