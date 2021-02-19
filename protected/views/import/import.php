<?php
	$this->pageTitle = 'นำเข้าครุภัณฑ์ด้วย Excel' . Yii::app()->params['prg_ctrl']['pagetitle'];
?>

<style type="text/css">
/*upload--------------------------------------*/
.btn-upload {
	border-radius: 0 6px 6px 0;
	height: 34px;
	width: 110px;
	margin-left:-7px;
	display:inline-block;
}
.btn-upload:focus, .btn-upload:active { outline: none; }
.uploaderProgress {
    border-radius: 6px 0 0 6px ;
	box-shadow: 0 1px 0 rgba(255, 255, 255, 0.15) inset, 0 1px 1px rgba(0, 0, 0, 0.075);
    overflow: hidden;
	display:inline-block;
	margin-left:-7px;
	height: 34px;
	width: 350px;
}
.uploaderProgress2 {
    border-radius: 6px 0 0 6px ;
	box-shadow: 0 1px 0 rgba(255, 255, 255, 0.15) inset, 0 1px 1px rgba(0, 0, 0, 0.075);
    overflow: hidden;
	display:inline-block;
	margin-left:-7px;
	height: 34px;
	width: 500px;
}
.uploaderProgress span {
    color: #333;
    font-size: 14px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.uploaderProgress2 span {
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

.txtlabel{
	width:70px;
}
.subheader{
	margin-left:10px;
	margin-top:7px;
	}
.hdf{
	display:none;
}
/*area--------------------------------------*/
/*
#bodyContainer {	
}
#bodyContent {
	width:100%;
    padding: 0px 50px;
}
*/
#bodyContainer, #footerContainer {
    clear: both;
    width: 100%;				
    min-width: 1820px;				
    margin: 0;
    padding: 0;
} 
.searchsection {
	width: 1510px;	
}

.abc{
	background-color:red;
	
}
.yes{
	background-color: #02FF3E;
	
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
	width:170px;
}
.txtlabel2{
	width:220px;
}
/*
ul.yiiPager .first, ul.yiiPager .last, ul.yiiPager .next, ul.yiiPager .previous {
	display: inline;Go to page:
}
*/
.true{
	display:none;
}
.flue{
	display:none;
}
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
.center {
    margin: auto;
	text-align: center;
    width: 80%;
   	
}
.f_left{
	float:left;
	text-align:center;
	display:block;
}
.center_listview{text-align:center;margin-top:10px;}
#main {
    height:60px;
    display: -webkit-flex; /* Safari */
    display: flex;	
	text-align:center;
	background-color:#007daa; 
	width:100%;
	margin:0px;
	padding:0px; 
	text-align: center;  position: relative; 
}
.labelhead{color:#FFFFFF;margin-top:10px;
}
.mainList1 {
    display: -webkit-flex; /* Safari */
    display: flex;	
	text-align:center; 
	width:1510px;
	border-bottom:1px solid #BAD3DC;
	margin:auto;
 
}
.txtlistspan{
	margin-top:12px;
}
.txtlist{
	margin-top:15px;
	text-align:left;
	height:100%;
	border-right:1px solid #BAD3DC;
 	
}
</style>  

