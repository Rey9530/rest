<?php defined('BASEPATH') or exit('No direct script access allowed');

class Agenda_reserva_model extends CI_model{

    public function __construct(){
        parent:: __construct();
        $this->load->model('Bitacora_model');
        $this->load->model('Iniciar_sesion_model');
        $this->usuario  = $this->Iniciar_sesion_model->obtener_session();
    }

    public function cargarAgendaReserva($datos){

        $start      = date('Y-m-d',strtotime($datos['start']));
        $end        = date('Y-m-d',strtotime($datos['end']));
        $contenedor = array();
        $e          = array();
        $x          = 0;

        if($datos['ids'] > 0){
            $this->db->where('agenda_eventos.id_sucursal',$datos['ids']);
        }
        $this->db->where('agenda_eventos.estado != 0');
        $this->db->where('date(agenda_eventos.fecha_capturada) BETWEEN "'.$start.'" AND "'.$end.'" ');
        $this->db->join('clientes','clientes.id_cliente=agenda_eventos.id_cliente');
        // $this->db->join('tipo_evento','tipo_evento.id_tipo_evento=agenda_eventos.id_tipo_evento','left');
        $evento = $this->db->get('agenda_eventos')->result_array();
        foreach($evento as  $row){

            $e['id']                        = 'evento-'.$x;
            $e['id_agenda_reserva']         = $row['id_agenda_reserva'];
            $e['start']                     = $row['start'];
            $e['end']                       = $row['end'];
            $e['backgroundColor']           = $row['color_fondo'];
            $e['description']               = 'Nota: '.$row['nota'];
            $e['title']                     = $row['nombre_cliente'];
            
            $x++;
            array_push($contenedor,$e);
        }
        echo json_encode($contenedor);
    }

    public function cargarTipoEvento($datos){

        $opciones = '';

        $this->db->where('estado',1);
        $evento = $this->db->get('tipo_evento');
        foreach($evento->result_array() as $row){
            $seleccionar = (($datos['id_tipo_evento'] == $row['id_tipo_evento']) ? 'selected':'' );
            $opciones .= '<option style="color: '.$row['color_fondo'].';" '.$seleccionar.' value="'.$row['id_tipo_evento'].'">'.$row['nombre_evento'].'</option>';
        }
        echo $opciones;
    }

    public function cargarSucursal($datos){

        if($datos['tipo'] == 0){
            $opciones = '<option value="">Seleccionar sucursal</option>';
        }else{
            $opciones = '<option value="0">Todas</option>';
        }

        $this->db->where('estado',1);
        $evento = $this->db->get('sucursales');
        foreach($evento->result_array() as $row){
            $seleccionar = (($datos['id_sucursal'] == $row['id_sucursal']) ? 'selected':'' );
            $opciones .= '<option '.$seleccionar.' value="'.$row['id_sucursal'].'">'.$row['nombre_sucursal'].'</option>';
        }
        return $opciones;
    }
    
    public function cargarColorFondo($datos){

        $this->db->where('estado',1);
        $this->db->where('id_tipo_evento',$datos['id_tipo_evento']);
        echo json_encode((array) $this->db->get('tipo_evento')->row());

    }
    
    public function cargarClientes($datos){

        $respuesta = array();

        if(!empty($datos['buscar'])){
            $this->db->where('estado',1);
            $this->db->where('CONCAT_WS(" ",nombre_cliente,telefono_cliente,correo_cliente) LIKE "%'.$datos['buscar'].'%"');
            $cliente = $this->db->get('clientes');
            foreach($cliente->result_array() as $row){
    
                $e['id']            =   $row['id_cliente'];
                $e['text']          =   $row['nombre_cliente'];
                array_push($respuesta,$e);

            }
        }

        echo json_encode($respuesta);
    }

