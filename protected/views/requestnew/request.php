
<?php
	$this->pageTitle = 'SEQUESTER' . Yii::app()->params['prg_ctrl']['pagetitle'];
?>


<style type="text/css">
/*area--------------------------------------*/
/*
#bodyContainer {	
}
#bodyContent {
	width:100%;
    padding: 0px 50px;
}
*/
#bodyContainer, #footerContainer {
    clear: both;
    width: 100%;				
    min-width: 1820px;				
    margin: 0;
    padding: 0;
} 
.searchsection {
	width: 1480px;	
}

.abc{
	background-color:red;
	
}
.yes{
	background-color: #02FF3E;
	
}
/*pager--------------------------------------*/
.grid-view .pager, .grid-view .mailbox-pager {
    margin: 5px 0 0;
    text-align: center;
}
ul.yiiPager {
    border: none;
    display: inline;
    font-size: 0px;
	line-height: 20px;
    margin: 0;
    padding: 0;
    border-radius: 3px;
}
ul.yiiPager li {
    display: inline;
	font-size: 14px;
	margin-right:3px;
	height:20px;
}
.pager li > a, .pager li > span {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 1px;
    display: inline-block;
    padding: 5px 14px;
}
ul.yiiPager a:link, ul.yiiPager a:visited {
    padding: 5px 8px;
}
ul.yiiPager .selected a {
    background: #4FC1E9 none repeat scroll 0 0; /*#2AABD2*/
    color: #ffffff;
    font-weight: bold;
}
ul.yiiPager .first a, ul.yiiPager .previous a, ul.yiiPager .next a, ul.yiiPager .last a {
    background: #e0f0ff none repeat scroll 0 0;
    color: #0e509e;
	font-weight:normal;
	font-size: 13px;
}
.txtlabel{
	width:150px;
}
.txtlabel1{
	width:170px;
}
.txtlabel2{
	width:220px;
}
/*
ul.yiiPager .first, ul.yiiPager .last, ul.yiiPager .next, ul.yiiPager .previous {
	display: inline;
}
*/
.advs{
	display:none;
}
.hdf{
	display:none;
}
.hdf1{
	visibility:;
}
.hdf2{
	display:none;
}

.txtcalendar{
    background: #fff none repeat scroll 0 0;
	height: 34px;	
}
.ipdisable{
	background-color: #CCC;
}

.btncalendar{
    background: #fff none repeat scroll 0 0;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
    color: #333;
    font-size: 16px;
    line-height: normal;
    margin: 0;
    padding: 7px;
    vertical-align: middle;
	border-radius: 2px 0px 0px 2px;
	margin-left:-40px;
	height: 34px;	
	
}
.btncalendar1{
    background: #fff none repeat scroll 0 0;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
    color: #333;
    font-size: 16px;
    line-height: normal;
    margin: 0;
    padding: 7px;
    vertical-align: middle;
	border-radius: 2px 0px 0px 2px;
	margin-left:-65px;
	height: 34px;	
}
.center {
    margin: auto;
	text-align: center;
    width: 80%;
   	
}
</style>  

<div class="panel panel-info searchsection" style="width:100%;">
    <div class="panel-heading">รายการใหม่ รอประมวลผลข้อมูล</div>
    <div class="panel-body sectioncontent">
        <div style="display:block;" class="center">
            <ul>            	
                <li style="list-style:none;">
                    <label class="">ชุดหนังสือ</label>
                    <input type="text" id='txtdoc_code' class="input-default" maxlength="5" style="width:100px; margin-left:20px;">
                    <label style="margin-left:20px;">เลขทะเบียนนายจ้าง</label> 
                    <input type="text" id='txtacc_emp' class="input-default" maxlength="15"  style="width:150px; margin-left:10px;"> 
                    <label style="margin-left:20px;">เลขประจำตัวประชาชน</label> 
                    <input type="text" id='txtiden' class="input-default" maxlength="15" style="width:150px; margin-left:20px;">              		
                    <span>
                        <button class="btn btn-primary" style="margin-left:10px;" onClick="getSearch()">
                            <i class="glyphicon glyphicon-search"></i>
                            ค้นหา
                    	</button> 
                    </span>
                </li>
                <li style="list-style:none;margin-top:5px;">   
                	<label style="margin-left:-560px;margin-right:40px;">สถานะรายการ</label>                  
                   	<input type="checkbox" id="ch1" style="margin-left:5px;" value="1"/><label style="margin-left:5px;">รายการใหม่</label>  
                   	<input type="checkbox" id="ch2" style="margin-left:15px;display:none;" value="2"/><label style="margin-left:5px;display:none;">รอผล</label> 
                   	<input type="checkbox" id="ch3" style="margin-left:15px;" value="3"/><label style="margin-left:5px;">ข้อมูลไม่สมบูรณ์</label>
                   	<input type="checkbox" id="ch4" style="margin-left:15px;display:none;" value="4"/><label style="margin-left:5px;display:none;">ตรวจสอบแล้ว</label>
                </li> <li style="list-style:none;clear:both"></li>
                <li style="list-style:none;">
                   	<input id="hdfstatus" type="hidden" />
                   	<input id="hdfid" type="hidden" />
                   	<input id="hdfremark" type="hidden" />
                    <input id="hdftype" type="hidden" />
                </li>
            </ul>
        </div>
    </div>       
