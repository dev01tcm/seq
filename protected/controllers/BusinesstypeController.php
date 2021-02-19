<?php

class BusinesstypeController extends Controller
{
	function init() {
		parent::chkLogin();
	}
		
	public function actionIndex()
	{
		
		$model = lkup_businesstype::search();
		$this->render('businesstype', array('model'=>$model));
		//$this->render('bank');
	}
	public function actionSearch()
	{
		//if(isset($_GET['ajax']) && isset($_GET['sort'])){
		if(isset($_GET['ajax']) && !isset($_POST['YII_CSRF_TOKEN'])){
			$keyword = Yii::app()->session['businesstype_keyword'];			
		} else {
			$keyword = isset($_POST['keyword'])?addslashes(trim($_POST['keyword'])):'';	
			
			Yii::app()->session['businesstype_keyword']=$keyword;			
		}
		$model = lkup_businesstype::search($keyword);			
		$this->renderPartial('businesstype', array('model'=>$model));
		
		
	}
	public function actionBusinesstypedata(){
		
		

		$id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		$data=lkup_businesstype::getBusinesstype($id);
		foreach($data as $dataitem){
			
			$id=$dataitem['id'];
			$code=$dataitem['code'];
			$name=$dataitem['name'];
			$order_number=$dataitem['business_order'];
			$type=$dataitem['type'];			
		
		}
		echo CJSON::encode(array(
			'status' => 'success',
			'msg' => '',
			'id'=>$id,
			'code'=>$code,
			'name'=>$name,
			'order_number'=>$order_number,
			'type'=>$type,
			//'email'=>$email
			
			));		

	}
	
	
	public function actionSavedata(){

		$model=new frm_businesstype;		
		$model->id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		$model->code=isset($_POST['code'])?addslashes(trim($_POST['code'])):'';
		$model->type=isset($_POST['type'])?addslashes(trim($_POST['type'])):'';
		$model->name=isset($_POST['name'])?addslashes(trim($_POST['name'])):'';
		$model->order_number=isset($_POST['order_number'])?addslashes(trim($_POST['order_number'])):'';
		if($model->order_number==""){
			$model->order_number=null;
		}
		if($model->id==''){
			if($model->save_insert()) {
					echo CJSON::encode(array('status' => 'success','msg' => '',));		 
				} else {
					echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_businesstype'], ));		
						Yii::app()->session->remove('errmsg_businesstype');
				}
		}else{
			if($model->save_update()) {
					echo CJSON::encode(array('status' => 'success','msg' => '',));		 
				} else {
					echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_businesstype'], ));		
						Yii::app()->session->remove('errmsg_businesstype');	
					}	
				}
		}
		
	public function actionDeletedata(){

		$model=new frm_businesstype;		
		$model->id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		
			if($model->save_delete()) {
					echo CJSON::encode(array('status' => 'success','msg' => '',));		 
				} else {
					echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_businesstype'], ));		
						Yii::app()->session->remove('errmsg_businesstype');
				}
	}
		
}