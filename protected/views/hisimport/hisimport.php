
<?php
	$this->pageTitle = 'SEQUESTER' . Yii::app()->params['prg_ctrl']['pagetitle'];
?>


<style type="text/css">
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
	width:100px;
}


.uploaderProgress {
    border-radius: 6px 0 0 6px ;
	box-shadow: 0 1px 0 rgba(255, 255, 255, 0.15) inset, 0 1px 1px rgba(0, 0, 0, 0.075);
    overflow: hidden;
	display:inline-block;
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
.del:hover{
	color: red;
}
.link_empty{ display:none;}
/*
ul.yiiPager .first, ul.yiiPager .last, ul.yiiPager .next, ul.yiiPager .previous {
	display: inline;
}
*/
.tb{
	border-style:solid; 
	border-color:#CCC; 
	border-top-width:1px; 
	border-right-width:1px; 
	border-bottom-width:1px; 
	border-left-width:1px;
	text-align:center;
}
.tb1{
	border-style:solid; 
	border-color:#fff; 
	border-top-width:1px; 
	border-right-width:1px; 
	border-bottom-width:1px; 
	border-left-width:1px;
	text-align:center;
}
.f_left{
	float:left;	
	text-align:center;
}
.t_table{
	border:1px solid #ccc;	
	height:40px;
	text-left:10px;
}
.t_table1{
	height:30px;
	border:1px solid #ccc;
	text-align:center;
}
.center_listview{text-align:center;margin-top:10px;}
</style>  


    
    <div class="panel panel-info">
		<div class="panel-heading">ประวัติการนำเข้าผลการตรวจสอบบัญชีเงินฝาก</div>
    	<div class="panel-body">
        	
					 <table id="example" class="display" style="width:80%">
					  <thead>
						<tr>
							<th><div align="center">ชุดหนังสือ</div></th>
							<th><div align="center">เลขที่หนังสือ</div></th>
							<th><div align="center">วันที่หนังสือ</div></th>
							<th><div align="center">รายละเอียด</div></th>
						</tr>
					</thead>
					<?php
					foreach ($dataProvider as $dataitem)
					{
					?>
					  <tr>
						<td><div align="center"><?php echo $dataitem['id']; ?></div></td>
						<td><div align="center"><?php echo $dataitem["doc_no"];?></div></td>
						<td><div align="center"><?php echo $dataitem["doc_date"];?></div></td>
						<td><div align="center"><button type="button" id="<?php echo $dataitem['code']; ?>" class="btn btn-info" onClick="getDatagrid(this);">รายละเอียด</button></div></td>
						
					  </tr>
					<?php
					}
					?>
					</table>
                    
            </div>
      	</div> 
		
     <div id="modaldetail1" class="modal fade" aria-hidden="true" aria-labelledby="modaldetailLabel" role="dialog" tabindex="-1">
        <div class="modal-dialog" style="width:70%; margin-top:50px;">
            <div class="modal-content">
                <div class="modal-header" style="padding: 10px 20px 7px;">
                    <button class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">×    <span class="sr-only">Close</span>
                    </button>
                    <h1 id="modaldetailLabel" class="modal-title">รายชื่อธนาคารที่นำเข้าข้อมูลเข้ามา</h1>
                </div>
                <div class="modal-body" style="margin-top:-10px;">
                  
					<div id="pan1">
					</div>
					
                </div>
                <div class="modal-footer" style="padding: 7px 20px">
                    <h3 id="errmodaldetail" class="sectionError"></h3>
                    <div class="sectionButton">                    
                        <Button ID="btcledit"class="btn btn-default" data-dismiss="modal" Width="80px">ย้อนกลับ</Button>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <div id="modaldetail" class="modal fade" aria-hidden="true" aria-labelledby="modaldetailLabel" role="dialog" tabindex="-1">
        <div class="modal-dialog" style="width:80%; margin-top:118px;">
            <div class="modal-content">
                <div class="modal-header" style="padding: 10px 20px 7px;">
                    <button class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">×    <span class="sr-only">Close</span>
                    </button>
                    <h1 id="modaldetailLabel" class="modal-title">รายละเอียด</h1>
                </div>
                <div class="modal-body" style="margin-top:-10px;">
                    <div>                    	
                        <div align='left' style='border-bottom:1px solid #ccc;'>
                            <label style="width:120px;">เลขชุดหนังสือ : </label>
                            <label id='spcode' style="width:80px;"></label>
                            <label style='width:100px;'>เลขหนังสือ : </label>
                            <label id='spdoc_no' style="width:160px;"></label>		
                            <label style="margin-top:5px;width:120px;">วันที่หนังสือ : </label>
                            <label id='spdoc_date' style="width:120px;"></label>
                            <label style='width:120px;'>วันเวลาที่นำเข้า : </label>
                            <label id='spcreate_date' style="width:250px;"></label>						
                        </div>                        
                        <div align='left' style='border-bottom:1px solid #ccc;'>
                            <label style='margin-top:5px;width:120px;'>รหัสธนาคาร : </label>
                            <label id='spbank_id' style="width:80px;"></label>
                            <label style='width:100px;'>ชื่อธนาคาร : </label>
                            <label id='spbank' style="width:450px;"></label>
                        </div>
                    </div>
					<div id="pan2">
					</div>
					
                </div>
                <div class="modal-footer" style="padding: 7px 20px">
                    <h3 id="errmodaldetail" class="sectionError"></h3>
                    <div class="sectionButton">                    
                        <Button ID="btcledit"class="btn btn-default" data-dismiss="modal" Width="80px">ย้อนกลับ</Button>
                    </div>
                </div>
            </div>
        </div>
    </div>    

	<div id="modalpaper" class="modal fade" aria-hidden="true" aria-labelledby="modaldetailLabel" role="dialog" tabindex="-1">
        <div class="modal-dialog" style="width:850px; margin-top:88px;">
			<div class="modal-content">
				<div class="modal-header" style="padding: 10px 20px 7px;">
					<button class="close" data-dismiss="modal" type="button">
         				<span aria-hidden="true">×    <span class="sr-only">Close</span>
          			</button>
       				<h1 id="modalpaperLabel" class="modal-title">บันทึกข้อมูล</h1>
      			</div>
           		<div class="modal-body"> 
                    <div style="clear:both;height:0px;">
                        <input type="hidden" id="hdfname" />             
                        <input type="hidden" id="hdffiletotal" />
                        <input type="hidden" id="hdfdataid" />
                        <input type="hidden" id="hdfdcntrmv" />               
                    </div>
                    <ul>                   
                        <li style="list-style:none;width:40%;float:left;" hidden="hidden">
                            <label class="txtlabel" style="width:90px;">ลำดับที่</label>
                            <input type="text" id='txtno' class="input-default ipdisable" maxlength="20" style="width:100px; text-align:left;" disabled>
                        </li> 
                        <li style="list-style:none;width:60%;float:left;">
                            <label class="txtlabel">เลขที่ชุดข้อมูล : </label>
                            <input type="text" class="input-default ipdisable" id="txtcode" style="width:200px;" disabled/>
                        </li>
                        <li style="list-style:none;height:5px;clear:both;"></li>
                        <li style="list-style:none;clear:both;">
                            <label class="txtlabel">เลขที่หนังสือ : </label>
                            <input type="text" class="input-default ipdisable" id="txtdoc_no" style="width:200px;" maxlength="20" disabled/>
                            <label class="" style="margin-left:15px;">วันที่หนังสือ : </label>
                            <input id="txtdoc_date" type="text" class="input-default ipdisable" style="width:200px;" maxlength="10" disabled>
                        </li> 
                        <li style="list-style:none;height:0px;clear:both;"></li>  
                        <li style="list-style:none; margin-top:30px;">
                        	<div class="panel panel-default" style="display:block;width:90%;margin:0 auto; ">
                            	<div class="panel-heading"><font size="+1">ไฟล์แนบ </font></div>
                            	<div class="panel-body">
                                	<div id="elementId" style="float:left;width:85%;padding-left:60px;"></div>
                                    <div style="float:right;width:15%;" id="divbuttonadd">
                                        <button onClick='addpaperclip()' class='btn btn-primary'>
                                            <i class='glyphicon glyphicon-plus'></i> เพิ่มไฟล์
                                        </button>
                                    </div>
                                    <div style="clear:both;height:0px;"></div>
                                    <font color="#FF0004"><span class="txtlabel">* เฉพาะไฟล์ .pdf .jpeg .jpg .txt .xls .xlsx .docx .doc .zip และ .png</span></font>
                                </div>                                                                
                            </div>                        
                        </li>                  
                    </ul> 
           		</div>
                <div id="errupload" class="files sectionError" style="margin-left:20px;font-size:14pt;"></div>                 
                <div id="divtrnidfile" style="height:0px;"></div>
                <div id="divrmv" style="height:0px;"></div>
                <div class="modal-footer" style="padding:7px 20px">
                    <div>                	   
                        <Button id="btcledit"class="btn btn-default" style="float:right;" data-dismiss="modal" Width="80px">ปิด</Button>
                    </div>
                    <div class="aa" >
                        <input type="button" class="btn btn-danger" style="float:left;display:none;" onClick="setDelete();" value="ลบ"/>
                        <input type="button" class="btn btn-success" name="ok" style="float:right; margin-right:10px;" onClick="file_savedata();" value="บันทึก"/>   
                    </div>
                    <div style="clear:both;height:0px;"></div> 
                </div>
            </div>
    	</div> 
  	</div>
    
    
    
</div>    
   <div id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false" class="modal">
    <div class="modal-dialog" align="center" style="margin-top:300px;">
        <img src="<?php echo Yii::app()->params['prg_ctrl']['url']['baseurl'];?>/images/common/loading232.gif" />
    </div>
</div> 
<script type="text/javascript">
jQuery(document).ready(function ($) {	

	$("#txtkeyword").keyup(function (e) {
		if (e.keyCode == 13) {getSearch();}
		});
});
$(document).ready( function () {
    $('#example').DataTable();
} );
function getSearch() {
	
	var data = {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>', 'keyword': $('#txtkeyword').val()}; 
	alert("cerferfer");
	$.fn.yiiListView.update('import_id', {
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("hisimport/searchlist"); ?>',
		data: data,
	});
	
} 
/*
function enableTxt(elem) {
    var id = $(elem).attr("id");
	var name = $(elem).attr("name");
    alert(id+name);
}*/
function getDatagrid(elem){
	
	var code = $(elem).attr("id");
	
	$('#pleaseWaitDialog').modal('show');
	
	//alert(grid);
	
	 $.ajax({
    	type: "POST",
    	url: "<?php echo Yii::app()->createAbsoluteUrl("home/search2"); ?>",
  		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','code':code},				
    	success: function (data) {
						
			
			$('#pleaseWaitDialog').modal('hide');
			$("#modaldetail1").modal('show');
			$('#pan1').html(data);
			
		}
	});		
	//list-griddata61003
}
function setDetail(elem){
		
	//var id = $(el).attr("id");
	//var code = $(el).attr("name");
	var id = $(elem).attr("data-idbank"); 
	var code = $(elem).attr("data-value"); 
	$('#pleaseWaitDialog').modal('show');
	//var id = $(elem).parent().attr("data-idbank");
	//var code = $(elem).parent().attr("data-value");
	//var id = $(el).parent().attr("data-id");
	//alert(id+code);
	//return;
	$.ajax({
    	type: "POST",
    	url: "<?php  echo Yii::app()->createAbsoluteUrl("hisimport/searchhead"); ?>",
  		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id,'code':code},
    	dataType: "json",				
		success: function (data) {
			if (data.status=='success') {
				//$("#modaldetail").modal('show');
				$("#spcode").html(data.code);
				$("#spdoc_no").html(data.doc_no);
				$("#spdoc_date").html(data.doc_date);
				$("#spcreate_date").html(data.create_date);
				$("#spbank_id").html(data.bank_id);
				$("#spbank").html(data.name);
				getSearch2(id,code);
				
			}else{
				alert(data.msg);
			} 
		}
	});
	//alert(id+code);
	
	var data = {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id,'code':code, 'keyword': $('#txtkeyword').val()}; 
	$.fn.yiiGridView.update('list-grid', {
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("home/search"); ?>',
		data: data,
	});
	
	
}
function getSearch2(id,code){
	
		 $.ajax({
    	type: "POST",
    	url: "<?php echo Yii::app()->createAbsoluteUrl("hisimport/searchformhis"); ?>",
  		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','code':code},				
    	success: function (data) {
						
			
			
			$('#pan2').html(data);
			$('#pleaseWaitDialog').modal('hide');
			$("#modaldetail").modal('show');
		}
	});
		
	}
	
function getData(){
	var data = {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'}; 
	$.fn.yiiGridView.update('list-griddata', {
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("hisimport/Databank"); ?>',
		data: data,
	});
}
	
function getPaper(){
	$("#modalpaper").modal('show');
}
function deleteimport(elem){
	$('#pleaseWaitDialog').modal('show');
	var idbank = $(elem).attr("data-idbank");
	var code = $(elem).attr("data-value");
	var r = confirm("คุณต้องการลบข้อมูลนี้ใช่หรือไม่ !");	
    if (r == true) {	
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl("hisimport/deletedata"); ?>",
			data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','idbank':idbank,'code':code},
			dataType: "json",				
			success: function (data) {	
			console.log(data.status);
				if (data.status=='success') {
					
					var grid='list-griddata'+code;
					var data = {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','code':code}; 
					$.fn.yiiGridView.update(grid, {
					type: 'POST',
					url: '<?php echo Yii::app()->createAbsoluteUrl("home/search2"); ?>',
					data: data,
	});	
					$('#pleaseWaitDialog').modal('hide');
					alert("ทำการลบข้อมูลเรียบร้อยแล้ว");
				
					//getSearch();				
				}else{
					alert(data.msg);
					$('#pleaseWaitDialog').modal('hide');
				} 
			}

		});
		
  	}
}
function setUpdate(el){
	
	$('#hdfdataid').val('');
	$('#elementId').html('');
	$('#hdfdcntrmv').val('');
	$('#divrmv').html('');
	$('#divtrnidfile').html('');
	$('#errupload').text('');
	var id = $(el).attr("data-id"); 
	var bank_id = $(el).attr("data-idbank"); 
	var code = $(el).attr("data-value"); 
	//var id = $(el).parent().attr("data-id");
	//alert(id);
	//return;
	index = 0;
 	
	$.ajax({
    	type: "POST",
    	url: "<?php echo Yii::app()->createAbsoluteUrl("hisimport/getDataimport"); ?>",
  		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id,'bank_id':bank_id,'code':code},
    	dataType: "json",				
    	success: function (data) {
			if (data.status=='success') {
				$('#txtno').val(data.id_impt);
				$('#txtcode').val(data.code);
				$('#txtdoc_no').val(data.doc_no);
				$('#txtdoc_date').val(data.doc_date);
				$('#hdffiletotal').val(data.cntfile);
				
				if(data.cntfile != 0){
					var i = 0;
					while(i<data.cntfile){
						if(i<(data.cntfile))
						addpaperclip2();
						var fileid = '#hdffileid'+(i+1);
						var filename = '#name_file'+(i+1);
						var filesize = '#hdffilesize'+(i+1);
						var filetype = '#hdffiletype'+(i+1);
						var fileurl = '#link'+(i+1);
						
						$('#divtrnidfile').append("<input type='hidden' id='trnid"+(i+1)+"' value='"+data.trn_id[i]+"' />");
						$(fileid).val(data.trn_id[i]);
						$(filename).text(data.namefile[i]);
						$(filesize).val(data.sizefile[i]);
						$(filetype).val(data.typefile[i]);
						$(fileurl).attr('href',data.urlfile[i]+data.namefile[i]);
						$(fileurl).attr('download',data.namefile[i]);
						$(fileurl).removeClass('link_empty');
						i++;
					}	
				}
			
				$('#modalpaper').modal('show');
			
			}else{
				
			} 
		}
	});
}

