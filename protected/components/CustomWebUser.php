<?php
	
class CustomWebUser extends CWebUser
{
	private $_usermodel;
	private $_bankmodel;
	
	public function getUser()
	{
		//$this->_usermodel=mas_user::model()->find('user_id=?',array(Yii::app()->user->id));
		$this->_usermodel=lookupdata::getUserlogin(Yii::app()->user->id);
		return true;
	}	
	
	public function getInfo($fieldcode)
	{	
		if($this->_usermodel===null) {$this->getUser();}
		$user = $this->_usermodel;
		/* 
		if($fieldcode=='displayname'){ $returnval = $user->firstname.' '.$user->lastname; }
		else if($fieldcode=='username')		{ $returnval = $user->username; }
		else if($fieldcode=='usergroup')	{ $returnval = stripslashes($user->usergroup); }
		else if($fieldcode=='position')	{ $returnval = stripslashes($user->position); }
		else {$returnval='';}
		*/
		
		//if($fieldcode=='displayname'){ $returnval = trim(stripslashes($user[0]['firstname']).' '.stripslashes($user[0]['lastname'])); }
		if($fieldcode=='displayname'){ $returnval = trim(stripslashes($user[0]['displayname'])); }		
		else if($fieldcode=='username')		{ $returnval = $user[0]['username']; }		
		else if($fieldcode=='userlevel_id')	{ $returnval = $user[0]['userlevel_id']; }
		else if($fieldcode=='dep_name')	{ $returnval = $user[0]['dep_name']; }
		else if($fieldcode=='dep_id')	{ $returnval = $user[0]['dep_id']; }
		else if($fieldcode=='code')	{ $returnval = $user[0]['code']; }
		/*
		else if($fieldcode=='chkprofie')	{ 
			if($user[0]['remark']==''){
				$returnval = false;
			} else {
				$returnval = true;
			}
		}		
		*/
		/*
		else if($fieldcode=='usergroupname')	{ $returnval = $user[0]['usergroup_name']; }
		else if($fieldcode=='position')	{ $returnval = stripslashes($user[0]['position']); }
		else if($fieldcode=='telno')	{ $returnval = stripslashes($user[0]['telno']); }
		else if($fieldcode=='department')	{ $returnval = stripslashes($user[0]['department_id']); }
		else if($fieldcode=='departmentgroup')	{ $returnval = stripslashes($user[0]['departmentgroup_id']); }
		else if($fieldcode=='company')	{ $returnval = stripslashes($user[0]['company_id']); }		
		
		else if($fieldcode=='chkprofie')	{ 
			if($user[0]['position']=='' || $user[0]['email']=='' || $user[0]['telno']=='' || $user[0]['mobileno']==''){
				$returnval = false;
			} else {
				$returnval = true;
			}
		}		
		else {$returnval='';}	
			
		*/
		
		
		return $returnval;
		
	}
	
	public function clearInfo()
	{	
		unset($this->_usermodel);
		return true;
	}
	
}