<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <!--css-->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/ext-4.2.0/examples/shared/example.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/ext-4.2.0/examples/writer/writer.css')?>" rel="stylesheet">

    <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/funciones/login.js')?>"></script>
    <script src="<?php echo base_url('assets/ext-4.2.0/examples/shared/include-ext.js')?>"></script>
    <script src="<?php echo base_url('assets/ext-4.2.0/examples/shared/examples.js')?>"></script>
</head>
<body style="background: #AFC4D5;">
    <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title"><center><b>Inicio de Sessión</b></center></div>
                </div>
                <div style="padding-top:30px" class="panel-body" >
                    <form method="post" id="loginform" class="form-horizontal" action="" onsubmit="return validarLogin();">
                        <div class="form-group">
                            <label class="col-lg-4 control-label colorlabelAPEPAT">Usuario: </label>
                            <div class="col-lg-7">
                                <input type="text" class="form-control" id="USUARIO" name="USUARIO" placeholder="Ingrese su usuario" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label colorlabelAPEPAT">Contraseña: </label>
                            <div class="col-lg-7">
                                <input type="password" class="form-control" id="CONTRASENA" name="CONTRASENA" placeholder="Ingrese su contraseña" />
                            </div>
                        </div>
			<div class="form-group">
                            <div class="col-sm-12 controls">
                                <center><button type="submit" class="btn btn-default">Ingresar</button></center>
                            </div>
			</div>
                        <div class="form-group">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <div id="mensaje"></div>
                            </div>
                            <div class="col-sm-1"></div>
			</div>
                    </form>     
                </div>                     
            </div>  
        </div>
    </div>
</body>
</html>
