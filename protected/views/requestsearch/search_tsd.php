<div class="modal-body" style="margin-top:-10px;">    
              	<div>
                    <div align='left' style='border-bottom:1px solid #ccc;'>
                        <label class="txtlabel">ลำดับที่ :</label>
                        <label class="" id="lbid" style="width:100px;"></label>    
                        <label class="txtlabel">ชุดหนังสือ :</label>
                        <label class="" id="lbcode"></label>
                        <label class="" style="margin-left:100px;">วันที่หนังสือ(ส่งออก) :</label>
                        <label class="" id="lbdate"></label>                       
                    </div>                        
                    <div align='left' style='border-bottom:1px solid #ccc; margin-top:10px;'>
                       <label class="txtlabel">เลขที่บัญชีนายจ้าง :</label>
                       <label class="" id="lbacc_emp" style="width:100px;"></label>
                       <label class="" style="margin-left:50px;">คำนำหน้าชื่อ/ประเภทธุรกิจ :</label>
                       <label class="" id="lbbname"></label>
                       <label class="" style="margin-left:50px;">ชื่อ - สกุล :</label>
                       <label class="" id="lbfullname"></label>
                        <label class="" style="margin-left:100px;">เลขป.ช.ช / เลขทะเบียนพาณิชย์ :</label>
                        <label class="" id="lbpid"></label>
                    </div>                   
            	</div>
				<div>
				 <label class="txtlabel">แบบมีเลขทะเบียนหลักทรัพย์</label>
				</div>
					<div>
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
											foreach ($model as $dataitem)
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
											<th></th>
											<th></th>
										   
										</tr>
									</tfoot> 
						</table>
					</div>
					<div>
						<label class="txtlabel">แบบไม่มีเลขทะเบียนหลักทรัพย์</label>
					</div>
					<div>
						<table id="Tabledetail_tsd_book" class="table table-striped" style="margin-top:20px; width:100%"  >
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
											foreach ($model2 as $dataitem)
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
    $('#Tabledetail_tsd_book').DataTable();
  }); 
</script>	