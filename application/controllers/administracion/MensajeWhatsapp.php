<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MensajeWhatsapp extends CI_Controller {
	
	public function __construct(){
		parent:: __construct(); 
		$this->load->model('Iniciar_sesion_model');
		$this->load->helper('administracion/mensaje_whatsapp_helper');
		$this->load->model('administracion/MensajeWhatsapp_model');
		if(!$this->Iniciar_sesion_model->obtener_session()){ redirect(base_url()); }
	}

	public function index(){
		$this->load->view('administracion/MensajeWhatsapp');
	}
	
    public function cargarMensajeWhatsapp(){
        $datos  = $this->MensajeWhatsapp_model->cargarMensajeWhatsapp();
		return cargarMensajeWhatsapp($datos);
	}
    
	public function modalMensajeWhatsapp(){
		if($this->input->post('id_mensaje') > 0){
			$datos  = $this->MensajeWhatsapp_model->modalMensajeWhatsapp($this->input->post());
		}else{
			$datos['id_mensaje']	= $this->input->post('id_mensaje');
		}
		return modalMensajeWhatsapp($datos);
	}

	public function guardarMensaje(){
		return $this->MensajeWhatsapp_model->guardarMensaje($this->input->post());
	}

	public function cargarSucursal(){
		return $this->MensajeWhatsapp_model->cargarSucursal($this->input->post());
	}
	
	public function cambiarEstado(){
		return $this->MensajeWhatsapp_model->cambiarEstado($this->input->post());
	}
}
