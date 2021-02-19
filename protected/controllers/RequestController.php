<?php

class RequestController extends Controller
{
	function init() {
		parent::chkLogin();
	}
		
	public function actionIndex()
	{
		
		$id=Yii::app()->session['id_request'];
		$model = lkup_request::search();
		$modeldetail = lkup_request::getDetail();
		
		$this->render('request', array(
			'model'=>$model,			
			'modeldetail'=>$modeldetail
			));		
	}
	public function actionSearch()
	{
		
		if(isset($_GET['ajax']) && !isset($_POST['YII_CSRF_TOKEN'])){
			$keyword = Yii::app()->session['request_keyword'];	
			$acc_emp = Yii::app()->session['request_acc_emp'];
			$iden = Yii::app()->session['request_iden'];	
			$status1 = Yii::app()->session['request_status1'];
			$status2 = Yii::app()->session['request_status2'];
			$status3 = Yii::app()->session['request_status3'];
			$status4 = Yii::app()->session['request_status4'];
		} else {
			$keyword = isset($_POST['keyword'])?addslashes(trim($_POST['keyword'])):'';	
			$acc_emp = isset($_POST['acc_emp'])?addslashes(trim($_POST['acc_emp'])):'';
			$iden = isset($_POST['iden'])?addslashes(trim($_POST['iden'])):'';
			$status1 = isset($_POST['status1'])?addslashes(trim($_POST['status1'])):'';
			$status2 = isset($_POST['status2'])?addslashes(trim($_POST['status2'])):'';
			$status3 = isset($_POST['status3'])?addslashes(trim($_POST['status3'])):'';
			$status4 = isset($_POST['status4'])?addslashes(trim($_POST['status4'])):'';
			
			Yii::app()->session['request_keyword']=$keyword;
			Yii::app()->session['request_acc_emp']=$acc_emp;
			Yii::app()->session['request_iden']=$iden;
			Yii::app()->session['request_status1']=$status1;
			Yii::app()->session['request_status2']=$status2;	
			Yii::app()->session['request_status3']=$status3;	
			Yii::app()->session['request_status4']=$status4;				
		}
		$model = lkup_request::search($keyword,$acc_emp,$iden,$status1,$status2,$status3,$status4);	
		$modeldetail = lkup_request::searchrequest();				
		$this->render('request', array(
			'model'=>$model,
			'modeldetail'=>$modeldetail
			));	
	}
	public function actionRequestform(){
		
		$id = isset($_GET['id'])?addslashes(trim($_GET['id'])):'';	
		$doc_no = isset($_GET['doc_no'])?addslashes(trim($_GET['doc_no'])):'';
		$doc_date = isset($_GET['doc_date'])?addslashes(trim($_GET['doc_date'])):'';
		$doc_no_tsd = isset($_GET['doc_no_tsd'])?addslashes(trim($_GET['doc_no_tsd'])):'';
	

		if($doc_date!=''){
			$data=lkup_request::getRequestfrom($doc_no,$doc_date);
			foreach($data as $dataitem){
				$doc_no=$dataitem['doc_no'];
				$doc_date=$dataitem['doc_date'];
				$docdate=$dataitem['docdate'];
			}

			$modelform = lkup_request::searchdetail($doc_no,$docdate);
			$this->render('requestform', array(
				'state'=>'edit',	
				'modelform' => $modelform,	
				'id' => '',	
				'doc_no' => $doc_no,
				'doc_no_tsd' => $doc_no_tsd,		
				'doc_date' => $doc_date										
			));			
			
		}
		
		if($id!=''){
		
			$data=lkup_request::getRequestfrom($id);
				foreach($data as $dataitem){			
				$id=$dataitem['id'];
				$doc_no=$dataitem['doc_no'];
				$doc_date=$dataitem['doc_date'];
				$docdate=$dataitem['docdate'];	
									
			}

			$modelform = lkup_request::searchdetail($doc_no,$docdate);		
			$this->render('requestform', array(
				'state'=>'edit',	
				'modelform' => $modelform,										
				'id' => $id,	
				'doc_no' => $doc_no,		
				'doc_date' => $doc_date,	
				'docdate' => $docdate,											
			));
		}
		if($id=='' && $doc_date==''){
			$modelform = lkup_request::searchdetail();
		//	$modelform_tsd = lkup_request_tsd::searchdetail();
			$this->render('requestform', array(			
			'modelform' => $modelform,	
		//	'modelform_tsd' => $modelform_tsd,						
			'state'=>'add'));
		}
		
		
	}
	public function actionSearchform(){
		$doc_no = isset($_POST['doc_no'])?addslashes(trim($_POST['doc_no'])):'';	
		$doc_date = isset($_POST['doc_date'])?addslashes(trim($_POST['doc_date'])):'';
		$doc_no_tsd = isset($_POST['doc_no_tsd'])?addslashes(trim($_POST['doc_no_tsd'])):'';
		
		$modelform = lkup_request::searchdetail($doc_no,$doc_date,$doc_no_tsd);
	//	$modelform_tsd = lkup_request_tsd::searchdetail_tsd($doc_no_tsd,$doc_date);
		$this->render('requestform', array(
			'modelform'=>$modelform,
		//	'modelform_tsd'=>$modelform_tsd,
			'state'=>'',
			));	
	}
	public function actionRequestdata(){
		
		
		$name="";
		$code="";

		$id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		$data=lkup_request::getRequest($id);
		foreach($data as $dataitem){
			
			$id=$dataitem['id'];
			$doc_no=$dataitem['doc_no'];
			$doc_date=$dataitem['doc_date'];
			$acc_employer=$dataitem['acc_employer'];
			$emp_type=$dataitem['emp_type'];
			$business_type=$dataitem['business_type'];
			$pid_type=$dataitem['pid_type'];
			$prefix=$dataitem['prefix'];
			$pid=$dataitem['pid'];
			$cid=$dataitem['cid'];
			$birth=$dataitem['birth'];
			$address=$dataitem['address'];
			$name=$dataitem['name'];
			$lname=$dataitem['lname'];
			$company_name=$dataitem['company_name'];
			$active=$dataitem['status'];
			
			$activereq=$dataitem['active'];
			$remark=$dataitem['remark'];
			$business_name=$dataitem['business_name'];
		
		}
		echo CJSON::encode(array(
			'status' => 'success',
			'msg' => '',
			'id'=>$id,
			'doc_no'=>preg_replace('/\\\\/', '', $doc_no),
			'doc_date'=>$doc_date,
			'acc_employer'=>preg_replace('/\\\\/', '', $acc_employer),
			'emptype'=>$emp_type,
			'business_type'=>$business_type,
			'company_name'=>preg_replace('/\\\\/', '', $company_name),
			'pid_type'=>$pid_type,
			'prefix'=>$prefix,
			'pid'=>$pid,
			'cid'=>$cid,
			'birth'=>$birth,
			'address'=>preg_replace('/\\\\/', '', $address),
			'name'=>preg_replace('/\\\\/', '', $name),
			'lname'=>preg_replace('/\\\\/', '', $lname),
			'active'=>$active,
			'activereq'=>$activereq,
			'remark'=>preg_replace('/\\\\/', '', $remark),
			'business_name'=>preg_replace('/\\\\/', '', $business_name)
			
			));		

	}
	
	
	public function actionSavedata()
	{
		$model=new frm_request;		
		$model->id=isset($_POST['id'])?(trim($_POST['id'])):'';
		$model->state=isset($_POST['state'])?addslashes(trim($_POST['state'])):'';
		$model->doc_no=isset($_POST['doc_no'])?(trim($_POST['doc_no'])):'';
		$model->doc_date=isset($_POST['doc_date'])?(trim($_POST['doc_date'])):'';
		$model->acc_employer=isset($_POST['acc_employer'])?(trim($_POST['acc_employer'])):'';
		$model->pid_type=isset($_POST['pid_type'])?(trim($_POST['pid_type'])):'';
		$model->business_type=isset($_POST['business_type'])?(trim($_POST['business_type'])):'';
		$model->business_name=isset($_POST['business_name'])?(trim($_POST['business_name'])):'';
		$model->emptype=isset($_POST['emptype'])?(trim($_POST['emptype'])):'';
		$model->name=isset($_POST['name'])?(trim($_POST['name'])):'';
		$model->lname=isset($_POST['lname'])?(trim($_POST['lname'])):'';		
		$model->name=isset($_POST['name'])?(trim($_POST['name'])):'';
		$model->lname=isset($_POST['lname'])?(trim($_POST['lname'])):'';
		$model->birth=isset($_POST['birth'])?(trim($_POST['birth'])):'';
		$model->pid=isset($_POST['pid'])?(trim($_POST['pid'])):'';
		$model->cid=isset($_POST['cid'])?(trim($_POST['cid'])):'';
		$model->address=isset($_POST['address'])?(trim($_POST['address'])):'';		
		$model->company=isset($_POST['company'])?(trim($_POST['company'])):'';
		$model->doc_no_tsd=isset($_POST['doc_no_tsd'])?(trim($_POST['doc_no_tsd'])):'';
		$model->zipcode=isset($_POST['zipcode'])?(trim($_POST['zipcode'])):'';
		$model->active=isset($_POST['active'])?(trim($_POST['active'])):'';
		$model->remark=isset($_POST['remark'])?(trim($_POST['remark'])):'';
		
		
		
		if($model->birth==''){
			$model->birth=null;
		}
		//exit;
				
		if($model->state=='edit'){
			if($model->save_insert()) {
					echo CJSON::encode(array('status' => 'success','msg' => '',));		 
				} else {
					echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_request'], ));		
						Yii::app()->session->remove('errmsg_request');
				}
		}else{
			if($model->id==''){
				if($model->save_insert()) {
						echo CJSON::encode(array('status' => 'success','msg' => '',));		 
					} else {
						echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_request'], ));		
							Yii::app()->session->remove('errmsg_request');
					}
			}else{
				if($model->save_update()) {
					echo CJSON::encode(array('status' => 'success','msg' => '',));		 
				} else {
					echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_request'], ));		
					Yii::app()->session->remove('errmsg_request');	
				}	
			}
		}
	}
	
	
	public function actionSelecttype()
	{		
		$id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		$data=lookupdata::getSelecttype($id);			
		echo CJSON::encode(array(
			'status' => 'success',
			'msg' => '',
			'data'=>$data,
			));
		
	}
	
	
	public function actionDeletedata()
	{
		$model=new frm_request;		
		$model->id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';		
		if($model->save_delete()) {
				echo CJSON::encode(array('status' => 'success','msg' => '',));		 
		} else {
			echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_request'], ));		
				Yii::app()->session->remove('errmsg_request');
		}
	}
	
	
	
