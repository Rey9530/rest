$(document).ready(function() {
     //== Crear elemento BackDrop ( Overlay )
     function createBackdropElement () {
        var btn = document.createElement("div");
        btn.setAttribute('class', 'modal-backdrop fade show')
        document.body.appendChild(btn);
    }

    var idsucursal = $('#sucursal').val();

    $('#calendar').fullCalendar({
        locale      : 'es',
        defaultView : 'month',
        header      : {
            left    : 'prev,next today',
            center  : 'title',
            right   : 'month,agendaWeek,agendaDay'
        },
        events      : '../agenda/Agenda_reserva/cargarAgendaReserva?ids='+idsucursal,
        droppable   : true, // this allows things to be dropped onto the calendar !!!
        eventLimit  : true, // allow "more" link when too many events
        selectable  : true,
        dayClick    : function (date, jsEvent, view) {
            var start2      = date.format('YYYY-MM-DD HH:mm:ss');
            var end         = date.format('YYYY-MM-DD HH:mm:ss');
            //=== aqui colocaremos la funcion para agregar
            //==  eventos con fecha seleccionada
            // console.log('Agregar eventos');
            modalEventos(start2,end);
        },
        eventClick  : function(event, delta, revertFunc) {
            var start2                = '';
            var end                   = '';
            var id_agenda_reserva     = event.id_agenda_reserva;
            //=== aqui colocaremos la funcion para agregar
            modalEventos(start2,end,id_agenda_reserva);
        },
        editable    : true,
        eventLimit  : true, 
        eventMouseover  : function(event, jsEvent, view) {
            //== aca llamaremos una mini ventanita con las descripcion
            // console.log('Ventanita'); 
            $(this).attr('id', event.id);

            $('#'+event.id).popover({
                template    : '<div class="popover popover-primary" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
                title       : event.title,
                content     : event.description,
                placement   : 'auto',
            });

            $('#'+event.id).popover('show');
            $('.popover-header').css('background-color',event.backgroundColor);
            $('.popover').css('border','1px solid '+event.backgroundColor);
        },
        eventMouseout   : function(event, jsEvent, view) {
            //==ocultamos la ventanita
            // console.log('Ocultar Ventanita');
            $('#'+event.id).popover('hide');
         }
    });
});