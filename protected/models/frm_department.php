<?php

class frm_department extends CFormModel
{
	public $id;
	public $name;	
	public $code;
	
	public function rules()
	{
		return array(
			array('code', 'id','name', 'safe'),				
		);
	}

	public function attributeLabels()
	{
		return array(

		);
	}
	
	

	public function save_insert()
	{
		//check error
		//เช็คว่ามีข้อมูลหรือไม่
		
		$sql ="select count(*) as aa from mas_department where status=1 and name='".$this->name."' and code='".$this->code."' ";
	   	$data =Yii::app()->db->createCommand($sql)->queryAll();
		foreach($data as $dataitem){
			if ($dataitem['aa']>0){
				Yii::app()->session['errmsg_dep']='มีข้อมูลนี้ในระบบแล้ว';
				return false;
				}
			}		
		
		//save
		
		$createby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;		
		
		$sql = "INSERT INTO mas_department (code,name,create_date,create_by) VALUES(:code,:name,now(),$createby)";
		$command=yii::app()->db->createCommand($sql);
		$command->bindValue(":code", $this->code);		
		$command->bindValue(":name", $this->name);		
		if($command->execute()) {
			$id = Yii::app()->db->getLastInsertID();
			return true;
		} else { 
			Yii::app()->session['errmsg_dep']='เกิดข้อผิดพลาดบันทึกไม่สำเร็จ';
			return false;
		}			
	}	

	public function save_update()
	{
			$sql ="select count(*) as aa from mas_department where status=1 and name='".$this->name."' and id!='".$this->id."' and code='".$this->code."' ";
			$data =Yii::app()->db->createCommand($sql)->queryAll();
			foreach($data as $dataitem){
				if ($dataitem['aa']>0){
					Yii::app()->session['errmsg_dep']='มีข้อมูลนี้ในระบบแล้ว';
					return false;
					}
				}		
		//save
		
			$updateby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;		
		
			$sql = "update mas_department set code=:code, name=:name, update_date=now(), update_by=$updateby where id='".$this->id."'";
			$command=yii::app()->db->createCommand($sql);			
			$command->bindValue(":code", $this->code);		
		$command->bindValue(":name", $this->name);				
				if($command->execute()) {
					return true;
				} else {
					Yii::app()->session['errmsg_dep']='ไม่สามารถบันทึกข้อมูลได้'.$sql;
					return false;
			}	
	}
	public function save_delete()
	{
		
			$updateby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;	
			$sql = "update mas_department set status=0, update_date=now(), update_by=$updateby where id='".$this->id."'";
			$command=yii::app()->db->createCommand($sql);			
				if($command->execute()) {
					return true;
				} else {
					Yii::app()->session['errmsg_dep']='ไม่สามารถลบข้อมูลได้'.$sql;
					return false;
			}	
	}
		
}
