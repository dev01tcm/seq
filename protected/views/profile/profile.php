
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
.txtlabel1{
	width:170px;
}
/*
ul.yiiPager .first, ul.yiiPager .last, ul.yiiPager .next, ul.yiiPager .previous {
	display: inline;
}
*/
.advs{
	display:none;
}
</style>  

<div class="panel panel-info">
    	<div class="panel-heading">ประวัติการกรอกรายการ</div>
        <div class="panel-body sectioncontent">
        	<div style="width:800px; display:block; margin:0 auto;">
        	<ul>
            	<li style="list-style:none;">
                    <label class="txtlabel1">ชุดหนังสือ</label>
                    <input type="text" id='txtdocument' class="input-default" maxlength="20" style="width:200px;">
            	</li>                
             	<li style="list-style:none; margin-top:15px">
                	<label class="txtlabel1" >เลขทะเบียนนายจ้าง</label> 
                    <input type="text" id='txtemp' class="input-default" maxlength="20"  style="width:200px;">                    
                </li>
                <li style="list-style:none; margin-top:15px">
                	<label class="txtlabel1" >เลขประจำตัวประชาชน</label> 
                   <input type="text" id='txtiden' class="input-default" maxlength="13" style="width:200px;">
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
                <button class="btn btn-primary" id="btnadd" style="float:left; margin-right:10px;">
                    <i class="glyphicon glyphicon-plus"></i>
                    เพิ่มรายการ
                </button>     
            </div>
            <div style="clear:both;height:0px;"></div>
        </div>
    </div>       

 
    <div class="panel panel-info">
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
        ?>
        </div>
    </div>
    
<div id="modaldetail" class="modal fade" aria-hidden="true" aria-labelledby="modaldetailLabel" role="dialog" tabindex="-1">
    <div class="modal-dialog" style="width:730px; margin-top:118px;">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px 20px 7px;">
                <button class="close" data-dismiss="modal" type="button">
                <span aria-hidden="true">×    <span class="sr-only">Close</span>
                </button>
                <h1 id="modaldetailLabel" class="modal-title">บันทึกข้อมูล</h1>
            </div>
            <form method="post">
            <div class="modal-body">
            		<ul class="ul">
                        <li class="sectionContent" style="list-style:none;">
                            <label class="txtlabel">เลขที่หนังสือ :</label>
                            <input type="text" class="input-default" id="txtnumberdoc" style="width:200px;"/>
                            <label class="" style="margin-left:10px;">วันที่หนังสือ :</label>
                            <input type="text" class="input-default " id="txtdatedoc" style="width:200px;float:right;"/>
                        </li>
                    </ul>
                    <ul class="ul">
                        <li class="sectionContent" style="list-style:none;">
                            <label class="txtlabel">เลขบัญชีนายจ้าง :</label>
                            <input type="text" class="input-default" maxlength="200" id="txtnumber_emp" style="width:200px;">
                            <label class="" style="margin-left:10px;">ประเภทธุรกิจ :</label>
                            <select class="input-default" id="drptype" style="width:200px; float:right;"/>                            	
                                <option value="">--เลือก--</option>                                						
                            </select>
                        </li>
                    </ul> 
                    <ul class="ul">
                        <li class="sectionContent" style="list-style:none;">
                            <label class="txtlabel">ชื่อ :</label>
                            <input type="text" class="input-default" maxlength="200" id="txtname" style="width:200px;">
                            <label class="" style="margin-left:10px;">นามสกุล :</label>
                            <input type="text" class="input-default" maxlength="200" id="txtlname" style="width:200px;float:right;">
                        </li>
                    </ul>  
                    <ul class="ul">
                        <li class="sectionContent" style="list-style:none;">
                            <label class="txtlabel">วัน/เดือน/ปี เกิด :</label>
                            <input type="text" class="input-default" maxlength="200" id="txtbird" style="width:200px;">
                        </li>
                    </ul> 
                    <ul class="ul">
                        <li class="sectionContent" style="list-style:none;">   
                        	<label class="txtlabel">เลขประจำตัว :</label>
                                <select class="input-default" id="drptype" style="width:200px;" onChange="advs()"/>
                                    <option value="">--เลือก--</option>     
                                    <option value="1">เลขประจำตัวประชาชน</option>   
                                    <option value="2">เลขทะเบียนนิติบุคคล</option> 
                                    <option value="3">ต่างชาติ</option>                          						
                                </select> 
                        </li>
                    </ul> 
                    <ul class="ul">
                        <li class="sectionContent" style="list-style:none;"> 
                             <label class="txtlabel"></label>
                             <input type="text" class="input-default" maxlength="50" id="txtidcard" style="width:200px;">
                        </li>
                    </ul> 
                     <ul class="ul">
                        <li class="sectionContent" style="list-style:none;">
                        <label class="txtlabel" >ที่อยู่ </label>
                        <textarea rows="2" cols="50" class="input-default" id="txtaddess" maxlength="200" style="width:510px;"></textarea>
                                
                    </li>             
            </div>
            <div class="modal-footer" style="padding: 7px 20px">
                <h3 id="errmodaldetail" class="sectionError"></h3>
                <div class="sectionButton">
                    <input type="button" class="btn btn-success" name="ok" onClick="ajax_savedata();" value="บันทึก"/>
                    <Button ID="btcledit"class="btn btn-default" data-dismiss="modal" Width="80px">ย้อนกลับ</Button>
                </div>
       		</div>
        </form>
        </div>
    </div>
</div>

<script type="text/javascript">
jQuery(document).ready(function ($) {	
$('Button[id=btnadd]').click(function () {
	$("#modaldetailLabel").html("เพิ่มข้อมูล");                
	$("#modaldetail").modal('show');
		$('#hdfstatus').val('add');
		//$('#id').val('');
		//$('#name').val('');
		//$('#status').val('');
            });
     $('#modaldetail').on('show.bs.modal', function (e) {
					
            });
     $('#modaldetail').on('hidden.bs.modal', function (e) {
        //$('#id').val('');
		//$('#username').val('');
		//$('#userlevel').val('');
            });


});
function advs(){
	//console.log($(".advs").css("display"));
	
	if($(".advs").css("display")=="none"){
		$(".advs").css("display", "block");
		//$("#btnadvs").html("ค้นหาแบบง่าย");
	} else {
		$(".advs").css("display", "none");
		//$("#btnadvs").html("ค้นหาขั้นสูง");
	}
	
}
</script>