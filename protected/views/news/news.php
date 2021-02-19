
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
	width:90px;
}
.mce-tinymce.mce-container.mce-panel {
   border: 2px solid #848282 !important;
}
/*
ul.yiiPager .first, ul.yiiPager .last, ul.yiiPager .next, ul.yiiPager .previous {
	display: inline;
}
*/

</style>  

<div class="panel panel-info">
	<div class="panel-heading">ข่าวด่วน</div>
    <div class="panel-body sectioncontent">
        <div style="width:800px; display:block; margin:0 auto;">
            <ul>            	
                <li class="sectionContent" style="list-style:none;">
                    <label class="txtlabel">ข่าว :</label>                    
                    <textarea id="txtnews"></textarea>
                </li>
                <li class="sectionContent" style="list-style:none; margin-top:10px;">
 					<label class="txtlabel checkbox-inline" style="font-size:14px;"> : <a> แจ้งข่าว  </a><input type="checkbox" id="radio_news" value="1"></label>
                </li>
                <li class="sectionContent" style="list-style:none; margin-top:30px; float:right;">
                    <div class="sectionButton">
                        <input type="button" class="btn btn-success" name="ok" onClick="ajax_savedata();" value="บันทึก"/>
                    </div>
                </li>
                 <li style="list-style:none; margin-top:15px">
                   <input id="hdfstatus" type="hidden" />
                   <input id="hdfid" type="hidden" />
                </li>
            </ul>
        </div>
    </div>
</div>
    
<script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">

jQuery(document).ready(function ($) {	
	$.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl("news/selectdata"); ?>",
		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
		dataType: "json",				
		success: function (data) {
			if (data.status=='success') {	
				$('#hdfstatus').val(data.st_news);							
				var mybrowser=navigator.userAgent;
				if(mybrowser.indexOf('MSIE')>0){
					tinymce.get('txtnews').setContent(stripSlashes(data.txtnews));
				}else{
					$('#txtnews').val(stripSlashes(data.txtnews));
				}								
				
				var status_new = $('#hdfstatus').val();
				if(status_new==1){
					$( "#radio_news").prop('checked', true);
				}else{
					$( "#radio_news").prop('checked', false);
				}
			}
			else{
				alert(data.msg);
			} 
		}
	});
	tinymce.init({
	  selector: '#txtnews',
	  height: 300,
	  theme: 'modern',
	  menubar : false,

	  fontsize_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 72pt',
	  plugins: [
		'advlist autolink lists link image charmap print preview hr anchor pagebreak',
	'searchreplace wordcount visualblocks visualchars code fullscreen',
	'insertdatetime media nonbreaking save table contextmenu directionality',
	'emoticons template paste textcolor colorpicker textpattern imagetools codesample',
	'image contextmenu importcss'
	  ],
	  toolbar1: 'insertfile undo redo | bold italic underline | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | emoticons link |  fontsizeselect | fontselect | currentdate',
	  //image_advtab: true,
	  templates: [
		{ title: 'Test template 1', content: 'Test 1' },
		{ title: 'Test template 2', content: 'Test 2' }
	  ],
	  content_css: [
		'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
		'//www.tinymce.com/css/codepen.min.css'
	  ],	  
	  //contextmenu: "cut copy paste | link inserttable " ,
	  contextmenu_never_use_native: true,
	
	 });
	 
	//selectdata();
 });


function ajax_savedata() {
	
	
	var ed = tinyMCE.get('txtnews');
    var txtnews = ed.getContent();
	var status;
	if ($('#radio_news').is(':checked')) {
		status = 1;
	}else{
		status = 0;	
	}

    $.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl("news/savedata"); ?>",
		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','txtnews':txtnews,'status':status},
		dataType: "json",				
		success: function (data) {
			if (data.status=='success') {	
				
				alert('บันทึกสำเร็จ');
				selectdata();
			}
			else{
				alert(data.msg);
			} 
		}
	});
}


function selectdata(){
	
    $.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl("news/selectdata"); ?>",
		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
		dataType: "json",				
		success: function (data) {
			if (data.status=='success') {	
				$('#hdfstatus').val(data.st_news);							
				var mybrowser=navigator.userAgent;
				if(mybrowser.indexOf('MSIE')>0){
					tinymce.get('txtnews').setContent(stripSlashes(data.txtnews));
				}else{
					$('#txtnews').val(stripSlashes(data.txtnews));
				}								
				
				var status_new = $('#hdfstatus').val();
				if(status_new==1){
					$( "#radio_news").prop('checked', true);
				}else{
					$( "#radio_news").prop('checked', false);
				}
			}
			else{
				alert(data.msg);
			} 
		}
	});

}
function stripSlashes(str)
{
	return str.replace(/\\/g, '');
}
</script>
