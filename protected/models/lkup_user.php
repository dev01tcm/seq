<?php


class lkup_user extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'mas_user';
	}

    public function attributeLabels() {
        return array(
        );
    }
	public function search($keyword=null,$dep=null) 
	{

	
		$sqlCon="";
		
			if($keyword!=''){	
				
				$sqlCon.= " and (a.username like '%".$keyword."%' ";	
				$sqlCon.= " or a.pid like '%".$keyword."%' ";		
				$sqlCon.= " or a.firstname like '%".$keyword."%' ";		
				$sqlCon.= " or a.lastname like '%".$keyword."%'";
				$sqlCon.= " or b.code like '%".$keyword."%')";
			}
			if($dep!=''){							
				$sqlCon.= " and b.id = ".$dep;				
			}
		

		
		$count=Yii::app()->db->createCommand("select count(*) from mas_user a left join mas_department b on a.dep_id=b.id left join mas_userlevel c on a.userlevel_id=c.id where a.status!=0 ".$sqlCon)->queryScalar();
		$sql ="select @rownum := @rownum + 1 AS rank,a.id, replace(a.username,'\\\','') as username, replace(b.name,'\\\','') as department_name, ";
		$sql.="replace(c.name,'\\\','') as userlevel, replace(a.pid,'\\\','') as pid, ";		
		$sql.="replace(CONCAT(ifnull(a.firstname,''),' ',ifnull(a.lastname,'') ),'\\\','') as displayname, ";
		$sql.="CONCAT(ifnull(date_format(a.st_date,'%d/%m/'),''),ifnull(date_format(a.st_date,'%Y')+543,'') )as stdate, ";
		$sql.="CONCAT(ifnull(date_format(a.en_date,'%d/%m/'),''),ifnull(date_format(a.en_date,'%Y')+543,'') )as endate, ";
		$sql.="DATEDIFF( a.en_date, a.st_date ) AS active ";
		$sql.="from mas_user a ";
		$sql.="left join mas_department b on a.dep_id=b.id ";
		$sql.="left join mas_userlevel c on a.userlevel_id=c.id ";
		$sql.=",(SELECT @rownum := 0) r  ";
		$sql.="where a.status!=0 ".$sqlCon ;
		

		return new CSqlDataProvider($sql, array(
			'totalItemCount'=>$count,
			'sort'=>array(
				'attributes'=>array(
					 'rank', 'id', 'username','department_name', 'userlevel', 'stdate', 'endate', 'displayname', 'pid',
				),
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['prg_ctrl']['pagination']['default']['pagesize'],
			),
		));	
    }	
	public function searchChkuser($dep=null) 
	{
	
		$count=Yii::app()->db->createCommand("select count(*) from mas_user a left join mas_department b on a.dep_id=b.id where a.status=1 and b.id = ".$dep)->queryScalar();
		$sql ="select @rownum := @rownum + 1 AS rank,a.id, replace(a.username,'\\\','') as username, ";	
		$sql.="replace(CONCAT(ifnull(a.firstname,''),' ',ifnull(a.lastname,'') ),'\\\','') as displayname ";	
		$sql.="from mas_user a ";
		$sql.="left join mas_department b on a.dep_id=b.id ";
		$sql.=",(SELECT @rownum := 0) r  ";
		$sql.="where a.status=1  and b.id = ".$dep;	
		return new CSqlDataProvider($sql, array(
			'totalItemCount'=>$count,
			'sort'=>array(
				'attributes'=>array(
					 'rank', 'id', 'username','displayname',
				),
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['prg_ctrl']['pagination']['default']['pagesize'],
			),
		));	
	
	}
	public function getUser($id = null)
	{
	   	$sql="select id,username,pid,dep_id,userlevel_id, ";
		$sql.="firstname,lastname, ";
	   	$sql.="CONCAT(ifnull(date_format(st_date,'%d/%m/'),''),ifnull(date_format(st_date,'%Y')+543,'') )as st_date, ";
		$sql.="CONCAT(ifnull(date_format(en_date,'%d/%m/'),''),ifnull(date_format(en_date,'%Y')+543,'') )as en_date, ";
	   	$sql.="status from mas_user where id='".$id."'";	   
	   	$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;
	}
	public function setsaveuser($keyword = null)
	{	
	
	    $host=Yii::app()->params['prg_ctrl']['ldap']['server']; 
		$port=Yii::app()->params['prg_ctrl']['ldap']['port'];
		$bind_uid=Yii::app()->params['prg_ctrl']['ldap']['bind_uid'];		
		$bind_pwd=Yii::app()->params['prg_ctrl']['ldap']['bind_pwd'];			
		$bind_dn=Yii::app()->params['prg_ctrl']['ldap']['bind_dn'];		
		$filter_attr=Yii::app()->params['prg_ctrl']['ldap']['filter_attr'];	
		$publiccode_attr=Yii::app()->params['prg_ctrl']['ldap']['publiccode_attr'];				
		$arr_search_attr=Yii::app()->params['prg_ctrl']['ldap']['arr_search_attr'];			
		$arr_basedn=Yii::app()->params['prg_ctrl']['ldap']['arr_basedn'];			
					
		$ldapcon = ldap_connect($host,$port);		
			if(!$ldapcon) { 
		
				echo '<br> ldap cannot connect';
			 
		}
		
		ldap_set_option($ldapcon, LDAP_OPT_PROTOCOL_VERSION, 3);
		$ldapbind = ldap_bind($ldapcon,$bind_dn,$bind_pwd);
		if(!$ldapbind) { 
			
			ldap_close($ldapcon); 
			 
		}
		$ldapsr = ldap_search($ldapcon, $arr_basedn, $filter_attr."=". $keyword, array_values($arr_search_attr))  ;
		$entry = @ldap_get_entries($ldapcon, $ldapsr);
		if($entry["count"]!=0)
		{
			
			foreach (array_keys($arr_search_attr) as $attr)
			{
		
				$ldap_user_info [$attr] = $entry[0][$arr_search_attr[$attr]][0];
			}
				
			$data[0]["firstname"] = isset($ldap_user_info['firstname'])?$ldap_user_info['firstname']:'';
			$data[0]["lastname"] = isset($ldap_user_info['lastname'])?$ldap_user_info['lastname']:'';
			$data[0]["userid"]  = isset($ldap_user_info['userid'])?$ldap_user_info['userid']:'';
			$data[0]["dep_id"] = isset($ldap_user_info['dep_id'])?$ldap_user_info['dep_id']:'';
			$data[0]["publiccode"] = isset($ldap_user_info['publiccode'])?$ldap_user_info['publiccode']:'';
			$data[0]["dep_name"] = isset($ldap_user_info['dep_name'])?$ldap_user_info['dep_name']:'';
			ldap_close($ldapcon);
			return $data;
		}
		else
		{
			$ldapsr = ldap_search($ldapcon, $arr_basedn, $publiccode_attr."=".$keyword, array_values($arr_search_attr));
			$entry = @ldap_get_entries($ldapcon, $ldapsr);	
			if($entry["count"]==0)
				{
					Yii::app()->session['errmsg_ldap']='ไม่มีผลลัพธ์ในการค้นหา';
					ldap_close($ldapcon); 
					return  null;
				} 
				else 
				{	
					for ($i=0; $i < $entry["count"]; $i++)
					{
					foreach (array_keys($arr_search_attr) as $attr)
						{
						$ldap_user_info [$attr] = $entry[$i][$arr_search_attr[$attr]][0];
						}
						
							$data[$i]["firstname"] = isset($ldap_user_info['firstname'])?$ldap_user_info['firstname']:'';
							$data[$i]["lastname"] = isset($ldap_user_info['lastname'])?$ldap_user_info['lastname']:'';
							$data[$i]["userid"]  = isset($ldap_user_info['userid'])?$ldap_user_info['userid']:'';
							$data[$i]["dep_id"] = isset($ldap_user_info['dep_id'])?$ldap_user_info['dep_id']:'';
							$data[$i]["publiccode"] = isset($ldap_user_info['publiccode'])?$ldap_user_info['publiccode']:'';
							$data[$i]["dep_name"] = isset($ldap_user_info['dep_name'])?$ldap_user_info['dep_name']:'';
					}
					ldap_close($ldapcon);
					
					return new CSqlDataProvider($data, array(
			'totalItemCount'=>$count,
			'sort'=>array(
				'attributes'=>array(
					 'firstname', 'lastname', 'userid','dep_id','publiccode','dep_name',
				),
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['prg_ctrl']['pagination']['default']['pagesize'],
			),
		));	
				}
			
		}
	}
	public function getdep($code = null)
	{
	   	$sql="select id from mas_department where status=1 and code='".$code."'";	   
	   	$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;
	}
	public function getsearchhis($id=null) 

	{
		$sqlCon="";
		
			if($id!=''){							
				$sqlCon.= " and log_id = ".$id;	
								
			}
		
		
		$count=Yii::app()->db->createCommand("select count(*) from log_user a left join mas_department b on a.dep_id= b.id where a.status!=0 ".$sqlCon)->queryScalar();
		$sql ="select a.id,a.log_id,CONCAT(date_format(a.log_date,'%d/%m/'),date_format(a.log_date,'%Y')+543 )as daydate,a.log_type,a.log_createby,a.username,a.firstname,a.lastname,a.pid,case when a.status=1 then 'Active' when a.status=2 then 'Inactive' when a.status=3 then 'Time out'end as userstatus ,replace(b.name,'\\\','') as department_name,replace(c.name,'\\\','') as userlevel_name from log_user a left join mas_department b on a.dep_id=b.id left join mas_userlevel c on a.userlevel_id=c.id where a.status!=0 ".$sqlCon;
		
		return new CSqlDataProvider($sql, array(
			'totalItemCount'=>$count,
			'sort'=>array(
				'attributes'=>array(
					 'log_id', 'daydate','log_type','log_createby','username','firstname','lastname','pid','department_name','userlevel_name','userstatus',
				),
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['prg_ctrl']['pagination']['default']['pagesize'],
			),
		));	
	}
	
}	
