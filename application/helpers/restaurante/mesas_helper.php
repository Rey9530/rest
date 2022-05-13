<?php defined('BASEPATH') OR exit('No direct script access allowed');
function agregar_a_mesa($id_mesa){
    $CI =& get_instance();

    $CI->db->where("id_mesa",$id_mesa);
    $data = $CI->db->get("mesas")->result_array();
    if(count($data)==0){
        echo "<h3>Ooops a ocurrido algo</h3>";
        return;
    }
    $data = $data[0];
    ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Asignar a: <?=$data['descripcion']?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="col-12">
                        <form method="post" id="asignar_a_mesa" >
                            <div class="form-group">
                                <p>Cliente</p>
                                <label for="t-text" class="sr-only">Text</label> 
                                <input id="cliente" type="text" name="cliente" value="N/A" placeholder="Ingrese una descripcion...." class="form-control" >
                                <input id="id_mesa" type="hidden" name="id_mesa" value="<?=$id_mesa?>" placeholder="Ingrese una descripcion...." class="form-control" >
                                
                            </div>
                            <div class="form-group">
                                <p>Cantidad</p>
                                <label for="t-text" class="sr-only">Text</label>
                                <input id="cantidad" type="number" name="cantidad" value="1" placeholder="Ingrese la Cantidad" class="form-control" required> 
                            </div>
                            <div class="form-group">
                                <p>Observaci&oacute;n</p>
                                <label for="t-text" class="sr-only">Text</label> 
                                <textarea id="observacion" type="text" name="observacion" value="N/A" placeholder="Ingrese una Observaci&oacute;n...." class="form-control" ></textarea>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn"   data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="asignar_mesa()" id="procesar_btn">Asignar</button>
                </div>
            </div>
        </div> 
        <script> 
            function asignar_mesa(){ 
                if($("#cliente").val().length<3){
                    swal({
                        title: 'Ooops',
                        text: "El cliente no debe estar vacio!",
                        type: 'error',
                        padding: '2em'
                    });
                    return false;
                }
                $.ajax({
                    type        : 'POST',
                    url         : '<?=base_url()?>restaurante/mesas/asignar_mesa',
                    data		: $("#asignar_a_mesa").serialize(),
                    dataType    : 'json',
                    beforeSend:function(data){
                        $("#procesar_btn").attr('disabled','disabled');
                        $("#procesar_btn").html(' <div class="spinner-border text-white mr-2 align-self-center loader-sm "></div>');
                    },
                    success: function(data){
                        if(data.estado==200){
                            $('#modal').modal('hide');
                            obtener_mesas();
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
        </script> 
    <?php
}


function detalle_cuenta($tk_cuenta){
    $CI =& get_instance();
 

    
    $CI->db->select('mc.*,m.*');
    $CI->db->from('mesas m');
    $CI->db->join('mesas_cuentas mc', 'mc.id_mesa = m.id_mesa'); 
    $CI->db->where("id_cuenta",$tk_cuenta);
    $data = $CI->db->get()->result_array();

    if(count($data)==0){
        echo "<h3>Ooops a ocurrido algo</h3>";
        return;
    }
    $data = (object) $data[0];
    ?>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cuenta de: <span style="font-weight:bold;"> <?=$data->descripcion?></span>, Cliente: <span style="font-weight:bold;"><?=$data->cliente?> </span> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body  border-tab widget-content widget-content-area"> 
                        
                    <ul class="nav nav-tabs mt-3" id="border-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="cargar_ordenes_cuenta_tab" data-toggle="tab" href="#cargar_ordenes_cuenta" role="tab" aria-controls="cargar_ordenes_cuenta" aria-selected="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                                Ordenes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="border-profile-tab" data-toggle="tab" href="#border-profile" role="tab" aria-controls="border-profile" aria-selected="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-align-justify"><line x1="21" y1="10" x2="3" y2="10"></line><line x1="21" y1="6" x2="3" y2="6"></line><line x1="21" y1="14" x2="3" y2="14"></line><line x1="21" y1="18" x2="3" y2="18"></line></svg>
                                Detalle
                            </a>
                        </li> 
                    </ul>
                    <div class="tab-content mb-4" id="border-tabsContent">
                        <div class="tab-pane fade show active" id="cargar_ordenes_cuenta" role="tabpanel" aria-labelledby="cargar_ordenes_cuenta_tab">
                            <!-------------------------------------------============================================================--->
                             
                            <!-------------------------------------------============================================================--->
                        </div>
                        <div class="tab-pane fade" id="border-profile" role="tabpanel" aria-labelledby="border-profile-tab">
                            <div class="media"> 
                                <div class="media-body row">
                                    <div class="col-12">

                                        <h3>Proximamente</h3>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div> 
                </div>
                <div class="modal-footer">
                    <A class="btn btn-primary" href="<?=base_url()?>restaurante/mesas/nueva_orden/<?=$tk_cuenta?>"  >  Nueva Orden</A> 
                    <button class="btn btn-danger" onclick="finalizar_cuenta(<?=$tk_cuenta?>)">Firnalizar Cuenta</button>
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancelar</button> 
                </div>
            </div>
        </div> 
        <script>
            
            function finalizar_cuenta(tk_cuenta){ 
                swal({
                    title: '¿Estas seguro?',
                    text: "Esta por finalizar la orden!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar', 
                }).then(function(result) {
                    if (result.value) {  
                        cargando_swal();
                        $.ajax({
                            type        : 'POST',
                            url         : '<?=base_url()?>restaurante/mesas/finalizar_cuenta',
                            data		: {tk_cuenta},
                            dataType    : 'json',
                            success: function(data){
                                cargando_swal(false);
                                if(data.estado==200){  
                                    $('#modal').modal('hide');
                                    if(window.obtener_mesas){
                                        obtener_mesas();
                                    }
                                    swal({
                                        title: 'Excelente!',
                                        text: data.msj,
                                        type: 'success',
                                        padding: '2em'
                                    }).then(function(data) {
                                        // location.href = '<?=base_url()?>restaurante/mesas'; 
                                    })
                                }else{ 
                                    swal({
                                        title: 'Ooops!',
                                        text: data.msj,
                                        type: 'error',
                                        padding: '2em'
                                    }).then(function(data) {
                                        console.log(data);
                                    })
                                }
                            }
                        });
                    }
                }); 
            }
            function cargar_ordenes_cuenta(tk){ 
                $.ajax({
                    type        : 'POST',
                    url         : '<?=base_url()?>restaurante/mesas/cargar_ordenes_cuenta',
                    data		: {tk},
                    dataType    : 'html', 
                    beforeSend:function(data){
                        cargando_swal();
                    },
                    success: function(data){  
                        cargando_swal(false);
                        $("#cargar_ordenes_cuenta").html(data);
                    }
                });
                 
            }

            cargar_ordenes_cuenta(<?=$tk_cuenta?>)
        </script> 
    <?php
}



function cargar_ordenes_cuenta($tk_cuenta){
    $CI =& get_instance();
    $i =0;

    ?>
    
    <div id="iconsAccordion" class="accordion-icons">
    <?php
    $data = $CI->db->where('id_cuenta='.intval($tk_cuenta))->get('ordenes_restaurante')->result_array();
    foreach ($data AS $item) { $i++;
        $item = (object) $item; 
        ?>
        <div class="card">
            <div class="card-header" id="headingOne3_<?=$item->id_orden?>">
                <section class="mb-0 mt-0">
                    <div role="menu" class="collapsed" data-toggle="collapse" data-target="#iconAccordionOne_<?=$item->id_orden?>" aria-expanded="false" aria-controls="iconAccordionOne_<?=$item->id_orden?>">
                        <div class="accordion-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
                        Orden #<?=$i?>
                        <div class="icons">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                    </div>
                </section>
            </div>

            <div id="iconAccordionOne_<?=$item->id_orden?>" class="collapse" aria-labelledby="headingOne3_<?=$item->id_orden?>" data-parent="#iconsAccordion">
                <div class="card-body table-responsive" style="word-wrap: break-word;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Plato</th>
                                <th>Cantidad</th>
                                <th>Extras</th>
                                <th>Precio</th>
                                <th>Sub Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php
                        $e=0;
                        $data = $CI->db->query('SELECT *,ordenes_restaurante_detalle.estado AS estado_detalle FROM ordenes_restaurante_detalle 
                        INNER JOIN productos ON productos.id_producto=ordenes_restaurante_detalle.id_producto
                        WHERE id_orden='.intval($item->id_orden))->result_array();
                        foreach ($data AS $detalle) {
                            $e ++;
                            $detalle = (object) $detalle; 
                            $html_componente='';
                            if($detalle->ids_complementos!=''){ 
                                $porciones = explode(",", $detalle->ids_complementos);
                                $ids = implode(",", $porciones); 
                                
                                $data = $CI->db->query('SELECT * FROM productos_componentes_detalle  
                                WHERE id_componente_detalle IN ('.$ids.')')->result_array();
                                foreach ($data AS $componenet) {
                                    $html_componente .= '-'.$componenet['descripcion'].'<br>';
                                }
                            }
                            ?>
                                <tr>
                                    <td><?=$e?></td>
                                    <td><?=$detalle->nombre?></td>
                                    <td><?=$detalle->cantidad?></td>
                                    <td><?=$html_componente?></td>
                                    <td><?=$detalle->precio?></td>
                                    <td><?=$detalle->sub_total?></td>
                                    <td>
                                        <?php if($detalle->estado_detalle==1){ ?>
                                            <button class="btn btn-danger" onclick="eliminar_detalle(<?=$detalle->id_detalle?>)"> 
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-square"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="9" x2="15" y2="15"></line><line x1="15" y1="9" x2="9" y2="15"></line></svg>    
                                            </button> 
                                        <?php }else{ ?>
                                            <label class="badge bg-warning">Eliminado</label>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php
                        }
                
                    ?></tbody>
                    </table>

                </div>
            </div>
        </div>
        <script>
            function eliminar_detalle(detalle){ 
                swal({
                    title: '¿Estas seguro?',
                    text: "Esta por eliminar el item seleecionado!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar', 
                }).then(function(result) {
                    if (result.value) {  
                        $.ajax({
                            type        : 'POST',
                            url         : '<?=base_url()?>restaurante/mesas/eliminar_detalle',
                            data		: {detalle},
                            dataType    : 'json',
                            success: function(data){
                                if(data.estado==200){  
                                    agregar_a_mesa(0,<?=$tk_cuenta?>);
                                    swal({
                                        title: 'Excelente!',
                                        text: data.msj,
                                        type: 'success',
                                        padding: '2em'
                                    }).then(function(data) {
                                        
                                    })
                                }else{ 
                                    swal({
                                        title: 'Ooops!',
                                        text: data.msj,
                                        type: 'error',
                                        padding: '2em'
                                    }).then(function(data) {
                                        console.log(data);
                                    })
                                }
                            }
                        });
                    }
                }); 
            }
        </script>
 

    <?php  }
    ?> </div><?php
}


function add_producto($tk_producto){
    $CI =& get_instance(); 

    $CI->db->where("id_producto",$tk_producto);
    $data = $CI->db->get("productos")->result_array(); 
    if(count($data)==0){
        echo "<h3>Ooops a ocurrido algo</h3>";
        return;
    }
    $data = $data[0];
    ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?=$data['nombre']?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="col-12">
                        <p><?= nl2br($data['descripcion'])?></p>
                    </div>
                    <div class="col-12">
                        <form action="return false;" id="form_add_producto">
                            <input type="hidden" name="tk_producto" id="tk_producto" value="<?=$tk_producto?>">
                            <?php
                                $i=0;
                                $query_components = $CI->db->where('id_producto',$tk_producto)->where('estado=1')->get('productos_componentes')->result_array(); 
                                foreach ($query_components AS $item) { $i ++;
                                    ?>
                                    <div class="form-group">
                                        <p><?=$item['nombre']?></p>
                                        <select name="componente_<?=$i?>" id="componente_<?=$i?>" class="form-control">
                                            <?php
                                                $query_components_d = $CI->db->where('id_componente',$item['id_componenete'])->get('productos_componentes_detalle')->result_array(); 
                                                foreach ($query_components_d AS $item_d) {
                                                    echo "<option value='".$item_d['id_componente_detalle']."'>".$item_d['descripcion']." (+".number_format($item_d['precio'],2).")</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <?php 
                                }
                            ?>
                            <input type="hidden" name="contador" id="contador" value="<?=$i?>">
                            <div class="form-group">
                                <p>Cantidad</p>
                                <input type="text" id="cantidad" name="cantidad" class="form-control" value="1">
                            </div>
                            <div class="form-group">
                                <p>Comentario</p>
                                <textarea type="text" id="comentario" name="comentario" class="form-control" ></textarea>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn"   data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="agregar_al_detalle()" id="procesar_btn">Agregar</button>
                </div>
            </div>
        </div> 
        <script> 
            function agregar_al_detalle(){ 
                if(!$("#cantidad").val()>0){
                    swal({
                        title: 'Ooops',
                        text: "La cantidad minima debe ser 1!",
                        type: 'error',
                        padding: '2em'
                    });
                    return false;
                }
                $.ajax({ 
                    type        : 'POST',
                    url         : '<?=base_url()?>restaurante/mesas/agregar_al_detalle',
                    data		: $("#form_add_producto").serialize(),
                    dataType    : 'json',
                    beforeSend:function(data){
                        cargando_swal();
                    },
                    success: function(data){
                        if(data.estado==200){
                            cargando_swal(false);
                            $('#modal').modal('hide');
                            obtener_detalle_orden();
                            const toast = swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1500,
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
        </script> 
    <?php
}