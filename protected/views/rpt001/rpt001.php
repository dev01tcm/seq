
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
.hdf{
	display:none;
}
</style>  

<div class="panel panel-info">
    <div class="panel-heading">รายงานการส่งข้อมูลกลับของธนาคาร</div>
    <div class="panel-body sectioncontent">
        <div style="width:800px; display:block; margin:0 auto;">
        <ul>
            <li style="list-style:none;">
                <label class="txtlabel">เลขชุดหนังสือ</label>
                <input type="text" id='txtdocument' class="input-default" maxlength="5" style="width:200px;">
                 <span>                    
                    <button class="btn btn-primary" style="margin-left:10px;" onclick="getSearch()">
                        <i class="glyphicon glyphicon-search"></i>
                        ค้นหาข้อมูล
                    </button>
                </span>
            </li>
            <li style="list-style:none; margin-top:15px">
               <input id="hdfstatus" type="hidden" style="color:#5DBBFF" />
               <input id="hdfurl" type="hidden" value="<?php echo Yii::app()->params['prg_ctrl']['url']['baseurl']; ?>"/>
            </li>
        </ul>
        </div>
    </div>       
</div>       
<div class="panel panel-info hdf">
    <div class="panel-body">
    <?php	
	
	
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
                'htmlOptions'=>array('style'=>'text-align:center; width:80px;'),
                'headerHtmlOptions'=>array('style'=>'width:80px; text-align:center;'),
              ),					
             array(
                'name'=>'code',
                'header' => 'เลขชุดหนังสือ',
                'htmlOptions'=>array('style'=>'text-align:center; width:120px;'),
                'headerHtmlOptions'=>array('style'=>'width:120px; text-align:center;'),
              ),			
              array(
                'name'=>'name_bank',
                'header' => 'ชื่อธนาคาร',
                'htmlOptions'=>array('style'=>'text-align:left;'),
                'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
              ),			
              array(
                'name'=>'request_date',
                'header' => 'วันที่ธนาคารตรวจสอบ',
                'htmlOptions'=>array('style'=>'text-align:center; width:170px;'),
                'headerHtmlOptions'=>array('style'=>'width:170px; text-align:center;'),
              ),			  
              array(
                'name'=>'cnt',
                'header' => 'นายจ้าง(ราย)',
                'htmlOptions'=>array('style'=>'text-align:center; width:110px;'),
                'headerHtmlOptions'=>array('style'=>'width:110px; text-align:center;'),
              ),
			  array(
                'name'=>'create_date',
                'header' => 'วันที่นำข้อมูลเข้า',
                'htmlOptions'=>array('style'=>'text-align:center; width:150px;'),
                'headerHtmlOptions'=>array('style'=>'width:150px; text-align:center;'),
              ),
			  array(
				//'name'=>'',
				'type' => 'html', 
				'value' => function($data){ 
					if($data['cnt']!=1){
						$img = Yii::app()->params['prg_ctrl']['url']['baseurl'].'/images/icon/';
						$pdf = $img.'pdf.png';
						$excel = $img.'excel.png';
						echo '<label id="btncnt" style="color:#5DBBFF;" data-value="'.$data['code'].'" data-id="'.$data['bank_id'].'" onclick="getPdf(this)"><a href="#" title="ดาวน์โหลด PDF"><img src="'.$pdf.'" width="25px;"></a></label>';
						echo '<label id="btncnt" style="color:#5DBBFF; margin-left:10px;" data-value="'.$data['code'].'" data-id="'.$data['bank_id'].'" onclick="getExcel(this)"><a href="#" title="ดาวน์โหลด EXCEL"><img src="'.$excel.'" width="30px;"></a></label>';
						//echo '<label id="btncnt" style="color:#5DBBFF;cursor:pointer;" data-value="'.$data['code'].'" data-id="'.$data['id'].'" onclick="getDetail(this)">'.$data['cnt'].'</label>';
												
					}
				},
				'header' => 'ออกรายงาน',
				'htmlOptions'=>array('style'=>'text-align:center; width:150px;'),
                'headerHtmlOptions'=>array('style'=>'width:150px; text-align:center;'),
			),
        ),
    ));
	
    ?>
    </div>
</div>
 

<script type="text/javascript">
function gotopagepdf(){
	/*
	var code = $('#txtdocument').val();
	var url = $('#hdfurl').val();
	$('#txtdocument').val('');
	url = url+"/rpt001/rpt001pdf?code="+code;
	window.open(url, '_blank');	
	*/
}
function getSearch() {
	if($('#txtdocument').val()==""){		
		$(".hdf").css("display", "disabled");
	}else{
		$(".hdf").css("display", "block");
	}
	
	
	var data = {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>', 'keyword': $('#txtdocument').val()}; 
	$.fn.yiiGridView.update('list-grid', {
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("rpt001/search"); ?>',
		data: data,
	});
}
function getPdf(elem){
	var id = $(elem).attr("data-id"); 
	var code = $(elem).attr("data-value");
	
	var url = $('#hdfurl').val();	
	url = url+"/rpt001/rpt001pdf?code="+code+"&id="+id;
	window.open(url, '_blank');
	//alert(id+code);
	
}
function getExcel(elem){
	var id = $(elem).attr("data-id"); 
	var code = $(elem).attr("data-value");
	
	var url = $('#hdfurl').val();	
	url = url+"/rpt001/rpt001excel?code="+code+"&id="+id;
	window.open(url, '_blank');
	//alert(id+code);
	
}
</script>