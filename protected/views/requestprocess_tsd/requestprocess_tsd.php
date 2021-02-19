
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
    <div class="panel-heading">รายการประมวลผลแล้ว รอผลตรวจสอบ</div>
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
                </li>
            </ul>
        </div>
    </div>       
</div>       

 
<div class="panel panel-info">	
  	<div class="panel-body">
        <?php
		$img = Yii::app()->params['prg_ctrl']['url']['baseurl'].'/images/icon/';
		$aa = $img.'plus.png';
		$bb = $img.'warning.png';
		$cc = $img.'bleach.png';
		$dd = $img.'check.png';
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'list-grid',
            'dataProvider' => $model,
            'htmlOptions' => array('style' => 'margin: auto; width: 100%;'),
            'itemsCssClass' => 'table table-bordered table-striped',			
			'rowHtmlOptionsExpression'=>'array("data-id"=>$data["id"])',
			'summaryText' => "
							<!--div style='float:left;'>
								<img src='".$aa."' style='width:16px;'/>
								<span style='font-size:12px; margin-right:10px;'>รายการใหม่</span>
								<img src='".$bb."' style='width:16px;'/>
								<span style='font-size:12px; margin-right:10px;'>รอผล</span>
								<img src='".$cc."' style='width:16px;'/>
								<span style='font-size:12px; margin-right:10px;'>ข้อมูลไม่สมบูรณ์</span>
								<img src='".$dd."' style='width:16px;'/>
								<span style='font-size:12px; margin-right:10px;'>ตรวจสอบแล้ว</span>
							</div-->
							แสดงข้อมูล: {start} - {end} จาก {count} รายการ",			
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
                ),*/
				array(
					'name'=>'id',
					'header' => 'ลำดับ',					
					'htmlOptions'=>array('style'=>'text-align:center; width:20px;'),
					'headerHtmlOptions'=>array('style'=>'width:20px; text-align:center;vertical-align:middle;'),
				),	
				/*
				array(
					//'name'=>'active',
					'type' => 'html',
					'value' => array($this, 'getActive'),
					'header' => 'สถานะ',
					'htmlOptions'=>array(
						'style'=>'text-align:center;width:50px;'),
						//'class'=>function($data){return $data['status']==2?"abc":"yes";}),
					'headerHtmlOptions'=>array('style'=>'width:50px; text-align:center;'),
				),	
				*/	
				array(
					'name'=>'code',
					'header' => 'ชุดหนังสือ',					
					'htmlOptions'=>array('style'=>'text-align:center; width:30px;'),
					'headerHtmlOptions'=>array('style'=>'width:30px; text-align:center;vertical-align:middle;'),
				),/*
				array(
					'name'=>'docno_exp',
					'header' => 'เลขหนังสือ (ส่งออก)',					
					'htmlOptions'=>array('style'=>'text-align:center; width:80px;'),
					'headerHtmlOptions'=>array('style'=>'width:80px; text-align:center;'),
				),
				array(
					'name'=>'docdate_exp',
					'header' => 'วันที่หนังสือ (ส่งออก)',					
					'htmlOptions'=>array('style'=>'text-align:center; width:80px;'),
					'headerHtmlOptions'=>array('style'=>'width:80px; text-align:center;'),
				),		*/		  				  					
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
					'htmlOptions'=>array('style'=>'text-align:left;width:200px;'),
					'headerHtmlOptions'=>array('style'=>'width:200px; text-align:center;vertical-align:middle;'),
				),				 
				array(
					'name'=>'full_name',
					'header' => 'ชื่อ - สกุล',
					'htmlOptions'=>array('style'=>'text-align:left;width:200px;'),
					'headerHtmlOptions'=>array('style'=>'width:200px; text-align:center;vertical-align:middle;'),
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
					'htmlOptions'=>array('style'=>'text-align:left; width:150px;'),
					'headerHtmlOptions'=>array('style'=>'width:150px; text-align:center;vertical-align:middle;'),
			  	),
			 	array(
					'name'=>'depid_code',
					'header' => 'สังกัด',
					'htmlOptions'=>array('style'=>'text-align:center; width:30px;'),
					'headerHtmlOptions'=>array('style'=>'width:30px; text-align:center;vertical-align:middle;'),
			  	),	
				/*
			  	array(
					'name'=>'cnt',
					'header' => 'ตอบกลับจำนวน',
					'htmlOptions'=>array(
						'style'=>'text-align:center; width:80px;'),
						//'class'=>function($data){return $data['status']==2?"abc":"yes";}),
					'headerHtmlOptions'=>array('style'=>'width:80px; text-align:center;'),
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
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:90px;'),
                ),
				*/
            ),
        ));
        ?>
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
	/*
	$("#txtbirth").datepicker({		
		dateFormat: "dd/mm/yy"     
	});*/
	$("#txtbirth").attr("disabled", "disabled"); 
	$("#txtbirth").css('background-color', '#ccc');	 
	  $('#txtbirth').datepicker({
			format: 'dd/mm/yyyy',
			todayBtn: true,
			language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
			thaiyear: true              //Set เป็นปี พ.ศ.
		});  //กำหนดเป็นวันปัจุบัน		
	$('#btnbirth').click(function () {
			
			$("#txtbirth").removeAttr("disabled"); 
			$('#txtbirth').datepicker('show');
			$("#txtbirth").attr("disabled", "disabled"); 
			$("#txtbirth").css('background-color', '#ccc');

	});
		/*
	$("#txtdoc_date").datepicker({
		dateFormat: "dd/mm/yy" 
	});*/
	$("#txtdoc_date").attr("disabled", "disabled"); 
	$("#txtdoc_date").css('background-color', '#ccc');	 
	  $('#txtdoc_date').datepicker({
			format: 'dd/mm/yyyy',
			todayBtn: true,
			language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
			thaiyear: true              //Set เป็นปี พ.ศ.
		});  //กำหนดเป็นวันปัจุบัน		
	$('#btndocdate').click(function () {
			
			$("#txtdoc_date").removeAttr("disabled"); 
			$('#txtdoc_date').datepicker('show');
			$("#txtdoc_date").attr("disabled", "disabled"); 
			$("#txtdoc_date").css('background-color', '#ccc');

	});	
	$('#ch1').prop('checked', true);
	$('#ch2').prop('checked', true);
	$('#ch3').prop('checked', true);
	$('#ch4').prop('checked', true);
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
	var status1,status2,status3,status4;
	if($("#ch1").is(':checked')){ 
		status1 = '1';  
	}else{
		status1 = null;	
	}
	if($("#ch2").is(':checked')){
		status2 = '2';
	}else{
		status2 = null;
	}
	if($("#ch3").is(':checked')){
		status3 = '3';
	}else{
		status3 = null;
	}
	if($("#ch4").is(':checked')){
		status4 = '4';
	}else{
		status4 = null;
	}
		
	var data = {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','keyword': $('#txtdoc_code').val(),'acc_emp': $('#txtacc_emp').val(),'iden': $('#txtiden').val(),'status1':status1,'status2':status2,'status3':status3,'status4':status4}; 
	$.fn.yiiGridView.update('list-grid', {
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("requestprocess/search"); ?>',
		data: data,
	});
} 


</script>