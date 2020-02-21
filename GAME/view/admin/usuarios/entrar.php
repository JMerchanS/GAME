<h3>Acceso</h3>
<div class="row">
    <form class="col m12 l6" method="POST">
        <div class="row">
            <div class="input-field col s12">
                <input id="usuario" type="text" name="usuario" value=""  required pattern="(^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9]| admin)?$" style="border-bottom: solid white 1px">
                <label for="usuario" style="color: white">Usuario</label>
            </div>
            <div class="input-field col s12">
                <input id="clave" type="password" name="clave" value="" style="border-bottom: solid white 1px">
                <label for="clave" style="color: white">Contraseña</label>
            </div>
            <div class="input-field col s12">
                <button class="btn waves-effect waves-light" type="submit" name="acceder">Acceder
                    <i class="material-icons right">person</i>
                </button>
            </div>
        </div>
    </form>
</div>