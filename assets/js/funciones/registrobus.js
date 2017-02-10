var table;
$(document).ready(function() {
    var url = base_url + '/' + pathArray[1] + '/index.php/registrobus/json/databus';
    table = $('#tablebus').DataTable({
        "pageLength": 10,
        "ajax": {
            "url": url,
            "type": "POST"
        },
        "columns": 
            [
                {"data": "NomBus"},
                {"data": "Placa"},
                {"data": "Chofer"},
                {"data": "N_Asiento",'class':'text-center'},
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
    
    $('#tablebus tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        var data = table.row( this ).data();
        editarbus(data.IdBus);
    });
});

function saverow(){
    var IdBus = $("#IdBus").val();
    var url2 = base_url + '/' + pathArray[1] + '/index.php/registrobus/json/';
    var url3 = '';
    var NomBus = $('#NomBus').val();
    var Placa = $('#Placa').val();
    var N_Asiento = $('#N_Asiento').val();
    var IdChofer = $('#IdChofer').val();
    if(NomBus === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar el NOMBRE BUS.');
        });
        return false;
    }
    if(Placa === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar el NRO PLACA.');
        });
        return false;
    }
    if(N_Asiento === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar el NUMERO ASIENTO.');
        });
        return false;
    }
    if(IdChofer === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar el SELECCIONAR EL CHOFER.');
        });
        return false;
    }
    if(IdBus === ''){
        url3 = url2 + 'add';
    }else{
        url3 = url2 + 'update';
    }
    $.ajax({
        url : url3,
        type: "POST",
        dataType: "JSON",
        data: $('#formRegistroBus').serialize(),
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

function editarbus(IdBus){
    var url1 = base_url + '/' + pathArray[1] + '/index.php/registrobus/json/editarbus';
    $.ajax({
        url : url1,
        type: "POST",
        dataType: "JSON",
        data: {IdBus:IdBus},
        success: function(data){
            $.each(data, function(k,v){
                $("#IdBus").val(data[k].IdBus);
                $("#Placa").val(data[k].Placa);
                $("#NomBus").val(data[k].NomBus);
                $("#N_Asiento").val(data[k].N_Asiento);
                $("#IdChofer").val(data[k].IdChofer);
            });
        },
        timeout:40000
    });
}

function reload_table(){
    table.ajax.reload(null,false);
}

function createrow(){
    $('#IdBus').val('');
    $('#NomBus').val('');
    $('#Placa').val('');
    $('#N_Asiento').val('');
    $('#IdChofer').val('');
}