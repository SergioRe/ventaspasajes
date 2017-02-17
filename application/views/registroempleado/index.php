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
    <script src="<?php echo base_url('assets/js/funciones/usuarios.js')?>"></script>
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

        #tableusuarios_filter{
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
                        <center><b><p>REGISTRO USUARIOS</p></b></center>
                    </div>
                    <form class="form-horizontal" id="formRegistroUsuario" name="formRegistroUsuario">
                        <input type="hidden" id="IDUSUARIO" name="IDUSUARIO"/>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="ejemplo_email_3" class="col-lg-4 control-label">NOMBRES: </label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" id="NOMBRES" name="NOMBRES" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ejemplo_email_3" class="col-lg-4 control-label">APELLIDOS: </label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" id="APELLIDOS" name="APELLIDOS" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ejemplo_email_3" class="col-lg-4 control-label">DIRECCIÓN: </label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" id="DIRECCION" name="DIRECCION" onkeypress="return validarNumeros(event)" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ejemplo_email_3" class="col-lg-4 control-label">CARGO: </label>
                                    <div class="col-lg-7">
                                        <select id="CARGO" name="CARGO" class="form-control">
                                            <option value="">Seleecione</option>
                                            <option value="1">Administrador del Sistema</option>
                                            <option value="2">Vendedor</option>
                                            <option value="3">Supervisor</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ejemplo_email_3" class="col-lg-4 control-label">USUARIO: </label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" id="USUARIO" name="USUARIO" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ejemplo_email_3" class="col-lg-4 control-label">CONTRASEÑA: </label>
                                    <div class="col-lg-7">
                                        <input type="password" class="form-control" id="CONTRASENA" name="CONTRASENA" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img class="img-responsive" src="http://placehold.it/200x180" alt="">
                            </div>
                        </div>
                    </form>
                    <button type="button" class="btn btn-success btn-sm" id="btn-create" onclick="createrow();">
                        <span class="glyphicon glyphicon-plus-sign"></span> <b>Boton Nuevo</b> 
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm" id="btn-save" onclick="saverow();">
                        <span class="glyphicon glyphicon-floppy-disk"></span> <b>Boton Guardar</b>
                    </button><br/><br/>
                    <div class="well">
                        <center><b><p>LISTADO DE USUARIOS</p></b></center>
                    </div>
                    <form class="form-horizontal izquierda" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">NOMBRES: </label>
                            <div class="col-sm-3" id="filter_col1" data-column="0">
                                <input type="text" class="column_filter form-control" id="col0_filter" placeholder="INGRESE LOS NOMBRES">
                            </div>
                            <label class="control-label col-sm-2 letra1" for="pwd">APELLIDOS: </label>
                            <div class="col-sm-3" id="filter_col2" data-column="1">          
                                <input type="text" class="column_filter form-control letra1" id="col1_filter" placeholder="INGRESE LOS APELLIDOS">
                            </div>
                        </div>
                    </form>
                    <table id="tableusuarios" class="table table-bordered display" cellspacing="0" width="100%">
                        <thead style="background-color: #f5f5f5;">
                            <tr>
                                <th class="text-center">NOMBRES</th>
                                <th class="text-center">APELLIDOS</th>
                                <th class="text-center">DIRECCION</th>
                                <th class="text-center">CARGO</th>
                                <th class="text-center">EDITAR</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
</body>
</html>

