
<?PHP  //echo "<pre>"; print_r($alldept);  echo "</pre>"; ?>


<!-- BEGIN PAGE CONTENT-->

			  <div class="row">
				<div class="col-md-12">
               <!--Delete Msg-->
               <div id="delete"></div>
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
								<i class="fa fa-picture"></i>Employees Head Information Table
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
						 	<div class="row">
								<div class="col-md-6">
									<div class="btn-group">
									<a href="<?PHP echo base_url("admin/departments/add_viral_departments"); ?>"><button id="sample_editable_1_new" class="btn green">
											Add New <i class="fa fa-plus"></i>
											</button></a>
										</div>
									</div>
									<div class="col-md-6">
										
									</div>
								</div>
							<div class="table-scrollable">

								<table class="table table-condensed table-hover">
                                    <thead>
                                        <tr>
                                            <th>Department Name</th>
                                            <th>Department Head	</th>
                                            <th>Email</th>
                                            <th>UserName</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?PHP if(isset($alldept) && is_array($alldept) ){
                                                    foreach($alldept as $dept){
														$dep_id = $dept['dep_id'];
                                         ?>
                                        <tr>
                                            <td><?PHP echo isset($dept['name']) ? ($dept['name']) : (''); ?></td>
                                            <td><?PHP echo isset($dept['Manager']) ? ($dept['Manager']) : (''); ?></td>
                                            <td><?PHP echo isset($dept['email']) ? ($dept['email']) : (''); ?></td>
                                            <td><?PHP echo isset($dept['username']) ? ($dept['username']) : (''); ?></td>
                                            <td>  
                                            
                                                <a href="<?PHP  echo base_url("admin/departments/add_viral_departments/editdept/$dep_id");?>" class="btn default btn-xs purple">
                                                <i class="fa fa-edit"></i> Edit </a> |
    											<a href="<?PHP  echo base_url("admin/departments/job_type/$dep_id");?>" class="btn default btn-xs black">
                                                <i class="fa fa-bookmark"></i> Job Type </a> |
         								 <a onclick="return deletedept(<?PHP echo ( isset($dep_id) )?($dep_id):('');?>);"
          									 class="btn default btn-xs black"><i class="fa fa-trash-o"></i> Delete </a>
                                                
                                            </td>
                                        </tr>
                                        <?PHP }
                                        }
                                         ?>
                                     </tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- END CONDENSED TABLE PORTLET-->
						
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>              
           
             
       