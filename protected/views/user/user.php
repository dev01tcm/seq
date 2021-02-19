
<?php
	$this->pageTitle = 'ลงทะเบียนนายจ้าง' . Yii::app()->params['prg_ctrl']['pagetitle'];
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
</style>  
 
<div class="panel panel-info">
    	<div class="panel-heading">ข้อมูลผู้ใช้</div>
        <div class="panel-body sectioncontent">
        	<div style="width:800px; display:block; margin:0 auto;">
        	<ul>
            	<li style="list-style:none;">
					<label class="labeltext" style="width:120px;">คำค้น</label>
					<input type="text" id='txtkeyword' placeholder="เช่น ชื่อผู้ใช้,ชื่อ - นามสกุล,เลขประจำตัวประชาชน,รหัสหน่วยงาน" class="input-default ipwd5">
            	</li>
                <li style="list-style:none; margin-top:15px">
                    <label class="txtlabel">หน่วยงาน </label>
                   <select class="input-default js-example-basic-multiple" id="drpdep" style="width:530px;" name="states[]">                            	
                        <option value=''>--เลือก--</option>
                            <?php 								
                            $data=lookupdata::getDepartment();
                            foreach($data as $dataitem) {
                            echo "<option value='".$dataitem['id']."'>".$dataitem['name']." (".$dataitem['code'].")</option>";
                            } 
                            ?>
                    </select>          
                       
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
                    				
                    'htmlOptions' => array(
                        'width' => '35px',
                        'align' => 'center',
						'onclick' => 'setDelete(this);'
                    ),
					'linkHtmlOptions'=>array('class'=>'btn btn-danger'),
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
                ),
				array(
                    'header' => 'ประวัติการแก้ไข',
                    'class' => 'CLinkColumn',
                    'label' => '<i class="glyphicon glyphicon-search"></i>',
                    				
                    'htmlOptions' => array(
                        'width' => '35px',
                        'align' => 'center',
						'onclick' => 'getHeaddetail(this);'
                    ),
					'linkHtmlOptions'=>array('class'=>'btn btn-info'),
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
                ),
							
				 array(
					'name'=>'username',
					'header' => 'ชื่อผู้ใช้',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'width:300px; text-align:center;'),
				  ),
				   array(
					'name'=>'displayname',
					'header' => 'ชื่อ - นามสกุล',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'width:250px; text-align:center;'),
				  ),
				  array(
					'name'=>'pid',
					'header' => 'เลขประจำตัวประชาชน',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'width:200px; text-align:center;'),
				  ),			
				  array(
					'name'=>'department_name',
					'header' => 'หน่วยงาน',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),			
				 
				   array(
					'name'=>'userlevel',
					'header' => 'กลุ่มสิทธิ์',
					'htmlOptions'=>array('style'=>'text-align:center; width:100px;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),
				 
            ),
        ));
		
        ?>
        </div>
    </div>
	<div id="modalshow" class="modal fade" aria-hidden="true" aria-labelledby="modaldetailLabel" role="dialog" tabindex="-1">
    <div class="modal-dialog" style="width: 90%; margin-top:18px;">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px 20px 7px;">
                <button class="close" data-dismiss="modal" type="button">
                	<span aria-hidden="true">×    <span class="sr-only">Close</span>
                </button>
                <h1 id="modalLabel" class="modal-title">ประวัติการบันทึกการเปลี่ยนแปลง</h1>
            </div>            
            <div class="modal-body" style="margin-top:-10px;">    
             
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
                                'name'=>'daydate',
                                'header' => 'วัน เดือน ปี',
                                'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
                                'headerHtmlOptions'=>array('style'=>'text-align:center;vertical-align:middle;width:100px;'),
                              ),  
							   array(
                                'name'=>'log_type',
                                'header' => 'เหตุการณ์',
                                'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
                                'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
                              ),
                            array(
								'name'=>'username',
                                'header' => 'ชื่อผู้ใช้',
                                'htmlOptions'=>array('style'=>'text-align:left;width:50px;'),
                                'headerHtmlOptions'=>array('style'=>'text-align:center;vertical-align:middle;width:50px;'),
                              ),
                            array(
                                'name'=>'firstname',
                                'header' => 'ชื่อ',
                                'htmlOptions'=>array('style'=>'text-align:left;width:50px;'),
                                'headerHtmlOptions'=>array('style'=>'text-align:center;vertical-align:middle;width:50px;'),
                              ),
						  array(
							'name'=>'lastname',
							'header' => 'นามสกุล',
							'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
							'headerHtmlOptions'=>array('style'=>'text-align:center;vertical-align:middle;width:50px;'),
						  ),
                            array(
                                'name'=>'pid',
                                'header' => 'เลขบัตรประชาชน',
                                'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
                                'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
                              ),
							  array(
                                'name'=>'department_name',
                                'header' => 'หน่วยงาน',
                                'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
                                'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
                              ),
							   array(
                                'name'=>'userlevel_name',
                                'header' => 'สิทธิ์',
                                'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
                                'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
                              ),
							  array(
                                'name'=>'userstatus',
                                'header' => 'สถานะ',
                                'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
                                'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
                              ),
							   array(
                                'name'=>'log_createby',
                                'header' => 'ผู้เปลี่ยนแปลง',
                                'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
                                'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
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
    
<div id="modaldetail" class="modal fade" aria-hidden="true" aria-labelledby="modaldetailLabel" role="dialog" tabindex="-1">
    <div class="modal-dialog" style="width:730px; margin-top:118px;">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px 20px 7px;">
                <button class="close" data-dismiss="modal" type="button">
                <span aria-hidden="true">×    <span class="sr-only">Close</span>
                </button>
                <h1 id="modaldetailLabel" class="modal-title">บันทึกข้อมูล</h1>
           		   </div>
				    <div class="modal-header" id="saveuserdiv"style="padding: 10px 20px 7px;">
						<ul class="ul">
							<li style="list-style:none;">
								<input type="text"id='txtsearch'placeholder="ค้นหาด้วยเลขบัตรประชาชนหรือรหัสผู้ใช้จากLDAP" class="input-default" maxlength="15"  style="width:300px;"> 					
								<button class="btn btn-primary"style="margin-right:10px;"onClick="getSearchsave()">
								<i class="glyphicon glyphicon-search"></i>ค้นหา</button>
							</li>
							<table id="mytb1" class="table table-striped ">
							</table>
						</ul>
               
            </div>
            <div class="modal-body">
                <ul class="ul">
                    <li class="sectionContent" style="list-style:none;">
                        <label class="txtlabel">ชื่อผู้ใช้ : <font color="red">*</font> </label>
                        <input type="text" class="input-default" id="txtusername" maxlength="20" style="width:200px;" onkeyup="checkText(this.value,this)"/>            
                    </li>
                </ul>
                <ul class="ul">
                    <li class="sectionContent" style="list-style:none;">
                        <label class="txtlabel">ชื่อ : <font color="red">*</font></label>                        
                        <input id="txtfirstname" type="text" class="input-default" style="width:200px;" maxlength="50" onkeyup="checkText(this.value,this)" >
                        <label class="" style="margin-left:10px;">นามสกุล : <font color="red">*</font></label>
                        <input id="txtlastname" type="text" class="input-default" style="width:200px;" maxlength="50" onkeyup="checkText(this.value,this)" >
                    </li>
                </ul>
                <ul class="ul">
                    <li class="sectionContent" style="list-style:none;">
                        <label class="txtlabel">เลขบัตรประชาชน :</label>
                        <input type="text" class="input-default" maxlength="13" id="txtpid" style="width:200px;" onkeyup="checkText(this.value,this)">                           
                    </li>
                </ul>
                <ul class="ul">
                    <li class="sectionContent" style="list-style:none;">
                        <label class="txtlabel">หน่วยงาน : <font color="red">*</font></label>
                        <select class="input-default" id="drpdep_id" style="width:480px;">                            	
                        	<option value=''>--เลือก--</option>
                                <?php 								
                                $data=lookupdata::getDepartment();
                                foreach($data as $dataitem) {
                                echo "<option value='".$dataitem['id']."'>".$dataitem['name']."</option>";
                                } 
                                ?>
                        </select>                           
                    </li>
                </ul> 
                <ul class="ul">
                    <li class="sectionContent" style="list-style:none;">
                        <label class="txtlabel">กลุ่มสิทธิ์ : <font color="red">*</font></label>
                        <select class="input-default" id="drplevel" style="width:100px;" >
                    		<option value="">--เลือก--</option>
                            <option value="1">Admin</option>
                            <option value="2">User</option>
               			</select>                           
                    </li>
                </ul>
                <ul class="ul" hidden="hidden">
                    <li class="sectionContent" style="list-style:none;">
                        <label class="txtlabel">ใช้งานวันที่ :</label>                        
                        <input id="txtst_date" type="text" class="input-default ipdisable txtcalendar" style="width:200px;" maxlength="10" disabled>
                        <span class="btncalendar" id="btnstdate" style="cursor:pointer;" title="เลือกปฏิทิน">
                            <span class="glyphicon glyphicon-calendar" style="color: #007CFF" ></span>
                        </span>
                        <span class="btncalendar1" id="date_st" onClick="clearcalendar();" style="cursor:pointer;" title="ยกเลิกวันที่">
                            <span class="glyphicon glyphicon-remove" style="color:#FC0004" ></span>
                        </span>
                        <label class="" style="margin-left:50px;">ถึงวันที่ :</label>
                        <input id="txten_date" type="text" class="input-default ipdisable txtcalendar" style="width:200px;" maxlength="10" disabled>
                        <span class="btncalendar" id="btnendate" style="cursor:pointer;" title="เลือกปฏิทิน">
                            <span class="glyphicon glyphicon-calendar" style="color: #007CFF" ></span>
                        </span>
                        <span class="btncalendar1" id="date_st" onClick="clearcalendar();" style="cursor:pointer;" title="ยกเลิกวันที่">
                            <span class="glyphicon glyphicon-remove" style="color:#FC0004" ></span>
                        </span>
                    </li>
                </ul> 
                <ul class="ul">
                    <li class="sectionContent" style="list-style:none;">
                        <label class="txtlabel">สถานะ : <font color="red">*</font></label>
                        <select class="input-default" id="drpstatus" style="width:100px;" >
                    		<option value="1">Active</option>
                            <option value="2">Inctive</option>
							<option value="3">Time out </option>
               			</select>                           
                    </li>
                </ul>                                          
            </div>
            <div class="modal-footer" style="padding: 7px 20px">
                <h3 id="errmodaldetail" class="sectionError"></h3>
                <div class="sectionButton">
                    <input type="button" id="savedata" class="btn btn-success" name="ok" onClick="ajax_savedata();" value="บันทึก"/>
                    <Button ID="btcledit"class="btn btn-default" data-dismiss="modal" Width="80px">ย้อนกลับ</Button>
					
                </div>
       		</div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
   $('.js-example-basic-multiple').select2();
});
jQuery(document).ready(function ($) {
	
	$("#txtst_date").attr("disabled", "disabled"); 
	$("#txtst_date").css('background-color', '#ccc');	 
	  $('#txtst_date').datepicker({
			format: 'dd/mm/yyyy',
			todayBtn: true,
			language: 'th',             
			thaiyear: true             
		});  
	$('#btnstdate').click(function () {
			
			$("#txtst_date").removeAttr("disabled"); 
			$('#txtst_date').datepicker('show');
			$("#txtst_date").attr("disabled", "disabled"); 
			$("#txtst_date").css('background-color', '#ccc');

	});
	
	$("#txten_date").attr("disabled", "disabled"); 
	$("#txten_date").css('background-color', '#ccc');	 
	  $('#txten_date').datepicker({
			format: 'dd/mm/yyyy',
			todayBtn: true,
			language: 'th',             
			thaiyear: true             
		}); 	
	$('#btnendate').click(function () {
			
			$("#txten_date").removeAttr("disabled"); 
			$('#txten_date').datepicker('show');
			$("#txten_date").attr("disabled", "disabled"); 
			$("#txten_date").css('background-color', '#ccc');

	});
$('Button[id=btnadd]').click(function () {
	$("#modaldetailLabel").html("เพิ่มข้อมูล");                
	$("#modaldetail").modal('show');
		$('#hdfid').val('');
		$('#txtusername').val('');
		$('#txtfirstname').val('');
		$('#txtlastname').val('');
		$('#txtpid').val('');	
		$('#drpdep_id').val('');
		$('#drplevel').val('');
		$('#txtst_date').val('');
		$('#txten_date').val('');
		$("#saveuserdiv").show();
		$('#txtsearch').val('');
		$('#mytb1').empty();
            });
     $('#modaldetail').on('show.bs.modal', function (e) {
					
            });
     $('#modaldetail').on('hidden.bs.modal', function (e) {
       
            });

	$("#txtkeyword").keyup(function (e) {
		if (e.keyCode == 13) {getSearch();}
		});
});
function getSearch() {
	
	var data = {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>', 'keyword': $('#txtkeyword').val(), 'dep': $('#drpdep').val()}; 
	$.fn.yiiGridView.update('list-grid', {
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("user/search"); ?>',
		data: data,
	});
}
function ajax_savedata() {
	
	if($('#txtusername').val()==''){
		alert('กรุณากรอกชื่อผู้ใช้');
		return;
	}
	
	if($('#txtfirstname').val()==''){
		alert('กรุณากรอกชื่อ');
		return;
	}
	if($('#txtlastname').val()==''){
		alert('กรุณากรอกนามสกุล');
		return;
	}
	
	if($('#drpdep_id').val()==''){
		alert('กรุณาเลือกหน่วยงาน');
		return;
	}
	if($('#drplevel').val()==''){
		alert('กรุณาเลือกกลุ่มสิทธิ์');
		return;
	} 
	if($('#drpstatus').val()==''){
		alert('กรุณาเลือกสถานะ');
		return;
	}
	$('#savedata').attr('disabled','disabled');
	var id=$('#hdfid').val();
	var username=$('#txtusername').val();
	var firstname=$('#txtfirstname').val();
	var lastname=$('#txtlastname').val();
	
	
	var pid=$('#txtpid').val();	
	var dep_id=$('#drpdep_id').val();
	var level=$('#drplevel').val();
	var aa=$('#txtst_date').val();
	var bb=$('#txten_date').val();	
	var active=$('#drpstatus').val();
	var aaa = ex_date2db(aa);
	var bbb = ex_date2db(bb);	
	var aaDate = new Date(aaa)
	var aaMonth = ((aaDate.getMonth().length+1) === 1)? (aaDate.getMonth()+1) : + (aaDate.getMonth()+1); 
	var st_date = (aaDate.getFullYear()-543) + "-" + aaMonth + "-" + aaDate.getDate();
	
	var bbDate = new Date(bbb)
	var bbMonth = ((bbDate.getMonth().length+1) === 1)? (bbDate.getMonth()+1) : + (bbDate.getMonth()+1); 
	var en_date = (bbDate.getFullYear()-543) + "-" + bbMonth + "-" + bbDate.getDate();
	
		if(st_date=='NaN-NaN-NaN'){
			st_date=null;			
		}
		if(en_date=='NaN-NaN-NaN'){
			en_date=null;			
		}
	
    $.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl("user/savedata"); ?>",
		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'id':id,'username':username,'firstname':firstname,'lastname':lastname,'pid':pid,'dep_id':dep_id,'level':level,
				'st_date':st_date,'en_date':en_date,'active':active},
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
				$('#savedata').removeAttr('disabled');				
				getSearch();				
			}else{
				swal({
					icon: "error",			
					title: "เกิดข้อผิดพลาด",
					text: data.msg
				});	
			}
		}
	});
}
function setUpdate(el) {
	
	
	var id = $(el).parent().attr("data-id"); 
	
	 $.ajax({
    	type: "POST",
    	url: "<?php echo Yii::app()->createAbsoluteUrl("user/userdata"); ?>",
  		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id},
    	dataType: "json",				
    	success: function (data) {
			if (data.status=='success') {				
				$('#hdfid').val(data.id);
				$('#txtusername').val(data.username);
				$('#txtfirstname').val(data.firstname);
				$('#txtlastname').val(data.lastname);
				$('#txtpid').val(data.pid);	
				$('#drpdep_id').val(data.dep_id);
				$('#drplevel').val(data.level);
				$('#txtst_date').val(data.st_date);
				$('#txten_date').val(data.en_date);
				$('#drpstatus').val(data.active);
				$("#saveuserdiv").hide();
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
			url: "<?php echo Yii::app()->createAbsoluteUrl("user/deletedata"); ?>",
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
		
		swal({
					icon: "error",			
					title: "เกิดข้อผิดพลาด",
					text: data.msg
				});	
		alert(data.msg);
	} 
					}
				});
			}
	});
	
}

