
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
#bodyContainer, #footerContainer {
    clear: both;
    width: 100%;				
    min-width: 1820px;				
    margin: 0;
    padding: 0;
} 
.searchsection {
	width: 1480px;	
}

.abc{
	background-color:red;
	
}
.yes{
	background-color: #02FF3E;
	
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
	width:130px;
}
.txtlabel1{
	width:170px;
}
.txtlabel2{
	width:220px;
}
/*
ul.yiiPager .first, ul.yiiPager .last, ul.yiiPager .next, ul.yiiPager .previous {
	display: inline;
}
*/
.advs{
	display:none;
}
.hdf{
	display:none;
}
.hdf1{
	display:none;
}
.hdf2{
	display:none;
}
.txtcalendar{
    background: #fff none repeat scroll 0 0;
	height: 34px;	
}
.ipdisable{
	background-color: #CCC;
}

.btncalendar{
    background: #fff none repeat scroll 0 0;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
    color: #333;
    font-size: 16px;
    line-height: normal;
    margin: 0;
    padding: 7px;
    vertical-align: middle;
	border-radius: 2px 0px 0px 2px;
	margin-left:-40px;
	height: 34px;	
	
}
.btncalendar1{
    background: #fff none repeat scroll 0 0;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
    color: #333;
    font-size: 16px;
    line-height: normal;
    margin: 0;
    padding: 7px;
    vertical-align: middle;
	border-radius: 2px 0px 0px 2px;
	margin-left:-65px;
	height: 34px;	
}
.center {
    margin: auto;
	text-align: center;
    width: 80%;
   	
}

</style>  

<div class="panel panel-info searchsection" style="width:100%;">
    <div class="panel-heading">รายการที่ได้รับผลตรวจสอบบัญชีเงินฝากจากธนาคารแล้ว</div>
    <div class="panel-body sectioncontent">
        <div style="display:block;" class="center">
            <ul>            	
                <li style="list-style:none;">
                    <label class="">ชุดหนังสือ</label>
                    <input type="text" id='txtdoc_code' class="input-default" maxlength="5" style="width:100px; margin-left:20px;">
                    <label style="margin-left:20px;">เลขทะเบียนนายจ้าง</label> 
                    <input type="text" id='txtacc_emp' class="input-default" maxlength="15"  style="width:150px; margin-left:10px;"> 
                    <label style="margin-left:20px;">เลขประจำตัวประชาชน</label> 
                    <input type="text" id='txtiden' class="input-default" maxlength="13" style="width:150px; margin-left:20px;">              		
                    <span>
                        <button class="btn btn-primary" style="margin-left:10px;" onClick="getSearch()">
                            <i class="glyphicon glyphicon-search"></i>
                            ค้นหา
                    	</button> 
                    </span>
                </li>
                <li style="list-style:none;margin-top:5px;display:none;">   
                	<label style="margin-left:-370px;margin-right:40px;">สถานะรายการ</label>                  
                   	<input type="checkbox" id="ch1" style="margin-left:5px;" value="1"/><label style="margin-left:5px;">รายการใหม่</label>  
                   	<input type="checkbox" id="ch2" style="margin-left:15px;" value="2"/><label style="margin-left:5px;">รอผล</label> 
                   	<input type="checkbox" id="ch3" style="margin-left:15px;" value="3"/><label style="margin-left:5px;">ข้อมูลไม่สมบูรณ์</label>
                   	<input type="checkbox" id="ch4" style="margin-left:15px;" value="4"/><label style="margin-left:5px;">ตรวจสอบแล้ว</label>
                </li> <li style="list-style:none;clear:both"></li>
                <li style="list-style:none;">
                   	<input id="hdfstatus" type="hidden" />
                   	<input id="hdfid" type="hidden" />
                   	<input id="hdfremark" type="hidden" />
                    <input id="hdftype" type="hidden" />
                    <input id="hdfurl" type="hidden" value="<?php echo Yii::app()->params['prg_ctrl']['url']['baseurl']; ?>"/>
                </li>
            </ul>
        </div>
    </div>       
