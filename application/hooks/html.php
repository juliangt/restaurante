<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class html extends CI_Controller {
	
	var $u; 
		
	public function __construct() {
		parent::__construct();
		
		$this->u = $this->session->userdata('user');
	}
	
	public function show_header(){
	
		if ($this->session->userdata('user_online')) {
			$data['esAdmin'] = $this->u->administrador;
		} else {
			$data['esAdmin'] = 0;
		}
		
		if (! $this->input->get('sh') == 'no' ) {
			$data['mensaje'] = $this->session->userdata('mensaje');
			$this->load->view('header.php', $data);
		}
		
		$this->session->unset_userdata('mensaje');
			
	}

	public function show_footer(){
		if (! $this->input->get('sh') == 'no' ) {
			$this->load->view('footer.php');
		}			
	}
}