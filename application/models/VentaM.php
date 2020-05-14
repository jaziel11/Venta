<?php
class VentaM extends CI_Model {
    
    public function insertaVenta($data){
        $usuarioSession = $this->session->userdata("sesiones");
        $sql = "INSERT INTO venta (fecha, hora, total,cambio,pago,negocio,usuario) VALUES (curdate(), curtime(),". $data['total']." ,". $data['cambio']." ,". $data['pago'].",".$usuarioSession["negocioid"].",".$usuarioSession["id"]." )";
        $res = $this->db->query($sql);
        return $res;
    }
    public function insertaVentaDetalle($venta,$id,$cantidad,$precio){
        $sql = "INSERT INTO ventadetalle (ventaid, productoid, cantidad, precio) VALUES ($venta, $id, $cantidad, $precio)";
        $res = $this->db->query($sql);
        return $res;
    }
    public function getUltimo(){
        $usuarioSession = $this->session->userdata("sesiones");

        $sql = "select max(id) as ultimo from venta where negocio=".$usuarioSession['negocioid'];
        $res = $this->db->query($sql);
        return $res->row();
        
    }
    
    public function getVentas(){
        
        $sql="select id,fecha,hora,total from venta where fecha = curdate() and negocio=".$usuarioSession['negocioid']."  order by id desc";
        $res=$this->db->query($sql);
        return $res->result_array();        
        
    }
    public function getVentasFecha($inicio,$fin){
        $usuarioSession = $this->session->userdata("sesiones");
        $sql="select id,fecha,hora,total from venta where fecha>='$inicio' and fecha<='$fin' and negocio=".$usuarioSession['negocioid']." order by id desc";
        $res=$this->db->query($sql);
        return $res->result_array();  
    }
}
