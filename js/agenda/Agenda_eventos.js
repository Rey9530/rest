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


$('#sucursal').change(()=>{
    window.location.href = '../agenda/Agenda_reserva?ids='+$('#sucursal').val();
});