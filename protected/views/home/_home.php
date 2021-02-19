    <li style='list-style:none; border-top:1px dotted #999; padding:8px 100px 4px 300px;'>                   
		<label class='labeltext'>
        	เลขหนังสือชุด 
            &nbsp;&nbsp; 
 			<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $data['id']; ?>" id="<?php echo $data['code']; ?>" onClick="getDatagrid(this);"><?php echo $data['code']; ?></a>
            &nbsp;&nbsp; 
            ได้รับข้อมูลกลับมาแล้ว &nbsp;&nbsp;&nbsp; <?php echo $data['cnt']; ?>&nbsp;&nbsp;&nbsp; ธนาคาร</label>
       	</label>
  	</li>
       
   
	<li style='list-style:none; border-top:1px dotted #999; padding:8px 100px 4px 300px;' id="collapse<?php echo $data['id']; ?>" class="panel-collapse collapse" >   
		<div class="panel-body" style="width:67%; margin:0 auto;padding:0px 10px;"> 
        <?php   
		
			$code=$data['code'];
			//$data=lkup_hisimport::getSearch($data['code']);
			$data=lkup_hisimport::getSearch0();
			$this->widget('zii.widgets.grid.CGridView', array(
				'id' => 'list-griddata'.$code,
				'dataProvider' => $data,
				'htmlOptions' => array('width' => '100%'),
				'itemsCssClass' => 'table table-bordered table-striped',	
				'rowHtmlOptionsExpression'=>'array("data-id"=>$data["im_id"])',
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
						'name'=>'code_id',
						'header' => 'รหัส',
						'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
						'headerHtmlOptions'=>array('style'=>'width:50px; text-align:center;vertical-align:middle;'),
					  ),			
					  array(
						'name'=>'name',
						'header' => 'ธนาคาร',
						'htmlOptions'=>array('style'=>'text-align:left;width:;'),
						'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
					  ),
									 
					array(
						'name'=>'cnt1',
						'header' => 'พบ<br/>(ราย)',
						'htmlOptions'=>array('style'=>'text-align:center;width:70px;'),
						'headerHtmlOptions'=>array('style'=>'width:70px; text-align:center;vertical-align:middle;'),
					  ),
					array(
						'name'=>'cnt2',
						'header' => 'ไม่พบ<br/>(ราย)',
						'htmlOptions'=>array('style'=>'text-align:center;width:70px;'),
						'headerHtmlOptions'=>array('style'=>'width:70px; text-align:center;vertical-align:middle;'),
					  ),
					array(
						'name'=>'cnt',
						'header' => 'รวม<br/>(ราย)',
						'htmlOptions'=>array('style'=>'text-align:center;width:70px;'),
						'headerHtmlOptions'=>array('style'=>'width:70px; text-align:center;vertical-align:middle;'),
					  ),
					array(
						//'name'=>'',
						'type' => 'html', 
						'value' => function($data){ 
							if($data['cnt']!=0){
								echo '<button id="btnpaper" type="button" data-idbank="'.$data['code_id'].'" data-id="'.$data['im_id'].'" data-value="'.$data['code'].'"  onclick="setUpdate(this)" class="btn btn-warning"><i class="glyphicon glyphicon-paperclip"></i></button>'; 	
							}
						},
						'header' => 'ไฟล์แนบ',
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'headerHtmlOptions'=>array('style'=>'width:70px;text-align:center;vertical-align:middle;'),
					),
					array(
						//'name'=>'',
						'type' => 'html', 
						'value' => function($data){ 
							if($data['cnt']!=0){
								echo '<button id="btndetail" type="button" data-idbank="'.$data['code_id'].'" id="'.$data['im_id'].'" data-value="'.$data['code'].'"  onclick="setDetail(this)" class="btn btn-success"><i class="glyphicon glyphicon-list-alt"></i></button>'; 	
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
	</li>