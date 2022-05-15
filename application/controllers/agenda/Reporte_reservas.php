<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte_reservas extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('agenda/Reporte_reservas_model');
        $this->load->model('agenda/Reporte_clientes_model');
		$this->load->model('Iniciar_sesion_model');
		if(!$this->Iniciar_sesion_model->obtener_session()){ redirect(base_url()); }
		$this->usuario  = $this->Iniciar_sesion_model->obtener_session();
	}

	public function index(){
		$this->load->view('agenda/Reporte_reservas');
	}

    public function cargarSucursales(){
        return $this->Reporte_reservas_model->cargarSucursales();
    }
	
	public function imprimirReporte($tipo,$incio,$fin,$id_sucursal = 0){
		
		$tk 					= random_bytes(10);
		$datos['reserva']		= $this->Reporte_reservas_model->obtenerReservas($incio,$fin,$id_sucursal);
		$titulo				 	= 'Reporte de Reversas | '.date('d-m-Y').' | Creador: '.$this->usuario['nombre'];
		$datos['titulo']		= $titulo;
		$html 					=  $this->load->view('agenda/reportes/Reporte_reservas',$datos,true);
		if($tipo == 1){
			$this->Reporte_clientes_model->creadorPDF($html,$titulo,$tk);
		}
		
		if($tipo == 2){
			$this->Reporte_clientes_model->creadorExcel($html,$titulo,$tk);
		}
	}
}
