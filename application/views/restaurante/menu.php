<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include('includes/meta.php')?>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="<?=base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/assets/css/forms/theme-checkbox-radio.css">
    <link href="<?=base_url()?>assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/assets/css/apps/contacts.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->    
</head>
<body>
     
   
    <!--  BEGIN NAVBAR  -->
    <?php include('includes/nav_var.php')?>  
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  --> 
        <?php include('includes/menu/menu.php'); ?> 
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">                
                <div class="row layout-spacing layout-top-spacing" id="cancel-row">
                    <div class="col-lg-12">
                        <div class="widget-content searchable-container list">

                            <div class="row">
                                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 filtered-list-search  align-self-center">
                                    <form class="form-inline my-2 my-lg-0">
                                        <div class="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                            <input type="text" class="form-control product-search" id="input-search" placeholder="Buscar Producto...">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 filtered-list-search  align-self-center d-none">
                                    <form class="form-inline my-2 my-lg-0">
                                        <div class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                            <input type="text" class="form-control product-search  flatpickr flatpickr-input" value="<?=date('d-m-Y')?>" id="input-date" placeholder="Fecha" >
                                        </div>
                                    </form>
                                </div>
                                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 filtered-list-search  align-self-center"> 
                                    <select type="text" class="form-control"  id="select-categorias" placeholder="Fecha" onchange="obtener_menu();"> 
                                        <option value="0">Todas</option>
                                        <?php
                                            $data = $this->db->query('SELECT * FROM categorias WHERE estado=1');
                                            foreach ($data->result_array() AS $item) {
                                                $item = (object)$item;
                                                echo '<option value="'.$item->id_categoria.'">'.$item->descripcion.'</option>';
                                            } 
                                        ?>
                                    </select>  
                                </div>

                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 text-sm-right text-center  align-self-center">
                                    <div class="d-flex justify-content-sm-end justify-content-center">
                                        
                                    </div> 
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 align-self-center">
                                    <br/>
                                </div>
                            </div>
                            <!-----------AQUI INICIA LA TABLA-------------->
                            <div class="searchable-items list" id="table_menu"> 
                                <!-----FIN ITEMS--->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <?php include('includes/footer.php');?>
        </div>
        <!--  END CONTENT AREA  -->
    </div>
        <!-- END MAIN CONTAINER -->
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <?php include('includes/scripts.php'); ?>
    <!-- END GLOBAL MANDATORY SCRIPTS --> 
    <script src="<?=base_url()?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?=base_url()?>assets/assets/js/apps/contact.js"></script>
    <script>
        $(()=>{
            obtener_menu();
            let f1 = flatpickr(document.getElementById('input-date'),{
                enableTime: false,
                dateFormat: "d-m-Y",
            });  
        });
 

        function cambiar_estado_detallado( tk ) {
            let estado = $("#check_"+tk).is(':checked');
            $.ajax({
                type        : 'POST',
                url         : '<?=base_url()?>restaurante/menu/cambiar_estado_detallado',
                dataType    : 'json',
                data        : { tk, estado }, 
                success: function(data){
                    const toast = swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        padding: '2em'
                    });
                    if(data.estado){
                        toast({
                            type: 'success',
                            title: data.msj,
                            padding: '2em',
                        })
                    }else{
                        toast({
                            type: 'error',
                            title: data.msj,
                            padding: '2em',
                        })
                    }
                }
            });
        }
        function cambiar_estado() {

            let estatus =$("#activated").is(':checked');
            let select_categorias = $('#select-categorias').val();
            
            $.each( $(".onclickcheked"), function( key, value ) {
                if($(this).is(':checked')  ){
                    if(!estatus){
                        $(this).click();
                    }
                }else{
                    if(estatus){
                        $(this).click();
                    }
                }
            });

            $.ajax({
                type        : 'POST',
                url         : '<?=base_url()?>restaurante/menu/cambiar_estado',
                dataType    : 'json',
                data        : { estatus, select_categorias }, 
                success: function(data){
                    const toast = swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        padding: '2em'
                    });
                    if(data.estado){
                        toast({
                            type: 'success',
                            title: data.msj,
                            padding: '2em',
                        })
                    }else{
                        toast({
                            type: 'error',
                            title: data.msj,
                            padding: '2em',
                        })
                    }
                }
            });

        }
        function table_menu(datas) {   
            let html =  `
            <div class="items items-header-section">
                <div class="item-content">
                    <div class="" style="width:40%;">
                        <!--<div class="n-chk align-self-center text-center">
                            <label class="new-control new-checkbox checkbox-primary">
                                <input type="checkbox" class="new-control-input" id="contact-check-all">
                                <span class="new-control-indicator"></span>
                            </label>
                        </div>-->
                        <h4>Nombre</h4>
                    </div>
                    <div class="user-email text-center" style="width:10%;">
                        <h4 style="margin-left: 0;">Categoria</h4>
                    </div>
                    <div class="user-location text-center" style="width:10%;">
                        <h4 style="margin-left: 0;">Precio</h4>
                    </div>
                    <div class="user-phone text-center" style="width:10%;display:none;">
                        <h4 style="margin-left: 3px;">Estado</h4>
                    </div>
                    <div class="user-phone text-center" style="width:10%;display:none;">
                        <h4 style="margin-left: 3px;">Unidades</h4>
                    </div>
                    <div class="action-btn text-center" style="width:10%;">
                        <!--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2  delete-multiple"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>-->
                        
                        <label class="switch s-outline s-outline-danger  mb-4 mr-2">
                            <input type="checkbox" onclick="cambiar_estado ()" id="activated">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
            `;
            datas.forEach(data => {  
                html += `<div class="items">
                    <div class="item-content">
                        <div class="user-profile" style="width:40%;">
                            <!--<div class="n-chk align-self-center text-center">
                                <label class="new-control new-checkbox checkbox-primary">
                                <input type="checkbox" class="new-control-input contact-chkbox">
                                <span class="new-control-indicator"></span>
                                </label>
                            </div>-->
                            <img src="${data.url}" alt="avatar">
                            <div class="user-meta-info">
                                <p class="user-name" data-name="${data.nombre}">${data.nombre}</p>
                                <p class="user-work" data-descripcion="${data.descripcion}">${data.descripcion}</p>
                            </div>
                        </div>
                        <div class="user-email" style="width:10%;">
                            <p class="info-title">Categoria: </p>
                            <p class="usr-categoria"  >${data.categoria_descripcion}</p>
                        </div>
                        <div class="user-location" style="width:10%;">
                            <p class="info-title">Precio: </p>
                            <p class="usr-location"  > ${data.precio}</p>
                        </div>
                        <div class="user-phone" style="width:10%;display:none;">
                            <p class="info-title">Estado: </p>
                            <p class="usr-ph-no"  >${data.producto}</p>
                        </div>
                        <div class="user-phone" style="width:10%;display:none;">
                            <p class="info-title">Unidades: </p>
                            <p class="usr-ph-no" data-phone="+1 (070) 123-4567">0</p>
                        </div>
                        <div class="action-btn text-center" style="width:10%;">
                            <!--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 edit"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-minus delete"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                            -->

                            <label class="switch s-outline s-outline-danger  mb-4 mr-2 ">
                                <input type="checkbox" class="onclickcheked" ${data.en_venta} id="check_${data.producto}" onclick="cambiar_estado_detallado(${data.producto})">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>`; 
            });  
            $("#table_menu").html(html); 
            checkall('contact-check-all', 'contact-chkbox');
        }
        function obtener_menu(){
            let input_date = $('#input-date').val()
            let select_categorias = $('#select-categorias').val();
            $.ajax({
                type        : 'POST',
                url         : '<?=base_url()?>restaurante/menu/obtener_menu',
                dataType    : 'json',
                data    : {input_date, select_categorias},
                beforeSend:function(data){
                    $("#table_menu").html('<div class="loader dual-loader mx-auto"></div>');
                },
                success: function(data){
                    table_menu(data.detalle);
                }
            });
        }
    </script>
</body>
</html>