
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
                                'name'=>'log_date',
                                'header' => 'ที่',
                                'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
                                'headerHtmlOptions'=>array('style'=>'text-align:center;vertical-align:middle;width:50px;'),
                              ),                            
                            array(
                                'name'=>'log_type',
                                'header' => 'ชื่อธนาคาร',
                                'htmlOptions'=>array('style'=>'text-align:left;width:200px;'),
                                'headerHtmlOptions'=>array('style'=>'text-align:center;vertical-align:middle;width:150px;'),
                              ),
							  array(
                                'name'=>'userbyupdate',
                                'header' => 'รหัสธนาคาร',
                                'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
                                'headerHtmlOptions'=>array('style'=>'text-align:center;vertical-align:middle;width:50px;'),
                              ),
   
                        ),
                    ));
                    ?>
                      