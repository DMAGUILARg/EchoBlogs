<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Articulo_model'); 
		$this->load->model('Categoria_model'); 
    }

    public function perfil() {
        $user_id = $this->session->userdata('user_id'); 
        $data['user_email'] = $this->session->userdata('user_email');
        $data['nombre_usuario'] = $this->session->userdata('nombre_usuario');
        $data['user_fecha_registro'] = $this->session->userdata('user_fecha_registro');
        $data['articulos'] = $this->Articulo_model->obtener_articulos_por_autor($user_id); 
        $data['categorias'] = $this->Categoria_model->get_all_categorias();
        $this->load->view('perfil', $data); 
    }

    public function ver_articulos_por_categoria($categoria_id) {
        $data['articulos'] = $this->Articulo_model->obtener_articulos_por_categoria($categoria_id);
        $this->load->view('ver_articulos', $data);
    }
}
