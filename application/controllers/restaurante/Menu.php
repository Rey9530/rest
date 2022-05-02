<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
	
	public function __construct(){
		parent:: __construct(); 
		$this->load->model('Iniciar_sesion_model');
		$this->load->model('restaurante/Menu_model');
		if(!$this->Iniciar_sesion_model->obtener_session()){
			redirect(base_url());
		}
	}

	public function index()
	{
		$this->load->view('restaurante/menu');
	} 

	public function obtener_menu()
	{   
        $post = $this->input->post();
        $data = $this->Menu_model->obtener_menu($post);
        echo json_encode($data);
	}  

	public function cambiar_estado()
	{   
        $post = $this->input->post();
        $data = $this->Menu_model->cambiar_estado($post);
        echo json_encode($data);
	} 

	public function cambiar_estado_detallado()
	{   
        $post = $this->input->post();
        $data = $this->Menu_model->cambiar_estado_detallado($post);
        echo json_encode($data);
	} 
}
