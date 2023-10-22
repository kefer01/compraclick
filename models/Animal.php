<?php

namespace Model;

class Animal extends ActiveRecord
{
    protected static $tabla = 'animal';
    protected static $columnasDB = [
        'id', 'especie'
    ];

    public $id;
    public $especie;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->especie = $args['especie'] ?? '';
    }

    public function validar()
    {
        if (!$this->especie) {
            self::$alertas['error'][] = 'Debes añadir un especie';
        }

        if (!$this->animal) {
            self::$alertas['error'][] = 'La animal es Obligatoria';
        }

        return self::$alertas;
    }
}
