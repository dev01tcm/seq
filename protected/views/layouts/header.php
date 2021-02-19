
<div id="headerContainer" class="container" style='background: url("<?php echo Yii::app()->params['prg_ctrl']['img_head_bg'] ?>");background-size: cover;width: 100%;left: 0;top: 0; z-index: 1; '>
    <div id="headerContent" class="container">
        <div class="hdlogo">
            <a href="<?php echo Yii::app()->getBaseUrl(true); ?>"><img src="<?php echo Yii::app()->params['prg_ctrl']['logo'] ?>"></a>
            <div class="displaytitle" style="">       
            	<a href="<?php echo Yii::app()->createUrl(''); ?>" style="font-size:20px;font-weight:bold;text-decoration:none; color:#FFF;"><?php echo Yii::app()->name; ?></a>               
            </div>    
        	<div class="displayuser" style=" color:#FFF;">
            <span>ระบบสอบบัญชีเงินฝากธนาคาร</span>
            <!--
           		<span class="usernm" style=" margin-top:50px;" ><?php echo Yii::app()->user->getInfo('username'); ?></span>
          		<span class="usernm" style=""><?php echo Yii::app()->user->getInfo('displayname'); ?></span> -->
            </div>             
        </div>
        
        <div>
            <div style="float:right; margin-top:15px;">                         
                <a class="btn btn-danger" href="<?php echo Yii::app()->createUrl('logout'); ?>" style="float:left">
                <i class="glyphicon glyphicon-off"></i> ออกจากระบบ
                </a>       
            </div>  
            <div style="float:right;">
                <img src="<?php echo Yii::app()->params['prg_ctrl']['img_head_logo'] ?>" width="90%" /> 
            </div>  
       	</div>          
    </div>    
</div> 

