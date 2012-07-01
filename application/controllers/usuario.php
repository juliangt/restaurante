<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->must_be_admin = false;
	}

	public function login() {
		if (!$this->session->userdata('user_online')) {
                    $this->load->view( 'general/header.php' );
                    $this->load->view('usuario/login.php');
                    $this->load->view('general/footer.php');
		} else {
                    	//redirect('recomendacion/solicitar');
			redirect('welcome');
		}
	}
	
	public function logout() {
		$this->session->unset_userdata('user_online');
		$this->session->unset_userdata('user');
                $this->session->unset_userdata('rid');
		$this->session->sess_destroy();
		$this->_auth = FALSE;
		redirect('usuario/login');
	}
	
	public function login_check() {

		$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
		$this->output->set_header("Pragma: no-cache"); 

		$user = $this->usuario_model->login_check();
                
		if ($user == false) {
                    $this->session->set_userdata('mensaje', 'No se pudo ingresar. Compruebe sus datos.');
                    redirect('usuario/login/');
		} else {
                    //$this->session->set_userdata('mensaje', 'Login correcto.');
                    $this->session->set_userdata('user_online',TRUE);
                    $this->session->set_userdata('user',$user);
                    redirect('welcome');
		}		
	} 

	public function esAdmin() {
		$u = $this->session->userdata('user');
		
		if ($u->administrador == 0){
			redirect('welcome/');
		}
	}

}
