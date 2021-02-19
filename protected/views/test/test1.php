<body>
    
<span class="btn btn-success fileinput-button">
    <i class="glyphicon glyphicon-plus"></i>
    <span>Select files...</span>
    <!-- The file input field used as target for the file upload widget -->
    <input id="fileupload" name="files[]" multiple="" type="file">
</span>

  </body>  
    
<script type="text/javascript">  
$(document).ready(function(){
    var url = 'uploads/';
    var formdata = {json: JSON.stringify({field1: 'value1'})};

    jQuery('#fileupload').fileupload({
        url: url,
        formData : formdata,        
        dataType: 'json',
        type: "POST",
        contentType:false,
        processData:false,
        success : function(data){                   
            alert('success...');
            //console.dir(data);
        }
    });       
});
</script>  

<?php
/*
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>





<script>
  // Here's a live example that downloads three test text files:
  function do_dl() {
    download_files([
      { download: "http://localhost/seq/uploads/Convert_60010070test%20%E0%B8%99%E0%B8%B3%E0%B9%80%E0%B8%82%E0%B9%89%E0%B8%B2.txt" },
     
    ]);
  };
</script>
<?php

/*$filename = 'uploads/Convert_Convert_60010070test นำเข้า(1).txt';
$file = iconv(mb_detect_encoding($filename, mb_detect_order(), true), "TIS-620", $filename);
if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}else{
	echo "Noo";
	echo $file;
}

/*
$filName = "customer.txt";
$objWrite = fopen("customer.txt", "w");

$objConnect = mysql_connect("localhost","root","1234") or die("Error Connect to Database");
$objDB = mysql_select_db("sequester");
$strSQL = "SELECT * FROM mas_bank";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");

while($objResult = mysql_fetch_array($objQuery))
{
	/*
	fwrite($objWrite, "\"$objResult[code]\",\"$objResult[name]\",\"$objResult[address]\",");
	fwrite($objWrite, "\"$objResult[email]\",\"$objResult[status]\",\"$objResult[create_date]\" \r\n");
	
	fwrite($objWrite, $objResult['email'].' '.$objResult['status'].' '.$objResult['create_date'].''."\r\n");
}
fclose($objWrite);
echo "<br>Generate Text File Done.<br><a href=$filName>Download</a>";


$raw_date = '1/2/2560 11:00:00 PM';

					// to disregard that PM escape it in the format
$new_date = DateTime::createFromFormat('d/m/Y H:i:s \P\M', $raw_date);
//echo "q";

echo $new_date->format('Y-m-d H:i:s'); // 2014-10-25 14:00:00
//echo $new_date;
//echo var_dump($new_date);
*//*
$aaa="asd";
$bbb="asdfg";
$ccc="asdfg";
$ddd="asdfg";
$eee="asdfg";
$fff="asdfg";
$ggg="asdfg";
$hhh="asdfg";
//echo chunk_split($aaa , 5 , '&nbsp;');
//echo str_pad($aaa, 300, ' ', STR_PAD_LEFT);
$x = 2;

$txtfilName = "sso.txt";
$obj = fopen($txtfilName, "w");

	//str_repeat('&nbsp;', 5);
	fwrite($obj, str_pad($aaa, 5, ' ', STR_PAD_RIGHT).str_pad($bbb, 6, ' ', STR_PAD_RIGHT).str_pad($ccc, 8, ' ', STR_PAD_RIGHT));
	fwrite($obj, $ddd.' '.$eee.' '.$fff.'');
	fwrite($obj, $ggg.' '.$hhh."\r\n");
	$x++;

fclose($obj);
*/
/*
$code='aaa';
$x = 2;
$txtfilName = "sso.txt";
$obj = fopen($txtfilName, "w");
$sql ="select a.doc_no,CONCAT(ifnull(date_format(a.doc_date,'%d/%m/'),''),ifnull(date_format(a.doc_date,'%Y')+543,'') )as doc_date, ";
		$sql.="a.acc_employer,a.business_name, ";
		//$sql.="CONCAT(a.name,' ', a.lname, ' ', ifnull(a.company_name,'') ) full_name, ";
		$sql.="CONCAT(a.name,ifnull(a.company_name,'')) name, a.lname, ";
		$sql.="CONCAT(ifnull(a.pid,''),' ',ifnull(a.cid,'') )as pid  , ";
		$sql.="CONCAT(ifnull(date_format(a.birth,'%d/%m/'),''),ifnull(date_format(a.birth,'%Y')+543,'') )as birth, ";
		$sql.="a.address ";
		$sql.="from tran_request a ";
		//$sql.="where id>='".$cntmin."' and id<='".$cntmax."' ";	
		$data =Yii::app()->db->createCommand($sql)->queryAll();
		foreach($data as $objResult)
		{
			fwrite($obj, str_pad($code, 5, ' ', STR_PAD_RIGHT).str_pad($objResult['doc_no'], 20, ' ', STR_PAD_RIGHT).str_pad($objResult['doc_date'], 10, ' ', STR_PAD_RIGHT));
			fwrite($obj, str_pad($objResult['acc_employer'], 10, ' ', STR_PAD_RIGHT).str_pad($objResult['business_name'], 20, ' ', STR_PAD_RIGHT));
			fwrite($obj, str_pad($objResult['name'], 50, ' ', STR_PAD_RIGHT).str_pad($objResult['lname'], 50, ' ', STR_PAD_RIGHT));
			fwrite($obj, str_pad($objResult['pid'], 20, ' ', STR_PAD_RIGHT));
			fwrite($obj, str_pad($objResult['birth'], 10, ' ', STR_PAD_RIGHT).str_pad($objResult['address'], 50, ' ', STR_PAD_RIGHT)."\r\n");
			$x++;
		}
		fclose($obj);
		*/
		
		//echo strlen("ที่รง.0625/ว.02")."<br/>";
		//echo mb_strlen("ที่รง.0625/ว.02", 'UTF-8');
		
		
	/*	
		$URL = "test.txt";
$file=@fopen($URL,"r") or die("Can Not Open File. Please contact admin!");


$i=1;
 while (!feof($file)){
	   	$buffer = fgets($file, 4096);
		
		str_pad($text[0], 20);
		
	   	$text= explode(6,$buffer);
		$name = $text[0];
		$fullpath = $text[1];
		$upload_url = $text[2];
	   	$sql = "insert into tran_file (name, upload_path, upload_url)  ";
	   	$sql.= "values (:name,:upload_path,:upload_url)";
		$command=yii::app()->db->createCommand($sql);
	   	$command->bindValue(":name", $name);
		$command->bindValue(":upload_path", $fullpath);
		$command->bindValue(":upload_url", $upload_url);
   
   if($command->execute()) {
	   //echo "aa";
   }
}
@fclose($file);
		*/
		
		
		
		
		
		
	/*	
		
$handle = fopen('60003011.txt', 'r');
if ($handle) 
    {
    while (($buffer = fgets($handle, 4096)) !== false)
        {
        // new data
        $doc_no      =substr($buffer,6,20);
        //$fullpath     =trim(substr($buffer,6,26));
        //$upload_url      =trim(substr($buffer,27,36));
/*        $fourth     =trim(substr($buffer,27,100));
        $fifth      =str_replace(" , ", ", ", trim(substr($buffer,128,113)));
        $sixth      =trim(substr($buffer,240,30));
		

echo $doc_no."<br/> ";
/*
		$sql = "insert into tran_request_item (doc_no)  ";
	   	$sql.= "values (:doc_no)";
		$command=yii::app()->db->createCommand($sql);
	   	$command->bindValue(":doc_no", $doc_no);
		/*
		$command->bindValue(":upload_path", $fullpath);
		$command->bindValue(":upload_url", $upload_url);

   if($command->execute()) {
	   //echo "aa";
   }


/*
        // query
        $sql = "INSERT INTO table(column_1,column_2,column_3,column_4,column_5,column_6) VALUES (:first,:second,:third,:fourth,:fifth,:sixth)";
        $q = $conn->prepare($sql);
        $q->execute(array(  ':first'    =>$first,
                            ':second'   =>$second,
                            ':third'    =>$third,
                            ':fourth'   =>$fourth,
                            ':fifth'    =>$fifth,
                            ':sixth'    =>$sixth    ));*//*
        }

        if (!feof($handle))
        {
        echo "Error: unexpected fgets() fail\n";
        }
    fclose($handle);
   // echo "File data successfully imported to database!";
}


*/
/*

$sql ="select a.doc_no,CONCAT(ifnull(date_format(a.doc_date,'%d/%m/'),''),ifnull(date_format(a.doc_date,'%Y')+543,'') )as doc_date, ";
		$sql.="a.acc_employer,a.business_name, ";
		//$sql.="CONCAT(a.name,' ', a.lname, ' ', ifnull(a.company_name,'') ) full_name, ";
		$sql.="CONCAT(ifnull(a.name,''),ifnull(a.company_name,'')) name, a.lname, ";
		$sql.="CONCAT(ifnull(a.pid,''),' ',ifnull(a.cid,'') )as pid  , ";
		$sql.="CONCAT(ifnull(date_format(a.birth,'%d/%m/'),''),ifnull(date_format(a.birth,'%Y')+543,'') )as birth, ";
		$sql.="a.address ";
		$sql.="from tran_exportreq_item a ";
		$sql.="where 1=1 and (request_id>='1' and request_id<='5') ";	
		//echo var_dump($sql);
		//exit;
		$data =Yii::app()->db->createCommand($sql)->queryAll();
		$i = 2;
		foreach($data as $objResult)
		{
			
			$aa = $objResult["doc_no"];
			$bb = $objResult["doc_date"];
			$cc = $objResult["acc_employer"];
			
			//echo var_dump(mb_strlen($aa, 'UTF-8'))."<br/>";
			//echo var_dump($aa);
			//echo var_dump(str_pad(mb_strlen($aa,'UTF-8'), 20, ' ', STR_PAD_RIGHT))."<br/>";
			//echo str_pad($aa,'UTF-8', 20, 'ก', STR_PAD_RIGHT)."<br/>";
			//echo var_dump(iconv(mb_detect_encoding($aa, mb_detect_order(), true), "UTF-8", $aa))."<br/>";
			
			$i++;
		}
	//mb_internal_encoding("UTF-8");

/* Display current internal character encoding */
//echo mb_internal_encoding();
//$string = "ที่นี่abcd1234";
//echo 'mb_strlen() return: '.mb_strlen($string, 'utf-8');

