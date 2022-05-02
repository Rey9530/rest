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
		$this->load->view('agenda/Agenda_reserva');
	}

    public function modalEventos(){
		$datos	= $this->input->post();
		return modalEventos($datos);
	}
    
	public function cargarAgendaReserva(){
		return $this->Agenda_reserva_model->cargarAgendaReserva($this->input->get());
	}
	
	public function cargarTipoEvento(){
		return $this->Agenda_reserva_model->cargarTipoEvento($this->input->post());
	}
	
	public function cargarSucursal(){
		return $this->Agenda_reserva_model->cargarSucursal($this->input->post());
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
