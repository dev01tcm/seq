<?php


class lookupdata extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'mas_user';
	}

	public function getUserlogin($id = null)
	{
	   $sql =" select a.id,CONCAT(ifnull(a.firstname,''),' ',ifnull(a.lastname,'') )as displayname ,a.username,a.userlevel_id ,replace(b.name,'\\\','') as dep_name ,a.remark, ";
	   $sql.=" a.dep_id,b.code ";
	   $sql.=" from mas_user a ";
	   $sql.=" left join mas_department b on a.dep_id=b.id ";
	   $sql.=" where a.id='".$id."' and a.status='1' ";
	   $rows =Yii::app()->db->createCommand($sql)->queryAll();
	   return $rows;
	}
	public function getBank()
	{
	   $sql =" select id ";
	   $sql.=" from mas_bank ";
	   $sql.=" where status='1' ";
	   $rows =Yii::app()->db->createCommand($sql)->queryAll();
	   return $rows;
	}
	
	public function getSample($id = null)
	{
	   $sql ="select code as code ,name as name
				from table where active=1
				order by code";
	   $rows =Yii::app()->db->createCommand($sql)->queryAll();
	   return $rows;
	}
	
	public function getUser()
	{
	   $sql ="select id,CONCAT(ifnull(firstname,''),' ',ifnull(lastname,'') )as displayname ,username,userlevel_id from mas_user order by id";
	   $rows =Yii::app()->db->createCommand($sql)->queryAll();
	   return $rows;
	}

			
	public function getDepartment()
	{
	   $sql ="select id,replace(name,'\\\','') as name ,code from mas_department where status='1' order by name ";
	   $rows =Yii::app()->db->createCommand($sql)->queryAll();
	   return $rows;
	}
	public function getPrefix()
	{
	   $sql ="SELECT name FROM mas_businesstype ";
	   $rows =Yii::app()->db->createCommand($sql)->queryAll();
	   return $rows;
	}
	/*
	public function getBusinesstype()
	{
	   $sql ="select id,name from mas_businesstype where type='2' or type='0' ";
	   $rows =Yii::app()->db->createCommand($sql)->queryAll();
	   return $rows;
	}
	public function getPrefix()
	{
	   $sql ="select id,name,type from mas_businesstype where type='1' or type='0' order by create_date ";
	   $rows =Yii::app()->db->createCommand($sql)->queryAll();
	   return $rows;
	}
	*/
	
	public function getType()
	{
	   $sql ="select id,replace(name,'\\\','') as name from mas_type where status='1' ";
	   $rows =Yii::app()->db->createCommand($sql)->queryAll();
	   return $rows;
	}
	public function getCode()
	{
	   //$sql ="select max(code)+1 as code from tran_exportreq where status='1' ";
	   
	   /*
	   $sql ="select 
				case when ifnull(max(code),'')!='' 
				then max(code)+1 
				else (case when right(((year(now())+543)),2)='60' then concat(right(((year(now())+543)),2),'022') else concat(right(((year(now())+543)),2),'001') end)  end as code
				from tran_exportreq  where status='1' ";
*/
	$sql ="select 
				case when right(((year(now())+543)),2)=left((max(code)),2)
				then max(code)+1
				else concat(right(((year(now())+543)),2),'001')  end as code
				from tran_exportreq  where status='1' ";		
	   $rows =Yii::app()->db->createCommand($sql)->queryAll();
	   return $rows;
	}
	public function getCodetsd()
	{
	   //$sql ="select max(code)+1 as code from tran_exportreq where status='1' ";
	   
	   /*
	   $sql ="select 
				case when ifnull(max(code),'')!='' 
				then max(code)+1 
				else (case when right(((year(now())+543)),2)='60' then concat(right(((year(now())+543)),2),'022') else concat(right(((year(now())+543)),2),'001') end)  end as code
				from tran_exportreq  where status='1' ";
*/
	$sql ="select 
				case when right(((year(now())+543)),2)=left((max(code)),2)
				then max(code)+1
				else concat(right(((year(now())+543)),2),'001')  end as code
				from tran_exportreq_tsd  where status='1' ";		
	   $rows =Yii::app()->db->createCommand($sql)->queryAll();
	   return $rows;
	}
	public function getCode2()
	{
	   $sql ="select max(code) as code from tran_exportreq where status='1' ";
	   $rows =Yii::app()->db->createCommand($sql)->queryAll();
	   return $rows;
	}
	
	//20170504
	public function getNews()
	{
	   $sql ="select id,replace(name,'\\\','') as name,status from mas_news ";
	   $rows =Yii::app()->db->createCommand($sql)->queryAll();
	   return $rows;
	}
	public function getSetcon()
	{
		$sql ="select con_st,con_en from mas_config ";
	   	$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;
	}
	
	//20170508
	public function getSetdata()
	{
		
		
		$conf_st=1;
		$conf_en=1;
		$sql1 ="select ifnull(con_st,'1') as con_st,ifnull(con_en,'1') as con_en from mas_config";
	   	$rows1 =Yii::app()->db->createCommand($sql1)->queryAll();
		foreach ($rows1 as $rows1_data)
		{
			$conf_st = $rows1_data['con_st'];
			$conf_en = $rows1_data['con_en'];
		}
	   	
		$sql ="select '".$conf_st."' as cntfig_st,'".$conf_en."' as cntfig_en, min(id) as cntmin,max(id) as cntmax, count(id) as cnt from ( ";
		$sql.=" select id from tran_request where status=1 order by id ";
		$sql.=" limit ".$conf_en;
		$sql.=" ) aa ";
		//echo var_dump($sql);
		//exit;
	   	$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;
	}
	public function getSetdata_tsd()
	{
		
		
		$conf_st=1;
		$conf_en=1;
		$sql1 ="select ifnull(con_st,'1') as con_st,ifnull(con_en,'1') as con_en from mas_config";
	   	$rows1 =Yii::app()->db->createCommand($sql1)->queryAll();
		foreach ($rows1 as $rows1_data)
		{
			$conf_st = $rows1_data['con_st'];
			$conf_en = $rows1_data['con_en'];
		}
	   	
		$sql ="select '".$conf_st."' as cntfig_st,'".$conf_en."' as cntfig_en, min(id) as cntmin,max(id) as cntmax, count(id) as cnt from ( ";
		$sql.=" select id from tran_request_tsd where status=1 order by id ";
		$sql.=" limit ".$conf_en;
		$sql.=" ) aa ";
		//echo var_dump($sql);
		//exit;
	   	$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;
	}
	public function getSelecttype($id=null)
	{
		$sql ="select id,name from mas_businesstype where type='".$id."' or type='0' and status!=0 order by id ";
	   	$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;
	}
	
	//20170516
	public function getDetail($id=null)
	{
		$sql ="select a.id,a.code,a.doc_no,a.acc_employer,a.business_name, ";
		$sql.="CONCAT(ifnull(date_format(a.doc_date,'%d/%m/'),''),ifnull(date_format(a.doc_date,'%Y')+543,'') )as doc_date, ";
		$sql.="CONCAT(a.name,' ', a.lname, ' ', ifnull(a.company_name,'') ) full_name, ";
		$sql.="CONCAT(ifnull(a.pid,''),' ',ifnull(a.cid,'') )as pid ";		
		$sql.="from tran_request a ";	
		$sql.="where 1=1 and a.id='".$id."' ";	
	   	$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;
	}
	
	public function getStatusrequest($id = null)	
	{
		$sql = "select status ";
		$sql.= "from tran_request where id=".$id;
	   	$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;
	}
	
}		