</div>       

 
<div class="panel panel-info">	
  	<div class="panel-body">
        <?php
		$img = Yii::app()->params['prg_ctrl']['url']['baseurl'].'/images/icon/';
		$aa = $img.'plus.png';
		$bb = $img.'warning.png';
		$cc = $img.'bleach.png';
		$dd = $img.'check.png';
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'list-grid',
            'dataProvider' => $model,
            'htmlOptions' => array('style' => 'margin: auto; width: 100%;'),
            'itemsCssClass' => 'table table-bordered table-striped',			
			'rowHtmlOptionsExpression'=>'array("data-id"=>$data["id"])',
			'summaryText' => "
							<div style='float:left;'>								
								<img src='".$aa."' style='width:16px;'/>
								<span style='font-size:12px; margin-right:10px;'>รายการใหม่</span>								
								<img src='".$cc."' style='width:16px;'/>
								<span style='font-size:12px; margin-right:10px;'>ข้อมูลไม่สมบูรณ์</span>
								<!--img src='".$dd."' style='width:16px;'/>
								<span style='font-size:12px; margin-right:10px;'>ตรวจสอบแล้ว</span-->
								<i class='glyphicon glyphicon-star' style='color:#FFCC00;width:20px;'></i>
								<span style='font-size:12px; margin-right:10px;'>รายการที่เตรียมประมวลผลรอบถัดไป</span>
							</div>
							แสดงข้อมูล: {start} - {end} จาก {count} รายการ",			
			'pagerCssClass'=>'mailbox-pager',
			'pager' => array(
				'class'=>'CLinkPager',
                'header' => '',
				'firstPageLabel'=>'หน้าแรก',
				'prevPageLabel'=>'ก่อนหน้า',
				'nextPageLabel'=>'หน้าถัดไป', 
				'lastPageLabel'=>'หน้าสุดท้าย',				
        	),		           		
          	'columns' => array(			
				array(
                    'header' => '',
                    'class' => 'CLinkColumn',
                    'label' => '<i class="glyphicon glyphicon-pencil"></i>',
					'htmlOptions' => array(
                        'width' => '35px',
                        'align' => 'center',
						'onclick'=>'setUpdate(this);'
                    ),
					'linkHtmlOptions'=>array('class'=>'btn btn-info'),
					'headerHtmlOptions'=>array('style'=>'text-align:center;'),
                ),
				array(
					'name'=>'id',
					'header' => 'ลำดับ',					
					'htmlOptions'=>array('style'=>'text-align:center; width:20px;'),
					'headerHtmlOptions'=>array('style'=>'width:20px; text-align:center;vertical-align:middle;'),
				),	
				array(
					//'name'=>'active',
					'type' => 'html',
					'value' => array($this, 'getProcess'),
					'header' => 'เตรียมประมวลผล',
					'htmlOptions'=>array(
						'style'=>'text-align:center;width:100px;'),
						//'class'=>function($data){return $data['status']==2?"abc":"yes";}),
					'headerHtmlOptions'=>array('style'=>'width:100px; text-align:center;vertical-align:middle;'),
				),
				array(
					//'name'=>'active',
					'type' => 'html',
					'value' => array($this, 'getActive'),
					'header' => 'สถานะ',
					'htmlOptions'=>array(
						'style'=>'text-align:center;width:50px;'),
						//'class'=>function($data){return $data['status']==2?"abc":"yes";}),
					'headerHtmlOptions'=>array('style'=>'width:50px; text-align:center;vertical-align:middle;'),
				),		
				/*
				array(
					'name'=>'code',
					'header' => 'ชุดหนังสือ',					
					'htmlOptions'=>array('style'=>'text-align:center; width:30px;'),
					'headerHtmlOptions'=>array('style'=>'width:30px;; text-align:center;'),
				),
				array(
					'name'=>'docno_exp',
					'header' => 'เลขหนังสือ (ส่งออก)',					
					'htmlOptions'=>array('style'=>'text-align:center; width:80px;'),
					'headerHtmlOptions'=>array('style'=>'width:80px; text-align:center;'),
				),
				array(
					'name'=>'docdate_exp',
					'header' => 'วันที่หนังสือ (ส่งออก)',					
					'htmlOptions'=>array('style'=>'text-align:center; width:80px;'),
					'headerHtmlOptions'=>array('style'=>'width:80px; text-align:center;'),
				),
				*/				  				  					
				array(
					'name'=>'doc_no',
					'header' => 'เลขหนังสือ',
					'htmlOptions'=>array('style'=>'width:200px;'),
					'headerHtmlOptions'=>array('style'=>'width:200px; text-align:center;vertical-align:middle;'),
				),
				array(
					'name'=>'doc_date',
					'header' => 'วันที่หนังสือ',
					'htmlOptions'=>array('style'=>'text-align:center; width:30px;'),
					'headerHtmlOptions'=>array('style'=>'width:30px; text-align:center;vertical-align:middle;'),
				),			
				array(
					'name'=>'acc_employer',
					'header' => 'เลขนายจ้าง',
					'htmlOptions'=>array('style'=>'text-align:left;width:50px;'),
					'headerHtmlOptions'=>array('style'=>'width:50px;text-align:center;vertical-align:middle;'),
				),			
				array(
					'name'=>'business_name',
					'header' => 'ประเภทธุรกิจ',
					'htmlOptions'=>array('style'=>'text-align:left;width:300px;'),
					'headerHtmlOptions'=>array('style'=>'width:300px; text-align:center;vertical-align:middle;'),
				),				 
				array(
					'name'=>'full_name',
					'header' => 'ชื่อ - สกุล',
					'htmlOptions'=>array('style'=>'text-align:left;width:150px;'),
					'headerHtmlOptions'=>array('style'=>'width:150px; text-align:center;vertical-align:middle;'),
				),
				array(
					'name'=>'pid',
					'header' => 'เลขป.ช.ช / เลขทะเบียนพาณิชย์',
					'htmlOptions'=>array('style'=>'text-align:left; width:130px;'),
					'headerHtmlOptions'=>array('style'=>'width:130px; text-align:center;vertical-align:middle;'),
				),
				array(
					'name'=>'birth',
					'header' => 'วันเกิด',
					'htmlOptions'=>array('style'=>'text-align:left; width:80px;'),
					'headerHtmlOptions'=>array('style'=>'width:80px; text-align:center;vertical-align:middle;'),
			  	),				  				 	
			  	array(
					'name'=>'address',
					'header' => 'ที่อยู่',
					'htmlOptions'=>array('style'=>'text-align:left;width:700px'),
					'headerHtmlOptions'=>array('style'=>'width:700px;text-align:center;vertical-align:middle;'),
				),
			  	array(
					'name'=>'create_date',
					'header' => 'วันที่บันทึก',
					'htmlOptions'=>array('style'=>'text-align:left;width:30px;'),
					'headerHtmlOptions'=>array('style'=>'width:30px; text-align:center;vertical-align:middle;'),
			  	),				  
			  	array(
					'name'=>'firstname',
					'header' => 'เจ้าของเรื่อง',
					'htmlOptions'=>array('style'=>'text-align:left; width:80px;'),
					'headerHtmlOptions'=>array('style'=>'width:80px; text-align:center;vertical-align:middle;'),
			  	),
			 	array(
					'name'=>'depid_code',
					'header' => 'สังกัด',
					'htmlOptions'=>array('style'=>'text-align:center; width:30px;'),
					'headerHtmlOptions'=>array('style'=>'width:30px; text-align:center;vertical-align:middle;'),
			  	),	
				/*
			  	array(
					'name'=>'cnt',
					'header' => 'ตอบกลับจำนวน',
					'htmlOptions'=>array(
						'style'=>'text-align:center; width:80px;'),
						//'class'=>function($data){return $data['status']==2?"abc":"yes";}),
					'headerHtmlOptions'=>array('style'=>'width:80px; text-align:center;'),
			  	),			  		
				array(
                    'header' => 'ผลการตรวจสอบ',
                    'class' => 'CLinkColumn',
                    'label' => '<i class="glyphicon glyphicon-list-alt"></i>',
					'htmlOptions' => array(
                        'width' => '90px',
                        'align' => 'center',	
						'style'=>'text-align:center;',					
						'onclick'=>'getHeaddetail(this);'
                    ),
					'linkHtmlOptions'=>array('class'=>'btn btn-success'),
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:90px;'),
                ),
				*/
            ),
        ));
        ?>
    </div>
</div>
    
