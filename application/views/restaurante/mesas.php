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
    <link href="<?=base_url()?>assets/assets/css/components/cards/card.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/assets/css/components/tabs-accordian/custom-accordions.css" rel="stylesheet" type="text/css" />
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
    <script>
        $(()=>{
            obtener_mesas();
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
        function table_mesa(datas) {   
            let html =  '';
            datas.forEach(data => {  
                html += `
                    <div class="col-sm-6 col-md-4 col-lg-3 p-1   " onclick="agregar_a_mesa(${data.tk_mesa},${data.tk_cuenta});" > 
                        <div class="card component-card_7 shadow" style="width:100%;cursor:pointer;background-color:${data.background};" >
                            <div class="card-body">
                                <h5 class="card-text">${data.descripcion} </h5>
                                <h6 class="rating-count">${data.estado} </h6>
                                <div class="rating-stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                    <span class="r-rating-num">${data.capacidad}</span>
                                </div>
                            </div>
                        </div> 
                    </div> 
                `; 
            });  
            $("#cancel-row").html(html);  
        }
        function obtener_mesas(){
            let input_date = $('#input-date').val()
            let select_categorias = $('#select-categorias').val();
            $.ajax({
                type        : 'POST',
                url         : '<?=base_url()?>restaurante/mesas/obtener_mesas',
                dataType    : 'json', 
                beforeSend:function(data){
                    $("#cancel-row").html('<div class="loader dual-loader mx-auto"></div>');
                },
                success: function(data){
                    table_mesa(data.detalle);
                }
            });
        }
        
        function agregar_a_mesa(tk_=0,tk_c){  
            $.ajax({
                type        : 'POST',
                url         : '<?=base_url()?>restaurante/mesas/agregar_a_mesa',
                dataType    : 'html', 
                data        : { tk_, tk_c },
                beforeSend:function(data){
                    $("#modal").html(`
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <p class="modal-text">
                                    <div class="loader dual-loader mx-auto"></div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    `);
                    $("#modal").modal();
                },
                success: function(data){ 
                    $("#modal").html(data);
                }
            });
        }
        function detalles_mesa(tk_=0){  
            $.ajax({
                type        : 'POST',
                url         : '<?=base_url()?>restaurante/mesas/detalles_mesa',
                dataType    : 'html', 
                data        : { tk_ },
                beforeSend:function(data){
                    $("#modal_xl").modal();
                    $("#modal_xl").html(`
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <p class="modal-text">
                                    <div class="loader dual-loader mx-auto"></div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    `);
                },
                success: function(data){ 
                    $("#modal_xl").html(data);
                }
            });
        }
    </script>
</body>
</html>