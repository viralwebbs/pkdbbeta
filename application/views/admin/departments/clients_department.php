<?PHP  //echo "<pre>"; print_r($alldept);  echo "</pre>"; ?>

<!-- BEGIN PAGE CONTENT-->

			  <div class="row">
				<div class="col-md-12">
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
								<i class="fa fa-picture"></i>Client's Information Table
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
									<a href="<?PHP echo base_url("admin/departments/add_client_departments"); ?>"><button id="sample_editable_1_new" class="btn green">
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
									<th>
										Company Name
									</th>
									<th>
										Department Name
									</th>
									<th>
										 Email
									</th>
									<th>
										 Action
									</th>
								</tr>
								</thead>
								<tbody>
                                <?PHP if(isset($alldept) && is_array($alldept) ){
                                                    foreach($alldept as $dept){
														$dep_id = $dept['cdep_id'];
														$client_id = $dept['client_id'];
								?>
								<tr>
                                </tr>
								<?PHP if(isset($client_id)){
											$company= $this->functions->get_result_by_id("`client`","company_name","`id`",$client_id);
									}  ?>
                                    <?PHP  if(isset($company)){ 
									foreach($company as $company_name){ 
										$company_name = $company_name['company_name']; } } ?>
									<td><?PHP echo isset($company_name) ? ($company_name) : (''); ?></td>
                                    <td><?PHP echo isset($dept['cdep_name']) ? ($dept['cdep_name']) : (''); ?></td>
                                    <td><?PHP echo isset($dept['cdep_email']) ? ($dept['cdep_email']) : (''); ?></td>
                                    <td> 
                                    <a href="<?PHP  echo base_url("admin/departments/add_client_departments/editdept/$dep_id");?>" class="btn default btn-xs purple">
                                                <i class="fa fa-edit"></i> Edit </a> |
    								<a onclick="return deletecdept(<?PHP echo ( isset($dep_id) )?($dep_id):('');?>);"
          									 class="btn default btn-xs black"><i class="fa fa-trash-o"></i> Delete </a>
                                                
                                            </td>
								</tr>
								
								
								
							<?PHP
							}   }  else{ 
							echo '<td align="center" colspan="3" class="center">
                                            <div class="alert alert-danger">
                                       		<b style="font-size:40px;font-weight:bolder">Danger!</b>&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;
                                         <font style="font-size:25px;font-weight:bolder;"> No Record Found </font>
                                         </div>
               					 </td>';
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
           
             
       