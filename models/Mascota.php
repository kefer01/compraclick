<?php

namespace Model;

class Mascota extends ActiveRecord
{
    protected static $tabla = 'mascota';
    protected static $columnasDB = [
        'id',
        'nombre',
        'raza',
        'genero',
        'peso',
        'descripcion',
        'id_usuario',
        'estado',
        'imagen',
        'id_especie'
    ];

    public $id;
    public $nombre;
    public $raza;
    public $genero;
    public $peso;
    public $descripcion;
    public $id_usuario;
    public $estado;
    public $imagen;
    public $id_especie;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->raza = $args['raza'] ?? '';
        $this->genero = $args['genero'] ?? '';
        $this->peso = $args['peso'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->id_usuario = $args['id_usuario'] ?? '';
        $this->estado = $args['estado'] ?? '1';
        $this->imagen = $args['imagen'] ?? 'pets.png';
        $this->id_especie = $args['id_especie'] ?? '1';
    }

    public function validar()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'Debes añadir un nombre';
        }

        if (!$this->raza) {
            self::$alertas['error'][] = 'La raza es Obligatoria';
        }

        if (!$this->peso) {
            self::$alertas['error'][] = 'Agregar peso de la mascota';
        }

        if (!$this->genero) {
            self::$alertas['error'][] = 'El género es Obligatorio';
        }

        if (!$this->descripcion) {
            self::$alertas['error'][] = 'La descripcion es obligatoria';
        }

        if (strlen($this->descripcion) > 50) {
            self::$alertas['error'][] = 'La descripción no puede tener más de 50 caracteres';
        }

        return self::$alertas;
    }

    // Buscar varios registro por su id
    public static function findAll($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id_usuario = ${id}";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
}