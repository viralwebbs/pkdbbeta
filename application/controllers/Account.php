<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	 public function __construct() {
		  parent::__construct();
		$this->CI =& get_instance();
        $this->loggedin = $this->session->userdata("loggedin");
    }
	
	public function login()
	{	
		$data['title'] = "Viral Webbs PKDB";
		/*if ($this->input->post('admin')) { 
    		// Set rule for login form and run the form validation
			echo $this->input->post('admin');
			die;
			
		}*/
		
		/*$client = $this->input->post('client');
		
		if($client){
			
			$this->form_validation->set_rules("username","username","required|trim");
			$this->form_validation->set_rules("password","password","required|trim");
			if($this->form_validation->run() == false){
				
				$this->load->view('admin_login',$data);
			} else{
				$pass = $this->common->filter('password');
				$username= $this->common->filter('username');
				$type = "client";
				$result = $this->Sqlmodel->runQuery("SELECT * FROM `client_login` WHERE `username`='{$username}' AND `password`='{$pass}'",1);	
				$login_array = array(
				'username' => $result['username'],
					'clientid' => $result['client_id'],
					'role' => 'client'
				);
				
			}
		} */
		
		$this->form_validation->set_rules("username","username","required|trim");
		$this->form_validation->set_rules("password","password","required|trim");
		$this->form_validation->set_rules("type","type","required|trim");
		$type = $this->common->filter("type");
		if($this->form_validation->run() == false){
			$this->load->view('admin_login',$data);
		}else{
			$pass = $this->common->filter('password');
			$username= $this->common->filter('username');
			$type= $this->common->filter('type');
			if($type == 'employee'){
				$result = $this->Sqlmodel->runQuery("SELECT * FROM `$type` WHERE `username`='{$username}' AND `password`='{$pass}'",1);	
				$login_array = array(
				'username' => $result['username'],
					'employeeid' => $result['emp_id'],
					'role' => 'employee'
				);
			}
			elseif($type == 'department'){
				$result = $this->Sqlmodel->runQuery("SELECT * FROM `$type` WHERE `username`='{$username}' AND `password`='{$pass}'",1);	
				$login_array = array(
					'username' => $result['username'],
					'departmentid' => $result['dep_id'],
					'role' => 'department'
				);
			}
			elseif($type == 'Pk Admin'){
				$result = $this->Sqlmodel->runQuery("SELECT * FROM `user_login` WHERE `username`='{$username}' AND `password`='{$pass}' AND `type` = '{$type}' ",1);
				$login_array = array(
					'username' => $result['username'],
					'adminid' => $result['user_id'],
					'role' => 'admin'
				);	
				
			}
			if($result){
				$type = ($type == "Pk Admin")?('admin'):($type);
				$type = ($type == "employee")?('employee'):($type);
				$type = ($type == "department")?('department'):($type);
				$type = ($type == "client")?('client'):($type);
				$this->session->set_userdata("loggedin",$login_array);
				$this->session->set_flashdata("success","Loggedin Successfully!");
				redirect(base_url($type."/dashboard"));
			}else{
				$this->session->set_flashdata("error","Wrong Username/Password");
				redirect(base_url("account/login"));
			}
		}
	}
	public function logout(){
		
		$this->session->unset_userdata("loggedin");
		redirect(base_url("account/login"));	
	}
	
}

?>