    public function guardarReserva($datos){

        //== esta funcion fue creada para hacer las dos cosas y no de conflictos
        $datos['start']                 = date('Y-m-d H:i:s',strtotime($datos['inicio'].' '.$datos['hora'].':00'));
        $datos['end']                   = date('Y-m-d H:i:s',strtotime($datos['final'].' '.$datos['hora'].':00'));
        $datos['fecha_capturada']       = date('Y-m-d H:i:s',strtotime($datos['inicio'].' '.$datos['hora'].':00'));
        
        //== consultamos el color ya que no es enviado por el serialize
        // $this->db->where('id_tipo_evento',$datos['id_tipo_evento']);
        // $evento     = (array) $this->db->get('tipo_evento')->row();
        $id_agenda_reserva              = $datos['id_agenda_reserva'];

        //=== verificamos que el id_cliente venga vacio para hacer la identificacion si el ciete ya esta registrado
        if($datos['id_oculto'] == 1){

            $cliente['nombre_cliente']          = $datos['nombre_cliente'];
            $cliente['telefono_cliente']        = $datos['telefono_cliente'];
            $cliente['dos_telefono_cliente']    = $datos['dos_telefono_cliente'];
            $cliente['correo_cliente']          = $datos['correo_cliente'];
            $cliente['id_usuario']              = $this->usuario['id_usuario'];
            $cliente['id_sucursal']             = $this->usuario['id_sucursal'];

            if($this->db->insert('clientes',$cliente)){
                $datos['id_cliente'] = $this->db->insert_id();
                $accion_realizada = 'Registro un nuevo cliente ID '.$datos['id_cliente'].', con nombre: '.$datos['nombre_cliente'];
                $this->Bitacora_model->registroAcciones($accion_realizada);
            }else{
                return false;
            }

        }

        $color_fondo   = $datos['color_fondo'];
        //== vaciamos los datos innecesarios para la db
        unset($datos['color_fondo']);
        unset($datos['id_oculto']);
        unset($datos['inicio']);
        unset($datos['final']);
        unset($datos['hora']);
        unset($datos['id_agenda_reserva']);
        unset($datos['nombre_cliente']);
        unset($datos['telefono_cliente']);
        unset($datos['dos_telefono_cliente']);
        unset($datos['correo_cliente']);

        //== identidicador para verificar en que momento crear un evento o solo actualizar un existente

        if($id_agenda_reserva == 0){
            $datos['id_usuario']    = $this->usuario['id_usuario'];
            $datos['color_fondo']   = $color_fondo;
            if($this->db->insert('agenda_eventos',$datos)){
                echo 200;
                $accion_realizada = 'Registro una nueva reverva ID '.$this->db->insert_id().', para el cliente ID '.$datos['id_cliente'];
            }
        }else{
            
            // validamos que siempre venga con id de cliente para que no se pierda el evento
            if(empty($datos['id_cliente'])) unset($datos['id_cliente']);
            $this->db->where('id_agenda_reserva',$id_agenda_reserva);
            if($this->db->update('agenda_eventos',$datos)){
                echo 200;
                $this->db->where('id_agenda_reserva',$id_agenda_reserva);
                $evento = (array) $this->db->get('agenda_eventos')->row();
                $datos['id_cliente'] = $evento['id_cliente'];
                $accion_realizada = 'Actualizo la nueva reverva ID '.$this->db->insert_id().', de el cliente ID '.$datos['id_cliente'];
            }
        }
        $this->Bitacora_model->registroAcciones($accion_realizada);
    }

    public function obtenerReserva($id_agenda_reserva){
        //=== consultamos el registro segun el id enviado
        //== hacemos un join para obtener los datos necesarios.
        $this->db->where('agenda_eventos.id_agenda_reserva',$id_agenda_reserva);
        $this->db->join('clientes','clientes.id_cliente=agenda_eventos.id_cliente');
        // $this->db->join('tipo_evento','tipo_evento.id_tipo_evento=agenda_eventos.id_tipo_evento');
        return (array) $this->db->get('agenda_eventos')->row();
    }

    public function cargarTitulosMensajes(){
        $opciones = '<option value="">Seleccione un mensaje</option>';

        $this->db->where('estado',1);
        $mensaje = $this->db->get('mensaje_whatsapp')->result_array();
        foreach($mensaje as $row){
            $opciones .= '<option value="'.$row['id_mensaje'].'">'.$row['titulo_mensaje'].'</option>';
        }
        echo $opciones;
    }

    public function cargarMensaje($datos){
        $this->db->select('contenido_mensaje');
        $this->db->where('id_mensaje',$datos['id_mensaje']);
        echo    json_encode($this->db->get('mensaje_whatsapp')->row());
    }
}