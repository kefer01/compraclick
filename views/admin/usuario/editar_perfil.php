<div class="contenedor editar-perfil">
    <h2>Editar Perfil</h2>
    <?php include_once __DIR__ . '/../../templates/alertas.php' ?>
    <form action="/admin/usuario/editar_perfil" class="formulario"  method="POST">
            <div class="campo">
                <input type="text" name="id" hidden value="<?php echo $usuario->id; ?>">
            </div>
            <div class="campo">
                <label for="p_nombre">Primer Nombre</label>
                <input type="text" name="p_nombre" value="<?php echo $usuario->p_nombre; ?>">
            </div>
            <div class="campo">
                <label for="s_nombre">Segundo Nombre</label>
                <input type="text" name="s_nombre" value="<?php echo $usuario->s_nombre; ?>">
            </div>
            <div class="campo">
                <label for="p_apellido">Primer Apellido</label>
                <input type="text" name="p_apellido" value="<?php echo $usuario->p_apellido; ?>">
            </div>
            <div class="campo">
                <label for="s_Apellido">Segundo Apellido</label>
                <input type="text" name="s_apellido" value="<?php echo $usuario->s_apellido; ?>">
            </div>
            <div class="campo">
                <label for="usuario">Usuario</label>
                <input type="usuario" name="usuario" placeholder="Usuario" value="<?php echo $usuario->usuario; ?>">
            </div>
            <div class="campo">
                <label for="correo">Correo</label>
                <input type="correo" name="correo" placeholder="Correo" value="<?php echo $usuario->correo; ?>">
            </div>
            <div class="campo">
                <label for="estado">Estado</label>
                <input type="estado" name="estado" value="<?php echo $usuario->estado; ?>">
            </div>
            <div class="campo">
                <label for="rol">Rol</label>
                <input type="rol" name="rol" value="<?php echo $usuario->id_rol; ?>">
            </div>
            <input class="boton-verde" type="submit" class="boton" value="Actualizar">
        </form>
</div>    
