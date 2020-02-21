<?php
namespace App\Model;

class Partida
{
    //Variables o atributos
    var $id_partida;
    var $usuario;
    var $fecha;
    var $tiempo;
    var $puntos;



    function __construct($data=null){

        $this->id_partida = ($data) ? $data->id_partida : null;
        $this->usuario = ($data) ? $data->usuario : null;
        $this->fecha = ($data) ? $data->fecha : null;
        $this->tiempo = ($data) ? $data->tiempo : null;
        $this->puntos = ($data) ? $data->puntos : null;
    }

}