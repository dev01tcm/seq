<?php

class TestController extends Controller
{
	function init() {
		parent::chkLogin();
	}
		
	public function actionIndex()
	{
		
		//$model = lkup_bank::search();
		//$this->render('bank', array('model'=>$model));
		$this->render('test');
	}
	public function actionTest1()
	{
		
		//$model = lkup_bank::search();
		//$this->render('bank', array('model'=>$model));
		$this->render('test1');
	}
	public function actionSearch()
	{		
		$code=isset($_POST['code'])?addslashes(trim($_POST['code'])):'';
		$cntmin=isset($_POST['cntmin'])?addslashes(trim($_POST['cntmin'])):'';
		$cntmax=isset($_POST['cntmax'])?addslashes(trim($_POST['cntmax'])):'';	
		//$data=lkup_investigate::search($code,$cntmin,$cntmax);
		$data=lkup_investigate::search("61003","5200","6001");			
		echo CJSON::encode(array(
			'status' => 'success',
			'msg' => '',
			'filename' => Yii::app()->session['filename'],		
			));		

	}	
}