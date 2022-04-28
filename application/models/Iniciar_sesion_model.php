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
            return array('estado'=>200,'msg'=>'Acceso Concedido'); 
        }else{
            return array('estado'=>400,'msg'=>'Error de session, acceso denegado');
        } 
    }
}

