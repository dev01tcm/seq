<?php


class rpt_002 extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'mas_news';
	}

    public function attributeLabels() {
        return array(
        );
    }
	public function search($code=null,$emp_no=null,$people_no=null) 
	{	
		$sqlCon = '';
		if($code!='' && $emp_no!='' && $people_no!=''){
			$sqlCon.= " and c.code = '".$code."' ";
			$sqlCon.= " and a.acc_employer = '".$emp_no."' ";
			$sqlCon.= " and (a.pid = ".$people_no." or a.cid = ".$people_no.") ";
			
		}
		$count=Yii::app()->db->createCommand("select count(*),concat(ifnull(a.pid,''),ifnull(a.cid,'')) as pc_id FROM tran_request_item a LEFT JOIN tran_request c on a.request_id=c.id WHERE 1=1 ".$sqlCon." group by pc_id")->queryScalar();
		$sql = " SELECT @n := @n + 1 AS 'NO', ";
		$sql.= " a.id, c.code,a.acc_employer,";
		$sql.= " CONCAT(ifnull(date_format(a.doc_date,'%d/%m/'),''),ifnull(date_format(a.doc_date,'%Y')+543,''),' ', ifnull(date_format(a.doc_date,'%T'),''))as doc_date, ";
		$sql.= " concat(ifnull(a.pid,''),ifnull(a.cid,'')) as pc_id,";
		$sql.= " a.business_name,";
		$sql.= " replace(CONCAT(ifnull(a.company_name,''),ifnull(a.name,''),' ', ifnull(a.lname,'')),'\\\','') as name ";
		$sql.= " FROM tran_request_item a ";
		$sql.= " LEFT JOIN tran_request c on a.request_id=c.id ,(SELECT @n := 0) m ";
		$sql.= " WHERE 1=1  ".$sqlCon; 
		$sql.= " group by  pc_id order by NO";
		
		//echo var_dump($sql);exit;
		return new CSqlDataProvider($sql, array(
			'totalItemCount'=>$count,
			'sort'=>array(
				'attributes'=>array(
					 'id','NO', 'code','acc_employer','doc_date','pc_id','business_name','name','lname',
				),
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['prg_ctrl']['pagination']['default']['pagesize'],
			),
		));	
	}
	public function getGroup($code=null,$emp_no=null,$people_no=null) 
	{	
	
		$sqlCon = '';
		if($code!=''){
			$sqlCon.= " and a.code = '".$code."' ";
		}
		if($emp_no!=''){
			$sqlCon.= " and a.acc_employer = '".$emp_no."' ";
		}
		if($people_no!=''){
			$sqlCon.= " and (a.pid = ".$people_no." or a.cid = ".$people_no.") ";
		}
	
		$sql ="select a.id,a.code,a.acc_employer,a.business_name, ";
		$sql.="CONCAT(ifnull(date_format(a.doc_date,'%d/%m/'),''),ifnull(date_format(a.doc_date,'%Y')+543,'') )as doc_date, ";
		$sql.="CONCAT(a.name,' ', ifnull(a.company_name,'') ) name, a.lname, ";
		$sql.="CONCAT(ifnull(a.pid,''),' ',ifnull(a.cid,'') )as pid ";		
		$sql.="from tran_exportreq_item a ";	
		$sql.="where 1=1 and a.status=1 ".$sqlCon;	
	   	$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;
	
	
	/*
		$sqlCon = '';
		if($code!=''){
			$sqlCon.= " and c.code = '".$code."' ";
		}
		if($emp_no!=''){
			$sqlCon.= " and a.acc_employer = '".$emp_no."' ";
		}
		if($people_no!=''){
			$sqlCon.= " and (a.pid = ".$people_no." or a.cid = ".$people_no.") ";
		}
						
		
		$sql ="SELECT code,acc_employer,doc_date,pid,business_name,name,lname,";
		$sql.="count(*) as cnt from (";
		$sql.="SELECT c.code,a.acc_employer,";
		//$sql.="CONCAT(ifnull(date_format(a.doc_date,'%d/%m/'),''),ifnull(date_format(a.doc_date,'%Y')+543,''))as doc_date, ";
		$sql.="CONCAT(date_format(a.doc_date,'%d/%m/'),date_format(a.doc_date,'%Y')+543 )as doc_date, ";
		$sql.="concat(ifnull(a.pid,''),ifnull(a.cid,'')) as pid,";
		$sql.="a.business_name,a.name,a.lname,";
		$sql.="b.name as bank,";
		$sql.="b.code as code_bank,";
		$sql.="a.bank_dep_id,a.bank_dep_name,";
		$sql.="case a.acc_type_id WHEN '1' THEN 'ออมทรัพย์' WHEN '2' THEN 'ประจำ' WHEN '3' THEN 'กระแสรายวัน' ";
		$sql.="WHEN '4' THEN 'อื่นๆ' END as acc_type, ";
		$sql.="a.acc_no,a.acc_name,a.mark,a.amont,";
		$sql.="a.request_date,a.remark ";
		$sql.="FROM tran_request_item a ";
		$sql.="LEFT JOIN mas_bank b on a.bank_id=b.code ";
		$sql.="LEFT JOIN tran_request c on a.request_id=c.id ";
		$sql.="WHERE 1=1  ".$sqlCon;
		$sql.="order by a.id ) aa ";
		$sql.="group by code,pid order by code,acc_employer ";  
		//echo var_dump($sql);
		//exit;
	   	$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;	
		*/
    }	
	
	
	public function getData($code=null,$emp_no=null,$people_no=null) 
	{	
		$sqlCon = '';
		if($code!=''){
			$sqlCon.= " and c.code = '".$code."' ";
		}
		if($emp_no!=''){
			$sqlCon.= " and a.acc_employer = '".$emp_no."' ";
		}
		if($people_no!=''){
			$sqlCon.= " and (a.pid = ".$people_no." or a.cid = ".$people_no.") ";
		}	
		
		$sql ="SELECT 0 as cnt,";
		$sql.="b.name as bank,";
		$sql.="b.code as code_bank,";
		$sql.="a.bank_dep_id,a.bank_dep_name,";
		$sql.="a.acc_type_id as acc_type, ";
		$sql.="a.acc_no,a.acc_name,a.mark,a.amont,a.check_status,";
		$sql.="CONCAT(ifnull(date_format(a.request_date,'%d/%m/'),''),ifnull(date_format(a.request_date,'%Y')+543,''),ifnull(date_format(a.request_date,' %T'),'') )as request_date,a.remark ";
		$sql.="FROM tran_request_item a ";
		$sql.="LEFT JOIN mas_bank b on a.bank_id=b.code ";
		$sql.="LEFT JOIN tran_request c on a.request_id=c.id ";
		$sql.="WHERE 1=1 ".$sqlCon;
		$sql.="order by a.id  ";  
		//echo var_dump($sql);
		//exit;
	   	$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;	
		
    }		
	

}	
