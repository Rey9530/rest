<?php defined('BASEPATH') or exit('No direct script access allowed');

class Clientes_model extends CI_model{

    public function __construct(){
        parent:: __construct();
        $this->load->model('Bitacora_model');
        $this->load->model('Iniciar_sesion_model');
        $this->usuario  = $this->Iniciar_sesion_model->obtener_session();
    }

    public function cargarClientes(){
        $this->db->where('clientes.estado',1);
        $this->db->join('usuarios','usuarios.id_usuario=clientes.id_usuario');
        return $this->db->get('clientes')->result_array();
    }

    public function obtenerCliente($id_cliente){
        $this->db->where('clientes.id_cliente',$id_cliente);
        $this->db->join('usuarios','usuarios.id_usuario=clientes.id_usuario');
        return (array) $this->db->get('clientes')->row();
    }
    
    public function actualizarCliente($datos){
        $this->db->where('id_cliente',$datos['id_cliente']);
        if($this->db->update('clientes',$datos)) echo 200;
        $accion_realizada = 'Edito la informacion del cliente ID: '.$datos['id_cliente'];
        $this->Bitacora_model->registroAcciones($accion_realizada);
    }
    
    public function eliminarCliente($datos){
        $this->db->where('id_cliente',$datos['id_cliente']);
        $datos['estado']    = 0;
        if($this->db->update('clientes',$datos)) echo 200;
        $accion_realizada = 'Elimino el registro del cliente ID: '.$datos['id_cliente'];
        $this->Bitacora_model->registroAcciones($accion_realizada);
    }
}