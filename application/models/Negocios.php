<?php 
	class Negocios extends CI_Model {
		public function __construct() {
	        parent::__construct();
	    }

		public function getAllCliente($data){
			$sql = "select id,fechaingreso,nombre,clienteid,
			(select count(id) from negocioUsuario where negocioid=negocio.id) as usuarios,
			(select count(id) from negocioItem where negocioid=negocio.id) as items
			 from negocio where 
			clienteid=".$data['id'];
			echo $sql;
			$result = $this->db->query($sql);

			return $result->result_array();
		}
		public function addUsuario($data){
			$sql = "INSERT INTO `puntoVenta1190`.`usuario` (`usuario`, `nombre`, `apaterno`, `amaterno`, `fechaingreso`, `pass`, `tipouser`) VALUES ('".$data['usuario']."', '".$data['nombre']."', '".$data['apaterno']."', '".$data['amaterno']."', curdate(), sha1('".$data['pass']."'), '".$data['tipo']."');";

			$result = $this->db->query($sql);

			return $result;

		}

		public function addNegocioUsuario($data){
			$sql = "INSERT INTO `puntoVenta1190`.`negocioUsuario` (`negocioId`, `usuarioId`) VALUES (
			'".$data['negocioid']."', (select max(id) from usuario));";
			$result = $this->db->query($sql);

			return $result;

		}
			public function Add($data){
			$sql = "INSERT INTO `puntoVenta1190`.`cliente` (`nombre`, `aPaterno`, `aMaterno`, `telefono`,  `fechaIngreso`) VALUES ('".$data['nombre']."', '".$data['apaterno']."', '".$data['amaterno']."', '".$data['telefono']."',  curdate());
";

			$result = $this->db->query($sql);

			return $result;
		}
		public function getNegocio($user){
			$sql = "select negocioid,(select nombre from negocio where id=negocioid) as negocio from negocioUsuario where usuarioid=".$user;
			echo $sql;
			$result = $this->db->query($sql);

			return $result->row();
		}
		
		
	}

?>