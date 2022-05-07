<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda_reserva extends CI_Controller {
	public function __construct(){
		parent:: __construct(); 
		$this->load->model('agenda/Agenda_reserva_model');
		$this->load->helper('agenda/agenda_reserva_helper');
		$this->load->model('Iniciar_sesion_model');
		if(!$this->Iniciar_sesion_model->obtener_session()){ redirect(base_url()); }
	}

	public function index(){
		$datos['id_sucursal'] 	= ((isset($_GET['ids']))?$_GET['ids']:0);
		$datos['tipo'] 			= 1;
		$data['sucursal'] 		= $this->Agenda_reserva_model->cargarSucursal($datos);
		$this->load->view('agenda/Agenda_reserva',$data);
	}

    public function enviarWharsapp(){
		$datos	= $this->Agenda_reserva_model->obtenerReserva($this->input->post('id_agenda_reserva'));
		return enviarWharsapp($datos);
	}

    public function modalEventos(){
		$datos	= $this->input->post();
		return modalEventos($datos);
	}
    
	public function cargarTitulosMensajes(){
		return $this->Agenda_reserva_model->cargarTitulosMensajes($this->input->post());
	}

	public function cargarMensaje(){
		return $this->Agenda_reserva_model->cargarMensaje($this->input->post());
	}
	
	public function cargarAgendaReserva(){
		return $this->Agenda_reserva_model->cargarAgendaReserva($this->input->get());
	}
	
	public function cargarTipoEvento(){
		return $this->Agenda_reserva_model->cargarTipoEvento($this->input->post());
	}
	
	public function cargarSucursal(){
		echo $this->Agenda_reserva_model->cargarSucursal($this->input->post());
	}

	public function cargarColorFondo(){
		return $this->Agenda_reserva_model->cargarColorFondo($this->input->post());
	}
	
	public function cargarClientes(){
		return $this->Agenda_reserva_model->cargarClientes($this->input->post());
	}
	
	public function guardarReserva(){
		return $this->Agenda_reserva_model->guardarReserva($this->input->post());
	}
}
