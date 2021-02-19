<?php


class lkup_bank extends CActiveRecord
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
				$sqlCon.= " and (name like '%".$keyword."%' ";	
				$sqlCon.= " or code like '%".$keyword."%' ";	
				$sqlCon.= " or address like '%".$keyword."%' ";	
				$sqlCon.= " or email like '%".$keyword."%') ";				
			}
		
		
		$count=Yii::app()->db->createCommand('select count(*) from mas_bank where status=1 '.$sqlCon)->queryScalar();
		$sql ="select id, replace(code,'\\\','') as code, replace(name,'\\\','') as name , ";
		$sql.="replace(address,'\\\','') as address , replace(email,'\\\','') as email , ";
		$sql.="case status when '2' then 'Inactive' when '1' then 'Active' end as status ";
		$sql.="from mas_bank where status=1 ".$sqlCon;
		
		return new CSqlDataProvider($sql, array(
			'totalItemCount'=>$count,
			'sort'=>array(
				'attributes'=>array(
					 'id', 'code','name','address','email','status',
				),
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['prg_ctrl']['pagination']['default']['pagesize'],
			),
		));	
    }	
	public function getBank($id = null)
	{
	   	//$sql="select id, code, name, address, email from mas_bank where status=1 and id='".$id."' ";	   
	   	$sql ="select id, replace(code,'\\\','') as code, replace(name,'\\\','') as name , ";
		$sql.="replace(address,'\\\','') as address , replace(email,'\\\','') as email ";
		$sql.="from mas_bank where status=1 and id='".$id."' ";
	   	$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;
	}

}	
