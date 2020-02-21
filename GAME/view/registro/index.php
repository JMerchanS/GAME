<form class="col m12 l6" method="POST" enctype="multipart/form-data">
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
            <input id="usuario" type="text" name="usuario" value="<?php echo $datos->usuario ?>" pattern="(^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$" style="border-bottom: solid white 1px; color: white" title="Solo emails">
            <label for="usuario" style="color: white">Usuario</label>
        </div>
        <br>
        <?php $clase = ($datos->id) ? "hide" : "" ?>
        <div class="input-field col s12 <?php echo $clase ?>" id="password">
            <input id="clave" type="password" name="clave" value="" style="border-bottom: solid white 1px; color: white" pattern=".{8,}" title="Entre 8 y 12 caracteres">
            <label for="clave" style="color: white">Contraseña</label>
        </div>
    </div>
    <div class="row">
        <?php $clase = ($datos->id) ? "" : "hide" ?>
        <p class="<?php echo $clase ?>">
            Último acceso: <strong><?php echo date("d/m/Y H:i", strtotime($datos->fecha_acceso)) ?></strong>
        </p>
        <div class="input-field col s12">
            <a href="<?php echo $_SESSION['home'] ?>" title="Volver">
                <button class="btn waves-effect waves-light" type="button">Volver
                    <i class="material-icons right">replay</i>
                </button>
            </a>
            <a href="<?php echo $_SESSION['home'] ?>" title="Guardar">
            <button class="btn waves-effect waves-light" type="submit" name="guardar">Guardar
                <i class="material-icons right">save</i>
            </button>
            </a>
        </div>
    </div>
</form>