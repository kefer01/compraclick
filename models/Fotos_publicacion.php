<?php

namespace Model;

class Fotos_publicacion extends ActiveRecord
{
    protected static $tabla = 'fotos_publicacion';
    protected static $columnasDB = [
        'id', 'id_publicacion', 'nombre_foto'];

    public $id;
    public $id_publicacion;
    public $nombre_foto;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_publicacion = $args['id_publicacion'] ?? '';
        $this->nombre_foto = $args['nombre_foto'] ?? '';
    }
}
