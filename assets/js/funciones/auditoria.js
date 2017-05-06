function consultar(){
    var sentenciasql = $('#sentenciasql').val();
    if(sentenciasql == ''){
        alert('Debe ingresar la sentencia sql.');
        return false;
    }
    var url = base_url + '/' + pathArray[1] + '/index.php/auditoria/consultar';

    $.ajax({
        async:true,
        dataType: "html",
        url: url,
        method: "POST",
        data: {sentenciasql: sentenciasql},
        beforeSend:cargando,
        success: function(result){
            Ext.getBody().unmask();
            $('#respuesta').html(result);
        },
        error:problemas,
        timeout:40000
    });
}


