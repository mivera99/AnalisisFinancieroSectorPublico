
// Función para mostrar u ocultar la contraseña 
function showPassword(){
    var tipo = document.getElementById("password");
    if(tipo.type == "password"){
        tipo.type = "text";
    }else{
        tipo.type = "password";
    }
}

/*function submit(){
    var
}*/