<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once (APPPATH . "controllers/admin/main.php");

class Departments extends Main {

	
	 public function __construct() {
		  parent::__construct();
		 
    }
	
	
	public function index(){
		
		//$data['alljobs'] = $this->Sqlmodel->getRecords("*", "job", "id", "ASC", "archive='0'", "20","0");
		$data['filename'] = "admin/departments";
		$data['title']= "All Departments";
		$data['module'] = "departments";
		$data['child'] = "departments";
		$this->load->view("default",$data);	
			
	}

	public function viral_departments(){
		
	   $data['alldept'] = $this->Sqlmodel->getRecords("*", "department", "dep_id", "ASC");
       $data['filename'] = "admin/departments/viral_departments";
       $data['title'] = "Viral Departments";
       $dataheader['title']= "Viral Departments";
	   $sidebardata['module'] = "departments";
	   $sidebardata['child'] = "viral_departments";
	   
	   $this->get_layout($data, $dataheader, $sidebardata);
 	}

	public function add_viral_departments($param = NULL, $dep_id = NULL){
		//echo $param . $dep_id;  //die();
       $data['filename'] = "admin/departments/add_viral_department";
       $data['title'] = "Add Viral Department";
       $dataheader['title']= "Add Viral Departments";
	   $sidebardata['module'] = "departments";
	   $sidebardata['child'] = "add_viral_department";
	    if($param =='' ){
		   $this->get_layout($data, $dataheader, $sidebardata);
     	}
	   
	   if($param !='' && $param == 'adddept'){
			//echo $param . $dep_id . 'add';  die();
			
			$config = array(
					array(
							'field' => 'dept_name',
							'label' => 'Department Name',
							'rules' => 'required',
							'errors' => array(
									'required' => 'You must provide Departments Name.',
							),
					),
					array(
							'field' => 'dept_head',
							'label' => 'Department Head',
							'rules' => 'required',
							'errors' => array(
									'required' => 'You must provide a Viral Department Head Name. ',
							),
					),
					/*array(
							'field' => 'dept_email',
							'label' => 'Department Email',
							'rules' => 'required',
							'errors' => array(
									'required' => 'You must provide Department Head Email.',
							),
					),*/
					array(
							'field' => 'username',
							'label' => 'Username',
							'rules' => 'required',
							'errors' => array(
									'required' => 'You must provide Username.',
							),
					),
					
					array(
							'field' => 'password',
							'label' => 'Password',
							'rules' => 'required',
							'errors' => array(
									'required' => 'You must provide Password.',
							),
							
					),
					array(
							'field' => 're-password',
							'label' => 'Re Password',
							'rules' => 'required|matches[password]',
							'errors' => array(
									'required' => 'You must provide Re Password.',
							),
							
					)
				
					
			);

			$this->form_validation->set_rules($config);
			
			
			if($this->form_validation->run() == false){
				
			 $this->get_layout($data, $dataheader, $sidebardata);
				
			} else{
				
			    
				
				$columns['name'] = $this->common->filter("dept_name");
				$manager=  $this->common->filter("dept_head");
				$where = "`emp_id` ='$manager' ";
				$name = $this->Sqlmodel->getSingleField('`name`', '`employee`', $where);
				$columns['Manager'] = $name['name'];
				$email = $this->Sqlmodel->getSingleField('`email`', '`employee`', $where);
				$columns['email'] = $email['email'];
				$columns['username'] = $this->common->filter("username");
				$columns['password'] = $this->common->filter("password");
				
			
			   /// Inser Into  Departments
			
				$result['depadded'] = $this->Sqlmodel->insertRecord("department" , $columns);
				if($result['depadded'] == FALSE){
					$array_msg = array('err'=>'OOPS!  Department  Not Added  , Try Again');
					$this->session->set_flashdata('Error',$array_msg);
					$this->get_layout($data, $dataheader, $sidebardata);
				} else{
					$array_msg = array('success'=>'Department Added Successfully');
					$this->session->set_flashdata('Success',$array_msg);
					
					redirect(base_url("admin/departments/viral_departments"));
					die();
				}
				
				
				
				
			}  // end of else form validation 
			
	   } /// end if param == adddept
	   
	   /// Edit Department
	   if($param !='' && $param == 'editdept' && $dep_id !=''){
		   $data['title'] = "Edit Viral Department";
          $dataheader['title']= "Edit Viral Departments";
		   //echo $param . $dep_id . 'edit';  die();
			$where = "`dep_id` = '$dep_id' ";
			$data['editdept'] = $this->Sqlmodel->getRecords("*", "department", "dep_id", "ASC", $where);
			if($data['editdept'] == TRUE){
				$this->get_layout($data, $dataheader, $sidebardata);
			} else{
				redirect( base_url("admin/departments/viral_departments") );
			}
			
				
	   } /// end if param == edit dept
	   
	   /// Update dept
	   if($param !='' && $param == 'updatedept' && $dep_id !=''){
			//echo $param . $dep_id . 'update'; die();
				//echo "working 1"; die();
				
				$columns['name'] = $this->common->filter("dept_name");
				$manager=  $this->common->filter("dept_head");
				$where = "`emp_id` ='$manager' ";
				$name = $this->Sqlmodel->getSingleField('`name`', '`employee`', $where);
				$columns['Manager'] = $name['name'];
				$email = $this->Sqlmodel->getSingleField('`email`', '`employee`', $where);
				$columns['email'] = $email['email'];
				$columns['username'] = $this->common->filter("username");
				$username =  $this->common->filter("username");
				$password =  $this->common->filter("password");
				if(!empty($password)){
					$columns['password'] = $this->common->filter("password");
				}
			   /// update Into  Departments
				$condition = "`dep_id` = '$dep_id'";
				$result['depupdated'] = $this->Sqlmodel->updateRec("department" , $columns , $condition);
				if($result['depupdated'] == FALSE){
					$array_msg = array('err'=>'OOPS!  Department  Not Updated , Try Again');
					$this->session->set_flashdata('Error',$array_msg);
					$this->get_layout($data, $dataheader, $sidebardata);
				} else{
					$array_msg = array('success'=>'Department Updated Successfully');
					$this->session->set_flashdata('Success',$array_msg);
					
					redirect(base_url("admin/departments/viral_departments"));
					die();
				}
				
	   } /// end if param == updatedept
	   
	  
 	}

	

