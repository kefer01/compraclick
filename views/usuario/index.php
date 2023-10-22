<div class="contenedor admin">
    <h2 class="nombre-pagina-admin">Perfil del Usuario</h2>
    <div class="contenedor-admin">
        <div>
            <div class="opciones">
                <div class="opcion">
                    <a class="boton-naranja" href="../usuario/publicar">Nueva publicacion</a>
                </div>
                <div class="opcion">
                    <a class="boton-naranja" href="../usuario/cita/editar_perfil">Actualizar Perfil</a>
                </div>
                <div class="opcion">
                    <a class="boton-naranja" href="../usuario/mascota/crear">Agregar Mascota</a>
                </div>
            </div>
        </div>
        <div>
            <h3>Tu muro de publicaciones</h3>
            <div class="tu-muro">
                <div class="perfil">
                    <?php echo $_SESSION['nombre'] ?>
                </div>
                <div class="publicaciones">
                    <h4 class="titulo-publicaciones">Publicaciones</h4>
                    <?php foreach ($publicaciones as $publicacion): ?>
                        <div class="publicacion">
                            <p class="idPublicacion" hidden>
                                <?php echo $publicacion->id ?>
                            </p>
                            <p>
                                <?php echo $publicacion->id_usuario ?>
                            </p>
                            <p>
                                <?php
                                // Pasar la fecha y hora a una hora legible 
                                $fecha = $publicacion->fecha_hora;
                                $timestamp = strtotime($fecha); // Convierte la fecha en un timestamp
                                $fecha_objeto = new DateTime();
                                $fecha_objeto->setTimestamp($timestamp);
                                $localizador = new IntlDateFormatter('es_GT', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
                                $localizador->setPattern('EEEE dd-MM-yyyy');
                                $fecha_formateada = $localizador->format($fecha_objeto); // Formatea el timestamp a la nueva fecha
                                echo $fecha_formateada;
                                ?>
                            </p>
                            <p>
                                <?php echo $publicacion->publicacion ?>
                            </p>
                            <div class="fotos">
                                <?php foreach ($fotosPost as $fotos): 
                                    foreach ($fotos as $foto) :
                                        if ($foto->id_publicacion == $publicacion->id): ?>
                                            <img loading="lazy" src="/imagenes/<?php echo $foto->nombre_foto; ?>" alt="Foto Publicacion">
                                    <?php endif;
                                    endforeach; 
                                endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>