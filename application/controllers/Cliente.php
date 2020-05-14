<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {
	public function __construct() {
	    parent::__construct();
		$this->load->model("Usuario"); 
		$this->load->model("Clientes"); 

		$this->load->model("Negocios"); 
		$usuarioSession = $this->session->userdata("sesiones");
		if(!$usuarioSession['ok'])
		{
			redirect('Login');
		}
	}
	
	
	
	public function GetAll(){
		$data['clientes'] = $this->Clientes->getAll();
		$this->load->view('components/header',$data);
		$this->load->view('components/menuAdmin');
		$this->load->view('admin/dashboard');
		$this->load->view('components/footer');
	}
	public function Add(){
		$this->load->view('components/header');
		$this->load->view('components/menuAdmin');
		$this->load->view('admin/add');
		$this->load->view('components/footer');
	}
	public function Add1(){
		$data['nombre'] = $this->input->post('nombre');
		$data['apaterno'] = $this->input->post('apaterno');
		$data['amaterno'] = $this->input->post('amaterno');
		$data['telefono'] = $this->input->post('telefono');

		if($this->Clientes->Add($data)){
			$this->session->set_userdata('okMensaje','Cliente Registrado');
			redirect('Cliente/GetAll');
		}else{
			$this->session->set_userdata('error','Favor de intentar de nuevo');
			redirect('Cliente/Add');
		}
	}
	public function AddNegocio(){
		$data['nombre'] = $this->input->post('nombre');
		$data['cliente'] = $this->input->post('cliente');

		
		if($this->Clientes->addNegocio($data)){
			$this->session->set_userdata('okMensaje','Cliente Registrado');
		}else{
			$this->session->set_userdata('error','Favor de intentar de nuevo');
			
		}
		redirect('Cliente/Edit/'.$data['cliente']);

	}
	public function AddUsuario(){
		$data['nombre'] = $this->input->post('nombre');
		$data['apaterno'] = $this->input->post('apaterno');
		$data['amaterno'] = $this->input->post('amaterno');
		$data['usuario'] = $this->input->post('usuario');
		$data['pass'] = $this->input->post('pass');
		$data['tipo'] = $this->input->post('tipo');
		$data['negocioid'] = $this->input->post("negocioid");
		$data['cliente'] = $this->input->post("cliente");

		if($this->Negocios->addUsuario($data)){

			if($this->Negocios->addNegocioUsuario($data)){
				$this->session->set_userdata('okMensaje','Cliente Registrado');

			}


			//$this->session->set_userdata('okMensaje','Cliente Registrado');
		}else{
			$this->session->set_userdata('error','Favor de intentar de nuevo');
			
		}
		redirect('Cliente/Edit/'.$data['cliente']);

	}
	public function Edit(){
		$data['id'] = $this->uri->segment(3);
		$data['cliente'] = $this->Clientes->getCliente($data);
		$data['negocios'] = $this->Negocios->getAllCliente($data);
		$this->load->view('components/header',$data);
		$this->load->view('components/menuAdmin');
		$this->load->view('admin/negocios');
		$this->load->view('components/footer');
	}

	


}
