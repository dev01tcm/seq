
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
								//'name'=>'',
								'type' => 'html', 
								'value' => function($modeldetail){ 
									if($modeldetail['name']!=null){
										echo '<button id="btnpaper" type="button" data-idbank="'.$modeldetail['bank_id'].'" data-id="'.$modeldetail['id'].'" data-value="'.$modeldetail['code'].'"  onclick="setUpdate(this)" class="btn btn-warning"><i class="glyphicon glyphicon-paperclip"></i></button>'; 	
									}
								},
								'header' => 'ไฟล์แนบ',
								'htmlOptions'=>array('style'=>'text-align:center;'),
								'headerHtmlOptions'=>array('style'=>'width:70px;text-align:center;vertical-align:middle;'),
							),
                        ),
                    ));
                    ?>
                      