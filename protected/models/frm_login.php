<?php

class frm_login extends CFormModel
{
	public $username;
	public $password;
	private $_identity;

	public function rules()
	{
		return array(
			array('username, password', 'safe'),				
		);
	}

	public function attributeLabels()
	{
		return array(

		);
	}

	public function login()
	{
		if($this->username==''){
			Yii::app()->session['errmsg_login2']='กรุณาระบุรหัสผู้ใช้';	
			return false;			
		}
		
		if($this->password==''){
			Yii::app()->session['errmsg_login2']='กรุณาระบุรหัสผ่าน';	
			return false;			
		}		
		
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			Yii::app()->user->login($this->_identity);
			return true;
		} else {
			if($this->_identity->errorCode == UserIdentity::ERROR_USERNAME_INVALID) {
				Yii::app()->session['errmsg_login2']='รหัสผู้ใช้ ไม่ถูกต้อง';
				
			} elseif($this->_identity->errorCode == UserIdentity::ERROR_PASSWORD_INVALID) {
				 Yii::app()->session['errmsg_login2']='รหัสผ่าน ไม่ถูกต้อง';

			} elseif($this->_identity->errorCode == UserIdentity::ERROR_USERNAME_NOTLDAP) {
				Yii::app()->session['errmsg_login2']='รหัสผู้ใช้หรือรหัสผ่าน ไม่ถูกต้อง';

				 
			} elseif($this->_identity->errorCode == UserIdentity::ERROR_USERNAME_NOTADMIN) {
				Yii::app()->session['errmsg_login2']='คุณไม่มีสิทธิ์ในการเข้าใช้งานระบบ';
				
			} elseif($this->_identity->errorCode == UserIdentity::ERROR_USERNAME_INSERTDEP) {
				Yii::app()->session['errmsg_login2']='ไม่สามารถตรวจสอบข้อมูลหน่วยงานได้';	
				
			} elseif($this->_identity->errorCode == UserIdentity::ERROR_USERNAME_NONDEPSEQ) {
				Yii::app()->session['errmsg_login2']='ข้อมูลหน่อยงานผู้ใช้ไม่มีอยู่ในระบบสอบทรัพย์กรุณาติดต่อเจ้าหน้าที่';	
			
			} elseif($this->_identity->errorCode == UserIdentity::ERROR_USERNAME_TIMELOGIN) {
				Yii::app()->session['errmsg_login2']='เนื่องจากไม่มีการเข้าใช้งานเกิน 6 เดือน กรุณาติดต่อกลุ่มเงินสมทบและเร่งรัดหนี้ หมายเลขโทรศัพท์ 02 956 2260-3';				
			}else {
				Yii::app()->session['errmsg_login2']='Invalid Exception.';
			}			
			return false;
		}
			
	}


		
}
