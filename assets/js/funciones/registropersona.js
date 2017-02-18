var table;
var table1;
var aregloAsientos = [];
$(document).ready(function() {
    var url = base_url + '/' + pathArray[1] + '/index.php/registropersona/json/datapasajero';
    var url1 = base_url + '/' + pathArray[1] + '/index.php/registropersona/json/dataventa';
    table = $('#tablepasajero').DataTable({
        "pageLength": 10,
        "ajax": {
            "url": url,
            "type": "POST"
        },
        "columns": 
            [
                {"data": "IDPasajero"},
                {"data": "DNI"},
                {"data": "Nombres"}
            ],
        "bLengthChange" : false,
        "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 0,1,2 ] }
        ],
        "language": {
            "sSearch": "",
            "zeroRecords": "No se encontraron resultados",
            "info": "Paginas _PAGE_ de _PAGES_, total _MAX_.",
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
    
    table1 = $('#tableventa').DataTable({
        "pageLength": 10,
        "ajax": {
            "url": url1,
            "type": "POST"
        },
        "columns": 
            [
                {"data": "IdVenta"},
                {"data": "Comprobante"},
                {"data": "Fechaventa"},
                {"data": "USUARIO"},
                {"data": "NOMBRES"},
                {"data": "Nombres"},
                {"data": "DNI"},
                {"data": "Valor_Total"}
            ],
        "bLengthChange" : false,
        "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 0,1,2,3,4,5,6,7 ] }
        ],
        "language": {
            "sSearch": "",
            "zeroRecords": "No se encontraron resultados",
            "info": "Paginas _PAGE_ de _PAGES_, total _MAX_.",
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
    
    $('#tableventa tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
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
    
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('div').attr('data-column') );
    });
});

function filterColumn ( i ) {
    table.column( i ).search(
    $('#col'+i+'_filter').val()).draw();
}

function saverow(){
    var IDPasajero = $("#IDPasajero").val();
    var url2 = base_url + '/' + pathArray[1] + '/index.php/registropersona/json/';
    var url3 = '';
    var Dni = $('#DNI').val();
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
                $("#DNI").val(data[k].DNI);
                $("#APEPAT").val(data[k].APEPAT);
                $("#APEMAT").val(data[k].APEMAT);
                $("#Nombres").val(data[k].Nombres);
                $("#FECNAC").val(data[k].FECNAC);
                $("#Direccion").val(data[k].Direccion);
                $("#Telefono").val(data[k].Telefono);
                $("#Email").val(data[k].Email);
            });
        },
        timeout:40000
    });
}

function reload_table(){
    table.ajax.reload(null,false);
}

function reload_table1(){
    table1.ajax.reload(null,false);
}

function createrow(){
    $('#IDPasajero').val('');
    $('#DNI').val('');
    $('#APEPAT').val('');
    $('#APEMAT').val('');
    $('#Nombres').val('');
    $('#FECNAC').val('');
    $('#Direccion').val('');
    $('#Telefono').val('');
    $('#Email').val('');
}

function generarventa(){
    var IDPasajero = $("#IDPasajero").val();
    if(IDPasajero === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe seleccionar un cliente para poder realizar la venta.');
        });
        return false;
    }
    $.ajax({
        dataType: "html",
        url: "modalventa",
        method: "POST",
        beforeSend:cargando,
        success: function(result){
            Ext.getBody().unmask();
            $("#modalventa").html(result);
            $("#ModalRegistroVenta").modal("show");
            $('#itinerario').css('display','none');
            $('#tableasientos1').css('display','none');
        },
        error:problemas,
        timeout:40000
    });
}

function cancelar(){
    $("#ModalRegistroVenta").modal("hide");
    $('#itinerario').css('display','none');
    $('#itinerario').css('display','none');
    $('#tableasientos1').css('display','none');
}

function datositinerario(IDITINERARIO){
    if(IDITINERARIO === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe seleccionar una Ruta.');
        });
        $('#itinerario').css('display','none');
        $('#tableasientos1').css('display','none');
        return false;
    }
    var url1 = base_url + '/' + pathArray[1] + '/index.php/registropersona/dataitinerario';
    $.ajax({
        dataType: "html",
        url : url1,
        method: "POST",
        data: {IDITINERARIO:IDITINERARIO},
        success: function(result){
            $('#itinerario').css('display','block');
            $('#tableasientos1').css('display','block');
            $("#itinerario").html(result);
        },
        timeout:40000
    });
}

function seleccionarasiento(numasiento){
    var valor = verificarExistencia(numasiento);
    if(valor === '1'){
        remove(aregloAsientos,numasiento);
        $('#'+numasiento).css('background-color','#0431B4');
    }else{
        aregloAsientos.push(numasiento);
        $('#'+numasiento).css('background-color','#088A08');
    }
}

function remove(arr, item) {
    for(var i = arr.length; i--;) {
        if(arr[i] === item) {
            arr.splice(i, 1);
        }
    }
}

function verificarExistencia(numasiento){
    for(var i = 0; i < aregloAsientos.length; i++) {
        if (aregloAsientos[i] === numasiento) {
            return '1';
        }
    }
    return '2';
}

function saveventa(){
    var url1 = base_url + '/' + pathArray[1] + '/index.php/registropersona/json/saveventa';
    var IdBus = $("#IdBus").val();
    if(IdBus === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe seleccionar una RUTA.');
        });
        return false;
    }
    if(aregloAsientos.length === 0){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe seleccionar un ASIENTO.');
        });
        return false;
    }
    var IDPasajero = $("#IDPasajero").val();
    var fecha_viaje = $("#FECHA_VIAJE").val();
    var destino = $("#DESTINO").val();
    var IDITINERARIO = $("#IDITINERARIO").val();
    var IdVenta = $("#IdVenta").val();
    var hora = $("#HORA").val();
    $.ajax({
        url : url1,
        type: "POST",
        dataType: "JSON",
        data: {aregloAsientos:aregloAsientos,idPasajero:IDPasajero,fecha_viaje:fecha_viaje,destino:destino,IDITINERARIO:IDITINERARIO,IdVenta:IdVenta,hora:hora},
        success: function(data){
            Ext.getBody().unmask();
            if(data.data ==='Si'){
                Ext.Msg.alert('!ATENCIÓN¡', 'Proceso realizado correctamente.');
                $("#itinera").val(IDITINERARIO);
                var ventaid = $("#IdVenta").val();
                $("#IdVenta1").val(ventaid);
                $("#ModalRegistroVenta").modal("hide");
                $("#ModalReporte").modal("show");
                createrow();
                limpiarmodal();
                reload_table1();
            }else{
                ExtMsg("Aviso: <br /><br />" + data, Ext.MessageBox.WARNING);
            }
        },
        timeout:40000
    });
}

function limpiarmodal(){
    $("#IDPasajero").val('');
    $("#FECHA_VIAJE").val('');
    $("#DESTINO").val('');
    $("#IDITINERARIO").val('');
    $("#HORA").val('');
}

function cerrarModal(){
    $("#ModalReporte").modal("hide");
    $("#itinera").val();
    $("#IdVenta1").val();
    aregloAsientos = [];
}