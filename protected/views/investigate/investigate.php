
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
.subheader{
	margin-left:10px;
	margin-top:7px;
	}
.hdf{
	display:none;
}
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
	width:210px;
}

.ipdisable{
	background-color: #CCC;
}

</style>  

	<div class="panel panel-info">
    	<div class="panel-heading">ส่งออกไฟล์เพื่อขอตรวจสอบ</div>
        <div style="height:40px; border-bottom:1px solid #ccc"><label class="subheader" style="magin-left:10px;">ข้อมูลการส่งออกไฟล์ธนาคาร</label></div>          
        <div class="panel-body sectioncontent">
            <div style="width:800px; display:block; margin:0 auto;">
                <ul>
                	<li style="list-style:none; margin-top:15px">
                       <input id="hdfstatus" type="hidden" />
                       <input id="hdfid" type="hidden" />
                       <input id="hdffilename" type="hidden" />
                    </li>
                    <li style="list-style:none;">
                        <label class="txtlabel1">เลขชุดหนังสือ :</label>
                        <?php  
                            $data=lookupdata::getCode();
                            foreach($data as $dataitem) {
                                if($dataitem['code']=='') {
                                    echo "<input type='text' id='txtcode' class='input-default' style='width:100px; text-align:right; background-color:#ccc' value='".substr(date('Y')+543,-2).'001'."' disabled />";
                                }else{
                                    echo "<input type='text' id='txtdoc_code' class='input-default' style='width:100px; text-align:right; background-color:#ccc' value='".$dataitem['code']."' disabled />";
                                }
                            } 
                                
                         ?>
                                           
                    </li>
                    <li style="list-style:none; margin-top:10px">
                        <label class="txtlabel1">ทำการส่งออกครั้งละไม่น้อยกว่า :</label> 
                        <input type="text" id='txtcon_st' class="input-default" value="0" style="width:100px; text-align:right; background-color:#ccc" disabled>                    
                        <label style="margin-left:10px;">รายการ</label>   
                        <label style="margin-left:20px;">และไม่เกิน :</label> 
                        <input type="text" id='txtcon_en' class="input-default" value="0" style="margin-left:18px; width:100px; text-align:right; background-color:#ccc" disabled>                    
                        <label style="margin-left:10px;">รายการ</label>                  
                    </li>
                    <li style="list-style:none; margin-top:10px">
                        <label class="txtlabel1">ทำการประมวลผลรายการที่ :</label>
                        <input type="text" id='txtmin' class="input-default" style="width:100px;text-align:right; background-color:#ccc" disabled>
                        <label class="" style="margin-left:80px;">ถึงรายการที่ :</label>
                        <input type="text" id='txtmax' class="input-default" style="width:100px; margin-left:10px; text-align:right; background-color:#ccc" disabled>
                    </li>
                    
                    <li style="list-style:none; margin-top:10px">
                        <label class="txtlabel1">มีข้อมูลทั้งสิ้น :</label>                    
                        <input type="text" id='txtcount_item' class="input-default" value="0" style="width:100px; text-align:right; background-color:#ccc" disabled>  
                        <label style="margin-left:10px;">รายการ</label>                   
                    </li>
                    <li style="list-style:none; margin-top:10px">
                                          
                    </li>             	
                </ul>
				  
                
            </div>
			 <div style="height:40px; border-bottom:1px solid #ccc"><label class="subheader" style="magin-left:10px;">ข้อมูลการส่งออกไฟล์หลักทรัพย์ </label></div> 
			 <div style="width:800px; display:block; margin:0 auto;">
                <ul>
                	<li style="list-style:none; margin-top:15px">
                       <input id="hdfstatus" type="hidden" />
                       <input id="hdfid" type="hidden" />
                       <input id="hdffilename" type="hidden" />
                    </li>
                    <li style="list-style:none;">
                        <label class="txtlabel1">เลขชุดหนังสือ :</label>
                         <?php 
					 
                            $data=lookupdata::getCodetsd();
                            foreach($data as $dataitem) {
                                if($dataitem['code']=='') {
                                    echo "<input type='text' id='txtcode_tsd' class='input-default' style='width:100px; text-align:right; background-color:#ccc' value='".substr(date('Y')+543,-2).'001'."' disabled />";
                                }else{
                                    echo "<input type='text' id='txtdoc_code_tsd' class='input-default' style='width:100px; text-align:right; background-color:#ccc' value='".$dataitem['code']."' disabled />";
                                }
                            } 
                                
                         ?>
                                           
                    </li>
                    <li style="list-style:none; margin-top:10px">
                        <label class="txtlabel1">ทำการส่งออกครั้งละไม่น้อยกว่า :</label> 
                        <input type="text" id='txtcon_st_tsd' class="input-default" value="0" style="width:100px; text-align:right; background-color:#ccc" disabled>                    
                        <label style="margin-left:10px;">รายการ</label>   
                        <label style="margin-left:20px;">และไม่เกิน :</label> 
                        <input type="text" id='txtcon_en_tsd' class="input-default" value="0" style="margin-left:18px; width:100px; text-align:right; background-color:#ccc" disabled>                    
                        <label style="margin-left:10px;">รายการ</label>                  
                    </li>
                    <li style="list-style:none; margin-top:10px">
                        <label class="txtlabel1">ทำการประมวลผลรายการที่ :</label>
                        <input type="text" id='txtmin_tsd' class="input-default" style="width:100px;text-align:right; background-color:#ccc" disabled>
                        <label class="" style="margin-left:80px;">ถึงรายการที่ :</label>
                        <input type="text" id='txtmax_tsd' class="input-default" style="width:100px; margin-left:10px; text-align:right; background-color:#ccc" disabled>
                    </li>
                    
                    <li style="list-style:none; margin-top:10px">
                        <label class="txtlabel1">มีข้อมูลทั้งสิ้น :</label>                    
                        <input type="text" id='txtcount_item_tsd' class="input-default" value="0" style="width:100px; text-align:right; background-color:#ccc" disabled>  
                        <label style="margin-left:10px;">รายการ</label>                   
                    </li>
                    <li style="list-style:none; margin-top:10px">
                                          
                    </li>             	
                </ul>
				  <div style="height:40px; border-bottom:1px solid #ccc"><label class="subheader" style="magin-left:10px;">ข้อมูลการส่งออกไฟล์ </label></div> 
                
            </div>
            </div>
            <div class="panel-body sectionctrl">
                <div align="center">
                     <button class="btn btn-primary" id="btncon" style="margin-right:10px;" onClick="ajax_savedata()" >
                        ยืนยัน
                    </button>    
                </div>
                <div style="clear:both;height:0px;"></div>
            </div>
            <div class="panel-body sectionctrl hdf">
                <div align="">
                    ทำการส่งออกไฟล์เรียบร้อย สามารถดาวน์โหลดไฟล์ได้ที่นี่ 
                     <a style="margin-right:10px;" href="#" onclick='ToKey()'>
                        คลิก
                    </a>          
                            
                </div>
                <div style="clear:both;height:0px;"></div>
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
	$('#txtcon_st').val('<?php echo $cntfig_st; ?>');	
	$('#txtcon_en').val('<?php echo $cntfig_en; ?>');	
	$('#txtmin').val('<?php echo $cntmin; ?>');	
	$('#txtmax').val('<?php echo $cntmax; ?>');
	$('#txtcount_item').val('<?php echo $cnt; ?>');
	$('#txtcon_st_tsd').val('<?php echo $cntfig_st_tsd; ?>');	
	$('#txtcon_en_tsd').val('<?php echo $cntfig_en_tsd; ?>');	
	$('#txtmin_tsd').val('<?php echo $cntmin_tsd; ?>');	
	$('#txtmax_tsd').val('<?php echo $cntmax_tsd; ?>');
	$('#txtcount_item_tsd').val('<?php echo $cnt_tsd; ?>');
	var cn_st = parseInt($('#txtcon_st').val());	
	var cn_cnt = parseInt($('#txtcount_item').val());
	var cn_st_tsd = parseInt($('#txtcon_st_tsd').val());	
	var cn_cnt_tsd = parseInt($('#txtcount_item_tsd').val());
	
	if(cn_st > cn_cnt && cn_st_tsd > cn_cnt_tsd ){
		$("#btncon").attr("disabled", "disabled");
	}			
	var txtitem = $('#txtcount_item').val();
	var txtitem_tsd = $('#txtcount_item_tsd').val()
	if(txtitem==0 && txtitem_tsd==0){
		$("#btncon").attr('disabled', true);
	}
	
});

