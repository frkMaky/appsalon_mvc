<?php
namespace Model;

class Usuario extends ActiveRecord {

    // BBDD
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id','nombre','apellido','email','password','telefono','admin','confirmado','token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    // Constructor -----
    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? 0;
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->token = $args['token'] ?? '';
    }

    // Mensajes de validación para la creación de una cuenta
    public function validarNuevaCuenta() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es obligatorio';
        }
        if(!$this->apellido) {
            self::$alertas['error'][] = 'El Apellido es obligatorio';
        }
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email es obligatorio';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'El Password es obligatorio';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El Password debe contener al menos 6 caracteres';
        }
        return self::$alertas;
    }

    public function validarLogin() {

        if(!$this->email) {
            self::$alertas['error'][] = " El email es obligatiorio.";
        }

        if(!$this->password) {
            self::$alertas['error'][] = " El password es obligatiorio.";
        }
        return self::$alertas;
    }

    public function validarEmail() {

        if(!$this->email) {
            self::$alertas['error'][] = " El email es obligatiorio.";
        }
        return self::$alertas;
    }

    public function validarPassword() {
        if(!$this->password) {
            self::$alertas['error'][] = " El password es obligatorio";
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = " El password debe tener al menos 6 caracteres";
        }
        return self::$alertas;
    }

    // Revisa si el usuario ya existe
    public function existeUsuario() {

        $query = "SELECT * FROM " . self::$tabla ." WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);
    
        if($resultado->num_rows) { // Ya existe el usuario 
            self::$alertas['error'][] = "El usuario ya está registrado";
        }
        return $resultado;
    }

    // Hashear el password
    public function hashPassword() {
        $this->password = password_hash($this->password , PASSWORD_BCRYPT);
    }
    // Crear el Token 
    public function crearToken() {
        $this->token = uniqid();
    }

    public function comprobarPasswordAndVerificado($password){
        
        $resultado = password_verify($password,$this->password);
        if (!$resultado || !$this->confirmado) {
            self::$alertas['error'][] = "Constraseña incorrecta o cuenta no verificada";
        }else{ // 
            return true; 
        }
        return $resultado;
    }
}