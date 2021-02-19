
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
	width:100px;
}


.uploaderProgress {
    border-radius: 6px 0 0 6px ;
	box-shadow: 0 1px 0 rgba(255, 255, 255, 0.15) inset, 0 1px 1px rgba(0, 0, 0, 0.075);
    overflow: hidden;
	display:inline-block;
	height: 34px;
	width: 300px;
}
.uploaderProgress span {
    color: #333;
    font-size: 14px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.progress {
    background-image: linear-gradient(to bottom, #ebebeb 0px, #fefefe 100%);
    background-repeat: repeat-x;
    background-color: #fefefe;
    border-radius: 4px;
	box-shadow:none;
    height: 1px;
	width: 290px;
    margin: 0px 0 10px -1px;
    overflow: hidden;
}
#errupload {
	overflow:hidden;
	height:60px;
}
.del:hover{
	color: red;
}

.link_empty{ display:none;}
.tb{
	border-style:solid; 
	border-color:#CCC; 
	border-top-width:1px; 
	border-right-width:1px; 
	border-bottom-width:1px; 
	border-left-width:1px;
	text-align:center;
}
.tb1{
	border-style:solid; 
	border-color:#fff; 
	border-top-width:1px; 
	border-right-width:1px; 
	border-bottom-width:1px; 
	border-left-width:1px;
	text-align:center;
}
.f_left{
	float:left;	
	text-align:center;
	
}
.t_table{
	border:1px solid #ccc;	
	height:40px;
	text-left:10px;
	
}
.t_table1{
	height:30px;
	border:1px solid #ccc;
	text-align:center;
	
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
.center_listview{text-align:center;margin-top:10px;}
</style>  

<div class="panel panel-info">
    	<div class="panel-heading">ประวัติการส่งออกไฟล์เพื่อขอตรวจสอบบัญชีเงินฝาก</div>
        <div class="panel-body sectioncontent">
        	<div style="width:800px; display:block; margin:0 auto;">
        	<ul>
            	<li style="list-style:none;">
				<label class="labeltext" style="width:120px;">คำค้น</label>
				<input type="text" id='txtkeyword' placeholder="เช่น ชุดหนังสือ,เลขหนังสือ " class="input-default ipwd5">
                <span>
                    <button class="btn btn-primary" style="margin-right:20px;" onClick="getSearch()">
                        <i class="glyphicon glyphicon-search"></i>
                        ค้นหา
                    </button> 
                </span>                
            </li>
             	<li style="list-style:none; margin-top:15px">
                   <input id="hdfstatus" type="hidden" />
                   <input id="hdfid" type="hidden" />
                   <input id="hdffilename" type="hidden" />
                   <input id="hdffilename2" type="hidden" />
            	</li>
            </ul>
            </div>
        </div>       
    </div>        


    <div class="panel panel-info">
    	<div class="panel-body">
        	<div class="panel-heading" style="background-color:#007daa; width:96%; height:40px; margin:0 auto;">
            	<div style="clear:both;"></div>            	
                <div class="f_left" style="width:20%">
                    <label style="color:#FFFFFF;">เลขที่ชุด</label>
                </div> 
                <div class="f_left" style="width:20%">    
                    <label style="color:#FFFFFF;">เลขที่หนังสือ</label>
                </div>
                <div class="f_left" style="width:20%">
                    <label style="color:#FFFFFF;">วันที่หนังสือ</label> 
                </div>
                <div class="f_left" style="width:20%">
                    <label style="color:#FFFFFF;">วันเวลาที่ส่งออก</label> 
               	</div>
                <div class="f_left" style="width:20%">
                    <label style="color:#FFFFFF;">จำนวน</label>   
               	</div>          
            </div>
			<?php
			/*
                $this->widget('zii.widgets.CListView', array(
                    'dataProvider'=>$dataProvider,
                    'itemView'=>'_hisinvestigate',
                    'htmlOptions' => array('width' => '100%;'),
                    'enablePagination' =>true,
                    'summaryText' => '',
                    'id'=>"export_id",
                ));
				*/
			//	var_dump($dataProvider);
				 $this->widget('zii.widgets.CListView', array(
                    'dataProvider'=>$dataProvider,
                    'itemView'=>'_hisinvestigate_tsd',
                    'htmlOptions' => array('width' => '100%;'),
                    'enablePagination' =>true,
                    'summaryText' => '',
                    'id'=>"export_id",
					'pagerCssClass'=>'center_listview',
					'pager' => array(
					 'class'=>'CLinkPager',
					 'header' => '',
					 'firstPageLabel'=>'หน้าแรก',
					 'prevPageLabel'=>'ก่อนหน้า',
					 'nextPageLabel'=>'หน้าถัดไป', 
					 'lastPageLabel'=>'หน้าสุดท้าย',    
					),
                ));
				
        	?>
                    
		</div>
	</div> 

 
 

<div id="modaldetail" class="modal fade" aria-hidden="true" aria-labelledby="modaldetailLabel" role="dialog" tabindex="-1">
    <div class="modal-dialog" style="width:750px; margin-top:88px;">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px 20px 7px;">
                <button class="close" data-dismiss="modal" type="button">
                	<span aria-hidden="true">×    <span class="sr-only">Close</span>
                </button>
                <h1 id="modaldetailLabel" class="modal-title">บันทึกข้อมูล</h1>
            </div>
           	<div class="modal-body">            		
        		<ul>
                    <li style="list-style:none;" hidden='hidden'>
                  		<label class="txtlabel">ลำดับที่</label>
                        <input type="text" id='txtno' class="input-default"  style="width:100px; text-align:right; background-color:#ccc;" disabled>                        
                    </li>
                    <li style="list-style:none; margin-top:10px;">
                    	<label class="txtlabel">ชุดหนังสือ</label>
                        <input type="text" id='txtcode' class="input-default"  style="background-color:#ccc; width:200px;" disabled>
                    </li>
                    <li style="list-style:none; margin-top:10px;">
                    	<label class="txtlabel">วันที่ประมวลผล</label>
                        <input type="text" id='txtdate' class="input-default"  style="background-color:#ccc; width:200px;" disabled>
                    </li>                    
                   <li style="list-style:none; margin-top:10px">
                        <label class="txtlabel">เลขหนังสือ</label>
                        <input type="text" class="input-default" id="txtdoc_no" style="width:200px;" maxlength="20" onkeyup="checkText(this.value,this)"/>                 
                    </li>
                    <li style="list-style:none; margin-top:10px">
                        <label class="txtlabel">วันที่หนังสือ</label>
                        <input id="txtdoc_date" type="text" class="input-default ipdisable txtcalendar" style="width:200px;" maxlength="10" disabled/>
                            <span class="btncalendar" id="btndocdate" style="cursor:pointer;" title="เลือกปฏิทิน">
                                <span class="glyphicon glyphicon-calendar" style="color: #007CFF" ></span>
                            </span>
                            <span class="btncalendar1" id="date_st" onClick="clearcalendar();" style="cursor:pointer;" title="ยกเลิกวันที่">
                                <span class="glyphicon glyphicon-remove" style="color:#FC0004" ></span>
                            </span>
                    </li>
					<li style="list-style:none; margin-top:10px">
                        <label class="txtlabel">เลือกวันเริ่มต้นตรวจสอบ</label>
                        <input id="txtdoc_datebegin" type="text" class="input-default ipdisable txtcalendar" style="width:200px;" maxlength="10" disabled/>
                            <span class="btncalendar" id="btndocdatebegin" style="cursor:pointer;" title="เลือกปฏิทิน">
                                <span class="glyphicon glyphicon-calendar" style="color: #007CFF" ></span>
                            </span>
                            <span class="btncalendar1" id="date_st" onClick="clearcalendar();" style="cursor:pointer;" title="ยกเลิกวันที่">
                                <span class="glyphicon glyphicon-remove" style="color:#FC0004" ></span>
                            </span>
                    </li>
					<li style="list-style:none; margin-top:10px">
                        <label class="txtlabel">เลือกวันสิ้นสุดตรวจสอบ</label>
                        <input id="txtdoc_dateend" type="text" class="input-default ipdisable txtcalendar" style="width:200px;" maxlength="10" disabled/>
                            <span class="btncalendar" id="btndocdateend" style="cursor:pointer;" title="เลือกปฏิทิน">
                                <span class="glyphicon glyphicon-calendar" style="color: #007CFF" ></span>
                            </span>
                            <span class="btncalendar1" id="date_st" onClick="clearcalendar();" style="cursor:pointer;" title="ยกเลิกวันที่">
                                <span class="glyphicon glyphicon-remove" style="color:#FC0004" ></span>
                            </span>
                    </li> 					
           		</ul>  
            </div>
            <div class="panel-body sectionctrl">
                <div align="">
                    สามารถดาวน์โหลดไฟล์ได้ที่นี่ 
                     <a style="margin-right:10px;" href="#" onclick='ToKey2()'>
                        คลิก
                    </a>          
                            
                </div>
            </div>
            <div class="panel-body sectionctrl hdf" style="margin-top:-20px;">
                <div align="">
                    ทำการส่งออกไฟล์เรียบร้อย สามารถดาวน์โหลดไฟล์ เพื่อส่งธนาคารได้ที่นี่ 
                     <a style="margin-right:10px;" href="#" onclick='ToKey()'>
                        คลิก
                    </a>          
                            
                </div>
                <div style="clear:both;height:0px;"></div>
            </div>
            <div class="modal-footer" style="padding: 7px 20px"> 
            	<div>                	   
                    <Button id="btcledit"class="btn btn-default" style="float:right;" data-dismiss="modal" Width="80px">ย้อนกลับ</Button>               
                	<input type="button" class="btn btn-success" name="ok" style="float:right; margin-right:10px;" onClick="ajax_savedata();" value="บันทึก"/>   
                </div>                
            </div>            
        </div>
    </div>
</div>

<div id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false" class="modal">
    <div class="modal-dialog" align="center" style="margin-top:300px;">
        <img src="<?php echo Yii::app()->params['prg_ctrl']['url']['baseurl'];?>/images/common/loading232.gif" />
    </div>
</div>  

<script type="text/javascript">
jQuery(document).ready(function ($) {	
	$('#txtdoc_date').datepicker({
			format: 'dd/mm/yyyy',
			todayBtn: true,
			language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
			thaiyear: true              //Set เป็นปี พ.ศ.
		});
	$('#txtdoc_datebegin').datepicker({
			format: 'dd/mm/yyyy',
			todayBtn: true,
			language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
			thaiyear: true              //Set เป็นปี พ.ศ.
		});
	$('#txtdoc_dateend').datepicker({
			format: 'dd/mm/yyyy',
			todayBtn: true,
			language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
			thaiyear: true              //Set เป็นปี พ.ศ.
		});		//กำหนดเป็นวันปัจุบัน	
	$('#btndocdate').click(function () {
			
			$("#txtdoc_date").removeAttr("disabled"); 
			$('#txtdoc_date').datepicker('show');
			$("#txtdoc_date").attr("disabled", "disabled"); 
			$("#txtdoc_date").css('background-color', '#ccc');

	});
	$('#btndocdatebegin').click(function () {
			
			$("#txtdoc_datebegin").removeAttr("disabled"); 
			$('#txtdoc_datebegin').datepicker('show');
			$("#txtdoc_datebegin").attr("disabled", "disabled"); 
			$("#txtdoc_datebegin").css('background-color', '#ccc');

	});
	$('#btndocdateend').click(function () {
			
			$("#txtdoc_dateend").removeAttr("disabled"); 
			$('#txtdoc_dateend').datepicker('show');
			$("#txtdoc_dateend").attr("disabled", "disabled"); 
			$("#txtdoc_dateend").css('background-color', '#ccc');

	});

     $('#modaldetail').on('show.bs.modal', function (e) {
					
            });
     $('#modaldetail').on('hidden.bs.modal', function (e) {       
		
		
            });



	$("#txtkeyword").keyup(function (e) {
		if (e.keyCode == 13) {getSearch();}
		});
	
});

function clearcalendar(){
	$('#txtdoc_date').val('');
	$('#txtdoc_datebegin').val('');
	$('#txtdoc_dateend').val('');
}
function ToKey(){
    	location.reload();
        window.open($('#hdffilename').val(),'_blank');
    	
}
function ToKey2(){
    	location.reload();
        window.open($('#hdffilename2').val(),'_blank');
    	
}
function ajax_savedata(){
	
	if($('#txtdoc_no').val()=='' || $('#txtdoc_no').val()=='รง0625/ว.0'){
		alert('กรุณากรอกเลขที่หนังสือ');
		return;
	}
	if($('#txtdoc_date').val()==''){
		alert('กรุณากรอกวันที่หนังสือ');
		return;
	}
	var id = $('#txtno').val();
	var code = $('#txtcode').val();		
	var aa=$('#txtdoc_date').val();
	var aaa = ex_date2db(aa);	
	var aaDate = new Date(aaa)
	var aaMonth = ((aaDate.getMonth().length+1) === 1)? (aaDate.getMonth()+1) : + (aaDate.getMonth()+1); 
	var doc_date = (aaDate.getFullYear()-543) + "-" + aaMonth + "-" + aaDate.getDate();
	var ab=$('#txtdoc_datebegin').val();
	var bbb = ex_date2db(ab);	
	var bbDate = new Date(bbb)
	var aaMonth = ((bbDate.getMonth().length+1) === 1)? (bbDate.getMonth()+1) : + (bbDate.getMonth()+1); 
	var doc_datebegin = (bbDate.getFullYear()-543) + "-" + aaMonth + "-" + bbDate.getDate();
	var cc=$('#txtdoc_dateend').val();
	var ccc = ex_date2db(cc);	
	var ccDate = new Date(ccc)
	var aaMonth = ((ccDate.getMonth().length+1) === 1)? (ccDate.getMonth()+1) : + (ccDate.getMonth()+1); 
	var doc_dateend = (ccDate.getFullYear()-543) + "-" + aaMonth + "-" + ccDate.getDate();
	if(doc_date=='NaN-NaN-NaN'){
		doc_date=null;			
	}
	
	var doc_no = $('#txtdoc_no').val();
	//var doc_date = $('#txtdoc_date').val();
	$('#pleaseWaitDialog').modal('show');
	 $.ajax({
    	type: "POST",
    	url: "<?php echo Yii::app()->createAbsoluteUrl("hisinvestigate_tsd/investigate"); ?>",
  		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id,'doc_no':doc_no,'doc_date':doc_date,'doc_datebegin':doc_datebegin,'doc_dateend':doc_dateend},
    	dataType: "json",				
    	success: function (data) {
			if (data.status=='success') {
				$('#hdffilename').val(data.filename);
				$('#hdffilename2').val(data.filename2);
				$('#pleaseWaitDialog').modal('hide');
				getSearch();
				alert('บันทึกสำเร็จ');
				$(".hdf").css("display", "block");
				//$("#modaldetail").modal('hide');  				
				//getHead();
			}else{
				alert(data.msg);
			} 
		}
	});
	
}

function setUpdate(id) {


	 $.ajax({
    	type: "POST",
    	url: "<?php echo Yii::app()->createAbsoluteUrl("hisinvestigate_tsd/getdata"); ?>",
  		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id},
    	dataType: "json",				
    	success: function (data) {
			if (data.status=='success') {
				$('#txtno').val(data.id);
				$('#txtdate').val(data.create_date);
				$('#txtcode').val(data.code);				
				$('#txtdoc_no').val(data.doc_no);
				$('#txtdoc_date').val(data.doc_date);	
				//$('#hdffilename').val(data.filename);
				//alert(data.filename);
				if(data.doc_no=='' || data.doc_no==null){$('#txtdoc_no').val('รง0625/ว.0')}
				$('#hdffilename').val(data.filename);
				$('#hdffilename2').val(data.filename2);
				if(data.doc_no!='' && data.doc_date!=''){
					$(".hdf").css("display", "block");	
				}else{
					$(".hdf").css("display", "none");
				}
				//$('#hdfstatus').val('edit');
				$("#modaldetailLabel").html("แก้ไขข้อมูล");   
				$("#modaldetail").modal('show'); 
					
							
			
			}else{
				alert(data.msg);
			} 
		}
	});		
	
	
	
} 
function getSearch() {
	
	var data = {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>', 'keyword': $('#txtkeyword').val()}; 
	$.fn.yiiListView.update('export_id', {
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("hisinvestigate_tsd/search"); ?>',
		data: data,
	});
} 

</script>
