<?php

class frm_news extends CFormModel
{
	//public $id;
	public $txtnews;	
	public $status;
	
	public function rules()
	{
		return array(
			array('code', 'txtnews','status', 'safe'),				
		);
	}

	public function attributeLabels()
	{
		return array(

		);
	}
	

	public function save_update()
	{
			
		
		$updateby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;		
	
		$sql = "update mas_news set name=:txtnews,status=:status, update_date=now(), update_by=$updateby ";
		$command=yii::app()->db->createCommand($sql);	
		$command->bindValue(":txtnews", $this->txtnews);	
		$command->bindValue(":status", $this->status);				
			if($command->execute()) {
				return true;
			} else {
				Yii::app()->session['errmsg_update']='ไม่สามารถบันทึกข้อมูลได้'.$sql;
				return false;
		}	
	}
	
		
}
