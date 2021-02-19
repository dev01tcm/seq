<?php

class Rpt002Controller extends Controller
{
	function init() {
		parent::chkLogin();
	}
		
	public function actionIndex()
	{
		
		//$model = lkup_profile::search();
		//$this->render('reportbank', array('model'=>$model));
		$this->render('rpt002');
	}
	public function actionRpt002pdf()
	{
		
		$doc_no = isset($_GET['doc_no'])?addslashes(trim($_GET['doc_no'])):'';
		$emp_no = isset($_GET['emp_no'])?addslashes(trim($_GET['emp_no'])):'';
		$people_no = isset($_GET['people_no'])?addslashes(trim($_GET['people_no'])):'';

		$this->render('rpt002pdf',array('doc_no'=>$doc_no,'emp_no'=>$emp_no,'people_no'=>$people_no));
	}	
}