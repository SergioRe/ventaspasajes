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
    <link href="<?php echo base_url('assets/css/jquery.ptTimeSelect.css')?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/themes/redmond/jquery-ui.css" />
    
    <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/funciones/funciones.js')?>"></script>
    <script src="<?php echo base_url('assets/js/funciones/registroviaje.js')?>"></script>
    <script src="<?php echo base_url('assets/estilotbl/media/js/jquery.dataTables.js')?>"></script>
    <script src="<?php echo base_url('assets/estilotbl/media/js/dataTables.bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/ext-4.2.0/examples/shared/include-ext.js')?>"></script>
    <script src="<?php echo base_url('assets/ext-4.2.0/examples/shared/examples.js')?>"></script>
    <script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.ptTimeSelect.js')?>"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!--    <script src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>-->
</head>
<body style="padding: 0px;padding-top: 0px;">
    <style type="text/css">
        .glyphicon { margin-right:10px; }
        .panel-body { padding:0px; }
        .panel-body table tr td { padding-left: 15px }
        .panel-body .table {margin-bottom: 0px; }

        #tableviaje_filter{
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
                        <center><b><p>REGISTRO VIAJE</p></b></center>
                    </div>
                    <form class="form-horizontal" id="formRegistroViaje" name="formRegistroViaje">
                        <input type="hidden" id="IDITINERARIO" name="IDITINERARIO"/>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ejemplo_email_3" class="col-lg-4 control-label">NOMBRE VIAJE: </label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" id="NOMVIAJE" name="NOMVIAJE" disabled="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ejemplo_email_3" class="col-lg-4 control-label">ORIGEN: </label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" id="ORIGEN" name="ORIGEN" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ejemplo_email_3" class="col-lg-4 control-label">DESTINO: </label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" id="DESTINO" name="DESTINO" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ejemplo_email_3" class="col-lg-4 control-label">HORA SALIDA: </label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" id="HORA" name="HORA" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ejemplo_email_3" class="col-lg-4 control-label">HORA LLEGADA: </label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" id="HORAFIN" name="HORAFIN" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ejemplo_email_3" class="col-lg-4 control-label">PRECIO: </label>
                                    <div class="col-lg-7">
                                        <input type="number" class="form-control" id="PRECIO" name="PRECIO" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ejemplo_email_3" class="col-lg-4 control-label">ASIENTO: </label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" id="ASIENTO" name="ASIENTO" value="40" disabled="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img class="img-responsive" src="<?php echo base_url('assets/img/bu3.jpg')?>" style="width: 100%;height: 180px;">
                                <br/>
                                <div class="form-group">
                                    <label for="ejemplo_email_3" class="col-lg-4 control-label">FECHA VIAJE: </label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" id="FECHA_VIAJE" name="FECHA_VIAJE"  />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ejemplo_email_3" class="col-lg-4 control-label">CHOFER: </label>
                                    <div class="col-lg-7">
                                        <select id="IDCHOFER" name="IDCHOFER" class="form-control">
                                            <option value="">Seleecione</option>
                                            <?php
                                            foreach ($listachofer as $value):
                                            ?>
                                            <option value="<?php echo $value['IdChofer'];?>"><?php echo $value['Chofer'];?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ejemplo_email_3" class="col-lg-4 control-label">BUS: </label>
                                    <div class="col-lg-7">
                                        <select id="IdBus" name="IdBus" class="form-control">
                                            <option value="">Seleecione</option>
                                            <?php
                                            foreach ($listabus as $value):
                                            ?>
                                            <option value="<?php echo $value['IdBus'];?>"><?php echo $value['NomBus'];?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <button type="button" class="btn btn-success btn-sm" id="btn-create" onclick="createrow();">
                        <span class="glyphicon glyphicon-plus-sign"></span> <b>Boton Nuevo</b> 
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm" id="btn-save" onclick="saverow();">
                        <span class="glyphicon glyphicon-floppy-disk"></span> <b>Boton Guardar</b>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" id="btn-delete" onclick="deleteviaje();">
                        <span class="glyphicon glyphicon glyphicon-minus"></span> <b>Boton Eliminar</b>
                    </button><br/><br/>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row" style="background:#FFF;">
            <div class="col-md-12"><br/>
                <div class="well">
                    <center><b><p>LLISTADO VIAJES</p></b></center>
                    <form class="form-horizontal izquierda" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">NOMBRE VIAJE: </label>
                            <div class="col-sm-3" id="filter_col1" data-column="0">
                                <input type="text" class="column_filter form-control" id="col0_filter" placeholder="INGRESE NOMBRE VIAJE">
                            </div>
                            <label class="control-label col-sm-2 letra1" for="pwd">NRO PLACA: </label>
                            <div class="col-sm-3" id="filter_col5" data-column="4">          
                                <input type="text" class="column_filter form-control" id="col4_filter" placeholder="INGRESE NRO PLACA">
                            </div>
                        </div>
                    </form>
                    <table id="tableviaje" class="table table-bordered display" cellspacing="0" width="100%">
                        <thead style="background-color: #f5f5f5;">
                            <tr>
                                <th class="text-center">NOMBRE VIAJE</th>
                                <th class="text-center">ORIGNE</th>
                                <th class="text-center">DESTINO</th>
                                <th class="text-center">FECHA VIAJE</th>
                                <th class="text-center">BUS</th>
                                <th class="text-center">PRECIO</th>
                                <th class="text-center">NRO PLACA</th>
                                <th class="text-center">CHOFER</th>
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

