<?php

class frm_request extends CFormModel
{
	
	public $id;	
	public $doc_no;
	public $doc_date;
	public $acc_employer;	
	public $pid_type;
	public $business_type;
	public $business_name;
	public $name;
	public $lname;
	public $birth;
	public $pid;
	public $cid;
	public $company;
	public $address;
	public $doc_no_tsd;
	public $zipcode;	
	public $state;
	public $active;
	public $remark;	
	public $emptype;
	
	public function rules()
	{
		return array(
			array('id', 'doc_no', 'doc_date', 'acc_employer', 'pid_type', 'business_type', 'business_name', 'emptype',
				'name', 'lname', 'birth', 'pid', 'cid', 'company', 'address', 'active', 'remark', 'state','zipcode','doc_no_tsd'),				
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
		
		$createby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;
		$dep_id = Yii::app()->user->getInfo('dep_id');
		
		$sqlCon="";
		if($this->pid!=''){
			$sqlCon.=" and (pid='".$this->pid."' or cid='".$this->pid."') ";
		}
		if($this->cid!=''){
			$sqlCon.=" and (cid='".$this->cid."' or pid='".$this->cid."') ";
		}
		$sql ="select count(*) as aa from tran_request where status not in (0,2,4) and acc_employer='".$this->acc_employer."' ".$sqlCon;
		//echo var_dump($sql);exit;
	   	$data =Yii::app()->db->createCommand($sql)->queryAll();
		foreach($data as $dataitem){
			if ($dataitem['aa']>0){
				Yii::app()->session['errmsg_request']='มีข้อมูลนี้ในระบบแล้ว';
				return false;
				}
			}		
		
		//save
		$businessname="";	
		/*	
		$type_id = Yii::app()->params['data_ctrl']['businesstype']['othtr'];
		if($this->business_type==$type_id){
			$businessname=$this->business_name;
		}else{
			$sql ="select name from mas_businesstype where status!=0 and id='".$this->business_type."' ";
			$data =Yii::app()->db->createCommand($sql)->queryAll();
				foreach($data as $dataitem){
					$businessname=$dataitem['name'];						
				}
		}*/
		$sql ="select name from mas_businesstype where status!=0 and id='".$this->business_type."' ";
		$data =Yii::app()->db->createCommand($sql)->queryAll();
		foreach($data as $dataitem){
			$businessname=$dataitem['name'];						
		}
		
		$sql = "INSERT INTO tran_request ";
		$sql.= "(doc_no,doc_date,acc_employer,emp_type,business_type,business_name,pid_type,company_name,name,lname, ";
		$sql.= "birth,pid,cid,address,dep_id,create_date,create_by) ";
		$sql.= "VALUES ";
		$sql.= "(:doc_no,:doc_date,:acc_employer,:emptype,:business_type,:business_name,:pid_type,:company,:name,:lname,";
		$sql.= ":birth,:pid,:cid,:address,$dep_id,now(),$createby)";
		$command=yii::app()->db->createCommand($sql);		
		$command->bindValue(":doc_no", $this->doc_no);	
		$command->bindValue(":doc_date", $this->doc_date);		
		$command->bindValue(":acc_employer", $this->acc_employer);	
		$command->bindValue(":emptype", $this->emptype);	
		$command->bindValue(":business_type", $this->business_type);
		$command->bindValue(":business_name", $businessname);	
		$command->bindValue(":pid_type", $this->pid_type);	
		$command->bindValue(":name", $this->name);
		$command->bindValue(":lname", $this->lname);				
		$command->bindValue(":birth", $this->birth);	
		$command->bindValue(":pid", $this->pid);
		$command->bindValue(":company", $this->company);
		$command->bindValue(":cid", $this->cid);		
		$command->bindValue(":address", $this->address);	
		
		if($command->execute()) {			
			$id = Yii::app()->db->getLastInsertID();	
			
			//echo var_dump($id);exit;
			$user = Yii::app()->user->getInfo('username');			
			Yii::app()->CommonFnc->log_request($id, "Add", $user);
			$sql1 = "INSERT INTO tran_request_tsd ";
			$sql1.= "(doc_no,bank_request_id,doc_date,acc_employer,emp_type,business_type,business_name,pid_type,company_name,name,lname,zipcode, ";
			$sql1.= "birth,pid,cid,address,dep_id,create_date,create_by) ";
			$sql1.= "VALUES ";
			$sql1.= "(:doc_no,:bank_request_id,:doc_date,:acc_employer,:emptype,:business_type,:business_name,:pid_type,:company,:name,:lname,:zipcode,";
			$sql1.= ":birth,:pid,:cid,:address,$dep_id,now(),$createby)";
			$command=yii::app()->db->createCommand($sql1);
			$command->bindValue(":bank_request_id",$id);		
			$command->bindValue(":doc_no", $this->doc_no_tsd);	
			$command->bindValue(":doc_date", $this->doc_date);		
			$command->bindValue(":acc_employer", $this->acc_employer);	
			$command->bindValue(":emptype", $this->emptype);	
			$command->bindValue(":business_type", $this->business_type);
			$command->bindValue(":business_name", $businessname);	
			$command->bindValue(":pid_type", $this->pid_type);	
			$command->bindValue(":name", $this->name);
			$command->bindValue(":lname", $this->lname);				
			$command->bindValue(":birth", $this->birth);	
			$command->bindValue(":pid", $this->pid);
			$command->bindValue(":company", $this->company);
			$command->bindValue(":cid", $this->cid);		
			$command->bindValue(":address", $this->address);	
			$command->bindValue(":zipcode", $this->zipcode);
			
			if($command->execute()) {			
				$id = Yii::app()->db->getLastInsertID();	
				
				//echo var_dump($id);exit;
				
				$user = Yii::app()->user->getInfo('username');			
				Yii::app()->CommonFnc->log_request($id, "Add", $user);
				return true;
			} else { 
				Yii::app()->session['errmsg_request']='เกิดข้อผิดพลาดบันทึกไม่สำเร็จ';
				return false;
			}			

		//	return true;
		} else { 
			Yii::app()->session['errmsg_request']='เกิดข้อผิดพลาดบันทึกไม่สำเร็จ';
			return false;
		}
		
	
	}	

	public function save_update()
	{
		/*
			$sql ="select count(*) as aa from mas_department where status=1 and name='".$this->name."' and id!='".$this->id."' and code='".$this->code."' ";
			$data =Yii::app()->db->createCommand($sql)->queryAll();
			foreach($data as $dataitem){
				if ($dataitem['aa']>0){
					Yii::app()->session['errmsg_user']='มีข้อมูลนี้ในระบบแล้ว';
					return false;
					}
				}
				*/		
			$sqlCon="";
			if($this->pid!=''){
				$sqlCon.=" and pid='".$this->pid."' ";
			}
			if($this->cid!=''){
				$sqlCon.=" and cid='".$this->cid."' ";
			}
			$sql ="select count(*) as aa from tran_request where status not in (0,2,4) and acc_employer='".$this->acc_employer."' and id!='".$this->id."' ".$sqlCon;
			$data =Yii::app()->db->createCommand($sql)->queryAll();
			foreach($data as $dataitem){
				if ($dataitem['aa']>0){
					Yii::app()->session['errmsg_request']='มีข้อมูลนี้ในระบบแล้ว';
					return false;
					}
				}
		//save
			$businessname="";
			/*
			$type_id = Yii::app()->params['data_ctrl']['businesstype']['othtr'];
			if($this->business_type==$type_id){
				$businessname=$this->business_name;
			}else{
				$sql ="select name from mas_businesstype where status!=0 and id='".$this->business_type."' ";
				$data =Yii::app()->db->createCommand($sql)->queryAll();
					foreach($data as $dataitem){
						$businessname=$dataitem['name'];						
					}
			}*/
			$sql ="select name from mas_businesstype where status!=0 and id='".$this->business_type."' ";
			$data =Yii::app()->db->createCommand($sql)->queryAll();
			foreach($data as $dataitem){
				$businessname=$dataitem['name'];						
			}
		
			$updateby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;		
			//$dep_id = Yii::app()->user->getInfo('dep_id');
		
			$sql = "update tran_request set ";
			$sql.= " doc_no=:doc_no,doc_date=:doc_date, acc_employer=:acc_employer,emp_type=:emptype,business_type=:business_type, ";
			$sql.= "business_name=:business_name,pid_type=:pid_type,name=:name,lname=:lname,birth=:birth, ";
			$sql.= "pid=:pid,cid=:cid,company_name=:company,address=:address, ";
			$sql.= "status=:active,remark=:remark, ";
			$sql.= "update_date=now(), update_by=$updateby where id='".$this->id."'";
			$command=yii::app()->db->createCommand($sql);			
			$command->bindValue(":doc_no", $this->doc_no);	
			$command->bindValue(":doc_date", $this->doc_date);		
			$command->bindValue(":acc_employer", $this->acc_employer);	
			$command->bindValue(":emptype", $this->emptype);	
			$command->bindValue(":business_type", $this->business_type);
			$command->bindValue(":business_name", $businessname);	
			$command->bindValue(":pid_type", $this->pid_type);	
			$command->bindValue(":name", $this->name);
			$command->bindValue(":lname", $this->lname);				
			$command->bindValue(":birth", $this->birth);	
			$command->bindValue(":pid", $this->pid);
			$command->bindValue(":company", $this->company);
			$command->bindValue(":cid", $this->cid);		
			$command->bindValue(":address", $this->address);
			
			$command->bindValue(":active", $this->active);	
			$command->bindValue(":remark", $this->remark);	
				
				
			if($command->execute()) {
				$id = $this->id;
				$user = Yii::app()->user->getInfo('username');			
				Yii::app()->CommonFnc->log_request($id, "Update", $user);
				//
				$sql = "update tran_request_tsd set ";
				$sql.= " doc_no=:doc_no,doc_date=:doc_date, acc_employer=:acc_employer,emp_type=:emptype,business_type=:business_type, ";
				$sql.= "business_name=:business_name,pid_type=:pid_type,name=:name,lname=:lname,birth=:birth, ";
				$sql.= "pid=:pid,cid=:cid,company_name=:company,address=:address, ";
				$sql.= "status=:active,remark=:remark, ";
				$sql.= "update_date=now(), update_by=$updateby where bank_request_id='".$this->id."'";
				$command=yii::app()->db->createCommand($sql);			
				$command->bindValue(":doc_no", $this->doc_no_tsd);	
				$command->bindValue(":doc_date", $this->doc_date);		
				$command->bindValue(":acc_employer", $this->acc_employer);	
				$command->bindValue(":emptype", $this->emptype);	
				$command->bindValue(":business_type", $this->business_type);
				$command->bindValue(":business_name", $businessname);	
				$command->bindValue(":pid_type", $this->pid_type);	
				$command->bindValue(":name", $this->name);
				$command->bindValue(":lname", $this->lname);				
				$command->bindValue(":birth", $this->birth);	
				$command->bindValue(":pid", $this->pid);
				$command->bindValue(":company", $this->company);
				$command->bindValue(":cid", $this->cid);		
				$command->bindValue(":address", $this->address);
				$command->bindValue(":active", $this->active);	
				$command->bindValue(":remark", $this->remark);					
						if($command->execute()) {
							$id = $this->id;
							$user = Yii::app()->user->getInfo('username');			
							Yii::app()->CommonFnc->log_request($id, "Update", $user);
							//
							return true;
						} else {
							Yii::app()->session['errmsg_request']='ไม่สามารถลบข้อมูลได้'.$sql;
							return false;
					}		
				} else {
					Yii::app()->session['errmsg_request']='ไม่สามารถลบข้อมูลได้'.$sql;
					return false;
				}
		
	}
	
	public function save_delete()
	{
		
		$updateby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;	
		$sql = "update tran_request set status=0, update_date=now(), update_by=$updateby where id='".$this->id."'";
		$command=yii::app()->db->createCommand($sql);			
			if($command->execute()) {
				$id = $this->id;
				$user = Yii::app()->user->getInfo('username');			
				Yii::app()->CommonFnc->log_request($id, "Delete", $user);
				return true;
			} else {
				Yii::app()->session['errmsg_request']='ไม่สามารถลบข้อมูลได้'.$sql;
				return false;
		}	
	}
	
		
}
