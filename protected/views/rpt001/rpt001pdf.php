<?php


 	require_once(Yii::getPathOfAlias('application') .Yii::app()->params['prg_ctrl']['vendor']['tcpdf']['path']);
	
	class ConductPDF extends CustomTCPDF {	
		public $para01;   
		public $para02;     
		public $para03; 
		public $para04; 
	
		function Header(){
			// Header Content
			date_default_timezone_set("Asia/Bangkok");
			$y = date('Y')+543;
			$m = date('d/m/');
			$t = date(' (H:i:s)');

			$this->Image(Yii::app()->params['prg_ctrl']['logo_path'],10,5,20,20);
			$this->SetFont('thsarabun', 'I', 14);
			$this->Cell(0,-7,'วันที่พิมพ์ '.$m.$y.$t,0,-1,"R");
	 		//$this->Cell(0,-7,'วันที่พิมพ์ '.date('d/m/y (h:i:s)'),0,-1,"R");
			$this->Ln(0);
			
			$this->SetFont('thsarabun', 'b', 18);
        	$this->Cell(0, -7,"รายงานการส่งข้อมูลกลับของ".$this->para01." (ชุดข้อมูลที่ ".$this->para02.")", 0, 1, 'C');
			$this->Ln(7);
			//$this->SetFont('thsarabun', 'b', 14);
			//$this->Cell(90,-10,'เลขชุดหนังสือ : ''     '.'ธนาคาร : '.$this->para02,0,0,"L");
			$this->Ln(7);
						
			// Header Table Config
			$colconfig = array(
				//array('text', width, text align), //////////////////////////////////////////////////
				 array('ลำดับ', 15, 'C'), 
				 array('เลขที่บัญชีนายจ้าง', 40, 'C'),
				 array('ประเภทธุรกิจ', 50, 'C'),
				 array('ชื่อ', 60, 'C'), 
				 array('นามสกุล', 60, 'C'),
				 array('วันที่ธนาคารตรวจสอบ', 50, 'C'),					 
			);
			$height = 9;
			$textcolor = '30';
			$bgColor = '200';
			$fontsize = '14';
			
			
			// Header Table
			$this->SetFillColor($bgColor);
			$this->SetTextColor($textcolor);
			$this->SetFont('THSarabun','b',$fontsize);
			foreach ($colconfig as $col) {
				$this->Cell($col[1], $height, $col[0], 1, 0, $col[2], true);
			}
			$this->Ln();
		}

		public function Footer() {
			$this->SetY(-15);
			$this->SetFont('thsarabun', 'I', 8);
			$this->Cell(0, 12, 'หน้า '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		}					
	}

	// Column Config
	$body_row_height = 6;
	$body_row_height2 = 10;
	$body_textcolor = '30';
	$body_isbgColor = false;
	$body_bgColor = '255';
	$body_fontsize = '12';	
	$body_colconfig = array(
		//array('column', width, digit per line, text align), //////////////////////////////////////////////////
				 array('ลำดับ', 15, 0,'C'), 
				 array('เลขที่บัญชีนายจ้าง', 40, 0, 'C'),
				 array('ประเภทธุรกิจ', 50, 0, 'L'),
				 array('ชื่อ', 60, 0, 'L'), 
				 array('นามสกุล', 60, 0, 'L'),
				 array('วันที่ธนาคารตรวจสอบ', 50, 0, 'C'),
		  
	  );
			  
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
	$pdf->SetMargins(10, 36, 10);//$pdf->SetMargins(PDF_MARGIN_LEFT, 30.8, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	
	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	
	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	//SQL For Group

		
	
	$groupdata=rpt_001::getGroup($code,$id);
	
	$grpi = 1;	
	//$groupdata =Yii::app()->db->createCommand($sql)->queryAll();
	foreach ($groupdata as $grouprow)
	{
			$pdf->para01=$grouprow['bank_name'];
			$pdf->para02=$grouprow['code'];
			//$pdf->para03=$grouprow['bank'];
			//$pdf->para04=$grouprow['cnt'];
	
			$pdf->AddPage('L','A4');
		//echo var_dump($code."-".$id);exit;
			// Get data
			$data=rpt_001::getData($code,$id);

			// Data
			$pdf->SetFillColor($body_bgColor);
			$pdf->SetTextColor($body_textcolor);
			$pdf->SetFont('THSarabun','B',$body_fontsize);
			$rowcnt=0;
			foreach ($data as $row)
			{
				$i = 0;
				$isMultiline = false;
				$row_height = $body_row_height;
				foreach ($row as $field) {
					if($body_colconfig[$i][2]>0) { if(strlen($field)>$body_colconfig[$i][2]){ $isMultiline = true; $row_height = $body_row_height2; break; } }					
					$i++;
				}		
				
				$i = 0;
				foreach ($row as $field) {
					$x_axis=$pdf->getx(); 
					$y_axis=$pdf->gety();
					if($i==0){
						$pdf->vcell($body_colconfig[$i][1],$row_height,$x_axis,$y_axis,$rowcnt+1, 1, $body_colconfig[$i][3],$body_isbgColor,$body_colconfig[$i][2],$isMultiline);
					} else {
						$pdf->vcell($body_colconfig[$i][1],$row_height,$x_axis,$y_axis,$field, 1, $body_colconfig[$i][3],$body_isbgColor,$body_colconfig[$i][2],$isMultiline);
					}
					$i++;
				}
				
				$rowcnt++;
				$pdf->Ln();
			}
			
	}



/*
		$grpi++;
	}

*/




		
	$pdf->Output();
	exit;
	/*
	foreach ($groupdata as $grouprow)
	{
		ini_set('max_execution_time', 120);
			$pdf->para01=$grouprow['bank_name'];
			$pdf->para02=$grouprow['code'];
			//$pdf->para03=$grouprow['bank'];
			//$pdf->para04=$grouprow['cnt'];
	
			$pdf->AddPage('L','A4');
		//echo var_dump($code."-".$id);exit;
			// Get data
			$data=rpt_001::getData($code,$id);

			// Data
			$pdf->SetFillColor($body_bgColor);
			$pdf->SetTextColor($body_textcolor);
			$pdf->SetFont('THSarabun','B',$body_fontsize);
			$rowcnt=0;
			$h="";
			foreach ($data as $row)
			{			
					
				
						
			}
			/*
			$h = '<table border="1" style="padding-left:5px;padding-right:0px;" >';
			foreach ($data as $row)
			{			
					
				$h.='<tr nobr="true">';
				$h.='<td style="width:53px;text-align:center;">'.($rowcnt+1).'</td>';
				$h.='<td style="width:142px;text-align:center;">'.$row['acc_employer'].'</td>';
				$h.='<td style="width:177px;text-align:left;">'.$row['business_name'].'</td>';
				$h.='<td style="width:212.8px;text-align:left;">'.$row['name'].'</td>';
				$h.='<td style="width:212.5px;text-align:left;">'.$row['lname'].'</td>';
				$h.='<td style="width:177px;text-align:left;">'.$row['request_date'].'</td>';
				$h.='</tr>';	
				$rowcnt++;	
						
			}
			$h.='</table>';
			
			$pdf->writeHTML($h, true, false, true, false, '');			

		$grpi++;
	}

		
	$pdf->Output();
	exit;
*/
	
?>

