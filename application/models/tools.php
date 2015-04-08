<?php

class Tools extends CI_Model {
	
	function get_nt_kurs() {
		$this->db->where('name','nt_kurs');
		$get = $this->db->get('tools_table');
		return $get->row()->value;
	}
	
	function set_nt_kurs($value){
		$this->db->where('name','nt_kurs');
		$this->db->set('value',$value);
		$this->db->update('tools_table');
	}

	function get_usd_kurs() {
		$this->db->where('name','usd_kurs');
		$get = $this->db->get('tools_table');
		return $get->row()->value;
	}

	function set_usd_kurs($value){
		$this->db->where('name','usd_kurs');
		$this->db->set('value',$value);
		$this->db->update('tools_table');
	}

	function get_deadline_days() {
		$this->db->where('name','deadline_days');
		$get = $this->db->get('tools_table');
		return $get->row()->value;		
	}

	function set_deadline_days($value){
		$this->db->where('name','deadline_days');
		$this->db->set('value',$value);
		$this->db->update('tools_table');
	}

	function remove_tags_excel($string) {
		$string = str_ireplace('_x000D_', ' ',$string);
		$string = preg_replace('/[^A-Za-z0-9\-]/', ' ',$string);
		$string = str_ireplace('-', ' ',$string);
		$string = preg_replace('!\s+!', ' ',$string);
		return $string;
	}

	function rounded($num) {
		$exp = explode('.', $num);
		if(is_array($exp) && count($exp) == 2) {
			if(is_numeric($exp[0]) && is_numeric($exp[1])) {
				if(end($exp) >= 1 && end($exp) <= 5) {
					return $exp[0].'.5';
				} else if(end($exp) >= 6 && end($exp) <= 9) {
					return $exp[0] + 1 . '.0';
				}
			} return $num;
		} return $num;
	}
	
	function deadline($days = NULL) {
		$date = strtotime($days . " day");
		return date('Y-m-d', $date);
	}
}

?>