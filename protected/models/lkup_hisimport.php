<?php


class lkup_hisimport extends CActiveRecord
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
							
							/*	
				$sqlCon.= " and (b.code like '%".$keyword."%' ";	
				$sqlCon.= " or a.doc_no like '%".$keyword."%' ";	
				$sqlCon.= " or a.acc_employer like '%".$keyword."%' ";	
				//$sqlCon.= " or cid like '%".$keyword."%' ";
				$sqlCon.= " or a.pid like '%".$keyword."%') ";	
					*/		
			}
		
		
		$count=Yii::app()->db->createCommand("select count(*) from tran_importresult ".$sqlCon)->queryScalar();
		$sql ="select id,code,doc_no ,";
		$sql.="CONCAT(ifnull(date_format(doc_date,'%d/%m/'),''),ifnull(date_format(doc_date,'%Y')+543,'') )as doc_date, ";
		$sql.="CONCAT(ifnull(date_format(create_date,'%d/%m/'),''),ifnull(date_format(create_date,'%Y')+543,''),ifnull(date_format(create_date,' %T'),'') )as create_date ";
		$sql.="from tran_importresult ";
		
		return new CSqlDataProvider($sql, array(
			'totalItemCount'=>$count,
			'sort'=>array(
				'attributes'=>array(
					 'id','code','doc_no','doc_date','create_date',
				),
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['prg_ctrl']['pagination']['default']['pagesize'],
			),
		));
    }	
	public function search2($keyword=null) {
		
		$sqlCon='';
		/*
		$dep_id = Yii::app()->user->getInfo('dep_id');
		if(Yii::app()->user->getInfo('userlevel_id')=='1')
		{
			
		}else{
			$sqlCon.= " and a.dep_id='$dep_id' ";
		}*/
		if($keyword!=''){	
					
				$sqlCon.= " where a.code like '%".$keyword."%' ";	
				$sqlCon.= " or a.doc_no like '%".$keyword."%' ";	
				$sqlCon.= " or b.acc_employer like '%".$keyword."%' ";	
				$sqlCon.= " or b.name like '%".$keyword."%' ";
				$sqlCon.= " or b.pid like '%".$keyword."%' ";
				$sqlCon.= " or b.acc_no like '%".$keyword."%' ";
				//and (t2.name like '%ทรานปอเตอร์ 10827%')
						
			}
			/*
		$count=Yii::app()->db->createCommand("select count(*) FROM (SELECT id, code, doc_no FROM tran_exportreq)t1 LEFT OUTER JOIN (SELECT id, code, bank_id, doc_no, doc_date, create_date, count( bank_id ) AS cnt FROM (SELECT a.id, a.code, a.bank_id, a.doc_no, CONCAT( ifnull( date_format( a.doc_date, '%d/%m/' ) , '' ) , ifnull( date_format( a.doc_date, '%Y' ) +543, '' ) ) AS doc_date, CONCAT( ifnull( date_format( a.create_date, '%d/%m/' ) , '' ) , ifnull( date_format( a.create_date, '%Y' ) +543, '' ) , ifnull( date_format( a.create_date, '%T' ) , '' ) ) AS create_date
FROM tran_importresult a LEFT JOIN tran_importresult_item t2 ON a.id = t2.importresult_id WHERE a.status =1 AND t2.comment = '' GROUP BY a.code, a.bank_id )aa
)t2 ON t1.code = t2.code where 1=1 ")->queryScalar();
		
		
		$sql =" SELECT t1.id, t1.code, t1.doc_no, t2.doc_date, t2.create_date, t3.cnt, t2.acc_employer, t2.name, t2.pid, t2.acc_no  ";
		$sql.=" FROM ";
		$sql.=" 		(SELECT id, code, doc_no FROM tran_exportreq )t1 ";
		$sql.=" LEFT OUTER JOIN ";
		$sql.=" 		(SELECT id, code, doc_no, doc_date, create_date ,acc_employer  ,name  ,pid  ,acc_no ";
		$sql.=" 		FROM ";
		$sql.=" 			(SELECT t1.id, t1.code, t1.bank_id, t1.doc_no, t2.name, t2.acc_employer, t2.pid, t2.acc_no,  ";
		$sql.=" 			CONCAT(ifnull(date_format(t1.doc_date,'%d/%m/'),''),ifnull(date_format(t1.doc_date,'%Y')+543,'')) AS doc_date,  ";
		$sql.=" 			CONCAT(ifnull(date_format(t1.create_date,'%d/%m/'),''),ifnull(date_format(t1.create_date,'%Y')+543,''),ifnull(date_format(t1.create_date,'%T'),'')) AS create_date ";
		$sql.=" 			FROM tran_importresult t1 ";
		$sql.=" 			LEFT JOIN tran_importresult_item t2 ON t1.id = t2.importresult_id ";
		$sql.=" 			WHERE t1.status =1 AND t2.comment = '' ".$sqlCon." GROUP BY t1.code, t1.bank_id) aa ";
		$sql.=" 		)t2 ";
		$sql.=" ON t1.code = t2.code ";
		$sql.=" LEFT OUTER JOIN ";
		$sql.=" 		(select id,code,cnt  ";
		$sql.=" 		from  ";
		$sql.=" 			(select id,code,cnt ";
		$sql.="      			from (select a.id,a.code,count(b.request_id) as cnt ";					
		$sql.=" 			from tran_request a ";		
		$sql.=" 		left join tran_request_item b on a.id=b.request_id ";
		$sql.=" 		where a.status!=0 and a.code!='' ";
		$sql.=" 		group by a.id ";
		$sql.=" 			) aa group by code order by code ";
		$sql.=" 		) dd order by code) t3 ";
		$sql.=" on t1.code=t3.code	";
		$sql.= "where 1=1 ".$sqlCon;
		$sql.= "group by t1.code ";
		
		$sql.="	order by t1.code desc ";
		*/
	/*	
		$count=Yii::app()->db->createCommand("select count(*) from ( select c.code, count(bank_id) as cnt from (
		select distinct a.code, b.bank_id from tran_request a join tran_request_item b on a.id=b.request_id ".$sqlCon."	) as aa	
		right outer join (select DISTINCT code from tran_request
		where status!=0 and code!='' order by code desc 
		) c on aa.code=c.code
		group by c.code
		order by c.code desc
		) as aaa")->queryScalar();
		
		$sql =" select c.code as id,c.code,c.doc_no,c.doc_date,c.create_date, count(bank_id) as cnt,c.acc_employer,c.name,c.pid,c.acc_no  ";
		$sql.=" from (  ";
		$sql.="		select distinct a.code, b.bank_id   ";
		$sql.="		from tran_request a  ";
        $sql.="		join tran_request_item b on a.id=b.request_id where b.status!=0  ";		
		$sql.=") as aa  ";
		$sql.=" right outer join (  ";
		$sql.="		select DISTINCT a.code,a.doc_no,CONCAT(ifnull(date_format(a.doc_date,'%d/%m/'),''),ifnull(date_format(a.doc_date,'%Y')+543,'')) AS doc_date, ";
		$sql.="		CONCAT(ifnull(date_format(b.create_date,'%d/%m/'),''),ifnull(date_format(b.create_date,'%Y')+543,'')) AS create_date, ";
		$sql.="		b.acc_employer,b.name,b.pid,b.acc_no ";
    	$sql.="		from tran_exportreq a ";
     	$sql.="		left join tran_importresult_item b on a.doc_no=b.doc_no ".$sqlCon." ";
		$sql.="		GROUP BY a.code ";
		$sql.="	) c on aa.code=c.code  ";
		$sql.=" group by c.code  ";
		$sql.=" order by c.code desc ";
*/
		$sql ="SELECT code as id , code ,doc_no,DATE_FORMAT(DATE_ADD(doc_date, INTERVAL 543 YEAR),'%d/%m/%Y   %T') as doc_date from tran_exportreq ";
		$data1 =Yii::app()->db->createCommand($sql)->queryAll();
		
	/*	
		$sql = "SELECT doc_no, date_format(DATE_ADD(create_date, INTERVAL 543 YEAR),'%d/%m/%Y   %T') as create_date FROM tran_importresult_item GROUP BY doc_no;";
		$data2 =Yii::app()->db->createCommand($sql)->queryAll();
		foreach($data2 as $dataitem2){
			//$offerArray[$dataitem2['doc_no']] = $dataitem2['create_date'];
			$offerArray[$dataitem2['create_date']] = trim($dataitem2['doc_no']);
		}
		
		$sql ="SELECT  code ,id FROM tran_request WHERE STATUS != 0  ";
		$data4 =Yii::app()->db->createCommand($sql)->queryAll();
		
		$sql ="SELECT  request_id FROM tran_request_item WHERE STATUS != 0  ";
		$data5 =Yii::app()->db->createCommand($sql)->queryAll();
		
		$z=0;
		foreach($data4 as $dataitem4)
		{
			foreach($data5 as $dataitem5)
			{
				if($dataitem4['id']==$dataitem5['request_id'])
				{
					$data3[$z]['code']=$dataitem4['code'];
					$z++;
				}
			}
		}
		
		
		
		
		$sql ="SELECT DISTINCT a.code ,b.bank_id FROM tran_request a inner JOIN tran_request_item b ON a.id = b.request_id WHERE b. STATUS != 0  ";
		$data3 =Yii::app()->db->createCommand($sql)->queryAll();
		
		var_dump($data1);
		exit;
	
		$data = array();
		
		$i = 0;
		foreach($data1 as $dataitem)
		{
			
			$a=0;
			$data[$i]['doc_no'] =  $dataitem['doc_no'];
			
		
			$data[$i]['id']=$dataitem['id'];
			$data[$i]['code']=$dataitem['code'];
			
			//$sql ="SELECT  create_date from tran_importresult_item where doc_no='".$data['doc_no']."' limit 0,1;";
			//$rows1 =Yii::app()->db->createCommand($sql)->queryAll();
			
			//$data['code']=$rows1[0]['create_date'];
		/*	
			$data[$i]['doc_date']=$dataitem['doc_date'];
			
			$xxx =  array_search($dataitem['doc_no'],$offerArray);
			
			$data[$i]['create_date'] =  $xxx;
			
			
			
			foreach($data2 as $dataitem2){
				
				 $offerArray[$dataitem2['doc_no']] = $dataitem2['create_date'];
				 
				//echo $dataitem2['doc_no'];
				
				if($dataitem['doc_no'] === $dataitem2['doc_no'] ){
					echo $dataitem['doc_no'] . " - " . $dataitem2['doc_no'] . "<br/>";
					$data[$i]['create_date'] =  $dataitem2['create_date'];
					
					echo $data[$i]['create_date'];
					continue 1;
					
				}else{
					$data[$i]['create_date'] = "sss";	
				}
			}
			foreach($data3 as $dataitem3)
			{
				if($dataitem['code']==$dataitem3['code'])
				{
					$a++;
				}
			}
			
			$data[$i]['cnt']=$a;
		
			$i++;
			
		}
	*/
	    return $data1;
    }	
	public function getSearch($code=null) 
	{
		$dep_id = Yii::app()->user->getInfo('dep_id');
		  $sqlCon="";
		if(Yii::app()->user->getInfo('userlevel_id')=='1')
		{
			
		}else{
			$sqlCon.= " and a.dep_id='$dep_id' ";
		}
		
		$count=Yii::app()->db->createCommand("select count(*) from mas_bank")->queryScalar();
		
		/*
	
		$sql =" select t1.id,t1.code_id,t1.name,t2.code,t2.doc_no,t2.doc_date,t2.create_date,ifnull(t3.cnt1,0) as cnt1,ifnull(t4.cnt2,0) as cnt2,ifnull(t2.cnt,0) as cnt,t2.code,t2.im_id  ";
		$sql.=" from ";
		$sql.="		(select a.id,a.code as code_id,a.name ";
		$sql.="		from mas_bank a) t1 ";
		$sql.="	left outer join ";
		$sql.="		(SELECT b.id as im_id,b.code, b.doc_no, b.bank_id,count(*) as cnt, ";
		$sql.="		CONCAT(ifnull(date_format(b.doc_date, '%d/%m/'),''),ifnull(date_format(b.doc_date,'%Y')+543,'') )as doc_date, ";
		$sql.="     CONCAT(ifnull(date_format(b.create_date,'%d/%m/'),''),ifnull(date_format(b.create_date,'%Y')+543,''),ifnull(date_format(b.create_date,' %T'),'') )as create_date ";
		$sql.="		FROM tran_importresult b ";
		$sql.="		JOIN tran_importresult_item c ON b.id = c.importresult_id ";
		$sql.="		WHERE c.comment = '' and b.code='".$code."' group by b.bank_id) t2 ";
		$sql.=" on t1.code_id=t2.bank_id ";	
		$sql.="	left outer join ";
		$sql.="		(SELECT b.bank_id,count(*) as cnt1 ";
		$sql.="		FROM tran_importresult b ";
		$sql.="		JOIN tran_importresult_item c ON b.id = c.importresult_id ";
		$sql.="		WHERE c.comment = '' and c.check_status=1 and b.code='".$code."' group by b.bank_id) t3 ";
		$sql.=" on t1.code_id=t3.bank_id ";	
		$sql.="	left outer join ";
		$sql.="		(SELECT b.bank_id,count(*) as cnt2 ";
		$sql.="		FROM tran_importresult b ";
		$sql.="		JOIN tran_importresult_item c ON b.id = c.importresult_id ";
		$sql.="		WHERE c.comment = '' and c.check_status=2 and b.code='".$code."' group by b.bank_id) t4 ";
		$sql.=" on t1.code_id=t4.bank_id ";	
		*/
		$sql1 ="SELECT
			a.id,
			a. CODE AS code_id,
			a. NAME
			
		FROM
			mas_bank a where status !=0";
		$rows1 =Yii::app()->db->createCommand($sql1)->queryAll();
	//	var_dump($rows1);
	//	exit;
		$sql ="select 
		t1.check_status,
		t2.im_id,
		t1. CODE,
		t1.doc_no,
		t1.bank_id,
		t1.cnt,
		t1.doc_date,
		t1.create_date from (SELECT 
		b.check_status,
		b.id AS im_id,
		a. CODE,
		b.doc_no,
		b.bank_id,
		count(b.id) AS cnt,
		DATE_FORMAT(DATE_ADD(b.doc_date, INTERVAL 543 YEAR),'%m/%d/%Y') AS doc_date,
		DATE_FORMAT(DATE_ADD(b.create_date,INTERVAL 543 YEAR),'%m/%d/%Y %H:%i:%s') AS create_date
	FROM
		tran_request a
	  JOIN tran_request_item b ON b.request_id = a.id
	WHERE
		a. CODE = '".$code."'
	AND a. STATUS = 4
	AND b. STATUS != 0
	GROUP BY
		b.check_status,b.bank_id) t1
		LEFT OUTER JOIN (
	SELECT
		id AS im_id,
		bank_id
	FROM
		tran_importresult
	WHERE
		CODE = '".$code."'
	GROUP BY
		bank_id
) t2 ON t1.bank_id = t2.bank_id
		";
		
	$i=0;	
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
		
		$cc=0;
		
		foreach($rows1 as $dataitem)
		{
			$dd=0;
			
			$data[$i]['code_id']=$dataitem['code_id'];
			$data[$i]['name']=$dataitem['NAME'];
			$data[$i]['im_id']='';
			$data[$i]['doc_no']='';
			$data[$i]['doc_date']='';
			$data[$i]['create_date']='';
			$data[$i]['cnt1']='0';
			$data[$i]['cnt2']='0';
			$data[$i]['cntsum']='0';
			
			foreach($rows as $dataitem2)
			{
				if($dataitem['code_id']==$dataitem2['bank_id'])
				{
					
					$data[$i]['im_id']=$dataitem2['im_id'];
					$data[$i]['CODE']=$dataitem2['CODE'];
					$data[$i]['doc_no']=$dataitem2['doc_no'];
					$data[$i]['doc_date']=$dataitem2['doc_date'];
					$data[$i]['create_date']=$dataitem2['create_date'];
					if($dataitem2['check_status']==1)
					{
						$data[$i]['cnt1']=isset($dataitem2['cnt'])?addslashes(trim($dataitem2['cnt'])):'0';
						
						
					}
					
					if($dataitem2['check_status']==2)
					{
						$data[$i]['cnt2']=isset($dataitem2['cnt'])?addslashes(trim($dataitem2['cnt'])):'0';
						
						
					}
					$aa=(int)isset($dataitem2['cnt'])?addslashes(trim($dataitem2['cnt'])):0;
				//	$dd=(int)isset($dataitem2['cnt'])?addslashes(trim($dataitem2['cnt'])):0;
					$dd+=$aa;
					$data[$i]['cntsum']=$dd;
					
				}
				
				
				
			}
			
			if($dd!=0)
				{
					$cc++;
				}
			
			$i++;
		}
		
		Yii::app()->session['coutbank']=$cc;
		return $data;
		
    }
	
	public function getSearch2($code=null) 
	{
		/*
		$sql ="select t1.id,t1.code_id,t1.name,t2.code,t2.doc_no,t2.doc_date,t2.create_date,t2.cnt,t2.code,t2.im_id  ";
		$sql.="from ";
		$sql.="		(select a.id,a.code as code_id,a.name ";
		$sql.="		from mas_bank a) t1 ";
		$sql.="	left outer join ";
		$sql.="		(SELECT b.id as im_id,b.code, b.doc_no, b.bank_id,count(*) as cnt, ";
		$sql.="		CONCAT(ifnull(date_format(b.doc_date, '%d/%m/'),''),ifnull(date_format(b.doc_date,'%Y')+543,'') )as doc_date, ";
		$sql.="     CONCAT(ifnull(date_format(b.create_date,'%d/%m/'),''),ifnull(date_format(b.create_date,'%Y')+543,''),ifnull(date_format(b.create_date,' %T'),'') )as create_date ";
		$sql.="		FROM tran_importresult b ";
		$sql.="		JOIN tran_importresult_item c ON b.id = c.importresult_id ";
		$sql.="		WHERE c.comment = '' and b.code='".$code."' group by b.bank_id) t2 ";
		$sql.="on t1.code_id=t2.bank_id ";	
		*/
		$dep_id = Yii::app()->user->getInfo('dep_id');
		$sqlCon="";
		if(Yii::app()->user->getInfo('userlevel_id')=='1')
		{
			
		}else{
			$sqlCon.= " and a.dep_id='$dep_id' ";
		}
		$sql ="select t1.id,t1.code_id,t1.name,t2.code,t2.doc_no,t2.doc_date,t2.create_date,t2.cnt,t2.code,t2.im_id  ";
		$sql.="from ";
		$sql.="		(select a.id,a.code as code_id,a.name ";
		$sql.="		from mas_bank a) t1 ";
		$sql.="	left outer join ";
		$sql.="		(SELECT b.id as im_id,a.code, b.doc_no, b.bank_id,count(*) as cnt, ";
		$sql.="		CONCAT(ifnull(date_format(b.doc_date, '%d/%m/'),''),ifnull(date_format(b.doc_date,'%Y')+543,'') )as doc_date, ";
		$sql.="     CONCAT(ifnull(date_format(b.create_date,'%d/%m/'),''),ifnull(date_format(b.create_date,'%Y')+543,''),ifnull(date_format(b.create_date,' %T'),'') )as create_date ";
		$sql.="		from tran_request a ";
		$sql.="		RIGHT OUTER JOIN tran_request_item b on b.request_id=a.id ";
		$sql.="		WHERE a.status=4 and a.code='".$code."' ".$sqlCon."  group by b.bank_id) t2 ";
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;
    }		
	
	public function getDataimport($id = null)
	{
	   $sql = "select id,code,doc_no,doc_date,";
	   $sql.= "CONCAT(ifnull(date_format(create_date,'%d/%m/'),''),ifnull(date_format(create_date,'%Y')+543,''))as create_date, ";
	   $sql.= "file_id ";
	   $sql.= "from tran_importresult where status!=0 and id='".$id."' ";	   
	   $rows =Yii::app()->db->createCommand($sql)->queryAll();
	   return $rows;
	}
		
	public function getdataUpdate($bank_id = null,$code = null){
		/*
		$sql = "select a.id as id_impt,a.code,a.doc_no,a.bank_id,";
		$sql.= "concat(date_format(a.doc_date,'%d/%m/'),date_format(a.doc_date,'%Y')+543) as doc_date,";
		$sql.= "concat(date_format(a.create_date,'%d/%m/'),date_format(a.create_date,'%Y')+543) as create_date,";
		$sql.= "b.name,b.upload_url,b.id as trn_id,b.file_size,b.file_type ";
		$sql.= "from tran_importresult a ";	
		$sql.= "left join tran_file b on a.id=b.object_id ";
		$sql.= "where ((b.file_type='.pdf' or ((b.file_type='.jpg' or b.file_type='.jpeg') or b.file_type='.png'))  ";
		$sql.= "and b.status=1) and a.id = ".$id." ";
		*/
		$sql = "select a.id as id_impt,a.code,a.doc_no,a.bank_id,";
		$sql.= "concat(date_format(a.doc_date,'%d/%m/'),date_format(a.doc_date,'%Y')+543) as doc_date,";
		$sql.= "concat(date_format(a.create_date,'%d/%m/'),date_format(a.create_date,'%Y')+543) as create_date,";
		$sql.= "b.name,b.upload_url,b.id as trn_id,b.file_size,b.file_type ";
		$sql.= "from tran_importresult a ";	
		$sql.= "left join tran_file b on a.id=b.object_id ";
		$sql.= "where object_type='book'  ";
		$sql.= "and b.status=1 and a.code = ".$code." and a.bank_id=".$bank_id." ";
		//echo var_dump($sql);
	   $rows =Yii::app()->db->createCommand($sql)->queryAll();
	   return $rows;		
	}
	
	public function getdataSecond($id = null){
		$sql = "select a.id,a.code,a.doc_no,a.bank_id,";
		$sql.= "concat(date_format(a.doc_date,'%d/%m/'),date_format(a.doc_date,'%Y')+543) as doc_date,";
		$sql.= "concat(date_format(a.create_date,'%d/%m/'),date_format(a.create_date,'%Y')+543) as create_date ";
		$sql.= "from tran_importresult a "; 
		$sql.= "left join tran_file b on a.id=b.object_id "; 
		$sql.= "where a.id = ".$id;	
		//echo var_dump($sql); exit;
	   $rows =Yii::app()->db->createCommand($sql)->queryAll();
	   return $rows;				
	}
	
	
	
	
	
	
	
	
	
	/*
	
	
	
	
	
	public function getDataimport($id = null)
	{
	   $sql = "select id,code,doc_no,doc_date,";
	   $sql.= "CONCAT(ifnull(date_format(create_date,'%d/%m/'),''),ifnull(date_format(create_date,'%Y')+543,''))as create_date, ";
	   $sql.= "file_name ";
	   $sql.= "from tran_importresult where status!=0 and id='".$id."' ";	   
	   $rows =Yii::app()->db->createCommand($sql)->queryAll();
	   return $rows;
	}*/
	public function Searchform($id = null,$code = null,$keyword = null)
	{
		$dep_id = Yii::app()->user->getInfo('dep_id');
		  $sqlCon="";
		if(Yii::app()->user->getInfo('userlevel_id')=='1')
		{
			
		}else{
			$sqlCon.= " and a.dep_id='$dep_id' ";
		}
		
	 
		
			if($id!=''){	
				$sqlCon.= " and b.bank_id='".$id."' ";		
				$sqlCon.= " and a.code='".$code."' ";				
			}
			if($keyword!=''){	
				$sqlCon.= " and (b.acc_employer like '%".$keyword."%' ";	
				$sqlCon.= " or a.code like '%".$keyword."%' ";
				$sqlCon.= " or b.doc_no like '%".$keyword."%' ";
				$sqlCon.= " or b.name like '%".$keyword."%' ";
				$sqlCon.= " or b.pid like '%".$keyword."%' ";
				$sqlCon.= " or b.acc_no like '%".$keyword."%' ) ";		
			}
		/*
	  
		$count=Yii::app()->db->createCommand("select count(*) from tran_importresult_item a left join tran_importresult b on b.id=a.importresult_id left join tran_request c on c.id=a.request_id where a.status != 0 and a.comment='' ".$sqlCon)->queryScalar();
	
		$sql ="select a.id,b.code,a.doc_no,a.acc_employer,a.business_name, ";
		$sql.="CONCAT(ifnull(date_format(a.doc_date,'%d/%m/'),''),ifnull(date_format(a.doc_date,'%Y')+543,'') )as doc_date, ";
		$sql.="a.pid,a.cid, a.check_status, ";
		
		$sql.="CONCAT(ifnull(a.name,''),' ', ifnull(a.lname,'')) full_name,  ";	
		$sql.="a.mark,a.amont,a.acc_type_id,a.bank_id,a.bank_dep_id,a.bank_dep_name, a.acc_no, a.acc_name, ";
		$sql.="CONCAT(ifnull(date_format(a.request_date,'%d/%m/'),''),ifnull(date_format(a.request_date,'%Y')+543,''),ifnull(date_format(a.request_date,' %T'),'') )as request_date, ";		
		$sql.=" a.remark  ";
		$sql.="from tran_importresult_item a ";
		$sql.="left join tran_importresult b on b.id=a.importresult_id ";
		$sql.="left join tran_request c on c.id=a.request_id ";
		$sql.="where a.status != 0 and a.comment='' ".$sqlCon;
		//echo var_dump($sql);
		//exit;
		*/
		$count=Yii::app()->db->createCommand("select count(*) from tran_request a RIGHT OUTER JOIN tran_request_item b on b.request_id=a.id where a.status=4 ".$sqlCon)->queryScalar();
		$sql =" select  a.id,b.request_id,a.code,b.doc_no,b.acc_employer,b.business_name, ";
		$sql.=" CONCAT(ifnull(date_format(b.doc_date,'%d/%m/'),''),ifnull(date_format(b.doc_date,'%Y')+543,'') )as doc_date,  ";
		$sql.=" b.pid,b.check_status, CONCAT(ifnull(b.name,''),' ', ifnull(b.lname,'')) full_name, ";
		$sql.=" b.mark,b.amont,b.acc_type_id,b.bank_id,b.bank_dep_id,b.bank_dep_name, b.acc_no, b.acc_name, ";
		$sql.=" CONCAT(ifnull(date_format(b.request_date,'%d/%m/'),''),ifnull(date_format(b.request_date,'%Y')+543,''),ifnull(date_format(b.request_date,' %T'),'') )as request_date, b.remark"; 		
		$sql.=" from tran_request a ";
		$sql.=" RIGHT OUTER JOIN tran_request_item b on b.request_id=a.id ";
		$sql.=" where a.status=4 and b.status !=0".$sqlCon;
		$sql.=" ORDER BY a.id ";
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
	
	
	public function getData($id=null,$code=null) 
	{
		 $sqlCon="";
		
			if($id!=''){	
				$sqlCon.= " and a.bank_id='".$id."' ";			
				$sqlCon.= " and a.code='".$code."' ";			
			}
		$sql= "SELECT a.code, a.doc_no, a.bank_id, b.name, ";
		$sql.="CONCAT(ifnull(date_format(a.doc_date,'%d/%m/'),''),ifnull(date_format(a.doc_date,'%Y')+543,'') )as doc_date, ";
		$sql.="CONCAT(ifnull(date_format(a.create_date,'%d/%m/'),''),ifnull(date_format(a.create_date,'%Y')+543,''),ifnull(date_format(a.create_date,' %T'),'') )as create_date ";
		$sql.= "FROM tran_importresult a ";
		$sql.= "JOIN mas_bank b ON a.bank_id = b.code ";
		$sql.= "where a.status='1' ".$sqlCon;		
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;
    }	
	
	
	
	
	
	
	
	
	
	
	
	//Grid ปล่าว
	
	public function getSearch0()
	{
		
		$count=Yii::app()->db->createCommand("select count(*) from tran_request where 1=2")->queryScalar();
		$sql =" select  a.id,b.request_id,a.code,b.doc_no,b.acc_employer,b.business_name, ";
		$sql.=" CONCAT(ifnull(date_format(b.doc_date,'%d/%m/'),''),ifnull(date_format(b.doc_date,'%Y')+543,'') )as doc_date,  ";
		$sql.=" b.pid,b.check_status, CONCAT(ifnull(b.name,''),' ', ifnull(b.lname,'')) full_name, ";
		$sql.=" b.mark,b.amont,b.acc_type_id,b.bank_id,b.bank_dep_id,b.bank_dep_name, b.acc_no, b.acc_name, ";
		$sql.=" CONCAT(ifnull(date_format(b.request_date,'%d/%m/'),''),ifnull(date_format(b.request_date,'%Y')+543,''),ifnull(date_format(b.request_date,' %T'),'') )as request_date, b.remark"; 		
		$sql.=" from tran_request a ";
		$sql.=" RIGHT OUTER JOIN tran_request_item b on b.request_id=a.id ";
		$sql.=" where 1=2 and b.status !=0";
		$sql.=" ORDER BY a.id ";
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
	
	
	
	
	
	public function Searchform0()
	{
		
		$count=Yii::app()->db->createCommand("select count(*) from tran_request where 1=2")->queryScalar();
		$sql =" select  a.id,b.request_id,a.code,b.doc_no,b.acc_employer,b.business_name, ";
		$sql.=" CONCAT(ifnull(date_format(b.doc_date,'%d/%m/'),''),ifnull(date_format(b.doc_date,'%Y')+543,'') )as doc_date,  ";
		$sql.=" b.pid,b.check_status, CONCAT(ifnull(b.name,''),' ', ifnull(b.lname,'')) full_name, ";
		$sql.=" b.mark,b.amont,b.acc_type_id,b.bank_id,b.bank_dep_id,b.bank_dep_name, b.acc_no, b.acc_name, ";
		$sql.=" CONCAT(ifnull(date_format(b.request_date,'%d/%m/'),''),ifnull(date_format(b.request_date,'%Y')+543,''),ifnull(date_format(b.request_date,' %T'),'') )as request_date, b.remark"; 		
		$sql.=" from tran_request a ";
		$sql.=" RIGHT OUTER JOIN tran_request_item b on b.request_id=a.id ";
		$sql.=" where 1=2 and b.status !=0" ;
		$sql.=" ORDER BY a.id ";
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
	public function Searchformhisimport($id = null,$code = null)
	{
		$dep_id = Yii::app()->user->getInfo('dep_id');
		  $sqlCon="";
		if(Yii::app()->user->getInfo('userlevel_id')=='1')
		{
			
		}else{
			$sqlCon.= " and a.dep_id='$dep_id' ";
		}
		
	 
		
			if($id!=''){	
				$sqlCon.= " and b.bank_id='".$id."' ";		
				$sqlCon.= " and a.code='".$code."' ";				
			}
		
		/*
	  
		$count=Yii::app()->db->createCommand("select count(*) from tran_importresult_item a left join tran_importresult b on b.id=a.importresult_id left join tran_request c on c.id=a.request_id where a.status != 0 and a.comment='' ".$sqlCon)->queryScalar();
	
		$sql ="select a.id,b.code,a.doc_no,a.acc_employer,a.business_name, ";
		$sql.="CONCAT(ifnull(date_format(a.doc_date,'%d/%m/'),''),ifnull(date_format(a.doc_date,'%Y')+543,'') )as doc_date, ";
		$sql.="a.pid,a.cid, a.check_status, ";
		
		$sql.="CONCAT(ifnull(a.name,''),' ', ifnull(a.lname,'')) full_name,  ";	
		$sql.="a.mark,a.amont,a.acc_type_id,a.bank_id,a.bank_dep_id,a.bank_dep_name, a.acc_no, a.acc_name, ";
		$sql.="CONCAT(ifnull(date_format(a.request_date,'%d/%m/'),''),ifnull(date_format(a.request_date,'%Y')+543,''),ifnull(date_format(a.request_date,' %T'),'') )as request_date, ";		
		$sql.=" a.remark  ";
		$sql.="from tran_importresult_item a ";
		$sql.="left join tran_importresult b on b.id=a.importresult_id ";
		$sql.="left join tran_request c on c.id=a.request_id ";
		$sql.="where a.status != 0 and a.comment='' ".$sqlCon;
		//echo var_dump($sql);
		//exit;
		*/
		$count=Yii::app()->db->createCommand("select count(*) from tran_request a RIGHT OUTER JOIN tran_request_item b on b.request_id=a.id where a.status=4 ".$sqlCon)->queryScalar();
		$sql =" select  a.id,b.request_id,a.code,b.doc_no,b.acc_employer,b.business_name, ";
		$sql.=" CONCAT(ifnull(date_format(b.doc_date,'%d/%m/'),''),ifnull(date_format(b.doc_date,'%Y')+543,'') )as doc_date,  ";
		$sql.=" b.pid,b.check_status, CONCAT(ifnull(b.name,''),' ', ifnull(b.lname,'')) full_name, ";
		$sql.=" b.mark,b.amont,b.acc_type_id,b.bank_id,b.bank_dep_id,b.bank_dep_name, b.acc_no, b.acc_name, ";
		$sql.=" CONCAT(ifnull(date_format(b.request_date,'%d/%m/'),''),ifnull(date_format(b.request_date,'%Y')+543,''),ifnull(date_format(b.request_date,' %T'),'') )as request_date, b.remark"; 		
		$sql.=" from tran_request a ";
		$sql.=" RIGHT OUTER JOIN tran_request_item b on b.request_id=a.id ";
		$sql.=" where a.status=4 ".$sqlCon;
		$sql.=" ORDER BY a.id ";
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
}	
