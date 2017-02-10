$(document).ready(function () {
    registrar_usuario();
});

function registrar_usuario(){
    var url = base_url + '/' + pathArray[1] + '/index.php/inicio/json/registro';
    $('#frmregistro').bootstrapValidator({
        //live: 'disabled',
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
//            nombres: {
//                feedbackIcons: 'false',
//                validators: {
//                    notEmpty: {
//                        message: 'Debe ingresar los nombres.'
//                    }
//                }
//            },
//            apellidos: {
//                feedbackIcons: 'false',
//                validators: {
//                    notEmpty: {
//                        message: 'Debe ingresar los apellidos.'
//                    }
//                }
//            },
            nrodoc: {
                feedbackIcons: 'false',
                validators: {
                    notEmpty: {
                        message: 'Debe ingresar su numero de documento.'
                    }
                }
            }
//            passw: {
//                feedbackIcons: 'false',
//                validators: {
//                    notEmpty: {
//                        message: 'Debe ingresar un contraseña.'
//                    }
//                }
//            },
//            sexo: {
//                feedbackIcons: 'false',
//                validators: {
//                    notEmpty: {
//                        message: 'Debe seleccionar un sexo.'
//                    }
//                }
//            },
//            dia: {
//
//                feedbackIcons: 'false',
//                validators: {
//                    notEmpty: {
//                        message: 'Debe ingresar el diá de nacimiento.'
//                    }
//                }
//            },
//            mes: {
//                feedbackIcons: 'false',
//                validators: {
//                    notEmpty: {
//                        message: 'Debe ingresar el mes de nacimiento.'
//                    }
//                }
//            },
//            ano: {
//                feedbackIcons: 'false',
//                validators: {
//                    notEmpty: {
//                        message: 'Debe ingresar el año de nacimiento.'
//                    }
//                }
//            },
//            email: {
//                feedbackIcons: 'false',
//                validators: {
//                    notEmpty: {
//                        message: 'Debe ingresar su Email.'
//                    },
//                    emailAddress: {
//                        message: 'Debe ingresar un Email valido.'
//                    }
//                }
//            }
        }
    })
    .on('success.form.bv', function(e) {
        e.preventDefault();
        var $form     = $(e.target),
        validator = $form.data('bootstrapValidator');
        enviar_data();
    });
    
    limpiar_form_registro();
}

function enviar_data(){
    var ruta = base_url + '/' + pathArray[1] + '/index.php/inicio/json/registro';
    $.ajax({
        url : ruta,
        type: "POST",
        dataType: "JSON",
        data: $('#frmregistro').serialize(),
        beforeSend:cargando,
        success: function(result){
            $("#mensaje").html('');
            if(result.msj ==='Si'){
                $('#mensaje').html('<p class="text-success close letra2"><b>!Proceso realizado correctamente!</b></p>');
                limpiar_form_registro();
            }else{
                $('#mensaje').html('<p class="text-danger close letra2"><b>Error: '+result+'</b></p>');
            }
        },
        timeout:40000,
        error: problemas
    });
}

function login_modal(){
    limpiar();
    $("#myModalLogin").modal("show");
}

function limpiar(){
    $('#usuario').val('');
    $('#passw').val('');
}

function validar_login(){
    var usuario = $('#usuario').val();
    var passw = $('#passw').val();
    if(usuario === ''){
        alertas('INFO','ATENCIÓN','Debe ingresar el usuario.');
        return false;
    }
    if(passw === ''){
        alertas('INFO','ATENCIÓN','Debe ingresar su contraseña.');
        return false;
    }
}

function modal_registro(){
    $("#myModalLogin").modal("hide");
    limpiar();
    limpiar_form_registro();
    $("#myModalRegistro").modal("show");
}

function limpiar_form_registro(){
    $('#frmregistro').data('bootstrapValidator').resetForm(true);
}

function modal_recuperar_pass(){
    $("#myModalLogin").modal("hide");
    limpiar();
    $("#myModalRecuperarPass").modal("show");
}

function enviar_pass(){
    var url = base_url + '/' + pathArray[1] + '/index.php/inicio/json/recuperarpass';
    var CorreoUsu = $('#inputEmail1').val();
    if(CorreoUsu === ''){
        alertas('INFO','ATENCIÓN','Debe ingresar su Email.');
        return false;
    }
    $.ajax({
        url: url,
        type: "POST",
	    dataType: "JSON",
        data: {CorreoUsu:CorreoUsu},
        beforeSend:cargando,
        success:function(result){
            $('#myModalRecuperarPass').modal('hide');
            switch(result.msj){
                case 'Si':
                    alertas('SUCCESS','ATENCIÓN','Proceso realizado correctamente. Se envio su contraseña a su correo electronico.');
                    break;
                case 'correoNoExiste':
                    alertas('INFO','ATENCIÓN','El correo ingresado no existe, por favor registrese.');
                    break;
                default:
                    alertas('ERROR','ATENCIÓN',result.msj);
                    break;        
            }
        },
        timeout:40000,
        error: problemas
    });
    return false;
}

//A PRUEBA
function obtenerPanelSlide(idObjeto){
    var html = "";
    $.ajax({
        url: path+'post/obtenerPorOrdenMarca',
        type: 'POST',
        data: {
            idmarca:idObjeto
        }, 
        success:function(msg){
            var post = JSON.parse(msg);
            console.log(msg.length); 
            if(msg.length != 0){
                console.log(msg);
                var idmarca = 0;
                html += '<div class="tab-pane fade active in" id="' + idObjeto + '" >';
                for (var i = 0; i < msg.length; i++) {
                    html += '<div class="col-sm-3">';
                        html += '<div class="product-image-wrapper">';
                            html += '<div class="single-products">';
                                html += '<div class="productinfo text-center">';
                                    html += '<img src="'+ base_url +'/oceo2/assets/img/home/gallery1.jpg" alt="" />';
                                    html += '<h2>'+ msg[i][product].precio +'</h2>';
                                    html += '<p>'+ msg[i].titulo +'</p>';
                                    html += '<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>';
                                html += '</div>';
                            html += '</div>';
                        html += '</div>';
                    html += '</div>';
                }
                html += '</div>';
                $("#conPost").html(html);
            }
        }
    });
}

function filtrarPorAnio(){
    var frm = document.getElementById("frmSpinnerAnio");
    frm.submit();
}

function reniec(dni){
    var url = base_url + '/' + pathArray[1] + '/index.php/inicio/json/datadni';
    var ctn = dni.length;
    $.ajax({
        url: url,
        type: "POST",
        dataType: "JSON",
        data: {dni:dni},
        beforeSend:cargando,
        success:function(data){
            $('#nombres').val(data.nombres);
            $('#apellidos').val(data.apellido_paterno+' '+data.apellido_materno);
            $('#mensaje').html('');
        },
        timeout:40000,
        error: problemas
    });
    return false;
}

