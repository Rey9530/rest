<?php

function enviarWharsapp($datos){
    $CI             =& get_instance();
    ?>
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mensaje para WhatsApp</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="mensaje" class="control-label">Numero WhatsApp <span style="color: red;">*</span>:</label>
                        <input id="telefono_cliente" class="form-control celular" value="<?=$datos['telefono_cliente']?>">
                    </div>
                    <div class="col-md-12 pt-4">
                        <label for="mensaje" class="control-label">Seleccionar Mensaje <span style="color: red;">*</span>:</label>
                        <select id="id_mensaje" class="form-control" onchange="cargarMensaje();"></select>
                    </div>
                    <div class="col-md-12 pt-4">
                        <label for="mensaje" class="control-label">Mensaje <span style="color: red;">*</span>:</label>
                        <div class="form-group">
                            <textarea rows="8" class="form-control" id="mensaje" aria-describedby="emailHelp1" placeholder="Escriba su mensaje!"></textarea>
                            <small id="emailHelp1" class="form-text text-muted">Este mensaje se enviara al cliente, por favor sea cortez.</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancelar</button>
                    <button type="button" class="btn btn-dark" onclick="enviarMensaje();"><i class="fa fa-send"></i> Enviar</button>
                </div>
            </div>
        </div>
        <script>
            $(()=>{
                cargarTitulosMensajes();
            });

            $(".celular").inputmask({mask:"(503) 9999-9999"});
        </script>
    <?php
}