<div class="panel panel-info searchsection" style="width:100%;">
    <div class="panel-heading">นำเข้าผลการตรวจสอบบัญชีเงินฝาก</div>
    <div class="panel-body sectioncontent">
        <div style="display:block; margin: auto; width: 80%;">
        	<input type="hidden" id="hdfname" />             
            <input type="hidden" id="hdfname_type" />
            <input type="hidden" id="hdfdataid" />
        	<div class="panel panel-default" style="float:left;display:block; margin: auto; width: 49%;">
              	<div class="panel-heading"><font size="+1">นำเข้าไฟล์ .txt .xls .xlsx</font></div>
              	<div class="panel-body" style=" margin-left:30px;">
                	<div data-ids=0>
                        <input id="paperclip0" type="file" name="files[]" accept=".txt, .xls, .xlsx" style="display:none;" data-id="0">
                        <div class="uploaderProgress2 input-default upload0"><span id="name_file0"></span></div>                                
                        <button onclick="btclick(this)" class="btn btn-primary btn-upload"><i class="glyphicon glyphicon-save"></i> เลือกไฟล์</button>            
                        <div id="progress0" class="progress"><div class="progress-bar progress-bar-success"></div></div>
                        <font color="#FF0004"><span class="txtlabel">* เฉพาะไฟล์ .txt, .xls, .xlsx </span></font>
                        <input type="hidden" id="hdffilesize0" />                           
                      	<input type="hidden" id="hdftype0" />
              		</div>
                </div>
            </div>
            
            <div class="panel panel-default" style="float:right;display:block; margin: auto; width: 50%;">
              	<div class="panel-heading"><font size="+1">ไฟล์แนบ </font></div>
              	<div class="panel-body" style=" margin-left:30px;">
              		<div id="elementId">
                        <div data-ids=1>
                            <input id='paperclip1' type='file' name='files[]' accept='.pdf, .png, .jpeg, .jpg, .txt, .xlsx, .xls, .doc, .docx, .zip, .rar, .7z' style='display:none;'>
                            <div class='uploaderProgress input-default upload1' style="width:346px;"><span id="name_file1" style="width:1000px;"></span></div>
                            <button onclick="btclick(this)" class='btn btn-warning btn-upload'><i class='glyphicon glyphicon-paperclip'></i> ไฟล์แนบ</button>
                            <span title='ลบ' class='glyphicon glyphicon-remove' style='margin-left:15px;cursor: pointer;' onclick='cal()' ></span>
                            <button onClick="addpaperclip()" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i>เพิ่มไฟล์แนบ</button>
                            <input type="hidden" id="hdffilesize1" />                           
                            <input type="hidden" id="hdftype1" />                            
                        </div>
                        <div id='progress1' class='progress'>
                            <div class='progress-bar progress-bar-success'></div>
                        </div>                          
                   	</div>
                 	<font color="#FF0004"><span class="txtlabel">* เฉพาะไฟล์ .pdf .jpeg .jpg .txt .xls .xlsx .docx .doc .zip และ .png</span></font> 
              	</div>
            </div>           
            <div id="errupload" class="files sectionError"></div>            
        </div>             
        
        <div style="margin-top:20px; margin-left:10%; float:left;">
            <a style="margin-top:100px;" id="mnbtran" class="mnt dropdown-toggle" target="_blank" href="<?php echo Yii::app()->createUrl('convertfile'); ?>">
                <i class="glyphicon glyphicon-share"></i> แปลงไฟล์
            </a> 
        </div>  
    </div>
    <div class="panel-body sectioncontent" style="display:block; margin: auto; width: 70%;" align="center">    	
    	<button onClick="fileimport()" id="btnupload" style="width:200px; height:50px;" class="btn btn-success"><i class="glyphicon glyphicon-floppy-disk"></i> บันทึก</button>
    	<!--input type="button" value="บันทึก" class="btn btn-success" onClick="fileimport()"-->
    </div>
</div>      

	

