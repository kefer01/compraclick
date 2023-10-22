<?php

namespace Model;

class Genero extends ActiveRecord
{
    protected static $tabla = 'genero_mascota';
    protected static $columnasDB = [
        'id', 'nombre'];

    public $id;
    public $nombre;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
    }
}
