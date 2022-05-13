$(()=>{
    cargarMensajeWhatsapp();
});

function cargarMensajeWhatsapp(){
    $.ajax({
        url     : '../administracion/MensajeWhatsapp/cargarMensajeWhatsapp',
        type    : 'POST',
        success : (respuesta)=>{
            $('#contenedormensaje').html(respuesta);
        }
    });
}

function modalMensajeWhatsapp(id_mensaje = 0){
    $.ajax({
        url     : '../administracion/MensajeWhatsapp/modalMensajeWhatsapp',
        type    : 'POST',
        data    : {id_mensaje},
        success : (respuesta)=>{
            $('#moda-mensaje').html(respuesta);
            $('#moda-mensaje').modal({backdrop: 'static', keyboard: false});
        }
    });
}

function guardarmensaje(){
    if(titulo_mensaje.value.length == 0){ $('#titulo_mensaje').css({'border':'1px solid red'}); return false; }
    else { $('#titulo_mensaje').css({'border':'1px solid green'}); }
    
    if(id_sucursal.value.length == 0){ $('#id_sucursal').css({'border':'1px solid red'}); return false; }
    else { $('#id_sucursal').css({'border':'1px solid green'}); }
    
    if(contenido_mensaje.value.length == 0){ $('#contenido_mensaje').css({'border':'1px solid red'}); return false; }
    else { $('#contenido_mensaje').css({'border':'1px solid green'}); }

    $.ajax({
        url     : '../administracion/MensajeWhatsapp/guardarmensaje',
        type    : 'POST',
        data    : $('#formularioMensaje').serialize(), 
        success : (respuesta)=>{
            cargarMensajeWhatsapp();
            $('#moda-mensaje').modal('hide');
            mensajeRespuesta(respuesta);
        }
    });
}

function cambiarEstado(id_mensaje,valor){
    $.ajax({
        url     : '../administracion/MensajeWhatsapp/cambiarEstado',
        type    : 'POST',
        data    : {id_mensaje,valor}, 
        success : (respuesta)=>{
            cargarMensajeWhatsapp();
            mensajeRespuesta(respuesta);
        }
    });
}