</div>       

 
<div class="panel panel-info">	
  	<div class="panel-body">
        <?php
		
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'list-grid',
            'dataProvider' => $model,
            'htmlOptions' => array('style' => 'margin: auto; width: 100%;'),
            'itemsCssClass' => 'table table-bordered table-striped',			
			'rowHtmlOptionsExpression'=>'array("data-id"=>$data["id"],"data-value"=>$data["code"])',
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
			/*		
				array(
                    'header' => '',
                    'class' => 'CLinkColumn',
                    'label' => '<i class="glyphicon glyphicon-pencil"></i>',
					'htmlOptions' => array(
                        'width' => '35px',
                        'align' => 'center',
						'onclick'=>'setUpdate(this);'
                    ),
					'linkHtmlOptions'=>array('class'=>'btn btn-info'),
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
                ),
				*/
				array(
					'name'=>'id',
					'header' => 'ลำดับ',					
					'htmlOptions'=>array('style'=>'text-align:center; width:20px;'),
					'headerHtmlOptions'=>array('style'=>'width:20px; text-align:center;vertical-align:middle;'),
				),	
			
				array(
					'name'=>'code',
					'header' => 'ชุดหนังสือ',					
					'htmlOptions'=>array('style'=>'text-align:center; width:30px;'),
					'headerHtmlOptions'=>array('style'=>'width:30px; text-align:center;vertical-align:middle;'),
				),
				array(
					'name'=>'docno_exp',
					'header' => 'เลขหนังสือ (ส่งออก)',					
					'htmlOptions'=>array('style'=>'text-align:center; width:80px;'),
					'headerHtmlOptions'=>array('style'=>'width:80px; text-align:center;vertical-align:middle;'),
				),
				array(
					'name'=>'docdate_exp',
					'header' => 'วันที่หนังสือ (ส่งออก)',					
					'htmlOptions'=>array('style'=>'text-align:center; width:80px;'),
					'headerHtmlOptions'=>array('style'=>'width:80px; text-align:center;vertical-align:middle;'),
				),				  				  					
				array(
					'name'=>'doc_no',
					'header' => 'เลขหนังสือ',
					'htmlOptions'=>array('style'=>'width:200px;'),
					'headerHtmlOptions'=>array('style'=>'width:200px; text-align:center;vertical-align:middle;'),
				),
				array(
					'name'=>'doc_date',
					'header' => 'วันที่หนังสือ',
					'htmlOptions'=>array('style'=>'text-align:center; width:30px;'),
					'headerHtmlOptions'=>array('style'=>'width:30px; text-align:center;vertical-align:middle;'),
				),			
				array(
					'name'=>'acc_employer',
					'header' => 'เลขนายจ้าง',
					'htmlOptions'=>array('style'=>'text-align:left;width:50px;'),
					'headerHtmlOptions'=>array('style'=>'width:50px; text-align:center;vertical-align:middle;'),
				),			
				array(
					'name'=>'business_name',
					'header' => 'ประเภทธุรกิจ',
					'htmlOptions'=>array('style'=>'text-align:left;width:300px;'),
					'headerHtmlOptions'=>array('style'=>'width:300px; text-align:center;vertical-align:middle;'),
				),				 
				array(
					'name'=>'full_name',
					'header' => 'ชื่อ - สกุล',
					'htmlOptions'=>array('style'=>'text-align:left;width:150px;'),
					'headerHtmlOptions'=>array('style'=>'width:150px; text-align:center;vertical-align:middle;'),
				),
				array(
					'name'=>'pid',
					'header' => 'เลขป.ช.ช / เลขทะเบียนพาณิชย์',
					'htmlOptions'=>array('style'=>'text-align:left; width:130px;'),
					'headerHtmlOptions'=>array('style'=>'width:130px; text-align:center;vertical-align:middle;'),
				),
				array(
					'name'=>'birth',
					'header' => 'วันเกิด',
					'htmlOptions'=>array('style'=>'text-align:left; width:80px;'),
					'headerHtmlOptions'=>array('style'=>'width:80px; text-align:center;vertical-align:middle;'),
			  	),				  				 	
			  	array(
					'name'=>'address',
					'header' => 'ที่อยู่',
					'htmlOptions'=>array('style'=>'text-align:left;width:800px'),
					'headerHtmlOptions'=>array('style'=>'width:800px;text-align:center;vertical-align:middle;'),
				),
			  	array(
					'name'=>'create_date',
					'header' => 'วันที่บันทึก',
					'htmlOptions'=>array('style'=>'text-align:left;width:30px;'),
					'headerHtmlOptions'=>array('style'=>'width:30px; text-align:center;vertical-align:middle;'),
			  	),				  
			  	array(
					'name'=>'firstname',
					'header' => 'เจ้าของเรื่อง',
					'htmlOptions'=>array('style'=>'text-align:left; width:120px;'),
					'headerHtmlOptions'=>array('style'=>'width:120px; text-align:center;vertical-align:middle;'),
			  	),
			 	array(
					'name'=>'depid_code',
					'header' => 'สังกัด',
					'htmlOptions'=>array('style'=>'text-align:center; width:30px;'),
					'headerHtmlOptions'=>array('style'=>'width:30px; text-align:center;vertical-align:middle;'),
			  	),	
			  	array(
					'name'=>'cnt',
					'header' => 'ตอบกลับจำนวน',
					'htmlOptions'=>array(
						'style'=>'text-align:center; width:80px;'),
						//'class'=>function($data){return $data['status']==2?"abc":"yes";}),
					'headerHtmlOptions'=>array('style'=>'width:80px; text-align:center;vertical-align:middle;'),
			  	),			  		
				array(
                    'header' => 'ผลการตรวจสอบ',
                    'class' => 'CLinkColumn',
                    'label' => '<i class="glyphicon glyphicon-list-alt"></i>',
					'htmlOptions' => array(
                        'width' => '90px',
                        'align' => 'center',	
						'style'=>'text-align:center;',					
						'onclick'=>'getHeaddetail(this);'
                    ),
					'linkHtmlOptions'=>array('class'=>'btn btn-success'),
					'headerHtmlOptions'=>array('style'=>'text-align:center;vertical-align:middle;width:90px;'),
                ),
            ),
        ));
        ?>
    </div>
