<?php


class lkup_home extends CActiveRecord
{
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'mas_assetbrand';
	}

    public function attributeLabels() {
        return array(
        );
    }
	public function getRequestnew()
	{
		$sqlCon='';
		$dep_id = Yii::app()->user->getInfo('dep_id');
		if(Yii::app()->user->getInfo('userlevel_id')=='1')
		{
			
		}else{
			$sqlCon.= " and dep_id='$dep_id' ";
		}
		
		$sql ="select count(id) as cnt from tran_request where status=1 ".$sqlCon;		
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;
	}
	public function getRequestedit()
	{
		$sqlCon='';
		$dep_id = Yii::app()->user->getInfo('dep_id');
		if(Yii::app()->user->getInfo('userlevel_id')=='1')
		{
			
		}else{
			$sqlCon.= " and dep_id='$dep_id' ";
		}
		
		$sql ="select count(id) as cnt from tran_request where status=3 ".$sqlCon;		
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;
	}
	public function getDashboard()
	{
		$sqlCon='';
		$dep_id = Yii::app()->user->getInfo('dep_id');
		if(Yii::app()->user->getInfo('userlevel_id')=='1')
		{
			
		}else{
			$sqlCon.= " and a.dep_id='$dep_id' ";
		}/*
		$sql ="select distinct code,cnt from ( ";
		$sql.="select a.id,a.code,count(b.request_id) as cnt ";
		$sql.="from tran_request a ";
		$sql.="left join tran_request_item b on a.id=b.request_id ";
		$sql.="where a.status!=0 and a.code!='' ".$sqlCon;
		$sql.=" group by a.id) aa group by code";
		*/
		//20170526
		$sql ="select id, code,cnt from ( ";
		$sql.="		select id,code,cnt from ( ";
		$sql.="			select a.id,a.code,count(b.request_id) as cnt ";
		$sql.="			from tran_request a ";
		$sql.="			left join tran_request_item b on a.id=b.request_id ";
		$sql.="			where a.status!=0 and a.code!='' ".$sqlCon;
		$sql.="			group by a.id ";
		$sql.="		) aa ";
		$sql.="		group by code order by code desc limit 20 ";
		$sql.=") dd order by code ";		
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;
	}
	public function search($keyword=null) {
		$sqlCon="";
		$dep_id = Yii::app()->user->getInfo('dep_id');
		if(Yii::app()->user->getInfo('userlevel_id')=='1')
		{
			
		}else{
			$sqlCon.= " where a.dep_id='$dep_id' ";
		}
		
		$count=Yii::app()->db->createCommand("select count(*) from ( select c.code, count(bank_id) as cnt from (
		select distinct a.code, b.bank_id from tran_request a join tran_request_item b on a.id=b.request_id ".$sqlCon."	) as aa	
		right outer join (select DISTINCT code from tran_request
		where status!=0 and code!='' order by code desc limit 20
		) c on aa.code=c.code
		group by c.code
		order by c.code desc
		) as aaa")->queryScalar();
		
		//$count=Yii::app()->db->createCommand("select count(*) from tran_request a left join tran_request_item b on a.id=b.request_id where a.status!=0 and a.code!='' ".$sqlCon." group by a.id ")->queryScalar();
		
		$sql ="select c.code as id,c.code, count(bank_id) as cnt ";
		$sql.="	from ( ";
		$sql.="		select distinct a.code, b.bank_id  ";
		$sql.="		from tran_request a join tran_request_item b on a.id=b.request_id  ".$sqlCon;
  		//$sql.="		where a.dep_id='21' ";
		$sql.="	) as aa ";
		$sql.="	right outer join ( ";
		$sql.="		select DISTINCT code  ";
		$sql.="		from tran_request ";
		$sql.="		where status!=0 and code!='' order by code desc limit 20 ";
		$sql.="	) c on aa.code=c.code ";
		$sql.="	group by c.code ";
		$sql.="	order by c.code desc ";
		/*
		$sql ="select id,code,cnt from ( ";
		$sql.="			select a.id,a.code,count(b.request_id) as cnt ";
		$sql.="			from tran_request a ";
		$sql.="			left join tran_request_item b on a.id=b.request_id"; 
		$sql.="			where a.status!=0 and a.code!='' ".$sqlCon;
		$sql.="			group by a.id ";
		$sql.="		) aa ";
		$sql.="		group by code order by code desc ";
		
		
		$sql ="select id,code,cnt from ( ";
		$sql.="		select id,code,cnt from ( ";
		$sql.="			select a.id,a.code,count(b.request_id) as cnt ";
		$sql.="			from tran_request a ";
		$sql.="			left join tran_request_item b on a.id=b.request_id ";
		$sql.="			where a.status!=0 and a.code!='' ".$sqlCon;
		$sql.="			group by a.id ";
		$sql.="		) aa ";
		$sql.="		group by code order by code desc limit 20 ";
		$sql.=") dd order by code desc";	
		
		*/
		return new CSqlDataProvider($sql, array(
			'totalItemCount'=>$count,
			'sort'=>array(
				'attributes'=>array(
					'id','code','cnt',
				),
			),
			'pagination'=>array(
				'pageSize'=>'20',
				//'pageSize'=>Yii::app()->params['prg_ctrl']['pagination']['default']['pagesize'],
			),
		));	
    }	
	
}	
