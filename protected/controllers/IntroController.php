<?php

class IntroController extends Controller
{
		
	public function actionIndex()
	{
		//$this->layout='main_login2';
		$this->layout='main_login3';
		$this->render('intro');
	}
	public function actionLogin()
	{
		
		if(!Yii::app()->user->isGuest) { 
		/*
			$getusergroup = Yii::app()->user->getInfo('usergroup');
			$getuserdept = Yii::app()->user->getInfo('department');
			$getuserdeptgroup = Yii::app()->user->getInfo('departmentgroup');			
			if($getusergroup=='4'){
				$this->redirect('repair');
			} else {
				$this->redirect('asset');
			}
			*/
			$this->redirect('home');
		} else {
			$this->redirect('login'); 
		}
		
		//$this->redirect('intro');
	}
	
}