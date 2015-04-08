<?php

class Customers_model extends CI_Model {
	
	function get_list($type = null) {
		if($type != null) $this->db->where('LOWER(type)',$type);
		$get = $this->db->get('customer_table');
		if($get->num_rows() > 0) return $get->result();
		else return FALSE;
	}

	function get_customer($address = null, $type = null) {
		$customer = $this->get_by_id($address);
		if($customer != FALSE) {
			return $customer;
		} else {
			$customer = $this->check_speeling_address($address, $type);
			return $customer;
		}
	}
	
	function get_by_id($ref_id) {
		$this->db->where('reference_id',$ref_id);
		$get = $this->db->get('customer_table');
		if($get->num_rows() > 0) return $get->row();
		else return FALSE;
	}

	function save_customer($data)
	{
		
		$this->db->insert('customer_table',$data);	
		
	}
	
	function get_data(){

	//	$this->db->where('type', $type);
		$query = $this->db->get('customer_table');
		return $query->result();
		
		
		
	}
	
	function getuser($reference_id)
	{
		$this->db->where('reference_id',$reference_id);
		$query = $this->db->get('customer_table');
		return $query->row();
	}
	
	
	
	function customer_new_id(){
		$get = $this->db->count_all('customer_table');
		$get = $get + 111;
		$len = strlen($get);
			switch ($len) {
			case '1': return 'CUST00000' . $get; break;
			case '2': return 'CUST0000' . $get; break;
			case '3': return 'CUST000' . $get; break;
			case '4': return 'CUST00' . $get; break;   
			case '5': return 'CUST0' . $get; break;   
			default: return 'CUST'.$get; break;
			}
	}

	function customer_edit($reference_id,$data)
	{
		$this->db->where('reference_id', $reference_id);
		$this->db->update('customer_table', $data); 	
		
	}
	
	function customer_delete($reference_id)
	{
		$this->db->where('reference_id', $reference_id);
		$this->db->delete('customer_table'); 
		
	}

  function get_status_paid($refference_id,$status_payment="paid")
	{
		//$this->db->where('shipper',$refference_id);
     	$this->db->or_where('consignee',$refference_id);
        $this->db->where('status_payment',$status_payment);
		$query = $this->db->get('manifest_data_table');
		if($query->num_rows() > 0) return $query->result();
		else return FALSE;

	}

     function get_status_Unpaid($refference_id,$status_payment="Unpaid")
	{
	 	//$this->db->where('shipper',$refference_id);
       	$this->db->or_where('consignee',$refference_id);
        $this->db->where('status_payment',$status_payment);
		$query = $this->db->get('manifest_data_table');
		if($query->num_rows() > 0) return $query->result();
		else return FALSE;

	}


	

	function check_speeling_address($address){
		$array = explode(' ',$address);
		$QUERY = "
			SELECT
				*
			FROM
				(
					SELECT
						CUST.cust_id,
						CUST.name,
						CUST.address,
						CUST.country,
						CONCAT(
							CUST. name,
							' ',
							CUST.address,
							' ',
							CUST.phone,
							' ',
							CUST.email,
							' ',
							CUST.country
						)AS FULL_ADDRESS
					FROM
						customer_table CUST
				)CUST
			WHERE
		";
		for ($i=0;$i<=count($array)-1;$i++) {
			if(trim($array[$i])) {
				$QUERY .= "CUST.FULL_ADDRESS LIKE '%".trim(strip_tags(str_ireplace(array(',','/',"'"),'',trim($array[$i]))))."%'";
				$QUERY .= " OR ";
			}
		}
		$QUERY = substr($QUERY, 0, -4);
		$get = $this->db->query($QUERY);
		if($get->num_rows() > 0) {
			$similar['cust_id'] = array();
			foreach ($get->result() as $key => $value) {
				similar_text($value->FULL_ADDRESS, $address, $percent);
				$percent = round($percent);
				if($percent > 50) {
					$similar['percent'][] = $percent;
					$similar['cust_id'][] = $value->cust_id;
				}
			}
			if(count($similar['cust_id']) > 0) {
				$this->db->where_in('cust_id',$similar['cust_id']);
				$this->db->where('reference_id !=','0');
				$get = $this->db->get('customer_table');
				if($get->num_rows() > 0) return $get->result();
				else return FALSE;
			} else return FALSE;
		} else return FALSE;
	}

	function search($keyword) {
		$keyword = $this->tools->remove_tags_excel($keyword);
		$keyword = explode(' ', $keyword);
		if(is_array($keyword) && count($keyword) > 0){
			foreach($keyword as $val) {
				if(strlen($val) > 1) {
					$this->db->like('name',$val);
					$this->db->or_like('address',$val);
					$this->db->or_like('country',$val);
				}
			}
			$get = $this->db->get('customer_table');
			if($get->num_rows() > 0) return $get->result();
			else FALSE;
		} else return FALSE;
	}

	function list_country() {
		return array('Indonesia','Taiwan','China','Vietnam','Hongkong');
	}
}

?>