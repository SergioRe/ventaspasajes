var table;
$(document).ready(function() {
    var url = base_url + '/' + pathArray[1] + '/index.php/registropersona/json/datapasajero';
    table = $('#tablepasajero').DataTable({
        "pageLength": 10,
        "ajax": {
            "url": url,
            "type": "POST"
        },
        "columns": 
            [
                {"data": "IDPasajero"},
                {"data": "Dni"},
                {"data": "NRODOC"},
                {"data": "APEPAT"},
                {"data": "APEMAT"},
                {"data": "Nombres"},
                {"data": "FECNAC"},
                {"data": "Direccion"},
                {"data": "Telefono"},
                {"data": "Email"},
                {
             bSortable: false,
                mRender: function (o) { return '<center><span class="glyphicon glyphicon-pencil"></span></center>'; }
            }
            ],
        "bLengthChange" : false,
        "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 0,1,2,3,4,5,6,7,8,9 ] }
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
    
    $('#tablepasajero tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        var data = table.row( this ).data();
        editarpersona(data.IDPasajero);
    });
});

function saverow(){
    var IDPasajero = $("#IDPasajero").val();
    var url2 = base_url + '/' + pathArray[1] + '/index.php/registropersona/json/';
    var url3 = '';
    var Dni = $('#Dni').val();
    var APEPAT = $('#APEPAT').val();
    var APEMAT = $('#APEMAT').val();
    var Nombres = $('#Nombres').val();
    var FECNAC = $('#FECNAC').val();
    var Direccion = $('#Direccion').val();
    var Telefono = $('#Telefono').val();
    var USUARIO = $('#USUARIO').val();
    var CONTRASENA = $('#CONTRASENA').val();
    var Email = $('#Email').val();
    if(Dni === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar su DNI.');
        });
        return false;
    }
    if(APEPAT === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar su APELLIDO PATERNO.');
        });
        return false;
    }
    if(APEMAT === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar su APELLIDO MATERNO.');
        });
        return false;
    }
    if(Nombres === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar el NOMBRE.');
        });
        return false;
    }
    if(FECNAC === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar la FECHA NAC.');
        });
        return false;
    }
    if(Direccion === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar la DIRECCIÓN.');
        });
        return false;
    }
    if(Telefono === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar el TELEFONO.');
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
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar el CONTRASEÑA.');
        });
        return false;
    }
    if(Email === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar el Email.');
        });
        return false;
    }
    if(IDPasajero === ''){
        url3 = url2 + 'add';
    }else{
        url3 = url2 + 'update';
    }
    $.ajax({
        url : url3,
        type: "POST",
        dataType: "JSON",
        data: $('#formRegistroPersona').serialize(),
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

function editarpersona(IDPasajero){
    var url1 = base_url + '/' + pathArray[1] + '/index.php/registropersona/json/editarpasajero';
    $.ajax({
        url : url1,
        type: "POST",
        dataType: "JSON",
        data: {IDPasajero:IDPasajero},
        success: function(data){
            $.each(data, function(k,v){
                $("#IDPasajero").val(data[k].IDPasajero);
                $("#Dni").val(data[k].Dni);
                $("#APEPAT").val(data[k].APEPAT);
                $("#APEMAT").val(data[k].APEMAT);
                $("#Nombres").val(data[k].Nombres);
                $("#FECNAC").val(data[k].FECNAC);
                $("#Direccion").val(data[k].Direccion);
                $("#Telefono").val(data[k].Telefono);
                $("#TIPUSU").val(data[k].TIPUSU);
                $("#USUARIO").val(data[k].USUARIO);
                $("#CONTRASENA").val(data[k].CONTRASENA);
                $("#Email").val(data[k].Email);
            });
        },
        timeout:40000
    });
}

function reload_table(){
    table.ajax.reload(null,false);
}

function createrow(){
    $('#IDPasajero').val('');
    $('#Dni').val('');
    $('#APEPAT').val('');
    $('#APEMAT').val('');
    $('#Nombres').val('');
    $('#FECNAC').val('');
    $('#Direccion').val('');
    $('#Telefono').val('');
    $('#TIPUSU').val('');
    $('#USUARIO').val('');
    $('#CONTRASENA').val('');
    $('#Email').val('');
}