<nav>
    <div class="nav-wrapper">
        <div class="col s12">
            <a href="<?php echo $_SESSION['home'] ?>admin/index" class="breadcrumb" title="Inicio">Inicio</a>
        </div>
    </div>
</nav>
<div class="row" style="margin-left: 40%">
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
                    </div>
                </div>
            </div>
        </article>
    <?php } ?>
</div>
