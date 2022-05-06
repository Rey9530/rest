<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {
	
	public function __construct(){
		parent:: __construct(); 
		$this->load->model('Iniciar_sesion_model');
		$this->load->helper('administracion/productos_helper');
		$this->load->model('administracion/Productos_model');
		if(!$this->Iniciar_sesion_model->obtener_session()){ redirect(base_url()); }
	}

	public function index()
	{
		$this->load->view('administracion/productos');
	} 
     
    function cargar_archivo() {
        $post = $this->input->post();

        $mi_archivo                 = 'archivo';
        $config['upload_path']      = 'archivos/productos';
        $config['file_name']        = time();
        $config['allowed_types']    = "*"; 

        if(isset($post['tk_']) && $post['tk_']>0){
            $url_img = $this->Productos_model->obtener_imagen($post['tk_']);
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
        $resp = $this->Productos_model->guardar($post);
		echo json_encode($resp);
	} 
    
     
	public function eliminar_Producto()
	{
        $post = $this->input->post();
        $resp = $this->Productos_model->eliminar_Producto($post);
		echo json_encode($resp);
	} 
     
	public function eliminar_componente()
	{
        $post = $this->input->post();
        $resp = $this->Productos_model->eliminar_componente($post);
		echo json_encode($resp);
	} 
     
	public function eliminar_detalle_componente()
	{
        $post = $this->input->post();
        $resp = $this->Productos_model->eliminar_detalle_componente($post);
		echo json_encode($resp);
	} 
     
	public function guardar_componente()
	{
        $post = $this->input->post();
        $resp = $this->Productos_model->guardar_componente($post);
		echo json_encode($resp);
	} 
     
	public function btn_add_componente_detalle()
	{
        $post = $this->input->post();
        $resp = $this->Productos_model->btn_add_componente_detalle($post);
		echo json_encode($resp);
	} 
    
    
	public function formulario_Producto()
	{
        $id = $this->input->post("tk");
        formulario_Producto($id);
	} 
    
	public function componentes_producto()
	{
        $id = $this->input->post("tk");
        componentes_producto($id);
	} 
    
	public function load_componente_detalle()
	{
        $id = $this->input->post("tk");
        load_componente_detalle($id);
	} 
    
    
	public function load_componente()
	{
        $id = $this->input->post("tk");
        load_componente($id);
	} 
    
    
	public function table_Producto()
	{ 
        table_Producto();
	} 
    
}
