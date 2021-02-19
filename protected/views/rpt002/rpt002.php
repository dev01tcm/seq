
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
	width:130px;
}
/*
ul.yiiPager .first, ul.yiiPager .last, ul.yiiPager .next, ul.yiiPager .previous {
	display: inline;
}
*/

</style>  

<div class="panel panel-info">
    <div class="panel-heading">ผลการสอบทรัพย์บัญชีธนาคาร แยกนายจ้าง</div>
    <div class="panel-body sectioncontent">
        <div style="width:800px; display:block; margin:0 auto;">
        <ul>
            <li style="list-style:none;">
                <label class="txtlabel">เลขชุดหนังสือ</label>
                <input type="text" id='txtdocument_no' class="input-default" style="width:300px;" maxlength="5">
            </li>
            <li style="list-style:none; margin-top:15px">
                <label class="txtlabel">เลขบัญชีนายจ้าง</label>
                <input type="text" id='txtemployer_no' class="input-default" style="width:300px;" maxlength="10">
            </li>
            <li style="list-style:none; margin-top:15px">
                <label class="txtlabel">เลขป.ช.ช/เลขทะเบียนพาณิชย์</label>
                <input type="text" id='txtcommercial_no' class="input-default" style="width:300px;" maxlength="15">               
            </li>
            <li style="list-style:none; margin-top:15px">
               <input id="hdfstatus" type="hidden" />
               <input id="hdfurl" type="hidden" value="<?php echo Yii::app()->params['prg_ctrl']['url']['baseurl']; ?>"/>
            </li>
        </ul>
        </div>
        
        <div class="panel-body sectionctrl">
        	<div style="float:right;">
                 <a class="btn btn-primary" style="float:left;margin-right:10px;" onClick="gotopagepdf()">
                    <i class="glyphicon glyphicon-export"></i>
                    ออกรายงาน
                </a>    
            </div>
            <div style="clear:both;height:0px;"></div>
        </div>
    </div>  
</div>       

 <?php
 /*
<div class="panel panel-info">
    <div class="panel-body">
        
		
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'list-grid',
            'dataProvider' => $model,
            'htmlOptions' => array('width' => '500px'),
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
					'name'=>'NO',
					'header' => 'ลำดับ',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
					'headerHtmlOptions'=>array('style'=>'width:50px; text-align:center;vertical-align:middle;'),
				  ),					
				 array(
					'name'=>'code',
					'header' => 'ชุดหนังสือ',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px;'),
					'headerHtmlOptions'=>array('style'=>'width:100px; text-align:center;vertical-align:middle;'),
				  ),	
				  array(
					'name'=>'acc_employer',
					'header' => 'เลขบัญชีนายจ้าง',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
				  ),		
				  array(
					'name'=>'business_name',
					'header' => 'ประเภทธุรกิจ',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'width:150px; text-align:center;vertical-align:middle;'),
				  ),				 
				  array(
					'name'=>'name',
					'header' => 'ชื่อ - สกุล',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'text-align:center;vertical-align:middle;'),
				  ),			
				  array(
					'name'=>'pc_id',
					'header' => 'เลขป.ช.ช / เลขทะเบียนพาณิชย์',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'width:200px; text-align:center;vertical-align:middle;'),
				  ),
				  array(
					'name'=>'doc_date',
					'header' => 'วันที่ส่งออกข้อมูล',
					'htmlOptions'=>array('style'=>'text-align:center;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
				  ),
				 array(
					//'name'=>'',
					'type' => 'html', 
					'value' => function($data){ 
						if(1==1){
							$img = Yii::app()->params['prg_ctrl']['url']['baseurl'].'/images/icon/';
							$pdf = $img.'pdf.png';
							$excel = $img.'excel.png';
							echo '<label id="btncnt" style="color:#5DBBFF;" data-value="'.$data['code'].'" data-id="" onclick="getPdf(this)"><a href="#" title="ดาวน์โหลด PDF"><img src="'.$pdf.'" width="25px;"></a></label>';
							echo '<label id="btncnt" style="color:#5DBBFF; margin-left:10px;" data-value="'.$data['code'].'" data-id="" onclick="getExcel(this)"><a href="#" title="ดาวน์โหลด EXCEL"><img src="'.$excel.'" width="30px;"></a></label>';				
													
						}
					},
					'header' => 'ออกรายงาน',
					'htmlOptions'=>array('style'=>'text-align:center; width:150px;'),
					'headerHtmlOptions'=>array('style'=>'width:150px; text-align:center;'),
				),					  	
            ),
        ));
		
        
    </div>
</div>
    
*/
?>
<script type="text/javascript">
jQuery(document).ready(function ($) {
});

function getSearch() {
	if($('#txtdocument_no').val()==""){		
		alert("กรุณากรอกเลขชุดหนังสือ");
		return;
	}
	if($('#txtemployer_no').val()==""){		
		alert("กรุณากรอกเลขบัญชีนายจ้าง");
		return;
	}
	if($('#txtdocument_no').val()==""){		
		alert("กรุณากรอกเลขป.ช.ช/เลขทะเบียนพาณิชย์");
		return;
	}
	var doc_no = $('#txtdocument_no').val();
	var emp_no = $('#txtemployer_no').val();
	var people_no = $('#txtcommercial_no').val();
	//alert(doc_no);
	var data = {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>', 'doc_no': doc_no, 'emp_no': emp_no, 'people_no': people_no}; 
	$.fn.yiiGridView.update('list-grid', {
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("rpt002/search"); ?>',
		data: data,
	});
}
function gotopagepdf(){
	if($('#txtdocument_no').val()==""){		
		alert("กรุณากรอกเลขชุดหนังสือ");
		return;
	}
	/*
	if($('#txtemployer_no').val()==""){		
		alert("กรุณากรอกเลขบัญชีนายจ้าง");
		return;
	}
	if($('#txtdocument_no').val()==""){		
		alert("กรุณากรอกเลขป.ช.ช/เลขทะเบียนพาณิชย์");
		return;
	}*/
	var doc_no = $('#txtdocument_no').val();
	var emp_no = $('#txtemployer_no').val();
	var people_no = $('#txtcommercial_no').val();
	if(emp_no=="" && people_no==""){
		alert("กรุณากรอกเลขบัญชีนายจ้าง หรือ กรอกเลขป.ช.ช/เลขทะเบียนพาณิชย์");
		return;
	}
	$('#txtdocument_no').val('');
	$('#txtemployer_no').val('');
	$('#txtcommercial_no').val('');
	var url = $('#hdfurl').val();
	url = url+"/rpt002/rpt002pdf/?doc_no="+doc_no+'&emp_no='+emp_no+'&people_no='+people_no;
	window.open(url, '_blank');	
	
}
</script>