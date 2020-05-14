<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {
	public function __construct() {
	    parent::__construct();
		$this->load->model("Usuario"); 
		$usuarioSession = $this->session->userdata("sesiones");
		if(!$usuarioSession['ok'])
		{
			redirect('Login');
		}
	}
	
	
	
	public function Home(){
		
		$this->load->view('components/header');
		$this->load->view('components/menu');

       
		$this->load->view('components/footer');
	}
	public function HomeAdmin(){
		$this->load->view('components/header');
		$this->load->view('components/menuAdmin');
		$this->load->view('components/footer');
	}


}
