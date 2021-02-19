<div class="panel-body">
        	<?php		
                        $this->widget('zii.widgets.grid.CGridView', array(
                        'id' => 'list-grid',
                        'dataProvider' => $modelform,
                        'htmlOptions' => array('width' => '500px'),
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
                                    'name'=>'acc_employer',
                                    'header' => 'เลขนายจ้าง',
                                    'htmlOptions'=>array('style'=>'text-align:left;width:50px;'),
                                    'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
                                ),			
                                array(
                                    'name'=>'business_name',
                                    'header' => 'ประเภทธุรกิจ',
                                    'htmlOptions'=>array('style'=>'text-align:left;width:130px;'),
                                    'headerHtmlOptions'=>array('style'=>'width:130px; text-align:center;vertical-align:middle;'),
                                  ),					 
                                array(
                                    'name'=>'full_name',
                                    'header' => 'ชื่อ - สกุล',
                                    'htmlOptions'=>array('style'=>'text-align:left;width:150px;'),
                                    'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
                                ),
                                array(
                                    'name'=>'pid',
                                    'header' => 'เลขป.ช.ช./เลขทะเบียนพาณิชย์',
                                    'htmlOptions'=>array('style'=>'text-align:left;width:120px;'),
                                    'headerHtmlOptions'=>array('style'=>'width:120px; text-align:center;vertical-align:middle;'),
                                ),			
                                array(
                                    'name'=>'bank_dep_id',
                                    'header' => 'รหัสสาขา',
                                    'htmlOptions'=>array('style'=>'text-align:center;width:90px;'),
                                    'headerHtmlOptions'=>array('style'=>' text-align:center;vertical-align:middle;width:90px;'),
                                ),	
                                array(
                                    'name'=>'check_status',
                                    'header' => 'สถานะ',
                                    'htmlOptions'=>array('style'=>'text-align:center;vertical-align:middle; width:20px;'),
                                    'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;width:20px;'),
                                ),		
                                array(
                                    'name'=>'bank_dep_name',
                                    'header' => 'ชื่อสาขา',
                                    'htmlOptions'=>array('style'=>'text-align:left; width:150px;'),
                                    'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;width:150px;'),
                                ),			
                                array(
                                    'name'=>'acc_type_id',
                                    'header' => 'ประเภทบัญชี',
                                    'htmlOptions'=>array('style'=>'text-align:center; width:50px;'),
                                    'headerHtmlOptions'=>array('style'=>'width:50px; text-align:center;vertical-align:middle;'),
                                ),
                                array(
                                    'name'=>'acc_no',
                                    'header' => 'เลขที่บัญชี',
                                    'htmlOptions'=>array('style'=>'text-align:center; width:50px;'),
                                    'headerHtmlOptions'=>array('style'=>'width:50px; text-align:center;vertical-align:middle;'),
                                ),				
                                array(
                                    'name'=>'acc_name',
                                    'header' => 'ชื่อบัญชี',
                                    'htmlOptions'=>array('style'=>'text-align:left; width:150px;'),
                                    'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;width:150px;'),
                                ),						  	
                                array(
                                    'name'=>'mark',
                                    'header' => 'เครื่องหมายจำนวนเงิน',
                                    'htmlOptions'=>array('style'=>'text-align:center; width:100px;'),
                                    'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;width:100px;'),
                                ),		
                                array(
                                    'name'=>'amont',
                                    'header' => 'จำนวนเงิน',
                                    'htmlOptions'=>array('style'=>'text-align:right;width:120px;'),
                                    'headerHtmlOptions'=>array('style'=>'width:120px; text-align:center;vertical-align:middle;'),
                                ),			
                                array(
                                    'name'=>'request_date',
                                    'header' => 'วันเวลาที่ตรวจ',
                                    'htmlOptions'=>array('style'=>'text-align:center; width:50px;'),
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
			