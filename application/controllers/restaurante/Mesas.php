<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mesas extends CI_Controller {
	
	public function __construct(){
		parent:: __construct(); 
		$this->load->model('Iniciar_sesion_model');
		$this->load->model('restaurante/Mesa_model');
		$this->load->model('restaurante/Menu_model');
		$this->load->helper('restaurante/mesas_helper');
		if(!$this->Iniciar_sesion_model->obtener_session()){
			redirect(base_url());
		}
	}

	public function index()
	{
		$this->load->view('restaurante/mesas');
	} 

	public function nueva_orden($tk_cuenta=0)
	{
		if(!$tk_cuenta>0){ redirect(base_url()); }
		$data['tk_cuenta'] = $tk_cuenta;
        $this->session->unset_userdata('detalle_venta');
		$this->load->view('restaurante/nueva_orden',$data);
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

	public function cargar_productos()
	{
        $tk_ = $this->input->post('tk_');  
        $data = $this->Menu_model->cargar_productos($tk_);
        echo json_encode($data);
	} 

	public function obtener_detalle_orden()
	{
        $data = $this->Mesa_model->obtener_detalle_orden();
        echo json_encode($data);
	} 

	public function finalizar_cuenta()
	{
        $tk_cuenta = $this->input->post('tk_cuenta');  
        $data = $this->Mesa_model->finalizar_cuenta($tk_cuenta); 
        echo json_encode($data);
	} 

	public function eliminar_detalle()
	{
        $detalle = $this->input->post('detalle');  
        $data = $this->Mesa_model->eliminar_detalle($detalle); 
        echo json_encode($data);
	} 

	public function finalizar_orden()
	{
        $tk_cuenta = $this->input->post('tk_cuenta');  
        $data = $this->Mesa_model->finalizar_orden($tk_cuenta); 
        echo json_encode($data);
	} 

	public function agregar_al_detalle()
	{
        $post = $this->input->post();  
        $data = $this->Mesa_model->agregar_al_detalle($post);
        echo json_encode($data);
	} 

	public function cargar_ordenes_cuenta()
	{
        $tk = $this->input->post('tk'); 
        echo cargar_ordenes_cuenta($tk);
	} 

	public function add_producto()
	{
        $tk = $this->input->post('tk_'); 
        echo add_producto($tk);
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