	public function job_type($dep_id = NULL){
		if($dep_id == ''){ redirect(base_url("/admin/departments/viral_departments")); }
		$where = "`dep_id` = '$dep_id'";
	   $data['alltype'] = $this->Sqlmodel->getRecords("*", "job_type", "id", "ASC",$where);
       $data['filename'] = "admin/departments/vjob_type";
       $data['title'] = "View job Types";
       $dataheader['title']= "View job Types";
	   $sidebardata['module'] = "departments";
	   $sidebardata['child'] = "vjob_type";
	   $this->get_layout($data, $dataheader, $sidebardata);
 	}

 	
 	public function editjob_type($id = NULL,$param = NULL){
		if($id == ''){ redirect(base_url("/admin/departments/viral_departments")); }
		$where = "`id` = '$id' ";
		$data['edittype'] = $this->Sqlmodel->getRecords("*", "job_type", "id", "ASC", $where);
       $data['filename'] = "admin/departments/edit_jtype";
       $data['title'] = "Edit Job type";
        $dataheader['title']= "Edit Job type";
	   $sidebardata['module'] = "departments";
	   $sidebardata['child'] = "editjob_type";
	   if($param == ''){
	   	$this->get_layout($data, $dataheader, $sidebardata);
	   }
	   if(!empty($param) && $param =='updatejobtype' && $id !=''){
		   		$columns['title'] = $this->common->filter("job_type");
				$columns['dep_id'] = $this->common->filter("dept");
			
				
				// update Into  Departments
				$condition = "`id` = '$id'";
				$result['updated'] = $this->Sqlmodel->updateRec("job_type" , $columns , $condition);
				if($result['updated'] == FALSE){
					$array_msg = array('err'=>'OOPS!  Job Type Not Updated , Try Again');
					$this->session->set_flashdata('Error',$array_msg);
					$this->get_layout($data, $dataheader, $sidebardata);
				} else{
					$array_msg = array('success'=>'Job type Updated Successfully');
					$this->session->set_flashdata('Success',$array_msg);
					
					redirect(base_url("admin/departments/job_type/$id"));
					die();
				}
		   
		}
 	}  /// end of function edit job type

 	public function add_new_vjob_type($param = NULL){
		
       $data['filename'] = "admin/departments/add_new_vjob_type";
       $data['title'] = "Add New Job Type";
       $dataheader['title']= "Add New Job Type";
	   $sidebardata['module'] = "departments";
	   $sidebardata['child'] = "add_new_vjob_type";
	   if($param ==''){
       	$this->get_layout($data, $dataheader, $sidebardata);
	   }
	   if($param != '' && $param == 'addjobtype'){
		  // echo $param ; die();
		 	$config = array(
					array(
							'field' => 'job_type',
							'label' => 'Job Date',
							'rules' => 'required',
							'errors' => array(
									'required' => 'You must provide Job Type.',
							),
					),
					array(
							'field' => 'dept',
							'label' => 'Department Name',
							'rules' => 'required',
							'errors' => array(
									'required' => 'You must provide a Department Name.',
							),
					)
					
					
					
			);

			$this->form_validation->set_rules($config);
			
			if($this->form_validation->run() == false){ 
			
				$this->get_layout($data, $dataheader, $sidebardata);
			} else{
				$columns['title'] = $this->common->filter("job_type");
				$columns['dep_id'] = $this->common->filter("dept");
				$columns['status'] = '1';
				
				$result['jobadded'] = $this->Sqlmodel->insertRecord("job_type" , $columns);
				if($result['jobadded'] == FALSE){
					$array_msg = array('err'=>'Job Type Not added  , Try again later');
					$this->session->set_flashdata('Error',$array_msg);
					redirect(base_url("admin/departments/job_type"));
				} else{
						$last_id = $columns['dep_id'];
						$array_msg = array('success'=>'Job Type Added Successfully');
						$this->session->set_flashdata('Success',$array_msg);
						redirect(base_url("admin/departments/job_type/$last_id"));
						die();
				}
					
			}  
		  
	  }
 }
 
