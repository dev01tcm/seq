<?php

require_once(Yii::getPathOfAlias('application') .'/vendor/Classes/PHPExcel.php');
include(Yii::getPathOfAlias('application') .'/vendor/Classes/PHPExcel/IOFactory.php');



$inputFileName = "2.xls";  
$inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
$objReader->setReadDataOnly(true);  
$objPHPExcel = $objReader->load($inputFileName);  


$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
$highestRow = $objWorksheet->getHighestRow();
$highestColumn = $objWorksheet->getHighestColumn();

$headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
$headingsArray = $headingsArray[1];

$r = 0;
$namedDataArray = array();
for ($row = 2; $row <= $highestRow; ++$row) {
    $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
        ++$r;
       	$namedDataArray[$r] = $dataRow[$row];
    }
}

echo "<table>";
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
				$bank_id = $xls_value['I'];	
			$bank_dep_id = $xls_value['J'];	
				
				echo "<tr><td>".$code."</td><td>".$doc_no."</td><td>".$doc_date."</td><td>".$acc_employer."</td><td>".$business_name."</td><td>".$name."</td><td>".$lname."</td><td>".$pid."</td><td>".$bank_id."</td><td>".$bank_dep_id."</td></tr>";
				$r++;
				
			}
			
		
		
		
		
		
		echo "</table>";


?>

