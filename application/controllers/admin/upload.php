<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

	 public function __construct() {
		  parent::__construct();
		   ini_set( 'memory_limit', '100000000M' );
			ini_set('upload_max_filesize', '1000000M');  
			ini_set('post_max_size', '1000000M');  
			ini_set('max_input_time', 3600000000);  
			ini_set('max_execution_time', 360000000);
		 
    }
	
	function index($job_id = NULL, $client_id = NULL){
		
		
			// Image Uploading
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|xlsx|xls|psd|zip|sql';
			$config['max_size']	= '100000000';
			$config['detect_mime']  = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$this->upload->initialize($config);
			//echo '<pre>';
			//print_r( $_FILES);
			//echo '</pre>';
			$file= $_FILES['file']['name'];
			if(isset($file)){
				if ( ! $this->upload->do_upload('file')) {
					 $error = array('error' => $this->upload->display_errors());
					//echo '<pre>';  print_r($error); echo '</pre>';
					 //die();
					$array_msg = array('fileerror'=>'File Not Uploaded');
					$this->session->set_flashdata('Fileerr',$array_msg);
					
				} else {
					$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
					echo '<pre>'; print_r($this->upload->data()); echo '</pre>';
					//die();
					$filename = $this->upload->data('file_name');
					$data = array('upload_data' => $this->upload->data());
					///inser into upload
					$fields['job_id'] = $job_id;
					$fields['client_id'] = $client_id;
					 $fields['file_name'] = $filename;
					 $fields['i'] = $job_id;
					$fields['type'] = "Admin";
					$fields['fileuploaded'] = $this->Sqlmodel->insertRecord("upload" , $fields);
					
					$array_msg = array('filesuccess'=>'File Uploaded');
					$this->session->set_flashdata('File',$array_msg);
					//redirect( base_url("admin/jobs/detail/$job_id/$client_id"));
					//die();
				}
				
				
			} /// end of file
			
		
	}
				
} // end of class
