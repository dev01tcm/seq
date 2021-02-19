
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
	width:175px;
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
	visibility:;
}
.hdf2{
	display:none;
}
.hdf3{
	display:none;
}
.hdf4{
	display:none;
}
.btn1{
	display:none;
}
.btndel{
	display:none;
}

.hdfgrd{
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
	margin-left:-70px;
	height: 34px;	
}

</style> 
	<div class="panel panel-info">
    <div class="panel-heading">บันทึกรายการขอตรวจสอบบัญชีเงินฝากและหลักทรัพย์</div>
    <div class="panel-body sectioncontent">
    	<div style="width:1100px; display:block; margin:0 auto;">
        	<ul>
            	<li style="list-style:none;" hidden="hidden">
                	<label class="txtlabel">เลขที่ชุดข้อมูล :</label>
                	<input type="text" class="input-default" id="txtcode" style="width:200px;" />
            	</li>
              	<li style="list-style:none; margin-top:15px">
				  <div>
						<label class="txtlabel">เลขที่หนังสือ : <font color="red">*</font></label>
						<input id="txtdoc_no" type="text" class="input-default" style="width:200px;" maxlength="20" onkeyup="checkText(this.value,this),getInsert()" />
						<label class="" style="margin-left:10px;">วันที่หนังสือ : <font color="red">*</font></label>
						<input id="txtdoc_date" type="text" class="input-default ipdisable txtcalendar" style="width:200px;" maxlength="10" onchange="getInsert()" readonly/>
						<span class="btncalendar" id="btndocdate" style="cursor:pointer;" title="เลือกปฏิทิน">
							<span class="glyphicon glyphicon-calendar" style="color: #007CFF" ></span>
						</span>
						<span class="btncalendar1" id="date_st" onClick="clearcalendar();" style="cursor:pointer;" title="ยกเลิกวันที่">
							<span class="glyphicon glyphicon-remove" style="color:#FC0004" ></span>
						</span> 

						<button class="btn btn-primary" id="btnadd" style="margin-left:50px;" disabled="disabled">
							<i class="glyphicon glyphicon-plus"></i>
							เพิ่มรายการ
                   		 </button> 
					</div> 
					<label class="txtlabel" style="margin-top:20px">เลขที่หนังสือธTSD : <font color="red">*</font></label>
                    <input id="txtdoc_no_tsd" type="text" class="input-default" style="width:200px; " maxlength="20" onkeyup="checkText(this.value,this),getInsert()" />                  
                                       
                </li>                
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


