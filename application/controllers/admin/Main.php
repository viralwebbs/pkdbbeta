<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	
	 public function __construct() {
		  parent::__construct();
		  date_default_timezone_set("Europe/London");
		/*echo "<pre>";
			print_r($this->session->userdata());
			echo "</pre>"; */
		$this->common->is_loggedin();
        $loggedin = $this->loggedin = $this->session->userdata("loggedin");
		$role= $loggedin['role'];
		if($role == 'employee'){
			redirect(base_url($role."/dashboard"));
		} elseif($role == 'department'){
			redirect(base_url($role."/dashboard"));
		} elseif($role == 'admin'){
			$username= $loggedin['username'];
			$adminid= $loggedin['adminid'];
		} else{
		redirect(base_url("account/logout"));
		}
	}
		
		function  get_head($dataheader){
					
					$this->load->view("common/admin_head",$dataheader);
		}
		
		function  get_header(){
			$data=  array();
			$this->load->view("common/admin_header",$data);
		}
		
		function  get_sidebar($sidebardata){
			
			$this->load->view("common/admin_sidebar",$sidebardata);
		}
		
		function  get_footer(){
			$data=  array();
			$this->load->view("common/admin_footer",$data);
		}
		
		function get_layout($data, $dataheader,  $sidebardata){
			//print_r($sidebardata); 
			//print_r($data); die();
			$this->get_head($dataheader);
			$this->get_header();
			$this->get_sidebar($sidebardata);
			$this->load->view("default",$data);	
			$this->get_footer();
		}
		
		function send_email($job_id, $developer_time='', $designer_time ='', $marketing_time =''){
			$emailfields = "`job`.`id` AS jobid , `job`.`job_title`, `job`.`job_desc`, `job`.`comment`,
					`job`.`viral_dept` , `job`.`client_dept` ,`client`.`id` AS cid, 	
					`client`.`client_type`,`client`.`company_name`,`client`.`name`,`department`.`name` AS vdept_name , `department`.`email` AS vdept_email , `client_departments`.`cdep_name`,
					 `client_departments`.`cdep_email`, `job_status`.`status`  ";
				$joinemailtable = array(
						 
						 array(
							'table' => '`client`',
							'condition' => '`job`.`client_id` = `client`.`id` ',
							'type' => '`left`'
						),
						 
						 array(
							'table' => '`department`',
							'condition' => '`job`.`viral_dept` = `department`.`dep_id` ',
							'type' => '`left`'
						),
						 array(
							'table' => '`job_status`',
							'condition' => '`job`.`job_status` = `job_status`.`status_id` ',
							'type' => '`left`'
						) ,
						 array(
							'table' => '`client_departments`',
							'condition' => '`job`.`client_dept` = `client_departments`.`cdep_id` ',
							'type' => '`left`'
						)
				);
				$where = "`job`.`id` = '$job_id'";
								
						$getemaildata  = $this->Sqlmodel->getJoinRecords($emailfields, "job", $where, $joinemailtable);
						foreach( $getemaildata as $rowemail){
							$fromname='viral Webbs';
							
							$jobid=$rowemail['jobid'];
							$job_title= $rowemail['job_title'];
							$job_status=$rowemail['status'];
							$job_dec=$rowemail['job_desc'];
							$comment=$rowemail['comment'];
							
							$vdepname=$rowemail['vdept_name'];
							$vdepemail=$rowemail['vdept_email'];
							
							$cdepname=$rowemail['cdep_name'];
							$cdepemail = $rowemail['cdep_email'];
							
							$client_name=$rowemail['name'];
							$client_company=$rowemail['company_name'];
							$client_type=$rowemail['client_type'];
						}
						
			$emailmsg= $this->allemail->sendmail($fromname, $job_id, $job_title, $job_status, $job_dec, $vdepemail, $cdepemail, 
												$comment, $client_name, $client_company, $client_type, $developer_time, $designer_time, $marketing_time);
						
			return $emailmsg;
		}
		
		//// get ajax request and filter result
		function get_result(){
			 $tablename = $this->input->post("tablename");
			 $fieldname = $this->input->post("fieldname");
			 $condition = $this->input->post("condition");
			 $id = $this->input->post("id");
			
			$types= '';
			$result['types'] = $this->Sqlmodel->get_result_by_id($tablename,$fieldname,$condition,$id);
			$fieldname = explode("," ,$fieldname );
			$fieldname[0];
			$fieldname[1];
			$html = '';
			foreach($result['types'] as $row){
				//$id = $row['id'];
				//$title = $row['title'];
				$html .= '<option value="'.$row[$fieldname[0]].'" > '.$row[$fieldname[1]].'</option>';
			}
			//$param = $tablename . $fieldname  . $condition  . $id ;
			echo  json_encode($html);
			
			//echo  $html;
		}
		
    
}

?>