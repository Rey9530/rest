<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {
	public function __construct(){
		parent:: __construct(); 
		$this->load->model('agenda/Clientes_model');
		$this->load->helper('agenda/clientes_helper');
		$this->load->model('Iniciar_sesion_model');
		if(!$this->Iniciar_sesion_model->obtener_session()){ redirect(base_url()); }
	}

	public function index(){
		$this->load->view('agenda/Clientes');
	}

    public function cargarClientes(){
        $datos = $this->Clientes_model->cargarClientes();
        return cargarClientes($datos);
    }

    public function obtenerCliente(){
        $datos = $this->Clientes_model->obtenerCliente($this->input->post('id_cliente'));
        return obtenerCliente($datos);
    }
    
    public function actualizarCliente(){
        return $this->Clientes_model->actualizarCliente($this->input->post());
    }
    
    public function eliminarCliente(){
        return $this->Clientes_model->eliminarCliente($this->input->post());
    }
}
