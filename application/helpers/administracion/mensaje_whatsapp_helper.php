<?php
function modalMensajeWhatsapp($datos){
    $CI =& get_instance();
    ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mensaje de Whatsapp</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-remove"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formularioMensaje">
                        <input type="hidden" name="id_mensaje" value="<?=$datos['id_mensaje']?>">
                        <div class="col-md-12 mt-4">
                            <label for="titulo_mensaje">Titulo <span style="color: red;">*</span>:</label>
                            <input value="<?=((isset($datos['titulo_mensaje']))?$datos['titulo_mensaje']:'')?>" type="text" name="titulo_mensaje" id="titulo_mensaje" class="form-control">
                        </div>
                        <div class="col-md-12 mt-4">
                            <label for="titulo_mensaje">Sucursal <span style="color: red;">*</span>:</label>
                            <select name="id_sucursal" id="id_sucursal" class="form-control"></select>
                        </div>
                        <div class="col-md-12 mt-4">
                            <label for="contenido_mensaje">Cuerpo mensaje <span style="color: red;">*</span>:</label>
                            <textarea name="contenido_mensaje" id="contenido_mensaje" cols="30" rows="8" class="form-control"><?=((isset($datos['contenido_mensaje']))?$datos['contenido_mensaje']:'')?></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="guardarmensaje();"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </div>
        </div>
        <script>
            $(()=>{
                var id_sucursal = <?=((isset($datos['id_sucursal']))?$datos['id_sucursal']:0)?>;
                cargarSucursal(id_sucursal);
            });
            function cargarSucursal(id_sucursal = 0){
               $.ajax({
                   url     : '../administracion/MensajeWhatsapp/cargarSucursal',
                   type    : 'POST',
                   data     : {id_sucursal},
                   success : (respuesta)=>{
                       $('#id_sucursal').html(respuesta);
                   }
               });
            }
        </script>
    <?php
}

function cargarMensajeWhatsapp($datos){
    $CI =& get_instance();
    ?>
        <div class="col-lg-12 mt-5">
            <button class="btn btn-secondary btn-lg" type="button" onclick="modalMensajeWhatsapp();"><i class="fa fa-plus"></i> agregar</button>
            <button class="btn btn-info btn-lg" type="button" onclick="cargarMensajeWhatsapp();"><i class="fa fa-refresh"></i> Recargar</button>
        </div>
        <div class="col-lg-12 mt-5">
            <table id="tablaMensajesWhatsapp" class="table dt-table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Contenido</th>
                        <th>Usuario Creador</th>
                        <th>Fecha Creacion</th>
                        <th>Estado</th>
                        <th>Opcion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($datos as $row){
                            echo '<tr>';
                                echo '<td>'.$row['titulo_mensaje'].'</td>';
                                echo '<td>'.nl2br($row['contenido_mensaje']).'</td>';
                                echo '<td>'.$row['nombre'].'</td>';
                                echo '<td>'.date('d-m-Y g:i:s A',strtotime($row['fecha_creacion'])).'</td>';
                                if($row['estado'] == 1){
                                    $titulo = 'Inhabilitar';
                                    $color  = 'danger';
                                    $valor  = '0';
                                    echo '<td><span class="shadow-none badge badge-success">Habilitado</span></td>';
                                }else{
                                    $titulo = 'Abilitar';
                                    $color  = 'secondary';
                                    $valor  = '1';
                                    echo '<td><span class="shadow-none badge badge-danger">Inhabilitado</span></td>';
                                }
                                echo '<td>';
                                    echo '<div class="btn-group" role="group" aria-label="Basic example">';
                                        echo '<button onclick="modalMensajeWhatsapp('.$row['id_mensaje'].');" class="btn btn-warning" type="button"><i class="fa fa-edit"></i> Editar</button>';
                                        echo '<button onclick="cambiarEstado('.$row['id_mensaje'].','.$valor.');" class="btn btn-'.$color.'" type="button"><i class="fa fa-hand-o-up"></i> '.$titulo.'</button>';
                                    echo '</div>';
                                echo '</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Titulo</th>
                        <th>Contenido</th>
                        <th>Usuario Creador</th>
                        <th>Fecha Creacion</th>
                        <th>Estado</th>
                        <th>Opcion</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <script>
            $('#tablaMensajesWhatsapp').DataTable({
                "dom"           :   "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                                    "<'table-responsive'tr>" +
                                    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                                    "oLanguage": {
                                        "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                                        "sInfo": "Mostrando página _PAGE_ de _PAGES_",
                                        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                                        "sSearchPlaceholder": "Buscar...",
                                        "sLengthMenu": "Resultados :  _MENU_",
                                    },
                "stripeClasses" :   [],
                "lengthMenu"    :   [5,7, 10, 20, 50,100],
                "pageLength"    :   7 
            });
        </script>
    <?php
}