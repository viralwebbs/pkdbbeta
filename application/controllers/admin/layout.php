<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once (APPPATH . "controllers/admin/layout.php");

class Layout extends Main {

	
	 public function __construct() {
		  parent::__construct();
	}
		function get_layout($data){
			$this->get_head();
			$this->get_header();
			$this->get_sidebar();
			$this->load->view("default",$data);	
			$this->get_footer();
		}
		
	
    
}
?>