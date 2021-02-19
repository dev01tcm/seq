<?php

	//define('FPDF_FONTPATH',Yii::getPathOfAlias('application') .Yii::app()->params['prg_ctrl']['vendor']['tfpdf']['fontpath']);
 	require_once(Yii::getPathOfAlias('application') .Yii::app()->params['prg_ctrl']['vendor']['tcpdf']['oripath']);
	require_once(Yii::getPathOfAlias('application') .Yii::app()->params['prg_ctrl']['vendor']['tcpdf']['confpath']);

	class CustomTCPDF extends TCPDF {


		function vcell($c_width,$c_height,$x_axis,$y_axis,$text ,$border,$align,$fill,$cntperline,$isMultiline){
			if($isMultiline==false){
				$this->SetX($x_axis);
				$this->Cell($c_width,$c_height,$text,$border,0,$align,$fill);						
				return;
			} 
			
			$w_w=$c_height/2;
			$lineheight1=$w_w;
			$lineheight2=$c_height;						
			
			$y_axis2=$y_axis+$lineheight1-0.7;
			
			$len=strlen($text);
			if($len>$cntperline && $cntperline>0){
				/*
				$w_text=str_split($text,$cntperline);

				$this->SetX($x_axis);
				$this->Cell($c_width,$lineheight1,$w_text[0],'','',$align,$fill);
				
				$this->SetY($y_axis2);
				$this->SetX($x_axis);				
				$this->Cell($c_width,$lineheight1,$w_text[1],'','',$align,$fill);
				$this->SetY($y_axis);

				$this->SetX($x_axis);
				$this->Cell($c_width,$c_height,'','LTRB',0,$align,$fill);
				*/
				
				$this->SetX($x_axis);
				$this->Cell($c_width,$c_height,$text,$border,0,$align,$fill);
			}
			else{
				
				$this->SetX($x_axis);
				$this->Cell($c_width,$c_height,$text,$border,0,$align,$fill);
								
			}
		}	
	}

?>
