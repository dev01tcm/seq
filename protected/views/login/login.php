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
	background: url("images/common/bgd.jpg") repeat-y scroll center top rgba(0, 0, 0, 0);
	/* "https://s-passets-cache-ak0.pinimg.com/webapp/style/app/common/images/inspired-desktop/bg_wood_floors_grid-e81a5b5a.jpg" */	
	background-size: cover;
	height: 100%;	
	width: 100%;
    position: absolute;
    left: 0;
    top: 0; 
    z-index: -1;
}
.head {
	background-size: cover;
	height: 35%;	
	width: 100%;
    position: absolute;
    left: 0;
    top: 0; 
    z-index: 1;
    
}

.cls_news {
 width:550px;float:left;position:relative;z-index:1000;margin-right: 0px;
display:block;
}
.cls_hidden{
	display:none;
}
.log_right{padding:0px;margin:0px;float:left;}
.log_border_new{border-radius:0px 4px 4px 0px;}
.log_boder_nonew{border-radius:4px;margin: 0 auto;}
</style> 

<div style="margin-bottom:18%">
	<center><img src="images/common/headbackground.png" class="head"/></center>
</div>
<div  style="height:480px;margin: 0 auto; width:1000px;">
    <div id="div_news" style="height:480px;">
        <div class="panel-body" id="div_news_detail" style="padding:20px;font-size:18px;white-space:normal;background-color:#FFFFFF; border-radius:4px 0px 0px 4px; border-right:1px solid #D4D4D4; height:100%;">
    <iframe id="preview"  style="width:520px;height:402px;">  
        
    </iframe>      
        </div>
    </div>
    <input type="hidden" id="hdf_status" />
    
    
    
    <div id="log_in" style="height:480px;">
        <div id="loghead" class="loginheader" style="text-align:center;background-color:#FFFFFF; width:450px;height:100%;">
            <img src="<?php echo Yii::app()->params['prg_ctrl']['logo']; ?>" style="width:100px; height:100px;margin-top:10px;" />
            <h1 style="font-weight: bolder;font-size:25px;margin:20px 0 50px;color:#402b78;">ยินดีต้อนรับสู่ระบบสอบทรัพย์</h1>
          
        <div style="clear:both; height:0px;"></div>
        
        <form id="login-form" method="post" style="width:390px; margin-left:30px;">
                    
                <div class="row" style="margin:0px;"><input type="text" id="txtusername" name="txtusername" maxlength="320" placeholder="รหัสผู้ใช้" style="margin-bottom:10px;"></div>
                <div class="row" style="margin:0px;"><input type="password" id="txtpassword" name="txtpassword" maxlength="30" placeholder="รหัสผ่าน" style="margin-bottom:30px;"></div>
            
 
                <div style="padding-top:12px;width:390px;">
                    <input type="button" id="btnlogin" class="btn btn-default" value="เข้าสู่ระบบ" onClick="ajax_auth();">    
                </div> 
          		

        </form>
        </div>

    </div>
	<div style="clear:both; height:0px;"></div>
</div>

<div id="shawdow-behind"><img class="prefetch" src="images/common/bgd.jpg"></div>  
   
<script type="text/javascript">
jQuery(document).ready(function ($) {	
	$("#txtpassword").keyup(function (e) {
		if (e.keyCode == 13) {ajax_auth();}
		});
	$('#hdf_status').val('<?php echo $status; ?>');
	var st_news = $('#hdf_status').val();
	if(st_news==1){
		//$('#div_news_detail').html('<?php //echo $txtnews; ?>');
		getNews();
		$("#div_news").addClass("cls_news");
		$("#log_in").addClass("log_right");	
		$('#loghead').addClass("log_border_new");
	}else{
		$("#div_news").addClass("cls_hidden");
		$('#loghead').addClass("log_boder_nonew");	
		
	}
});


function ajax_auth(){ 
	//if(ex_isEmpty($('#txtusername').val())){alert('กรุณาระบุรหัสผู้ใช้'); return;}
	//if(ex_isEmpty($('#txtpassword').val())){alert('กรุณาระบุรหัสผ่าน'); return;}
	
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

function getNews(){
    $.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl("login/getnews"); ?>",
		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
		dataType: "json",				
		success: function (data) {
			if (data.status=='success') {	
				//$('#div_news_detail').html(stripSlashes(data.txtnews));
				
				var $iframe = $('#preview');
				$iframe.ready(function() {
				$iframe.contents().find("body").append(stripSlashes(data.txtnews));
				});				
			}
			else{
				alert(data.msg);
			} 
		}
	});		
}
function stripSlashes(str)
{
	return str.replace(/\\/g, '');
}
</script>