<?php defined('BASEPATH') or exit('No direct script access allowed');

class Reporte_reservas_model extends CI_model{

    public function __construct(){
        parent:: __construct();
        $this->load->model('Bitacora_model');
        $this->load->model('Iniciar_sesion_model');
        $this->usuario  = $this->Iniciar_sesion_model->obtener_session();
    }

    public function cargarSucursales(){
        
        $opciones = '<option value="0">Todas</option>';

        $this->db->where('estado',1);
        $evento = $this->db->get('sucursales');
        foreach($evento->result_array() as $row){
            $seleccionar = (($this->usuario['id_sucursal'] == $row['id_sucursal']) ? 'selected':'' );
            $opciones .= '<option '.$seleccionar.' value="'.$row['id_sucursal'].'">'.$row['nombre_sucursal'].'</option>';
        }
        echo $opciones;
    }

    public function obtenerReservas($inicio,$fin,$id_sucursal){
        $inicio = date('Y-m-d',strtotime($inicio));
        $fin    = date('Y-m-d',strtotime($fin));

        if($id_sucursal > 0){
            $this->db->where('agenda_eventos.id_sucursal',$id_sucursal);
        }
        $this->db->where('DATE(agenda_eventos.fecha_capturada) BETWEEN "'.$inicio.'" AND "'.$fin.'" ');
        $this->db->join('sucursales','sucursales.id_sucursal=agenda_eventos.id_sucursal');
        $this->db->join('usuarios','usuarios.id_usuario=agenda_eventos.id_usuario');
        $this->db->join('clientes','clientes.id_cliente=agenda_eventos.id_cliente');
        return $this->db->get('agenda_eventos')->result_array();
    }
}