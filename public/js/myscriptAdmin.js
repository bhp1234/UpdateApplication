function showError(text){
swal(    text, '',   'error' );
}

function changeLayout(name){
var date=new Date();
date.setTime(date.getTime()+365*24*60*60*1000);
document.cookie="layout="+name+";expires="+date.toGMTString()+"; path=/";
}

/*function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=");
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1) {
                c_end = document.cookie.length;
            }
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return "";
}*/

function showImgS()
{
 var reader = new FileReader();
 var dom=document.getElementById("smallImg");
 reader.onload = function (e) {
         
			document.getElementById('showsmall').setAttribute("src",e.target.result);
        }
 reader.readAsDataURL(dom.files[0]);
}

function showImgB()
{
 var reader = new FileReader();
 var dom=document.getElementById("bigImg");
 reader.onload = function (e) {
         
			document.getElementById('showbig').setAttribute("src",e.target.result);
        }
 reader.readAsDataURL(dom.files[0]);
} 

function checkAddProValue()
{

}