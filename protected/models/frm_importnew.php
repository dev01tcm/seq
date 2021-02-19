<?php

class frm_importnew extends CFormModel
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
		//echo var_dump('dd');exit;
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
		
		//echo var_dump($inputFileName);exit;
		
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
				//Yii::app()->session['errmsg_import']='ข้อมูลในไฟล์ไม่ถูกต้อง กรุณาตรวจสอบไฟล์ที่นำเข้า ที่คอลัมภ์ A ท่านต้องการแปลงไฟล์เลยหรือไม่ ?';
				Yii::app()->session['errmsg_import']='ข้อมูลในไฟล์ไม่ถูกต้อง คุณต้องการแปลงไฟล์เลยหรือไม่ ?';
				//Yii::app()->session['errmsg_fname
				return false;				
			}
			
			//$ck_b1 = $objPHPExcel->getActiveSheet()->getCell('B1')->getValue();
			$ck_b2 = $objPHPExcel->getActiveSheet()->getCell('B2')->getValue();
			//$ckb_b1 = strlen(trim($ck_b1, " "));
			$ckb_b2 = strlen(trim($ck_b2, " "));
			if(($ck_b2 == null) or ($ck_b2 == null))
			{						
				//Yii::app()->session['errmsg_import']='ข้อมูลในไฟล์ไม่ถูกต้อง กรุณาตรวจสอบไฟล์ที่นำเข้า ที่คอลัมภ์ B ท่านต้องการแปลงไฟล์เลยหรือไม่ ?';
				Yii::app()->session['errmsg_import']='ข้อมูลในไฟล์ไม่ถูกต้อง คุณต้องการแปลงไฟล์เลยหรือไม่ ?';
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
				//Yii::app()->session['errmsg_import']='ข้อมูลในไฟล์ไม่ถูกต้อง กรุณาตรวจสอบไฟล์ที่นำเข้า ที่คอลัมภ์ C คุณต้องการแปลงไฟล์เลยหรือไม่ ?';
				Yii::app()->session['errmsg_import']='ข้อมูลในไฟล์ไม่ถูกต้อง คุณต้องการแปลงไฟล์เลยหรือไม่ ?';
				return false;				
			}
			//$ck_d1 = $objPHPExcel->getActiveSheet()->getCell('D1')->getValue();
			$ck_d2 = $objPHPExcel->getActiveSheet()->getCell('D2')->getValue();			
			//$ckd_d1 = strlen(trim($ck_d1, " "));
			$ckd_d2 = strlen(trim($ck_d2, " "));
			if($ck_d2 == null)
			{						
				//Yii::app()->session['errmsg_import']='ข้อมูลในไฟล์ไม่ถูกต้อง กรุณาตรวจสอบไฟล์ที่นำเข้า ที่คอลัมภ์ D คุณต้องการแปลงไฟล์เลยหรือไม่ ?';
				Yii::app()->session['errmsg_import']='ข้อมูลในไฟล์ไม่ถูกต้อง คุณต้องการแปลงไฟล์เลยหรือไม่ ?';
				return false;				
			}
			
			
			$ck_k2 = $objPHPExcel->getActiveSheet()->getCell('K2')->getValue();	
			
			if($ck_k2=="065"){
				$ck_k2 = $objPHPExcel->getActiveSheet()->getCell('M2')->getValue();
				$ckk_k2 = strlen(trim($ck_k2, " "));
				if(($ckk_k2 == 1) or ($ckk_k2 == 2))
				{						
								
				}else{
					//Yii::app()->session['errmsg_import']='ข้อมูลในไฟล์ไม่ถูกต้อง กรุณาตรวจสอบไฟล์ที่นำเข้า ที่คอลัมภ์ M คุณต้องการแปลงไฟล์เลยหรือไม่ ?';
					Yii::app()->session['errmsg_import']='ข้อมูลในไฟล์ไม่ถูกต้อง คุณต้องการแปลงไฟล์เลยหรือไม่ ?';
					return false;
				
				}
			}else{
				
				$ckk_k2 = strlen(trim($ck_k2, " "));
				if(($ckk_k2 == 1) or ($ckk_k2 == 2))
				{						
									
				}else{
					//Yii::app()->session['errmsg_import']='ข้อมูลในไฟล์ไม่ถูกต้อง กรุณาตรวจสอบไฟล์ที่นำเข้า ที่คอลัมภ์ K คุณต้องการแปลงไฟล์เลยหรือไม่ ?';
					Yii::app()->session['errmsg_import']='ข้อมูลในไฟล์ไม่ถูกต้อง คุณต้องการแปลงไฟล์เลยหรือไม่ ?';
					return false;
				
				}
			}
			
			$code = $objPHPExcel->getActiveSheet()->getCell('A2')->getValue();
			$doc_no = $objPHPExcel->getActiveSheet()->getCell('B2')->getValue();
			$docdate = $objPHPExcel->getActiveSheet()->getCell('C2')->getValue();	
			$docdate_type = $objPHPExcel->getActiveSheet()->getCell('C2')->getDataType();				
		
			$r = -1;
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
		
					$r = -1;
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
				Yii::app()->session['errmsg_import']='ข้อมูลในไฟล์ไม่ถูกต้อง คุณต้องการแปลงไฟล์เลยหรือไม่ ?';
				return false;	
			}
			if($bank_id == "")
			{						
				Yii::app()->session['errmsg_import']='ข้อมูลในไฟล์ไม่ถูกต้อง คุณต้องการแปลงไฟล์เลยหรือไม่ ?';
				return false;				
			}			
			$datadoc_date = (date_parse_from_format('d/m/Y', $docdate));
			$year = $datadoc_date['year'];
			if($year<2500)
			{
				Yii::app()->session['errmsg_import']='ข้อมูลในไฟล์ไม่ถูกต้อง คุณต้องการแปลงไฟล์เลยหรือไม่ ?';
				return false;
			}else{
				$year = $datadoc_date['year']-543;						
				$mount = "-".$datadoc_date['month']."-".$datadoc_date['day'];	
				$docdate = $year.$mount;
				
			}
			
			/*
		$r = -1;
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
		*/
		
		
		$data = array();
		$result_msg = array();
		$i = 0;
		$index=0;
		$letterorder = $namedDataArray[0]['A'];
		$bkcode = $namedDataArray[0]['I'];
		foreach($namedDataArray as $xls_value){
				$data[$i]['row'] = $i+1;	
				$data[$i]['letterorder'] = $xls_value['A'];	
				$data[$i]['letternumber_export'] = $xls_value['B'];	
				$data[$i]['letterdate_export'] = $xls_value['C'];	
				$data[$i]['emp_number'] = $xls_value['D'];	
				$data[$i]['busitype'] = $xls_value['E'];	
				$data[$i]['name'] = $xls_value['F'];	
				$data[$i]['surname'] = $xls_value['G'];	
				$data[$i]['idcard'] = $xls_value['H'];	
				$data[$i]['bkcode'] = $xls_value['I'];	
				$data[$i]['bkbranchcode'] = $xls_value['J'];	
				$data[$i]['result'] = $xls_value['K'];	
				$data[$i]['bkbranchname'] = $xls_value['L'];	
				$data[$i]['bkbooktypecode'] = $xls_value['M'];	
				$data[$i]['bkbooknumber'] = $xls_value['N'];	
				$data[$i]['bkbookname'] = $xls_value['O'];	
				$data[$i]['bksign'] = $xls_value['P'];	
				$data[$i]['bksum'] = $xls_value['Q'];	
				$data[$i]['bkcheckdate'] = $xls_value['R'];	

				if(isset($xls_value['S'])){
						$data[$i]['bkcomment'] = $xls_value['S'];
						$field_number = count($xls_value);
				}else{
						$data[$i]['bkcomment'] = '';
						$field_number = count($xls_value)+1;
				}

				if($field_number <> 19){# check sum of field 
						$result_msg[$index] = 'ไม่สามารถนำข้อมูลเข้า..บรรทัดที่ '.$data[$i]['row'].' มี '.$field_number.' field ไม่ตรงตาม format';
				}
				 if(strlen($data[$i]['bkcomment']) >50 ){# check field bkcomment
						$index++;
						$result_msg[$index] = 'บรรทัดที่ '.$data[$i]['row'].' ไม่สามารถนำข้อมูลเข้าได้ เนื่องจาก Field หมายเหตุมีความยาวเกิน 50 อักขระ'; 
				}
				 if($data[$i]['letterorder'] != $letterorder){ # check field letterorder
						$index++;
						$result_msg[$index] = 'บรรทัดที่ '.$data[$i]['row'].' ไม่สามารถนำข้อมูลเข้าได้ เนื่องจาก Field ชุดหนังสือ ไม่ถูกต้อง'; 
				}

				 if($data[$i]['bkcode'] != $bkcode){# check field bkcode
						$index++;
						$result_msg[$index] = 'ไม่สามารถนำข้อมูลเข้าได้ เนื่องจาก Field รหัสธนาคารไม่ถูกต้อง'; 
				}
				 if( ($data[$i]['result'] != '1') and ($data[$i]['result'] != '2') ){# check field bkcode
						$index++;
						$result_msg[$index] = 'บรรทัดที่ '.$data[$i]['row'].' ไม่สามารถนำข้อมูลเข้าได้ เนื่องจาก Field รหัสผลการตรวจสอบไม่ถูกต้อง'; 
				}
				//echo var_dump($data[$i]['name']);exit;
				
				$i++;
		}#foreach

		//require($_SERVER['DOCUMENT_ROOT'].'/sequester/view/v_import_xls_valid.php');								
		
		unset($namedDataArray);
		unset($result_msg);
		unset($data);
		
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