</div>
    




<!-- รายละเอียด -->

<div id="modalshow" class="modal fade" aria-hidden="true" aria-labelledby="modaldetailLabel" role="dialog" tabindex="-1">
    <div class="modal-dialog" style="width: 90%; margin-top:18px;">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px 20px 7px;">
                <button class="close" data-dismiss="modal" type="button">
                	<span aria-hidden="true">×    <span class="sr-only">Close</span>
                </button>
                <h1 id="modalLabel" class="modal-title">ผลการตรวจสอบบัญชีเงินฝาก</h1>
            </div>            
            <div class="modal-body" style="margin-top:-10px;">    
              	<div>
                    <div align='left' style='border-bottom:1px solid #ccc;'>
                        <label class="txtlabel">ลำดับที่ :</label>
                        <label class="" id="lbid" style="width:100px;"></label>    
                        <label class="txtlabel">ชุดหนังสือ :</label>
                        <label class="" id="lbcode"></label>
                        <label class="" style="margin-left:100px;">วันที่หนังสือ(ส่งออก) :</label>
                        <label class="" id="lbdate"></label>                       
                    </div>                        
                    <div align='left' style='border-bottom:1px solid #ccc; margin-top:10px;'>
                       <label class="txtlabel">เลขที่บัญชีนายจ้าง :</label>
                       <label class="" id="lbacc_emp" style="width:100px;"></label>
                       <label class="" style="margin-left:50px;">คำนำหน้าชื่อ/ประเภทธุรกิจ :</label>
                       <label class="" id="lbbname"></label>
                       <label class="" style="margin-left:50px;">ชื่อ - สกุล :</label>
                       <label class="" id="lbfullname"></label>
                        <label class="" style="margin-left:100px;">เลขป.ช.ช / เลขทะเบียนพาณิชย์ :</label>
                        <label class="" id="lbpid"></label>
                    </div>
            		                      
            	</div>
					<?php
					
                    $this->widget('zii.widgets.grid.CGridView', array(
                        'id' => 'list-griddetail',
                        'dataProvider' => $modeldetail,
                        'htmlOptions' => array('width' => '1200px'),
                        'itemsCssClass' => 'table table-bordered table-striped',	
                        'rowHtmlOptionsExpression'=>'array("data-id"=>$data["id"])',
                        'summaryText' => 'แสดงข้อมูล: {start} - {end} จาก {count} รายการ',
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
                                'name'=>'bank_name',
                                'header' => 'ชื่อธนาคาร',
                                'htmlOptions'=>array('style'=>'text-align:left;width:200px;'),
                                'headerHtmlOptions'=>array('style'=>'text-align:center;vertical-align:middle;width:150px;'),
                              ),
						  array(
							'name'=>'bank_id',
							'header' => 'รหัสธนาคาร',
							'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
							'headerHtmlOptions'=>array('style'=>'text-align:center;vertical-align:middle;width:50px;'),
						  ),
                            array(
                                'name'=>'bank_dep_id',
                                'header' => 'รหัสสาขา',
                                'htmlOptions'=>array('style'=>'text-align:center;width:80px;'),
                                'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
                              ),
                            array(
                                'name'=>'bank_dep_name',
                                'header' => 'ชื่อสาขา',
                                'htmlOptions'=>array('style'=>'text-align:left;'),
                                'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
                              ),						 
                            array(
                                'name'=>'acc_type',
                                'header' => 'ประเภทบัญชี',
                                'htmlOptions'=>array('style'=>'text-align:center;width:80px;'),
                                'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
                              ),
                            
                            array(
                                'name'=>'acc_no',
                                'header' => 'เลขที่บัญชี',
                                'htmlOptions'=>array('style'=>'text-align:left;'),
                                'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
                              ),
                            array(
                                'name'=>'acc_name',
                                'header' => 'ชื่อบัญชี',
                                'htmlOptions'=>array('style'=>'text-align:left;'),
                                'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
                              ),
							 
                            array(
                                'name'=>'mark',
                                'header' => 'เครื่องหมายจำนวนเงิน',
                                'htmlOptions'=>array('style'=>'text-align:center;width:100px;'),
                                'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
                              ),	
							 								
                             array(
                                'name'=>'amont',
                                'header' => 'จำนวนเงินคงเหลือ',
                                'htmlOptions'=>array('style'=>'text-align:right;'),
                                'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
                              ),
                              array(
                                'name'=>'request_date',
                                'header' => 'วันเวลาที่ตรวจ',
                                'htmlOptions'=>array('style'=>'text-align:center;'),
                                'headerHtmlOptions'=>array('style'=>'width:90px; text-align:center;vertical-align:middle;'),
                              ),
                            array(
                                'name'=>'check_status',
                                'header' => 'สถานะ',
                                'htmlOptions'=>array('style'=>'text-align:center;width:40px;'),
                                'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
                              ),
                              array(
                                'name'=>'remark',
                                'header' => 'หมายเหตุ',
                                'htmlOptions'=>array('style'=>'text-align:left;'),
                                'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
                              ),
                        ),
                    ));
                    ?>
                      
            </div>
            <div class="modal-footer" style="padding: 7px 20px">
                <h3 id="errmodaldetail" class="sectionError"></h3>
                <div class="sectionButton"> 
                	<Button id="btpt"class="btn btn-success" data-dismiss="modal" Width="100px;" onClick="gotopagepdf();"><i class="glyphicon glyphicon-print"></i> พิมพ์</Button>                   
                    <Button ID="btcledit"class="btn btn-default" data-dismiss="modal" Width="80px">ย้อนกลับ</Button>
                </div>
       		</div>
        </div>
    </div>
