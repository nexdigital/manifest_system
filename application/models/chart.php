<?php

class Chart extends CI_Model {
	function get_rank_kg($date = false, $limit = false){
		$this->db->select('manifest_data_table.shipper, manifest_data_table.created_date, SUM(manifest_data_table.kg) as "total_kg"');
		$this->db->join('customer_table','customer_table.reference_id = manifest_data_table.shipper');
		$this->db->where('LEFT(manifest_data_table.created_date,7)',$date);
		$this->db->group_by('manifest_data_table.shipper');
		$this->db->order_by('total_kg','desc');
		if($limit) $this->db->limit($limit);

		$get = $this->db->get('manifest_data_table');

		if($get->num_rows() > 0) return $get->result();
		else return FALSE;
	}
}

?>