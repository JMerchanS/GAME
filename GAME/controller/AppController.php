<?php
namespace App\Controller;

use App\Helper\ViewHelper;
use App\Helper\DbHelper;
use App\Model\Partida;


class AppController
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

    public function index()
    {
        //Llamo a la vista
        $this->view->vista("app", "index");
    }

    public function registro() {
        $this->view->vista("registro", "index");

//Si ha pulsado el botón de guardar
        if (isset($_POST["guardar"])) {

//Recupero los datos del formulario
            $usuario = filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_STRING);
            $clave = filter_input(INPUT_POST, "clave", FILTER_SANITIZE_STRING);

            $imagen_recibida = $_FILES['avatar'];
            $avatar = ($_FILES['avatar']['name']) ? $_FILES['avatar']['name'] : "";
            $imagen_subida = ($_FILES['avatar']['name']) ? '/var/www/html/GAME' . $_SESSION['public'] . "img/" . $_FILES['avatar']['name'] : "";
            $texto_img = ""; //Para el mensaje

            //Encripto la clave
            $clave_encriptada = ($clave) ? password_hash($clave, PASSWORD_BCRYPT, ['cost' => 12]) : "";

//Subo la imagen
            if ($avatar) {
                if (is_uploaded_file($imagen_recibida['tmp_name']) && move_uploaded_file($imagen_recibida['tmp_name'], $imagen_subida)) {
                    $texto_img = " La imagen se ha subido correctamente.";
                } else {
                    $texto_img = " Hubo un problema al subir la imagen.";
                }
            }

            //Creo un nuevo usuario
            $this->db->query("INSERT INTO usuarios (usuario, clave, avatar) VALUES ('$usuario','$clave_encriptada','$avatar')");
//Mensaje y redirección
            $this->view->redireccionConMensaje("green", "El usuario se creado correctamente.");

        }
    }

    /*<? php

 función  pública unityjson () {

    // Consulta a la bbdd
    $ rowset = $ this -> db -> query ( "SELECCIONAR * DE noticias DONDE activo = 1 ORDENAR POR fecha DESC" );

    // Asigno resultados a un conjunto de instancias del modelo
    $ noticias = array ();
    while ( $ row = $ rowset -> fetch (\ PDO :: FETCH_OBJ )) {
        array_push ( $ noticias , nueva  Noticia ( $ fila ));
    }

    // Compongo el array con la información que necesita la API
    $ array_noticias = array ();
    foreach ( $ noticias  como  $ row ) {
        $ array_noticias [] = [
            'titulo' => $ row -> titulo ,
            'entradilla' => $ row -> entradilla ,
            'texto' => $ row -> texto ,
            'autor' => $ fila -> autor ,
            'fecha' => date ( "d / m / Y" , strtotime ( $ row -> fecha )),
            'enlace' => $ _SESSION [ 'inicio' ]. "noticia /" . $ fila -> babosa ,
            'imagen' => $ _SESSION [ 'public' ]. "img /" . $ fila -> imagen
        ];
    }

    // Muestro en formato JSON con opciones para tildes y caracteres de escape
    echo  json_encode ( $ array_noticias ,
        JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

}

 función  pública unitypost () {

    $ usuario = entrada_filtro ( INPUT_POST , "usuario" , FILTER_SANITIZE_SPECIAL_CHARS );
    $ clave = entrada_filtro ( INPUT_POST , "clave" , FILTER_SANITIZE_SPECIAL_CHARS );
    echo  "POST: El usuario es $ usuario y la clave es $ clave" ;

}

 función  pública unityget () {

    $ usuario = filter_input ( INPUT_GET , "usuario" , FILTER_SANITIZE_SPECIAL_CHARS );
    $ clave = entrada_filtro ( INPUT_GET , "clave" , FILTER_SANITIZE_SPECIAL_CHARS );
    echo  "OBTENER: El usuario es $ usuario y la clave es $ clave" ;

}
     */
}