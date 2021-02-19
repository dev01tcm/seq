<?php

class frm_hisimport extends CFormModel
{
	public $id;
	public $name;	
	public $size;	
	public $type;
	public $trnid;	
	public $cntfile;
	public $path;	
	public $url;
	public $save_path;
	public $save_url;
	public $rmv;	
	public $arr;
	public $idbank;
	public $code;
	
	public function rules()
	{
		return array(
			array('id', 'name', 'size', 'type', 'cntfile', 'path', 'url',  'save_path', 'save_url', 'rmv','arr'),				
		);
	}

	public function attributeLabels()
	{
		return array(

		);
	}
	


	public function save_insert()
	{
			
		$fullpath = $this->path;
		$i = 0;
		$sum = count($this->name);
		while($i < $sum && (isset($this->name[$i]) && $this->name!='')){
		
			$file_name = $this->name[$i];
			$createby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;		
			$inputFileName = $fullpath.Yii::app()->params['prg_ctrl']['path']['closepath'].$file_name;
			
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

			
			if($this->type[$i]==".pdf" || $this->type[$i]==".png" || $this->type[$i]==".jpg" || $this->type[$i]==".jpeg" || $this->type[$i]==".txt" || $this->type[$i]==".xls" || $this->type[$i]==".xlsx" || $this->type[$i]==".doc" || $this->type[$i]==".docx" || $this->type[$i]==".rar" || $this->type[$i]==".zip" || $this->type[$i]==".7z"){
				
				$sql = "INSERT INTO tran_file (name,object_group,object_type,object_id,upload_path,upload_url,file_size, ";
				$sql.= "file_type,create_date,create_by) ";
				$sql.= "VALUES(:name,:object_group,:object_type,:object_id,:fullpath,:fullurl,:size,:type,now(),$createby) ";
				$command=yii::app()->db->createCommand($sql);		
				$command->bindValue(":name", $this->name[$i]);
				$command->bindValue(":object_group", "Import");
				$command->bindValue(":object_type", "Book");
				$command->bindValue(":object_id", $this->id);
				$command->bindValue(":size", $this->size[$i]);
				$command->bindValue(":fullpath", $this->save_path);
				$command->bindValue(":fullurl", $this->save_url);
				$command->bindValue(":type", $this->type[$i]);
				if($command->execute()){
					//$id = Yii::app()->db->getLastInsertID();
				}else{
					Yii::app()->session['errmsg_import']='Insert error PDF'.$sql;
					return false;							
				}
				if(file_exists($inputFileName))
				{
					rename ($inputFileName, Yii::app()->params['prg_ctrl']['path']['media'].Yii::app()->params['prg_ctrl']['path']['closepath'].$FileName);
				}
				
			}else{
				Yii::app()->session['errmsg_import']='ประเภทไฟล์แนบไม่ถูกต้อง !!!';
				return false;				
			}			
			$i++;
		}
		return true;
	
	}//end function save_insert

