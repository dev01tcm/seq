<?php

	
	$tb = "temp2";  
		
	$sql = "select CONCAT(ifnull(name,''),ifnull(company_name,'')) as name from tran_exportreq_item where id='17236';";//code='61013' and acc_employer='2500011674' "; 
	
	//$sql = "select name from test";
	$data =Yii::app()->db->createCommand($sql)->queryAll();		
	foreach($data as $objResult)
	{
		
		$txt1 = $objResult['name'];
	}
	echo htmlspecialchars_decode($txt1);
	//echo str_replace("world","earth","Hello world!",$var);
	$output  = str_replace(' ', '', $txt1);
	echo "::".$output."::<br/>";
	
	
	$txt1 = trim($txt1);
	//hexdump($txt1);
	echo var_dump(trim($txt1, 'utf-8'))."<br/>";  // 5
	echo var_dump(strlen($txt1))."<br/>";              // 5
	echo var_dump($txt1);
	//$txt1 = iconv(mb_detect_encoding(trim($txt1), mb_detect_order(), true), "TIS-620", trim($txt1));
	//$txt1 = iconv(mb_detect_encoding($txt1, mb_detect_order(), true), 'utf-8//TRANSLIT', $txt1);
	echo "<br/>".$txt1."<br/>mb :".mb_strlen(trim($txt1),"UTF-8")."<br/>st :".strlen($txt1);
	//echo $txt1;
	
	
	$x = trim("เค.เอส.การ์เด้น แอนด์ เซอร์วิส ");
	$y = "เค.เอส.การ์เด้น แอนด์ เซอร์วิส ";
	echo "<br/>".$x.": ".mb_strlen($x,"UTF-8")."-".strlen($x);
	echo "<br/>".$y.": ".mb_strlen($y,"UTF-8")."-".strlen($y);
?>

<input type="text" id="txt" />
<input type="button" onclick="test();" value="ตกลง"  />

<script>
function test(){
	var isText=true;
	var str = $('#txt').val();
	var txt1 = "'";
	var txt2 = '"';	
	var txt3 = "๑๒๓๔๕๖๗๘๙๐";
    var orgi_text=txt1+txt2+txt3;
	var chk_text=str.split("");
	chk_text.filter(function(s){        
        if(orgi_text.indexOf(s)!=-1){
            isText=false;
            //obj.value=str.replace(RegExp(s, "g"),'');
        }           
    }); 
	if(isText==true){
		alert(isText);
	}else{
		alert('no');	
	}
}

function checkText1(str,obj){
    var isText=true;
	
	var txt1 = "'";
	var txt2 = '"';	
	var txt3 = "๑๒๓๔๕๖๗๘๙๐";
    var orgi_text=txt1+txt2+txt3;
	//var orgi_text=" ๅภถุึคตจขชๆไำพะัีรนยบลฃฟหกดเ้่าสวงผปแอิืทมใฝ๑๒๓๔ู฿๕๖๗๘๙๐ฎฑธํ๊ณฯญฐฅฤฆฏโฌ็๋ษศซฉฮฺ์ฒฬฦ";
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