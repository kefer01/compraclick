<div class="contenedor reestablecer">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php' ?>
    <?php include_once __DIR__ . '/../templates/alertas.php' ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Coloca tu nuevo password</p>

        <form class="formulario" method="POST">
            <div class="campo">
                <label for="pass">Contraseña</label>
                <input type="password" name="pass" id="pass" placeholder="Tu Contraseña">
            </div>
            <div class="campo">
                <label for="password2">Repetir Contraseña</label>
                <input type="password" name="password2" id="password2" placeholder="Repite tu Contraseña">
            </div>

            <input type="submit" class="boton" value="Guardar Contraseña">
        </form>
        <div class="acciones">
            <a href="/crear">¿Aún no tienes una cuenta? obtener una</a>
            <a href="/olvide">¿Olvidaste tu contraseña?</a>
        </div>
    </div><!-- .contenedor-sm  -->
</div>