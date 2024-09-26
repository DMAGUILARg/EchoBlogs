<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="<?php echo base_url('application/assets/css/landing.css'); ?>" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="<?php echo base_url('application/assets/css/perfil.css'); ?>" rel="stylesheet">
    <title>Echo Blogs</title>
</head>

<body>

    <?php if ($this->session->flashdata('message')): ?>
    <?php
    
    $message_type = $this->session->flashdata('message_type');
    $background_color = ($message_type === 'success') ? '#0c9b20' : '#dc3545'; 
    ?>
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <div id="toastMessage"
            class="toast align-items-center text-white border-0 position-fixed top-0 start-50 translate-middle-x mt-3 fade show"
            role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000"
            style="background-color: <?php echo $background_color; ?>;">
            <div class="d-flex">
                <div class="toast-body">
                    <?php if ($message_type === 'success'): ?>
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <?php elseif ($message_type === 'danger'): ?>
                    <i class="bi bi-x-circle-fill me-2"></i>
                    <?php endif; ?>
                    <?php echo $this->session->flashdata('message'); ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php $this->load->view('particiones/navbar'); ?>
    <!-- Aquí empieza el container -->
    <div class="container mt-2 mb-5">
        <div class="row">
            <div class="col-md-8">
                <section>
                    <h2 class="text-center mt-4">Sobre Nosotros</h2>
                    <p class="text-center">Echo Blogs es una comunidad para compartir y descubrir contenido de calidad.
                        Expresa tus ideas, interactúa con otros usuarios a través de comentarios y únete a un espacio
                        donde las palabras tienen impacto.</p>
                    <p class="text-center">Únete a Echo Blogs y sé parte de un ecosistema de ideas que resuenan y
                        generan impacto.</p>
                </section>
            </div>
            <div class="col-md-4">
                <div class="contenedor-1">
                    <div class="text-center">
                        <img style="width: 150px;" src="<?php echo base_url('application/assets/img/echo.png'); ?>"
                            alt="Echo Blogs" />
                    </div>
                    <form method="post" action="<?= base_url('Landing/register_user'); ?>">
                        <div class="mb-3">
                            <label for="Nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="Nombre" aria-describedby="Nombre"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="Email" class="form-label">Correo</label>
                            <input type="email" name="email" class="form-control" id="Email"
                                aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="Password" class="form-label">Contraseña</label>
                            <input type="password" name="contraseña" class="form-control" id="Password" required>
                        </div>
                        <button type="submit" class="btn-registro">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('particiones/footer'); ?>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var toastEl = document.getElementById('toastMessage');
        var toast = new bootstrap.Toast(toastEl);
        toast.show();
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>