 /////Client Departments
 public function client_departments(){
		
	   $data['alldept'] = $this->Sqlmodel->getRecords("*", "client_departments", "cdep_id", "ASC");
       $data['filename'] = "admin/departments/clients_department";
       $data['title'] = "Client Departments";
       $dataheader['title']= "Client Departments";
	   $sidebardata['module'] = "departments";
	   $sidebardata['child'] = "client_departments";
	   
	   $this->get_layout($data, $dataheader, $sidebardata);
 	}
	
	public function add_client_departments($param = NULL, $dep_id = NULL){
		//echo $param . $dep_id;  //die();
       $data['filename'] = "admin/departments/add_client_department";
       $data['title'] = "Add Client Department";
       $dataheader['title']= "Add Client Departments";
	   $sidebardata['module'] = "departments";
	   $sidebardata['child'] = "add_client_department";
	    if($param =='' ){
		   $this->get_layout($data, $dataheader, $sidebardata);
     	}
	   
	   if($param !='' && $param == 'adddept'){
			//echo $param . $dep_id . 'add';  die();
			
			$config = array(
					array(
							'field' => 'dept_name',
							'label' => 'Department Name',
							'rules' => 'required',
							'errors' => array(
									'required' => 'You must provide Departments Name.',
							),
					),
					array(
							'field' => 'client_company',
							'label' => 'Client Company',
							'rules' => 'required',
							'errors' => array(
									'required' => 'You must provide a Client Companhy Name. ',
							),
					),
					array(
							'field' => 'email',
							'label' => 'Email',
							'rules' => 'required|valid_email',
							'errors' => array(
									'required' => 'You must provide a Email. ',
							),
					)
			);

			$this->form_validation->set_rules($config);
			
			
			if($this->form_validation->run() == false){
				
			 $this->get_layout($data, $dataheader, $sidebardata);
				
			} else{
				
			    $columns['client_id']=  $this->common->filter("client_company"); 
				$columns['cdep_name'] = $this->common->filter("dept_name");
				$columns['cdep_email'] = $this->common->filter("email");
				
				/// Insert Into  Departments
			
				$result['depadded'] = $this->Sqlmodel->insertRecord("client_departments" , $columns);
				if($result['depadded'] == FALSE){
					$array_msg = array('err'=>'OOPS!  Department  Not Added  , Try Again');
					$this->session->set_flashdata('Error',$array_msg);
					$this->get_layout($data, $dataheader, $sidebardata);
				} else{
					$array_msg = array('success'=>'Department Added Successfully');
					$this->session->set_flashdata('Success',$array_msg);
					
					redirect(base_url("admin/departments/client_departments"));
					die();
				}
				
				
				
				
			}  // end of else form validation 
			
	   } /// end if param == adddept
	   
	   /// Edit Department
	   if($param !='' && $param == 'editdept' && $dep_id !=''){
		   $data['title'] = "Edit Viral Department";
          $dataheader['title']= "Edit Viral Departments";
		   //echo $param . $dep_id . 'edit';  die();
			$where = "`cdep_id` = '$dep_id' ";
			$data['editdept'] = $this->Sqlmodel->getRecords("*", "client_departments", "cdep_id", "ASC", $where);
			if($data['editdept'] == TRUE){
				$this->get_layout($data, $dataheader, $sidebardata);
			} else{
				redirect( base_url("admin/departments/client_departments") );
			}
			
				
	   } /// end if param == edit dept
	   
	   /// Update dept
	   if($param !='' && $param == 'updatedept' && $dep_id !=''){
			//echo $param . $dep_id . 'update'; die();
				//echo "working 1"; die();
				
				$columns['client_id']=  $this->common->filter("client_company"); 
				$columns['cdep_name'] = $this->common->filter("dept_name");
				$columns['cdep_email'] = $this->common->filter("email");
			   /// update Into  Departments
				$condition = "`cdep_id` = '$dep_id'";
				$result['depupdated'] = $this->Sqlmodel->updateRec("client_departments" , $columns , $condition);
				if($result['depupdated'] == FALSE){
					$array_msg = array('err'=>'OOPS!  Department  Not Updated , Try Again');
					$this->session->set_flashdata('Error',$array_msg);
					$this->get_layout($data, $dataheader, $sidebardata);
				} else{
					$array_msg = array('success'=>'Department Updated Successfully');
					$this->session->set_flashdata('Success',$array_msg);
					
					redirect(base_url("admin/departments/client_departments"));
					die();
				}
				
	   } /// end if param == updatedept
	   
	  
 	}

 
}  /// end of class

?>