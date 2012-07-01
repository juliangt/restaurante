<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gatekeeper extends CI_Controller {
	
	var $_auth;
	var $_username;
	var $password;

	public function __construct() {
		parent::__construct();
		$this->isOnline();
	}

	public function login () {
		$this->_auth = true; 	
	}
	
	public function startGatekeeper() {		
		
		// if ($this->session->userdata('user_online') == true && $this -> router -> method == 'login') redirect('home');

		// Si no está logueado y no solicita login, lo mando al login
		if ($this->_auth != true && !in_array($this->router->method, array('login','login_check','portal'))) 
			redirect('usuario/login/');

		if ($this->_auth)
			{		}

	}
	
	public function isAdmin() {
		if ($this->must_be_admin) {
			echo "AA";
		}
	}
	
	public function logout() {
		$this->session->unset_userdata('user_online');
		$this->session->sess_destroy();
		$this->_auth = FALSE;
	}

	public function isOnline() {
		$this->_auth = $this->session->userdata('user_online');
	}
}
