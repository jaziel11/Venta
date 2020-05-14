<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

 	public function __construct(){
		parent::__construct();

		$this->load->model("Usuario"); 
		$this->load->model("Negocios"); 


	}
 	 public function index()
	{	
		$this->load->view("Login/main");
		$this->session->sess_destroy();

	}
	//mostrar la vista del login
	public function valida(){ 
		$data['pass'] = $this->input->post("pass");
		$data['user'] = $this->input->post("user");

		$usuario = $this->Usuario->Auth($data);
		if($usuario->total){
			$negocio = $this->Negocios->getNegocio($usuario->id);

			$usuarioInfo = array(
                'user' => $data['user'],
                'tipo' => $usuario->tipouser,
                'id' => $usuario->id,
                'nombrecompleto' => $usuario->nombrecompleto,
                'negocioid' => $negocio->negocioid,
                'ok' => 1,
                'negocio' => $negocio->negocio
                );
			$this->session->set_userdata("sesiones",$usuarioInfo);
			// $this->session->set_userdata('user',$data['user']);
			// $this->session->set_userdata('tipo',$usuario->tipouser);
			// $this->session->set_userdata('id',$usuario->id);
			// $this->session->set_userdata('nombrecompleto',$usuario->nombrecompleto);
			// $negocio = $this->Negocios->getNegocio($usuario->id);
			// $this->session->set_userdata('negocioid',$negocio->negocioid);
			// $this->session->set_userdata('ok',1);

			if((int)$usuario->tipouser == 3){
				redirect('Venta/Nueva');	
			}else{
				redirect('Cliente/GetAll');
			}			
		}else{
			$this->session->set_userdata('error','Usuario o Contrase&ntilde;a incorrectos');
			redirect('Login/index');
		}
	}
	public function logOut(){
		$this->session->sess_destroy();
		redirect('Login/index');
	}



}

/* End of file welcome.php */
/* Location: ./application/controllers/ */
