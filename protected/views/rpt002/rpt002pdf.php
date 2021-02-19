<?php


 	require_once(Yii::getPathOfAlias('application') .Yii::app()->params['prg_ctrl']['vendor']['tcpdf']['path']);
	
	class ConductPDF extends CustomTCPDF {	
		public $para01;   
		public $para02;     
		public $para03; 
		public $para04; 
		public $para05;
		public $para06; 
		public $para07;	
		public $para08;	
		public $margin_head;	
		function Header(){
			// Header Content
			date_default_timezone_set("Asia/Bangkok");
			$y = date('Y')+543;
			$m = date('d/m/');
			$t = date(' (H:i:s)');
			
			$this->Image(Yii::app()->params['prg_ctrl']['logo_path'],10,5,20,20);
			$this->SetFont('thsarabun', 'I', 14);
	 		$this->Cell(0,-7,'วันที่พิมพ์ '.$m.$y.$t,0,-1,"R");
			$this->Ln(7);
			$this->SetFont('thsarabun', 'I', 14);
	 		$this->Cell(0,-7,'พิมพ์โดย '.Yii::app()->user->getInfo('displayname'),0,-1,"R");
			$this->Ln(0);
			$this->SetFont('thsarabun', 'b', 18);
        	$this->Cell(0, -7,"ผลการสอบทรัพย์บัญชีธนาคาร แยกนายจ้าง", 0, 1, 'C');
			$this->Ln(7);
			$this->SetFont('thsarabun', 'b', 14);
			$this->Cell(90,-10,'เลขชุดหนังสือ : '.$this->para01.'                   '.'วันที่ส่งออกข้อมูล : '.$this->para08,0,0,"L");
			$this->Ln(7);
			$this->SetFont('thsarabun', 'b', 14);
			$this->Cell(90,-10,'เลขบัญชีนายจ้าง : '.$this->para02,0,0,"L");	
			$this->Ln(7);

			if($this->para07!=''){
				$last_name = '           นามสกุล : '.$this->para07;	
			}else{
				$last_name = '';	
			}	
			$this->SetFont('thsarabun', 'b', 14);
			$this->Cell(90,-10,'คำนำหน้าชื่อ/ประเภทธุรกิจ : '.$this->para05.'          ชื่อ : '.$this->para06.$last_name,0,0,"L");				
			$this->Ln(7);
			$this->SetFont('thsarabun', 'b', 14);
			$this->Cell(90,-10,'เลขที่บัตรประชาชน/เลขทะเบียนนิติบุคคล : '.$this->para03,0,0,"L");	
			$this->Ln(7);	
		}

		public function Footer() {
			$this->SetY(-15);
			$this->SetFont('thsarabun', 'I', 8);
			$this->Cell(0, 12, 'หน้า '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		}					
	}

	
	//ConductPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf = new ConductPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	
	// set default header data
	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
	
	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	
	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	
	// set margins
	$pdf->SetMargins(6, 55 , 10);//$pdf->SetMargins(PDF_MARGIN_LEFT, 30.8, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	
	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	
	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	//SQL For Group

		
			
	$groupdata=rpt_002::getGroup($doc_no,$emp_no,$people_no);
	
	$grpi = 1;	
	//$groupdata =Yii::app()->db->createCommand($sql)->queryAll();
	foreach ($groupdata as $grouprow)
	{
		
			$pdf->para01=$grouprow['code'];
			$pdf->para02=$grouprow['acc_employer'];
			$pdf->para03=$grouprow['pid'];
			$pdf->para05=$grouprow['business_name'];
			$pdf->para06=$grouprow['name'];
			$pdf->para07=$grouprow['lname'];			
			$pdf->para08=$grouprow['doc_date'];
			$pdf->AddPage('L','A4');
			
			
			// Get data
			$data=rpt_002::getData($pdf->para01,$pdf->para02,$pdf->para03);
				
			// Data			
			$pdf->SetFont('THSarabun','',12);
			
			$rowcnt=0;			
			$h = '<table border="0.8" style="padding-left:5px;padding-right:0px;">';
			$h.='<thead>';
			$h.='<tr style="background-color:#d4d4d4;text-align:center;font-size:13pt;font-weight:bold;">';
			$h.='<td style="width:30px;">ที่</td>';
			$h.='<td style="width:142px;">ชื่อธนาคาร</td>';
			$h.='<td style="width:50px;">รหัส ธนาคาร</td>';			
			$h.='<td style="width:50px;">รหัส สาขา</td>';
			$h.='<td style="width:110px;">ชื่อสาขา</td>';
			$h.='<td style="width:50px;">ประเภท บัญชี</td>';	
			$h.='<td style="width:115px;">เลขที่บัญชี</td>';
			$h.='<td style="width:150px;">ชื่อบัญชี</td>';	
			$h.='<td style="width:50px;">เครื่อง หมาย</td>';
			$h.='<td style="width:75px;">จำนวนเงิน</td>';	
			$h.='<td style="width:65px;">วันที่ สอบทรัพย์</td>';
			$h.='<td style="width:45px;">สถานะ</td>';
			$h.='<td style="width:80px;">หมายเหตุ</td>';
			$h.='</tr>';
			$h.='</thead>';
			foreach ($data as $row)
			{					
				$h.='<tr nobr="true">';
				$h.='<td style="width:30px;text-align:center;">'.($rowcnt+1).'</td>';
				$h.='<td style="width:142px;text-align:left;">'.$row['bank'].'</td>';
				$h.='<td style="width:50px;text-align:center;">'.$row['code_bank'].'</td>';
				$h.='<td style="width:50px;text-align:center;">'.$row['bank_dep_id'].'</td>';
				$h.='<td style="width:110px;text-align:left;">'.$row['bank_dep_name'].'</td>';
				$h.='<td style="width:50px;text-align:center;">'.$row['acc_type'].'</td>';
				$h.='<td style="width:115px;text-align:left;">'.$row['acc_no'].'</td>';
				$h.='<td style="width:150px;text-align:left;">'.$row['acc_name'].'</td>';
				$h.='<td style="width:50px;text-align:center;">'.$row['mark'].'</td>';
				$h.='<td style="width:75px;text-align:right;">'.$row['amont'].'</td>';
				$h.='<td style="width:65px;text-align:center;">'.$row['request_date'].'</td>';
				$h.='<td style="width:45px;text-align:center;">'.$row['check_status'].'</td>';
				$h.='<td style="width:80px;text-align:left;">'.$row['remark'].'</td>';
				$h.='</tr>';	
				$rowcnt++;			
			}
			$h.='</table>';
			$pdf->writeHTML($h, true, false, true, false, '');
			
		$grpi++;
		
	}
	$pdf->Output();
	exit;

	
?>

