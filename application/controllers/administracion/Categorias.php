<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {
	
	public function __construct(){
		parent:: __construct(); 
		$this->load->model('Iniciar_sesion_model');
		$this->load->helper('administracion/categorias_helper');
		$this->load->model('administracion/Categorias_model');
		if(!$this->Iniciar_sesion_model->obtener_session()){ redirect(base_url()); }
	}

	public function index()
	{
		$this->load->view('administracion/categorias');
	} 
     
    function cargar_archivo() {
        $post = $this->input->post();

        $mi_archivo                 = 'archivo';
        $config['upload_path']      = 'archivos/categorias';
        $config['file_name']        = time();
        $config['allowed_types']    = "*"; 

        if(isset($post['tk_']) && $post['tk_']>0){
            $url_img = $this->Categorias_model->obtener_imagen($post['tk_']);
            $url = $config['upload_path'].'/'.$url_img;
            if (file_exists($url) && !empty($url_img)) {
                unlink($url); 
            } 
        }
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload($mi_archivo)) {
            //*** ocurrio un error
            $data['uploadError'] = $this->upload->display_errors();
            echo $this->upload->display_errors();
            return;
        }

        $data['uploadSuccess'] = $this->upload->data();
        return $data['uploadSuccess']['file_name'];
    }
     
	public function guardar()
	{
        $post = $this->input->post();
        if(isset($_FILES['archivo'])){ 
            $post['archivo'] = $this->cargar_archivo();
        }
        $resp = $this->Categorias_model->guardar($post);
		echo json_encode($resp);
	} 
    
     
	public function eliminar_categoria()
	{
        $post = $this->input->post();
        $resp = $this->Categorias_model->eliminar_categoria($post);
		echo json_encode($resp);
	} 
    
    
	public function formulario_categoria()
	{
        $id = $this->input->post("tk");
        formulario_categoria($id);
	} 
    
    
	public function table_categoria()
	{ 
        table_categoria();
	} 
    
}
