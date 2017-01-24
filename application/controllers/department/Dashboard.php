<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	
	 public function __construct() {
		 parent::__construct();
       
		$this->common->is_loggedin();
		
        $loggedin = $this->loggedin = $this->session->userdata("loggedin");
		$role= $loggedin['role'];
		if($role == 'employee'){
			redirect(base_url($role."/dashboard"));
		} elseif($role == 'department'){
			$username= $loggedin['username'];
			$departmentid= $loggedin['departmentid'];	
		} elseif($role == 'admin'){
			redirect(base_url($role."/dashboard"));
		} else{
		redirect(base_url("account/logout"));
		}
    }
	
	
	public function index(){
		
		$data['filename'] = "department/dashboard";
		$data['title']= "Dashboard";
		$data['module'] = "jobs";
		$data['child'] = "jobs";
		$this->load->view("default",$data);	
			
	}

}

?>