<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda_reserva extends CI_Controller {
	public function __construct(){
		parent:: __construct(); 
		$this->load->model('agenda/Agenda_reserva_model');
		$this->load->model('Iniciar_sesion_model');
		// if(!$this->Iniciar_sesion_model->obtener_session()){ redirect(base_url()); }
	}

	public function index(){
		$this->load->view('agenda/Agenda_reserva');
	} 
    
}
