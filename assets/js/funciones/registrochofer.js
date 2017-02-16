var table;
$(document).ready(function() {
    var url = base_url + '/' + pathArray[1] + '/index.php/registrochofer/json/datachofer';
    table = $('#tablechofer').DataTable({
        "pageLength": 10,
        "ajax": {
            "url": url,
            "type": "POST"
        },
        "columns": 
            [
                {"data": "Chofer"},
                {"data": "Direccion"},
                {"data": "N_Brevete"},
                {
             bSortable: false,
                mRender: function (o) { return '<center><span class="glyphicon glyphicon-pencil"></span></center>'; }
            }
            ],
        "bLengthChange" : false,
        "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 0,1,2,3 ] }
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
    
    $('#tablechofer tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        var data = table.row( this ).data();
        editarchofer(data.IdChofer);
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
    var IdChofer = $("#IdChofer").val();
    var url2 = base_url + '/' + pathArray[1] + '/index.php/registrochofer/json/';
    var url3 = '';
    var Chofer = $('#Chofer').val();
    var Direccion = $('#Direccion').val();
    var N_Brevete = $('#N_Brevete').val();
    if(Chofer === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar el CHOFER.');
        });
        return false;
    }
    if(Direccion === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar la DIRECCIÓN.');
        });
        return false;
    }
    if(N_Brevete === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar el NUMERO DE BREVETE.');
        });
        return false;
    }
    if(IdChofer === ''){
        url3 = url2 + 'add';
    }else{
        url3 = url2 + 'update';
    }
    $.ajax({
        url : url3,
        type: "POST",
        dataType: "JSON",
        data: $('#formRegistroChofer').serialize(),
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

function editarchofer(IdChofer){
    var url1 = base_url + '/' + pathArray[1] + '/index.php/registrochofer/json/editarchofer';
    $.ajax({
        url : url1,
        type: "POST",
        dataType: "JSON",
        data: {IdChofer:IdChofer},
        success: function(data){
            $.each(data, function(k,v){
                $("#IdChofer").val(data[k].IdChofer);
                $("#Chofer").val(data[k].Chofer);
                $("#Direccion").val(data[k].Direccion);
                $("#N_Brevete").val(data[k].N_Brevete);
            });
        },
        timeout:40000
    });
}

function reload_table(){
    table.ajax.reload(null,false);
}

function createrow(){
    $('#IdChofer').val('');
    $('#Chofer').val('');
    $('#Direccion').val('');
    $('#N_Brevete').val('');
}