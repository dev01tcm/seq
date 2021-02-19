
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
	width:80px;
}
/*
ul.yiiPager .first, ul.yiiPager .last, ul.yiiPager .next, ul.yiiPager .previous {
	display: inline;
}
*/

</style>  

<div class="panel panel-info">
    	<div class="panel-heading">รายละเอียดการส่งออกไฟล์เพื่อขอตรวจสอบบัญชีเงินฝาก</div>    
       	<div style="margin-top:20px;">
        	<ul>
            	<li style="list-style:none;">
					<span>ชุดหนังสือ :<?php echo $code; ?></span>
                    <span style="margin-left:20px;">เลขหนังสือ : <?php echo $doc_no; ?></span>
           		</li>                
                <li style="list-style:none;">
                	<div>
                        สามารถดาวน์โหลดไฟล์ได้ที่นี่                   
                        <a style="margin-right:10px;" href="<?php echo $file_name ?>" target="_blank">
                            คลิก
                        </a>	
                    </div>
                    <div align="center" style=" float:right; margin-top:-50px;">
                    	<a role="menuitem" class="btn btn-default" tabindex="-1" href="<?php echo Yii::app()->createUrl('hisinvestigate'); ?>">ย้อนกลับ</a>	
                    </div>			
           		</li>                        	
            </ul>
      	</div>    
    	<div class="panel-body" style="margin-top:-50px;">
			<?php
		
				$this->widget('zii.widgets.grid.CGridView', array(
					'id' => 'list-grid',
					'dataProvider' => $modelform,
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
					/*
					'id', 'code','doc_no','doc_date','acc_employer','business_type','cid','prefix','lname',
							 'pid','name','address','status','birth','remark',	
							 */           		
					'columns' => array(
						
					array(
							'name'=>'code',
							'header' => 'ชุดหนังสือ',					
							'htmlOptions'=>array('style'=>'text-align:center; width:30px;'),
							'headerHtmlOptions'=>array('style'=>'width:90px; text-align:center;'),
						  ),					
						 array(
							'name'=>'doc_no',
							'header' => 'เลขหนังสือ',
							'htmlOptions'=>array('style'=>'text-align:left; width:100px;'),
							'headerHtmlOptions'=>array('style'=>'text-align:center; width:110px;'),
						  ),
						  array(
							'name'=>'doc_date',
							'header' => 'วันที่หนังสือ',
							'htmlOptions'=>array('style'=>'text-align:center; width:30px;'),
							'headerHtmlOptions'=>array('style'=>'text-align:center; width:100px;'),
						  ),			
						  array(
							'name'=>'acc_employer',
							'header' => 'เลขที่บัญชีนายจ้าง',
							'htmlOptions'=>array('style'=>'text-align:left;width:50px;'),
							'headerHtmlOptions'=>array('style'=>'width:140px; text-align:center;'),
						  ),			
						  array(
							'name'=>'business_name',
							'header' => 'คำนำหน้าชื่อ/ ประเภทธุรกิจ',
							'htmlOptions'=>array('style'=>'text-align:left;width:130px;'),
							'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
						  ),				 
						  array(
							'name'=>'full_name',
							'header' => 'ชื่อ - สกุล',
							'htmlOptions'=>array('style'=>'text-align:left;width:200px;'),
							'headerHtmlOptions'=>array('style'=>'width:200px; text-align:center;'),
						  ),
						  array(
							'name'=>'pid',
							'header' => 'เลขป.ช.ช./เลขทะเบียนพาณิชย์',
							'htmlOptions'=>array('style'=>'text-align:left;width:150px;'),
							'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
						  ),				 	
						  array(
							'name'=>'address',
							'header' => 'ที่อยู่',
							'htmlOptions'=>array('style'=>'text-align:left;'),
							'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
						  ),
						  array(
							'name'=>'birth',
							'header' => 'วันเกิด',
							'htmlOptions'=>array('style'=>'text-align:center; width:100px;'),
							'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
						  ),
						   array(
							'name'=>'create_date',
							'header' => 'วันที่ส่งออก',
							'htmlOptions'=>array('style'=>'text-align:center; width:100px;'),
							'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
						  ),
					),
				));
				
			   ?>
            </div>
           <div class="panel-body sectionctrl">
            <div align="center">
                            
                 
                 
            </div>
            <div style="clear:both;height:0px;"></div>
        </div>
    </div>        


<script type="text/javascript">
jQuery(document).ready(function ($) {	
$('Button[id=btnadd]').click(function () {
	$("#modaldetailLabel").html("เพิ่มข้อมูล");                
	$("#modaldetail").modal('show');
		//$('#hdfstatus').val('add');
		//$('#id').val('');
		//$('#name').val('');
		//$('#status').val('');
            });
     $('#modaldetail').on('show.bs.modal', function (e) {
					
            });
     $('#modaldetail').on('hidden.bs.modal', function (e) {       
		$('#txtcode').val('');
		$('#txtname').val('');	
		$('#txtaddress').val('');
		$('#txtemail').val('');
		
            });



	$("#txtkeyword").keyup(function (e) {
		if (e.keyCode == 13) {getSearch();}
		});
});
function ToKey(){
    	location.reload();
        window.open($('#hdffilename').val(),'_blank');
    	
}
function getSearch() {
	
	var data = {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>', 'keyword': $('#txtkeyword').val()}; 
	$.fn.yiiGridView.update('list-grid', {
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("bank/search"); ?>',
		data: data,
	});
} 

</script>
