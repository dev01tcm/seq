<?php


class lkup_businesstype extends CActiveRecord
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
				$sqlCon.= " and (id like '%".$keyword."%' ";	
				$sqlCon.= " or type like '%".$keyword."%' ";			
				$sqlCon.= " or name like '%".$keyword."%') ";				
			}
		
		
		$count=Yii::app()->db->createCommand('select count(*) from mas_businesstype where status=1 '.$sqlCon)->queryScalar();
		$sql ="select id,code,name,business_order, status, ";
		$sql.="case type when '0' then 'ไม่ระบุ' when '1' then 'บุคคล' when '2' then 'นิติบุคคล' end as type ";
		$sql.="from mas_businesstype where status=1 ".$sqlCon;
		
		return new CSqlDataProvider($sql, array(
			'totalItemCount'=>$count,
			'sort'=>array(
				'attributes'=>array(
					 'id', 'code', 'name', 'type', 'business_order', 'status',
				),
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['prg_ctrl']['pagination']['default']['pagesize'],
			),
		));	
    }	
	public function getBusinesstype($id = null)
	{
	   $sql="select id, code, name, business_order, type from mas_businesstype where status=1 and id='".$id."' ";	   
	   $rows =Yii::app()->db->createCommand($sql)->queryAll();
	   return $rows;
	}

}	
