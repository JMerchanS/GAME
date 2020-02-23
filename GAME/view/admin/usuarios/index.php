<nav>
    <div class="nav-wrapper">
        <div class="col s12">
            <a href="<?php echo $_SESSION['home'] ?>admin/index" title="Inicio" class="breadcrumb">Inicio</a>
            <a href="#!" class="breadcrumb">Usuarios</a>
        </div>
    </div>
</nav>
<div class="row">
    <!--Nuevo-->
    <article class="col s12 l6">
        <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-image">
                    <img src="../../../public/img/37943.png">
                        <a class="btn-floating halfway-fab waves-effect waves-light red" href="<?php echo $_SESSION['home']."admin/usuarios/crear" ?>" title="Editar"><i class="material-icons">add</i></a>
                </div>
                    <div class="card-content">
                        <h4 class="grey-text">
                            Nuevo usuario
                        </h4>
                    </div>
            </div>
        </div>
    </article>
    <?php foreach ($datos as $row){ ?>
        <article class="col s12 l6">
            <div class="row">
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-image">
                            <img src="<?php echo $_SESSION['public']."img/".$row->avatar ?>">
                            <a class="btn-floating halfway-fab waves-effect waves-light red" href="<?php echo $_SESSION['home']."admin/usuarios/editar/".$row->id ?>"title="Editar"><i class="material-icons">edit</i></a>
                        </div>
                        <div class="card-content">
                            <span class="card-title" style="color: black"><?php echo $row->usuario ?></span>
                            <strong>Usuarios: </strong><?php echo ($row->usuarios) ? "Sí" : "No" ?><br>
                            <strong>Partidas: </strong><?php echo ($row->partidas) ? "Sí" : "No" ?>
                        </div>
                        <div class="card-action">
                            <?php $title = ($row->activo == 1) ? "Desactivar" : "Activar" ?>
                            <?php $color = ($row->activo == 1) ? "green-text" : "red-text" ?>
                            <?php $icono = ($row->activo == 1) ? "mood" : "mood_bad" ?>
                            <a href="<?php echo $_SESSION['home']."admin/usuarios/activar/".$row->id ?>" title="<?php echo $title ?>">
                                <i class="<?php echo $color ?> material-icons"><?php echo $icono ?></i>
                            </a>
                            <a href="#" class="activator" title="Borrar">
                                <i class="material-icons">delete</i>
                            </a>
                        </div>

                        <!--Confirmación de borrar-->
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">Borrar usuario<i class="material-icons right">close</i></span>
                            <p>
                                ¿Está seguro de que quiere borrar al usuario<strong><?php echo $row->usuario ?></strong>?<br>
                                Esta acción no se puede deshacer.
                            </p>
                            <a href="<?php echo $_SESSION['home']."admin/usuarios/borrar/".$row->id ?>" title="Borrar">
                                <button class="btn waves-effect waves-light" type="button">Borrar
                                    <i class="material-icons right">delete</i>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    <?php } ?>
</div>
