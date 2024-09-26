<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Landing_model');
        $this->load->library('session'); 
    }

    public function index()
    {
        $this->load->view('landing_views');
    }

    public function register_user()
    {
        $nombre = $this->input->post('nombre');
        $email = $this->input->post('email');
        $contraseña = $this->input->post('contraseña');

        if (strlen($contraseña) < 8) {
            $this->session->set_flashdata('message', 'La contraseña debe tener al menos 8 caracteres.');
            $this->session->set_flashdata('message_type', 'danger');
            redirect('landing/index');
            return;
        }

        if ($this->Landing_model->email_existe($email)) {
            $this->session->set_flashdata('message', 'Este correo electrónico ya está registrado.');
            $this->session->set_flashdata('message_type', 'danger');
        } else {
            $hash_password = password_hash($contraseña, PASSWORD_BCRYPT);

            $data = array(
                'nombre_autor' => $nombre,
                'email' => $email,
                'contraseña' => $hash_password,
                'id_rol' => 2 
            );

            if ($this->Landing_model->insert_user($data)) {
                $this->session->set_flashdata('message', 'Registro exitoso.');
                $this->session->set_flashdata('message_type', 'success');
            } else {
                $this->session->set_flashdata('message', 'Hubo un error al registrarse. Por favor, inténtalo de nuevo.');
                $this->session->set_flashdata('message_type', 'danger');
            }
        }

        redirect('landing/index');
    }
}
