
<?PHP  //echo "<pre>"; print_r($editdept);  echo "</pre>"; ?>

<?PHP
	
 if( isset($editdept) && is_array($editdept) && ( !empty($editdept) ) ){ 
	foreach($editdept as $dept){
			$dep_id = $dept['dep_id'];
			$dept_name = $dept['name'];
			$dept_head = $dept['Manager'];
			$dept_username= $dept['username'];
		 $department =  $this->functions->get_result_by_id("`employee`","`emp_id`","`Name`",$dept_head);
		// echo "<pre>"; print_r($department);  echo "</pre>";
		 foreach($department as $row){
			  $department_id = $row['emp_id'];
		}
		
			
		
	} // end foreach
}   //  end of if  ?>
<!-- BEGIN PAGE CONTENT-->
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
											<i class="fa fa-gift"></i>Enter Department Information
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
										<!-- BEGIN FORM-->
                                        <?PHP if(isset($dep_id )){$param = "updatedept/$dep_id";} else{$param = "adddept";} ?>
										<form action="<?PHP echo base_url("admin/departments/add_viral_departments/$param");?>" class="form-horizontal" 
                                        		id="adddepform" method="post">
											<div class="form-body">
												<div class="form-group">
													<label class="col-md-3 control-label">Department Name</label>
													<div class="col-md-4">
														<div class="input-group">
															<input name="dept_name" type="text" class="form-control input-circle-left" placeholder="Enter Department Name" 
                                                             autocomplete="off" required="required" 
                                                             value="<?PHP echo isset($dept_name) ? ($dept_name) : (set_value("dept_name"));  ?>" >
															<span class="input-group-addon input-circle-right">
															<i class="fa fa-user"></i>
															</span>
														</div>
													</div>
                                                    <div class="col-md-4">
														<?PHP if(form_error("dept_name")){ ?>
                                                        <div class="alert alert-danger">
                                                            <?PHP echo form_error("dept_name"); ?>
                                                        </div>
                                                        <?PHP } ?>
                                                    </div>
												</div>
								    	     <div class="form-group">
										      <label class="control-label col-md-3">Department Head	<span class="required">
										       </span>
										     </label>
										      <div class="col-md-4">
                                             
											   <select name="dept_head" class="form-control select2me"   required="required">
													<?PHP  echo $this->functions->DropDown("employee" , "emp_id", "Name", "", "",$department_id ); ?>
											   </select>
										     </div>
                                             <div class="col-md-4">
														<?PHP if(form_error("dept_head")){ ?>
                                                        <div class="alert alert-danger">
                                                            <?PHP echo form_error("dept_head"); ?>
                                                        </div>
                                                        <?PHP } ?>
                                                    </div>
									       </div>
												<!--<div class="form-group">
													<label class="col-md-3 control-label">Email</label>
													<div class="col-md-4">
														<div class="input-group">
                                                        <select name="dept_email" class="form-control select2me" id="dept_email"
                                                         required="required">
															<?PHP    
                                                                    $tablename="employee";
                                                                    $field1 = 'emp_id';
                                                                    $field2 = 'email'; 
                                                                    
                                                                    echo $this->functions->DropDown($tablename , $field1, $field2, "", "", "");
                                                              ?>
											 		  </select>
															
															<span class="input-group-addon input-circle-right" >
															<i class="fa fa-user"></i>
															</span>
														</div>
													</div>
                                                    <div class="col-md-4">
														<?PHP if(form_error("dept_email")){ ?>
                                                        <div class="alert alert-danger">
                                                            <?PHP echo form_error("dept_email"); ?>
                                                        </div>
                                                        <?PHP } ?>
                                                    </div>
												</div>-->	
												<div class="form-group">
													<label class="col-md-3 control-label">Username</label>
													<div class="col-md-4">
														<div class="input-group">
															<input name="username" type="text" class="form-control input-circle-left" placeholder="Enter Username"
                                                              autocomplete="off" required="required" 
                                                               value="<?PHP echo isset($dept_username) ? ($dept_username) : (set_value("username"));  ?>">
															<span class="input-group-addon input-circle-right" >
															<i class="fa fa-user"></i>
															</span>
														</div>
													</div>
                                                    <div class="col-md-4">
														<?PHP if(form_error("username")){ ?>
                                                        <div class="alert alert-danger">
                                                            <?PHP echo form_error("username"); ?>
                                                        </div>
                                                        <?PHP } ?>
                                                    </div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Password</label>
													<div class="col-md-4">
														<div class="input-group">
															<input name="password" type="text" class="form-control input-circle-left" placeholder="Enter Password"
                                                            autocomplete="off">
															<span class="input-group-addon input-circle-right" >
															<i class="fa fa-user"></i>
															</span>
														</div>
													</div>
                                                    <div class="col-md-4">
														<?PHP if(form_error("password")){ ?>
                                                        <div class="alert alert-danger">
                                                            <?PHP echo form_error("password"); ?>
                                                        </div>
                                                        <?PHP } ?>
                                                    </div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Re-Type Password	</label>
													<div class="col-md-4">
														<div class="input-group">
															<input name="re-password" type="text" class="form-control input-circle-left" 
                                                            placeholder="Enter Re-Type Password	"  autocomplete="off">
															<span class="input-group-addon input-circle-right" >
															<i class="fa fa-user"></i>
															</span>
														</div>
													</div>
                                                    <div class="col-md-4">
														<?PHP if(form_error("re-password")){ ?>
                                                        <div class="alert alert-danger">
                                                            <?PHP echo form_error("re-password"); ?>
                                                        </div>
                                                        <?PHP } ?>
                                                    </div>
												</div>						    	     										
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-offset-3 col-md-9">
                                                     <?PHP if(isset($dep_id )){$value = "Edit Department";} ?>
														<button type="submit" class="btn btn-circle blue"><?PHP echo isset($value) ? ($value) : ('Add Department'); ?></button>
													</div>
												</div>
											</div>
										</form>
										<!-- END FORM-->
									</div>
								</div>
                                
             </div>
             
         </div>