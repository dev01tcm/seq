<?php

class frm_businesstype extends CFormModel
{
	public $id;
	public $code;
	public $name;	
	public $type;
	public $order_number;
	
	
	public function rules()
	{
		return array(
			array('code','id','name','order_number','type','safe'),				
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
		
		$sql ="select count(*) as aa from mas_businesstype where status=1 and name='".$this->name."' and type='".$this->type."' ";
		$sql.=" and code='".$this->code."' ";
	   	$data =Yii::app()->db->createCommand($sql)->queryAll();
		foreach($data as $dataitem){
			if ($dataitem['aa']>0){
				Yii::app()->session['errmsg_businesstype']='มีข้อมูลนี้ในระบบแล้ว';
				return false;
				}
			}		
		$sql ="select business_order as aa from mas_businesstype where status=1 and business_order='".$this->order_number."'  ";			
		$data =Yii::app()->db->createCommand($sql)->queryAll();
		foreach($data as $dataitem){
			if ($dataitem['aa']>0){
				Yii::app()->session['errmsg_businesstype']='มีลำดับนี้แล้ว';
				return false;
				}
			}	
		//save
		
		$createby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;		
		
		$sql = "INSERT INTO mas_businesstype (code,name,business_order,type,create_date,create_by) VALUES(:code,:name,:business_order,:type,now(),$createby)";
		$command=yii::app()->db->createCommand($sql);
		$command->bindValue(":code", $this->code);		
		$command->bindValue(":name", $this->name);
		$command->bindValue(":business_order", $this->order_number);
		$command->bindValue(":type", $this->type);			
		if($command->execute()) {
			$id = Yii::app()->db->getLastInsertID();
			return true;
		} else { 
			Yii::app()->session['errmsg_businesstype']='เกิดข้อผิดพลาดบันทึกไม่สำเร็จ';
			return false;
		}			
	}	

	public function save_update()
	{
			$sql ="select count(*) as aa from mas_businesstype where status=1 and name='".$this->name."' and id!='".$this->id."' and type='".$this->type."' ";
			$sql.=" and code='".$this->code."' ";
			$data =Yii::app()->db->createCommand($sql)->queryAll();
			foreach($data as $dataitem){
				if ($dataitem['aa']>0){
					Yii::app()->session['errmsg_businesstype']='มีข้อมูลนี้ในระบบแล้ว';
					return false;
					}
				}	
				
			$sql ="select business_order as aa from mas_businesstype where status=1 and business_order='".$this->order_number."'  ";			
			$data =Yii::app()->db->createCommand($sql)->queryAll();
			foreach($data as $dataitem){
				if ($dataitem['aa']>0){
					Yii::app()->session['errmsg_businesstype']='มีลำดับนี้แล้ว';
					return false;
					}
				}	
		//save
		
			$updateby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;		
		
			$sql = "update mas_businesstype set code=:code, name=:name, business_order=:business_order, type=:type, update_date=now(), update_by=$updateby where id='".$this->id."'";
			$command=yii::app()->db->createCommand($sql);			
			$command->bindValue(":code", $this->code);		
			$command->bindValue(":name", $this->name);
			$command->bindValue(":business_order", $this->order_number);
			$command->bindValue(":type", $this->type);		
			//$command->bindValue(":email", $this->email);				
				if($command->execute()) {
					return true;
				} else {
					Yii::app()->session['errmsg_businesstype']='ไม่สามารถบันทึกข้อมูลได้'.$sql;
					return false;
			}	
	}
	public function save_delete()
	{
		
			$updateby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;	
			$sql = "update mas_businesstype set status=0, update_date=now(), update_by=$updateby where id='".$this->id."'";
			$command=yii::app()->db->createCommand($sql);			
				if($command->execute()) {
					return true;
				} else {
					Yii::app()->session['errmsg_businesstype']='ไม่สามารถลบข้อมูลได้'.$sql;
					return false;
			}	
	}
		
}
