<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Iniciar_sesion extends CI_Controller {

	
	public function __construct(){
		parent:: __construct(); 
		$this->load->model('Iniciar_sesion_model');
	}

	public function index()
	{
		if(!empty($this->Iniciar_sesion_model->obtener_session())){
			redirect(base_url('agenda/Agenda_reserva'));
		}
		$this->load->view('iniciar_sesion');
	}
	
	public function logueo()
	{
		$data = $this->input->post(); 
		$resp = $this->Iniciar_sesion_model->logueo($data);
		echo json_encode($resp);
	}
	
	public function cerrarSesion(){
		echo $this->Iniciar_sesion_model->cerrarSesion();
	}
}
