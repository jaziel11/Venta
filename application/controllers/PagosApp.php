<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Los_Angeles');

class PagosApp extends CI_Controller {
	public function __construct() {
	    parent::__construct();
		$this->load->model("Usuario"); 
		$this->load->model("Pago"); 
		$this->load->model("Proveedor"); 

		// $usuarioSession = $this->session->userdata("sesiones");
		// if(!$usuarioSession['ok'])
		// {
		// 	// redirect('Login');
		// }
	}	
	
	public function add(){
		$data['clave'] = $this->input->post("clave");

		if($data['clave']=="a1s2d3"){
			$data['actividad'] = $this->input->post("actividad");
			$data['latitud'] = $this->input->post("latitud");
			$data['longitud'] = $this->input->post("longitud");
			$data['lugar'] = $this->input->post("lugar");


			// if($data['nvoProveedor']!=""){
			// 	if($this->Proveedor->add($data)){
			// 		$ultimo = $this->Proveedor->getUltimo();
			// 		$data['proveedor']= $ultimo->ultimo;
			// 	}
			// }

			$inserto = $this->Pago->addActividad($data);
			if($inserto){
				// $this->session->set_userdata('okMensaje','Articulo Registrado');
				echo "1";
			}else{
				echo "0";
				// $this->session->set_userdata('error','Favor de intentar de nuevo');
			}

		}
	}
	


}
