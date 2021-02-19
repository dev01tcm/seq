<?php

class CommonFnc extends CApplicationComponent
{
    public function init() {    
		parent::init();
    }
	
	//Common Function /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Common Function /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Common Function /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Common Function /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	//Common Function /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	


	public function genstring($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	public function gendocumentno($length = 6) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
		
	public function file_get_contents_curl($url){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,10);
			//curl_setopt($ch, CURLOPT_TIMEOUT, 20);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
	}


	public function get_image_url($url, $serverpath) {
		try{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_POST, 0);
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$sourcefile=curl_exec($ch);
			curl_close($ch);
			
			$savefile = fopen($serverpath, 'w');
			fwrite($savefile, $sourcefile);
			fclose($savefile);		
			
			return true;
		} catch( Exception $e ){
			return false;
		}
	}

	public function file_exists_url($url) {
		try{
			$ch = curl_init($url);
			
			curl_setopt($ch, CURLOPT_NOBODY, true);
			curl_exec($ch);
			$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			// $retcode >= 400 -> not found, $retcode = 200, found.
			curl_close($ch);
			
			if($retcode==200) {return true;} else {return false;}
		} catch( Exception $e ){
			return false;
		}
	}

	public function get_user_ip2long()
	{
		return ip2long($this->get_user_ip_address(true));
	}

	
	/**
	* Get the IP address of the client accessing the website
	* @param bool $force_string Force the return of a single address as a string, even if more than one address is found
		True: Always return a string with a single value
		False: Always return an array
		Null (empty): Return a string if a single value, array for multiple values
	*
	* @return bool|string|array
	*/
	public function get_user_ip_address($force_string=NULL)
	{
		// Consider: http://stackoverflow.com/questions/4581789/how-do-i-get-user-ip-address-in-django
		// Consider: http://networkengineering.stackexchange.com/questions/2283/how-to-to-determine-if-an-address-is-a-public-ip-address
		
		$ip_addresses = array();
		$ip_elements = array(
			'HTTP_X_FORWARDED_FOR', 'HTTP_FORWARDED_FOR', 
			'HTTP_X_FORWARDED', 'HTTP_FORWARDED',
			'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_CLUSTER_CLIENT_IP',
			'HTTP_X_CLIENT_IP', 'HTTP_CLIENT_IP',
			'REMOTE_ADDR'
		);
		
		foreach ( $ip_elements as $element ) {
			if(isset($_SERVER[$element])) {
				if ( !is_string($_SERVER[$element]) ) {
					// Log the value somehow, to improve the script!
					continue;
				}
				
				$address_list = explode(',', $_SERVER[$element]);
				$address_list = array_map('trim', $address_list);
				
				// Not using array_merge in order to preserve order
				foreach ( $address_list as $x ) { $ip_addresses[] = $x; }
			}
		}
		
		if ( count($ip_addresses)==0 ) {
			return FALSE;
		} elseif ( $force_string===TRUE || ( $force_string===NULL && count($ip_addresses)==1 ) ) {
			return $ip_addresses[0];
		} else {
			return $ip_addresses;
		}
	}
	
		
	public function rand_string( $length ) {
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		return substr(str_shuffle($chars),0,$length);
	}	
	
	//The latitude must be a number between -90 and 90
	public function check_latitude($latitude){
		if(is_numeric($latitude) && $latitude>=-90 && $latitude<=90) { return true; } else { return false; }
	}
	
	//The longitude must be a number between -180 and 180
	public function check_longitude($longitude){
		if(is_numeric($longitude) && $longitude>=-180 && $longitude<=180) { return true; } else { return false; }
	}

	public function convert_timeago($dt){
		try {  		
			$t=time()+(60*60*Yii::app()->params['prg_ctrl']['diffsvtime']);  //เวลาปัจจุบันบวก จำนวน ชม ที่ต่างกันของ webserver กะ dbserver
			$date1 = new DateTime(date("Y-m-d H:i:s",$t));
			$date2 = new DateTime($dt);
			$diff = $date1->diff($date2);
			
			if($diff->y>1) { $timeago = $diff->y .' '.Yii::t('common','years_ago');
			} elseif($diff->y>0) { $timeago = Yii::t('common','a_year_ago');		
			
			} elseif($diff->m>1) { $timeago = $diff->m .' '.Yii::t('common','months_ago');
			} elseif($diff->m>0) { $timeago = Yii::t('common','a_month_ago');
					
			} elseif($diff->d>1) { $timeago = $diff->d .' '.Yii::t('common','days_ago'); 
			} elseif($diff->d>0) { $timeago = Yii::t('common','a_day_ago'); 
					
			} elseif($diff->h>1) { $timeago = $diff->h .' '.Yii::t('common','hours_ago');
			} elseif($diff->h>0) { $timeago = Yii::t('common','a_hour_ago');
			
			} elseif($diff->i>1) { $timeago = $diff->i .' '.Yii::t('common','minutes_ago');
			} elseif($diff->i>0) { $timeago = Yii::t('common','a_minute_ago');
					
			} else { $timeago = Yii::t('common','just_now');								
			}
			return $timeago; 
		} catch (Exception $e) {
			return '';
		}		
	}

	public function convert_cntnumber($cnt){
		try {  		
			return number_format($cnt); 
		} catch (Exception $e) {
			return '0';
		}		
	}


	public function url_to_domain($url) {
		$host = @parse_url($url, PHP_URL_HOST);
		
		// If the URL can't be parsed, use the original URL
		// Change to "return false" if you don't want that
		if (!$host)
		$host = $url;
		
		// The "www." prefix isn't really needed if you're just using
		// this to display the domain to the user
		if (substr($host, 0, 4) == "www.")
		$host = substr($host, 4);
		
		// You might also want to limit the length if screen space is limited
		if (strlen($host) > 50)
		$host = substr($host, 0, 47) . '...';
		
		return $host;
	} 

	
	public function consolelog( $data ) {
		if ( is_array( $data ) )
			$output = "<script>console.log( '" . implode( ',', $data) . "' );</script>";
		else
			$output = "<script>console.log( '" . $data . "' );</script>";
	
		echo $output;
	}


	//Custom Function /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Custom Function /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Custom Function /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Custom Function /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	//Custom Function /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	//Yii::app()->session->remove('');	
	//addslashes();
	//stripslashes();	
	
	
	
	public function get_facebook_token(){
		 return $this->file_get_contents_curl('https://graph.facebook.com/oauth/access_token?type=client_cred&client_id='.Yii::app()->params['social_ctrl']['facebook']['id'].'&client_secret='.Yii::app()->params['social_ctrl']['facebook']['secret']);
	}	


	function change_language($lang, $profile_code=0)
	{
		$lang = strtolower(addslashes($lang)); 
		$arr_lang = Yii::app()->params['prg_ctrl']['multilang'];	
		if (in_array($lang, $arr_lang)) {
			if (Yii::app()->user->isGuest && $profile_code==0) {
				Yii::app()->session['language'] = $lang;
				Yii::app()->language = $lang;
				$this->set_cookie('cklang',$lang);
				return true;			
			} else {
				if($profile_code==0){$profile_code = Yii::app()->user->id;}
				if (tt_profile::model()->save_language($profile_code,$lang)) {
					Yii::app()->session['language'] = $lang;
					Yii::app()->language = $lang;
					$this->set_cookie('cklang',$lang);					
					return true;			
				} else {
					return true;			
				}

			}  			
		} else {
			return false;	
		}
	}	
	
	function check_language($lang)
	{
		$lang = strtolower(addslashes($lang)); 
		$arr_lang = Yii::app()->params['prg_ctrl']['multilang'];	
		if (in_array($lang, $arr_lang)) {
			return true;			
		} else {
			return false;	
		}
	}
	

	public function save_logdata($profile_code, $log_type, $descp)
	{
		/*
		$ip_addr = $this->get_user_ip2long();
		$scid = $this->rand_string(8);
		Yii::app()->session['logscid'] = $scid;

		$sql1 = 'INSERT INTO tl_logdata (log_date, log_type, ip_addr, scid, profile_code, descp)
		VALUES(now(), :log_type, :ip_addr, :scid, :profile_code, :descp)';
		$command=yii::app()->db->createCommand($sql1);
		$command->bindValue(':log_type', $log_type);
		$command->bindValue(':ip_addr', $ip_addr);
		$command->bindValue(':scid', $scid);		
		$command->bindValue(':profile_code', $profile_code);
		$command->bindValue(':descp', addslashes($descp));
		if($command->execute()) {
				return true;
		} else {
			return false;
		}			
		*/
		return true;
	}		

	public function save_logview($profile_code, $log_type, $obj_controller, $obj_action, $obj_view, $obj_code, $obj_lang, $obj_profile_code, $descp)
	{
		/*
		$ip_addr = $this->get_user_ip2long();

		
		
		$sql1 = 'INSERT INTO tl_logview (log_date, log_type, ip_addr, obj_controller, obj_action, obj_view, obj_code, obj_lang, obj_profile_code, profile_code, descp)
		VALUES(now(), :log_type, :ip_addr, :obj_controller, :obj_action, :obj_view, :obj_code, :obj_lang, :obj_profile_code, :profile_code, :descp)';
		$command=yii::app()->db->createCommand($sql1);
		$command->bindValue(':log_type', $log_type);
		$command->bindValue(':ip_addr', $ip_addr);
		$command->bindValue(':obj_controller', $obj_controller);		
		$command->bindValue(':obj_action', $obj_action);		
		$command->bindValue(':obj_view', $obj_view);		
		$command->bindValue(':obj_code', addslashes($obj_code));		
		$command->bindValue(':obj_lang', $obj_lang);				
		$command->bindValue(':obj_profile_code', $obj_profile_code);										
		$command->bindValue(':profile_code', $profile_code);
		$command->bindValue(':descp', addslashes($descp));
		if($command->execute()) {
				return true;
		} else {
			return false;
		}		
		*/
		return true;	
	}		

	public function logview($obj_view, $obj_code, $obj_profile_code, $descp)
	{
		/*
		$obj_controller = Yii::app()->controller->id;
		$obj_action = Yii::app()->controller->action->id;

		$profile_code = !Yii::app()->user->isGuest?Yii::app()->user->id:0;
		$log_type='';
		$obj_lang = Yii::app()->language;

		$lv = Yii::app()->CommonFnc->save_logview($profile_code, $log_type, $obj_controller, $obj_action, $obj_view, $obj_code, $obj_lang, $obj_profile_code, $descp);
		return $lv;
		*/
		return true;
	}		

	

	public function set_cookie($cookie_name, $cookie_value)
	{
		$cookie = new CHttpCookie($cookie_name, $cookie_value);
		$cookie->expire = time()+3600*24*Yii::app()->params['prg_ctrl']['authCookieDuration']; 
		$cookie->domain = Yii::app()->params['prg_ctrl']['domain']; 		
		Yii::app()->request->cookies[$cookie_name] = $cookie;
		return true;		
	}	


	public function get_cookie($cookie_name)
	{
		$cookie_value = isset(Yii::app()->request->cookies[$cookie_name]) ? Yii::app()->request->cookies[$cookie_name]->value : '';
		return $cookie_value;			
	}	
	
	
	public function get_token()
	{
		//$token_value = uniqid('', true);
		$token_value = $this->rand_string(23);
		return $token_value;			
	}	
	

	public function removespecialchars($raw){
		return preg_replace('#[^-ก-๙a-zA-Z0-9]#u', '', $raw);
	}

	
	public function seotitle($raw){
		 $raw = preg_replace('#[^-ก-๙a-zA-Z0-9]#u', '', $raw);
		 $raw =  preg_replace('/-+/i','-',$raw);
		 if(substr($raw,0,1) == '-')
			  $raw = substr($raw,1);
		 if(substr($game_url,-1) == '-')
			  $raw = substr($raw,0,-1);
		 return urlencode($raw);
	}	
	
	public function set_selectedtopmenu($menu_code){
		if(Yii::app()->controller->id == $menu_code) {
			return ' selected';
		} else {
			return '';
		}
	}	
	

	public function set_jsscript($js_name)
	{
		if($js_name=='tinymce') {
			$sc = '<script src="'.Yii::app()->request->baseUrl.'/vendor/tinymce/4.0.22/tinymce.min.js"></script>';		
		} else {
			$sc = '';
		}
		return $sc;				
	}	
	
	//20170523
	public function ex_pad($txt1,$txtlen) 
	{		 
		 //$n1= mb_strlen($txt1,"UTF-8");
		 $n1= mb_strlen($txt1,"UTF-8");
		 $n2 = $txtlen-$n1;
		 $txt1 = iconv(mb_detect_encoding($txt1, mb_detect_order(), true), "TIS-620", $txt1);
		 if($n2>0){
			 return $txt1.str_pad("", $n2, ' ', STR_PAD_RIGHT);
		}else{
			return $txt1;
		}
		 
    }
	public function ex_pad_conv($txt1,$txtlen) 
	{		 
		 //$n1= mb_strlen($txt1,"UTF-8");
		 $n1= mb_strlen($txt1,"UTF-8");
		 $n2 = $txtlen-$n1;
		 //$txt1 = iconv(mb_detect_encoding($txt1, mb_detect_order(), true), "TIS-620", $txt1);
		 if($n2>0){
			 return $txt1.str_pad("", $n2, ' ', STR_PAD_RIGHT);
		}else{
			return $txt1;
		}
		 
    }
	
	public function log_request($id,$type,$user) 
	{
		$sql = "insert into log_request SELECT null as log_id,now() as log_date,'".$type."' as log_type,'' as descp,'".$user."' as log_createby,a.* FROM tran_request a WHERE id=".$id." ";
		$command=yii::app()->db->createCommand($sql);
		if($command->execute()) {
			//$id = Yii::app()->db->getLastInsertID();
		}
       return;            
		 
    }
	public function log_login($type,$user) 
	{
		$sql = "insert into log_login (log_date,log_type,descp,log_createby) values (now(),'".$type."','','".$user."')";		
		$command=yii::app()->db->createCommand($sql);
		if($command->execute()) {
			//$id = Yii::app()->db->getLastInsertID();
		}
       return;            
		 
    }
	public function log_events($log_type,$descp,$log_createby) 
	{
		$sql = "insert into log_events (log_date,log_type,descp,log_createby) values (now(),'".$log_type."','".$descp."','".$log_createby."')";		
		$command=yii::app()->db->createCommand($sql);
		if($command->execute()) {
			
		}
       return;            
		 
    }
		public function log_users($id,$type,$user) 
	{
		$sql = "insert into log_user SELECT null as id,now() as log_date,'".$type."' as log_type,'".$user."' as log_createby,a.* FROM mas_user a WHERE id=".$id." ";	
		$command=yii::app()->db->createCommand($sql);
		if($command->execute()) {
			
		}
       return;            
		 
    }
	public function log_data($log_type,$descp,$log_createby) 
	{
		date_default_timezone_set("Asia/Bangkok");				
		$dr_folder = Yii::app()->params['prg_ctrl']['path']['media'].Yii::app()->params['prg_ctrl']['path']['closepath'].'log_data';								
		@mkdir($dr_folder,0,true);		
		
		$filename = $dr_folder.Yii::app()->params['prg_ctrl']['path']['closepath']."log_".date('Ym').".txt";
		$chk_file = file_exists($filename);
		
		if($chk_file < 1){
			//สร้างใหม่
			$obj = fopen($filename, "w");
			fwrite($obj, 
				date('Y-d-m H:i:s').','.		
				$log_type.' '.
				$descp.' '.
				$log_createby.' '."\r\n");			
			fclose($obj);
			
		}else{
			//update ไฟล์เดิม
			
			$obj = fopen($filename, "a");		
			fwrite($obj, 
				date('Y-d-m H:i:s').','.		
				$log_type.' '.
				$descp.' '.
				$log_createby.' '."\r\n");			
			fclose($obj);
		}
	
       	return;            
		 
    }
}
   