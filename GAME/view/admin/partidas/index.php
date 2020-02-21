<nav>
    <div class="nav-wrapper">
        <div class="col s12">
            <a href="<?php echo $_SESSION['home'] ?>admin/index" class="breadcrumb" title="Inicio">Inicio</a>
            <a href="<?php echo $_SESSION['home'] ?>admin/partidas" class="breadcrumb" title="Partidas">Partidas</a>
        </div>
    </div>
</nav>
<br>
<div class="row" style="margin-left: 30%">
    <?php foreach ($datos as $row){ ?>
        <article class="col s12 l6">
            <div class="card grey darken-1" style="text-align: center">
                <div class="card-content white-text">
                    <strong>Usuario: </strong><?php echo ($row->usuario)?><br>
                    <strong>Tiempo: </strong><?php echo ($row->tiempo)?><br>
                    <strong>Puntos: </strong><?php echo ($row->puntos)?><br>
                    <strong>Fecha: </strong><?php echo date("d/m/Y", strtotime($row->fecha)) ?>
                </div>
            </div>
        </article>
    <?php } ?>
</div>
