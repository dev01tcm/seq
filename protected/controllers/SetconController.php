<?php

class SetconController extends Controller
{
	function init() {
		parent::chkLogin();
	}
		
	
	public function actionIndex()
	{
		$data=lookupdata::getSetcon();
		foreach($data as $dataitem){
			$con_st=$dataitem['con_st'];
			$con_en=$dataitem['con_en'];
		}	
			
		$this->render('setcon', array(				
			'con_st' => $con_st,
			'con_en' => $con_en,	
		));
		
		//$this->render('setcon');
				
	}
	
	public function actionSavedata()
	{		
		$model=new frm_setcon;			
		$model->con_st=isset($_POST['con_st'])?addslashes(trim($_POST['con_st'])):'';	
		$model->con_en=isset($_POST['con_en'])?addslashes(trim($_POST['con_en'])):'';		
		
		if($model->save_update()) {
			echo CJSON::encode(array('status' => 'success','msg' => '',));		 
		} else {
			echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_setconfig'], ));		
				Yii::app()->session->remove('errmsg_setconfig');
		}
		
	}
		
}