<div id="modaldetail" class="modal fade" aria-hidden="true" aria-labelledby="modaldetailLabel" role="dialog" tabindex="-1">
    <div class="modal-dialog" style="width:750px; margin-top:88px;">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px 20px 7px;">
                <button class="close" data-dismiss="modal" type="button">
                	<span aria-hidden="true">×    <span class="sr-only">Close</span>
                </button>
                <h1 id="modaldetailLabel" class="modal-title">บันทึกข้อมูล</h1>
            </div>
           	<div class="modal-body">            		
        		<ul>
                    <li style="list-style:none;" class="">
                  		<label class="txtlabel">ลำดับที่</label>
                        <input type="text" id='txtno' class="input-default" maxlength="20" style="width:100px; text-align:right; background-color:#ccc;" disabled>
                        <label style="margin-left:148px;">สถานะ</label>
                        <input type="text" id='txtstatus' class="input-default" maxlength="20" style="background-color:#ccc; margin-left:10px;width:200px;" disabled>
                    </li> 
                	<li style="list-style:none; margin-top:15px"" hidden="hidden">
                        <label class="txtlabel">เลขที่ชุดข้อมูล :</label>
                        <input type="text" class="input-default" id="txtcode" style="width:200px;" />
                  	</li>
                   	<li style="list-style:none; margin-top:15px">
                        <label class="txtlabel">เลขที่หนังสือ : <font color="red">*</font></label>
                        <input type="text" class="input-default" id="txtdoc_no" style="width:200px;" maxlength="20" onkeyup="checkText(this.value,this)"/>
                        <label class="" style="margin-left:10px;">วันที่หนังสือ : <font color="red">*</font></label>                                            
                        <input id="txtdoc_date" type="text" class="input-default ipdisable txtcalendar" style="width:200px;" maxlength="10" disabled>
                        <span class="btncalendar" id="btndocdate" style="cursor:pointer;" title="เลือกปฏิทิน">
                            <span class="glyphicon glyphicon-calendar" style="color: #007CFF" ></span>
                        </span>
                        <span class="btncalendar1" id="date_st" onClick="clearcalendar();" style="cursor:pointer;" title="ยกเลิกวันที่">
                            <span class="glyphicon glyphicon-remove" style="color:#FC0004" ></span>
                        </span>
                    </li>
                    <li style="list-style:none; margin-top:15px">
                        <label class="txtlabel">เลขบัญชีนายจ้าง : <font color="red">*</font></label>
                        <input type="text" class="input-default" maxlength="10" id="txtacc_employer" style="width:200px;" onkeyup="checkText(this.value,this)">                            
                    </li>
                    <li style="list-style:none; margin-top:15px">   
                        <label class="txtlabel">บุคคล / นิติบุคคล : <font color="red">*</font></label>
                        <select class="input-default" id="drppid" style="width:200px;" onChange="typeselect('');">
                            <option value="">--เลือก--</option>     
                            <option value="1">บุคคล</option>   
                            <option value="2">นิติบุคคล</option>                                                						
                        </select>                            	
                    </li>
                    <li style="list-style:none; margin-top:15px">
                    	<div class="hdf">
                            <label class="txtlabel" id="txttype"></label>                        
                            <select class="input-default" id="drptype" style="width:200px;" onChange="hdf();"
                                <option value="">--เลือก--</option>
                                
                            </select>
                        </div>
                        <!--div style="margin-left:350px; margin-top:-33px;" class="hdf1">                        
                        	<input type="text" class="input-default" id="txtbusiness_name" maxlength="20" style="width:290px;" onkeyup="checkText(this.value,this)" />              	
                        </div-->
                    </li>             
                    <li style="list-style:none; margin-top:15px" class="hdf2">                        	
                        <label class="txtlabel">ชื่อบริษัท : <font color="red">*</font></label>
                        <input type="text" class="input-default" id="txtcompany_name" style="width:510px;" maxlength="50" placeholder="เช่น บริษัท ABC" onkeyup="checkText(this.value,this)" />
                    </li>   
                    <li style="list-style:none; margin-top:15px" class="hdf2">   
                        <label class="txtlabel">ประเภทเลขนิติบุคคล : <font color="red">*</font></label>
                        <select class="input-default" id="drpemptype" style="width:300px;" onChange="empselect('');">                           
                            <option value="1">ข้อมูลกรมพัฒนาธุรกิจการค้า</option>   
                            <option value="2">ข้อมูลหน่วยงานอื่น</option>                                                						
                        </select>                            	
                    </li>
                    <li style="list-style:none; margin-top:15px" class="hdf2">
                        <label class="txtlabel">เลขนิติบุคคล : <font color="red">*</font></label>                            
                        <input type="text" class=" input-default" style=" width:200px; margin-top:-5px; " maxlength="13" id="txtcid" onkeyup="checkText(this.value,this)" placeholder="เลขทะเบียนนิติบุคคล">
                    </li>                    
                    <li style="list-style:none; margin-top:15px" class="hdf3">
                        <label class="txtlabel">ชื่อ : <font color="red">*</font></label>
                        <input type="text" class="input-default" maxlength="50" id="txtname" style="width:200px;" onkeyup="checkText(this.value,this)">
                        <label class="hdf1" style="margin-left:10px;">นามสกุล : <font color="red">*</font></label>
                        <input type="text" class="input-default hdf1" maxlength="50" id="txtlname" style="width:200px;margin-left:15px;" onkeyup="checkText(this.value,this)">
                    </li>
                   	<li style="list-style:none; margin-top:15px" class="hdf3">
                        <label class="txtlabel">เลขประชาชน : <font color="red">*</font></label>
                        <input type="text" class="input-default" style=" width:200px; margin-top:-5px; " maxlength="13" id="txtpid" placeholder="เลขบัตรประจำตัวประชาชน" onkeyup="checkText(this.value,this)">
                    </li>                    
                   	<li style="list-style:none; margin-top:15px" class="hdf3">
                        <label class="txtlabel">วัน/เดือน/ปี เกิด :</label>
                        <input id="txtbirth" type="text" class="input-default ipdisable txtcalendar" style="width:200px;" maxlength="10" disabled/>
                        <span class="btncalendar" id="btnbirth" style="cursor:pointer;" title="เลือกปฏิทิน">
                            <span class="glyphicon glyphicon-calendar" style="color: #007CFF" ></span>
                        </span>
                        <span class="btncalendar1" id="date_brd1" onClick="clearcalendar1();" style="cursor:pointer;" title="ยกเลิกวันที่">
                            <span class="glyphicon glyphicon-remove" style="color:#FC0004" ></span>
                        </span>
                    </li>
                    <li style="list-style:none; margin-top:15px" class="hdf4">
                        <label class="txtlabel" >ที่อยู่ : <font color="red">*</font></label>
                        <input type="text" class="input-default" maxlength="200" id="txtaddress" style="width:510px;" onkeyup="checkText(this.value,this)">                              
                    </li>  
                    <div class="aa">
                    <?php if(Yii::app()->user->getInfo('userlevel_id')=='1') { ?>
                        <li style="list-style:none; margin-top:15px" >
                            <label class="txtlabel" >ข้อมูลไม่สมบูรณ์ : </label>
                            <input type="checkbox" id="radio_request" onChange="advs()" />                            
                        </li>
                    <?php } ?>
                        <li style="list-style:none; margin-top:15px" class="advs" >
                            <label class="txtlabel" >หมายเหตุ : </label>
                            <input type="text" class="input-default" maxlength="200" id="txtremark" style="width:510px;" onkeyup="checkText(this.value,this)">
                        </li>
                    </div>                    
           		</ul>  
            </div>
            <div class="modal-footer" style="padding: 7px 20px"> 
            	<div>                	   
                    <Button id="btcledit"class="btn btn-default" style="float:right;" data-dismiss="modal" Width="80px">ย้อนกลับ</Button>
                </div>
            	<div class="aa">
                	<input type="button" class="btn btn-danger" style="float:left;" onClick="setDelete();" value="ลบ"/>
                	<input type="button" class="btn btn-success" name="ok" style="float:right; margin-right:10px;" onClick="ajax_savedata();" value="บันทึก"/>   
                </div>                
            </div>            
        </div>
    </div>
</div>




<!-- รายละเอียด -->