function clearcalendar(){
	$('#txtst_date').val('');
}
function clearcalendar1(){
	$('#txten_date').val('');
}
function getSearchsave() {
	if($('#txtsearch').val()==''){
		$('#mytb1').empty();
		alert('กรุณากรอกข้อมูล');
		$('#txtsearch').focus();
		$('#txtsearch').select();
	}else if($('#txtsearch').val().search("'")!=-1)
	   {
	     alert('ไม่สามารถใส่สัญญาลักษณ์่ เครื่องมหายคำพูดได้');
		 $('#txtsearch').focus();
		 $('#txtsearch').select();
	   }
	else if($('#txtsearch').val().search('"')!=-1)
	   {
	     alert('ไม่สามารถใส่สัญญาลักษณ์่ เครื่องมหายคำพูดได้');
		 $('#txtsearch').focus();
		 $('#txtsearch').select();
		}
	else{
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl("user/searchsave"); ?>",
			data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>', 'keyword': $('#txtsearch').val()},
			dataType: "json",				
			success: function (data) {
				if (data.status=='success') {
					var userid = data.username;
					if(userid.length==1){
						$('#mytb1').empty();
						$('#txtusername').val(data.username);
						$('#txtfirstname').val(data.firstname);
						$('#txtlastname').val(data.lastname);
						$('#txtpid').val(data.pid);	
						$('#drpdep_id').val(data.dep_id);
					}else{
						$('#mytb1').empty();
						$('#mytb1').show();
						var username = data.username;
						var firstname = data.firstname;
						var lastname = data.lastname;
						var publiccode = data.pid
						var dep_name = data.dep_name;
						var dep_id = data.dep_id;
						console.log(dep_id);
						var mytr = '';
							mytr =	'<tr height="35" background-color="blue">';
							mytr +=	'<td width="105" align="center" ><b>ชื่อผู้ใช้ </b></td>';
							mytr +=	'<td width="105" align="center"><b>ชื่อ </b></td>';
							mytr +=	'<td width="105" align="center"><b>นามสกุล </b></td>';
							mytr +=	'<td width="105" align="center"><b>หน่วยงาน </b></td>';
							mytr +=	'<td width="105" align="center"><b>เลือก </b></td>';
							mytr +=	'</tr>';
							$('#mytb1').append(mytr);
						
						for(var a=0;a<username.length;a++){
						var mytr = '';
							mytr =	'<tr height="35">';
							mytr +=	'<td width="105" align="center" >' + username[a] + '</td>';
							mytr +=	'<td width="105" align="center">' + firstname[a] + '</td>';
							mytr +=	'<td width="105" align="center">' + lastname[a] + '</td>';
							mytr +=	'<td width="105" align="center">' + dep_name[a] + '</td>';
							mytr +=	'<td width="105" align="center"><button class="btn btn-primary" onClick="getSearchsaveuser(\'' + username[a] + '\',\'' + firstname[a] + '\',\'' + lastname[a] + '\',\'' + dep_id[a] + '\',\'' + publiccode[a] + '\',\'T\');">เลือก</button></td>';
							mytr +=	'</tr>';
							$('#mytb1').append(mytr);
						}	
					}
				}
				else{
				$('#mytb1').empty();
				alert(data.msg);
			} 
			}
		});
	}		
	
}
function getSearchsaveuser(username, firstname, lastname, dep_id, publiccode, ee)
 {
	if(dep_id)
	{
	var dep_id = parseInt(dep_id);
	}
	$('#txtusername').val(username);
	$('#txtfirstname').val(firstname);
	$('#txtlastname').val(lastname);
	$('#txtpid').val(publiccode);
	if(dep_id)
	{
		$('#drpdep_id').val(dep_id);
	}	
	
	$("#mytb1").hide();
	
}
function getHeaddetail(el) {
	
	
	var id = $(el).parent().attr("data-id"); 
	//alert(id);
	var data = {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>', 'id': id}; 
	
	$.fn.yiiGridView.update('list-griddetail', {
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("user/searchhis"); ?>',
		data: data,
	});	
	
	$("#modalshow").modal('show');
}

</script>