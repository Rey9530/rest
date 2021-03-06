<?php defined('BASEPATH') OR exit('No direct script access allowed');


function table_categoria(){
    $CI =& get_instance();    

    $data = $CI->db->query('SELECT * FROM categorias WHERE estado=1'); 
    ?>
        <div class="table-responsive">
            <table class="table table-bordered mb-4">
                <thead>
                    <tr>
                        <th  class='text-center'>#</th>
                        <th  class='text-center'>Descripci&oacute;n</th>
                        <th  class='text-center'>Imagen</th>
                        <th  class='text-center'>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($data->result_array() as $item) { $i ++;
                        ?> 
                        <tr>
                            <td> <?=$i?> </td>
                            <td> <?=$item['descripcion']?> </td>
                            <td class='text-center'> 
                                <?php
                                    if(!empty($item['img'])){
                                      $url = base_url().'archivos/categorias/'.$item['img'];
                                    }else{
                                        $url = base_url().'archivos/categorias/'.$item['img'] ;
                                    } 
                                ?>
                                
                                <div class="avatar avatar-xl">
                                    <img alt="avatar" src="<?=$url?>" class="rounded" style="width:150px;" />
                                </div>
                            </td>
                            <td class='text-center'> 
                                <button class="btn btn-info" onclick="formulario_categoria(<?=$item['id_categoria']?>);">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                </button>
                                <button class="btn btn-danger" onclick="eliminar_categoria(<?=$item['id_categoria']?>);">
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
                
                    function eliminar_categoria(tk=0){

                        swal({
                            title: '??Estas seguro?',
                            text: "El registro se eliminara completamente!",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Eliminar', 
                        }).then(function(result) {
                            if (result.value) {
                                $.ajax({
                                    type        : 'POST',
                                    url         : '<?=base_url()?>administracion/categorias/eliminar_categoria',
                                    data		: {tk},
                                    dataType    : 'json',
                                    success: function(data){
                                        if(data.estado==200){
                                            $('#modal').modal('hide');
                                            table_categoria();
                                            const toast = swal.mixin({
                                                toast: true,
                                                position: 'top-end',
                                                showConfirmButton: false,
                                                timer: 3000,
                                                padding: '2em'
                                            }); 
                                            toast({
                                                type: 'success',
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
function formulario_categoria($id){
    $CI =& get_instance(); 
    $id = intval($id);
    $data = $CI->db->query('SELECT * FROM categorias WHERE id_categoria='.$id)->result_array(); 
    $descripcion ='';
    $img ='';
    foreach($data AS $item){
        $descripcion = $item['descripcion'];
        $img   = base_url().'archivos/categorias/'.$item['img']; 
    }
    ?> 
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Categoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-lg-12 col-12 mx-auto">
                            <form method="post" id="procesar_categoria" >
                                <div class="form-group">
                                    <p>Descripci&oacute;n</p>
                                    <label for="t-text" class="sr-only">Text</label>
                                    <input type="hidden" name="tk_" id="tk_" value="<?=$id?>">
                                    <input id="descripcion" type="text" name="descripcion" value="<?=$descripcion?>" placeholder="Ingrese una descripcion...." class="form-control" >
                                </div>
                                <div class="form-group">
                                    <div class="custom-file-container" data-upload-id="myFirstImage">
                                        <label>Subir (Un archivo) <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Quitar la imagen">x</a></label>
                                        <label class="custom-file-container__custom-file" >
                                            <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                        </label>
                                        <div class="custom-file-container__image-preview" style="background-image: url('https://www.ngenespanol.com/wp-content/uploads/2018/08/La-primera-imagen-de-la-historia-1280x720.jpg')"></div>
                                    </div>
                                </div>
                            </form>
                        </div>                                        
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="procesar_categoria()" id="procesar_btn">Procesar</button>
                </div>
            </div>
        </div> 
        <script> 
                var firstUpload = new FileUploadWithPreview('myFirstImage',{
                    showDeleteButtonOnImages: true,
                    text: { 
                        chooseFile: 'Choose file...',
                        browse: 'Browse',
                        selectedCount: 'files selected'
                    },
                    maxFileCount: 0,
                    images: {
                        baseImage: '<?=$img?>',
                        backgroundImage: '',
                        successFileAltImage: '',
                        successPdfImage: '', 
                    },
                    presetFiles: [] //  an array of preset images
                });
            function procesar_categoria(){ 
                if($("#descripcion").val().length<4){
                    swal({
                        title: 'Ooops',
                        text: "La descripcion no debe estar vacia!",
                        type: 'error',
                        padding: '2em'
                    });
                    return false;
                }
                var formData = new FormData();
                
                let categoria = $('#descripcion').val(); 
                let tk_ = $('#tk_').val(); 
                formData.append("categoria", categoria);
                formData.append("tk_", tk_);
                if(firstUpload.cachedFileArray.length>0){
                    formData.append("archivo", firstUpload.cachedFileArray[0]);
                }
                $.ajax({
                    type        : 'POST',
                    url         : '<?=base_url()?>administracion/categorias/guardar',
                    data		: formData,
                    cache       : false,
                    contentType : false,
                    processData : false,
                    dataType    : 'json',
                    beforeSend:function(data){
                        $("#procesar_btn").attr('disabled','disabled');
                        $("#procesar_btn").html(' <div class="spinner-border text-white mr-2 align-self-center loader-sm "></div>');
                    },
                    success: function(data){
                        if(data.estado==200){
                            $('#modal').modal('hide');
                            table_categoria();
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