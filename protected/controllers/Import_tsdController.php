<?php

class import_tsdController extends Controller
{
	
	
	public function actionIndex()
	{	
		$modeltrue = lkup_import::searchtrue();	
		$modelfalse = lkup_import::searchfalse();				
		$this->render('import_tsd', array(
			'modeltrue'=>$modeltrue,
			'modelfalse'=>$modelfalse
			));			
		//$this->render('import');			
	}
	
	public function actionUpload()
	{
		require_once Yii::getPathOfAlias('application') . Yii::app()->params['prg_ctrl']['vendor']['jquery-upload']['path']; 		
		require_once Yii::getPathOfAlias('application') . Yii::app()->params['prg_ctrl']['vendor']['jquery-upload']['path_intro']; 

		$upload_handler = new IntroUploadHandle(array(
			'accept_file_types' => '/\.(xls|xlsx|txt|jpeg|jpg|png|pdf|doc|docx|zip|rar|7z)$/i',			
			'upload_dir' => Yii::app()->params['prg_ctrl']['path']['upload'].Yii::app()->params['prg_ctrl']['path']['closepath'],	
			'upload_url' => Yii::app()->params['prg_ctrl']['url']['upload'].Yii::app()->params['prg_ctrl']['path']['closepath'],
		));
	
	}
	
	
	public function actionSavedata()
	{
		$fullpath=Yii::app()->params['prg_ctrl']['path']['upload'];
		$fullurl=Yii::app()->params['prg_ctrl']['url']['upload'];
		
		$save_path=Yii::app()->params['prg_ctrl']['path']['media'];
		$save_url=Yii::app()->params['prg_ctrl']['url']['media'];
		
		$closepath = Yii::app()->params['prg_ctrl']['path']['closepath'];
		
		$model=new frm_import;		
		$model->name=isset($_POST['name'])?$_POST['name']:'';		
		$model->size=isset($_POST['size'])?$_POST['size']:'';
		$model->closepath=$closepath;
		$model->path=$fullpath;		
		$model->url=$fullurl;		
		$model->save_path=$save_path;		
		$model->save_url=$save_url;
		$model->type=isset($_POST['type'])?$_POST['type']:'';	
		
		//echo var_dump($model->name);exit;
		if($model->save_import()) {
			echo CJSON::encode(array('status' => 'success','msg' =>'', ));	 
			//Yii::app()->session->remove('errmsg_import');
		} else {
			echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_import'], ));		
			Yii::app()->session->remove('errmsg_import');
		}		
		
	}
	
	
	public function actionSavefile()
	{
		
		
		$fullpath=Yii::app()->params['prg_ctrl']['path']['upload'];
		$fullurl=Yii::app()->params['prg_ctrl']['url']['upload'];
		
		$save_path=Yii::app()->params['prg_ctrl']['path']['media'];
		$save_url=Yii::app()->params['prg_ctrl']['url']['media'];
		
		$closepath = Yii::app()->params['prg_ctrl']['path']['closepath'];
		
		$model=new frm_import;		
		$model->name=isset($_POST['name'])?$_POST['name']:'';		
		$model->size=isset($_POST['size'])?$_POST['size']:'';
		$model->closepath=$closepath;
		$model->path=$fullpath;		
		$model->url=$fullurl;		
		$model->save_path=$save_path;		
		$model->save_url=$save_url;
		$model->type=isset($_POST['type'])?$_POST['type']:'';	
		
		
		if($model->save_insert()) {
			
			echo CJSON::encode(array('status' => 'success','msg' =>'', ));	
			 
		} else {
			echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_import'], ));		
			Yii::app()->session->remove('errmsg_import');
		}		
		
	}
	public function actionSavefile2()
	{
		
		
		$fullpath=Yii::app()->params['prg_ctrl']['path']['upload'];
		$fullurl=Yii::app()->params['prg_ctrl']['url']['upload'];
		
		$save_path=Yii::app()->params['prg_ctrl']['path']['media'];
		$save_url=Yii::app()->params['prg_ctrl']['url']['media'];
		
		$closepath = Yii::app()->params['prg_ctrl']['path']['closepath'];
		//echo var_dump(isset($_POST['name'])?$_POST['name']:'',isset($_POST['size'])?$_POST['size']:'',isset($_POST['type'])?$_POST['type']:'',$fullpath); exit;
	
		$name = isset($_POST['name'][0])?"convert_".$_POST['name'][0]:'';
		$exp = explode('.' , $name);
		$name = substr($name, 0 , -(strlen($exp[count($exp)-1])+1));
		$exp = $exp[count($exp)-1];
		
		
		//$type = isset($_POST['type'])?$_POST['type']:'';
		if(($exp=="txt") or ($exp=="TXT"))
		{
			$type="txt";
		}
		if(($exp=="xls") or ($exp=="xlsx"))
		{
			$type="xlsx";
		}
		
		$name = $name.".".$type;
		$inputFileName = $fullpath.$closepath.$name;
		
		$name = array($name);
		$size = array(filesize($inputFileName));
		$type=array($type);
		
		$model=new frm_import;		
		$model->name=$name;		
		$model->size=$size;
		$model->closepath=$closepath;
		$model->path=$fullpath;		
		$model->url=$fullurl;		
		$model->save_path=$save_path;		
		$model->save_url=$save_url;
		$model->type=$type;	
		
		
		
		if($model->save_insert()) {
			
			echo CJSON::encode(array('status' => 'success','msg' =>'', ));	
			 
		} else {			
			
			echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_import'],));		
			Yii::app()->session->remove('errmsg_import');
		}		
		
	}
	public function actionGetimport()
	{	
			
		if(isset($_GET['ajax']) && !isset($_POST['YII_CSRF_TOKEN'])){
			$id = Yii::app()->session['import_id'];				
		} else {
			$id = $id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';			
			Yii::app()->session['import_id']=$id;		
		}
		$modeltrue = lkup_import::searchtrue($id);	
		$modelfalse = lkup_import::searchfalse($id);					
		$this->render('import', array(
			'modeltrue'=>$modeltrue,
			'modelfalse'=>$modelfalse
			));		
	}
	
