<?php

class Investigate_tsdController extends Controller
{
	function init() {
		parent::chkLogin();
	}
		
	public function actionIndex()
	{
		$data=lookupdata::getSetdata();
		foreach($data as $dataitem){
			$cntmax=$dataitem['cntmax'];
			$cntmin=$dataitem['cntmin'];
			$cnt=$dataitem['cnt'];
			$cntfig_st=$dataitem['cntfig_st'];
			$cntfig_en=$dataitem['cntfig_en'];
		}	
		
		$this->render('investigate_tsd', array(				
			'cntmax' => $cntmax,
			'cntmin' => $cntmin,
			'cnt' => $cnt,
			'cntfig_st' => $cntfig_st,
			'cntfig_en' => $cntfig_en	
		));
		//$model = lkup_profile::search();
		//$this->render('reportbank', array('model'=>$model));
		//$this->render('investigate');
	}
	public function actionSavedata()
	{
		$model=new frm_investigate_tsd;				
		//$model->doc_no=isset($_POST['doc_no'])?addslashes(trim($_POST['doc_no'])):'';
		//$model->doc_date=isset($_POST['doc_date'])?addslashes(trim($_POST['doc_date'])):'';
		$model->con_st=isset($_POST['con_st'])?addslashes(trim($_POST['con_st'])):'';
		$model->con_en=isset($_POST['con_en'])?addslashes(trim($_POST['con_en'])):'';
		$model->cntmin=isset($_POST['cntmin'])?addslashes(trim($_POST['cntmin'])):'';
		$model->cntmax=isset($_POST['cntmax'])?addslashes(trim($_POST['cntmax'])):'';
		$model->cnt=isset($_POST['cnt'])?addslashes(trim($_POST['cnt'])):'';		
		$code=isset($_POST['code'])?addslashes(trim($_POST['code'])):'';
		$cntmin=isset($_POST['cntmin'])?addslashes(trim($_POST['cntmin'])):'';
		$cntmax=isset($_POST['cntmax'])?addslashes(trim($_POST['cntmax'])):'';
		//if($model->doc_date==''){$model->doc_date=null;}
		
		//echo var_dump($model->doc_date);
		//exit;
		if($model->save_insert()) {
				$data=lkup_investigate_tsd::search($code,$cntmin,$cntmax);		
				echo CJSON::encode(array('status' => 'success','msg' => '','filename' => Yii::app()->session['filename'],));		
					 
			} else {
				echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_investigate'], ));		
					Yii::app()->session->remove('errmsg_investigate');
			}
		
	}
	public function actionSearch()
	{		
		$code=isset($_POST['code'])?addslashes(trim($_POST['code'])):'';
		$cntmin=isset($_POST['cntmin'])?addslashes(trim($_POST['cntmin'])):'';
		$cntmax=isset($_POST['cntmax'])?addslashes(trim($_POST['cntmax'])):'';	
		$data=lkup_investigate::search($code,$cntmin,$cntmax);
		//$data=lkup_investigate::search("61001","4019","4645");			
		echo CJSON::encode(array(
			'status' => 'success',
			'msg' => '',
			'filename' => Yii::app()->session['filename'],		
			));		

	}
	/*
	public function actionSavefile()
	{		
		$model=new frm_investigate;		
		$model->filename=isset($_POST['filename'])?addslashes(trim($_POST['filename'])):'';
		
		if($model->save_file()) {
				echo CJSON::encode(array('status' => 'success','msg' => '',));		 
			} else {
				echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_investigate'], ));		
					Yii::app()->session->remove('errmsg_investigate');
			}		

	}
	*/
}