<?php
function obtenerCliente($datos){
    ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar informacion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <i class="fa fa-remove"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="FormularioCliente" autocomplete="off">
                            <input type="hidden" name="id_cliente" value="<?=$datos['id_cliente']?>">
                        <div class="col-md-12 mt-2">
                            <label for="">Nombre cliente <span style="color: red;">*</span>:</label>
                            <input type="text" name="nombre_cliente" id="nombre_cliente" class="form-control" value="<?=$datos['nombre_cliente']?>">
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="">Telefono<span style="color: red;">*</span>:</label>
                            <input type="text" name="telefono_cliente" id="telefono_cliente" class="form-control cel" value="<?=$datos['telefono_cliente']?>">
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="">Segundo Telefono:</label>
                            <input type="text" name="dos_telefono_cliente" class="form-control cel" value="<?=$datos['dos_telefono_cliente']?>">
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="">Correo electronico:</label>
                            <input type="text" name="dos_telefono_cliente" class="form-control mail" value="<?=$datos['dos_telefono_cliente']?>">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cerrar</button>
                    <button type="button" class="btn btn-secondary"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </div>
        </div>
        <script>
            $('.cel').inputmask("(503) 9999-9999");
            $(".mail").inputmask({
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
            
            $('.btn-secondary').on('click',function(){

                if($('#nombre_cliente').val().length == 0){
                    $('#nombre_cliente').css('border','1px solid red'); return false;
                }else{
                    $('#nombre_cliente').css('border','1px solid green');
                }

                if($('#telefono_cliente').val().length == 0){
                    $('#telefono_cliente').css('border','1px solid red'); return false;
                }else{
                    $('#telefono_cliente').css('border','1px solid green');
                }

                $.ajax({
                    url     :  '../agenda/Clientes/actualizarCliente',
                    type    : 'POST',
                    data    : $('#FormularioCliente').serialize(),
                    success : (respuesta)=>{
                        $('#modal-cliente').modal('hide');
                        cargarClientes();
                        mensajeRespuesta(respuesta);
                    }
                });
            });
        </script>
    <?php
}
function cargarClientes($datos){
    $CI             =& get_instance();
    ?>
        <div class="col-md-12">
            <button class="btn btn-info" onclick="cargarClientes();"><i class="fa fa-refresh"></i> Recargar</button>
        </div>
        <div class="row col-md-12 mt-3">
            <table id="tablaClientes" class="table dt-table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Telefonos</th>
                        <th>Correo Electronico</th>
                        <th>Fecha Creacion</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $x  =   1;
                        foreach ($datos as $row) {

                            if(empty($row['correo_cliente'])){
                                $row['correo_cliente'] = '<span class="label label-info">N/A</span>';
                            }

                            echo '<tr>';
                                echo '<td>'.$x.'</td>';
                                echo '<td>'.$row['nombre_cliente'].'</td>';
                                echo '<td>'.$row['telefono_cliente'].' '.$row['dos_telefono_cliente'].'</td>';
                                echo '<td>'.$row['correo_cliente'].'</td>';
                                echo '<td>'.date('d-m-Y g:i:s A',strtotime($row['fecha_creacion'])).'</td>';
                                echo '<td>';
                                    echo '<button onclick="obtenerCliente('.$row['id_cliente'].');" type="button" title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i></button>';
                                    echo '<button onclick="eliminarCliente('.$row['id_cliente'].');" type="button" title="Eliminar" class="btn btn-danger"><i class="fa fa-trash"></i></button>';
                                echo '</td>';
                            echo '</tr>';
                            $x++;
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Telefonos</th>
                        <th>Correo Electronico</th>
                        <th>Fecha Creacion</th>
                        <th>Opciones</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <script>
            $('#tablaClientes').DataTable({
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
            
    <?php
}