<!--div class="panel panel-info hdfgrd"-->
<div class="panel panel-info hdfgrd">
    <div class="panel-body">
    	<?php
		
		
		
			$this->widget('zii.widgets.grid.CGridView', array(
			'id' => 'list-gridform',
			'dataProvider' => $modelform,
			'htmlOptions' => array('style' => 'margin: auto; width: 100%;'),
			'itemsCssClass' => 'table table-bordered table-striped',			
			'rowHtmlOptionsExpression'=>'array("data-id"=>$data["id"])',
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
				array(
								//'name'=>'',
								'type' => 'html', 
								'value' => function($modelform){ 
									if($modelform['type']!="TSD"){
										echo '<button id="btnpaper"  data-idbank="'.$modelform['id'].'" onclick="setUpdaterequestfrom(this)" ><i class="glyphicon glyphicon-pencil"></i></button>'; 	
									}
								},
								'header' => '',
								'htmlOptions'=>array('style'=>'text-align:center; width:35px;'),
								'headerHtmlOptions'=>array('style'=>'text-align:center;'),
							),	
				array(
					'name'=>'id',
					'header' => 'ลำดับ',					
					'htmlOptions'=>array('style'=>'text-align:center; width:20px;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				),	
																
				array(
					'name'=>'doc_no',
					'header' => 'เลขหนังสือ',
					'htmlOptions'=>array('style'=>'width:110px;'),
					'headerHtmlOptions'=>array('style'=>'width:110px; text-align:center;'),
				),
				array(
					'name'=>'doc_date',
					'header' => 'วันที่หนังสือ',
					'htmlOptions'=>array('style'=>'text-align:center; width:30px;'),
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
				),			
				array(
					'name'=>'acc_employer',
					'header' => 'เลขนายจ้าง',
					'htmlOptions'=>array('style'=>'text-align:left;width:50px;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				),			
				array(
					'name'=>'business_name',
					'header' => 'ประเภทธุรกิจ',
					'htmlOptions'=>array('style'=>'text-align:left;width:130px;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				),				 
				array(
					'name'=>'full_name',
					'header' => 'ชื่อ - สกุล',
					'htmlOptions'=>array('style'=>'text-align:left;width:150px;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				),
				array(
					'name'=>'pid',
					'header' => 'เลขป.ช.ช / เลขทะเบียนพาณิชย์',
					'htmlOptions'=>array('style'=>'text-align:left; width:130px;'),
					'headerHtmlOptions'=>array('style'=>'width:130px; text-align:center;'),
				),
				array(
					'name'=>'birth',
					'header' => 'วันเกิด',
					'htmlOptions'=>array('style'=>'text-align:left; width:80px;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				),				  				 	
				array(
					'name'=>'address',
					'header' => 'ที่อยู่',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'name'=>'create_date',
					'header' => 'วันที่บันทึก',
					'htmlOptions'=>array('style'=>'text-align:left;width:30px;'),
					'headerHtmlOptions'=>array('style'=>'width:30px; text-align:center;'),
				),
				array(
					'name'=>'type',
					'header' => 'ประเภท',
					'htmlOptions'=>array('style'=>'text-align:left;width:30px;'),
					'headerHtmlOptions'=>array('style'=>'width:30px; text-align:center;'),
				),					
			),
		));
		?>
  	</div>
</div>




<div id="modaldetail" class="modal fade" aria-hidden="true" aria-labelledby="modaldetailLabel" role="dialog" tabindex="-1">
    <div class="modal-dialog" style="width:800px; margin-top:88px;">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px 20px 7px;">
                <button class="close" data-dismiss="modal" type="button">
                	<span aria-hidden="true">×    <span class="sr-only">Close</span>
                </button>
                <h1 id="modaldetailLabel" class="modal-title">บันทึกข้อมูล</h1>
            </div>
           	<div class="modal-body">            		
        		<ul>                    
                    <li style="list-style:none; margin-top:15px">
                        <label class="txtlabel">เลขบัญชีนายจ้าง : <font color="red">*</font></label>
                        <input type="text" class="input-default" maxlength="10" id="txtacc_employer" style="width:300px;" onkeyup="checkText(this.value,this)">                            
                    </li>                    
                    <li style="list-style:none; margin-top:15px">   
                        <label class="txtlabel">บุคคล / นิติบุคคล : <font color="red">*</font></label>
                        <select class="input-default" id="drppid" style="width:300px;" onChange="typeselect('');">
                            <option value="">--เลือก--</option>     
                            <option value="1">บุคคล</option>   
                            <option value="2">นิติบุคคล</option>                                                						
                        </select>                            	
                    </li>
					 <li style="list-style:none; margin-top:15px" class="hdf5">   
                        <label class="txtlabel">ประเภทบุคคล : <font color="red">*</font></label>
                        <select class="input-default" id="drpet" style="width:300px;" onChange="empselect2('');">
							<option value="">--เลือก--</option> 
                            <option value="1">บุคคลภายในประเทศ</option>   
                            <option value="2">บุคคลต่างประเทศ</option>                                                						
                        </select>                            	
                    </li>   
                    <li style="list-style:none; margin-top:15px">
                    	<div class="hdf">
                            <label class="txtlabel" id="txttype"></label>                        
                            <select class="input-default" id="drptype" style="width:300px;" onChange="hdf();"
                                <option value="">--เลือก--</option>
                                
                            </select>
                        </div>
          
                    </li>      
                   
                    <li style="list-style:none; margin-top:15px" class="hdf2">                        	
                        <label class="txtlabel">ชื่อสถานประกอบการ : <font color="red">*</font></label>
                        <input type="text" class="input-default" id="txtcompany_name" style="width:510px;" maxlength="50" placeholder="เช่น บริษัท ABC" onkeyup="checkText(this.value,this)" />
                    </li>   
                    <li style="list-style:none; margin-top:15px" class="hdf2">   
                        <label class="txtlabel">ประเภทเลขนิติบุคคล : <font color="red">*</font></label>
                        <select class="input-default" id="drpemptype" style="width:300px;" onChange="empselect('');">                           
                            <option value="1">เลข 13 หลัก (กรมพัฒนาธุรกิจการค้า)</option>   
                            <option value="2">จากหน่วยงานอื่น ๆ</option>                                                						
                        </select>                            	
                    </li>
                    <li style="list-style:none; margin-top:15px" class="hdf2">
                        <label class="txtlabel">เลขนิติบุคคล : <font color="red">*</font></label>                            
                        <input type="text" class=" input-default" style=" width:300px; margin-top:-5px; " maxlength="15" id="txtcid" onkeyup="checkText(this.value,this)" placeholder="เลขนิติบุคคล 13 หลัก">
                    </li>                    
                    <li style="list-style:none; margin-top:15px" class="hdf3">
                        <label class="txtlabel">ชื่อ : <font color="red">*</font></label>
                        <input type="text" class="input-default" maxlength="50" id="txtname" style="width:200px;" onkeyup="checkText(this.value,this)">
                        <label class="hdf1" style="margin-left:10px;">นามสกุล : <font color="red">*</font></label>
                        <input type="text" class="input-default hdf1" maxlength="50" id="txtlname" style="width:200px;margin-left:15px;" onkeyup="checkText(this.value,this)">
                    </li>
                   	<li style="list-style:none; margin-top:15px" class="hdf3">
                        <label class="txtlabel">เลขบัตรประชาชน/เลขหนังสือเดินทาง : <font color="red">*</font></label>
                        <input type="text" class="input-default" style=" width:200px; margin-top:-5px; " maxlength="13" id="txtpid" placeholder="บัตรประชาชน/เหนังสือเดินทาง" onkeyup="checkText(this.value,this)">
                    </li>                    
                   	<li style="list-style:none; margin-top:15px" class="hdf3">
                        <label class="txtlabel">วัน/เดือน/ปี เกิด :</label>
                        <input id="txtbirth" type="text" class="input-default ipdisable txtcalendar" style="width:200px;" maxlength="10" disabled/>
                        <span class="btncalendar" id="btnbirth" style="cursor:pointer;" title="เลือกปฏิทิน">
                            <span class="glyphicon glyphicon-calendar" style="color: #007CFF" ></span>
                        </span>
                        <span class="btncalendar1" id="date_brd1" onClick="clearcalendar1();" style="cursor:pointer; margin-left:-65px;" title="ยกเลิกวันที่">
                            <span class="glyphicon glyphicon-remove" style="color:#FC0004" ></span>
                        </span>
                    </li>
                    <li style="list-style:none; margin-top:15px" class="hdf4">
                        <label class="txtlabel" >ที่อยู่ : <font color="red">*</font></label>
                        <input type="text" class="input-default" maxlength="200" id="txtaddress" style="width:510px;" placeholder="กรุณากรอกเฉพาะตัวอักษรและตัวเลขเท่านั้น" onkeyup="checkText(this.value,this)">                              
                    </li> 
					<li style="list-style:none; margin-top:15px" class="hdf4">
                        <label class="txtlabel" >รหัสไปรษณีย์ : <font color="red">*</font></label>
                        <input type="text" class="input-default" maxlength="5" id="txtzipcode" style="width:100px;" placeholder="" onkeyup="checkText(this.value,this)">                              
                    </li> 
                    <div class="aa">
                    <?php if(Yii::app()->user->getInfo('userlevel_id')=='1') { ?>
                        <li style="list-style:none; margin-top:15px" >
                            <label class="txtlabel" >ข้อมูลไม่สมบูรณ์ : </label>
                            <input type="checkbox" id="radio_request" onChange="advs()" />                            
                        </li>
                    <?php } ?>
                        <li style="list-style:none; margin-top:15px" class="advs" >
                            <label class="txtlabel" >หมายเหตุ : </label>
                            <input type="text" class="input-default" maxlength="200" id="txtremark" style="width:510px;" onkeyup="checkText(this.value,this)">
                        </li>
                    </div>                    
           		</ul>  
            </div>
            <div class="modal-footer" style="padding: 7px 20px"> 
            	<div>                	   
                    <Button id="btcledit"class="btn btn-default" style="float:right;" data-dismiss="modal" Width="80px">ย้อนกลับ</Button>
                </div>
            	<div class="aa">
                	<input type="button" class="btn btn-danger btndel" style="float:left;" onClick="setDelete();" value="ลบ" />
                	<input type="button" id="buttonsave" class="btn btn-success" name="ok" style="float:right; margin-right:10px;" onClick="ajax_savedata();" value="บันทึก"/>   
                </div>                
            </div>            
        </div>
    </div>
</div>


<script type="text/javascript">
$("#hdfstatus").val('add');
$('#hdftype').val("<?php echo Yii::app()->params['data_ctrl']['businesstype']['othtr']; ?>");
var storage = [];
	<?php 	
		$data=lookupdata::getPrefix();
		foreach($data as $obj) {			
	?>	
			storage.push('<?php echo $obj['name']; ?>');
			
	<?php
		};
	?>
jQuery(document).ready(function ($) {
	

	
	$('Button[id=btnadd]').click(function () {
	$("#modaldetailLabel").html("เพิ่มข้อมูล");                
	$("#modaldetail").modal('show');
	$('#txtacc_employer').val('');		
	$('#drppid').val('');				
	$('#txtremark').val('');
	$('#hdfid').val('');
	typeselect();
    });
    $('#modaldetail').on('show.bs.modal', function (e) {
	});
    $('#modaldetail').on('hidden.bs.modal', function (e) {    
		$(".btndel").css("display", "none");
	});
			
	$("#txtbirth").attr("disabled", "disabled"); 
	$("#txtbirth").css('background-color', '#ccc');	 
	  $('#txtbirth').datepicker({
			format: 'dd/mm/yyyy',
			todayBtn: true,
			language: 'th',             
			thaiyear: true              
		});  //กำหนดเป็นวันปัจุบัน		
	$('#btnbirth').click(function () {
			
			$("#txtbirth").removeAttr("disabled"); 
			$('#txtbirth').datepicker('show');
			$("#txtbirth").attr("disabled", "disabled"); 
			$("#txtbirth").css('background-color', '#ccc');

	});
		
	$("#txtdoc_date").attr("disabled", "disabled"); 
	$("#txtdoc_date").css('background-color', '#ccc');	 
	  $('#txtdoc_date').datepicker({
			format: 'dd/mm/yyyy',
			todayBtn: true,
			language: 'th',             
			thaiyear: true              
		});  	
	$('#btndocdate').click(function () {
			
			$("#txtdoc_date").removeAttr("disabled"); 
			$('#txtdoc_date').datepicker('show');
			$("#txtdoc_date").attr("disabled", "disabled"); 
			$("#txtdoc_date").css('background-color', '#ccc');

	}); 
	<?php if($state=='edit'){ ?>	
		$("#hdfstatus").val('edit');
		$('#hdfid').val('<?php echo $id; ?>');
		$('#txtdoc_no').val('<?php echo $doc_no; ?>');
		$('#txtdoc_date').val('<?php echo $doc_date; ?>');
		$('#txtdoc_no_tsd').val('<?php echo $doc_no_tsd; ?>');
		alert('1'+$('#txtdoc_no_tsd').val('<?php echo $doc_no_tsd; ?>'));
		return;
		$("#txtdoc_no").css('background-color', '#ccc');
		$("#txtdoc_no").attr("disabled", "disabled");
		$(".btn2").css("display", "none");
		$(".btn1").css("display", "block");
		$("#btndocdate").css("display", "none");
		$("#date_st").css("display", "none");
		$(".hdfgrd").css("display", "block");
		
		
	<?php }else{ ?>	
		
		$("#hdfstatus").val('add');
		$('#hdfid').val('');
		$('#txtdoc_no').val('');
		$('#txtdoc_date').val('');
	//	$('#txtdoc_date').val('');
	<?php }  ?>	
	 
});


function clearcalendar(){
	$('#txtdoc_date').val('');
}

function clearcalendar1(){
	$('#txtbirth').val('');
}

function ajax_savehead() {
	
	if($('#txtdoc_no').val()==''){
		alert('กรุณากรอกเลขที่หนังสือ');
		return;
	}
	if($('#txtdoc_date').val()==''){
		alert('กรุณากรอกวันที่หนังสือ');
		return;
	}
	$("#txtdoc_no").css('background-color', '#ccc');
	$("#txtdoc_no").attr("disabled", "disabled");
	$(".btn2").css("display", "none");
	$(".btn1").css("display", "block");
	$("#btndocdate").css("display", "none");
	$("#date_st").css("display", "none");
}
function getSearch() {
	var doc_no = $('#txtdoc_no').val();
	var doc_no_tsd = $('#txtdoc_no_tsd').val();	
	var aa=$('#txtdoc_date').val();
	var aaa = ex_date2db(aa);
	var aaDate = new Date(aaa)
	var aaMonth = ((aaDate.getMonth().length+1) === 1)? (aaDate.getMonth()+1) : + (aaDate.getMonth()+1); 
	var doc_date = (aaDate.getFullYear()-543) + "-" + aaMonth + "-" + aaDate.getDate();
	
	if(doc_date=='NaN-NaN-NaN'){
		doc_date=null;			
	}

	var data = {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','doc_no':doc_no,'doc_date':doc_date,'doc_no_tsd':doc_no_tsd}; 
	$.fn.yiiGridView.update('list-gridform', {
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("request/searchform"); ?>',
		data: data,
	});	
	$(".hdfgrd").css("display", "block");
} 

function ajax_savedata() 
{
	
	if($('#txtdoc_no_tsd').val()!='')
		{ 
		  var sa=$('#txtdoc_no_tsd').val(); 
		  var letters =  /[A-Za-z._0-9%+-\/!@#$%^&* ]|[ก-๙]/g;
		//  exit;
		// var letters =  /\''  '\' /g;
		
		  var sss = sa.match(letters);
			if(sa.length != sss.length){
				swal({
					title: "มีบางอย่าผิดปกติ !",
					text: "เลขหนังสือไม่ควรมี อักษรฟังชั่น match !",
					icon: "warning",
					button: "ตกลง",
				});
				var inputVal = document.getElementById("txtdoc_no_tsd");
				inputVal.style.borderColor  = "red";			
					return;	
					
			}else{
				var inputVal = document.getElementById("txtdoc_no_tsd");
				inputVal.style.borderColor  = "";
			}
		 
		  }		
	if($('#txtdoc_no').val()!='')
		{ 
		  var sa=$('#txtdoc_no').val(); 
		  var letters =  /[A-Za-z._0-9%+-\/!@#$%^&* ]|[ก-๙]/g;
		//  exit;
		// var letters =  /\''  '\' /g;
		
		  var sss = sa.match(letters);
			if(sa.length != sss.length){
				swal({
					title: "มีบางอย่าผิดปกติ !",
					text: "เลขหนังสือไม่ควรมี อักษรฟังชั่น match !",
					icon: "warning",
					button: "ตกลง",
				});
				var inputVal = document.getElementById("txtdoc_no");
				inputVal.style.borderColor  = "red";			
					return;	
					
			}else{
				var inputVal = document.getElementById("txtdoc_no");
				inputVal.style.borderColor  = "";
			}
		 
		  }		
	if($('#txtacc_employer').val()!='')
		{ 
		  var sa=$('#txtacc_employer').val(); 
		  var letters =  /[A-Za-z._0-9%+-\/!@#$%^&* ]|[ก-๙]/g;
		//  exit;
		// var letters =  /\''  '\' /g;
		
		  var sss = sa.match(letters);
			if(sa.length != sss.length){
				swal({
					title: "มีบางอย่าผิดปกติ !",
					text: "เลขทะเบียนนายจ้างไม่ควรมี อักษรฟังชั่น match !",
					icon: "warning",
					button: "ตกลง",
				});
				var inputVal = document.getElementById("txtacc_employer");
				inputVal.style.borderColor  = "red";			
					return;	
					
			}else{
				var inputVal = document.getElementById("txtacc_employer");
				inputVal.style.borderColor  = "";
			}
		 
		  }	
	
  if($('#txtname').val()!='')
	{ 

	  var sa=$('#txtname').val(); 
      var letters =  /[A-Za-z._0-9%+-\/!@#$%^&* ]|[ก-๙]/g;
	//  exit;
	// var letters =  /\''  '\' /g;
	
      var sss = sa.match(letters);
		if(sa.length != sss.length){
			swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "ชื่อไม่ควรมี อักษรฟังชั่น match !",
				icon: "warning",
				button: "ตกลง",
			});
			var inputVal = document.getElementById("txtname");
			inputVal.style.borderColor  = "red";			
				return;	
				
		}else{
			var inputVal = document.getElementById("txtname");
			inputVal.style.borderColor  = "";
		}
	 
      }
 if($('#txtlname').val()!='')
	{ 
	  var sa=$('#txtlname').val(); 
      var letters =  /[A-Za-z._0-9%+-\/!@#$%^&* ]|[ก-๙]/g;
	//  exit;
	// var letters =  /\''  '\' /g;
	
      var sss = sa.match(letters);
		if(sa.length != sss.length){
			swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "นามสกุลไม่ควรมี อักษรฟังชั่น match !",
				icon: "warning",
				button: "ตกลง",
			});
			var inputVal = document.getElementById("txtlname");
			inputVal.style.borderColor  = "red";			
				return;	
				
		}else{
			var inputVal = document.getElementById("txtlname");
			inputVal.style.borderColor  = "";
		}
	 
      }
  if($('#txtcid').val()!='')
	{ 
	  var sa=$('#txtcid').val(); 
      var letters =  /[A-Za-z._0-9%+-\/!@#$%^&* ]|[ก-๙]/g;
	
      var sss = sa.match(letters);
		if(sa.length != sss.length){
			swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "เลขนิติบุคคลไม่ควรมี อักษรฟังชั่น match !",
				icon: "warning",
				button: "ตกลง",
			});
			var inputVal = document.getElementById("txtcid");
			inputVal.style.borderColor  = "red";			
				return;	
				
		}else{
			var inputVal = document.getElementById("txtcid");
			inputVal.style.borderColor  = "";
		}
	 
      } 	  
  if($('#txtpid').val()!='')
	{ 
	  var sa=$('#txtpid').val(); 
      var letters =  /[A-Za-z._0-9%+-\/!@#$%^&* ]|[ก-๙]/g;
	
      var sss = sa.match(letters);
		if(sa.length != sss.length){
			swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "เลขบัตรประชาชนไม่ควรมี อักษรฟังชั่น match !",
				icon: "warning",
				button: "ตกลง",
			});
			var inputVal = document.getElementById("txtpid");
			inputVal.style.borderColor  = "red";			
				return;	
				
		}else{
			var inputVal = document.getElementById("txtpid");
			inputVal.style.borderColor  = "";
		}
	 
      } 
  if($('#txtaddress').val()!='')
	{ 
	  var sa=$('#txtaddress').val(); 
      var letters =  /[A-Za-z._0-9%+-\/!@#$%^&* ]|[ก-๙]/g;
	
      var sss = sa.match(letters);
		if(sa.length != sss.length){
			swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "ที่อยุ๋ไม่ควรมี อักษรฟังชั่น match !",
				icon: "warning",
				button: "ตกลง",
			});
			var inputVal = document.getElementById("txtaddress");
			inputVal.style.borderColor  = "red";			
				return;	
				
		}else{
			var inputVal = document.getElementById("txtaddress");
			inputVal.style.borderColor  = "";
		}
	 
      }
	  if($('#txtzipcode').val()!='')
		{ 
		  var sa=$('#txtzipcode').val(); 
		  var letters =  /[A-Za-z._0-9%+-\/!@#$%^&* ]|[ก-๙]/g;
	
		  var sss = sa.match(letters);
			if(sa.length != sss.length){
				swal({
					title: "มีบางอย่าผิดปกติ !",
					text: "เลขหนังสือไม่ควรมี อักษรฟังชั่น match !",
					icon: "warning",
					button: "ตกลง",
				});
				var inputVal = document.getElementById("txtzipcode");
				inputVal.style.borderColor  = "red";			
					return;	
					
			}else{
				var inputVal = document.getElementById("txtzipcode");
				inputVal.style.borderColor  = "";
			}
		 
		  }		
	if($('#txtcompany_name').val()!='')
	{ 
	  var sa=$('#txtcompany_name').val(); 
      var letters =  /[A-Za-z._0-9%+-\/!@#$%^&* ]|[ก-๙]/g;
	
      var sss = sa.match(letters);
		if(sa.length != sss.length){
			swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "ชื่อสถานประกอบการไม่ควรมี อักษรฟังชั่น match !",
				icon: "warning",
				button: "ตกลง",
			});	
			var inputVal = document.getElementById("txtcompany_name");
			inputVal.style.borderColor  = "red";			
				return;	
		}else{
			var inputVal = document.getElementById("txtcompany_name");
			inputVal.style.borderColor  = "";
		}
	 
      }
	
	var isText=true;
	var txt1 = "'";
	var txt2 = '"';	
	var txt3 = "๑๒๓๔๕๖๗๘๙๐";
    var orgi_text=txt1+txt2+txt3;

	var state=$('#hdfstatus').val();
	var id=$('#hdfid').val();
	
	var doc_no=$.trim($('#txtdoc_no').val());
	
	var acc_employer=$.trim($('#txtacc_employer').val());
	
	//บุคคล
	var name = $.trim($('#txtname').val());			
	var lname = $.trim($('#txtlname').val());	
	var pid = $.trim($('#txtpid').val());
	//นิติ
	var company = $.trim($('#txtcompany_name').val());
	var emptype = $('#drpemptype').val();
	var cid = $.trim($('#txtcid').val());
	
	var address=$.trim($('#txtaddress').val());	
	
	var chk_text="";
	var chk ='';
	if($('#txtdoc_date').val()==''){
		alert('กรุณากรอกวันที่หนังสือ');
		return;
	}
	
	if(doc_no!=''){
		chk_text=doc_no.split("");
		chk_text.filter(function(s){        
			if(orgi_text.indexOf(s)!=-1){
				alert("เลขที่หนังสือมีอักขระพิเศษ !");
				return;
			}           
		});
	}else{
		alert('กรุณากรอกเลขที่หนังสือ');
		return;
	}
	
	
	
	if(acc_employer!=''){
		if(acc_employer.length<10){
			swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "กรุณากรอกเลขบัญชีนายจ้างให้ครบ !",
				icon: "warning",
				button: "ตกลง",
			});		
			return;
		}	
		chk_text=acc_employer.split("");
		chk_text.filter(function(s){        
			if(orgi_text.indexOf(s)!=-1){
				swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "เลขบัญชีนายจ้างมีอักขระพิเศษ !",
				icon: "warning",
				button: "ตกลง",
			});		
				return;				
			}           
		}); 
	}else{
		swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "กรุณากรอกเลขบัญชีนายจ้าง !",
				icon: "warning",
				button: "ตกลง",
			});		
		return;
		
	}
	
	if($('#drpid').val()==''){
		swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "กรุณาเลือกประเภท บุคคล / นิติบุคคล !",
				icon: "warning",
				button: "ตกลง",
			});		
		return;
	}else{		
		if($('#drppid').val()==1){
			if($('#drptype').val()==''){
				swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "กรุณาเลือกคำนำหน้าชื่อ !",
				icon: "warning",
				button: "ตกลง",
			});		
				return;
			}
			if($('#drpet').val()==''){
				swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "กรุณาเลือกประเภทบุคคล !",
				icon: "warning",
				button: "ตกลง",
			});		
				return;
			}
			if(name!=''){
				chk = name;
				chk_text=name.split("");
				chk_text.filter(function(s){        
					if(orgi_text.indexOf(s)!=-1){
						swal({
						title: "มีบางอย่าผิดปกติ !",
						text: "ชื่อมีอักขระพิเศษ !",
						icon: "warning",
						button: "ตกลง",
					});		
						return;				
					}           
				}); 
			}else{
				swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "กรุณากรอกชื่อ !",
				icon: "warning",
				button: "ตกลง",
			});		
				return;
			}
			
			if($('#drptype').val()!=25){
				if(lname!=''){
					chk_text=lname.split("");
					chk_text.filter(function(s){        
						if(orgi_text.indexOf(s)!=-1){
							swal({
							title: "มีบางอย่าผิดปกติ !",
							text: "นามสกุลมีอักขระพิเศษ !",
							icon: "warning",
							button: "ตกลง",
						});		
							return;				
						}           
					});
				}else{
					swal({
					title: "มีบางอย่าผิดปกติ !",
					text: "กรุณากรอกนามสกุล !",
					icon: "warning",
					button: "ตกลง",
				});		
					return;
				}
			}
			
			if(pid!=''){
				var ck_txtpid = pid.length;
				if($('#drpet').val()==1)
				{
						if(ck_txtpid<13){
			swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "กรุณากรอกเลขบัตรประชาชนให้ครบถ้วน !",
				icon: "warning",
				button: "ตกลง",
			});		
					return;
				}
				chk_text=pid.split("");
				chk_text.filter(function(s){        
					if(orgi_text.indexOf(s)!=-1){
			swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "เลขบัตรประชาชนมีอักขระพิเศษ !",
				icon: "warning",
				button: "ตกลง",
			});		
						return;				
					}           
				});
				}
				else
				{
					if(ck_txtpid<5 || ck_txtpid>13)
					{				
			swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "กรุณากรอกเลขหนังสือเดินทางให้ครบ !",
				icon: "warning",
				button: "ตกลง",
			});		
						return;
					}
			chk_text=pid.split("");
				chk_text.filter(function(s){        
					if(orgi_text.indexOf(s)!=-1){
			swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "เลขบัตรประจำตัวประชาชนมีอักขระพิเศษ !",
				icon: "warning",
				button: "ตกลง",
			});		
						return;				
					}           
				});
				}
			}else{
			swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "กรุณากรอกเลขบับัตรประจำตัวประชาชน !",
				icon: "warning",
				button: "ตกลง",
			});		
				return;				
			}
			
			
			
			
		}else{
			if($('#drptype').val()==''){
			swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "กรุณาเลือกประเภทธุรกิจ !",
				icon: "warning",
				button: "ตกลง",
			});		
				return;
			}
			if(cid!=''){
				chk_text=cid.split("");
				chk_text.filter(function(s){        
					if(orgi_text.indexOf(s)!=-1){
			swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "เลขนิติบุคคลมีอักขระพิเศษ !",
				icon: "warning",
				button: "ตกลง",
			});		
						return;				
					}           
				});
			}else{
			swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "กรุณากรอกเลขทะเบียนนิติบุคคล !",
				icon: "warning",
				button: "ตกลง",
			});		
				return;
			}
			
			
			var ck_emp = $('#drpemptype').val();			
			var ck_txtcid = cid.length;
			
			if(ck_emp==1){
				if(ck_txtcid!=13){				
					swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "กรุณากรอกเลขนิติบุคคลให้ครบ 13 หลัก !",
				icon: "warning",
				button: "ตกลง",
			});		
					return;
				}				
			}else{
				if(ck_txtcid<5 || ck_txtcid>15){				
			swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "กรุณากรอกเลขทะเบียนนิติบุคคลให้ครบ !",
				icon: "warning",
				button: "ตกลง",
			});		
					return;
				}
			}
			
			
			if(company!='')
			{
				chk = company;
				chk_text=company.split("");
				chk_text.filter(function(s){        
					if(orgi_text.indexOf(s)!=-1){
						swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "ชื่อสถานประกอบการมีอักขระพิเศษ !",
				icon: "warning",
				button: "ตกลง",
			});		
						return;				
					}           
				});
			}else{
				swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "กรุณากรอกชื่อสถานประกอบการ !",
				icon: "warning",
				button: "ตกลง",
			});		
				return;
				
			}		
		}
	}
	if(address!=""){
		chk_text=address.split("");
		chk_text.filter(function(s){        
			if(orgi_text.indexOf(s)!=-1){
				swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "ชื่อสถานประกอบการมีอักขระพิเศษ !",
				icon: "warning",
				button: "ตกลง",
			});		
				return;				
			}           
		});
		
	}else{
		swal({
				title: "มีบางอย่าผิดปกติ !",
				text: "กรุณากรอกที่อยู่ !",
				icon: "warning",
				button: "ตกลง",
			});		
		return;
		
	}
	
	var i =0;
	
	$.each(storage, function(key, value) {
		if(chk.indexOf(value) !== -1){ 
			i=1;
			var r = confirm("ชื่อที่คุณกรอกข้อมูลมีคำนำหน้าชื่อในระบบแล้ว คุณต้องการดำเนินการต่อหรือไม่ !");
	
			if (r == true) {
				save_data();
		  	}
		} 
	});
	var chkname = [];
	chkname.push('บริษัท');
	$.each(chkname, function(key, value) {
		if(chk.indexOf(value) !== -1){ 
			i=2;
			var r = confirm("ชื่อที่คุณกรอกข้อมูลมีคำนำหน้าชื่อในระบบแล้ว คุณต้องการดำเนินการต่อหรือไม่ !");
	
			if (r == true) {
				save_data();
		  	}
		} 
	});
	
	if(i==0){
		
		save_data();
	}
}	
function save_data()
{
	
	var id=$('#drppid').val();
	
//	$('#buttonsave').attr('disabled','disabled');
	if(id==1)
	{
		
		var state=$('#hdfstatus').val();
		var id=$('#hdfid').val();
		var doc_no=$('#txtdoc_no').val();
		var doc_no_tsd=$('#txtdoc_no_tsd').val();
		var zipcode=$('#txtzipcode').val();
		var acc_employer=$('#txtacc_employer').val();
		var pid_type=$('#drppid').val();
		var business_type=$('#drptype').val();
		var name = $.trim($('#txtname').val());			
		var lname = $.trim($('#txtlname').val());
		if(business_type==25){lname=''}
		var bb = $('#txtbirth').val();
		var pid = $('#txtpid').val();
		var company = $.trim($('#txtcompany_name').val());
		var emptype = $('#drpet').val();
		
		var cid = $('#txtcid').val();
		var address=$.trim($('#txtaddress').val());	
		var aa=$('#txtdoc_date').val();
			
		var bbb = ex_date2db(bb);	
		var aaa = ex_date2db(aa);
	
	
	
	
	
		var aaDate = new Date(aaa)
		var aaMonth = ((aaDate.getMonth().length+1) === 1)? (aaDate.getMonth()+1) : + (aaDate.getMonth()+1); 
		var doc_date = (aaDate.getFullYear()-543) + "-" + aaMonth + "-" + aaDate.getDate();
		
		var bbDate = new Date(bbb)
		var bbMonth = ((bbDate.getMonth().length+1) === 1)? (bbDate.getMonth()+1) : + (bbDate.getMonth()+1); 
		var birth = (bbDate.getFullYear()-543) + "-" + bbMonth + "-" + bbDate.getDate();
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
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl("request/savedata"); ?>",
			data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
					'id':id,
					'doc_no':doc_no,'doc_no_tsd':doc_no_tsd,'acc_employer':acc_employer,'pid_type':pid_type,'business_type':business_type,
					'name':name,'lname':lname,'birth':birth,'pid':pid,'cid':cid,'emptype':emptype,
					'company':company,'address':address,'doc_date':doc_date,'active':active,'remark':remark,'state':state,'zipcode':zipcode
			},
			dataType: "json",				
			success: function (data) {
				if (data.status=='success') {	
					$('#txtacc_employer').val('');		
					$('#drppid').val('');				
					$('#txtremark').val('');
					$("#txtdoc_no").attr("disabled", "disabled");
					$("#txtdoc_no").css({"background-color": "#ccc"});
					$("#btndocdate").css("display", "none");
					$("#date_st").css("display", "none");
					typeselect();
					getSearch();
					$("#modaldetail").modal('hide');
					$('#buttonsave').removeAttr('disabled');
		swal({
				title: "สำเร็จ !",
				text: "ทำการบันทึกข้อมูลสำเร็จ",
				icon: "success",
				button: "ตกลง",
		});	
				}
				else{
					alert(data.msg);
				} 
			}
		});
	}
	else
	{	
		var state=$('#hdfstatus').val();
		var id=$('#hdfid').val();
		var doc_no=$('#txtdoc_no').val();
		var doc_no_tsd=$('#txtdoc_no_tsd').val();
		var zipcode=$('#txtzipcode').val();
		var acc_employer=$('#txtacc_employer').val();
		var pid_type=$('#drppid').val();
		var business_type=$('#drptype').val();
		var name = $.trim($('#txtname').val());			
		var lname = $.trim($('#txtlname').val());
		if(business_type==25){lname=''}
		var bb = $('#txtbirth').val();
		var pid = $('#txtpid').val();
		var company = $.trim($('#txtcompany_name').val());
		var emptype = $('#drpemptype').val();
		var cid = $('#txtcid').val();
		
		var address=$.trim($('#txtaddress').val());	
		var aa=$('#txtdoc_date').val();
			
		var bbb = ex_date2db(bb);	
		var aaa = ex_date2db(aa);
		
		
		
		
		
		var aaDate = new Date(aaa)
		var aaMonth = ((aaDate.getMonth().length+1) === 1)? (aaDate.getMonth()+1) : + (aaDate.getMonth()+1); 
		var doc_date = (aaDate.getFullYear()-543) + "-" + aaMonth + "-" + aaDate.getDate();
		
		var bbDate = new Date(bbb)
		var bbMonth = ((bbDate.getMonth().length+1) === 1)? (bbDate.getMonth()+1) : + (bbDate.getMonth()+1); 
		var birth = (bbDate.getFullYear()-543) + "-" + bbMonth + "-" + bbDate.getDate();
		
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
		
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl("request/savedata"); ?>",
			data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'id':id,
					'doc_no':doc_no,'doc_no_tsd':doc_no_tsd,'acc_employer':acc_employer,'pid_type':pid_type,'business_type':business_type,
					'name':name,'lname':lname,'birth':birth,'pid':pid,'cid':cid,'emptype':emptype,
					'company':company,'address':address,'doc_date':doc_date,'active':active,'remark':remark,'state':state,'zipcode':zipcode
			},
			dataType: "json",				
			success: function (data) {
				if (data.status=='success') {	
					$('#txtacc_employer').val('');		
					$('#drppid').val('');				
					$('#txtremark').val('');
					$("#txtdoc_no").attr("disabled", "disabled");
					$("#txtdoc_no").css({"background-color": "#ccc"});
					$("#btndocdate").css("display", "none");
					$("#date_st").css("display", "none");
					typeselect();
					getSearch();
					$("#modaldetail").modal('hide');
					$('#buttonsave').removeAttr('disabled');
				}
				else{
					alert(data.msg);
				} 
			}
		});
	}
}

