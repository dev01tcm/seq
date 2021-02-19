<?php

class frm_sample extends CFormModel
{
	public $id;
	public $name;
	
	public function rules()
	{
		return array(
			array('code, name', 'safe'),				
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

		
		//save
		$createby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;		
		
		$sql = "INSERT INTO tt_table ( id, name, active, createby, createdt)
		VALUES(:id, :name, :active, :createby, now())";
		$command=yii::app()->db->createCommand($sql);
		$command->bindValue(":id", $this->id);
		$command->bindValue(":name", addslashes($this->name));
		$command->bindValue(":active", "1");
		$command->bindValue(":createby", $createby);
		if($command->execute()) {
			$id = Yii::app()->db->getLastInsertID();
			return true;
		} else { 
			Yii::app()->session['errmsg_sample']='err bla bla bla';
			return false;
		}			
	}	

	public function save_update()
	{
		//check error
		
		
		//save		
		$updateby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;		
		
		$sql = "update tt_table set name=:name, updateby=:updateby, updatedt=now() where id=".$this->id;
		$command->bindValue(":name", addslashes($this->name));
		$command->bindValue(":updateby", $updateby);
				
		$command=yii::app()->db->createCommand($sql); 
		if($command->execute()) {
			return true;
		} else {
			Yii::app()->session['errmsg_sample']='err bla bla bla';
			return false;
		}	
	}	
		
}
