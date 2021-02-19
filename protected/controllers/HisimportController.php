<?php

class HisimportController extends Controller
{
	function init() {
		parent::chkLogin();
	}
		
	public function actionIndex()
	{
		ini_set('max_execution_time', 300);
		$dataProvider = lkup_hisimport::search2();		
//$modelform = lkup_hisimport::Searchform();
		$data = lkup_hisimport::getData();
		$this->render('hisimport', array(
			//'modelform'=>$modelform,
			'dataProvider' => $dataProvider
			));
		//$this->renderPartial('_hisimport', array(
			//'model'=>$model,
			//));
	}
	/*
	public function actionSearchlist()
	{
		//$name='aaa';
		$id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';	
		$code=isset($_POST['code'])?addslashes(trim($_POST['code'])):'';	
		$dataProvider = lkup_hisimport::search2();
		$modelform = lkup_hisimport::Searchform($id,$code);
		$this->render('hisimport', array(
			'modelform'=>$modelform,
			'dataProvider' => $dataProvider,
			//'name' => $name,
			));
		
	}*/
	public function actionSearchlist()
	{
		//if(isset($_GET['ajax']) && isset($_GET['sort'])){
		if(isset($_GET['ajax']) && !isset($_POST['YII_CSRF_TOKEN'])){
			$keyword = Yii::app()->session['hisimport_keyword'];			
		} else {
			$keyword = isset($_POST['keyword'])?addslashes(trim($_POST['keyword'])):'';	
			
			Yii::app()->session['hisimport_keyword']=$keyword;			
		}
		$modelform = lkup_hisimport::Searchform();	
		$dataProvider = lkup_hisimport::search2($keyword);		
		$this->render('hisimport', array(
			'modelform'=>$modelform,
			'dataProvider' => $dataProvider,
			//'name' => $name,
			));
		
		
	}
	public function actionSearch()
	{
		//$name='aaa';
		if(isset($_GET['ajax']) && !isset($_POST['YII_CSRF_TOKEN'])){
			$id = Yii::app()->session['hisimport_id'];	
			$code = Yii::app()->session['hisimport_code'];	
			$keyword = Yii::app()->session['hisimport_keyword'];				
		} else {
			$id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';	
			$code=isset($_POST['code'])?addslashes(trim($_POST['code'])):'';	
			$keyword = isset($_POST['keyword'])?addslashes(trim($_POST['keyword'])):'';			
			Yii::app()->session['hisimport_id']=$id;	
			Yii::app()->session['hisimport_code']=$code;	
			Yii::app()->session['hisimport_keyword']=$keyword;		
		}
		
		$dataProvider = lkup_hisimport::search2();
		$modelform = lkup_hisimport::Searchform($id,$code,$keyword);
		$this->render('hisimport', array(
			'modelform'=>$modelform,
			'dataProvider' => $dataProvider,
			//'name' => $name,
			));
		
	}
	public function actionDatabank()
	{
		//$name='aaa';
		$data=lkup_hisimport::getSearch();
		$modelform = lkup_hisimport::Searchform();
		$dataProvider = lkup_hisimport::search2();
		$this->renderPartial('hisimport', array(
			'modelform'=>$modelform,
			'dataProvider' => $dataProvider,
			//'name' => $name,
			));
		
	}
	public function actionSearchhead()
	{
		
		$id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		$code=isset($_POST['code'])?addslashes(trim($_POST['code'])):'';
		$data=lkup_hisimport::getData($id,$code);
		foreach($data as $dataitem){		
		
			//$id=$dataitem['id'];
			$code=$dataitem['code'];
			$doc_no=$dataitem['doc_no'];
			$doc_date=$dataitem['doc_date'];	
			$create_date=$dataitem['create_date'];
			$bank_id=$dataitem['bank_id'];	
			$name=$dataitem['name'];
		}
		echo CJSON::encode(array(
			'status' => 'success',
			'msg' => '',
			//'id'=>$id,
			'code'=>$code,
			'doc_no'=>$doc_no,
			'doc_date'=>$doc_date,
			'create_date'=>$create_date,
			'bank_id'=>$bank_id,
			'name'=>$name
			));
	}
	
