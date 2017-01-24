<?php

class Sqlmodel extends CI_Model {

	private $table;

    public function __construct(){
	     // Call the Model constructor
	   parent::__construct();

    }

	
	/****************************** Start General Functions ***********************/
	
	//insert function 
	function insertRecord($table , $columns)
	{
		
		if($this->db->insert($table , $columns))
		
		return $this->db->insert_id();
		else
		return false;
		
		/*echo $this->db->last_query();
		die();*/
	}
	
	//update function
	function updateRecord($table , $colums , $condition)
	{
		if($this->db->update($table , $colums , $condition))
		return true;
		else
		return false;
	}
	
	// delete function 
	function deleteRecord($table , $condition)
	{
		if($this->db->delete($table , $condition))
		{
		//echo $this->db->last_query();
		return TRUE;
		}
		else
		{
		return FALSE;
		}
	}
	
	function runQuery($sql, $flag='')
	{
		$this->result = $this->db->query($sql);
		if($this->result->num_rows() >0){
			if($flag)
				return  $this->result->row_array();
			else
				return $this->result->result_array();
		}else{
			return false;	
		}
	}
	
	public function insertRec($table, $data)
	{
		
		$q = $this->db->insert($table, $data);
		if (!$q) {
		  // if query returns null
		  $msg = $this->db->_error_message();
		  $num = $this->db->_error_number();
		  return FALSE;
		}
		else{
			return $this->db->insert_id();
		}
	}
	
	public function updateRec($table, $data, $where)
	{	$this->db->where($where);
		$q = $this->db->update($table, $data);	
		if (!$q) {
		  // if query returns null
		  $msg = $this->db->_error_message();
		  $num = $this->db->_error_number();
		  return FALSE;
		}
		return TRUE;
				
	}
	
