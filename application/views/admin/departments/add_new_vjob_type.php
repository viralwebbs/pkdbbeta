<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
						<div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Add New Job Type
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
                            </div>
                        </div>
									<div class="portlet-body form">
                                    <div class="table-toolbar">
								
									</div>
                                       
										<!-- BEGIN FORM-->
										<form action="<?PHP echo base_url("admin/departments/add_new_vjob_type/addjobtype"); ?>" class="form-horizontal" method="post">
											<div class="form-body">

												<div class="form-group">
													<label class="col-md-3 control-label">Job Type</label>
													<div class="col-md-4">
														<div class="input-group">
										<input name="job_type" type="text" class="form-control input-circle-left" placeholder="Enter job type" required="required">
															<span class="input-group-addon input-circle-right">
															<i class="fa fa-user"></i>
															</span>
														</div>
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
										      <label class="control-label col-md-3">Department<span class="required">
										       </span>
										     </label>
										      <div class="col-md-4">
											   <select name="dept" class="form-control select2me" required="required">
												<?PHP echo $this->functions->DropDown("`department`","dep_id","name"); ?>
											</select>
										     </div>
                                             <div class="col-md-4">
														<?PHP if(form_error("dept")){ ?>
                                                        <div class="alert alert-danger">
                                                            <?PHP echo form_error("dept"); ?>
                                                        </div>
                                                        <?PHP } ?>
                                                    </div>
									       </div>
							    	     										
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-offset-3 col-md-9">
														<button type="submit" class="btn btn-circle blue">Add JobType</button>
													</div>
												</div>
                                                
											</div>
										</form>
										<!-- END FORM-->
									
								</div>
                                
             
             
             