function modalEventos($datos){
    $CI             =& get_instance();

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
                                <input hidden name="id_agenda_reserva" id="id_agenda_reserva" value="<?=$datos['id_agenda_reserva']?>">
                                <input hidden id="id_oculto" name="id_oculto" value="0">

                                <div class="row mt-3">
                                    <div class="col-md-12 col-sm-12 col-12">
                                        <div class="input-group">
                                            <input type="text" id="buscar" name="id_cliente" class="form-control" >
                                            <div class="input-group-append">
                                              <button id="oculto" onclick="mostrarCamposOcultos();" class="btn btn-success" type="button">Nuevo</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--campos del cliente-->
                                <div id="camposCliente" style="display: none;">
                                    <div class="row pt-5">
                                        <div class="col-md-12 col-sm-12 col-12">
                                            <div class="form-group start-date">
                                                <label for="start-date" class="">Nombre Ciente <span style="color: red;">*</span>:</label>
                                                <div class="d-flex">
                                                    <input id="nombre_cliente" name="nombre_cliente" placeholder="Nombre cliente" class="form-control cliente" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-5">
                                        <div class="col-md-4 col-sm-4 col-12">
                                            <div class="form-group start-date">
                                                <label for="start-date" class="">Celular Ciente <span style="color: red;">*</span>:</label>
                                                <div class="d-flex">
                                                    <input id="telefono_cliente" name="telefono_cliente" placeholder="(503) 7358-2967" class="form-control celular cliente" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-12">
                                            <div class="form-group start-date">
                                                <label for="start-date" class="">Segundo Celular Ciente:</label>
                                                <div class="d-flex">
                                                    <input id="dos_telefono_cliente" name="dos_telefono_cliente" placeholder="(503) 7182-9992" class="form-control celular cliente" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-12">
                                            <div class="form-group start-date">
                                                <label for="start-date" class="">Correo cliente:</label>
                                                <div class="d-flex">
                                                    <input id="correo_cliente" name="correo_cliente" placeholder="Ej.: cliente@gmail.com" class="form-control correo cliente" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--campos del cliente-->

                                <div class="row pt-5">
                                    <div class="col-md-4 col-sm-4 col-12">
                                        <div class="form-group start-date">
                                            <label for="start-date" class="">Inicio <span style="color: red;">*</span>:</label>
                                            <div class="d-flex">
                                                <input value="<?=((isset($evento['start']))?date('d-m-Y',strtotime($evento['start'])):$fecha_inicio)?>" id="inicio" name="inicio" placeholder="Fecha Inicio" class="form-control fecha required" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label class="">Fin <span style="color: red;">*</span>:</label>
                                            <div class="d-flex">
                                                <input value="<?=((isset($evento['start']))?date('d-m-Y',strtotime($evento['start'])):$fecha_final)?>" id="final" name="final" placeholder="Fecha Final" type="text" class="form-control fecha required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-12">
                                        <div class="form-group start-date">
                                            <label for="start-date" class="">Hora <span style="color: red;">*</span>:</label>
                                            <div class="d-flex">
                                                <input value="<?=((isset($evento['start']))?date('H:i',strtotime($evento['start'])):$hora)?>" id="hora" name="hora" placeholder="Hora" class="form-control required" type="time">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="col-md-4 col-sm-4 col-12">
                                            <div class="form-group start-date">
                                                <label for="start-date" class="">Sucursal <span style="color: red;">*</span>:</label>
                                                <div class="d-flex">
                                                    <select id="id_sucursal" name="id_sucursal" class="form-control required">
                                                    </select>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label class="">Tipo evento <span style="color: red;">*</span>:</label>
                                            <div class="d-flex">
                                                <select id="id_tipo_evento" name="id_tipo_evento" class="form-control required" onchange="cargarColorFondo(this.value);">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 col-sm-4 col-12">
                                        <div class="form-group start-date">
                                            <label for="start-date" class="">Numero de personas <span style="color: red;">*</span>:</label>
                                            <div class="d-flex">
                                                <input value="<?php if(isset($evento['numero_personas'])) echo $evento['numero_personas']; ?>" id="numero_personas" name="numero_personas" placeholder="Ej.: 2" class="form-control required" type="number">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="col-md-12">
                                        <label class="">Descripcion del evento <span style="color: red;">*</span>:</label>
                                        <div class="d-flex event-description">
                                            <textarea id="nota" name="nota" placeholder="Ingrese Descripcion" rows="3" class="form-control required" name="taskdescription"><?php if(isset($evento['nota'])) echo $evento['nota']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" onclick="enviarWharsapp(<?=$datos['id_agenda_reserva']?>);" style="display: none;" id="envio"><i class="fa fa-whatsapp"></i> Enviar recordatorio</button>
                    <button class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button class="btn btn-info" onclick="guardarReserva();" type="button"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </div>
        </div>
        <script>

            var id_tipo_evento  = "<?=((isset($evento['id_tipo_evento']))?$evento['id_tipo_evento']:'0')?>";
            var id_sucursal     = "<?=((isset($evento['id_sucursal']))?$evento['id_sucursal']:'0')?>";
            var nombre_cliente  = `<?=((isset($evento['nombre_cliente']))?$evento['nombre_cliente']:'Selecione cliente')?>`;
            
            $(()=>{
                cargarTipoEvento(id_tipo_evento);
                cargarbuscador(nombre_cliente);
                cargarSucursal(id_sucursal);
                mostrarBotonWhatsapp(<?=$datos['id_agenda_reserva']?>);
            });

            function mostrarBotonWhatsapp(id=0){
                if(id > 0){
                    $('#envio').slideDown();
                }
            }
            
            setTimeout(() => {
                if(id_tipo_evento > 0){
                    $('#id_tipo_evento').change();
                }
            }, 500);

            function guardarReserva(){

                if(id_oculto.value == 0 && buscar.value == ''  && id_agenda_reserva.value == 0){
                    swal({
                        title       : 'Debes seleccionar un cliente',
                        animation   : false,
                        customClass : 'animated tada',
                        padding     : '2em',
                        text        : 'Cerraré en 3 segundos.',
                        timer       : 3000,
                        onOpen      : function () {
                            swal.showLoading()
                        }
                    });
                    return false;
                }

                //== campos obligarios de los clientes
                if($('#nombre_cliente').val().length == 0 && id_oculto.value == 1)
                { $('#nombre_cliente').css({'border':'1px solid red'}); return false;}
                else { $('#nombre_cliente').css({'border':'1px solid green'}); }

                if(telefono_cliente.value.length == 0 && id_oculto.value == 1)
                { $('#telefono_cliente').css({'border':'1px solid red'}); return false;}
                else { $('#telefono_cliente').css({'border':'1px solid green'}); }

                //=== campos normales obligatorios
                if(inicio.value.length == 0){ $('#inicio').css({'border':'1px solid red'}); return false;}
                else { $('#inicio').css({'border':'1px solid green'}); }

                if(final.value.length == 0){ $('#final').css({'border':'1px solid red'}); return false; }
                else { $('#final').css({'border':'1px solid green'}); }
                
                if(hora.value.length == 0){ $('#final').css({'hora':'1px solid red'}); return false; }
                else { $('#hora').css({'border':'1px solid green'}); }

                if($('#id_sucursal').val().length == 0){ $('#id_sucursal').css({'border':'1px solid red'}); return false; }
                else { $('#id_sucursal').css({'border':'1px solid green'}); }

                if($('#id_tipo_evento').val().length == 0){ $('#id_tipo_evento').css({'border':'1px solid red'}); return false; }
                else { $('#id_tipo_evento').css({'border':'1px solid green'}); }

                if(numero_personas.value.length == 0){ $('#numero_personas').css({'border':'1px solid red'}); return false;  }
                else { $('#numero_personas').css({'border':'1px solid green'}); }

                if(nota.value.length == 0){ $('#nota').css({'border':'1px solid red'}); return false; }
                else { $('#nota').css({'border':'1px solid green'}); }
                
                $.ajax({
                    url     : '<?=base_url()?>agenda/Agenda_reserva/guardarReserva',
                    type    :  'post',
                    data    : $('#formularioEventos').serialize(),
                    success : (respuesta)=>{
                        $('#modal-celandario').modal('hide');
                        $('#calendar').fullCalendar("refetchEvents");
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
                $('#id_oculto').val(1);
            }

            function ocultarCamposOcultos(){
                $('#camposCliente').slideUp();
                $('#oculto').attr({onclick: 'mostrarCamposOcultos();'});
                $('#oculto').text('Nuevo');
                $('#buscar').prop('readonly',false);
                $('#id_oculto').val(0);
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
                    minimumInputlength: 3,
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