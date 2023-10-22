<?php

namespace Controllers;

use Model\Fotos_publicacion;
use Model\Mascota;
use Model\Publicacion;
use MVC\Router;
use Model\Usuario;
use Model\Producto;
use Intervention\Image\ImageManagerStatic as Image;


class UsuarioController
{

    public static function index(Router $router)
    {
        $query = "SELECT a.id, CONCAT(c.p_nombre, ' ', c.p_apellido) AS id_usuario, b.nombre as id_mascota, 
        a.publicacion, a.id_publicacion_estado, a.fecha_hora, a.tipo_publicacion FROM publicacion a
        INNER JOIN mascota b ON a.id_mascota = b.id INNER JOIN usuario c ON a.id_usuario = c.id
        WHERE a.id_usuario = 5 ORDER BY a.fecha_hora desc";
        $publicaciones = Publicacion::SQL($query);
        $fotos = new Fotos_publicacion;
        $fotosPost = [];
        foreach ($publicaciones as $publicacion) {
            $idFotos = $publicacion->id;
            array_push($fotosPost, $fotos::whereAll('id_publicacion',$idFotos));
        }
        isAuth();
        $router->render('usuario/index', [
            'nombre' => $_SESSION['nombre'],
            'titulo' => 'Tu Perfil',
            'publicaciones' => $publicaciones,
            'fotosPost' => $fotosPost
        ]);
    }

    public static function nueva_publicacion(Router $router)
    {
        isAuth();
        $alertas = [];
        $id = $_SESSION['id'];
        $mascotas = Mascota::findAll($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $publicacion = new Publicacion;
            $publicacion->sincronizar($_POST);

            $alertas = $publicacion->validar();

            if (empty($alertas)) {
                $resultado = $publicacion->guardar();
                if ($resultado) {
                    $id_publicacion = $resultado['id'];
                    if (isset($_FILES['imagenes'])) {
                        $archivos = $_FILES['imagenes'];
                        foreach ($archivos['name'] as $indice => $nombre) {
                            /** SUBIDA DE ARCHIVOS */
                            // Generar un nombre unico
                            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                            if ($archivos['tmp_name'][$indice]) {
                                // Setear la imagen
                                // Realiza un resize a la imagen con Intervention
                                $image = Image::make($archivos['tmp_name'][$indice])->fit(800, 600);
                                $publicacion->setImagen($nombreImagen);
                                // CREAR CARPETA para subir imagenes
                                if (!is_dir(CARPETA_IMAGENES)) {
                                    mkdir(CARPETA_IMAGENES);
                                }
                                //Guarda el nombre de la imagen en la BD ya ligada a la publicacion
                                $imagen = new Fotos_publicacion;
                                $imagen->id_publicacion = $id_publicacion;
                                $imagen->nombre_foto = $nombreImagen;
                                $resultadoImagen = $imagen->guardar();
                                if ($resultadoImagen) {
                                    //Guarda la imagen en el servidor
                                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                                    echo ('Publicación creada con exito');
                                    // header('Location: /usuario/index');
                                }
                            }
                        }
                    }
                }
            }
        }

        $router->render('usuario/nueva_publicacion', [
            'titulo' => 'Nueva Publicación',
            'alertas' => $alertas,
            'mascotas' => $mascotas
        ]);
    }

    public static function editar_perfil(Router $router)
    {
        isAuth();
        $alertas = [];
        $id_usuario = $_SESSION['id'];
        $usuario = Usuario::find($id_usuario);

        $router->render('usuario/perfil/editar_perfil', [
            'titulo' => 'Editar Perfil',
            'alertas' => $alertas,
            'usuario' => $usuario
        ]);
    }

    public static function actualizar_perfil(Router $router)
    {
        isAuth();
        $alertas = [];
        $id_usuario = $_SESSION['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = Usuario::find($id_usuario);
                $usuario->sincronizar($_POST);
                if (empty($alertas)) {
                    $existeUsuario = Usuario::where('correo', $usuario->correo);
                    if ($existeUsuario) {
                        Usuario::setAlerta('error', 'El Usuario ya esta registrado');
                        $usuario->guardar();
                    } else {
                        
                        // Crear un nuevo usuario
                        $resultado = $usuario->guardar();
    
                    }
                }

               
        
    }  
        $router->render('usuario/perfil/editar_perfil', [
            'titulo' => 'Editar Perfil',
            'alertas' => $alertas,
            'usuario' => $usuario
        ]);
    }



    public static function publicacion(Router $router)
    {
        isAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $publicacion = new Publicacion;
            $publicacion->sincronizar($_POST);

            $alertas = $publicacion->validar();

            if (empty($alertas)) {
                $resultado = $publicacion->guardar();
                if ($resultado) {
                    $id_publicacion = $resultado['id'];
                    if (isset($_FILES['imagenes'])) {
                        $archivos = $_FILES['imagenes'];
                        foreach ($archivos['name'] as $indice => $nombre) {
                            /** SUBIDA DE ARCHIVOS */
                            // Generar un nombre unico
                            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                            if ($archivos['tmp_name'][$indice]) {
                                // Setear la imagen
                                // Realiza un resize a la imagen con Intervention
                                $image = Image::make($archivos['tmp_name'][$indice])->fit(800, 600);
                                $publicacion->setImagen($nombreImagen);
                                // CREAR CARPETA para subir imagenes
                                if (!is_dir(CARPETA_IMAGENES)) {
                                    mkdir(CARPETA_IMAGENES);
                                }
                                //Guarda el nombre de la imagen en la BD ya ligada a la publicacion
                                $imagen = new Fotos_publicacion;
                                $imagen->id_publicacion = $id_publicacion;
                                $imagen->nombre_foto = $nombreImagen;
                                $resultadoImagen = $imagen->guardar();
                                if ($resultadoImagen) {
                                    //Guarda la imagen en el servidor
                                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                                    // header('Location: /usuario/index');
                                }
                            }
                        }
                    }
                    $respuesta = true;
                    echo json_encode($respuesta);
                }
            } else {
                $respuesta = false;
                echo json_encode($respuesta);
            }
        }
    }

    public static function tienda(Router $router)
    {
        isAuth();
        // Consultar la base de datos
        $consulta = "SELECT id_producto, tipo, nombre, marca, descripcion, uso, imagen,";
        $consulta .= " stock, costo, precio, estado ";
        $consulta .= "from productos";

        //debuguear($consulta);
        $producto = Producto::SQL($consulta);
        //debuguear($producto);
        $router->render('tienda/tienda', [
            //'nombre' => $_SESSION['nombre'],
            'titulo' => 'Tienda',
            'producto' => $producto
        ]);
    }

    public static function modificar_perfiles(Router $router)
    {
        isAuth();
        $alertas = [];
        $id_usuario = $_GET['id'];
        $usuario = Usuario::find($id_usuario);

        $router->render('admin/usuario/editar_perfil', [
            'titulo' => 'Editar Perfil',
            'alertas' => $alertas,
            'usuario' => $usuario
        ]);
    }

    public static function actualizar_perfil_admin(Router $router)
    {
        isAuth();
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //debuguear($_POST);
                $usuario = new Usuario;
                $usuario->sincronizar($_POST);
                $usuario->actualizar();

                // actualizamos usuario
                $resultado = $usuario->actualizar();
                header('Location: /admin/usuario/mantenimiento');      
        }  
        $router->render('admin/usuario/editar_perfil', [
            'titulo' => 'Editar Perfil',
            'alertas' => $alertas,
            'usuario' => $usuario
        ]);
    }
}