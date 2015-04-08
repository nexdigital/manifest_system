<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Users
 *
 * This model represents user authentication data. It operates the following tables:
 * - user account data,
 * - user profiles
 *
 * @package	Tank_auth
 * @author	Ilya Konyukhov (http://konyukhov.com/soft/)
 */
class General extends CI_Model
{
	function insert($data)
	{
		$this->db->insert('contact',$data);
	}
	
	function chatInput($data)
	{
		$this->db->insert('chat',$data);
	}
	
	function chatView()
	{
		$this->db->select('*');
		$this->db->from('user_table');
		$this->db->join('chat','chat.user = user_table.user_id');
		$get 	= $this->db->get();
		if($get->num_rows() > 0) return $get->result();
		else return FALSE;
			
		
	}
	
	
}