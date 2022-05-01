<?php defined('BASEPATH') or exit('No direct script access allowed');

class Productos_model extends CI_model{

    public function __construct()
    {
        parent:: __construct();
    }

    public function guardar($post){ 
        extract($post);
        $data['descripcion'] = $producto;
        $data['precio']     = $precio;
        $data['id_categoria']     = $categoria;
        $data['nombre']     = $nombre;
        
        if(isset($archivo)){
            $data['img'] = $archivo;
        }
        if($tk_>0){            
            $this->db->where('id_producto',$tk_);
            if($this->db->update('productos',$data)){
                return array( 'estado'=>200, 'msj'=>'Almacenado con exito' );
            }else{
                return array( 'estado'=>400, 'msj'=>'Ha ocurrido al actualizar' );
            }

        }else{ 
            if($this->db->insert('productos',$data)){
                return array( 'estado'=>200, 'msj'=>'Almacenado con exito' );
            }else{
                return array( 'estado'=>400, 'msj'=>'Ha ocurrido al guardar' );
            }
        }
    } 

    public function eliminar_Producto($post){ 
        extract($post);
        $data['estado'] = 0; 

        $this->db->where('id_producto',intval($tk));
        if($this->db->update('productos',$data)){
            return array( 'estado'=>200, 'msj'=>'Datos elimiado con exito' );
        }else{
            return array( 'estado'=>400, 'msj'=>'Ha ocurrido al eliminar' );
        }
    } 

    public function obtener_imagen($id){ 
        

        $this->db->where('id_producto',intval($id));
        $data = $this->db->get('productos')->result_array();
        if(count($data)>0){
            return $data[0]['img'];
        }else{
            return '';
        }
    } 
}

