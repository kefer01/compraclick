<div class="contenedor nueva-publicacion">
    <h2>Nueva Publicación</h2>
    <p class="">Crea una nueva publicación sobre alguna de tus mascotas</p>

    <?php include_once __DIR__ . '/../templates/alertas.php' ?>

    <div class="contenedor-sm form">
        <!-- <form action="publicar" class="formulario" method="POST" enctype="multipart/form-data"> -->
        <form class="formulario" id="formularioPublicacion">
            <div class="campo">
                <label for="imagenes">Foto</label>
                <input type="file" accept="image/jpeg, image/png" name="imagenes[]" id="imagen"
                    placeholder="Foto de tu mascota" multiple>
            </div>
            <div class="campo">
                <label for="id_mascota">Mascota</label>
                <select name="id_mascota" id="mascota">
                    <option value="">-- Seleccione --</option>
                    <?php foreach ($mascotas as $mascota): ?>
                        <option value="<?php echo $mascota->id; ?>"><?php echo $mascota->nombre; ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="campo">
                <label for="publicacion">Descripción</label>
                <textarea name="publicacion" id="publicacion" placeholder="¿Que estás pensando publicar?"></textarea>
            </div>
            <!-- <input type="submit" name="postear" class="boton" value="Publicar"> -->
            <input type="button" class="boton" onclick="subirPublicacion()" value="Publicar">
        </form>

    </div>
</div>