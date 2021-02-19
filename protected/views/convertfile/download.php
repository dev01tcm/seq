<?php
ob_start();
$file = $_GET["fileload"];
$file1 = mb_substr($file,8);
header('Content-Disposition: attachment; filename="'.$file1.'"'); 
readfile($file);
exit;
