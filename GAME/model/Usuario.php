<?php
namespace App\Model;

class Usuario {

    //Variables o atributos
    var $id;
    var $usuario;
    var $clave;
    var $avatar;
    var $fecha_acceso;
    var $activo;
    var $usuarios;
    var $partidas;

    function __construct($data=null){

        $this->id = ($data) ? $data->id : null;
        $this->usuario = ($data) ? $data->usuario : null;
        $this->clave = ($data) ? $data->clave : null;
        $this->avatar = ($data) ? $data-> avatar : null;
        $this->fecha_acceso = ($data) ? $data->fecha_acceso : null;
        $this->activo = ($data) ? $data->activo : null;
        $this->usuarios = ($data) ? $data->usuarios : null;
        $this->partidas = ($data) ? $data->partidas : null;

    }

}