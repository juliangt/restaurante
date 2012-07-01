<?php
class recomendacion extends CI_Controller {

    private $u; 
    
    function __construct() {
        parent::__construct();
        
        $this -> u = $this->session->userdata('user');

    }

    public function solicitar () {
        // limpio la recomendacion existente.
        $this->session->unset_userdata('rid');

        $this->load->view( 'general/header.php' );

        $data['familias'] = $this->db->get('FamiliasDeCocina')->result();
        $data['restricciones'] = $this->db->get('Restriccion')->result();

        $this->load->view( 'recomendacion/solicitar.php' , $data);

        $data_footer['show_location'] = true;

        $this->load->view( 'general/footer.php', $data_footer );
        
    }
    
    public function mostrar () {
        
        if (!$this->session->userdata('rid')) {
            redirect ('recomendacion/error');
        } else {
            
            $data['plato'] = $this->obtenerPlato();
            
            if (!$data['plato']) {
                redirect('recomendacion/no_hay');
            }
            
            $data['restaurante'] = $this -> obtenerRestaurante($data['plato'][0]->id);

            $this->load->view( 'general/header.php' );
            $this->load->view( 'recomendacion/nueva.php',$data);
            $this->load->view( 'general/footer.php' );

        }
    }
    
    public function no_hay () {
        $this->load->view( 'general/header.php' );
        $this->load->view( 'recomendacion/vacia.php');
        $this->load->view( 'general/footer.php' );
    }
    
    public function error () {
        $this->load->view( 'general/header.php' );
        $this->load->view( 'recomendacion/error.php');
        $this->load->view( 'general/footer.php' );
    }
    
    public function aceptar ($rid,$rr,$pr,$r,$p) {
        /*
         * recomendacion id, idrestauranterecomendacion, id platorecomendacion, id restaurante, id plato
         */
        
        $this->guardarHistorial($r, $p, 1);
        $this->guardarConsumo($r, $p);
        
        $this->actualizarPuntajePlato($p,'+5');
        $this->actualizarPuntajeRestaurante($r,'+5');
        
        $this->log('Actualizo puntaje del Restaurante en general. Puntaje: +5. Restaurante: ' . $r);
        $this->log('Actualizo puntaje del plato en general. Puntaje: +5. Plato: ' . $p);
        
        // limpio la recomendacion existente.
        $this->session->unset_userdata('rid');

        // redirijo al inicio
        redirect('welcome');

    }

    public function denegar ($rid,$rr,$pr,$r,$p) {
        
        $this->guardarHistorial($r, $p, 0);

        $this->actualizarPuntajePlato($p,'-1');
        $this->log('Actualizo puntaje del plato en general. Puntaje: -1. Plato: ' . $p);
        $this->actualizarPuntajeRestaurante($r,'-1');
        $this->log('Actualizo puntaje del Restaurante en general. Puntaje: -1. Restaurante: ' . $r);
        
        $this->eliminarPlatosRestaurante($rid, $r);
        $this->eliminarRestaurante($rr, $r);
        
        // Lo mando nuevamente a la pantalla de 
        redirect ('recomendacion/mostrar');

    }

    public function denegar_plato ($rid,$rr,$pr,$r,$p) {
        
        $this-> guardarHistorial($r, $p, 0);
        $this-> eliminarPlato($pr, $p);
        
        $this-> actualizarPuntajePlato($p,'-1');
        $this->log('Actualizo puntaje del plato en general. Puntaje: -1. Plato: ' . $p);
        
        // Lo mando nuevamente a la pantalla de 
        redirect ('recomendacion/mostrar');
    }

    
    private function actualizarPuntajePlato($id,$valor){
        $this->db->query('update PlatoDeComida set puntaje=puntaje '.$valor.' where id = '. $id);
    }
    
    private function actualizarPuntajeRestaurante($id,$valor){
        $this->db->query('update Restaurante set puntaje=puntaje '.$valor.' where id = '. $id);
    }
    
    private function eliminarPlato($pr,$p) {
        $this->db->delete('PlatosRecomendacion', array('idPlato' => $p)); 
        $this->log('Se elimina plato recomendado no aceptado. Plato: ' . $p);
    }
    
    private function eliminarRestaurante($rr,$r) {
        $this->db->delete('RestaurantesRecomendacion', array('id' => $rr, 'idRestaurante' => $r)); 
        $this->log('Se elimina restaurante recomendado no aceptado. Restaurante: ' . $r . '. ParRestRec: ' . $rr);
    }
    
    private function eliminarPlatosRestaurante($rid,$r) {
        $this->db->delete('PlatosRecomendacion', array('idRecomendacion' => $rid, 'idRestaurante' => $r)); 
        $this->log('Se eliminan platos del restaurante recomendado no aceptado. Restaurante: ' . $r);
    }

    private function guardarHistorial ($r,$p,$a) {
        /**
         * restarante, plato, acepto
         */
        $data = array(
            'idComensal' => $this->u->id,
            'idRestaurante' => $r,
            'idPlato' => $p,
            'acepto' => $a
        );

        $this->db->insert('HistorialSugerencias', $data); 
        $this->log('Se guardo la sugerencia aceptada: '.$a.'. Plato: '.$p.'. Restaurante: '.$r);
   
    }

    private function guardarConsumo ($r,$p) {
        $data = array(
            'idComensal' =>  $this->u->id,
            'idRestaurante' => $r,
            'idPlato' => $p
        );

        $this->db->insert('HistorialConsumos', $data); 
        $this->log('Se guardo el consumo, pendiente de puntuacion. Rstaurante: ' . $r . '. Plato: ' . $p);

    }
    
    private function obtenerRestaurante($p) {
        $query = $this->db->query('select rr.id as idParRestaurante, r.CoordenadaX, r.CoordenadaY, r.domicilio, r.localidad, r.provincia, rr.idRecomendacion, r.nombre, r.id from RestaurantesRecomendacion rr left join Restaurante r on rr.idRestaurante = r.id where rr.idRecomendacion = '. $this->session->userdata('rid') . ' and r.id in (select idRestaurante from PlatosRecomendacion where idPlato = '.$p.') order by r.puntaje desc limit 1'); 
        
        if ($query->num_rows != 1) {
            return false;
        } else {
            return $query->result();
        }
    }
    
    private function obtenerPlato() {
        $query = $this->db->query('SELECT pr.id as idParPlatoRestaurante, p.nombre, p.id FROM PlatosRecomendacion pr LEFT JOIN PlatoDeComida p ON pr.idPlato = p.id WHERE pr.idRecomendacion =  '. $this->session->userdata('rid') . '  GROUP BY pr.id, p.nombre, p.id ORDER BY pr.puntaje desc limit 1'); 
        
        if ($query->num_rows != 1) {
            return false;
        } else {
            return $query->result();
        }
    }

    // Para guarda seguimiento del comportamiento
    private function log($txt) {
        write_file(FCPATH.'/logger/Recomendacion-'.$this->session->userdata('rid').'.log', date('Y-m-d G:i:s')." - $txt \r\n", 'a+');
    }

}
