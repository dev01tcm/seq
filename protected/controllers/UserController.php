<?php

class UserController extends Controller
{
	function init() {
		parent::chkLogin();
	}
		
	public function actionIndex()
	{
		
		$model = lkup_user::search();
		$modeldetail = lkup_user::getsearchhis();
		$this->render('user', array(
		'model'=>$model,
		'modeldetail'=>$modeldetail,
		));
		
	}
	public function actionSearch()
	{
		if(isset($_GET['ajax']) && !isset($_POST['YII_CSRF_TOKEN'])){
			$keyword = Yii::app()->session['user_keyword'];	
			$dep = Yii::app()->session['user_dep'];		
				
		} else {
			$keyword = isset($_POST['keyword'])?addslashes(trim($_POST['keyword'])):'';	
			$dep = isset($_POST['dep'])?addslashes(trim($_POST['dep'])):'';
			
			Yii::app()->session['user_keyword']=$keyword;		
			Yii::app()->session['user_dep']=$dep;		
		}
		$model = lkup_user::search($keyword,$dep);
		$modeldetail = lkup_user::getsearchhis();
		$this->renderPartial('user', array(
		'model'=>$model,
		'modeldetail'=>$modeldetail
		));
		
	}
	public function actionUserdata(){
		

		$id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		$data=lkup_user::getUser($id);
		foreach($data as $dataitem){
			
			$id=$dataitem['id'];
			$username=$dataitem['username'];
			$firstname=$dataitem['firstname'];
			$lastname=$dataitem['lastname'];				
			$pid=$dataitem['pid'];
			$dep_id=$dataitem['dep_id'];
			$level=$dataitem['userlevel_id'];
			$st_date=$dataitem['st_date'];
			$en_date=$dataitem['en_date'];
			$active=$dataitem['status'];
			
			
			
		
		}
		
		echo CJSON::encode(array(
			'status' => 'success',
			'msg' => '',
			'id'=>$id,
			'username'=>preg_replace('/\\\\/', '', $username),
			'firstname'=>preg_replace('/\\\\/', '', $firstname),
			'lastname'=>preg_replace('/\\\\/', '', $lastname),
			'pid'=>preg_replace('/\\\\/', '', $pid),
			'dep_id'=>$dep_id,
			'level'=>$level,
			'st_date'=>$st_date,
			'en_date'=>$en_date,
			'active'=>$active
			
			));		

	}
	
	
	public function actionSavedata()
	{
		
		$model=new frm_user;		
		$model->id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		$model->username=isset($_POST['username'])?addslashes(trim($_POST['username'])):'';
		$model->firstname=isset($_POST['firstname'])?addslashes(trim($_POST['firstname'])):'';
		$model->lastname=isset($_POST['lastname'])?addslashes(trim($_POST['lastname'])):'';
		$model->pid=isset($_POST['pid'])?addslashes(trim($_POST['pid'])):'';
		$model->dep_id=isset($_POST['dep_id'])?addslashes(trim($_POST['dep_id'])):'';
		$model->level=isset($_POST['level'])?addslashes(trim($_POST['level'])):'';
		$model->active=isset($_POST['active'])?addslashes(trim($_POST['active'])):'';
		
		$model->st_date=null;
		$model->en_date=null;
		
		
		if($model->id==''){
			if($model->save_insert()) {
					echo CJSON::encode(array('status' => 'success','msg' => '',));		 
				} else {
					echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_user'], ));		
						Yii::app()->session->remove('errmsg_user');
				}
		}else{
			if($model->save_update()) {
					echo CJSON::encode(array('status' => 'success','msg' => '',));		 
				} else {
					echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_user'], ));		
						Yii::app()->session->remove('errmsg_user');	
					}	
				}
		}
	public function actionDeletedata(){

		$model=new frm_user;		
		$model->id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		
			if($model->save_delete()) {
					echo CJSON::encode(array('status' => 'success','msg' => '',));		 
				} else {
					echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_user'], ));		
						Yii::app()->session->remove('errmsg_user');
				}
	}
	public function actionSearchsave()
	{
	
		$keyword1 =str_replace("(","/",$_POST['keyword']);	
		$keyword2 =str_replace(')','/',trim($keyword1));
		$keyword3 =str_replace('"','/',trim($keyword2));
		$keyword = isset($keyword1)?addslashes(str_replace('"','/',trim($keyword3))):'';
		$data = lkup_user::setsaveuser($keyword);
		
		if($data!=null)
		{
			foreach($data as $dataitem)
			{
				$username[]=$dataitem["userid"];
				$firstname[]=$dataitem["firstname"];
				$lastname[]=$dataitem["lastname"];				
				$pid[]=$dataitem["publiccode"];
				$dep_code=$dataitem["dep_id"];
				
				$data_dep=lkup_user::getdep($dep_code);
				$dep_name[]=$dataitem["dep_name"];
		
				
				foreach($data_dep as $dataitem1)
				{
					$dep_id[]=$dataitem1["id"];	
				}
			
			}

			echo CJSON::encode(array(
				'status' => 'success',
				'msg' => '',
				'username'=>preg_replace('/\\\\/', '', $username),
				'firstname'=>preg_replace('/\\\\/', '', $firstname),
				'lastname'=>preg_replace('/\\\\/', '', $lastname),
				'pid'=>preg_replace('/\\\\/', '', $pid),
				'dep_id'=>$dep_id,
				'dep_name'=>$dep_name,
			
				
				));		
		}
	
		else
		{
		echo CJSON::encode(array('status' => 'nodata','msg' => Yii::app()->session['errmsg_ldap'], ));		
			Yii::app()->session->remove('errmsg_ldap');
		}
	}
	public function actionSearchhis(){
		
		$id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		
		$model = lkup_user::search();	
		$modeldetail = lkup_user::getsearchhis($id);
		var_dump($modeldetail);
		$this->render('user', array(
			'model'=>$model,			
			'modeldetail'=>$modeldetail
			));
				
	}
	
}