<?php
//th
return array(
   /*error for comomn*/
  '110' => '',
  '110_invalid_exception' => 'เกิดข้อผิดพลาด',
  '110_invalid_savedata' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล',

  /*error for custom api*/
  '210' => '',


  /*error for vendor*/
  /*error for login forgotpw resetpw*/
  '501_fb_not_found' => 'ไม่พบไอดี Facebook นี้ ในระบบ',  
  '501_acc_temp_disabled' => 'หมายเลขสมาชิกนี้ ถูกระงับการใช้งานชั่วคราว',
  '501_acc_deactivated' => 'หมายเลขสมาชิกนี้ ถูกยกเลิกการใช้งานแล้ว',
  '501_incorrect' => 'อีเมล์หรือรหัสผ่านไม่ถูกต้อง',

  '501_email_blank' => 'อีเมล์ ไม่ควรเป็นค่าว่าง',
  '501_email_invalid' => 'อีเมล์ รูปแบบไม่ถูกต้อง',
  '501_email_notfound' => 'ไม่พบอีเมล์นี้',
  '501_email_use' => 'อีเมล์นี้ถูกใช้ในระบบแล้ว',  
  '501_email_multiple' => 'เราส่งข้อมูลไปยังอีเมล์หลายครั้งแล้ว ลองเช็คอีเมล์ของคุณในโฟลเดอร์ inbox, spam, junk',  
  '501_info_multiple' => 'เราได้รับข้อมูลซ้ำจากเครื่องคอมของคุณหลายครั้งแล้ว',
  '501_wait {minutes} before_resend' => 'กรุณารอ {minutes} นาที ก่อนรีเซ็ตรหัสผ่านได้อีกครั้ง',
        
  '501_pwd_blank' => 'รหัสผ่าน ไม่ควรเป็นค่าว่าง',
  '501_pwd_short {n}' => 'รหัสผ่านสั้นเกินไป (ต้องมากกว่า {n} ตัวอักษร)',
  '501_pwd_long {n}' => 'รหัสผ่านยาวเกินไป (ต้องไม่เกิน {n} ตัวอักษร)',
  '501_pwd_notmatch' => 'ยืนยันรหัสผ่าน ไม่ตรงกับช่องรหัสผ่าน',

  '501_link_expired' => 'ลิ๊งค์ไม่ถุกต้อง หรือหมดอายุ',
    	    
  
  
  /*error for jquery-upload*/
  '511_1' => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
  '511_2' => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
  '511_3' => 'The uploaded file was only partially uploaded',
  '511_4' => 'No file was uploaded',
  '511_5' => 'Missing a temporary folder',
  '511_6' => 'Failed to write file to disk',
  '511_7' => 'A PHP extension stopped the file upload',
  '511_post_max_size' => 'ไฟล์มีขนาดใหญ่เกินกว่าที่ระบบกำหนด',
  '511_max_file_size' => 'ไฟล์มีขนาดใหญ่เกินไป',
  '511_min_file_size' => 'ไฟล์มีขนาดเล็กเกินไป',
  '511_accept_file_types' => 'รองรับเฉพาะไฟล์รูปภาพ gif|jpg|png เท่านั้น',
  '511_max_number_of_files' => 'Maximum number of files exceeded',
  '511_max_width' => 'ขนาดภาพมีความกว้างมากเกินไป',
  '511_min_width' => 'ขนาดภาพมีความกว้างน้อยเกินไป',
  '511_max_height' => 'ขนาดภาพมีความสูงมากเกินไป',
  '511_min_height' => 'ขนาดภาพมีความสูงน้อยเกินไป',
  '511_abort' => 'ยกเลิกการอัปโหลดไฟล์',
  '511_image_resize' => 'เกิดข้อผิดพลาด ไม่สามารถลดขนาดภาพได้',
  '511_fail_save_data'=> 'เกิดข้อผิดพลาด ไม่สามารถบันทึกข้อมูลได้',
);
?>