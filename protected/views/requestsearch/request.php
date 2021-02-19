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
	width:130px;
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
	display:none;
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
    <div class="panel-heading">ค้นหาข้อมูล</div>
    <div class="panel-body sectioncontent">
        <div style="display:block; margin-left:400px;">
            <ul>            	
                <li style="list-style:none;">
                    <label class="txtlabel">ชุดหนังสือ</label>
                    <input type="text" id='txtdoc_code' class="input-default" maxlength="5" style="width:150px;"> 
					<label class="txtlabel" style="margin-left:50px;">ประเภทบัญชี</label>
                    <select class="input-default" id="systype" style="width:150px;margin-left:40px;" >
                        <option value="">--เลือกทั้งหมด--</option>     
                        <option value="1">ธนาคาร</option>   
                        <option value="2">หลักทรัพย์</option>                                                						
                    </select>
               	</li>
                <li style="list-style:none; margin-top:15px">   
                    <label class="txtlabel">บุคคล / นิติบุคคล </label>
                    <select class="input-default" id="drptype" style="width:150px;" >
                        <option value="">--เลือก--</option>     
                        <option value="1">บุคคล</option>   
                        <option value="2">นิติบุคคล</option>                                                						
                    </select>
                    <label class="txtlabel1" style="margin-left:50px;">เลขทะเบียนนายจ้าง</label> 
                    <input type="text" id='txtacc_emp' class="input-default" maxlength="15"  style="width:150px;">                            	
                </li>
                <li style="list-style:none; margin-top:15px">
                    <label class="txtlabel">ชื่อ - นามสกุล</label> 
                    <input type="text" id='txtname' class="input-default" maxlength="15"  style="width:150px;"> 
                    <label class="txtlabel1" style="margin-left:50px;">เลขป.ช.ช / เลขทะเบียนพาณิชย์</label> 
                    <input type="text" id='txtiden' class="input-default" maxlength="13" style="width:150px;">              		
                    
                </li>
                <?php if(Yii::app()->user->getInfo('userlevel_id')=='1') { ?>  
                <li style="list-style:none; margin-top:15px">
                    <label class="txtlabel">หน่วยงาน </label>
                    <select class="input-default js-example-basic-multiple" id="drpdep" style="width:530px;" name="states[]">                            	
                        <option value=''>--เลือก--</option>
                            <?php 								
                            $data=lookupdata::getDepartment();
                            foreach($data as $dataitem) {
                            echo "<option value='".$dataitem['id']."'>".$dataitem['name']." (".$dataitem['code'].")</option>";
                            } 
                            ?>
                    </select>        
                       
                </li>
                <?php } ?>
                <li style="list-style:none;margin-top:15px;">   
                	<label class="txtlabel">สถานะรายการ</label>                  
                   	<input type="checkbox" id="ch1" style="margin-left:5px;" value="1"/><label style="margin-left:5px;">รายการใหม่</label>  
                   	<input type="checkbox" id="ch2" style="margin-left:15px;" value="2"/><label style="margin-left:5px;">รอผล</label> 
                   	<input type="checkbox" id="ch3" style="margin-left:15px;" value="3"/><label style="margin-left:5px;">ข้อมูลไม่สมบูรณ์</label>
                   	<input type="checkbox" id="ch4" style="margin-left:15px;" value="4"/><label style="margin-left:5px;">ตรวจสอบแล้ว</label>
                </li> <li style="list-style:none;clear:both"></li>                
                <li style="list-style:none; float:right;">
                	<span>
                        <button class="btn btn-primary" style="margin-left:10px;" onClick="getSearch()">
                            <i class="glyphicon glyphicon-search"></i>
                            ค้นหา
                    	</button> 
                    </span>
                	
                </li>
                <li style="list-style:none;">
                   	<input id="hdfstatus" type="hidden" />
                   	<input id="hdfid" type="hidden" />
                   	<input id="hdfremark" type="hidden" />
                    <input id="hdftype" type="hidden" />
                    <input id="hdfurl" type="hidden" value="<?php echo Yii::app()->params['prg_ctrl']['url']['baseurl']; ?>"/>
                </li>
            </ul>			
        </div>
    </div>       
