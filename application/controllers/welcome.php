<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		
		$this->must_be_admin = false;
	}
	
	
	public function index()
	{
            $this->load->view('general/header.php');
            $this->load->view('index/inicio.php');
            $this->load->view('general/footer.php');
	}
	
	public function portal() {
		$this->index();
	}
	
}
