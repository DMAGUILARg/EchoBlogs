<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_categorias() {
        $query = $this->db->get('categorias');
        return $query->result_array();
    }

    public function get_categoria($id_categoria) {
        $this->db->where('id_categoria', $id_categoria);
        $query = $this->db->get('categorias');
        return $query->row();
    }
}
