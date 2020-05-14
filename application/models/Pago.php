<?php

class Pago extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function add($data) {
        $usuarioSession = $this->session->userdata("sesiones");

        $sql = "INSERT INTO `puntoVenta1190`.`pago` (`id`, `fecha`,hora, `total`, `concepto`, `titulo`, `proveedorId`, `negocioId`) VALUES (NULL, '" . $data['fecha'] . "',curtime(), '" . $data['total'] . "', '" . $data['concepto'] . "', '" . $data['titulo'] . "', '" . $data['proveedor'] . "', '" . $usuarioSession['negocioid'] . "');
";

        $result = $this->db->query($sql);

        return $result;
    }

    public function addActividad($data) {
        // $usuarioSession = $this->session->userdata("sesiones");

        $sql = "INSERT INTO `puntoVenta1190`.`actividad` (`fecha`, `hora`, `descripcion`, `latitud`, `longitud`, `lugar`) VALUES 
			(curdate(), curtime(), '" . $data['actividad'] . "', " . $data['latitud'] . ", " . $data['longitud'] . ", '" . $data['lugar'] . "');";

        $result = $this->db->query($sql);

        return $result;
    }

    public function getPagos($data) {
        $usuarioSession = $this->session->userdata("sesiones");

        $sql = "SELECT id,fecha,total,concepto,titulo,proveedorId,negocioid,hora
					FROM `pago`
					WHERE negocioid=" . $usuarioSession['negocioid'] . " and (fecha >= '" . $data['desde'] . "'
					AND fecha <= '" . $data['hasta'] . "')
					";

        $result = $this->db->query($sql);

        return $result->result_array();
    }

    public function getPagosTitulo($data) {
        $usuarioSession = $this->session->userdata("sesiones");

        $sql = "SELECT id,fecha,sum(total) as total,concepto,titulo,proveedorId,negocioid,hora
					FROM `pago`
					WHERE negocioid=" . $usuarioSession['negocioid'] . " and (fecha >= '" . $data['desde'] . "'
					AND fecha <= '" . $data['hasta'] . "') group by titulo order by total desc
					";

        $result = $this->db->query($sql);

        return $result->result_array();
    }

    public function getPagosMeses($data) {
        $usuarioSession = $this->session->userdata("sesiones");

        $sql = "select titulo,date_format(fecha,'%Y-%m') as fecha,sum(total) as total from  pago where negocioid=" . $usuarioSession['negocioid'] . " and (fecha >= '" . $data['desde'] . "'
					AND fecha <= '" . $data['hasta'] . "')";
        $sql .= "group by date_format(fecha,'%Y-%m');";
        $result = $this->db->query($sql);

        return $result->result_array();
    }
    public function getPagosProveedor($data) {
        $usuarioSession = $this->session->userdata("sesiones");

        $sql = "select proveedorid,avg(total) as promedio,count(*) as pagos,max(total) as maximo,sum(total) as total from  pago where negocioid=" . $usuarioSession['negocioid'] . " and (fecha >= '" . $data['desde'] . "'
					AND fecha <= '" . $data['hasta'] . "')";
        $sql .= "group by proveedorid order by total desc";
        $result = $this->db->query($sql);

        return $result->result_array();
    }
    
    public function getTitulosFechas($data) {
        $usuarioSession = $this->session->userdata("sesiones");

        $sql = "select titulo from pago where negocioid=" . $usuarioSession['negocioid'] . "  and (fecha >= '" . $data['desde'] . "'
					AND fecha <= '" . $data['hasta'] . "') group by titulo;";
        $result = $this->db->query($sql);

        return $result->result_array();
    }
    
    

}

?>