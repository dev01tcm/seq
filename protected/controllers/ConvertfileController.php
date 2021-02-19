<?php

class ConvertfileController extends Controller
{
	
	public function actionIndex()
	{			
		$this->render('convertfile');		
	}
	
	public function actionUpload()
	{
		require_once Yii::getPathOfAlias('application') . Yii::app()->params['prg_ctrl']['vendor']['jquery-upload']['path']; 		
		require_once Yii::getPathOfAlias('application') . Yii::app()->params['prg_ctrl']['vendor']['jquery-upload']['path_convert']; 

		$upload_handler = new ConvertUploadHandler(array(
			'accept_file_types' => '/\.(xls|xlsx|txt)$/i',			
			'upload_dir' => Yii::app()->params['prg_ctrl']['path']['upload'].Yii::app()->params['prg_ctrl']['path']['closepath'],	
			'upload_url' => Yii::app()->params['prg_ctrl']['url']['upload'].Yii::app()->params['prg_ctrl']['path']['closepath'],
		));
	
	}
	
	public function actionConvert()
	{
		$fullpath=Yii::app()->params['prg_ctrl']['path']['upload'];
		$fullurl=Yii::app()->params['prg_ctrl']['url']['upload'];
		$closepath = Yii::app()->params['prg_ctrl']['path']['closepath']; 
		
		$model=new frm_convertfile;		
		$model->name=isset($_POST['name'])?$_POST['name']:'';		
		$model->closepath=$closepath;
		$model->fullpath=$fullpath;		
		$model->fullurl=$fullurl;
		$model->type=isset($_POST['type'])?$_POST['type']:'';
		
		
		if($model->convert_file()) {
			echo CJSON::encode(array('status' => 'success','msg' => '',));		 
		} else {
			echo CJSON::encode(array('status' => 'error','msg' => Yii::app()->session['errmsg_convert'], ));		
			Yii::app()->session->remove('errmsg_convert');
		}
		
		
	}	
	public function actionDownload()
	{
		$this->render('download');
		
	}
}