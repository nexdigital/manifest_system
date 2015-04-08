<?php

class Discount extends CI_Model {
	
	function get_list($user_id = null,$status = null) {
		$this->db->select('discount_table.*');
		$this->db->join('manifest_data_table','manifest_data_table.data_id = discount_table.data_id');
		if($user_id != null) $this->db->where('discount_table.user_id',$user_id);
		if($status != null) $this->db->where_in('discount_table.status',$status);
		$get = $this->db->get('discount_table');
		if($get->num_rows() > 0) return $get->result();
		else return false;
	}

	function set($discount) {
		$this->db->insert('discount_table',$discount);
	}

	function update_status($discount_id,$status) {
		$this->db->where('discount_id',$discount_id);
		$this->db->set('status',$status);
		$this->db->update('discount_table');
	}

	function check($data_id,$type,$status = array('Approved','Rejected','Waiting Approval')) {
		$this->db->where('data_id',$data_id);
		$this->db->where('type',$type);
		$this->db->where_in('status',$status);
		$get = $this->db->get('discount_table');
		if($get->num_rows() == 0) return true;
		else return false;
	}

	function get_by_data_id($data_id,$type,$where = array('Approved')) {
		$this->db->where('data_id',$data_id);
		$this->db->where('type',$type);
		$this->db->where_in('status',$status);
		$get = $this->db->get('discount_table');
		if($get->num_rows() > 0) return $get->row();
		else return false;		
	}

	function check_maximum_discount($data_id,$type,$discount) {
		$data = $this->manifest_model->get_by_data_id($data_id);
		switch ($type) {
			case 'rate':
				if($discount <= $data->nt_kurs) return true;
				else return false;
				break;
			case 'value':
				if($discount <= $data->value) return true;
				else return false;
				break;
			case 'total':
				if($discount <= (($data->kg * $data->value) * $data->nt_kurs)) return true;
				else return false;
				break;
		}
	}
}

?>