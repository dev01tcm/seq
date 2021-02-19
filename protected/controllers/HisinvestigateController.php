<?php

class HisinvestigateController extends Controller
{
	function init() {
		parent::chkLogin();
	}
		
	public function actionIndex()
	{
		Yii::app()->session->remove('hisinvestigate_keyword');
		$dataProvider = lkup_hisinvestigate::search();
		$this->render('hisinvestigate', array('dataProvider'=>$dataProvider));
	}
	public function actionSearch()
	{
		if(isset($_GET['ajax']) && !isset($_POST['YII_CSRF_TOKEN'])){
			$keyword = Yii::app()->session['hisinvestigate_keyword'];			
		} else {
			$keyword = isset($_POST['keyword'])?addslashes(trim($_POST['keyword'])):'';	
			Yii::app()->session['hisinvestigate_keyword']=$keyword;			
		}
		$dataProvider = lkup_hisinvestigate::search($keyword);			
		$this->render('hisinvestigate', array('dataProvider'=>$dataProvider));
		
		
	}

	public function actionGetdata()
	{
		
		$id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		$data=lkup_hisinvestigate::getRequest($id);
		foreach($data as $dataitem){
			
			$id=$dataitem['id'];
			$code=$dataitem['code'];
			$doc_no=$dataitem['doc_no'];
			$doc_date=$dataitem['doc_date'];
			$create_date=$dataitem['create_date'];			
			$filename=Yii::app()->params['prg_ctrl']['url']['media'].$dataitem['file_bankname'];
			$filename2=Yii::app()->params['prg_ctrl']['url']['media'].$dataitem['file_prename'];
		}
		echo CJSON::encode(array(
			'status' => 'success',
			'msg' => '',
			'id'=>$id,
			'code'=>$code,
			'doc_no'=>$doc_no,
			'doc_date'=>$doc_date,
			'filename'=>$filename,
			'filename2'=>$filename2,
			'create_date'=>$create_date
			
			));	
	}
	public function actionInvestigate(){

		$model=new frm_hisinvestigate;		
		$model->id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		//$model->code=isset($_POST['code'])?addslashes(trim($_POST['code'])):'';
		$model->doc_no=isset($_POST['doc_no'])?addslashes(trim($_POST['doc_no'])):'';
		$model->doc_date=isset($_POST['doc_date'])?addslashes(trim($_POST['doc_date'])):'';
		if($model->doc_date==''){$model->doc_date=null;}
		$id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		
		if($model->file_investigate()) {
			$data=lkup_hisinvestigate::getRequest($id);
			foreach($data as $dataitem){
				
				$id=$dataitem['id'];
				$code=$dataitem['code'];
				$doc_no=$dataitem['doc_no'];
				$doc_date=$dataitem['doc_date'];
				$create_date=$dataitem['create_date'];			
				$filename=Yii::app()->params['prg_ctrl']['url']['media'].$dataitem['file_bankname'];
				$filename2=Yii::app()->params['prg_ctrl']['url']['media'].$dataitem['file_prename'];
			}
			echo CJSON::encode(array(
				'status' => 'success',
				'msg' => '',
				'id'=>$id,
				'code'=>$code,
				'doc_no'=>$doc_no,
				'doc_date'=>$doc_date,
				'filename'=>$filename,
				'filename2'=>$filename2,
				'create_date'=>$create_date
				
				));	
				//echo CJSON::encode(array('status' => 'success','msg' => '',));					 
		} else {
			echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_hisinvestigate'], ));		
				Yii::app()->session->remove('errmsg_hisinvestigate');	
			}	
	}		
	
}