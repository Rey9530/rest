<?php defined('BASEPATH') or exit('No direct script access allowed');

class Iniciar_sesion_model extends CI_model{

    public function __construct()
    {
        parent:: __construct();
    }

    public function obtener_session(){
        return ($this->session->userdata('usuario')) ? $this->session->userdata('usuario') : null;
    }
    
    public function logueo($data){
        extract($data);
        if(!isset($usuario) || !isset($clave)){
            return array('estado'=>500,'msg'=>'Error de usuario y/o clave');
        }
        
        $this->db->where('usuario',$usuario);
        $this->db->where('clave', $clave);
        $this->db->where('estado',1);
        
        $data = $this->db->get('usuarios')->result_array();

        if(count($data)>0){ 
            $sesion = $this->session->set_userdata('usuario',$data[0]);
            $this->avisoDeAcceso(200);
            return array('estado'=>200,'msg'=>'Acceso Concedido'); 
        }else{
            $this->avisoDeAcceso(400,$usuario);
            return array('estado'=>400,'msg'=>'Error de session, acceso denegado');
        } 
    }

    public function avisoDeAcceso($estado,$usuario = ''){
        if($estado == 200){
            $usuario = $this->obtener_session();
            $accion_realizada                   = 'A ingresado al sistema';
            $campos['id_usuario']               = $usuario['id_usuario'];
            $campos['id_sucursal']              = $usuario['id_sucursal'];
            $campos['accion_realizada']         = $accion_realizada;
            $this->db->insert('bitacora',$campos);
        }else{
            $accion_realizada                   = '¡Aviso! Se ha realizado un intento de ingreso al sisterma con el usuario: '.mb_strtoupper($usuario);
            $campos['id_usuario']               = 1;
            $campos['id_sucursal']              = 1;
            $campos['accion_realizada']         = $accion_realizada;
            $this->db->insert('bitacora',$campos);
        }
    }

    public function cerrarSesion(){
        $usuario                      = $this->obtener_session();
        $accion_realizada             = 'A cerrado sesion';
        $campos['id_usuario']         = $usuario['id_usuario'];
        $campos['id_sucursal']        = $usuario['id_sucursal'];
        $campos['accion_realizada']   = $accion_realizada;
        if($this->db->insert('bitacora',$campos)){
            $this->session->sess_destroy();
            return 200;
        }
    }
}

