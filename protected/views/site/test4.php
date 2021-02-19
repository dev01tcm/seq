<?php
require_once(Yii::getPathOfAlias('application') .'/vendor/Classes/PHPExcel.php');
			include(Yii::getPathOfAlias('application') .'/vendor/Classes/PHPExcel/IOFactory.php');
			
			
			// Create new PHPExcel object
			$objPHPExcel = new PHPExcel();
			$style 	= array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,));
			$txt 	= array('alignment' => array('horizontal' => PHPExcel_Style_NumberFormat::FORMAT_TEXT,));
			$style2 = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,));
			
			$objPHPExcel->getActiveSheet()->removeColumn('T');
			$objPHPExcel->getActiveSheet()->removeColumn('U');
			$objPHPExcel->getActiveSheet()->removeColumn('V');	
			
			$inputFileName = "Copy of 60012.xlsx";	
			$file_name = $inputFileName;
			if(file_exists($inputFileName))
			{
				/*
				$filename = pathinfo($file_name, PATHINFO_FILENAME);
				$ext = pathinfo($file_name, PATHINFO_EXTENSION);	
				$FileName = iconv(mb_detect_encoding($filename, mb_detect_order(), true), "TIS-620", $filename).".".$ext;		
				
				rename ($inputFileName, Yii::app()->params['prg_ctrl']['path']['upload'].Yii::app()->params['prg_ctrl']['path']['closepath'].$FileName);
				$inputFileName =  $fullpath.Yii::app()->params['prg_ctrl']['path']['closepath'].$FileName;	
				*/
				$filename = pathinfo($file_name, PATHINFO_FILENAME);
				$ext = pathinfo($file_name, PATHINFO_EXTENSION);	
				$FileName = $filename.".".$ext;		 
			}else{
				return true;
			}
			$xx=2;
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
			$objReader->setReadDataOnly(true);  
			$objPHPExcel = $objReader->load($inputFileName);  
		
			$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
			$highestRow = $objWorksheet->getHighestRow();
			$highestColumn = $objWorksheet->getHighestColumn();
			$c2 = $objPHPExcel->getActiveSheet()->getCell('C2')->getValue();
			$i2 = $objPHPExcel->getActiveSheet()->getCell('I'.$xx)->getValue();
			$k2 = $objPHPExcel->getActiveSheet()->getCell('K'.$xx)->getValue();
			$r2 = $objPHPExcel->getActiveSheet()->getCell('R'.$xx)->getValue();
			$t2 = $objPHPExcel->getActiveSheet()->getCell('T'.$xx)->getValue();
			$sub_file = substr($FileName,0,8);
			/*
			if(($k2=="065") or ($k2=="65")){										
				$bank_ck = $k2;	
				//if($k2!=""){break;}
			}else{
				$bank_ck = $i2;		
				//if($bank_ck!=""){break;}	
				if($bank_ck!=null){break;}		
			}
			
			$xx++;
			echo var_dump($bank_ck);exit;
			$sql ="select count(*) as aa from mas_bank a ";
			$sql.="where a.code='".$bank_ck."' ";
			$data =Yii::app()->db->createCommand($sql)->queryAll();
			foreach($data as $dataitem)
			{
				if ($dataitem['aa']==0)
				{	
					Yii::app()->session['errmsg_convert']='ข้อมูลในไฟล์ไม่ถูกต้อง กรุณาตรวจสอบไฟล์';
					return false;
				}
			}
			
			*/
				
			
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
				if($ck_data==5){
		
					if($value['K']=="065"){	
									
						$bank_id = $value['K'];	
						if($bank_id!=""){break;}
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
						if($value['K']=="065"){										
							$bank_id = $value['K'];	
							if($bank_id!=""){break;}
						}else{
							$bank_id = $value['I'];		
							if($bank_id!=""){break;}			
						}						
					}
				}		
			}
			
			//echo var_dump($bank_id);
			//exit;
		
			$i = 2;
			foreach($namedDataArray as $xls_value)
			{		
		
				$code = $xls_value['A'];	
				$doc_no = $xls_value['B'];					
				$doc_date = DMYth2YMD('/',$xls_value['C'],'-');				
				$acc_employer = $xls_value['D'];	
				$business_name = $xls_value['E'];					
				$name = $xls_value['F'];	
				$lname = $xls_value['G'];	
				$pid = $xls_value['H'];
		
				if($xls_value['K']=="065"){									
					//$bank_id = $xls_value['K'];	
					$bank_dep_id = $xls_value['L'];	
					$check_status = $xls_value['M'];	
					$bank_dep_name = $xls_value['N'];	
					$acc_type_id = $xls_value['O'];	
					$acc_no = $xls_value['P'];	
					$acc_name = $xls_value['Q'];	
					$mark = $xls_value['R'];	
					$amont = $xls_value['S'];	
					$request_date = $xls_value['T'];
					if(isset($xls_value['U'])){
						$remark = $xls_value['U'];
					}else{
						$remark = '';
					}
				}else{
					//$bank_id = $xls_value['I'];	
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
					echo var_dump($namedDataArray)."<br/>";
				}
				if($sub_file!="Convert_")
				{
					$ck_requestdate = substr_count($request_date, ':');					
					if($ck_requestdate=="3")
					{									
						$data_date = (date_parse_from_format('d/m/Y :H:i:s', $request_date));							
						$year = $data_date['year'];
						$ck_mo = mb_strlen($data_date['month'], 'UTF-8');
						$ck_d = mb_strlen($data_date['day'], 'UTF-8');				
						$ck_h = mb_strlen($data_date['hour'], 'UTF-8');
						$ck_m = mb_strlen($data_date['minute'], 'UTF-8');
						$ck_s = mb_strlen($data_date['second'], 'UTF-8');
						$mo = $data_date['month'];
						$d = $data_date['day'];
						$h = $data_date['hour'];
						$m = $data_date['minute'];
						$s = $data_date['second'];
						if($ck_mo < 2){$mo = '0'.$mo;};
						if($ck_d < 2){$d = '0'.$d;};
						if($ck_h < 2){$h = '0'.$h;};
						if($ck_m < 2){$m = '0'.$m;};
						if($ck_s < 2){$s = '0'.$s;};
						if($year<2500)
						{
							$year = $data_date['year'];						
							$mount = "/".$mo."/".$d." ".$h.":".$m.":".$s;	
							$request_date = $year.$mount;
						}else{
							$year = $data_date['year']-543;						
							$mount = "/".$mo."/".$d." ".$h.":".$m.":".$s;	
							$request_date = $year.$mount;		
						}					
					}
					if($ck_requestdate=="2")
					{
						$data_date = (date_parse_from_format('d/m/Y H:i:s', $request_date));							
						$year = $data_date['year'];
						$ck_mo = mb_strlen($data_date['month'], 'UTF-8');
						$ck_d = mb_strlen($data_date['day'], 'UTF-8');				
						$ck_h = mb_strlen($data_date['hour'], 'UTF-8');
						$ck_m = mb_strlen($data_date['minute'], 'UTF-8');
						$ck_s = mb_strlen($data_date['second'], 'UTF-8');
						$mo = $data_date['month'];
						$d = $data_date['day'];
						$h = $data_date['hour'];
						$m = $data_date['minute'];
						$s = $data_date['second'];
						if($ck_mo < 2){$mo = '0'.$mo;};
						if($ck_d < 2){$d = '0'.$d;};
						if($ck_h < 2){$h = '0'.$h;};
						if($ck_m < 2){$m = '0'.$m;};
						if($ck_s < 2){$s = '0'.$s;};
						if($year<2500)
						{
							$year = $data_date['year'];						
							$mount = "/".$mo."/".$d." ".$h.":".$m.":".$s;	
							$request_date = $year.$mount;
						}else{
							$year = $data_date['year']-543;						
							$mount = "/".$mo."/".$d." ".$h.":".$m.":".$s;	
							$request_date = $year.$mount;
						}						
					}
					if($ck_requestdate=="")
					{						
						$data_date = (date_parse_from_format('d/m/Y', $request_date));					
						$year = $data_date['year'];
						$ck_mo = mb_strlen($data_date['month'], 'UTF-8');
						$ck_d = mb_strlen($data_date['day'], 'UTF-8');			
						$mo = $data_date['month'];
						$d = $data_date['day'];				
						if($ck_mo < 2){$mo = '0'.$mo;};
						if($ck_d < 2){$d = '0'.$d;};
						if($year<2500)
						{
							if($year<1000)
							{
								$PHPDateTimeObject = PHPExcel_Shared_Date::ExcelToPHPObject($request_date);
								if($PHPDateTimeObject->format('Y')<2500){
									$year = $PHPDateTimeObject->format('Y');
								}else{
									$year = $PHPDateTimeObject->format('Y')-543 ;	
								}
								$mount = $PHPDateTimeObject->format('-m-d H:i:s');
								$request_date = $year.$mount;
							}else{							
								$year = $data_date['year'];						
								$mount = "/".$mo."/".$d." 00:00:00";	
								$request_date = $year.$mount;
							}
						}else{
							$year = $data_date['year']-543;						
							$mount = "/".$mo."/".$d." 00:00:00";	
							$request_date = $year.$mount;
						}				
					}
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
				$amont = trim($amont, " ");
				$amont = str_replace(',', '', $amont);
				
				
				
				
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
			