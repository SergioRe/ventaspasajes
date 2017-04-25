var table;
$(document).ready(function() {
    $('#HORA').ptTimeSelect({
        hoursLabel:     'Hora',
        minutesLabel:   'Minutos',
        setButtonLabel: 'Ok'
    });
    $('#HORAFIN').ptTimeSelect({
        hoursLabel:     'Hora',
        minutesLabel:   'Minutos',
        setButtonLabel: 'Ok'
    });
    var url = base_url + '/' + pathArray[1] + '/index.php/registroviaje/json/dataviaje';
    table = $('#tableviaje').DataTable({
        "pageLength": 10,
        "ajax": {
            "url": url,
            "type": "POST"
        },
        "columns": 
            [
                {"data": "NOMVIAJE"},
                {"data": "ORIGEN","class": "text-center"},
                {"data": "DESTINO","class": "text-center"},
                {"data": "FECHA_VIAJE","class": "text-center"},
                {"data": "NomBus","class": "text-center"},
                {"data": "PRECIO","class": "text-center"},
                {"data": "Placa","class": "text-center"},
                {"data": "Chofer"},
                {
             bSortable: false,
                mRender: function (o) { return '<center><span class="glyphicon glyphicon-pencil"></span></center>'; }
            }
            ],
        "bLengthChange" : false,
        "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 0,1,2,3,4,5,6 ] }
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
    
    $('#tableviaje tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        var data = table.row( this ).data();
        editarviaje(data.IDITINERARIO);
    });
    
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('div').attr('data-column') );
    });
    
    $( "#FECHA_VIAJE" ).datepicker({
        minDate: 0,
        dateFormat:"dd-mm-yy"
    });
});

function filterColumn ( i ) {
    table.column( i ).search(
    $('#col'+i+'_filter').val()).draw();
}

function saverow(){
    var IDITINERARIO = $("#IDITINERARIO").val();
    var url2 = base_url + '/' + pathArray[1] + '/index.php/registroviaje/json/';
    var url3 = '';
    var NOMVIAJE = $('#NOMVIAJE').val();
    var ORIGEN = $('#ORIGEN').val();
    var DESTINO = $('#DESTINO').val();
    var IdBus = $('#IdBus').val();
    var IDCHOFER = $('#IDCHOFER').val();
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
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe seleccionar un BUS.');
        });
        return false;
    }
    if(IDCHOFER === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe seleccionar un CHOFER.');
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

function editarviaje(IDITINERARIO){
    var url1 = base_url + '/' + pathArray[1] + '/index.php/registroviaje/json/editarviaje';
    $.ajax({
        url : url1,
        type: "POST",
        dataType: "JSON",
        data: {IDITINERARIO:IDITINERARIO},
        success: function(data){
            $.each(data, function(k,v){
                $("#IDITINERARIO").val(data[k].IDITINERARIO);
                $("#NOMVIAJE").val(data[k].NOMVIAJE);
                $("#ORIGEN").val(data[k].ORIGEN);
                $("#DESTINO").val(data[k].DESTINO);
                $("#IdBus").val(data[k].IdBus);
                $("#HORA").val(data[k].HORA);
                $("#HORAFIN").val(data[k].HORAFIN);
                $("#PRECIO").val(data[k].PRECIO);
                $("#IDCHOFER").val(data[k].IDCHOFER);
                $("#FECHA_VIAJE").val(data[k].FECHA_VIAJE);
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
    $('#ORIGEN').val('');
    $('#DESTINO').val('');
    $('#IdBus').val('');
    $('#HORA').val('');
    $('#HORAFIN').val('');
    $('#PRECIO').val('');
    $('#FECHA_VIAJE').val('');
    $('#IDCHOFER').val('');
}

function deleteviaje(){
    var url2 = base_url + '/' + pathArray[1] + '/index.php/registroviaje/json/deleteviaje';
    var IDITINERARIO = $('#IDITINERARIO').val();
    if(IDITINERARIO === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe seleccionar un VIAJE.');
        });
        return false;
    }
    Ext.Msg.confirm("!ATENCIÓN¡", "Esta segurto de eliminar al bus.", function(btnText){
        if(btnText === "yes"){
            $.ajax({
                url : url2,
                type: "POST",
                dataType: "JSON",
                data: {IDITINERARIO:IDITINERARIO},
                beforeSend:cargando,
                success: function(result){
                    Ext.getBody().unmask();
                    switch (result.data){
                        case 'Si':
                            Ext.Msg.alert('!ATENCIÓN¡', 'Proceso realizado correctamente.');
                            createrow();
                            reload_table();
                            break;
                        case 'ExisteViaje':
                            Ext.Msg.alert('!ATENCIÓN¡', 'No ce puede eliminar al viaje.');
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