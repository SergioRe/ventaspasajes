<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Menú Principal</title>
    <link href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/estilotbl/media/css/dataTables.bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/ext-4.2.0/examples/shared/example.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/ext-4.2.0/examples/writer/writer.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">

    <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/funciones/funciones.js')?>"></script>
    <script src="<?php echo base_url('assets/js/funciones/reportes.js')?>"></script>
    <script src="<?php echo base_url('assets/estilotbl/media/js/jquery.dataTables.js')?>"></script>
    <script src="<?php echo base_url('assets/estilotbl/media/js/dataTables.bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/ext-4.2.0/examples/shared/include-ext.js')?>"></script>
    <script src="<?php echo base_url('assets/ext-4.2.0/examples/shared/examples.js')?>"></script>
    <script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
</head>
<body style="padding: 0px;padding-top: 0px;">
    <style type="text/css">
        .glyphicon { margin-right:10px; }
        .panel-body { padding:0px; }
        .panel-body table tr td { padding-left: 15px }
        .panel-body .table {margin-bottom: 0px; }

        #tablebus_filter{
            display: none;
        }
        .selected{
            background-color: #b0bed9;
            cursor: pointer;
        }
    </style>
    <img class="img-responsive" src="<?php echo base_url('assets/img/bu2.png')?>" style="width: 100%;height: 250px;">
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Usuario: <b><?php echo $NOMCOMP;?></b></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">Tipo Usuario: <b><?php echo $CARGO;?></b></a>
                    </li>
                </ul>
                <ul class="nav navbar-nav pull-right">
                    <li>
                        <a href="<?= site_url('inicio/cerrarsession') ?>"><span class="glyphicon glyphicon-log-in"></span> Cerrar Sessión</a>
                    </li>
                </ul>            
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-folder-close">
                            </span>Menú Principal</a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <table class="table">
                                <?php 
                                foreach ($MENU as $valor):
                                $icono = 'glyphicon glyphicon-'.$valor['MENICONO'].' text-primary';  
                                ?>
                                <tr>
                                    <td>
                                        <span class="<?php echo $icono;?>"></span>
                                        <a href="<?= site_url($valor['MENURL']); ?>"><?php echo $valor['MENNOM'];?></a>
                                    </td>
                                </tr>
                                <?php
                                endforeach;
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-md-9">
                <div class="thumbnail">
                    <div class="well">
                        <center><b><p>REPORTES</p></b></center>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="99%">
                            <thead>
                                <tr>
                                    <th><center>NOMBRE REPORTE</center></th>
                                    <th><center>IMPRIMIR PDF</center></th>
                                </tr>
                                <tr>
                                    <th>LISTA DE BUSES</th>
                                    <th><center>
                                        <a class="btn btn-sm btn-default btn-sm" target="_blank" href="listabuses">
                                            <i class="glyphicon glyphicon-print"></i> Imprimir PDF</a>
                                    </center></th>
                                </tr>
                                <tr>
                                    <th>REPORTE DE VENTAS DEL DÍA</th>
                                    <th><center>
                                        <a class="btn btn-sm btn-default btn-sm" target="_blank" href="reporteventas">
                                            <i class="glyphicon glyphicon-print"></i> Imprimir PDF</a>
                                    </center></th>
                                </tr>
                                <tr>
                                    <th>REPORTE DE VENTAS POR FECHAS</th>
                                    <th><center>
                                        <a class="btn btn-sm btn-default btn-sm" onclick="reporteVentasPorFechas();">
                                            <i class="glyphicon glyphicon-print"></i> Imprimir PDF</a>
                                    </center></th>
                                </tr>
                            </thead>
                        </table>
                        </div>
                    </div><br/><br/>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <div class="well">
                        <center><b><p>DESIGNED BY: FIORELA VILCACHAGUA</p></b></center>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <div id="ModalRangoFechas" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 400px;">
                <div class="modal-header" style="background-color: #f5f5f5;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Generar Reporte</h4>
                </div>
                <div class="modal-body">
                    <form action="reporteventasporfecha" method="post" target="_blank" onsubmit="return validarFechas();">
                        <input type="text" class="form-control datepicker" id="FECHAINI" name="FECHAINI" placeholder="Ingrese la Fecha Inicio" /><br/>
                        <input type="text" class="form-control datepicker" id="FECHAFIN" name="FECHAFIN" placeholder="Ingrese la Fecha Fin" /><br/>
                        <input type="submit" class="btn btn-default" target="_blank" value="Generra reporte" onclick="cerrarModal();">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

