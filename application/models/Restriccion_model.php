<?php

class Restriccion_model extends CI_Model {
    var $id             = '';
    var $Nombre		= '';
    var $Ingredientes   = '';
    
    function __construct()
    {
        parent::__construct();
        $this -> Ingredientes = array();
    }
    
    function get($id)  {
        $query = $this -> db -> get_where('Restriccion', array('id' => $id));
        $u = $query->result();
        return $u[0];
    }

    function getNombre() {
        return $this->nombre;
    }
    
    function getIngredientes() {
        return $this->Ingredientes;
    }
    
    function addIngrediente($i) {
        $this->Ingredientes[] = $i;
    }
    
}