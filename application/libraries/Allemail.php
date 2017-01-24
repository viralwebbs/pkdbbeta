<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Allemail  {
	
	public function __construct(){
			$this->CI =& get_instance();
	}
	
			/// mail  function
		public function sendmail($fromname, $job_id, $job_title, $job_status, $job_dec, $vdepemail, $cdepemail, $comment,$client_name, 
								$client_company,$client_type,$developer_time='',$designer_time= '' ,$marketing_time='' ){
						
						$header  = 'MIME-Version: 1.0' . "\r\n";
						$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$header .= 'From:'.$fromname.'<task@viralwebbs.com>' . "\r\n";
						$header .= "Content-Transfer-Encoding: 7bit\r\n";
						$header .= 'Cc: task@viralwebbs.com' . "\r\n";
						//$header .= 'Cc: touqeerfazal@viralwebbs.com' . "\r\n";
						$header .= 'Bcc:'.$vdepemail."\r\n";
						$header .= "Reply-To:".$fromname."<noreply@viralwebbs.com>\n";
						
						$subject ='Job No'.' '.$job_id.' '.'--'.' '.'Job Title'.' '.$job_title;
						
						$message = "<strong>From ".$fromname." </strong><br /><br/>";
						
						if($developer_time !='' || $designer_time !='' || $marketing_time != ''){
								$message .= "<strong><u>Time Assigned</u></strong><br /><br/>";
								$message .= "<strong>Developers: </strong>".$developer_time."<br />";
								$message .= "<strong>Graphics : </strong>".$designer_time."<br />";
								$message .= "<strong>Marketing : </strong>".$marketing_time."<br /><br/>";	
						}
						$message .= "<strong><u>Client Detail</u></strong><br /><br/>";
						$message .= "<strong>Client Name: </strong>".$client_name."<br />";
						$message .= "<strong>Company Name: </strong>".$client_company."<br />";
						$message .= "<strong>Client Type : </strong>".$client_type."<br /><br/>";
						$message .= "<strong><u>Job Detail</u></strong><br /><br/>";
						$message .= "<strong>Job Title : </strong>".$job_title."<br />";
						$message .= "<strong>Job no : </strong>".$job_id."<br />";
						$message .= "<strong>Status : </strong>".$job_status."<br />";
						$message .= "<strong>Comment :&nbsp; </strong>";
						$message .= "<strong>Job Desc :&nbsp; </strong>";
						$message .= $job_dec;
						$message .= $comment; 
						$message .= "<br /><strong>Best Regards: </strong><br />".$fromname."<br />"; 
						
						////Sending Email
						$sending =mail($cdepemail,$subject,$message, $header);
						if($sending){
							return TRUE;
						} 
						else{
							return FALSE;
						}
						
		} // end of function email
				
				
} // end of class