function addpaperclip()
{
	var id = 0;
	var count = $('#hdfdataid').val();	
	if(count==''){
		count=0;
	}

	id = Number(count)+1;
	//alert(i);
	$('#elementId').append("<div data-ids='"+ id +"' class='paperclipupload"+ id +"'><input id='paperclip"+ id +"' type='file' accept='.pdf, .png, .jpg, .jpeg, .txt, .xlsx, .xls, .doc, .docx, .zip, .rar, .7z'  name='files[]' style='display:none;'><div class='uploaderProgress input-default upload"+ id +"' style='width:350px;'><span data-id='"+ id +"' title='ดาวน์โหลด' id='dwnload"+id+"' style='cursor: pointer;margin-right: 20px;'><a id='link"+id+"' target='_blank' class='link_empty' download><i class='glyphicon glyphicon-download'></i></a></span><span id='name_file"+ id +"'></span></div><button onclick='btclick(this)' class='btn btn-warning btn-upload' style='border-radius: 0px 5px 5px 0px;'><i class='glyphicon glyphicon-paperclip'></i> ไฟล์แนบ</button><input type='hidden' id='hdffileid"+ id +"'><input type='hidden' id='hdffilename"+ id +"'><input type='hidden' id='hdffilesize"+ id +"'><input type='hidden' id='hdffiletype"+ id +"'><span title='ลบ' class='glyphicon glyphicon-remove del'  style='margin-left:10px;cursor: pointer;' onclick='del(this)' ></span></div><div id='progress"+ id +"' class='progress aa"+ id +"' style='width:344px;margin-left: 5px;'><div class='progress-bar'></div></div>");
	
	
	$('#hdfdataid').val(id);
	$(function () { 	
    'use strict';
		
    $('#paperclip'+id).fileupload({
		url:'<?php echo Yii::app()->createAbsoluteUrl("hisimport/upload"); ?>',
        dataType: 'json',
		formData: [{ name: 'YII_CSRF_TOKEN', value: '<?php echo Yii::app()->request->csrfToken; ?>' }],		
		beforeSend: function(xhr, data) {
			$('.upload'+id).html('<span id="name_file'+ id +'">'+data.files[0].name+'</span>');
			$(".hdf").css("display", "none");
			$('#progress'+id+' .progress-bar').addClass("progress-bar-success");
			$('#progress'+ id +' .progress-bar').css('width','0%');
			ex_hideErrors('#errupload');
		},		
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
				if(file.error!=null) {
					if(file.error == 'Filetype not allowed'){
						ex_setErrors('#errupload','*รูปแบบไฟล์ไม่รองรับ');
					}
					if(file.error == 'The uploaded file exceeds the upload_max_filesize directive in php.ini'){
						ex_setErrors('#errupload','*ไม่สามารถอัพโหลดได้ เนื่องจากไฟล์มีขนาดใหญ่');
					}
					$('#name_file'+id).text('');
					$('#progress'+id+' .progress-bar').addClass("progress-bar-danger");
					$('#progress'+id+' .progress-bar').css({'width':'100%'});					
					
				} else {
					//ajax_log(file.name);
					//alert('Upload ไฟล์เรียบร้อยแล้ว');
					//$('#hdfname').val(data.result.files[0].name);
					
					
					$('.upload'+id).html('<span id="name_file'+ id +'">'+data.result.files[0].name+'</span>');
					$('#hdffilesize'+id).val(data.result.files[0].size);				
					$('#hdffiletype'+id).val('.'+data.result.files[0].name.split('.').pop());	
					$('#link'+id).addClass('link_empty');
					$("#btnupload").removeAttr("disabled");
					$(".btn-warning").removeAttr("disabled");
					$(".btn-default").removeAttr("disabled");
					$('#progress'+id+' .progress-bar').addClass("progress-bar-success");
					$('#progress'+id+' .progress-bar').css('width','0%');
					ex_hideErrors('#errupload');
					
				}
            });
        }, 
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress'+id+' .progress-bar').css('width',progress + '%');
        },
		fail: function(e, data){
			ex_setErrors('#errupload', data.jqXHR.responseText);
		},		
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

	});
}
function addpaperclip2()
{
	var i = 0;
	var count = $('#hdfdataid').val();	
	if(count==''){
		count=0;
	}

	i = Number(count)+1;
	//alert(i);
	$('#elementId').append("<div data-ids='"+ i +"' class='paperclipupload"+ i +"'><input id='paperclip"+ i +"' type='file' accept='.pdf, .png, .jpg, .jpeg, .txt, .xlsx, .xls, .doc, .docx'  name='files[]' style='display:none;'><div class='uploaderProgress input-default upload"+ i +"' style='width:445px;border-radius: 6px 6px 6px 6px;'><span data-id='"+ i +"' title='ดาวน์โหลด' id='dwnload"+i+"' style='cursor: pointer;margin-right: 20px;'><a id='link"+i+"' target='_blank' class='link_empty' download><i class='glyphicon glyphicon-download'></i></a></span><span id='name_file"+ i +"'></span></div><input type='hidden' id='hdffileid"+ i +"'><input type='hidden' id='hdffilename"+ i +"'><input type='hidden' id='hdffilesize"+ i +"'><input type='hidden' id='hdffiletype"+ i +"'><span title='ลบ' class='glyphicon glyphicon-remove del'  style='margin-left:10px;cursor: pointer;' onclick='del(this)' ></span></div><div id='progress"+ i +"' class='progress aa"+ i +"' style='width:344px;margin-left: 5px;'><div class='progress-bar'></div></div>");
	
	$('#hdfdataid').val(i);
	
}
function btclick(el){
	var id = $(el).parent().attr("data-ids");	
	
	//alert(id);
	//return;
	$('#progress'+ id +' .progress-bar').removeClass("progress-bar-success progress-bar-danger");
	$('#progress'+ id +' .progress-bar').css('width','0%');
	$('#errupload').text('');
	$("#paperclip"+id).click();
	
	
}