<div id="modalshow" class="modal fade" aria-hidden="true" aria-labelledby="modaldetailLabel" role="dialog" tabindex="-1">
    <div class="modal-dialog" style="width: 90%; margin-top:18px;">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px 20px 7px;">
                <button class="close" data-dismiss="modal" type="button">
                	<span aria-hidden="true">×    <span class="sr-only">Close</span>
                </button>
                <h1 id="modalLabel" class="modal-title">ผลการตรวจสอบบัญชีเงินฝาก</h1>
            </div>            
            <div class="modal-body" >     
              	<div>
                    <ul>
                     	<li style="list-style:none;">
                           <label class="txtlabel">ลำดับที่ :</label>
                           <span class="" id="lbid"></span>                           
                        </li>
                        <li style="list-style:none;" class="">                           
                            <label class="txtlabel">ชุดหนังสือ :</label>
                        	<span class="" id="lbcode"></span>
                            <label class="" style="margin-left:100px;">วันที่หนังสือ :</label>
                        	<span class="" id="lbdate"></span>
                        </li> 
                        <li style="list-style:none;">
                           <label class="txtlabel">เลขที่บัญชีนายจ้าง :</label>
                           <span class="" id="lbacc_emp"></span>
                        </li>                       
                        <li style="list-style:none;">
                           <label class="txtlabel">ชื่อ - สกุล :</label>
                           <span class="" id="lbfullname"></span>
                           
                        </li>
            		 </ul>                     
            	</div>
                <div style="margin-top:-30px;">
					<?php
                    $this->widget('zii.widgets.grid.CGridView', array(
                        'id' => 'list-griddetail',
                        'dataProvider' => $modeldetail,
                        'htmlOptions' => array('width' => '1200px'),
                        'itemsCssClass' => 'table table-bordered table-striped',	
                        'rowHtmlOptionsExpression'=>'array("data-id"=>$data["id"])',
                        'summaryText' => 'แสดงข้อมูล: {start} - {end} จาก {count} รายการ',
                        'pagerCssClass'=>'mailbox-pager',
                        'pager' => array(
                            'class'=>'CLinkPager',
                            'header' => '',
                            'firstPageLabel'=>'หน้าแรก',
                            'prevPageLabel'=>'ก่อนหน้า',
                            'nextPageLabel'=>'หน้าถัดไป', 
                            'lastPageLabel'=>'หน้าสุดท้าย',	
                        
                        ),		
                        'columns' => array(
                            array(
                                'name'=>'bank_id',
                                'header' => 'รหัสธนาคาร',
                                'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
                                'headerHtmlOptions'=>array('style'=>'text-align:center;vertical-align:middle;width:50px;'),
                              ),
                            array(
                                'name'=>'bank_name',
                                'header' => 'ชื่อธนาคาร',
                                'htmlOptions'=>array('style'=>'text-align:left;width:200px;'),
                                'headerHtmlOptions'=>array('style'=>'text-align:center;vertical-align:middle;width:150px;'),
                              ),
                            array(
                                'name'=>'bank_dep_id',
                                'header' => 'รหัสสาขา',
                                'htmlOptions'=>array('style'=>'text-align:left;'),
                                'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
                              ),
                            array(
                                'name'=>'bank_dep_name',
                                'header' => 'ชื่อสาขา',
                                'htmlOptions'=>array('style'=>'text-align:left;'),
                                'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
                              ),						 
                            array(
                                'name'=>'acc_type',
                                'header' => 'ประเภทบัญชี',
                                'htmlOptions'=>array('style'=>'text-align:left;'),
                                'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
                              ),
                            
                            array(
                                'name'=>'acc_no',
                                'header' => 'เลขที่บัญชี',
                                'htmlOptions'=>array('style'=>'text-align:left;'),
                                'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
                              ),
                            array(
                                'name'=>'acc_name',
                                'header' => 'ชื่อบัญชี',
                                'htmlOptions'=>array('style'=>'text-align:left;'),
                                'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
                              ),
							  /*
                            array(
                                'name'=>'mark',
                                'header' => 'เครื่องหมายบวกลบของจำนวนเงิน',
                                'htmlOptions'=>array('style'=>'text-align:left;'),
                                'headerHtmlOptions'=>array('style'=>'width:; text-align:center;'),
                              ),	
							  */								
                             array(
                                'name'=>'amont',
                                'header' => 'จำนวนเงินคงเหลือ',
                                'htmlOptions'=>array('style'=>'text-align:right;'),
                                'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
                              ),
                              array(
                                'name'=>'request_date',
                                'header' => 'วันเวลาที่ตรวจ',
                                'htmlOptions'=>array('style'=>'text-align:center;'),
                                'headerHtmlOptions'=>array('style'=>'width:90px; text-align:center;vertical-align:middle;'),
                              ),
                            array(
                                'name'=>'check_status',
                                'header' => 'สถานะ',
                                'htmlOptions'=>array('style'=>'text-align:center;width:40px;'),
                                'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
                              ),
                              array(
                                'name'=>'remark',
                                'header' => 'หมายเหตุ',
                                'htmlOptions'=>array('style'=>'text-align:left;'),
                                'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
                              ),
                        ),
                    ));
                    ?>
                </div>        
            </div>
            <div class="modal-footer" style="padding: 7px 20px">
                <h3 id="errmodaldetail" class="sectionError"></h3>
                <div class="sectionButton">                    
                    <Button ID="btcledit"class="btn btn-default" data-dismiss="modal" Width="80px">ย้อนกลับ</Button>
                </div>
       		</div>
        </div>
    </div>
</div>

<script type="text/javascript">
$('#hdftype').val("<?php echo Yii::app()->params['data_ctrl']['businesstype']['othtr']; ?>");
var storage = [];
	<?php 	
		$data=lookupdata::getPrefix();
		foreach($data as $obj) {			
	?>	
			storage.push('<?php echo $obj['name']; ?>');
			//storage.push('s');
	<?php
		};
	?>
jQuery(document).ready(function ($) {
	$('#modaldetail').on('show.bs.modal', function (e) {
				
            });
	$('#modaldetail').on('hidden.bs.modal', function (e) {       
		$(".advs").css("display", "none");
		$('#txtremark').val('');
	});
	/*
	$("#txtbirth").datepicker({		
		dateFormat: "dd/mm/yy"     
	});*/
	$("#txtbirth").attr("disabled", "disabled"); 
	$("#txtbirth").css('background-color', '#ccc');	 
	  $('#txtbirth').datepicker({
			format: 'dd/mm/yyyy',
			todayBtn: true,
			language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
			thaiyear: true              //Set เป็นปี พ.ศ.
		});  //กำหนดเป็นวันปัจุบัน		
	$('#btnbirth').click(function () {
			
			$("#txtbirth").removeAttr("disabled"); 
			$('#txtbirth').datepicker('show');
			$("#txtbirth").attr("disabled", "disabled"); 
			$("#txtbirth").css('background-color', '#ccc');

	});
		/*
	$("#txtdoc_date").datepicker({
		dateFormat: "dd/mm/yy" 
	});*/
	$("#txtdoc_date").attr("disabled", "disabled"); 
	$("#txtdoc_date").css('background-color', '#ccc');	 
	  $('#txtdoc_date').datepicker({
			format: 'dd/mm/yyyy',
			todayBtn: true,
			language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
			thaiyear: true              //Set เป็นปี พ.ศ.
		});  //กำหนดเป็นวันปัจุบัน		
	$('#btndocdate').click(function () {
			
			$("#txtdoc_date").removeAttr("disabled"); 
			$('#txtdoc_date').datepicker('show');
			$("#txtdoc_date").attr("disabled", "disabled"); 
			$("#txtdoc_date").css('background-color', '#ccc');

	});	
	$('#ch1').prop('checked', true);
	$('#ch2').prop('checked', true);
	$('#ch3').prop('checked', true);
	$('#ch4').prop('checked', true);
	$("#txtdoc_code").keyup(function (e) {
		if (e.keyCode == 13) {getSearch();}
	});
	$("#txtacc_emp").keyup(function (e) {
		if (e.keyCode == 13) {getSearch();}
	});
	$("#txtiden").keyup(function (e) {
		if (e.keyCode == 13) {getSearch();}
	});
	
});

