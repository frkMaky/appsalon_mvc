<?php

namespace Model;

class Servicio extends ActiveRecord {
    // BBDD
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id','nombre','precio'];

    public $id;
    public $nombre;
    public $precio;

    public function __construct($args=[]){
        $this->id = $id ?? '';
        $this->nombre = $nombre ?? '';
        $this->precio = $precio ?? '';
    }
    
    public function validar(){
        if(!$this->nombre) {
            self::$alertas['error'][] = "El nombre del servicio es obligatorio";
        }
        if(!$this->precio) {
            self::$alertas['error'][] = "El precio del servicio es obligatorio";
        }
        if(!is_numeric($this->precio)) {
            self::$alertas['error'][] = "El precio no es valido";
        }
        return self::$alertas;
    }

}