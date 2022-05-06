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

