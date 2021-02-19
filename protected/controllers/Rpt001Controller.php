<?php

class Rpt001Controller extends Controller
{
	function init() {
		parent::chkLogin();
	}
		
	public function actionIndex()
	{
		
		$model = rpt_001::search();
		//$model=lkup_hisimport::getSearch();
		$this->render('rpt001', array('model'=>$model));
		//$this->render('rpt001');
	}
	public function actionSearch()
	{
		//if(isset($_GET['ajax']) && isset($_GET['sort'])){
		if(isset($_GET['ajax']) && !isset($_POST['YII_CSRF_TOKEN'])){
			$keyword = Yii::app()->session['rpt001_keyword'];			
		} else {
			$keyword = isset($_POST['keyword'])?addslashes(trim($_POST['keyword'])):'';	
			
			Yii::app()->session['rpt001_keyword']=$keyword;			
		}
		$model = rpt_001::search($keyword);			
		$this->renderPartial('rpt001', array('model'=>$model));
		
		
	}
	public function actionRpt001pdf()
	{
		
		$code = isset($_GET['code'])?addslashes(trim($_GET['code'])):'';
		$id = isset($_GET['id'])?addslashes(trim($_GET['id'])):'';
		if($id==''){
			$id = '';	
		}
		if($code==''){
			$code = '';	
		}
		$this->render('rpt001pdf',array(
			'id'=>$id,
			'code'=>$code
			
		));
	}	
	public function actionRpt001excel()
	{
		
		$code = isset($_GET['code'])?addslashes(trim($_GET['code'])):'';
		$id = isset($_GET['id'])?addslashes(trim($_GET['id'])):'';
		if($id==''){
			$id = '';	
		}
		if($code==''){
			$code = '';	
		}
		$this->render('rpt001excel',array(
			'id'=>$id,
			'code'=>$code
			
		));
	}
}