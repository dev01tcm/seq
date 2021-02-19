<?php

class ChkuserController extends Controller
{
	function init() {
		parent::chkLogin();
	}
		
	public function actionIndex()
	{
		
		$dep = Yii::app()->user->getInfo('dep_id');
		$model = lkup_user::searchChkuser($dep);
		$this->render('chkuser', array('model'=>$model));
	}
	
	
}