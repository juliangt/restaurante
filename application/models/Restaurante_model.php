<?php

class Restaurante_model extends CI_Model {
    var $id             = '';
    var $Nombre		= '';
    var $CoordinadaX    = '';
    var $CoordinadaY    = '';
    var $habilitado     = '';
    var $puntaje        = '';
    
    function __construct()
    {
        parent::__construct();
    }
    
    function get($id)  {
        $query = $this -> db -> get_where('Restaurante', array('id' => $id));
        $u = $query->result();
        return $u[0];
    }

    function getNombre() {
        return $this->nombre;
    }
    
    function getCoordenadaX(){
        return $this->CoordinadaX;
    }

    function getCoordenadaY(){
        return $this->CoordinadaY;
    }
    
}