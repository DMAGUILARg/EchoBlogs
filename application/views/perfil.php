<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perfil de Usuario</title>
    <link href="<?php echo base_url('application/assets/css/landing.css'); ?>" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="<?php echo base_url('application/assets/css/perfil.css'); ?>" rel="stylesheet">
</head>

<body>
    <!-- Este es el navbar -->
    <?php $this->load->view('particiones/navbar', $user_email); ?>
    <!-- Aquí termina el navbar -->

    <div class="container my-4">
        <div class="row">
            <!-- Perfil de Usuario -->
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-header d-flex align-items-center">
                        <div class="chartArt">
                            <?php echo strtoupper(substr($nombre_usuario, 0, 1)); ?>
                        </div>
                        <div class="ms-3">
                            <h5 class="card-title mb-0"><?php echo $nombre_usuario; ?></h5>
                            <p class="text-muted mb-0">
                                <i class="fa-solid fa-user"></i> dmg10
                            </p>
                        </div>
                    </div>
                    <div class="card-body">
                        <p><strong>Email:</strong> <?php echo $user_email; ?></p>
                        <p><strong>Fecha de Registro:</strong><?php echo $user_fecha_registro; ?></p>
                    </div>
                </div>
            </div>
            <!-- Artículos del Usuario -->
            <div class="col-md-9">
                <h4 class="card-title mb-4">Mis Artículos</h4>
                <?php if (!empty($articulos)): ?>
                <?php foreach ($articulos as $articulo): ?>
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center">
                        <div class="chartArt"><?php echo strtoupper(substr($articulo['autor_nombre'], 0, 1)); ?></div>
                        <div class="ms-3">
                            <h5 class="card-title mb-0"><?php echo $articulo['titulo']; ?></h5>
                            <p class="text-muted mb-0">
                                <i class="fa-solid fa-calendar"></i> Publicado el
                                <?php echo date('d M, Y', strtotime($articulo['fecha_de_creacion'])); ?>
                            </p>
                            <span class="badge ms-auto"><?= $articulo['categoria_nombre']; ?></span>
                        </div>
                    </div>
                    <img src="<?php echo $articulo['imagen']; ?>" class="card-img-top"
                        alt="<?php echo $articulo['titulo']; ?>" />
                    <div class="card-body">
                        <p class="card-text"><?php echo $articulo['contenido']; ?></p>
                        <div class="d-flex ">
                            <button class="btn btn-gradient btn-edit-article " data-bs-toggle="modal"
                                data-bs-target="#updateArticleModal" data-id="<?php echo $articulo['id_articulo']; ?>"
                                data-titulo="<?php echo htmlspecialchars($articulo['titulo'], ENT_QUOTES); ?>"
                                data-contenido="<?php echo htmlspecialchars($articulo['contenido'], ENT_QUOTES); ?>"
                                data-categoria-id="<?php echo $articulo['categoria_id']; ?>">
                                <i class="fa-solid fa-edit"></i> Editar
                            </button>
                        </div>
                    </div>
                    <div class="card-footer">
                        <!-- Aquí podrías agregar más detalles si lo deseas -->
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <p>No hay artículos disponibles.</p>
                <?php endif; ?>
            </div>
            <!-- Modal para actualizar artículo -->
            <div class="modal fade" id="updateArticleModal" tabindex="-1" aria-labelledby="updateArticleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateArticleModalLabel">Actualizar Artículo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateArticleForm" method="post" enctype="multipart/form-data"
                                action="<?= base_url('articulos/actualizar_articulo'); ?>">
                                <input type="hidden" id="ArticuloId" name="id_articulo">
                                <div class="mb-3">
                                    <label for="ActualizarTitulo" class="form-label">Título</label>
                                    <input type="text" class="form-control" id="ActualizarTitulo" name="titulo"
                                        placeholder="Ingrese el título del artículo" required />
                                </div>
                                <div class="mb-3">
                                    <label for="updateArticleImage" class="form-label">Imagen</label>
                                    <input type="file" class="form-control" id="updateArticleImage" name="imagen"
                                        accept="imagenes/*" />
                                    <small class="form-text text-muted">Deje este campo vacío si no desea cambiar la
                                        imagen.</small>
                                </div>
                                <div class="mb-3">
                                    <label for="ActualizarContenido" class="form-label">Contenido</label>
                                    <textarea class="form-control" id="ActualizarContenido" name="contenido" rows="5"
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
                                    <button type="submit" class="btn btn-gradient">Actualizar Artículo</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal para eliminar artículo -->
            <div class="modal fade" id="deleteArticleModal" tabindex="-1" aria-labelledby="deleteArticleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteArticleModalLabel">
                                Confirmación de Eliminación
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>¿Estás seguro de que deseas eliminar este artículo?</p>
                            <div class="mb-3">
                                <label for="deleteReason" class="form-label">
                                    Motivo de la eliminación
                                </label>
                                <textarea class="form-control" id="deleteReason" rows="3"
                                    placeholder="Escribe el motivo de la eliminación..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-gradient">
                                Eliminar Artículo
                            </button>

                        </div>
                    </div>
                </div>
            </div>
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.btn-edit-article').forEach(button => {
                    button.addEventListener('click', function() {
                        const articuloId = this.dataset
                            .id;
                        const articuloTitulo = this.dataset.titulo;
                        const articuloContenido = this.dataset.contenido;
                        const articuloCategoriaId = this.dataset.categoriaId;


                        document.getElementById('ArticuloId').value = articuloId;
                        document.getElementById('ActualizarTitulo').value = articuloTitulo;
                        document.getElementById('ActualizarContenido').innerText =
                            articuloContenido;
                        document.getElementById('ActualizarCategoria').value =
                            articuloCategoriaId;
                    });
                });
            });
            </script>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>



</html>