</div>
<div id="modalpaper" class="modal fade" aria-hidden="true" aria-labelledby="modaldetailLabel" role="dialog" tabindex="-1">
    <div class="modal-dialog" style="width:850px; margin-top:300px;">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px 20px 7px;">
                <button class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">×    <span class="sr-only">Close</span>
                </button>
                <h1 id="modalpaperLabel" class="modal-title">ดาวน์โหลดไฟล์แนบ</h1>
            </div>
            <div class="modal-body"> 
                <div style="clear:both;height:0px;">
                    <input type="hidden" id="hdfname" />             
                    <input type="hidden" id="hdffiletotal" />
                    <input type="hidden" id="hdfdataid" />
                    <input type="hidden" id="hdfdcntrmv" />               
                </div>
                <ul>                   
                    
                    <li style="list-style:none;height:0px;clear:both;"></li>  
                    <li style="list-style:none; margin-top:10px;">
                        
                        <div id="elementId" style="float:left;width:85%;padding-left:60px;"></div>                        
                        <div style="clear:both;height:0px;"></div>
                                
                                           
                    </li>                  
                </ul> 
            </div>
            
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
$('#hdftype').val("<?php echo Yii::app()->params['data_type']['type']['type_id']; ?>");
jQuery(document).ready(function ($) {
	$('#modaldetail').on('show.bs.modal', function (e) {
				
            });
	$('#modaldetail').on('hidden.bs.modal', function (e) {       
		$(".advs").css("display", "none");
		$('#txtremark').val('');
	});
	
	$("#txtdoc_code").keyup(function (e) {
		if (e.keyCode == 13) {getSearch();}
	});
	$("#txtacc_emp").keyup(function (e) {
		if (e.keyCode == 13) {getSearch();}
	});
	$("#txtiden").keyup(function (e) {
		if (e.keyCode == 13) {getSearch();}
	});
	
});

