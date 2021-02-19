<?php
	ob_start();
	require_once(Yii::getPathOfAlias('application') .'/vendor/Classes/PHPExcel.php');
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="report001.xls"');
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
					->getStyle("A1:J3")->applyFromArray($style)
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
		
		$groupdata=rpt_001::getGroup($code,$id);	
	
		//$groupdata =Yii::app()->db->createCommand($sql)->queryAll();
		foreach ($groupdata as $grouprow)
		{			
			$bank_name=$grouprow['bank_name'];
			$code=$grouprow['code'];
		}
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'รายงานการส่งข้อมูลกลับของ'.$bank_name.' (ชุดข้อมูลที่ '.$code.')');	
		$objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
		$objPHPExcel->setActiveSheetIndex(0)
			 ->setCellValue('A3', 'ลำดับ')
			 ->setCellValue('B3', 'เลขที่บัญชีนายจ้าง')
			 ->setCellValue('C3', 'ประเภทธุรกิจ')
			 ->setCellValue('D3', 'ชื่อ')
			 ->setCellValue('E3', 'นามสกุล')
			 ->setCellValue('F3', 'วันที่ธนาคารตรวจสอบ');
		$objPHPExcel->getActiveSheet()->getStyle("A:F")->getFont()->setName('angsanaupc')->setSize(16);		
			
		$objPHPExcel->getActiveSheet()
					->getColumnDimension('A')->setWidth(10);
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
		//$objPHPExcel->getDefaultStyle('A2')->applyFromArray($style);
		
		$data=rpt_001::getData($code,$id);
		//$data =Yii::app()->db->createCommand($sql)->queryAll();
		$i = 4;
		
		foreach($data as $objResult)
		{
			//$objPHPExcel->getActiveSheet()->getStyle('A1'.$i)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($style)->getFont()->setName('angsanaupc')->setSize(16);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit('A' . $i, $objResult["no"]);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit('B' . $i, $objResult["acc_employer"]);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit('C' . $i, $objResult["business_name"]);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit('D' . $i, $objResult["name"]);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit('E' . $i, $objResult["lname"]);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit('F' . $i, $objResult["request_date"]);
			$i++;
		}
		
		$objPHPExcel->getActiveSheet()->setTitle('Sheet1');
      	$objPHPExcel->setActiveSheetIndex(0);
      	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');		
		$objWriter->save('php://output');	
		die();
		/*
		$workbook->close();
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment; filename=".basename("$xlsName").";");
header("Content-Transfer-Encoding: binary ");
header("Content-Length: ".filesize($fname));
readfile($fname); 
unlink($fname);
*/
?>

