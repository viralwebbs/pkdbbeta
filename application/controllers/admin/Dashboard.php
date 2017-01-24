<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (APPPATH . "controllers/admin/main.php");
class Dashboard extends Main {

	
	 public function __construct() {
		  parent::__construct();
		 
		}
	
	
	public function index(){
		
		$data['filename'] = "admin/dashboard";
		$data['title']= "Dashboard";
		$dataheader['title']= "Dashboard";
		$sidebardata['module'] = "jobs";
		$sidebardata['child'] = "jobs";
		$this->get_layout($data, $dataheader, $sidebardata);
			
			
	}

}

?>