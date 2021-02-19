<?php

class InvestigateController extends Controller
{
	function init() {
		parent::chkLogin();
	}
		
	public function actionIndex()
	{
	$data=lookupdata::getSetdata();
	$data_tsd=lookupdata::getSetdata_tsd();
		foreach($data as $dataitem){
			$cntmax=$dataitem['cntmax'];
			$cntmin=$dataitem['cntmin'];
			$cnt=$dataitem['cnt'];
			$cntfig_st=$dataitem['cntfig_st'];
			$cntfig_en=$dataitem['cntfig_en'];
		}

		
		foreach($data_tsd as $dataitem1){
			$cntmax_tsd=$dataitem1['cntmax'];
			$cntmin_tsd=$dataitem1['cntmin'];
			$cnt_tsd=$dataitem1['cnt'];
			$cntfig_st_tsd=$dataitem1['cntfig_st'];
			$cntfig_en_tsd=$dataitem1['cntfig_en'];
		}	
		
		
		$this->render('investigate', array(				
			'cntmax' => $cntmax,
			'cntmin' => $cntmin,
			'cnt' => $cnt,
			'cntfig_st' => $cntfig_st,
			'cntfig_en' => $cntfig_en,
			'cntmax_tsd' => $cntmax_tsd,
			'cntmin_tsd' => $cntmin_tsd,
			'cnt_tsd' => $cnt_tsd,
			'cntfig_st_tsd' => $cntfig_st_tsd,
			'cntfig_en_tsd' => $cntfig_en_tsd			
		));
		//$model = lkup_profile::search();
		//$this->render('reportbank', array('model'=>$model));
		//$this->render('investigate');
	}
	public function actionSavedata()
	{
		$model=new frm_investigate;	
		$model1=new frm_investigate_tsd;			
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
		
		$model1->con_st_tsd=isset($_POST['con_st_tsd'])?addslashes(trim($_POST['con_st_tsd'])):'';
		$model1->con_en_tsd=isset($_POST['con_en_tsd'])?addslashes(trim($_POST['con_en_tsd'])):'';
		$model1->cntmin_tsd=isset($_POST['cntmin_tsd'])?addslashes(trim($_POST['cntmin_tsd'])):'';
		$model1->cntmax_tsd=isset($_POST['cntmax_tsd'])?addslashes(trim($_POST['cntmax_tsd'])):'';
		$model1->cnt_tsd=isset($_POST['cnt_tsd'])?addslashes(trim($_POST['cnt_tsd'])):'';		
		$code_tsd=isset($_POST['code_tsd'])?addslashes(trim($_POST['code_tsd'])):'';
		$cntmax_tsd=isset($_POST['cntmax_tsd'])?addslashes(trim($_POST['cntmax_tsd'])):'';
		$cntmin_tsd=isset($_POST['cntmin_tsd'])?addslashes(trim($_POST['cntmin_tsd'])):'';
		//if($model->doc_date==''){$model->doc_date=null;}
		
		//echo var_dump($model->doc_date);
		//exit;
		if($model->save_insert()) {
				if($model1->save_insert()) {
					$data=lkup_investigate::search($code,$cntmin,$cntmax);	
					$data=lkup_investigate_tsd::search($code_tsd,$cntmin_tsd,$cntmax_tsd);	
					echo CJSON::encode(array('status' => 'success','msg' => '','filename' => Yii::app()->session['filename'],));		
				}else {
					echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_investigate'], ));		
					Yii::app()->session->remove('errmsg_investigate');
				}
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