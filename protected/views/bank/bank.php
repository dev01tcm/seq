
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
    	<div class="panel-heading">ข้อมูลธนาคาร</div>
        <div class="panel-body sectioncontent">
        	<div style="width:800px; display:block; margin:0 auto;">
        	<ul>
            	<li style="list-style:none;">
				<label class="labeltext" style="width:120px;">คำค้น</label>
				<input type="text" id='txtkeyword' placeholder="เช่น รหัส,ชื่อธนาคาร " class="input-default ipwd6">
                
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
                 <button class="btn btn-primary" style="float:left;margin-right:10px;" onClick="getSearch()">
                    <i class="glyphicon glyphicon-search"></i>
                    ค้นหาข้อมูล
                </button>      
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
				array(
					'name'=>'code',
					'header' => 'รหัสธนาคาร',
					'htmlOptions'=>array('style'=>'text-align:left; width:100px;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),					
				 array(
					'name'=>'name',
					'header' => 'ชื่อธนาคาร',
					'htmlOptions'=>array('style'=>'text-align:left; width:300px;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),			
				  array(
					'name'=>'address',
					'header' => 'ที่อยู่ธนาคาร',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),			
				  array(
					'name'=>'email',
					'header' => 'E-mail',
					'htmlOptions'=>array('style'=>'text-align:left; width:300px;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),
				  array(
					'name'=>'status',
					'header' => 'สถานะ',
					'htmlOptions'=>array('style'=>'text-align:center; width:100px;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),
            ),
        ));
		
        ?>
        </div>
    </div>
    
<div id="modaldetail" class="modal fade" aria-hidden="true" aria-labelledby="modaldetailLabel" role="dialog" tabindex="-1">
    <div class="modal-dialog" style="width:530px; margin-top:118px;">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px 20px 7px;">
                <button class="close" data-dismiss="modal" type="button">
                <span aria-hidden="true">×    <span class="sr-only">Close</span>
                </button>
                <h1 id="modaldetailLabel" class="modal-title">บันทึกข้อมูล</h1>
            </div>
            <div class="modal-body">
            		<ul class="ul">
                        <li class="sectionContent" style="list-style:none;">
                            <label class="txtlabel">code :</label>
                            <input type="text" class="input-default" id="txtcode" style="width:200px;" maxlength="10" onkeyup="checkText(this.value,this)"/>                            
                        </li>
                    </ul>
                    <ul class="ul">
                        <li class="sectionContent" style="list-style:none;">
                            <label class="txtlabel">ชื่อธนาคาร :</label>
                            <input type="text" class="input-default" maxlength="100" id="txtname" style="width:300px;" onkeyup="checkText(this.value,this)">                           
                        </li>
                    </ul> 
                    <ul class="ul">
                        <li class="sectionContent" style="list-style:none;">
                        <label class="txtlabel" >ที่อยู่ </label>
                        <textarea rows="2" cols="50" class="input-default" id="txtaddress" maxlength="300" style="width:300px;" onkeyup="checkText(this.value,this)"></textarea>
                                
                    	</li>   
                    </ul> 
                    <ul class="ul">
                        <li class="sectionContent" style="list-style:none;">
                            <label class="txtlabel">Email :</label>
                            <input type="text" class="input-default" maxlength="100" id="txtemail" style="width:200px;" onkeyup="checkText(this.value,this)">
                        </li>
                    </ul>                        
            </div>
            <div class="modal-footer" style="padding: 7px 20px">
                <h3 id="errmodaldetail" class="sectionError"></h3>
                <div class="sectionButton">
                    <input type="button" class="btn btn-success" name="ok" onClick="ajax_savedata();" value="บันทึก"/>
                    <Button ID="btcledit"class="btn btn-default" data-dismiss="modal" Width="80px">ย้อนกลับ</Button>
                </div>
       		</div>
        </div>
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
	 	$('#hdfid').val('');   
		$('#txtcode').val('');
		$('#txtname').val('');	
		$('#txtaddress').val('');
		$('#txtemail').val('');
		
            });



	$("#txtkeyword").keyup(function (e) {
		if (e.keyCode == 13) {getSearch();}
		});
});
function getSearch() {
	
	var data = {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>', 'keyword': $('#txtkeyword').val()}; 
	$.fn.yiiGridView.update('list-grid', {
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("bank/search"); ?>',
		data: data,
	});
} 
function ajax_savedata() {
	
	if($('#txtcode').val()==''){
		alert('กรุณากรอกรหัสธนาคาร');
		return;
	}
	if($('#txtname').val()==''){
		alert('กรุณากรอกชื่อธนาคาร');
		return;
	}
	if($('#txtaddress').val()==''){
		alert('กรุณากรอกที่อยู่');
		return;
	}
	if($('#txtemail').val()==''){
		alert('กรุณากรอกอีเมล์');
		return;
	}
	
	var id=$('#hdfid').val();
	var code=$('#txtcode').val();
	var name=$('#txtname').val();	
	var address=$('#txtaddress').val();
	var email=$('#txtemail').val();
	
    $.ajax({
    type: "POST",
    url: "<?php echo Yii::app()->createAbsoluteUrl("bank/savedata"); ?>",
  	data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id,'code':code,'name':name,'address':address,'email':email},
    dataType: "json",				
    success: function (data) {
	if (data.status=='success') {		
		$("#modaldetail").modal('hide');	
		swal({
				title: "สำเร็จ !",
				text: "ทำการบันทึกข้อมูลสำเร็จ",
				icon: "success",
				button: "ตกลง",
				});	
		getSearch();
		
	}
	else{
		alert(data.msg);
	} 
}
});
}	

function setUpdate(el) {
	
	
	var id = $(el).parent().attr("data-id"); 
	
	//alert(id);
	 $.ajax({
    	type: "POST",
    	url: "<?php echo Yii::app()->createAbsoluteUrl("bank/bankdata"); ?>",
  		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id},
    	dataType: "json",				
    	success: function (data) {
			if (data.status=='success') {
				$('#hdfid').val(data.id);
				$('#txtcode').val(data.code);
				$('#txtname').val(data.name);				
				$('#txtaddress').val(data.address);
				$('#txtemail').val(data.email);	
				//$('#hdfid').val(data.id);			
				//$('#hdfstatus').val('edit');
				$("#modaldetailLabel").html("แก้ไขข้อมูล");   
				$("#modaldetail").modal('show');  				
			
			}else{
				alert(data.msg);
			} 
		}
	});		
	
}
function setDelete(el) {
	var id = $(el).parent().attr("data-id");    
		/////////////////////////////////////////////var r = confirm("คุณต้องการลบข้อมูลนี้ใช่หรือไม่ !");
		swal({
			title: "แน่ใจหรือว่าต้องการลบ ?",
			text: "เมื่อทำการยืนยันข้อมูลจะถูกลบออกจากระบบ !",
			icon: "warning",
			buttons: true,
			dangerMode: true
			})
		.then((data) => {
	if (data) {
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl("bank/deletedata"); ?>",
			data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id},
			dataType: "json",				
		success: function (data) {
			if (data.status=='success') {		
				$("#modaldetail").modal('hide');	
				swal({
					icon: "success",			
					title: "สำเร็จ !",
					text: "ลบข้อมูล สำเร็จแล้ว !"
				});	
			getSearch();
			}
			else{
				alert(data.msg);
			} 
					}
				});
			}
	});
///////////////////////////////////////////////////////////////////////////////////////////////

}

</script>
