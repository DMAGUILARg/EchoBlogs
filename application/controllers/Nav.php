<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Navbar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    public function index() {
        $data['user_email'] = $this->session->userdata('user_email');
		$data['nombre_usuario'] = $this->session->userdata('nombre_usuario');
        $this->load->view('navbar', $data);
    }
}
