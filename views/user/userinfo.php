
 <style>
 .forminput input[type=submit] {
	width:60px;
	font-weight:bold;
    padding:5px; 
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
			  <div class="panel-heading" style="border-style:none;font-size:20px" align="center" >THÔNG TIN NGƯỜI DÙNG</div>

			  <!-- Table -->
			  <table style="border-style:none;margin-left:35%;line-height: 200%;" >
			  <tr><td style="width:100px">Họ tên:</td><td><?php if($this->user["loaind"]<=2) echo $this->user["tenkh"]; else echo $this->user["tennv"]; ?></td></tr>
			  <tr><td >Địa chỉ:</td><td id="address" name="changeaddress"><?php echo $this->user["diachi"]; ?></td><td><a id="changeAd" href="#changepaddress">Thay đổi</a></td></tr>
				<tr><td >Số điện thoại:</td><td id="phonenumber" name="changephonenumber"><?php echo $this->user["dienthoai"]; ?></td><td><a id="changePn" href="#changepphonenumber">Thay đổi</a></td></tr>
				<tr><td >Email:</td><td id="email" name="changeemail"><?php echo $this->user["email"]; ?></td><td><a id="changeEm" href="#changeemail">Thay đổi</a></td></tr>
			  <tr><td>Ngày sinh:</td><td><?php echo (new DateTime($this->user["ngaysinh"]))->format('d/m/Y') ?></td></tr>
			  </table>
			</div>
	

</div>