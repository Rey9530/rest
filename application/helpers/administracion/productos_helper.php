<?php defined('BASEPATH') OR exit('No direct script access allowed');


function table_producto(){
    $CI =& get_instance();    

    $data = $CI->db->query('SELECT productos.*,categorias.descripcion AS categoria_descripcion FROM productos INNER JOIN categorias ON categorias.id_categoria=productos.id_categoria WHERE productos.estado=1'); 
    ?>
        <div class="table-responsive">
            <table class="table table-bordered mb-4">
                <thead>
                    <tr>
                        <th class='text-center'>#</th>
                        <th class='text-center'>Nombre</th>
                        <th class='text-center'>Precio</th>
                        <th class='text-center'>Categoria</th>
                        <th class='text-center'>Imagen</th>
                        <th class='text-center'>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($data->result_array() as $item) { $i ++;
                        ?> 
                        <tr>
                            <td class='text-center'> <?=$i?> </td>
                            <td class='text-center'> <?=$item['nombre']?> </td>
                            <td class='text-center'> <?=$item['precio']?> </td>
                            <td class='text-center'> <?=$item['categoria_descripcion']?> </td>
                            <td class='text-center'> 
                                <?php
                                    if(!empty($item['img'])){
                                        $url = base_url().'archivos/productos/'.$item['img'];
                                    }else{
                                        $url = base_url().'archivos/productos/'.$item['img'] ;
                                    } 
                                    ?>
                                
                                <div class="avatar avatar-xl">
                                    <img alt="avatar" src="<?=$url?>" class="rounded" style="width:150px;" />
                                </div>
                            </td>
                            <td class='text-center'> 
                                <button class="btn btn-info" onclick="formulario_producto(<?=$item['id_producto']?>);">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                </button>
                                <button class="btn btn-primary" onclick="componentes_producto(<?=$item['id_producto']?>);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
                                </button>
                                <button class="btn btn-danger" onclick="eliminar_producto(<?=$item['id_producto']?>);">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                </button>
                            </td>
                        </tr>
                        <?php
                    }
                    ?> 
                </tbody>
            </table> 
        </div>
        <script>


        function componentes_producto(tk=0){
            $.ajax({
                type        : 'POST',
                url         : '<?=base_url()?>administracion/productos/componentes_producto',
                data		: {tk},
                dataType    : 'html',
                beforeSend:function(data){
                    cargando_swal()
                },
                success: function(data){
                    cargando_swal(false)
                    $("#modal").html(data);
                    $("#modal").modal();
                }
            });
        }

        
        function eliminar_producto(tk=0){

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
                        url         : '<?=base_url()?>administracion/productos/eliminar_producto',
                        data		: {tk},
                        dataType    : 'json',
                        success: function(data){
                            if(data.estado==200){
                                $('#modal').modal('hide');
                                table_producto();
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
    <?php
}


function formulario_producto($id){
    $CI =& get_instance(); 
    $id = intval($id);
    $data = $CI->db->query('SELECT * FROM productos WHERE id_producto='.$id)->result_array(); 
    $descripcion ='';
    $precio =0;
    $id_categoria =0;
    $img ='';
    $nombre = '';
    foreach($data AS $item){
        $nombre = $item['nombre'];
        $descripcion = $item['descripcion'];
        $precio = $item['precio'];
        $id_categoria = $item['id_categoria'];
        $img   = base_url().'archivos/productos/'.$item['img']; 
    }
    ?> 
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-lg-12 col-12 mx-auto">
                            <form method="post" id="procesar_producto" autocomplete="off" >
                                <div class="form-group">
                                    <p>Nombre</p>
                                    <label for="t-text" class="sr-only">Text</label>
                                    <input type="hidden" name="tk_" id="tk_" value="<?=$id?>">
                                    <input id="nombre" type="text" name="nombre" value="<?=$nombre?>" placeholder="Ingrese un nombre...." class="form-control" >
                                </div>
                                <div class="form-group">
                                    <p>Descripci&oacute;n</p>
                                    <label for="t-text" class="sr-only">Text</label>
                                    <textarea id="descripcion" type="text" name="descripcion" value="<?=$descripcion?>" placeholder="Ingrese una descripcion...." class="form-control" ></textarea>
                                </div>
                                <div class="form-group">
                                    <p>Precio</p>
                                    <label for="t-text" class="sr-only">Text</label> 
                                    <input id="precio" type="number" step='0.01' name="precio" value="<?=$precio?>" placeholder="Ingrese un precio...." class="form-control" >
                                </div>
                                <div class="form-group">
                                    <p>Categoria</p>
                                    <label for="t-text" class="sr-only">Text</label> 
                                    <select id="categoria" name="categoria" class="form-control" >
                                        <?php
                                            $data = $CI->db->query('SELECT * FROM categorias WHERE estado=1')->result_array(); 
                                            foreach ($data AS $value) {
                                                $selected = ($value['id_categoria']==$id_categoria)?'selected':'';
                                                echo '<option '.$selected.' value="'.$value['id_categoria'].'">'.$value['descripcion'].'</option>';
                                            }
                                        ?>
                                    </select>
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
                    <button type="button" class="btn btn-primary" onclick="procesar_producto()" id="procesar_btn">Procesar</button>
                </div>
            </div>
        </div> 
        <script> 
                var firstUpload = new FileUploadWithPreview('myFirstImage',{
                    showDeleteButtonOnImages: true,
                    text: { 
                        chooseFile: 'Seleccione Archivo...',
                        browse: 'Browse',
                        selectedCount: 'Seleccione Archivos...'
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
            function procesar_producto(){ 
                if($("#nombre").val().length<4){
                    swal({
                        title: 'Ooops',
                        text: "El nombre muyy corto!",
                        type: 'error',
                        padding: '2em'
                    });
                    return false;
                }
                var formData = new FormData();
                
                let producto = $('#descripcion').val(); 
                let precio = $('#precio').val(); 
                let categoria = $('#categoria').val(); 
                let tk_ = $('#tk_').val(); 
                let nombre = $('#nombre').val(); 
                formData.append("producto", producto);
                formData.append("tk_", tk_);
                formData.append("categoria", categoria);
                formData.append("precio", precio);
                formData.append("nombre", nombre);
                if(firstUpload.cachedFileArray.length>0){
                    formData.append("archivo", firstUpload.cachedFileArray[0]);
                }
                $.ajax({
                    type        : 'POST',
                    url         : '<?=base_url()?>administracion/productos/guardar',
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
                            table_producto();
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

function load_componente($id=0){
    $CI =& get_instance(); 
    $id = intval($id);
    $data = $CI->db->query('SELECT * FROM productos_componentes WHERE estado=1 AND id_producto='.$id)->result_array();  
    ?>
    <div id="toggleAccordion">
        <?php
            foreach ($data AS $item) {
                $item = (object) $item;
                ?>
                    <div class="card">
                        <div class="card-header" id="headingOne<?=$item->id_componenete?>" >
                            <section class="mb-0 mt-0">
                            <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAccordion<?=$item->id_componenete?>" aria-expanded="true" aria-controls="defaultAccordion<?=$item->id_componenete?>">
                            <a href="#" onclick="load_componente_detalle(<?=$item->id_componenete?>)">
                                <?=$item->nombre?> 
                            </a>    
                                 <div class="icons">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                     
                                     <button class="btn btn-danger" onclick="eliminar_componente(<?=$item->id_componenete?>)" style="padding:5px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                     </button>
                                </div>
                            </div>
                            </section>
                        </div> 
                        <div id="defaultAccordion<?=$item->id_componenete?>" class="collapse" aria-labelledby="headingOne<?=$item->id_componenete?>" data-parent="#toggleAccordion">
                            <div class="card-body row">
                                  <div class="col-12"  style="padding:0px;" >  
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="componente_name_detalle_<?=$item->id_componenete?>" id="componente_name_detalle_<?=$item->id_componenete?>" placeholder="Ingrese descripcion...">
                                            <input type="number" class="form-control" name="precio_<?=$item->id_componenete?>" id="precio_<?=$item->id_componenete?>" placeholder="Ingrese precio..."> 
                                            <button class="btn btn-outline-info" type="button" id="btn_add_componente" onclick="btn_add_componente_detalle(<?=$item->id_componenete?>)">Guardar</button>
                                        </div> 
                                  </div>
                                  <div class="col-12" id="load_componente_detalle<?=$item->id_componenete?>">

                                  </div>
                            </div>
                        </div>
                    </div>
                <?php
            }
        ?>
         
    </div>
    <script>
        function btn_add_componente_detalle(tk){ 
                if($("#componente_name_detalle_"+tk).val().length<4){
                    swal({
                        title: 'Ooops',
                        text: "El nombre muy corto!",
                        type: 'error',
                        padding: '2em'
                    });
                    return false;
                }
                let formData = {
                    componente_name_detalle_: $("#componente_name_detalle_"+tk).val(),
                    precio_: $('#precio_'+tk).val() ,
                    tk_:tk 
                };
                  
                
                $.ajax({
                    type        : 'POST',
                    url         : '<?=base_url()?>administracion/productos/btn_add_componente_detalle',
                    data		: formData,
                    dataType    : 'json', 
                    beforeSend:function(data){
                        cargando_swal();
                    },
                    success: function(data){ 
                        cargando_swal(false);
                        if(data.estado==200){ 
                            $("#componente_name_detalle_"+tk).val('')
                            $("#precio_"+tk).val('')
                            load_componente_detalle(tk ); 
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
        function load_componente_detalle(tk){ 
            $.ajax({
                type        : 'POST',
                url         : '<?=base_url()?>administracion/productos/load_componente_detalle',
                data		: {tk},
                dataType    : 'html', 
                beforeSend:function(data){
                    cargando_swal();
                },
                success: function(data){  
                    cargando_swal(false);
                    $("#load_componente_detalle"+tk).html(data);
                }
            });
        } 
        
        function eliminar_componente(tk=0){

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
                        url         : '<?=base_url()?>administracion/productos/eliminar_componente',
                        data		: {tk},
                        dataType    : 'json',
                        success: function(data){
                            if(data.estado==200){ 
                                load_componente(<?=$id?>);
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
    <?php
}

function load_componente_detalle($id=0){
    $CI =& get_instance(); 
    $id = intval($id);
    $data = $CI->db->query('SELECT * FROM productos_componentes_detalle WHERE estado=1 AND id_componente='.$id)->result_array();  
    ?> 
    <table class="table">
        <tr>
            <td>Descripci&oacute;n</td>
            <td>Precio</td>
            <td>Accion</td>
        </tr>
        <?php
            foreach ($data AS $item) {
                $item = (object) $item;
                ?>
                    <tr>
                        <td><?=$item->descripcion?></td>
                        <td><?=$item->precio?></td>
                        <td>
                            <button class="btn btn-danger" onclick="eliminar_detalle_componente(<?=$item->id_componente_detalle?>)" style="padding:5px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>    
                        </td>
                    </tr>
                     
                <?php
            }
        ?>
        </table> 
    <script>
          
        
        function eliminar_detalle_componente(tk=0){

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
                        url         : '<?=base_url()?>administracion/productos/eliminar_detalle_componente',
                        data		: {tk},
                        dataType    : 'json',
                        success: function(data){
                            if(data.estado==200){ 
                                load_componente_detalle(<?=$id?>);
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
    <?php
}

function componentes_producto($id=0){
    $CI =& get_instance(); 
    $id = intval($id);
    $data = $CI->db->query('SELECT * FROM productos WHERE id_producto='.$id)->result_array(); 
    $descripcion ='';
    $precio =0;
    $id_categoria =0;
    $img ='';
    $nombre = '';
    foreach($data AS $item){
        $nombre = $item['nombre'];
        $descripcion = $item['descripcion'];
        $precio = $item['precio'];
        $id_categoria = $item['id_categoria'];
        $img   = base_url().'archivos/productos/'.$item['img']; 
    }
    ?> 
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Componentes de: <?=$nombre?> </h5>
                    <br>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body"> 
                    <p style="margin:0px;padding:0px;" class="text-muted"><?=$descripcion?></p><br>
                    <div class="row">
                        <div class="col-12 mx-auto">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Nombre</span>
                                <input type="text" class="form-control" name="componente_name" id="componente_name">
                                <input type="hidden" class="form-control" name="tk_" id="tk_" value="<?=$id?>">
                                <button class="btn btn-outline-info" type="button" id="btn_add_componente" onclick="btn_add_componente()">Guardar</button>
                            </div>
                        </div>      
                        <div class="col-12" id="load_componente">

                        </div>                                  
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="procesar_producto()" id="procesar_btn">Procesar</button>
                </div>
            </div>
        </div>
        <script>

            function load_componente(tk){ 
                $.ajax({
                    type        : 'POST',
                    url         : '<?=base_url()?>administracion/productos/load_componente',
                    data		: {tk},
                    dataType    : 'html', 
                    beforeSend:function(data){
                        cargando_swal();
                    },
                    success: function(data){  
                        cargando_swal(false);
                        $("#load_componente").html(data)
                    }
                });
            }
            load_componente(<?=$id?>);
            function btn_add_componente(){ 
                if($("#componente_name").val().length<4){
                    swal({
                        title: 'Ooops',
                        text: "El nombre muy corto!",
                        type: 'error',
                        padding: '2em'
                    });
                    return false;
                }
                let formData = {
                    componente_name: $('#componente_name').val(),
                    tk_: $('#tk_').val() 
                };
                  
                
                $.ajax({
                    type        : 'POST',
                    url         : '<?=base_url()?>administracion/productos/guardar_componente',
                    data		: formData,
                    dataType    : 'json', 
                    beforeSend:function(data){
                        cargando_swal();
                    },
                    success: function(data){ 
                        cargando_swal(false);
                        if(data.estado==200){ 
                            $('#componente_name').val('');
                            load_componente($('#tk_').val() ); 
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