<?php


class lkup_investigate extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'trn_transfer';
	}

    public function attributeLabels() {
        return array(
        );
    }
	
    public function search($code=null,$cntmin=null,$cntmax=null) 
	{
					
		//Yii::app()->CommonFnc->log_events("export", "step1", "auo job");
		require_once(Yii::getPathOfAlias('application') .'/vendor/Classes/PHPExcel.php');
		date_default_timezone_set("Asia/Bangkok");
		// Create new PHPExcel object
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

    //$sheet->getStyle("A1:B1")->applyFromArray($style);
		//Yii::app()->CommonFnc->log_events("export", "step2", "auo job");
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
		
		
		// Add some data
		
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
			
		$objPHPExcel->getActiveSheet()
					->getColumnDimension('A')->setWidth(15);
		$objPHPExcel->getActiveSheet()
					->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()
					->getColumnDimension('C')->setWidth(15);
		$objPHPExcel->getActiveSheet()
					->getColumnDimension('D')->setWidth(20);
		$objPHPExcel->getActiveSheet()
					->getColumnDimension('E')->setWidth(30);
		$objPHPExcel->getActiveSheet()
					->getColumnDimension('F')->setWidth(20);
		$objPHPExcel->getActiveSheet()
					->getColumnDimension('G')->setWidth(20);
		$objPHPExcel->getActiveSheet()
					->getColumnDimension('H')->setWidth(40);
		$objPHPExcel->getActiveSheet()
					->getColumnDimension('I')->setWidth(15);
		$objPHPExcel->getActiveSheet()
					->getColumnDimension('J')->setWidth(50);
					
		
		
		ini_set('max_execution_time', 300);
		
		//Yii::app()->CommonFnc->log_events("export", "step3", "auo job");
		$sql ="select a.doc_no,CONCAT(ifnull(date_format(a.doc_date,'%d/%m/'),''),ifnull(date_format(a.doc_date,'%Y')+543,'') )as doc_date, ";
		$sql.="a.acc_employer,a.business_name, ";
		$sql.="CONCAT(ifnull(a.name,''),ifnull(a.company_name,'')) as name, a.lname, ";
		$sql.="CONCAT(ifnull(a.pid,''),ifnull(a.cid,'') )as pid  , ";
		$sql.="CONCAT(ifnull(date_format(a.birth,'%d/%m/'),''),ifnull(date_format(a.birth,'%Y')+543,'') )as birth, ";
		$sql.="a.address, b.business_order ";
		$sql.="from tran_exportreq_item a ";
		$sql.="left join mas_businesstype b on a.business_type=b.id ";
		$sql.="where a.status=1 and a.code='".$code."' and (a.request_id>='".$cntmin."' and a.request_id<='".$cntmax."') ";	
		$sql.=" order by CASE WHEN b.business_order Is NULL Then 1 Else 0 End, b.business_order,a.id";
		//echo var_dump($sql);
		//exit;
		$data =Yii::app()->db->createCommand($sql)->queryAll();
		$i = 2;
		//Yii::app()->CommonFnc->log_events("fopen excel", " data ok", "auo job");
		
		
		//Yii::app()->CommonFnc->log_events("export", "step4", "auo job");
		foreach($data as $objResult)
		{
			
			$objPHPExcel->getActiveSheet()->setCellValueExplicit('A' . $i, $code);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit('B' . $i, $objResult["doc_no"],PHPExcel_Cell_DataType::TYPE_STRING);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit('C' . $i, $objResult["doc_date"]);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit('D' . $i, $objResult["acc_employer"],PHPExcel_Cell_DataType::TYPE_STRING);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit('E' . $i, $objResult["business_name"],PHPExcel_Cell_DataType::TYPE_STRING);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit('F' . $i, ltrim($objResult["name"]),PHPExcel_Cell_DataType::TYPE_STRING);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit('G' . $i, ltrim($objResult["lname"]),PHPExcel_Cell_DataType::TYPE_STRING);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit('H' . $i, $objResult["pid"]);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit('I' . $i, $objResult["birth"]);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit('J' . $i, ltrim($objResult["address"]),PHPExcel_Cell_DataType::TYPE_STRING);			
			
			$i++;
		}
		
		//Yii::app()->CommonFnc->log_events("export", "step5", "auo job");
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->getActiveSheet()->setTitle('Sheet1');
      	$objPHPExcel->setActiveSheetIndex(0);
      	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		
		//Yii::app()->CommonFnc->log_events("export", "step6", "auo job");
		//if($objResult["doc_no"]=='' || $objResult['doc_date']==''){
			$dr_folder = Yii::app()->params['prg_ctrl']['path']['media'].Yii::app()->params['prg_ctrl']['path']['closepath'].'temp';								
			@mkdir($dr_folder,0755,true);
		

		//Yii::app()->CommonFnc->log_events("export", "step6_1", "auo job");		
			//$excelFileName = "SSO_".$code.".xls";
			$txtfileName = $dr_folder.Yii::app()->params['prg_ctrl']['path']['closepath']."SSO_".$code.".txt";
			$x = 2;	
				$obj = fopen($txtfileName, "w");
				//Yii::app()->CommonFnc->log_data("fopen text", " data ok", "auo job");
				
		//Yii::app()->CommonFnc->log_events("export", "step6_2", "auo job");				
				foreach($data as $objResult)
				{
					//mb_internal_encoding("UTF-8");
					//str_repeat('&nbsp;', 5);
					$errlog = $objResult['acc_employer'];
					//Yii::app()->CommonFnc->log_events("export", "step6_3_".$errlog, "auo job");
					/*
					if($objResult['acc_employer']=='2500011674'){
						fwrite($obj, 
							Yii::app()->CommonFnc->ex_pad($code, 5).
							Yii::app()->CommonFnc->ex_pad($objResult['doc_no'], 20).
							Yii::app()->CommonFnc->ex_pad($objResult['doc_date'], 10).						
							Yii::app()->CommonFnc->ex_pad($objResult['acc_employer'], 10).
							Yii::app()->CommonFnc->ex_pad($objResult['business_name'], 20).
							Yii::app()->CommonFnc->ex_pad(ltrim($objResult['name']), 50).
							Yii::app()->CommonFnc->ex_pad(ltrim($objResult['lname']), 50).
							Yii::app()->CommonFnc->ex_pad($objResult['pid'], 20).
							Yii::app()->CommonFnc->ex_pad($objResult['birth'], 10).
							Yii::app()->CommonFnc->ex_pad(ltrim($objResult['address']), 200)."\r\n");						
					} else {	
					*/
					
					fwrite($obj, 
						Yii::app()->CommonFnc->ex_pad($code, 5).
						Yii::app()->CommonFnc->ex_pad($objResult['doc_no'], 20).
						Yii::app()->CommonFnc->ex_pad($objResult['doc_date'], 10).						
						Yii::app()->CommonFnc->ex_pad($objResult['acc_employer'], 10).
						Yii::app()->CommonFnc->ex_pad($objResult['business_name'], 20).
						Yii::app()->CommonFnc->ex_pad(ltrim($objResult['name']), 50).
						Yii::app()->CommonFnc->ex_pad(ltrim($objResult['lname']), 50).
						Yii::app()->CommonFnc->ex_pad($objResult['pid'], 20).
						Yii::app()->CommonFnc->ex_pad($objResult['birth'], 10).
						Yii::app()->CommonFnc->ex_pad(ltrim($objResult['address']), 200)."\r\n");						
						
					/*}*/
					$x++;
				}
				fclose($obj);

				//Yii::app()->CommonFnc->log_events("export", "step7", "auo job");
				$excelFileName = $dr_folder.Yii::app()->params['prg_ctrl']['path']['closepath']."SSO_".$code.".xls";
			//	$objWriter->save($excelFileName);	
				//Yii::app()->CommonFnc->log_data("create file", "1/3 gen data ok", "auo job");
				
				//Yii::app()->CommonFnc->log_events("export", "step8", "auo job");
				$filezip = Yii::app()->params['prg_ctrl']['path']['media'].Yii::app()->params['prg_ctrl']['path']['closepath']."SSO_".$code.".zip";
				$filename = "SSO_".$code.".zip";
				Yii::app()->session['filename']=Yii::app()->params['prg_ctrl']['url']['media'].$filename;
				
				$rootPath = realpath($dr_folder);
				$zip = new ZipArchive();
				$zip->open($filezip, ZipArchive::CREATE | ZipArchive::OVERWRITE);
				//Yii::app()->CommonFnc->log_data("open zip", "2/3 gen data ok", "auo job");
				// Create recursive directory iterator				
				$files = new RecursiveIteratorIterator(
					new RecursiveDirectoryIterator($rootPath),
					RecursiveIteratorIterator::LEAVES_ONLY
				);
				//Yii::app()->CommonFnc->log_events("export", "step9", "auo job");
				//$i = 1;
				$dir = $dr_folder;
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
				//Yii::app()->CommonFnc->log_data("zip ok", "ok", "auo job");
				deleteDirectory($dr_folder);	
				
				$size = filesize($filezip); 		   
					
				//Yii::app()->CommonFnc->log_events("export", "step10", "auo job");
				
    	
		$file_id = Yii::app()->session['file_id'];
		$id = Yii::app()->session['id'];
		
		$sql = "update tran_file set name=:name, upload_path=:path, upload_url=:url,file_type=:filetype,file_size=:file_size,object_id=:object_id ";			
		$sql.= "where status=1 and id='".$file_id."' ";
		$command=yii::app()->db->createCommand($sql);
		$command->bindValue(":name", $filename);	
		$command->bindValue(":path", Yii::app()->params['prg_ctrl']['path']['media']);
		$command->bindValue(":url", Yii::app()->params['prg_ctrl']['url']['media']);
		$command->bindValue(":filetype", ".zip");
		$command->bindValue(":file_size", $size);	
		$command->bindValue(":object_id", $id);	
			if($command->execute()) {
				Yii::app()->session->remove('id');		
				Yii::app()->session->remove('file_id');	
			}else { 
				Yii::app()->session['errmsg_investigate']='เกิดข้อผิดพลาดบันทึก1'.$sql;
				return false;
			}
			
		
	}
	
	public function datein($doc_no=null,$st_date=null,$en_date=null) {		
		
		$sql ="select count(*) as number from tran_request where status!=0 and status=2 ";
		$sql.="and doc_no='".$doc_no."' and (doc_date>='".$st_date."' and doc_date<='".$en_date."') ";
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;		
			
		
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