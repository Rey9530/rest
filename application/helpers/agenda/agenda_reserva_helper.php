<?php

function modalEventos($datos){
    $CI     =& get_instance();

    $fecha_inicio   = date('d-m-Y',strtotime($datos['start']));
    $hora           = date('H:i',strtotime($datos['end']));
    $fecha_final    = date('d-m-Y',strtotime($datos['end']));

    $evento	= $CI->Agenda_reserva_model->obtenerReserva($datos['id_agenda_reserva']);
    ?>
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-body">
                    <span class="close" data-dismiss="modal">&times;</span>
                    <div class="add-edit-event-box">
                        <div class="add-edit-event-content">
                            <h5 class="add-event-title modal-title">Agenda Reserva</h5>
                            <form id="formularioEventos" autocomplete="off">
                                <input hidden name="id_agenda_reserva" value="<?=$datos['id_agenda_reserva']?>">
                                <input hidden id="id_oculto" name="id_oculto" value="<?=((isset($evento['id_cliente']))?$evento['id_cliente']:0)?>">

                                <div class="row mt-3">
                                    <div class="col-md-12 col-sm-12 col-12">
                                        <div class="input-group">
                                            <input type="text" id="buscar" name="id_cliente" class="form-control">
                                            <div class="input-group-append">
                                              <button id="oculto" onclick="mostrarCamposOcultos();" class="btn btn-success" type="button">Nuevo</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--campos del cliente-->
                                <div id="camposCliente" style="display: none;">
                                    <div class="row pt-5">
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="form-group start-date">
                                                <label for="start-date" class="">Nombre Ciente:</label>
                                                <div class="d-flex">
                                                    <input id="nombre_cliente" name="nombre_cliente" placeholder="Nombre cliente" class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="form-group start-date">
                                                <label for="start-date" class="">Numero de personas:</label>
                                                <div class="d-flex">
                                                    <input id="numero_personas" name="numero_personas" placeholder="2" class="form-control" type="number">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-5">
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="form-group start-date">
                                                <label for="start-date" class="">Celular Ciente:</label>
                                                <div class="d-flex">
                                                    <input id="telefono_cliente" name="telefono_cliente" placeholder="(503) 7358-2967" class="form-control celular" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="form-group start-date">
                                                <label for="start-date" class="">Correo cliente:</label>
                                                <div class="d-flex">
                                                    <input id="correo_cliente" name="correo_cliente" placeholder="Ej.: cliente@gmail.com" class="form-control correo" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--campos del cliente-->

                                <div class="row pt-5">
                                    <div class="col-md-4 col-sm-4 col-12">
                                        <div class="form-group start-date">
                                            <label for="start-date" class="">Inicio:</label>
                                            <div class="d-flex">
                                                <input value="<?=((isset($evento['start']))?date('d-m-Y',strtotime($evento['start'])):$fecha_inicio)?>" id="inicio" name="inicio" placeholder="Fecha Inicio" class="form-control fecha" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label class="">Fin:</label>
                                            <div class="d-flex">
                                                <input value="<?=((isset($evento['start']))?date('d-m-Y',strtotime($evento['start'])):$fecha_final)?>" id="final" name="final" placeholder="Fecha Final" type="text" class="form-control fecha">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-12">
                                        <div class="form-group start-date">
                                            <label for="start-date" class="">Hora:</label>
                                            <div class="d-flex">
                                                <input value="<?=((isset($evento['start']))?date('H:i',strtotime($evento['start'])):$hora)?>" id="hora" name="hora" placeholder="Hora" class="form-control" type="time">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="col-md-6 col-sm-6 col-12">
                                            <div class="form-group start-date">
                                                <label for="start-date" class="">Sucursal:</label>
                                                <div class="d-flex">
                                                    <select id="id_sucursal" name="id_sucursal" class="form-control">
                                                    </select>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label class="">Tipo evento:</label>
                                            <div class="d-flex">
                                                <select id="id_tipo_evento" name="id_tipo_evento" class="form-control" onchange="cargarColorFondo(this.value);">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="col-md-12">
                                        <label class="">Descripcion del evento:</label>
                                        <div class="d-flex event-description">
                                            <textarea id="nota" name="nota" placeholder="Ingrese Descripcion" rows="3" class="form-control" name="taskdescription"><?php if(isset($evento['nota'])) echo $evento['nota']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Descartar</button>
                    <button class="btn btn-info" onclick="guardarReserva();" type="button">Guardar</button>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $("#buscar").change(function() {
                    $('#id_oculto').val($('#buscar').val());
                });
            });

            var id_tipo_evento  = "<?=((isset($evento['id_tipo_evento']))?$evento['id_tipo_evento']:'0')?>";
            var id_sucursal     = "<?=((isset($evento['id_sucursal']))?$evento['id_sucursal']:'0')?>";
            var nombre_cliente  = `<?=((isset($evento['nombre_cliente']))?$evento['nombre_cliente']:'Selecione cliente')?>`;
            
            $(()=>{
                cargarTipoEvento(id_tipo_evento);
                cargarbuscador(nombre_cliente);
                cargarSucursal(id_sucursal);
            });
            
            setTimeout(() => {
                if(id_tipo_evento > 0){
                    $('#id_tipo_evento').change();
                }
            }, 500);


            function guardarReserva(){
                $.ajax({
                    url     : '<?=base_url()?>agenda/Agenda_reserva/guardarReserva',
                    type    :  'post',
                    data    : $('#formularioEventos').serialize(),
                    success : (respuesta)=>{
                        $('#calendar').fullCalendar("refetchEvents");
                        $('#modal-celandario').modal('hide');
                        if(respuesta == 200){
                            swal({
                                title       : 'Datos almacenados con exito!',
                                animation   : false,
                                customClass : 'animated tada',
                                padding     : '2em',
                                text        : 'Cerraré en 3 segundos.',
                                timer       : 3000,
                                onOpen      : function () {
                                    swal.showLoading()
                                }
                            }).then(()=>{

                            });
                        }else{
                            swal({
                                title       : 'Algo salio mal contacte al proveedor!',
                                animation   : false,
                                customClass : 'animated tada',
                                padding     : '2em',
                                text        : 'Cerraré en 3 segundos.',
                                timer       : 3000,
                                onOpen      : function () {
                                    swal.showLoading()
                                }
                            });
                        }
                    }
                });
            }

            $(".celular").inputmask({mask:"(503) 9999-9999"});

            $(".correo").inputmask(
                {
                    mask:"*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
                    greedy:!1,onBeforePaste:function(m,a){return(m=m.toLowerCase()).replace("mailto:","")},
                    definitions:{"*":
                        {
                            validator:"[0-9A-Za-z!#$%&'*+/=?^_`{|}~-]",
                            cardinality:1,
                            casing:"lower"
                        }
                    }
                }
            )

            $(".fecha").inputmask("99-99-9999");

            function mostrarCamposOcultos(){
                $('#camposCliente').slideDown();
                $('#oculto').attr({onclick: 'ocultarCamposOcultos();'});
                $('#oculto').text('Buscar');
                $('#buscar').select2('destroy');
                $('#buscar').val('');
                $('#buscar').prop('readonly',true);
                $('#id_oculto').val(0);
            }
            function ocultarCamposOcultos(){
                $('#camposCliente').slideUp();
                $('#oculto').attr({onclick: 'mostrarCamposOcultos();'});
                $('#oculto').text('Nuevo');
                $('#buscar').prop('readonly',false);
                cargarbuscador();
            }

            function cargarColorFondo(id_tipo_evento = 0){
                $.ajax({
                    url     : '<?=base_url()?>agenda/Agenda_reserva/cargarColorFondo',
                    type    : 'POST',
                    dataType: 'json',
                    data    : {id_tipo_evento},
                    success : (respuesta)=>{
                        $('#id_tipo_evento').css({'color':respuesta.color_fondo,'border': '1px solid '+respuesta.color_fondo});
                    }
                });
            }
            
            function cargarTipoEvento(id_tipo_evento = 0){
                $.ajax({
                    url     : '<?=base_url()?>agenda/Agenda_reserva/cargarTipoEvento',
                    type    : 'POST',
                    data    : {id_tipo_evento},
                    success : (respuesta)=>{
                        $('#id_tipo_evento').html(respuesta);
                    }
                });
            }

            function cargarSucursal(id_sucursal = 0, tipo = 0){
                $.ajax({
                    url     : '<?=base_url()?>agenda/Agenda_reserva/cargarSucursal',
                    type    : 'POST',
                    data    : {id_sucursal,tipo},
                    success : (respuesta)=>{
                        $('#id_sucursal').html(respuesta);
                    }
                });
            }

            function cargarbuscador(nombre_cliente){
                // console.log(nombre_cliente);
                $("#buscar").select2({
                    language: "es",
                    dir: "rtl",
                    placeholder: nombre_cliente,
                    minimumInputLength: 3,
                    ajax: {
                        url: '<?=base_url()?>agenda/Agenda_reserva/cargarClientes',
                        type: "POST",
                        data: function (params) {
                            var query = {
                                buscar          : params,
                                type            : 'POST',
                            }
                            return query
                        },
                        results: function (data, page) {
                            return {
                                results: data
                            };
                        }
                    }
                });
            }
        </script>
    <?php
}