<?php 
echo '<link href="'.__SITE_PATH.'public/sweetalert/lib/sweet-alert.css" rel="stylesheet">';
echo '<script src="'.__SITE_PATH.'public/sweetalert/lib/sweet-alert.min.js"></script>';
 echo '<link rel="stylesheet" href="'.__SITE_PATH.'public/Admin/plugins/select2/select2.min.css">'; 
?>
<script>

function showError(text){
swal(    text, '',   'error' );
}
function showSuccess(text){
swal(text, "", "success");
}
</script>
<style>
.example-modal .modal {
        position: relative;
        top: auto;
        bottom: auto;
        right: auto;
        left: auto;
        display: block;
        z-index: 1;
		width:90%;
      }
      .example-modal .modal {
        background: transparent !important;
		
      }
	  .select2-container--default .select2-selection--single {
	border-radius:0px;
	height:34px;
    }
</style>
<?php
$product=$this->product;
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

<section class="content">
          <div class="row">
            <div class="col-xs-12">
			<div class="example-modal"   >
            <div class="modal"  >
              <div class="modal-dialog" style="margin:50px;width:90%" >
                <div class="modal-content" style="width:90%" >
                  <div class="modal-header"  >
                    <h4 class="modal-title">Thay đổi sản phẩm</h4>
                  </div>
                  <div class="modal-body">
				  <form action="" method="post" enctype="multipart/form-data" onsubmit="return confirm('Bạn có muốn thay đổi ?');">
                   <table style="line-height:300%">
				   <tr><td>Tên sản phẩm :&nbsp;</td><td > <input style="width:230px" class="form-control" type="text" name="proName" placeholder="Tên sản phẩm" value="<?= $product["tensp"] ?>"></td>
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
								if($kq1["id_loai"]==$product["id_loai"])
							
									echo '<option value="'.$kq1["id_loai"].'" selected >'.$kq1["tenloaisp"].'</option>';
								else
								echo '<option value="'.$kq1["id_loai"].'">'.$kq1["tenloaisp"].'</option>';
								}
								
							echo '</optgroup>';
							}
							
						}
						?>
                    </select>
					</td>
				   </tr>
					<tr><td>Giá :&nbsp;</td><td> <input style="width:230px" class="form-control" type="number" name="proPrice" min="1" value="<?= $product["gia"] ?>" placeholder="Giá"></td>
					
					</tr>
					<tr><td>Số lượng :&nbsp;</td><td> <input style="width:230px" class="form-control" type="number" name="proQuan" min="1" value="<?= $product["soluong"] ?>" placeholder="Số lượng"></td><td>Số lượng tồn:&nbsp;</td><td><?= $product["soluongton"] ?></td></tr>
					
					<tr><td>Ghi chú :&nbsp;</td><td colspan="3"> <input  class="form-control" type="text" name="proNote"  placeholder="Ghi chú" value="<?= $product["ghichu"] ?>"></td></tr>
					
					<tr><td>Mô tả :&nbsp;</td><td colspan="3"><textarea id="editor1" name="proDes" rows="1" cols="60"><?= $product["mota"] ?></textarea></td></tr>
					
				   <tr><td>Ảnh nhỏ <span style="color:red"><b>*</b></span>:&nbsp;</td><td> <input style="width:250px;font-size:13px" type="file" onchange="showImgS()" name="smallImg" id="smallImg" accept=".jpg"></td>
					<td>Ảnh to <span style="color:red"><b>*</b></span>:&nbsp;</td><td> <input style="width:250px;font-size:13px" type="file" onchange="showImgB()" name="bigImg" id="bigImg" accept=".jpg"></td>
					</tr>
					<tr><td></td><td> <img src="<?php echo __SITE_PATH.'public/products/small/'.$product["hinh"] ?>" style="width:150px;height:100px" id="showsmall" /></td>
					<td></td><td> <img src="<?php echo __SITE_PATH.'public/products/large/'.$product["hinh"] ?>" style="width:150px;height:100px" id="showbig" /></td>
					</tr>
				   </table>
                  </div>
                  <div class="modal-footer">
					<input type="hidden" name="type" value="edit">
                    <input type="submit" class="btn btn-primary"  id="btnAdd"  value="Thay đổi">
                  </div>
				 </form> 
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div><!-- /.example-modal -->
		  </div>
		  </div>
</section>		  
<?php echo'<script type="text/javascript" src="'.__SITE_PATH.'public/Admin/plugins/ckeditor/ckeditor.js"></script>';
		echo '<script src="'.__SITE_PATH.'public/Admin/plugins/select2/select2.full.min.js"></script>'; 
	?>
<script>
    $(document).ready( function(){
	$(".select2").select2();
	CKEDITOR.replace('editor1');
	CKEDITOR.config.width = 600;
	});
    </script>