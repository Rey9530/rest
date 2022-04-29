<?php defined('BASEPATH') or exit('No direct script access allowed');

class Mesas_model extends CI_model{

    public function __construct()
    {
        parent:: __construct();
    }

    public function guardar($post){ 
        extract($post);
        $data['descripcion'] = $descripcion;
        $data['capacidad'] = $capacidad;
        if($tk_>0){            
            $this->db->where('id_mesa',$tk_);
            if($this->db->update('mesas',$data)){
                return array( 'estado'=>200, 'msj'=>'Almacenado con exito' );
            }else{
                return array( 'estado'=>400, 'msj'=>'Ha ocurrido al guardar' );
            }

        }else{
            
            if($this->db->insert('mesas',$data)){
                return array( 'estado'=>200, 'msj'=>'Almacenado con exito' );
            }else{
                return array( 'estado'=>400, 'msj'=>'Ha ocurrido al guardar' );
            }
        }
    } 

    public function eliminar_mesa($post){ 
        extract($post);
        $data['estado'] = 0; 

        $this->db->where('id_mesa',intval($tk));
        if($this->db->update('mesas',$data)){
            return array( 'estado'=>200, 'msj'=>'Datos elimiado con exito' );
        }else{
            return array( 'estado'=>400, 'msj'=>'Ha ocurrido al eliminar' );
        }
    } 
}

