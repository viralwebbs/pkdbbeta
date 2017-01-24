<?PHP 
	class Common{
		
		public function __construct()
		{

			$this->CI =& get_instance();
		}
		
		public function filter($val){
			
			if($val){
				 	$pattern = array('\n\r', '\n', '\r', '\r\n');
					$trimval = trim($this->CI->input->get_post($val));
					$value = $this->CI->db->escape_str($trimval);
					 $replacevalue = str_replace($pattern, "", $value);
					return $replacevalue;
			}else{
				return false;
			}
				
		}
		
		public function checkchild($child,$compare){
			if($child == $compare){
				echo ' class="active"';
				//echo 'active open';
			}
		}
		public function checkModel($module,$compare){
			if($module == $compare){
				echo 'active open';
			}
		}
		public function json($status,$msg,$data){
			
			$array = array('status' => $status,"msg" => $msg,"data" => $data);
			echo json_encode($array);
		}
		public function do_upload($name){
				$exp = explode(".",$_FILES[$name]['name']);
				$imagename = time().'-deal.'.end($exp);
                $config['upload_path']          = 'assets/uploads/';
                $config['allowed_types']        = 'jpeg|jpg|png';
                $config['max_size']             = 2046;
                $config['max_width']            = 2500;
                $config['max_height']           = 2500;
				$config['file_name'] 			= $imagename; 
                $this->CI->load->library('upload', $config);

                if ( ! $this->CI->upload->do_upload($name))
                {
                        $data = array('error' => $this->CI->upload->display_errors());

                }
                else
                {
                        $data = array('upload_data' => $this->CI->upload->data());
                }
				return $data;
        }
		public function msg(){
			
			if($this->CI->session->flashdata("error")){
				echo '<div class="alert alert-danger alert-dismissible fade in">'.$this->CI->session->flashdata("error").'</div>';
			}
			if($this->CI->session->flashdata("success")){
				echo '<div class="alert alert-success alert-dismissible fade in">'.$this->CI->session->flashdata("success").'</div>';
			}
			if($this->CI->session->flashdata("msg")){
				echo '<div class="alert alert-info alert-dismissible fade in">'.$this->CI->session->flashdata("msg").'</div>';
			}
		}
		
		public function calculate($time){
			
			$d = date("Y-m-d h:i:s",$time);
	$start_date = new DateTime($d);
	$since_start = $start_date->diff(new DateTime(date('Y-m-d H:i:s')));
	//echo $since_start->days.' days total<br>';

	if($since_start->y == '0' && $since_start->d == '0' && $since_start->h == '0' && $since_start->i == '0'){
		return $since_start->s.' seconds ago';

	}elseif ($since_start->y == '0' && $since_start->d == '0' && $since_start->h == '0' && $since_start->i !== '0') {
		return $since_start->i.' minutes ago';
	}elseif ($since_start->y == '0' && $since_start->d == '0' && $since_start->h != '0') {
		return $since_start->h.' hours ago';
	}elseif($since_start->y == '0' && $since_start->d != '0'){
		return $since_start->d.' days ago';

	}elseif ($since_start->y != '0') {
		return $since_start->y.' years ago';
	}}
		public function is_loggedin(){
			if($this->CI->session->userdata("loggedin") == false){
				redirect(base_url("account/login"));
			}else{
				return $this->CI->session->userdata("loggedin");
			}
		}

	}

?>