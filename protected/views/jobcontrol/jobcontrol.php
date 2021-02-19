<?php
	$this->pageTitle = 'Jobcontrol' . Yii::app()->params['prg_ctrl']['pagetitle'];
?>

<script type="text/javascript">
jQuery(document).ready(function ($) {
    $.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl("jobcontrol/investigate"); ?>",
		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
		dataType: "json",				
		success: function (data) {
			if (data.status=='success') {	
				
				//alert('ทำการส่งออกไฟล์เรียบร้อย');
			}else{
				alert(data.msg);
			} 
		}
	});
});

</script>