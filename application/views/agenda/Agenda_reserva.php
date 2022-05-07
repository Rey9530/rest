<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="es">
    <head>  
	    <?php include('includes/meta.php')?>   
	    <?php include('includes/header.php')?>
        <!--  END CUSTOM STYLE FILE  -->          
    </head>
    <body>
        <?php include('includes/nav_var.php')?>
        <!--  BEGIN NAVBAR  -->
        <div class="sub-header-container">
            <header class="header navbar navbar-expand-sm">
                <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>
                <ul class="navbar-nav flex-row">
                    <li>
                        <div class="page-header">
                            <nav class="breadcrumb-one" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Agenda</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><span>Calendario</span></li>
                                </ol>
                            </nav>
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

            <?=include('includes/menu/menu.php')?>
            
            <!--  BEGIN CONTENT AREA  -->
            <div id="content" class="main-content">
                <div class="layout-px-spacing">
                    <div class="row layout-top-spacing" id="cancel-row">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-content widget-content-area">
                                    <div class="calendar-upper-section">
                                        <div class="row">
                                            <div class="col-md-3 col-12">
                                                <!--aqui pondremos el selector de las sucursales-->
                                                <label>Sucursales:</label>
                                                <select id="sucursal" class="form-control form-control-lg">
                                                    <?php echo $sucursal; ?>
                                                </select>
                                            </div>                                                
                                            <div class="col-md-9 col-12">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>

                        <!-- The Modal -->
                        <div id="modal-celandario" class="modal animated zoomInUp custo-zoomInUp"> </div>
                        <div id="modal-whatsapp" class="modal animated rotateInDownLeft custo-rotateInDownLeft"> </div>
                    </div>
                </div>
                <?php include('includes/footer.php'); ?>
            </div>
        </div>
        <!--  END CONTENT AREA  -->

        <script src="<?=base_url()?>js/agenda/Agenda_eventos.js?<?=time()?>"></script>
        <script src="<?=base_url()?>js/agenda/fullcalendar.js?<?=time()?>"></script>
    </body>
</html>