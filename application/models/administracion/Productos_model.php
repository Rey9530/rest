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

    public function btn_add_componente_detalle($post){ 
        extract($post);
        $data['descripcion']    = (isset($componente_name_detalle_))?$componente_name_detalle_:0 ;
        $data['precio']         = (isset($precio_))?$precio_:0; 
        $data['id_componente']  = (isset($tk_))?$tk_:0; 
        
        if($this->db->insert('productos_componentes_detalle',$data)){
            return array( 'estado'=>200, 'msj'=>'Almacenado con exito' );
        }else{
            return array( 'estado'=>400, 'msj'=>'Ha ocurrido al guardar' );
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

    public function eliminar_componente($post){ 
        extract($post);
        $data['estado'] = 0;  
        $this->db->where('id_componenete',intval($tk));
        if($this->db->update('productos_componentes',$data)){
            return array( 'estado'=>200, 'msj'=>'Datos elimiado con exito' );
        }else{
            return array( 'estado'=>400, 'msj'=>'Ha ocurrido al eliminar' );
        }
    } 

    public function eliminar_detalle_componente($post){ 
        extract($post);
        $data['estado'] = 0;  
        $this->db->where('id_componente_detalle',intval($tk));
        if($this->db->update('productos_componentes_detalle',$data)){
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

    public function guardar_componente($post){ 
        extract($post);
        $datos_i['id_producto'] = (isset($tk_))?$tk_:0;
        $datos_i['nombre'] = (isset($componente_name))?$componente_name:0; 
        if($this->db->insert('productos_componentes',$datos_i)){
            return array( 'estado'=>200, 'msj'=>'Almacenado con exito' );
        }else{
            return array( 'estado'=>400, 'msj'=>'Ha ocurrido al guardar' );
        }
    } 
}