function getSearch() {
	
		
	var data = {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','keyword': $('#txtdoc_code').val(),'acc_emp': $('#txtacc_emp').val(),'iden': $('#txtiden').val()}; 
	$.fn.yiiGridView.update('list-grid', {
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("requestresult/search"); ?>',
		data: data,
	});
} 


function ajax_savedata() {
	if($('#txtdoc_no').val()==''){
		alert('กรุณากรอกเลขที่หนังสือ');
		return;
	}
	if($('#txtdoc_date').val()==''){
		alert('กรุณากรอกวันที่หนังสือ');
		return;
	}
	if($('#txtacc_employer').val()==''){
		alert('กรุณากรอกเลขที่บัญชีนายจ้าง');
		return;
	}	
	//var ck_acc_employer = $('#txtacc_employer').val().length;
	if($('#txtacc_employer').val().length<10){
		alert('กรุณากรอกเลขที่บัญชีนายจ้างให้ครบ');
		return;
	}	
	if($('#drpid').val()==''){
		alert('กรุณาเลือก บุคคล / นิติบุคคล');
		return;
	}else{		
		if($('#drppid').val()==1){
			if($('#drptype').val()==''){
				alert('กรุณาเลือกคำนำหน้าชื่อ');
				return;
			}
			if($('#drptype').val()==$('#hdftype').val()){
				if($('#txtbusiness_name').val()==''){
					alert('กรุณากรอกคำนำหน้าชื่อ');
					return;
				}
			}
			if($('#txtname').val()==''){
				alert('กรุณากรอกชื่อ');
				return;
			}
			if($('#txtlname').val()==''){
				alert('กรุณากรอกนามสกุล');
				return;
			}
			
			if($('#txtpid').val()==''){
				alert('กรุณากรอกเลขบัตรประจำตัวประชาชน');
				return;
			}
			var ck_txtpid = $('#txtpid').val().length;
			if(ck_txtpid<13){
				alert('กรุณากรอกเลขบัตรประจำตัวประชาชนให้ครบ');
				return;
			}
			
		}else{
			if($('#drptype').val()==''){
				alert('กรุณาเลือกประเภทธุรกิจ');
				return;
			}
			if($('#drptype').val()==$('#hdftype').val()){
				if($('#txtbusiness_name').val()==''){
					alert('กรุณากรอกชื่อประเภทธุรกิจ');
					return;
				}
			}
			if($('#txtcid').val()==''){
				alert('กรุณากรอกเลขทะเบียนนิติบุคคล');
				return;
			}
			if($('#txtcompany_name').val()==''){
				alert('กรุณากรอกชื่อสถานประกอบการ');
				return;
			}			
			
		}
	}
	
	if($('#txtaddress').val()==''){
		alert('กรุณากรอกที่อยู่');
		return;
	}
	
	var id=$('#hdfid').val();
	var doc_no=$('#txtdoc_no').val();
	var acc_employer=$('#txtacc_employer').val();
	var pid_type=$('#drppid').val();//บุคคลข-นิติ
	var business_type=$('#drptype').val();//ประเภทธุรกิจข-คำนำหน้าชื่อ
	var business_name=$('#txtbusiness_name').val();//กรณีที่เลือก อื่น ๆ 
	//บุคคล
	var name = $('#txtname').val();			
	var lname = $('#txtlname').val();
	var bb = $('#txtbirth').val();
	var pid = $('#txtpid').val();
	//นิติ
	var company = $('#txtcompany_name').val();
	var cid = $('#txtcid').val();
	
	var address=$('#txtaddress').val();	
	var aa=$('#txtdoc_date').val();
		
	var bbb = ex_date2db(bb);	
	var aaa = ex_date2db(aa);
	
	
	
	var aaDate = new Date(aaa)
	var aaMonth = ((aaDate.getMonth().length+1) === 1)? (aaDate.getMonth()+1) : + (aaDate.getMonth()+1); 
	var doc_date = (aaDate.getFullYear()-543) + "-" + aaMonth + "-" + aaDate.getDate();
	
	var bbDate = new Date(bbb)
	var bbMonth = ((bbDate.getMonth().length+1) === 1)? (bbDate.getMonth()+1) : + (bbDate.getMonth()+1); 
	var birth = (bbDate.getFullYear()-543) + "-" + bbMonth + "-" + bbDate.getDate();
	//alert(doc_date);
	//return;
	
		if(doc_date=='NaN-NaN-NaN'){
			doc_date=null;			
		}
		if(birth=='NaN-NaN-NaN'){
			birth=null;			
		}
	
	<?php if(Yii::app()->user->getInfo('userlevel_id')=='1') { ?>
	
	
	
		var active = $('#radio_request').val();	
		if($('#radio_request').is(':checked')){
			active =3;
		}else{
			active =1;
		}
		
		var remark = $('#txtremark').val();
		
		
		
	<?php }else{ ?>
	
		var active = 1;	
		var remark ='';
		<?php } ?>
	
	/*
	if(status==3){		
		if ($('#radio_request').is(':checked')) {
			var active = $('#radio_request').val();	
			var remark = $('#txtremark').val();	
		}else{
			$(".advs").css("display", "none");
			$("#radio_request").val('1');
		}
	}
	*/
	
    $.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl("requestresult/savedata"); ?>",
		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'id':id,
				'doc_no':doc_no,'acc_employer':acc_employer,'pid_type':pid_type,'business_type':business_type,
				'business_name':business_name,'name':name,'lname':lname,'birth':birth,'pid':pid,'cid':cid,
				'company':company,'address':address,'doc_date':doc_date,'active':active,'remark':remark
		},
		dataType: "json",				
		success: function (data) {
			if (data.status=='success') {	
				$('#txtdoc_no').val('');
				$('#txtdoc_date').val('');
				$('#txtacc_employer').val('');		
				$('#drppid').val('');				
				$('#txtremark').val('');
				advs();
				//typeselect();
				getSearch();
				//alert('บันทึกข้อมูลเรียบร้อยแล้ว');
				$("#modaldetail").modal('hide');
			}
			else{
				alert(data.msg);
			} 
		}
	});
}	

