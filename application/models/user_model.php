<?php

class User_model extends CI_Model {

	function get_list() {
		$get = $this->db->get('user_table');
		return $get->result();
	}

	function get_by_id($user_id){
		$this->db->where('user_id',$user_id);
		$get = $this->db->get('user_table');
		if($get->num_rows() > 0) return $get->row();
		else return FALSE;
	}

	function check_username($username) {
		$this->db->where('LOWER(username)',strtolower($username));
		$get = $this->db->get('user_table');
		if($get->num_rows() == 0) return TRUE;
		else return FALSE;
	}

	function create_user($username,$password) {
		$this->db->set('user_id','USR' . $this->create_user_id());
		$this->db->set('username',$username);
		$this->db->set('password',$password);
		$this->db->set('type','User');
		$this->db->set('created_date',date('Y-m-d h:i:s'));
		$this->db->set('last_activity',date('Y-m-d h:i:s'));
		$this->db->insert('user_table');
	}

	function edit_user($user_id,$data) {
		$this->db->where('user_id',$user_id);
		$this->db->update('user_table',$data);
	}

	function delete_user($user_id) {
		$this->db->where('user_id',$user_id);
		$this->db->delete('user_table');
	}

	function create_user_id(){
		$get = $this->db->count_all('user_table');
		$get = $get + 1;
		$len = strlen($get);
		switch ($len) {
			case '1': return '0000' . $get; break;
			case '2': return '000' . $get; break;
			case '3': return '00' . $get; break;
			case '4': return '0' . $get; break;			
			default: return $get; break;
		}
	}

  
}


?>