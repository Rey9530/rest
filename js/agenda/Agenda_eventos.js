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
    window.location.href = '../agenda/Agenda_reserva?ids='+sucursal.value;
});

function cargarSucursalesActivas(id_sucursal = 0 ,tipo = 1){
    $.ajax({
        url     : '../agenda/Agenda_reserva/cargarSucursal',
        type    : 'POST',
        data    : {id_sucursal,tipo},
        success : (respuesta)=>{
            $('#sucursal').html(respuesta);
        }
    });
}