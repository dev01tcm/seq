
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
    	<div class="panel-heading">รายงานการส่งข้อมูลกลับของธนาคาร</div>
        <div class="panel-body sectioncontent">
        	<div style="width:800px; display:block; margin:0 auto;">
        	<ul>
            	<li style="list-style:none;">
                    <label class="txtlabel">เลขชุดหนังสือ</label>
                    <input type="text" id='txtdocument' class="input-default" style="width:200px;">
            	</li>
             	<li style="list-style:none; margin-top:15px">
                   <input id="hdfstatus" type="hidden" />
                   <input id="hdfid" type="hidden" />
            	</li>
            </ul>
            </div>
        </div>
       
        
        <div class="panel-body sectionctrl">
        	<div style="float:right;">
                 <a class="btn btn-primary" href="#" style="float:left;margin-right:10px;" onClick="getSearch()">
                    <i class="glyphicon glyphicon-search"></i>
                    ค้นหาข้อมูล
                </a>    
            </div>
            <div style="clear:both;height:0px;"></div>
        </div>
    </div>       

 
    <div class="panel panel-info">
    	<div class="panel-body">
        <?php
		/*
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
					'name'=>'username',
					'header' => 'ชุดหนังสือ',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),					
				 array(
					'name'=>'displayname',
					'header' => 'เลขหนังสือ(ส่งออก)',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),			
				  array(
					'name'=>'',
					'header' => 'วันที่หนังสือ(ส่งออก)',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),			
				  array(
					'name'=>'',
					'header' => 'เลขหนังสือ',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),
				 
				  array(
					'name'=>'',
					'header' => 'วันที่หนังสือ',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),			
				  array(
					'name'=>'',
					'header' => 'เลขนายจ้าง',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),
				  array(
					'name'=>'',
					'header' => 'เลขหนังสือ',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),
				 
				  array(
					'name'=>'',
					'header' => 'วันที่หนังสือ',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),			
				  array(
					'name'=>'',
					'header' => 'เลขนายจ้าง',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),
				  array(
					'name'=>'',
					'header' => 'เลขหนังสือ',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),
				 
				  array(
					'name'=>'',
					'header' => 'วันที่หนังสือ',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),			
				  array(
					'name'=>'',
					'header' => 'เลขนายจ้าง',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),
				  array(
					'name'=>'',
					'header' => 'เลขหนังสือ',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),				 
				  array(
					'name'=>'',
					'header' => 'วันที่หนังสือ',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),			
				  array(
					'name'=>'',
					'header' => 'เลขนายจ้าง',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),				   
				 array(
                    'header' => 'แก้ไข',
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
				array(
                    'header' => 'ลบ',
                    'class' => 'CLinkColumn',
                    'label' => '<i class="glyphicon glyphicon-remove"></i>',
                    //'urlExpression' => 'Yii::app()->createUrl("department/delete", array("id" => $data["id"]))',					
                    'htmlOptions' => array(
                        'width' => '35px',
                        'align' => 'center',
						'onclick' => 'setDelete(this);'
                    ),
					'linkHtmlOptions'=>array('class'=>'btn btn-danger'),
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
                ),		
				  	
            ),
        ));
		*/
        ?>
        </div>
    </div>
    


<script type="text/javascript">

</script>