<?php

namespace Model;

class Publicacion extends ActiveRecord
{
    protected static $tabla = 'publicacion';
    protected static $columnasDB = [
        'id', 'id_usuario', 'id_mascota', 'publicacion', 'id_publicacion_estado',
        'fecha_hora', 'tipo_publicacion'
    ];

    public $id;
    public $id_usuario;
    public $id_mascota;
    public $publicacion;
    public $id_publicacion_estado;
    public $fecha_hora;
    public $tipo_publicacion;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_usuario = $args['id_usuario'] ?? $_SESSION['id'];
        $this->id_mascota = $args['id_mascota'] ?? '';
        $this->publicacion = $args['publicacion'] ?? '';
        $this->id_publicacion_estado = $args['id_publicacion_estado'] ?? '1';
        $this->fecha_hora = $args['fecha_hora'] ?? date('Y-m-d H:i:s');
        $this->tipo_publicacion = $args['tipo_publicacion'] ?? '1';
    }

    public function validar()
    {
        if (!$this->id_mascota) {
            self::$alertas['error'][] = 'La mascota es Obligatoria';
        }

        if (!$this->publicacion) {
            self::$alertas['error'][] = 'La descripción en la publicación es obligatoria';
        }

        if (strlen($this->fecha_hora) > 240) {
            self::$alertas['error'][] = 'La descripción no puede tener más de 240 caracteres';
        }
        
        return self::$alertas;
    }
}
