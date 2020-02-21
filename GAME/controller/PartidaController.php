<?php
namespace App\Controller;

use App\Helper\ViewHelper;
use App\Helper\DbHelper;
use App\Model\Partida;


class PartidaController
{
    var $db;
    var $view;

    function __construct()
    {
        //Conexión a la BBDD
        $dbHelper = new DbHelper();
        $this->db = $dbHelper->db;

        //Instancio el ViewHelper
        $viewHelper = new ViewHelper();
        $this->view = $viewHelper;
    }

    //Listado de partidas
    public function index()
    {
        //Permisos
        $this->view->permisos("partidas");
        $id_usuario = $_SESSION['usuario'];
        if ($id_usuario == "admin"){
            $rowset = $this->db->query("SELECT * FROM partidas ORDER BY id_partida ASC");
            //Asigno resultados a un array de instancias del modelo
            $partidas = array();
            while ($row = $rowset->fetch(\PDO::FETCH_OBJ)) {
                array_push($partidas, new Partida($row));
            }$this->view->vista("admin", "partidas/index", $partidas);
        }else{
//Recojo las partidas de la base de datos
            $rowset = $this->db->query("SELECT * FROM partidas WHERE usuario='$id_usuario' ORDER BY id_partida ASC");
            //Asigno resultados a un array de instancias del modelo
            $partidas = array();
            while ($row = $rowset->fetch(\PDO::FETCH_OBJ)) {
                array_push($partidas, new Partida($row));
            }
            $this->view->vista("admin", "partidas/index", $partidas);
        }

    }


}