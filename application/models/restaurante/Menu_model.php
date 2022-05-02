<?php defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_model{

    public function __construct()
    {
        parent:: __construct();
    }

    public function cambiar_estado($post){ 
        extract($post);
        $estado['estado_disponibilidad'] = ($estatus=='true') ? 1 : 0;
        if($select_categorias>0){
            $this->db->where('id_categoria',$select_categorias);
        }
        if($this->db->update('productos',$estado)){
            return array( 'estado'=>200, 'msj'=>'Actualizado con exito' );
        }
        return array( 'estado'=>500, 'msj'=>'Error al actualizar' ); 
    }

    public function cambiar_estado_detallado($post){ 
        extract($post);
        $data['estado_disponibilidad'] = ($estado=='true') ? 1 : 0;
        $this->db->where('id_producto',$tk);
        if($this->db->update('productos',$data)){
            return array( 'estado'=>200, 'msj'=>'Actualizado con exito' );
        }
        return array( 'estado'=>500, 'msj'=>'Error al actualizar' ); 
    }

    public function obtener_menu($post){ 
        $input_date = $post['input_date'];
        $select_categorias = $post['select_categorias'];
        
        $json['estado'] = 200;

        $sql ='';
        if($select_categorias>0){
            $sql =' AND productos.id_categoria='.$select_categorias;
        }

        $input_date = date('Y-m-d', strtotime($input_date));
        $data = $this->db->query('SELECT productos.*,categorias.descripcion AS categoria_descripcion FROM productos INNER JOIN categorias ON categorias.id_categoria=productos.id_categoria WHERE productos.estado=1 '.$sql); 
        foreach ($data->result_array() AS $item ) {
            $item = (object) $item; 

            // $this->db->where('id_producto',$item->id_producto); 
            // $this->db->where('estado',1); 
            // $this->db->where('
            //     (
            //         (fecha="'.$input_date.'" AND tipo_disponibilidad=1) 
            //         OR
            //         (fecha="'.$input_date.'" AND tipo_disponibilidad=2)
            //         OR
            //         (AND tipo_disponibilidad=3)
            //     '); 
            // $data = $this->db->get('menu_disponibilidad'); 

            $url = base_url().'archivos/productos/'.$item->img;
            $en_venta = ($item->estado_disponibilidad==1) ? 'checked' : ''; 
            $json['detalle'][] = array(
                'nombre'=>$item->nombre,
                'producto'=>$item->id_producto,
                'descripcion'=>$item->descripcion,
                'precio'=>$item->precio,
                'estado'=>$item->estado,
                'en_venta'=>$en_venta,
                'categoria_descripcion'=>$item->categoria_descripcion,
                'url'=>$url,
            );
        }

        return $json;
    } 
}