	public function actionGetDataimport(){
		$id = isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		$bank_id = isset($_POST['bank_id'])?addslashes(trim($_POST['bank_id'])):'';
		$code = isset($_POST['code'])?addslashes(trim($_POST['code'])):'';
		$trn_id = isset($_POST['trn_id'])?($_POST['trn_id']):'';
		$namefile = isset($_POST['namefile'])?($_POST['namefile']):'';
		$sizefile = isset($_POST['sizefile'])?($_POST['sizefile']):'';
		$typefile = isset($_POST['typefile'])?($_POST['typefile']):'';
		$urlfile = isset($_POST['urlfile'])?($_POST['urlfile']):'';
		
		$cntfile = 0;
		

		$data = lkup_hisimport::getdataUpdate($bank_id,$code);
		if($data != null){
			foreach($data as $key => $dataitm){
				$cntfile = $cntfile + 1;
				$id_impt = $dataitm['id_impt'];
				$trn_id[$key] = $dataitm['trn_id'];
				$code = $dataitm['code'];
				$doc_no = $dataitm['doc_no'];
				$doc_date = $dataitm['doc_date'];
				$bank_id = $dataitm['bank_id'];	
				$create_date = $dataitm['create_date'];
				$namefile[$key] = $dataitm['name'];
				$sizefile[$key] = $dataitm['file_size'];
				$typefile[$key] = $dataitm['file_type'];
				$urlfile[$key] = $dataitm['upload_url'];
				
			}
			//echo var_dump($urlfile);
			//exit;
			echo CJSON::encode(array(
				'status' => 'success',
				'id_impt' => $id_impt,
				'code' => $code,
				'doc_no' => $doc_no,
				'doc_date' => $doc_date,
				'bank_id' => $bank_id,
				'create_date' => $create_date,
				'namefile' => $namefile,
				'sizefile' => $sizefile,
				'typefile' => $typefile,
				'urlfile' => $urlfile,
				'cntfile' => $cntfile,
				'trn_id' => $trn_id
			));
		}else{
			//echo var_dump("ddd");
			//exit;
			$data = lkup_hisimport::getdataSecond($id);
			foreach($data as $dataitm){
				$id_impt = $dataitm['id'];
				$code = $dataitm['code'];
				$doc_no = $dataitm['doc_no'];
				$doc_date = $dataitm['doc_date'];
				$bank_id = $dataitm['bank_id'];	
				$create_date = $dataitm['create_date'];					
			}
			echo CJSON::encode(array(
				'status' => 'success',
				'id_impt' => $id_impt,
				'code' => $code,
				'doc_no' => $doc_no,
				'doc_date' => $doc_date,
				'create_date' => $create_date,
				'cntfile' => $cntfile				
				
			));			
		}
	}
	public function actionUpload()
	{
		require_once Yii::getPathOfAlias('application') . Yii::app()->params['prg_ctrl']['vendor']['jquery-upload']['path']; 		
		require_once Yii::getPathOfAlias('application') . Yii::app()->params['prg_ctrl']['vendor']['jquery-upload']['path_intro']; 

		$upload_handler = new IntroUploadHandle(array(
			'accept_file_types' => '/\.(jpeg|png|pdf|txt|xlsx|xls|jpg|doc|docx|zip|rar|7z)$/i',			
			'upload_dir' => Yii::app()->params['prg_ctrl']['path']['upload'].'/',	
			'upload_url' => Yii::app()->params['prg_ctrl']['url']['upload'].'/',
		));
	
	}
	
