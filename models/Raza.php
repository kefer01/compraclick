<?php

namespace Model;

class Raza extends ActiveRecord
{
    protected static $tabla = 'raza';
    protected static $columnasDB = [
        'id', 'raza', 'descripcion', 'id_especie'
    ];

    public $id;
    public $raza;
    public $descripcion;
    public $id_especie;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->raza = $args['raza'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->id_especie = $args['id_especie'] ?? '';
    }

    public function validar()
    {
        if (!$this->raza) {
            self::$alertas['error'][] = 'Debes añadir un raza';
        }

        if (!$this->raza) {
            self::$alertas['error'][] = 'La raza es Obligatoria';
        }

        if (!$this->id_especie) {
            self::$alertas['error'][] = 'Agregar id_especie de la raza';
        }

        if (!$this->descripcion) {
            self::$alertas['error'][] = 'La descripcion es obligatoria';
        }

        if (strlen($this->descripcion) > 50) {
            self::$alertas['error'][] = 'La descripción no puede tener más de 50 caracteres';
        }

        return self::$alertas;
    }
}
