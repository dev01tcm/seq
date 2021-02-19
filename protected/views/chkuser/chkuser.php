
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
	width:120px;
}
/*
ul.yiiPager .first, ul.yiiPager .last, ul.yiiPager .next, ul.yiiPager .previous {
	display: inline;
}
*/
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
	margin-left:-35px;
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
.subheader{
	margin-left:10px;
	margin-top:7px;
}
</style>  

<div class="panel panel-info">
    <div class="panel-heading">ข้อมูลผู้ใช้</div>
    <div style="height:40px; border-bottom:1px solid #ccc"><label class="subheader" style="magin-left:10px;">รายการข้อมูลผู้ใช้ในหน่วยงาน <?php echo Yii::app()->user->getInfo('dep_name'); ?> </label></div>  
    <div class="panel-body sectioncontent">
        
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
                            'name'=>'rank',
                            'header' => 'ลำดับ',
                            'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
                            'headerHtmlOptions'=>array('style'=>'width:50px; text-align:center;'),
                          ),		
                         array(
                            'name'=>'username',
                            'header' => 'ชื่อผู้ใช้',
                            'htmlOptions'=>array('style'=>'text-align:left;width:300px;'),
                            'headerHtmlOptions'=>array('style'=>'width:300px; text-align:center;'),
                          ),
                           array(
                            'name'=>'displayname',
                            'header' => 'ชื่อ - นามสกุล',
                            'htmlOptions'=>array('style'=>'text-align:left;'),
                            'headerHtmlOptions'=>array('style'=>'text-align:center;'),
                          ),
                         
                    ),
                ));
                
         	?>
        
    </div>       
</div>        

 