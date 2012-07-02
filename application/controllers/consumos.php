<?php
class consumos extends CI_Controller {

    private $u; 
    
    function __construct() {
        parent::__construct();
        
        $this -> u = $this->session->userdata('user');
    }

    public function index () {
        redirect ('consumos/lista');
    }
    
    public function lista () {

        $this -> db -> select ('HistorialConsumos.id as idHistorial, PlatoDeComida.nombre as nombrePlato, Restaurante.nombre as nombreRestaurante');
        $this -> db -> where ('idComensal',$this->u->id);
        $this -> db -> where ('feedback', 0);

        $this->db->join('PlatoDeComida', 'PlatoDeComida.id = HistorialConsumos.idPlato');
        $this->db->join('Restaurante', 'Restaurante.id = HistorialConsumos.idRestaurante');

        $query = $this->db->get('HistorialConsumos');

        if ($query->num_rows == 0) {
            redirect ('consumos/no_hay');
        }

        $data['consumos'] = $query->result();
        
        $this->load->view( 'general/header.php' );
        $this->load->view( 'consumos/pendientes.php',$data );
        $this->load->view( 'general/footer.php' );

        
    }
    
    public function feedback($idh) {
        $this -> db -> where ('id',$idh);
        $this -> db -> where ('feedback', 0);
        
        $query = $this->db->get('HistorialConsumos');
        $data['historial'] = $query->result();
        
        $data['restaurante'] = $this->buscarRestaurante($data['historial'][0]->idRestaurante);
        $data['plato'] = $this->buscarPlatoDeComida($data['historial'][0]->idPlato);
        
        $this->load->view( 'general/header.php' );
        $this->load->view( 'consumos/calificar.php',$data );
        $this->load->view( 'general/footer.php' );
    }
    
    public function cancel($idh){
        $this->db->delete('HistorialConsumos', array('id' => $idh));
        redirect('consumos');
    }
    
    public function no_hay () {
        $this->load->view( 'general/header.php' );
        $this->load->view( 'consumos/vacia.php');
        $this->load->view( 'general/footer.php' );
    }
    
    public function calificar ($idh,$r,$p) {
        
        $data = array(
               'puntajeRestaurante' => $this->input->post('slt_restaurante'),
               'puntajePlato' => $this->input->post('slt_plato'),
               'feedback' => 1
        );

        $this->db->where('id', $idh);
        $this->db->update('HistorialConsumos', $data); 
        
        $this->db->query('update Restaurante set puntaje=puntaje+'.$this->input->post('slt_restaurante').' where id = '. $r);
        
        if ($this->input->post('slt_plato') != 'x') {
            $this->db->query('update PlatoDeComida set puntaje=puntaje+'.$this->input->post('slt_plato').' where id = '. $p);
        }
        
        redirect('consumos');
    }
    
    
    private function buscarRestaurante($r){
        $this -> db -> where ('id',$r);
        $query = $this->db->get('Restaurante');
        return $query->result();
    }
    
    private function buscarPlatoDeComida($p){
        $this -> db -> where ('id',$p);
        
        $query = $this->db->get('PlatoDeComida');
        return $query->result();
    }
    
}

