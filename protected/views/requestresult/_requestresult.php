<div class="panel-heading" style="background-color:#BAD3DC; width:100%; height:40px; margin:auto; margin-top:-5px;">
	<div style="clear:both; height:0px;"></div>
	<div>
    	<label style="width:50px;float:left; text-align:center;">
			<?php 
				if ($index > 0 && $widget->dataProvider->data[$index-1]['code'] == $data['code']): 			
			?>
            <?php 
				else:echo $data['code'];
           	?>
         	<?php endif; ?>  
    	</label>
        <label style="width:90px;float:left; text-align:center;">
			<?php
				if (($index > 0 && $widget->dataProvider->data[$index-1]['docno_exp'] == $data['docno_exp']) && ($index > 0 && $widget->dataProvider->data[$index-1]['code'] == $data['code'])):
			?>
				
			<?php 
				else:echo $data['docno_exp'];
			?>
         	<?php endif; ?>  
    	</label>
        <label style="width:90px;float:left; text-align:center;">
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
    	<span style="width:90px;display:block;float:left;"><?php echo $data['doc_no']; ?></span>
        <span style="width:80px;display:block;float:left; text-align:center;"><?php echo $data['doc_date']; ?></span> 	
    	<span style="width:100px;display:block;float:left;"><?php echo $data['acc_employer']; ?></span>
        <span style="width:100px;display:block;float:left;"><?php echo $data['business_name']; ?></span>
        <span style="width:100px;display:block;float:left;"><?php echo $data['full_name']; ?></span>
        <span style="width:120px;display:block;float:left;"><?php echo $data['pid']; ?></span>
        <span style="width:100px;display:block;float:left; text-align:center;"><?php  echo !empty($data['birth'])?$data['birth']:'-';?></span>
        <span style="width:380px;display:block;float:left;"><?php echo $data['address']; ?></span>
        <span style="width:80px;display:block;float:left;"><?php echo $data['create_date']; ?></span>
        <span style="width:80px;display:block;float:left;"><?php echo $data['firstname']; ?></span>
        <span style="width:80px;display:block;float:left; text-align:center;""><?php echo $data['depid_code']; ?></span>
        <span style="width:50px;display:block;float:left; text-align:center;""><?php echo $data['cnt']; ?></span>
        <span style="width:50px;display:block;float:left; text-align:center;""><i class="glyphicon glyphicon-list-alt"></i></span>
	</div>
</div>