	public function getSingleRecord($table, $where)
	{
	
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);	
		$count = $this->db->count_all_results();
		if($count=="1")
		{
		$query = $this->db->get_where($table, $where);
		$data=$query->row_array();
		return $data;
		}
		else{
		return null;	
		}
	}
	
	public function getSingleField($col, $table, $where)
	{
		$this->db->select($col);
		$this->db->from($table);
			$this->db->where($where);	
		$query = $this->db->get();
		$data = $query->row_array();
		//echo $this->db->last_query(); 
		if(isset($data))
		{
			//echo $data[$col]; die();
		return $data;
		}
		else{
		return null;	
		}
	}
	
	public function getRecords($fields, $table, $sortby="", $order="", $where="", $limit="0", $start="")
	{
	
		$this->db->select($fields);
		$this->db->from($table);
		if(!empty($where))
		{
		$this->db->where($where);	
		}
		if($sortby!="" && $order!="")
		{
		$this->db->order_by($sortby,$order);
		}
		
		if($limit!=0)
		{
			$this->db->limit($limit, $start);
			
		}
		
		$query = $this->db->get();
		//echo $this->db->last_query(); die();
		$data=$query->result_array();
		
		return $data;
		
	}
	
	public function getJoinRecords($fields = '', $table='',  $where="",$jointable='',$sortby="", $order="",$groupby='',$limit="0", $start="")
	{
		if($fields != ''){
			$this->db->select($fields);
		} else{
			$this->db->select("*");
		}
		if($table != ''){
			$this->db->from($table);
		}
		
		if(!empty($where))
		{
		$this->db->where($where);	
		}
		
		
		if($jointable!='')
		{
			foreach($jointable as $key){
			//print_r($key);
			$tablejoin = $key['table'];
			$joincondition = $key['condition'];
			 $jointype = $key['type']; 
			
			$this->db->join($tablejoin, $joincondition, "left");
			}
			
			
		}
		if($sortby!="" && $order!="")
		{
		$this->db->order_by($sortby,$order);
		}
		
		if($sortby!="" && $order!="")
		{
		$this->db->order_by($sortby,$order);
		}
		//die();
		if($groupby!='')
		{
			$this->db->group_by($groupby);
			
		}
		if($limit!=0)
		{
			$this->db->limit($limit, $start);
			
		}
		$query = $this->db->get();
		//echo $this->db->last_query(); die();
		$data=$query->result_array();
		
		return $data;
		
	}
	
	
	public function countRecords($table, $where=array())
	{
	$this->db->select('*');
	$this->db->from($table);
	if(!empty($where))
	{
	$this->db->where($where);	
	}
	$records = $this->db->count_all_results();
	return $records;	
	}
	
	public function checkCookie()
	{
		if(isset($_COOKIE['dstacklog'])&&$_COOKIE['dstacklog']!="")
		{
			$id = $this->encrypt->decode($_COOKIE['dstacklog']);
			$user_data = $this->getUserDataById($id);
			if(!empty($user_data))
			{	
			$this->session->set_userdata('user_id',$user_data['id']);
			$this->session->set_userdata('fb_uid',$user_data['fb_uid']);
			$this->session->set_userdata('email',$user_data['email']);
			$this->session->set_userdata('full_name',$user_data['full_name']);
			$this->session->set_userdata('role', $user_data['user_role']);
			$this->session->set_userdata('auth', '1');
			redirect(base_url().'home','location');	
			}
			else{
			return;	
			}
		}
		else
		{
		return;	
		}
	}
	
	public function truncate($table="")
	{
		if($table=="")
		{
		return;
		}
		if($this->db->truncate($table))
		{
			return true;	
		}
		else{
			return false;
		}
	}
	
	public function seourl($rstring="")
	{
		$string = preg_replace('/\%/',' percentage',$rstring);
		$string = preg_replace('/\@/',' at ',$string);
		$string = preg_replace('/\&/',' and ',$string);
		$string = preg_replace("/\'/","",$string);
		$string = str_replace("\\","",$string);
		$string = preg_replace('/\s[\s]+/','-',$string);    // Strip off multiple spaces
		$string = preg_replace('/[\s\W]+/','-',$string);    // Strip off spaces and non-alpha-numeric
		$string = preg_replace('/^[\-]+/','',$string); // Strip off the starting hyphens
		$string = preg_replace('/[\-]+$/','',$string); // // Strip off the ending hyphens
		$string = strtolower($string);
		$string = str_replace(" ","-",$string);
		return $string;
	}
	
	public function getmsg($user_id="")
	{
		
		
	$msg_query = "SELECT 
  m.`msg_con_id`,
  m.`msg_dt`,
  m.`msg_from`,
  m.`msg_from_read`,
  m.`msg_id`,
  m.`msg_to`,
  m.`msg_to_read`,
  u.`first_name`,
  u.`last_name`,
  u.`profile_image`,
  (SELECT 
    msg_text 
  FROM
    messages 
  WHERE msg_from = m.msg_from 
  ORDER BY msg_dt DESC 
  LIMIT 1) AS msg_text 
FROM
  messages AS m 
  INNER JOIN site_users AS u 
    ON m.`msg_from` = u.`user_id` 
WHERE m.msg_to = '".$this->session->userdata('user_id')."' AND m.msg_to_read='No' 
GROUP BY msg_from,
  m.msg_to 
ORDER BY msg_dt DESC 
LIMIT 20 ";
		$msgs = $this->runQuery($msg_query);
		$total_new = count($msgs);
		$messages = array('total_new'=>$total_new,'data'=>$msgs);
		return $messages;
	}

	/****************************** End General Functions ***********************/
	
	//Function for notifications
	public function noti($from_id="", $to_id="",$type="",$group_id=0,$wall_post_id=0,$like_type="")
	{
		$noti = $this->SqlModel->getSingleField('notifications','site_users',array('user_id'=>$to_id));
		if($noti=="Yes")
		{
			$noti_data = array(
			'noti_type'			=>	$type,
			'noti_to_user_id'	=>	$to_id,
			'noti_wall_post_id'	=>	$wall_post_id ,
			'noti_from_user_id'	=>	$from_id,
			'noti_like_type'	=>	$like_type,
			'noti_group_id'		=>	$group_id,
			'noti_read'			=>	'No',
			'noti_dt'			=>	date('Y-m-d H:i:s')
			);
			$q = $this->SqlModel->insertRecord('notifications',$noti_data);
			if($q>0)
			{
				
				return $q;	
			}
			else{
				return false;	
			}
		}
	}
	
	//For getting freidns ID
	public function getFriends($user_id=0)
	{
		$this->db->select('f_to')->from('friends')->where(array('f_from'=>$user_id,'f_status'=>'Accept'));
		$query = $this->db->get();
		$data=$query->result_array();
		return $data;	
		
	}
	
	public function notiData($noti_id=0)
	{
		$listing = "SELECT n.*,u.user_uri,u.`first_name`,u.`last_name`,u.`profile_image`,u.`thumb_image` FROM  notifications AS n INNER JOIN site_users AS u ON n.`noti_from_user_id` = u.user_id  WHERE  n.noti_id='".$noti_id."'";
		
		$query=$this->db->query($listing);
		$data=$query->result_array();
		//print_r($data);
		$k=0;
		$d = $data[0];
		if(!empty($d))
		{
				if($d['noti_type']=="Comment")
				{
					$p = "";
					$post = $this->SqlModel->getSingleRecord('wall_posts',array('wall_post_id'=>$d['noti_wall_post_id']));
					if($post['type']=="text")
					{
						$p = substr($post['post_description'],0,10).'...';
						$type = "status";	
					}
					else if($post['type']=="video")
					{
						$p = substr($post['post_title'],0,10).'...';
						$type = "video";
					}
					else if($post['type']=="link")
					{
						$p = substr($post['post_title'],0,10).'...';
						$type = "link";
					}
					else if($post['type']=="image")
					{	
						if($post['post_description']!="")
						{
						$p = substr($post['post_description'],0,10).'...';
						}
						$type = "photo";
					}
					if($p!="")
					{
					$data[$k]['notification'] = $d['first_name']. ' '.$d['last_name']. ' commented on your "'.$p.'" '.$type;
					}
					else{
					$data[$k]['notification'] = $d['first_name']. ' '.$d['last_name']. ' commented on your '.$type;	
					}
					$data[$k]['link'] = base_url().'profile/view/'.$this->SqlModel->getSingleField('user_uri','site_users',array('user_id'=>$d['noti_to_user_id']));
				}
				else if($d['noti_type']=="FriendAccept")
				{
					$data[$k]['notification'] = $d['first_name']. ' '.$d['last_name']. ' accept your friend request';
					$data[$k]['link'] = base_url().'friends';
				}
				else if($d['noti_type']=="FriendInv")
				{
					$data[$k]['notification'] = $d['first_name']. ' '.$d['last_name']. ' sent you friend request';
					$data[$k]['link'] = base_url().'friends/invitation';
				}
				else if($d['noti_type']=="Invite")
				{
					$data[$k]['notification'] = $d['first_name']. ' '.$d['last_name']. ' invite you to join "'.$this->SqlModel->getSingleField('group_name','groups',array('group_id'=>$d['noti_group_id'])).'" group';
					$data[$k]['link'] = base_url().'groups/invites';
				}
				else if($d['noti_type']=="Like")
				{
					$p = "";
					$post = $this->SqlModel->getSingleRecord('wall_posts',array('wall_post_id'=>$d['noti_wall_post_id']));
					if($post['type']=="text")
					{
						$p = substr($post['post_description'],0,10).'...';
						$type = "status";	
					}
					else if($post['type']=="video")
					{
						$p = substr($post['post_title'],0,10).'...';
						$type = "video";
					}
					else if($post['type']=="link")
					{
						$p = substr($post['post_title'],0,10).'...';
						$type = "link";
					}
					else if($post['type']=="image")
					{	
						if($post['post_description']!="")
						{
						$p = substr($post['post_description'],0,10).'...';
						}
						$type = "photo";
					}
					if($p!="")
					{
						 $data[$k]['notification'] = $d['first_name']. ' '.$d['last_name']. ' like your "'.$p.'" '.$type.' for '.$d['noti_like_type'];
					}
					else{
						$data[$k]['notification'] = $d['first_name']. ' '.$d['last_name']. ' like your '.$type.' for '.$d['noti_like_type'];	
					}
					$data[$k]['link'] = base_url().'profile/view/'.$this->SqlModel->getSingleField('user_uri','site_users',array('user_id'=>$d['noti_to_user_id']));
				}
				else if($d['noti_type']=="Text")
				{
					$post = $this->SqlModel->getSingleRecord('wall_posts',array('wall_post_id'=>$d['noti_wall_post_id']));
					$p = substr($post['post_description'],0,10).'...';
					$type = "status";
					$data[$k]['notification'] = $d['first_name']. ' '.$d['last_name']. ' post "'.$p.'" '.$type;
					$data[$k]['link'] = base_url().'profile/view/'.$d['user_uri'];
				}
				else if($d['noti_type']=="Video")
				{
					$post = $this->SqlModel->getSingleRecord('wall_posts',array('wall_post_id'=>$d['noti_wall_post_id']));
					$p = substr($post['post_title'],0,10).'...';
					$type = "video";
					$data[$k]['notification'] = $d['first_name']. ' '.$d['last_name']. ' post "'.$p.'" '.$type;
					$data[$k]['link'] = base_url().'profile/view/'.$d['user_uri'];
				}
				else if($d['noti_type']=="Link")
				{
					$post = $this->SqlModel->getSingleRecord('wall_posts',array('wall_post_id'=>$d['noti_wall_post_id']));
					$p = substr($post['post_title'],0,10).'...';
					$type = "link";
					$data[$k]['notification'] = $d['first_name']. ' '.$d['last_name']. ' post "'.$p.'" '.$type;
					$data[$k]['link'] = base_url().'profile/view/'.$d['user_uri'];
				}
				else if($d['noti_type']=="Photo")
				{	
					$post = $this->SqlModel->getSingleRecord('wall_posts',array('wall_post_id'=>$d['noti_wall_post_id']));
					$type = "photo";
					if($post['post_description']!="")
					{
					$p = substr($post['post_description'],0,10).'...';
					$data[$k]['notification'] = $d['first_name']. ' '.$d['last_name']. ' post "'.$p.'" '.$type;	
					}
					else{
					$data[$k]['notification'] = $d['first_name']. ' '.$d['last_name']. ' post '.$type;		
					}
					$data[$k]['link'] = base_url().'profile/view/'.$d['user_uri'];
				}
			//Calculate duration 	
			$datetime = new DateTime($d['noti_dt']);
			$now = new DateTime();
			$time = $now->diff($datetime, true);
			$duration ="";
				if($time->days!=0)
				{
					if($time->days==1)
					{
					$duration.= $time->days ." day ";
					}
					else{
					$duration.= $time->days ." days ";	
					}
				}
				
				if($time->days<1)
				{
									
					if($time->h!=0)
					{
						if($time->h==1)
						{
						$duration.= $time->h ." hour ";
						}
						else{
						$duration.= $time->h ." hours ";	
						}
					}
				
				if($time->h==0)
				{
					if($time->i!=0)
					{
						if($time->i==1)
						{
						$duration.= $time->i ." minute ";
						}
						else{
						$duration.= $time->i ." minutes ";	
						}
					}
					
					if($time->i==0)
					{
						if($time->s!=0)
						{
							if($time->s==1)
							{
							$duration.= $time->s ." second ";
							}
							else{
							$duration.= $time->s ." seconds ";	
							}
						}
					}
				}
			}
			$duration.="ago";	
			$data[$k]['duration'] = $duration;
			
		}
		
		return $data;
		
	}
	
	public function countNotiRecords($user_id=0)
	{
		$listing = "SELECT count(*) as cnt FROM  notifications AS n INNER JOIN site_users AS u ON n.`noti_from_user_id` = u.user_id  WHERE n.noti_to_user_id='".$user_id."'";
		$cnt = $this->runQuery($listing,1);
		return $cnt['cnt'];
	}
	
	public function getNoti($user_id=0,$limit=10,$start=0,$rtype="web")
	{
		if($rtype=="web")
		{
		$listing = "SELECT n.*,u.user_uri,u.`first_name`,u.`last_name`,u.`profile_image`,u.`thumb_image` FROM  notifications AS n INNER JOIN site_users AS u ON n.`noti_from_user_id` = u.user_id  WHERE n.noti_to_user_id='".$user_id."' ORDER BY  noti_dt DESC ";
		}
		else{
		$listing = "SELECT n.*,u.user_uri,u.`first_name`,u.`last_name`,CONCAT('".base_url()."images/source/',IF(u.`profile_image` IS NULL,'default_profile.jpg',u.`profile_image`)) as profile_image,CONCAT('".base_url()."images/source/',IF(u.`thumb_image` IS NULL,'default_profile_80x80.jpg',u.`thumb_image`)) as thumb_image FROM  notifications AS n INNER JOIN site_users AS u ON n.`noti_from_user_id` = u.user_id  WHERE n.noti_to_user_id='".$user_id."' ORDER BY  noti_dt DESC ";
		}
		
		if($limit!=0)
		{
			$listing.= " LIMIT ".$start.",".$limit;
		}
		$query=$this->db->query($listing);
		$data=$query->result_array();
		
		if(!empty($data))
		{
			foreach($data as $k=>$d)
			{
				if($d['noti_type']=="Comment")
				{
					$p = "";
					$post = $this->SqlModel->getSingleRecord('wall_posts',array('wall_post_id'=>$d['noti_wall_post_id']));
					if($post['type']=="text")
					{
						$p = substr($post['post_description'],0,10).'...';
						$type = "status";	
					}
					else if($post['type']=="video")
					{
						$p = substr($post['post_title'],0,10).'...';
						$type = "video";
					}
					else if($post['type']=="link")
					{
						$p = substr($post['post_title'],0,10).'...';
						$type = "link";
					}
					else if($post['type']=="image")
					{	
						if($post['post_description']!="")
						{
						$p = substr($post['post_description'],0,10).'...';
						}
						$type = "photo";
					}
					if($p!="")
					{
					$data[$k]['notification'] = '<strong>'.$d['first_name']. ' '.$d['last_name']. '</strong> commented on your "'.$p.'" '.$type;
					}
					else{
					$data[$k]['notification'] = '<strong>'.$d['first_name']. ' '.$d['last_name']. '</strong> commented on your '.$type;	
					}
					$data[$k]['link'] = base_url().'profile/view/'.$this->SqlModel->getSingleField('user_uri','site_users',array('user_id'=>$d['noti_to_user_id']));
				}
				else if($d['noti_type']=="FriendAccept")
				{
					$data[$k]['notification'] = '<strong>'.$d['first_name']. ' '.$d['last_name']. '</strong> accept your friend request';
					$data[$k]['link'] = base_url().'friends';
				}
				else if($d['noti_type']=="FriendInv")
				{
					$data[$k]['notification'] = '<strong>'.$d['first_name']. ' '.$d['last_name']. '</strong> sent you friend request';
					$data[$k]['link'] = base_url().'friends/invitation';
				}
				else if($d['noti_type']=="Invite")
				{
					$data[$k]['notification'] = '<strong>'.$d['first_name']. ' '.$d['last_name']. '</strong> invite you to join "'.$this->SqlModel->getSingleField('group_name','groups',array('group_id'=>$d['noti_group_id'])).'" group';
					$data[$k]['link'] = base_url().'groups/invites';
				}
				else if($d['noti_type']=="Like")
				{
					$p = "";
					$post = $this->SqlModel->getSingleRecord('wall_posts',array('wall_post_id'=>$d['noti_wall_post_id']));
					if($post['type']=="text")
					{
						$p = substr($post['post_description'],0,10).'...';
						$type = "status";	
					}
					else if($post['type']=="video")
					{
						$p = substr($post['post_title'],0,10).'...';
						$type = "video";
					}
					else if($post['type']=="link")
					{
						$p = substr($post['post_title'],0,10).'...';
						$type = "link";
					}
					else if($post['type']=="image")
					{	
						if($post['post_description']!="")
						{
						$p = substr($post['post_description'],0,10).'...';
						}
						$type = "photo";
					}
					if($p!="")
					{
						 $data[$k]['notification'] = '<strong>'.$d['first_name']. ' '.$d['last_name']. '</strong> like your "'.$p.'" '.$type.' for '.$d['noti_like_type'];
					}
					else{
						$data[$k]['notification'] = '<strong>'.$d['first_name']. ' '.$d['last_name']. '</strong> like your '.$type.' for '.$d['noti_like_type'];	
					}
					$data[$k]['link'] = base_url().'profile/view/'.$this->SqlModel->getSingleField('user_uri','site_users',array('user_id'=>$d['noti_to_user_id']));
				}
				else if($d['noti_type']=="Text")
				{
					$post = $this->SqlModel->getSingleRecord('wall_posts',array('wall_post_id'=>$d['noti_wall_post_id']));
					$p = substr($post['post_description'],0,10).'...';
					$type = "status";
					$data[$k]['notification'] = '<strong>'.$d['first_name']. ' '.$d['last_name']. '</strong> post "'.$p.'" '.$type;
					$data[$k]['link'] = base_url().'profile/view/'.$d['user_uri'];
				}
				else if($d['noti_type']=="Video")
				{
					$post = $this->SqlModel->getSingleRecord('wall_posts',array('wall_post_id'=>$d['noti_wall_post_id']));
					$p = substr($post['post_title'],0,10).'...';
					$type = "video";
					$data[$k]['notification'] = '<strong>'.$d['first_name']. ' '.$d['last_name']. '</strong> post "'.$p.'" '.$type;
					$data[$k]['link'] = base_url().'profile/view/'.$d['user_uri'];
				}
				else if($d['noti_type']=="Link")
				{
					$post = $this->SqlModel->getSingleRecord('wall_posts',array('wall_post_id'=>$d['noti_wall_post_id']));
					$p = substr($post['post_title'],0,10).'...';
					$type = "link";
					$data[$k]['notification'] = '<strong>'.$d['first_name']. ' '.$d['last_name']. '</strong> post "'.$p.'" '.$type;
					$data[$k]['link'] = base_url().'profile/view/'.$d['user_uri'];
				}
				else if($d['noti_type']=="Photo")
				{	
					$post = $this->SqlModel->getSingleRecord('wall_posts',array('wall_post_id'=>$d['noti_wall_post_id']));
					$type = "photo";
					if($post['post_description']!="")
					{
					$p = substr($post['post_description'],0,10).'...';
					$data[$k]['notification'] = '<strong>'.$d['first_name']. ' '.$d['last_name']. '</strong> post "'.$p.'" '.$type;	
					}
					else{
					$data[$k]['notification'] = '<strong>'.$d['first_name']. ' '.$d['last_name']. '</strong> post '.$type;		
					}
					$data[$k]['link'] = base_url().'profile/view/'.$d['user_uri'];
				}
			//Calculate duration 	
			$datetime = new DateTime($d['noti_dt']);
			$now = new DateTime();
			$time = $now->diff($datetime, true);
			$duration ="";
				if($time->days!=0)
				{
					if($time->days==1)
					{
					$duration.= $time->days ." day ";
					}
					else{
					$duration.= $time->days ." days ";	
					}
				}
				
				if($time->days<1)
				{
									
					if($time->h!=0)
					{
						if($time->h==1)
						{
						$duration.= $time->h ." hour ";
						}
						else{
						$duration.= $time->h ." hours ";	
						}
					}
				
				if($time->h==0)
				{
					if($time->i!=0)
					{
						if($time->i==1)
						{
						$duration.= $time->i ." minute ";
						}
						else{
						$duration.= $time->i ." minutes ";	
						}
					}
					
					if($time->i==0)
					{
						if($time->s!=0)
						{
							if($time->s==1)
							{
							$duration.= $time->s ." second ";
							}
							else{
							$duration.= $time->s ." seconds ";	
							}
						}
					}
				}
			}
			$duration.="ago";	
			$data[$k]['duration'] = $duration;
			//Calculate duration
				if($rtype=="phone")
				{
				 $data[$k]['notification'] = strip_tags($data[$k]['notification']);	
				}
			}
		}
		return $data;
		
	}
	
	
	//For getting order data
	public function getOrder($order_id=0)
	{
		$oquery = "SELECT o.*,u.`first_name`,u.`last_name`,u.`user_id`,u.`email` FROM orders AS o INNER JOIN site_users AS u ON o.`order_user_id`=u.`user_id` WHERE order_id='".$order_id."'";
		$odquery_result = $this->db->query($oquery);
		$order_data = $odquery_result->row_array();
		return $order_data;
	}

	//For getting order details
	public function getOrderDetails($order_id=0)
	{
		$odquery = "SELECT * FROM order_details WHERE od_order_id='".$order_id."'";
		$odquery_result = $this->db->query($odquery);
		$order_details = $odquery_result->result_array();	
		return $order_details;
	}
	
	/// Send Push Notification
    function push($device_id,$device_type,$message) {
	
		if($device_id=="" || $device_type=="" || $message=="")
		{
			return;	
		}
        if($device_type == 'iOS') { // iphone notification

            // load library
            $this->load->library('apn');
            $this->apn->payloadMethod = 'enhance'; // you can turn on this method for debuggin purpose
            $this->apn->connectToPush();
            //$params = array_merge($params,array('sound' => $user->ringtone));
            // adding custom variables to the notification
            $this->apn->setData($params);
            $send_result = $this->apn->sendMessage(trim($device_id), $message, /*badge*/ 0, /*sound*/ /*$user->ringtone*/ 'default' );

            $this->apn->disconnectPush();
			//v($this->apn->disconnectPush());
        } else  if($device_type=="Android"){ // andriod notification
            // simple loading
            // note: you have to specify API key in config before
            $this->load->library('gcm');
            // simple adding message. You can also add message in the data,
            // but if you specified it with setMesage() already
            // then setMessage's messages will have bigger priority
            $this->gcm->setMessage($message);
            // add recepient or few
            $this->gcm->addRecepient($device_id);

            // set additional data\
            $this->gcm->setData($params);
            // also you can add time to live
            $this->gcm->setTtl(500);
            // and unset in further
            //$this->gcm->setTtl(false);
            // set group for messages if needed
            //$this->gcm->setGroup('Test');
            // or set to default
            //$this->gcm->setGroup(false);
            // send
        	 if($this->gcm->send()){
                //echo "sent";
            }else{
               // echo "Not send";   
            }
			$this->gcm->status;
			$this->gcm->messagesStatuses;
			//print_r($this->gcm->status);
			//print_r($this->gcm->messagesStatuses);
        }
    }
	
	//For gettingjob type
	public function get_result_by_id($tablename,$fieldname='',$condition='',$id= '')
	{
		
			if($fieldname==''){
				$this->db->select("*");
			} else{
				$this->db->select($fieldname);
			}
			if($id !=''){
				$this->db->where($condition,$id);
			} else{
				$this->db->where($condition);
			}
			$result = $this->db->get($tablename);
			
			//echo $this->db->last_query(); die();
			
			$data=$result->result_array();
			
			return $data;
			
		
	}
	
	//// Function Drop Down
	function DropDown($tablename= '', $field1 = '', $field2 = '', $condition= '', $id='' ) {     
			
			
			if($field1){
				$this->db->select($field1);
			}
			if($field2){
				$this->db->select($field2);
			}
				
			
			if($id){
				$this->db->where($condition,$id);
			} 
			//$this->db->order_by($id,"ASC");
			
			$result = $this->db->get($tablename);
			
			//echo $this->db->last_query(); die();
			
			$data=$result->result_array();
			
			return $data;
		
	}
	

} /// End Of Class

?>