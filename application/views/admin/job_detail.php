<style>
.m-l-10{
	margin-left:20px;
}

.td-width{
	width:35% !important;
}
.td-td-width{
	width:60% !important;
}
.overflowy {
	height:200px;
	overflow-y:auto
}

</style>


<?PHP  //echo "<pre>"; print_r($job_detail); echo "</pre>"; ?>
<?PHP  //echo "<pre>"; print_r($viral_uploaded_file); echo "</pre>"; ?>
<?PHP // echo "<pre>"; print_r($client_uploaded_file); echo "</pre>"; ?>
<?PHP  //echo "<pre>"; print_r($task_history); echo "</pre>"; ?>
<!-- BEGIN CONTAINER -->
<div class="container-fluid">
	
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
			
			<!-- BEGIN PAGE CONTENT-->
			
			<div class="row">
				
				<div class="col-md-10 col-lg-12 col-sm-12 col-xs-12">
                	<?PHP 
						///job Error
						if($this->session->flashdata('Success')){
							$msg = $this->session->flashdata('Success');
							 echo "<div class='alert alert-success alert-dismissible' style='font-size:20px;font-weight:bolder'>
								   <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								   <strong>Success !</strong>&nbsp;&nbsp;".$msg['success']."</div>";
								 $this->session->unset_flashdata['Success'];
								   
						}                    
						if($this->session->flashdata('Error')){
							$msg = $this->session->flashdata('Error');
							 echo "<div class='alert alert-danger alert-dismissible' style='font-size:20px;font-weight:bolder'>
								   <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								   <strong>OOPS !</strong>&nbsp;&nbsp;".$msg['err']."</div>";
								   $this->session->unset_flashdata['Error'];
								   
						}  
						
						////Email error
						if($this->session->flashdata('Email')){
							$msg = $this->session->flashdata('Email');
							 echo "<div class='alert alert-success alert-dismissible' style='font-size:20px;font-weight:bolder'>
								   <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								   <strong>Success !</strong>&nbsp;&nbsp;".$msg['emailsuccess']."</div>";
							 	$this->session->unset_flashdata['Email'];
								   
						}  
						if($this->session->flashdata('Emailerr')){
							$msg = $this->session->flashdata('Emailerr');
							 echo "<div class='alert alert-danger alert-dismissible' style='font-size:20px;font-weight:bolder'>
								   <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								   <strong>OOPS !</strong>&nbsp;&nbsp;".$msg['emailerror']."</div>";
								   $this->session->unset_flashdata['Emailerr'];
								   
						}  
						//// FIle Error
						if($this->session->flashdata('File')){
							$msg = $this->session->flashdata('File');
							 echo "<div class='alert alert-success alert-dismissible' style='font-size:20px;font-weight:bolder'>
								   <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								   <strong>Success !</strong>&nbsp;&nbsp;".$msg['filesuccess']."</div>";
							 	$this->session->unset_flashdata['File'];
								   
						}  
						if($this->session->flashdata('Fileerr')){
							$msg = $this->session->flashdata('Fileerr');
							 echo "<div class='alert alert-danger alert-dismissible' style='font-size:20px;font-weight:bolder'>
								   <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								   <strong>OOPS !</strong>&nbsp;&nbsp;".$msg['fileerror'] ."</div>";
								   $this->session->unset_flashdata['Fileerr'];
								   
						}  
					?>
                    	<!--Delete Msg-->
                   		 <div id="delete"></div>
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box red">
                    
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-comments"></i>Job Details
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
							<div class="table-scrollable">
                            <table class="table table-bordered table-hover">
                            <?PHP if( isset($job_detail) && is_array($job_detail) && !empty($job_detail) ){ ?>
								
								
								<?PHP foreach($job_detail as $rowjob){
										$job_id =$rowjob['jobid'];
										$client_id =$rowjob['cid'];	
								  ?>
									
							
								<tr>
									<th class="active">Job Status</th>
                                    <td class="td-width">
									<?PHP 
											if($rowjob['job_status'] !=''){
												$status = $this->functions->get_result_by_id("job_status","status","status_id",$rowjob['job_status']);
												foreach($status as $rowstatus){
													$job_status = $rowstatus['status'];
												}
											}
									 echo isset($job_status)? $job_status  : '--'; ?>
                                    </td>
                                    <th class="active">Action</th>
									<td><a href="<?PHP echo base_url();?>admin/jobs/add/<?PHP echo isset($rowjob['cid'])? $rowjob['cid']  : ''; ?>" 
                                    class="m-l-10 btn btn-primary">Add Job </a>
                                    <a href="<?PHP echo base_url();?>admin/jobs/" class="m-l-10 btn btn-primary"> View All Job </a>
                                    <a href="<?PHP echo base_url();?>admin/jobs/add/<?PHP echo isset($rowjob['cid'])? $rowjob['cid']  : ''; ?>/editjob/
									<?PHP echo isset($rowjob['jobid'])? $rowjob['jobid']  : ''; ?>" class="m-l-10 btn btn-primary">Edit Job </a> 
									<?PHP if( isset($rowjob['job_status']) && $rowjob['job_status'] == 'Complete' || $rowjob['job_status'] == 'Cancelled' ){ 
											if($rowjob['archive'] == '0'){ ?> 
                                    			<a href="#" class="m-l-10 btn btn-primary">Archive Job </a>  
										 <?PHP  } else{ ?> 
                                         		<a href="#" class="m-l-10 btn btn-primary">Un-Archive Job </a>  
										 <?PHP }
								   } ?> </td> 
								</tr>
								<tr>
									<th class="active">Job Type</th>
                                    <td class="td-width"><?PHP  echo isset($rowjob['job_type'])? $rowjob['title']  : '--'; ?></td>
                                    <th class="active">Upload Files</th>
									<td>
                                    	<!-- BEGIN File Uploading form-->
                                        <div class="portlet light">
                                            <div class="portlet-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        
                                                        <form  action="<?PHP echo base_url("admin/upload/index/$job_id/$client_id"); ?>" class="dropzone" id="my-dropzone">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    	<!-- File Uploading form -->
                                   </td>
								</tr>
     
                                <tr>
									<th class="active">Job Title</th>
                                     <td class="td-width"><?PHP  echo isset($rowjob['job_title'])? $rowjob['job_title']  : '--'; ?></td>
                                    <th class="active">Viral Webbs Uploaded Files</th>
									<td> <div class="overflowy">
                                    	<table class="table table-bordered">
                                         	<th class="success">File Name</th><th class="success">Action</th>
                                            <?PHP if(!empty($viral_uploaded_file)){ 
											foreach($viral_uploaded_file as $vfile){  ?>
                                                <tr>
                                                    <td class="td-td-width"><?PHP echo isset($vfile['file_name']) ? $vfile['file_name'] : '--'; ?> </td>
                                                    <td>
                                                        	<?PHP if($vfile['file_name'] !=''){ ?>
                                                            <a href="<?PHP echo base_url();?>uploads/<?PHP echo $vfile['file_name']; ?>" class="m-l-10 btn btn-primary btn-xs" 
                                                            target="_blank">Download </a>
                                                           <?PHP } ?>
                                                            
              <a  onclick="return deletefile(<?PHP echo (isset($vfile['fid']))?($vfile['fid']):('');?>,'<?PHP echo (isset($vfile['file_name']))?($vfile['file_name']):(''); ?>');" 
                                                            class="m-l-10 btn btn-primary btn-xs">Delete </a>
                                                       
                                                    </td>
                                                </tr>
                                            <?PHP  } 
												} else{
													echo "<tr><td colspan='2' align='center'>";
													echo "<div class='alert alert-Danger' style='font-size:30px; color:red;font-weight:900;'>No File Found</div>";
													echo "</td></tr>"; 
												}
											?>
                                     	</table>
                                    </div></td>
								</tr>
								<tr>
									<th class="active">Job No</th>
                                    <td class="td-width"><?PHP  echo isset($rowjob['jobid'])? $rowjob['jobid']  : '--'; ?></td>
                                   <th class="active"></th>
									
									
								</tr>
                                <tr>
									<th class="active">Job Description</th>
                                   
                                    <td class="td-width">
									 <div class="overflowy"><?PHP echo isset($rowjob['job_desc'])? stripslashes($rowjob['job_desc'])  : '--'; ?></div>
                                      </td>
                                   
                                    <th class="active">Client Uploaded Files</th>
									<td> <div class="overflowy">
                                    	<table class="table table-bordered">
                                         	<th class="success">File Name</th><th class="success">Action</th>
                                            
												<?PHP if($client_uploaded_file){
													foreach($client_uploaded_file as $cfile){    ?>
                                                <tr>
                                                    <td class="td-td-width"><?PHP echo isset($cfile['file_name']) ? $cfile['file_name'] : '--'; ?> </td>
                                                    <td>
                                                        <?PHP if($vfile['file_name'] !=''){ ?>
                                                            <a href="<?PHP echo base_url();?>/uploads/<?PHP echo $cfile['file_name']; ?>" class="m-l-10 btn btn-primary btn-xs" 
                                                            target="_blank">Download </a>
                <a  onclick="return deletefile(<?PHP echo (isset($cfile['fid']))?($cfile['fid']):('');?>,'<?PHP echo (isset($cfile['file_name']))?($cfile['file_name']):(''); ?>');" 
                                                            class="m-l-10 btn btn-primary btn-xs">Delete </a>
                                                       	<?PHP } ?>
                                                    </td>
                                                </tr>
                                                <?PHP  } 
												} else{
													echo "<tr><td colspan='2' align='center'>";
													echo "<div class='alert alert-Danger' style='font-size:30px; color:red;font-weight:900;'>No File Found</div>";
													echo "</td></tr>"; 
												}
												?>
                                            
                                    	 </table>
                                    
                                    </div></td>
								</tr>
                                <tr>
									<th class="active">Job Date</th>
                                     <td class="td-width"><?PHP  echo isset($rowjob['job_date'])? $rowjob['job_date']  : $rowjob['date_created']; ?></td>
                                    <th class="active">Project Coordinator</th>
									<td> 
                                    	<form class="form form-horizontal" method="post" action="<?PHP echo base_url("admin/jobs/timeassign/$job_id/$client_id"); ?>"> 
                                    	<table class="table table-bordered">
                                         	<th class="success">Departments</th><th class="success">Time Allowed(Hours)</th>
                                           
                                                <tr>
                                                    <td class="info">Developers</td>
                                                    <td><input class="form-control" type="text" name="developer" value="" /> </td>
                                                </tr>
                                                <tr>
                                                    <td class="info">Desiging</td>
                                                    <td><input class="form-control" type="text" name="desiging" value="" /> </td>
                                                </tr>
                                                <tr>
                                                    <td class="info">Marketting</td>
                                                    <td><input class="form-control" type="text" name="marketing" value="" /> </td>
                                                </tr>
                                           		<tr>
                                                    <td colspan="2" align="right">
                                                    <input  type="hidden" name="" value="" />
                                                    <input class="btn btn-primary btn-sm" type="submit" name="" value="Time Assign" />
                                                    </td>
                                                    
                                                </tr>
                                           
                                     	</table>
                                       </form>
                                       <form class="form form-horizontal">
                                    	<table class="table table-bordered">
                                         	
                                           
                                                <tr>
                                                    <td colspan="2" align="right">
                               <a href="<?PHP echo base_url("admin/jobs/job_assign/$job_id/$client_id"); ?>" class="m-l-10 btn btn-primary btn-xs"  name="" >Assign To Employee</a>
                                                    </td>
                                               
                                                    <td colspan="2" align="right">
                            <a href="<?PHP echo base_url("admin/jobs/job_assign/$job_id/$client_id"); ?>" class="m-l-10 btn btn-primary btn-xs"  name="" >Assign To Department</a>
                                                    </td>
                                                    <td colspan="2" align="right">
                           <a href="<?PHP echo base_url("admin/jobs/job_assign/$job_id/$client_id"); ?>" class="m-l-10 btn btn-primary btn-xs"  name="" >Assign To PM</a>
                                                    </td>
                                                    </td>
                                                </tr>
                                           
                                     	</table>
                                       </form>
                                    </td>
								</tr>
                                <tr>
									<th class="active">Date Started</th>
                                    <td class="td-width"><?PHP  echo isset($rowjob['date_started'])? $rowjob['date_started']  : '--'; ?></td>
                                    <th class="active">Date Finished</th>
                                    <td><?PHP  echo isset($rowjob['date_finished'])? $rowjob['date_finished']  : '--'; ?></td>
								</tr>
                                <tr>
                                	<th class="active">Book Size</th>
                                   <td class="td-width"><?PHP  echo isset($rowjob['book_size'])? $rowjob['book_size']  : '--'; ?></td>
                                	<th class="active">Task Assigned History</th>
                                    <td>
                                    	
                                    	  <?PHP  foreach($task_history as $assign_hidtory){ ?>
                                    	<table class="table table-bordered">
                                      
                                            	<tr>
                                                    <th class="success">Assigned to</th>
                                                    <td class="info"><?PHP echo (isset($assign_hidtory['Name']) ? ($assign_hidtory['Name']) : ("--") ) ?></td>
                                                </tr>
                                                <tr>
                                                    <th class="success">Assigned Date</th>
                                                    <td class="info"><?PHP echo (isset($assign_hidtory['phase_start_date']) ? ($assign_hidtory['phase_start_date']) : ("--") ) ?></td>
                                                </tr>
                                                 <tr>
                                                     <th class="success">Department</th>
                                                     <td class="info"><?PHP echo (isset($assign_hidtory['name']) ? ($assign_hidtory['name']) : ("--") ) ?></td>
                                                 </tr>
                                                  <tr>
                                                      <th class="success">Deadline</th>
                                                      <td class="info"><?PHP echo (isset($assign_hidtory['phase_date_end']) ? ($assign_hidtory['phase_date_end']) : ("--") ) ?></td>
                                                  </tr>
                                       			  <tr>
                                                     
                                                      <td align="center" colspan="2" ><a href="#" style="font-size:20px;">Click Here To View Complete Hisrory </a></td>
                                                  </tr>
                                         </table>
                                         <?PHP } ?>
                                        
                                    </td>
                                    
                                    
								</tr>
                                <tr>
									<th class="active">Clients Deadline</th>
                                     <td class="td-width"><?PHP  echo isset($rowjob['viral_deadline'])? $rowjob['viral_deadline']  : '--'; ?></td>
                                    <th class="active">Viral Webbs Deadline</th>
                                     <td><?PHP  echo isset($rowjob['client_deadline'])? $rowjob['client_deadline']  : '--'; ?></td>
								</tr>
                                <tr>
									<th class="active">Comments</th>
                                    
                                   <td class="td-width"><div class="overflowy">
								  			 <?PHP echo isset($rowjob['comment'])? stripslashes($rowjob['comment'])  : ''; ?>
                                  	 </div></td>
                                    <th class="active">Comments</th>
									<td>
                                    	<form class="form form-horizontal">
                                    	<table class="table table-bordered">
                                         	<tr>
                                                    <td><textarea name=""></textarea></td>
                                              </tr>
                                              <tr>
                                                <td colspan="2" align="right"><input class="btn btn-primary btn-xs" type="submit" name="" value="Post Comment" /></td>
                                              </tr>
                                           
                                     	</table>
                                       </form>
                                    </td>
								</tr>
                                 
                                <?PHP  }  ?>
								<?PHP } // end of if 
								else{
									
									echo "<tr><td colspan='2' align='center'>";
									echo "<div class='alert alert-Danger' style='font-size:30px; color:red;font-weight:900;'>No Record Found</div>";
									echo "</td></tr>"; 
									
								}
								?>
								</table>
                                
                                
							</div>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
				</div>
			</div>
			
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->

<script type="text/javascript">
// This example uses jQuery so it creates the Dropzone, only when the DOM has
// loaded.

// Disabling autoDiscover, otherwise Dropzone will try to attach twice.

// or disable for specific dropzone:


$(function() {
  // Now that the DOM is fully loaded, create the dropzone, and setup the
  // event listeners
  var myDropzone = new Dropzone(".dropzone");

  myDropzone.on("complete", function(file, res) {
	  if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
            //alert('File Uploaded Successfully. ');
			location.reload();
        } else{
			 //alert('File Not Uploaded Successfully. ');
			location.reload();
          //alert('cry baby');
		}
      /*if (myDropzone.files[0].status != Dropzone.SUCCESS ) {
		  location.reload();
         // alert('yea baby');
      } else {
		  location.reload();
         // alert('cry baby');

      }*/
  });
});
</script>