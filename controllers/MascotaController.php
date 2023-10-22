<?php

namespace Controllers;

use Model\Animal;
use Model\Genero;
use Model\Mascota;
use Model\Raza;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;


class MascotaController
{

    public static function index(Router $router)
    {
        isAuth();
        $router->render('usuario/index', [
            'nombre' => $_SESSION['nombre'],
            'titulo' => 'Tu Perfil'
        ]);
    }

    public static function crear(Router $router)
    {
        isAuth();
        $id_usuario = $_SESSION['id'];
        $generos = Genero::all();
        $animales = Animal::all();
        $alertas = [];
        $mascota = new Mascota;


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mascota->sincronizar($_POST);
            if ($mascota->imagen === '') {
                $mascota->imagen = 'pets.png';
            } else {
                /** SUBIDA DE ARCHIVOS */

                // Generar un nombre unico
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                // Setear la imagen
                // Realiza un resize a la imagen con Intervention
                if ($_FILES['imagen']['tmp_name']) {
                    $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
                    $mascota->setImagen($nombreImagen);
                }
            }
            $alertas = $mascota->validar();
            if (empty($alertas)) {
                // debuguear($mascota);
                // CREAR CARPETA para subir imagenes
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
                //Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
                // Guarda en la base de datos
                $resultado = $mascota->guardar();
                if ($resultado) {
                    header('Location: /usuario/index');
                }
            }
        }

        $router->render('usuario/mascota/nueva_mascota', [
            'titulo' => 'Agregar Nueva Mascota',
            'alertas' => $alertas,
            'generos' => $generos,
            'animales' => $animales,
            'mascota' => $mascota,
            'id_usuario' => $id_usuario
        ]);
    }


    public static function obtenerRaza()
    {
        isAuth();

        $numero = $_GET['numero'];
        // Hacer algo con el valor del parámetro
        $especies = Raza::whereAll('id_especie', $numero);
        // Generar una respuesta en formato JSON
        echo json_encode($especies);
    }
}