<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mesas extends CI_Controller {
	
	public function __construct(){
		parent:: __construct(); 
		$this->load->model('Iniciar_sesion_model');
		$this->load->model('restaurante/Mesa_model');
		$this->load->helper('restaurante/mesas_helper');
		if(!$this->Iniciar_sesion_model->obtener_session()){
			redirect(base_url());
		}
	}

	public function index()
	{
		$this->load->view('restaurante/mesas');
	} 

	public function nueva_orden()
	{
		$this->load->view('restaurante/nueva_orden');
	} 

	public function obtener_mesas()
	{
        $data = $this->Mesa_model->obtener_mesas();
        echo json_encode($data);
	}  

	public function detalles_mesa()
	{
        $tk_ = $this->input->post('tk_'); 
        echo detalles_mesa($tk_);
	} 

	public function cargar_ordenes_cuenta()
	{
        $tk = $this->input->post('tk'); 
        echo cargar_ordenes_cuenta($tk);
	} 

	public function agregar_a_mesa()
	{
        $tk_ = $this->input->post('tk_'); 
        $tk_c = $this->input->post('tk_c'); 
		if($tk_c>0){
			echo detalle_cuenta($tk_c);
		}else{
			echo agregar_a_mesa($tk_);
		}
	} 

	public function asignar_mesa()
	{
        $post = $this->input->post();
        $data = $this->Mesa_model->asignar_mesa($post);
        echo json_encode($data);
	} 
}
