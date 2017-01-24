<?PHP 

defined('BASEPATH') OR exit('No direct script access allowed');

class Delete extends CI_Controller {
		
		public function __construct()
		{
			 
       		 parent::__construct();
    
			$this->CI =& get_instance();
		}
		
	
		public function index(){
			 $filename = $this->input->post("filename");
			 $tablename = $this->input->post("tablename");
			 $condition = $this->input->post("condition");
			$result = $this->Sqlmodel->deleteRecord($tablename , $condition);
			return $result;
		
	}
	public function deletefile(){
			 $filename = $this->input->post("filename");
			 $tablename = $this->input->post("tablename");
			 $condition = $this->input->post("condition");
			$result = $this->Sqlmodel->deleteRecord($tablename , $condition);
			if($result == TRUE){
				if(file_exists(FCPATH . "uploads/".$filename)){
					unlink( FCPATH . "uploads/".$filename);  // FCPATH Front Controller Path
				}
			}
			return $result;
		
	}
	
	public function delete(){
			 $filename = $this->input->post("filename");
			 $tablename = $this->input->post("tablename");
			 $condition = $this->input->post("condition");
			$result = $this->Sqlmodel->deleteRecord($tablename , $condition);
			return $result;
		
	}
	
	
	
	
}  //// end of class

?>