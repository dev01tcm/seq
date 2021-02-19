<?php

class frm_hisinvestigate_tsd extends CFormModel
{
	 public $id;
	 public $code;
	 public $doc_no;
	 public $doc_date;
     public $doc_datebegin;
	 public $doc_dateend;
	public function rules()
 	{
  		return array(
   			array('code', 'id', 'doc_no', 'doc_date', 'safe','doc_datebegin','doc_dateend'),    
  		);
 	}

 	public function attributeLabels()
 	{
  		return array();
 	}

	public function file_investigate()
 	{

		$updateby = !Yii::app()->user->isGuest?Yii::app()->user->id:0; 
		date_default_timezone_set("Asia/Bangkok");
 
  		$sql = "update tran_exportreq_tsd set doc_no=:doc_no, doc_date=:doc_date,beggin_trans_date=:doc_datebegin,end_trans_date=:doc_dateend, update_date=now(), update_by=$updateby where id='".$this->id."'";
  		$command=yii::app()->db->createCommand($sql);   
		$command->bindValue(":doc_no", $this->doc_no);  
		$command->bindValue(":doc_date", $this->doc_date);
		$command->bindValue(":doc_datebegin", $this->doc_datebegin); 
			$command->bindValue(":doc_dateend", $this->doc_dateend); 
   		if($command->execute()) {
    		$sql = "update tran_exportreq_item_tsd set doc_no=:doc_no, doc_date=:doc_date, update_date=now(), update_by=$updateby where exportreq_id='".$this->id."'";
    		$command=yii::app()->db->createCommand($sql);   
    		$command->bindValue(":doc_no", $this->doc_no);  
    		$command->bindValue(":doc_date", $this->doc_date); 
     		if($command->execute()) { 
      			require_once(Yii::getPathOfAlias('application') .'/vendor/Classes/PHPExcel.php');
      			$objPHPExcel = new PHPExcel(); 
      			$style = array(
       				'alignment' => array(
       				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
       				)
      			);
      			$txt = array(
       				'alignment' => array(
       				'horizontal' => PHPExcel_Style_NumberFormat::FORMAT_TEXT,
       				)
      			);
    
      			$objPHPExcel->getActiveSheet()
			 		->getStyle("A1:J1")->applyFromArray($style)
			 		->getFont()
			 		->setName('angsanaupc')
			 		->setSize(16)
			 		->setBold(true);
    
      // Set properties
      			$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
              		->setLastModifiedBy("Maarten Balliauw")
              		->setTitle("Office 2007 XLSX Test Document")
              		->setSubject("Office 2007 XLSX Test Document")
              		->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
              		->setKeywords("office 2007 openxml php")
              		->setCategory("Test result file");
      
      			$objPHPExcel->setActiveSheetIndex(0)
         			->setCellValue('A1', 'เลขที่ชุดข้อมูล')
         			->setCellValue('B1', 'เลขที่หนังสือ')
         			->setCellValue('C1', 'วันที่หนังสือ')
					->setCellValue('D1', 'เลขที่บัญชีนายจ้าง')
					->setCellValue('E1', 'คำนำหน้าชื่อ/ประเภทธุรกิจ')
					->setCellValue('F1', 'ชื่อ')
					->setCellValue('G1', 'สกุล')
					->setCellValue('H1', 'เลขประจำตัวประชาชน/เลขทะเบียนพาณิชย์')
					->setCellValue('I1', 'วัน เดือน ปี เกิด')
					->setCellValue('J1', 'ที่อยู่');
				$objPHPExcel->getActiveSheet()->getStyle("A:J")->getFont()->setName('angsanaupc')->setSize(16); 				
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(40);
				$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
				$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(50);
         
      
				$sql ="select a.id, a.code,a.doc_no, ";
				$sql.="CONCAT(ifnull(date_format(a.doc_date,'%d/%m/'),''),ifnull(date_format(a.doc_date,'%Y')+543,''))as doc_date, ";
				$sql.="a.acc_employer,a.business_name, ";
				$sql.="CONCAT(ifnull(a.name,''),ifnull(a.company_name,'')) as name, a.lname, ";
				$sql.="CONCAT(ifnull(a.pid,''),ifnull(a.cid,'') )as pid  , ";
				$sql.="CONCAT(ifnull(date_format(a.birth,'%d/%m/'),''),ifnull(date_format(a.birth,'%Y')+543,'') )as birth, ";
				$sql.="a.address, b.business_order ";
				$sql.="from tran_exportreq_item_tsd a ";
				$sql.="left join mas_businesstype b on a.business_type=b.id ";
				$sql.="where exportreq_id='".$this->id."' ";   
				$sql.=" order by CASE WHEN b.business_order Is NULL Then 1 Else 0 End, b.business_order,a.id";				
				$data =Yii::app()->db->createCommand($sql)->queryAll();
				
     	 		$sql = "select code from(select id,code,name from mas_bank ) aa group by code";  
      			$data1 =Yii::app()->db->createCommand($sql)->queryAll();  
				
       			$x = 2;
       			$grpi = 1;
       			foreach ($data1 as $dataitem)
       			{
        			$bank = $dataitem['code'];					
					$setformat = Yii::app()->params['export_ctrl']['excel']['setformat'];
					//if("test"==$setformat){	
					$i = 2;		
					//Yii::app()->CommonFnc->log_data("fopen excel", " data ok", "auo job");
					if (in_array($bank,$setformat) ){						
						foreach($data as $objResult)
						{       
							$objPHPExcel->getActiveSheet()->setCellValueExplicit('A' . $i, $objResult["code"],PHPExcel_Cell_DataType::TYPE_STRING);
							$objPHPExcel->getActiveSheet()->setCellValueExplicit('B' . $i, $objResult["doc_no"],PHPExcel_Cell_DataType::TYPE_STRING);
							$objPHPExcel->getActiveSheet()->setCellValueExplicit('C' . $i, $objResult["doc_date"]);
							$objPHPExcel->getActiveSheet()->setCellValueExplicit('D' . $i, $objResult["acc_employer"],PHPExcel_Cell_DataType::TYPE_STRING);
							$objPHPExcel->getActiveSheet()->setCellValueExplicit('E' . $i, mb_substr($objResult['business_name'], 0, 20, "utf-8"),PHPExcel_Cell_DataType::TYPE_STRING);
							$objPHPExcel->getActiveSheet()->setCellValueExplicit('F' . $i, ltrim($objResult["name"]),PHPExcel_Cell_DataType::TYPE_STRING);
							$objPHPExcel->getActiveSheet()->setCellValueExplicit('G' . $i, ltrim($objResult["lname"]),PHPExcel_Cell_DataType::TYPE_STRING);
							$objPHPExcel->getActiveSheet()->setCellValueExplicit('H' . $i, $objResult["pid"]);
							$objPHPExcel->getActiveSheet()->setCellValueExplicit('I' . $i, $objResult["birth"]);
							$objPHPExcel->getActiveSheet()->setCellValueExplicit('J' . $i, ltrim($objResult["address"]),PHPExcel_Cell_DataType::TYPE_STRING);
							$i++;
						}			  			
					}else{					
						
						foreach($data as $objResult)
						{       
							$objPHPExcel->getActiveSheet()->setCellValueExplicit('A' . $i, $objResult["code"]);
							$objPHPExcel->getActiveSheet()->setCellValueExplicit('B' . $i, $objResult["doc_no"]);
							$objPHPExcel->getActiveSheet()->setCellValueExplicit('C' . $i, $objResult["doc_date"]);
							$objPHPExcel->getActiveSheet()->setCellValueExplicit('D' . $i, $objResult["acc_employer"]);
							$objPHPExcel->getActiveSheet()->setCellValueExplicit('E' . $i, mb_substr($objResult['business_name'], 0, 20, "utf-8"));
							$objPHPExcel->getActiveSheet()->setCellValueExplicit('F' . $i, ltrim($objResult["name"]));
							$objPHPExcel->getActiveSheet()->setCellValueExplicit('G' . $i, ltrim($objResult["lname"]));
							$objPHPExcel->getActiveSheet()->setCellValueExplicit('H' . $i, $objResult["pid"]);
							$objPHPExcel->getActiveSheet()->setCellValueExplicit('I' . $i, $objResult["birth"]);
							$objPHPExcel->getActiveSheet()->setCellValueExplicit('J' . $i, ltrim($objResult["address"]));
							$i++;
						}
					}
					$objPHPExcel->getActiveSheet()->setTitle('Sheet1');
					$objPHPExcel->setActiveSheetIndex(0);
					$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
					//$strFileName = "SSO_".$bank."_".$objResult['code'].".xls";
					
					$m_folder = Yii::app()->params['prg_ctrl']['path']['media'].Yii::app()->params['prg_ctrl']['path']['closepath'].$objResult['code'];
					@mkdir($m_folder,0755,true);										
					$dr_folder = $m_folder.Yii::app()->params['prg_ctrl']['path']['closepath']."SSO_".$bank."_".$objResult['code'];					
					@mkdir($dr_folder,0755,true);
										
        			$txtfilName = $dr_folder.Yii::app()->params['prg_ctrl']['path']['closepath']."SSO_".$bank."_".$objResult['code'].".txt";
         			$obj = fopen($txtfilName, "w");
					//Yii::app()->CommonFnc->log_data("fopen text", " data ok", "auo job");
         			foreach($data as $objResult)
         			{
          				fwrite($obj, 
           					Yii::app()->CommonFnc->ex_pad($objResult['code'], 5).
           					Yii::app()->CommonFnc->ex_pad($objResult['doc_no'], 20).
           					Yii::app()->CommonFnc->ex_pad($objResult['doc_date'], 10).      
							Yii::app()->CommonFnc->ex_pad($objResult['acc_employer'], 10).
							Yii::app()->CommonFnc->ex_pad(mb_substr($objResult['business_name'], 0, 20, "utf-8"), 20).
							Yii::app()->CommonFnc->ex_pad(ltrim($objResult["name"]), 50).
							Yii::app()->CommonFnc->ex_pad(ltrim($objResult['lname']), 50).
							Yii::app()->CommonFnc->ex_pad($objResult['pid'], 20).
							Yii::app()->CommonFnc->ex_pad($objResult['birth'], 10).
							Yii::app()->CommonFnc->ex_pad(ltrim($objResult['address']), 200)."\r\n");      
						$x++;
					}
					fclose($obj);
					
					$strFileName = $dr_folder.Yii::app()->params['prg_ctrl']['path']['closepath']."SSO_".$bank."_".$objResult['code'].".xls";
				//	$objWriter->save($strFileName);	
//Yii::app()->CommonFnc->log_data("create file", "1/3 gen data ok", "auo job");					
					$grpi++;        
				   }
				  $countall= count($data);
				  foreach($data as $objResult)
         			{
						$code=$objResult['code'];
						$doc_no=$objResult['doc_no'];
					 }
					 
				    $dom = new DOMDocument('1.0','UTF-8');
					$dom->formatOutput = true;

					$root = $dom->createElement('SSO');
					$dom->appendChild($root);
					


					$result = $dom->createElement('AuditHead');
					$root->appendChild($result);
					$result->appendChild( $dom->createElement('TotalAccount', $countall) );
					$result->appendChild( $dom->createElement('GovDepart', 'SSO') );
					$result->appendChild( $dom->createElement('DocID', $code) );
					$result->appendChild( $dom->createElement('RequestID', $this->doc_no) );
					$datass = $dom->createElement('Audittype');
					$result->appendChild($datass);
					$datass->appendChild( $dom->createElement('Audit', '00') );
					$datass->appendChild( $dom->createElement('Audit', 'XM') );
					$datass->appendChild( $dom->createElement('Audit', 'XD') );
					$result->appendChild( $dom->createElement('BeginTransDate',$this->doc_datebegin) );
					$result->appendChild( $dom->createElement('EndTransDate',$this->doc_dateend) );
					$result->appendChild( $dom->createElement('SendingDate',$this->doc_date) );
					foreach($data as $objResult)
         			{
						$resultdetail = $dom->createElement('Auditdetail');
						$root->appendChild($resultdetail);
						$resultdetail->appendChild( $dom->createElement('ReferenceID',$objResult['pid']) );
						$resultdetail->appendChild( $dom->createElement('FirstName', $objResult["name"]) );
						$resultdetail->appendChild( $dom->createElement('LastName', $objResult['lname']) );
						$resultdetail->appendChild( $dom->createElement('Address', $objResult['address']) );
					 }
                     $hostftp='192.168.1.105';
					 $port='80';
				//	echo '<xmp>'. $dom->saveXML() .'</xmp>';
					$dom->save("TSD/$code.xml")or die('XML Create Error');
					
				
				$sql = "select count(*) as cnt from tran_file where object_id='".$this->id."' ";
				$sql.= "and object_group='Export' and object_type='Bank' ";
				$data =Yii::app()->db->createCommand($sql)->queryAll();
				foreach($data as $dataitem)
				{
					if($dataitem['cnt']==0){
						$filezip = Yii::app()->params['prg_ctrl']['path']['media'].Yii::app()->params['prg_ctrl']['path']['closepath']."SSO_".$objResult['code']."_Bank".".zip";
						$filename = "SSO_".$objResult['code']."_Bank".".zip";
					}else{
						$filezip = Yii::app()->params['prg_ctrl']['path']['media'].Yii::app()->params['prg_ctrl']['path']['closepath']."SSO_".$objResult['code']."_Bank(".$dataitem['cnt'].")".".zip";
						$filename = "SSO_".$objResult['code']."_Bank(".$dataitem['cnt'].")".".zip";
					}
				}
				Yii::app()->session['filename']=Yii::app()->params['prg_ctrl']['url']['media'].$filename;
		
				$rootPath = realpath($m_folder);
				$zip = new ZipArchive();
				$zip->open($filezip, ZipArchive::CREATE | ZipArchive::OVERWRITE);
		//Yii::app()->CommonFnc->log_data("open zip", "2/3 gen data ok", "auo job");
				// Create recursive directory iterator				
				$files = new RecursiveIteratorIterator(
					new RecursiveDirectoryIterator($rootPath),
					RecursiveIteratorIterator::LEAVES_ONLY
				);
		
				//$i = 1;
				$dir = $m_folder;
				foreach ($files as $name => $file)
				{				
					//Yii::app()->CommonFnc->log_data("add file", "3/3 gen data ok", "auo job");
					if (!$file->isDir())
					{
						$filePath = $file->getRealPath();
						$relativePath = substr($filePath, strlen($rootPath) + 1);							
												
						$zip->addFile($filePath, $relativePath);
													
					}							   
					//$i++;        
       			}
				$zip->close();	
	   
				deleteDirectory($m_folder);				
				$size = filesize($filezip); 
				
				$sql = "insert into tran_file (name,object_id,object_group,object_type,upload_path,upload_url,file_type, ";
				$sql.= "file_size,create_date,create_by) ";
				$sql.= "VALUES(:name,:object_id,:object_group,:object_type,:upload_path,:upload_url,:file_type, ";
				$sql.= ":file_size,now(),$updateby)";
				$command=yii::app()->db->createCommand($sql);
				$command->bindValue(":name", $filename);
				$command->bindValue(":object_id", $this->id);
				$command->bindValue(":object_group", "Export");
				$command->bindValue(":object_type", "Bank");
				$command->bindValue(":upload_path", Yii::app()->params['prg_ctrl']['path']['media']);
				$command->bindValue(":upload_url", Yii::app()->params['prg_ctrl']['url']['media']);
				$command->bindValue(":file_type", ".zip");
				$command->bindValue(":file_size", $size);
				if($command->execute()) 
				{		
					$id = Yii::app()->db->getLastInsertID();
					$sql = "select count(*) as cnt from tran_file where status=1 and object_id='".$this->id."' ";
					$sql.= "and object_type='Bank' and id!='".$id."' ";
					$data =Yii::app()->db->createCommand($sql)->queryAll();
					foreach($data as $dataitem)
					{
						if($dataitem['cnt']>0)
						{
							$sql = "update tran_file set status=0, update_date=now(), update_by=$updateby ";
							$sql.= "where status=1 and object_id='".$this->id."' and object_type='Bank' and id!='".$id."' ";
							$command=yii::app()->db->createCommand($sql);			
							if($command->execute()) {
								return true;
							}else { 
								Yii::app()->session['errmsg_hisinvestigate']='เกิดข้อผิดพลาดบันทึก2'.$sql;
								return false;
							}	
						}
					}					
					return true;
				}else { 
					Yii::app()->session['errmsg_hisinvestigate']='เกิดข้อผิดพลาดบันทึก1'.$sql;
					return false;
				}
      			return true;
     		} else {
      			Yii::app()->session['errmsg_hisinvestigate']='ไม่สามารถบันทึกข้อมูลได้'.$sql;
      			return false;
    		}    
    		return true;
   		} else {
    		Yii::app()->session['errmsg_hisinvestigate']='ไม่สามารถบันทึกข้อมูลได้'.$sql;
    		return false;
  		} 
 	} 
}
function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}