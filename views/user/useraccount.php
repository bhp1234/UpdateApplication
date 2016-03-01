
 <style>
 .forminput input{
 width:100px;
 }
 .forminput input[type=submit] {
	width:60px;
	font-weight:bold;
    padding:5px 15px; 
    background:green;
	color:white;
    border:0 none;
    cursor:pointer;
    -webkit-border-radius: 5px;
    border-radius: 5px; 
}
a{
text-decoration:none;
}
 </style>
		<?php 
			if(isset($_SESSION["MsError"]) && !empty($_SESSION["MsError"]))
			{
			echo "<script>showError('".$_SESSION["MsError"]."')</script>";
			$_SESSION["MsError"]="";
		}?>
 <div class="col-sm-9 padding-right" style="border:1px solid #9E9E9E;height:900px">


			<div class="panel panel-default" style="margin:20px;border-style:none">
  <!-- Default panel contents -->
			  <div class="panel-heading" style="border-style:none;font-size:20px" align="center" >THÔNG TIN TÀI KHOẢN</div>

			  <!-- Table -->
			  <table style="border-style:none;margin-left:35%;line-height: 200%;" >
			  <tr><td style="width:100px">Tài khoản:</td><td><?php echo $this->user["user"] ?></td></tr>
			  <tr><td >Mật khẩu:</td><td id="password">••••••</td><td><a id="changePW" href="#changepassword">Thay đổi</a></td></tr>
			  <tr name="changepassword" id="changePWfield"></tr>
			  <tr><td>Ngày tạo:</td><td><?php echo (new DateTime($this->user["ngaytao"]))->format('d/m/Y') ?></td></tr>
			  </table>
			</div>
	

</div>