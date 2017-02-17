<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Menú Principal</title>
    <link href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/estilotbl/media/css/dataTables.bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/ext-4.2.0/examples/shared/example.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/ext-4.2.0/examples/writer/writer.css')?>" rel="stylesheet">

    <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/funciones/funciones.js')?>"></script>
    <script src="<?php echo base_url('assets/js/funciones/registropersona.js')?>"></script>
    <script src="<?php echo base_url('assets/estilotbl/media/js/jquery.dataTables.js')?>"></script>
    <script src="<?php echo base_url('assets/estilotbl/media/js/dataTables.bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/ext-4.2.0/examples/shared/include-ext.js')?>"></script>
    <script src="<?php echo base_url('assets/ext-4.2.0/examples/shared/examples.js')?>"></script>
</head>
<body style="padding: 0px;padding-top: 0px;">
    <style type="text/css">
        .glyphicon { margin-right:10px; }
        .panel-body { padding:0px; }
        .panel-body table tr td { padding-left: 15px }
        .panel-body .table {margin-bottom: 0px; }

        #tablepasajero_filter{
            display: none;
        }
        .selected{
            background-color: #b0bed9;
            cursor: pointer;
        }
    </style>
    <img class="img-responsive" src="http://placehold.it/1600x300" alt="">
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
                        <center><b><p>REGISTRO DE VENTAS</p></b></center>
                    </div>
                    <form class="form-horizontal" id="formRegistroPersona" name="formRegistroPersona">
                        <input type="hidden" id="IDPasajero" name="IDPasajero"/>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ejemplo_email_3" class="col-lg-4 control-label">DNI: </label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" onkeypress="return validarNumeros(event)" id="DNI" name="DNI" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ejemplo_email_3" class="col-lg-4 control-label">APELLIDO PATERNO: </label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" id="APEPAT" name="APEPAT" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ejemplo_email_3" class="col-lg-4 control-label">APELLIDO MATERNO: </label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" id="APEMAT" name="APEMAT" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ejemplo_email_3" class="col-lg-4 control-label">NOMBRES: </label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" id="Nombres" name="Nombres" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ejemplo_email_3" class="col-lg-4 control-label">FECHA NACIMIENTO: </label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" id="FECNAC" name="FECNAC" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ejemplo_email_3" class="col-lg-4 control-label">DIRECCIÓN: </label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" id="Direccion" name="Direccion" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ejemplo_email_3" class="col-lg-4 control-label">TELEFÓNO: </label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" id="Telefono" name="Telefono" />
                                    </div>
                                </div>
                                <div class="form-group" style="margin-top: 26px;">
                                    <label for="ejemplo_email_3" class="col-lg-4 control-label">Email: </label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" id="Email" name="Email" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-sm-1" for="email">DNI: </label>
                                    <div class="col-sm-4" id="filter_col2" data-column="1">
                                        <input type="text" class="column_filter form-control" id="col1_filter" placeholder="DNI">
                                    </div>
                                    <label class="control-label col-sm-2 letra1" for="pwd">NOMBRES: </label>
                                    <div class="col-sm-5" id="filter_col6" data-column="5">          
                                        <input type="text" class="column_filter form-control letra1" id="col5_filter" placeholder="NOMBRES">
                                    </div>
                                </div>
                                <table id="tablepasajero" class="table table-bordered display" cellspacing="0" width="100%">
                                    <thead style="background-color: #f5f5f5;">
                                        <tr>
                                            <th class="text-center">N</th>
                                            <th class="text-center">DNI</th>
                                            <th class="text-center">NOMBRES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                    <button type="button" class="btn btn-success btn-sm" id="btn-create" onclick="createrow();">
                        <span class="glyphicon glyphicon-plus-sign"></span> <b>Boton Nuevo</b> 
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm" id="btn-save" onclick="saverow();">
                        <span class="glyphicon glyphicon-floppy-disk"></span> <b>Boton Guardar</b>
                    </button>
                    <button type="submit" class="btn btn-info btn-sm" id="btn-save" onclick="generarventa();">
                        <span class="glyphicon glyphicon-shopping-cart"></span> <b>Generar Venta</b>
                    </button>
                </div>
            </div>
        </div>
        <div class="row" style="background:#FFF;">
            <div class="col-md-12"><br/>
                <div class="well">
                    <center><b><p>LISTADO DE VENTAS</p></b></center>
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
    <div id="modalventa"></div>
</body>
</html>

