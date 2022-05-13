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

                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-one">
                            <div class="widget-heading">
                                <h6 class="">Statistics</h6>

                                <div class="task-action">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="<?=base_url()?>assets/#" role="button" id="pendingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="pendingTask" style="will-change: transform;">
                                            <a class="dropdown-item" href="<?=base_url()?>assets/javascript:void(0);">View</a>
                                            <a class="dropdown-item" href="<?=base_url()?>assets/javascript:void(0);">Download</a>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="w-chart">

                                <div class="w-chart-section total-visits-content">
                                    <div class="w-detail">
                                        <p class="w-title">Total Visits</p>
                                        <p class="w-stats">423,964</p>
                                    </div>
                                    <div class="w-chart-render-one">
                                        <div id="total-users"></div>
                                    </div>
                                </div>
                                
                                
                                <div class="w-chart-section paid-visits-content">
                                    <div class="w-detail">
                                        <p class="w-title">Paid Visits</p>
                                        <p class="w-stats">7,929</p>
                                    </div>
                                    <div class="w-chart-render-one">
                                        <div id="paid-visits"></div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="w-header">
                                    <div class="w-info">
                                        <h6 class="value">Capacidad del Restaurante</h6>
                                    </div>
                                    <div class="task-action">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="<?=base_url()?>assets/#" role="button" id="pendingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="pendingTask" style="will-change: transform;">
                                                <a class="dropdown-item" href="<?=base_url()?>assets/javascript:void(0);">This Week</a>
                                                <a class="dropdown-item" href="<?=base_url()?>assets/javascript:void(0);">Last Week</a>
                                                <a class="dropdown-item" href="<?=base_url()?>assets/javascript:void(0);">Last Month</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
 
                                <?php
                                    
                                    $query = $this->db->query('SELECT COUNT(*) AS capacidad FROM mesas WHERE estado=1')->result_array();
                                    $mesas_total = (count($query)>0)?$query[0]['capacidad']:0;
                                    $porsentaje = 0;
                                    $query = $this->db->query('SELECT COUNT(*) AS capacidad FROM mesas_cuentas INNER JOIN mesas ON mesas_cuentas.id_mesa=mesas.id_mesa WHERE mesas_cuentas.estado=1')->result_array();
                                    $valor = (count($query)>0)?$query[0]['capacidad']:0;
                                    if($valor>0 && $mesas_total>0){
                                        $porsentaje = ($valor*100)/$mesas_total;
                                    }
                                ?>
                                <div class="w-progress-stats">                                            
                                    <div class="progress">
                                        <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: <?=$porsentaje?>%" aria-valuenow="<?=$porsentaje?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                    <div class="">
                                        <div class="w-icon">
                                            <p><?=$porsentaje?>%</p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-account-invoice-two">
                            <div class="widget-content">
                                <div class="account-box">
                                    <div class="info">
                                        <div class="inv-title">
                                            <h5 class="">Total Balance</h5>
                                        </div>
                                        <div class="inv-balance-info">
                                            <?php
                                                $query = $this->db->query('SELECT SUM(sub_total) AS total FROM ordenes_restaurante_detalle WHERE estado=1')->result_array();
                                                $venta = (count($query)>0)?$query[0]['total']:0;
                                            
                                            ?>
                                            <p class="inv-balance">$ <?=$venta?></p> 
                                        </div>
                                    </div> 
                                </div>
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

</body>
</html>