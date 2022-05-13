<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include('includes/meta.php')?>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="<?=base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/assets/css/components/cards/card.css" rel="stylesheet" type="text/css" />  
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/assets/css/forms/theme-checkbox-radio.css">
    <link href="<?=base_url()?>assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/assets/css/apps/contacts.css" rel="stylesheet" type="text/css" />

    <style>
        .btn-flotante {
            font-size: 16px; /* Cambiar el tamaño de la tipografia */
            text-transform: uppercase; /* Texto en mayusculas */
            font-weight: bold; /* Fuente en negrita o bold */
            color: #ffffff; /* Color del texto */
            border-radius: 5px; /* Borde del boton */
            letter-spacing: 2px; /* Espacio entre letras */
            background-color: #E91E63; /* Color de fondo */
            padding: 18px 30px; /* Relleno del boton */
            position: fixed;
            bottom: 40px;
            right: 40px;
            transition: all 300ms ease 0ms;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            z-index: 99;
        }
        .btn-flotante:hover {
            background-color: #2c2fa5; /* Color de fondo al pasar el cursor */
            box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.3);
            transform: translateY(-7px);
        }
        @media only screen and (max-width: 600px) {
            .btn-flotante {
                font-size: 14px;
                padding: 12px 20px;
                bottom: 20px;
                right: 20px;
            }
        }
    </style>     
     
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
            <div class="widget-content widget-content-area">
                <div class="d-flex " style="overflow: auto;width:100%;">
                    <?php 
                    $data_q = $this->db->query('SELECT * FROM categorias WHERE estado=1');
                    foreach ($data_q->result_array() AS $item) {
                        $item = (object) $item; 
                        ?>
                            <div class=" card component-card_2 contenedor_imagen" style="margin:6px;width:200px;min-width: 200px;cursor:pointer;" onclick="cargar_productos(<?=$item->id_categoria?>)">
                                <img src="<?=base_url()?>archivos/categorias/<?=$item->img?>" class="card-img-top" style="height:150px;" alt="widget-card-2">
                                <div class="card-body" style="margin:0px;padding:10px;" >
                                    <h5 style="margin:0px;padding:0px;text-align:center;font-weight:bold;" ><?=$item->descripcion?></h5> 
                                </div>
                            </div>
                        <?php
                    }
                    ?>  
                </div><br><br>
                <h2>Productos</h2>
                <div class="d-flex " style="overflow: auto;width:100%;"  id="html_prodcuto"> 
                    <p class="alert alert-info" style=" width:100%;">Seleccione una categoria</p>
                </div><br><br>
                <h2>Detalle </h2>
                <div  style=" width:100%;" class="widget-content searchable-container list"  >
                    <div  style=" width:100%;" class="searchable-items list" id="html_pedido">
                        <p class="alert alert-info" style=" width:100%;">Sin items agregados</p>
                    </div>
                </div>
                <div class="row">
                    <div class=" col-sm-12 col-lg-3 col-md-3">
                        
                    </div>
                    <div class=" col-sm-12 col-lg-3 col-md-3"><br></div>
                    <div class=" col-sm-12 col-lg-4 col-md-4">  </div>
                    <div class=" col-sm-12 col-lg-2 col-md-2"><br>
                        <button href="#" class="btn btn-primary btn-block" onclick="finalizar_orden()">
                            Finalizar
                        </button>
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
            obtener_detalle_orden();
        });
  
        function finalizar_orden(){
            let tk_cuenta = <?=intval($tk_cuenta)?>;

            swal({
                title: '¿Estas seguro?',
                text: "Esta por finalizar la orden!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Eliminar', 
            }).then(function(result) {
                if (result.value) {  
                    $.ajax({
                        type        : 'POST',
                        url         : '<?=base_url()?>restaurante/mesas/finalizar_orden',
                        data		: {tk_cuenta},
                        dataType    : 'json',
                        success: function(data){
                            if(data.estado==200){  
                                swal({
                                    title: 'Excelente!',
                                    text: data.msj,
                                    type: 'success',
                                    padding: '2em'
                                }).then(function(data) {
                                    location.href = '<?=base_url()?>restaurante/mesas'; 
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
  
        function cargar_productos(tk_=0){
            let input_date = $('#input-date').val()
            let select_categorias = $('#select-categorias').val();
            $.ajax({
                type        : 'POST',
                url         : '<?=base_url()?>restaurante/mesas/cargar_productos',
                dataType    : 'json', 
                data        : {tk_},
                beforeSend:function(data){
                    $("#html_prodcuto").html('<div class="loader dual-loader mx-auto"></div>');
                },
                success: function(resp){ 
                    html_prodcuto(resp.detalle);
                }
            });
        }
        function html_prodcuto(json){ 
            let html = '';
            json.forEach(element => {
                html += `
                    <div class=" card component-card_2 contenedor_imagen" style="margin:6px;width:200px;min-width: 200px;cursor:pointer;" onclick="add_producto(${ element.tk_producto })">
                        <img src="${ element.url }" class="card-img-top" style="height:150px;" alt="widget-card-2">
                        <div class="card-body" style="margin:0px;padding:10px;" >
                            <h6 style="margin:0px;padding:0px;text-align:center;font-weight:bold;" >${ element.nombre }</h6> 
                        </div>
                    </div>
                `; 
            });
            $("#html_prodcuto").html(html);
        }
  
        function obtener_detalle_orden(tk_=0){
            let input_date = $('#input-date').val()
            let select_categorias = $('#select-categorias').val();
            $.ajax({
                type        : 'POST',
                url         : '<?=base_url()?>restaurante/mesas/obtener_detalle_orden',
                dataType    : 'json', 
                data        : {tk_},
                beforeSend:function(data){
                    $("#html_pedido").html('<div class="loader dual-loader mx-auto"></div>');
                },
                success: function(resp){ 
                    obtener_detalle_orden_html(resp.detalle);
                }
            });
        }
        function obtener_detalle_orden_html(json){  
            let html =  `
            <div class="items items-header-section">
                <div class="item-content" style="padding:0px;">
                    <div class="" style="width:40%;"> 
                        <h4>Producto</h4>
                    </div>
                    <div class="user-email text-center" style="width:10%;">
                        <h4 style="margin-left: 0;">Cantidad</h4>
                    </div>
                    <div class="user-phone text-center" style="width:30%; ">
                        <h4 style="margin-left: 3px;">Comentario</h4>
                    </div>
                    <div class="user-location text-center" style="width:10%;">
                        <h4 style="margin-left: 0;">Precio</h4>
                    </div>
                    <div class="user-phone text-center" style="width:10%; ">
                        <h4 style="margin-left: 3px;">Acciones</h4>
                    </div> 
                </div>
            </div>
            `;
            json.forEach(data => {  

                let items_html= '';
                data.detalle_componentes.forEach(item => { 
                    items_html += ` - ${item.nombre} (${item.precio}) <br/>`;
                });
                html += `<div class="items">
                    <div class="item-content">
                        <div class="user-profile" style="width:40%;"> 
                            <img src="${data.url}" alt="avatar">
                            <div class="user-meta-info">
                                <p class="user-name" data-name="${data.nombre}">${data.prodcuto}</p>
                                <p class="user-work" data-descripcion="${data.descripcion}">${items_html}</p>
                            </div>
                        </div>
                        <div class="user-email" style="width:10%;">
                            <p class="info-title">Categoria: </p>
                            <p class="usr-categoria"  >${data.cantidad}</p>
                        </div>
                        <div class="user-phone" style="width:30%; ">
                            <p class="info-title">Estado: </p>
                            <p class="usr-ph-no"  >${data.comentario}</p>
                        </div> 
                        <div class="user-location" style="width:10%;">
                            <p class="info-title">Precio: </p>
                            <p class="usr-location"  > ${data.precio}</p>
                        </div>
                        <div class="action-btn text-center" style="width:10%;">
                            
                            <button class="btn btn-danger text-white" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            </button>
                        
                        </div>
                    </div>
                </div>`; 
            });  
            $("#html_pedido").html(html); 
        }
  
  
        function add_producto(tk_=0){ 
            cargando_swal();
            $.ajax({
                type        : 'POST',
                url         : '<?=base_url()?>restaurante/mesas/add_producto',
                dataType    : 'html', 
                data        : {tk_}, 
                success: function(resp){ 
                    $('#modal').html(resp);
                    $('#modal').modal();
                    cargando_swal(false);
                }
            });
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
          
    </script>
</body>
</html>