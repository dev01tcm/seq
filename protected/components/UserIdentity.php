<?php
	
class UserIdentity extends CUserIdentity
{
	public $username;
	public $password;
	private $_id;
	private $_ad_id;
	private $dep_code;
	private $dep_name;
	private $_ad_firstname;
	private $_ad_surname;	
	private $_ad_err;
		
		
	const ERROR_USERNAME_NOTADMIN=21;
	const ERROR_USERNAME_NOTLDAP=22;
	const ERROR_USERNAME_ERRLDAP=23;
	const ERROR_USERNAME_INSERTDEP=24;
	const ERROR_USERNAME_NONDEPSEQ=25;
	const ERROR_USERNAME_TIMELOGIN=26;

	public function __construct()
	{
        $arg_list = func_get_args();
		$this->username=$arg_list[0];
		$this->password=$arg_list[1];
	}

	public function authenticate()
	{
	
		
		
		//if($this->AuthAD($this->username,$this->password) ){ 
				
				$username=strtolower($this->username);
				$user=mas_user::model()->find('LOWER(username)=? and status !=0',array($username));
				$dep_code="1101";
				if($user===null)
					{ 
		 
					$this->errorCode=self::ERROR_USERNAME_INVALID;
					}
				else if ($user->status==2)
					{
						$this->errorCode=self::ERROR_USERNAME_INVALID;
					}
				else 
					{
			
						$sql ="select id,code  from mas_department where status=1 and code='".$dep_code."'";   
						$rows =Yii::app()->db->createCommand($sql)->queryAll();
			
						if ($rows==null)
							{
									$this->errorCode=self::ERROR_USERNAME_NONDEPSEQ;
							}
						else
						{
							$sql ="select log_date from log_login where log_createby='".$username."'order by log_date ";  
							$rows2 =Yii::app()->db->createCommand($sql)->queryAll();
							if($rows2==null)
								{
									foreach($rows as $dataitem)
												{
													$id=$dataitem['id'];
												}
												/*$sql = "update mas_user set dep_id='".$id."',update_date=now() where id='".$user->id."'";
												$command=yii::app()->db->createCommand($sql);
												if($command->execute())
													{
													$this->_id=$user->id;	
													$this->errorCode=self::ERROR_NONE;
													}
												else
													{
													$this->errorCode=self::ERROR_USERNAME_INSERTDEP;
													}*/
											
											
													if($user->dep_id == $id)
														{
															$this->_id=$user->id;	
															$this->errorCode=self::ERROR_NONE;
														
														}
													else
														{
														
															$sql = "update mas_user set dep_id='".$id."',update_date=now() where id='".$user->id."'";
															$command=yii::app()->db->createCommand($sql);
															if($command->execute())
															{
																$this->_id=$user->id;	
																$this->errorCode=self::ERROR_NONE;
															}
															else
															{
																$this->errorCode=self::ERROR_USERNAME_INSERTDEP;
															}
														}
											
							}	
						else{	
								$sql ="select datediff(now(),log_date) from log_login where log_createby='".$username."'order by log_date DESC LIMIT 0,1";  
								$rows1 =Yii::app()->db->createCommand($sql)->queryAll();
								foreach($rows1 as $dataitem)
										{
											$date=$dataitem['datediff(now(),log_date)'];
										}
										if($date>180||$user->status==3 )
										{
												Yii::app()->CommonFnc->log_login("Login", $user->username);
												$sql = "update mas_user set status=3,update_date=now() where username='".$user->username."'";
												Yii::app()->CommonFnc->log_users($user->id,"update","system auto");
												$command=yii::app()->db->createCommand($sql);
												if($command->execute())
													 {
														 
													 }
												$this->errorCode=self::ERROR_USERNAME_TIMELOGIN;
										}
										
										else{
											
								
												foreach($rows as $dataitem)
												{
													$id=$dataitem['id'];
															}
													/*$sql = "update mas_user set dep_id='".$id."',update_date=now() where id='".$user->id."'";
													$command=yii::app()->db->createCommand($sql);
													if($command->execute())
														{
														$this->_id=$user->id;	
														$this->errorCode=self::ERROR_NONE;
														}
													else
														{
														$this->errorCode=self::ERROR_USERNAME_INSERTDEP;
														}*/
											
											
													if($user->dep_id == $id)
														{
															$this->_id=$user->id;	
															$this->errorCode=self::ERROR_NONE;
														
														}
													else
														{
														
															$sql = "update mas_user set dep_id='".$id."',update_date=now() where id='".$user->id."'";
															$command=yii::app()->db->createCommand($sql);
															if($command->execute())
															{
																$this->_id=$user->id;	
																$this->errorCode=self::ERROR_NONE;
															}
															else
															{
																$this->errorCode=self::ERROR_USERNAME_INSERTDEP;
															}
														}
												}
								}
									
						}
					}
			/*}
			else{
					$this->errorCode=self::ERROR_USERNAME_NOTLDAP;
				}*/
		return $this->errorCode==self::ERROR_NONE;
		
		
		
		
		
	}	

