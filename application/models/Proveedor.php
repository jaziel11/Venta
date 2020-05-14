<?php 
	class Proveedor extends CI_Model {
		public function __construct() {
	        parent::__construct();
	    }

		
		
		public function add($data){
			$usuarioSession = $this->session->userdata("sesiones");
			$sql = "INSERT INTO `puntoVenta1190`.`proveedor` (`id`, `nombre`,negocioid) VALUES (NULL, '".$data['nvoProveedor']."',".$usuarioSession['negocioid'].");";

			$result = $this->db->query($sql);

			return $result;
		}
		public function getUltimo(){
			$usuarioSession = $this->session->userdata("sesiones");

			$sql = "select max(id) as ultimo from proveedor where negocioid=".$usuarioSession['negocioid']."";

			$result = $this->db->query($sql);

			return $result->row();
		}
		public function getAll(){
			$usuarioSession = $this->session->userdata("sesiones");

			$sql = "select id,nombre from proveedor where negocioid=".$usuarioSession['negocioid']." order by nombre asc";

			$result = $this->db->query($sql);

			return $result->result_array();
		}

		

	}

?>