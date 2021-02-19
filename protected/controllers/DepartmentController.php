<?php

class DepartmentController extends Controller
{
	function init() {
		parent::chkLogin();
	}
		
	public function actionIndex()
	{
		
		$model = lkup_department::search();
		$this->render('department', array('model'=>$model));
		//$this->render('department');
	}
	public function actionSearch()
	{
		//if(isset($_GET['ajax']) && isset($_GET['sort'])){
		if(isset($_GET['ajax']) && !isset($_POST['YII_CSRF_TOKEN'])){
			$keyword = Yii::app()->session['department_keyword'];			
		} else {
			$keyword = isset($_POST['keyword'])?addslashes(trim($_POST['keyword'])):'';	
			
			Yii::app()->session['department_keyword']=$keyword;			
		}
		$model = lkup_department::search($keyword);			
		$this->renderPartial('department', array('model'=>$model));
		
		
	}
	public function actionDepartmentdata(){
		
		$name="";
		$code="";

		$id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		$data=lkup_department::getDepartment($id);
		foreach($data as $dataitem){
			
			$id=$dataitem['id'];
			$code=$dataitem['code'];
			$name=$dataitem['name'];
			
			
		
		}
		echo CJSON::encode(array(
			'status' => 'success',
			'msg' => '',
			'id'=>$id,
			'code'=>$code,
			'name'=>$name
			
			));		

	}
	
	
	public function actionSavedata(){

		$model=new frm_department;		
		$model->id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		$model->code=isset($_POST['code'])?addslashes(trim($_POST['code'])):'';
		$model->name=isset($_POST['name'])?addslashes(trim($_POST['name'])):'';
		//$model->status=isset($_POST['status'])?addslashes(trim($_POST['status'])):'';
	
		if($model->id==''){
			if($model->save_insert()) {
					echo CJSON::encode(array('status' => 'success','msg' => '',));		 
				} else {
					echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_dep'], ));		
						Yii::app()->session->remove('errmsg_dep');
				}
		}else{
			if($model->save_update()) {
					echo CJSON::encode(array('status' => 'success','msg' => '',));		 
				} else {
					echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_dep'], ));		
						Yii::app()->session->remove('errmsg_dep');	
					}	
				}
		}
	public function actionDeletedata(){

		$model=new frm_department;		
		$model->id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		
			if($model->save_delete()) {
					echo CJSON::encode(array('status' => 'success','msg' => '',));		 
				} else {
					echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_dep'], ));		
						Yii::app()->session->remove('errmsg_dep');
				}
	}
	
}