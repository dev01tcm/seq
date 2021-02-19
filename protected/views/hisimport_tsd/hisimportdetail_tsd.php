<div>

<?php
		
			foreach ($modelform as $dataitem1)
							{
								$total_qty=$dataitem1['total_qty'];
								$not_fount_qty=$dataitem1['not_fount_qty'];
								$book_closing_qty=$dataitem1['book_closing_qty'];
								$registration_qty=$dataitem1['registration_qty'];
								$request_id=$dataitem1['request_id'];
								$import_datetime=$dataitem1['import_datetime'];
								
							}
								?>
<h3><span class="label label-default">จำนวนรายการตรวจสอบบัญชีหลักทรัพย์ที่นำเข้ามา :: <?php echo $total_qty;?>     รายการ         วันที่นำเข้า  <?php echo $import_datetime; ?></span></h3>
</div>
<div>
<table id="Tabledatauser" class="table table-striped" style="margin-top:20px; width:100%"  >
            <thead style="background-color:#AED6F1;">
              <tr>
                
                <th>ประเภทข้อมูลหลักทรัพย์</th>
				<th>จำนวน</th>
                <th align="center">ผลการตรวจสอบ</th>
              
                
              </tr>
            </thead>
			 <tbody>
			
			<tr>
				
			    <td>ข้อมูลตามหน้าทะเบียน</td>
				<td><?php echo $registration_qty ; ?></td>
				<td><div align="center">
				<?php
							
								echo '<button  id="btnpaper" type="button"  data-value="'.$request_id.'"  onclick="getdetail(this)"  class="btn btn-info"><i class="glyphicon glyphicon-list-alt"></i></button>'; 
							
				?>
				</div></td>
				
								
			</tr>
			<tr>
				
			    <td>ข้อมูลนะวันที่ปิดสมุดทะเบียน</td>
				<td><?php echo $book_closing_qty; ?></td>
				<td><div align="center">
				<?php
							
								echo '<button  id="btnpaper" type="button" data-value="'.$request_id.'"  onclick="getdetail_book(this)" class="btn btn-info"><i class="glyphicon glyphicon-list-alt"></i></button>'; 
							
				?>
				</div></td>
				
								
			</tr>
			<tr>
				
			    <td>ไม่พบข้อมูลหลักทรัพย์</td>
				<td><?php echo $not_fount_qty; ?></td>
				<td><div align="center">
				<?php
							
								echo '<button  id="btnpaper" type="button" data-value="'.$request_id.'"  onclick="getdetail(this)" class="btn btn-info"><i class="glyphicon glyphicon-list-alt"></i></i></button>'; 
							
				?>
				</div></td>
				
								
			</tr>
			 </tbody>
			 <tfoot>
            	<tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    
                   
                </tr>
          	</tfoot>
			

	</table>
</div>	
<script type="text/javascript">
	$(document).ready(function() {
    $('#Tabledatauser1').DataTable();
  }); 
</script>		