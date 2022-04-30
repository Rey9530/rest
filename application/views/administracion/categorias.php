<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include('includes/meta.php')?>
    <link rel="icon" type="image/x-icon" href="<?=base_url()?>assets/assets/img/favicon.ico"/>
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
    <link href="<?=base_url()?>assets/plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
    
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

    <!--  BEGIN NAVBAR  -->
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="<?=base_url()?>assets/javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">

                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=base_url()?>assets/javascript:void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Analytics</span></li>
                            </ol>
                        </nav>

                    </div>
                </li>
            </ul>
            <ul class="navbar-nav flex-row ml-auto ">
                <li class="nav-item more-dropdown">
                    <div class="dropdown  custom-dropdown-icon">
                        <a class="dropdown-toggle btn" href="<?=base_url()?>assets/#" role="button" id="customDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span>Settings</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="customDropdown">
                            <a class="dropdown-item" data-value="Settings" href="<?=base_url()?>assets/javascript:void(0);">Settings</a>
                            <a class="dropdown-item" data-value="Mail" href="<?=base_url()?>assets/javascript:void(0);">Mail</a>
                            <a class="dropdown-item" data-value="Print" href="<?=base_url()?>assets/javascript:void(0);">Print</a>
                            <a class="dropdown-item" data-value="Download" href="<?=base_url()?>assets/javascript:void(0);">Download</a>
                            <a class="dropdown-item" data-value="Share" href="<?=base_url()?>assets/javascript:void(0);">Share</a>
                        </div>
                    </div>
                </li>
            </ul>
        </header>
    </div>
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
                                    <h4>Listado de categorias </h4>
                                </div>
                                <div class="col-xl-2 col-md-2 col-sm-2 col-2">
                                    <button id="btn_agregar" onclick="formulario_categoria(0)" class="btn btn-primary pull-right btn-block"> Agregar </button>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area" id="table_categorias">
                            
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

    
    <script src="<?=base_url()?>assets/plugins/file-upload/file-upload-with-preview.min.js"></script>
    <script>
        
        $(()=>{
            table_categoria();
        });

        function formulario_categoria(tk=0){
            $.ajax({
                type        : 'POST',
                url         : '<?=base_url()?>administracion/categorias/formulario_categoria',
                data		: {tk},
                dataType    : 'html',
                success: function(data){
                    $("#modal").html(data);
                    $("#modal").modal();
                }
            });
        }

        function table_categoria(){
            $.ajax({
                type        : 'POST',
                url         : '<?=base_url()?>administracion/categorias/table_categoria',
                dataType    : 'html',
                beforeSend:function(data){
                    $("#table_categorias").html('<div class="loader dual-loader mx-auto"></div>');
                },
                success: function(data){
                    $("#table_categorias").html(data); 
                }
            });
        }
    </script>
</body>
</html>