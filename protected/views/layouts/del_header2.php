<div id="headerContainer" class="container">
    <div id="headerContent" class="container">
        <div class="hdlogo">
            <a href="<?php echo Yii::app()->getBaseUrl(true); ?>"><img src="<?php echo Yii::app()->params['prg_ctrl']['logo'] ?>"></a>
            <div class="displaytitle" style="">
            	<a href="<?php echo Yii::app()->createUrl(''); ?>" style="font-size:20px;font-weight:bold;text-decoration:none;"><?php echo Yii::app()->name; ?></a>
            </div>    
        	<div class="displayuser" style="">
        	<span class="usernm"><?php echo Yii::app()->user->getInfo('displayname'); ?></span>
            <span class="usernm"><?php echo Yii::app()->user->getInfo('displayworkplace'); ?></span>
            <span class="usernm">(<?php echo Yii::app()->user->getInfo('usergroupname'); ?>)</span>
            
			<?php /* span class="usernm"><?php echo Yii::app()->user->getInfo('usergroup'); ?></span>
			<span class="usernm"><?php echo Yii::app()->user->getInfo('department'); ?></span>
			<span class="usernm"><?php echo Yii::app()->user->getInfo('departmentgroup'); ?></span */ ?>
            </div>             
        </div>
        <div class="hdsetting">
            <a class="btn btn-danger" href="<?php echo Yii::app()->createUrl('logout'); ?>" style="float:left">
            <i class="glyphicon glyphicon-off"></i> ออกจากระบบ
            </a>
            <div style="clear:both;height:0px;"></div>  
        </div>         
    </div>    
</div> 
<div id="menuContainer" class="container">
	<ul id="menuContent" class="container">
        <li class="hdmn">
            <a id="mnbtran" class="mnt dropdown-toggle" data-toggle="dropdown">
            <i class="glyphicon glyphicon-home"></i> หน้าหลัก
            </a>

            <ul id="mnltran" class="dropdown-menu" role="menu" aria-labelledby="mnbtran">
<?php if(Yii::app()->user->getInfo('usergroup')!='4') { ?>            
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('asset'); ?>">ข้อมูลครุภัณฑ์</a></li>         
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('repair'); ?>">บันทึกแจ้งซ่อม</a></li> 
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('transfer'); ?>">บันทึกโอนย้าย</a></li>     
               <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('borrow'); ?>">บันทึกยีมคืน</a></li>                 
<?php } ?>  

<?php if(Yii::app()->user->getInfo('usergroup')=='4') { ?>            
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('repair'); ?>">บันทึกแจ้งซ่อม</a></li>
<?php } ?>  




                 
<?php /* if(Yii::app()->user->getInfo('usergroup')=='1') { ?>                              
                <li role="presentation" class="divider"></li> 
				<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('macontract'); ?>">ปรับปรุงสัญญาบำรุงรักษา</a></li>              
 <?php } */ ?>         
       
               <?php /*      
                <li role="presentation" class="divider"></li> 
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('import'); ?>">นำเข้าครุภัณฑ์ด้วย Excel</a></li>         
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('macontract'); ?>">ปรับปรุงสัญญาบำรุงรักษา</a></li>   
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('depreciate'); ?>">คำนวนค่าเสื่อม</a></li>   
				*/ ?>                                                   
            </ul>               
        </li>    

<?php if(Yii::app()->user->getInfo('usergroup')=='1') { ?>
        <li class="hdmn">       
            <a id="mnbsetting" class="mnt dropdown-toggle" data-toggle="dropdown">
            <i class="glyphicon glyphicon-cog"></i> ตั้งค่าข้อมูล
            </a>

            <ul id="mnlsetting" class="dropdown-menu" role="menu" aria-labelledby="mnbsetting">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('department'); ?>">ข้อมูลหน่วยงาน</a></li>         
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('departmentgroup'); ?>">ข้อมูลกลุ่มงาน</a></li>         
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('user'); ?>">ผู้ใช้งานระบบ</a></li>         
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('contract'); ?>">ข้อมูลสัญญา</a></li>    
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('company'); ?>">ข้อมูลบริษัท</a></li>         
                <li role="presentation" class="divider"></li>

                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('assetspec'); ?>">ครุภัณฑ์ - Spec</a></li>                         
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('assettype'); ?>">ครุภัณฑ์ - ประเภท</a></li>         
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('assetbrand'); ?>">ครุภัณฑ์ - ยี่ห้อ</a></li>         
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('assetmodel'); ?>">ครุภัณฑ์ - รุ่น</a></li>     
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('repairproblem'); ?>">แจ้งซ่อม - ปัญหาเบื้องต้น</a></li>         
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('repairreason'); ?>">แจ้งซ่อม - สาเหตุปัญหา</a></li>         
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('repairsolution'); ?>">แจ้งซ่อม - การดำเนินการแก้ไข</a></li>         
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('repairos'); ?>">แจ้งซ่อม - ระบบปฎิบัติการ</a></li>    
            </ul>     
         </li>       
<?php } ?> 
 
 
<?php if(Yii::app()->user->getInfo('usergroup')!='4') { ?>        
         <li class="hdmn">       
            <a id="mnbreport" class="mnt dropdown-toggle" data-toggle="dropdown">
            <i class="glyphicon glyphicon-book"></i> รายงาน
            </a>

            <ul id="mnlreport" class="dropdown-menu" role="menu" aria-labelledby="mnbreport">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('rptasset'); ?>">รายงานทะเบียนคุรภัณฑ์</a></li>         
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('rptrepair'); ?>">รายงานการแจ้งซ่อม</a></li>         
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('rpttransfer'); ?>">รายการการโอน</a></li>         
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('rptborrow'); ?>">รายงานการยืมคืน</a></li>         
            </ul>     
         </li>           
<?php } ?> 
<?php if(Yii::app()->user->getInfo('usergroup')=='4') { ?>        
         <li class="hdmn">       
            <a id="mnbreport" class="mnt dropdown-toggle" data-toggle="dropdown">
            <i class="glyphicon glyphicon-book"></i> รายงาน
            </a>

            <ul id="mnlreport" class="dropdown-menu" role="menu" aria-labelledby="mnbreport">       
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('rptrepair'); ?>">รายงานการแจ้งซ่อม</a></li>               
            </ul>     
         </li>           
<?php } ?> 

 
          <li class="hdmn">       
            <a id="mnbprofile" class="mnt dropdown-toggle" data-toggle="dropdown">
            <i class="glyphicon glyphicon-user"></i> แก้ไขข้อมูลส่วนตัว
            </a>

            <ul id="mnlprofile" class="dropdown-menu" role="menu" aria-labelledby="mnbprofile">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('profile'); ?>">แก้ไขข้อมูลส่วนตัว</a></li>         
            </ul>     
         </li>    
        
        
        
	</ul>
</div>

