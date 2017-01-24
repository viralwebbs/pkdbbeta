<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends CI_Controller {

	
	 public function __construct() {
		  parent::__construct();
        $this->loggedin = $this->session->userdata("loggedin");
    }
	
	
	public function index(){
		
		$data['filename'] = "admin/jobs";
		$data['title']= "Jobs";
		$data['module'] = "jobs";
		$data['child'] = "jobs";
		$this->load->view("default",$data);	
			
	}
	public function add(){
		
		$data['filename'] = "admin/jobs_add";
		$data['title']= "Add a Job";
		$data['module'] = "jobs";
		$data['child'] = "jobs_add";
		$this->load->view("default",$data);	
			
	}

}

?>