<?php

class frm_convertfile extends CFormModel
{
	public $type;
	public $name;	
	public $fullpath;
	public $fullurl;
	public $filename;	
	public $closepath;
	
	public function rules()
	{
		return array(
			array('code', 'type','name','fullpath','closepath','fullurl', 'safe'),				
		);
	}

	public function attributeLabels()
	{
		return array(

		);
	}
	
	

	public function convert_file()
	{
		//check error
		
		$x=0;
		$file_name = $this->name[$x];
		$fullpath = $this->fullpath;
		$fullurl = $this->fullurl;
		$closepath = $this->closepath;
		
		$type=$this->type[$x];
		$sum = count($this->name);				
		//$createby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;	
		$inputFileName = $fullpath.$closepath.$file_name;
		
		
		if(file_exists($inputFileName))
		{

			$exp = explode('.' , $file_name);
			$filename = substr($file_name, 0 , -(strlen($exp[count($exp)-1])+1));
			$ext = $exp[count($exp)-1];
			$filename = substr($filename,0,80);	
			$FileName = $filename.".".$ext;			 
		}else{
			return true;
		}/*==*/
		$sub_file = substr($file_name,0,8);
			
		
///<-------------------------	txt file   --------------------------------------------------------------------->
		
		if(($type=="txt") or ($type=="TXT"))
		{
			$txtfilName = "sso.txt";
			//$obj = fopen($txtfilName, "w");
			$handle = fopen($inputFileName, 'r');
			$i = 0;
			
			$myfile = fopen($txtfilName, "w") or die("Unable to open file!");
			if ($handle) 
			{
				while (($buffer = fgets($handle, 4096)) !== false)
				{										
					$ck_data = strlen(trim($buffer, " "));
					if($ck_data > 400)
					{	
						if (mb_check_encoding(file_get_contents($inputFileName), 'UTF-8')) 
						{
							if($sub_file!="convert_")
							{			
								if($i==0){							
									
									$code = iconv_substr($buffer, 1,5, "UTF-8");
									$doc_no = iconv_substr($buffer, 6,20, "UTF-8");
									$doc_date = iconv_substr($buffer, 26,10, "UTF-8");							
									$acc_employer = iconv_substr($buffer, 36,10, "UTF-8");
									$business_name = iconv_substr($buffer, 46,20, "UTF-8");
									$name = iconv_substr($buffer, 66,50, "UTF-8");
									$lname = iconv_substr($buffer, 116,50, "UTF-8");
									$pid = iconv_substr($buffer, 166,20, "UTF-8");
									$bank_id = iconv_substr($buffer, 186,3, "UTF-8");									
									if($bank_id=="006")
									{						
										$check_status = iconv_substr($buffer, 195,1, "UTF-8");
										if($check_status=="2")
										{
											$bank_dep_id = iconv_substr($buffer, 189,4, "UTF-8");												
											$bank_dep_name = iconv_substr($buffer, 196,50, "UTF-8");
											$acc_type_id = iconv_substr($buffer, 246,2, "UTF-8");
											$acc_no = iconv_substr($buffer, 248,20, "UTF-8");
											$acc_name = iconv_substr($buffer, 268,100, "UTF-8");					
											$mark = iconv_substr($buffer, 368,1, "UTF-8");							
											$amont = iconv_substr($buffer, 369,16, "UTF-8");
											$request_date = iconv_substr($buffer, 385,30, "UTF-8");											
											$remark = iconv_substr($buffer, 414,50, "UTF-8");
										}else{
											$bank_dep_id = iconv_substr($buffer, 191,4, "UTF-8");												
											$bank_dep_name = iconv_substr($buffer, 196,50, "UTF-8");
											$acc_type_id = iconv_substr($buffer, 246,2, "UTF-8");
											$acc_no = iconv_substr($buffer, 248,20, "UTF-8");
											$acc_name = iconv_substr($buffer, 268,100, "UTF-8");					
											$mark = iconv_substr($buffer, 368,1, "UTF-8");							
											$amont = iconv_substr($buffer, 369,16, "UTF-8");
											$request_date = iconv_substr($buffer, 385,30, "UTF-8");											
											$remark = iconv_substr($buffer, 414,50, "UTF-8");
										}										
									}else{
										$bank_dep_id = iconv_substr($buffer, 189,4, "UTF-8");	
										$check_status = iconv_substr($buffer, 193,1, "UTF-8");											
										$bank_dep_name = iconv_substr($buffer, 194,50, "UTF-8");
										$acc_type_id = iconv_substr($buffer, 244,2, "UTF-8");
										$acc_no = iconv_substr($buffer, 246,20, "UTF-8");
										$acc_name = iconv_substr($buffer, 266,100, "UTF-8");					
										$mark = iconv_substr($buffer, 366,1, "UTF-8");							
										$amont = iconv_substr($buffer, 367,17, "UTF-8");
										$request_date = iconv_substr($buffer, 384,30, "UTF-8");											
										$remark = iconv_substr($buffer, 413,50, "UTF-8");
									}
								}else{
									$code = iconv_substr($buffer, 0,5, "UTF-8");
									$doc_no = iconv_substr($buffer, 5,20, "UTF-8");
									$doc_date = iconv_substr($buffer, 25,10, "UTF-8");							
									$acc_employer = iconv_substr($buffer, 35,10, "UTF-8");
									$business_name = iconv_substr($buffer, 45,20, "UTF-8");
									$name = iconv_substr($buffer, 65,50, "UTF-8");
									$lname = iconv_substr($buffer, 115,50, "UTF-8");
									$pid = iconv_substr($buffer, 165,20, "UTF-8");
									$bank_id = iconv_substr($buffer, 185,3, "UTF-8");
									
									if($bank_id=="006")
									{						
										$check_status = iconv_substr($buffer, 194,1, "UTF-8");
										if($check_status=="2")
										{
											$bank_dep_id = iconv_substr($buffer, 188,4, "UTF-8");												
											$bank_dep_name = iconv_substr($buffer, 195,50, "UTF-8");
											$acc_type_id = iconv_substr($buffer, 245,2, "UTF-8");
											$acc_no = iconv_substr($buffer, 247,20, "UTF-8");
											$acc_name = iconv_substr($buffer, 267,100, "UTF-8");					
											$mark = iconv_substr($buffer, 367,1, "UTF-8");							
											$amont = iconv_substr($buffer, 368,16, "UTF-8");
											$request_date = iconv_substr($buffer, 384,30, "UTF-8");											
											$remark = iconv_substr($buffer, 413,50, "UTF-8");
										}else{
											$bank_dep_id = iconv_substr($buffer, 190,4, "UTF-8");												
											$bank_dep_name = iconv_substr($buffer, 195,50, "UTF-8");
											$acc_type_id = iconv_substr($buffer, 245,2, "UTF-8");
											$acc_no = iconv_substr($buffer, 247,20, "UTF-8");
											$acc_name = iconv_substr($buffer, 267,100, "UTF-8");					
											$mark = iconv_substr($buffer, 367,1, "UTF-8");							
											$amont = iconv_substr($buffer, 368,16, "UTF-8");
											$request_date = iconv_substr($buffer, 384,30, "UTF-8");											
											$remark = iconv_substr($buffer, 413,50, "UTF-8");
										}										
									}else{
										$bank_dep_id = iconv_substr($buffer, 188,4, "UTF-8");	
										$check_status = iconv_substr($buffer, 192,1, "UTF-8");											
										$bank_dep_name = iconv_substr($buffer, 193,50, "UTF-8");
										$acc_type_id = iconv_substr($buffer, 243,2, "UTF-8");
										$acc_no = iconv_substr($buffer, 245,20, "UTF-8");
										$acc_name = iconv_substr($buffer, 265,100, "UTF-8");					
										$mark = iconv_substr($buffer, 365,1, "UTF-8");							
										$amont = iconv_substr($buffer, 366,17, "UTF-8");
										$request_date = iconv_substr($buffer, 383,30, "UTF-8");											
										$remark = iconv_substr($buffer, 412,50, "UTF-8");
									}
								}	
								
								
								$data_date = (date_parse_from_format('d/m/Y', $doc_date));							
								$year = $data_date['year'];
								$ck_mo = mb_strlen($data_date['month'], 'UTF-8');
								$ck_d = mb_strlen($data_date['day'], 'UTF-8');
								$mo = $data_date['month'];
								$d = $data_date['day'];							
								if($ck_mo < 2){$mo = '0'.$mo;};
								if($ck_d < 2){$d = '0'.$d;};							
								if($year<2500)
								{
									$year = $data_date['year']+543;						
									$doc_date = $d."/".$mo."/".$year;
								}else{
									$year = $data_date['year'];						
									$doc_date = $d."/".$mo."/".$year;		
									
								}
								//echo var_dump($doc_date);exit;
								
								
									
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
										$year = $data_date['year']+543;							
										$request_date = $d."/".$mo."/".$year." ".$h.":".$m.":".$s;
									}else{
										$year = $data_date['year'];						
										$request_date = $d."/".$mo."/".$year." ".$h.":".$m.":".$s;		
										
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
										$year = $data_date['year']+543;						
										$request_date = $d."/".$mo."/".$year." ".$h.":".$m.":".$s;
									}else{
										$year = $data_date['year'];						
										$request_date = $d."/".$mo."/".$year." ".$h.":".$m.":".$s;
										
										
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
											$year = $PHPDateTimeObject->format('Y')+543;	
											$mount = $PHPDateTimeObject->format('-m-d H:i:s');
											$request_date = $year.$mount;
										}else{							
											$year = $data_date['year']+543;							
											$mount = "/".$mo."/".$d." 00:00:00";	
											$request_date = $d."/".$mo."/".$year." 00:00:00";
										}
									}else{
										$year = $data_date['year'];					
										$request_date = $d."/".$mo."/".$year." 00:00:00";
									}				
								}
							}else{
								
								$name = mb_substr($buffer,45,20, "utf-8");
								$code = mb_substr($buffer, 0, 5, "utf-8");	
								$doc_no = mb_substr($buffer, 5, 20, "utf-8");								
								$doc_date = mb_substr($buffer, 25, 10, "utf-8");			
								$acc_employer = mb_substr($buffer, 35, 10, "utf-8");
								$business_name = mb_substr($buffer, 45, 20, "utf-8");
								$name = mb_substr($buffer, 65, 50, "utf-8");
								$lname = mb_substr($buffer, 115, 50, "utf-8");
								$pid = mb_substr($buffer, 165, 20, "utf-8");
								$bank_id = mb_substr($buffer, 185, 3, "utf-8");
														
								$bank_dep_id = mb_substr($buffer, 188, 4, "utf-8");							
								$check_status = mb_substr($buffer, 192, 1, "utf-8");						
								$bank_dep_name = mb_substr($buffer, 193, 50, "utf-8");
								$acc_type_id = mb_substr($buffer, 243, 2, "utf-8");
								$acc_no = mb_substr($buffer, 245, 20, "utf-8");							
								$acc_name = mb_substr($buffer, 265, 100, "utf-8");						
								$mark = mb_substr($buffer, 365, 1, "utf-8");											
								$amont = mb_substr($buffer, 366, 17, "utf-8");	
								$request_date = mb_substr($buffer, 383, 30, "utf-8");
								$remark = mb_substr($buffer, 412, 50, "utf-8");
							}
							
						
							//Yii::app()->session['errmsg_convert']='ประเภทของไฟล์ไม่ถูกต้อง กรุณาเปลี่ยนประเภทไฟล์เป็น ANSI';
							//return false;
							
						}else{
							if($sub_file!="convert_")
							{													
								$code = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 0, 5));	
								$doc_no = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 5, 20));
								$doc_date = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 25, 10));							
								$acc_employer = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 35, 10));
								$business_name = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 45, 20));
								$name = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 65, 50));
								$lname = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 115, 50));
								$pid = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 165, 20));
								$bank_id = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 185, 3));									
												
								if($bank_id=="006")
								{						
									$check_status = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 194, 1));
									if($check_status=="2")
									{
										$bank_dep_id = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 188, 4));												
										$bank_dep_name = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 195, 50));
										$acc_type_id = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 245, 2));
										$acc_no = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 247, 20));
										$acc_name = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 267, 100));						
										$mark = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 367, 1));							
										$amont = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 368, 16));	
										$request_date = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 384, 30));											
										$remark = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 413, 50));
									}else{
										//$bank_dep_id = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 188, 4));
										$bank_dep_id = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 190, 4));						
										$bank_dep_name = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 195, 50));
										$acc_type_id = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 245, 2));
										$acc_no = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 247, 20));
										$acc_name = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 267, 100));						
										$mark = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 367, 1));							
										$amont = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 368, 16));	
										$request_date = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 384, 30));											
										$remark = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 413, 50));
									}				
									
								}else{
									$bank_dep_id = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 188, 4));							
									$check_status = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 192, 1));						
									$bank_dep_name = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 193, 50));
									$acc_type_id = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 243, 2));
									$acc_no = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 245, 20));									
									$acc_name = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 265, 100));						
									$mark = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 365, 1));		
														
									$amont = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 366, 17));	
									$request_date = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 383, 30));											
									//$remark = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 406, 50));
									$remark = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 412, 50));	
									
										
								}
								$data_date = (date_parse_from_format('d/m/Y', $doc_date));							
								$year = $data_date['year'];
								$ck_mo = mb_strlen($data_date['month'], 'UTF-8');
								$ck_d = mb_strlen($data_date['day'], 'UTF-8');
								$mo = $data_date['month'];
								$d = $data_date['day'];							
								if($ck_mo < 2){$mo = '0'.$mo;};
								if($ck_d < 2){$d = '0'.$d;};							
								if($year<2500)
								{
									$year = $data_date['year']+543;						
									$doc_date = $d."/".$mo."/".$year;
								}else{
									$year = $data_date['year'];						
									$doc_date = $d."/".$mo."/".$year;		
									
								}
								//echo var_dump($doc_date);exit;
								
								
									
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
										$year = $data_date['year']+543;							
										$request_date = $d."/".$mo."/".$year." ".$h.":".$m.":".$s;
									}else{
										$year = $data_date['year'];						
										$request_date = $d."/".$mo."/".$year." ".$h.":".$m.":".$s;		
										
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
										$year = $data_date['year']+543;						
										$request_date = $d."/".$mo."/".$year." ".$h.":".$m.":".$s;
									}else{
										$year = $data_date['year'];						
										$request_date = $d."/".$mo."/".$year." ".$h.":".$m.":".$s;
										
										
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
											$year = $PHPDateTimeObject->format('Y')+543;	
											$mount = $PHPDateTimeObject->format('-m-d H:i:s');
											$request_date = $year.$mount;
										}else{							
											$year = $data_date['year']+543;							
											$mount = "/".$mo."/".$d." 00:00:00";	
											$request_date = $d."/".$mo."/".$year." 00:00:00";
										}
									}else{
										$year = $data_date['year'];					
										$request_date = $d."/".$mo."/".$year." 00:00:00";
									}				
								}
							}else{
								$code = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 0, 5));	
								$doc_no = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 5, 20));
								$doc_date = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 25, 10));							
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
								//$remark = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 406, 50));
								$remark = iconv('TIS-620','UTF-8//IGNORE',substr($buffer, 412, 50));
								/*
								
								//$name = mb_substr($buffer,45,20, "utf-8");
								$code = mb_substr($buffer, 0, 5, "utf-8");	
								$doc_no = mb_substr($buffer, 5, 20, "utf-8");								
								$doc_date = mb_substr($buffer, 25, 10, "utf-8");			
								$acc_employer = mb_substr($buffer, 35, 10, "utf-8");
								$business_name = mb_substr($buffer, 45, 20, "utf-8");
								$name = mb_substr($buffer, 65, 50, "utf-8");
								$lname = mb_substr($buffer, 115, 50, "utf-8");
								$pid = mb_substr($buffer, 165, 20, "utf-8");
								$bank_id = mb_substr($buffer, 185, 3, "utf-8");
														
								$bank_dep_id = mb_substr($buffer, 188, 4, "utf-8");							
								$check_status = mb_substr($buffer, 192, 1, "utf-8");						
								$bank_dep_name = mb_substr($buffer, 193, 50, "utf-8");
								$acc_type_id = mb_substr($buffer, 243, 2, "utf-8");
								$acc_no = mb_substr($buffer, 245, 20, "utf-8");							
								$acc_name = mb_substr($buffer, 265, 100, "utf-8");						
								$mark = mb_substr($buffer, 365, 1, "utf-8");											
								$amont = mb_substr($buffer, 366, 17, "utf-8");	
								//$request_date = mb_substr($buffer, 383, 30, "utf-8");
								$remark = mb_substr($buffer, 412, 50, "utf-8");*/
								//echo var_dump($remark);exit;
								//echo var_dump($request_date);exit;
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
						//$remark = ereg_replace('[[:space:]]+', ' ', trim($remark));
						$amont = trim($amont, " ");
						
						
						
						//echo var_dump($doc_date);	exit;		
						//$request_date = str_pad($request_date,30," ",STR_PAD_RIGHT);
						
						$code = Yii::app()->CommonFnc->ex_pad($code, 5);
						$doc_no = Yii::app()->CommonFnc->ex_pad($doc_no, 20);
						$doc_date = Yii::app()->CommonFnc->ex_pad($doc_date, 10);				
						$acc_employer = Yii::app()->CommonFnc->ex_pad($acc_employer, 10);
						$business_name = Yii::app()->CommonFnc->ex_pad($business_name, 20);
						$name = Yii::app()->CommonFnc->ex_pad($name, 50);
						$lname = Yii::app()->CommonFnc->ex_pad($lname, 50);
						$pid = Yii::app()->CommonFnc->ex_pad($pid, 20);
						$bank_id = Yii::app()->CommonFnc->ex_pad($bank_id, 3);
						$bank_dep_id = Yii::app()->CommonFnc->ex_pad($bank_dep_id, 4);
						$check_status = Yii::app()->CommonFnc->ex_pad($check_status, 1);
						$bank_dep_name = Yii::app()->CommonFnc->ex_pad($bank_dep_name, 50);
						$acc_type_id = Yii::app()->CommonFnc->ex_pad($acc_type_id, 2);
						$acc_no = Yii::app()->CommonFnc->ex_pad($acc_no, 20);
						$acc_name = Yii::app()->CommonFnc->ex_pad($acc_name, 100);
						$mark = Yii::app()->CommonFnc->ex_pad($mark, 1);
						$amont = Yii::app()->CommonFnc->ex_pad($amont, 17);
						$request_date = Yii::app()->CommonFnc->ex_pad($request_date, 30);						
						$remark = trim(preg_replace('/\s\s+/', ' ', $remark));
						$remark = Yii::app()->CommonFnc->ex_pad($remark, 50);
						$amont = str_replace(',', '', $amont);	
					//
						
						/*
						fwrite($obj, 						
							$code.
							$doc_no.
							$doc_date.						
							$acc_employer.
							$business_name.											
							$name.
							$lname.
							$pid.
							$bank_id.
							$bank_dep_id.
							$check_status.
							$bank_dep_name.
							$acc_type_id.
							$acc_no.
							$acc_name.
							$mark.
							$amont.
							$request_date.
							$remark."\r\n");	
							//$i++;
							*/
							

							$txt = $code.
							$doc_no.
							$doc_date.						
							$acc_employer.
							$business_name.											
							$name.
							$lname.
							$pid.
							$bank_id.
							$bank_dep_id.
							$check_status.
							$bank_dep_name.
							$acc_type_id.
							$acc_no.
							$acc_name.
							$mark.
							$amont.
							$request_date.
							$remark."\r\n";
							fwrite($myfile, $txt);
							
					//echo var_dump($code);
					}
				}
				
			}
			fclose($myfile);
			//fclose($obj);
			//echo var_dump($fullpath.$closepath."convert_".$FileName);exit;
			rename($txtfilName, $fullpath.$closepath."convert_".$FileName);
			//rename("xxx.txt", $fullpath.$closepath."xxx.txt");
			//$txtfil = "SSO_".$code.".txt";
			fclose($handle);
			return true;		
		}
		
		
