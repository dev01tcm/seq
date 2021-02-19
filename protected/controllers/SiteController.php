<?php

class SiteController extends Controller
{
	public function actionIndex()
	{
		/*
		if(!Yii::app()->user->isGuest) { 
			$getusergroup = Yii::app()->user->getInfo('usergroup');
			$getuserdept = Yii::app()->user->getInfo('department');
			$getuserdeptgroup = Yii::app()->user->getInfo('departmentgroup');			
			if($getusergroup=='4'){
				$this->redirect('repair');
			} else {
				$this->redirect('asset');
			}
		} else {
			$this->redirect('intro'); 
		}
		*/	
		if(!Yii::app()->user->isGuest) { 
		
			$this->redirect('home');
		} else {
			$this->redirect('login'); 
		}
		//$this->redirect('intro');
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

	public function actionTest()
	{
		$this->render('test');
	}
	public function actionTest1()
	{
		$this->render('test1');
	}
	public function actionTest2()
	{
		$this->render('test2');
	}
	public function actionTest3()
	{
		$this->render('test3');
	}	
	public function actionTest4()
	{
		$this->render('test4');
	}		
	public function actionDownload()
	{
		/*
		$model=new frm_convertfile;		
		$model->filename=isset($_POST['filename'])?$_POST['filename']:'';
		if($model->convert_download()) {
			echo CJSON::encode(array('status' => 'success','msg' => '',));		 
		} else {
			echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_convert'], ));		
			Yii::app()->session->remove('errmsg_convert');
		}*/
		
		Yii::app()->session['file'] = isset($_POST['filename'])?$_POST['filename']:'';
		//echo CJSON::encode(array('status' => 'success','msg' => '',));	
		//$this->render('download');
		
  		//exit();
		//echo var_dump(Yii::app()->session['file']);
		//$this->render('download');
	}
}