</div> 

<div class="panel panel-info">	
  	<div class="panel-body">
        <?php
		
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'list-grid',
            'dataProvider' => $model,
            'htmlOptions' => array('style' => 'margin: auto; width: 100%;'),
            'itemsCssClass' => 'table table-bordered table-striped',			
			'rowHtmlOptionsExpression'=>'array("data-id"=>$data["id"])',
			'summaryText' => "แสดงข้อมูล: {start} - {end} จาก {count} รายการ",			
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
					'name'=>'id',
					'header' => 'ลำดับ',					
					'htmlOptions'=>array('style'=>'text-align:center; width:20px;'),
					'headerHtmlOptions'=>array('style'=>'width:20px; text-align:center;vertical-align:middle;'),
				),	
			
				array(
					'name'=>'code',
					'header' => 'ชุดหนังสือ',					
					'htmlOptions'=>array('style'=>'text-align:center; width:30px;'),
					'headerHtmlOptions'=>array('style'=>'width:30px; text-align:center;vertical-align:middle;'),
				),
				array(
					'name'=>'docno_exp',
					'header' => 'เลขหนังสือ (ส่งออก)',					
					'htmlOptions'=>array('style'=>'text-align:center; width:80px;'),
					'headerHtmlOptions'=>array('style'=>'width:80px; text-align:center;vertical-align:middle;'),
				),
				array(
					'name'=>'docdate_exp',
					'header' => 'วันที่หนังสือ (ส่งออก)',					
					'htmlOptions'=>array('style'=>'text-align:center; width:80px;'),
					'headerHtmlOptions'=>array('style'=>'width:80px; text-align:center;vertical-align:middle;'),
				),				  				  					
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
					'headerHtmlOptions'=>array('style'=>'width:50px; text-align:center;vertical-align:middle;'),
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
					'htmlOptions'=>array('style'=>'text-align:left;width:800px'),
					'headerHtmlOptions'=>array('style'=>'width:800px;text-align:center;vertical-align:middle;'),
				),
				array(
					'name'=>'system_type',
					'header' => 'ประเภทงาน',
					'htmlOptions'=>array('style'=>'text-align:center; width:30px;'),
					'headerHtmlOptions'=>array('style'=>'width:30px; text-align:center;vertical-align:middle;'),
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
					'htmlOptions'=>array('style'=>'text-align:left; width:120px;'),
					'headerHtmlOptions'=>array('style'=>'width:120px; text-align:center;vertical-align:middle;'),
			  	),
			 	array(
					'name'=>'depid_code',
					'header' => 'สังกัด',
					'htmlOptions'=>array('style'=>'text-align:center; width:30px;'),
					'headerHtmlOptions'=>array('style'=>'width:30px; text-align:center;vertical-align:middle;'),
			  	),	
			  	array(
					'name'=>'cnt',
					'header' => 'ตอบกลับจำนวน',
					'htmlOptions'=>array(
						'style'=>'text-align:center; width:80px;'),
						//'class'=>function($data){return $data['status']==2?"abc":"yes";}),
					'headerHtmlOptions'=>array('style'=>'width:80px; text-align:center;vertical-align:middle;'),
			  	),
				array(
					//'name'=>'',
					'type' => 'html', 
					'value' => function($data){ 
						if($data['cnt']!=0){
							
								echo '<button id="btndetail" type="button" data-id="'.$data['id'].'" data-value="'.$data['code'].'"  onclick="getHeaddetail(this)" class="btn btn-success"><i class="glyphicon glyphicon-list-alt"></i></button>';	
							
						}else{
								echo '<button id="btndetail" type="button" data-pid="'.$data['pid'].'" data-value="'.$data['code'].'"  onclick="getHeaddetail_std(this)" class="btn btn-success"><i class="glyphicon glyphicon-list-alt"></i></button>';  	
							}
						
							 	
							
					},
					'header' => 'ผลการตรวจสอบ',
					'htmlOptions'=>array('style'=>'text-align:center;'),
					'headerHtmlOptions'=>array('style'=>'width:90px;text-align:center;vertical-align:middle;'),
				),
            ),
        ));
        ?>
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
            <div class="modal-body" style="margin-top:-10px;">    
              	<div>
                    <div align='left' style='border-bottom:1px solid #ccc;'>
                        <label class="txtlabel">ลำดับที่ :</label>
                        <label class="" id="lbid" style="width:100px;"></label>    
                        <label class="txtlabel">ชุดหนังสือ :</label>
                        <label class="" id="lbcode"></label>
                        <label class="" style="margin-left:100px;">วันที่หนังสือ(ส่งออก) :</label>
                        <label class="" id="lbdate"></label>                       
                    </div>                        
                    <div align='left' style='border-bottom:1px solid #ccc; margin-top:10px;'>
                       <label class="txtlabel">เลขที่บัญชีนายจ้าง :</label>
                       <label class="" id="lbacc_emp" style="width:100px;"></label>
                       <label class="" style="margin-left:50px;">คำนำหน้าชื่อ/ประเภทธุรกิจ :</label>
                       <label class="" id="lbbname"></label>
                       <label class="" style="margin-left:50px;">ชื่อ - สกุล :</label>
                       <label class="" id="lbfullname"></label>
                        <label class="" style="margin-left:100px;">เลขป.ช.ช / เลขทะเบียนพาณิชย์ :</label>
                        <label class="" id="lbpid"></label>
                    </div>                   
            	</div>
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
                                'name'=>'no',
                                'header' => 'ที่',
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
							'name'=>'bank_id',
							'header' => 'รหัสธนาคาร',
							'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
							'headerHtmlOptions'=>array('style'=>'text-align:center;vertical-align:middle;width:50px;'),
						  ),
                            array(
                                'name'=>'bank_dep_id',
                                'header' => 'รหัสสาขา',
                                'htmlOptions'=>array('style'=>'text-align:center;width:80px;'),
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
                                'htmlOptions'=>array('style'=>'text-align:center;width:80px;'),
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
							 
                            array(
                                'name'=>'mark',
                                'header' => 'เครื่องหมายจำนวนเงิน',
                                'htmlOptions'=>array('style'=>'text-align:center;width:100px;'),
                                'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
                              ),	
							 								
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
						   array(
							'name'=>'',
							'header' => 'ไฟล์แนบ',
							'htmlOptions'=>array('style'=>'text-align:left;'),
							'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
						  ),
                        ),
                    ));
                    ?>
                      
            </div>
            <div class="modal-footer" style="padding: 7px 20px">
                <h3 id="errmodaldetail" class="sectionError"></h3>
                <div class="sectionButton"> 
                	<Button id="btpt"class="btn btn-success" data-dismiss="modal" Width="100px;" onClick="gotopagepdf();"><i class="glyphicon glyphicon-print"></i> พิมพ์</Button>                   
                    <Button ID="btcledit"class="btn btn-default" data-dismiss="modal" Width="80px">ย้อนกลับ</Button>
                </div>
       		</div>
        </div>
    </div>
