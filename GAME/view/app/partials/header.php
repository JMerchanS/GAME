<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>GAME</title>

    <!--CSS-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['public'] ?>css/app.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Creepster&display=swap');
    </style>
</head>

<body style="background-color: #4aa0e6">
<nav style="background-color: #1d68a7">
    <div class="nav-wrapper">

        <!--Botón menú móviles-->
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>

        <!--Menú de navegación-->
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li>
                <a href="<?php echo $_SESSION['home'] ?>" title="Inicio">Inicio</a>
            </li>
            <li>
                <a href="<?php echo $_SESSION['home'] ?>admin" title="Panel de administración"
                   target="_blank" class="grey-text">
                    Admin
                </a>
            </li>
            <li>
                <a href="<?php echo $_SESSION['home'] ?>registro" title="Registro"
                   target="_blank" class="grey-text">
                    Registro
                </a>
            </li>
            <li>
                <a href="http://3.8.131.236/GAME/view/Game/index.html" title="Panel de administración"
                   target="_blank" class="grey-text">
                    Game
                </a>
            </li>
        </ul>

    </div>
</nav>

<!--Menú de navegación móvil-->
<ul class="sidenav" id="mobile-demo" style="background-color: #1b4b72">
    <li>
        <a href="<?php echo $_SESSION['home'] ?>" title="Inicio">Inicio</a>
    </li>
    <li>
        <a href="<?php echo $_SESSION['home'] ?>admin" title="Panel de administración"
           target="_blank" class="grey-text">
            Admin
        </a>
    </li>
    <li>
        <a href="<?php echo $_SESSION['home'] ?>registro" title="Registro"
           target="_blank" class="grey-text">
            Registro
        </a>
    </li>
    <li>
        <a href="http://3.8.131.236/GAME/view/Game/index.html" title="Game"
           target="_blank" class="grey-text">
            Game
        </a>
    </li>
</ul>

<main>

    <header>
        <img src="<?php echo $_SESSION['public'] ?>img/descarga.png"style="display: inline-block">
        <h1 style="display: inline-block; padding: 1em;">Welcome to...<span style="font-family: 'Creepster', cursive;">ZOMBIELAND</span></h1>
        <h2 style="font-family: 'Creepster', cursive;">Álvaro, Javier, Jesús y Salva</h2>
    </header>

    <section class="container-fluid">