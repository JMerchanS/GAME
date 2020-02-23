<?php

namespace App\Controller;

use App\Helper\ViewHelper;
use App\Helper\DbHelper;
use App\Model\Noticia;
use App\Model\Partida;
use App\Model\Usuario;


class UsuarioController
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

    public function admin(){

//Compruebo permisos
        $this->view->permisos();

//LLamo a la vista
        $this->view->vista("admin","index");

    }

    public function entrar()
    {

//Si ya está autenticado, le llevo a la página de inicio del panel
        if (isset($_SESSION['usuario'])) {

            $this->admin();

        } //Si ha pulsado el botón de acceder, tramito el formulario
        else if (isset($_POST["acceder"])) {

//Recupero los datos del formulario
            $campo_usuario = filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_STRING);
            $campo_clave = filter_input(INPUT_POST, "clave", FILTER_SANITIZE_STRING);

//Busco al usuario en la base de datos
            $rowset = $this->db->query("SELECT * FROM usuarios WHERE usuario='$campo_usuario' AND activo=1 LIMIT 1");

//Asigno resultado a una instancia del modelo
            $row = $rowset->fetch(\PDO::FETCH_OBJ);
            $usuario = new Usuario($row);

//Si existe el usuario
            if ($usuario->usuario) {
//Compruebo la clave
                if (password_verify($campo_clave, $usuario->clave)) {

//Asigno el usuario y los permisos la sesión
                    $_SESSION["usuario"] = $usuario->usuario;
                    $_SESSION["usuarios"] = $usuario->usuarios;
                    $_SESSION["partidas"] = $usuario->partidas;

//Guardo la fecha de último acceso
                    $ahora = new \DateTime("now", new \DateTimeZone("Europe/Madrid"));
                    $fecha = $ahora->format("Y-m-d H:i:s");
                    $this->db->query("UPDATE usuarios SET fecha_acceso='$fecha' WHERE usuario='$campo_usuario'");

//Redirección con mensaje
                    $this->view->redireccionConMensaje("admin/index", "green", "Bienvenido al panel de administración.");
                } else {
//Redirección con mensaje
                    $this->view->redireccionConMensaje("admin", "red", "Contraseña incorrecta.");
                }
            } else {
//Redirección con mensaje
                $this->view->redireccionConMensaje("admin", "red", "No existe ningún usuario con ese nombre.");
            }
        } //Le llevo a la página de acceso
        else {
            $this->view->vista("admin", "usuarios/entrar");
        }
    }
    function compruebaUsuario()
    {
        //Para la conexión con DAM
        $campo_usuario = filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_STRING);
        $campo_clave = filter_input(INPUT_POST, "contrasena", FILTER_SANITIZE_STRING);


        $rowset = $this->db->query("SELECT * FROM usuarios WHERE usuario=' $campo_usuario' AND activo=1 LIMIT 1");
        //Asigno resultado a una instancia del modelo
        $row = $rowset->fetch(\PDO::FETCH_OBJ);

        $usuario = new Usuario($row);

        if ($usuario->usuario) {
            //Compruebo la clave
            if (password_verify($campo_clave, $usuario->clave)) {
                //Consulta a la bbdd
                $rowset = $this->db->query("SELECT * FROM partidas WHERE activo=1 ORDER BY fecha DESC");

                //Asigno resultados a un array de instancias del modelo
                $partidas = array();
                while ($row = $rowset->fetch(\PDO::FETCH_OBJ)) {
                    array_push($partidas, new Noticia($row));
                }

                //Compongo el array con la información de la API
                $array_partidas = array();
                foreach ($partidas as $row) {
                    $array_partidas[] = [
                        'usuario' => $row->usuario,
                        'tiempo' => $row->tiempo,
                        'puntos' => $row->puntos,
                        'fecha' => date("d/m/y"), strtotime($row->fecha),
                    ];
                }

                //Muestro en formato JSON
                echo json_encode($array_partidas, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

            } else {
                echo "no";
            }
        } else {
            echo "no";
        }
    }
    public function salir(){

//Borro al usuario de la sesión
        unset($_SESSION['usuario']);

//Redirección con mensaje
        $this->view->redireccionConMensaje("admin/usuarios/entrar","green","Te has desconectado con éxito.");

    }

//Listado de usuarios
    public function index(){

//Permisos
        $this->view->permisos("usuarios");

//Recojo los usuarios de la base de datos
        $rowset = $this->db->query("SELECT * FROM usuarios ORDER BY usuario ASC");

//Asigno resultados a un array de instancias del modelo
        $usuarios = array();
        while ($row = $rowset->fetch(\PDO::FETCH_OBJ)){
            array_push($usuarios,new Usuario($row));
        }

        $this->view->vista("admin","usuarios/index", $usuarios);

    }

    public function indexPropio(){

        $Usuario_sesion=$_SESSION['usuario'];
        //Recojo las partidas de la base de datos
        $rowset = $this->db->query("SELECT * FROM usuarios WHERE usuario='$Usuario_sesion'");
        //Asigno resultados a un array de instancias del modelo
        $usuario = array();
        while ($row = $rowset->fetch(\PDO::FETCH_OBJ)){
            array_push($usuario,new Usuario($row));
        }
        $this->view->vista("admin","index", $usuario);

    }