</div>
<!-- รายละเอียด TSD-->

<div id="modalshowTSD" class="modal fade" aria-hidden="true" aria-labelledby="modaldetailLabel" role="dialog" tabindex="-1">
    <div class="modal-dialog" style="width: 90%; margin-top:18px;">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px 20px 7px;">
                <button class="close" data-dismiss="modal" type="button">
                	<span aria-hidden="true">×    <span class="sr-only">Close</span>
                </button>
                <h1 id="modalLabel" class="modal-title">ผลการตรวจสอบบัญชีเงินฝาก</h1>
            </div>            
            <div id="search_tsd">
			</div>
            <div class="modal-footer" style="padding: 7px 20px">
                <h3 id="errmodaldetail" class="sectionError"></h3>
                <div class="sectionButton"> 
                	<Button id="btpt"class="btn btn-success" data-dismiss="modal" Width="100px;" onClick="gotopagepdf();"><i class="glyphicon glyphicon-print"></i> พิมพ์</Button>                   
                    <Button ID="btcledit"class="btn btn-default" data-dismiss="modal" Width="80px">ย้อนกลับ</Button>
                </div>
       		</div>
        </div>
    </div>
</div>    
    
<div id="modalpaper" class="modal fade" aria-hidden="true" aria-labelledby="modaldetailLabel" role="dialog" tabindex="-1">
    <div class="modal-dialog" style="width:850px; margin-top:300px;">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px 20px 7px;">
                <button class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">×    <span class="sr-only">Close</span>
                </button>
                <h1 id="modalpaperLabel" class="modal-title">ดาวน์โหลดไฟล์แนบ</h1>
            </div>
            <div class="modal-body"> 
                <div style="clear:both;height:0px;">
                    <input type="hidden" id="hdfname" />             
                    <input type="hidden" id="hdffiletotal" />
                    <input type="hidden" id="hdfdataid" />
                    <input type="hidden" id="hdfdcntrmv" />               
                </div>
                <ul>                   
                    
                    <li style="list-style:none;height:0px;clear:both;"></li>  
                    <li style="list-style:none; margin-top:10px;">
                        
                        <div id="elementId" style="float:left;width:85%;padding-left:60px;"></div>                        
                        <div style="clear:both;height:0px;"></div>
                                
                                           
                    </li>                  
                </ul> 
            </div>
            
            <div class="modal-footer" style="padding:7px 20px">
                <div>                	   
                    <Button id="btcledit"class="btn btn-default" style="float:right;" data-dismiss="modal" Width="80px">ปิด</Button>
                </div>
                <div class="aa" hidden="hidden">
                    <input type="button" class="btn btn-danger" style="float:left;display:none;" onClick="setDelete();" value="ลบ"/>
                    <input type="button" class="btn btn-success" name="ok" style="float:right; margin-right:10px;" onClick="file_savedata();" value="บันทึก"/>   
                </div>
                <div style="clear:both;height:0px;"></div> 
            </div>
        </div>
    </div> 
