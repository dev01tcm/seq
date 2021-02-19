<?php

class frm_import extends CFormModel
{	
	public $name;
	public $size;	
	public $path;
	public $url;
	public $save_path;
	public $save_url;
	public $type;
	public $closepath;
	
	
	
	public function rules()
	{
		return array(
			array('code', 'name', 'size', 'closepath', 'path', 'url',  'save_path', 'save_url', 'type', 'safe'),				
		);
	}

	public function attributeLabels()
	{
		return array(

		);
	}
	
	public function save_import()
	{
		$i=0;
		$fullpath = $this->path;
		$closepath = $this->closepath;
		$save_path = $this->save_path;
		$save_url = $this->save_url;
		$sum = count($this->name);
		while($i < $sum){			
			if($this->name[$i]!=""){
				$file_name = $this->name[$i];
				$createby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;		
				$inputFileName = $fullpath.$closepath.$file_name;
				
				//echo var_dump($inputFileName);
				//exit;
				
					if(file_exists($inputFileName))
					{
						
						$exp = explode('.' , $file_name);
						$filename = substr($file_name, 0 , -(strlen($exp[count($exp)-1])+1));
						$ext = $exp[count($exp)-1];
						$filename = substr($filename,0,80);	
						$FileName = $filename.".".$ext;	 
					}
					$sql ="select count(*) as aa from tran_file a ";
					$sql.="where name='".$file_name."' ";					
					$data =Yii::app()->db->createCommand($sql)->queryAll();
					foreach($data as $dataitem)
					{
						if ($dataitem['aa']==0)
						{								
							if($this->type[$i]=="pdf" || $this->type[$i]=="png" || $this->type[$i]=="jpg" || $this->type[$i]=="jpeg" || $this->type[$i]=="txt" || $this->type[$i]=="xls" || $this->type[$i]=="xlsx" || $this->type[$i]=="doc" || $this->type[$i]=="docx" || $this->type[$i]=="rar" || $this->type[$i]=="zip" || $this->type[$i]=="7z"){
								$sql = "INSERT INTO tran_file (name,object_group,object_type,object_id,upload_path,upload_url,file_size, ";
								$sql.= "file_type,create_date,create_by) ";
								$sql.= "VALUES(:name,:object_group,:object_type,:object_id,:fullpath,:fullurl,:size,:type,now(),$createby) ";
								$command=yii::app()->db->createCommand($sql);		
								$command->bindValue(":name", $this->name[$i]);
								$command->bindValue(":object_group", "Import");
								$command->bindValue(":object_type", "Book");
								$command->bindValue(":object_id", Yii::app()->session['id_import']);
								//Yii::app()->session['id_import']
								$command->bindValue(":size", $this->size[$i]);
								$command->bindValue(":fullpath", $save_path);
								$command->bindValue(":fullurl", $save_url);
								$command->bindValue(":type", '.'.$this->type[$i]);
								if($command->execute()){
									//$id = Yii::app()->db->getLastInsertID();
									//Yii::app()->session->remove('id_import');
									
								}else{
									Yii::app()->session['errmsg_import']='error PDF'.$sql;
									return false;							
								}
								if(file_exists($inputFileName))
								{
									rename ($inputFileName, Yii::app()->params['prg_ctrl']['path']['media'].Yii::app()->params['prg_ctrl']['path']['closepath'].$FileName);
								}									
							}
						}
					}	
			}
			$i++;
			
			
		}
				
		return true;
	

	}
	
//public function save_insert($name=null, $fullpath=null, $fullurl=null, $size=null, $type=null)
	public function save_insert()
	{
		
		$x=0;
		$closepath = $this->closepath;
		$fullpath = $this->path;
		$fullurl = $this->url;
		$save_path = $this->save_path;
		$save_url = $this->save_url;
		$size=$this->size[$x]; 
		$type=$this->type[$x];
		$sum = count($this->name);				
		$createby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;	
		
		$file_name=$this->name[$x];	
		$inputFileName = $fullpath.$closepath.$file_name;
		
		$saveid="";
		$chk_id=false;
		//echo var_dump($type);exit;
		ini_set('max_execution_time', 300);
		if($type=="txt" || $type=="TXT")
		{
			
			if(file_exists($inputFileName))
			{
				
				$exp = explode('.' , $file_name);
				$filename = substr($file_name, 0 , -(strlen($exp[count($exp)-1])+1));
				$ext = $exp[count($exp)-1];
				$filename = substr($filename,0,80);	
				$FileName = $filename.".".$ext;	 
			}
			
			
			
			$handle = fopen($inputFileName, 'r');
			
			$i = 0;
			if ($handle) 
			{
				while (($buffer = fgets($handle, 4096)) !== false)
				{	
					if (mb_check_encoding(file_get_contents($inputFileName), 'UTF-8')) {
							
						Yii::app()->session['errmsg_import']='ประเภท Encoding ของไฟล์เป็น UTF-8 กรุณาบันทึกเป็น ANSI หรือแปลงไฟล์';
						return false;
					}
					$ck_data = strlen(trim($buffer, " "));
					if($ck_data != 465)
					{
						Yii::app()->session['errmsg_import']='ข้อมูลในไฟล์มีขนาดเกินกว่าความยาวที่กำหนด กรุณาตรวจสอบไฟล์ที่นำเข้าหรือแปลงไฟล์';
						return false;
					}
					if($ck_data == 465)
					{	
						//ini_set('max_execution_time', 90);
						$chkmsg="";
						
						$code = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 0, 5));						
						$doc_no = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 5, 20));											
						$ltexp_date = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 25, 10));
						$ltexp_date = DMYth2YMD('/',$ltexp_date,'-');	
						$doc_date = $ltexp_date;			
						$acc_employer = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 35, 10));
						$business_name = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 45, 20));
						$name = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 65, 50));
						$lname = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 115, 50));
						$pid = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 165, 20));						
						$bank_id = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 185, 3));						
						$bank_dep_id = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 188, 4));	
						$check_status = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 192, 1));				
						$bank_dep_name = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 193, 50));
						$acc_type_id = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 243, 2));
						$acc_no = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 245, 20));
						$acc_name = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 265, 100));					
						$mark = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 365, 1));						
						$amont = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 366, 17));	
						$request_date = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 383, 30));
						$remark = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 413, 50));												
						//$remark = iconv_substr($buffer, 413,50, "UTF-8");
						
						$code = trim($code, " ");
						$acc_employer = trim($acc_employer, " ");
						$pid = trim($pid, " ");					
						$bank_id = trim($bank_id, " ");			
						$bank_dep_id = trim($bank_dep_id, " ");
						$check_status = trim($check_status, " ");
						$bank_dep_name = trim($bank_dep_name, " ");
						$acc_type_id = trim($acc_type_id, " ");
						$acc_no = trim($acc_no, " ");
						$acc_name = trim($acc_name, " ");
						$amont = trim($amont, " ");
						$amont = str_replace(',', '', $amont);	
						
						
						
						if ($code == "")
						{
							$chkmsg = $chkmsg. "เลขชุดหนังสือเป็นค่าว่าง, ";
						}else{
							$ck_code = mb_strlen($code, 'UTF-8');
							if($ck_code>=5)
							{							
								$sql =" select count(*) as aa from tran_request a ";
								$sql.=" where code='".$code."' ";//and status=2 ";
								
								$data =Yii::app()->db->createCommand($sql)->queryAll();
								foreach($data as $dataitem)
								{
									if ($dataitem['aa']==0)
									{
										$chkmsg = $chkmsg. "เลขชุดหนังสือไม่มีในระบบ, ";
										//$code="00000";
									}
								}
							}						
						}
						if ($doc_no == "")
						{					
							$chkmsg = $chkmsg. "เลขที่หนังสือเป็นค่าว่าง, ";					
						}else{
							$ck_docno = mb_strlen($doc_no, 'UTF-8');
							if($ck_docno>20)
							{
								$doc_no="00000";
							}
						}
						
						if ($doc_date == "")
						{					
							$chkmsg = $chkmsg. "วันที่หนังสือเป็นค่าว่าง, ";					
						}
						
						if ($acc_employer == "")
						{
							$chkmsg = $chkmsg. "เลขทะเบียนนายจ้างเป็นค่าว่าง, ";
						}
						if ($business_name == "")
						{					
							$chkmsg = $chkmsg. "คำนำหน้าชื่อหรือประเภทธุรกิจค่าว่าง, ";					
						}
						
						if ($name == "" && $lname == "")
						{
							$chkmsg = $chkmsg. "ชื่อ หรือ นามสกุลเป็นเป็นค่าว่าง, ";
						}
						
						if ($pid == "" )
						{					
							$chkmsg = $chkmsg. "เลขบัตประชาชน/เลขทะเบียนพาณิชย์เป็นค่าว่าง, ";					
						}	
						
						if ($bank_id == "")
						{					
							$bank_id=null;	
							$chkmsg = $chkmsg. "รหัสธนาคารเป็นค่าว่าง, ";					
						}else{
							$ck_bank_id = mb_strlen($bank_id, 'UTF-8');
							if($ck_bank_id > 3)
							{
								$bank_id=null;
								$chkmsg = $chkmsg. "รหัสธนาคารไม่ถูกต้อง, ";	
							}						
						}
						
						if ($bank_dep_id == "")
						{				
							$bank_dep_id=null;	
							//$chkmsg = $chkmsg. "รหัสสาขาเป็นค่าว่าง, ";					
						}else{
							$ck_bank_dep_id = mb_strlen($bank_dep_id, 'UTF-8');
							if($ck_bank_dep_id > 4)
							{
								$bank_dep_id=null;
								$chkmsg = $chkmsg. "รหัสสาขาไม่ถูกต้อง, ";	
							}
							
						}
						if ($acc_type_id == "")
						{					
							$acc_type_id='';
							//$chkmsg = $chkmsg. "รหัสประเภทบัญชีเป็นค่าว่าง, ";					
						}else{
							$ck_acctypeid = mb_strlen($acc_type_id, 'UTF-8');
							if($ck_acctypeid > 2)
							{
								$acc_type_id='';
								$chkmsg = $chkmsg. "รหัสประเภทบัญชีไม่ถูกต้อง, ";	
							}						
						}
						if ($acc_no == "")
						{					
							$acc_no='';
							//$chkmsg = $chkmsg. "เลขที่บัญชีเป็นค่าว่าง, ";					
						}else{
							$ck_acc_no = mb_strlen($acc_no, 'UTF-8');
							if($ck_acc_no > 20)
							{
								$acc_no='';
								$chkmsg = $chkmsg. "เลขที่บัญชีไม่ถูกต้อง, ";	
							}
							
						}
						if ($check_status== "")
						{
							$check_status=null;
							$chkmsg = $chkmsg. "สถานะตรวจสอบเป็นค่าว่าง, ";						
						}
						if($check_status=="1")
						{
							if($bank_dep_id=="")
							{
								$chkmsg = $chkmsg. "รหัสสาขาเป็นค่าว่าง, ";
							}
						}
						if ($acc_name == "")
						{					
							$acc_name='';
							//$chkmsg = $chkmsg. "ชื่อบัญชีเป็นค่าว่าง, ";					
						}
						if ($mark == "")
						{					
							//$chkmsg = $chkmsg. "เครื่องหมายจำนวนเงินเป็นค่าว่าง, ";					
						}
						if ($amont == "")
						{					
							$amont = 0;					
						}
						
						if ($request_date == "")
						{					
							$chkmsg = $chkmsg. "วันเวลาที่ตรวจสอบเป็นค่าว่าง ";				
						}else{
							$ck_requestdate = substr_count($request_date, ':');
							if($ck_requestdate=="2")
							{		
								$sub_file = substr($FileName,0,8);
								
								if($bank_id!="002")
								{
									$data_date = (date_parse_from_format('d/m/Y H:i:s', $request_date));			
									$year = $data_date['year'];
									if($year<2500)
									{
										$request_date="0000-00-00 00:00:00";	
										$chkmsg = $chkmsg. "วันเวลาที่ตรวจสอบ Format ไม่ถูกต้อง, ";
									}else{
										$year = $data_date['year']-543;						
										$mount = "-".$data_date['month']."-".$data_date['day']." ".$data_date['hour'] ;
										$mount.= ":".$data_date['minute'].":".$data_date['second'];	
										$request_date = $year.$mount;
									}
								}else{
									$PHPDateTimeObject = PHPExcel_Shared_Date::ExcelToPHPObject($request_date);					
									$year = $PHPDateTimeObject->format('Y')-543 ;
									$mount = $PHPDateTimeObject->format('-m-d H:i:s');
									$request_date = $year.$mount;
								}
								
								
							}else{
								$request_date="0000-00-00 00:00:00";	
								$chkmsg = $chkmsg. "วันเวลาที่ตรวจสอบ Format ไม่ถูกต้อง, ";
								
							}								
						}
						
						//echo var_dump($request_date);exit;									
						$sql ="select count(*) as aa from tran_file where name='".$file_name."' ";												
						$data =Yii::app()->db->createCommand($sql)->queryAll();
						foreach($data as $dataitem)
						{
							if ($dataitem['aa']>0){
								//$doc_code;
							}else{
								
								$sql = "INSERT INTO tran_file (name,object_group,object_type,upload_path,upload_url,file_size, ";
								$sql.= "file_type,create_date,create_by) ";
								$sql.= "VALUES(:name,:object_group,:object_type,:upload_path,:upload_url,:size,:type,now(),$createby) ";
								$command=yii::app()->db->createCommand($sql);		
								$command->bindValue(":name", $file_name);
								$command->bindValue(":object_group", "Import");
								$command->bindValue(":object_type", "Bank");
								//$command->bindValue(":object_id", Yii::app()->session['object_id']);
								$command->bindValue(":size", $size);
								$command->bindValue(":upload_path", $save_path);
								$command->bindValue(":upload_url", $save_url);
								$command->bindValue(":type", '.'.$type);
								if($command->execute()){
									$file_id = Yii::app()->db->getLastInsertID();
								}else { 
									Yii::app()->session['errmsg_import']='เกิดข้อผิดพลาดบันทึก11'.$sql;
									return false;
								}
							}
						}
						
						//echo var_dump($save_path);
						//exit;
						$sql ="select count(*) as aa from tran_importresult where file_id='".$file_id."'   ";
						$data =Yii::app()->db->createCommand($sql)->queryAll();
						foreach($data as $dataitem)
						{
							if ($dataitem['aa']>0){
								//$doc_code;
							}else{
								$sql = "INSERT INTO tran_importresult ";
								$sql.= "(file_id,code,doc_no,doc_date,bank_id,create_date,create_by) ";				
								$sql.= "VALUES(:file_id,:code,:doc_no,:doc_date,:bank_id,now(),$createby) ";
								$command=yii::app()->db->createCommand($sql);
								$command->bindValue(":file_id", $file_id);
								$command->bindValue(":code", $code);
								$command->bindValue(":doc_no", $doc_no);
								$command->bindValue(":doc_date", $doc_date);					
								$command->bindValue(":bank_id", $bank_id);
								if($command->execute()) {
									$doc_code = Yii::app()->db->getLastInsertID();
									Yii::app()->session['id_import']=$doc_code;
									$sql = "update tran_file set object_id='".$doc_code."' where  id='".$file_id."' and object_group='Import' ";									
									$command=yii::app()->db->createCommand($sql);
									if($command->execute()) {
										//$id = Yii::app()->db->getLastInsertID();				
										//return true;
									}else{ 
										Yii::app()->session['errmsg_import']='เกิดข้อผิดพลาดบันทึก12'.$sql;
										return false;
									}								
								}else { 
									Yii::app()->session['errmsg_import']='เกิดข้อผิดพลาดบันทึก13'.$sql;
									return false;
								}
							}
						}
						
						////////////ผ่าน		
						$request_id='';
						$request_code='';
						
						$sql ="select id, code from tran_request where code='".$code."' and acc_employer='".$acc_employer."' and ";
						$sql.="(pid='".$pid."' or cid='".$pid."')  and status!=0 ";	/// s<>0
						$data =Yii::app()->db->createCommand($sql)->queryAll();
						foreach($data as $dataitem)
						{
							$request_id=$dataitem['id'];
							$request_code=$dataitem['code'];
						}
						
						
						if ($request_id=='')
						{
							$chkmsg = $chkmsg. "ไม่พบข้อมูลนี้ในระบบ, ";
							$sql = "INSERT INTO tran_importresult_item ";
							$sql.= "(importresult_id,doc_no,doc_date,acc_employer,business_name,name,lname,pid,bank_id, ";
							$sql.= "bank_dep_id,check_status,bank_dep_name,acc_type_id,acc_no,acc_name,mark,amont,remark,comment, ";
							$sql.= "request_date,create_date,create_by) ";
							$sql.= "VALUES(:code,:doc_no,:doc_date,:acc_employer,:business_name,:name,:lname,:pid,:bank_id,";
							$sql.= ":bank_dep_id,:check_status,:bank_dep_name,:acc_type_id,:acc_no,:acc_name,:mark,:amont, ";
							$sql.= ":remark,:comment,:request_date,now(),$createby) ";
							$command=yii::app()->db->createCommand($sql);		
							$command->bindValue(":code", $doc_code);
							$command->bindValue(":doc_no", $doc_no);
							$command->bindValue(":doc_date", $doc_date);	
							$command->bindValue(":acc_employer", $acc_employer);
							$command->bindValue(":business_name", $business_name);
							//$command->bindValue(":prefix", $prefix);
							$command->bindValue(":name", $name);
							$command->bindValue(":lname", $lname);
							$command->bindValue(":pid", $pid);
							//$command->bindValue(":cid", $cid);
							$command->bindValue(":bank_id", $bank_id);				
							$command->bindValue(":bank_dep_id", $bank_dep_id); 
							$command->bindValue(":check_status", $check_status);
							$command->bindValue(":bank_dep_name", $bank_dep_name);
							$command->bindValue(":acc_type_id", $acc_type_id);
							$command->bindValue(":acc_no", $acc_no);
							$command->bindValue(":acc_name", $acc_name);
							$command->bindValue(":mark", $mark);
							$command->bindValue(":amont", $amont);
							$command->bindValue(":request_date", $request_date);
							$command->bindValue(":remark", $remark);				
							$command->bindValue(":comment", $chkmsg);
							if($command->execute()) {
							
							} else {
								Yii::app()->session['errmsg_import']='ไม่สามารถบันทึกข้อมูลได้'.$sql;
								return false;
							}
						}else{
							
							//เช็คซ้ำ
							/*
							$sql ="select count(*) as aa from tran_importresult_item a ";
							$sql.="left join tran_importresult b on b.id=a.importresult_id ";
							$sql.="where ";
							$sql.="b.code='".$code."' and a.acc_employer='".$acc_employer."' and a.bank_id='".$bank_id."' and a.acc_no='".$acc_no."' and ";
							$sql.=" (a.pid='".$pid."' or a.cid='".$pid."') and a.comment='' ";
							//$sql.="a.bank_dep_id='".$bank_dep_id."' and a.pid='".$pid."' and a.comment='' ";
							*/
							
							//$sql ="select count(*) as aa from tran_importresult_item where request_id='".$request_id."' and bank_id='".$bank_id."' and comment='' ";
							
							$sql ="select count(*) as aa from tran_importresult_item where request_id='".$request_id."' and bank_id='".$bank_id."' and acc_no='".$acc_no."' and comment='' ";

							$data =Yii::app()->db->createCommand($sql)->queryAll();
							foreach($data as $dataitem)
							{
								if ($dataitem['aa']!=0)
								{
									$chkmsg = $chkmsg. "มีข้อมูลนี้ในระบบแล้ว, ";
								}
							}
							$sql = "INSERT INTO tran_importresult_item ";
							$sql.= "(importresult_id,doc_no,doc_date,acc_employer,business_name,name,lname,pid,bank_id, ";
							$sql.= "bank_dep_id,request_id,check_status,bank_dep_name,acc_type_id,acc_no,acc_name,mark,amont, ";
							$sql.= "remark,comment,request_date,create_date,create_by) ";
							$sql.= "VALUES(:code,:doc_no,:doc_date,:acc_employer,:business_name,:name,:lname,:pid,:bank_id, ";
							$sql.= ":bank_dep_id,$request_id,:check_status,:bank_dep_name,:acc_type_id,:acc_no, ";
							$sql.= ":acc_name,:mark,:amont,:remark,:comment,:request_date,now(),$createby) ";
							$command=yii::app()->db->createCommand($sql);		
							$command->bindValue(":code", $doc_code);
							$command->bindValue(":doc_no", $doc_no);
							$command->bindValue(":doc_date", $doc_date);	
							$command->bindValue(":acc_employer", $acc_employer);
							$command->bindValue(":business_name", $business_name);
							$command->bindValue(":name", $name);
							$command->bindValue(":lname", $lname);
							$command->bindValue(":pid", $pid);
							$command->bindValue(":bank_id", $bank_id);				
							$command->bindValue(":bank_dep_id", $bank_dep_id); 
							$command->bindValue(":check_status", $check_status);
							$command->bindValue(":bank_dep_name", $bank_dep_name);
							$command->bindValue(":acc_type_id", $acc_type_id);
							$command->bindValue(":acc_no", $acc_no);
							$command->bindValue(":acc_name", $acc_name);
							$command->bindValue(":mark", $mark);
							$command->bindValue(":amont", $amont);
							$command->bindValue(":request_date", $request_date);
							$command->bindValue(":remark", $remark);				
							$command->bindValue(":comment", $chkmsg);
							
							if($command->execute()) 
							{
								$id = Yii::app()->db->getLastInsertID();
								if($chkmsg==""){
									$sql = "INSERT INTO tran_request_item ";
									$sql.= "(request_id,importresult_id,doc_no,doc_date,acc_employer,business_name, ";
									$sql.= "name,lname,pid,bank_id,bank_dep_id,check_status,bank_dep_name,acc_type_id, ";
									$sql.= "acc_no,acc_name,mark,amont,remark,request_date,create_date,create_by) ";
									$sql.= "select a.request_id,".$doc_code.",a.doc_no,a.doc_date,a.acc_employer,a.business_name, ";				
									$sql.= "a.name,a.lname,a.pid,a.bank_id,a.bank_dep_id,a.check_status,a.bank_dep_name, ";
									$sql.= "a.acc_type_id,a.acc_no,a.acc_name,a.mark,a.amont,a.remark,a.request_date,now(),$createby ";
									$sql.= "from tran_importresult_item a ";
									$sql.= "where a.id='".$id."' ";
																				
									$command=yii::app()->db->createCommand($sql);
									if($command->execute()) 
									{		
										///ยุบรวม																
										//$sql = "update tran_request set status=4 where id='".$request_id."' ";	 ////up dt										
										//$saveid=$request_id;									
										
										if($request_id!=$saveid){
											
											$chk_id=true;
											$saveid=$request_id;	
										}else{
											$chk_id=false;
										}
										
										if($chk_id==true){
											
											$sql = "update tran_request set status=4, update_date=now() where id='".$request_id."' ";					
											$command=yii::app()->db->createCommand($sql);
											if($command->execute()) {
												
											}else { 
												Yii::app()->session['errmsg_import']='เกิดข้อผิดพลาดบันทึก1'.$sql;
												return false;
											}
										}										
												
									}else { 
										Yii::app()->session['errmsg_import']='เกิดข้อผิดพลาดบันทึก'.$sql;
										return false;	
									}											
								}	
								//return true;
							} else {
								Yii::app()->session['errmsg_import']='ไม่สามารถบันทึกข้อมูลได้'.$sql;
								return false;
							}
						}
					}			
				}
				fclose($handle);
			//rename ($inputFileName, Yii::app()->params['prg_ctrl']['path']['media'].Yii::app()->params['prg_ctrl']['path']['closepath'].$FileName);
			//return true;
			//ini_set('max_execution_time', 120);
			}			
			
		}
		
				
		if(($type=="xls") or ($type=="xlsx"))
		{
			
			Yii::app()->session->remove('id_import');
			//$file_name=$this->name[$x];		
			//date_default_timezone_set('Europe/London');
			date_default_timezone_set('Asia/Bangkok');
			//////////////////// นำเข้าไฟล์ Excle ////////////////////////////////			
			require_once(Yii::getPathOfAlias('application') .'/vendor/Classes/PHPExcel.php');
			include(Yii::getPathOfAlias('application') .'/vendor/Classes/PHPExcel/IOFactory.php');
		
			if(file_exists($inputFileName))
			{
				$exp = explode('.' , $file_name);
				$filename = substr($file_name, 0 , -(strlen($exp[count($exp)-1])+1));
				$ext = $exp[count($exp)-1];
				$filename = substr($filename,0,80);	
				$FileName = $filename.".".$ext;	 
			}
			$xx=2;
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
			$objReader->setReadDataOnly(true);  
			$objPHPExcel = $objReader->load($inputFileName);  
			
			$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
			$highestRow = $objWorksheet->getHighestRow();
			$highestColumn = $objWorksheet->getHighestColumn();	
			
			
			//$ck_a1 = $objPHPExcel->getActiveSheet()->getCell('A1')->getValue();
			$ck_a2 = $objPHPExcel->getActiveSheet()->getCell('A2')->getValue();
			//$cka_a1 = strlen(trim($ck_a1, " "));
			$cka_a2 = strlen(trim($ck_a2, " "));
			if(($cka_a2 != 5) or ($ck_a2 == null))
			{						
				Yii::app()->session['errmsg_import']='ข้อมูลในไฟล์ไม่ถูกต้อง กรุณาตรวจสอบไฟล์ที่นำเข้า ที่คอลัมภ์ A';
				return false;				
			}
			
			//$ck_b1 = $objPHPExcel->getActiveSheet()->getCell('B1')->getValue();
			$ck_b2 = $objPHPExcel->getActiveSheet()->getCell('B2')->getValue();
			//$ckb_b1 = strlen(trim($ck_b1, " "));
			$ckb_b2 = strlen(trim($ck_b2, " "));
			if(($ck_b2 == null) or ($ck_b2 == null))
			{						
				Yii::app()->session['errmsg_import']='ข้อมูลในไฟล์ไม่ถูกต้อง กรุณาตรวจสอบไฟล์ที่นำเข้า ที่คอลัมภ์ B';
				return false;				
			}
			
			//$ck_c1 = $objPHPExcel->getActiveSheet()->getCell('C1')->getValue();
			$ck_c2 = $objPHPExcel->getActiveSheet()->getCell('C2')->getValue();
			//$ckc_c1 = strlen(trim($ck_c1, " "));
			$ckc_c2 = strlen(trim($ck_c2, " "));
			//$ckc1_date = substr_count($ck_c1, '/');
			$ckc2_date = substr_count($ck_c2, '/');
			if(($ckc2_date != 2) or ($ck_c2 == null))
			{						
				Yii::app()->session['errmsg_import']='ข้อมูลในไฟล์ไม่ถูกต้อง กรุณาตรวจสอบไฟล์ที่นำเข้า ที่คอลัมภ์ C';
				return false;				
			}
			//$ck_d1 = $objPHPExcel->getActiveSheet()->getCell('D1')->getValue();
			$ck_d2 = $objPHPExcel->getActiveSheet()->getCell('D2')->getValue();			
			//$ckd_d1 = strlen(trim($ck_d1, " "));
			$ckd_d2 = strlen(trim($ck_d2, " "));
			if($ck_d2 == null)
			{						
				Yii::app()->session['errmsg_import']='ข้อมูลในไฟล์ไม่ถูกต้อง กรุณาตรวจสอบไฟล์ที่นำเข้า ที่คอลัมภ์ D';
				return false;				
			}
			
			
			$ck_k2 = $objPHPExcel->getActiveSheet()->getCell('K2')->getValue();	
			
			if($ck_k2=="065"){
				$ck_k2 = $objPHPExcel->getActiveSheet()->getCell('M2')->getValue();
				$ckk_k2 = strlen(trim($ck_k2, " "));
				if(($ckk_k2 == 1) or ($ckk_k2 == 2))
				{						
								
				}else{
					Yii::app()->session['errmsg_import']='ข้อมูลในไฟล์ไม่ถูกต้อง กรุณาตรวจสอบไฟล์ที่นำเข้า ที่คอลัมภ์ M';
					return false;
				
				}
			}else{
				
				$ckk_k2 = strlen(trim($ck_k2, " "));
				if(($ckk_k2 == 1) or ($ckk_k2 == 2))
				{						
									
				}else{
					Yii::app()->session['errmsg_import']='ข้อมูลในไฟล์ไม่ถูกต้อง กรุณาตรวจสอบไฟล์ที่นำเข้า ที่คอลัมภ์ K';
					return false;
				
				}
			}
			
			
						
			$sql = "INSERT INTO tran_file (name,object_group,object_type,upload_path,upload_url,file_size, ";
			$sql.= "file_type,create_date,create_by) ";
			$sql.= "VALUES(:name,:object_group,:object_type,:upload_path,:upload_url,:size,:type,now(),$createby) ";
			$command=yii::app()->db->createCommand($sql);		
			$command->bindValue(":name", $file_name);
			$command->bindValue(":object_group", "Import");
			$command->bindValue(":object_type", "Bank");
			$command->bindValue(":size", $size);
			$command->bindValue(":upload_path", $save_path);
			$command->bindValue(":upload_url", $save_url);
			$command->bindValue(":type", '.'.$type);
			if($command->execute()){
				$file_id = Yii::app()->db->getLastInsertID();
			}else { 
				Yii::app()->session['errmsg_import']='เกิดข้อผิดพลาดบันทึก11'.$sql;
				return false;
			}
		
			$code = $objPHPExcel->getActiveSheet()->getCell('A2')->getValue();
			$doc_no = $objPHPExcel->getActiveSheet()->getCell('B2')->getValue();
			$docdate = $objPHPExcel->getActiveSheet()->getCell('C2')->getValue();	
			$docdate_type = $objPHPExcel->getActiveSheet()->getCell('C2')->getDataType();				
		
			$r = 0;
			$namedDataArray = array();
			for ($row = 1; $row <= $highestRow; ++$row) 
			{
				$dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
				if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) 
				{
					++$r;
					$namedDataArray[$r] = $dataRow[$row];
				}
			}
		
			foreach($namedDataArray as $value)
			{
				$ck_data = strlen(trim($value['A'], " "));	
				$sub_file = substr($FileName,0,8);	
				if($ck_data==5)
				{		
					//$sub_file = substr($FileName,0,8);
					if($sub_file!="convert_")
					{		
						if($value['K']=="065"){										
							$bank_id = $value['K'];	
							if($bank_id!=""){break;}
						}else{
							$bank_id = $value['I'];		
							if($bank_id!=""){break;}			
						}
					}else{
						$bank_id = $value['I'];		
						if($bank_id!=""){break;}
					}
				}else{
		
					$r = 0;
					$namedDataArray = array();
					for ($row = 2; $row <= $highestRow; ++$row) 
					{
						$dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
						if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) 
						{
							++$r;
							$namedDataArray[$r] = $dataRow[$row];
						}
					}
					
					
					foreach($namedDataArray as $value)
					{						
						//$sub_file = substr($FileName,0,8);
								
						if($sub_file!="convert_")
						{		
							
							if($value['K']=="065"){										
								$bank_id = $value['K'];	
								if($bank_id!=""){break;}
							}else{
								$bank_id = $value['I'];		
								if($bank_id!=""){break;}			
							}
						}else{
							$bank_id = $value['I'];		
							if($bank_id!=""){break;}
						}
					}
					
				}		
			}
			
			$ckbank = $objPHPExcel->getActiveSheet()->getCell('K2')->getValue();
			if($ckbank=="065")
			{
				//$bank_id = $objPHPExcel->getActiveSheet()->getCell('K2')->getValue();
				Yii::app()->session['errmsg_import']='ข้อมูลในไฟล์ไม่ถูกต้อง กรุณาแปลงไฟล์';
				return false;	
			}
			if($bank_id == "")
			{					
				Yii::app()->session['errmsg_import']='รหัสธนาคารเป็นค่าว่าง กรุณาตรวจสอบไฟล์ที่นำเข้า';
				return false;				
			}
			/*20180320
			if($bank_id!="002"){
				$datadoc_date = (date_parse_from_format('d/m/Y', $docdate));
				$year = $datadoc_date['year'];
				if($year<2500)
				{
					$docdate=$docdate;
				}else{
					$year = $datadoc_date['year']-543;						
					$mount = "-".$datadoc_date['month']."-".$datadoc_date['day'];	
					$docdate = $year.$mount;
					
				}
			}else{
				
				$PHPDateTimeObject = PHPExcel_Shared_Date::ExcelToPHPObject($docdate);					
				$year = $PHPDateTimeObject->format('Y')-543 ;
				$mount = $PHPDateTimeObject->format('-m-d H:i:s');
				$docdate = $year.$mount;
			}
			*/
			$datadoc_date = (date_parse_from_format('d/m/Y', $docdate));
			$year = $datadoc_date['year'];
			if($year<2500)
			{
				$docdate=$docdate;
			}else{
				$year = $datadoc_date['year']-543;						
				$mount = "-".$datadoc_date['month']."-".$datadoc_date['day'];	
				$docdate = $year.$mount;
				
			}
			$sql = "INSERT INTO tran_importresult ";
			$sql.= "(file_id,code,doc_no,doc_date,bank_id,create_date,create_by) ";				
			$sql.= "VALUES(:file_id,:code,:doc_no,:doc_date,:bank_id,now(),$createby) ";
			$command=yii::app()->db->createCommand($sql);
			$command->bindValue(":file_id", $file_id);
			$command->bindValue(":code", $code);
			$command->bindValue(":doc_no", $doc_no);
			$command->bindValue(":doc_date", $docdate);					
			$command->bindValue(":bank_id", $bank_id);
			if($command->execute()) 
			{
				$importresult_id = Yii::app()->db->getLastInsertID();
				Yii::app()->session['id_import']=$importresult_id;
				$sql = "update tran_file set object_id='".$importresult_id."' where  id='".$file_id."' and object_group='Import' ";									
				$command=yii::app()->db->createCommand($sql);
				if($command->execute()) {
					//$id = Yii::app()->db->getLastInsertID();				
					//return true;
				}else{ 
					Yii::app()->session['errmsg_import']='เกิดข้อผิดพลาดบันทึก12'.$sql;
					return false;
				}								
			}else { 
				Yii::app()->session['errmsg_import']='เกิดข้อผิดพลาดบันทึก13'.$sql;
				return false;
			}
			$num_rows = 0;	
			foreach($namedDataArray as $xls_value)
			{				
				$chkmsg = "";
				$code = $xls_value['A'];	
				$doc_no = $xls_value['B'];	
				$doc_date = $xls_value['C'];
				//$doc_date = Yii::app()->CommonFnc->DMYth2YMD('/',$xls_value['C'],'-');
				$acc_employer = $xls_value['D'];	
				$business_name = $xls_value['E'];					
				$name = $xls_value['F'];	
				$lname = $xls_value['G'];	
				$pid = $xls_value['H'];				
				$bank_id = $xls_value['I'];	
				$bank_dep_id = $xls_value['J'];	
				$check_status = $xls_value['K'];	
				$bank_dep_name = $xls_value['L'];	
				$acc_type_id = $xls_value['M'];	
				$acc_no = $xls_value['N'];	
				$acc_name = $xls_value['O'];	
				$mark = $xls_value['P'];	
				$amont = $xls_value['Q'];	
				$request_date = $xls_value['R'];
				if(isset($xls_value['S'])){
					$remark = $xls_value['S'];
				}else{
					$remark = '';
				}				
					
				
						
			
				$code = trim($code, " ");
				$acc_employer = trim($acc_employer, " ");
				$pid = trim($pid, " ");			
				$bank_id = trim($bank_id, " ");			
				$bank_dep_id = trim($bank_dep_id, " ");
				$check_status = trim($check_status, " ");
				$bank_dep_name = trim($bank_dep_name, " ");
				$acc_type_id = trim($acc_type_id, " ");
				$acc_no = trim($acc_no, " ");
				$acc_name = trim($acc_name, " ");	
				$mark = trim($mark, " ");		
				$amont = str_replace(',', '', $amont);
				
				//check ว่าง
				if ($code == "")
				{
					$chkmsg = $chkmsg. "เลขชุดหนังสือเป็นค่าว่าง, ";
				}else{
					$ck_code = mb_strlen($code, 'UTF-8');
					if($ck_code>5){
						$code="00000";
					}
				}
				if ($doc_no == "")
				{					
					$chkmsg = $chkmsg. "เลขที่หนังสือเป็นค่าว่าง, ";					
				}else{
					$ck_docno = mb_strlen($doc_no, 'UTF-8');
					if($ck_docno>20)
					{
						$doc_no="00000";
					}
				}				
				if ($doc_date == "")
				{					
					$chkmsg = $chkmsg. "วันที่หนังสือเป็นค่าว่าง, ";					
				}else{
					/*20180320
					if($bank_id!="002"){
						$data_date = (date_parse_from_format('d/m/Y', $doc_date));
						$year = $data_date['year'];
						if($year<2500)
						{
							$docdate=$docdate;
						}else{
							$year = $data_date['year']-543;						
							$mount = "-".$data_date['month']."-".$data_date['day'];	
							$doc_date = $year.$mount;							
						}
					}else{
						$PHPDateTimeObject = PHPExcel_Shared_Date::ExcelToPHPObject($doc_date);					
						$year = $PHPDateTimeObject->format('Y')-543 ;
						$mount = $PHPDateTimeObject->format('-m-d H:i:s');
						$doc_date = $year.$mount;
					}
					*/
					$data_date = (date_parse_from_format('d/m/Y', $doc_date));
					$year = $data_date['year'];
					if($year<2500)
					{
						$docdate=$docdate;
					}else{
						$year = $data_date['year']-543;						
						$mount = "-".$data_date['month']."-".$data_date['day'];	
						$doc_date = $year.$mount;							
					}					
				}
				
				if ($acc_employer == "")
				{
					$chkmsg = $chkmsg. "เลขทะเบียนนายจ้างเป็นค่าว่าง, ";
				}
				if ($business_name == "")
				{					
					$chkmsg = $chkmsg. "คำนำหน้าชื่อหรือประเภทธุรกิจค่าว่าง, ";					
				}				
				if ($name == "" && $lname == "")
				{
					$chkmsg = $chkmsg. "ชื่อ หรือ นามสกุลเป็นเป็นค่าว่าง, ";
				}else{				
					$ck_name = mb_strlen($name, 'UTF-8');	
					$ck_lname = mb_strlen($lname, 'UTF-8');
					if($ck_name>50)
					{
						//$name = substr($name, 0, 50);
						$name = mb_substr($name, 0, 50, 'UTF-8');
						$chkmsg = $chkmsg. "ชื่อ มีขนาดตัวอักษรมากกว่าที่กำหนด, ";
					}
					if($ck_lname>50)
					{
						//$lname = substr($lname, 0, 50);
						$lname = mb_substr($lname, 0, 50, 'UTF-8');
						$chkmsg = $chkmsg. "นามสกุล มีขนาดตัวอักษรมากกว่าที่กำหนด, ";
					}
				}				
				if ($pid == "" )
				{					
					$chkmsg = $chkmsg. "เลขบัตประชาชน/เลขทะเบียนพาณิชย์เป็นค่าว่าง, ";					
				}			
				if ($bank_id == "")
				{					
					$bank_id=null;	
					$chkmsg = $chkmsg. "รหัสธนาคารเป็นค่าว่าง, ";					
				}else{
					$ck_bank_id = mb_strlen($bank_id, 'UTF-8');
					if($ck_bank_id > 3)
					{
						$bank_id=null;
						$chkmsg = $chkmsg. "รหัสธนาคารไม่ถูกต้อง, ";	
					}	
				}				
				if ($bank_dep_id == "")
				{				
					$bank_dep_id=null;	
					//$chkmsg = $chkmsg. "รหัสสาขาเป็นค่าว่าง, ";					
				}else{
					$ck_bank_dep_id = mb_strlen($bank_dep_id, 'UTF-8');
					if($ck_bank_dep_id > 4)
					{
						$bank_dep_id=null;
						$chkmsg = $chkmsg. "รหัสสาขาไม่ถูกต้อง, ";	
					}
					
				}
				if ($acc_type_id == "")
				{					
					$acc_type_id='';
					//$chkmsg = $chkmsg. "รหัสประเภทบัญชีเป็นค่าว่าง, ";					
				}else{
					$ck_acctypeid = mb_strlen($acc_type_id, 'UTF-8');
					if($ck_acctypeid > 2)
					{
						$acc_type_id='';
						$chkmsg = $chkmsg. "รหัสประเภทบัญชีไม่ถูกต้อง, ";	
					}				
				}
				if ($acc_no == "")
				{					
					$acc_no='';
					//$chkmsg = $chkmsg. "เลขที่บัญชีเป็นค่าว่าง, ";					
				}else{
					$ck_acc_no = mb_strlen($acc_no, 'UTF-8');
					if($ck_acc_no > 20)
					{
						$acc_no='';
						$chkmsg = $chkmsg. "เลขที่บัญชีไม่ถูกต้อง, ";	
					}				
				}			
				if ($acc_name == "")
				{					
					$acc_name='';
					//$chkmsg = $chkmsg. "ชื่อบัญชีเป็นค่าว่าง, ";					
				}
				if($mark == ""){
					
				}else{
					
					if ($mark != "+" and $mark != "-")
					{					
						$chkmsg = $chkmsg. "เครื่องหมายจำนวนเงินไม่ถูกต้อง, ";					
					}
				}
				if ($amont == "" )
				{					
					$amont = 0;					
				}else{
					//if ( is_numeric($amont)){ $amont; }else{ echo $chkmsg = $chkmsg. "จำนวนเงินไม่ถูกต้อง, ";}
					if (preg_match('/^[0-9.,]+$/', $amont)) { $amont;} else { $chkmsg = $chkmsg. "จำนวนเงินไม่ถูกต้อง, "; }
					
				}
				if ($request_date == "")
				{					
					$request_date=null;
					$chkmsg = $chkmsg. "วันเวลาที่ตรวจสอบเป็นค่าว่าง, ";					
				}else{
					$ck_requestdate = substr_count($request_date, ':');
					if($ck_requestdate=="2")
					{		
						//$sub_file = substr($FileName,0,8);								
						$data_date = (date_parse_from_format('d/m/Y H:i:s', $request_date));			
						$year = $data_date['year'];
						if($year<2500)
						{
							$request_date="0000-00-00 00:00:00";	
							$chkmsg = $chkmsg. "วันเวลาที่ตรวจสอบ Format ไม่ถูกต้อง, ";
						}else{
							$year = $data_date['year']-543;						
							$mount = "-".$data_date['month']."-".$data_date['day']." ".$data_date['hour'] ;
							$mount.= ":".$data_date['minute'].":".$data_date['second'];	
							$request_date = $year.$mount;
						}						
						
					}else{
						if($bank_id=="002")
						{	
							$PHPDateTimeObject = PHPExcel_Shared_Date::ExcelToPHPObject($request_date);											
							$year = $PHPDateTimeObject->format('Y')-543 ;												
							$mount = $PHPDateTimeObject->format('-m-d H:i:s');															
							$request_date = $year.$mount;															
						}else{						
							$request_date="0000-00-00 00:00:00";	
							$chkmsg = $chkmsg. "วันเวลาที่ตรวจสอบ Format ไม่ถูกต้อง, ";
						}
					}								
				}
				if ($request_date == "--")
				{				
					$request_date=null;	
					$chkmsg = $chkmsg. "วันเวลาที่ตรวจสอบเป็นค่าว่าง, ";					
				}
				//echo var_dump($doc_code);exit;



				$request_id='';
				$request_code='';
				
				$sql ="select id, code from tran_request where code='".$code."' and acc_employer='".$acc_employer."' and ";
				$sql.="(pid='".$pid."' or cid='".$pid."')  and status!=0 ";	/// s<>0
				$data =Yii::app()->db->createCommand($sql)->queryAll();
				foreach($data as $dataitem)
				{
					$request_id=$dataitem['id'];
					$request_code=$dataitem['code'];
				}
				
				if ($request_id=='')
				{
				
					$chkmsg = $chkmsg. "ไม่พบข้อมูลนี้ในระบบ, ";
					$sql = "INSERT INTO tran_importresult_item ";
					$sql.= "(importresult_id,doc_no,doc_date,acc_employer,business_name,name,lname,pid,bank_id,bank_dep_id, ";
					$sql.= "check_status,bank_dep_name,acc_type_id,acc_no,acc_name,mark,amont,remark,comment, ";
					$sql.= "request_date,create_date,create_by) ";
					$sql.= "VALUES(:importresult_id,:doc_no,:doc_date,:acc_employer,:business_name,:name,:lname,:pid,:bank_id,:bank_dep_id, ";
					$sql.= ":check_status,:bank_dep_name,:acc_type_id,:acc_no,:acc_name,:mark,:amont,:remark,:comment, ";
					$sql.= ":request_date,now(),$createby) ";
					$command=yii::app()->db->createCommand($sql);		
					$command->bindValue(":importresult_id", $importresult_id);
					$command->bindValue(":doc_no", $doc_no);
					$command->bindValue(":doc_date", $doc_date);	
					$command->bindValue(":acc_employer", $acc_employer);
					$command->bindValue(":business_name", $business_name);
					$command->bindValue(":name", $name);
					$command->bindValue(":lname", $lname);
					$command->bindValue(":pid", $pid);
					$command->bindValue(":bank_id", $bank_id);				
					$command->bindValue(":bank_dep_id", $bank_dep_id); 
					$command->bindValue(":check_status", $check_status);
					$command->bindValue(":bank_dep_name", $bank_dep_name);
					$command->bindValue(":acc_type_id", $acc_type_id);
					$command->bindValue(":acc_no", $acc_no);
					$command->bindValue(":acc_name", $acc_name);
					$command->bindValue(":mark", $mark);
					$command->bindValue(":amont", $amont);
					$command->bindValue(":request_date", $request_date);
					$command->bindValue(":remark", $remark);				
					$command->bindValue(":comment", $chkmsg);
					if($command->execute()) {
					
					} else {
						Yii::app()->session['errmsg_import']='ไม่สามารถบันทึกข้อมูลได้'.$sql;
						return false;
					}
				}else{
					/////check
					
					
					//เช็คซ้ำ
					
					/*
					$sql ="select count(*) as aa from tran_importresult_item a ";
					$sql.="left join tran_importresult b on b.id=a.importresult_id ";
					$sql.="where ";
					$sql.="b.code='".$code."' and a.bank_id='".$bank_id."' and a.acc_employer='".$acc_employer."' and a.acc_no='".$acc_no."' and ";
					$sql.=" (a.pid='".$pid."' or a.cid='".$pid."') and a.comment='' ";
					//$sql.="a.bank_dep_id='".$bank_dep_id."' and a.pid='".$pid."' and a.comment='' ";
					
					$data =Yii::app()->db->createCommand($sql)->queryAll();
					foreach($data as $dataitem)
					{
						if ($dataitem['aa']!=0)
						{
							$chkmsg = $chkmsg. "มีข้อมูลนี้ในระบบแล้ว, ";
						}
					}
					*/
					//$sql ="select count(*) as aa from tran_importresult_item a where a.bank_id='".$bank_id."' and a.pid='".$pid."' and a.comment='' ";					
					$sql ="select count(*) as aa from tran_importresult_item where request_id='".$request_id."' and bank_id='".$bank_id."' and acc_no='".$acc_no."' and comment='' ";
					//$sql ="select count(*) as aa from tran_importresult_item where request_id='".$request_id."' and bank_id='".$bank_id."' and comment='' ";
					

					$data =Yii::app()->db->createCommand($sql)->queryAll();
					

					foreach($data as $dataitem)
					{
						if ($dataitem['aa']!=0)
						{
							$chkmsg = $chkmsg. "มีข้อมูลนี้ในระบบแล้ว, ";
						}
					}

			
					$sql = "INSERT INTO tran_importresult_item ";
					$sql.= "(importresult_id,doc_no,doc_date,acc_employer,business_name,name,lname,pid,bank_id,bank_dep_id, ";
					$sql.= "request_id,check_status,bank_dep_name,acc_type_id,acc_no,acc_name,mark,amont,remark,comment, ";
					$sql.= "request_date,create_date,create_by) ";
					$sql.= "VALUES(:importresult_id,:doc_no,:doc_date,:acc_employer,:business_name,:name,:lname,:pid,:bank_id,:bank_dep_id, ";
					$sql.= " $request_id,:check_status,:bank_dep_name,:acc_type_id,:acc_no,:acc_name,:mark,:amont,:remark,:comment, ";
					$sql.= ":request_date,now(),$createby) ";
					$command=yii::app()->db->createCommand($sql);		
					$command->bindValue(":importresult_id", $importresult_id);
					$command->bindValue(":doc_no", $doc_no);
					$command->bindValue(":doc_date", $doc_date);	
					$command->bindValue(":acc_employer", $acc_employer);
					$command->bindValue(":business_name", $business_name);
					$command->bindValue(":name", $name);
					$command->bindValue(":lname", $lname);
					$command->bindValue(":pid", $pid);
					$command->bindValue(":bank_id", $bank_id);				
					$command->bindValue(":bank_dep_id", $bank_dep_id); 
					$command->bindValue(":check_status", $check_status);
					$command->bindValue(":bank_dep_name", $bank_dep_name);
					$command->bindValue(":acc_type_id", $acc_type_id);
					$command->bindValue(":acc_no", $acc_no);
					$command->bindValue(":acc_name", $acc_name);
					$command->bindValue(":mark", $mark);
					$command->bindValue(":amont", $amont);
					$command->bindValue(":request_date", $request_date);
					$command->bindValue(":remark", $remark);				
					$command->bindValue(":comment", $chkmsg);
					
					if($command->execute()) 
					{						
						/////check  get id
						
						$id = Yii::app()->db->getLastInsertID();
						if($chkmsg==""){
							$sql = "INSERT INTO tran_request_item ";
							$sql.= "(request_id,importresult_id,doc_no,doc_date,acc_employer,business_name, ";
							$sql.= "name,lname,pid,bank_id,bank_dep_id,check_status,bank_dep_name,acc_type_id, ";
							$sql.= "acc_no,acc_name,mark,amont,remark,request_date,create_date,create_by) ";
							$sql.= "select a.request_id,".$importresult_id.",a.doc_no,a.doc_date,a.acc_employer,a.business_name, ";				
							$sql.= "a.name,a.lname,a.pid,a.bank_id,a.bank_dep_id,a.check_status,a.bank_dep_name, ";
							$sql.= "a.acc_type_id,a.acc_no,a.acc_name,a.mark,a.amont,a.remark,a.request_date,now(),$createby ";
							$sql.= "from tran_importresult_item a ";
							$sql.= "where a.id='".$id."' ";
																		
							$command=yii::app()->db->createCommand($sql);
							if($command->execute()) 
							{		
								///ยุบรวม																
								//$sql = "update tran_request set status=4 where id='".$request_id."' ";	 ////up dt	
								
								if($request_id!=$saveid){
											
									$chk_id=true;
									$saveid=$request_id;	
								}else{
									$chk_id=false;
								}
								
								if($chk_id==true){
									
									$sql = "update tran_request set status=4, update_date=now() where id='".$request_id."' ";					
									$command=yii::app()->db->createCommand($sql);
									if($command->execute()) {
										
									}else { 
										Yii::app()->session['errmsg_import']='เกิดข้อผิดพลาดบันทึก1'.$sql;
										return false;
									}
								}
							}else { 
								Yii::app()->session['errmsg_import']='เกิดข้อผิดพลาดบันทึก'.$sql;
								return false;	
							}
						}
					
					} else {
						Yii::app()->session['errmsg_import']='ไม่สามารถบันทึกข้อมูลได้'.$sql;
						return false;
					}
				}				
			}	
		}		
		if(file_exists($inputFileName))
		{
			rename ($inputFileName, Yii::app()->params['prg_ctrl']['path']['media'].Yii::app()->params['prg_ctrl']['path']['closepath'].$FileName);
		}	
		//rename ($inputFileName, Yii::app()->params['prg_ctrl']['path']['media'].Yii::app()->params['prg_ctrl']['path']['closepath'].$FileName);
		
		return true;			
	}			
}
	
FUNCTION DMYth2YMD($exp_in,$date_dmy,$exp_out)
{
	$arr = explode($exp_in,$date_dmy,3);
	if(count($arr)==3){
		list($d,$m,$y_th) = $arr;
		$y = $y_th-543;
		$date_ymd =  $y.$exp_out.$m.$exp_out.$d;
	}else{
		$date_ymd =  $date_dmy;
	}
	return $date_ymd;
}