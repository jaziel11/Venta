<?php 
	class Item extends CI_Model {
		public function __construct() {
	        parent::__construct();
	    }


		public function addItem($data){
			$result = 0;
 			$usuarioSession = $this->session->userdata("sesiones");
			$sql = "INSERT INTO `puntoVenta1190`.`item` (`descripcion`, `codigo`,precio,usuario) VALUES ('".$data['descripcion']."', '".$data['codigo']."',".$data['precio1'].".".$data['precio2'].",
			".$usuarioSession["id"].");";
			try{
				$result = $this->db->query($sql);
			}catch(Exception $a){

			}
			

			return $result;
		}
		public function addItemNegocio($data){
			$result = 0;
			$usuarioSession = $this->session->userdata("sesiones");
			$sql = "INSERT INTO `puntoVenta1190`.`negocioItem` (`negocioId`, `productoId`,precio) VALUES (".$usuarioSession["negocioid"].", (select max(id) from item where usuario=".$usuarioSession["id"]."),
			".$data['precio1'].".".$data['precio2'].");";
			try{
				$result = $this->db->query($sql);
			}catch(Exception $a){

			}
			

			return $result;
		}
		public function addItemNegocioNuevo($data){
			$result = 0;
			$usuarioSession = $this->session->userdata("sesiones");
			$sql = "INSERT INTO `puntoVenta1190`.`negocioItem` (`negocioId`, `productoId`,precio) VALUES (".$usuarioSession["negocioid"].", ".$data['id'].",
			".$data['precio1'].".".$data['precio2'].");";
			try{
				$result = $this->db->query($sql);
			}catch(Exception $a){

			}
			

			return $result;
		}
		public function editItem($data){
			$result = 0;

			$sql = "UPDATE `puntoVenta1190`.`item` SET `precio`='".$data['precio1'].".".$data['precio2']."',
			descripcion='".$data['descripcion']."' WHERE `id`=".$data['id'].";";
			try{
				$result = $this->db->query($sql);
			}catch(Exception $a){

			}
			

			return $result;
		}
		public function editItemNegocio($data){
			$usuarioSession = $this->session->userdata("sesiones");
			$result = 0;

			$sql = "UPDATE `puntoVenta1190`.`negocioItem` SET `precio`='".$data['precio1'].".".$data['precio2']."' WHERE `productoid`=".$data['id']." and negocioid=".$usuarioSession['negocioid'].";";
			echo $sql;
			try{
				$result = $this->db->query($sql);
			}catch(Exception $a){

			}
			

			return $result;
		}
		public function insertarProducto($upc,$descripcion,$precio){
	        $sql = "INSERT INTO item (codigo,descripcion,precio) VALUES ('".$upc."', '".$descripcion."', ".$precio." )";
	        $res = $this->db->query($sql);
	        return $res;
	    }
		public function getItemCodigo($upc){
			$usuarioSession = $this->session->userdata("sesiones");
	        $sql = "select ifnull(id,0) as id,descripcion,ifnull((select precio from negocioItem where productoid=item.id and 
			negocioid=".$usuarioSession['negocioid']." limit 1),0)as precioActual from item where codigo ='".$upc."'";
	        $res = $this->db->query($sql);
	        return $res->row();
	    }

		public function getItems(){
			$usuarioSession = $this->session->userdata("sesiones");
			$sql = "select id,descripcion,ifnull((select precio from negocioItem where productoid=item.id and 
			negocioid=".$usuarioSession['negocioid']." limit 1),0) as precio,codigo,baja from item order by descripcion asc";
				$result = $this->db->query($sql);	

			return $result->result_array();
		}
		public function getItem($id){
			$usuarioSession = $this->session->userdata("sesiones");
			$sql = "select id,descripcion,ifnull((select precio from negocioItem where productoid=item.id and 
			negocioid=".$usuarioSession['negocioid']."),0) as precio,codigo,baja from item where id=".$id." order by descripcion asc";
				$result = $this->db->query($sql);	

			return $result->row();
		}
		public function existeItem($data){
			$usuarioSession = $this->session->userdata("sesiones");
			$sql = "select count(*) as total from negocioItem where productoid=".$data['id']." and negocioid=".$usuarioSession['negocioid'].";";
				$result = $this->db->query($sql);	

			return $result->row();
		}
		public function getItemsFindCode($data){
			$usuarioSession = $this->session->userdata("sesiones");
			$sql = "select id,descripcion,ifnull((select precio from negocioItem where productoid=item.id and 
			negocioid=".$usuarioSession['negocioid']."),0) as precio,codigo,baja from item where codigo = '".$data['busqueda']."' order by descripcion asc";
				$result = $this->db->query($sql);	

			return $result->row();
		}
		public function getItemsFindAll($data){
			$usuarioSession = $this->session->userdata("sesiones");
			$sql = "select id,descripcion,ifnull((select precio from negocioItem where productoid=item.id and 
			negocioid=".$usuarioSession['negocioid']." limit 1),0) as precio,codigo,baja from item where
			 codigo like '%".$data['busqueda']."%' or descripcion like '%".$data['busqueda']."%' order by descripcion asc";
				$result = $this->db->query($sql);	

			return $result->result_array();
		}
	}

?>