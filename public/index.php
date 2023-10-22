<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use Controllers\AdminController;
use Controllers\MainController;
use Controllers\MascotaController;
use Controllers\UsuarioController;
use Controllers\UsuarioAdminController;
use MVC\Router;
$router = new Router();

// Pagina Main
$router->get('/', [MainController::class, 'main']);
// Pagina Blog
$router->get('/proteccion', [MainController::class, 'proteccion']);
// Pagina Blog
$router->get('/nosotros', [MainController::class, 'nosotros']);
// Pagina Blog
$router->get('/donar', [MainController::class, 'donar']);
$router->post('/busqueda', [MainController::class, 'buscarMascota']);


// Login
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// Crear cuenta
$router->get('/crear', [LoginController::class, 'crear']);
$router->post('/crear', [LoginController::class, 'crear']);

// Formulario de olvide mi password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/restablecer', [LoginController::class, 'restablecer']);
$router->post('/restablecer', [LoginController::class, 'restablecer']);

// Confirmacion de cuenta
$router->get('/confirmar', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

// Area privada
$router->get('/admin', [AdminController::class, 'index']);
// Usuario
$router->get('/usuario/index', [UsuarioController::class, 'index']);
$router->get('/usuario/publicar', [UsuarioController::class, 'nueva_publicacion']);
// $router->post('/usuario/publicar', [UsuarioController::class, 'nueva_publicacion']);
$router->post('/usuario/publicar', [UsuarioController::class, 'publicacion']);
$router->get('/usuario/cita/editar_perfil', [UsuarioController::class, 'editar_perfil']);
$router->post('/usuario/cita/editar_perfil', [UsuarioController::class, 'actualizar_perfil']);
$router->get('/usuario/nueva_publicacion', [UsuarioController::class, 'nueva_publicacion']);
$router->get('/usuario/perfil/editar_perfil', [UsuarioController::class, 'editar_perfil']);
$router->post('/usuario/perfil/editar_perfil', [UsuarioController::class, 'actualizar_perfil']);
//Mascota
$router->get('/usuario/mascota/crear', [MascotaController::class, 'crear']);
// Mantenimiento usuario
$router->get('/admin/usuario/mantenimiento', [UsuarioAdminController::class, 'index']);
$router->post('/usuario/mascota/crear', [MascotaController::class, 'crear']);
$router->get('/usuario/mascota/raza', [MascotaController::class, 'obtenerRaza']);

// Mantenimiento usuario
$router->get('/admin/usuario/mantenimiento', [UsuarioAdminController::class, 'index']);
$router->get('/admin/usuario/editar_perfil', [UsuarioController::class, 'modificar_perfiles']);
$router->post('/admin/usuario/editar_perfil', [UsuarioController::class, 'actualizar_perfil_admin']);

// Tienda
$router->get('/tienda/tienda', [UsuarioController::class, 'tienda']);
//$router->get('/', [MainController::class, 'main']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();