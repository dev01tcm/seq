<?php

class LoginController extends Controller
{
	public function actionIndex()
	{
		$this->layout='main_login';
		$data=lookupdata::getNews();
		foreach($data as $dataitem) {                         
			$txtnews = $dataitem['name'];
			$status = $dataitem['status'];
		}		
		if(!Yii::app()->user->isGuest) { $this->redirect(Yii::app()->getBaseUrl(true)); }
		$this->render('login',array(				
				'txtnews' => $txtnews,
				'status' => $status
				
		));		
	}


	public function actionAuth()
	{
		$model=new frm_login;
		$model->username = isset($_POST['txtusername'])?addslashes(trim($_POST['txtusername'])):'';
		$model->password = isset($_POST['txtpassword'])?addslashes(trim($_POST['txtpassword'])):'';
		
		if($model->login()) {
			$user = Yii::app()->user->getInfo('username');			
			Yii::app()->CommonFnc->log_login("Login", $user);
			Yii::app()->CommonFnc->log_data("Login", $user, "ok");		
			//Yii::app()->session['login_time']=time();
			//Yii::app()->session['_timeSecond']=1200;
			echo CJSON::encode(array('status' => 'success','msg' => '',));		 
		} else {
			$user2 = isset($_POST['txtusername'])?addslashes(trim($_POST['txtusername'])):'';
			Yii::app()->CommonFnc->log_data("Login", $user2, "error:".Yii::app()->session['errmsg_login2']);
			echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_login2'], ));		
			Yii::app()->session->remove('errmsg_login2');
			//Yii::app()->session->remove('login_time');
			//Yii::app()->session->remove('_timeSecond');	
		}
	}

	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	
	function actionGetnews(){
		$data=lookupdata::getNews();
		foreach($data as $dataitem) {                         
			$txtnews = $dataitem['name'];
			$status = $dataitem['status'];
		}
		echo CJSON::encode(array('status' => 'success','txtnews' => $txtnews,'st_news' => $status,));		
			
	}
}