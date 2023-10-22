<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;


class UsuarioAdminController
{

    public static function index(Router $router)
    {
        isAuth();
        $usuarios = Usuario::all();


        $router->render('/admin/usuario/mantenimiento', [
            'nombre' => $_SESSION['nombre'],
            'titulo' => 'Mantenimiento',
            'usuarios' => $usuarios
        ]);
    }

    public static function nueva_publicacion(Router $router)
    {
        isAuth();
        $alertas = [];

        $router->render('usuario/nueva_publicacion', [
            'titulo' => 'Nueva Publicación',
            'alertas' => $alertas
        ]);
    }
}