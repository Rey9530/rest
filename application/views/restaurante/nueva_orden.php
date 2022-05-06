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
    <link href="<?=base_url()?>assets/assets/css/components/timeline/custom-timeline.css" rel="stylesheet" type="text/css" />
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
            <div class="widget-content widget-content-area">
                <div class="post-gallery-img d-flex" style="overflow: auto;width:100%;">
                    <?php 
                    $data_q = $this->db->query('SELECT * FROM categorias WHERE estado=1');
                    foreach ($data_q->result_array() AS $item) {
                        $item = (object) $item; 
                        ?> 

                        <div class="card component-card_2">
                            <img src="<?=base_url()?>archivos/categorias/<?=$item->img?>" class="card-img-top" alt="widget-card-2">
                            <div class="card-body">
                                <h5 class="card-title">CLI Based</h5> 
                            </div>
                        </div>
                        <?php
                    }
                    ?>  
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
            // obtener_mesas();
        });
  
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