<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include('includes/meta.php')?> 
    <link href="<?=base_url()?>assets/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?=base_url()?>assets/assets/js/loader.js"></script>
    
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="<?=base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="<?=base_url()?>assets/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>assets/assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    
</head>
<body>
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->
    
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
        
        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                
            <div class="row layout-top-spacing">
                <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-10 col-md-10 col-sm-10 col-10">
                                    <h4>Listado de Mesas </h4>
                                </div>
                                <div class="col-xl-2 col-md-2 col-sm-2 col-2">
                                    <button id="btn_agregar" onclick="formulario_mesa(0)" class="btn btn-primary pull-right btn-block"> Agregar </button>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area" id="table_mesas">
                            
                        </div>
                    </div>
                </div>
                     

                </div>

            </div>

            <?php include('includes/footer.php');?>
        </div>
        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <?php include('includes/scripts.php'); ?>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="<?=base_url()?>assets/plugins/apex/apexcharts.min.js"></script>
    <script src="<?=base_url()?>assets/assets/js/dashboard/dash_2.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script>
        
        $(()=>{
            table_mesa();
        });

        function formulario_mesa(tk=0){
            $.ajax({
                type        : 'POST',
                url         : '<?=base_url()?>administracion/mesas/formulario_mesa',
                data		: {tk},
                dataType    : 'html',
                success: function(data){
                    $("#modal").html(data);
                    $("#modal").modal();
                }
            });
        }

        function table_mesa(){
            $.ajax({
                type        : 'POST',
                url         : '<?=base_url()?>administracion/mesas/table_mesa',
                dataType    : 'html',
                beforeSend:function(data){
                    $("#table_mesas").html('<div class="loader dual-loader mx-auto"></div>');
                },
                success: function(data){
                    $("#table_mesas").html(data); 
                }
            });
        }
    </script>
</body>
</html>