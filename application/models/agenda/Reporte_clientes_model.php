<?php defined('BASEPATH') or exit('No direct script access allowed');

class Reporte_clientes_model extends CI_model{

    public function __construct(){
        parent:: __construct();
        $this->load->model('Bitacora_model');
        $this->load->model('Iniciar_sesion_model');
        $this->usuario  = $this->Iniciar_sesion_model->obtener_session();
    }

    public function cargarSucursales(){
        
        $opciones = '<option value="0">Todas</option>';

        $this->db->where('estado',1);
        $evento = $this->db->get('sucursales');
        foreach($evento->result_array() as $row){
            $seleccionar = (($this->usuario['id_sucursal'] == $row['id_sucursal']) ? 'selected':'' );
            $opciones .= '<option '.$seleccionar.' value="'.$row['id_sucursal'].'">'.$row['nombre_sucursal'].'</option>';
        }
        echo $opciones;
    }

    public function obtenerCliente($inicio,$fin,$id_sucursal){
        $inicio = date('Y-m-d',strtotime($inicio));
        $fin    = date('Y-m-d',strtotime($fin));

        $this->db->where('clientes.estado',1);
		if($id_sucursal > 0){
			$this->db->where('clientes.id_sucursal',$id_sucursal);
		}
        $this->db->where('DATE(clientes.fecha_creacion) BETWEEN "'.$inicio.'" AND "'.$fin.'" ');
        $this->db->join('usuarios','usuarios.id_usuario=clientes.id_usuario');
        return $this->db->get('clientes')->result_array();
    }
    
    public function creadorPDF($html = '',$titulo = '',$tk = ''){
		if(!empty($tk)){
			$mpdf = new \Mpdf\Mpdf(
				[
					'format'		=> 'LETTER',
					'margin_top' 	=> 20,
					'margin_right' 	=> 10,
					'margin_left' 	=> 10,
					'margin_bottom' => 20,
				]
			);
			$mpdf->SetTitle($titulo);
			$mpdf->setFooter('{PAGENO} / {nb}');
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}else{
			echo 'Lo que buscas no esta por aca!';
		}
	}
	
	public function creadorExcel($html = '',$titulo = '',$tk = ''){
		if(!empty($tk)){
			header("Content-type: application/x-msdownload");
			header("Content-Disposition: attachment; filename=".$titulo.".xls");
			header("Pragma: no-cache");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			echo $html;
		}else{
			echo 'Lo que buscas no esta por aca!';
		}
	}
}