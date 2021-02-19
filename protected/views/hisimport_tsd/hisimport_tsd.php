
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
		<div class="panel-heading">ประวัติการนำเข้าผลการตรวจสอบหลักทรัพย์</div>
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
                    <h1 id="modaldetailLabel" class="modal-title">รายชื่อหลักทรัพย์ที่นำเข้ามา</h1>
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
              <div id="pan2">
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
    	url: "<?php echo Yii::app()->createAbsoluteUrl("hisimport_tsd/search_tsd_detail"); ?>",
  		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','code':code},				
    	success: function (data) {
						
			
			$('#pleaseWaitDialog').modal('hide');
			$("#modaldetail1").modal('show');
			$('#pan1').html(data);
			
		}
	});		
	//list-griddata61003
}
function getdetail(elem){
	
	
	var code = $(elem).attr("data-value");
//	$('#pleaseWaitDialog').modal('show');
	
	//alert(grid);
	
	 $.ajax({
    	type: "POST",
    	url: "<?php echo Yii::app()->createAbsoluteUrl("hisimport_tsd/tsd_detail"); ?>",
  		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','code':code},				
    	success: function (data) {
						
			
		//	$('#pleaseWaitDialog').modal('hide');
			$("#modaldetail").modal('show');
			$('#pan2').html(data);
			
		}
	});		
	//list-griddata61003
}
function getdetail_book(elem){
	
	
	var code = $(elem).attr("data-value");
//	$('#pleaseWaitDialog').modal('show');
	
	//alert(grid);
	
	 $.ajax({
    	type: "POST",
    	url: "<?php echo Yii::app()->createAbsoluteUrl("hisimport_tsd/tsd_detail_book"); ?>",
  		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','code':code},				
    	success: function (data) {
						
			
		//	$('#pleaseWaitDialog').modal('hide');
			$("#modaldetail").modal('show');
			$('#pan2').html(data);
			
		}
	});		
	//list-griddata61003
}
</script>