function typeselect(type){	 
	var id = $('#drppid').val();	
	
	if(id==''){
		$(".hdf").css("display", "none");
		$(".hdf1").css("display", "none");
		$(".hdf2").css("display", "none");
		$(".hdf3").css("display", "none");
		$(".hdf4").css("display", "none");
		$('#txtbusiness_name').val('');
		$('#txtname').val('');			
		$('#txtlname').val('');
		$('#txtbirth').val('');
		$('#txtpid').val('');
		$('#txtcompany_name').val('');
		$('#txtcid').val('');
		$('#txtaddress').val('');	
		return;
	}else{
		if(id==1){
			$(".hdf").css("display", "block");
			$(".hdf2").css("display", "none");
			$(".hdf3").css("display", "block");
			$(".hdf4").css("display", "block");
			$("#txttype").html("คำนำหน้าชื่อ : <font color='red'>*</font>");		
		}else{
			$(".hdf").css("display", "block");
			$(".hdf2").css("display", "block");
			$(".hdf3").css("display", "none");
			$(".hdf4").css("display", "block");
			$("#txttype").html("ประเภทธุรกิจ : <font color='red'>*</font>");
		}
		$('#txtname').val('');			
		$('#txtlname').val('');
		$('#txtbirth').val('');
		$('#txtpid').val('');
		$('#txtcompany_name').val('');
		$('#txtcid').val('');
		$('#txtaddress').val('');		
	}	
	$.ajax({
    	type: "POST",
    	url: "<?php echo Yii::app()->createAbsoluteUrl("requestresult/selecttype"); ?>",
  		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id},
    	dataType: "json",				
    	success: function (data) {
			if (data.status=='success') {
				//alert(data.data);
				$("#drptype").empty();
				$('#drptype').append('<option value="">--เลือก--</option>');
				var _object = data.data;
					for(var i in _object){
						$("#drptype").append("<option value='" + _object[i]['id'] + "'>" + _object[i]['name'] + "</option>");
					}			
				if(type!=null){
					$("#drptype").val(type);
				}			
			}else{
				alert(data.msg);
			} 
		}
	});	
}

