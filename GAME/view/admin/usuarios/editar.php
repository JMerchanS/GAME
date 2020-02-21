<nav>
    <div class="nav-wrapper">
        <div class="col s12">
            <a href="<?php echo $_SESSION['home'] ?>admin/index" class="breadcrumb" title="Inicio">Inicio</a>
            <a href="<?php echo $_SESSION['home'] ?>admin/usuarios" class="breadcrumb" title="Partidas">Usuarios</a>
            <a href="<?php echo $_SESSION['home'] ?>admin/usuarios/editar" class="breadcrumb" title="Partidas">Editar <?php echo $datos->usuario ?></a>
        </div>
    </div>
</nav>
<div class="row" style="background-color: #1b4b72">
    <?php $id = ($datos->id)?>
    <form class="col m12 l6" method="POST" enctype="multipart/form-data" action="<?php echo $_SESSION['home'] ?>admin/usuarios/editar/<?php echo $id ?>">
        <div class="row">
            <div class="col s12">
                <div class="file-field input-field">
                    <div class="btn">
                        <span>Avatar</span>
                        <input type="file" name="avatar">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" style="border-bottom: solid white 1px">
                    </div>
                </div>
                <?php if ($datos->avatar){ ?>
                    <img src="<?php echo $_SESSION['public']."img/".$datos->avatar ?>">
                <?php } ?>
            </div>
            <div class="input-field col s12">
                <input id="usuario" type="text" name="usuario" value="<?php echo $datos->usuario ?>" style="border-bottom: solid white 1px; color: white">
                <label for="usuario" style="color: white">Usuario</label>
            </div>
            <br>
            <?php $clase = ($datos->id) ? "hide" : "" ?>
            <div class="input-field col s12 <?php echo $clase ?>" id="password" style="border-bottom: solid white 1px">
                <input id="clave" type="password" name="clave" value="" style="color: white">
                <label style="color: white" for="clave">Contraseña</label>
            </div>
            <?php $clase = ($datos->id) ? "" : "hide" ?>
            <p class="<?php echo $clase ?>">
                <label for="cambiar_clave">
                    <input id="cambiar_clave" name="cambiar_clave" type="checkbox">
                    <span style="color: white">Pulsa para cambiar la clave</span>
                </label>
            </p>
        </div>
        <div class="row">
            <?php if ($_SESSION['usuarios'] == 1){ ?>
                <p style="color: white">Permisos</p>
                <p>
                    <label for="partidas">
                        <input id="partidas" name="partidas" type="checkbox" <?php echo ($datos->partidas == 1) ? "checked" : "" ?>>
                        <span style="color: white">Partidas</span>
                    </label>
                </p>
                <p>
                    <label for="usuarios">
                        <input id="usuarios" name="usuarios" type="checkbox" <?php echo ($datos->usuarios == 1) ? "checked" : "" ?>>
                        <span style="color: white">Usuarios</span>
                    </label>
                </p>
            <?php }else{  ?>
                <p style="color: white;display: none;">Permisos</p>
                <p style="display: none">
                    <label for="partidas" style="display: none">
                        <input id="partidas" name="partidas" type="checkbox" <?php echo ($datos->partidas == 1) ? "checked" : "" ?> style="display: none">
                        <span style="color: white;display: none;">Partidas</span>
                    </label>
                </p>
                <p style="display: none">
                    <label for="usuarios" style="display: none">
                        <input id="usuarios" name="usuarios" type="checkbox" <?php echo ($datos->usuarios == 1) ? "checked" : "" ?> style="display: none">
                        <span style="color: white; display: none;">Usuarios</span>
                    </label>
                </p>
            <?php }?>
            <?php $clase = ($datos->id) ? "" : "hide" ?>
            <p class="<?php echo $clase ?>" style="color: white">
                Último acceso: <strong style="color: white"><?php echo date("d/m/Y H:i", strtotime($datos->fecha_acceso)) ?></strong>
            </p>
            <div class="input-field col s12">
                <a href="<?php echo $_SESSION['home'] ?>admin/usuarios" title="Volver">
                    <button class="btn waves-effect waves-light" type="button">Volver
                        <i class="material-icons right">replay</i>
                    </button>
                </a>
                <button class="btn waves-effect waves-light" type="submit" name="guardar">Guardar
                    <i class="material-icons right">save</i>
                </button>
            </div>
        </div>
    </form>
</div>