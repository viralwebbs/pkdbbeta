<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once (APPPATH . "controllers/admin/main.php");

class Jobs extends Main {

	
	
	 public function __construct() {
		  parent::__construct();
		 
    }
 
	
	public function index(){
		
		$data['alljobs'] = $this->Sqlmodel->getRecords("*", "job", "id", "ASC", "archive='0'", "100","0");
		$data['filename'] = "admin/jobs";
		$data['title']= "Jobs";
		$dataheader['title']= "Jobs";
		$sidebardata['module'] = "jobs";
		$sidebardata['child'] = "job List";
		$this->get_layout($data, $dataheader, $sidebardata);
	
		//$this->load->view("default",$data);	
		//$this->get_footer($data);
			
	}
	public function add($client_id= NULL, $param= NULL, $job_id= NULL){
		//echo $client_id . $param . $job_id ;
		//die();
		$data['filename'] = "admin/job_add";
		$data['title']= "ADd New Jobs";
		$data['client_id'] = $client_id;
		$dataheader['title']= "Jobs";
		$sidebardata['module'] = "jobs";
		$sidebardata['child'] = "job_add";
		
		
		if($client_id == '' ){
			 redirect(base_url("/admin/jobs"));
		 } else if($param ==''){
			 $this->get_layout($data, $dataheader, $sidebardata);
				
		}
		
		if($param !='' && $param == 'addjob'){
			
			
			$config = array(
					array(
							'field' => 'job_date',
							'label' => 'Job Date',
							'rules' => 'required',
							'errors' => array(
									'required' => 'You must provide Job Date.',
							),
					),
					array(
							'field' => 'viral_dept',
							'label' => 'Viral department',
							'rules' => 'required',
							'errors' => array(
									'required' => 'You must provide a Viral Department.',
							),
					),
					/*array(
							'field' => 'client_dept',
							'label' => 'Client Department',
							'rules' => 'required',
							'errors' => array(
									'required' => 'You must provide a Client Department.',
							),
					),*/
					array(
							'field' => 'job_type',
							'label' => 'Job type',
							'rules' => 'required',
							'errors' => array(
									'required' => 'You must provide Job Type.',
							),
					),
					array(
							'field' => 'job_title',
							'label' => 'Jobt title',
							'rules' => 'required',
							'errors' => array(
									'required' => 'You must provide Job Title.',
							),
					),
					
					array(
							'field' => 'job_status',
							'label' => 'Job Status',
							'rules' => 'required',
							'errors' => array(
									'required' => 'You must provide Job Status.',
							),
					)
				
					
			);

			$this->form_validation->set_rules($config);
			
			if($this->form_validation->run() == false){
			 $this->get_layout($data, $dataheader, $sidebardata);
				//$this->load->view("default",$data);
			} else{
				
				
				$columns['client_id'] = $client_id;
				$columns['job_date'] = date('Y-m-d', strtotime( $this->common->filter('job_date') ));
				$columns['viral_dept'] = $this->common->filter("viral_dept");
				$columns['client_dept'] = $this->common->filter("client_dept");
				$columns['job_type'] = $this->common->filter("job_type");
				$columns['job_title'] = $this->common->filter("job_title");
				$columns['book_size'] = $this->common->filter("book_size");
				$columns['client_deadline'] = date('Y-m-d', strtotime( $this->common->filter("client_deadline") ) );
				$columns['viral_deadline'] = date('Y-m-d', strtotime( $this->common->filter("viral_deadline") ));
				$columns['date_started'] = date('Y-m-d', strtotime( $this->common->filter("date_started") ));
				$columns['date_finished'] = date('Y-m-d', strtotime($this->common->filter("date_finished") ));
				$columns['date_created'] = date('Y-m-d');
				$columns['job_status'] = $this->common->filter("job_status");
				$columns['job_desc'] = $this->common->filter("job_desc");
				$columns['comment'] = $this->common->filter("comment");
			
				/// Inser Into Job
				if($columns['client_id'] != ''){
					$result['jobadded'] = $this->Sqlmodel->insertRecord("job" , $columns);
					$last_id = $result['jobadded'];
					//print_r($result['jobadded']);
					if($last_id == FALSE){
						$array_msg = array('err'=>'OOPS!  Job Not Added  , Try Again');
						$this->session->set_flashdata('Error',$array_msg);
						$this->get_layout($data, $dataheader, $sidebardata);
					} else{
							// Image Uploading
							$config['upload_path'] = './uploads/';
							$config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|xlsx|xls|psd';
							$config['max_size']	= '100000000';
							//$config['max_width']  = '1024';
							//$config['max_height']  = '768';
							$config['detect_mime']  = TRUE;
							$config['file_ext_tolower'] = TRUE;
							//$config['encrypt_name'] = TRUE;
							$this->upload->initialize($config);
							$file = $_FILES['userfile'];
							if(isset($file)){
								if ( ! $this->upload->do_upload('userfile')) {
									 $error = array('error' => $this->upload->display_errors());
									// print_r($error);
									$array_msg = array('fileerror'=>'File Not Uploaded');
									$this->session->set_flashdata('Fileerr',$array_msg);
									$this->get_layout($data, $dataheader, $sidebardata);
									
								} else {
									$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
									//print_r($this->upload->data());
									$filename = $this->upload->data('file_name');
									$data = array('upload_data' => $this->upload->data());
									///inser into upload
									$fields['job_id'] = $last_id;
									$fields['client_id'] = $client_id;
									 $fields['file_name'] = $filename;
									 $fields['i'] = $last_id;
									$fields['type'] = "Admin";
									$fields['fileuploaded'] = $this->Sqlmodel->insertRecord("upload" , $fields);
									
								}
							} /// end of file
							/// Sending Email
							$emailmsg = $this->send_email($last_id);
							if($emailmsg){
								$array_msg = array('emailsuccess'=>'Email Send Successfully');
								$this->session->set_flashdata('Email',$array_msg);
								//echo "Success";
							} else{
								$array_msg = array('emailerror'=>'Email Sending Failed !');
								$this->session->set_flashdata('Emailerr',$array_msg);
								//echo "error";
							}
							$array_msg = array('success'=>'Job Added Successfully');
							$this->session->set_flashdata('Success',$array_msg);
							redirect(base_url("admin/jobs/detail/$last_id/$client_id"));
						}
				}  else{
					$array_msg = array('err'=>'Client id missing ');
					$this->session->set_flashdata('Error',$array_msg);
					$this->get_layout($data, $dataheader, $sidebardata);
				}
				
				
				
			}  // end of else form validation
			
		}  // end of job add
		
		// Edit Job
			if( ($param !='' && $param == 'editjob' ) && ($job_id !='') ){
				
				$fields = "`job`.`id` AS jobid , `job`.`job_title`, `job`.`job_desc`, `job`.`job_type`, `job`.`date_created`, `job`.`book_size`, `job`.`comment`, `job`.`archive`,
					`job`.`job_date`,`job`.`date_started`,`job`.`date_finished`,`job`.`client_deadline`,`job`.`viral_deadline`,`job`.`job_status`,`job`.`amount_agreed`,`job`.`time`,
					`job`.`viral_dept` , `job`.`client_dept`";
				$where = "`job`.`id` = '$job_id'";
								
				$data['job_edit'] = $this->Sqlmodel->getJoinRecords($fields, "job", $where,"", " `job`.`id`", "DESC"," `job`.`id`");
				 $this->get_layout($data, $dataheader, $sidebardata);
				//$this->load->view("default",$data);	
				
			} /// end of jobedit
		
			//// job update parameter 
			if($param !='' && $param == 'updatejob' && $job_id !=''){
				//echo $param .$job_id .$client_id;
				//die();
			$config = array(
					array(
							'field' => 'job_date',
							'label' => 'Job Date',
							'rules' => 'required',
							'errors' => array(
									'required' => 'You must provide Job Date.',
							),
					),
					array(
							'field' => 'viral_dept',
							'label' => 'Viral department',
							'rules' => 'required',
							'errors' => array(
									'required' => 'You must provide a Viral Department.',
							),
					)
					/*,
					array(
							'field' => 'client_dept',
							'label' => 'Client Department',
							'rules' => 'required',
							'errors' => array(
									'required' => 'You must provide a Client Department.',
							),
					)*/
					,
					array(
							'field' => 'job_type',
							'label' => 'Job type',
							'rules' => 'required',
							'errors' => array(
									'required' => 'You must provide Job Type.',
							),
					),
					array(
							'field' => 'job_title',
							'label' => 'Jobt title',
							'rules' => 'required',
							'errors' => array(
									'required' => 'You must provide Job Title.',
							),
					),
					
					array(
							'field' => 'job_status',
							'label' => 'Job Status',
							'rules' => 'required',
							'errors' => array(
									'required' => 'You must provide Job Status.',
							),
					)
				
					
			);

			$this->form_validation->set_rules($config);
			
			if($this->form_validation->run() == false){ 
			
				redirect(base_url("admin/jobs/add/$client_id/editjob/$job_id"));
				
			} else{
				
				$updatecolumns['client_id'] = $client_id;
				$updatecolumns['job_date'] = date('Y-m-d', strtotime( $this->common->filter('job_date') ));
				$updatecolumns['viral_dept'] = $this->common->filter("viral_dept");
				$updatecolumns['client_dept'] = $this->common->filter("client_dept");
				$updatecolumns['job_type'] = $this->common->filter("job_type");
				$updatecolumns['job_title'] = $this->common->filter("job_title");
				$updatecolumns['book_size'] = $this->common->filter("book_size");
				$updatecolumns['client_deadline'] = date('Y-m-d', strtotime( $this->common->filter("client_deadline") ) );
				$updatecolumns['viral_deadline'] = date('Y-m-d', strtotime( $this->common->filter("viral_deadline") ));
				$updatecolumns['date_started'] = date('Y-m-d', strtotime( $this->common->filter("date_started") ));
				$updatecolumns['date_finished'] = date('Y-m-d', strtotime($this->common->filter("date_finished") ));
				$updatecolumns['date_created'] = date('Y-m-d');
				$updatecolumns['job_status'] = $this->common->filter("job_status");
				$updatecolumns['job_desc'] = $this->common->filter("job_desc");
				$updatecolumns['comment'] = $this->common->filter("comment");
				
				if($updatecolumns['client_id'] != ''){
					$where = "`id` = '$job_id'";
					$result['jobupdated'] = $this->Sqlmodel->updateRec("job", $updatecolumns, $where);
					if($result['jobupdated'] == FALSE){
						$array_msg = array('err'=>'Job Not Updated  , Try again later');
						$this->session->set_flashdata('Error',$array_msg);
						redirect(base_url("admin/jobs/add/$client_id/editjob/$job_id"));
					} else{
							$array_msg = array('success'=>'Job Updated Successfully');
							$this->session->set_flashdata('Success',$array_msg);
							/// Sending Email
							$emailmsg = $this->send_email($job_id);
							if($emailmsg){
								$array_msg = array('emailsuccess'=>'Email Send Successfully');
								$this->session->set_flashdata('Email',$array_msg);
								//echo "Success";
							} else{
								$array_msg = array('emailerror'=>'Email Sending Failed !');
								$this->session->set_flashdata('Emailerr',$array_msg);
								//echo "error";
							}
							
							
							redirect(base_url("admin/jobs/detail/$job_id/$client_id"));
					}
					
				} else{
					$array_msg = array('err'=>'Client id missing');
					$this->session->set_flashdata('Error',$array_msg);
					redirect(base_url("admin/jobs/add/$client_id/editjob/$job_id"));
				}
				
				
				
				
			}  // end of else form validation update job
			
		}  // end of job update

			
	} // end of function
	
	
	
