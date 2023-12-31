<?php

namespace Model;

class Usuario extends ActiveRecord
{
    protected static $tabla = 'usuario';
    protected static $columnasDB = ['id', 'p_nombre', 's_nombre',
    'p_apellido', 's_apellido', 'correo', 'usuario','pass', 'estado', 'token', 'id_rol', 'confirmado'];

    public $id;
    public $p_nombre;
    public $s_nombre;
    public $p_apellido;
    public $s_apellido;
    public $correo;
    public $usuario;
    public $pass;
    public $estado;
    public $token;
    public $id_rol;
    public $confirmado;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->p_nombre = $args['p_nombre'] ?? '';
        $this->s_nombre = $args['s_nombre'] ?? '';
        $this->p_apellido = $args['p_apellido'] ?? '';
        $this->s_apellido = $args['s_apellido'] ?? '';
        $this->correo = $args['correo'] ?? '';
        $this->usuario = $args['usuario'] ?? '';
        $this->pass = $args['pass'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->estado = $args['estado'] ?? '0';
        $this->token = $args['token'] ?? '';
        $this->id_rol = $args['id_rol'] ?? 3;
        $this->confirmado = $args['confirmado'] ?? '1';
    }

    // Validación para cuentas nuevas
    public function validarNuevaCuenta() {
        if(!$this->p_nombre){
            self::$alertas['error'][] = 'El Nombre del Usuario es Obligatorio';
        }
        if(!$this->p_apellido){
            self::$alertas['error'][] = 'El Apellido del Usuario es Obligatorio';
        }
        if(!$this->correo){
            self::$alertas['error'][] = 'El Correo del Usuario es Obligatorio';
        }
        if(!filter_var($this->correo, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'El Correo del Usuario no es válido';
        }
        if(!$this->pass){
            self::$alertas['error'][] = 'La Contraseña no puede ir vacía';
        }
        if(strlen($this->pass) < 6 ){
            self::$alertas['error'][] = 'La Contraseña debe contener al menos 6 caracteres';
        }
        if($this->pass !== $this->password2 ){
            self::$alertas['error'][] = 'Las Contraseñas son diferentes';
        }
        return self::$alertas;
    }
    
    // Hashea el password
    public function hashPassword(){
        $this->pass = password_hash($this->pass, PASSWORD_BCRYPT);
    }

    public function validarLogin() {
        if (!$this->correo) {
            self::$alertas['error'][] = 'El correo es obligatorio';
        }
        if (!$this->pass) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }

        return self::$alertas;
    }

    // Generar un token
    public function crearToken(){
        $this->token = uniqid();
    }

    public function comprobarPasswordAndVerificado($password) {
        $resultado = password_verify($password, $this->pass);
        if (!$resultado || !$this->confirmado) {
            self::$alertas['error'][] = 'Contraseña Incorrecta o tu cuenta no ha sido confirmada';
        } else {
            return true;
        }
    }

    public function validarEmail() {
        if (!$this->correo) {
            self::$alertas['error'][] = 'El correo es obligatorio';
        }
        return self::$alertas;
    }

    public function validarPassword() {
        if (!$this->pass) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }
        if (strlen($this->pass) < 6) {
            self::$alertas['error'][] = 'La contraseña debe tener al menos 6 caracteres';
        }
        return self::$alertas;
    }
}
