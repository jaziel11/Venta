<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogos extends CI_Controller {
	// $usuario;
	public function __construct() {
	    parent::__construct();
		$this->load->model("Usuario"); 
		$this->load->model("Item"); 

		$usuarioSession = $this->session->userdata("sesiones");
		if(!$usuarioSession['ok'])
		{
			redirect('Login');
		}
	}
	
	
	public function Items(){
		$data['item'] = null;
		$data['id'] = $this->uri->segment(3);

		$data['busqueda'] = $this->input->post("busqueda");
		if($data['busqueda']==null){
			$data['items'] = $this->Item->getItems();
			if($data['id']!=null){
				$data['item'] = $this->Item->getItem($data['id']);
			}
		}else{
			$data['item'] = $this->Item->getItemsFindCode($data);
			$data['items'] = $this->Item->getItemsFindAll($data);
			if(count($data['item'])==0 && count($data['items'])==0){
				$this->session->set_userdata('error','Articulo no existe favor de agregarlo');

				redirect("Catalogos/AddItem/".$data['busqueda']);
			}
		}
		
		$this->load->view('components/header',$data);
		$this->load->view('components/menu');
		if($data['item']!=null){

			$this->load->view('catalogos/items/item');
		}else{
			$this->load->view('catalogos/items/items');
		}
       
		$this->load->view('components/footer');
	}
	public function AddItem(){
		$data['codigoF'] = $this->uri->segment(3);
		$this->load->view('components/header',$data);
		$this->load->view('components/menu');   
		$this->load->view('catalogos/items/addItem');
    
		$this->load->view('components/footer');
	}
	public function AddItem1(){
		$data['descripcion'] = $this->input->post("descripcion");
		$data['codigo'] = $this->input->post("codigo");
		$data['precio1'] = $this->input->post("precio1");
		$data['precio2'] = $this->input->post("precio2");

		$inserto = $this->Item->addItem($data);
		if($inserto){
			$this->Item->addItemNegocio($data);
			$this->session->set_userdata('okMensaje','Articulo Registrado');
			redirect('Catalogos/Items');
		}else{
			$this->session->set_userdata('error','Favor de intentar de nuevo');
			redirect('Catalogos/AddItem');
		}

	}

	
	
	public function editItem(){
		$data['id'] = $this->input->post("id");
		$data['precio1'] = $this->input->post("precio1");
		$data['precio2'] = $this->input->post("precio2");
		$data['descripcion'] = $this->input->post("descripcion");
		$inserto = $this->Item->editItem($data);
		if($inserto){
			$devuelto = $this->Item->existeItem($data);
			if($devuelto->total>0){
				$this->Item->editItemNegocio($data);
			}else{
				$this->Item->addItemNegocioNuevo($data);

			}
			$this->session->set_userdata('okMensaje','Articulo Actualizado');
			
		}else{
			$this->session->set_userdata('error','Favor de intentar de nuevo');
		}
		 redirect('Catalogos/Items/'.$data['id']);

	}
	public function getItem(){
		$this->load->view('components/header');
		$this->load->view('components/menu');

       
		$this->load->view('components/footer');
	}
	public function Proveedores(){
		
		$this->load->view('components/header');
		$this->load->view('components/menu');       
		$this->load->view('components/footer');
	}
	


}
