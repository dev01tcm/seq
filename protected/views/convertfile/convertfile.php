
<?php
	$this->pageTitle = 'SEQUESTER' . Yii::app()->params['prg_ctrl']['pagetitle'];
?>


<style type="text/css">
.btn-upload {
	border-radius: 0 6px 6px 0;
	height: 34px;
	width: 110px;
	margin-left:-7px;
	display:inline-block;
}
.btn-upload:focus, .btn-upload:active { outline: none; }
.uploaderProgress {
    border-radius: 6px 0 0 6px ;
	box-shadow: 0 1px 0 rgba(255, 255, 255, 0.15) inset, 0 1px 1px rgba(0, 0, 0, 0.075);
    overflow: hidden;
	display:inline-block;
	margin-left:-7px;
	height: 34px;
	width: 300px;
}
.uploaderProgress2 {
    border-radius: 6px 0 0 6px ;
	box-shadow: 0 1px 0 rgba(255, 255, 255, 0.15) inset, 0 1px 1px rgba(0, 0, 0, 0.075);
    overflow: hidden;
	display:inline-block;
	margin-left:-7px;
	height: 34px;
	width: 300px;
}
.uploaderProgress span {
    color: #333;
    font-size: 14px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.progress {
    background-image: linear-gradient(to bottom, #ebebeb 0px, #fefefe 100%);
    background-repeat: repeat-x;
    background-color: #fefefe;
    border-radius: 4px;
	box-shadow:none;
    height: 1px;
	width: 290px;
    margin: 0px 0 10px -1px;
    overflow: hidden;
}
#errupload {
	overflow:hidden;
	height:60px;
}

/*area--------------------------------------*/
/*
#bodyContainer {	
}
#bodyContent {
	width:100%;
    padding: 0px 50px;
}
*/

/*pager--------------------------------------*/
.grid-view .pager, .grid-view .mailbox-pager {
    margin: 5px 0 0;
    text-align: center;
}
ul.yiiPager {
    border: none;
    display: inline;
    font-size: 0px;
	line-height: 20px;
    margin: 0;
    padding: 0;
    border-radius: 3px;
}
ul.yiiPager li {
    display: inline;
	font-size: 14px;
	margin-right:3px;
	height:20px;
}
.pager li > a, .pager li > span {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 1px;
    display: inline-block;
    padding: 5px 14px;
}
ul.yiiPager a:link, ul.yiiPager a:visited {
    padding: 5px 8px;
}
ul.yiiPager .selected a {
    background: #4FC1E9 none repeat scroll 0 0; /*#2AABD2*/
    color: #ffffff;
    font-weight: bold;
}
ul.yiiPager .first a, ul.yiiPager .previous a, ul.yiiPager .next a, ul.yiiPager .last a {
    background: #e0f0ff none repeat scroll 0 0;
    color: #0e509e;
	font-weight:normal;
	font-size: 13px;
}
.txtlabel{
	width:80px;
}
/*
ul.yiiPager .first, ul.yiiPager .last, ul.yiiPager .next, ul.yiiPager .previous {
	display: inline;
}
*/
.conv{
	display:none;	
}
</style>  

<div class="panel panel-info">
    <div class="panel-heading">แปลงไฟล์ .txt .xlsx .xls</div>
    <div class="panel-body sectioncontent">
        <div style="width:800px; display:block; margin:0 auto;">
        	<ul>
                <li style="list-style:none; margin-top:15px">
					<input id="hdfstatus" type="hidden" />
                   	<input id="hdfstatus" type="hidden" />
                   	<input id="hdfid" type="hidden" />  
                   	<input id="hdftype" type="hidden" /> 
                   	<input id="hdfpath" type="hidden" value="<?php echo Yii::app()->params['prg_ctrl']['url']['upload'].Yii::app()->params['prg_ctrl']['path']['closepath']; ?>" /> 
                    <input id="hdftxtpath" type="hidden" value="<?php echo "uploads".Yii::app()->params['prg_ctrl']['path']['closepath']; ?>" />
                   
                </li> 
                <li style="list-style:none; margin-top:15px">                
                   	<input id="file_upload" type="file" name="files[]" accept=".txt, .xls, .xlsx" style="display:none;">
                    <div class="uploaderProgress input-default"><span id="name_file"></span></div>                                
                    <button onclick="btclick()" class="btn btn-primary btn-upload"><i class="glyphicon glyphicon-save"></i> เลือกไฟล์</button>    
                    <button type="button" onClick="fileconvert()" class="btn btn-success">แปลงไฟล์</button>       
                    <div id="progress" class="progress"><div class="progress-bar progress-bar-success"></div></div>
                    <font color="#FF0004"><span class="txtlabel">* เฉพาะไฟล์ .txt, .xls, .xlsx </span></font>  
                                     
                </li>           	
       		</ul>
        </div>
    </div>
</div>        


<div class="panel panel-info conv" style=" height:150px;">   
    <div class="panel-body sectioncontent con">
        <div style="width:800px; margin-top:80px;">
        	<ul>               
                <li style="list-style:none; margin-top:15px">
                	<a href='#' target="_blank" id="file_download" style="margin-left:300px;"></a>   	    
                                      
                </li>               
       		</ul>
        </div>
    </div>
</div>
<div id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false" class="modal">
    <div class="modal-dialog" align="center" style="margin-top:300px;">
        <img src="<?php echo Yii::app()->params['prg_ctrl']['url']['baseurl'];?>/images/common/loading232.gif" />
    </div>
</div> 
<div id="modaldetail" class="modal fade" aria-hidden="true" aria-labelledby="modaldetailLabel" role="dialog" tabindex="-1">
    <div class="modal-dialog" style="width:800px; margin-top:118px;">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px 20px 7px;">
                <button class="close" data-dismiss="modal" type="button">
                <span aria-hidden="true">×    <span class="sr-only">Close</span>
                </button>
                <h1 id="modaldetailLabel" class="modal-title">แปลงไฟล์สำเร็จ</h1>
            </div>
            <div class="modal-body">
            		<ul class="ul">
                        <li class="sectionContent" style="list-style:none;">
                            <label class="">ชื่อไฟล์ :</label>
                            <a style="width:650px;" id="txtfilename"></a>                         
                        </li>
                    </ul>
                                       
            </div>
            <div class="modal-footer" style="padding: 7px 20px">
                <h3 id="errmodaldetail" class="sectionError"></h3>
                <div class="sectionButton">
                    
                    <Button ID="btcledit"class="btn btn-default" data-dismiss="modal" Width="80px">ยกเลิก</Button>
                </div>
       		</div>
        </div>
    </div>
</div>
<script type="text/javascript">	
<?php /*upload*///////////////////////////////////////////////////////////////////////////// ?>
$(function () { 	
	'use strict';
		
	$('#file_upload').fileupload({
		url:'<?php echo Yii::app()->createAbsoluteUrl("convertfile/upload"); ?>',
		dataType: 'json',
		formData: [{ name: 'YII_CSRF_TOKEN', value: '<?php echo Yii::app()->request->csrfToken; ?>' }],		
		beforeSend: function(xhr, data) {			
			$('.uploaderProgress').html('<span id="name_file">'+data.files[0].name+'</span>');
			//$(".hdf").css("display", "none");
			$('#progress .progress-bar').css('width','0%');
			ex_hideErrors('#errupload');			
		},		
		done: function (e, data) {				
			$.each(data.result.files, function (index, file) {
				if(file.error!=null) {					
					ex_setErrors('#errupload', file.error)
				} else {
					//ajax_log(file.name);
					//alert('Upload ไฟล์เรียบร้อยแล้ว');
					$('.uploaderProgress').html('<span id="name_file">'+data.result.files[0].name+'</span>');		
					var type = data.result.files[0].name.split('.').pop();
					
					if(type=="xls"){
						type = "xlsx";
					}
					//alert(type);
					var str = data.result.files[0].name;
					var rest = str.substring(0, str.lastIndexOf(".") + 1);					
					var lin = $('#hdfpath').val()+'convert_'+rest+type;
					var lin2 = $('#hdftxtpath').val()+'convert_'+rest+type;
					
					//var filename = "convert_"+rest+type;
					$('#txtfilename').val("convert_"+rest+type);	
					$('#txtfilename').html("convert_"+rest+type);
					
					if(type=="xlsx"){
						$('.con').html('<div class="panel panel-default" style="display:block; margin: auto; width: 49%;"><div class="panel-heading"><font size="+1">แปลงไฟล์สำเร็จ</font></div><div class="panel-body" style=" margin-left:30px;"><label>ดาวน์โหลดไฟล์ได้ที่นี่ <a href="'+ lin +'" target="_blank" id="file_download" style="margin-left:10px; margin-top:300px;" download>convert_'+rest+type+'</a></div></div>');				
					}else{
						$('.con').html('<div class="panel panel-default" style="display:block; margin: auto; width: 49%;"><div class="panel-heading"><font size="+1">แปลงไฟล์สำเร็จ</font></div><div class="panel-body" style=" margin-left:30px;"><form action="convertfile/download" method="get" target="_blank"><input type="hidden" name="fileload" value="'+ lin2 +'"><label>ดาวน์โหลดไฟล์ได้ที่นี่ <a onclick="download();" style="cursor: pointer;">convert_'+rest+type+'</a><input type="submit" id="ok" hidden="hidden"/></label></form></div></div>');
					}
					
					$('.conv').css("display", "none");
					
					//$('#hdfname').val(data.result.files[0].name);
					//$('#hdffilesize'+id).val(data.result.files[0].size);					
					$('#hdftype').val(data.result.files[0].name.split('.').pop());					
					//addpaperclip2();
					$("#btnupload").removeAttr("disabled");
					$(".btn-warning").removeAttr("disabled");
					$(".btn-default").removeAttr("disabled");
					//alert(ss);
					$('#progress .progress-bar').css('width','0%');
					ex_hideErrors('#errupload');
				}
			});
		}, 
		progressall: function (e, data) {			
			var progress = parseInt(data.loaded / data.total * 100, 10);
			$('#progress .progress-bar').css('width',progress + '%');
		},
		fail: function(e, data){			
			ex_setErrors('#errupload', data.jqXHR.responseText);
		},		
	}).prop('disabled', !$.support.fileInput)
		.parent().addClass($.support.fileInput ? undefined : 'disabled');		
	});



function fileconvert()
{
	$('#pleaseWaitDialog').modal('show');
	//alert('aaaaa');
	//return;
	var file = $('#txtfilename').val();
	if(file=="")
	{
		alert("กรุณาเลือกไฟล์");
		return;
	}
	
	var name = [];
	var size = [];
	//var path = [];
	//var url = [];
	var type = [];
	var i = 0;
	var filename = '#name_file';
	//var filesize = '#hdffilesize';
	//var filepath = '#hdfpath'+i;
	//var fileurl = '#hdfurl'+i;
	var filetype = '#hdftype';

	name[i] = $(filename).text();
	//size[i] = $(filesize).val();
	//path[i] = $(filepath).val();
	//url[i] = $(fileurl).val();
	type[i] = $(filetype).val();
	//alert($(filesize).val());
	//return;
	
	$.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl("convertfile/convert"); ?>",
		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','name':name,'size':size,'type':type},
		dataType: "json",				
		success: function (data) {
			if (data.status=='success') {	
				//getSearch();	
				if(data.msg==''){
					//alert("ffff");
				}
				
				//$('.download').html('<span id="file_download" style="width:1000px;">'+data.result.files[0].name+'</span>');
				//alert("sss");
				//$('#file_download').
				downloadfile();
				
			}else{
				//alert('no');
				
				alert(data.msg);
				$('#pleaseWaitDialog').modal('hide');
			} 
		}
	});	
}


function btclick(){	
	$("#file_upload").click();
}
function downloadfile(){
	$('#pleaseWaitDialog').modal('hide');
	$('.conv').css("display", "block");
	//$("#modaldetail").modal('show');
}
function download(){
	//alert("sss");
	$('#ok').click();
}

</script>
