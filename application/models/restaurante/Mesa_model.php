<?php defined('BASEPATH') or exit('No direct script access allowed');

class Mesa_model extends CI_model{

    public function __construct()
    {
        parent:: __construct();
    }

    public function asignar_mesa($post)
    { extract($post);

        $datos_i['cliente']     = (isset($cliente))?$cliente:'N/AA';
        $datos_i['cantidad']    = (isset($cantidad))?$cantidad:0;
        $datos_i['id_mesa']     = (isset($id_mesa))?$id_mesa:0;
        $datos_i['observacion'] = (isset($observacion))?$observacion:'';

        if($this->db->insert('mesas_cuentas',$datos_i)){
            return array( 'msj'=>'Ingresado con exito','estado'=>200 );
        }
        return array( 'msj'=>'Ha ocurrido un error favor intentarlo mas tarde','estado'=>500 );
    }

    public function agregar_al_detalle($post)
    { 
        $detalle    = ($this->session->userdata('detalle_venta')) ? $this->session->userdata('detalle_venta') : array();
     
        $array  = array();
        $item   = $post;
        $datos_array = $this->db->query('SELECT * FROM productos WHERE id_producto='.$item['tk_producto'])->result_array(); 
        if(!count($datos_array)>0){  return array( 'msj'=>'Ooops ha ocurrido un error favor intentarlo mas tarde ','estado'=>500 );  }
        $datos_c = $datos_array[0];
        $array['prodcuto']      = $datos_c['nombre'];
        $array['url']           = base_url().'archivos/productos/'.$datos_c['img'];
        $array['precio']        = $datos_c['precio'];
        $array['cantidad']      = $item['cantidad'];
        $array['comentario']    = $item['comentario'];
        $array['contador']      = $item['contador'];
        $array['tk_producto']   = $item['tk_producto'];
        $array['tk']            = time().count($detalle);
        
        $_array = array();
        for( $i = 1; $i<=$item['contador']; $i ++ ){
            if(!isset($item['componente_'.$i])){ continue; }
            $id_componente = $item['componente_'.$i];
            $datos_comp = $this->db->query('SELECT * FROM productos_componentes_detalle WHERE id_componente_detalle='.$id_componente)->result_array(); 
            if(!count($datos_comp)>0){  return array( 'msj'=>'Ooops ha ocurrido un error favor intentarlo mas tarde ','estado'=>500 );  }
            $data_comp = $datos_comp[0];
            $_array[] = array(
                'nombre' => $data_comp['descripcion'],
                'tk_componente_detalle' => $data_comp['id_componente_detalle'],
                'precio' => $data_comp['precio'],
            ); 
            $array['precio'] += $data_comp['precio'];
        }
        $array['precio'] = number_format( $array['precio'],2,'.','');
        $array['detalle_componentes'] =$_array;

        $detalle[]  = $array;  
        $this->session->set_userdata('detalle_venta',$detalle);
        return array( 'msj'=>'Agregado con exito','estado'=>200 ); 
    }

    public function obtener_detalle_orden()
    {  
        $detalle    = ($this->session->userdata('detalle_venta')) ? $this->session->userdata('detalle_venta') : array();
        return array( 'detalle'=>$detalle,'estado'=>200 ); 
    }

    public function finalizar_cuenta($id_cuenta)
    {  
        
        $data['estado'] = 2;
        $this->db->where('id_cuenta',$id_cuenta);
        if($this->db->update('mesas_cuentas',$data)){
            return array( 'estado'=>200, 'msj'=>'Cuenta cerrada' );
        }
        return array( 'estado'=>500, 'msj'=>'Ha ocurrido un error' );
    }

    public function eliminar_detalle($detalle=0)
    {  
        $data['estado'] = 0;
        $this->db->where('id_detalle',$detalle);
        if($this->db->update('ordenes_restaurante_detalle',$data)){
            return array( 'estado'=>200, 'msj'=>'Item eliminado' );
        }
        return array( 'estado'=>500, 'msj'=>'Ha ocurrido un error' );
        
    }

    public function finalizar_orden($tk_orden=0)
    {  
        if(!$tk_orden>0){ return array('estado'=>500,'msj'=>'Error de cuenta, favor reiniciar el proceso'); }
        $detalle    = ($this->session->userdata('detalle_venta')) ? $this->session->userdata('detalle_venta') : array();
        if(!COUNT($detalle)>0){ return array('estado'=>500,'msj'=>'El carrito esta vacio'); }
        

        $orden['id_cuenta'] = $tk_orden;

        if($this->db->insert('ordenes_restaurante',$orden )){
            $id_orden = $this->db->insert_id();
            if(!$id_orden>0){
                return array( 'estado'=>500,'msj'=>'Error al generar cuenta, favor intentarlo mas tarde'); 
            }

            $existos = 0;
            foreach ($detalle AS $item) {
                $monto_complementos = 0;
                $ids_complementos = array();
                foreach ($item['detalle_componentes'] AS $detalle_c) {
                    $monto_complementos += floatval($detalle_c['precio']);
                    $ids_complementos[] = $detalle_c['tk_componente_detalle'];
                }
                $ids_string = implode(',',$ids_complementos);
                
                $sub_total = (floatval($monto_complementos) + floatval($item['precio'])) * floatval($item['cantidad']);
                $data['id_orden'] = $id_orden;
                $data['id_producto'] = $item['tk_producto'];
                $data['cantidad'] = $item['cantidad'];
                $data['precio'] = floatval($item['precio']);
                $data['monto_complementos'] = $monto_complementos;
                $data['sub_total'] = $sub_total;
                $data['ids_complementos'] = $ids_string;
                $data['comentario'] = $item['comentario']; 
                if($this->db->insert('ordenes_restaurante_detalle',$data)){
                    $existos ++;
                }
            }
            if($existos==COUNT($detalle)){
                return array( 'estado'=>200,'msj'=>'Orden creada con exito','detalle'=>$detalle ); 
            }
            return array( 'estado'=>500,'msj'=>'Ha ocurrido un error favor verificar, favor verificar la cuenta.'); 
        }
        return array( 'estado'=>500,'msj'=>'Ha ocurrido al crear la orden, favor reintentar.'); 
    }
  
    public function obtener_mesas(){          
        $json['estado'] = 200;
        $sql =''; 
 
        $data = $this->db->query('SELECT * FROM mesas WHERE estado=1 '); 
        foreach ($data->result_array() AS $item ) {
            $item = (object) $item;  

            $datos_c = $this->db->query('SELECT * FROM mesas_cuentas WHERE estado=1 AND id_mesa='.$item->id_mesa.' ORDER BY id_cuenta LIMIT 1 ')->result_array(); 
            
            $json['detalle'][] = array(
                'tk_mesa'=>$item->id_mesa,
                'background'=> (count($datos_c)>0) ? '#4361ee' : '#2ECC71', 
                'descripcion'=>$item->descripcion,
                'capacidad'=>$item->capacidad,
                'estado'=>  (count($datos_c)>0) ? $datos_c[0]['cliente'] : 'Disponible',
                'tk_cuenta'=>  (count($datos_c)>0) ? $datos_c[0]['id_cuenta'] : 0
            );
        }

        return $json;
    } 
}

