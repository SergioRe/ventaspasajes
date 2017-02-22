var table;
$(document).ready(function() {
    var url = base_url + '/' + pathArray[1] + '/index.php/registroempleado/json/dataempleado';
    table = $('#tableusuarios').DataTable({
        "pageLength": 10,
        "ajax": {
            "url": url,
            "type": "POST"
        },
        "columns": 
            [
                {"data": "NOMBRES"},
                {"data": "APELLIDOS"},
                {"data": "DIRECCION"},
                {"data": "CARGO"},
                {
             bSortable: false,
                mRender: function (o) { return '<center><span class="glyphicon glyphicon-pencil"></span></center>'; }
            }
            ],
        "bLengthChange" : false,
        "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 0,1,2,3,4 ] }
        ],
        "language": {
            "sSearch": "",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando paginas _PAGE_ de _PAGES_, total de filas _MAX_.",
            "infoEmpty": "Ning&uacute;n dato disponible en esta tabla",
            "infoFiltered": "(filtrando _MAX_ filas en total)",
            "sProcessing":   "Procesando...",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "&Uacute;ltimo",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            }
        }
    });
    
    $('#tableusuarios tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        var data = table.row( this ).data();
        editarusuario(data.IDUSUARIO);
    });
    
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('div').attr('data-column') );
    });
});

function filterColumn ( i ) {
    table.column( i ).search(
    $('#col'+i+'_filter').val()).draw();
}

function saverow(){
    var IDUSUARIO = $("#IDUSUARIO").val();
    var url2 = base_url + '/' + pathArray[1] + '/index.php/registroempleado/json/';
    var url3 = '';
    var NOMBRES = $('#NOMBRES').val();
    var APELLIDOS = $('#APELLIDOS').val();
    var CARGO = $('#CARGO').val();
    var USUARIO = $('#USUARIO').val();
    var CONTRASENA = $('#CONTRASENA').val();
    if(NOMBRES === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar los NOMBRES.');
        });
        return false;
    }
    if(APELLIDOS === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar los APELLIDOS.');
        });
        return false;
    }
    if(CARGO === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe seleccionar el CARGO.');
        });
        return false;
    }
    if(USUARIO === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar el USUARIO.');
        });
        return false;
    }
    if(CONTRASENA === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar la CONTRASEÑA.');
        });
        return false;
    }
    if(IDUSUARIO === ''){
        url3 = url2 + 'add';
    }else{
        url3 = url2 + 'update';
    }
    $.ajax({
        url : url3,
        type: "POST",
        dataType: "JSON",
        data: $('#formRegistroUsuario').serialize(),
        beforeSend:cargando,
        success: function(result){
            Ext.getBody().unmask();
            if(result.data ==='Si'){
                Ext.Msg.alert('!ATENCIÓN¡', 'Proceso realizado correctamente.');
                createrow();
                reload_table();
            }else{
                ExtMsg("Aviso: <br /><br />" + result, Ext.MessageBox.WARNING);
            }
        },
        timeout:40000,
        error: problemas
    });
}

function editarusuario(IDUSUARIO){
    var url1 = base_url + '/' + pathArray[1] + '/index.php/registroempleado/json/editarempleado';
    $.ajax({
        url : url1,
        type: "POST",
        dataType: "JSON",
        data: {IDUSUARIO:IDUSUARIO},
        success: function(data){
            $.each(data, function(k,v){
                $("#IDUSUARIO").val(data[k].IDUSUARIO);
                $("#NOMBRES").val(data[k].NOMBRES);
                $("#APELLIDOS").val(data[k].APELLIDOS);
                $("#DIRECCION").val(data[k].DIRECCION);
                $("#CARGO").val(data[k].TIPCOD);
                $("#USUARIO").val(data[k].USUARIO);
                $("#CONTRASENA").val(data[k].CONTRASENA);
            });
        },
        timeout:40000
    });
}

function reload_table(){
    table.ajax.reload(null,false);
}

function createrow(){
    $('#IDUSUARIO').val('');
    $('#NOMBRES').val('');
    $('#APELLIDOS').val('');
    $('#DIRECCION').val('');
    $('#CARGO').val('');
    $('#USUARIO').val('');
    $('#CONTRASENA').val('');
}

function deleteusuario(){
    var url2 = base_url + '/' + pathArray[1] + '/index.php/registroempleado/json/deleteusuario';
    var IDUSUARIO = $('#IDUSUARIO').val();
    if(IDUSUARIO === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe seleccionar un USUARIO.');
        });
        return false;
    }
    Ext.Msg.confirm("!ATENCIÓN¡", "Esta segurto de eliminar al pasajero.", function(btnText){
        if(btnText === "yes"){
            $.ajax({
                url : url2,
                type: "POST",
                dataType: "JSON",
                data: {IDUSUARIO:IDUSUARIO},
                beforeSend:cargando,
                success: function(result){
                    Ext.getBody().unmask();
                    switch (result.data){
                        case 'Si':
                            Ext.Msg.alert('!ATENCIÓN¡', 'Proceso realizado correctamente.');
                            createrow();
                            reload_table();
                            break;
                        case 'ExisteUsuario':
                            Ext.Msg.alert('!ATENCIÓN¡', 'No ce puede eliminar al usuario.');
                            break;
                        default:
                            ExtMsg("Aviso: <br /><br />" + result, Ext.MessageBox.WARNING);
                            break;
                    }
                },
                timeout:40000,
                error: problemas
            });
        }
    }, this);
}