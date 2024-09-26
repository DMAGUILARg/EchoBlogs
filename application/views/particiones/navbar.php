<div class="nav-login">
    <nav class="navbar">
        <div class="container-fluid">
            <img class="logo" src="<?php echo base_url('application/assets/img/echo.png'); ?>" alt="Echo Blogs Logo"/>
            <div class="d-flex">
                <a class="nav-link text-white" href="<?php echo base_url('blog'); ?>">Blogs</a>
                <?php if ($this->session->userdata('logged_in')): ?>
                    <div class="d-flex align-items-center position-relative">
						<div class="chartArt" data-bs-toggle="dropdown" aria-expanded="false">
							<?php echo strtoupper(substr($nombre_usuario, 0, 1)); ?>
						</div>
                        <div class="dropdown-menu dropdown-menu-end">
                            <span class="dropdown-item-text"><?php echo $user_email; ?></span>
							<a class="dropdown-item" href="<?php echo base_url('perfil'); ?>">Perfil de usuario</a>
                            <button class="dropdown-item" onclick="logout()">Cerrar sesión</button>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="<?php echo base_url('login'); ?>" class="btn-login">Iniciar Sesión</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</div>
<script>
function logout() {
    if (confirm('¿Estás seguro de que deseas cerrar sesión?')) {
        window.location.href = "<?php echo base_url('auth/logout'); ?>";
    }
}
</script>
