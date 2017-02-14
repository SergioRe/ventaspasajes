function validarLogin(){
    var usuarios = $('#USUARIO').val();
    var contrasena = $('#CONTRASENA').val();
    if(usuarios === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar el USUARIO.');
        });
        return false;
    }
    if(contrasena === ''){
        Ext.onReady(function() {
            Ext.MessageBox.alert('!ATENCIÓN¡', 'Debe ingresar LA CONTRASEÑA.');
        });
        return false;
    }
}


