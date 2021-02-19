

<script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/canvasjs/jquery.canvasjs.min.js"></script>


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
.mailbox-pager{
	 margin: 5px 0 0;
	text-align: center;
	
}
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
/*
ul.yiiPager .first, ul.yiiPager .last, ul.yiiPager .next, ul.yiiPager .previous {
	display: inline;
}
*/
.f_left{
	float:left;	
	text-align:center;
}
</style>  

<div class="panel panel-info">
    <div class="panel-heading">ภาพรวมการดำเนินการ</div>
    <div class="panel-body sectioncontent" style="padding: 15px 0 15px 0;">
        
            <ul style="padding-left:0px; padding-right:0px; margin: 0px;">
                <li style="list-style:none; padding:8px 100px 4px 300px;">
                	<?php      
					$data=lkup_home::getRequestnew();
					foreach($data as $dataitem) 
					{                         
						echo "<label class='labeltext'>ข้อมูลใหม่รอประมวลผลตรวจสอบ &nbsp;&nbsp;&nbsp;".$dataitem['cnt']." รายการ </label>";							
					}                         
                 	?>                   
                </li>
                <li style="list-style:none; border-top:1px dotted #999; padding:8px 100px 4px 300px;">
                	<?php      
					$data=lkup_home::getRequestedit();
					foreach($data as $dataitem) 
					{                         
						echo "<label class='labeltext'>ข้อมูลไม่สมบูรณ์รอการแก้ไข &nbsp;&nbsp;&nbsp;<font color='#dd4444' >".$dataitem['cnt']."</font> รายการ </label>";							
					}                         
                 	?>                   
                </li>
               <?php
			  
					$this->widget('zii.widgets.CListView', array(
						'dataProvider'=>$dataProvider,
						'itemView'=>'_home',
						'htmlOptions' => array('width' => '100%;'),
						'enablePagination' =>true,
						'summaryText' => '',
						'id'=>"home_id",
						'pagerCssClass'=>'mailbox-pager',
						'enablePagination'=>true,
						'pager' => array(
							'class'=>'CLinkPager',
							'header' => '',
							'firstPageLabel'=>'หน้าแรก',
							'prevPageLabel'=>'ก่อนหน้า',
							'nextPageLabel'=>'หน้าถัดไป', 
							'lastPageLabel'=>'หน้าสุดท้าย',				
						),	
						
					));
					
				?>
				
            </ul>
        
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
					<?php		
                        $this->widget('zii.widgets.grid.CGridView', array(
                        'id' => 'list-grid',
                        'dataProvider' => $modelform,
                        'htmlOptions' => array('width' => '500px'),
                        'itemsCssClass' => 'table table-bordered table-striped',	
                        'rowHtmlOptionsExpression'=>'array("data-id"=>$data["id"])',
                        'summaryText' => "แสดงข้อมูล: {start} - {end} จาก {count} รายการ",
                        'pagerCssClass'=>'mailbox-pager',
                        'pager' => array(
                            'class'=>'CLinkPager',
                            'header' => '',
                            'firstPageLabel'=>'หน้าแรก',
                            'prevPageLabel'=>'ก่อนหน้า',
                            'nextPageLabel'=>'หน้าถัดไป', 
                            'lastPageLabel'=>'หน้าสุดท้าย',	
                        
                        ),		           		
                        'columns' => array(	
                                array(
                                    'name'=>'acc_employer',
                                    'header' => 'เลขนายจ้าง',
                                    'htmlOptions'=>array('style'=>'text-align:left;width:50px;'),
                                    'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
                                ),			
                                array(
                                    'name'=>'business_name',
                                    'header' => 'ประเภทธุรกิจ',
                                    'htmlOptions'=>array('style'=>'text-align:left;width:130px;'),
                                    'headerHtmlOptions'=>array('style'=>'width:130px; text-align:center;'),
                                  ),					 
                                array(
                                    'name'=>'full_name',
                                    'header' => 'ชื่อ - สกุล',
                                    'htmlOptions'=>array('style'=>'text-align:left;width:150px;'),
                                    'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
                                ),
                                array(
                                    'name'=>'pid',
                                    'header' => 'เลขป.ช.ช./เลขทะเบียนพาณิชย์',
                                    'htmlOptions'=>array('style'=>'text-align:left;width:120px;'),
                                    'headerHtmlOptions'=>array('style'=>'width:120px; text-align:center;'),
                                ),			
                                array(
                                    'name'=>'bank_dep_id',
                                    'header' => 'รหัสสาขา',
                                    'htmlOptions'=>array('style'=>'text-align:center;width:90px;'),
                                    'headerHtmlOptions'=>array('style'=>' text-align:center;width:90px;'),
                                ),	
                                array(
                                    'name'=>'check_status',
                                    'header' => 'สถานะ',
                                    'htmlOptions'=>array('style'=>'text-align:center; width:20px;'),
                                    'headerHtmlOptions'=>array('style'=>'width:; text-align:center;width:20px;'),
                                ),		
                                array(
                                    'name'=>'bank_dep_name',
                                    'header' => 'ชื่อสาขา',
                                    'htmlOptions'=>array('style'=>'text-align:left; width:150px;'),
                                    'headerHtmlOptions'=>array('style'=>'width:; text-align:center;width:150px;'),
                                ),			
                                array(
                                    'name'=>'acc_type_id',
                                    'header' => 'ประเภทบัญชี',
                                    'htmlOptions'=>array('style'=>'text-align:center; width:50px;'),
                                    'headerHtmlOptions'=>array('style'=>'width:50px; text-align:center;'),
                                ),
                                array(
                                    'name'=>'acc_no',
                                    'header' => 'เลขที่บัญชี',
                                    'htmlOptions'=>array('style'=>'text-align:center; width:50px;'),
                                    'headerHtmlOptions'=>array('style'=>'width:50px; text-align:center;'),
                                ),				
                                array(
                                    'name'=>'acc_name',
                                    'header' => 'ชื่อบัญชี',
                                    'htmlOptions'=>array('style'=>'text-align:left; width:150px;'),
                                    'headerHtmlOptions'=>array('style'=>'width:; text-align:center;width:150px;'),
                                ),						  	
                                array(
                                    'name'=>'mark',
                                    'header' => 'เครื่องหมายจำนวนเงิน',
                                    'htmlOptions'=>array('style'=>'text-align:center; width:100px;'),
                                    'headerHtmlOptions'=>array('style'=>'width:; text-align:center;width:100px;'),
                                ),		
                                array(
                                    'name'=>'amont',
                                    'header' => 'จำนวนเงิน',
                                    'htmlOptions'=>array('style'=>'text-align:right;width:120px;'),
                                    'headerHtmlOptions'=>array('style'=>'width:120px; text-align:center;'),
                                ),			
                                array(
                                    'name'=>'request_date',
                                    'header' => 'วันเวลาที่ตรวจ',
                                    'htmlOptions'=>array('style'=>'text-align:center; width:50px;'),
                                    'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
                                ),					  
                                array(
                                    'name'=>'remark',
                                    'header' => 'หมายเหตุ',
                                    'htmlOptions'=>array('style'=>'text-align:left;'),
                                    'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
                                ),				  			  			
                            ),
                        ));		
                    ?>  
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
                                    
                                    <div style="clear:both;height:0px;"></div>
                                    
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
                    <div class="aa" hidden="hidden">
                        <input type="button" class="btn btn-danger" style="float:left;display:none;" onClick="setDelete();" value="ลบ"/>
                        <input type="button" class="btn btn-success" name="ok" style="float:right; margin-right:10px;" onClick="file_savedata();" value="บันทึก"/>   
                    </div>
                    <div style="clear:both;height:0px;"></div> 
                </div>
            </div>
    	</div> 
  	</div>


