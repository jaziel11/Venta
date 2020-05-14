<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Los_Angeles');

class Pagos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Usuario");
        $this->load->model("Pago");
        $this->load->model("Proveedor");

        $usuarioSession = $this->session->userdata("sesiones");
        if (!$usuarioSession['ok']) {
            redirect('Login');
        }
    }

    public function All() {
        $data['proveedores'] = $this->Proveedor->getAll();
        $this->load->view('components/header', $data);
        $this->load->view('components/menu');
        $this->load->view('pagos/nuevo');

        $this->load->view('components/footer');
    }

    public function getAll() {
        $data['desde'] = date("Y-m-d");
        $data['hasta'] = date("Y-m-d");


        if ($this->input->post("desde") != null && $this->input->post("hasta") != null) {
            $data['desde'] = $this->input->post("desde");
            $data['hasta'] = $this->input->post("hasta");
        }
        if ($data['desde'] != null && $data['hasta'] != null) {

            $data['pagos'] = $this->Pago->getPagos($data);
            $data['pagosTitulo'] = $this->Pago->getPagosTitulo($data);
            $data['pagosMeses'] = $this->Pago->getPagosMeses($data);
            $data['pagosProveedor'] = $this->Pago->getPagosProveedor($data);

//            $data['titulos'] = $this->Pago->getTitulosFechas($data);

            $data['proveedores'] = $this->Proveedor->getAll();
            
            
        } else {
            $data['pagos'] = null;
        }
        if ($data['pagos'] != null) {
            $data['total'] = 0;
            foreach ($data['pagos'] as $pago) {
                $data['total'] += $pago['total'];
            }
        }
        $data['proveedores'] = $this->Proveedor->getAll();
        $this->load->view('components/header', $data);
        $this->load->view('components/menu');
        $this->load->view('pagos/all');

        $this->load->view('components/footer');
    }

    public function add() {
        $data['titulo'] = $this->input->post("titulo");
        $data['proveedor'] = $this->input->post("proveedor");
        $data['nvoProveedor'] = $this->input->post("nvoProveedor");
        $data['total'] = $this->input->post("total");
        $data['concepto'] = $this->input->post("concepto");
        $data['fecha'] = $this->input->post("fecha");

        if ($data['nvoProveedor'] != "") {
            if ($this->Proveedor->add($data)) {
                $ultimo = $this->Proveedor->getUltimo();
                $data['proveedor'] = $ultimo->ultimo;
            }
        }

        $inserto = $this->Pago->add($data);
        if ($inserto) {
            $this->session->set_userdata('okMensaje', 'Articulo Registrado');
        } else {
            $this->session->set_userdata('error', 'Favor de intentar de nuevo');
        }
        redirect('Pagos/All');
    }

}
