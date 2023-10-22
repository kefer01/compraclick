<?php

namespace Model;

class Producto extends ActiveRecord
{
    protected static $tabla = 'productos';
    protected static $columnasDB = [
        'id_producto', 'tipo', 'nombre', 'marca', 'descripcion', 
        'uso', 'imagen', 'stock', 'costo', 'precio', 'estado'
    ];

    public $id_producto;
    public $tipo;
    public $nombre;
    public $marca;
    public $descripcion;
    public $uso;
    public $imagen;
    public $stock;
    public $costo;
    public $precio;
    public $estado;

    public function __construct($args = [])
    {
        $this->id_producto = $args['id_producto'] ?? null;
        $this->tipo = $args['tipo'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->marca = $args['marca'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->uso = $args['uso'] ?? '';
        $this->imagen = $args['imagen'] ?? 'pets.png';
        $this->stock = $args['stock'] ?? '';
        $this->costo = $args['costo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->estado = $args['estado'] ?? '';
    }
}