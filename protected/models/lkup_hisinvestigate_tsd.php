<?php


class lkup_hisinvestigate_tsd extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'mas_bank';
	}

    public function attributeLabels() {
        return array(
        );
    }
	
	public function search($keyword=null) {

	
		$sqlCon="";
		
			if($keyword!=''){	
								
				$sqlCon.= " and ( ";	
				$sqlCon.= " a.code like '%".$keyword."%' ";	
				$sqlCon.= " or a.doc_no like '%".$keyword."%' ";
				$sqlCon.= " or b.acc_employer like '%".$keyword."%' ";
				$sqlCon.= " or b.company_name like '%".$keyword."%' ";
				$sqlCon.= " or b.name like '%".$keyword."%' ";
				$sqlCon.= " or b.lname like '%".$keyword."%' ";	
				$sqlCon.= " or b.pid like '%".$keyword."%' ";
				$sqlCon.= " or b.cid like '%".$keyword."%' ";
				$sqlCon.= " ) ";	
						
			}
		
		$count=Yii::app()->db->createCommand('select count(*) from tran_exportreq_tsd a where a.status!=0 ')->queryScalar();		
		$sql = " select a.id,a.code,a.cnt,a.doc_no, ";
		$sql.= " CONCAT(ifnull(date_format(a.doc_date,'%d/%m/'),''),ifnull(date_format(a.doc_date,'%Y')+543,'') )as doc_date,  ";	
		$sql.= " CONCAT(ifnull(date_format(a.create_date,'%d/%m/'),''),ifnull(date_format(a.create_date,'%Y')+543,''),' ',ifnull(date_format(a.create_date,'%H:%i:%s'),'') )as create_date 	 ";
		$sql.= " from tran_exportreq_tsd  a ";
		$sql.= " left join tran_exportreq_item_tsd b on b.exportreq_id=a.id ";
		$sql.= " where a.status!=0  ".$sqlCon;
		$sql.= " group by a.code ";
		return new CSqlDataProvider($sql, array(
			'totalItemCount'=>$count,
			'sort'=>array(
				'attributes'=>array(
					 'id', 'code', 'doc_no', 'doc_date',  'cnt', 'create_date',
				),
			),
			'pagination'=>array(
				//'pageSize'=>'1',
				'pageSize'=>Yii::app()->params['prg_ctrl']['pagination']['default']['pagesize'],
			),
		));	
    }
	
	
		
	public function searchform($id = null,$keyword=null)
	{
	  
		$sqlCon="";
		if($keyword!=''){	
								
				$sqlCon.= " and ( ";	
				$sqlCon.= " a.code like '%".$keyword."%' ";	
				$sqlCon.= " or a.doc_no like '%".$keyword."%' ";
				$sqlCon.= " or a.acc_employer like '%".$keyword."%' ";
				$sqlCon.= " or a.company_name like '%".$keyword."%' ";
				$sqlCon.= " or a.name like '%".$keyword."%' ";
				$sqlCon.= " or a.lname like '%".$keyword."%' ";	
				$sqlCon.= " or a.pid like '%".$keyword."%' ";
				$sqlCon.= " or a.cid like '%".$keyword."%' ";
				$sqlCon.= " ) ";	
						
			}
		
		$count=Yii::app()->db->createCommand("select count(*) from tran_exportreq_item_tsd a where a.status!=0 and a.exportreq_id='".$id."' ".$sqlCon)->queryScalar();
		$sql ="select a.id,a.doc_no, a.code, ";
		$sql.="CONCAT(ifnull(date_format(a.doc_date,'%d/%m/'),''),ifnull(date_format(a.doc_date,'%Y')+543,'') )as doc_date, ";
		//$sql.="a.acc_employer,a.business_name, ";
		$sql.="replace(a.acc_employer,'\\\','') as acc_employer,";
		$sql.="replace(a.business_name,'\\\','') as business_name, ";
		$sql.="replace(CONCAT(ifnull(a.company_name,''),ifnull(a.name,''),' ', ifnull(a.lname,'')),'\\\','') as full_name, ";
		$sql.="replace(CONCAT(ifnull(a.pid,''),' ',ifnull(a.cid,'') ),'\\\','') as pid, ";
		$sql.="CONCAT(ifnull(a.pid,''),' ',ifnull(a.cid,'') )as pid, ";
		$sql.="CONCAT(ifnull(date_format(a.birth,'%d/%m/'),''),ifnull(date_format(a.birth,'%Y')+543,'') )as birth, ";
		$sql.="CONCAT(ifnull(date_format(a.create_date,'%d/%m/'),''),ifnull(date_format(a.create_date,'%Y')+543,'') )as create_date, ";
		$sql.="c.name as file_name, ";
		$sql.="a.address,a.status ";
		$sql.="from tran_exportreq_item_tsd a ";
		$sql.="left join tran_exportreq_tsd b on b.id = a.exportreq_id ";
		$sql.="left join tran_file_tsd c on c.id=b.file_id ";
		$sql.="left join mas_businesstype d on a.business_type=d.id ";
		$sql.="where a.status!=0 and a.exportreq_id='".$id."' ".$sqlCon;
		$sql.=" order by CASE WHEN d.business_order Is NULL Then 1 Else 0 End, d.business_order,a.id";
		
		return new CSqlDataProvider($sql, array(
			'totalItemCount'=>$count,
			'sort'=>array(
				/*'attributes'=>array(
					 'id', 'code', 'doc_no', 'doc_date', 'acc_employer', 'full_name', 'pid', 'file_name', 'birth',
					 'address', 'business_name','company_name', 'status', 'active', 'create_date',
				),*/
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['prg_ctrl']['pagination']['default']['pagesize'],
			),
		));	
    
	}
	public function getRequest($id = null)
	{
		/*
	   $sql = "select id,code,doc_no,doc_date,CONCAT(ifnull(date_format(create_date,'%d/%m/'),''),ifnull(date_format(create_date,'%Y')+543,'') )as create_date, ";
	   $sql.= "file_name,CONCAT(ifnull(LEFT(RTRIM(file_name), 42),''),'(1)', ifnull(RIGHT(RTRIM(file_name), 4),'')) filename ";
	   $sql.= "from tran_exportreq where status!=0 and id='".$id."' ";	   
	   $rows =Yii::app()->db->createCommand($sql)->queryAll();
	   return $rows;
	   *//*
	    $sql = "select a.id,a.code,a.doc_no,CONCAT(ifnull(date_format(a.create_date,'%d/%m/'),''),ifnull(date_format(a.create_date,'%Y')+543,'') )as create_date, ";
		$sql.= "CONCAT(ifnull(date_format(a.doc_date,'%d/%m/'),''),ifnull(date_format(a.doc_date,'%Y')+543,'') )as doc_date, ";
	  	$sql.= "b.name as file_name,b.name as filename ";
	   	$sql.= "from tran_exportreq a ";
	   	$sql.= "left join tran_file b on b.id=a.file_id ";
	   	$sql.= "where a.status!=0 and a.id='".$id."' ";	   
	   	$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows; */
		$sql = "select t1.id,t1.code,t1.doc_no,t1.doc_date,t1.create_date,t2.file_prename ,t3.file_bankname  ";
		$sql.= "from ";
		$sql.= "	(select id, code, doc_no,CONCAT(ifnull(date_format(create_date,'%d/%m/'),''),ifnull(date_format(create_date,'%Y')+543,'') )as create_date, ";
		$sql.= "	CONCAT(ifnull(date_format(doc_date,'%d/%m/'),''),ifnull(date_format(doc_date,'%Y')+543,'') )as doc_date ";
		$sql.= "	from tran_exportreq_tsd ";
		$sql.= "	where status!=0 and id='".$id."') t1 ";
		$sql.= "left outer join ";
		$sql.= "	(select name as file_prename,object_id ";
		$sql.= "	from tran_file_tsd ";
		$sql.= "	where status=1 and object_type='Pre') t2 ";
		$sql.= "on t2.object_id=t1.id ";
		$sql.= "left outer join ";
		$sql.= "	(select name as file_bankname,object_id ";
		$sql.= "	from tran_file_tsd ";
		$sql.= "	where status=1 and object_type='Bank') t3 ";
		$sql.= "on t3.object_id=t1.id ";
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;
	}
	
	public function getData($id = null)
	{
		/*
	   $sql = "select id,code,doc_no, CONCAT(ifnull(LEFT(RTRIM(file_name), 42),''),'(1)', ifnull(RIGHT(RTRIM(file_name), 4),'')) filename, ";
	   $sql.= "CONCAT(ifnull(date_format(doc_date,'%d/%m/'),''),ifnull(date_format(doc_date,'%Y')+543,'') )as doc_date, ";
	   $sql.= "CONCAT(ifnull(date_format(create_date,'%d/%m/'),''),ifnull(date_format(create_date,'%Y')+543,'') )as create_date ";
	   $sql.= " from tran_exportreq where status!=0 and id='".$id."' ";	   
	   $rows =Yii::app()->db->createCommand($sql)->queryAll();
	   return $rows;
	   */
	   	$sql = "select a.id,a.code,a.doc_no,a.doc_date,CONCAT(ifnull(date_format(a.create_date,'%d/%m/'),''),ifnull(date_format(a.create_date,'%Y')+543,'') )as create_date, ";
		$sql.= "b.name as filename,b.name as file_name ";
		$sql.= "from tran_exportreq a ";
		$sql.= "left join tran_file b on b.id=a.file_id ";
		$sql.= "where a.status!=0 and a.id='".$id."' ";	   
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;
	}
	
}	