	public function detail($job_id='', $client_id=''){
		
		if($job_id == '' || $client_id == '' ){ redirect(base_url("/admin/jobs"));}
			
		$valid_client_id = $this->functions->get_result_by_id("`client`",'`id`','`id`',$client_id);
		if(!empty($valid_client_id)){
			//print_r($valid_client_id); die();
		} else{
				redirect(base_url("/admin/jobs"));
		}
		
		//$job_id = $this->input->post['id'];
		$fields = "`job`.`id` AS jobid , `job`.`job_title`, `job`.`job_desc`, `job`.`job_type`, `job`.`date_created`, `job`.`book_size`, `job`.`comment`, `job`.`archive`,
			`job`.`job_date`,`job`.`date_started`,`job`.`date_finished`,`job`.`client_deadline`,`job`.`viral_deadline`,`job`.`job_status`,`job`.`amount_agreed`,`job`.`time`,
			`job`.`viral_dept` ,`employee`.`dep_id`,`employee`.`Name` ,`client`.`id` AS cid, `client`.`client_type`,`client`.`company_name`,`client`.`name`,`job_type`.`title`,
			`department`.`name` AS dept_name";
						
		
		$jointable = array(
				 array(
					'table' => '`employee`',
					'condition' => '`employee`.`dep_id` = 1',
					'type' => '`left`'
				),
				 array(
					'table' => '`client`',
					'condition' => '`job`.`client_id` = `client`.`id` ',
					'type' => '`left`'
				),
				 array(
					'table' => '`job_type`',
					'condition' => '`job`.`job_type` = `job_type`.`id` ',
					'type' => '`left`'
				) ,
				 array(
					'table' => '`department`',
					'condition' => '`job`.`viral_dept` = `department`.`dep_id` ',
					'type' => '`left`'
				)
		);
		
		
		$where = "`job`.`id` = '$job_id'";
						
		$data['job_detail'] = $this->Sqlmodel->getJoinRecords($fields, "job", $where,$jointable, " `job`.`id`", "DESC"," `job`.`id`");
		$where = " `job_id` = '$job_id' AND `client_id` = '$client_id'  AND `type` = 'Admin' ";
		$data['viral_uploaded_file'] = $this->Sqlmodel->get_result_by_id("upload","`id` AS fid, `file_name`",$where);
		$clientwhere = " `job_id` = '$job_id' AND `client_id` = '$client_id'  AND `type` = 'Client' ";
		$data['client_uploaded_file'] = $this->Sqlmodel->get_result_by_id("`upload`", "`id` AS fid, `file_name`", $clientwhere);
		
		 $employ_fields=" `timeplan`.`phase_start_date`, `timeplan`.`phase_date_end`, `employee`.`Name`, `department`.`name`";
		$date=date('Y-m-d');
		 $employeewhere ="`timeplan`.`job_id`='$job_id' AND `timeplan`.`phase_date_end` >='$date'";
	
		
			$taskjointable = array(
				 array(
					'table' => '`employee`',
					'condition' => '`timeplan`.`emp_id` = `employee`.`emp_id`',
					'type' => '`left`'
				),
				array(
					'table' => '`department`',
					'condition' => '`department`.`dep_id` = `employee`.`dep_id`',
					'type' => '`left`'
				)
		);
							
							
		$data['task_history'] =  $this->Sqlmodel->getJoinRecords($employ_fields, "`timeplan`", $employeewhere,$taskjointable," `timeplan`.`id`", "DESC");
		
		$data['filename'] = "admin/job_detail.php";
		$data['title']= "Job Details";
		$data['client_id'] = $client_id;
		$dataheader['title']= "Jobs";
		$sidebardata['module'] = "jobs";
		$sidebardata['child'] = "job_add";
		
		$this->get_layout($data, $dataheader, $sidebardata);
			
	}
	
