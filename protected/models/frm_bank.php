<?php

class frm_bank extends CFormModel
{
	public $id;
	public $name;	
	public $code;
	public $address;
	public $email;	
	public $status;
	
	public function rules()
	{
		return array(
			array('code', 'id','name','address','email','status', 'safe'),				
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
		
		$sql ="select count(*) as aa from mas_bank where status=1 and name='".$this->name."' and code='".$this->code."' ";
	   	$data =Yii::app()->db->createCommand($sql)->queryAll();
		foreach($data as $dataitem){
			if ($dataitem['aa']>0){
				Yii::app()->session['errmsg_bank']='มีข้อมูลนี้ในระบบแล้ว';
				return false;
				}
			}		
		
		//save
		
		$createby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;		
		
		$sql = "INSERT INTO mas_bank (code,name,address,email,create_date,create_by) VALUES(:code,:name,:address,:email,now(),$createby)";
		$command=yii::app()->db->createCommand($sql);
		$command->bindValue(":code", $this->code);		
		$command->bindValue(":name", $this->name);
		$command->bindValue(":address", $this->address);		
		$command->bindValue(":email", $this->email);		
		if($command->execute()) {
			$id = Yii::app()->db->getLastInsertID();
			return true;
		} else { 
			Yii::app()->session['errmsg_bank']='เกิดข้อผิดพลาดบันทึกไม่สำเร็จ';
			return false;
		}			
	}	

	public function save_update()
	{
			$sql ="select count(*) as aa from mas_bank where status=1 and name='".$this->name."' and id!='".$this->id."' and code='".$this->code."' ";
			$data =Yii::app()->db->createCommand($sql)->queryAll();
			foreach($data as $dataitem){
				if ($dataitem['aa']>0){
					Yii::app()->session['errmsg_bank']='มีข้อมูลนี้ในระบบแล้ว';
					return false;
					}
				}		
		//save
		
			$updateby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;		
		
			$sql = "update mas_bank set code=:code, name=:name,address=:address, email=:email, update_date=now(), update_by=$updateby where id='".$this->id."'";
			$command=yii::app()->db->createCommand($sql);			
			$command->bindValue(":code", $this->code);		
			$command->bindValue(":name", $this->name);
			$command->bindValue(":address", $this->address);		
			$command->bindValue(":email", $this->email);				
				if($command->execute()) {
					return true;
				} else {
					Yii::app()->session['errmsg_bank']='ไม่สามารถบันทึกข้อมูลได้'.$sql;
					return false;
			}	
	}
	public function save_delete()
	{
		
			$updateby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;	
			$sql = "update mas_bank set status=0, update_date=now(), update_by=$updateby where id='".$this->id."'";
			$command=yii::app()->db->createCommand($sql);			
				if($command->execute()) {
					return true;
				} else {
					Yii::app()->session['errmsg_bank']='ไม่สามารถลบข้อมูลได้'.$sql;
					return false;
			}	
	}
		
}
