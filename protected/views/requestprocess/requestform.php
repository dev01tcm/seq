
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
.hdf3{
	display:none;
}
.hdf4{
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
</style>  

<div class="panel panel-info">
    <div class="panel-heading">บันทึกรายการขอตรวจสอบบัญชีเงินฝาก</div>
    <div class="panel-body sectioncontent">
    	<div style="width:900px; display:block; margin:0 auto;">
        	<ul>
            	<li style="list-style:none;" hidden="hidden">
                	<label class="txtlabel">เลขที่ชุดข้อมูล :</label>
                	<input type="text" class="input-default" id="txtcode" style="width:200px;" />
            	</li>
              	<li style="list-style:none; margin-top:15px">
                	<label class="txtlabel">เลขที่หนังสือ : <font color="red">*</font></label>
                    <input id="txtdoc_no" type="text" class="input-default" style="width:200px;" maxlength="20" onkeyup="checkText(this.value,this)" />
                    <label class="" style="margin-left:10px;">วันที่หนังสือ : <font color="red">*</font></label>
                    <input id="txtdoc_date" type="text" class="input-default ipdisable txtcalendar" style="width:200px;" maxlength="10" readonly/>
                    <span class="btncalendar" id="btndocdate" style="cursor:pointer;" title="เลือกปฏิทิน">
                        <span class="glyphicon glyphicon-calendar" style="color: #007CFF" ></span>
                    </span>
                    <span class="btncalendar1" id="date_st" onClick="clearcalendar();" style="cursor:pointer;" title="ยกเลิกวันที่">
                        <span class="glyphicon glyphicon-remove" style="color:#FC0004" ></span>
                    </span>
                </li>
                <li style="list-style:none; margin-top:15px">
                    <label class="txtlabel">เลขบัญชีนายจ้าง : <font color="red">*</font></label>
                    <input type="text" class="input-default" maxlength="10" id="txtacc_employer" style="width:200px;" onkeyup="checkText(this.value,this)">                            
                </li>
                <li style="list-style:none; margin-top:15px">   
                    <label class="txtlabel">บุคคล / นิติบุคคล : <font color="red">*</font></label>
                    <select class="input-default" id="drppid" style="width:200px;" onChange="typeselect('');">
                        <option value="">--เลือก--</option>     
                        <option value="1">บุคคล</option>   
                        <option value="2">นิติบุคคล</option>                                                						
                    </select>                            	
                </li>
                <li style="list-style:none; margin-top:15px">
                    <div class="hdf">
                        <label class="txtlabel" id="txttype"></label>                        
                        <select class="input-default" id="drptype" style="width:200px;" onChange="hdf();"
                            <option value="">--เลือก--</option>                            
                        </select>
                    </div>
                    <div style="margin-left:350px; margin-top:-33px;" class="hdf1">                        
                        <input type="text" class="input-default" id="txtbusiness_name" maxlength="20" style="width:290px;" onkeyup="checkText(this.value,this)" />              	
                    </div>
                </li>                 
                <li style="list-style:none; margin-top:15px" class="hdf2">                        	
                	<label class="txtlabel">ชื่อบริษัท : <font color="red">*</font></label>
                    <input type="text" class="input-default" id="txtcompany_name" style="width:510px;" maxlength="50" placeholder="เช่น บริษัท ABC" onkeyup="checkText(this.value,this)" />
                </li>   
                <li style="list-style:none; margin-top:15px" class="hdf2">
                    <label class="txtlabel">เลขนิติบุคคล : <font color="red">*</font></label>                            
                    <input type="text" class=" input-default" style=" width:200px; margin-top:-5px; " maxlength="13" id="txtcid" placeholder="เลขทะเบียนนิติบุคคล" onkeyup="checkText(this.value,this)" />
                </li>                    
                <li style="list-style:none; margin-top:15px" class="hdf3">
                    <label class="txtlabel">ชื่อ : <font color="red">*</font></label>
                    <input type="text" class="input-default" maxlength="50" id="txtname" style="width:200px;" onkeyup="checkText(this.value,this)"/>
                    <label class="" style="margin-left:10px;">นามสกุล : <font color="red">*</font></label>
                    <input type="text" class="input-default" maxlength="50" id="txtlname" style="width:200px;margin-left:15px;" onkeyup="checkText(this.value,this)">
                </li>
                <li style="list-style:none; margin-top:15px" class="hdf3">
                    <label class="txtlabel">เลขประชาชน : <font color="red">*</font></label>
                    <input type="text" class="input-default" style=" width:200px; margin-top:-5px; " maxlength="13" id="txtpid" placeholder="เลขบัตรประจำตัวประชาชน" onkeyup="checkText(this.value,this)">
                </li>                    
                <li style="list-style:none; margin-top:15px" class="hdf3">
                    <label class="txtlabel">วัน/เดือน/ปี เกิด :</label>
                    <input id="txtbirth" type="text" class="input-default ipdisable txtcalendar" style="width:200px;" maxlength="10" disabled/>
                    <span class="btncalendar" id="btnbirth" style="cursor:pointer;" title="เลือกปฏิทิน">
                        <span class="glyphicon glyphicon-calendar" style="color: #007CFF" ></span>
                    </span>
                    <span class="btncalendar1" id="date_brd1" onClick="clearcalendar1();" style="cursor:pointer;" title="ยกเลิกวันที่">
                        <span class="glyphicon glyphicon-remove" style="color:#FC0004" ></span>
                    </span>
                </li>
                <li style="list-style:none; margin-top:15px" class="hdf4">
                    <label class="txtlabel" >ที่อยู่ : <font color="red">*</font></label>
                    <input type="text" class="input-default" maxlength="200" id="txtaddress" style="width:510px;" onkeyup="checkText(this.value,this)">                                
                </li> 					
            </ul>         
        </div>
    </div>
    <div class="modal-footer" style="padding: 7px 20px">
        <h3 id="errmodaldetail" class="sectionError"></h3>
        <div class="sectionButton">
            <input type="button" class="btn btn-success" name="ok" onClick="ajax_savedata();" value="บันทึก"/>               
        </div>
    </div>       
</div>
 

<script type="text/javascript">
jQuery(document).ready(function ($) {
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
	 
});


function ajax_savedata() {

//echo strlen($aaa)."<br/>";
	/*
	var aa=$('#txtdoc_date').val();
	var aaa = ex_date2db(aa);
	
	var fullDate = new Date(aaa)
	var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : + (fullDate.getMonth()+1); 
	var doc_date = (fullDate.getFullYear()-543) + "-" + twoDigitMonth + "-" + fullDate.getDate();

	alert(doc_date);
	return;
	*/
	if($('#txtdoc_no').val()==''){
		alert('กรุณากรอกเลขที่หนังสือ');
		return;
	}
	if($('#txtdoc_date').val()==''){
		alert('กรุณากรอกวันที่หนังสือ');
		return;
	}
	if($('#txtacc_employer').val()==''){
		alert('กรุณากรอกเลขที่บัญชีนายจ้าง');
		return;
	}	
	//var ck_acc_employer = $('#txtacc_employer').val().length;
	if($('#txtacc_employer').val().length < 10){
		alert('กรุณากรอกเลขที่บัญชีนายจ้างให้ครบ');
		return;
	}	
	if($('#drpid').val()==''){
		alert('กรุณาเลือก บุคคล / นิติบุคคล');
		return;
	}else{		
		if($('#drppid').val()==1){
			if($('#drptype').val()==''){
				alert('กรุณาเลือกคำนำหน้าชื่อ');
				return;
			}
			if($('#drptype').val()==24){
				if($('#txtbusiness_name').val()==''){
					alert('กรุณากรอกคำนำหน้าชื่อ');
					return;
				}
			}
			if($('#txtname').val()==''){
				alert('กรุณากรอกชื่อ');
				return;
			}
			if($('#txtlname').val()==''){
				alert('กรุณากรอกนามสกุล');
				return;
			}
			
			if($('#txtpid').val()==''){
				alert('กรุณากรอกเลขบัตรประจำตัวประชาชน');
				return;
			}
			
			if($('#txtpid').val().length < 13){
				alert('กรุณากรอกเลขบัตรประจำตัวประชาชนให้ครบ');
				return;
			}			
		}else{
			if($('#drptype').val()==''){
				alert('กรุณาเลือกประเภทธุรกิจ');
				return;
			}
			if($('#drptype').val()==24){
				if($('#txtbusiness_name').val()==''){
					alert('กรุณากรอกชื่อประเภทธุรกิจ');
					return;
				}
			}
			if($('#txtcid').val()==''){
				alert('กรุณากรอกเลขทะเบียนนิติบุคคล');
				return;
			}
			if($('#txtcompany_name').val()==''){
				alert('กรุณากรอกชื่อสถานประกอบการ');
				return;
			}			
			
		}
	}
	
	if($('#txtaddress').val()==''){
		alert('กรุณากรอกที่อยู่');
		return;
	}
		
	var doc_no=$('#txtdoc_no').val();
	var acc_employer=$('#txtacc_employer').val();
	var pid_type=$('#drppid').val();//บุคคลข-นิติ
	var business_type=$('#drptype').val();//ประเภทธุรกิจข-คำนำหน้าชื่อ
	var business_name=$('#txtbusiness_name').val();//กรณีที่เลือก อื่น ๆ 
	//บุคคล
	var name = $('#txtname').val();			
	var lname = $('#txtlname').val();
	var bb = $('#txtbirth').val();
	var pid = $('#txtpid').val();
	//นิติ
	var company = $('#txtcompany_name').val();
	var cid = $('#txtcid').val();
	
	var address=$('#txtaddress').val();	
	var aa=$('#txtdoc_date').val();
		
	var bbb = ex_date2db(bb);	
	var aaa = ex_date2db(aa);
	
	var bbDate = new Date(bbb)
	var bbMonth = ((bbDate.getMonth().length+1) === 1)? (bbDate.getMonth()+1) : + (bbDate.getMonth()+1); 
	var birth = (bbDate.getFullYear()-543) + "-" + bbMonth + "-" + bbDate.getDate();
	
	var aaDate = new Date(aaa)
	var aaMonth = ((aaDate.getMonth().length+1) === 1)? (aaDate.getMonth()+1) : + (aaDate.getMonth()+1); 
	var doc_date = (aaDate.getFullYear()-543) + "-" + aaMonth + "-" + aaDate.getDate();

	//alert(doc_date);
	//return;
	
		if(doc_date=='NaN-NaN-NaN'){
			doc_date=null;			
		}
		if(birth=='NaN-NaN-NaN'){
			birth=null;			
		}
    $.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl("request/savedata"); ?>",
		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
			'doc_no':doc_no,'acc_employer':acc_employer,'pid_type':pid_type,'business_type':business_type,
			'business_name':business_name,'name':name,'lname':lname,'birth':birth,'pid':pid,'cid':cid,
			'company':company,'address':address,'doc_date':doc_date},
		dataType: "json",				
		success: function (data) {
			if (data.status=='success') {	
				$('#txtdoc_no').val('');
				$('#txtdoc_date').val('');
				$('#txtacc_employer').val('');		
				$('#drppid').val('');	
				typeselect();
				alert('บันทึกข้อมูลเรียบร้อยแล้ว');
			}
			else{
				alert(data.msg);
			} 
		}
	});
}	

