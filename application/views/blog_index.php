<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blog</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="<?php echo base_url('application/assets/css/blog.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('application/assets/css/landing.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('application/assets/css/perfil.css'); ?>" rel="stylesheet">
</head>

<body>
    <!-- Este es el navbar -->
    <?php $this->load->view('particiones/navbar', $user_email , $nombre_usuario); ?>
    <!-- Aquí termina el navbar -->
    <div class="container my-4">
        <div class="row">
            <div class="col-md-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Categorías</h5>
                    <button class="btn btn-gradient" data-bs-toggle="modal" data-bs-target="#createArticleModal">
                        <i class="fa-solid fa-plus"></i> Crear post
                    </button>
                </div>
                <ul class="list-group">
                    <li class="list-group-item category"
                        onclick="window.location.href='<?= base_url('articulos/filtrar_por_categoria/all'); ?>'">
                        Todos
                    </li>
                    <?php foreach ($categorias as $categoria): ?>
                    <li class="list-group-item category"
                        onclick="window.location.href='<?= base_url('articulos/filtrar_por_categoria/'.$categoria['id_categoria']); ?>'">
                        <?= htmlspecialchars($categoria['nombre_categoria']); ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-md-9">
                <?php foreach($articulos as $articulo): ?>
                <div class="card mb-4 post" data-category="<?= $articulo['categoria_nombre']; ?>">
                    <div class="card-header d-flex align-items-center">
                        <div class="chartArt"><?= strtoupper($articulo['autor_nombre'][0]); ?></div>
                        <div class="ms-3">
                            <h5 class="card-title mb-0"><?= $articulo['autor_nombre']; ?></h5>
                            <p class="text-muted mb-0"><i class="fa-solid fa-calendar"></i> Publicado el
                                <?php echo date('d M, Y', strtotime($articulo['fecha_de_creacion'])); ?></p>
                        </div>
                        <span class="badge ms-auto"><?= $articulo['categoria_nombre']; ?></span>
                    </div>
                    <img src="<?= $articulo['imagen']; ?>" class="card-img-top" alt="<?= $articulo['titulo']; ?>" />
                    <div class="card-body">
                        <p class="card-text"><?= $articulo['contenido']; ?></p>
                        <button class="btn btn-gradient" data-bs-toggle="modal"
                            data-bs-target="#postModal<?= $articulo['id_articulo']; ?>">
                            <i class="fa-solid fa-eye"></i> Ver más
                        </button>
                    </div>
                    <div class="card-footer">
                        <h6><i class="fa-solid fa-comments"></i> Comentarios</h6>
                        <?php foreach($articulo['comentarios'] as $comentario): ?>
                        <div class="comment">
                            <div class="chartArt"><?= strtoupper($comentario['autor_nombre'][0]); ?></div>
                            <div class="comment-content">
                                <strong><?= $comentario['autor_nombre']; ?></strong>
                                <p><?= $comentario['contenido']; ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <span class="view-more">Ver más comentarios...</span>
                        <div class="comment-input">
                            <textarea rows="2" placeholder="Escribe un comentario..."></textarea>
                            <button class="btn btn-gradient"><i class="fa-solid fa-paper-plane"></i> Comentar</button>
                        </div>
                    </div>
                </div>

                <!-- Modal para ver la noticia completa y comentarios -->
                <div class="modal fade" id="postModal<?= $articulo['id_articulo']; ?>" tabindex="-1"
                    aria-labelledby="postModalLabel<?= $articulo['id_articulo']; ?>" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="postModalLabel<?= $articulo['id_articulo']; ?>">
                                    <?= $articulo['autor_nombre']; ?> - <?= $articulo['titulo']; ?>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="<?= $articulo['imagen']; ?>" class="img-fluid mb-3"
                                    alt="<?= $articulo['titulo']; ?>" />
                                <p><?= $articulo['contenido']; ?></p>
                                <h6>Comentarios</h6>
                                <?php foreach($articulo['comentarios'] as $comentario): ?>
                                <div class="comment">
                                    <div class="chartArt"><?= strtoupper($comentario['autor_nombre'][0]); ?></div>
                                    <div class="comment-content">
                                        <strong><?= $comentario['autor_nombre']; ?></strong>
                                        <p><?= $comentario['contenido']; ?></p>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                <div class="comment-input">
                                    <textarea rows="2" placeholder="Escribe un comentario..."></textarea>
                                    <button class="btn btn-gradient"><i class="fa-solid fa-paper-plane"></i>
                                        Comentar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Modal para crear un artículo -->
    <div class="modal fade" id="createArticleModal" tabindex="-1" aria-labelledby="createArticleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createArticleModalLabel">Crear Nuevo Artículo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createArticleForm" method="post" enctype="multipart/form-data"
                        action="<?= base_url('articulos/guardar_articulo'); ?>">
                        <div class="mb-3">
                            <label for="articleTitle" class="form-label">Título</label>
                            <input type="text" class="form-control" id="articleTitle" name="titulo"
                                placeholder="Ingrese el título del artículo" required />
                        </div>
                        <div class="mb-3">
                            <label for="articleImage" class="form-label">Imagen</label>
                            <input type="file" class="form-control" id="articleImage" name="imagen"
                                accept="imagenes/*" />
                        </div>
                        <div class="mb-3">
                            <label for="articleContent" class="form-label">Contenido</label>
                            <textarea class="form-control" id="articleContent" name="contenido" rows="5"
                                placeholder="Ingrese el contenido del artículo" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="articleCategory" class="form-label">Categoría</label>
                            <select class="form-select" id="articleCategory" name="categoria_id"
                                aria-label="Seleccione una categoría" required>
                                <option selected disabled>Seleccionar una categoría</option>
                                <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= $categoria['id_categoria']; ?>">
                                    <?= $categoria['nombre_categoria']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-gradient">Guardar Artículo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Aquí empieza el footer -->
    <footer class="footer ">
        <div class="container text-center">
            <div class="social-icons">
                <a class="custom" href="https://www.facebook.com" target="_blank"> <i class="bi bi-facebook"></i>
                </a>
                <a class="custom" href="https://www.twitter.com" target="_blank"> <i class="bi bi-twitter"></i>
                </a>
                <a class="custom" href="https://www.tiktok.com" target="_blank"> <i class="bi bi-tiktok"></i>
                </a>
                <a class="custom" href="https://www.youtube.com" target="_blank"> <i class="bi bi-youtube"></i>
                </a>
            </div>
            <p>© 2024 Echo Blogs</p>
        </div>
    </footer>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const categories = document.querySelectorAll('.category');
        const posts = document.querySelectorAll('.post');

        categories.forEach(category => {
            category.addEventListener('click', function() {
                const filter = this.getAttribute('data-category');

                posts.forEach(post => {
                    if (filter === 'all' || post.getAttribute('data-category') ===
                        filter) {
                        post.style.display = 'block';
                    } else {
                        post.style.display = 'none';
                    }
                });
            });
        });
    });
    </script>


    <script src="<?php echo base_url('application/assets/js/blog.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>



</html>