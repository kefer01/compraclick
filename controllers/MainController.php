<?php

namespace Controllers;

use Model\Busqueda;
use Model\Producto;
use MVC\Router;

class MainController
{

    public static function main(Router $router)
    {

        // Consultar la base de datos
        $consulta = "SELECT p.id, p.nombre, m.marca, p.descripcion, p.precio, p.imagen, ";
        $consulta .= "p.stock FROM producto p ";
        $consulta .= "INNER JOIN producto_marca m ON p.marca = m.id_producto_marca ";
        $consulta .= "INNER JOIN producto_tipo t ON p.tipo = t.id_producto_tipo ";
        $consulta .= "LIMIT 3";
        $productos = Producto::SQL($consulta);
        // debuguear($productos);
        $router->render('main/index', [
            'titulo' => 'Inicio',
            'productos' => $productos
        ]);
    }

    public static function proteccion(Router $router)
    {

        $router->render('main/proteccion', [
            'titulo' => 'Protección Animal',
        ]);
    }

    public static function nosotros(Router $router)
    {

        $router->render('main/nosotros', [
            'titulo' => 'Nosotros',
        ]);
    }

    public static function donar(Router $router)
    {

        $router->render('main/donar', [
            'titulo' => 'donar',
        ]);
    }

    public static function buscarMascota(Router $router)
    {
        $busqueda = $_POST['busqueda'];
        $query = "SELECT a.nombre, b.raza, c.nombre AS genero FROM mascota AS a
        INNER JOIN raza AS b ON a.raza = b.id
        INNER JOIN genero_mascota AS c ON a.genero = c.id
        WHERE b.raza LIKE '%" . $busqueda . "%'";

        $mascotas = Busqueda::sql($query);

        $router->render('main/busqueda', [
            'titulo' => 'Busqueda',
            'mascotas' => $mascotas
        ]);
    }

    public static function carrito(Router $router)
    {
        isAuth();
        $router->render('main/carrito', [
            'titulo' => 'Carrito de compras'
        ]);
    }

}