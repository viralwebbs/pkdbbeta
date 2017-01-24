<?PHP  //echo "<pre>"; print_r($editdept);  echo "</pre>"; ?>

<?PHP
	
 if( isset($editdept) && is_array($editdept) && ( !empty($editdept) ) ){ 
	foreach($editdept as $dept){
		    $client_id = $dept['client_id'];
			$dep_id = $dept['cdep_id'];
			$dept_name = $dept['cdep_name'];
			$dept_email= $dept['cdep_email'];
		
		
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
											<i class="fa fa-gift"></i>Update Client Information
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
										<form action="<?PHP echo base_url("admin/departments/add_client_departments/$param");?>" class="form-horizontal" 
                                        		id="adddepform" method="post">
											<div class="form-body">
											
								    	     <div class="form-group">
										      <label class="control-label col-md-3">Client Company<span class="required">
										       </span>
										     </label>
										      <div class="col-md-4">
											   <select name="client_company" class="form-control select2me" required="required">
												<?PHP  echo $this->functions->dropDown("client","id","company_name","","",$client_id); ?>
											</select>
										     </div>
                                              <div class="col-md-4">
														<?PHP if(form_error("client_company")){ ?>
                                                        <div class="alert alert-danger">
                                                            <?PHP echo form_error("client_company"); ?>
                                                        </div>
                                                        <?PHP } ?>
                                                    </div>
									       </div>
												<div class="form-group">
													<label class="col-md-3 control-label">Department Name</label>
													<div class="col-md-4">
														<div class="input-group">
												<input name="dept_name" type="text" class="form-control input-circle-left" placeholder="Enter Department Name" 
                    value="<?PHP echo (isset($dept_name)) ? ($dept_name) : (isset($_POST['dept_name']) ? (set_value("dept_name")) : ('') ); ?>" required="required">
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
													<label class="col-md-3 control-label">Email</label>
													<div class="col-md-4">
														<div class="input-group">
															<input name="email" type="text" class="form-control input-circle-left" placeholder="Enter Email" 
              value="<?PHP echo (isset($dept_email)) ? ($dept_email) : (isset($_POST['email']) ? (set_value("email")) : ('') ); ?>"required="required">
															<span class="input-group-addon input-circle-right" >
															<i class="fa fa-user"></i>
															</span>
														</div>
													</div>
                                                     <div class="col-md-4">
														<?PHP if(form_error("email")){ ?>
                                                        <div class="alert alert-danger">
                                                            <?PHP echo form_error("email"); ?>
                                                        </div>
                                                        <?PHP } ?>
                                                    </div>
												</div>							    	     										
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-offset-3 col-md-9">
                                                    <?PHP if(isset($dep_id )){$value = "Update Department";} ?>
														<button type="submit" class="btn btn-circle blue"><?PHP echo (isset($value)) ? ($value) : ('Add Department'); ?></button>
													</div>
												</div>
											</div>
										</form>
										<!-- END FORM-->
									</div>
								</div>
                                
             </div>
             
             </div>