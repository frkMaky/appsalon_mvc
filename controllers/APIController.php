<?php

namespace Controllers;

use Model\Servicio;
use Model\Cita;
use Model\CitaServicio;

class APIController {

    public static function index() {
        $servicios = Servicio::all();

        echo json_encode($servicios,JSON_INVALID_UTF8_IGNORE);
    }

    public static function guardar() {
        
        // Almacena la cita y devuelve el ID
        $cita = new Cita($_POST);
        $resultado = $cita.guardar();

        $id = $resultado['id'];

        // Almacela la cita y los servicios

        // Almacena los servicios con el id de la cita
        $idServicios = explode(',',$_POST['servicios']);
        foreach($idServicios as $idServicio){
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        // Devolvemos respuesta
        // $respuesta = [
        //     'resultado' => $resultado,
        // ];
        echo json_encode(['resultado'=>$resultado],JSON_INVALID_UTF8_IGNORE);
    }

    public static function eliminar() {
        if ($_SERVER['REQUEST_METHOD']==='POST'){
            $id = $_POST['id'];
            $cita = Cita::find($id);
            $cita->eliminar();
            header('Location:'. $_SERVER['HTTP_REFERER']);
        }
    }
}