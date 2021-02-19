<?php


class lkup_department extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'mas_department';
	}

    public function attributeLabels() {
        return array(
        );
    }
	public function search($keyword=null) {
		$sqlCon="";
		
			if($keyword!=''){							
				$sqlCon.= " and (name like '%".$keyword."%' ";	
				$sqlCon.= " or code like '%".$keyword."%') ";				
			}
		
		
		$count=Yii::app()->db->createCommand('select count(*) from mas_department where status=1 '.$sqlCon)->queryScalar();
		$sql ="select id,replace(code,'\\\','') as code, replace(name,'\\\','') as name from mas_department where status=1 ".$sqlCon;
		
		return new CSqlDataProvider($sql, array(
			'totalItemCount'=>$count,
			'sort'=>array(
				'attributes'=>array(
					 'id', 'code','name',
				),
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['prg_ctrl']['pagination']['default']['pagesize'],
			),
		));	
    }	
	public function getDepartment($id = null)
	{
	   $sql="select id,replace(code,'\\\','') as code, replace(name,'\\\','') as name from mas_department where status=1 and id='".$id."' ";	   
	   $rows =Yii::app()->db->createCommand($sql)->queryAll();
	   return $rows;
	}

}	
