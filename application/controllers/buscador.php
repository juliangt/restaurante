<?php
class Buscador extends CI_Controller {
    private $appPhysicalPath = null;
    private $u; 
    
    function __construct() {
        parent::__construct();

        $this -> dataFolderPath = FCPATH.'reglas/';
        $this -> u = $this->session->userdata('user');

    }

    // Metodo para aplicar Reglas y determinar verdadero o falso. 
    private function ApplyRule($id,$regla,$display=false) {
        $strategy = new SqlFileLoaderStrategy();
        $loader = new RuleLoader();
        $loader -> setStrategy($strategy);

        $data['rule'] =             $loader->loadRule($this->dataFolderPath . $regla . '.rules');
        $data['ruleContext'] =      $loader->loadRuleContext($this->dataFolderPath . $regla . '.test', $id);
        $data['result'] =           $data[ 'rule' ]-> evaluate( $data[ 'ruleContext' ] );
        $data['ruleText'] =         read_file( $this->dataFolderPath . $regla . '.rules' );
        $data['ruleContextText'] =  read_file( $this->dataFolderPath . $regla . '.test' );

        $values = array();
        $values = explode ('=', $data['result']->toString());
        $v = $values[2];
        
        if ($display) {
            //echo $data['rule'] , '<br />';
            //echo $data['ruleContext'] , '<br />';
            //echo $data['result'] , '<br />';
            echo $data['ruleText'] , '<br />';
            echo htmlentities($data['ruleContextText']) , '<br />';
        }
        
        return trim($v);
    }
    
    public function search() {
        
        $data = array(
            'idFamilia' =>  $this->input->post('slt_familia'),
            'idRestriccion' => $this->input->post('slt_restriccion') ,
            'radio' => $this->input->post('slt_radio'),
            'idComensal' => $this->u->id
        );
        
        $this->db->insert('Recomendacion', $data); 
        
        // Almaceno el ID de recomendacion para hacer el seguimiento durante la sesion de consulta
        $rid = $this->db->insert_id();
        $this->session->set_userdata('rid', $rid);
        
        $this->log('Usuario inicia solicitud: ' . $this->u->Mail);
        $this->log("Se guardo la recomendacion en la base de datos");

        $data = array(
               'UbicacionX' => $this->input->post('txt_ux'),
               'UbicacionY' => $this->input->post('txt_uy')
        );

        $this->db->where('id', $this->u->id );
        $this->db->update('Comensal', $data); 
        
        $this->log("Se actualizo la ubicacion del comensal");
        $this->log("Latitud: " . $this->input->post('txt_ux'));
        $this->log("Longitud " . $this->input->post('txt_uy'));

        // paso 2 
        $this ->getRestaurantes();
        $this ->getPlatos();
        
        // paso 3
        $this ->reduceRadioList();
        $this ->reduceRestauranteFamilyList();
       
        // paso 4
        $this ->reducePlatosFamiliaList();
        $this ->reducePlatosRestriccionesList();
        
        //  redirijo al controlador que maneja el usuario
        redirect('recomendacion/mostrar');

    }
    
    
    // Obtenemos variables
    private function getRestaurantes () {

        /** 
         * En primer instancia, son todos potenciales candidatos,
         * voy aplicando reglas y en base a los resultados voy
         * reduciendo la lista.
         */
        
        $query = $this->db->get('Restaurante');
        
        // Cargo TODOS los restaurantes para la recomendacion y le aplico la regla de distancia.
        foreach ($query->result() as $r) {
            
            $data = array(
                'idRecomendacion' =>  $this->session->userdata('rid'),
                'idRestaurante' => $r->id
            );

            $this->db->insert('RestaurantesRecomendacion', $data); 
            $this->log("Se agrego el par Rec, Restaurante: " . $r->id );
        }
    }
    
    private function getPlatos() {

        /** 
         * Tambien los platos, en principio todos son candidatos.
         * luego aplico reglas para ir sacandolos de la lista.
         */
        
        $restaurantes = $this->db->get('Restaurante');
        
        foreach ($restaurantes->result() as $r) {
            
            $this->db->where('idRestaurante', $r->id);
            $platos = $this->db->get('RestaurantePlato');
            
            $puntajeRestaurante = $r -> puntaje;
            $puntajeHistorialRestaurante = $this->recuperaHistorioRestauranteComensal($r->id,$this->u->id);
            
            foreach ($platos->result() as $p) {
                $puntajePlato = $this->recuperaPuntajePlato($p->idPlato);
                $puntajeHistorialPlato = $this->recuperaHistorioPlatoComensal($p->idPlato,$this->u->id);
               
                $puntaje = $puntajeRestaurante  + $puntajePlato + ( ( $puntajeHistorialPlato + $puntajeHistorialRestaurante ) * 2 );
                
                $data = array(
                    'idRecomendacion' => $this->session->userdata('rid'),
                    'idRestaurante' => $r->id,
                    'idPlato' => $p->idPlato,
                    'puntaje' => $puntaje
                );

                $this->db->insert('PlatosRecomendacion', $data); 
                $this->log("Se agrego el trio Rec, Restaurante: " . $r->id . ', Plato: ' . $p->idPlato);
                
            }
        }
    }

