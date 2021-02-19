<?php

class frm_user extends CFormModel
{
	public $id;
	public $username;	
	public $firstname;
	public $lastname;
	public $pid;
	public $dep_id;
	public $level;	
	public $st_date;
	public $en_date;
	public $active;
	
	
	public function rules()
	{
		return array(
			array('code', 'id', 'username', 'firstname', 'lastname', 'pid', 'dep_id','level', 'st_date', 'en_date','active', 'safe'),				
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
		
		$sql ="select count(*) as aa from mas_user where username='".$this->username."' and status in (1,2) ";//and pid='".$this->pid."' ";
	   	$data =Yii::app()->db->createCommand($sql)->queryAll();
		foreach($data as $dataitem){
			if ($dataitem['aa']>0){
				Yii::app()->session['errmsg_user']='มีข้อมูลนี้ในระบบแล้ว';
				return false;
				}
			}		
		
		//save
	
		$createby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;		
		
		$sql = "INSERT INTO mas_user (username,firstname,lastname,pid,dep_id,userlevel_id,st_date,en_date,status,create_date,create_by) ";
		$sql.= " VALUES(:username,:firstname,:lastname,:pid,:dep_id,:userlevel_id,:st_date,:en_date,:active,now(),$createby) ";
		//$sql.= " where id='".$this->id."' ";
		$command=yii::app()->db->createCommand($sql);
		$command->bindValue(":username", $this->username);
		$command->bindValue(":firstname", $this->firstname);
		$command->bindValue(":lastname", $this->lastname);		
		$command->bindValue(":pid", $this->pid);
		$command->bindValue(":dep_id", $this->dep_id);		
		$command->bindValue(":userlevel_id", $this->level);
		$command->bindValue(":st_date", $this->st_date);		
		$command->bindValue(":en_date", $this->en_date);
		$command->bindValue(":active", $this->active);		
		if($command->execute()) {
			$id = Yii::app()->db->getLastInsertID();
			$user = Yii::app()->user->getInfo('username');			
			Yii::app()->CommonFnc->log_users($id, "add", $user);
			return true;
		} else { 
			Yii::app()->session['errmsg_user']='เกิดข้อผิดพลาดบันทึกไม่สำเร็จ';
			return false;
		}			
	}	

	public function save_update()
	{
			$sql ="select count(*) as aa from mas_user where username='".$this->username."' and id!='".$this->id."'  and status in (1,2) ";// and pid='".$this->pid."' ";
			$data =Yii::app()->db->createCommand($sql)->queryAll();
			foreach($data as $dataitem){
				if ($dataitem['aa']>0){
					Yii::app()->session['errmsg_user']='มีข้อมูลนี้ในระบบแล้ว';
					return false;
					}
				}		
		//save
		
			$updateby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;		
		
			$sql = "update mas_user set username=:username,firstname=:firstname,lastname=:lastname, ";
			$sql.= "pid=:pid,dep_id=:dep_id,userlevel_id=:userlevel_id, ";
			$sql.= "st_date=:st_date,en_date=:en_date,status=:active, update_date=now(), update_by=$updateby ";
			$sql.= "where id='".$this->id."'";
			$command=yii::app()->db->createCommand($sql);			
			$command->bindValue(":username", $this->username);
			$command->bindValue(":firstname", $this->firstname);
			$command->bindValue(":lastname", $this->lastname);		
			$command->bindValue(":pid", $this->pid);
			$command->bindValue(":dep_id", $this->dep_id);		
			$command->bindValue(":userlevel_id", $this->level);
			$command->bindValue(":st_date", $this->st_date);		
			$command->bindValue(":en_date", $this->en_date);
			$command->bindValue(":active", $this->active);				
				if($command->execute()) {
					$user = Yii::app()->user->getInfo('username');					
					Yii::app()->CommonFnc->log_users($this->id, "update", $user);
					return true;
				} else {
					Yii::app()->session['errmsg_user']='ไม่สามารถบันทึกข้อมูลได้'.$sql;
					return false;
			}	
	}
	public function save_delete()
	{
		
			$updateby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;	
			$sql = "update mas_user set status=0, update_date=now(), update_by=$updateby where id='".$this->id."'";
			$command=yii::app()->db->createCommand($sql);			
				if($command->execute()) {
					return true;
				} else {
					Yii::app()->session['errmsg_user']='ไม่สามารถลบข้อมูลได้'.$sql;
					return false;
			}	
	}
		
}
