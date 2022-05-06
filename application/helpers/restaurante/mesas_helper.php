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
                        <li class="nav-item">
                            <a class="nav-link" id="border-contact-tab" data-toggle="tab" href="#border-contact" role="tab" aria-controls="border-contact" aria-selected="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> 
                                Contact
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content mb-4" id="border-tabsContent">
                        <div class="tab-pane fade show active" id="cargar_ordenes_cuenta" role="tabpanel" aria-labelledby="cargar_ordenes_cuenta_tab">
                             
                        </div>
                        <div class="tab-pane fade" id="border-profile" role="tabpanel" aria-labelledby="border-profile-tab">
                            <div class="media">
                                <img class="meta-usr-img mr-3" src="assets/img/90x90.jpg" alt="Generic placeholder image">
                                <div class="media-body">
                                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="border-contact" role="tabpanel" aria-labelledby="border-contact-tab">
                            <p class="dropcap  dc-outline-primary">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </p>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <A class="btn btn-primary" href="<?=base_url()?>restaurante/mesas/nueva_orden" target="_blank">  Nueva Orden</A> 
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancelar</button> 
                </div>
            </div>
        </div> 
        <script>
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


    ?> 
    <?php
}