function ToKey(){
    	location.reload();
        window.open($('#hdffilename').val(),'_blank');
    	
}

function ajax_savedata() {	
	var code = $('#txtdoc_code').val();	
	var code_tsd = $('#txtdoc_code_tsd').val();	
	if(code==null){
		code = $('#txtcode').val();
		codecode_tsd = $('#txtdoc_code_tsd').val();	
	}
	var con_st = $('#txtcon_st').val();	
	var con_en = $('#txtcon_en').val();	
	var cntmin = $('#txtmin').val();	
	var cntmax = $('#txtmax').val();
	var cnt = $('#txtcount_item').val();
	var con_st_tsd = $('#txtcon_st_tsd').val();	
	var con_en_tsd = $('#txtcon_en_tsd').val();	
	var cntmin_tsd = $('#txtmin_tsd').val();	
	var cntmax_tsd = $('#txtmax_tsd').val();
	var cnt_tsd = $('#txtcount_item_tsd').val();
	$('#pleaseWaitDialog').modal('show');
	
    $.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl("investigate/savedata"); ?>",
		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','con_st':con_st,'con_en':con_en,
								'cntmin':cntmin,'cntmax':cntmax,'cnt':cnt,'code':code,'con_st_tsd':con_st_tsd,'con_en_tsd':con_en_tsd,
								'cntmin_tsd':cntmin_tsd,'cntmax_tsd':cntmax_tsd,'cnt_tsd':cnt_tsd,'code_tsd':code_tsd},
		dataType: "json",				
		success: function (data) {
			if (data.status=='success') {			
				$('#hdffilename').val(data.filename);		
				alert('ทำการส่งออกไฟล์เรียบร้อย');
				$('#pleaseWaitDialog').modal('hide');	
				$(".hdf").css("display", "block");
				$("#btncon").attr('disabled', true);
			}else{
				alert(data.msg);
			} 
		}
	});
}	

</script>