function getSearch() {
	var status1,status2,status3,status4;
	if($("#ch1").is(':checked')){ 
		status1 = '1';  
	}else{
		status1 = null;	
	}
	if($("#ch3").is(':checked')){
		status3 = '3';
	}else{
		status3 = null;
	}
	/*
	if($("#ch2").is(':checked')){
		status2 = '2';
	}else{
		status2 = null;
	}
	
	if($("#ch4").is(':checked')){
		status4 = '4';
	}else{
		status4 = null;
	}
	*/	
	var data = {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','keyword': $('#txtdoc_code').val(),'acc_emp': $('#txtacc_emp').val(),'iden': $('#txtiden').val(),'status1':status1,'status3':status3};//,'status2':status2,'status4':status4}; 
	$.fn.yiiGridView.update('list-grid', {
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("requestnew/search"); ?>',
		data: data,
	});
}
/*
function ajax_savedata() {
	if($('#txtdoc_no').val()==''){
		alert('กรุณากรอกเลขที่หนังสือ');
		return;
	}
	if($('#txtdoc_date').val()==''){
		alert('กรุณากรอกวันที่หนังสือ');
		return;
	}
	if($('#txtacc_employer').val()==''){
		alert('กรุณากรอกเลขที่บัญชีนายจ้าง');
		return;
	}	
	//var ck_acc_employer = $('#txtacc_employer').val().length;
	if($('#txtacc_employer').val().length<10){
		alert('กรุณากรอกเลขที่บัญชีนายจ้างให้ครบ');
		return;
	}	
	if($('#drpid').val()==''){
		alert('กรุณาเลือก บุคคล / นิติบุคคล');
		return;
	}else{		
		if($('#drppid').val()==1){
			if($('#drptype').val()==''){
				alert('กรุณาเลือกคำนำหน้าชื่อ');
				return;
			}
			
			if($('#txtname').val()==''){
				alert('กรุณากรอกชื่อ');
				return;
			}
			if($('#drptype').val()!=25){
				if($('#txtlname').val()==''){
					alert('กรุณากรอกนามสกุล');
					return;
				}
			}
			
			
			if($('#txtpid').val()==''){
				alert('กรุณากรอกเลขบัตรประจำตัวประชาชน');
				return;
			}
			var ck_txtpid = $('#txtpid').val().length;
			if(ck_txtpid<13){
				alert('กรุณากรอกเลขบัตรประจำตัวประชาชนให้ครบ');
				return;
			}
			
		}else{
			if($('#drptype').val()==''){
				alert('กรุณาเลือกประเภทธุรกิจ');
				return;
			}
			
			if($('#txtcid').val()==''){
				alert('กรุณากรอกเลขทะเบียนนิติบุคคล');
				return;
			}
			if($('#txtcompany_name').val()==''){
				alert('กรุณากรอกชื่อสถานประกอบการ');
				return;
			}			
			
		}
	}
	
	if($('#txtaddress').val()==''){
		alert('กรุณากรอกที่อยู่');
		return;
	}
	
	var id=$('#hdfid').val();
	var doc_no=$('#txtdoc_no').val();
	var acc_employer=$('#txtacc_employer').val();
	var pid_type=$('#drppid').val();//บุคคลข-นิติ
	var business_type=$('#drptype').val();//ประเภทธุรกิจข-คำนำหน้าชื่อ
	//var business_name=$('#txtbusiness_name').val();//กรณีที่เลือก อื่น ๆ 
	//บุคคล
	var name = $('#txtname').val();			
	var lname = $('#txtlname').val();
	if(business_type==25){lname=''}
	var bb = $('#txtbirth').val();
	var pid = $('#txtpid').val();
	//นิติ
	var company = $('#txtcompany_name').val();
	var cid = $('#txtcid').val();
	
	var address=$('#txtaddress').val();	
	var aa=$('#txtdoc_date').val();
		
	var bbb = ex_date2db(bb);	
	var aaa = ex_date2db(aa);
	
	
	
	var aaDate = new Date(aaa)
	var aaMonth = ((aaDate.getMonth().length+1) === 1)? (aaDate.getMonth()+1) : + (aaDate.getMonth()+1); 
	var doc_date = (aaDate.getFullYear()-543) + "-" + aaMonth + "-" + aaDate.getDate();
	
	var bbDate = new Date(bbb)
	var bbMonth = ((bbDate.getMonth().length+1) === 1)? (bbDate.getMonth()+1) : + (bbDate.getMonth()+1); 
	var birth = (bbDate.getFullYear()-543) + "-" + bbMonth + "-" + bbDate.getDate();
	//alert(doc_date);
	//return;
	
		if(doc_date=='NaN-NaN-NaN'){
			doc_date=null;			
		}
		if(birth=='NaN-NaN-NaN'){
			birth=null;			
		}
	
	<?php if(Yii::app()->user->getInfo('userlevel_id')=='1') { ?>
	
	
	
		var active = $('#radio_request').val();	
		if($('#radio_request').is(':checked')){
			active =3;
		}else{
			active =1;
		}
		
		var remark = $('#txtremark').val();
		
		
		
	<?php }else{ ?>
	
		var active = 1;	
		var remark ='';
		<?php } ?>
	
	
	
    $.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl("requestnew/savedata"); ?>",
		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'id':id,
				'doc_no':doc_no,'acc_employer':acc_employer,'pid_type':pid_type,'business_type':business_type,
				'name':name,'lname':lname,'birth':birth,'pid':pid,'cid':cid,//'business_name':business_name,
				'company':company,'address':address,'doc_date':doc_date,'active':active,'remark':remark
		},
		dataType: "json",				
		success: function (data) {
			if (data.status=='success') {	
				$('#txtdoc_no').val('');
				$('#txtdoc_date').val('');
				$('#txtacc_employer').val('');		
				$('#drppid').val('');				
				$('#txtremark').val('');
				advs();
				//typeselect();
				getSearch();
				//alert('บันทึกข้อมูลเรียบร้อยแล้ว');
				$("#modaldetail").modal('hide');
			}
			else{
				alert(data.msg);
			} 
		}
	});
}	
*/
function ajax_savedata() 
{
	var isText=true;
	//var str = $('#txt').val();
	var txt1 = "'";
	var txt2 = '"';	
	var txt3 = "๑๒๓๔๕๖๗๘๙๐";
    var orgi_text=txt1+txt2+txt3;

	var state=$('#hdfstatus').val();
	var id=$('#hdfid').val();
	
	var doc_no=$.trim($('#txtdoc_no').val());
	
	var acc_employer=$.trim($('#txtacc_employer').val());
	
	//บุคคล
	var name = $.trim($('#txtname').val());			
	var lname = $.trim($('#txtlname').val());	
	var pid = $.trim($('#txtpid').val());
	//นิติ
	var company = $.trim($('#txtcompany_name').val());
	var emptype = $('#drpemptype').val();
	var cid = $.trim($('#txtcid').val());
	
	var address=$.trim($('#txtaddress').val());	
	
	var chk_text="";
	var chk ='';
	if($('#txtdoc_date').val()==''){
		alert('กรุณากรอกวันที่หนังสือ');
		return;
	}
	
	if(doc_no!=''){
		chk_text=doc_no.split("");
		chk_text.filter(function(s){        
			if(orgi_text.indexOf(s)!=-1){
				alert("เลขที่หนังสือมีอักขระพิเศษ !");
				return;
			}           
		});
	}else{
		alert('กรุณากรอกเลขที่หนังสือ');
		return;
	}
	
	
	
	if(acc_employer!=''){
		if(acc_employer.length<10){
			alert('กรุณากรอกเลขที่บัญชีนายจ้างให้ครบ');
			return;
		}	
		chk_text=acc_employer.split("");
		chk_text.filter(function(s){        
			if(orgi_text.indexOf(s)!=-1){
				alert('เลขที่บัญชีนายจ้างมีอักขระพิเศษ !');
				return;				
			}           
		}); 
	}else{
		alert('กรุณากรอกเลขที่บัญชีนายจ้าง');
		return;
		
	}
	
	if($('#drpid').val()==''){
		alert('กรุณาเลือก บุคคล / นิติบุคคล');
		return;
	}else{		
		if($('#drppid').val()==1){
			if($('#drptype').val()==''){
				alert('กรุณาเลือกคำนำหน้าชื่อ');
				return;
			}
			
			if(name!=''){
				chk = name;
				chk_text=name.split("");
				chk_text.filter(function(s){        
					if(orgi_text.indexOf(s)!=-1){
						alert('ชื่อมีอักขระพิเศษ !');
						return;				
					}           
				}); 
			}else{
				alert('กรุณากรอกชื่อ');
				return;
			}
			
			if($('#drptype').val()!=25){
				if(lname!=''){
					chk_text=lname.split("");
					chk_text.filter(function(s){        
						if(orgi_text.indexOf(s)!=-1){
							alert('นามสกุลมีอักขระพิเศษ !');
							return;				
						}           
					});
				}else{
					alert('กรุณากรอกนามสกุล');
					return;
				}
			}
			
			if(pid!=''){
				var ck_txtpid = pid.length;
				if(ck_txtpid<13){
					alert('กรุณากรอกเลขบัตรประจำตัวประชาชนให้ครบ');
					return;
				}
				chk_text=pid.split("");
				chk_text.filter(function(s){        
					if(orgi_text.indexOf(s)!=-1){
						alert('เลขบัตรประจำตัวประชาชนมีอักขระพิเศษ !');
						return;				
					}           
				});
			}else{
				alert('กรุณากรอกเลขบัตรประจำตัวประชาชน');
				return;				
			}
			
			
			
			
		}else{
			if($('#drptype').val()==''){
				alert('กรุณาเลือกประเภทธุรกิจ');
				return;
			}
			if(cid!=''){
				chk_text=cid.split("");
				chk_text.filter(function(s){        
					if(orgi_text.indexOf(s)!=-1){
						alert('เลขทะเบียนนิติบุคคลมีอักขระพิเศษ !');
						return;				
					}           
				});
			}else{
				alert('กรุณากรอกเลขทะเบียนนิติบุคคล');
				return;
			}
			
			
			var ck_emp = $('#drpemptype').val();			
			var ck_txtcid = cid.length;
			
			if(ck_emp==1){
				if(ck_txtcid!=13){				
					alert('กรุณากรอกเลขทะเบียนนิติบุคคลให้ครบ 13 หลัก');
					return;
				}				
			}else{
				if(ck_txtcid<5 || ck_txtcid>15){				
					alert('กรุณากรอกเลขทะเบียนนิติบุคคลให้ครบ');
					return;
				}
			}
			
			
			if(company!='')
			{
				chk = company;
				chk_text=company.split("");
				chk_text.filter(function(s){        
					if(orgi_text.indexOf(s)!=-1){
						alert('ชื่อสถานประกอบการมีอักขระพิเศษ !');
						return;				
					}           
				});
			}else{
				alert('กรุณากรอกชื่อสถานประกอบการ');
				return;
				
			}		
		}
	}
	if(address!=""){
		chk_text=address.split("");
		chk_text.filter(function(s){        
			if(orgi_text.indexOf(s)!=-1){
				alert('ชื่อสถานประกอบการมีอักขระพิเศษ !');
				return;				
			}           

		});
		
	}else{
		alert('กรุณากรอกที่อยู่');
		return;
		
	}/*
	if($('#txtaddress').val()==''){
		alert('กรุณากรอกที่อยู่');
		return;
	}
	
	var name = $('#txtname').val();	
	var company = $('#txtcompany_name').val();
	
	if(name!='')
	{
		chk = name;
		
	}
	*/
	
	var i =0;
	
	$.each(storage, function(key, value) {
		if(chk.indexOf(value) !== -1){ 
			i=1;
			var r = confirm("ชื่อที่คุณกรอกข้อมูลมีคำนำหน้าชื่อในระบบแล้ว คุณต้องการดำเนินการต่อหรือไม่ !");
	
			if (r == true) {
				save_data();
		  	}
		} 
	});
	//var chkname = ["บริษัท"];
	var chkname = [];
	chkname.push('บริษัท');
	$.each(chkname, function(key, value) {
		if(chk.indexOf(value) !== -1){ 
			i=2;
			var r = confirm("ชื่อที่คุณกรอกข้อมูลมีคำนำหน้าชื่อในระบบแล้ว คุณต้องการดำเนินการต่อหรือไม่ !");
	
			if (r == true) {
				save_data();
		  	}
		} 
	});
	
	if(i==0){
		save_data();
	}
}	
function save_data()
{
	
	
	var state=$('#hdfstatus').val();
	var id=$('#hdfid').val();
	var doc_no=$('#txtdoc_no').val();
	
	var acc_employer=$('#txtacc_employer').val();
	var pid_type=$('#drppid').val();//บุคคลข-นิติ
	var business_type=$('#drptype').val();//ประเภทธุรกิจข-คำนำหน้าชื่อ
	//var business_name=$('#txtbusiness_name').val();//กรณีที่เลือก อื่น ๆ 
	//บุคคล
	var name = $.trim($('#txtname').val());			
	var lname = $.trim($('#txtlname').val());
	if(business_type==25){lname=''}
	var bb = $('#txtbirth').val();
	var pid = $('#txtpid').val();
	//นิติ
	var company = $.trim($('#txtcompany_name').val());
	var emptype = $('#drpemptype').val();
	var cid = $('#txtcid').val();
	
	var address=$.trim($('#txtaddress').val());	
	var aa=$('#txtdoc_date').val();
		
	var bbb = ex_date2db(bb);	
	var aaa = ex_date2db(aa);
	
	
	
	
	
	var aaDate = new Date(aaa)
	var aaMonth = ((aaDate.getMonth().length+1) === 1)? (aaDate.getMonth()+1) : + (aaDate.getMonth()+1); 
	var doc_date = (aaDate.getFullYear()-543) + "-" + aaMonth + "-" + aaDate.getDate();
	
	var bbDate = new Date(bbb)
	var bbMonth = ((bbDate.getMonth().length+1) === 1)? (bbDate.getMonth()+1) : + (bbDate.getMonth()+1); 
	var birth = (bbDate.getFullYear()-543) + "-" + bbMonth + "-" + bbDate.getDate();
	//alert(doc_date);
	//return;
	
		if(doc_date=='NaN-NaN-NaN'){
			doc_date=null;			
		}
		if(birth=='NaN-NaN-NaN'){
			birth=null;			
		}
	
	<?php if(Yii::app()->user->getInfo('userlevel_id')=='1') { ?>
	
	
	
		var active = $('#radio_request').val();	
		if($('#radio_request').is(':checked')){
			active =3;
		}else{
			active =1;
		}
		
		var remark = $('#txtremark').val();
		
		
		
	<?php }else{ ?>
	
		var active = 1;	
		var remark ='';
		<?php } ?>
	
	/*
	if(status==3){		
		if ($('#radio_request').is(':checked')) {
			var active = $('#radio_request').val();	
			var remark = $('#txtremark').val();	
		}else{
			$(".advs").css("display", "none");
			$("#radio_request").val('1');
		}
	}
	*/
	
	
	
	$.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl("requestnew/savedata"); ?>",
		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'id':id,
				'doc_no':doc_no,'acc_employer':acc_employer,'pid_type':pid_type,'business_type':business_type,
				'name':name,'lname':lname,'birth':birth,'pid':pid,'cid':cid,'emptype':emptype,
				'company':company,'address':address,'doc_date':doc_date,'active':active,'remark':remark,'state':state
		},
		dataType: "json",				
		success: function (data) {
			if (data.status=='success') {	
				//$('#txtdoc_no').val('');
				//$('#txtdoc_date').val('');
				$('#txtacc_employer').val('');		
				$('#drppid').val('');				
				$('#txtremark').val('');
				//alert('บันทึกข้อมูลเรียบร้อยแล้ว');
				//$("#modaldetail").modal('hide');
				$("#txtdoc_no").attr("disabled", "disabled");
				$("#txtdoc_no").css({"background-color": "#ccc"});
				$("#btndocdate").css("display", "none");
				$("#date_st").css("display", "none");
				typeselect();
				getSearch();
				//alert('บันทึกข้อมูลเรียบร้อยแล้ว');
				$("#modaldetail").modal('hide');
				swal({
				title: "สำเร็จ !",
				text: "ทำการบันทึกข้อมูลสำเร็จ",
				icon: "success",
				button: "ตกลง",
				});	
			}
			else{
				alert(data.msg);
			} 
		}
	});
	
}
function typeselect(type){	 
	var id = $('#drppid').val();	
	//alert(id);
	if(id==''){
		$(".hdf").css("display", "none");
		$(".hdf1").css("visibility", "");
		$(".hdf2").css("display", "none");
		$(".hdf3").css("display", "none");
		$(".hdf4").css("display", "none");
		//$('#txtbusiness_name').val('');
		//$("#txtbusiness_name").attr("disabled", "disabled");
		$('#txtname').val('');			
		$('#txtlname').val('');
		$('#txtbirth').val('');
		$('#txtpid').val('');
		$('#txtcompany_name').val('');
		$('#txtcid').val('');
		$('#txtaddress').val('');	
		return;
	}else{
		if(id==1){
			$(".hdf").css("display", "block");
			$(".hdf2").css("display", "none");
			$(".hdf3").css("display", "block");
			$(".hdf4").css("display", "block");
			$("#txttype").html("คำนำหน้าชื่อ : <font color='red'>*</font>");	
			$(".hdf1").css("visibility", "");
			
		}else{
			$(".hdf1").css("visibility", "");
			$(".hdf").css("display", "block");
			$(".hdf2").css("display", "block");
			$(".hdf3").css("display", "none");
			$(".hdf4").css("display", "block");
			$("#txttype").html("ประเภทธุรกิจ : <font color='red'>*</font>");
		}
		$("#txtname").attr("placeholder",  "").val('').focus().blur();
		$('#txtname').val('');			
		$('#txtlname').val('');
		$('#txtbirth').val('');
		$('#txtpid').val('');
		$('#txtcompany_name').val('');
		$('#txtcid').val('');
		$('#txtaddress').val('');		
	}	
	$.ajax({
    	type: "POST",
    	url: "<?php echo Yii::app()->createAbsoluteUrl("requestnew/selecttype"); ?>",
  		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id},
    	dataType: "json",				
    	success: function (data) {
			if (data.status=='success') {
				//alert(data.data);
				$("#drptype").empty();
				$('#drptype').append('<option value="">--เลือก--</option>');
				var _object = data.data;
					for(var i in _object){
						$("#drptype").append("<option value='" + _object[i]['id'] + "'>" + _object[i]['name'] + "</option>");
					}			
				if(type!=null){
					$("#drptype").val(type);
				}			
			}else{
				alert(data.msg);
			} 
		}
	});	
}

