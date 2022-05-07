function modalEventos(start,end,id_agenda_reserva = 0){
    $.ajax({
        url     : '../agenda/Agenda_reserva/modalEventos',
        type    : 'POST',
        data    : {
            start,
            end,
            id_agenda_reserva,
        },
        success : (respuesta)=>{
            $('#modal-celandario').html(respuesta);
            $('#modal-celandario').modal({backdrop: 'static', keyboard: false});
        }
    });
}

function enviarWharsapp(id_agenda_reserva = 0){
    $('#modal-celandario').modal('hide');
    $.ajax({
        url     : '../agenda/Agenda_reserva/enviarWharsapp',
        type    : 'POST',
        data    : {
            id_agenda_reserva,
        },
        success : (respuesta)=>{
            $('#modal-whatsapp').html(respuesta);
            $('#modal-whatsapp').modal({backdrop: 'static', keyboard: false});
        }
    });
}

function cargarTitulosMensajes(){
    $.ajax({
        url     : '../agenda/Agenda_reserva/cargarTitulosMensajes',
        type    : 'POST',
        success : (respuesta)=>{
            $('#id_mensaje').html(respuesta);
        }
    });
}

function cargarMensaje(){
    var id_mensaje = $('#id_mensaje').val();
    $.ajax({
        url         : '../agenda/Agenda_reserva/cargarMensaje',
        type        : 'POST',
        dataType    : 'JSON',
        data        : {id_mensaje},
        success     : (respuesta)=>{
            $('#mensaje').html(respuesta.contenido_mensaje);
        }
    });
}

function enviarMensaje(){
    window.open('https://api.whatsapp.com/send?phone=50371829992&text=Hola.');
}

$('#sucursal').change(()=>{
    window.location.href = '../agenda/Agenda_reserva?ids='+$('#sucursal').val();
});