function hdf(){		
	var id = $('#drppid').val();
	var type = $('#drptype').val();	
	if(type==$('#hdftype').val()){	
		$(".hdf1").css("display", "block");
		if(id==1){				
			$("#txtbusiness_name").attr("placeholder", "เช่น ดร.,นพ.").val("").focus().blur();
		}else{				
			$("#txtbusiness_name").attr("placeholder", "เช่น บริษัท จำกัด").val("").focus().blur();
			//$(".hdf2").css("display", "block");
		}		
	}else{
		$(".hdf1").css("display", "none");
	}	
}

function advs() {
	//var aa = $('#radio_request').val();
	if ($('#radio_request').is(':checked')) {
		$(".advs").css("display", "block");
	}else{
		$(".advs").css("display", "none");
		$("#radio_request").val('1');
	}
}

function setUpdate(el){
	var id = $(el).attr("data-id"); 
	var bank_id = $(el).attr("data-idbank"); 
	var code = $(el).attr("data-value");
	//alert(bank_id);
	
	$('#hdfdataid').val('');
	$('#elementId').html('');
	$('#hdfdcntrmv').val('');
	$('#divrmv').html('');
	$('#divtrnidfile').html('');
	$('#errupload').text('');
	
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
				//$('#modalpaper').modal('show');
	//return;
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
function getHeaddetail(el) {
	var id = $(el).parent().attr("data-id"); 
	var code = $(el).parent().attr("data-value"); 
	//alert(code+'-'+id);return;
	
	//alert(id);
	var data = {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>', 'id': id, 'code': code}; 
	$.fn.yiiGridView.update('list-griddetail', {
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("requestresult/searchdetail"); ?>',
		data: data,
	});	
	
	$.ajax({
    	type: "POST",
    	url: "<?php  echo Yii::app()->createAbsoluteUrl("requestresult/Searchhead"); ?>",
  		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id},
    	dataType: "json",				
		success: function (data) {
			if (data.status=='success') {
				$('#lbcode').html(data.code);
				$('#lbdate').html(data.doc_date);
				$('#lbacc_emp').html(data.acc_employer);
				$('#lbid').html(data.id);
				$('#lbbname').html(data.business_name);
				$('#lbfullname').html(data.full_name);
				$('#lbpid').html(data.pid);
				//$("#modalshow").modal('show');			
				//setDetail(id);
				$('#hdfid').val(id);
				$("#modalshow").modal('show');	
			}else{
				alert(data.msg);
			} 
		}
	});	
}
function setDetail(id) {	

	
	
	$("#modalshow").modal('show');	
}

function setDelete() {
	var id = $('#hdfid').val();
	//alert(id);
	var r = confirm("คุณต้องการลบข้อมูลนี้ใช่หรือไม่ !");
	
    if (r == true) {
	 $.ajax({
    	type: "POST",
    	url: "<?php  echo Yii::app()->createAbsoluteUrl("requestresult/deletedata"); ?>",
  		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id},
    	dataType: "json",				
		success: function (data) {
			if (data.status=='success') {
				//alert('ลบเรียบร้อย');
				$("#modaldetail").modal('hide');
				getSearch();
				//getSearchdetail();			
				
			}else{
				alert(data.msg);
			} 
		}
	});
  }
}
function clearcalendar(){
	$('#txtdoc_date').val('');
}
function clearcalendar1(){
	$('#txtbirth').val('');
}
function gotopagepdf(){
	var id = $('#hdfid').val(); 
		
	var url = $('#hdfurl').val();	
	url = url+"/requestresult/rpt_request?id="+id;
	window.open(url, '_blank');
	
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
	$('#elementId').append("<div data-ids='"+ i +"' class='paperclipupload"+ i +"'><input id='paperclip"+ i +"' type='file' accept='.pdf, .png, .jpg, .jpeg'  name='files[]' style='display:none;'><div class='uploaderProgress input-default upload"+ i +"' style='width:645px;border-radius: 6px 6px 6px 6px;'><span data-id='"+ i +"' title='ดาวน์โหลด' id='dwnload"+i+"' style='cursor: pointer;margin-right: 20px;'><a id='link"+i+"' target='_blank' class='link_empty'><i class='glyphicon glyphicon-download'></i></a></span><span id='name_file"+ i +"'></span></div><input type='hidden' id='hdffileid"+ i +"'><input type='hidden' id='hdffilename"+ i +"'><input type='hidden' id='hdffilesize"+ i +"'><input type='hidden' id='hdffiletype"+ i +"'></div>");
	
	$('#hdfdataid').val(i);
	
}
</script>