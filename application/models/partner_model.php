<?php

class Partner_model extends CI_Model {
	
	function get_partner_list() {
		$get = $this->db->get('partner');
		if($get->num_rows() > 0) return $get->result();
		else return false;
	}

}


?>