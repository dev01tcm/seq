<?php

class BankController extends Controller
{
	
	public function actionIndex()
	{	$id = !Yii::app()->user->isGuest?Yii::app()->user->id:0;
				
		$model = lkup_bank::search();
		$this->render('bank', array('model'=>$model));
		
	}
	public function actionSearch()
	{
		//if(isset($_GET['ajax']) && isset($_GET['sort'])){
		if(isset($_GET['ajax']) && !isset($_POST['YII_CSRF_TOKEN'])){
			$keyword = Yii::app()->session['bank_keyword'];			
		} else {
			$keyword = isset($_POST['keyword'])?addslashes(trim($_POST['keyword'])):'';	
			
			Yii::app()->session['bank_keyword']=$keyword;			
		}
		$model = lkup_bank::search($keyword);			
		$this->renderPartial('bank', array('model'=>$model));
		
		
	}
	public function actionBankdata(){
		
		$name="";
		$code="";
		$address="";
		$email="";

		$id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		$data=lkup_bank::getBank($id);
		foreach($data as $dataitem){
			
			$id=$dataitem['id'];
			$code=$dataitem['code'];
			$name=$dataitem['name'];
			$address=$dataitem['address'];
			$email=$dataitem['email'];			
		
		}
		echo CJSON::encode(array(
			'status' => 'success',
			'msg' => '',
			'id'=>$id,
			'code'=>$code,
			'name'=>$name,
			'address'=>$address,
			'email'=>$email
			
			));		

	}
	
	
	public function actionSavedata(){

		$model=new frm_bank;		
		$model->id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		$model->code=isset($_POST['code'])?addslashes(trim($_POST['code'])):'';
		$model->name=isset($_POST['name'])?addslashes(trim($_POST['name'])):'';
		$model->address=isset($_POST['address'])?addslashes(trim($_POST['address'])):'';
		$model->email=isset($_POST['email'])?addslashes(trim($_POST['email'])):'';
	
		if($model->id==''){
			if($model->save_insert()) {
					echo CJSON::encode(array('status' => 'success','msg' => '',));		 
				} else {
					echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_bank'], ));		
						Yii::app()->session->remove('errmsg_bank');
				}
		}else{
			if($model->save_update()) {
					echo CJSON::encode(array('status' => 'success','msg' => '',));		 
				} else {
					echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_bank'], ));		
						Yii::app()->session->remove('errmsg_bank');	
					}	
				}
		}
	public function actionDeletedata(){

		$model=new frm_bank;		
		$model->id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		
			if($model->save_delete()) {
					echo CJSON::encode(array('status' => 'success','msg' => '',));		 
				} else {
					echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_bank'], ));		
						Yii::app()->session->remove('errmsg_bank');
				}
	}
		
}