<div class="panel panel-info hdf">
    <div class="panel-heading">ผลการนำเข้าข้อมูล</div>   
    <div style="height:40px; border-bottom:1px solid #ccc">
    	<label class="subheader" style="magin-left:10px;">รายการที่นำเข้าทั้งหมด 
        <span class="showa"></span> ราย
        </label>
   	</div>
    <div style="height:40px; border-bottom:1px solid #ccc">
    	<button type="button" class="btn" style="width:100%;" onClick="true1()">
    		<label style="float:left;">
            	<i class="glyphicon glyphicon-ok-sign" style="margin-right:10px; color:#00DF19"></i>รายการนำเข้าที่สำเร็จ
                <span class="showt" style="color:#00D92D"></span> ราย
                <span style="margin-left:10px; margin-right:10px; color:#57E2FF;">>> Click <<</span>
                <i class="glyphicon glyphicon-chevron-down" style="margin-right:10px; color:#B1B1B1;"></i>
            </label>
            
     	</button>
	</div>
    <div class="panel-body sectioncontent true">
        <div class="panel-body" style="margin-top:-40px;">
			<?php		
        	$this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'list-gridtrue',
            'dataProvider' => $modeltrue,
            'htmlOptions' => array('width' => '100%'),
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
					'name'=>'code',
					'header' => 'ชุดหนังสือ',					
					'htmlOptions'=>array('style'=>'text-align:center; width:30px;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),					
				 array(
					'name'=>'doc_no',
					'header' => 'เลขหนังสือ',
					'htmlOptions'=>array('style'=>'text-align:center; width:30px;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
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
					'htmlOptions'=>array('style'=>'text-align:left;width:90px;'),
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
					'header' => 'เลขป.ช.ช./เลขทะเบียนพาณิชย์',
					'htmlOptions'=>array('style'=>'text-align:left;width:120px;'),
					'headerHtmlOptions'=>array('style'=>'width:120px; text-align:center;'),
				  ),	
				array(
					'name'=>'bank_id',
					'header' => 'รหัสธนาคาร',
					'htmlOptions'=>array('style'=>'text-align:center; '),
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;'),
				  ),					
				 array(
					'name'=>'bank_dep_id',
					'header' => 'รหัสสาขา',
					'htmlOptions'=>array('style'=>'text-align:center;width:90px;'),
					'headerHtmlOptions'=>array('style'=>' text-align:center;width:90px;'),
				  ),	
				 array(
					'name'=>'check_status',
					'header' => 'สถานะ',
					'htmlOptions'=>array('style'=>'text-align:center; width:20px;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;width:20px;'),
				  ),		
				  array(
					'name'=>'bank_dep_name',
					'header' => 'ชื่อสาขา',
					'htmlOptions'=>array('style'=>'text-align:left; width:90px;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;width:90px;'),
				  ),			
				  array(
					'name'=>'acc_type_id',
					'header' => 'ประเภทบัญชี',
					'htmlOptions'=>array('style'=>'text-align:center; width:50px;'),
					'headerHtmlOptions'=>array('style'=>'width:50px; text-align:center;'),
				  ),
				  array(
					'name'=>'acc_no',
					'header' => 'เลขที่บัญชี',
					'htmlOptions'=>array('style'=>'text-align:center; width:50px;'),
					'headerHtmlOptions'=>array('style'=>'width:50px; text-align:center;'),
				  ),				
				  array(
					'name'=>'acc_name',
					'header' => 'ชื่อบัญชี',
					'htmlOptions'=>array('style'=>'text-align:left; width:90px;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;width:90px;'),
				  ),						  	
				 array(
					'name'=>'mark',
					'header' => 'เครื่องหมายจำนวนเงิน',
					'htmlOptions'=>array('style'=>'text-align:center; width:100px;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;width:100px;'),
				  ),		
				  array(
					'name'=>'amont',
					'header' => 'จำนวนเงิน',
					'htmlOptions'=>array('style'=>'text-align:right;'),
					'headerHtmlOptions'=>array('style'=>'width:100px; text-align:center;'),
				  ),			
				  array(
					'name'=>'request_date',
					'header' => 'วันเวลาที่ตรวจ',
					'htmlOptions'=>array('style'=>'text-align:center; width:50px;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),
				  
				  array(
					'name'=>'remark',
					'header' => 'หมายเหตุ',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),
            ),
        ));		
        ?>  
			
			
        </div>
    </div>
    
    <div style="height:40px; border-bottom:1px solid #ccc">
    	<button type="button" class="btn" style="width:100%; " onClick="flue()">
    		<label style="float:left;">
            	<i class="glyphicon glyphicon-remove-sign" style="margin-right:10px; color:red"></i>รายการนำเข้าที่ไม่สำเร็จ 
                <span class="showf" style="color:#DD0003"></span> ราย
                <span style="margin-left:10px; margin-right:10px; color:#57E2FF;">>> Click <<</span>
                <i class="glyphicon glyphicon-chevron-down" style="margin-right:10px; color:#B1B1B1;"></i>
      		</label>           
      	</button>
	</div>
    <div class="panel-body sectioncontent flue">
        <div class="panel-body" style="margin-top:-40px;">
        	<?php
			$this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'list-gridfalse',
            'dataProvider' => $modelfalse,
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
					'name'=>'code',
					'header' => 'ชุดหนังสือ',					
					'htmlOptions'=>array('style'=>'text-align:center; width:30px;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),					
				 array(
					'name'=>'doc_no',
					'header' => 'เลขหนังสือ',
					'htmlOptions'=>array('style'=>'text-align:center; width:30px;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
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
					'htmlOptions'=>array('style'=>'text-align:left;width:90px;'),
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
					'header' => 'เลขป.ช.ช./เลขทะเบียนพาณิชย์',
					'htmlOptions'=>array('style'=>'text-align:left;width:120px;'),
					'headerHtmlOptions'=>array('style'=>'width:120px; text-align:center;'),
				  ),/*
				 array(
					'name'=>'cid',
					'header' => 'เลขทะเบียนพาณิชย์',
					'htmlOptions'=>array('style'=>'text-align:left;width:150px;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),		*/		
				array(
					'name'=>'bank_id',
					'header' => 'รหัสธนาคาร',
					'htmlOptions'=>array('style'=>'text-align:center; '),
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;'),
				  ),					
				 array(
					'name'=>'bank_dep_id',
					'header' => 'รหัสสาขา',
					'htmlOptions'=>array('style'=>'text-align:center;width:90px;'),
					'headerHtmlOptions'=>array('style'=>' text-align:center;width:90px;'),
				  ),	
				 array(
					'name'=>'check_status',
					'header' => 'สถานะ',
					'htmlOptions'=>array('style'=>'text-align:center; width:20px;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;width:20px;'),
				  ),		
				  array(
					'name'=>'bank_dep_name',
					'header' => 'ชื่อสาขา',
					'htmlOptions'=>array('style'=>'text-align:left; width:90px;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;width:90px;'),
				  ),			
				  array(
					'name'=>'acc_type_id',
					'header' => 'ประเภทบัญชี',
					'htmlOptions'=>array('style'=>'text-align:center; width:50px;'),
					'headerHtmlOptions'=>array('style'=>'width:50px; text-align:center;'),
				  ),
				  array(
					'name'=>'acc_no',
					'header' => 'เลขที่บัญชี',
					'htmlOptions'=>array('style'=>'text-align:center; width:50px;'),
					'headerHtmlOptions'=>array('style'=>'width:50px; text-align:center;'),
				  ),				
				  array(
					'name'=>'acc_name',
					'header' => 'ชื่อบัญชี',
					'htmlOptions'=>array('style'=>'text-align:left; width:90px;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;width:90px;'),
				  ),						  	
				 array(
					'name'=>'mark',
					'header' => 'เครื่องหมายจำนวนเงิน',
					'htmlOptions'=>array('style'=>'text-align:center; width:100px;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;width:100px;'),
				  ),		
				  array(
					'name'=>'amont',
					'header' => 'จำนวนเงิน',
					'htmlOptions'=>array('style'=>'text-align:right;'),
					'headerHtmlOptions'=>array('style'=>'width:100px; text-align:center;'),
				  ),			
				  array(
					'name'=>'request_date',
					'header' => 'วันเวลาที่ตรวจ',
					'htmlOptions'=>array('style'=>'text-align:center; width:50px;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),
				  
				  array(
					'name'=>'remark',
					'header' => 'หมายเหตุ',
					'htmlOptions'=>array('style'=>'text-align:left;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),          
				  array(
					'name'=>'comment',
					'header' => 'comment',
					'htmlOptions'=>array('style'=>'text-align:left; width:100px;'),
					'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
				  ),
            ),
        ));		
        ?>  
            
        </div>	
 	</div>
</div>

<span id="submittername"></span>

<div id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false" class="modal">
    <div class="modal-dialog" align="center" style="margin-top:300px;">
        <img src="<?php echo Yii::app()->params['prg_ctrl']['url']['baseurl'];?>/images/common/loading232.gif" />
    </div>
</div> 

<script type="text/javascript">
jQuery(document).ready(function ($) {	
	$(function () { 	
		'use strict'; 
		
		$('#paperclip0').fileupload({
			url:'<?php echo Yii::app()->createAbsoluteUrl("import/upload"); ?>',
			dataType: 'json',
			formData: [{ name: 'YII_CSRF_TOKEN', value: '<?php echo Yii::app()->request->csrfToken; ?>' }],		
			beforeSend: function(xhr, data) {				
				
				$('.upload0').html('<span id="name_file0">'+data.files[0].name+'</span>');
				$(".hdf").css("display", "none");				
				$("#name_file1").text("");
				$(".subim").remove();
				
				$('#progress0 .progress-bar').css('width','0%');
				ex_hideErrors('#errupload');
			},		
			done: function (e, data) {
				$.each(data.result.files, function (index, file) {
					if(file.error!=null) {						
						ex_setErrors('#errupload', file.error)
					} else {
						//ajax_log(file.name);
						//alert('Upload ไฟล์เรียบร้อยแล้ว');
						$('.upload0').html('<span id="name_file0">'+data.result.files[0].name+'</span>');
						//$('#hdfname').val(data.result.files[0].name);
						$('#hdffilesize0').val(data.result.files[0].size);					
						$('#hdftype0').val(data.result.files[0].name.split('.').pop());					
						//addpaperclip2();
						$("#btnupload").removeAttr("disabled");
						$(".btn-warning").removeAttr("disabled");
						$(".btn-default").removeAttr("disabled");
						//alert(ss);
						$('#progress0 .progress-bar').css('width','0%');
						ex_hideErrors('#errupload');
					}
				});
			}, 
			progressall: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$('#progress0 .progress-bar').css('width',progress + '%');
			},
			fail: function(e, data){
				ex_setErrors('#errupload', data.jqXHR.responseText);
			},		
		}).prop('disabled', !$.support.fileInput)
			.parent().addClass($.support.fileInput ? undefined : 'disabled');
	});	
	$(function () { 	
		'use strict'; 
		
		$('#paperclip1').fileupload({
			url:'<?php echo Yii::app()->createAbsoluteUrl("import/upload"); ?>',
			dataType: 'json',
			formData: [{ name: 'YII_CSRF_TOKEN', value: '<?php echo Yii::app()->request->csrfToken; ?>' }],		
			beforeSend: function(xhr, data) {				
				
				$('.upload1').html('<span id="name_file1">'+data.files[0].name+'</span>');
				$(".hdf").css("display", "none");
				$('#progress1 .progress-bar').css('width','0%');
				ex_hideErrors('#errupload');
			},		
			done: function (e, data) {
				$.each(data.result.files, function (index, file) {
					if(file.error!=null) {						
						ex_setErrors('#errupload', file.error)
					} else {
						//ajax_log(file.name);
						//alert('Upload ไฟล์เรียบร้อยแล้ว');
						$('.upload1').html('<span id="name_file1">'+data.result.files[0].name+'</span>');
						//$('#hdfname').val(data.result.files[0].name);
						$('#hdffilesize1').val(data.result.files[0].size);					
						$('#hdftype1').val(data.result.files[0].name.split('.').pop());					
						//addpaperclip2();
						$("#btnupload").removeAttr("disabled");
						$(".btn-warning").removeAttr("disabled");
						$(".btn-default").removeAttr("disabled");
						//alert(ss);
						$('#progress1 .progress-bar').css('width','0%');
						ex_hideErrors('#errupload');
					}
				});
			}, 
			progressall: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$('#progress1 .progress-bar').css('width',progress + '%');
			},
			fail: function(e, data){
				ex_setErrors('#errupload', data.jqXHR.responseText);
			},		
		}).prop('disabled', !$.support.fileInput)
			.parent().addClass($.support.fileInput ? undefined : 'disabled');
	});	
	
	
	var ck_btn = $('#name_file0').val();
		if(ck_btn==''){
			$("#btnupload").attr("disabled", "disabled");
			$(".btn-warning").attr("disabled", "disabled");
			$(".btn-default").attr("disabled", "disabled");
		
			
		}
});

function getTrue(id){
	
//('#pleaseWaitDialog').modal('hide');
	var data = {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id}; 
	$.fn.yiiGridView.update('list-gridtrue', {
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("import/getimport"); ?>',
		data: data,
		
	});
	
}
function getFalse(id){
//('#pleaseWaitDialog').modal('hide');
	var data = {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id}; 
	$.fn.yiiGridView.update('list-gridfalse', {
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("import/getimport"); ?>',
		data: data,
	});
}
function showdata(){
	$.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl("import/Showdata"); ?>",
		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
		dataType: "json",				
		success: function (data) {
			if (data.status=='success') {	
				var cntt=parseInt(data.cntt);
				var cntf=parseInt(data.cntf);
				$('.showa').html('<span>'+ (cntt+cntf) +'</span>');
				$('.showt').html('<span>'+ data.cntt +'</span>');	
				$('.showf').html('<span>'+ data.cntf +'</span>');
				$("#btnupload").attr("disabled", "disabled");
				$(".btn-warning").attr("disabled", "disabled");
				$(".btn-default").attr("disabled", "disabled");
				$('#pleaseWaitDialog').modal('hide');
				//showdata();
				
				$(".hdf").css("display", "block");
				getTrue(data.id);
				getFalse(data.id);
				
			}
			else{
				alert(data.msg);
			} 
		}
	});
	
}
function cal(){
	$("#name_file1").html('');
}