<div id="menuContainer" class="container">
	<ul id="menuContent" class="container">  
        <li class="hdmn" style="float:left">
            <a id="mnbtran" class="mnt dropdown-toggle" href="<?php echo Yii::app()->createUrl('home'); ?>" >
            	<i class="glyphicon glyphicon-home"></i> หน้าหลัก
            </a>             
        </li>
        <?php?> 
        <li class="hdmn" style="float:left">
            <a id="mnbtran" class="mnt dropdown-toggle" href="<?php echo Yii::app()->createUrl('request/requestform'); ?>">
            	<i class="glyphicon glyphicon-plus"></i> บันทึกรายการใหม่
            </a>            
        </li>
        <?php ?>
        <!--li class="hdmn" style="float:left">
            <a id="mnbtran" class="mnt dropdown-toggle" href="<?php echo Yii::app()->createUrl('request'); ?>">
            	<i class="glyphicon glyphicon-list"></i> ประวัติรายการ
            </a>                
        </li-->  
        <li class="hdmn" style="float:left">
            <a id="mnbtran" class="mnt dropdown-toggle" data-toggle="dropdown">
            <i class="glyphicon glyphicon-export"></i> รายการใหม่
            </a> 
            <ul id="mnlsetting" class="dropdown-menu" role="menu" aria-labelledby="mnbsetting">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('requestnew'); ?>">รายการใหม่ธนาคาร</a></li> 
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('requestnewtsd'); ?>">รายการใหม่หลักทรัพย์</a></li>          
            </ul>   
        </li>
        <li class="hdmn" style="float:left">
            <a id="mnbtran" class="mnt dropdown-toggle" data-toggle="dropdown">
            <i class="glyphicon glyphicon-export"></i> รายการประมวลผลแล้ว
            </a> 
            <ul id="mnlsetting" class="dropdown-menu" role="menu" aria-labelledby="mnbsetting">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('requestprocess'); ?>">รายการประมวลผลธนาคาร</a></li> 
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('requestprocess_tsd'); ?>">รายการประมวลผลหลักทรัพย์</a></li>          
            </ul>   
        </li>
         <li class="hdmn" style="float:left">
            <a id="mnbtran" class="mnt dropdown-toggle" href="<?php echo Yii::app()->createUrl('requestresult'); ?>">
            	<i class="glyphicon glyphicon-check"></i> รายการตรวจสอบผลแล้ว
            </a>                
        </li>  
        <li class="hdmn" style="float:left">
            <a id="mnbtran" class="mnt dropdown-toggle" href="<?php echo Yii::app()->createUrl('requestsearch'); ?>">
            	<i class="glyphicon glyphicon-search"></i> ค้นหาข้อมูล
            </a>                
        </li>                       
        <?php if(Yii::app()->user->getInfo('userlevel_id')=='1') { ?>         
        
        <!--li class="hdmn" style="float:left">
            <a id="mnbtran" class="mnt dropdown-toggle" data-toggle="dropdown">
            <i class="glyphicon glyphicon-folder-open"></i> ประมวลผลข้อมูล
            </a> 
            <ul id="mnlsetting" class="dropdown-menu" role="menu" aria-labelledby="mnbsetting">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('investigate'); ?>">ส่งออกไฟล์เพื่อขอตรวจสอบบัญชีเงินฝาก</a></li> 
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('hisinvestigate'); ?>">ประวัติการส่งออกไฟล์เพื่อขอตรวจสอบบัญชีเงินฝาก</a></li>   
                <li role="presentation" class="divider"></li>    
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('import'); ?>">นำเข้าผลการตรวจสอบบัญชีเงินฝาก</a></li>   
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('hisimport'); ?>">ประวัติการนำเข้าผลการตรวจสอบบัญชีเงินฝาก</a></li>        
            </ul>   
        </li-->
         <li class="hdmn" style="float:left">
            <a id="mnbtran" class="mnt dropdown-toggle" data-toggle="dropdown">
            <i class="glyphicon glyphicon-export"></i> ประมวลผลข้อมูล
            </a> 
            <ul id="mnlsetting" class="dropdown-menu" role="menu" aria-labelledby="mnbsetting">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('investigate'); ?>">ส่งออกไฟล์เพื่อขอตรวจสอบบัญชีเงินฝาก</a></li> 
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('hisinvestigate'); ?>">ประวัติการส่งออกไฟล์เพื่อขอตรวจสอบบัญชีเงินฝาก</a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('investigate_tsd'); ?>">ส่งออกไฟล์เพื่อขอตรวจสอบหลักทรัพย์</a></li> 
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('hisinvestigate_tsd'); ?>">ประวัติการส่งออกไฟล์เพื่อขอตรวจสอบหลักทรัพย์</a></li>                    
            </ul>   
        </li>
          <li class="hdmn" style="float:left">
            <a id="mnbtran" class="mnt dropdown-toggle" data-toggle="dropdown">
            <i class="glyphicon glyphicon-import"></i> นำเข้าผลการตรวจสอบ
            </a> 
            <ul id="mnlsetting" class="dropdown-menu" role="menu" aria-labelledby="mnbsetting">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('import'); ?>">นำเข้าผลการตรวจสอบบัญชีเงินฝาก</a></li>   
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('hisimport'); ?>">ประวัติการนำเข้าผลการตรวจสอบบัญชีเงินฝาก</a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('import_tsd'); ?>">นำเข้าผลการตรวจสอบหลักทรัพ</a></li>   
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('hisimport_tsd'); ?>">ประวัติการนำเข้าผลการตรวจสอบหลักทรัพย์</a></li>          
            </ul>   
        </li>
        
        
          
         <?php } ?> 
        
        <li class="hdmn" style="float:left">
            <a id="mnbtran" class="mnt dropdown-toggle" data-toggle="dropdown">
            <i class="glyphicon glyphicon-cog"></i> ตั้งค่า
            </a> 
            <ul id="mnlsetting" class="dropdown-menu" role="menu" aria-labelledby="mnbsetting">                
                <?php if(Yii::app()->user->getInfo('userlevel_id')!='1') { ?>  
                	<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('chkuser'); ?>">ตรวจสอบข้อมูลผู้ใช้ในหน่วยงาน</a></li>
                <?php }else{ ?>
                	
                	<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('bank'); ?>">ข้อมูลธนาคาร</a></li>    
                    <li role="presentation" class="divider"></li>          	
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('department'); ?>">ข้อมูลหน่วยงาน</a></li>  
                    <li role="presentation" class="divider"></li> 
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('businesstype'); ?>">ข้อมูลประเภทธุรกิจ</a></li>
                    <li role="presentation" class="divider"></li>
                	<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('user'); ?>">ข้อมูลผู้ใช้</a></li>
                    <li role="presentation" class="divider"></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('chkuser'); ?>">ตรวจสอบข้อมูลผู้ใช้ในหน่วยงาน</a></li>
                    <li role="presentation" class="divider"></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('news'); ?>">ข่าวด่วน</a></li>
                    <li role="presentation" class="divider"></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('setcon'); ?>">ตั้งค่า Config</a></li>
                <?php } ?>                
            </ul>   
        </li>
       
      
         
         
        <li class="hdmn" style="float:left">
            <a id="mnbtran" class="mnt dropdown-toggle" data-toggle="dropdown">
            <i class="glyphicon glyphicon-list-alt"></i> รายงาน
            </a> 
            <ul id="mnlsetting" class="dropdown-menu" role="menu" aria-labelledby="mnbsetting">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('rpt001'); ?>">รายงานการส่งข้อมูลกลับของธนาคาร</a></li>   
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('rpt002'); ?>">รายงานผลการสอบทรัพย์บัญชีธนาคาร แยกนายจ้าง</a></li>
                <?php if(Yii::app()->user->getInfo('userlevel_id')=='1') { ?>    
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('rpt003'); ?>">รายงานรายละเอียดการบันทึกข้อมูล</a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('rpt004'); ?>">รายงานสรุปการบันทึกข้อมูล</a></li>   
               
                <?php } ?>               
            </ul>   
        </li> 
        <?php /*if(Yii::app()->user->getInfo('userlevel_id')=='1') { ?>  
         <li class="hdmn" style="float:left">
            <a id="mnbtran" class="mnt dropdown-toggle" href="<?php echo Yii::app()->createUrl('convertfile'); ?>">
                <i class="glyphicon glyphicon-share"></i> แปลงไฟล์
            </a>                
        </li> 
        <?php }*/ ?>  
         <li class="hdmn" style="float:left">
            <a id="mnbtran" class="mnt dropdown-toggle" data-toggle="dropdown">
            <i class="glyphicon glyphicon-list-alt"></i> คู่มือการใช้งาน
            </a> 
            <ul id="mnlsetting" class="dropdown-menu" role="menu" aria-labelledby="mnbsetting">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->params['prg_ctrl']['url']['media'];?>_user.pdf" target="_blank">คู่มือการใช้งาน ผู้ใช้งานระดับเจ้าหน้าที่</a></li>                 
                <?php if(Yii::app()->user->getInfo('userlevel_id')=='1') { ?>    
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->params['prg_ctrl']['url']['media'];?>_admin.pdf" target="_blank">คู่มือการใช้งาน ผู้ดูแลระบบ</a></li>
               
                <?php } ?>               
            </ul>   
        </li>        
        <li class="hdmn" style="float:left">
        	
        		
           
       	</li> 
        <li class="hdmn" style="float:right;">  
            <!--<a id="mnbsetting" class="mnt dropdown-toggle" href="#">-->
            <span class="usernm" style=""><?php echo Yii::app()->user->getInfo('displayname'); ?></span> <span class="usernm" style=""><?php echo Yii::app()->user->getInfo('dep_name'); ?></span> 
            <!--/a-->                 
       	</li>   
	</ul>
</div>
