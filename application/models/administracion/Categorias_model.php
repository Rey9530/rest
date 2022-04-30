<?php defined('BASEPATH') or exit('No direct script access allowed');

class Categorias_model extends CI_model{

    public function __construct()
    {
        parent:: __construct();
    }

    public function guardar($post){ 
        extract($post);
        $data['descripcion'] = $categoria;
        
        if(isset($archivo)){
            $data['img'] = $archivo;
        }
        if($tk_>0){            
            $this->db->where('id_categoria',$tk_);
            if($this->db->update('categorias',$data)){
                return array( 'estado'=>200, 'msj'=>'Almacenado con exito' );
            }else{
                return array( 'estado'=>400, 'msj'=>'Ha ocurrido al guardar' );
            }

        }else{
            
            if($this->db->insert('categorias',$data)){
                return array( 'estado'=>200, 'msj'=>'Almacenado con exito' );
            }else{
                return array( 'estado'=>400, 'msj'=>'Ha ocurrido al guardar' );
            }
        }
    } 

    public function eliminar_categoria($post){ 
        extract($post);
        $data['estado'] = 0; 

        $this->db->where('id_categoria',intval($tk));
        if($this->db->update('categorias',$data)){
            return array( 'estado'=>200, 'msj'=>'Datos elimiado con exito' );
        }else{
            return array( 'estado'=>400, 'msj'=>'Ha ocurrido al eliminar' );
        }
    } 

    public function obtener_imagen($id){ 
        

        $this->db->where('id_categoria',intval($id));
        $data = $this->db->get('categorias')->result_array();
        if(count($data)>0){
            return $data[0]['img'];
        }else{
            return '';
        }
    } 
}

