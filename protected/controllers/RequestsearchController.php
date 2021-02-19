<?php

class RequestsearchController extends Controller
{
	function init() {
		parent::chkLogin();
	}
		
	public function actionIndex()
	{
		$model = lkup_requestsearch::search();
		$modeldetail = lkup_requestresult::getDetail3();
		$this->render('request', array(
			'model'=>$model,			
			'modeldetail'=>$modeldetail
			));		
	}
	
	public function actionSearch()
	{
		//if(isset($_GET['ajax']) && isset($_GET['sort'])){
		
		if(isset($_GET['ajax']) && !isset($_POST['YII_CSRF_TOKEN'])){
			$keyword = Yii::app()->session['request_keyword'];	
			$acc_emp = Yii::app()->session['request_acc_emp'];
			$iden = Yii::app()->session['request_iden'];	
			$dep = Yii::app()->session['request_dep'];	
			$status1 = Yii::app()->session['request_status1'];
			$status2 = Yii::app()->session['request_status2'];
			$status3 = Yii::app()->session['request_status3'];
			$status4 = Yii::app()->session['request_status4'];
			$type = Yii::app()->session['request_type'];
			$name = Yii::app()->session['request_name'];
			$systype = Yii::app()->session['request_name'];
			
		} else {
			$keyword = isset($_POST['keyword'])?addslashes(trim($_POST['keyword'])):'';	
			$acc_emp = isset($_POST['acc_emp'])?addslashes(trim($_POST['acc_emp'])):'';
			$iden = isset($_POST['iden'])?addslashes(trim($_POST['iden'])):'';
			$dep = isset($_POST['dep'])?addslashes(trim($_POST['dep'])):'';
			$status1 = isset($_POST['status1'])?addslashes(trim($_POST['status1'])):'';
			$status2 = isset($_POST['status2'])?addslashes(trim($_POST['status2'])):'';
			$status3 = isset($_POST['status3'])?addslashes(trim($_POST['status3'])):'';
			$status4 = isset($_POST['status4'])?addslashes(trim($_POST['status4'])):'';
			$type = isset($_POST['type'])?addslashes(trim($_POST['type'])):'';
			$name = isset($_POST['name'])?addslashes(trim($_POST['name'])):'';
			$systype = isset($_POST['systype'])?addslashes(trim($_POST['systype'])):'';
			Yii::app()->session['request_keyword']=$keyword;
			Yii::app()->session['request_acc_emp']=$acc_emp;
			Yii::app()->session['request_iden']=$iden;
			Yii::app()->session['request_dep']=$dep;
			Yii::app()->session['request_status1']=$status1;
			Yii::app()->session['request_status2']=$status2;	
			Yii::app()->session['request_status3']=$status3;	
			Yii::app()->session['request_status4']=$status4;
			Yii::app()->session['request_type']=$type;	
			Yii::app()->session['request_name']=$name;
			Yii::app()->session['request_name']=$systype;	
		}
		
		
		$model = lkup_requestsearch::search($keyword,$acc_emp,$iden,$status1,$status2,$status3,$status4,$type,$name,$dep,$systype);	
		$modeldetail = lkup_requestresult::searchrequest();				
		$this->render('request', array(
			'model'=>$model,
			'modeldetail'=>$modeldetail
			));	
	}
	public function actionSearchdetail(){
		
		$id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';	
		//Yii::app()->session['id_request']=$id;	
		$model = lkup_requestsearch::search();	
		$modeldetail = lkup_requestresult::getDetail($id);
		
		$this->render('request2', array(
			'model'=>$model,			
			'modeldetail'=>$modeldetail
			));		
	}
	public function actionSearchdetail_tsd(){
		
		
		$pid=isset($_POST['pid'])?addslashes(trim($_POST['pid'])):'';
		$code=isset($_POST['code'])?addslashes(trim($_POST['code'])):'';
		
		//Yii::app()->session['id_request']=$id;	
		$model = lkup_requestsearch::getsreachdetail_tsd_book($pid,$code);
		$model2 = lkup_requestsearch::getsreachdetail_tsd($pid,$code);
		
	//	$modeldetail = lkup_requestresult::getDetail($pid,$code);
		$this->layout='nolaout';
		$this->render('search_tsd', array(
			'model'=>$model,		
			'model2'=>$model2
			));		
	}
}