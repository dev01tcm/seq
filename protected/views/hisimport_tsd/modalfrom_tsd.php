 <?php
											foreach ($detail_tsd as $dataitem1)
											{
												 $codedetail=$dataitem1['code'];
												 $doc_nodetail=$dataitem1['doc_no'];
												 $import_datetimedetail=$dataitem1['import_datetime'];
												 $doc_datedetail=$dataitem1['doc_date'];
												 
											}
											?>
 
 <div class="modal-body" style="margin-top:-10px;">
                    <div>                    	
                        <div align='left' style='border-bottom:1px solid #ccc;'>
                            <label style="width:150px;">เลขชุดหนังสือ :  <?php echo $codedetail ?></label>
                            <label id='spcode' style="width:20px;"></label>
                            <label style='width:180px;'>เลขหนังสือ :   <?php echo $doc_nodetail ?></label>
                            <label id='spdoc_no' style="width:80;"></label>		
                            <label style="margin-top:5px;width:180px;">วันที่หนังสือ :   <?php echo $doc_datedetail ?></label>
                            <label id='spdoc_date' style="width:40;"></label>
                            <label style='width:250px;'>วันเวลาที่นำเข้า :   <?php echo $import_datetimedetail ?></label>
                            <label id='spcreate_date' style="width:120px;"></label>						
                        </div>                        
                    </div>
					<div class="panel-body">

						<table id="Tabledetail_tsd" class="table table-striped" style="margin-top:20px; width:100%"  >
									<thead style="background-color:#AED6F1;">
									  <tr>
										
										<th>เลขทะเบียนนายจ้าง</th>
										<th>ประเภทธุรกิจ
										<th>ชื่อ-นามสกุล</th>
										<th>เลขบัตรประชาชน/เลขทะเบียนพานิชย์</th>
										<th>รหัสหน่วยงาน</th>
										<th>ชื่อหน่วยงาน</th>
										<th>รายชื่อหลักทรัพย์</th>
										<th>เลขทะเบียนผู็ถือหุ้น</th>
										<th>เลขใบผู้ถือหุ้น</th>
										<th>จำนวนเงิน</th>
										<th>วันที่ตรวจสอบ</th>
										<th>หมายเหตุ</th>
									  </tr>
									</thead>
									 <tbody>
									<?php
											foreach ($modelform as $dataitem)
											{
											?>
									<tr>
										<td><?php echo $dataitem ['acc_employer'] ; ?></td>
										<td><?php echo $dataitem ['business_name'] ; ?></td>
										<td><?php echo $dataitem ['full_name'] ; ?></td>
										<td><?php echo $dataitem ['cid'] ; ?></td>
										<td><?php echo $dataitem ['code'] ; ?></td>
										<td><?php echo $dataitem ['name_depart'] ; ?></td>
										<td><?php echo $dataitem ['securities_namethai'] ; ?></td>
										<td><?php echo $dataitem ['account_id'] ; ?></td>	
										<td><?php echo $dataitem ['certificate_no'] ; ?></td>
										<td><?php echo $dataitem ['securities_shares'] ; ?></td>
										<td><?php echo $dataitem ['effective_date'] ; ?></td>
										<td><?php echo $dataitem ['effective_date'] ; ?></td>
										
										
										
														
									</tr>
									<?php
											}
									?>
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
											<th></th>
											<th></th>
										   
										</tr>
									</tfoot> 
						</table>
					</div>
					
</div>



            
<script type="text/javascript">
	$(document).ready(function() {
    $('#Tabledetail_tsd').DataTable();
  }); 
</script>				