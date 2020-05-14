<?php 
	class Clientes extends CI_Model {
		public function __construct() {
	        parent::__construct();
	    }

		public function getAll(){
			$sql = "select id,nombre,apaterno,amaterno,fechaingreso,telefono,correo from cliente";

			$result = $this->db->query($sql);

			return $result->result_array();
		}
		public function getCliente($data){
			$sql = "select id,nombre,apaterno,amaterno,fechaingreso,telefono,correo from cliente where id=".$data['id'];

			$result = $this->db->query($sql);

			return $result->row();
		}
		public function Add($data){
			$sql = "INSERT INTO `puntoVenta1190`.`cliente` (`nombre`, `aPaterno`, `aMaterno`, `telefono`,  `fechaIngreso`) VALUES ('".$data['nombre']."', '".$data['apaterno']."', '".$data['amaterno']."', '".$data['telefono']."',  curdate());
";

			$result = $this->db->query($sql);

			return $result;
		}

		public function addNegocio($data){
			$sql = "INSERT INTO `puntoVenta1190`.`negocio` (`fechaIngreso`, `clienteId`, `nombre`) VALUES (curdate(), '".$data['cliente']."', '".$data['nombre']."');
";

			$result = $this->db->query($sql);

			return $result;
		}

	}

?>