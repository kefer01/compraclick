<div class="contenedor editar-perfil">
    <h2>Editar Perfil</h2>
    <?php include_once __DIR__ . '/../../templates/alertas.php' ?>
    <form action="/usuario/perfil/editar_perfil" class="formulario"  method="POST">
            <div class="campo">
                <label for="p_nombre">Primer Nombre</label>
                <input type="text" name="p_nombre" value="<?php echo $usuario->p_nombre; ?>">
            </div>
            <div class="campo">
                <label for="s_nombre">Segundo Nombre</label>
                <input type="text" name="s_nombre" value="<?php echo $usuario->s_nombre; ?>">
            </div>
            <div class="campo">
                <label for="s_nombre">Primer Apellido</label>
                <input type="text" name="p_apellido" value="<?php echo $usuario->p_apellido; ?>">
            </div>
            <div class="campo">
                <label for="s_nombre">Segundo Apellido</label>
                <input type="text" name="s_apellido" value="<?php echo $usuario->s_apellido; ?>">
            </div>
            <div class="campo">
                <label for="usuario">Usuario</label>
                <input type="usuario" name="usuario" placeholder="Tu Usuario" value="<?php echo $usuario->usuario; ?>">
            </div>
            <input type="submit" class="boton" value="Actualizar">
        </form>
</div>    