<script type="text/javascript">
//$('.empty').hide();
//$('.pager').hide();

function getDatagrid(elem){
	
	var code = $(elem).attr("id");
	var id_old = code;
	var grid='list-griddata'+code;
	//alert(grid);
	//return;
	var data = {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','code':code}; 
	$.fn.yiiGridView.update(grid, {
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("home/search2"); ?>',
		data: data,
	});
	//list-griddata61003
}
function setDetail(elem){
		
	//var id = $(elem).attr("id");
	//var code = $(elem).attr("name");
	var id = $(elem).attr("data-idbank"); 
	var code = $(elem).attr("data-value"); 
	//alert(id+code);
	$.ajax({
    	type: "POST",
    	url: "<?php  echo Yii::app()->createAbsoluteUrl("hisimport/Searchhead"); ?>",
  		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id,'code':code},
    	dataType: "json",				
		success: function (data) {
			if (data.status=='success') {
				$("#modaldetail").modal('show');
				$("#spcode").html(data.code);
				$("#spdoc_no").html(data.doc_no);
				$("#spdoc_date").html(data.doc_date);
				$("#spcreate_date").html(data.create_date);
				$("#spbank_id").html(data.bank_id);
				$("#spbank").html(data.name);
				//getSearch2(id,code);
				
			}else{
				alert(data.msg);
			} 
		}
	});
	//alert(id+code);
	
	var data = {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id,'code':code}; 
	$.fn.yiiGridView.update('list-grid', {
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("home/search"); ?>',
		data: data,
	});
	
	
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
						$(fileurl).attr('href',data.urlfile[i]+'/'+data.namefile[i]);
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


function addpaperclip2()
{
	var i = 0;
	var count = $('#hdfdataid').val();	
	if(count==''){
		count=0;
	}

	i = Number(count)+1;
	//alert(i);
	$('#elementId').append("<div data-ids='"+ i +"' class='paperclipupload"+ i +"'><input id='paperclip"+ i +"' type='file' accept='.pdf, .png, .jpg, .jpeg'  name='files[]' style='display:none;'><div class='uploaderProgress input-default upload"+ i +"' style='width:445px;border-radius: 6px 6px 6px 6px;'><span data-id='"+ i +"' title='ดาวน์โหลด' id='dwnload"+i+"' style='cursor: pointer;margin-right: 20px;'><a id='link"+i+"' target='_blank' class='link_empty'><i class='glyphicon glyphicon-download'></i></a></span><span id='name_file"+ i +"'></span></div><input type='hidden' id='hdffileid"+ i +"'><input type='hidden' id='hdffilename"+ i +"'><input type='hidden' id='hdffilesize"+ i +"'><input type='hidden' id='hdffiletype"+ i +"'></div><div id='progress"+ i +"' class='progress aa"+ i +"' style='width:344px;margin-left: 5px;'><div class='progress-bar'></div></div>");
	
	$('#hdfdataid').val(i);
	
}



</script>