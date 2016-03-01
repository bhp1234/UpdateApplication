<?php
echo '<link href="'.__SITE_PATH.'public/sweetalert/lib/sweet-alert.css" rel="stylesheet">';
	echo '<script src="'.__SITE_PATH.'public/sweetalert/lib/sweet-alert.min.js"></script>'; 
	echo '<link rel="stylesheet" href="'.__SITE_PATH.'public/Admin/plugins/select2/select2.min.css">'; 
	echo '<script src="'.__SITE_PATH.'public/Admin/plugins/select2/select2.full.min.js"></script>'; 
	?>
<script>
function showError(text){
swal(    text, '',   'error' );
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
	.select2-container--default .select2-selection--single {
	border-radius:0px;
	height:34px;
    }
</style>
<?php
if(isset($_SESSION["MsError"]) && !empty($_SESSION["MsError"]))
			{
			echo "<script>showError('".$_SESSION["MsError"]."');</script>";
			$_SESSION["MsError"]="";
			}
			?>
 <section class="content-header">
          <h1>
            Danh sách nhóm/loại hàng hóa
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Nhóm/Loại</li>
          </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-3">
					<div class="left-sidebar" >
					
					<div class="panel-group category-products"  id="accordian">
					<?php $listCate=$this->model->getCategory();
					foreach($listCate as $top)
					{
						$kind=$this->model->getProductType($top["id_nhom"]);
						echo '<div class="panel panel-default">';
						echo '<div class="panel-heading">';
						echo '	<h4 class="panel-title" >';
						echo '<a style="background-color:transparent;color:black;margin-right:20px" class="badge pull-left" id="go" rel="leanModal" name="editCate" onclick="editCate('.$top["id_nhom"].',\''.$top["tennhom"].'\')" href="#editCate"><i class="fa fa-pencil"  ></i></a>';						
						echo '		<a data-toggle="collapse" style="font-size:20px" data-parent="#accordian" href="#'.$top["id_nhom"].'">';
						if($kind!=0)
						{
						echo '		<span class="badge pull-right"><i class="fa fa-plus"></i></span>';
						}						
						echo $top["tennhom"].'</a>';
						echo '	</h4>';
						echo '</div>';
						if($kind!=0)
						{
							echo '<div id="'.$top["id_nhom"].'" class="panel-collapse collapse">';
							echo '<div class="panel-body" >';
							echo '<ul style="list-style:none">';
							foreach($kind as $item)
							{
								
								echo '<li ><a style="background-color:transparent;color:black;margin-right:20px" class="badge pull-left" id="go" rel="leanModal" name="editKind" href="#editKind" onclick="editKind('.$item["id_loai"].',\''.$item["tenloaisp"].'\')"><i class="fa fa-pencil"></i></a><a href="#" style="font-size:15px">'.$item["tenloaisp"].'</a></li>		';						
								
							}
							echo '</ul>';
							echo '</div>';
							echo '</div>';
						}
						echo '</div>';
					}
					?>
					
					
					
				</div>			
			</div>
		</div>
	</div>
	<div style="border-bottom:1px solid black"></div>
	<div class="row">
		<div class="col-sm-3">
		<div class="example-modal"  style="width:900px" >
            <div class="modal"  >
              <div class="modal-dialog" style="margin:50px;width:90%" >
                <div class="modal-content" style="width:90%" >
                  <div class="modal-header"  >
                    <h4 class="modal-title">Thêm nhóm sản phẩm</h4>
                  </div>
                  <div class="modal-body">
				  <form action="" method="post">
				  <input type="hidden" name="type" value="addCate">
				  <input type="text" required name="cateName" style="height:33px" placeholder="Nhập tên nhóm" />&nbsp;&nbsp;&nbsp; <input type="submit" class="btn btn-primary"   value="Thêm nhóm">
				  </form>
				  </div>
				 </div>
			  </div>	 
			</div>
		</div>
		<div class="example-modal"  style="width:900px" >
            <div class="modal"  >
              <div class="modal-dialog" style="margin:50px;width:90%" >
                <div class="modal-content" style="width:90%" >
                  <div class="modal-header"  >
                    <h4 class="modal-title">Thêm loại sản phẩm</h4>
                  </div>
                  <div class="modal-body">
				  <form action="" method="post">
				  <table>
				  <tr>
				  <td>Nhóm : <input type="hidden" name="type" value="addKind"></td>
				  <td>
				  <select class="form-control select2" name="cateId" data-placeholder="Chọn loại sản phẩm" style="width:150px;border-radius:0px;height:34px">
						<?php
						foreach($this->model->getCategory() as $kq)
						{
							echo '<option value="'.$kq["id_nhom"].'" selected >'.$kq["tennhom"].'</option>';
						}
						?>
                    </select></td><td>&nbsp;&nbsp;&nbsp;</td> <td>Tên loại: &nbsp;<input type="text" required name="kindName" style="height:33px" placeholder="Nhập tên loại" /></td>
					<td>&nbsp;&nbsp;&nbsp;</td><td > <input type="submit" class="btn btn-success" value="Thêm loại"></td>
					</tr>
					</table>
				  </form>
				  </div>
				 </div>
			  </div>	 
			</div>
		</div>
		
		<div class="example-modal"  style="width:900px" >
            <div class="modal"  >
              <div class="modal-dialog" style="margin:50px;width:90%" >
                <div class="modal-content" style="width:90%" >
                  <div class="modal-header"  >
                    <h4 class="modal-title">Chuyển sản phẩm</h4>
                  </div>
                  <div class="modal-body">
				  <form action="" method="post">
				  <table>
				  <tr>
				  <td><input type="hidden" name="type" value="kindFromTo"></td>
				  <td>Từ loại :</td>
				  <td>
				  <select class="form-control select2" name="kindFrom" data-placeholder="Chọn loại sản phẩm" style="width:150px;border-radius:0px;height:34px">
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
                    </select></td><td>&nbsp;==>&nbsp;</td> <td>Sang loại :</td>
					<td>
					<select class="form-control select2" name="kindTo" data-placeholder="Chọn loại sản phẩm" style="width:150px;border-radius:0px;height:34px">
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
					<td>&nbsp;&nbsp;&nbsp;</td><td > <input type="submit" class="btn btn-success" onclick="return confirm('Bạn muốn chuyển loại ?');" value="Chuyển loại"></td>
					</tr>
					</table>
				  </form>
				  </div>
				 </div>
			  </div>	 
			</div>
		</div>
		</div>
	</div>
</section>
<div class="example-modal" style="display:none"  id="editCate" >
            <div class="modal"  style="width:800px">
              <div class="modal-dialog" style="width:800px">
                <div class="modal-content" style="width:800px" >
				<div class="modal-header" >
                    <button type="button" class="modal_close" style="border:none;float:right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="titleModelCate"></h4>
                  </div>
				<div class="modal-body">
				<form action="" method="post">
				<input type="hidden" name="type" value="editCate">
				<input type="hidden" name="cateId" id="cateId">
				 <input type="text" required name="cateName" style="height:33px" placeholder="Thay đổi nhóm" />&nbsp;&nbsp;&nbsp; <input type="submit" class="btn btn-primary"   value="Thay đổi">
				 <input type="button" class="btn btn-danger" onclick="confirmDel('Cate')"  value="Xóa nhóm này">
				</form>
				
				</div>
				
				 </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div>
		  
<div class="example-modal" style="display:none"  id="editKind" >
            <div class="modal"  style="width:800px">
              <div class="modal-dialog" style="width:800px">
                <div class="modal-content" style="width:800px" >
				<div class="modal-header" >
                    <button type="button" class="modal_close" style="border:none;float:right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="titleModelKind"></h4>
                  </div>
				<div class="modal-body">
				<form action="" method="post">
				<input type="hidden" name="type" value="editKind">
				<input type="hidden" name="kindId" id="kindId">
				 <input type="text" required name="kindName" style="height:33px" placeholder="Thay đổi loại" />&nbsp;&nbsp;&nbsp; <input type="submit" class="btn btn-primary"   value="Thay đổi">
				 <input type="button" class="btn btn-danger" onclick="confirmDel('Kind')"  value="Xóa loại này">
				</form>
				
				</div>
				
				 </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div>
<form action="" method="post" name="del">
<input type="hidden" name="type" id="type">
<input type="hidden" name="Id" id="Id">
</form>

<script>
$(".select2").select2();
$('a[rel*=leanModal]').leanModal({ top:100, closeButton: ".modal_close" });	
 function editCate(id,name){
$("#titleModelCate").html("Nhóm "+name);
$("#cateId").val(id);
}

 function editKind(id,name){
$("#titleModelKind").html("Loại "+name);
$("#kindId").val(id);
}

function confirmDel($type)
{	
 var $id;
 if($type=='Cate')
	$id=$("#cateId").val();
 else
	$id=$("#kindId").val();
	swal({   
	title: "Bạn muốn xóa ?",   
	text: "Hãy chắc chắn!",   
	type: "warning",   
	showCancelButton: true,   
	confirmButtonColor: "#DD6B55",   
	confirmButtonText: "Đồng ý!",   
	closeOnConfirm: false }, 
	function(){ 
	if($type=='Cate')
		$('#type').val('delCate');
		else
		$('#type').val('delKind');
		$('#Id').val($id);
		document.del.submit();
	  });

}

</script>