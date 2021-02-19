<?php


class rpt_003 extends CActiveRecord
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
	public function getGroup($code_no=null,$code=null) 
	{	
 
		$sqlCon = '';
		if($code_no!=''){
			$sqlCon.= " and a.code = '".$code_no."' ";
		}
		if($code!=''){
			$sqlCon.= " and b.code = ".$code;
		}
						
		$sql ="SELECT code_no,code,count(*) as cnt from ( ";
		$sql.="select a.code as code_no, b.code,";
		$sql.="a.doc_no,a.acc_employer,a.business_name,";
		$sql.="concat(ifnull(a.company_name,''),ifnull(a.name,''),' ',ifnull(a.lname,'')) as fullname,";
		$sql.="concat(ifnull(a.pid,''),ifnull(a.cid,'')) as pcid,";
		$sql.="date_format(a.birth,'%d/%m/%Y') as birth,a.address ";
		$sql.="FROM tran_request a ";
		$sql.="left JOIN mas_department b on a.dep_id=b.id ";
		$sql.="WHERE 1=1 ".$sqlCon;
		$sql.=" order by a.code,b.code  ) aa ";
		$sql.="group by code order by code,code_no "; 
	   	$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;	
		
    }	
	
	
	public function getData($code_no=null,$code=null) 
	{	
		$sqlCon = '';
		if($code_no!=''){
			$sqlCon.= " and a.code = '".$code_no."' ";
		}
		if($code!=''){
			$sqlCon.= " and b.code = ".$code;
		}
				
		
		$sql ="SELECT 0 as cnt,";
		$sql.="a.code,a.doc_no,a.acc_employer,a.business_name,";
		$sql.="concat(ifnull(a.company_name,''),ifnull(a.name,''),' ',ifnull(a.lname,'')) as fullname,";
		$sql.="concat(ifnull(a.pid,''),ifnull(a.cid,'')) as pcid,";
		$sql.="CONCAT(ifnull(date_format(a.birth,'%d/%m/'),''),ifnull(date_format(a.birth,'%Y')+543,''))as birth, ";
		$sql.="a.address ";
		$sql.="FROM tran_request a ";
		$sql.="left JOIN mas_department b on a.dep_id=b.id ";
		$sql.="WHERE 1=1 ".$sqlCon;
		$sql.=" order by a.code,b.code ";
	   	$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;	
		
    }		
	

}	
