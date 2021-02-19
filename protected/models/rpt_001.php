<?php


class rpt_001 extends CActiveRecord
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
	public function search($keyword=null) 
	{	
		$sqlCon = '';
		if($keyword!=''){
			$sqlCon.= " and b.code = '".$keyword."' ";
		}
		$count=Yii::app()->db->createCommand("select count(*) from (select count(*) FROM tran_importresult_item a left JOIN tran_importresult b on a.importresult_id=b.id left join mas_bank c on a.bank_id=c.code WHERE 1=1 and a.comment='' ".$sqlCon." group by c.id) aa")->queryScalar();
		$sql =" SELECT @n := @n + 1 AS 'NO',  ";
		$sql.=" b.code, ";
		$sql.=" c.name as name_bank, ";
		$sql.=" CONCAT(ifnull(date_format(a.request_date,'%d/%m/'),''),ifnull(date_format(a.request_date,'%Y')+543,''),ifnull(date_format(a.request_date,' %T'),'') )as request_date,  ";
		$sql.=" count(b.code) as cnt , b.id, b.bank_id, ";
		$sql.=" CONCAT(ifnull(date_format(a.create_date,'%d/%m/'),''),ifnull(date_format(a.create_date,'%Y')+543,''),ifnull(date_format(a.create_date,' %T'),'') )as create_date ";
		$sql.=" FROM tran_importresult_item a  ";
		$sql.=" left JOIN tran_importresult b on a.importresult_id=b.id  ";
		$sql.=" left join mas_bank c on a.bank_id=c.code , (SELECT @n := 0) m ";
		$sql.=" WHERE 1=1 and a.comment='' ".$sqlCon ;
		$sql.=" group by c.id order by no ";
return new CSqlDataProvider($sql, array(
			'totalItemCount'=>$count,
			'sort'=>array(
				'attributes'=>array(
					 'NO', 'code','id','bank_id','name_bank','request_date','cnt','create_date',
				),
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['prg_ctrl']['pagination']['default']['pagesize'],
			),
		));	
/*
		
		$sql =" SELECT @n := @n + 1 AS 'NO', ";
		$sql.=" CONCAT(ifnull(date_format(a.request_date,'%d/%m/'),''),ifnull(date_format(a.request_date,'%Y')+543,''),ifnull(date_format(a.request_date,' %T'),'') )as request_date, ";		
		$sql.=" b.code, b.id, c.id as bank_id, c.name as name_bank, count(b.code) as cnt ";
		$sql.=" FROM tran_importresult_item a ";
		$sql.=" left JOIN tran_importresult b on a.importresult_id=b.id ";
		$sql.=" left join mas_bank c on a.bank_id=c.code , (SELECT @n := 0) m";
		$sql.=" WHERE 1=1 and a.comment='' ".$sqlCon ;
		$sql.=" group by c.id ";
		return new CSqlDataProvider($sql, array(
			'totalItemCount'=>$count,
			'sort'=>array(
				'attributes'=>array(
					 'NO', 'code','id','name_bank','request_date','cnt','create_date',
				),
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['prg_ctrl']['pagination']['default']['pagesize'],
			),
		));	
		/*
		$count=Yii::app()->db->createCommand('select count(*) FROM tran_importresult_item a left JOIN tran_importresult b on a.importresult_id=b.id left join mas_bank c on a.bank_id=c.code WHERE 1=1 and a.comment="" '.$sqlCon.'" group by c.id"')->queryScalar();
		
		$sql ="SELECT 0 as cnt,";
		$sql.="a.id,b.code,c.id as id_bank,c.name as name_bank, ";
		$sql.="CONCAT(ifnull(date_format(a.request_date,'%d/%m/'),''),ifnull(date_format(a.request_date,'%Y')+543,''),ifnull(date_format(a.request_date,' %T'),'') )as request_date, ";
		$sql.="CONCAT(ifnull(date_format(a.create_date,'%d/%m/'),''),ifnull(date_format(a.create_date,'%Y')+543,''),ifnull(date_format(a.create_date,' %T'),'') )as create_date ";
		$sql.="FROM tran_importresult_item a ";
		$sql.="left JOIN tran_importresult b on a.importresult_id=b.id ";
		$sql.="left join mas_bank c on a.bank_id=c.code ";
		$sql.="WHERE 1=1 and a.comment='' ".$sqlCon;
		$sql.="group by c.id order by b.code ";  
		 
	   	return new CSqlDataProvider($sql, array(
			'totalItemCount'=>$count,
			'sort'=>array(
				'attributes'=>array(
					 'cnt', 'code','name_bank','request_date','email','create_date',
				),
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['prg_ctrl']['pagination']['default']['pagesize'],
			),
		));		
		*/
    }
	public function getGroup($code=null,$id=null) 
	{	
		$sqlCon = '';
		if($id!=''){
			$sqlCon.= " and b.bank_id = '".$id."' ";
		}
		if($code!=''){
			$sqlCon.= " and b.code = '".$code."' ";
		}
		$sql ="SELECT code,bank_name,count(*) as cnt from (";
		$sql.="select b.code,c.name as bank_name,a.request_date,a.acc_employer,a.create_date ";
		$sql.="FROM tran_importresult_item a ";
		$sql.="left JOIN tran_importresult b on a.importresult_id=b.id ";
		$sql.="left join mas_bank c on a.bank_id=c.code ";
		$sql.="WHERE 1=1  and a.comment='' ".$sqlCon;
		$sql.="order by a.id ) aa ";
		$sql.="group by code ";	
		//echo var_dump($sql);exit;   
	   	$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;	
		
    }	
	
	
	public function getData($code=null,$id=null) 
	{	
		$sqlCon = '';
		if($id!=''){
			$sqlCon.= " and b.bank_id='".$id."' ";		
			$sqlCon.= " and b.code='".$code."' ";
		}		
				
		$sql ="SELECT @n := @n + 1 AS 'no',";
		$sql.="a.acc_employer,a.business_name, ";
		$sql.="CONCAT(ifnull(a.name,''),ifnull(a.company_name,'')) as name, a.lname, ";
		$sql.="CONCAT(ifnull(date_format(a.request_date ,'%d/%m/'),''),ifnull(date_format(a.request_date ,'%Y')+543,''),ifnull(date_format(a.request_date ,' %T'),'') )as request_date ";		
		$sql.="FROM tran_importresult_item a ";
		$sql.="left JOIN tran_importresult b on a.importresult_id=b.id ";
		$sql.="left join mas_bank c on a.bank_id=c.code , (SELECT @n := 0) m ";
		$sql.="WHERE a.status != 0 and a.comment='' ".$sqlCon;
		$sql.="order by b.code ";
		
		//echo var_dump($sql);exit;
	   	$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;	
		
    }		
	

}	
