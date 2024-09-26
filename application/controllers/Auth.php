<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->library('session');
        $this->load->library('form_validation'); 
    }

    public function login() {
        $this->load->view('login');
    }

    public function do_login() {
        $this->form_validation->set_rules('email', 'Correo electrónico', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[6]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('login');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $user = $this->Login_model->get_user_by_email($email);

            if ($user && password_verify($password, $user['contraseña'])) {
         
                $this->session->set_userdata('logged_in', TRUE);
                $this->session->set_userdata('user_id', $user['id_usuario']);
                $this->session->set_userdata('user_email', $user['email']);
                $this->session->set_userdata('nombre_usuario', $user['nombre_autor']);
                $this->session->set_userdata('user_fecha_registro', $user['fecha_de_registro']);
                
                redirect('perfil');
            } else {
                $this->session->set_flashdata('message', 'Correo electrónico o contraseña incorrectos.');
                $this->session->set_flashdata('message_type', 'danger');
                
                redirect('login');
            }
        }
    }

    public function logout() {    
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_email');
        $this->session->unset_userdata('nombre_usuario');
        $this->session->unset_userdata('user_fecha_registro');
        redirect('login');
    }
}
