<?PHP 

defined('BASEPATH') OR exit('No direct script access allowed');

class Functions{
		
		public function __construct()
		{
			$this->CI =& get_instance();
	}
		
	function get_job_by_status($status= '',$archive=''){
		
		if($status){
			$result = $this->CI->Sqlmodel->countRecords("job", "`status`='{$status}' AND `archive`='{$archive}'");
		} else{
			 $result = $this->CI->Sqlmodel->countRecords("job", "`archive`='{$archive}'");
		}
		return $result;
	}
	
	function get_result_by_id($tablename,$fieldname,$condition,$id= 0){
				
				$result = $this->CI->Sqlmodel->get_result_by_id($tablename,$fieldname,$condition,$id);
			
			return $result;
			
		}
		
		
	function getRecords($fields, $table, $sortby, $order, $where){
			if($where){
				$result = $this->CI->Sqlmodel->getRecords($fields, $table, $sortby, $order, $where);
			}
			return $result;
			
	}
	
	
	function DropDown($tablename, $field1,$field2, $condition='', $id='',$match_id='') {    
		echo $match_id ; 
		 $result = $this->CI->Sqlmodel->DropDown($tablename , $field1, $field2,$condition, $id) ;
			
		 	$var="";					
			$options="";			
			$selected="";
			
			$options=$options . "<option value=\"\">Select Options</option>";
		
		
			foreach($result as $row) {		
				 $nodeid  = $row[$field1];
				
					if($match_id == $nodeid )
					$selected="selected";
					else
					$selected=""; 		
				$options .=  "<option $selected value=\"$row[$field1]\">$row[$field2]</option>"; 
			}
			
			
					  
			
			return $options; 

	}
	
	
	
			///Send Email
		function sendMail()
			{
				$config = Array(
			  'protocol' => 'smtp',
			  'smtp_host' => 'ssl://smtp.googlemail.com',
			  'smtp_port' => 465,
			  'smtp_user' => 'touqeerfazal1992@gmail.com', // change it to yours
			  'smtp_pass' => '5950191t', // change it to yours
			  'mailtype' => 'html',
			  'charset' => 'iso-8859-1',
			  'wordwrap' => TRUE
			);
			$CI =& get_instance();

        $CI->load->library('email',$config); 
					$message = 'Testing Email';
					//$this->load->library("email",$config);
				  $this->email->set_newline("\r\n");
				  $this->email->from('touqeerfazal1992@gmail.com'); // change it to yours
				  $this->email->to('zahid@viralwebbs.com');// change it to yours
				  $this->email->subject('Testing Email From Touqeer');
				  $this->email->message($message);
				  if($this->email->send())
				 {
				  echo 'Email sent.';
				 }
				 else
				{
				 show_error($this->email->print_debugger());
				}
			
			}
	
}  //// end of class
?>