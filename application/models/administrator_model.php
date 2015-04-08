<?php

class Administrator_model extends CI_Model {
	
	#User
	function get_list_user() {
		
	}

    function add_partner(){
          $data= array(
                  'company_name'=> $_POST['company_name'],
                  'address'=> $_POST['address'],
                  'city'=> $_POST['city'],
                  'country'=> $_POST['country'],
                  'zipcode'=> $_POST['zipcode'],
                  'telephone_number'=> $_POST['telephone_number'],
                  'email'=> $_POST['email'],
                  'type_business'=> $_POST['type_business'],
                  'date'=>date("Y-m-d H:i:s")

              );

        $this->db->insert('partner',$data);

    }

     function edit_partner($partner_id){
          $data= array(
                  'company_name'=> $_POST['company_name'],
                  'address'=> $_POST['address'],
                  'city'=> $_POST['city'],
                  'country'=> $_POST['country'],
                  'zipcode'=> $_POST['zipcode'],
                  'telephone_number'=> $_POST['telephone_number'],
                  'email'=> $_POST['email'],
                  'type_business'=> $_POST['type_business'],
                  'date'=>date("Y-m-d H:i:s")

              );
        $this->db->where('partner_id',$partner_id);
        $this->db->update('partner',$data);

    }

    function remove_partner($partner_id){
       $this->db->where('partner_id',$partner_id);
        $this->db->delete('partner');

    }

    function get_partner(){
        $sql = $this->db->get('partner');
        return $sql->result();
    }

}

?>