function del(el){	
	var id = $(el).parent().attr("data-ids");
	var txtidrmv = '#hdffileid'+id;
	var idrmv = $(txtidrmv).val();	
	$(".paperclipupload"+id ).remove();
	$(".aa"+id ).remove();
	index = index+1;
	$('#divrmv').append("<input id='txtrmv"+index+"' type='hidden' value='"+idrmv+"'/>");
	$('#hdfdcntrmv').val(index);
	
	
}

function file_savedata(){
	var id = $('#txtno').val();
	var cntfile = $('#hdffiletotal').val(); // total id of query from database
	var name = [];
	var size = [];
	var type = [];
	var trnid = [];// id of query from database
	var rmv = [];// id to remove
	var arr = [];
	var i = 0;
	var data_paper = $('#hdfdataid').val();
	if(data_paper != ''){
		while(i<data_paper){
			var filename = '#name_file'+(i+1);
			var filesize = '#hdffilesize'+(i+1);
			var filetype = '#hdffiletype'+(i+1);
			var filetrnid = '#trnid'+(i+1);
			
			if($(filename).text()!='' && $(filename).text()!=null){
				name.push($(filename).text());
				//alert(name[i]);
			}
			if($(filesize).val() != '' && $(filesize).val() != null){
				size.push($(filesize).val());
			}
			if($(filetype).val() != '' && $(filetype).val() != null){
				type.push($(filetype).val());
			}
			if($(filetrnid).val() != '' && $(filetrnid).val() != null){
				trnid.push($(filetrnid).val());
			}
			
			
			if($('#hdfdcntrmv').val() != ''){
				
				var txtrmv = '#txtrmv'+(i+1);
				if($(txtrmv).val() != null && $(txtrmv).val() != ''){
					rmv.push($(txtrmv).val());
				}
			}
			i++;
				
		}			
	}
	//alert('total file query '+cntfile);
	//alert(JSON.stringify(arr));
	//return;
	$.ajax({
    	type: "POST",
    	url: "<?php echo Yii::app()->createAbsoluteUrl("hisimport/savefile"); ?>",
  		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id,'name':name,'size':size,
		'type':type,'cntfile':cntfile,'trnid':trnid,'rmv':rmv},
    	dataType: "json",				
    	success: function (data) {
			if (data.status=='success') {
				alert("บันทึกสำเร็จ");		
				$('#modalpaper').modal('hide');						
				//getSearch();
				//getData();
			}else{
				alert(data.msg);
			} 
		}
	});	
	
	
}


</script>
