<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mesas extends CI_Controller {
	
	public function __construct(){
		parent:: __construct(); 
		$this->load->model('Iniciar_sesion_model');
		$this->load->helper('administracion/mesas_helper');
		$this->load->model('administracion/Mesas_model');
		if(!$this->Iniciar_sesion_model->obtener_session()){ redirect(base_url()); }
	}

	public function index()
	{
		$this->load->view('administracion/mesas');
	} 
     
	public function guardar()
	{
        $post = $this->input->post();
        $resp = $this->Mesas_model->guardar($post);
		echo json_encode($resp);
	} 
    
     
	public function eliminar_mesa()
	{
        $post = $this->input->post();
        $resp = $this->Mesas_model->eliminar_mesa($post);
		echo json_encode($resp);
	} 
    
    
	public function formulario_mesa()
	{
        $id = $this->input->post("tk");
        formulario_mesa($id);
	} 
    
    
	public function table_mesa()
	{ 
        table_mesa();
	} 
    
}
