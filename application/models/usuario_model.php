<?php

class Usuario_model extends CI_Model {
    var $id             = '';
    var $Mail		= '';
    var $UbicacionX     = '';
    var $UbicacionY     = '';
    
    function __construct()
    {
        parent::__construct();
    }
    
    function get_last_ten_entries()
    {
        $query = $this->db->get('Comensal', 10);
        return $query->result();
    }

    function get_user($id)  {
        $query = $this -> db -> get_where('Comensal', array('id' => $id));
        $u = $query->result();
        return $u[0];
    }

    function insert_client()
    {
        $this->Mail = $this->input->post('txt_mail');
    	$this->db->insert('Comensal', $this);   
    }

    function login_check() 
    {
        $m = strtolower(trim($this->input->post('txt_mail')));
        
        $query = $this->db->get_where('Comensal', array('Mail' => $m), 1, 0);
        
        if ($query-> num_rows == 1) {
            $u = $query->result();
            return $u[0];
        } else {
            return false;
        }
    }

}