	public function client_department(){
		$data['filename'] = "admin/clients_department";
		$data['title'] = "Client Depaertment";
		$data['module'] = "Departments";
		$data['child'] = "clients_department";
		$this->load->view("default", $data);
	}
	
		public function employee(){
		$data['filename'] = "admin/employee";
		$data['title'] = "Employee";
		$data['module'] = "employee";
		$data['child'] = "employee";
		$this->load->view("default", $data);
	}


		public function update_clientdeprt($id){
			//echo $id; 

		$data['filename'] = "admin/update_client_deprt";
		$data['title'] = "Update Client Info";
		$data['module'] = "jobs";
		$data['child'] = "update_clientdeprt";
		$this->load->view("default", $data);
	}



		public function add_deprt(){
		$data['filename'] = "admin/add_client_dprt";
		$data['title'] = "Add Client Department";
		$data['module'] = "jobs";
		$data['child'] = "add_deprt";
		$this->load->view("default", $data);
	}
	
	function get_result(){
			 $tablename = $this->input->post("tablename");
			 $fieldname = $this->input->post("fieldname");
			 $condition = $this->input->post("condition");
			 $id = $this->input->post("id");
			
			$types= '';
			$result['types'] = $this->Sqlmodel->get_result_by_id($tablename,$fieldname,$condition,$id);
			$fieldname = explode("," ,$fieldname );
			$fieldname[0];
			$fieldname[1];
			$html = '';
			foreach($result['types'] as $row){
				//$id = $row['id'];
				//$title = $row['title'];
				$html .= '<option value="'.$row[$fieldname[0]].'" > '.$row[$fieldname[1]].'</option>';
			}
			//$param = $tablename . $fieldname  . $condition  . $id ;
			echo  json_encode($html);
			
			//echo  $html;
		}
		
