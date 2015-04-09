<?php

class Manifest_model extends CI_Model {


	#FILE MANIFEST ->
	function file_new_id(){
		$get = $this->db->count_all('manifest_file_table');
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

	function file_insert_new($file){
		$this->db->insert('manifest_file_table',$file);
	}

	function get_all_file() {
		$this->db->join('manifest_data_table D','D.file_id = F.file_id');
		$this->db->group_by('F.file_id');
		$get = $this->db->get('manifest_file_table F');
		return $get->result();
	}
	function get_file() {
		$this->db->join('manifest_data_table D','D.file_id = F.file_id');
		$this->db->where('D.status','VALID');
		$this->db->group_by('F.file_id');
		$get = $this->db->get('manifest_file_table F');
		return $get->result();
	}

	function get_by_file_id($file_id) {
		$this->db->select('M.*,U.username');
		$this->db->join('user_table U','U.user_id = M.user_id');
		$this->db->where('M.file_id',$file_id);
		$get = $this->db->get('manifest_file_table M');
		if($get->num_rows() > 0) return $get->row();
		else return false;
	}

	function check_mawb_no($mawb_no) {
	 //	$this->db->where('LOWER(mawb_no)',strtolower($mawb_no));
        $this->db->where('mawb_no',$mawb_no);
		$get = $this->db->get('manifest_file_table');
		if($get->num_rows() == 0) return true;
		else return false;
	}

	function search_mawb_type($type) {
		$this->db->like('LOWER(mawb_type)',strtolower($type));
		$get = $this->db->get('manifest_data_table');
		if($get->num_rows() > 0) return true;
		else return false;
	}

	#DATA MANIFEST ->
	function check_hawb_no($hawb_no) {
        $this->db->where('hawb_no',$hawb_no);
		$get = $this->db->get('manifest_data_table');
		if($get->num_rows() == 1) return true;
		else return false;
	}

	function get_manifest_by_mawb_type($type){
		$this->db->where('LOWER(mawb_type)',strtolower($type));
		$get = $this->db->get('manifest_data_table');
		return $get->result();
	}

	function upgrade_data($hawb_no,$field = false,$value = false) {


		$this->db->query("
			UPDATE manifest_data_table 
			SET 
				".$field." = ".$field." + ".$value." 
			WHERE 
				hawb_no = '".$hawb_no."'
			");
	}

	function data_new_id(){
		$get = $this->db->count_all('manifest_data_table');
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

	function data_insert_new($data) {
		$this->db->insert('manifest_data_table',$data);
	}

	function data_update($data,$data_id) {
		$this->db->where('data_id',$data_id);
		$this->db->update('manifest_data_table',$data);
	}

	function get_filtering_data($start = null,$limit = null,$where,$group_by = false) {
		foreach ($where as $key => $value) { 
			if(is_array($value)) $this->db->where_in($key,$value); else $this->db->where($key,$value); 
		}
		if(is_numeric($start)) $this->db->limit($limit,$start);
		if($group_by != false) $this->db->group_by($group_by);
		$get = $this->db->get('manifest_data_table D');

		if($get->num_rows() > 0) return $get->result();
		else return false;
	}

	function count_not_verified(){
		$QUERY = "
			SELECT * FROM manifest_data_table D
			WHERE D.status = 'Unverified'
			GROUP BY D.file_id
		";
		$get = $this->db->query($QUERY);
		return $get->num_rows();
	}

	function set_status_data($data_id,$status) {
		$this->db->where('data_id',$data_id);
		$this->db->set('status',$status);
		$this->db->update('manifest_data_table');
	}

	function get_header_format(){
		$header = array('no','hawb_no','shipper','consignee','pkg','description','pcs','kg','value','pp','cc','remarks','other_charge_tata','other_charge_pml','mawb_type','rate');
		return $header;
	}

	function get_by_data_id($data_id){
		$this->db->where('data_id',$data_id);
		$get = $this->db->get('manifest_data_table');
		return $get->row();
	}

	function get_by_hawb_no($hawb_no){
		$this->db->where('hawb_no',$hawb_no);
		$get = $this->db->get('manifest_data_table');
		return $get->row();
	}

	function set_data_customer($cust_id,$data_id,$type) {
		$this->db->set($type,$cust_id);
		$this->db->where('data_id',$data_id);
		$this->db->update('manifest_data_table');
	}

	function check_valid_status($data) {
		$this->db->where('data_id',$data);
		$data = $this->db->get('manifest_data_table');
		$status = 0;

		$this->db->where('reference_id',$data->row()->shipper);
		$get = $this->db->get('customer_table');
		if($get->num_rows() > 0) $status++;

		$this->db->where('reference_id',$data->row()->consignee);
		$get = $this->db->get('customer_table');
		if($get->num_rows() > 0) $status++;

		if($status == 2) $this->set_status_data($data->row()->data_id,'VALID');

		return $status;
	}

	function set_payment_data($data_id,$cust_id) {
		$this->db->where('data_id',$data_id);
		$this->db->set('repayment_cust',$cust_id);
		$this->db->update('manifest_data_table');
	}
	function search_hawb($hawb) {
		$this->db->like('hawb_no',$hawb);
		$this->db->where('status','VALID');
		$get = $this->db->get('manifest_data_table');
		if($get->num_rows() > 0) return $get->result();
		else return false;		
	}
	
	function deadline_data($days = NULL) {
		$limit_date = $this->tools->deadline($days);
		
		$this->db->where('deadline <',$limit_date);
		$this->db->where('LOWER(status)',strtolower('valid'));
		$this->db->order_by('deadline','asc');
		$get = $this->db->get('manifest_data_table');
		if($get->num_rows() > 0) return $get->result();
		else return false;
	}

	#Extra Charge
	function add_extra_charge($charge) {
		$this->db->insert('manifest_extra_charge_table',$charge);
	}
	function delete_extra_charge($charge_id) {
		$this->db->where('charge_id',$charge_id);
		$this->db->delete('manifest_extra_charge_table');
	}
	function check_extra_charge($data_id,$type) {
		$this->db->where('data_id',$data_id);
		$this->db->where('type',$type);
		$get = $this->db->get('manifest_extra_charge_table');
		if($get->num_rows() > 0) return $get->row();
		else return FALSE;
	}

	function get_charge_type() {
		$get = $this->db->get('other_charge_type_table');
		return $get->result();
	}
	
	function get_extra_charge($data_id) {
		$this->db->where('data_id',$data_id);
		$get = $this->db->get('manifest_extra_charge_table');
		if($get->num_rows() > 0) return $get->result();
		else return FALSE;
	}

	function get_list_payment() {
		$get = $this->db->get('payment_data');
		if($get->num_rows() > 0) return $get->result();
		else return FALSE;
	}

	function print_get($print_id) {
		$this->db->where('print_priview_id',$print_id);
		$get = $this->db->get('print_priview_table');
		if($get->num_rows() > 0) return $get->row();
		else return false;
	}
	function print_add($data) {
		$this->db->insert("print_priview_table",$data);
	}
	function print_update($print_id,$data) {
		$this->db->where('print_priview_id',$print_id);
		$this->db->update("print_priview_table",$data);
	}

	function manifest_from_vietnam($file_id) {
		$this->db->select('manifest_data_table.*');
		$this->db->join('customer_table','manifest_data_table.shipper = customer_table.reference_id');
		$this->db->where('LOWER(customer_table.country)','vietnam');
		$this->db->where('manifest_data_table.file_id',$file_id);
		$get = $this->db->get('manifest_data_table');
		if($get->num_rows() > 0) return $get->result();
		else return FALSE;
	}


	function get_file_id_by_upload_date($date,$country) {
		$this->db->select('manifest_file_table.*');
		$this->db->join('manifest_file_table','manifest_file_table.file_id = manifest_data_table.file_id');
		$this->db->where('LEFT(manifest_file_table.created_date,10)',$date);
		$this->db->where('LOWER(manifest_data_table.status)','valid');
		$this->db->where_in('LOWER(manifest_file_table.flight_from)',$country);
		$this->db->group_by('manifest_data_table.file_id');
		$get = $this->db->get('manifest_data_table');
		if($get->num_rows() > 0) return $get->result();
		else return false;
	}
	
	function get_file_id_by_upload_date_and_country($date,$country) {
		$this->db->select('manifest_data_table.*');
		$this->db->join('manifest_file_table','manifest_file_table.file_id = manifest_data_table.file_id');
		$this->db->join('customer_table','customer_table.reference_id = manifest_data_table.shipper');
		$this->db->where('LEFT(manifest_data_table.created_date,10)',$date);
		$this->db->where('LOWER(manifest_file_table.flight_from) !=',$country);
		$this->db->where('LOWER(customer_table.country)',$country);
		$get = $this->db->get('manifest_data_table');
		if($get->num_rows() > 0) return $get->result();
		else return false;
	}

	function get_manifest_by_mawb_type_and_file_id($file_id,$type,$country){
		$this->db->select('manifest_data_table.*');
		$this->db->join('customer_table','customer_table.reference_id = manifest_data_table.shipper');
		$this->db->where('file_id',$file_id);
		$this->db->where('LOWER(country)',$country);
		$this->db->like('LOWER(mawb_type)',strtolower($type));
		$get = $this->db->get('manifest_data_table');
		if($get->num_rows() > 0) return $get->result();
		else return false;
	}

	function get_total($field, $file_id, $country) {
		$this->db->select('SUM('.$field.') AS total');
		$this->db->join('customer_table','customer_table.reference_id = manifest_data_table.shipper');
		$this->db->where('LOWER(country)',$country);
		$this->db->where('file_id',$file_id);
		$this->db->where_in('mawb_type',array('ftz','hc'));
		$get = $this->db->get('manifest_data_table');
		return $get->row()->total;
	}
	

	function get_total_where($field, $file_id, $where, $value, $country) {
		$this->db->select('SUM('.$field.') AS total');
		$this->db->join('customer_table','customer_table.reference_id = manifest_data_table.shipper');
		$this->db->where('LOWER(country)',$country);
		$this->db->where('file_id',$file_id);
		$this->db->where_in($where,$value);
		$get = $this->db->get('manifest_data_table');
		return $get->row()->total;
	}
	function get_total_where_by_hawb($field, $hawb_no, $where, $value, $country = false){
		$this->db->select('SUM('.$field.') AS total');
		$this->db->join('customer_table','customer_table.reference_id = manifest_data_table.shipper');
		if($country) $this->db->where('LOWER(country)',$country);
		$this->db->where('hawb_no',$hawb_no);
		$this->db->where_in($where,$value);
		$get = $this->db->get('manifest_data_table');
		return $get->row()->total;
	}
	function get_count_where($file_id, $where, $value, $country) {
		$this->db->where('file_id',$file_id);
		$this->db->join('customer_table','customer_table.reference_id = manifest_data_table.shipper');
		$this->db->where('LOWER(country)',$country);
		$this->db->where_in($where,$value);
		$get = $this->db->get('manifest_data_table');
		return $get->num_rows();
	}
	function get_count_where_by_hawb($hawb_no, $where, $value, $country = false) {
		$this->db->join('customer_table','customer_table.reference_id = manifest_data_table.shipper');
		if($country) $this->db->where('LOWER(country)',$country);
		$this->db->where('hawb_no',$hawb_no);
		$this->db->where_in($where,$value);
		$get = $this->db->get('manifest_data_table');
		return $get->num_rows();
	}
	
	function get_snow_jakarta_to_country_by_upload_date($date,$country) {

		$this->db->select('manifest_file_table.*');
		$this->db->where('LOWER(flight_from)','indonesia');
		$this->db->where('LOWER(flight_to)',$country);
		$this->db->where('LEFT(created_date,10)',$date);
		$get = $this->db->get('manifest_file_table');
		if($get->num_rows() > 0) return $get->result();

		else return false;
	}
	
	function check_snow_jakarta_country($file_id, $country) {
		$query = "
		SELECT * FROM
		(
			SELECT
				manifest_data_table.*,
				(
					SELECT customer_table.city
					FROM customer_table
					WHERE customer_table.reference_id = manifest_data_table.shipper
				) as 'city_shipper',
				(
					SELECT customer_table.city
					FROM customer_table
					WHERE customer_table.reference_id = manifest_data_table.consignee
				) as 'city_consignee'
			FROM manifest_data_table
			WHERE manifest_data_table.file_id = '".$file_id."'
		) MANIFEST where city_shipper = 'jakarta' and LOWER(city_consignee) = '".$country."'
		";
		$get = $this->db->query($query);
		if($get->num_rows() > 0) return $get->result();
		else return false;
	}
	function check_snow_jakarta_other_country($file_id, $country) {
		$query = "
		SELECT * FROM
		(
			SELECT
				manifest_data_table.*,
				(
					SELECT customer_table.city
					FROM customer_table
					WHERE customer_table.reference_id = manifest_data_table.shipper
				) as 'city_shipper',
				(
					SELECT customer_table.city
					FROM customer_table
					WHERE customer_table.reference_id = manifest_data_table.consignee
				) as 'city_consignee'
			FROM manifest_data_table
			WHERE manifest_data_table.file_id = '".$file_id."'
		) MANIFEST where city_shipper = 'jakarta' and LOWER(city_consignee) != '".$country."'
		";
		$get = $this->db->query($query);
		if($get->num_rows() > 0) return $get->result();
		else return false;
	}

	function get_snow_local_from_to($file_id,$from,$to) {
		$query = "
		SELECT * FROM
		(
			SELECT
				manifest_data_table.*,
				(
					SELECT customer_table.city
					FROM customer_table
					WHERE customer_table.reference_id = manifest_data_table.shipper
				) as 'city_shipper',
				(
					SELECT customer_table.city
					FROM customer_table
					WHERE customer_table.reference_id = manifest_data_table.consignee
				) as 'city_consignee'
			FROM manifest_data_table
			WHERE manifest_data_table.file_id = '".$file_id."'
		) MANIFEST where LOWER(city_shipper) = '".$from."' and LOWER(city_consignee) = '".$to."'
		";
		$get = $this->db->query($query);
		if($get->num_rows() > 0) return $get->result();
		else return false;		
	}

	function snow_local_get_total_where($file_id,$from,$to,$field){
		$query = "
		SELECT SUM(MANIFEST.".$field.") as total FROM
		(
			SELECT
				manifest_data_table.*,
				(
					SELECT customer_table.city
					FROM customer_table
					WHERE customer_table.reference_id = manifest_data_table.shipper
				) as 'city_shipper',
				(
					SELECT customer_table.city
					FROM customer_table
					WHERE customer_table.reference_id = manifest_data_table.consignee
				) as 'city_consignee'
			FROM manifest_data_table
			WHERE manifest_data_table.file_id = '".$file_id."'
		) MANIFEST where LOWER(city_shipper) = '".$from."' and LOWER(city_consignee) = '".$to."'
		";
		$get = $this->db->query($query);
		return $get->row()->total;
	}

	function snow_local_get_total_where_on_collect($file_id,$from,$to,$field){
		$query = "
		SELECT SUM(MANIFEST.".$field.") as total FROM
		(
			SELECT
				manifest_data_table.*,
				(
					SELECT customer_table.city
					FROM customer_table
					WHERE customer_table.reference_id = manifest_data_table.shipper
				) as 'city_shipper',
				(
					SELECT customer_table.city
					FROM customer_table
					WHERE customer_table.reference_id = manifest_data_table.consignee
				) as 'city_consignee'
			FROM manifest_data_table
			WHERE manifest_data_table.file_id = '".$file_id."'
		) MANIFEST where LOWER(city_shipper) = '".$from."' and LOWER(city_consignee) = '".$to."' AND MANIFEST.collect != ''
		";
		$get = $this->db->query($query);
		return $get->row()->total;
	}

	function get_data_by_other_country($file_id,$country) {
		$this->db->select('manifest_data_table.*, customer_table.country');
		$this->db->join('customer_table','customer_table.reference_id = manifest_data_table.shipper');
		$this->db->where('LOWER(country) !=',$country);
		if($country == 'taiwan') $this->db->where('LOWER(country) !=','vietnam');
		$this->db->where('file_id',$file_id);
		$get = $this->db->get('manifest_data_table');
		if($get->num_rows() > 0) return $get->result();
		else return false;
	}

	function get_hawb_from($hawb_no){
		$this->db->select('manifest_data_table.*, customer_table.country');
		$this->db->join('customer_table','customer_table.reference_id = manifest_data_table.shipper');
		$this->db->where('hawb_no',$hawb_no);
		$get = $this->db->get('manifest_data_table');
		if($get->num_rows() > 0) return $get->row();
		else return false;
	}

	function get_surabaya_import($date_from,$date_end){
    	$this->db->join('customer_table D','D.reference_id = F.consignee');
        $this->db->where('LOWER(D.city)','surabaya');
       	$this->db->where('LOWER(F.status)','VALID');
        $this->db->where('LOWER(F.manifest_type)','import');
        $this->db->where('F.last_update >=', $date_from);
        $this->db->where('F.last_update <=', $date_end);
		$get = $this->db->get('manifest_data_table F');
		return $get->result();
    }



     function get_surabaya_export($date_from,$date_end){
       	$this->db->join('customer_table D','D.reference_id = F.shipper');
        $this->db->where('LOWER(D.city)','surabaya');
       	$this->db->where('LOWER(F.status)','VALID');
        $this->db->where('LOWER(F.manifest_type)','export');
        $this->db->where('F.last_update >=', $date_from);
        $this->db->where('F.last_update <=', $date_end);
		$get = $this->db->get('manifest_data_table F');
		return $get->result();
    }
}
?>