	public function actionSavefile()
	{
		$fullpath=Yii::app()->params['prg_ctrl']['path']['upload'];
		$fullurl=Yii::app()->params['prg_ctrl']['url']['upload'];

		$save_path=Yii::app()->params['prg_ctrl']['path']['media'];
		$save_url=Yii::app()->params['prg_ctrl']['url']['media'];

		$model = new frm_hisimport;
		$model->id = isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		$model->name = isset($_POST['name'])?$_POST['name']:'';
		$model->size = isset($_POST['size'])?$_POST['size']:'';
		$model->type = isset($_POST['type'])?$_POST['type']:'';
		$model->trnid = isset($_POST['trnid'])?$_POST['trnid']:'';
		$model->rmv = isset($_POST['rmv'])?$_POST['rmv']:'';
		$model->cntfile = isset($_POST['cntfile'])?addslashes(trim($_POST['cntfile'])):'';		
		$model->path=$fullpath;
		$model->url=$fullurl;		
		$model->save_path=$save_path;		
		$model->save_url=$save_url;
		$model->arr=isset($_POST['arr'])?($_POST['arr']):'';
			
		
			
			
		if($model->cntfile == 0 && $model->rmv == ''){
				
			if($model->save_insert()) {
				echo CJSON::encode(array('status' => 'success','msg' =>'', ));	 
			} else {
				echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_import'], ));		
				Yii::app()->session->remove('errmsg_import');
			}		
			//echo var_dump('bbb'); exit;		
		}else{

			if($model->save_update()){
				echo CJSON::encode(array('status' => 'success','msg' =>'', ));	 
			} else{
				echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_import'], ));		
				Yii::app()->session->remove('errmsg_import');
			}			
		}
		
		
	}
	public function actionHisimportdata()
	{
		
	
		$id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		$data=lkup_hisimport::getData($id);
		foreach($data as $dataitem){
			
			$id=$dataitem['id'];
			$code=$dataitem['code'];
			$doc_no=$dataitem['doc_no'];
			$doc_date=$dataitem['doc_date'];	
		
		}
		echo CJSON::encode(array(
			'status' => 'success',
			'msg' => '',
			'id'=>$id,
			'code'=>$code,
			'doc_no'=>$doc_no,
			'doc_date'=>$doc_date
			//'email'=>$email
			
			));		

	}
	
	public function actionHisimportdetail(){
		$id = isset($_GET['id'])?addslashes(trim($_GET['id'])):'';
		$modelform = lkup_hisimport::searchform($id);
		$data = lkup_hisimport::getDataimport($id);
		foreach($data as $dataitm){
			$code = $dataitm['code'];
			$doc_no = $dataitm['doc_no'];
			$create_date = $dataitm['create_date'];
			$filename = $dataitm['file_name'];
		}
		$this->render('hisimportdetail', array(
			'modelform'=>$modelform,
			'code' => $code,
			'doc_no' => $doc_no,
			'create_date' => $create_date,
			'filename' => $filename
		
		));
		
	
	}
	public function actionDeletedata(){

		$model=new frm_hisimport;		
		$model->idbank=isset($_POST['idbank'])?addslashes(trim($_POST['idbank'])):'';
		$model->code=isset($_POST['code'])?addslashes(trim($_POST['code'])):'';
			if($model->save_delete()){
				
					echo CJSON::encode(array('status' => 'success','msg' => '',));		 
				} else {
					echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_user'], ));		
						Yii::app()->session->remove('errmsg_user');
				}
	}
	public function actionSearchformhis()
	{
		//$name='aaa';
		if(isset($_GET['ajax']) && !isset($_POST['YII_CSRF_TOKEN'])){
			$id = Yii::app()->session['hisimport_id'];	
			$code = Yii::app()->session['hisimport_code'];	
							
		} else {
			$id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';	
			$code=isset($_POST['code'])?addslashes(trim($_POST['code'])):'';			
			Yii::app()->session['hisimport_id']=$id;	
			Yii::app()->session['hisimport_code']=$code;	
				
		}
		$modelform = lkup_hisimport::searchformhisimport($id,$code);
		
		$this->layout='nolaout';
		$this->render('modalfrom', array(
			
			'modelform'=>$modelform,
			
			//'name' => $name,
			));
		
	}
	
}