<div class="contenedor crear">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php' ?>
    <?php include_once __DIR__ . '/../templates/alertas.php' ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crea tu cuenta en CompraClick</p>

        <?php include_once __DIR__ . '/../templates/alertas.php' ?>

        <form action="/crear" class="formulario" method="POST">
            <div class="campo">
                <label for="p_nombre">Nombre</label>
                <input type="text" name="p_nombre" id="p_nombre" placeholder="Tu Nombre" value="<?php echo $usuario->p_nombre; ?>">
            </div>
            <div class="campo">
                <label for="p_apellido">Apellido</label>
                <input type="text" name="p_apellido" id="p_apellido" placeholder="Tu apellido" value="<?php echo $usuario->p_apellido; ?>">
            </div>
            <div class="campo">
                <label for="correo">Correo</label>
                <input type="email" name="correo" id="correo" placeholder="Tu Correo" value="<?php echo $usuario->correo; ?>">
            </div>
            <div class="campo">
                <label for="pass">Contraseña</label>
                <input type="password" name="pass" id="pass" placeholder="Tu Contraseña">
            </div>
            <div class="campo">
                <label for="password2">Repetir Contraseña</label>
                <input type="password" name="password2" id="password2" placeholder="Repite tu Contraseña">
            </div>

            <input type="submit" class="boton" value="Crear Cuenta">
        </form>
        <div class="acciones">
            <a href="/login">¿Ya tienes cuenta? Iniciar Sesión</a>
            <a href="/olvide">¿Olvidaste tu contraseña?</a>
        </div>
    </div><!-- .contenedor-sm  -->
</div>