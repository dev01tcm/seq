<?php

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'SEQUESTER',
	'language' => 'en',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			//'ipFilters'=>array('127.0.0.1','::1'),
			'ipFilters'=>array('*.*.*.*','::1'),
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class' => 'CustomWebUser',
		),
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				//'<username:[\w.]+>'=>'user/post',
                //'<username:[\w.]+>/display'=>'image/display',			
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
			'showScriptName'=>false,
		),



		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		'db'=>array(
			/*'connectionString' => 'mysql:host=localhost;dbname=intranet02',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'D@t@B@seW@ning',
			'charset' => 'utf8',			
			*/
			
			//'connectionString' => 'mysql:host=localhost;dbname=sequesterdb',//seq_err',
			'connectionString' => 'mysql:host=localhost;dbname=seq',//seq_err',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

        'request'=>array(
            'enableCookieValidation'=>true,
			'enableCsrfValidation'=>true,
			//'baseUrl' => 'http://www.example.com',
        ),

		'clientScript' => array(
			'scriptMap' => array(
				'jquery.js' => false,
				'jquery.min.js' => false,
			),
		),		
		
		'CommonFnc' => array(
			'class'=>'CommonFnc',
        ),	
			
		'session' => array(
			'class' => 'CDbHttpSession',
			'timeout' => 60*20, //20นาที
		),
	),
 
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	
	'params'=>array(
		'data_ctrl'=>array(	
			'itcenter' => array(
				'dept_id' => '2', 
				'deptgroup_id' => '3', 		
														
				),
			'businesstype' => array(					
				'othtr' => '25',										
				),					
			),
			/*
		'export_ctrl'=>array(	
			'excel' => array(
				'setformat' => array(
					0 => '269',
					1 => 'test',					
					2 => '005', 
					3 => '006', 
					4 => '169',					
					),												
				),		
			),	
			*/
		'export_ctrl'=>array(	
			'excel' => array(
				//'setformat' => array('069', '169', '05', '006', '69'),
				'setformat' => array('069'),												
				),		
			),
		

		'prg_ctrl'=>array(
  		    'domain' => 'http://localhost:8081/seq',  //eg. for set cookie
	        'indextitle' => 'sequester',
			'pagetitle'	=> ' | ระบบสอบบัญชีเงินฝากธนาคาร ',
			'logo' => 'http://localhost:8081/seq/images/common/logo.png',		
			'logo_path' => 'C:/xampp/htdocs/seq/images/common/logo.png',	
			//'logo' => '/var/www/html/seq/images/common/logo.png',	
			'img_head_bg' => 'http://localhost:8081/seq/images/common/headder.png',	
			'img_head_logo' => 'http://localhost:8081/seq/images/common/aoom.png',
			'daterange' => '1940:2017',
			'authCookieDuration' => 7,  //the duration of the user login cookie in days			
			'diffsvtime' => 0, //เวลาบนเครื่อง webserver ห่างจาก dbserver เท่าไหร่ เช่น 7 หมายถึง webserver ช้ากว่า dbserver 7 ชม
			'ldap' => array(
				'server' => '172.20.10.17',
				'port' => '389', 
				'bind_uid' => 'appssows',		
				'bind_pwd' => 'Tory<oN',			
				'bind_dn' => 'uid=appssows,cn=App,ou=internal,DC=ESSS,DC=SSO,DC=GO,DC=TH',			
				'filter_attr' => 'uid',
				'publiccode_attr' => 'ssopersoncitizenid',
				'arr_search_attr' => array('firstname'=>'ssofirstname', 'lastname'=>'ssosurname', 'mail'=>'mail','dep_id'=>'ssobranchcode','userid'=>'uid','publiccode'=>'ssopersoncitizenid','dep_name'=>'workingdeptdescription'),
				'arr_basedn' => 'cn=Users,ou=internal,dc=ESSS,dc=SSO,dc=GO,dc=TH',			
				),			
			'url' => array(
				'baseurl' => 'http://localhost:8081/seq', 
				'upload' => 'http://localhost:8081/seq/uploads',
				'media' => 'http://localhost:8081/seq/media/', 
				
				),
			'path' => array(
			
				/*
				'logo' => '/var/www/html/seq/images/common/logo.png',	
				'basepath' => '/var/www/html/seq', 				
				'upload' => '/var/www/html/seq/uploads',										
				'media' => '/var/www/html/seq/media',
				'closepath' => '/', 
				*/	
				'basepath' => 'C:/xampp/htdocs/seq', 				
				'upload' => 'C:/xampp/htdocs/seq/uploads',										
				'media' => 'C:/xampp/htdocs/seq/media',
				'closepath' => '/', 
					
							
			),		
			'vendor' => array(
				'phpthumb' => array( 		
					'path' => '/vendor/phpthumb/PhpThumbFactory.php',  	
													
				),	
				'jquery-upload' => array(
					'path' => '/vendor/jquery-upload/UploadHandler.php',				
					'path_intro' => '/vendor/jquery-upload/IntroUploadHandle.php',
					'path_import' => '/vendor/jquery-upload/ImportUploadHandle.php',	
					'path_convert' => '/vendor/jquery-upload/ConvertUploadHandle.php',						
				),
				'tcpdf' => array(
					 'oripath' => '/vendor/tcpdf/tcpdf.php', 
					 'path' => '/vendor/tcpdf/customtcpdf.php', 
					 'confpath' => '/vendor/tcpdf/config/tcpdf_config.php', 
				
				),	
				'phpexcel' => array(
					'path' => '/vendor/Classes/PHPExcel.php',
				),
				'iofactory' => array(
					'path' => '/vendor/Classes/PHPExcel/IOFactory.php',
				),				
			),	
			'pagination' => array(
				'default' => array ( 
					'pagesize' => '40',
					'maxbuttoncount' => '12',
					'maxitem' => '1000',									
				),
			),	 					
		),			 
			

	),
);