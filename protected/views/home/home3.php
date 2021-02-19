<div>
<h3><span class="label label-default">จำนวนธนาคารที่นำเข้ามา :: <?php echo Yii::app()->session['coutbank'] ?></span></h3>
</div>
<div>
<table id="Tabledatauser" class="table table-striped" style="margin-top:20px; width:100%"  >
            <thead style="background-color:#AED6F1;">
              <tr>
                <th style="width:2%;">รหัส</th>
                <th>ธนาคาร</th>
				<th>วันที่นำเข้า</th>
                <th>พบ</th>
                <th>ไม่พบ</th>
                <th>รวม</th>
                <th>ไฟล์แนบ</th>
                <th>ผลการตรวจสอบ</th>
                <th>ลบข้อมูลนำเข้า</th>
              </tr>
            </thead>
			 <tbody>
			<?php
		
			foreach ($data as $dataitem1)
							{
				//	echo $dataitem1["cnt1"];
//exit;					
								?>
			<tr>
				<td><?php echo $dataitem1["code_id"]; ?></td>
			    <td><?php echo $dataitem1["name"]; ?></td>
				<td><?php echo $dataitem1["create_date"]; ?></td>
			    <td><?php echo $dataitem1["cnt1"]; ?></td>
			    <td><?php echo $dataitem1["cnt2"]; ?></td>
				<td><?php echo $dataitem1["cntsum"]; ?></td>
				<td><div align="center">
				<?php
							if($dataitem1['cntsum']!=0){
								echo '<button id="btnpaper" type="button" data-idbank="'.$dataitem1['code_id'].'" data-id="'.$dataitem1['im_id'].'" data-value="'.$dataitem1['CODE'].'"  onclick="setUpdate(this)" class="btn btn-warning"><i class="glyphicon glyphicon-paperclip"></i></button>'; 	
							}else
							{
								echo '<button  id="btnpaper" type="button" disabled  class="btn btn-warning"><i class="glyphicon glyphicon-paperclip"></i></button>'; 
							}
				?>
				</div></td>
				<td><div align="center">
				<?php
							if($dataitem1['cntsum']!=0){
								echo '<button id="btndetail" type="button" data-idbank="'.$dataitem1['code_id'].'" id="'.$dataitem1['im_id'].'" data-value="'.$dataitem1['CODE'].'"  onclick="setDetail(this)" class="btn btn-success"><i class="glyphicon glyphicon-list-alt"></i></button>'; 	
							}else
							{
								echo '<button id="btndetail" type="button" disabled class="btn btn-success"><i class="glyphicon glyphicon-list-alt"></i></button>'; 
							}
				?>
				</div></td>
				<td><div align="center">
				<?php
							
									if($dataitem1['cntsum']!=0){
										echo '<button id="btnpaper" type="button" data-idbank="'.$dataitem1['code_id'].'" data-value="'.$dataitem1['CODE'].'"  onclick="deleteimport(this)" class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i></button>'; 	
									}else{
									echo '<button id="btnpaper" type="button" disabled class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i></button>'; 
									}									
				?>
				</div></td>					
			</tr>
			 </tbody>
			 <tfoot>
            	<tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                   
                </tr>
          	</tfoot>
			<?php
							}
			?>
</div>
	</table>
		<script type="text/javascript">
		$(document).ready(function() {
   
   
    $('#Tabledatauser1').DataTable();

	    }); 
		</script>		