</div>
<script type="text/javascript">
jQuery(document).ready(function ($) {
	$('.js-example-basic-multiple').select2();
	
	$('#modaldetail').on('show.bs.modal', function (e) {
				
 	});
	$('#modaldetail').on('hidden.bs.modal', function (e) {       
		
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
	
	var status1,status2,status3,status4,type,name,dep;
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
	type = $("#drptype").val();
	name = $("#txtname").val();
	dep = $("#drpdep").val();
	systype = $("#systype").val();
	
	
	//alert(type);
	var data = {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','keyword': $('#txtdoc_code').val(),'acc_emp': $('#txtacc_emp').val(),'iden': $('#txtiden').val(),'status1':status1,'status2':status2,'status3':status3,'status4':status4,'type':type,'name':name,'dep':dep,'systype':systype}; 
	$.fn.yiiGridView.update('list-grid', {
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("requestsearch/search"); ?>',
		data: data,
	});
} 
function getHeaddetail(elem) {
	var id = $(elem).attr("data-id"); 
	var code = $(elem).attr("data-value"); 
	
	//alert(code);
	
	
	var data = {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>', 'id': id, 'code': code}; 
	$.fn.yiiGridView.update('list-griddetail', {
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("requestresult/searchdetail"); ?>',
		data: data,
	});	
	
	$.ajax({
    	type: "POST",
    	url: "<?php  echo Yii::app()->createAbsoluteUrl("requestresult/Searchhead"); ?>",
  		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id},
    	dataType: "json",				
		success: function (data) {
			if (data.status=='success') {
				$('#lbcode').html(data.code);
				$('#lbdate').html(data.doc_date);
				$('#lbacc_emp').html(data.acc_employer);
				$('#lbid').html(data.id);
				$('#lbbname').html(data.business_name);
				$('#lbfullname').html(data.full_name);
				$('#lbpid').html(data.pid);
				//$("#modalshow").modal('show');			
				//setDetail(id);
				$('#hdfid').val(id);
				$("#modalshow").modal('show');	
			}else{
				alert(data.msg);
			} 
		}
	});	
}
function getHeaddetail_std(elem) {
	var pid = $(elem).attr("data-pid"); 
	var code = $(elem).attr("data-value"); 
	
	
	
	$.ajax({
    	type: "POST",
    	url: "<?php  echo Yii::app()->createAbsoluteUrl("requestsearch/searchdetail_tsd"); ?>",
  		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','pid': pid,'code':code},			
		success: function (data) {
				$("#modalshowTSD").modal('show');	
				$('#search_tsd').html(data);
		}
	});	
}
function gotopagepdf(){
	var id = $('#hdfid').val(); 
		//alert(id);
	var url = $('#hdfurl').val();	
	url = url+"/requestresult/rpt_request?id="+id;
	window.open(url, '_blank');
	
}
function gotopagepdf_tsd(){
	var id = $('#hdfid').val(); 
		//alert(id);
	var url = $('#hdfurl').val();	
	url = url+"/requestresult/rpt_request?id="+id;
	window.open(url, '_blank');
	
}
function setUpdate(el){
	var id = $(el).attr("data-id"); 
	var bank_id = $(el).attr("data-idbank"); 
	var code = $(el).attr("data-value");
	//alert(bank_id);
	
	$('#hdfdataid').val('');
	$('#elementId').html('');
	$('#hdfdcntrmv').val('');
	$('#divrmv').html('');
	$('#divtrnidfile').html('');
	$('#errupload').text('');
	
	//var id = $(el).parent().attr("data-id");
	//alert(id);
	//return;
	index = 0;
 	
	$.ajax({
    	type: "POST",
    	url: "<?php echo Yii::app()->createAbsoluteUrl("hisimport/getDataimport"); ?>",
  		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id,'bank_id':bank_id,'code':code},
    	dataType: "json",				
    	success: function (data) {
			if (data.status=='success') {
				$('#txtno').val(data.id_impt);
				$('#txtcode').val(data.code);
				$('#txtdoc_no').val(data.doc_no);
				$('#txtdoc_date').val(data.doc_date);
				$('#hdffiletotal').val(data.cntfile);
				//$('#modalpaper').modal('show');
	//return;
				if(data.cntfile != 0){
					var i = 0;
					while(i<data.cntfile){
						if(i<(data.cntfile))
						addpaperclip2();
						var fileid = '#hdffileid'+(i+1);
						var filename = '#name_file'+(i+1);
						var filesize = '#hdffilesize'+(i+1);
						var filetype = '#hdffiletype'+(i+1);
						var fileurl = '#link'+(i+1);
						
						$('#divtrnidfile').append("<input type='hidden' id='trnid"+(i+1)+"' value='"+data.trn_id[i]+"' />");
						$(fileid).val(data.trn_id[i]);
						$(filename).text(data.namefile[i]);
						$(filesize).val(data.sizefile[i]);
						$(filetype).val(data.typefile[i]);
						$(fileurl).attr('href',data.urlfile[i]+'/'+data.namefile[i]);
						$(fileurl).attr('download',data.namefile[i]);
						$(fileurl).removeClass('link_empty');
						i++;
					}	
				}
			
				$('#modalpaper').modal('show');
			
			}else{
				
			} 
		}
	});
}
function addpaperclip2()
{
	var i = 0;
	var count = $('#hdfdataid').val();	
	if(count==''){
		count=0;
	}

	i = Number(count)+1;
	//alert(i);
	$('#elementId').append("<div data-ids='"+ i +"' class='paperclipupload"+ i +"'><input id='paperclip"+ i +"' type='file' accept='.pdf, .png, .jpg, .jpeg'  name='files[]' style='display:none;'><div class='uploaderProgress input-default upload"+ i +"' style='width:645px;border-radius: 6px 6px 6px 6px;'><span data-id='"+ i +"' title='ดาวน์โหลด' id='dwnload"+i+"' style='cursor: pointer;margin-right: 20px;'><a id='link"+i+"' target='_blank' class='link_empty'><i class='glyphicon glyphicon-download'></i></a></span><span id='name_file"+ i +"'></span></div><input type='hidden' id='hdffileid"+ i +"'><input type='hidden' id='hdffilename"+ i +"'><input type='hidden' id='hdffilesize"+ i +"'><input type='hidden' id='hdffiletype"+ i +"'></div>");
	
	$('#hdfdataid').val(i);
	
}
</script>