	public function actionShowdata()
	{
		$id = Yii::app()->session['id_import'];		
		//echo var_dump($id);
		$data = lkup_import::search($id);
		foreach($data as $dataitm){
			$cntt = $dataitm['cntt'];
			$cntf = $dataitm['cntf'];			
		}				
		
		echo CJSON::encode(array(
			'status' => 'success',
			'msg' => '',
			'id' => $id,			
			'cntt'=>$cntt,
			'cntf'=>$cntf			
			
			));		
	}
	public function actionSavedatades()
	{
	//	var_dump($_FILES["pic_upload"]["tmp_name"]);
	//	$images = $_FILES["pic_upload"]["tmp_name"];
	//	$new_images = "Thumbnails_".$_FILES["pic_upload"]["name"];
	
			$fileload=$_FILES["file_upload"]["name"];
			$fileload1=$_FILES["file_upload1"]["name"];
			$fileload2=$_FILES["file_upload2"]["name"];
		copy($_FILES["file_upload"]["tmp_name"],"media/".$_FILES["file_upload"]["name"]);
		copy($_FILES["file_upload1"]["tmp_name"],"media/".$_FILES["file_upload1"]["name"]);
		copy($_FILES["file_upload2"]["tmp_name"],"media/".$_FILES["file_upload2"]["name"]);
		
			$dataTotalAccount1 = frm_import_tsd::importtsd($fileload);
			$dataTotalAccount2 = frm_import_tsd::importtsd_book_closing($fileload1);
			$dataTotalAccount3 = frm_import_tsd::importtsd_not_found($fileload2);
			var_dump($dataTotalAccount1);
			var_dump($dataTotalAccount2);
			var_dump($dataTotalAccount3);
			
			$total=$dataTotalAccount1+$dataTotalAccount1+$dataTotalAccount1;
			$data= frm_import_tsd::TotalAccount_TSD($total);
			echo CJSON::encode(array('status' => 'success','msg' =>'', ));	
	}
}