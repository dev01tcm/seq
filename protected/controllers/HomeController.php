<?php

class HomeController extends Controller
{
	function init() {
		parent::chkLogin();
	}
		
	public function actionIndex()
	{
		/*
		//$this->renderPartial('home2', array(
		//$this->layout='main_login2';
		$model = lkup_home::search();
		$modelslide = lkup_home::getSlide();	
		//$modelslideord = lkup_home::getSlideord();			
		$this->render('home', array(
			'model'=>$model,
			'modelslide'=>$modelslide
			//'modelslideord'=>$modelslideord
			));
			*/
			/*
		$now = new DateTime();
		
		echo $now->format('Y-m-d H:i:s');
			
		ini_set('max_execution_time', 120);
		*/
		//ini_set('max_execution_time', 120);
		$dataProvider = lkup_home::search();
		$modelform = lkup_hisimport::Searchform0();//ส่งยฟพฟ
		//echo "<br/>";
		//$now2 = new DateTime();
		//echo $now2->format('Y-m-d H:i:s');
		//exit;
		$this->render('home', array(	
			'modelform'=>$modelform,
			'dataProvider' => $dataProvider,
		));
	}
	public function actionSearch()
	{
		//$name='aaa';
		if(isset($_GET['ajax']) && !isset($_POST['YII_CSRF_TOKEN'])){
			$id = Yii::app()->session['home_id'];	
			$code = Yii::app()->session['home_code'];	
			$keyword = Yii::app()->session['home_keyword'];				
		} else {
			$id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';	
			$code=isset($_POST['code'])?addslashes(trim($_POST['code'])):'';	
			$keyword = isset($_POST['keyword'])?addslashes(trim($_POST['keyword'])):'';			
			Yii::app()->session['home_id']=$id;	
			Yii::app()->session['home_code']=$code;	
			Yii::app()->session['home_keyword']=$keyword;		
		}
		
		$dataProvider = lkup_home::search();
		$modelform = lkup_hisimport::Searchform($id,$code,$keyword);
		$this->render('home2', array(
			'modelform'=>$modelform,
			'dataProvider' => $dataProvider,
			//'name' => $name,
			));
		
	}
	public function actionSearch2()
	{
		//$name='aaa';

		if(isset($_GET['ajax']) && !isset($_POST['YII_CSRF_TOKEN'])){
			$code = Yii::app()->session['home_code'];	
				
		} else {
			$code=isset($_POST['code'])?addslashes(trim($_POST['code'])):'';	
				
			Yii::app()->session['home_code']=$code;	
		}

		//$dataProvider = lkup_home::search();
		//$modelform = lkup_hisimport::Searchform($code);
		$data=lkup_hisimport::getSearch($code);
		$this->layout='nolaout';
		$this->render('home3', array(
			'data'=>$data,
			//'dataProvider' => $dataProvider,
			//'name' => $name,
			));
		
	}
	
}