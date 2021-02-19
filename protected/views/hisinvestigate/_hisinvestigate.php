    <div class="panel-heading" style="background-color:#BAD3DC; width:96%; height:40px; margin:auto; margin-top:-5px;">
    	<div style="clear:both;"></div>	
        <h4 class="panel-title">
        	<!--div class="f_left" style="width:10%"><?php //echo $num; ?></div-->
        	<!--div class="f_left" style="width:20%;"><a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $data['id']; ?>"><?php echo $data['code']; ?></a></div-->
            <div class="f_left" style="width:20%;"><label id="detail<?php echo $data['id'] ?>" style="cursor:pointer;margin:0 auto;" onClick="setUpdate(<?php echo $data['id'] ?>)"><a><?php echo $data['code'] ?></a></label></div>
        	<!--div class="f_left" style="width:20%;"><?php echo !empty($data['doc_no'])?$data['doc_no']:'-'; ?></div-->
            <?php if($data['doc_no']==''){ ?>
					<div class="f_left" style="width:20%;">-</div>
			<?php }else{ ?>
					<div style="width:20%; float:left; text-align:left;"><?php echo $data['doc_no']; ?></div>
			<?php } ?>
            <div class="f_left" style="width:20%;"><?php echo !empty($data['doc_date'])?$data['doc_date']:'-'; ?></div>
            <div class="f_left" style="width:20%;"><?php echo !empty($data['create_date'])?$data['create_date']:'-'; ?></div>
            <!--div class="f_left" style="width:20%;"><?php echo '<span id="detail'.$data['id'].'" class="detail" style="cursor:pointer;margin:0 auto;" onClick="setUpdate('.$data['id'].')"><a>'.$data['cnt'].'</a></span>'; ?></div-->
           <div class="f_left" style="width:20%;"><a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $data['id']; ?>"><?php echo $data['cnt']; ?></a></div>
         
        </h4>
      </div>   

 
      <div id="collapse<?php echo $data['id']; ?>" class="panel-collapse collapse" style="width:96%; margin:0 auto;padding:0px 10px;background-color:#F8F8F8; ">
        <div class="panel-body" style="width:80%; margin:0 auto;padding:0px 10px;">  

                <?php   
					$keyword = Yii::app()->session['hisinvestigate_keyword'];
					$modelform=lkup_hisinvestigate::searchform($data['id'],$keyword);
					$this->widget('zii.widgets.grid.CGridView', array(
						'id' => 'list-grid'.$data['id'],
						'dataProvider' => $modelform,
						'htmlOptions' => array('width' => '100%'),
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
								'name'=>'acc_employer',
								'header' => 'เลขที่บัญชีนายจ้าง',
								'htmlOptions'=>array('style'=>'text-align:left;width:50px;'),
								'headerHtmlOptions'=>array('style'=>'width:140px; text-align:center;vertical-align:middle;'),
							  ),			
							  array(
								'name'=>'business_name',
								'header' => 'ประเภทธุรกิจ',
								'htmlOptions'=>array('style'=>'text-align:left;width:130px;'),
								'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
							  ),				 
							  array(
								'name'=>'full_name',
								'header' => 'ชื่อ - สกุล',
								'htmlOptions'=>array('style'=>'text-align:left;width:200px;'),
								'headerHtmlOptions'=>array('style'=>'width:200px; text-align:center;vertical-align:middle;'),
							  ),
							  array(
								'name'=>'pid',
								'header' => 'เลขป.ช.ช./<br/>เลขทะเบียนพาณิชย์',
								'htmlOptions'=>array('style'=>'text-align:left;width:150px;'),
								'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
							  ),				 	
							  array(
								'name'=>'address',
								'header' => 'ที่อยู่',
								'htmlOptions'=>array('style'=>'text-align:left;width:400px;'),
								'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
							  ),
							  array(
								'name'=>'birth',
								'header' => 'วันเกิด',
								'htmlOptions'=>array('style'=>'text-align:center; width:100px;'),
								'headerHtmlOptions'=>array('style'=>'width:; text-align:center;vertical-align:middle;'),
							  ),
						),
					));
		
       					
					  
				?>

      </div>
    </div>
    <div style="clear:both;"></div>  