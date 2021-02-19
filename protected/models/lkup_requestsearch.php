<?php


class lkup_requestsearch extends CActiveRecord
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
	public function search($keyword=null,$acc_emp=null,$iden=null,$status1=null,$status2=null,$status3=null,$status4=null,$type=null,$name=null,$dep=null,$systype=null) {
	
		//echo var_dump($type);exit;
		//$createby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;

		$dep_id = Yii::app()->user->getInfo('dep_id');
		$sqlCon="";
		if($keyword!=''){							
			$sqlCon.= " and a.code like '%".$keyword."%' ";			
		}
		if($acc_emp!=''){							
			$sqlCon.= " and a.acc_employer like '%".$acc_emp."%' ";			
		}
		if($iden!=''){							
			$sqlCon.= " and (a.pid like '%".$iden."%' or a.cid like '%".$iden."%') ";			
		}
		
		if($status1!='' || $status2!='' || $status3!='' || $status4!=''){							
			$sqlCon.= " and (a.status = '".$status1."' or a.status = '".$status2."' or a.status = '".$status3."' or a.status = '".$status4."') ";			
		}
		
		if($type!=''){							
			$sqlCon.= " and a.pid_type = '".$type."' ";			
		}
		if($name!=''){							
			$sqlCon.= " and CONCAT(ifnull(a.company_name,''),ifnull(a.name,''),' ', ifnull(a.lname,''))  like '%".$name."%' ";			
		}
		if($dep!=''){							
			$sqlCon.= " and d.id = '".$dep."' ";			
		}
		
		

		if(Yii::app()->user->getInfo('userlevel_id')=='1')
		{
			
		}else{
			$sqlCon.= " and a.dep_id='$dep_id' ";
		}
			
		if($systype==1)
		{
				$count=Yii::app()->db->createCommand("select count(*) from(
				SELECT a.id,a.code, a.doc_no,a.system_type,
				CONCAT(date_format(a.doc_date,'%d/%m/'),date_format(a.doc_date,'%Y')+543 )as doc_date,a.acc_employer, a.pid_type, 
				a.business_name,CONCAT(ifnull(a.company_name,''),ifnull(a.name,''),' ', ifnull(a.lname,'')) as full_name,CONCAT(ifnull(a.pid,''),ifnull(a.cid,'')) pid, 
				CONCAT(date_format(a.birth,'%d/%m/'),date_format(a.birth,'%Y')+543 )as birth, a.address, 
				CONCAT(date_format(a.create_date,'%d/%m/'),date_format(a.create_date,'%Y')+543)as create_date,e.firstname,d.code as depid_code 		
				from tran_request a 
				left join mas_department d on a.dep_id=d.id  
				left join mas_user e on a.create_by=e.id 	
				where a.status!=0 ".$sqlCon."
				ORDER BY a.id) t1
				LEFT OUTER JOIN (
				select id,request_id,doc_no as docno_exp,CONCAT(date_format(doc_date,'%d/%m/'),date_format(doc_date,'%Y')+543 )as docdate_exp from tran_request_item 

				GROUP BY request_id ) t2 ON t2.request_id=t1.id ")->queryScalar();
				
				$sql =" select t1.id,t1.code,t1.system_type,t2.request_id,t2.docno_exp,t2.docdate_exp,t1.doc_no,t1.doc_date,t1.acc_employer,t1.business_name,t1.pid_type,t1.full_name, ";
				$sql.=" t1.pid,t1.birth,t1.address,t1.create_date,t1.firstname,t1.depid_code,t2.cnt ";
				$sql.=" from( ";
				$sql.="		SELECT a.id,a.code,a.system_type, a.doc_no,CONCAT(date_format(a.doc_date,'%d/%m/'),date_format(a.doc_date,'%Y')+543 )as doc_date,";
				$sql.=" 	a.acc_employer, a.pid_type,a.business_name,CONCAT(ifnull(a.company_name,''),ifnull(a.name,''),' ', ifnull(a.lname,'')) as full_name, ";
				$sql.=" 	CONCAT(ifnull(a.pid,''),ifnull(a.cid,'')) pid, ";
				$sql.="		CONCAT(date_format(a.birth,'%d/%m/'),date_format(a.birth,'%Y')+543 )as birth, a.address, ";
				$sql.="		CONCAT(date_format(a.create_date,'%d/%m/'),date_format(a.create_date,'%Y')+543)as create_date,e.firstname,d.code as depid_code 	";	
				$sql.="		from tran_request a ";
				$sql.="		left join mas_department d on a.dep_id=d.id   ";
				$sql.="		left join mas_user e on a.create_by=e.id 	 ";
				$sql.="		where a.status!=0  ".$sqlCon;
				$sql.="		ORDER BY a.id) t1 ";
				$sql.=" LEFT OUTER JOIN ( ";
				$sql.="		select id,request_id,doc_no as docno_exp,CONCAT(date_format(doc_date,'%d/%m/'),date_format(doc_date,'%Y')+543 )as docdate_exp,count(request_id) as cnt ";
				$sql.="		from tran_request_item ";
				$sql.=" GROUP BY request_id ) t2 ON t2.request_id=t1.id ";
				$sql.=" ORDER BY t1.id";
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
							 'system_type',
						),
					),
					'pagination'=>array(
						'pageSize'=>Yii::app()->params['prg_ctrl']['pagination']['default']['pagesize'],
					),
				));	
		}
		else if ($systype==2) 
		{
				$count=Yii::app()->db->createCommand("select count(*) from(
				SELECT a.id,a.code, a.doc_no,a.system_type,
				CONCAT(date_format(a.doc_date,'%d/%m/'),date_format(a.doc_date,'%Y')+543 )as doc_date,a.acc_employer, a.pid_type, 
				a.business_name,CONCAT(ifnull(a.company_name,''),ifnull(a.name,''),' ', ifnull(a.lname,'')) as full_name,CONCAT(ifnull(a.pid,''),ifnull(a.cid,'')) pid, 
				CONCAT(date_format(a.birth,'%d/%m/'),date_format(a.birth,'%Y')+543 )as birth, a.address, 
				CONCAT(date_format(a.create_date,'%d/%m/'),date_format(a.create_date,'%Y')+543)as create_date,e.firstname,d.code as depid_code 		
				from tran_request_tsd a 
				left join mas_department d on a.dep_id=d.id  
				left join mas_user e on a.create_by=e.id 	
				where a.status!=0 ".$sqlCon."
				ORDER BY a.id) t1
				LEFT OUTER JOIN (
				select id,request_id,doc_no as docno_exp,CONCAT(date_format(doc_date,'%d/%m/'),date_format(doc_date,'%Y')+543 )as docdate_exp from tran_request_item_tsd

				GROUP BY request_id ) t2 ON t2.request_id=t1.id ")->queryScalar();
				
				$sql =" select t1.id,t1.code,t1.system_type,t2.request_id,t2.docno_exp,t2.docdate_exp,t1.doc_no,t1.doc_date,t1.acc_employer,t1.business_name,t1.pid_type,t1.full_name, ";
				$sql.=" t1.pid,t1.birth,t1.address,t1.create_date,t1.firstname,t1.depid_code,(SELECT COUNT(1) FROM tran_securities_registration WHERE request_id = t1.code AND reference_id = t1.pid) + 
						(SELECT COUNT(1) FROM tran_securities_book_closing WHERE request_id = t1.code AND reference_id = t1.pid) AS cnt ";
				$sql.=" from( ";
				$sql.="		SELECT a.id,a.code,a.system_type, a.doc_no,CONCAT(date_format(a.doc_date,'%d/%m/'),date_format(a.doc_date,'%Y')+543 )as doc_date,";
				$sql.=" 	a.acc_employer, a.pid_type,a.business_name,CONCAT(ifnull(a.company_name,''),ifnull(a.name,''),' ', ifnull(a.lname,'')) as full_name, ";
				$sql.=" 	CONCAT(ifnull(a.pid,''),ifnull(a.cid,'')) pid, ";
				$sql.="		CONCAT(date_format(a.birth,'%d/%m/'),date_format(a.birth,'%Y')+543 )as birth, a.address, ";
				$sql.="		CONCAT(date_format(a.create_date,'%d/%m/'),date_format(a.create_date,'%Y')+543)as create_date,e.firstname,d.code as depid_code 	";	
				$sql.="		from tran_request_tsd a ";
				$sql.="		left join mas_department d on a.dep_id=d.id   ";
				$sql.="		left join mas_user e on a.create_by=e.id 	 ";
				$sql.="		where a.status!=0  ".$sqlCon;
				$sql.="		ORDER BY a.id) t1 ";
				$sql.=" LEFT OUTER JOIN ( ";
				$sql.="		select id,request_id,doc_no as docno_exp,CONCAT(date_format(doc_date,'%d/%m/'),date_format(doc_date,'%Y')+543 )as docdate_exp,count(request_id) as cnt ";
				$sql.="		from tran_request_item_tsd ";
				$sql.=" GROUP BY request_id ) t2 ON t2.request_id=t1.id ";
				$sql.=" ORDER BY t1.id";
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
							 'system_type',
						),
					),
					'pagination'=>array(
						'pageSize'=>Yii::app()->params['prg_ctrl']['pagination']['default']['pagesize'],
					),
				));	
		}
		else
		{
				$count=Yii::app()->db->createCommand("select count(*) from(
				SELECT a.id,a.code, a.doc_no,a.system_type,
				CONCAT(date_format(a.doc_date,'%d/%m/'),date_format(a.doc_date,'%Y')+543 )as doc_date,a.acc_employer, a.pid_type, 
				a.business_name,CONCAT(ifnull(a.company_name,''),ifnull(a.name,''),' ', ifnull(a.lname,'')) as full_name,CONCAT(ifnull(a.pid,''),ifnull(a.cid,'')) pid, 
				CONCAT(date_format(a.birth,'%d/%m/'),date_format(a.birth,'%Y')+543 )as birth, a.address, 
				CONCAT(date_format(a.create_date,'%d/%m/'),date_format(a.create_date,'%Y')+543)as create_date,e.firstname,d.code as depid_code 		
				from tran_request a 
				left join mas_department d on a.dep_id=d.id  
				left join mas_user e on a.create_by=e.id 	
				where a.status!=0 ".$sqlCon."
				ORDER BY a.id) t1
				LEFT OUTER JOIN (
				select id,request_id,doc_no as docno_exp,CONCAT(date_format(doc_date,'%d/%m/'),date_format(doc_date,'%Y')+543 )as docdate_exp from tran_request_item 

				GROUP BY request_id ) t2 ON t2.request_id=t1.id union select count(*) from(
				SELECT a.id,a.code, a.doc_no,a.system_type,
				CONCAT(date_format(a.doc_date,'%d/%m/'),date_format(a.doc_date,'%Y')+543 )as doc_date,a.acc_employer, a.pid_type, 
				a.business_name,CONCAT(ifnull(a.company_name,''),ifnull(a.name,''),' ', ifnull(a.lname,'')) as full_name,CONCAT(ifnull(a.pid,''),ifnull(a.cid,'')) pid, 
				CONCAT(date_format(a.birth,'%d/%m/'),date_format(a.birth,'%Y')+543 )as birth, a.address, 
				CONCAT(date_format(a.create_date,'%d/%m/'),date_format(a.create_date,'%Y')+543)as create_date,e.firstname,d.code as depid_code 		
				from tran_request_tsd a 
				left join mas_department d on a.dep_id=d.id  
				left join mas_user e on a.create_by=e.id 	
				where a.status!=0 ".$sqlCon."
				ORDER BY a.id) t1
				LEFT OUTER JOIN (
				select id,request_id,doc_no as docno_exp,CONCAT(date_format(doc_date,'%d/%m/'),date_format(doc_date,'%Y')+543 )as docdate_exp from tran_request_item_tsd 

				GROUP BY request_id ) t2 ON t2.request_id=t1.id" )->queryScalar();	
					
				$sql =" select t1.id,t1.code,t1.system_type,t2.request_id,t2.docno_exp,t2.docdate_exp,t1.doc_no,t1.doc_date,t1.acc_employer,t1.business_name,t1.pid_type,t1.full_name, ";
				$sql.=" t1.pid,t1.birth,t1.address,t1.create_date,t1.firstname,t1.depid_code,(SELECT COUNT(1) FROM tran_securities_registration WHERE request_id = t1.code AND reference_id = t1.pid) + 
						(SELECT COUNT(1) FROM tran_securities_book_closing WHERE request_id = t1.code AND reference_id = t1.pid) AS cnt ";
				$sql.=" from( ";
				$sql.="		SELECT a.id,a.code,a.system_type, a.doc_no,CONCAT(date_format(a.doc_date,'%d/%m/'),date_format(a.doc_date,'%Y')+543 )as doc_date,";
				$sql.=" 	a.acc_employer, a.pid_type,a.business_name,CONCAT(ifnull(a.company_name,''),ifnull(a.name,''),' ', ifnull(a.lname,'')) as full_name, ";
				$sql.=" 	CONCAT(ifnull(a.pid,''),ifnull(a.cid,'')) pid, ";
				$sql.="		CONCAT(date_format(a.birth,'%d/%m/'),date_format(a.birth,'%Y')+543 )as birth, a.address, ";
				$sql.="		CONCAT(date_format(a.create_date,'%d/%m/'),date_format(a.create_date,'%Y')+543)as create_date,e.firstname,d.code as depid_code 	";	
				$sql.="		from tran_request_tsd a ";
				$sql.="		left join mas_department d on a.dep_id=d.id   ";
				$sql.="		left join mas_user e on a.create_by=e.id 	 ";
				$sql.="		where a.status!=0  ".$sqlCon;
				$sql.="		ORDER BY a.id) t1 ";
				$sql.=" LEFT OUTER JOIN ( ";
				$sql.="		select id,request_id,doc_no as docno_exp,CONCAT(date_format(doc_date,'%d/%m/'),date_format(doc_date,'%Y')+543 )as docdate_exp,count(request_id) as cnt ";
				$sql.="		from tran_request_item_tsd ";
				$sql.=" GROUP BY request_id ) t2 ON t2.request_id=t1.id ";
				$sql.=" ";
				$sql.=" union all";
				$sql.=" select t1.id,t1.code,t1.system_type,t2.request_id,t2.docno_exp,t2.docdate_exp,t1.doc_no,t1.doc_date,t1.acc_employer,t1.business_name,t1.pid_type,t1.full_name, ";
				$sql.=" t1.pid,t1.birth,t1.address,t1.create_date,t1.firstname,t1.depid_code,t2.cnt ";
				$sql.=" from( ";
				$sql.="		SELECT a.id,a.code,a.system_type, a.doc_no,CONCAT(date_format(a.doc_date,'%d/%m/'),date_format(a.doc_date,'%Y')+543 )as doc_date,";
				$sql.=" 	a.acc_employer, a.pid_type,a.business_name,CONCAT(ifnull(a.company_name,''),ifnull(a.name,''),' ', ifnull(a.lname,'')) as full_name, ";
				$sql.=" 	CONCAT(ifnull(a.pid,''),ifnull(a.cid,'')) pid, ";
				$sql.="		CONCAT(date_format(a.birth,'%d/%m/'),date_format(a.birth,'%Y')+543 )as birth, a.address, ";
				$sql.="		CONCAT(date_format(a.create_date,'%d/%m/'),date_format(a.create_date,'%Y')+543)as create_date,e.firstname,d.code as depid_code 	";	
				$sql.="		from tran_request a ";
				$sql.="		left join mas_department d on a.dep_id=d.id   ";
				$sql.="		left join mas_user e on a.create_by=e.id 	 ";
				$sql.="		where a.status!=0  ".$sqlCon;
				$sql.="		ORDER BY a.id) t1 ";
				$sql.=" LEFT OUTER JOIN ( ";
				$sql.="		select id,request_id,doc_no as docno_exp,CONCAT(date_format(doc_date,'%d/%m/'),date_format(doc_date,'%Y')+543 )as docdate_exp,count(request_id) as cnt ";
				$sql.="		from tran_request_item ";
				$sql.=" GROUP BY request_id ) t2 ON t2.request_id=t1.id ";
				$sql.=" ORDER BY 1 ";

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
							 'system_type',
						),
					),
					'pagination'=>array(
						'pageSize'=>Yii::app()->params['prg_ctrl']['pagination']['default']['pagesize'],
					),
				));	
		}
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
	public function getDetail($id=null) 

	{
		
		
		$sqlCon="";
		
			if($id!=''){							
				$sqlCon.= " and c.id='".$id."' ";				
			}
		
		
		$count=Yii::app()->db->createCommand("select count(*) from tran_request_item a left join tran_request c on a.request_id=c.id left join mas_bank b on b.code=a.bank_id where 1=1 ".$sqlCon)->queryScalar();
		
		$sql ="select c.id,c.code,a.bank_id,a.bank_dep_id,a.bank_id, ";
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
		$sql.="where 1=1 ".$sqlCon;
		//echo var_dump($sql);exit;
		return new CSqlDataProvider($sql, array(
			'totalItemCount'=>$count,
			'sort'=>array(
				'attributes'=>array(
					 'id', 'bank_name', 'code', 'bank_id', 'bank_dep_id', 'bank_dep_name', 'acc_type', 'acc_no',
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
	public function getsreachdetail_tsd_book($code=null,$pid=null)
	{
		
			$sql ="SELECT r.code as request_id,''as certificate_no,r.remark, r.acc_employer, r.business_name,CONCAT(ifnull(r.company_name,''),ifnull(r.name,''),' ', ifnull(r.lname,'')) as full_name, r.cid, d.code, d.name, s.securities_namethai, s.account_id, s.securities_shares, s.effective_date
					FROM tran_request r 
					INNER JOIN tran_securities_book_closing s ON s.request_code = r.code AND s.reference_id = r.cid
					INNER JOIN mas_user u ON r.create_by = u.id
					INNER JOIN mas_department d ON u.dep_id = d.id 
					WHERE r.code = '".$code."' and reference_id='".$pid."'";
			$data1 =Yii::app()->db->createCommand($sql)->queryAll();
			
			return $data1;
	}
	public function getsreachdetail_tsd($code=null,$pid=null)
	{
		
			$sql ="SELECT r.code as request_id, r.acc_employer,r.remark, r.business_name,CONCAT(ifnull(r.company_name,''),ifnull(r.name,''),' ', ifnull(r.lname,'')) as full_name, r.cid, d.code, d.name as name_depart, s.securities_namethai, s.account_id, s.certificate_no, s.securities_shares, s.effective_date
					FROM tran_request r 
					INNER JOIN tran_securities_registration s ON s.request_code = r.code AND s.reference_id = r.cid
					INNER JOIN mas_user u ON r.create_by = u.id
					INNER JOIN mas_department d ON u.dep_id = d.id 
					WHERE r.code = '".$code."' and reference_id='".$pid."'";
			$data1 =Yii::app()->db->createCommand($sql)->queryAll();
			
			return $data1;
	}
}	
