<div class="h_txt" style="background-color:#BAD3DC; height:40px; margin-top:-5px;">
	<div style="clear:both; height:0px;"></div>
	<div>
    	<label style="width:80px;text-align:center;float:left;border-right:1px solid #999;">
			<?php 
				if ($index > 0 && $widget->dataProvider->data[$index-1]['code'] == $data['code']): 			
			?>
            <?php 
				else:echo $data['code'];
           	?>
         	<?php endif; ?>  
    	</label>
        <label style="width:100px;text-align:center;float:left;border-right:1px solid #999;">
			<?php
				if (($index > 0 && $widget->dataProvider->data[$index-1]['doc_no'] == $data['doc_no']) && ($index > 0 && $widget->dataProvider->data[$index-1]['code'] == $data['code'])):
			?>
				
			<?php 
				else:echo $data['doc_no'];
			?>
         	<?php endif; ?>  
    	</label>
        <label style="width:100px;float:left;margin-left:5px;">
			<?php
				if (($index > 0 && $widget->dataProvider->data[$index-1]['doc_no'] == $data['doc_no']) && ($index > 0 && $widget->dataProvider->data[$index-1]['code'] == $data['code'])):
			?>
			<?php 
				else:echo $data['doc_date'];
			?>
         	<?php endif; ?>  
    	</label>
    </div>
	<div>    	
    	<span style="width:100px;display:block;float:left;"><?php echo $data['acc_employer']; ?></span>
        <span style="width:180px;display:block;float:left; margin-left:5px;"><?php echo $data['business_name']; ?></span>
        <span style="width:200px;display:block;float:left; margin-left:5px;"><?php echo $data['full_name']; ?></span>
        <span style="width:120px;display:block;float:left; margin-left:5px;"><?php echo $data['pid']; ?></span>
        <span style="width:100px;display:block;float:left; margin-left:5px;"><?php  echo !empty($data['birth'])?$data['birth']:'-';?></span>
        <span style="width:380px;display:block;float:left; margin-left:5px;"><?php echo $data['address']; ?></span>
        <span style="width:80px;display:block;float:left; margin-left:5px;"><?php echo $data['create_date']; ?></span>
        <span style="width:80px;display:block;float:left; margin-left:5px;"><?php echo $data['firstname']; ?></span>
        <span style="width:80px;display:block;float:left; margin-left:5px;"><?php echo $data['depid_code']; ?></span>
	</div>
</div>