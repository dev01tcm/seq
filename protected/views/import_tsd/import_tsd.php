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
                    <form action="" method="post" name="myform1" id="myform1">
                        <input type="hidden" id="YII_CSRF_TOKEN" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>">
	                    <input type="file" name="file_upload" id="file_upload">
                        <input type="file" name="file_upload1" id="file_upload1">
						<input type="file" name="file_upload2" id="file_upload2"> 						
                        <input type="submit" name="bt_upload" id="bt_upload" value="Submit" />
                        <div id="progress0" class="progress"><div class="progress-bar progress-bar-success"></div></div>
                        <font color="#FF0004"><span class="txtlabel">* เฉพาะไฟล์ .txt, .xls, .xlsx </span></font>
                        <input type="hidden" id="hdffilesize0" />                           
                      	<input type="hidden" id="hdftype0" />
                   </form>   
              		</div>
                </div>
            </div>
            
                 
            <div id="errupload" class="files sectionError"></div>            
        </div>             
    </div>
    <div class="panel-body sectioncontent" style="display:block; margin: auto; width: 70%;" align="center">    	
    	<button onClick="fileimport()" id="btnupload" style="width:200px; height:50px;" class="btn btn-success"><i class="glyphicon glyphicon-floppy-disk"></i> บันทึก</button>
    	<!--input type="button" value="บันทึก" class="btn btn-success" onClick="fileimport()"-->
    </div>
</div>      


<script type="text/javascript">

$(document).ready(function() {
		
		
//-------------------------------------------------------------------------------------------------------------------
	$(function(){
     
     
    // เมื่อฟอร์มการเรียกใช้ evnet submit ข้อมูล        
    $("#myform1").on("submit",function(e){
        e.preventDefault(); // ปิดการใช้งาน submit ปกติ เพื่อใช้งานผ่าน ajax
         
        // เตรียมข้อมูล form สำหรับส่งด้วย  FormData Object
       var data = new FormData(this);
 

        // ส่งค่าแบบ POST ไปยังไฟล์ show_data.php รูปแบบ ajax แบบเต็ม
       $.ajax({
            type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl("import_tsd/savedatades"); ?>",
			data: data,
            method:"POST",
            enctype: 'multipart/form-data',
            contentType: false,
			cache: false,
			processData:false,
        }).done(function(data){
              
				
				alert("uploadภาพสำเร็จ");
		//	location.reload();
			
        });     
 
    });
     
     
});
	});

</script>





