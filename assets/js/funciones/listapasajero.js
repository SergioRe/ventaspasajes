var table;
$(document).ready(function() {
    var url = base_url + '/' + pathArray[1] + '/index.php/listapasajeros/json/datapasajero';
    table = $('#tablepasajero').DataTable({
        "pageLength": 10,
        "ajax": {
            "url": url,
            "type": "POST"
        },
        "columns": 
            [
                {"data": "IDPasajero"},
                {"data": "Nombres"},
                {"data": "DNI"},
                {"data": "Email",'class':'text-center'},
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
    
    $('#tablepasajero tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        var data = table.row( this ).data();
        editarPasajero(data.IDPasajero);
    });
    
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('div').attr('data-column') );
    });
});

function filterColumn ( i ) {
    table.column( i ).search(
    $('#col'+i+'_filter').val()).draw();
}

function editarPasajero(IDPasajero){
    var url1 = base_url + '/' + pathArray[1] + '/index.php/listapasajeros/json/editarpasajero';
    $.ajax({
        url : url1,
        type: "POST",
        dataType: "JSON",
        data: {IDPasajero:IDPasajero},
        success: function(data){
            $.each(data, function(k,v){
                $("#IDPasajero").val(data[k].IDPasajero);
                $("#Nombres").val(data[k].Nombres);
                $("#Direccion").val(data[k].Direccion);
                $("#DNI").val(data[k].DNI);
                $("#Telefono").val(data[k].Telefono);
                $("#Email").val(data[k].Email);
                $("#Contrasena").val(data[k].Contrasena);
                $("#EDAD").val(data[k].EDAD);
                $("#SEXO").val(data[k].SEXO);
            });
        },
        timeout:40000
    });
}

function reload_table(){
    table.ajax.reload(null,false);
}

function deletepasajero(){
    var url2 = base_url + '/' + pathArray[1] + '/index.php/listapasajeros/json/deletepasajero';
    var IdPasajero = $('#IDPasajero').val();
    if(IdPasajero === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe seleccionar un Pasajero.');
        });
        return false;
    }
    Ext.Msg.confirm("!ATENCIÓN¡", "Esta segurto de eliminar al pasajero.", function(btnText){
        if(btnText === "yes"){
            $.ajax({
                url : url2,
                type: "POST",
                dataType: "JSON",
                data: {IdPasajero:IdPasajero},
                beforeSend:cargando,
                success: function(result){
                    Ext.getBody().unmask();
                    switch (result.data){
                        case 'Si':
                            Ext.Msg.alert('!ATENCIÓN¡', 'Proceso realizado correctamente.');
                            createrow();
                            reload_table();
                            break;
                        case 'ExistePasajero':
                            Ext.Msg.alert('!ATENCIÓN¡', 'No ce puede eliminar al pasajero.</br>Esta registrado en una venta.');
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

function saverow(){
    var IDPasajero = $("#IDPasajero").val();
    var url2 = base_url + '/' + pathArray[1] + '/index.php/listapasajeros/json/';
    var url3 = '';
    var NomBus = $('#NomBus').val();
    var Placa = $('#Placa').val();
    var N_Asiento = $('#N_Asiento').val();
    var IdChofer = $('#IdChofer').val();
//    if(NomBus === ''){
//        Ext.onReady(function() {
//            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar el NOMBRE BUS.');
//        });
//        return false;
//    }
//    if(Placa === ''){
//        Ext.onReady(function() {
//            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar el NRO PLACA.');
//        });
//        return false;
//    }
//    if(N_Asiento === ''){
//        Ext.onReady(function() {
//            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar el NUMERO ASIENTO.');
//        });
//        return false;
//    }
//    if(IdChofer === ''){
//        Ext.onReady(function() {
//            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar el SELECCIONAR EL CHOFER.');
//        });
//        return false;
//    }
    if(IDPasajero === ''){
        url3 = url2 + 'add';
    }else{
        url3 = url2 + 'update';
    }
    $.ajax({
        url : url3,
        type: "POST",
        dataType: "JSON",
        data: $('#formRegistroPasajero').serialize(),
        beforeSend:cargando,
        success: function(result){
            Ext.getBody().unmask();
            switch (result.data){
                case 'Si':
                    Ext.Msg.alert('!ATENCIÓN¡', 'Proceso realizado correctamente.');
                    createrow();
                    reload_table();
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