//echo mb_strlen($string,"UTF-8");


//print mb_substr($th_msg, 0, 15, 'UTF-8');
/*
function getMBStrSplit($string, $split_length = 1){
	mb_internal_encoding('UTF-8');
	mb_regex_encoding('UTF-8'); 
	
	$split_length = ($split_length <= 0) ? 1 : $split_length;
	$mb_strlen = mb_strlen($string, 'utf-8');
	$array = array();
	$i = 0; 
	
	while($i < $mb_strlen)
	{
		$array[] = mb_substr($string, $i, $split_length);
		$i = $i+$split_length;
	}
	
	return $array;
}
$str = "สวัสดีชาวโลก";

$arr1 = getMBStrSplit($str);
$arr2 = getMBStrSplit($str, 3);

echo var_dump($arr1);
//exit;
*/



//sso_001_60001
//00260003
/*
$handle = fopen('sso_001_60001.txt', 'r');
$i = 0;
if ($handle) 
    {
    while (($buffer = fgets($handle, 4096)) !== false)
        {
			$i++;
		echo var_dump(mb_strlen($buffer,'UTF-8'))."<br/>";
	    echo var_dump(strlen($buffer))."<br/>";
		//exit;
        // new data
		
        $code      =trim(substr($buffer,0,5));
        $doc_no     =substr($buffer,5,19);
		$doc_date     =trim(substr($buffer,20,15));
		$acc_employer     =trim(substr($buffer,35,10));
		$business_name      =trim(substr($buffer,45,20));
        $name     =substr($buffer,65,50);
		$lname     =trim(substr($buffer,115,50));
		$pid      =trim(substr($buffer,165,20));
		
		//echo var_dump($doc_date);
		

        $bank_id     =substr($buffer,185,3);
		$bank_dep_id     =trim(substr($buffer,188,4));
		$check_status      =trim(substr($buffer,192,1));
		
        $bank_dep_name     =substr($buffer,193,50);
		$acc_type_id     =trim(substr($buffer,243,2));
		$acc_no     =trim(substr($buffer,245,20));
		$acc_name     =trim(substr($buffer,265,100));
		$mark     =substr($buffer,365,1);
		$amont     =trim(substr($buffer,366,16));
		$request_date     =trim(substr($buffer,382,30));
		$remark     =trim(substr($buffer,412,50));
		
		
		$string=$doc_no;
		$tmp='';
		$tmp = iconv(mb_detect_encoding($doc_no, mb_detect_order(), true), "UTF-8", $doc_no);
		$tmp1 = utf8_encode($doc_no);
		//echo $tmp.",".$tmp."<br/>";
			/*
		$date = DateTime::createFromFormat('d/m/Y', $doc_date);
		$year = $date->format('Y')-543;
		$mount = $date->format('-m-d');
		$doc_date = $year.$mount;
		
		
		$ck_requestdate = substr_count($request_date, ':');
		
		if($ck_requestdate=="2"){
			$date = DateTime::createFromFormat('d/m/Y H:i:s', $request_date);
			$year = $date->format('Y')-543;
			$mount = $date->format('-m-d H:i:s');		
			$request_date = $year.$mount;
			
		}else{
		
			$date = DateTime::createFromFormat('d/m/Y:H:i:s', $request_date);
			$year = $date->format('Y')-543;
			$mount = $date->format('-m-d H:i:s');		
			$request_date = $year.$mount;
		}
		
	
		$code = iconv(mb_detect_encoding($code, mb_detect_order(), true), "UTF-8", $code);
		$doc_no = iconv(mb_detect_encoding($doc_no, mb_detect_order(), true), "UTF-8", $doc_no);
		$doc_date = iconv(mb_detect_encoding($doc_date, mb_detect_order(), true), "UTF-8", $doc_date);
		$acc_employer = iconv(mb_detect_encoding($acc_employer, mb_detect_order(), true), "UTF-8", $acc_employer);
		$business_name = iconv(mb_detect_encoding($business_name, mb_detect_order(), true), "UTF-8", $business_name);
		$name = iconv(mb_detect_encoding($name, mb_detect_order(), true), "UTF-8", $name);
		$lname = iconv(mb_detect_encoding($lname, mb_detect_order(), true), "UTF-8", $lname);
		$pid = iconv(mb_detect_encoding($pid, mb_detect_order(), true), "UTF-8", $pid);
		//echo $code.",".$doc_no.",".$doc_date.",".$acc_employer.",".$business_name.",".$name.",".$lname.",".$pid."<br/>"; 
		
		$bank_id = iconv(mb_detect_encoding($bank_id, mb_detect_order(), true), "UTF-8", $bank_id);
		$bank_dep_id = iconv(mb_detect_encoding($bank_dep_id, mb_detect_order(), true), "UTF-8", $bank_dep_id);		
		$check_status = iconv(mb_detect_encoding($check_status, mb_detect_order(), true), "UTF-8", $check_status);
		
		$bank_dep_name = iconv(mb_detect_encoding($bank_dep_name, mb_detect_order(), true), "UTF-8", $bank_dep_name);
		$acc_type_id = iconv(mb_detect_encoding($acc_type_id, mb_detect_order(), true), "UTF-8", $acc_type_id);
		$acc_no = iconv(mb_detect_encoding($acc_no, mb_detect_order(), true), "UTF-8", $acc_no);
		$acc_name = iconv(mb_detect_encoding($acc_name, mb_detect_order(), true), "UTF-8", $acc_name);
		$mark = iconv(mb_detect_encoding($mark, mb_detect_order(), true), "UTF-8", $mark);
		$amont = iconv(mb_detect_encoding($amont, mb_detect_order(), true), "UTF-8", $amont);
		$request_date = iconv(mb_detect_encoding($check_status, mb_detect_order(), true), "UTF-8", $request_date);
		$remark = iconv(mb_detect_encoding($check_status, mb_detect_order(), true), "UTF-8", $remark);
		
		
		
		
		else{
			$ck_code = strlen($code);
			if($code!='5'){
				
				$sql =" select count(*) as aa from tran_request a ";
				$sql.=" where code='".$code."' ";//and status=2 ";
				
				$data =Yii::app()->db->createCommand($sql)->queryAll();
				foreach($data as $dataitem){
					if ($dataitem['aa']==0){
						$chkmsg = $chkmsg. "เลขชุดหนังสือไม่มีในระบบ, ";
						$code="00000";
					}
				}
			}
			
		}
		
		/*
		if ($acc_employer == "")
		{
			$chkmsg = $chkmsg. "เลขทะเบียนนายจ้างเป็นค่าว่าง, ";
		}
		if ($business_name == "")
		{					
			$chkmsg = $chkmsg. "คำนำหน้าชื่อหรือประเภทธุรกิจค่าว่าง, ";					
		}
		
		if ($name == "" && $lname == "")
		{
			$chkmsg = $chkmsg. "ชื่อ หรือ นามสกุลเป็นเป็นค่าว่าง, ";
		}
		
		if ($pid == "" )
		{					
			$chkmsg = $chkmsg. "เลขบัตประชาชน/เลขทะเบียนพาณิชย์เป็นค่าว่าง, ";					
		}	
		
		if ($bank_id == "")
		{					
			$bank_id=null;	
			$chkmsg = $chkmsg. "รหัสธนาคารเป็นค่าว่าง, ";					
		}else{
			$ck_bank_id = mb_strlen($bank_id, 'UTF-8');
			if($ck_bank_id > 3){
				$bank_id=null;
				$chkmsg = $chkmsg. "รหัสธนาคารไม่ถูกต้อง, ";	
			}
			
		}
		
		if ($bank_dep_id == "")
		{				
			$bank_dep_id=null;	
			//$chkmsg = $chkmsg. "รหัสสาขาเป็นค่าว่าง, ";					
		}else{
			$ck_bank_dep_id = mb_strlen($bank_dep_id, 'UTF-8');
			if($ck_bank_dep_id > 4){
				$bank_dep_id=null;
				$chkmsg = $chkmsg. "รหัสสาขาไม่ถูกต้อง, ";	
			}
			
		}
		if ($acc_type_id == "")
		{					
			$acc_type_id='';
			//$chkmsg = $chkmsg. "รหัสประเภทบัญชีเป็นค่าว่าง, ";					
		}else{
			$ck_acctypeid = mb_strlen($acc_type_id, 'UTF-8');
			if($ck_acctypeid > 2){
				$acc_type_id='';
				$chkmsg = $chkmsg. "รหัสประเภทบัญชีไม่ถูกต้อง, ";	
			}
			
		}
		if ($acc_no == "")
		{					
			$acc_no='';
			//$chkmsg = $chkmsg. "เลขที่บัญชีเป็นค่าว่าง, ";					
		}else{
			$ck_acc_no = mb_strlen($acc_no, 'UTF-8');
			if($ck_acc_no > 20){
				$acc_no='';
				$chkmsg = $chkmsg. "เลขที่บัญชีไม่ถูกต้อง, ";	
			}
			
		}
		
		if ($acc_name == "")
		{					
			$acc_name='';
			//$chkmsg = $chkmsg. "ชื่อบัญชีเป็นค่าว่าง, ";					
		}
		if ($mark == "")
		{					
			//$chkmsg = $chkmsg. "เครื่องหมายจำนวนเงินเป็นค่าว่าง, ";					
		}
		if ($amont == "")
		{					
			$amont = 0;					
		}
		
		if ($request_date == "")
		{					
			$chkmsg = $chkmsg. "วันเวลาที่ตรวจสอบเป็นค่าว่าง ";					
		}else{	
			$ck_requestdate = substr_count($request_date, ':');					
			if($ck_requestdate=="2"){
				$date = DateTime::createFromFormat('d/m/Y H:i:s', $request_date);
				$year = $date->format('Y')-543;
				$mount = $date->format('-m-d H:i:s');		
				$request_date = $year.$mount;
				
			}else{
			
				$date = DateTime::createFromFormat('d/m/Y:H:i:s', $request_date);
				$year = $date->format('Y')-543;
				$mount = $date->format('-m-d H:i:s');		
				$request_date = $year.$mount;
			}
		}
		
//echo $code."<br/>";
	
 //echo $code.",".$doc_no.",".$doc_date.",".$acc_employer.",".$business_name.",".$name.",".$lname.",".$pid.",".$bank_id.",".$bank_dep_id.",".$check_status.",".$bank_dep_name.",".$acc_type_id.",".$acc_no.",".$acc_name.",".$mark.",".$amont.",".$request_date.",".$remark."<br/>"; 
		}}
	//echo mb_strlen($code.$doc_no.$doc_date.$acc_employer.$business_name.$name.$lname.$pid.$bank_id.$bank_dep_id.$check_status.$bank_dep_name.$acc_type_id.$acc_no.$acc_name.$mark.$amont.$request_date.$remark, 'UTF-8'); 
	
		
		
		
		//echo mb_strlen("ที่รง.0625/ว.02", 'UTF-8');
		//$first = mb_strlen($first, 'UTF-8');
	//echo $second."<br/>"; 	
		
		/*
        $third      =trim(substr($buffer,20,6));
        $fourth     =trim(substr($buffer,27,100));
        $fifth      =str_replace(" , ", ", ", trim(substr($buffer,128,113)));
        $sixth      =trim(substr($buffer,240,30));

*//*
        // query
        $sql = "INSERT INTO tran_request_item(doc_no) VALUES (:second)";
        $q = $command=yii::app()->db->createCommand($sql);
        $q->execute(array(  //':first'    =>$first,
                            ':second'   =>$second ));*/
							/*
		$request_id='';
		$request_code='';
		$sqlStr ="select id,code from tran_request where acc_employer='".$acc_employer."' and ";
		$sqlStr.="(pid='".$pid."' or cid='".$pid."') ";//and status=2 ";
			//echo var_dump($sqlStr);
			//exit;
			/*
		if($bank_dep_name=="สาขาถนนสุดบรรทัด สระบุรี"){
					echo var_dump($sqlStr);
					exit;	
				}
		$dataSql =Yii::app()->db->createCommand($sqlStr)->queryAll();
			foreach($dataSql as $dataSqlitem)
			{
				$request_id=$dataSqlitem['id'];
				$request_code=$dataSqlitem['code'];
				//echo var_dump($request_id);
				//exit;
			}					
			$sql = "INSERT INTO tran_importresult_item ";
			$sql.= "(importresult_id,doc_no,doc_date,acc_employer,business_name,name,lname,pid,bank_id,bank_dep_id, ";
			$sql.= "request_id,check_status,bank_dep_name,acc_type_id,acc_no,acc_name,mark,amont,remark, ";
			$sql.= "request_date,create_date,create_by) ";
			$sql.= "VALUES(:code,:doc_no,:doc_date,:acc_employer,:business_name,:name,:lname,:pid,:bank_id,:bank_dep_id, ";
			$sql.= " $request_id,:check_status,:bank_dep_name,:acc_type_id,:acc_no,:acc_name,:mark,:amont,:remark, ";
			$sql.= ":request_date,now(),$createby) ";
			$command=yii::app()->db->createCommand($sql);		
			$command->bindValue(":code", null);
			$command->bindValue(":doc_no", $doc_no);
			$command->bindValue(":doc_date", $doc_date);	
			$command->bindValue(":acc_employer", $acc_employer);
			$command->bindValue(":business_name", $business_name);
			//$command->bindValue(":prefix", $prefix);
			$command->bindValue(":name", $name);
			$command->bindValue(":lname", $lname);
			$command->bindValue(":pid", $pid);
			//$command->bindValue(":cid", $cid);
			$command->bindValue(":bank_id", $bank_id);				
			$command->bindValue(":bank_dep_id", $bank_dep_id); 
			$command->bindValue(":check_status", $check_status);
			$command->bindValue(":bank_dep_name", $bank_dep_name);
			$command->bindValue(":acc_type_id", $acc_type_id);
			$command->bindValue(":acc_no", $acc_no);
			$command->bindValue(":acc_name", $acc_name);
			$command->bindValue(":mark", $mark);
			$command->bindValue(":amont", $amont);
			$command->bindValue(":request_date", $request_date);
			$command->bindValue(":remark", $remark);			
			if($command->execute()) {
				} else {
				Yii::app()->session['errmsg_import']='ไม่สามารถบันทึกข้อมูลได้'.$sql;
				return false;
			}*//*
        }

        if (!feof($handle))
        {
        echo "Error: unexpected fgets() fail\n";
        }
    fclose($handle);
    echo "File data successfully imported to database!";
}*/



