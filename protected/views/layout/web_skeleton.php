<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]> 
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ex-mnfrm.css" />
	<!-- css -->    
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/vendor/jquery-ui/1.10.4/css/smoothness/jquery-ui-1.10.4.custom.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/vendor/bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/vendor/fullcalendar/fullcalendar.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css"> 
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/select2.min.css" >  
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/vendor/jquery-ui/1.10.4/css/smoothness/jquery.dataTables.min.css">
    
    <!--
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/vendor/bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/vendor/bootstrap-3.3.7-dist/css/bootstrap-theme.css" rel="stylesheet" />
    -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/vendor/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
	<!-- js -->        
    
    
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/jquery/jquery-3.3.1.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>    
</head>
<body>
<?php echo $content; ?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/jquery-ui/1.10.4/js/jquery-ui-1.10.4.custom.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/bootstrap/js/bootstrap.min.js"></script>    
<script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/jquery-upload/js/vendor/jquery.ui.widget.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/jquery-upload/js/jquery.iframe-transport.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/jquery-upload/js/jquery.fileupload.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/custom.min.js"></script>    
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/select2.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/jquery/jquery.dataTables.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/sweetalert.min.js"></script>

<!--
<script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/bootstrap-3.3.7-dist/js/bootstrap.js"></script>
-->
    
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/dist/js/bootstrap-datepicker-custom.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/dist/locales/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>
 
</body>
</html>
