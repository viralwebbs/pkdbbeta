<?PHP //echo "<pre>"; print_r($edittype); echo "</pre>"; ?>
<?PHP
	$viral_dept ='';
 if( isset($edittype) && is_array($edittype) && ( !empty($edittype) ) ){ 
	foreach($edittype as $type){
		$id= $type['id'];
			$job_type = $type['title'];
			$dep_id = $type['dep_id'];
			
	} // end foreach
}   //  end of if  ?>


<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
<div class="portlet box green">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-gift"></i>Update  Information
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
										<form action="<?PHP  echo base_url("admin/departments/editjob_type/$dep_id/updatejobtype");?>" class="form-horizontal" method="post">
											<div class="form-body">

												<div class="form-group">
													<label class="col-md-3 control-label">Title</label>
													<div class="col-md-4">
														<div class="input-group">
									<input name="job_type" type="text" class="form-control input-circle-left" placeholder="Enter job Title" required="required" 
                                    value="<?PHP echo (isset($job_type)) ? ($job_type) : (''); ?>">
															<span class="input-group-addon input-circle-right">
															<i class="fa fa-user"></i>
															</span>
														</div>
													</div>
												</div>
											
								    	     <div class="form-group">
										      <label class="control-label col-md-3">Departmenty<span class="required">
										       </span>
										     </label>
										      <div class="col-md-4">
											   <select name="dept" class="form-control select2me"  required="required">
														<?PHP echo $this->functions->DropDown("`department`","dep_id","name","","",$dep_id); ?>
											</select>
										     </div>
									       </div>
							    	     										
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-offset-3 col-md-9">
														<button type="submit" class="btn btn-circle blue">Update JobType</button>
													</div>
												</div>
											</div>
										</form>
										<!-- END FORM-->
									</div>
								</div>
                                
             </div>
             
             </div>