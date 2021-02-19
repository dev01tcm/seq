<?php

class Requestprocess_tsdController extends Controller
{
	function init() {
		parent::chkLogin();
	}
		
	public function actionIndex()
	{
		
		$id=Yii::app()->session['id_request'];
		$model = lkup_requestprocess_tsd::search();
		
		
		$this->render('requestprocess_tsd', array(
			'model'=>$model,	
			));		
		//$this->render('itemlist');
	}
	public function actionSearch()
	{
		//if(isset($_GET['ajax']) && isset($_GET['sort'])){
		
		if(isset($_GET['ajax']) && !isset($_POST['YII_CSRF_TOKEN'])){
			$keyword = Yii::app()->session['request_keyword'];	
			$acc_emp = Yii::app()->session['request_acc_emp'];
			$iden = Yii::app()->session['request_iden'];
		} else {
			$keyword = isset($_POST['keyword'])?addslashes(trim($_POST['keyword'])):'';	
			$acc_emp = isset($_POST['acc_emp'])?addslashes(trim($_POST['acc_emp'])):'';
			$iden = isset($_POST['iden'])?addslashes(trim($_POST['iden'])):'';
			
			
			Yii::app()->session['request_keyword']=$keyword;
			Yii::app()->session['request_acc_emp']=$acc_emp;
			Yii::app()->session['request_iden']=$iden;			
		}
		
		$model = lkup_requestprocess::search($keyword,$acc_emp,$iden);	
				
		$this->render('request', array(
			'model'=>$model,
			));	
	}
}