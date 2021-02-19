<?php

class frm_investigate extends CFormModel	  
{
	public $id;
	public $doc_no;
	public $doc_date;	
	public $con_st;
	public $con_en;
	public $cntmin;	
	public $cntmax;
	public $cnt;	
	public $filename;
	public $jobbns;
	
	public function rules()
	{
		return array(
			array('doc_no', 'doc_date', 'con_st', 'con_en', 'cntmin', 'cntmax', 'cnt', 'jobbns', 'safe'),				
		);
	}

	public function attributeLabels()
	{
		return array(

		);
	}
	
	

	public function save_insert()
	{
		//check error
		//เช็คว่ามีข้อมูลหรือไม่
		
		//save
		//Yii::app()->session['aa']=$fullpath.'\\'.$name;
		$createby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;	
		//if($this->jobbns==''){$this->jobbns='0'}else{$this->jobbns}
		$jobbns = $this->jobbns;
		if($this->jobbns==""){
			$this->jobbns=0;
		}else{
			$this->jobbns;
		}
		
		/*
		$code_prefix = substr(date("Y")+543,-2);		
		$sql="select ((year(now())+543)) year from tran_exportreq where id=1 ";
		//$sql="select ifnull(fiscalyear,(year(now())+543)) year from mas_assetspec where id='".$this->idspec."'";
	   	$data =Yii::app()->db->createCommand($sql)->queryAll();
		foreach($data as $dataitem){
			if($dataitem['year']!=''){
				$code_prefix = substr($dataitem['year'],-2);
			}
		}	

		$code_new=$code_prefix.'001';
		//$sql="select lpad(substr(max(barcode),4,6)+1,6,'0') as code from mas_asset where barcode like '".$code_prefix."%'";
		$sql="select lpad(substr(max(code),4,3)+1,3,'0') as code from tran_exportreq where code like '".$code_prefix."%'";
	   	$data =Yii::app()->db->createCommand($sql)->queryAll();
		foreach($data as $dataitem){
			if($dataitem['code']==''){
				if($code_prefix=='60'){
					$code_new = $code_prefix.'022';
				} else {
					$code_new = $code_prefix.'001';
				}
			} else {
				$code_new = $code_prefix.$dataitem['code'];
			}
		}	
		*/
 		
		$code_new='';
		$data=lookupdata::getCode();
		foreach($data as $dataitem) {
		   $code_new = $dataitem['code'];

		} 
		
		$sql = "insert into tran_file (object_group,object_type,create_date,create_by) ";
		$sql.= "VALUES(:object_group,:object_type,now(),$createby)";
		$command=yii::app()->db->createCommand($sql);
		$command->bindValue(":object_group", "Export");
		$command->bindValue(":object_type", "Pre");
		if($command->execute()) {		
			$file_id = Yii::app()->db->getLastInsertID();
			Yii::app()->session['file_id'] = $file_id;
			
			$sql = "INSERT INTO tran_exportreq (code,doc_no,doc_date,con_st,con_en,min_id,max_id,cnt,file_id,create_type,create_date,create_by) ";
			$sql.= "VALUES(:code,:doc_no,:doc_date,:con_st,:con_en,:cntmin,:cntmax,:cnt,:file_id,:create_type,now(),$createby)";
			$command=yii::app()->db->createCommand($sql);		
			$command->bindValue(":code", $code_new);
			$command->bindValue(":doc_no", $this->doc_no);
			$command->bindValue(":doc_date", $this->doc_date);
			$command->bindValue(":con_st", $this->con_st);
			$command->bindValue(":con_en", $this->con_en);
			$command->bindValue(":cntmin", $this->cntmin);	
			$command->bindValue(":cntmax", $this->cntmax);	
			$command->bindValue(":cnt", $this->cnt);	
			$command->bindValue(":file_id", $file_id);
			$command->bindValue(":create_type", $this->jobbns);
			
			if($command->execute()) {
				$id = Yii::app()->db->getLastInsertID();
				
				Yii::app()->session['id'] = $id;
				
				$sql = "update tran_request set code=:code, status=2, update_date=now(), update_by=$createby ";
				$sql.= "where status=1 and (id>='".$this->cntmin."' and id<='".$this->cntmax."') ";
				$command=yii::app()->db->createCommand($sql);
				$command->bindValue(":code", $code_new);				
				if($command->execute()) {
					
					//$ids = Yii::app()->db->getLastInsertID();
					$sql = "insert into tran_exportreq_item (exportreq_id,code,doc_no,doc_date,acc_employer,business_type, ";
					$sql.= "business_name,request_id, ";
					$sql.= "pid_type,company_name,name,lname,pid,cid,birth,address,dep_id,remark,create_date,create_by) ";
					$sql.= "select '".$id."',:code,:doc_no,:doc_date,acc_employer,business_type,business_name,id,";
					$sql.= "pid_type,company_name,name,lname,pid,cid,birth,address,dep_id,remark,now(),$createby ";
					$sql.= "from tran_request ";			
					$sql.= "where status=2 and (id>='".$this->cntmin."' and id<='".$this->cntmax."') and code='".$code_new."' ";
					$command=yii::app()->db->createCommand($sql);
					$command->bindValue(":code", $code_new);
					$command->bindValue(":doc_no", $this->doc_no);
					$command->bindValue(":doc_date", $this->doc_date);
					if($command->execute()) {
					
						//$id = Yii::app()->db->getLastInsertID();				
					//	return true;
					}else { 
						Yii::app()->session['errmsg_investigate']='เกิดข้อผิดพลาดบันทึก1'.$sql;
						return false;
					}				
						
					return true;
				}else { 
					Yii::app()->session['errmsg_investigate']='เกิดข้อผิดพลาดบันทึก2'.$sql;
					return false;
				}			
				
				return true;
			} else { 
				Yii::app()->session['errmsg_investigate']='เกิดข้อผิดพลาดบันทึกไม่สำเร็จ3'.$sql;
				return false;
			}
			
							
			return true;
		}else { 
			Yii::app()->session['errmsg_investigate']='เกิดข้อผิดพลาดบันทึก4'.$sql;
			return false;
		}
		
		
			
		


	}	
	/*
	public function save_file()
	{
		$sql = "update tran_exportreq set file_name=:filename ";
		$sql.= "where id='".Yii::app()->session['id']."' ";
		$command=yii::app()->db->createCommand($sql);
		$command->bindValue(":filename", $this->filename);				
		if($command->execute()) {
				Yii::app()->session->remove('id');
				return true;
			} else {
				Yii::app()->session['errmsg_investigate']='ไม่สามารถบันทึกข้อมูลได้'.$sql;
				Yii::app()->session->remove('id');
				return false;
		}
	}
	
	
	
	*/
	
	
	public function save_update()
	{
			
			$sql ="select count(*) as aa from mas_transfer where status=1 and name='".$this->name."' and id!='".$this->id."'";
			$data =Yii::app()->db->createCommand($sql)->queryAll();
			foreach($data as $dataitem){
				if ($dataitem['aa']>0){
					Yii::app()->session['errmsg_investigate']='มีข้อมูลนี้ในระบบแล้ว';
					return false;
					}
				}		
		
		//save
		
			$updateby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;		
		
			$sql = "update mas_transfer set name=:name, update_date=now(), update_by=$updateby where id='".$this->id."'";
			$command=yii::app()->db->createCommand($sql);			
			$command->bindValue(":name", addslashes($this->name));				
				if($command->execute()) {
					return true;
				} else {
					Yii::app()->session['errmsg_investigate']='ไม่สามารถบันทึกข้อมูลได้'.$sql;
					return false;
			}	
	}
	public function save_delete()
	{
		
			$updateby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;	
			$sql = "update mas_transfer set status=0, update_date=now(), update_by=$updateby where id='".$this->id."'";
			$command=yii::app()->db->createCommand($sql);			
				if($command->execute()) {
					return true;
				} else {
					Yii::app()->session['errmsg_investigate']='ไม่สามารถลบข้อมูลได้'.$sql;
					return false;
			}	
	}
		
}
