<?php
	$this->pageTitle = 'Login' . Yii::app()->params['prg_ctrl']['pagetitle'];
?>


<style type="text/css">
body {
    background: none repeat scroll 0 0 #E9E9E9; 
	margin: 0px;
}

#bodyContainer {
	background-color: #E9E9E9;
}

.loginContainer { 
	background-color: #F0F0F0;	
    background-size: cover;
    border-radius: 6px;
    box-shadow: 0 -1px 5px rgba(0, 0, 0, 0.2);
    margin-left: -210px;
    margin-top: 80px; 
    padding: 0;
    /*position: absolute;*/
    position: relative;	
	margin-bottom: 100px;
    left: 50%;
    width: 422px;
    z-index: 1;	
	text-align: left;
} 
.loginContainer .loginheader {
	background-color: #007DAA;	
	padding: 5px 38px 15px 37px;
} 
.loginContainer .loginbody {
	background-color: #FFFFFF;	
	padding: 15px 38px 15px 37px;
	border-top: 1px solid #CCCCCC;
}
.loginContainer .loginfooter {
	background-color: #e0e0e0;	
	padding: 10px 38px 0px 37px; 
	height:67px;
}

.loginContainer .loginheader > h1 {
    font-size: 23px;
    margin: 15px 0 -5px;
}

#txtusername {
    border-radius: 3px;
    font-size: 20px;
    padding: 15px;	
    -moz-box-sizing: border-box;
    background: linear-gradient(#FAFAFA, #FAFAFA) repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: 1px solid #D6D3CE;
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.12) inset;
    color: #333333;
    width: 100%;	
	line-height: normal;
    margin: 0;
    vertical-align: middle;	
	margin-bottom:2px;
}

#txtpassword {
    border-radius: 3px;
    font-size: 20px;
    padding: 15px;	
    -moz-box-sizing: border-box;
    background: linear-gradient(#F0F0F0, #F5F5F5) repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: 1px solid #D6D3CE;
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.12) inset;
    color: #333333;
    width: 100%;	
	line-height: normal;
    margin: 0;
    vertical-align: middle;	
}

#btnlogin {
	width: 100%;
	height:45px;	
	font-weight:bold;
	color: #666666; 
	margin-top: -1px;
}


#shawdow-behind img {
    border: 0 none;
    height: auto;
    max-width: 100%;
    vertical-align: middle;
	display:none;
}

#shawdow-behind {
	background: url("images/common/bglogin.jpg") repeat-y scroll center top rgba(0, 0, 0, 0);
	/* "https://s-passets-cache-ak0.pinimg.com/webapp/style/app/common/images/inspired-desktop/bg_wood_floors_grid-e81a5b5a.jpg" */	
	background-size: cover;
	height: 100%;	
	width: 100%;
    position: absolute;
    left: 0;
    top: 0; 
    z-index: -1;
}
</style> 
 

<div class="loginContainer">
    <div class="loginheader">
        <h1 style="font-weight: bolder; color:#fff; font-size: 21px; margin: 13px 0 -2px;">เข้าสู่ระบบ</h1>
	</div>
    
    <div class="form">
	<form id="login-form" method="post">
        <div class="loginbody">
            <div class="row"><input type="text" id="txtusername" name="txtusername" maxlength="320" placeholder="รหัสผู้ใช้ AD"></div>
            <div class="row"><input type="password" id="txtpassword" name="txtpassword" maxlength="30" placeholder="รหัสผ่าน AD"></div>
        </div>
        <div class="loginfooter">
            <input type="button" id="btnlogin" class="btn btn-default" value="เข้าสู่ระบบ" onClick="ajax_auth();">    
        </div>    
    </form>
    </div>
</div>



<div id="shawdow-behind"><img class="prefetch" src="images/common/bglogin.jpg"></div>  
    
<script type="text/javascript">
jQuery(document).ready(function ($) {	
	$("#txtpassword").keyup(function (e) {
		if (e.keyCode == 13) {ajax_auth();}
		});
});

function ajax_auth(){ 
	if(ex_isEmpty($('#txtusername').val())){alert('กรุณาระบุรหัสผู้ใช้'); return;}
	if(ex_isEmpty($('#txtpassword').val())){alert('กรุณาระบุรหัสผ่าน'); return;}
	
	var data = {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>', 'txtusername': $('#txtusername').val(), 'txtpassword': $('#txtpassword').val()}; 
	$.ajax({
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("login/auth"); ?>',
		data:data,
		dataType:'json',
		success: success_auth,
		error: error_auth,
	});
} 
var success_auth = function (data) {
	if(data.status=='success') { location.reload();	
	} else if(data.status=='error') { alert(data.msg); 
	} else { alert('Invalid Exception.'); } 
}
var error_auth = function (data) { alert('Invalid Exception.'); }


</script>