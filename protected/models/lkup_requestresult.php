<?php


class lkup_requestresult extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'sqt_user';
	}

    public function attributeLabels() {
        return array(
        );
    }
	public function search($keyword=null,$acc_emp=null,$iden=null) {
		
		
		//$createby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;
		$dep_id = Yii::app()->user->getInfo('dep_id');
		$sqlCon="";
		/*
			if(Yii::app()->user->getInfo('userlevel_id')!='1') {
				$sqlCon.= " and a.dep_id='".$dep_id."' ";
			}
			*/
			if($keyword!=''){							
				$sqlCon.= " and a.code like '%".$keyword."%' ";			
			}
			if($acc_emp!=''){							
				$sqlCon.= " and a.acc_employer like '%".$acc_emp."%' ";			
			}
			if($iden!=''){							
				$sqlCon.= " and (a.pid like '%".$iden."%' or a.cid like '%".$iden."%') ";			
			}
			
	

			if(Yii::app()->user->getInfo('userlevel_id')=='1')
			{
				
			}else{
				$sqlCon.= " and a.dep_id='$dep_id' ";
			}
			
		/*
		$count=Yii::app()->db->createCommand('select count(*) from tran_request a where a.status=4 '.$sqlCon)->queryScalar();
		
		$sql= "select a.id,a.code,replace(c.doc_no,'\\\','') as docno_exp,replace(a.doc_no,'\\\','') as doc_no, ";
		$sql.="CONCAT(ifnull(date_format(c.doc_date,'%d/%m/'),''),ifnull(date_format(c.doc_date,'%Y')+543,'') )as docdate_exp, ";
		$sql.="CONCAT(ifnull(date_format(a.doc_date,'%d/%m/'),''),ifnull(date_format(a.doc_date,'%Y')+543,'') )as doc_date, ";
		$sql.="replace(a.acc_employer,'\\\','') as acc_employer,replace(a.business_name,'\\\','') as business_name, "; 
		$sql.="replace(CONCAT(ifnull(a.company_name,''),ifnull(a.name,''),' ', ifnull(a.lname,'')),'\\\','') as full_name, ";
		$sql.="CONCAT(ifnull(a.pid,''),ifnull(a.cid,'')) pid, ";
		$sql.="CONCAT(ifnull(date_format(a.birth,'%d/%m/'),''),ifnull(date_format(a.birth,'%Y')+543,'') )as birth, ";
		$sql.="CONCAT(ifnull(date_format(a.create_date,'%d/%m/'),''),ifnull(date_format(a.create_date,'%Y')+543,'') )as create_date, ";
		$sql.="replace(a.address,'\\\','') as address,replace(e.firstname,'\\\','') as firstname,count(b.request_id) as cnt,";
		$sql.="d.code as depid_code,a.status as active ";
		$sql.="from tran_request a ";
		$sql.="left join tran_request_item b on a.id=b.request_id ";
		$sql.="left join tran_exportreq c on a.code=c.code ";
		$sql.="left join mas_department d on a.dep_id=d.id ";
		$sql.="left join mas_user e on a.create_by=e.id ";
		$sql.="where a.status=4 ".$sqlCon;
		$sql.=" group by a.id ";
		return new CSqlDataProvider($sql, array(
			'totalItemCount'=>$count,
			'sort'=>array(
				'attributes'=>array(
					 'id', 
					 'code',
					 'docno_exp',
					 'docdate_exp',
					 'doc_no',
					 'doc_date',
					 'acc_employer', 
					 'business_name',
					 'full_name', 
					 'pid', 
					 'birth',
					 'address',
					 'create_date',
					 'firstname',
					 'depid_code', 
					 'active', 
					 'cnt', 
				),
			),*/
		$count=Yii::app()->db->createCommand("select count(*) from(
SELECT a.id,a.code, a.doc_no,
		CONCAT(date_format(a.doc_date,'%d/%m/'),date_format(a.doc_date,'%Y')+543 )as doc_date,a.acc_employer, 
		a.business_name,CONCAT(ifnull(a.company_name,''),ifnull(a.name,''),' ', ifnull(a.lname,'')) as full_name,CONCAT(ifnull(a.pid,''),ifnull(a.cid,'')) pid, 
		CONCAT(date_format(a.birth,'%d/%m/'),date_format(a.birth,'%Y')+543 )as birth, a.address, 
		CONCAT(date_format(a.create_date,'%d/%m/'),date_format(a.create_date,'%Y')+543)as create_date,e.firstname,d.code as depid_code 		
		from tran_request a 
		left join mas_department d on a.dep_id=d.id  
		left join mas_user e on a.create_by=e.id 	
		where a.status=4 ".$sqlCon."
ORDER BY a.id) t1
LEFT OUTER JOIN (
select id,request_id,doc_no as docno_exp,CONCAT(date_format(doc_date,'%d/%m/'),date_format(doc_date,'%Y')+543 )as docdate_exp from tran_request_item 

GROUP BY request_id ) t2 ON t2.request_id=t1.id" )->queryScalar();	
			
		$sql =" select t1.id,t1.code,t2.request_id,t2.docno_exp,t2.docdate_exp,t1.doc_no,t1.doc_date,t1.acc_employer,t1.business_name,t1.full_name, ";
		$sql.=" t1.pid,t1.birth,t1.address,t1.create_date,t1.firstname,t1.depid_code,t2.cnt ";
		$sql.=" from( ";
		$sql.="		SELECT a.id,a.code, a.doc_no,CONCAT(date_format(a.doc_date,'%d/%m/'),date_format(a.doc_date,'%Y')+543 )as doc_date,";
		$sql.=" 	a.acc_employer, a.business_name,CONCAT(ifnull(a.company_name,''),ifnull(a.name,''),' ', ifnull(a.lname,'')) as full_name, ";
		$sql.=" 	CONCAT(ifnull(a.pid,''),ifnull(a.cid,'')) pid, ";
		$sql.="		CONCAT(date_format(a.birth,'%d/%m/'),date_format(a.birth,'%Y')+543 )as birth, a.address, ";
		$sql.="		CONCAT(date_format(a.create_date,'%d/%m/'),date_format(a.create_date,'%Y')+543)as create_date,e.firstname,d.code as depid_code 	";	
		$sql.="		from tran_request a ";
		$sql.="		left join mas_department d on a.dep_id=d.id   ";
		$sql.="		left join mas_user e on a.create_by=e.id 	 ";
		$sql.="		where a.status=4  ".$sqlCon;
		$sql.="		ORDER BY a.id) t1 ";
		$sql.=" LEFT OUTER JOIN ( ";
		$sql.="		select id,request_id,doc_no as docno_exp,CONCAT(date_format(doc_date,'%d/%m/'),date_format(doc_date,'%Y')+543 )as docdate_exp,count(request_id) as cnt ";
		$sql.="		from tran_request_item ";
		$sql.=" GROUP BY request_id ) t2 ON t2.request_id=t1.id ";
		$sql.=" ORDER BY t1.id ";
		/*
		$count=Yii::app()->db->createCommand('select count(*) from tran_request a left join mas_department d on a.dep_id=d.id left join mas_user e on a.create_by=e.id where a.status=4 '.$sqlCon)->queryScalar();
		$sql ="SELECT a.id,a.code,a.doc_no,CONCAT(date_format(a.doc_date,'%d/%m/'),date_format(a.doc_date,'%Y')+543 )as doc_date,a.acc_employer, ";
		$sql.="a.business_name,CONCAT(ifnull(a.company_name,''),ifnull(a.name,''),' ', ifnull(a.lname,'')) as full_name,CONCAT(ifnull(a.pid,''),ifnull(a.cid,'')) pid, ";
		$sql.="CONCAT(date_format(a.birth,'%d/%m/'),date_format(a.birth,'%Y')+543 )as birth, a.address, ";
		$sql.="CONCAT(date_format(a.create_date,'%d/%m/'),date_format(a.create_date,'%Y')+543)as create_date,e.firstname,d.code as depid_code ";
		
		$sql.="from tran_request a ";
		$sql.="left join mas_department d on a.dep_id=d.id  ";
		$sql.="left join mas_user e on a.create_by=e.id ";
		$sql.="where a.status=4  ".$sqlCon;
*/

		return new CSqlDataProvider($sql, array(
			'totalItemCount'=>$count,
			'sort'=>array(
				'attributes'=>array(
					 'no',
					 'id', 
					 'code',
					 'docno_exp',
					 'docdate_exp',
					 'doc_no',
					 'doc_date',
					 'acc_employer', 
					 'business_name',
					 'full_name', 
					 'pid', 
					 'birth',
					 'address',
					 'create_date',
					 'firstname',
					 'depid_code', 
					 'active', 
					 'cnt',  
				),
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['prg_ctrl']['pagination']['default']['pagesize'],
			),
		));	
    }

	public function searchrequest($keyword=null) {
		
		$sqlCon="";
		
			if($keyword!=''){							
				$sqlCon.= " and (a.name like '%".$keyword."%' ";	
				$sqlCon.= " or a.id like '%".$keyword."%') ";				
			}
			
		$count=Yii::app()->db->createCommand('select count(*) from tran_request ')->queryScalar();
		$sql ="select a.id,a.doc_no,date_format(a.doc_date,'%d/%m/%Y') as doc_date,a.acc_employer, ";	
		$sql.="CONCAT(ifnull(a.business_type,''),' ',ifnull(a.prefix,'') )as business_type  , ";
		$sql.="CONCAT(ifnull(a.pid,''),' ',ifnull(a.cid,'') )as pid  , ";
		$sql.="CONCAT(a.name,' ', a.lname, ' ', ifnull(a.company_name,'') ) full_name ";	
		
		$sql.="from tran_request_item a ";
		//$sql.="left join ";
		//$sql.="from tran_request_item a ";
		
		return new CSqlDataProvider($sql, array(
			'totalItemCount'=>$count,
			'sort'=>array(
				'attributes'=>array(
					 'id', 'doc_no', 'doc_date', 'acc_employer', 'full_name', 'pid', 'business_type',//'bank','bank_dep'
				),
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['prg_ctrl']['pagination']['default']['pagesize'],
			),
		));
    }	
	public function getDetail($id=null,$code=null) 

	{
		
		
		$sqlCon="";
		$sqlCon2="";
		
			if($id!=''){							
				$sqlCon.= " and c.id='".$id."' ";				
			}
			if($code!=''){							
				$sqlCon2.= " and a.code='".$code."' ";				
			}
			//and a.code = "60022"
		
		$count=Yii::app()->db->createCommand("select count(*) from tran_request_item a left join tran_request c on a.request_id=c.id left join mas_bank b on b.code=a.bank_id where 1=1 ".$sqlCon)->queryScalar();
		
		
		$sql ="select @rownum := @rownum + 1 AS no,aa.id,aa.bank_id,aa.code,bb.name,aa.bank_dep_id,aa.bank_id,aa.bank_dep_name,aa.bank_name,aa.acc_type,  ";
		$sql.="aa.mark ,aa.amont,aa.check_status,aa.acc_no,aa.acc_name,aa.remark,aa.request_date,bb.upload_url from( ";
		$sql.="		select c.id,c.code,a.bank_id,a.bank_dep_id, ";
		$sql.="		replace(a.bank_dep_name,'\\\','') as bank_dep_name,  ";
		$sql.="		replace(b.name,'\\\','') as bank_name,  ";
		$sql.="		a.acc_type_id as acc_type,  ";
		$sql.="		a.mark ,a.amont,a.check_status, ";
		$sql.="		replace(a.acc_no,'\\\','') as acc_no,  ";
		$sql.="		replace(a.acc_name,'\\\','') as acc_name,  ";
		$sql.="		replace(a.remark,'\\\','') as remark,  ";
		$sql.="		CONCAT(ifnull(date_format(request_date,'%d/%m/'),''),ifnull(date_format(request_date,'%Y')+543,''),ifnull(date_format(request_date,' %T'),'') )as request_date  ";
		$sql.="		from tran_request_item a 	 ";
		$sql.="		left join tran_request c on a.request_id=c.id 	 ";
		$sql.="		left join mas_bank b on b.code=a.bank_id  ";
		$sql.="		where 1=1 ".$sqlCon;

		$sql.="		)aa  ";
		$sql.="		left outer join ( ";
		$sql.="		select a.bank_id,a.code,b.name,b.upload_url ";
		$sql.="		from tran_importresult a 	 ";
		$sql.="		left join tran_file b on a.id=b.object_id  ";
		$sql.="		where b.object_type='book' and b.status=1 ".$sqlCon2;
		$sql.="		ORDER BY a.bank_id ";
		$sql.="		) bb on aa.bank_id=bb.bank_id ";
		$sql.=",(SELECT @rownum := 0) r ";

		
		
		/*
		$sql ="select @rownum := @rownum + 1 AS no,c.id,c.code,a.bank_id,a.bank_dep_id,a.bank_id, ";
		$sql.="replace(a.bank_dep_name,'\\\','') as bank_dep_name, ";
		$sql.="replace(b.name,'\\\','') as bank_name, ";
		
		
		$sql.="a.acc_type_id as acc_type, ";
		
		//$sql.="case a.acc_type_id when '1' then 'ออมทรัพย์' when '2' then 'ประจำ' when '3' then 'กระแสรายวัน' ";
		//$sql.="when '4' then 'อื่น ๆ' end as acc_type, ";
		
		
		$sql.="a.mark ,a.amont,a.check_status,";

		//$sql.="CONCAT(a.mark,' ',a.amont) as amont,case a.check_status when '1' then 'พบ' when '2' then 'ไม่พบ' end as check_status,";
		$sql.="replace(a.acc_no,'\\\','') as acc_no, ";
		$sql.="replace(a.acc_name,'\\\','') as acc_name, ";
		$sql.="replace(a.remark,'\\\','') as remark, ";
		$sql.="CONCAT(ifnull(date_format(request_date,'%d/%m/'),''),ifnull(date_format(request_date,'%Y')+543,''),ifnull(date_format(request_date,' %T'),'') )as request_date ";
		$sql.="from tran_request_item a ";	
		$sql.="left join tran_request c on a.request_id=c.id ";	
		$sql.="left join mas_bank b on b.code=a.bank_id ";
		$sql.=",(SELECT @rownum := 0) r ";
		$sql.="where 1=1 ".$sqlCon;
		*/
		//echo var_dump($sql);exit;
		return new CSqlDataProvider($sql, array(
			'totalItemCount'=>$count,
			'sort'=>array(
				'attributes'=>array(
					 'no', 'id', 'bank_name', 'code', 'bank_id', 'bank_dep_id', 'bank_dep_name', 'acc_type', 'acc_no',
					 'acc_name','mark','amont','request_date','remark','check_status',
				),
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['prg_ctrl']['pagination']['default']['pagesize'],
			),
		));
	
	}
	
	public function getDetail2($id=null) 

	{
		
		
		$sqlCon="";
		
		
			if($id!=''){							
				$sqlCon.= " and c.id='".$id."' ";				
			}
		
		
		$count=Yii::app()->db->createCommand("select count(*) from tran_request_item a left join tran_request c on a.request_id=c.id left join mas_bank b on b.code=a.bank_id where 1=2 ".$sqlCon)->queryScalar();
		
		
		
		$sql ="select @rownum := @rownum + 1 AS no,c.id,c.code,a.bank_id,a.bank_dep_id,a.bank_id, ";
		$sql.="replace(a.bank_dep_name,'\\\','') as bank_dep_name, ";
		$sql.="replace(b.name,'\\\','') as bank_name, ";
		
		
		$sql.="a.acc_type_id as acc_type, ";
		
		//$sql.="case a.acc_type_id when '1' then 'ออมทรัพย์' when '2' then 'ประจำ' when '3' then 'กระแสรายวัน' ";
		//$sql.="when '4' then 'อื่น ๆ' end as acc_type, ";
		
		
		$sql.="a.mark ,a.amont,a.check_status,";

		//$sql.="CONCAT(a.mark,' ',a.amont) as amont,case a.check_status when '1' then 'พบ' when '2' then 'ไม่พบ' end as check_status,";
		$sql.="replace(a.acc_no,'\\\','') as acc_no, ";
		$sql.="replace(a.acc_name,'\\\','') as acc_name, ";
		$sql.="replace(a.remark,'\\\','') as remark, ";
		$sql.="CONCAT(ifnull(date_format(request_date,'%d/%m/'),''),ifnull(date_format(request_date,'%Y')+543,''),ifnull(date_format(request_date,' %T'),'') )as request_date ";
		$sql.="from tran_request_item a ";	
		$sql.="left join tran_request c on a.request_id=c.id ";	
		$sql.="left join mas_bank b on b.code=a.bank_id ";
		$sql.=",(SELECT @rownum := 0) r ";
		$sql.="where 1=2 ".$sqlCon;
		
		//echo var_dump($sql);exit;
		return new CSqlDataProvider($sql, array(
			'totalItemCount'=>$count,
			'sort'=>array(
				'attributes'=>array(
					 'no', 'id', 'bank_name', 'code', 'bank_id', 'bank_dep_id', 'bank_dep_name', 'acc_type', 'acc_no',
					 'acc_name','mark','amont','request_date','remark','check_status',
				),
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['prg_ctrl']['pagination']['default']['pagesize'],
			),
		));
	
	}
	public function getDetail3() 

	{
		
		
		
		
		$count=Yii::app()->db->createCommand("select count(*) from tran_request_item a left join tran_request c on a.request_id=c.id left join mas_bank b on b.code=a.bank_id where 1=2 ")->queryScalar();
		
		
		
		$sql ="select @rownum := @rownum + 1 AS no,c.id,c.code,a.bank_id,a.bank_dep_id,a.bank_id, ";
		$sql.="replace(a.bank_dep_name,'\\\','') as bank_dep_name, ";
		$sql.="replace(b.name,'\\\','') as bank_name, ";		
		$sql.="a.acc_type_id as acc_type, ";
		$sql.="a.mark ,a.amont,a.check_status,";
		$sql.="replace(a.acc_no,'\\\','') as acc_no, ";
		$sql.="replace(a.acc_name,'\\\','') as acc_name, ";
		$sql.="replace(a.remark,'\\\','') as remark, ";
		$sql.="CONCAT(ifnull(date_format(request_date,'%d/%m/'),''),ifnull(date_format(request_date,'%Y')+543,''),ifnull(date_format(request_date,' %T'),'') )as request_date ";
		$sql.="from tran_request_item a ";	
		$sql.="left join tran_request c on a.request_id=c.id ";	
		$sql.="left join mas_bank b on b.code=a.bank_id ";
		$sql.=",(SELECT @rownum := 0) r ";
		$sql.="where 1=2 ";
		return new CSqlDataProvider($sql, array(
			'totalItemCount'=>$count,
			'sort'=>array(
				'attributes'=>array(
					 'no', 'id', 'bank_name', 'code', 'bank_id', 'bank_dep_id', 'bank_dep_name', 'acc_type', 'acc_no',
					 'acc_name','mark','amont','request_date','remark','check_status',
				),
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['prg_ctrl']['pagination']['default']['pagesize'],
			),
		));
	
	}
	public function getDetailpdf($id=null) 
	{
		$sql ="select c.id,c.code,a.bank_id,a.bank_dep_id,a.bank_id, ";
		$sql.="replace(a.bank_dep_name,'\\\','') as bank_dep_name, ";
		$sql.="replace(b.name,'\\\','') as bank_name, ";
		$sql.="a.acc_type_id as acc_type, ";
		$sql.="a.mark ,a.amont,a.check_status,";
		$sql.="replace(a.acc_no,'\\\','') as acc_no, ";
		$sql.="replace(a.acc_name,'\\\','') as acc_name, ";
		$sql.="replace(a.remark,'\\\','') as remark, ";
		$sql.="CONCAT(ifnull(date_format(request_date,'%d/%m/'),''),ifnull(date_format(request_date,'%Y')+543,''),ifnull(date_format(request_date,' %T'),'') )as request_date ";
		$sql.="from tran_request_item a ";	
		$sql.="left join tran_request c on a.request_id=c.id ";	
		$sql.="left join mas_bank b on b.code=a.bank_id ";
		$sql.="where c.id='".$id."'";
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;
	
	}
	public function getRequest($id = null)
	{
	   $sql = "select id,code,doc_no,acc_employer,business_type,";
	   $sql.="CONCAT(ifnull(date_format(doc_date,'%d/%m/'),''),ifnull(date_format(doc_date,'%Y')+543,'') )as doc_date, ";
	   $sql.="CONCAT(ifnull(date_format(birth,'%d/%m/'),''),ifnull(date_format(birth,'%Y')+543,'') )as birth, ";
	   $sql.= "pid_type,prefix,company_name,pid,cid, ";	   
	   $sql.= "case status when '1' then 'รายการใหม่' when '2' then 'รอผล' when '3' then 'ข้อมูลไม่สมบูรณ์' when '4' then ";
	   $sql.= "'ตรวจสอบแล้ว' end as status,  ";
	   $sql.= "address,name,lname,status as active,remark,business_name ";
	   $sql.= "from tran_request where status!=0 and id='".$id."' ";	   
	   $rows =Yii::app()->db->createCommand($sql)->queryAll();
	   return $rows;
	}
}	
