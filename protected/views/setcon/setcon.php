
<?php
	$this->pageTitle = 'ตั้งค่า Config' . Yii::app()->params['prg_ctrl']['pagetitle'];
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
    <div class="panel-heading">ตั้งค่า Config</div>
    <div class="panel-body sectioncontent">
        <div style=" width:800px; display:block; margin:0 auto;">
            <ul>
                <li style="list-style:none;">
                    <label class="labeltext" style="width:250px;">จำนวนรายการตวจสอบไม่น้อยกว่า</label>
                    <input type="text" id='txtcon_st' class="input-default txtboxToFilter" maxlength="4" style="width:100px; text-align:right;">
                    <label style="margin-left:10px;">รายการ</label>
                     <label class="labeltext" style="">และไม่เกิน</label>
                    <input type="text" id='txtcon_en' class="input-default txtboxToFilter" maxlength="4" style="width:100px; text-align:right;">
                    <label style="margin-left:10px;">รายการ</label>
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
            <button class="btn btn-primary" id="btnadd" onClick="ajax_savedata()" style="float:left; margin-right:10px;">            
                บันทึก
            </button>     
        </div>
        <div style="clear:both;height:0px;"></div>
    </div>
</div>        

 


<script type="text/javascript">
jQuery(document).ready(function ($) {	
	$('#txtcon_st').val('<?php echo $con_st; ?>');	
	$('#txtcon_en').val('<?php echo $con_en; ?>');
});
function ajax_savedata() {
	
	
	if($('#txtcon_st').val()==''){
		alert('กรุณากรอกจำนวนรายการตรวจสอบไม่น้อยกว่า');
		return;
	}
	if($('#txtcon_en').val()==''){
		alert('กรุณากรอกจำนวนรายการตรวจสอบไม่เกิน');
		return;
	}
	
	var con_st=parseInt($('#txtcon_st').val());		
	var con_en=parseInt($('#txtcon_en').val());	
	
	//alert(con_st);
	//alert(con_en);
	//return;
	if(con_st>=con_en){
		//alert(con_st+con_en);
		alert('จำนวนรายการตรวจสอบไม่น้อยกว่า ต้องน้อยกว่าจำนวนรายการตรวจสอบไม่เกิน');
		return;
	}
	
    $.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl("setcon/savedata"); ?>",
		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','con_st':con_st,'con_en':con_en},
		dataType: "json",				
		success: function (data) {
			if (data.status=='success') {		
				swal({
				title: "สำเร็จ !",
				text: "ทำการบันทึกสำเร็จ",
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
$(document).ready(function() {
    $(".txtboxToFilter").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ( $.inArray(event.keyCode,[46,8,9,27,13,190]) !== -1 ||
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
    });
});
</script>