    // aplicamos reglas y reducimos lista
    private function reduceRadioList () {
        
        $this->log("Determino si el restaurante se encuentra fuera del radio de busqueda.");
        $this->db->where('idRecomendacion', $this->session->userdata('rid'));
        $query = $this->db->get('RestaurantesRecomendacion');
        
        // Cargo TODOS los restaurantes para la recomendacion y le aplico la regla de distancia.
        foreach ($query->result() as $r) {   
            $cumple = $this ->ApplyRule($r->id,'restauranteCercania');
            
            if ($cumple == 'FALSE') {

                $this->db->delete('RestaurantesRecomendacion', array('id' => $r->id)); 
                $this->log('Se elimina al restaurante por no cumplir proximidad : ' . $r->idRestaurante);
                
                $this->db->delete('PlatosRecomendacion', array('idRecomendacion' => $r->idRecomendacion, 'idRestaurante' => $r->idRestaurante )); 
                $this->log('Se eliminan platos del restaurante eliminado por proximidad: ' . $r->idRestaurante);
            }
        }
    }

    private function reduceRestauranteFamilyList () {
        
        $this->log("Determino si el restaurante cumple criterio de familia de cocina deseada.");
        $this->db->where('idRecomendacion', $this->session->userdata('rid'));
        $query = $this->db->get('RestaurantesRecomendacion');
        
        // Cargo TODOS los restaurantes para la recomendacion y le aplico la regla de familia.
        foreach ($query->result() as $r) {   
            $cumple = $this ->ApplyRule($r->id,'restauranteFamilia');
            
            if ($cumple == 'FALSE') {
                $this->db->delete('RestaurantesRecomendacion', array('id' => $r->id)); 
                $this->log('Se elimina al restaurante por no tener la familia de cocina requerida: ' . $r->idRestaurante);

                $this->db->delete('PlatosRecomendacion', array('idRecomendacion' => $r->idRecomendacion, 'idRestaurante' => $r->idRestaurante )); 
                $this->log('Se eliminan platos del restaurante eliminado por ser de distinta familia: ' . $r->idRestaurante);
            }
        }
    }
    
    private function reducePlatosFamiliaList () {
        
        $this->log("Elimino los platos de familia distinta a la ingresada si el restaurante tiene varias familias de cocina.");
        $this->db->where('idRecomendacion', $this->session->userdata('rid'));
        $query = $this->db->get('PlatosRecomendacion');
        
        // Cargo TODOS los restaurantes para la recomendacion y le aplico la regla de distancia.
        foreach ($query->result() as $r) {   
            
            $cumple = $this -> ApplyRule($r->id,'platosFamilia');
            
            if ($cumple == 'FALSE') {
                $this->db->delete('PlatosRecomendacion', array('id' => $r->id )); 
                $this->log('Se elimina plato del restaurante no eliminar por ser de distinta familia: ' . $r->idPlato);
            }
        }
    }
    
    private function reducePlatosRestriccionesList () {
        
        $this->log("Elimino los platos con ingredientes que tengan restricciones.");
        $this->db->where('idRecomendacion', $this->session->userdata('rid'));
        $query = $this->db->get('PlatosRecomendacion');
        
        // Cargo TODOS los restaurantes para la recomendacion y le aplico la regla de distancia.
        foreach ($query->result() as $r) {   
            
            $cumple = $this -> ApplyRule($r->id,'platosRestricciones');
            
            if ($cumple == 'FALSE') {
                $this->db->delete('PlatosRecomendacion', array('id' => $r->id )); 
                $this->log('Se elimina plato por no cumplir restricciones: ' . $r->idPlato);
            }
        }
    }

    
    
    
    // funciones auxiliares recupera historico puntajes.
    private function recuperaPuntajePlato($p){
        $q = $this->db->query('SELECT puntaje FROM PlatoDeComida WHERE id = ? ', array($p));
        $q = $q->result();
        
        return $q[0]->puntaje;
    }
    
    private function recuperaHistorioPlatoComensal($p,$c){
        $q = $this->db->query('SELECT IFNULL(SUM( puntajePlato ),0) puntaje FROM HistorialConsumos WHERE idComensal = ? AND idPlato = ? ', array($c,$p));
        $q = $q->result();
        
        return $q[0]->puntaje;
    }
    
    private function recuperaHistorioRestauranteComensal($r,$c){
        $q = $this->db->query('SELECT IFNULL(SUM( puntajePlato ),0) puntaje FROM HistorialConsumos WHERE idComensal = ? AND idRestaurante = ?', array($c,$r));
        $q = $q->result();
        
        return $q[0]->puntaje;
    }
    
    
    // Para guarda seguimiento del comportamiento
    private function log($txt) {
        write_file(FCPATH.'/logger/Recomendacion-'.$this->session->userdata('rid').'.log', date('Y-m-d G:i:s')." - $txt \r\n", 'a+');
    }

    
    
    
    
    // funciones de prueba.
    public function listRestaurantes () {
        
        $query = $this->db->get('Restaurante');
        $restaurantes = array();

        foreach ($query->result() as $r) {
            $res = array();
            $res['id'] =        $r->id;
            $res['nombre'] =    $r->nombre;
            $res['cumple'] =    $this -> loadRestauranteRules($r->id);
            $restaurantes[] =   $res;
        }
        
        $data['restaurantes'] = $restaurantes;
        
        $this->load->view('general/header.php');
        $this->load->view('lista_restaurantes.php',$data);
        $this->load->view('general/footer.php');
    }
    
    public function listComensales () {
        
        $cs = $this->db->get('Comensal');
        $comensales = array();
        
        foreach ($cs->result() as $c) {
            $com = array();
            $com['id'] = $c->id;
            $com['mail'] = $c->Mail;
            $com['x'] = $c->UbicacionX;
            $com['y'] = $c->UbicacionY;    
            $comensales[] = $com;
        }
        
        $data['comensales'] = $comensales;
        
        $this->load->view( 'general/header.php');
        $this->load->view( 'lista_comensales.php',$data);
        $this->load->view( 'general/footer.php');
    }
 
}
