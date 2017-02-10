function perfilesNom(){
    var cboperfil = $("#cboperfil").val();
    if(cboperfil === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe de seleccionar un PERFIL.');
        });
        return false;
    }
    $('#btn-save').css('display','none');
    $.ajax({
        async:true,
        dataType: "html",
        url: "usuariosporperfil",
        method: "POST",
        data: {
            cboperfil: cboperfil
        },
        beforeSend:cargando,
        success: function(result){
            Ext.getBody().unmask();
            $("#perfilesnom").html(result);
        },
        error:problemas,
        timeout:40000
    });
    return false;
}

function listaMenuPorUsuario(IDUSUARIO){
    var cboperfil = $("#cboperfil").val();
    if(cboperfil === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe de seleccionar un PERFIL.');
        });
        return false;
    }
    $('#btn-save').css('display','none');
    $.ajax({
        async:true,
        dataType: "html",
        url: "listamenuporusuario",
        method: "POST",
        data: {
            IDUSUARIO: IDUSUARIO
        },
        beforeSend:cargando,
        success: function(result){
            Ext.getBody().unmask();
            $('#btn-save').css('display','block');
            $("#listaMenuPorUsuario").html(result);
        },
        error:problemas,
        timeout:40000
    });
    return false;
}

function save(){
    var url = base_url + '/' + pathArray[1] + '/index.php/asignarpermisos/json/save';
    var IDUSUARIO = $('#IDUSUARIO').val();
    var data = '';
    var elementos = document.getElementsByName("checkbox");
    for(var i=0; i<elementos.length; i++) {
        data+=elementos[i].value+'-'+elementos[i].checked+',';
    }
    $.ajax({
        url : url,
        type: "POST",
        dataType: "JSON",
        data: {data:data},
        //beforeSend:cargando,
        success: function(result){
            if(result.data === 'Si'){
                Ext.Msg.alert('!ATENCIÓN¡', 'Proceso realizado correctamente.');
            }else{
                ExtMsg("Aviso: <br /><br />" + result, Ext.MessageBox.WARNING);
            }
        },
        //error: problemas,
        timeout: 40000
    });
    return false;
}