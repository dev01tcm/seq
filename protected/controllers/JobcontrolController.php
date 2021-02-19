<?php

class jobcontrolController extends Controller
{
	
	
	public function actionIndex()
	{	
		
		$this->layout='main_login';
		//$this->render('jobcontrol');	
		$this->investigate();		
	}
	
	public function investigate()
	{	
		Yii::app()->CommonFnc->log_events("JobExport", "Start job", "auo job");
		Yii::app()->CommonFnc->log_data("JobExport", "Start job", "auo job");	
		$data=lookupdata::getSetdata();
		foreach($data as $dataitem){
			$cntmax=$dataitem['cntmax'];
			$cntmin=$dataitem['cntmin'];
			$cnt=$dataitem['cnt'];
			$cntfig_st=$dataitem['cntfig_st'];
			$cntfig_en=$dataitem['cntfig_en'];
		}	
		if(($cntfig_st <= $cnt) and ($cnt<= $cntfig_en)){
			//echo var_dump($cnt+$cntfig_en);exit;
			$model=new frm_investigate;	
			$model->con_st=$cntfig_st;
			$model->con_en=$cntfig_en;
			$model->cntmin=$cntmin;
			$model->cntmax=$cntmax;
			$model->cnt=$cnt;	
			$model->jobbns=1;	
			
			$chk_genfile=0;
			if($model->save_insert()) {
				Yii::app()->CommonFnc->log_events("JobExport", "1/2 save data ok", "auo job");
				Yii::app()->CommonFnc->log_data("JobExport", "1/2 save data ok", "auo job");
				$data1=lookupdata::getCode2();
					foreach($data1 as $dataitem1) {
						if($dataitem1['code']=='') {
							$code = substr(date('Y')+543,-2).'001' ;
						}else{
							$code = $dataitem1['code'];
						}
					} 
				$data2=lkup_investigate::search($code,$cntmin,$cntmax);
				Yii::app()->CommonFnc->log_events("JobExport", "2/2 generate file ok", "auo job");
				Yii::app()->CommonFnc->log_data("JobExport", "2/2 generate file ok", "auo job");		
				$chk_genfile=1;					 
			} else {
				Yii::app()->CommonFnc->log_events("JobExport", "1/2 error ".Yii::app()->session['errmsg_investigate'], "auo job");
				Yii::app()->CommonFnc->log_data("JobExport", "1/2 error ".Yii::app()->session['errmsg_investigate'], "auo job");	
				Yii::app()->session->remove('errmsg_investigate');
			}	
			if($chk_genfile==0){
				Yii::app()->CommonFnc->log_events("JobExport", "2/2 generate file error", "auo job");
				Yii::app()->CommonFnc->log_data("JobExport", "2/2 generate file error", "auo job");	
			}
			Yii::app()->CommonFnc->log_events("JobExport", "End job", "auo job");
			Yii::app()->CommonFnc->log_data("JobExport", "End job", "auo job");	
		}else{
			Yii::app()->CommonFnc->log_events("JobExport", "Invalid Cnt; Cnt=".$cnt."; Min=".$cntfig_st."; Max=".$cntfig_en.";", "auo job");
			Yii::app()->CommonFnc->log_events("JobExport", "End job", "auo job");
			Yii::app()->CommonFnc->log_data("JobExport", "Invalid Cnt; Cnt=".$cnt."; Min=".$cntfig_st."; Max=".$cntfig_en.";", "auo job");	
			Yii::app()->CommonFnc->log_data("JobExport", "End job", "auo job");	
		}		
		
		//echo var_dump($cntfig_en);exit;
	}	
}