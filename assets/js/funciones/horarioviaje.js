var table;
$(document).ready(function() {
    var url = base_url + '/' + pathArray[1] + '/index.php/horarioviaje/json/datahorario';
    table = $('#tablehorario').DataTable({
        "pageLength": 10,
        "ajax": {
            "url": url,
            "type": "POST"
        },
        "columns": 
            [
                {"data": "NOMVIAJE"},
                {"data": "HORA"},
                {"data": "HORAFIN"},
                {"data": "ORIGEN"},
                {"data": "DESTINO"},
                {"data": "NomBus"},
                {"data": "Chofer"},
                {
             bSortable: false,
                mRender: function (o) { return '<center><span class="glyphicon glyphicon-pencil"></span></center>'; }
            }
            ],
        "bLengthChange" : false,
        "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 0,1,2,3,4,5,6,7 ] }
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
    
    $('#tablehorario tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        var data = table.row( this ).data();
        editarhorario(data.IDITINERARIO);
    });
});

function saverow(){
    var IDITINERARIO = $("#IDITINERARIO").val();
    var url2 = base_url + '/' + pathArray[1] + '/index.php/horarioviaje/json/';
    var url3 = '';
    var NOMVIAJE = $('#NOMVIAJE').val();
    var ORIGEN = $('#ORIGEN').val();
    var DESTINO = $('#DESTINO').val();
    var IdBus = $('#IdBus').val();
    if(NOMVIAJE === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar el NOMBRE VIAJE.');
        });
        return false;
    }
    if(ORIGEN === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar el ORIGEN.');
        });
        return false;
    }
    if(DESTINO === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar el DESTINO.');
        });
        return false;
    }
    if(IdBus === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar el SELECCIONAR EL BUS.');
        });
        return false;
    }
    if(IDITINERARIO === ''){
        url3 = url2 + 'add';
    }else{
        url3 = url2 + 'update';
    }
    $.ajax({
        url : url3,
        type: "POST",
        dataType: "JSON",
        data: $('#formRegistroViaje').serialize(),
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

function editarhorario(IDITINERARIO){
    var url1 = base_url + '/' + pathArray[1] + '/index.php/horarioviaje/json/editarviaje';
    $.ajax({
        url : url1,
        type: "POST",
        dataType: "JSON",
        data: {IDITINERARIO:IDITINERARIO},
        success: function(data){
            $.each(data, function(k,v){
                $("#IDITINERARIO").val(data[k].IDITINERARIO);
                $("#NOMVIAJE").val(data[k].NOMVIAJE);
                $("#HORA").val(data[k].HORA);
                $("#HORAFIN").val(data[k].HORAFIN);
            });
        },
        timeout:40000
    });
}

function reload_table(){
    table.ajax.reload(null,false);
}

function createrow(){
    $('#IDITINERARIO').val('');
    $('#NOMVIAJE').val('');
    $('#HORA').val('');
    $('#HORAFIN').val('');
}