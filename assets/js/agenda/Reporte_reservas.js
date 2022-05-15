$(".calendario").inputmask("99-99-9999");
cargarSucursales();

function cargarSucursales(){
    $.ajax({
        url     : '../Agenda/Reporte_reservas/cargarSucursales',
        type    : 'POST',
        success : (respuesta)=>{
            $('#id_sucursal').html(respuesta);
        }
    });
}


$('.btn-danger').on('click',function(){
    window.open('../agenda/Reporte_reservas/imprimirReporte/1/'+inicio.value+'/'+fin.value+'/'+id_sucursal.value);
});

$('.btn-success').on('click',function(){
    window.open('../agenda/Reporte_reservas/imprimirReporte/2/'+inicio.value+'/'+fin.value+'/'+id_sucursal.value);
});
