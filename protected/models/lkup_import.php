<?php


class lkup_import extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'trn_transfer';
	}

    public function attributeLabels() {
        return array(
        );
    }
	public function search($id = null) 
	{
		$sql = "select ifnull(t1.cntt,0) as cntt , ifnull(t2.cntf,0) as cntf  ";	
		$sql.= "from ";	
		$sql.= "	(select count(*) as cntt ,b.id from tran_importresult_item a ";	
		$sql.= "	left join tran_importresult b on a.importresult_id=b.id ";	
		$sql.= "	where b.id='".$id."' and a.comment='') t1 ";	
		$sql.= "left outer join ";	
		$sql.= "	(select count(*) as cntf ,b.id from tran_importresult_item a ";	
		$sql.= "	left join tran_importresult b on a.importresult_id=b.id ";	
		$sql.= "	where b.id='".$id."' and a.comment!='') t2 ";	
		$sql.= "on t1.id=t2.id ";	
		
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;		
		
    }	
    public function searchtrue($id=null) 
	{		
		$sqlCon="";
		/*
			if($id!=''){							
				$sqlCon.= " and a.comment='' ";				
			}
			*/
		$count=Yii::app()->db->createCommand("select count(*) from tran_importresult_item a where a.comment='' and  a.importresult_id='".$id."' ")->queryScalar();
	
		$sql ="select a.id,b.code,a.doc_no,a.acc_employer,a.business_name, ";
		$sql.="CONCAT(ifnull(date_format(a.doc_date,'%d/%m/'),''),ifnull(date_format(a.doc_date,'%Y')+543,'') )as doc_date, ";
		$sql.="a.pid,a.cid, a.check_status, ";
		
		$sql.="CONCAT(ifnull(a.name,''),' ', ifnull(a.lname,'')) full_name,  ";	
		$sql.="a.mark,a.amont,a.acc_type_id,a.bank_id,a.bank_dep_id,a.bank_dep_name, a.acc_no, a.acc_name, ";
		$sql.="CONCAT(ifnull(date_format(a.request_date,'%d/%m/'),''),ifnull(date_format(a.request_date,'%Y')+543,''),ifnull(date_format(a.request_date,' %T'),'') )as request_date, ";		
		$sql.=" a.remark  ";
		$sql.="from tran_importresult_item a ";
		$sql.="left join tran_importresult b on b.id=a.importresult_id ";
		$sql.="where a.comment='' and a.importresult_id='".$id."' ";
		//echo var_dump($sql);
		//exit;
		return new CSqlDataProvider($sql, array(
			'totalItemCount'=>$count,
			'sort'=>array(
				'attributes'=>array(
					 'id','code','doc_no','doc_date','acc_employer','pid','cid','full_name','bank_id','bank_dep_id','check_status',
					 'bank_dep_name','acc_type_id','acc_no','acc_name','mark','amont','request_date','remark','business_name',
				),
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['prg_ctrl']['pagination']['default']['pagesize'],
			),
		));	
    }
	 public function searchfalse($id=null) 
	 {
		 
		$count=Yii::app()->db->createCommand("select count(*) from tran_importresult_item a where a.comment!='' and a.importresult_id='".$id."' ")->queryScalar();
		
		$sql ="select a.id,b.code,a.doc_no,a.acc_employer,a.business_name, ";
		$sql.="CONCAT(ifnull(date_format(a.doc_date,'%d/%m/'),''),ifnull(date_format(a.doc_date,'%Y')+543,'') )as doc_date, ";
		//$sql.="a.doc_date, ";
		$sql.="a.pid,a.cid, a.check_status, ";
		$sql.="CONCAT(ifnull(a.name,''),' ', ifnull(a.lname,'')) full_name,  ";	
		$sql.="a.mark,a.amont,a.acc_type_id,a.bank_id,a.bank_dep_id,a.bank_dep_name, a.acc_no, a.acc_name,  ";
		$sql.="CONCAT(ifnull(date_format(a.request_date,'%d/%m/'),''),ifnull(date_format(a.request_date,'%Y')+543,''),ifnull(date_format(a.request_date,' %T'),'') )as request_date, ";
		$sql.=" a.remark, a.comment  ";
		$sql.="from tran_importresult_item a ";
		$sql.="left join tran_importresult b on b.id=a.importresult_id ";
		$sql.="where a.comment!='' and a.importresult_id='".$id."' ";
		
		return new CSqlDataProvider($sql, array(
			'totalItemCount'=>$count,
			'sort'=>array(
				'attributes'=>array(
					 'id','code','doc_no','doc_date','acc_employer','pid','cid','full_name','bank_id','bank_dep_id','check_status',
					 'bank_dep_name','acc_type_id','acc_no','acc_name','mark','amont','request_date','remark','comment','business_name',
				),
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['prg_ctrl']['pagination']['default']['pagesize'],
			),
		));		
    }	
	
	
	public function getimport($id = null)
	{
	   $sql="select id,name from trn_transfer where id='".$id."'";	   
	   $rows =Yii::app()->db->createCommand($sql)->queryAll();
	   return $rows;
	}
	

}		