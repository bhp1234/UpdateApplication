function showError(text){
swal(    text, '',   'error' );
}
function showSuccess(text){
swal(text, "", "success");
}
<!-- Tìm kiếm -->
	document.onmousedown= function(e){
		var IE = document.all?true:false


		if (!IE) document.captureEvents(Event.MOUSEMOVE)

		document.onmousedown = getMouseXY;


		var tempX = 0
		var tempY = 0


		function getMouseXY(e) {
		  if (IE) {
			tempX = event.clientX + document.body.scrollLeft
			tempY = event.clientY + document.body.scrollTop
		  } else {  
			tempX = e.pageX
			tempY = e.pageY
		  }  

		  if (tempX < 0){tempX = 0}
		  if (tempY < 0){tempY = 0}  
		 sBox=document.getElementById("search_box");
		 el=document.getElementById("search_div");
		 position = el.getBoundingClientRect();
		 elLeft=position.left + window.scrollX;
		 elTop= position.top+ window.scrollY;
		 elWidth=el.clientWidth;
		 elHeight=el.clientHeight;
		 if(tempX<elLeft || tempX>(elLeft+elWidth) || tempY<(elTop-sBox.clientHeight) || tempY>(elTop+elHeight))
		 el.style.visibility = "hidden";
		 else
		 el.style.visibility = "visible";
		}
	}
	
	function searchKey()
	{
		var value=document.getElementById('search_box').value;
		var url= __SITE_PATH+"/product/view?SearchKeyId=";
		window.location.href=url+value;
	}
	
	
	$(document).ready( function(){
	$('#navbarA  li').click(function(){
	$('#navbarA  li').removeClass('active');
	$(this).addClass('active');
	
	});
	
	$('#search_box').keyup(function(){
	var value=$(this).val();
	$.post(__SITE_PATH+'/libs/Search.php',{value:value},function(data){
	var arrLine=data.split(__NEW_LINE);
	var text='';
	for( i=0;i<arrLine.length;i++)
	{
		if(arrLine[i]!='')
		{
			if(i==0)
			text+="<li><h4>Sản phẩm</h4></li>";
			else
			text+="<li><h4>Loại sản phẩm</h4></li>";
			var arrRow=arrLine[i].split(__SPLIT_ROW);
			for(var j=0;j<arrRow.length;j++)
			{
				text+='<li>';
				var arrMember=arrRow[j].split(__SPLIT_MEMBER);
				if(i==0)
				{
				text+='<a href="'+__SITE_PATH+'product/detail?ProID='+arrMember[0]+'"><img src="'+__SITE_PATH+'public/products/small/'+arrMember[1]+'" width="50px" height="50px" alt="'+arrMember[2]+'-'+__DNS+'"> '+arrMember[2]+' </a>';
				}
				else
				{
				text+='<a href="'+__SITE_PATH+'product/view?KindId='+arrMember[0]+'"> '+arrMember[1]+' </a>';
				}
				text+='</li>';
			}
		}
	}
	
	
	
	$('#search_result').html(text);
	if(text!='')
	{
	$('#search_div').css("border","1px solid black");
	}
	else
	$('#search_div').css("border","");
	});
	
	});
	})
	
	<!-- Nhấn và hiện -->
	<!-- Đổi mật khẩu -->
	$(document).ready(function(){ 
	$pw=false;
	  $('#changePW').click(function(){
	  
	  if( $pw==false)
	  {
	  $pw=true;
	  $('#changePWfield').html(
	  '<td></td><td><form action="" method="post" id="changePwform"  class="forminput"><table ><tr><td>Mật khẩu cũ: </td><td ><input style="width:100px" type="password" name="pwo" required></td></tr><tr><td>&nbsp;</td></tr><tr><td>Mật khẩu mới :</td><td><input type="password" name="pwn" required></td></tr><tr><td>&nbsp;</td></tr><tr><tr><td>Nhập lại :</td><td><input type="password" name="pwc" required></td></tr><tr><td> </td></tr><tr><td>&nbsp;</td></tr><tr><tr><tr><td><input type="submit" value="Lưu" onclick="checkData()"></td><td><input type="hidden" name="type" value="changePw" ></td></tr> </table></form></td>'
	  );
	  $('#password').html("");
	  }
	  else
	  {
	  $pw=false;
	  $('#changePWfield').html("");
	  $('#password').html("••••••");
	  }
	  }); 
	});
	
	<!-- Đổi địa chỉ -->
	$(document).ready(function(){ 
	$ad=false;
	$valAd=$('#address').html();
	  $('#changeAd').click(function(){
	  
	  if( $ad==false)
	  {
	  $ad=true;
	  $('#address').html(
	  '<form action="" method="post" id="changeAdform" style="margin-top:10px"  class="forminput"><table ><tr><td ><input type="text" name="address"  value="'+$valAd+'" required> <input type="hidden" name="type" value="changeAd" ><input type="submit" value="Lưu">&nbsp;&nbsp;</td></tr> </table></form>'
	  );
	  }
	  else
	  {
	  $ad=false;
	  $('#address').html($valAd);
	  }
	  }); 
	});
	
	<!-- Đổi điện thoại -->
	$(document).ready(function(){ 
	$pn=false;
	$valPn=$('#phonenumber').html();
	  $('#changePn').click(function(){
	  
	  if( $pn==false)
	  {
	  $pn=true;
	  $('#phonenumber').html(
	  '<form action="" method="post" id="changePnform" style="margin-top:10px"  class="forminput"><table ><tr><td ><input type="text" name="phonenumber"  value="'+$valPn+'" required> <input type="hidden" name="type" value="changePn" ><input type="submit" value="Lưu">&nbsp;&nbsp;</td></tr> </table></form>'
	  );
	  }
	  else
	  {
	  $pn=false;
	  $('#phonenumber').html($valPn);
	  }
	  }); 
	});
	
	<!-- Đổi email -->
	$(document).ready(function(){ 
	$em=false;
	$valEm=$('#email').html();
	  $('#changeEm').click(function(){
	  
	  if( $em==false)
	  {
	  $em=true;
	  $('#email').html(
	  '<form action="" method="post" id="changeEmform" style="margin-top:10px"  class="forminput"><table ><tr><td ><input type="email" name="email"  value="'+$valEm+'" required> <input type="hidden" name="type" value="changeEm" ><input type="submit" value="Lưu">&nbsp;&nbsp;</td></tr> </table></form>'
	  );
	  }
	  else
	  {
	  $em=false;
	  $('#email').html($valEm);
	  }
	  }); 
	});
	
	function checkData(){
	var npw=document.getElementsByName('pwn')[0].value;
	var opw=document.getElementsByName('pwc')[0].value;
	if(npw.length<6 || npw.length>24)
	{
		showError('Mật khẩu phải lớn hơn 6 hoặc nhỏ hơn 24 kí tự');
		return false;
	}
	if(npw!=opw)
	{
		showError('Mật khẩu nhâp lại không chính xác');
		return false;
	}
	
	
	
	}
	
	