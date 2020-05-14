<?php 
	class Usuario extends CI_Model {
		public function __construct() {
	        parent::__construct();
	    }

		public function Auth($data){
			$sql = "select count(id) as total,tipouser,id,concat(nombre,' ', apaterno) as nombrecompleto from usuario where usuario='".$data['user']."' and 
					pass = sha1('".$data['pass']."');";
					
			$result = $this->db->query($sql);

			return $result->row();
		}

	}

?>