function empselect(type)
{	
	var emptype = $('#drpemptype').val();
	
	if(emptype!=1){
		$("#txtcid").attr("placeholder",  "เลขนิติบุคคลที่ได้จากหน่วยงานอื่น").val('').focus().blur();
	}else{
		$("#txtcid").attr("placeholder",  "เลขนิติบุคคล 13 หลัก").val('').focus().blur();
	}
}
function empselect2(type)
{	
	var emptype = $('#drpet').val();
	
	if(emptype!=1){
		$("#txtpid").attr("placeholder",  "เลขที่หนังสือเดินทาง").val('').focus().blur();
	}else{
		$("#txtpid").attr("placeholder",  "เลขประจำตัวบัตรประชาชน").val('').focus().blur();
	}
}
function typeselect(type){	 
	var id = $('#drppid').val();	
	if(id==''){
		$(".hdf").css("display", "none");
		$(".hdf1").css("visibility", "");
		$(".hdf2").css("display", "none");
		$(".hdf3").css("display", "none");
		$(".hdf4").css("display", "none");
		$(".hdf5").css("display", "none");
		$('#txtname').val('');			
		$('#txtlname').val('');
		$('#txtbirth').val('');
		$('#txtpid').val('');
		$('#txtcompany_name').val('');
		$('#txtcid').val('');
		$('#txtaddress').val('');	
		$('#drpemptype').val('1');
		$("#txtcid").attr("placeholder",  "เลขนิติบุคคล 13 หลัก").val('').focus().blur();
		$("#txtname").attr("placeholder",  "").val('').focus().blur();
		return;
	}else{
		if(id==1){
			
				$(".hdf").css("display", "block");
				$(".hdf2").css("display", "none");
				$(".hdf3").css("display", "block");
				$(".hdf4").css("display", "block");
				$(".hdf5").css("display", "block");
				$("#txttype").html("คำนำหน้าชื่อ : <font color='red'>*</font>");	
				$(".hdf1").css("visibility", "");	
				$('#drpemptype').val('1');
		}else{
			$(".hdf1").css("visibility", "");	
			$(".hdf").css("display", "block");
			$(".hdf2").css("display", "block");
			$(".hdf3").css("display", "none");
			$(".hdf4").css("display", "block");
			$(".hdf5").css("display", "none");
			$("#txttype").html("ประเภทธุรกิจ : <font color='red'>*</font>");
		}
		$("#txtcid").attr("placeholder",  "เลขนิติบุคคล 13 หลัก").val('').focus().blur();
		$("#txtname").attr("placeholder",  "").val('').focus().blur();
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
    	url: "<?php echo Yii::app()->createAbsoluteUrl("request/selecttype"); ?>",
  		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id},
    	dataType: "json",				
    	success: function (data) {
			if (data.status=='success') {
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
	
	if(type==25){
		$(".hdf1").css("visibility", "hidden");
		$("#txtname").attr("placeholder",  "เช่น พตท. เก่ง เรียนดี").val('').focus().blur();
	}else{
		$(".hdf1").css("visibility", "");
		$("#txtname").attr("placeholder",  "").val('').focus().blur();
	}
}

function advs() {
	if ($('#radio_request').is(':checked')) {
		$(".advs").css("display", "block");
	}else{
		$(".advs").css("display", "none");
		$("#radio_request").val('1');
	}
}

function setUpdaterequestfrom(el) {
	
	var id = $(el).attr("data-idbank"); 
//	var bankid = $('#bankid').val();
	
	 $.ajax({
    	type: "POST",
    	url: "<?php  echo Yii::app()->createAbsoluteUrl("request/requestdata"); ?>",
  		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id},
    	dataType: "json",
		
		success: function (data) {
			if (data.status=='success') {					
				$('#hdfid').val(data.id);
				if(data.activereq==2){
					
					$("#txtdoc_no").attr("disabled", "disabled");
					$("#txtacc_employer").attr("disabled", "disabled");
					$("#drppid").attr("disabled", "disabled");
					$("#drptype").attr("disabled", "disabled");
					$("#txtname").attr("disabled", "disabled");
					$("#txtlname").attr("disabled", "disabled");
					$("#txtpid").attr("disabled", "disabled");
					$("#txtcid").attr("disabled", "disabled");
					$("#txtaddress").attr("disabled", "disabled");
					$("#txtcompany_name").attr("disabled", "disabled");
					
					
					$("#txtdoc_no").css({"background-color": "#ccc"});
					$("#txtacc_employer").css({"background-color": "#ccc"});
					$("#drppid").css({"background-color": "#ccc"});
					$("#drptype").css({"background-color": "#ccc"});
					$("#txtname").css({"background-color": "#ccc"});
					$("#txtlname").css({"background-color": "#ccc"});
					$("#txtpid").css({"background-color": "#ccc"});
					$("#txtcid").css({"background-color": "#ccc"});	
					$("#txtaddress").css({"background-color": "#ccc"});
					$("#txtcompany_name").css({"background-color": "#ccc"});	
					$(".aa").css("display", "none");
					
				}
				if(data.activereq==4){
					
					$("#txtdoc_no").attr("disabled", "disabled");
					$("#txtacc_employer").attr("disabled", "disabled");
					$("#drppid").attr("disabled", "disabled");
					$("#drptype").attr("disabled", "disabled");
					$("#txtname").attr("disabled", "disabled");
					$("#txtlname").attr("disabled", "disabled");
					$("#txtpid").attr("disabled", "disabled");
					$("#txtcid").attr("disabled", "disabled");
					$("#txtaddress").attr("disabled", "disabled");
					$("#txtcompany_name").attr("disabled", "disabled");
					
					
					$("#txtdoc_no").css({"background-color": "#ccc"});
					$("#txtacc_employer").css({"background-color": "#ccc"});
					$("#drppid").css({"background-color": "#ccc"});
					$("#drptype").css({"background-color": "#ccc"});
					$("#txtname").css({"background-color": "#ccc"});
					$("#txtlname").css({"background-color": "#ccc"});
					$("#txtpid").css({"background-color": "#ccc"});
					$("#txtcid").css({"background-color": "#ccc"});	
					$("#txtaddress").css({"background-color": "#ccc"});
					$("#txtcompany_name").css({"background-color": "#ccc"});	
					$(".aa").css("display", "none");
					
				}
				if(data.activereq==1){
					
					$("#txtdoc_no").attr("disabled", "disabled");
					$("#txtacc_employer").removeAttr("disabled");
					$("#drppid").removeAttr("disabled");
					$("#drptype").removeAttr("disabled");
					$("#txtname").removeAttr("disabled");
					$("#txtlname").removeAttr("disabled");
					$("#txtpid").removeAttr("disabled");
					$("#txtcid").removeAttr("disabled");
					$("#txtaddress").removeAttr("disabled");
					$("#txtcompany_name").removeAttr("disabled");						
					
					$("#txtdoc_no").css({"background-color": "#ccc"});
					$("#txtacc_employer").css({"background-color": "#fff"});
					$("#drppid").css({"background-color": "#fff"});
					$("#drptype").css({"background-color": "#fff"});
					$("#txtname").css({"background-color": "#fff"});
					$("#txtlname").css({"background-color": "#fff"});
					$("#txtpid").css({"background-color": "#fff"});
					$("#txtcid").css({"background-color": "#fff"});	
					$("#txtaddress").css({"background-color": "#fff"});
					$("#txtcompany_name").css({"background-color": "#fff"});	
					$(".aa").css("display", "block");
				}
				if(data.activereq==3){
					
					$("#txtdoc_no").attr("disabled", "disabled");
					$("#txtacc_employer").removeAttr("disabled");
					$("#drppid").removeAttr("disabled");
					$("#drptype").removeAttr("disabled");
					$("#txtname").removeAttr("disabled");
					$("#txtlname").removeAttr("disabled");
					$("#txtpid").removeAttr("disabled");
					$("#txtcid").removeAttr("disabled");
					$("#txtaddress").removeAttr("disabled");
					$("#txtcompany_name").removeAttr("disabled");						
					
					$("#txtdoc_no").css({"background-color": "#ccc"});
					$("#txtacc_employer").css({"background-color": "#fff"});
					$("#drppid").css({"background-color": "#fff"});
					$("#drptype").css({"background-color": "#fff"});
					$("#txtname").css({"background-color": "#fff"});
					$("#txtlname").css({"background-color": "#fff"});
					$("#txtpid").css({"background-color": "#fff"});
					$("#txtcid").css({"background-color": "#fff"});	
					$("#txtaddress").css({"background-color": "#fff"});
					$("#txtcompany_name").css({"background-color": "#fff"});	
					$(".aa").css("display", "block");
				}
				
				
				
				
				
				
				$('#txtdoc_no').val(data.doc_no);	
				$('#txtdoc_date').val(data.doc_date);	
				$('#txtacc_employer').val(data.acc_employer);		
				$('#drpemptype').val(data.emptype);		
				$('#drppid').val(data.pid_type);
				typeselect(data.business_type);
				if(data.business_type==25){
					$(".hdf1").css("visibility", "hidden");
						
				}else{
					$(".hdf1").css("visibility", "");
										
				}	
											
				$('#txtname').val(data.name);	
				$('#txtlname').val(data.lname);
				$('#txtbirth').val(data.birth);
				$('#txtpid').val(data.pid);
				$('#txtcid').val(data.cid);	
				$('#txtaddress').val(data.address);
				
				
				$('#txtcompany_name').val(data.company_name);
				$('#txtno').val(data.id);
				$('#txtstatus').val(data.active);
				$('#hdfstatus').val(data.activereq);
				
				
				<?php if(Yii::app()->user->getInfo('userlevel_id')!='1') { ?>
				if(data.activereq==3){						
					$("#radio_request").prop('checked', true);
					$("#txtremark").css({"background-color": "#ccc","color": "#000"});
					$('#txtremark').val(data.remark);	
					$("#txtremark").attr("disabled", "disabled"); 					
					advs();
					$(".advs").css("display", "block");
				}else{
					$("#radio_request").prop('checked', false);
					$("#txtremark").removeAttr("disabled");					 
				}					
				<?php }else{ ?>
				if(data.activereq==3){						
					$("#radio_request").prop('checked', true);						
					$('#txtremark').val(data.remark);			
					advs();
					$(".advs").css("display", "block");
				}else{
					$("#radio_request").prop('checked', false);
					$("#txtremark").removeAttr("disabled");					 
				}							 
				<?php } ?>					
				$(".btndel").css("display", "block");
				//$(".advs").css("display", "block");
				$("#modaldetailLabel").html("แก้ไขข้อมูล");   
				$("#modaldetail").modal('show');
				
			}else{
				alert(data.msg);
			} 			
	 	}
	});	
}
function getHeaddetail(el) {
	var id = $(el).parent().attr("data-id"); 
	
	$.ajax({
    	type: "POST",
    	url: "<?php  echo Yii::app()->createAbsoluteUrl("request/Searchhead"); ?>",
  		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id},
    	dataType: "json",				
		success: function (data) {
			if (data.status=='success') {
				$('#lbcode').html(data.code);
				$('#lbdate').html(data.doc_date);
				$('#lbacc_emp').html(data.acc_employer);
				$('#lbid').html(data.id);
				$('#lbfullname').html(data.full_name);			
				setDetail(id);
			}else{
				alert(data.msg);
			} 
		}
	});	
}
function setDetail(id) {	
	var data = {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>', 'id': id}; 
	$.fn.yiiGridView.update('list-griddetail', {
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("request/searchdetail"); ?>',
		data: data,
	});	
	$("#modalshow").modal('show');	
}

function setDelete() {
	var id = $('#hdfid').val();
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
    	url: "<?php  echo Yii::app()->createAbsoluteUrl("request/deletedata"); ?>",
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

function getInsert(){
	
	if($('#txtdoc_no').val()!='' && $('#txtdoc_date').val()!=''){
		$('#btnadd').removeAttr('disabled');
	}else{
		$('#btnadd').css("disabled", "disabled");
	}	
}

</script>