	public function actionSearchhead()
	{
		$id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		$data = lookupdata::getDetail($id);
		foreach($data as $dataitem){
			
			$id=$dataitem['id'];
			$code=$dataitem['code'];
			$doc_date=$dataitem['doc_date'];
			$acc_employer=$dataitem['acc_employer'];
			$full_name=$dataitem['full_name'];
			
		
		}
		echo CJSON::encode(array(
			'status' => 'success',
			'msg' => '',
			'id'=>$id,
			'code'=>$code,
			'doc_date'=>$doc_date,
			'acc_employer'=>preg_replace('/\\\\/', '', $acc_employer),			
			'full_name'=>preg_replace('/\\\\/', '', $full_name),
		));	
	}
	
	public function actionSearchdetail(){
		
		$id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';	
		Yii::app()->session['id_request']=$id;	
		$model = lkup_request::search();	
		$modeldetail = lkup_request::getDetail($id);
		
		$this->render('request', array(
			'model'=>$model,			
			'modeldetail'=>$modeldetail
			));		
	}
	
	public function getActive($data){
		$active = $data['active'];
		$ret = "";
		if($active==1){
			$ret.= "<img src='".Yii::app()->params['prg_ctrl']['url']['baseurl']."/images/icon/plus.png' style='width:16px;' />";
		}else if($active==2){
			$ret.= "<img src='".Yii::app()->params['prg_ctrl']['url']['baseurl']."/images/icon/warning.png' style='width:16px;' />";
		}else if($active==3){
			$ret.= "<img src='".Yii::app()->params['prg_ctrl']['url']['baseurl']."/images/icon/bleach.gif' style='width:20px;' />";
		}else if($active==4){
			$ret.= "<img src='".Yii::app()->params['prg_ctrl']['url']['baseurl']."/images/icon/check.png' style='width:16px;' />";
		}else{
			$ret.="";
		}
		return $ret;
	}
}