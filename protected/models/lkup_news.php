<?php


class lkup_news extends CActiveRecord
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
	public function search() 
	{		
		
		$sql="select name,status from mas_news ";	   
	   	$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;	
		
    }	
	
	

}	
