<?php

class NewsController extends Controller
{
	function init() {
		parent::chkLogin();
	}
		
	public function actionIndex()
	{
		$data=lkup_news::search();
		foreach($data as $dataitem){			
			//$id=$dataitem['id'];
			$txtnews=$dataitem['name'];	
			$status=$dataitem['status'];
		}		
		$this->render('news', array(				
				'txtnews' => $txtnews,
				'status' => $status
				
		));
				
	}
	
	
	public function actionSavedata(){

		$model=new frm_news;			
		$model->txtnews=isset($_POST['txtnews'])?addslashes(trim($_POST['txtnews'])):'';
		$model->status=isset($_POST['status'])?addslashes(trim($_POST['status'])):'';
		

			if($model->save_update()) {
					echo CJSON::encode(array('status' => 'success','msg' => '',));		 
			}else {
					echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_update'], ));		
						Yii::app()->session->remove('errmsg_update');
			}
		
		
	}
	
	function actionSelectdata(){
		$data=lkup_news::search();	
		foreach($data as $dataitem){	
			$txtnews=$dataitem['name'];	
			$status=$dataitem['status'];
		}
		echo CJSON::encode(array('status' => 'success','txtnews' => $txtnews,'st_news'=> $status,));		
	}
	
	
	
}