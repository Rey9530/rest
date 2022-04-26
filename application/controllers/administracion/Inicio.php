<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	
	public function __construct(){
		parent:: __construct(); 
		$this->load->model('Iniciar_sesion_model');
		if(!$this->Iniciar_sesion_model->obtener_session()){ redirect(base_url()); }
	}

	public function index()
	{
		$this->load->view('administracion/inicio');
	} 
    
}
