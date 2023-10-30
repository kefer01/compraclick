<?php
$auth = $_SESSION['login'] ?? false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CompraClick |
        <?php echo $titulo ?? ''; ?>
    </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&family=Open+Sans&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/build/css/app.css">
    <link rel="stylesheet" href="style.scss">
</head>

<body>

    <header class="header">
        <div class="cont contenido-header">
            <div class="barra">
                <div class="izquierda">
                    <a href="/">
                        <img src="/build/img/logo.png" alt="Logotipo Doggy Friends">
                    </a>
                </div>
                <!-- <div class="menu">
                    <img class="mobile-menu" src="/build/img/menu-hamburguesa.png" alt="">

                </div>!-->

                <!-- <div class="center">
                    <form action="/busqueda" class="formulario" method="POST">
                        <input class="search-bar_input" type="text" name="busqueda" placeholder="buscar" name="q">
                        <button class="search-bar_button" type="submit" name="enviar"><img src="build/img/search.png"
                                alt=""></button>
                    </form>
                </div> -->

                <div class="derecha">
                    <nav class="navegacion ver">
                        <a href="/proteccion" class="link-icono proteccion">Protección al Comprador</a>
                        <a href="/nosotros" class="link-icono nosotros">Nosotros & FAQ</a>
                        <?php if (!$auth) { ?>
                            <a href="/login" class="link-icono iniciosesion">Iniciar Sesión</a>
                        <?php } else { ?>
                            <a href="/carrito" class="link-icono tienda">Carrito</a>
                            <a href="/usuario/index" class="link-icono perfil">Perfil</a>
                            <a href="/logout" class="link-icono cerrarsesion">Cerrar Sesión</a>
                        <?php } ?>
                        <img class="dark-mode-boton" src="/build/img/dark-mode.svg">
                    </nav>
                </div>
            </div>
    </header>

    <?php echo $contenido; ?>

    <footer class="footer">
        <p class="copyright">Todos los derechos reservados
            <?php echo date('Y'); ?> &copy;
        </p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="/build/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php echo $script ?? ''; ?>
</body>

</html>