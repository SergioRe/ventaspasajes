$(document).ready(function() {
    $('.datepicker').datepicker({
        autoclose: true,
        format: "dd/mm/yyyy",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true
    });
});

function reporteVentasPorFechas(){
    $("#ModalRangoFechas").modal("show");
}

function validarFechas(){
    var FECHAINI = $("#FECHAINI").val();
    var FECHAFIN = $("#FECHAFIN").val();
    if(FECHAINI === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar la FECHA INICIO.');
        });
        return false;
    }
    if(FECHAFIN === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar la FECHA FIN.');
        });
        return false;
    }
    var FECHAINII = new Date(FECHAINI);
    var FECHAFINN = new Date(FECHAFIN);
    if(FECHAINII >FECHAFINN){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'La FECHA INICIO no puede ser mayor que la FECHA FIN.');
        });
        return false;
    }
}