		//// Time assign 
		
		function timeassign($job_id = NULL, $client_id = NULL){
			
			
			if($job_id == '' || $client_id == ''){ redirect( base_url("admin/jobs"));}
			$date=date('Y-m-d');
			$time=date('h:i');
			$columns['job_id'] = $job_id;
			$columns['client_id'] = $client_id;
			$columns['developer_time'] = $this->common->filter("developer");
			$columns['designer_time'] = $this->common->filter("desiging");
			$columns['marketing_time'] = $this->common->filter("marketing");
			$columns['date_created'] =$date;
			$columns['time'] =$time;
			
			$result['timeassig'] = $this->Sqlmodel->insertRecord("employe_task" , $columns);
			if($result['timeassig'] == TRUE){
				/// Sending Email
				
				$emailmsg = $this->send_email($job_id, $columns['developer_time'],$columns['designer_time'], $columns['marketing_time']);
				if($emailmsg){
					$array_msg = array('emailsuccess'=>'Email Send Successfully');
					$this->session->set_flashdata('Email',$array_msg);
					//echo "Success";
				} else{
					$array_msg = array('emailerror'=>'Email Sending Failed !');
					$this->session->set_flashdata('Emailerr',$array_msg);
					//echo "error";
				}
				
				$array_msg = array('success'=>'Time Assigned Successfully');
				$this->session->set_flashdata('Success',$array_msg);
				
				redirect(base_url("admin/jobs/detail/$job_id/$client_id"));
				die();
			} else{
				$array_msg = array('err'=>'Time not Assigned ');
			    $this->session->set_flashdata('Error',$array_msg);
				redirect(base_url("admin/jobs/detail/$job_id/$client_id"));
				die();
			}
			
		}  /// end of time assign
		
		//// job Assign 
		
		function job_assign($job_id = NULL, $client_id = NULL){
			
			if($job_id == '' || $client_id == ''){ redirect( base_url("admin/jobs"));}
		    $data['alljob'] = $this->Sqlmodel->getRecords("`id`,`job_title`,`job_status`", "job", "id", "ASC", "`id` ='$job_id'");
			$data['filename'] = "admin/job_assign";
			$data['title']= "Assign Job";
			$dataheader['title']= "Assign Job";
			$sidebardata['module'] = "jobs";
			$sidebardata['child'] = "job_assign";
			
			$this->get_layout($data, $dataheader, $sidebardata);
			
			
			
			
		}  /// end of Job Assign

}

?>