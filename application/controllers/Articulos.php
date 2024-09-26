<?php 

class Articulos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Articulo_model');
        $this->load->model('Categoria_model'); 
        $this->load->library('session');
        $this->load->library('upload'); 
    }

    public function blog() {
        $data['user_email'] = $this->session->userdata('user_email');
        $data['nombre_usuario'] = $this->session->userdata('nombre_usuario');
        $data['articulos'] = $this->Articulo_model->obtener_articulos();
        foreach ($data['articulos'] as &$articulo) {
            $articulo['comentarios'] = $this->Articulo_model->obtener_comentarios_por_articulo($articulo['id_articulo']);
        }
        
        $data['categorias'] = $this->Categoria_model->get_all_categorias();
        
        $this->load->view('blog_index', $data);
    }

    public function guardar_articulo() {
        
        $config['upload_path'] = './imagenes/'; 
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2048; 

        $this->upload->initialize($config);

        if ($this->upload->do_upload('imagen')) {
            $upload_data = $this->upload->data();
            $imagen = $upload_data['file_name'];
        } else {
            $imagen = null; 
        }

        $data = array(
            'titulo' => $this->input->post('titulo'),
            'contenido' => $this->input->post('contenido'),
            'categoria_id' => $this->input->post('categoria_id'),
            'imagen' => $imagen,
            'autor_id' => $this->session->userdata('user_id') 
        );

       
        $this->Articulo_model->guardar_articulo($data);

       
        redirect('articulos/blog');
    }

	public function actualizar_articulo() {
		$id_articulo = $this->input->post('id_articulo');
	
		$config['upload_path'] = './imagenes/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 2048;
	
		$this->upload->initialize($config);
	
		if ($this->upload->do_upload('imagen')) {
			$upload_data = $this->upload->data();
			$imagen = $upload_data['file_name'];
		} else {
			$imagen = null;
		}
	
		$data = array(
			'titulo' => $this->input->post('titulo'),
			'contenido' => $this->input->post('contenido'),
			'categoria_id' => $this->input->post('categoria_id'),
			'imagen' => $imagen ? $imagen : $this->input->post('imagen_actual') 
		);
	
		$this->Articulo_model->actualizar_articulo($id_articulo, $data);
	
		redirect('perfil');
	}

	public function filtrar_por_categoria($categoria_id) {
        $data['user_email'] = $this->session->userdata('user_email');
        $data['nombre_usuario'] = $this->session->userdata('nombre_usuario');
        
        if ($categoria_id === 'all') {
            $data['articulos'] = $this->Articulo_model->obtener_articulos();
        } else {
            $data['articulos'] = $this->Articulo_model->obtener_articulos_por_categoria($categoria_id);
        }

        foreach ($data['articulos'] as &$articulo) {
            $articulo['comentarios'] = $this->Articulo_model->obtener_comentarios_por_articulo($articulo['id_articulo']);
        }
        
        $data['categorias'] = $this->Categoria_model->get_all_categorias();

        $this->load->view('blog_index', $data);
    }
	
}