<?php

namespace Model;

class Busqueda extends ActiveRecord
{
    protected static $tabla = 'animal';
    protected static $columnasDB = [
        'nombre', 'raza', 'genero'
    ];

    public $nombre;
    public $raza;
    public $genero;


    public function __construct($args = [])
    {
        $this->nombre = $args['nombre'] ?? null;
        $this->raza = $args['raza'] ?? '';
        $this->genero = $args['genero'] ?? '';
    }
}