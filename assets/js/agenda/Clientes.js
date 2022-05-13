cargarClientes();

function cargarClientes(){
    $.ajax({
        url     : '../agenda/Clientes/cargarClientes',
        type    : 'POST',
        success : (respuesta)=>{
            $('#contenedorClientes').html(respuesta);
        }
    });
}


function obtenerCliente(id_cliente = 0){
    $.ajax({
        url     : '../agenda/Clientes/obtenerCliente',
        type    : 'POST',
        data    : {id_cliente},
        success : (respuesta)=>{
            $('#modal-cliente').html(respuesta);
            $('#modal-cliente').modal({backdrop: 'static', keyboard: false});
        }
    });
}

function eliminarCliente(id_cliente){
    const swalWithBootstrapButtons = swal.mixin({
        confirmButtonClass  : 'btn btn-success btn-rounded',
        cancelButtonClass   : 'btn btn-danger btn-rounded mr-3',
        buttonsStyling      : false,
    });
  
    swalWithBootstrapButtons({
        title               : 'Esta seguro?',
        text                : "El registro sera eliminado!",
        type                : 'warning',
        showCancelButton    : true,
        confirmButtonText   : 'Si, eliminar!',
        cancelButtonText    : 'No, cancelar!',
        reverseButtons      : true,
        padding             : '2em'
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url     : '../agenda/Clientes/eliminarCliente',
                type    : 'POST',
                data    : {id_cliente},
                success : (respuesta)=>{
                    cargarClientes();
                    mensajeRespuesta(respuesta);
                }
            });
        }
    });
}