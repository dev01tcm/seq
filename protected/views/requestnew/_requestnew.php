<div class="mainList1" style="background-color:#BAD3DC;">
    <div class="mainList1" style="width:210px;min-height:50px;">
        
        
	<?php
         
        if ($index > 0 && $widget->dataProvider->data[$index-1]['doc_no'] == $data['doc_no']):
            echo '<span style="width:106px;text-align:center;height:100%;background-color:#BAD3DC;"></span>'; 
        else:
            echo '<span style="width:106px;text-align:center;height:100%;background-color:#D7E5EB; border-right:1px solid #BAD3DC;"><b><p class="txtlistspan"><a id="'.$data['doc_no'].'" style="cursor:pointer;" title="เพิ่มข้อมูล" onClick="setInsert(this.id)">'.$data['doc_no'].'</a></p></b></span>';
        endif; 

        if ($index > 0 && $widget->dataProvider->data[$index-1]['doc_date'] == $data['doc_date']):
            echo '<span style="width:105px;text-align:center;height:100%;background-color:#BAD3DC;"></span>'; 
        else:
            echo '<span style="width:105px;text-align:center;height:100%;background-color:#D7E5EB;border-right:1px solid #BAD3DC;"><b><p class="txtlistspan">'.$data['doc_date'].'</p></b></span>';
        endif; 
    ?>          
         
         
    </div>

    <div class="mainList1" style="background-color:#D7E5EB;width:1020px;min-height:50px;">
            <span id="state_active" style="width:38px;text-align:center;height:100%;border-right:1px solid #BAD3DC;">
                <?php
                    $active = $data['active'];
                    $ret = "";
                    if($active==1){
                        $ret.= "<img class='txtlistspan' src='".Yii::app()->params['prg_ctrl']['url']['baseurl']."/images/icon/plus.png' style='width:16px;' />";
                    }else if($active==2){
                        $ret.= "<img class='txtlistspan' src='".Yii::app()->params['prg_ctrl']['url']['baseurl']."/images/icon/warning.png' style='width:16px;' />";
                    }else if($active==3){
                        $ret.= "<img class='txtlistspan' src='".Yii::app()->params['prg_ctrl']['url']['baseurl']."/images/icon/bleach2.gif' style='width:20px;' />";
                    }else if($active==4){
                        $ret.= "<img class='txtlistspan' src='".Yii::app()->params['prg_ctrl']['url']['baseurl']."/images/icon/check.png' style='width:16px;' />";
                    }else{
                        $ret.="";
                    }
                    echo $ret;			
                ?>            
            </span>        
			<span style="width:121px;text-align:center;height:100%;border-right:1px solid #BAD3DC;">
            	<p class="txtlistspan"><?php echo $data['acc_employer']; ?></p>
            </span>
            <span style="width:122px;text-align:center;height:100%;border-right:1px solid #BAD3DC;"><p class="txtlistspan"><?php echo $data['business_name']; ?></p></span>
            <span style="width:182px;text-align:left;height:100%;padding-left:10px;border-right:1px solid #BAD3DC;"><p class="txtlistspan"><?php echo $data['full_name']; ?></p></span>
            <span style="width:182px;text-align:center;height:100%;border-right:1px solid #BAD3DC;"><p class="txtlistspan"><?php echo $data['pcid']; ?></p></span>
            <span style="width:122px;text-align:center;height:100%;border-right:1px solid #BAD3DC;">
				<p class="txtlistspan"><?php  echo !empty($data['birth'])?$data['birth']:'-';?></p>
            </span>
            <span style="width:211px;text-align:left;height:100%;padding-left:10px;border-right:1px solid #BAD3DC;"><p class="txtlistspan"><?php echo $data['address']; ?></p>
            </span>
            <span style="width:30px;text-align:center;height:100%;cursor:pointer;padding-top:15px;" title='แก้ไข'>
            	<a id="edit<?php echo $data['id']; ?>" onClick="setUpdate(<?php echo $data['id']; ?>)" ><i class='glyphicon glyphicon-pencil'></i></a>
            </span>
            
                 
    </div><div style="clear:both; height:0px;"></div>	
</div>
