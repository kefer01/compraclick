<div class="contenedor login">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php' ?>
    <?php include_once __DIR__ . '/../templates/alertas.php' ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Iniciar Sesión</p>

        <form action="/login" class="formulario" method="POST">
            <div class="campo">
                <label for="correo">Correo</label>
                <input type="email" name="correo" id="correo" placeholder="Tu Correo">
            </div>
            <div class="campo">
                <label for="pass">Contraseña</label>
                <input type="password" name="pass" id="pass" placeholder="Tu Contraseña">
            </div>

            <input type="submit" class="boton" value="Iniciar Sesión">
        </form>
        <div class="acciones">
            <a href="/crear">¿Aún no tienes una cuenta? obtener una</a>
            <a href="/olvide">¿Olvidaste tu contraseña?</a>
        </div>
    </div><!-- .contenedor-sm  -->
</div>