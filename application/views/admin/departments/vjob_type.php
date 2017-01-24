<?PHP //echo "<pre>"; print_r($alltype); echo "</pre>"; ?>
<!-- BEGIN PAGE CONTENT-->

			  <div class="row">
				<div class="col-md-12">
                <div id ="delete"></div>
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
								<i class="fa fa-picture"></i>All Jobs List
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
									<a href="<?php echo base_url();?>admin/departments/add_new_vjob_type"><button id="sample_editable_1_new" class="btn green">
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
										Job Type	
									</th>
									<th>
										Department 
									</th>
									<th>
										 Action
									</th>
								</tr>
								</thead>
								<tbody>
                                <?PHP  if(isset($alltype) && !empty($alltype)){
									foreach($alltype as $type){
										$id =  $type['id'];
								?>
								<tr>
									<td><?PHP  echo $type['title']; ?></td>
									<td>
                                    	<?PHP 
									
										 if($type['dep_id'] !=''){
											$deptartment = $this->functions->get_result_by_id("department","name","dep_id",$type['dep_id']);
											
											foreach($deptartment as $rowdept_name){ 
												echo $dept_name = $rowdept_name['name'];
											 } 
										}
								 ?>
                                    </td>

									<td>  
										<a href="<?php echo base_url("admin/departments/editjob_type/$id");?>" class="btn default btn-xs purple">
										<i class="fa fa-edit"></i> Edit </a> | 
                                        <a onclick="return deletejobtype(<?PHP echo (isset($id)) ? ($id) : (''); ?>)" class="btn default btn-xs black">
										<i class="fa fa-trash-o"></i> Delete </a>
									</td>
								</tr>
								<?PHP  	}	
								}  else {  ?> 
                                <td align="center" colspan="3" class="center">
                                            <div class="alert alert-danger">
                                       		<b style="font-size:40px;font-weight:bolder">Danger!</b>&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;
                                         <font style="font-size:25px;font-weight:bolder;"> No Record Found </font>
                                         </div>
               					 </td>  <?PHP }  ?>
								</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- END CONDENSED TABLE PORTLET-->
						
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>              
           
             
       