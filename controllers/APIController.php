<?php

namespace Controllers;

use Model\Producto;



class APIController
{

    public static function buscarProducto()
    {
        $alerta=[];
        if (!isset($_SESSION['login'])) {
            $alerta['Error'] = 'Usuario no registrado';
            echo json_encode($alerta);
        } else {
            $id = $_GET["id"];
            $consulta = "SELECT p.id, p.nombre, m.marca, p.descripcion, p.precio, p.imagen, ";
            $consulta .= "p.stock FROM producto p ";
            $consulta .= "INNER JOIN producto_marca m ON p.marca = m.id_producto_marca ";
            $consulta .= "INNER JOIN producto_tipo t ON p.tipo = t.id_producto_tipo ";
            $consulta .= "WHERE id=" . $id;
            $producto = Producto::SQL($consulta);
            echo json_encode($producto);
        }
    }
    // public static function index() {
    //     $vacunas = Vacuna::all();
    //     // debuguear($vacunas);
    //     echo json_encode($vacunas);
    // }

    // public static function guardar() {

    //     // Almacena la Cita y devuelve el ID
    //     $cita = new Cita($_POST);

    //     $resultado = $cita->guardar();
    //     // Retornamos una respuesta
    //     echo json_encode(['resultado' => $resultado]);
    // }

    // public static function eliminar() {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $id = $_POST['id'];
    //         $cita = Cita::find($id);
    //         $cita->eliminar();
    //         header('Location:' . $_SERVER['HTTP_REFERER']);
    //     }
    // }
}