<?php /*upload*///////////////////////////////////////////////////////////////////////////// ?>
function savedata()
{
	
	
	var i = 0;
	var data_paper = $('#hdfdataid').val();
	//var bb = $('#name_file'+i).text();
	//alert(data_paper);
	//return;
	var name = [];
	var size = [];
	//var path = [];
	//var url = [];
	var type = [];
	if(data_paper==''){ data_paper=1}
	while(i <= data_paper)
	{
			
		var filename = '#name_file'+i;
		var filesize = '#hdffilesize'+i;
		//var filepath = '#hdfpath'+i;
		//var fileurl = '#hdfurl'+i;
		var filetype = '#hdftype'+i;
	
		name[i] = $(filename).text();
		size[i] = $(filesize).val();
		//path[i] = $(filepath).val();
		//url[i] = $(fileurl).val();
		type[i] = $(filetype).val();
		
		//alert(path[i]);
		//return;
		
		i++;
	}
	//return;
	$.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl("import/savedata"); ?>",
		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','name':name,'size':size,'type':type},
		dataType: "json",				
		success: function (data) {
			if (data.status=='success') {	
				//getSearch();	
				
				//alert('Import ไฟล์เรียบร้อยแล้ว');
				showdata();	
				//$("#modaldetail").modal('hide'); 
				
				//fileimport();
			}else{
				$('#pleaseWaitDialog').modal('hide');
				alert(data.msg);
				
			} 
		}
	});
	
}
function fileimport()
{
	$('#pleaseWaitDialog').modal('show');
	//alert('aaaaa');
	//return;
	var name = [];
	var size = [];
	//var path = [];
	//var url = [];
	var type = [];
	var i = 0;
	var filename = '#name_file'+i;
	var filesize = '#hdffilesize'+i;
	//var filepath = '#hdfpath'+i;
	//var fileurl = '#hdfurl'+i;
	var filetype = '#hdftype'+i;

	name[i] = $(filename).text();
	size[i] = $(filesize).val();
	//path[i] = $(filepath).val();
	//url[i] = $(fileurl).val();
	type[i] = $(filetype).val();
	//alert($(filesize).val());
	//return;
	
	$.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl("import/savefile"); ?>",
		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','name':name,'size':size,'type':type},
		dataType: "json",				
		success: function (data) {
			if (data.status=='success') {	
				//getSearch();	
				
				if(data.msg==''){
					//alert('iiii');
				}
				
				savedata();
				//alert('yes');
				//hdf();	
				//$("#modaldetail").modal('hide'); 
			}else{
				//alert('no');
				$('#pleaseWaitDialog').modal('hide');
				//alert(data.fname);
				
				var r = confirm(data.msg);
	
				if (r == true) {
					
					
					
					
			<?php /*แปลงไฟล์*///////////////////////////////////////////////////////////////////////////// ?>
			
					
				
				
				
				
				
					//alert(name+"-"+type);
					//return;
				$.ajax({
					type: "POST",
					url: "<?php  echo Yii::app()->createAbsoluteUrl("convertfile/convert"); ?>",
					//data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','name':name,'size':size,'closepath':closepath,'path':path,'url':url,'save_path':save_path,'save_url':save_url,'type':type},
					data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','name':name,'type':type},
					dataType: "json",				
					success: function (data2) {
						if (data2.status=='success') {
							//alert('ลบเรียบร้อย');
							//return;
						
							$('#pleaseWaitDialog').modal('show');
							$.ajax({
								type: "POST",
								url: "<?php echo Yii::app()->createAbsoluteUrl("import/savefile2"); ?>",
								data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','name':name},
								dataType: "json",				
								success: function (data) {
									if (data.status=='success') {	
										//getSearch();	
										
										if(data.msg==''){
											//alert('iiii');
										}
										
										//savedata();
										savedata();
										
									}else{
										alert(data.msg);
										//alert("no");
									} 
								}
							});
							
						}else{
							alert(data2.msg);
						} 
					}
				});
					
					
					
					
					
					
					
					
			  	}
			} 
		}
	});
	
}
function aa()
{
	alert("111");
}
function addpaperclip()
{
	var count = $('#hdfdataid').val();	
	if(count==''){
		count=1;
	}
	
	//return;
	var id = Number(count)+1;
	//alert(i);
	$('#elementId').append("<div data-ids='"+ id +"' class='subim paperclipupload"+ id +"'><input id='paperclip"+ id +"' type='file' name='files[]' accept='.pdf, .png, .jpg, .jpeg, .txt, .xlsx, .xls, .doc, .docx, .zip, .rar, .7z' style='display:none;'><div class='uploaderProgress input-default upload"+ id +"' style='width:350px;'><span id='name_file"+ id +"' style='width:1000px;'></span></div><button onclick='btclick(this)' class='btn btn-warning btn-upload'><i class='glyphicon glyphicon-paperclip'></i> ไฟล์แนบ</button><input type='hidden' id='hdffilesize"+ id +"'><input type='hidden' id='hdftype"+ id +"'><span title='ลบ' class='glyphicon glyphicon-remove' style='margin-left:20px;cursor: pointer;' onclick='del(this)' ></span></div><div id='progress"+ id +"' class='subim progress aa"+ id +"'><div class='progress-bar progress-bar-success'></div></div>");
	
	
	$('#hdfdataid').val(id);
	$(function () { 	
		'use strict';
			
		$('#paperclip'+ id).fileupload({
			url:'<?php echo Yii::app()->createAbsoluteUrl("import/upload"); ?>',
			dataType: 'json',
			formData: [{ name: 'YII_CSRF_TOKEN', value: '<?php echo Yii::app()->request->csrfToken; ?>' }],		
			beforeSend: function(xhr, data) {
				$('.upload'+id).html('<span id="name_file'+ id +'">'+data.files[0].name+'</span>');
				$(".hdf").css("display", "none");
				$('#progress'+id+' .progress-bar').addClass("progress-bar-success");
				$('#progress'+ id +' .progress-bar').css('width','0%');
				ex_hideErrors('#errupload');
			},		
			done: function (e, data) {
				$.each(data.result.files, function (index, file) {
					if(file.error!=null) {
						if(file.error == 'Filetype not allowed'){
							ex_setErrors('#errupload','*รูปแบบไฟล์ไม่รองรับ');
						}
						if(file.error == 'The uploaded file exceeds the upload_max_filesize directive in php.ini'){
							ex_setErrors('#errupload','*ไม่สามารถอัพโหลดได้ เนื่องจากไฟล์มีขนาดใหญ่');
						}
						$('#name_file'+id).text('');
						$('#progress'+id+' .progress-bar').addClass("progress-bar-danger");
						$('#progress'+id+' .progress-bar').css({'width':'100%'});					
						
					} else {
						//ajax_log(file.name);
						//alert('Upload ไฟล์เรียบร้อยแล้ว');
						//$('#hdfname').val(data.result.files[0].name);
						$('.upload'+id).html('<span id="name_file'+ id +'">'+data.result.files[0].name+'</span>');
						//$('#hdfname').val(data.result.files[0].name);
						$('#hdffilesize'+id).val(data.result.files[0].size);					
						$('#hdftype'+id).val(data.result.files[0].name.split('.').pop());					
						//addpaperclip2();
						$("#btnupload").removeAttr("disabled");
						$(".btn-warning").removeAttr("disabled");
						$(".btn-default").removeAttr("disabled");
						//alert(ss);
						$('#progress'+id+' .progress-bar').css('width','0%');
						ex_hideErrors('#errupload');						
						
					}
				});
			}, 
			progressall: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$('#progress'+id+' .progress-bar').css('width',progress + '%');
			},
			fail: function(e, data){
				ex_setErrors('#errupload', data.jqXHR.responseText);
			},		
		}).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
	
		});
	
	
}

function del(el){	
	var id = $(el).parent().attr("data-ids");	
	$(".paperclipupload"+id ).remove();
	$(".aa"+id ).remove();
}


function btclick(el){
	var id = $(el).parent().attr("data-ids");	
	
	//return id;
	$("#paperclip"+id).click();
	
	//return id;
	
}
function true1(){
	
	if($(".true").css("display")=="none"){
		$(".true").css("display", "block");
		//$("#btnadvs").html("ค้นหาแบบง่าย");
	} else {
		$(".true").css("display", "none");
		//$("#btnadvs").html("ค้นหาขั้นสูง");
	}
	
}
function flue(){
	
	if($(".flue").css("display")=="none"){
		$(".flue").css("display", "block");
		//$("#btnadvs").html("ค้นหาแบบง่าย");
	} else {
		$(".flue").css("display", "none");
		//$("#btnadvs").html("ค้นหาขั้นสูง");
	}
	
}

</script>





