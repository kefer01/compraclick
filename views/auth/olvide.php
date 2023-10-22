<div class="contenedor olvide">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php' ?>
    <?php include_once __DIR__ . '/../templates/alertas.php' ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Recupera tu Acceso a Doggy Friends</p>

        <form action="/olvide" class="formulario" method="POST">
            <div class="campo">
                <label for="correo">Correo</label>
                <input type="email" name="correo" id="correo" placeholder="Tu Correo">
            </div>
            <input type="submit" value="Enviar Instrucciones">
        </form>
        <div class="acciones">
            <a href="/login">¿Ya tienes cuenta? Iniciar Sesión</a>
            <a href="/crear">¿Aún no tienes una cuenta? obtener una</a>
        </div>
    </div>
</div>