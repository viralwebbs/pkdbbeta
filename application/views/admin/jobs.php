<?PHP  // echo "<pre>" ; print_r($alljobs);  echo "<pre>" ; ?>
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		
				<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box grey-cascade">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-globe"></i>All Jobs
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="javascript:;" class="reload">
								</a>
								<a href="javascript:;" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
								
							</div>
							<table class="table table-striped table-bordered table-hover" id="sample_1">
							<thead>
							<tr>
								
								<th>Company</th>
								<th>Job Title</th>
                                <th>Job Type</th>
                                <th>Department</th>
                                <th>Job No</th>
                                <th>Job Date</th>
                                <th>Date Started</th>
                                <th>Date Finished</th>
                                <th>Deadline</th>
                                <th>Status</th>
                                <th>Assigned To</th>
                                <th>Assigned Date</th>
							</tr>
							</thead>
							<tbody>
                            <?PHP if(isset($alljobs) && is_array($alljobs) ){
									foreach($alljobs as $job){
										$blink=$job['blink'];
										 if($blink == '1'){
											?>  <tr class="odd gradeX" style="background-color: rgba(235, 130, 0, 0.9);"> <?PHP  //// Admin Comment or Employee Comment
										} elseif($blink == '2'){
											?>  <tr class="odd gradeX" style="background-color:#99CC99"> <?PHP  /////
										} elseif($blink == '3'){
											?>  <tr class="odd gradeX" style="background-color:#33FFCC"> <?PHP  //// Client Comment
										} else{
											?>  <tr class="odd gradeX"> <?PHP
										}
							 ?> 
							
								<?PHP  $company = $this->functions->get_result_by_id("client","company_name","id",$job['client_id']); ?>
								<td  class="center"><a href="#"> <?PHP  foreach($company as $company_name){ 
										$company_name = $company_name['company_name']; } 
										echo (isset($company_name)) ? $company_name : '--'; ?>  </a></td>
								<td  class="center"><a href="<?PHP echo base_url("/admin/jobs/detail/"); echo $job['id']; echo "/"; echo $job['client_id']; ?>"> <?PHP echo $job['job_title']; ?>  </a></td>
								<?PHP  $job_type = $this->functions->get_result_by_id("job_type","title","id",$job['job_type']); ?>
								<td align="center" class="center"><?PHP  foreach($job_type as $title){ echo $title['title']; } ?></td>
                                <?PHP  if($job['viral_dept'] !=''){
											$deptartment = $this->functions->get_result_by_id("department","name","dep_id",$job['viral_dept']);
											foreach($deptartment as $rowdept_name){ 
												$dept_name = $rowdept_name['name'];
											 } 
										}
								 ?>
								<td align="center" class="center"><?PHP echo isset($dept_name)   ? ($dept_name) :('NIL') ; ?></td>
                                <td align="center" class="center">
                                <a href="<?PHP echo base_url("/admin/jobs/detail/"); echo $job['id']; echo "/"; echo $job['client_id']; ?>" target="_blank"><?PHP echo $job['id']; ?></a>
                                </td>
                                 
                               <td  class="center"><?PHP echo $job['job_date']; ?></td>
                               <td  class="center"><?PHP echo $job['date_started']; ?></td>
                                <td  class="center"><?PHP echo $job['date_finished']; ?></td>
                               <td  class="center"><?PHP echo $job['client_deadline']; ?></td>
                               <?PHP  if($job['job_status'] !=''){
											$status = $this->functions->get_result_by_id("job_status","status","status_id",$job['job_status']);
											foreach($status as $rowstatus){
												$job_status = $rowstatus['status'];
											
												if($job['job_status'] == '1'){
														 ?><td class="center"><span class="label label-sm label-success"><?PHP echo  $job_status ; ?> </span></td> <?php
												} elseif( $job['job_status'] == '2'){
														 ?><td class="center"><span class="label label-sm label-info"><?PHP echo  $job_status ; ?> </span></td><?PHP
												} elseif( $job['job_status'] == '3'){
														 ?><td class="center"><span class="label label-sm label-primary"><?PHP echo  $job_status ; ?> </span></td> <?PHP
												} elseif( $job['job_status'] == '4'){
														 ?><td class="center"><span class="label label-sm label-danger"><?PHP echo  $job_status ; ?> </span></td> <?PHP
												} elseif( $job['job_status'] == '5'){
														 ?><td class="center"><span class="label label-sm label-warning"><?PHP echo  $job_status ; ?> </span></td> <?PHP
												} elseif( $job['job_status'] == '6'){
														 ?><td class="center"><span class="label label-sm label-default"><?PHP echo  $job_status ; ?> </span></td> <?PHP
												}  elseif( $job['job_status'] == '7'){
														 ?><td class="center"><span class="label label-sm label-default"><?PHP echo  $job_status ; ?> </span></td> <?PHP
												} elseif( $job['job_status'] == '8'){
														 ?><td class="center"><span class="label label-sm label-default"><?PHP echo  $job_status ; ?> </span></td> <?PHP
												} elseif( $job['job_status'] == '9'){
														 ?><td class="center"><span class="label label-sm label-default"><?PHP echo  $job_status ; ?> </span></td> <?PHP
												} else{
														?><td class="center">--</td> <?PHP
												}
											}
							   		}
							   ?>
                           
                             	<?PHP 	$date=date('Y-m-d');
										$job_id =$job['id'];
								$where = "`job_id`  = '$job_id'  AND `phase_start_date` >= '$date' ";
								 $assigned_date = $this->functions->get_result_by_id("timeplan","phase_start_date,emp_id", $where ); ?>
                             	<?PHP if(isset($assigned_date) && !empty($assigned_date)){
									foreach($assigned_date as $date_assigned){
										   $today_assigned = $date_assigned['phase_start_date'];
										   $emp_id = $date_assigned['emp_id']; 
									
								  
									$employee_detail = $this->functions->get_result_by_id("employee","Name", "emp_id", $emp_id);
								 
								   ?>
								   <td  class="center"><?PHP foreach($employee_detail as $employee_data){ $employee_name = $employee_data['Name'];
											echo (isset($employee_name)) ? $employee_name : '--'; }  ?></td>
								   
									<td   class="center"><?PHP  echo (isset($today_assigned) )? $today_assigned  : '--';  ?></td>
								   <?PHP }   /// end of foreach outer
							   	}  else {
								   		?>  <td align="center" class="center">--</td>  
										  <td align="center" class="center">--</td>  <?PHP
								} ?>
							</tr>
							<?PHP	} } else {  ?> <td align="center" class="center">No Record Found</td>  <?PHP }  ?>
							
							
							
							
							
							
							
							
							
							</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->

