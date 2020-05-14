<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Los_Angeles');

class Venta extends CI_Controller {
	public function __construct() {
	    parent::__construct();
		$this->load->model("Usuario"); 
		$this->load->model("Item"); 
		$this->load->model("VentaM"); 

		$usuarioSession = $this->session->userdata("sesiones");
		if(!$usuarioSession['ok'])
		{
			redirect('Login');
		}
	}
	
	public function getAll(){
		$data['desde'] = date("Y-m-d");
		$data['hasta'] = date("Y-m-d");

		
		if($this->input->post("desde")!=null && $this->input->post("hasta")!=null){
			$data['desde'] = $this->input->post("desde");
			$data['hasta'] = $this->input->post("hasta");
		}
		$data['ventas'] = $this->VentaM->getVentasFecha($data['desde'],$data['hasta']);
		if($data['ventas']!=null){
			$data['total'] = 0;
			foreach ($data['ventas'] as $venta) {
				$data['total'] += $venta['total'];
			}
		}
		$this->load->view('components/header',$data);
		$this->load->view('components/menu');
		$this->load->view('Venta/all');
		$this->load->view('components/footer');
	}
	
	public function Nueva(){
		
		$this->load->view('components/header');
		$this->load->view('components/menu');
		$this->load->view('Venta/main');
		$this->load->view('components/footer');
	}
	public function add(){
		$producto = $this->Item->getItemCodigo($this->input->get("codigo"));
        if (count($producto) == 0) {
            $arr = array('id' => 0, 'precio' => 0, 'nombre' => 0);
        } else {
            $arr = array('id' => $producto->id, 'precio' => $producto->precioActual, 'nombre' => $producto->descripcion);
        }
        echo json_encode($arr);
	}
	public function insertarProducto(){
		$producto = $this->Item->insertarProducto($this->input->get("codigo"), $this->input->get("descripcion"), $this->input->get("precio"));

        if ($producto == 0) {
            $arr = array('id' => 0, 'precio' => 0, 'nombre' => 0);
        } else {
            $producto1 = $this->Item->getItemCodigo($this->input->get("codigo"));

        $arr = array('id' => $producto1->id, 'precio' => $producto1->precioActual, 'nombre' => $producto1->descripcion);
        }
        echo json_encode($arr);
	}
	public function Registrar() {
        $data['total'] = $this->input->post("total1");
        $data['cambio'] = $this->input->post("cambio");
        $data['pago'] = $this->input->post("pago");

        $data['ids'] = $this->input->post("ids");
        $data['cantidad'] = $this->input->post("cantidad");
        $data['precios'] = $this->input->post("precios");

        $inserto = $this->VentaM->insertaVenta($data);
        $ultimaVenta = $this->VentaM->getUltimo();
        for ($i = 0; $i < count($data['ids']); $i++) {
            $this->VentaM->insertaVentaDetalle($ultimaVenta->ultimo, $data['ids'][$i], $data['cantidad'][$i], $data['precios'][$i]);
            // $this->producto->actualizarPrecio($data['ids'][$i], $data['precios'][$i]);
        }
        $this->session->set_userdata('exito', 'Su Cambio es ' . $data['cambio']);
        redirect('Venta/Nueva');
    }

}