function hdf(){		
	var id = $('#drppid').val();
	var type = $('#drptype').val();	
	/*
	if(type==$('#hdftype').val()){	
		//$(".hdf1").css("display", "block");
		if(id==1){				
			$("#txtbusiness_name").attr("placeholder", "เช่น ดร.,นพ.").val("").focus().blur();
		}else{				
			$("#txtbusiness_name").attr("placeholder", "เช่น บริษัท จำกัด").val("").focus().blur();
			//$(".hdf2").css("display", "block");
		}		
	}else{
		//$(".hdf1").css("display", "none");
	}	
	*/
	if(type==25){
		$(".hdf1").css("visibility", "hidden");
		$("#txtname").attr("placeholder",  "เช่น พตท. เก่ง เรียนดี").val('').focus().blur();
	}else{
		$(".hdf1").css("visibility", "");
		$("#txtname").attr("placeholder",  "").val('').focus().blur();
	}
}

function advs() {
	//var aa = $('#radio_request').val();
	if ($('#radio_request').is(':checked')) {
		$(".advs").css("display", "block");
	}else{
		$(".advs").css("display", "none");
		$("#radio_request").val('1');
	}
}
function empselect(type)
{	
	var emptype = $('#drpemptype').val();
	
	if(emptype!=1){
		$("#txtcid").attr("placeholder",  "เลขนิติบุคคลที่ได้จากหน่วยงานอื่น").val('').focus().blur();
	}else{
		$("#txtcid").attr("placeholder",  "เลขนิติบุคคล 13 หลัก").val('').focus().blur();
	}
	//alert(emptype);
}
function setUpdate(el) {	
	var id = $(el).parent().attr("data-id"); 
	
	 $.ajax({
    	type: "POST",
    	url: "<?php  echo Yii::app()->createAbsoluteUrl("requestnew/requestdata"); ?>",
  		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id},
    	dataType: "json",				
		success: function (data) {
			if (data.status=='success') {					
				$('#hdfid').val(data.id);
				if(data.activereq==2){
					
					$("#txtdoc_no").attr("disabled", "disabled");
					//$("#txtdoc_date").attr("disabled", "disabled");
					$("#txtacc_employer").attr("disabled", "disabled");
					$("#drppid").attr("disabled", "disabled");
					$("#drptype").attr("disabled", "disabled");
					//$("#txtbusiness_name").attr("disabled", "disabled");
					$("#txtname").attr("disabled", "disabled");
					$("#txtlname").attr("disabled", "disabled");
					//$("#txtbirth").attr("disabled", "disabled");
					$("#txtpid").attr("disabled", "disabled");
					$("#txtcid").attr("disabled", "disabled");
					$("#txtaddress").attr("disabled", "disabled");
					$("#txtcompany_name").attr("disabled", "disabled");
					
					
					$("#txtdoc_no").css({"background-color": "#ccc"});
					//$("#txtdoc_date").css({"background-color": "#ccc"});
					$("#txtacc_employer").css({"background-color": "#ccc"});
					$("#drppid").css({"background-color": "#ccc"});
					$("#drptype").css({"background-color": "#ccc"});
					//$("#txtbusiness_name").css({"background-color": "#ccc"});
					$("#txtname").css({"background-color": "#ccc"});
					$("#txtlname").css({"background-color": "#ccc"});
					//$("#txtbirth").css({"background-color": "#ccc"});
					$("#txtpid").css({"background-color": "#ccc"});
					$("#txtcid").css({"background-color": "#ccc"});	
					$("#txtaddress").css({"background-color": "#ccc"});
					$("#txtcompany_name").css({"background-color": "#ccc"});	
					$(".aa").css("display", "none");
					
				}
				if(data.activereq==4){
					
					$("#txtdoc_no").attr("disabled", "disabled");
					//$("#txtdoc_date").attr("disabled", "disabled");
					$("#txtacc_employer").attr("disabled", "disabled");
					$("#drppid").attr("disabled", "disabled");
					$("#drptype").attr("disabled", "disabled");
					//$("#txtbusiness_name").attr("disabled", "disabled");
					$("#txtname").attr("disabled", "disabled");
					$("#txtlname").attr("disabled", "disabled");
					//$("#txtbirth").attr("disabled", "disabled");
					$("#txtpid").attr("disabled", "disabled");
					$("#txtcid").attr("disabled", "disabled");
					$("#txtaddress").attr("disabled", "disabled");
					$("#txtcompany_name").attr("disabled", "disabled");
					
					
					$("#txtdoc_no").css({"background-color": "#ccc"});
					//$("#txtdoc_date").css({"background-color": "#ccc"});
					$("#txtacc_employer").css({"background-color": "#ccc"});
					$("#drppid").css({"background-color": "#ccc"});
					$("#drptype").css({"background-color": "#ccc"});
					//$("#txtbusiness_name").css({"background-color": "#ccc"});
					$("#txtname").css({"background-color": "#ccc"});
					$("#txtlname").css({"background-color": "#ccc"});
					//$("#txtbirth").css({"background-color": "#ccc"});
					$("#txtpid").css({"background-color": "#ccc"});
					$("#txtcid").css({"background-color": "#ccc"});	
					$("#txtaddress").css({"background-color": "#ccc"});
					$("#txtcompany_name").css({"background-color": "#ccc"});	
					$(".aa").css("display", "none");
					
				}
				if(data.activereq==1){
					
					$("#txtdoc_no").removeAttr("disabled");
					//$("#txtdoc_date").removeAttr("disabled");
					$("#txtacc_employer").removeAttr("disabled");
					$("#drppid").removeAttr("disabled");
					$("#drptype").removeAttr("disabled");
					//$("#txtbusiness_name").removeAttr("disabled");
					$("#txtname").removeAttr("disabled");
					$("#txtlname").removeAttr("disabled");
					//$("#txtbirth").removeAttr("disabled");
					$("#txtpid").removeAttr("disabled");
					$("#txtcid").removeAttr("disabled");
					$("#txtaddress").removeAttr("disabled");
					$("#txtcompany_name").removeAttr("disabled");						
					
					$("#txtdoc_no").css({"background-color": "#fff"});
					//$("#txtdoc_date").css({"background-color": "#fff"});
					$("#txtacc_employer").css({"background-color": "#fff"});
					$("#drppid").css({"background-color": "#fff"});
					$("#drptype").css({"background-color": "#fff"});
					//$("#txtbusiness_name").css({"background-color": "#fff"});
					$("#txtname").css({"background-color": "#fff"});
					$("#txtlname").css({"background-color": "#fff"});
					//$("#txtbirth").css({"background-color": "#fff"});
					$("#txtpid").css({"background-color": "#fff"});
					$("#txtcid").css({"background-color": "#fff"});	
					$("#txtaddress").css({"background-color": "#fff"});
					$("#txtcompany_name").css({"background-color": "#fff"});	
					$(".aa").css("display", "block");
				}
				if(data.activereq==3){
					
					$("#txtdoc_no").removeAttr("disabled");
					//$("#txtdoc_date").removeAttr("disabled");
					$("#txtacc_employer").removeAttr("disabled");
					$("#drppid").removeAttr("disabled");
					$("#drptype").removeAttr("disabled");
					//$("#txtbusiness_name").removeAttr("disabled");
					$("#txtname").removeAttr("disabled");
					$("#txtlname").removeAttr("disabled");
					//$("#txtbirth").removeAttr("disabled");
					$("#txtpid").removeAttr("disabled");
					$("#txtcid").removeAttr("disabled");
					$("#txtaddress").removeAttr("disabled");
					$("#txtcompany_name").removeAttr("disabled");						
					
					$("#txtdoc_no").css({"background-color": "#fff"});
					//$("#txtdoc_date").css({"background-color": "#fff"});
					$("#txtacc_employer").css({"background-color": "#fff"});
					$("#drppid").css({"background-color": "#fff"});
					$("#drptype").css({"background-color": "#fff"});
					//$("#txtbusiness_name").css({"background-color": "#fff"});
					$("#txtname").css({"background-color": "#fff"});
					$("#txtlname").css({"background-color": "#fff"});
					//$("#txtbirth").css({"background-color": "#fff"});
					$("#txtpid").css({"background-color": "#fff"});
					$("#txtcid").css({"background-color": "#fff"});	
					$("#txtaddress").css({"background-color": "#fff"});
					$("#txtcompany_name").css({"background-color": "#fff"});	
					$(".aa").css("display", "block");
				}
				//$('#txtcode').val(data.code);
				
				
				
				
				
				$('#txtdoc_no').val(data.doc_no);	
				$('#txtdoc_date').val(data.doc_date);	
				$('#txtacc_employer').val(data.acc_employer);	
				$('#drpemptype').val(data.emptype);					
				$('#drppid').val(data.pid_type);
				//alert(data.business_type);
				typeselect(data.business_type);
				//$('#drptype').val(data.business_type);
				/*
				if(data.business_type==$('#hdftype').val()){
					//$(".hdf1").css("display", "block");
					$('#txtbusiness_name').val(data.business_name);	
					//alert($('#hdftype').val());								
				}else{
					//$(".hdf1").css("display", "none");
					$('#txtbusiness_name').val('');	
					//alert($('#hdftype').val());						
				}			
					*/	
				if(data.business_type==25){
					$(".hdf1").css("visibility", "hidden");
						
				}else{
					$(".hdf1").css("visibility", "");
										
				}	
									
				$('#txtname').val(data.name);	
				$('#txtlname').val(data.lname);
				$('#txtbirth').val(data.birth);
				$('#txtpid').val(data.pid);
				$('#txtcid').val(data.cid);	
				$('#txtaddress').val(data.address);
				
				
				$('#txtcompany_name').val(data.company_name);
				$('#txtno').val(data.id);
				$('#txtstatus').val(data.active);
				$('#hdfstatus').val(data.activereq);
				
				
				<?php if(Yii::app()->user->getInfo('userlevel_id')!='1') { ?>
				if(data.activereq==3){						
					$("#radio_request").prop('checked', true);
					$("#txtremark").css({"background-color": "#ccc","color": "#000"});
					$('#txtremark').val(data.remark);	
					$("#txtremark").attr("disabled", "disabled"); 					
					advs();
					$(".advs").css("display", "block");
				}else{
					$("#radio_request").prop('checked', false);
					$("#txtremark").removeAttr("disabled");					 
				}					
				<?php }else{ ?>
				if(data.activereq==3){						
					$("#radio_request").prop('checked', true);						
					$('#txtremark').val(data.remark);			
					advs();
					$(".advs").css("display", "block");
				}else{
					$("#radio_request").prop('checked', false);
					$("#txtremark").removeAttr("disabled");					 
				}							 
				<?php } ?>					
				
				//$(".advs").css("display", "block");
				$("#modaldetailLabel").html("แก้ไขข้อมูล");   
				$("#modaldetail").modal('show');
				
			}else{
				alert(data.msg);
			} 			
	 	}
	});	
}
function getHeaddetail(el) {
	var id = $(el).parent().attr("data-id"); 
	$.ajax({
    	type: "POST",
    	url: "<?php  echo Yii::app()->createAbsoluteUrl("requestnew/Searchhead"); ?>",
  		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id},
    	dataType: "json",				
		success: function (data) {
			if (data.status=='success') {
				$('#lbcode').html(data.code);
				$('#lbdate').html(data.doc_date);
				$('#lbacc_emp').html(data.acc_employer);
				$('#lbid').html(data.id);
				$('#lbfullname').html(data.full_name);
				//$("#modalshow").modal('show');			
				setDetail(id);
			}else{
				alert(data.msg);
			} 
		}
	});	
}
function setDetail(id) {	
	var data = {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>', 'id': id}; 
	$.fn.yiiGridView.update('list-griddetail', {
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("requestnew/searchdetail"); ?>',
		data: data,
	});	
	$("#modalshow").modal('show');	
}

function setDelete() {
	var id = $('#hdfid').val();
	swal({
			title: "แน่ใจหรือว่าต้องการลบ ?",
			text: "เมื่อทำการยืนยันข้อมูลจะถูกลบออกจากระบบ !",
			icon: "warning",
			buttons: true,
			dangerMode: true
			})
		.then((data) => {
    if (data) {
	 $.ajax({
    	type: "POST",
    	url: "<?php  echo Yii::app()->createAbsoluteUrl("request/deletedata"); ?>",
  		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id},
    	dataType: "json",				
		success: function (data) {
			if (data.status=='success') {		
				$("#modaldetail").modal('hide');	
				swal({
					icon: "success",			
					title: "สำเร็จ !",
					text: "ลบข้อมูล สำเร็จแล้ว !"
				});	
			getSearch();
			}
			else{
				alert(data.msg);
			} 
					}
				});
			}
	});
///////////////////////////////////////////////////////////////////////////////////////////////
}
function clearcalendar(){
	$('#txtdoc_date').val('');
}
function clearcalendar1(){
	$('#txtbirth').val('');
}

</script>