	public function save_update()
	{
		$fullpath = $this->path;
		$updateby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;		
		$i = 0;
		$sum = count($this->name);
		$insert = $sum - $this->cntfile;
		$cntrmv = count($this->rmv);
		$irmv = 0;
		$arr = array();
		//echo $sum.','.$insert.','.$cntrmv,' '; //exit;

		if($cntrmv > 0){			
			
			while($irmv < $cntrmv && (isset($this->rmv[$i]) && $this->rmv[$i] != '')){
					
					$sql = "update tran_file set status=0,update_date=now(),update_by=$updateby ";
					$sql.= "where id=:idrmv ";
					$command=yii::app()->db->createCommand($sql);		
					$command->bindValue(":idrmv", $this->rmv[$irmv]);				
					if($command->execute()){
						array_push($arr,$this->rmv[$irmv]); 
					}else{
						Yii::app()->session['errmsg_import']='Remove error'.$sql;
						return false;							
					}
				
				$irmv++;	
			} //exit;
		}
		
		//echo count($arr);
		//exit;
		while($i < $this->cntfile && isset($this->name[$i])){	
			 
			if($this->name[$i] != '' && (isset($this->trnid[$i]) && $this->trnid[$i] != '')){
				$file_name = $this->name[$i];
				$createby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;		
				$inputFileName = $fullpath.Yii::app()->params['prg_ctrl']['path']['closepath'].$file_name;
								
				if(file_exists($inputFileName))
				{
					$exp = explode('.' , $file_name);
					$filename = substr($file_name, 0 , -(strlen($exp[count($exp)-1])+1));
					$ext = $exp[count($exp)-1];
					$filename = substr($filename,0,80);	
					$FileName = $filename.".".$ext;			 
				}	
				if($this->type[$i]==".pdf" || $this->type[$i]==".png" || $this->type[$i]==".jpg" || $this->type[$i]==".jpeg" || $this->type[$i]==".txt" || $this->type[$i]==".xls" || $this->type[$i]==".xlsx" || $this->type[$i]==".doc" || $this->type[$i]==".docx" || $this->type[$i]==".rar" || $this->type[$i]==".zip" || $this->type[$i]==".7z"){
					if(in_array($this->trnid[$i],$arr)==false){								
						$sql = "update tran_file set name=:name,object_group=:object_group,object_type=:object_type,object_id=:object_id,";
						$sql.= "upload_path=:fullpath,upload_url=:fullurl,file_size=:size,status=1, ";
						$sql.= "file_type=:type,update_date=now(),update_by=$updateby ";
						$sql.= "where id=".$this->trnid[$i];
						$command=yii::app()->db->createCommand($sql);		
						$command->bindValue(":name", $this->name[$i]);
						$command->bindValue(":object_group", "Import");
						$command->bindValue(":object_type", "Book");
						$command->bindValue(":object_id", $this->id);
						$command->bindValue(":size", $this->size[$i]);
						$command->bindValue(":fullpath", $this->save_path);
						$command->bindValue(":fullurl", $this->save_url);
						$command->bindValue(":type", $this->type[$i]);	
						if($command->execute()){
							//echo $this->trnid[$i]." not found !!\n";
						}else{
							Yii::app()->session['errmsg_import']='Update error PDF'.$sql;
							return false;							
						}
						if(file_exists($inputFileName))
						{
							rename ($inputFileName, Yii::app()->params['prg_ctrl']['path']['media'].Yii::app()->params['prg_ctrl']['path']['closepath'].$FileName);
						}
					}
				}
			} 
			$i++;
		
		}
		


		if($insert!=0 && $insert>0){
			
			while($i <= $sum ){
				
				if(isset($this->name[$i]) && $this->name[$i] != ''){
					$file_name = $this->name[$i];
					$createby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;		
					$inputFileName = $fullpath.Yii::app()->params['prg_ctrl']['path']['closepath'].$file_name;
					
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
					//echo var_dump($this->type[$i]);exit;
					if($this->type[$i]==".pdf" || $this->type[$i]==".png" || $this->type[$i]==".jpg" || $this->type[$i]==".jpeg" || $this->type[$i]==".txt" || $this->type[$i]==".xls" || $this->type[$i]==".xlsx" || $this->type[$i]==".doc" || $this->type[$i]==".docx" || $this->type[$i]==".rar" || $this->type[$i]==".zip" || $this->type[$i]==".7z"){
						
						$sql = "INSERT INTO tran_file (name,object_group,object_type,object_id,upload_path,upload_url,file_size, ";
						$sql.= "file_type,create_date,create_by) ";
						$sql.= "VALUES(:name,:object_group,:object_type,:object_id,:fullpath,:fullurl,:size,:type,now(),$updateby) ";
						$command=yii::app()->db->createCommand($sql);		
						$command->bindValue(":name", $this->name[$i]);
						$command->bindValue(":object_group", "Import");
						$command->bindValue(":object_type", "Book");
						$command->bindValue(":object_id", $this->id);
						$command->bindValue(":size", $this->size[$i]);
						$command->bindValue(":fullpath", $this->save_path);
						$command->bindValue(":fullurl", $this->save_url);
						$command->bindValue(":type", $this->type[$i]);
						
						if($command->execute()){
							//$id = Yii::app()->db->getLastInsertID();
						}else{
							Yii::app()->session['errmsg_import']='Insert error PDF'.$sql;
							return false;							
						}
						if(file_exists($inputFileName))
						{
							rename ($inputFileName, Yii::app()->params['prg_ctrl']['path']['media'].Yii::app()->params['prg_ctrl']['path']['closepath'].$FileName);
						}
						
					}else{
						Yii::app()->session['errmsg_import']='ประเภทไฟล์แนบไม่ถูกต้อง !!!';
						return false;				
					}
				} 
				$i++;			
			}
			
		
		}

		
		return true;		
				
	
	}//end function save_update
	public function save_delete()
	{
		ini_set('max_execution_time', 240);
		
		$sql ="select id from tran_importresult where code='".$this->code."' and bank_id='".$this->idbank."'";
		$data1 =Yii::app()->db->createCommand($sql)->queryAll();	
		$user = Yii::app()->user->getInfo('username');
		
		
	
			foreach($data1 as $dataitem)
							{
								$id=$dataitem['id'];
								
								
								$sql = "insert into log_tran_file SELECT null as log_id,now() as log_date,'Delete' as log_type,'".$user."' as log_createby,a.* FROM tran_file a WHERE object_id=".$id." ";
								$command=yii::app()->db->createCommand($sql);
								if($command->execute()) {
									
								} else {
											Yii::app()->session['errmsg_user']='ไม่สามารถบันทึกข้อมูลได้'.$sql;
											return false;
									   }
								$sql = "insert into log_tran_importresult_item SELECT null as log_id,now() as log_date,'Delete' as log_type,'".$user."' as log_createby,a.* FROM tran_importresult_item a WHERE importresult_id=".$id." ";
								$command=yii::app()->db->createCommand($sql);
								if($command->execute()) {
									
								} else {
											Yii::app()->session['errmsg_user']='ไม่สามารถบันทึกข้อมูลได้'.$sql;
											return false;
									   }
								$sql = "insert into log_tran_request_item SELECT null as log_id,now() as log_date,'Delete' as log_type,'".$user."' as log_createby,a.* FROM tran_request_item a WHERE importresult_id=".$id." ";
								$command=yii::app()->db->createCommand($sql);
								if($command->execute()) {
									
								}else {
										Yii::app()->session['errmsg_user']='ไม่สามารถบันทึกข้อมูลได้'.$sql;
										return false;
									 }
								 $sql = "delete from tran_request_item where importresult_id=".$id."";
								 $command=yii::app()->db->createCommand($sql);			
								  if($command->execute()) {
									
								     } else {
											Yii::app()->session['errmsg_user']='ไม่สามารถลบข้อมูลได้'.$sql;
									        return false;
									         }
								$sql = "delete from tran_importresult_item where importresult_id=".$id."";
								$command=yii::app()->db->createCommand($sql);			
								if($command->execute()) {
									
								   } else {
									        Yii::app()->session['errmsg_user']='ไม่สามารถลบข้อมูลได้'.$sql;
									        return false;
									       }				 
								$sql = "delete from tran_file where object_id=".$id."";
								$command=yii::app()->db->createCommand($sql);			
										if($command->execute()) {
											
								} else {
											Yii::app()->session['errmsg_user']='ไม่สามารถลบข้อมูลได้'.$sql;
											return false;
									   }			 
								
							}
							
			$sql = "insert into log_tran_importresult SELECT null as log_id,now() as log_date,'Delete' as log_type,'".$user."' as log_createby,a.* FROM tran_importresult a where code='".$this->code."'and bank_id=".$this->idbank."";
			$command=yii::app()->db->createCommand($sql);
			if($command->execute()) {
				
			}else {
					Yii::app()->session['errmsg_user']='ไม่สามารถบันทึกข้อมูลได้'.$sql;
					return false;
			}
		    $sql = "delete from tran_importresult where code='".$this->code."'and bank_id=".$this->idbank."";
			$command=yii::app()->db->createCommand($sql);			
			if($command->execute()) {
									
			} else {
					Yii::app()->session['errmsg_user']='ไม่สามารถลบข้อมูลได้'.$sql;
					return false;
				   }				
			$sql ="select id from tran_importresult where code='".$this->code."'";
			$data3 =Yii::app()->db->createCommand($sql)->queryAll();
					
			if($data3==null)
				{
					 $sql = "update tran_request set status = 2 where code='".$this->code."'";
					 $command=yii::app()->db->createCommand($sql);			
									if($command->execute()) {
										
										} else {
											Yii::app()->session['errmsg_user']='ไม่สามารถอัฟเดทข้อมูลได้'.$sql;
											return false;
											   }
				}
						
			
			return true;
	}
}
