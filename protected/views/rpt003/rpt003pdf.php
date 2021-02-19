<?php


 	require_once(Yii::getPathOfAlias('application') .Yii::app()->params['prg_ctrl']['vendor']['tcpdf']['path']);
	
	class ConductPDF extends CustomTCPDF {	
		public $para01;   
		public $para02;     
		public $para03; 
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
			
			$this->SetFont('thsarabun', 'b', 18);
        	$this->Cell(0, -7,"รายงานรายละเอียดการบันทึกข้อมูล", 0, 1, 'C');
			$this->Ln(7);
/*			$this->SetFont('thsarabun', 'b', 14);
			$this->Cell(90,-10,'เลขชุดหนังสือ : '.$this->para01.'                   '.'วันที่ส่งออกข้อมูล : '.$this->para08,0,0,"L");
			$this->Ln(7);
*/
			$this->SetFont('thsarabun', 'b', 14);
			$this->Cell(90,-10,'รหัสจังหวัด : '.$this->para02,0,0,"L");	
			$this->Ln(8);
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
	$pdf->SetMargins(5, 33 , 10);//$pdf->SetMargins(PDF_MARGIN_LEFT, 30.8, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	
	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	
	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	//SQL For Group

		
			
	$groupdata=rpt_003::getGroup($code_no,$code);

	$grpi = 1;		
	foreach ($groupdata as $grouprow)
	{
			$pdf->para01=$grouprow['code_no'];
			$pdf->para02=$grouprow['code'];
			$pdf->para03=$grouprow['cnt']; 
			$pdf->AddPage('L','A4');
			

			// Get data
			$data=rpt_003::getData($code_no,$pdf->para02);
			
			$pdf->SetFont('THSarabun','',12);			
			$rowcnt=0;			
			$h = '<table border="0.8" style="padding-left:5px;padding-right:0px;">';
			$h.='<thead>';
			$h.='<tr style="background-color:#d4d4d4;text-align:center;font-size:13pt;font-weight:bold;">';
			$h.='<td style="width:40px;">ที่</td>';
			$h.='<td style="width:60px;">ชุดหนังสือ</td>';
			$h.='<td style="width:100px;">เลขที่หนังสือ</td>';
			$h.='<td style="width:90px;">เลขบัญชีนายจ้าง</td>';
			$h.='<td style="width:135px;">คำนำหน้าชื่อ/ประเภทธุรกิจ</td>';
			$h.='<td style="width:200px;">ชื่อ</td>';	
			$h.='<td style="width:95px;">เลข ป.ช.ช./เลขนิติบุคคล</td>';
			$h.='<td style="width:65px;">ว/ด/ป เกิด</td>';	
			$h.='<td style="width:230px;">ที่อยู่</td>';
			$h.='</tr>';
			$h.='</thead>';
			foreach ($data as $row)
			{					
				$h.='<tr nobr="true">';
				$h.='<td style="width:40px;text-align:center;">'.($rowcnt+1).'</td>';
				$h.='<td style="width:60px;text-align:center;">'.$row['code'].'</td>';
				$h.='<td style="width:100px;text-align:left;">'.$row['doc_no'].'</td>';
				$h.='<td style="width:90px;text-align:center;">'.$row['acc_employer'].'</td>';
				$h.='<td style="width:135px;text-align:left;">'.$row['business_name'].'</td>';
				$h.='<td style="width:200px;text-align:left;">'.$row['fullname'].'</td>';
				$h.='<td style="width:95px;text-align:left;">'.$row['pcid'].'</td>';
				$h.='<td style="width:65px;text-align:center;">'.$row['birth'].'</td>';
				$h.='<td style="width:230px;text-align:left;">'.$row['address'].'</td>';
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

