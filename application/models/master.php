<?php

class Master extends CI_Model {
	
	
	#MASTER CURRENCY
	function get_list_currency($currency_type = 'kurs transaction') {
		$get = $this->db->query("select c.*, ct.* from currency_master_table c join currency_master_type_table ct on ct.currency_id = c.currency_id where lower(ct.currency_type) = '".strtolower($currency_type)."'");
		return $get->result();
	}
	function get_currency_value($currency_name,$currency_type) {
		$get = $this->db->query("select c.*, ct.* from currency_master_table c join currency_master_type_table ct on ct.currency_id = c.currency_id where lower(c.currency_name) = '".strtolower($currency_name)."' and lower(ct.currency_type) = '".strtolower($currency_type)."'");
		return $get->row('currency_value');
	}
	#MASTER 

	#MASTER

	#MASTER

}

?>