<?php

class System extends CI_Model {
	
	function __construct(){
		parent::__construct();
		$this->load->library('user_agent');	
	}
	
	function check_login($username,$password) {
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$get = $this->db->get('user_table');
		if($get->num_rows() > 0) return $get->row();
		else return FALSE;
	}

	function set_session_login($user) {
		$session = array('login'=>TRUE,'user_id'=>$user->user_id,'username'=>$user->username,'user_type'=>$user->type,'time'=>time(), 'ip'=>$this->input->ip_address());
		$this->session->set_userdata($session);
	}

	function remove_session_login() {
		$session = array('login'=>'','user_id'=>'','username'=>'', 'time'=>'', 'ip'=>'');
		$this->session->set_userdata($session);
	}
	
	function set_activity($activity = null){
		$this->db->set('user_id',$this->session->userdata('user_id'));
		$this->db->set('date',date('Y-m-d h:i:s'));
		$this->db->set('ip_address',$this->input->ip_address());
		$this->db->set('browser','<strong>Browser: </strong>'.$this->getBrowser().'<br /><strong>Operating System: </strong>'.$this->getOS().'<br/><br/><br/>'.$_SERVER['HTTP_USER_AGENT']);
		$this->db->set('activity',$activity);
		//$this->db->set('request',(isset($_REQUEST)) ? json_encode($_REQUEST) : null);
		$this->db->insert('activity_user_table');
	}
	
	function set_all_activity_log($activity = null){
		$this->db->set('user_id',$this->session->userdata('user_id'));
		$this->db->set('date',date('Y-m-d h:i:s'));
		$this->db->set('ip_address',$this->input->ip_address());
		$this->db->set('browser','<strong>Browser: </strong>'.$this->getBrowser().'<br /><strong>Operating System: </strong>'.$this->getOS().'<br/><br/><br/>'.$_SERVER['HTTP_USER_AGENT']);
		$this->db->set('url',$this->uri->uri_string());
		$this->db->set('request',(isset($_REQUEST)) ? json_encode($_REQUEST) : null);
		$this->db->insert('all_activity_log');
	}

	function get_cell_key($key,$array) {
		$string = array_search($key,$array);
		preg_match_all('!\d+!', $string, $result);
		if(isset($result[0][0])) return $result[0][0];		
		else return false;
	}
	
	function getOS() { 

	    $user_agent     =   $_SERVER['HTTP_USER_AGENT'];
	
	    $os_platform    =   "Unknown OS Platform";
	
	    $os_array       =   array(
	                            '/windows nt 10/i'     =>  'Windows 10',
	                            '/windows nt 6.3/i'     =>  'Windows 8.1',
	                            '/windows nt 6.2/i'     =>  'Windows 8',
	                            '/windows nt 6.1/i'     =>  'Windows 7',
	                            '/windows nt 6.0/i'     =>  'Windows Vista',
	                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
	                            '/windows nt 5.1/i'     =>  'Windows XP',
	                            '/windows xp/i'         =>  'Windows XP',
	                            '/windows nt 5.0/i'     =>  'Windows 2000',
	                            '/windows me/i'         =>  'Windows ME',
	                            '/win98/i'              =>  'Windows 98',
	                            '/win95/i'              =>  'Windows 95',
	                            '/win16/i'              =>  'Windows 3.11',
	                            '/macintosh|mac os x/i' =>  'Mac OS X',
	                            '/mac_powerpc/i'        =>  'Mac OS 9',
	                            '/linux/i'              =>  'Linux',
	                            '/ubuntu/i'             =>  'Ubuntu',
	                            '/iphone/i'             =>  'iPhone',
	                            '/ipod/i'               =>  'iPod',
	                            '/ipad/i'               =>  'iPad',
	                            '/android/i'            =>  'Android',
	                            '/blackberry/i'         =>  'BlackBerry',
	                            '/webos/i'              =>  'Mobile'
	                        );
	
	    foreach ($os_array as $regex => $value) { 
	
	        if (preg_match($regex, $user_agent)) {
	            $os_platform    =   $value;
	        }
	
	    }   
	
	    return $os_platform;
	
	}
	
	function getBrowser() {
	
	    $user_agent     =   $_SERVER['HTTP_USER_AGENT'];
	
	    $browser        =   "Unknown Browser";
	
	    $browser_array  =   array(
	                            '/msie/i'       =>  'Internet Explorer',
	                            '/firefox/i'    =>  'Firefox',
	                            '/safari/i'     =>  'Safari',
	                            '/chrome/i'     =>  'Chrome',
	                            '/opera/i'      =>  'Opera',
	                            '/netscape/i'   =>  'Netscape',
	                            '/maxthon/i'    =>  'Maxthon',
	                            '/konqueror/i'  =>  'Konqueror',
	                            '/mobile/i'     =>  'Handheld Browser'
	                        );
	
	    foreach ($browser_array as $regex => $value) { 
	
	        if (preg_match($regex, $user_agent)) {
	            $browser    =   $value;
	        }
	
	    }
	
	    return $browser;
	
	}

}

?>