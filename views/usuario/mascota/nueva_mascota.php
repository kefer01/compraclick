<div class="contenedor nueva-mascota">
    <h2>Nueva Mascota</h2>
    <p class="">Agrega una nueva mascota a tu cuenta en Doggy Friends</p>

    <?php include_once __DIR__ . '/../../templates/alertas.php' ?>

    <div class="contenedor-sm form">
        <form action="../mascota/crear" class="formulario" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $id_usuario ?>">
            <div class="campo">
                <label for="nombre">Nombre de tu mascota</label>
                <input autofocus type="text" name="nombre" id="nombre" placeholder="El nombre de tu mascota"
                    value="<?php echo $mascota->nombre; ?>">
            </div>
            <div class="campo">
                <label for="animal">Tipo de Mascota</label>
                <select name="animal" id="animal">
                    <option value="">-- Seleccione --</option>
                    <?php foreach ($animales as $animal): ?>
                        <option value="<?php echo $animal->id; ?>"><?php echo $animal->especie; ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="campo">
                <label for="raza">Raza</label>
                <select name="raza" id="raza">
                </select>
            </div>
            <div class="campo">
                <label for="genero">Género</label>
                <select name="genero" id="genero">
                    <option value="">-- Seleccione --</option>
                    <?php foreach ($generos as $genero): ?>
                        <option value="<?php echo $genero->id; ?>"><?php echo $genero->nombre; ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="campo">
                <label for="peso">Peso</label>
                <input type="number" name="peso" id="peso" placeholder="Su peso" min="1">
            </div>
            <div class="campo">
                <label for="imagen">Foto</label>
                <input type="file" accept="image/jpeg, image/png" name="imagen" id="imagen"
                    placeholder="Foto de tu mascota">
            </div>
            <div class="campo">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" placeholder="Describe a tu mascota"></textarea>
            </div>

            <input type="submit" class="boton" value="Agregar Mascota">
        </form>

    </div>
</div>