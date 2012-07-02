<?php

class Ingrediente_model extends CI_Model {
    var $id             = '';
    var $Nombre		= '';
    
    function __construct()
    {
        parent::__construct();
    }
    
    function get($id)  {
        $query = $this -> db -> get_where('Ingrediente', array('id' => $id));
        $u = $query->result();
        return $u[0];
    }
    
    function getNombre() {
        return $this->nombre;
    }
    
}