?>
 
<script type="text/javascript">
function checkText11()
	{
		var elem = document.getElementById('test_txt').value;
		if(!elem.match(/^([a-z0-9\\_])+$/i))
		{
			alert("กรอกได้เฉพาะ a-Z, A-Z, 0-9 และ _ (underscore)");
			document.getElementById('test_txt').value = "";
		}
	}
function checkText22(str,obj){
	
    var isText=true;
	
	var txt1 = "'";
	var txt2 = '"';
	var txt3 = "//\\"; //this is OK 
//var r2 = /\/;  // this is not OK 
	//var txt3 = '';
	//var orgi_text = /^(['"\\_])+$/;
	//var orgi_text=" ๅภถุึคตจขชๆไำพะัีรนยบลฃฟหกดเ้่าสวงผปแอิืทมใฝ๑๒๓๔ู฿๕๖๗๘๙๐ฎฑธํ๊ณฯญฐฅฤฆฏโฌ็๋ษศซฉฮฺ์ฒฬฦ";
	//alert(orgi_text);
   var orgi_text=txt1+txt2+txt3;
	//alert(orgi_text);
	//return;
    var chk_text=str.split("");
    chk_text.filter(function(s){        
        if(orgi_text.indexOf(s)!=-1){
            isText=false;
            obj.value=str.replace(RegExp(s, "g"),'');
        }           
    }); 
    return isText; // ถ้าเป็น true แสดงว่าเป็นภาษาไทยทั้งหมด*/
	
}
</script>
