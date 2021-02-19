<?php

class Rpt004Controller extends Controller
{
	function init() {
		parent::chkLogin();
	}
		
	public function actionIndex()
	{
		
		//$model = lkup_profile::search();
		//$this->render('reportbank', array('model'=>$model));
		$this->render('rpt004');
	}
	
		public function actionRpt004pdf()
	{
		$doc_no = isset($_GET['doc_no'])?addslashes(trim($_GET['doc_no'])):'';
		$this->render('rpt004pdf',array('doc_no'=>$doc_no));
	}
	
}