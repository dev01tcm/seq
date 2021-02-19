<?php


class rpt_004 extends CActiveRecord
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
	public function getGroup($code=null) 
	{	
  
		$sqlCon = '';
		if($code!=''){
			$sqlCon.= " and a.code = '".$code."' ";
		}
						

		$sql ="SELECT code_no,count(*) as cnt ";
		$sql.="FROM(		select ";
		$sql.="a.code as code_no,b.code,b.name,COUNT(a.dep_id) as cnt_depid  ";
		$sql.="from tran_request a ";
		$sql.="LEFT JOIN mas_department b on a.dep_id=b.id ";
		$sql.="WHERE 1=1 ".$sqlCon;
		$sql.=" GROUP by a.code,b.code order by a.code ";
		$sql.=") aa ";
		$sql.="GROUP by code_no order by code_no";
	   	$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;	
		
    }	
	
	
	public function getData($code=null) 
	{	
		$sqlCon = '';
		if($code!=''){
			$sqlCon.= " and a.code =".$code." ";
		}
				
		
		$sql ="SELECT 0 as cnt,";
		$sql.="b.code,b.name,COUNT(a.dep_id) as cnt_depid ";
		$sql.="from tran_request a ";
		$sql.="LEFT JOIN mas_department b on a.dep_id=b.id ";
		$sql.="WHERE 1=1 ".$sqlCon;
		$sql.=" GROUP by a.code,b.code order by a.code ";
	   	$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;	
		
    }		
	

}	
