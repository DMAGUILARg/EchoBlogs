<?php

class Articulo_model extends CI_Model {

    public function obtener_articulos() {
        $this->db->select('articulos.*, usuarios.nombre_autor as autor_nombre, categorias.nombre_categoria as categoria_nombre');
        $this->db->from('articulos');
        $this->db->join('usuarios', 'articulos.autor_id = usuarios.id_usuario');
        $this->db->join('categorias', 'articulos.categoria_id = categorias.id_categoria');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function obtener_comentarios_por_articulo($articulo_id) {
        $this->db->select('comentarios.*, usuarios.nombre_autor as autor_nombre');
        $this->db->from('comentarios');
        $this->db->join('usuarios', 'comentarios.autor_id = usuarios.id_usuario');
        $this->db->where('comentarios.articulo_id', $articulo_id);
        $query = $this->db->get();
        return $query->result_array();
    }

	public function guardar_articulo($data) {
        $this->db->insert('articulos', $data);
    }

	public function obtener_articulos_por_autor($autor_id) {
        $this->db->select('articulos.*, usuarios.nombre_autor as autor_nombre, categorias.nombre_categoria as categoria_nombre');
        $this->db->from('articulos');
        $this->db->join('usuarios', 'articulos.autor_id = usuarios.id_usuario');
        $this->db->join('categorias', 'articulos.categoria_id = categorias.id_categoria');
        $this->db->where('articulos.autor_id', $autor_id);
        $query = $this->db->get();
        return $query->result_array();
    }

	public function obtener_articulos_por_categoria($categoria_id) {
		$this->db->select('articulos.*, usuarios.nombre_autor as autor_nombre, categorias.nombre_categoria as categoria_nombre');
		$this->db->from('articulos');
		$this->db->join('usuarios', 'articulos.autor_id = usuarios.id_usuario');
		$this->db->join('categorias', 'articulos.categoria_id = categorias.id_categoria');
		$this->db->where('articulos.categoria_id', $categoria_id);
		$query = $this->db->get();
		return $query->result_array();
	}
	

	public function actualizar_articulo($id_articulo, $data) {
		$this->db->where('id_articulo', $id_articulo);
		$this->db->update('articulos', $data);
	}
	
}