function typeselect(){	 
	var id = $('#drppid').val();	
	
	if(id==''){
		$(".hdf").css("display", "none");
		$(".hdf1").css("display", "none");
		$(".hdf2").css("display", "none");
		$(".hdf3").css("display", "none");
		$(".hdf4").css("display", "none");
		$('#txtbusiness_name').val('');
		$('#txtname').val('');			
		$('#txtlname').val('');
		$('#txtbirth').val('');
		$('#txtpid').val('');
		$('#txtcompany_name').val('');
		$('#txtcid').val('');
		$('#txtaddress').val('');	
		return;
	}else{
		if(id==1){
			$(".hdf").css("display", "block");
			$(".hdf2").css("display", "none");
			$(".hdf3").css("display", "block");
			$(".hdf4").css("display", "block");
			$("#txttype").html("คำนำหน้าชื่อ : <font color='red'>*</font>");		
		}else{
			$(".hdf").css("display", "block");
			$(".hdf2").css("display", "block");
			$(".hdf3").css("display", "none");
			$(".hdf4").css("display", "block");
			$("#txttype").html("ประเภทธุรกิจ : <font color='red'>*</font>");
		}
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
				//$("#drptype").val(depart);			
			}else{
				alert(data.msg);
			} 
		}
	});	
}

function clearcalendar(){
	$('#txtdoc_date').val('');
}

function clearcalendar1(){
	$('#txtbirth').val('');
}

function hdf(){		
	var id = $('#drppid').val();
	var type = $('#drptype').val();	
	if(type==24){	
		$(".hdf1").css("display", "block");
		if(id==1){				
			$("#txtbusiness_name").attr("placeholder", "เช่น ดร.,นพ.").val("").focus().blur();
		}else{				
			$("#txtbusiness_name").attr("placeholder", "เช่น บริษัท จำกัด").val("").focus().blur();
			//$(".hdf2").css("display", "block");
		}		
	}else{
		$(".hdf1").css("display", "none");
	}	
}
</script>