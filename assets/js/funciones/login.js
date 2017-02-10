function validarLogin(){
    var usuarios = $('#USUARIO').val();
    var contrasena = $('#CONTRASENA').val();
    if(usuarios === ''){
        alert('Debe ingresar el usuario.');
        return false;
    }
    if(contrasena === ''){
        alert('Debe ingresar la contrasena.');
        return false;
    }
}


