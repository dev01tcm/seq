<?php

class Rpt003Controller extends Controller
{
	function init() {
		parent::chkLogin();
	}
		
	public function actionIndex()
	{
		
		//$model = lkup_profile::search();
		//$this->render('reportbank', array('model'=>$model));
		$this->render('rpt003');
	}
	public function actionRpt003pdf()
	{
		
		$code_no = isset($_GET['code_no'])?addslashes(trim($_GET['code_no'])):'';
		$code = isset($_GET['code'])?addslashes(trim($_GET['code'])):'';
		$this->render('rpt003pdf',array('code_no'=>$code_no,'code'=>$code));
	}	
}