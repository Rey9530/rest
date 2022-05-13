<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte_clientes extends CI_Controller {
	public function __construct(){
		parent:: __construct(); 
		$this->load->model('agenda/Reporte_clientes_model');
		$this->load->model('Iniciar_sesion_model');
		if(!$this->Iniciar_sesion_model->obtener_session()){ redirect(base_url()); }
	}

	public function index(){
		$this->load->view('agenda/Reporte_clientes');
	}

    public function cargarSucursales(){
        return $this->Reporte_clientes_model->cargarSucursales();
    }

    public function imprimirReporte($tipo,$incio,$fin,$id_sucursal = 0){
        $this->load->view('agenda/reportes/Reporte_clientes');
    }
}
