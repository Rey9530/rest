<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Iniciar_sesion extends CI_Controller {

	
	public function __construct(){
		parent:: __construct(); 
		$this->load->model('Iniciar_sesion_model');
		if($this->Iniciar_sesion_model->obtener_session()){
			redirect(base_url('administracion/inicio'));
		}
	}

	public function index()
	{
		$this->load->view('iniciar_sesion');
	}
	public function logueo()
	{
		$data = $this->input->post(); 
		$resp = $this->Iniciar_sesion_model->logueo($data);
		echo json_encode($resp);
	}
}