///<-------------------------	Excel file   ---------------------------------------------------------------------->	
	
		if(($type=="xls") or ($type=="xlsx"))
		{	
			//date_default_timezone_set('Europe/London');
			date_default_timezone_set('Asia/Bangkok');
			require_once(Yii::getPathOfAlias('application') .'/vendor/Classes/PHPExcel.php');
			include(Yii::getPathOfAlias('application') .'/vendor/Classes/PHPExcel/IOFactory.php');
			// Create new PHPExcel object
		
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
			$objReader->setReadDataOnly(true);  
			$objPHPExcel = $objReader->load($inputFileName);  
			
			$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
			$highestRow = $objWorksheet->getHighestRow();
			$highestColumn = $objWorksheet->getHighestColumn();			
			$sub_file = substr($inputFileName,0,8);
			
				
			//$ck_a1 = $objPHPExcel->getActiveSheet()->getCell('A1')->getValue();
			$ck_a2 = $objPHPExcel->getActiveSheet()->getCell('A2')->getValue();
			//$cka_a1 = strlen(trim($ck_a1, " "));
			$cka_a2 = strlen(trim($ck_a2, " "));
			if(($cka_a2 != 5) or ($ck_a2 == null))
			{						
				Yii::app()->session['errmsg_convert']='ข้อมูลในไฟล์ไม่ถูกต้อง กรุณาตรวจสอบไฟล์ที่นำเข้า ที่คอลัมภ์ A';
				return false;				
			}
			
			//$ck_b1 = $objPHPExcel->getActiveSheet()->getCell('B1')->getValue();
			$ck_b2 = $objPHPExcel->getActiveSheet()->getCell('B2')->getValue();
			//$ckb_b1 = strlen(trim($ck_b1, " "));
			$ckb_b2 = strlen(trim($ck_b2, " "));
			if(($ck_b2 == null) or ($ck_b2 == null))
			{						
				Yii::app()->session['errmsg_convert']='ข้อมูลในไฟล์ไม่ถูกต้อง กรุณาตรวจสอบไฟล์ที่นำเข้า ที่คอลัมภ์ B';
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
				Yii::app()->session['errmsg_convert']='ข้อมูลในไฟล์ไม่ถูกต้อง กรุณาตรวจสอบไฟล์ที่นำเข้า ที่คอลัมภ์ C';
				return false;				
			}
			//$ck_d1 = $objPHPExcel->getActiveSheet()->getCell('D1')->getValue();
			$ck_d2 = $objPHPExcel->getActiveSheet()->getCell('D2')->getValue();			
			//$ckd_d1 = strlen(trim($ck_d1, " "));
			$ckd_d2 = strlen(trim($ck_d2, " "));
			if($ck_d2 == null)
			{						
				Yii::app()->session['errmsg_convert']='ข้อมูลในไฟล์ไม่ถูกต้อง กรุณาตรวจสอบไฟล์ที่นำเข้า ที่คอลัมภ์ D';
				return false;				
			}
			
			
			$ck_k2 = $objPHPExcel->getActiveSheet()->getCell('K2')->getValue();	
			
			if($ck_k2=="065"){
				$ck_k2 = $objPHPExcel->getActiveSheet()->getCell('M2')->getValue();
				$ckk_k2 = strlen(trim($ck_k2, " "));
				if(($ckk_k2 == 1) or ($ckk_k2 == 2))
				{						
								
				}else{
					Yii::app()->session['errmsg_convert']='ข้อมูลในไฟล์ไม่ถูกต้อง กรุณาตรวจสอบไฟล์ที่นำเข้า ที่คอลัมภ์ M';
					return false;
				
				}
			}else{
				
				$ckk_k2 = strlen(trim($ck_k2, " "));
				if(($ckk_k2 == 1) or ($ckk_k2 == 2))
				{						
									
				}else{
					Yii::app()->session['errmsg_convert']='ข้อมูลในไฟล์ไม่ถูกต้อง กรุณาตรวจสอบไฟล์ที่นำเข้า ที่คอลัมภ์ K';
					return false;
				
				}
			}
			
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
			$objPHPExcel	= new PHPExcel();
			$style 	= array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,));
			$txt 	= array('alignment' => array('horizontal' => PHPExcel_Style_NumberFormat::FORMAT_TEXT,));
			$style2 = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,));
			// Set document properties
			$objPHPExcel->getProperties()
						->setCreator("Maarten Balliauw")
						->setLastModifiedBy("Maarten Balliauw")
						->setTitle("Office 2007 XLSX Test Document")
						->setSubject("Office 2007 XLSX Test Document")
						->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
						->setKeywords("office 2007 openxml php")
						->setCategory("Test result file");
			// Add some data
			$i = 2;
			$objPHPExcel->getActiveSheet()->getStyle("A:S")->getFont()->setName('angsanaupc')->setSize(16);		
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
			$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(23);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(45);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(45);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(40);
			$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);		
			$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(80);
			$objPHPExcel->getActiveSheet()->getStyle("A1:S1")->applyFromArray($style)->getFont()->setName('angsanaupc')->setSize(16)->setBold(true);
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'เลขที่ชุดข้อมูล')
						->setCellValue('B1', 'เลขที่หนังสือ')
						->setCellValue('C1', 'วันที่หนังสือ')
						->setCellValue('D1', 'เลขที่บัญชีนายจ้าง')
						->setCellValue('E1', 'คำนำหน้าชื่อ/ประเภทธุรกิจ')
						->setCellValue('F1', 'ชื่อ')
						->setCellValue('G1', 'สกุล')
						->setCellValue('H1', 'เลขประจำตัวประชาชน/เลขทะเบียนพาณิชย์')
						->setCellValue('I1', 'รหัสธนาคาร')
						->setCellValue('J1', 'รหัสสาขา')
						->setCellValue('K1', 'สถานะการตรวจสอบ')
						->setCellValue('L1', 'ชื่อสาขา')
						->setCellValue('M1', 'รหัสประเภทบัญชี')
						->setCellValue('N1', 'เลขที่บัญชีธนาคาร')
						->setCellValue('O1', 'ชื่อบัญชี')
						->setCellValue('P1', 'เครื่องหมายจำนวนเงิน')
						->setCellValue('Q1', 'จำนวนเงินคงเหลือ')
						->setCellValue('R1', 'วัน-เวลา ที่ตรวจสอบ')
						->setCellValue('S1', 'หมายเหตุ');
				
			//echo "<table border=1>";	
			foreach($namedDataArray as $xls_value)
			{		
				
				$code = $xls_value['A'];	
				$doc_no = $xls_value['B'];					
				$doc_date = $xls_value['C'];				
				$acc_employer = $xls_value['D'];	
				$business_name = $xls_value['E'];					
				$name = $xls_value['F'];	
				$lname = $xls_value['G'];	
				$pid = $xls_value['H'];
				if($xls_value['K']=="065"){		
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
				}
				if($bank_id!="002"){
					$datadoc_date = (date_parse_from_format('d/m/Y', $doc_date));
					$year = $datadoc_date['year'];					
					if($year>2500)
					{
						$doc_date=$doc_date;
					}else{
						$year = $datadoc_date['year']+543;						
						$mount = $datadoc_date['day']."/".$datadoc_date['month']."/";	
						//echo var_dump($year);exit;
						$doc_date = $mount.$year;
						
					}
				}
				
				if($sub_file!="Convert_")
				{
					if($request_date==""){
						
					}else{
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
								$year = $data_date['year']+543;
								$request_date = $d."/".$mo."/".$year." ".$h.":".$m.":".$s;
							}else{
								$year = $data_date['year'];						
								$request_date = $d."/".$mo."/".$year." ".$h.":".$m.":".$s;		
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
								$year = $data_date['year']+543;						
								$request_date = $d."/".$mo."/".$year." ".$h.":".$m.":".$s;
							}else{
								$year = $data_date['year'];						
								$request_date = $d."/".$mo."/".$year." ".$h.":".$m.":".$s;
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
										$year = $PHPDateTimeObject->format('Y')+543;
									}else{
										$year = $PHPDateTimeObject->format('Y') ;	
									}
									$mount = $PHPDateTimeObject->format('d/m/');
									$ho = $PHPDateTimeObject->format('H:i:s');					
									$request_date = $mount.$year." ".$ho;
								}else{							
									$year = $data_date['year']+543;
									$request_date = $d."/".$mo."/".$year." 00:00:00";
								}
							}else{
								$year = $data_date['year'];						
								$mount = "/".$mo."/".$d." 00:00:00";	
								$request_date = $d."/".$mo."/".$year." 00:00:00";
							}				
						}
					}
				}
				if (preg_match('/^[0-9.,]+$/', $amont)) 
				{ 
					$amont;				
				} else { 
					$amont=strtolower($amont);   //คำต้นฉบับ
					$nostr="usd";                 // คำที่ต้องการหา
					if(strstr($amont,$nostr))
					{
					  $remark = $remark. "จำนวนเงินต่างประเทศ USD ";  
					}
					
					$amont = str_replace("usd", "",$amont);	
				
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
						
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('A' . $i, $code);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('B' . $i, $doc_no);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('C' . $i, $doc_date);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('D' . $i, $acc_employer);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('E' . $i, mb_substr($business_name, 0, 20, "utf-8"));
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('F' . $i, $name);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('G' . $i, $lname);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('H' . $i, $pid);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('I' . $i, $bank_id);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('J' . $i, $bank_dep_id);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('K' . $i, $check_status);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('L' . $i, $bank_dep_name);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('M' . $i, $acc_type_id);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('N' . $i, $acc_no);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('O' . $i, $acc_name);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('P' . $i, $mark);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('Q' . $i, $amont);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('R' . $i, $request_date);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('S' . $i, $remark);
				$i++;
			}
			//echo var_dump($doc_no);exit;
			// Rename worksheet
			
			$objPHPExcel->getActiveSheet()->setTitle('Sheet1');			
			$objPHPExcel->setActiveSheetIndex(0);			
			//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');			
			//$objWriter->save('php://output');
			//$filename = pathinfo($file_name, PATHINFO_FILENAME);
			//$ext = pathinfo($file_name, PATHINFO_EXTENSION);
			//$filename = substr($filename,0,80);	
			$strFileName = "convert_".$filename.".xlsx";		
			
			//echo  var_dump($strFileName);exit;

			$objWriter->save($strFileName);
			//echo  var_dump($strFileName);exit;
			rename($strFileName, $fullpath.$closepath.$strFileName);
			return true;	
			
						
		}	
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