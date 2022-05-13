<?php defined('BASEPATH') or exit('No direct script access allowed');

class Bitacora_model extends CI_model{

    public function __construct(){
        parent:: __construct();
        $this->load->model('Iniciar_sesion_model');
        $this->usuario  = $this->Iniciar_sesion_model->obtener_session();
    }

    public function registroAcciones($accion_realizada){
        $campos['id_usuario']               = $this->usuario['id_usuario'];
        $campos['id_sucursal']              = $this->usuario['id_sucursal'];
        $campos['accion_realizada']         = $accion_realizada;
        $this->db->insert('bitacora',$campos);
    }
}

