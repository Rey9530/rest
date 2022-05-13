<?php defined('BASEPATH') or exit('No direct script access allowed');

class MensajeWhatsapp_model extends CI_model{

    public function __construct(){
        parent:: __construct();
        $this->load->model('Bitacora_model');
        $this->load->model('Iniciar_sesion_model');
        $this->usuario  = $this->Iniciar_sesion_model->obtener_session();
    }

    public function cargarSucursal($datos){

        $opciones = '<option value="">Seleccionar sucursal</option>';
    
        $this->db->where('estado',1);
        $evento = $this->db->get('sucursales');
        foreach($evento->result_array() as $row){
            $seleccionar = (($datos['id_sucursal'] == $row['id_sucursal']) ? 'selected':'' );
            $opciones .= '<option '.$seleccionar.' value="'.$row['id_sucursal'].'">'.$row['nombre_sucursal'].'</option>';
        }
        echo $opciones;
    }

    public function cargarMensajeWhatsapp(){
        $this->db->select('mensaje_whatsapp.*,usuarios.nombre');
        $this->db->join('usuarios','usuarios.id_usuario=mensaje_whatsapp.id_usuario');
        return $this->db->get('mensaje_whatsapp')->result_array();
    }
    
    public function modalMensajeWhatsapp($datos){
        $this->db->where('id_mensaje',$datos['id_mensaje']);
        return (array) $this->db->get('mensaje_whatsapp')->row();
    }
    
    public function guardarMensaje($datos){
        $id_mensaje     = $datos['id_mensaje'];
        unset($datos['id_mensaje']);
        
        if($id_mensaje == 0){
            $datos['id_usuario'] = $this->usuario['id_usuario'];
            if($this->db->insert('mensaje_whatsapp',$datos)) echo 200;
            $accion_realizada = 'Registro un nuevo mensaje ID '.$this->db->insert_id().', con titulo de: '.$datos['titulo_mensaje'];
        }else{
            $this->db->where('id_mensaje',$id_mensaje);
            if($this->db->update('mensaje_whatsapp',$datos)) echo 200;
            $accion_realizada = 'Actualizo el nuevo mensaje ID '.$id_mensaje.', con titulo de: '.$datos['titulo_mensaje'];
        }
        $this->Bitacora_model->registroAcciones($accion_realizada);
    }

    public function cambiarEstado($datos){
        $this->db->where('id_mensaje',$datos['id_mensaje']);
        $this->db->set('estado',$datos['valor']);
        if($this->db->update('mensaje_whatsapp')){
            echo 200;
            if($datos['valor'] == 1){
                $estado = 'abilito';
            }else{
                $estado = 'inhabilito';
            }
            $accion_realizada = 'Cambio el mensaje ID '.$datos['id_mensaje'].', a estado: '.$estado;
            $this->Bitacora_model->registroAcciones($accion_realizada);
        }
    }
}