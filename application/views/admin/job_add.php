<!-- BEGIN PAGE CONTENT-->
<?PHP //echo "<pre>"; print_r($job_edit); echo "</pre>"; ?>
<?PHP
	$viral_dept ='';
 if( isset($job_edit) && is_array($job_edit) && ( !empty($job_edit) ) ){ 
	foreach($job_edit as $job){
			$jobid = $job['jobid'];
			$job_date = $job['job_date'];
			$viral_dept = $job['viral_dept'];
			$client_dept = $job['client_dept'];
			$job_type = $job['job_type'];
			$job_title = $job['job_title'];
			$book_size = $job['book_size'];
			$client_deadline = $job['client_deadline'];
			$viral_deadline = $job['viral_deadline'];
			$date_started = $job['date_started'];
			$date_finished = $job['date_finished'];
			$job_status = $job['job_status'];
			$job_desc = $job['job_desc'];
			$comment = $job['comment'];
		
	} // end foreach
}   //  end of if  ?>
<div class="row">
		<div class="col-md-12">
        	<?PHP 
						if($this->session->flashdata('Success')){
							$msg = $this->session->flashdata('Success');
							 echo "<div class='alert alert-success alert-dismissible'>
								   <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								   ".$msg['success']."</div>";
								   $this->session->unset_flashdata['Success'];
								   
						}                    
						if($this->session->flashdata('Error')){
							$msg = $this->session->flashdata('Error');
							 echo "<div class='alert alert-danger alert-dismissible'>
								   <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								   ".$msg['err']."</div>";
								   $this->session->unset_flashdata['Success'];
								   
						}   
					?>
			<div class="portlet box green">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-gift"></i>Form Actions On Bottom
										</div>
										<div class="tools">
											<a href="javascript:;" class="collapse" data-original-title="" title="">
											</a>
											<a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
											</a>
											<a href="javascript:;" class="reload" data-original-title="" title="">
											</a>
											<a href="javascript:;" class="remove" data-original-title="" title="">
											</a>
										</div>
									</div>
									<div class="portlet-body form">
                                    <?PHP $param = "addjob"; 
										if(isset($jobid)){ $param="updatejob/$jobid";} ?>
										<!-- BEGIN FORM-->
                                        
										<form  class="form-horizontal" id="addjobform" method="post"  enctype="multipart/form-data"
                                        action="<?PHP echo base_url("admin/jobs/add/$client_id/$param"); ?>">
											<div class="form-body">
												<div class="form-group">
													<label class="col-md-3 control-label">Job Date</label>
													<div class="col-md-4">
														<div class="input-group">
															<input name="job_date" type="text" class="form-control input-circle-left datepicker"
                                                            value="<?PHP echo isset($job_date) ? ($job_date) : ( date("d-m-Y") );  ?>" required>
															<span class="input-group-addon input-circle-right">
															<i class="fa fa-user"></i>
															</span>
														</div>
                                                      </div>
                                                    <div class="col-md-4">
														<?PHP if(form_error("job_date")){ ?>
                                                        <div class="alert alert-danger">
                                                            <?PHP echo form_error("job_date"); ?>
                                                        </div>
                                                        <?PHP } ?>
                                                    </div>
													
												</div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Select Viral Department <span class="">
                                                     </span>
                                                    </label>
                                                    
                                                    <div class="col-md-4">
                                                        <select name="viral_dept" class="form-control select2me" onchange="get_jobTypes(this);" required>  
                                                         <?PHP    
                                                                $tablename="department";
                                                                $field1 = 'dep_id';
                                                                $field2 = 'name'; 
                                                                
                                                                echo $this->functions->DropDown($tablename , $field1, $field2, "", "", $viral_dept);
                                                        ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                     <?PHP if(form_error("viral_dept")){ ?>
                                                            <div class="alert alert-danger">
                                                                <?PHP echo form_error("viral_dept"); ?>
                                                            </div>
                                                  		 <?PHP } ?>
                                                    </div>
                                                    
                                                </div>
                                                
								    	     <div class="form-group">
                                                  <label class="control-label col-md-3">Select Clients Department<span class="">
                                                   </span>
                                                 </label>
                                                  <div class="col-md-4">
                                                   <select name="client_dept" class="form-control select2me" >
                                                    <?PHP    
                                                        $tablename="client_departments";
                                                        $field1 = 'cdep_id';
                                                        $field2 = 'cdep_name';
														$condition =  "`client_id`";
														$id = "$client_id";
                                                        
                                                        echo $this->functions->DropDown($tablename , $field1, $field2, $condition, $id, $client_dept);
                                                    ?>
                                                </select>
                                                 </div>
                                                  <div class="col-md-4">
                                                     <?PHP if(form_error("client_dept")){ ?>
                                                        <div class="alert alert-danger">
                                                        	<?PHP echo form_error("client_dept"); ?>
                                                        </div>
                                                		  <?PHP } ?>
                                                   </div>
                                                  
									       </div>
										   
								    	     <div class="form-group">
                                                  <label class="control-label col-md-3">Job Type<span class=""></span>
                                                 </label>
                                                  <div class="col-md-4">
                                                   <select  id="job_type" name="job_type" class="form-control select2me" 
                                                     requied>
                                                    <?PHP    
                                                        $tablename="job_type";
                                                        $field1 = 'id';
                                                        $field2 = 'title'; 
                                                        
                                                        echo $this->functions->DropDown($tablename , $field1, $field2 ,"", "", $job_type );
                                                    ?>
                                                </select>
                                                 </div>
                                                 <div class="col-md-4">
													 <?PHP if(form_error("job_type")){ ?>
                                                            <div class="alert alert-danger">
                                                                <?PHP echo form_error("job_type"); ?>
                                                            </div>
                                                      <?PHP } ?>
                                                 </div>
									       </div>
										   
												<div class="form-group">
													<label class="col-md-3 control-label">Job Title</label>
													<div class="col-md-4">
														<div class="input-group">
															<input name="job_title" type="text" class="form-control input-circle-left" 
                                                            placeholder="Enter Job Title"  
                                                            value="<?PHP echo isset($job_title) ? ($job_title) : (set_value("job_title"));  ?>"  required >
															<span class="input-group-addon input-circle-right">
															<i class="fa fa-user"></i>
															</span>
														</div>
													</div>
                                                    <div class="col-md-4">
														<?PHP if(form_error("job_title")){ ?>
                                                            <div class="alert alert-danger">
                                                                <?PHP echo form_error("job_title"); ?>
                                                            </div>
                                                     	 <?PHP } ?>
                                                  </div>
												</div>
								    	     <div class="form-group">
										      <label class="control-label col-md-3">book Size<span class="">
										       </span>
										     </label>
										      <div class="col-md-4">
                                                   <select class="form-control select2me" name="book_size">
                                                       <?PHP    
                                                        $tablename="book_size";
                                                        $field1 = 'id';
                                                        $field2 = 'bookSize_label'; 
                                                        
                                                        echo $this->functions->DropDown($tablename , $field1, $field2, "", "", $book_size);
                                                    ?>
                                                </select>
										     </div>
                                             
									       </div>
										   
												<div class="form-group">
													<label class="col-md-3 control-label">Client's Deadline</label>
													<div class="col-md-4">
														<div class="input-group">
															<input name="client_deadline" type="text" class="form-control input-circle-left datepicker"
                                                             placeholder="Enter Client's Deadline" 
                                                             value="<?PHP echo isset($client_deadline)  ? ($client_deadline) :
															  (isset($_POST['client_deadline']) ? ($_POST['client_deadline']) : ('')); ?>" >
															<span class="input-group-addon input-circle-right">
															<i class="fa fa-user"></i>
															</span>
														</div>
													</div>
                                                 </div>
												<div class="form-group">
													<label class="col-md-3 control-label">Viral Webbs Deadline</label>
													<div class="col-md-4">
														<div class="input-group">
															<input name="viral_deadline" type="text" class="form-control input-circle-left datepicker"
                                                             placeholder="Enter Viral Webbs Deadline" 
                                                              value="<?PHP echo isset($viral_deadline)  ? ($viral_deadline) :
															  (isset($_POST['viral_deadline']) ? ($_POST['viral_deadline']) : ('')); ?>"  >
															<span class="input-group-addon input-circle-right">
															<i class="fa fa-user"></i>
															</span>
														</div>
													</div>
                                                   
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Date Started</label>
													<div class="col-md-4">
														<div class="input-group">
															<input name="date_started" type="text"   class="form-control input-circle-left datepicker"
                                                             placeholder="Select Started Date" 
                                                              value="<?PHP echo isset($date_started)  ? ($date_started) :
															  (isset($_POST['started']) ? ($_POST['date_started']) : ('')); ?>" >
															<span class="input-group-addon input-circle-right">
															<i class="fa fa-user"></i>
															</span>
														</div>
													</div>
                                                    
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Date Finished</label>
													<div class="col-md-4">
														<div class="input-group">
															<input name="date_finished" id="datepicker2"  type="text" class="form-control input-circle-left datepicker"
                                                             placeholder="Select Finished Date" 
                                                              value="<?PHP echo isset($date_finished)  ? ($date_finished) :
															  (isset($_POST['date_finished']) ? ($_POST['date_finished']) : ('')); ?>" >
															<span class="input-group-addon input-circle-right">
															<i class="fa fa-user"></i>
															</span>
														</div>
													</div>
                                                   
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Status<span class="" >
													</span>
													</label>
													<div class="col-md-4">
														<select class="form-control select2me" name="job_status"  required>
															<?PHP    
																$tablename="job_status";
																$field1 = 'status_id';
																$field2 = 'status'; 
                                                        
                                                        echo $this->functions->DropDown($tablename , $field1, $field2, "", "", $job_status);
                                                    ?>
														</select>
													</div>
                                                    <div class="col-md-4">
														<?PHP if(form_error("job_status")){ ?>
                                                            <div class="alert alert-danger">
                                                                <?PHP echo form_error("job_status"); ?>
                                                            </div>
                                                         <?PHP } ?>
                                             		</div>
												</div>
                                                <?PHP 
												$readonly = "";
												if(isset($jobid)){ 
													$readonly ="disabled";
												} ?>
												<div class="form-group">
													<label class="col-md-3 control-label">Select File</label>
													<div class="col-md-4">
														<div class="input-group">
															<input name="userfile" type="file" class="form-control input-circle-left" placeholder="Choose File" <?PHP echo $readonly ?> >
															<span class="input-group-addon input-circle-right">
															<i class="fa fa-user"></i>
															</span>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Job Description</label>
													<div class="col-md-4">
														<div class="input-group">
                                                           <textarea name="job_desc" placeholder="Enter Job Description" > 
															   <?PHP echo isset($job_desc) ? (stripslashes($job_desc)) : 
                                                               ( isset($_POST['job_desc']) ? ($_POST['job_desc']) : ('') ); ?>
                                                           </textarea>															
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Comment</label>
													<div class="col-md-4">
														<div class="input-group">
                                                           <textarea name="comment" placeholder="Enter Comment" >
															   <?PHP echo isset($comment) ? (stripslashes($comment)) : 
                                                               ( isset($_POST['comment']) ? ($_POST['comment']) : ('') ); ?>
                                                           </textarea>															
														</div>
													</div>
												</div>
											</div>
                                            <?PHP 
												$value= "Add Job";
												if(isset($jobid)){ $value= "Update Job"; } ?>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-offset-3 col-md-9">
														<input type="submit" class="btn btn-primary btn-lg" value="<?PHP echo $value; ?>">
													</div>
												</div>
											</div>
										</form>
										<!-- END FORM-->
									</div>
								</div>
                                
             </div>
             
             </div>
             
  