	private function AuthAD($username,$password) {
		$host=Yii::app()->params['prg_ctrl']['ldap']['server']; 
		$port=Yii::app()->params['prg_ctrl']['ldap']['port'];
		$bind_uid=Yii::app()->params['prg_ctrl']['ldap']['bind_uid'];		
		$bind_pwd=Yii::app()->params['prg_ctrl']['ldap']['bind_pwd'];			
		$bind_dn=Yii::app()->params['prg_ctrl']['ldap']['bind_dn'];		
		$filter_attr=Yii::app()->params['prg_ctrl']['ldap']['filter_attr'];		
		$arr_search_attr=Yii::app()->params['prg_ctrl']['ldap']['arr_search_attr'];			
		$arr_basedn=Yii::app()->params['prg_ctrl']['ldap']['arr_basedn'];			
					
		$ldapcon = ldap_connect($host,$port);		
		if(!$ldapcon) { 
			//echo '<br> ldap cannot connect';
			return false; 
		}
		
		ldap_set_option($ldapcon, LDAP_OPT_PROTOCOL_VERSION, 3);
		$ldapbind = ldap_bind($ldapcon,$bind_dn,$bind_pwd);
		if(!$ldapbind) { 
			
			ldap_close($ldapcon); 
			return false; 
		}
		
		$ldapsr = ldap_search($ldapcon, $arr_basedn, $filter_attr ."=". $username, array_values($arr_search_attr));
		if(!$ldapsr)
		{

			ldap_close($ldapcon); 
			return false; 
		}
		
		$entry = @ldap_get_entries($ldapcon, $ldapsr);
		if($entry==false){
			if(!$entry or !$entry[0])
			{
				
				ldap_close($ldapcon); 
				return false; 			
			}
		}
		
		if (@ldap_bind($ldapcon, $entry[0]['dn'], $password)==true )
		{
			foreach (array_keys($arr_search_attr) as $attr)
			{
				$ldap_user_info[$attr] = $entry[0][$arr_search_attr[$attr]][0];
			}
			$dep_name = isset($ldap_user_info['dep_name'])?$ldap_user_info['dep_name']:'';
			$dep_code = isset($ldap_user_info['dep_id'])?$ldap_user_info['dep_id']:'';
			$firstname = isset($ldap_user_info['firstname'])?$ldap_user_info['firstname']:'';
			$lastname = isset($ldap_user_info['lastname'])?$ldap_user_info['lastname']:'';
			$mail = isset($ldap_user_info['mail'])?$ldap_user_info['mail']:'';
			
			$this->_ad_firstname=$firstname;
			$this->_ad_surname=$lastname;
			$this->dep_code=$dep_code;
			$this->dep_name=$dep_name;
			Yii::app()->session['login_name']=$firstname.' '.$lastname;
			ldap_close($ldapcon);
			return true;			
		} else { 
			ldap_close($ldapcon); 
			return false; 		
		}	
	}
	
	public function getId()
	{
		return $this->_id;
	}	
}