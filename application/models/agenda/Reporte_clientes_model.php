<?php defined('BASEPATH') or exit('No direct script access allowed');

class Reporte_clientes_model extends CI_model{

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
    
}