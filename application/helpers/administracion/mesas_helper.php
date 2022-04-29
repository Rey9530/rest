<?php defined('BASEPATH') OR exit('No direct script access allowed');



function table_mesa(){
    $CI =& get_instance();
    

    $data = $CI->db->query('SELECT * FROM mesas WHERE estado=1'); 
    ?>
        <div class="table-responsive">
            <table class="table table-bordered mb-4">
                <thead>
                    <tr>
                        <th>Descripci&oacute;n</th>
                        <th>Capacidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($data->result_array() as $item) {
                            ?>
                            
                                <tr>
                                    <td> <?=$item['descripcion']?> </td>
                                    <td> <?=$item['capacidad']?> </td>
                                    <td> 
                                        <button class="btn btn-info" onclick="formulario_mesa(<?=$item['id_mesa']?>);">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                        </button>
                                        <button class="btn btn-danger" onclick="eliminar_mesa(<?=$item['id_mesa']?>);">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </button>
                                    </td>
                                </tr>
                            <?php
                        }
                    ?> 
                </tbody>
            </table>
            <script>
                
                    function eliminar_mesa(tk=0){

                        swal({
                            title: '¿Estas seguro?',
                            text: "El registro se eliminara completamente!",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Eliminar', 
                        }).then(function(result) {
                            if (result.value) {
                                $.ajax({
                                    type        : 'POST',
                                    url         : '<?=base_url()?>administracion/mesas/eliminar_mesa',
                                    data		: {tk},
                                    dataType    : 'json',
                                    success: function(data){
                                        if(data.estado==200){
                                            $('#modal').modal('hide');
                                            table_mesa();
                                            const toast = swal.mixin({
                                                toast: true,
                                                position: 'top-end',
                                                showConfirmButton: false,
                                                timer: 3000,
                                                padding: '2em'
                                            }); 
                                            toast({
                                                type: 'Excelente',
                                                title: data.msj,
                                                padding: '2em',
                                            });
                                        }else{
                                            swal({
                                                title: 'Ooops',
                                                text: data.msj,
                                                type: 'error',
                                                padding: '2em'
                                            });
                                        }
                                    }
                                });
                            }
                        });

                        
                    }
            </script>
        </div>
    <?php
}
function formulario_mesa($id){
    $CI =& get_instance(); 
    $id = intval($id);
    $data = $CI->db->query('SELECT * FROM mesas WHERE id_mesa='.$id)->result_array(); 
    $descripcion ='';
    $capacitad =0;
    foreach($data AS $item){
        $descripcion = $item['descripcion'];
        $capacitad   = $item['capacidad']; 
    }
    ?> 
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mesa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-lg-12 col-12 mx-auto">
                            <form method="post" id="procesar_mesa" >
                                <div class="form-group">
                                    <p>Descripci&oacute;n</p>
                                    <label for="t-text" class="sr-only">Text</label>
                                    <input type="hidden" name="tk_" id="tk_" value="<?=$id?>">
                                    <input id="descripcion" type="text" name="descripcion" value="<?=$descripcion?>" placeholder="Ingrese una descripcion...." class="form-control" >
                                </div>
                                <div class="form-group">
                                    <p>Capacidad</p>
                                    <label for="t-text" class="sr-only">Text</label>
                                    <input id="capacidad" type="number" name="capacidad" value="<?=$capacitad?>" placeholder="Ingrese la capacidad" class="form-control" required> 
                                </div>
                            </form>
                        </div>                                        
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="procesar_mesa()" id="procesar_btn">Procesar</button>
                </div>
            </div>
        </div> 
        <script>
            function procesar_mesa(){

                if($("#descripcion").val().length<4){
                    swal({
                        title: 'Ooops',
                        text: "La descripcion no debe estar vacia!",
                        type: 'error',
                        padding: '2em'
                    });
                    return false;
                }
                $.ajax({
                    type        : 'POST',
                    url         : '<?=base_url()?>administracion/mesas/guardar',
                    data		: $("#procesar_mesa").serialize(),
                    dataType    : 'json',
                    beforeSend:function(data){
                        $("#procesar_btn").attr('disabled','disabled');
                        $("#procesar_btn").html(' <div class="spinner-border text-white mr-2 align-self-center loader-sm "></div>');
                    },
                    success: function(data){
                        if(data.estado==200){
                            $('#modal').modal('hide');
                            table_mesa();
                            const toast = swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                padding: '2em'
                            }); 
                            toast({
                                type: 'success',
                                title: 'Datos almacenados!',
                                padding: '2em',
                            });
                        }else{
                            swal({
                                title: 'Ooops',
                                text: "Ha ocurrido un error favor intentarlo mas tarde.!",
                                type: 'error',
                                padding: '2em'
                            });
                        }
                    }
                });
            }
        </script>
    <?php

}