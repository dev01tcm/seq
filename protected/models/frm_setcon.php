<?php

class frm_setcon extends CFormModel
{
	public $con_st;
	public $con_en;
	
	public function rules()
	{
		return array(
			array('code', 'con_st', 'con_en', 'safe'),				
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
	
		$sql = "update mas_config set con_st=:con_st, con_en=:con_en, update_date=now(), update_by=$updateby where id='1'";
		$command=yii::app()->db->createCommand($sql);		
		$command->bindValue(":con_st", $this->con_st);		
		$command->bindValue(":con_en", $this->con_en);			
			if($command->execute()) {
				return true;
			} else {
				Yii::app()->session['errmsg_setconfig']='ไม่สามารถบันทึกข้อมูลได้'.$sql;
				return false;
		}	
	}
		
}