//Para activar o desactivar
    public function activar($id){

//Permisos
        $this->view->permisos("usuarios");

//Obtengo el usuario
        $rowset = $this->db->query("SELECT * FROM usuarios WHERE id='$id' LIMIT 1");
        $row = $rowset->fetch(\PDO::FETCH_OBJ);
        $usuario = new Usuario($row);

        if ($usuario->activo == 1){

//Desactivo el usuario
            $consulta = $this->db->exec("UPDATE usuarios SET activo=0 WHERE id='$id'");

//Mensaje y redirección
            ($consulta > 0) ? //Compruebo consulta para ver que no ha habido errores
                $this->view->redireccionConMensaje("admin/usuarios","green","El usuario <strong>$usuario->usuario</strong> se ha desactivado correctamente.") :
                $this->view->redireccionConMensaje("admin/usuarios","red","Hubo un error al guardar en la base de datos.");
        }

        else{

//Activo el usuario
            $consulta = $this->db->exec("UPDATE usuarios SET activo=1 WHERE id='$id'");

//Mensaje y redirección
            ($consulta > 0) ? //Compruebo consulta para ver que no ha habido errores
                $this->view->redireccionConMensaje("admin/usuarios","green","El usuario <strong>$usuario->usuario</strong> se ha activado correctamente.") :
                $this->view->redireccionConMensaje("admin/usuarios","red","Hubo un error al guardar en la base de datos.");
        }

    }

    public function borrar($id){

//Permisos
        $this->view->permisos("usuarios");

//Borro el usuario
        $consulta = $this->db->exec("DELETE FROM usuarios WHERE id='$id'");

//Mensaje y redirección
        ($consulta > 0) ? //Compruebo consulta para ver que no ha habido errores
            $this->view->redireccionConMensaje("admin/usuarios","green","El usuario se ha borrado correctamente.") :
            $this->view->redireccionConMensaje("admin/usuarios","red","Hubo un error al guardar en la base de datos.");

    }

    public function crear(){

        //Permisos
        $this->view->permisos("usuarios");

        //Creo un nuevo usuario vacío
        $usuario = new Usuario();

        //Llamo a la ventana de edición
        $this->view->vista("admin","usuarios/editar", $usuario);

    }

    public function editar($id)
    {


//Si ha pulsado el botón de guardar
        if (isset($_POST["guardar"])) {


//Recupero los datos del formulario
            $usuario = filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_STRING);
            $clave = filter_input(INPUT_POST, "clave", FILTER_SANITIZE_STRING);
            $usuarios = (filter_input(INPUT_POST, 'usuarios', FILTER_SANITIZE_STRING) == 'on') ? 1 : 0;
            $partidas = (filter_input(INPUT_POST, 'partidas', FILTER_SANITIZE_STRING) == 'on') ? 1 : 0;
            $cambiar_clave = (filter_input(INPUT_POST, 'cambiar_clave', FILTER_SANITIZE_STRING) == 'on') ? 1 : 0;

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
            //Actualizo el usuario
            ($cambiar_clave) ?
                $this->db->query("UPDATE usuarios SET usuario='$usuario',clave='$clave_encriptada',partidas='$partidas',usuarios='$usuarios', avatar='$avatar' WHERE id='$id'") :
                $this->db->query("UPDATE usuarios SET usuario='$usuario',partidas='$partidas',usuarios='$usuarios', avatar='$avatar' WHERE id='$id'");

            //Subo y actualizo la imagen
            if ($avatar) {
                if (is_uploaded_file($imagen_recibida['tmp_name']) && move_uploaded_file($imagen_recibida['tmp_name'], $imagen_subida)) {
                    $texto_img = " La imagen se ha subido correctamente.";
                    $this->db->query("UPDATE usuarios SET avatar='$avatar' WHERE id='$id'");
                } else {
                    $texto_img = " Hubo un problema al subir la imagen.";
                }
            }

            //Mensaje y redirección
            $this->view->redireccionConMensaje("admin/index", "green", "El usuario <strong>$usuario</strong> se guardado correctamente." . $texto_img);

        } //Si no, obtengo usuario y muestro la ventana de edición
        else {

//Obtengo el usuario
            $rowset = $this->db->query("SELECT * FROM usuarios WHERE id='$id' LIMIT 1");
            $row = $rowset->fetch(\PDO::FETCH_OBJ);
            $usuario = new Usuario($row);

//Llamo a la ventana de edición
            $this->view->vista("admin", "usuarios/editar", $usuario);
        }
    }

    public function mostrar(){

        //Consulta a la bbdd
        $rowset = $this->db->query("SELECT * FROM partidas");

        //Asigno resultados a un array de instancias del modelo
        $partidas = array();
        while ($row = $rowset->fetch(\PDO::FETCH_OBJ)){
            array_push($partidas,new Partida($row));
        }

        //Compongo el array con la información de la API
        $array_partidas = array();
        foreach ($partidas as $row){
            $array_partidas[] = [
                'id_partida' => $row->id_partida,
                'usuario' => $row->usuario,
                'fecha' => date("d/m/y"), strtotime($row->fecha),
                'tiempo' => $row->tiempo,
                'puntos' => $row->puntos
            ];
        }

        //Muestro en formato JSON
        echo json_encode($array_partidas, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}
