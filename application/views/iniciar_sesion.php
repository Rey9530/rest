<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include('includes/meta.php')?>
    <link href="<?=base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/assets/css/authentication/form-1.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/assets/css/forms/switches.css">
</head>
<body class="form">
    

    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">Iniciar sesión en <a href="<?=base_url()?>"><span class="brand-name">CORK</span></a></h1> 
                        <form class="text-left" id="form_sesion">
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="usuario" name="usuario" type="text" class="form-control" placeholder="Username">
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="clave" name="clave" type="password" class="form-control" placeholder="Password">
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper toggle-pass">  
                                    </div>
                                    <div class="field-wrapper">
                                        <button  class="btn btn-primary" value="" id="btn_iniciar">Ingresar</button>
                                    </div>
                                    
                                </div> 

                                <div class="field-wrapper">
                                    <a href="<?=base_url()?>assets/auth_pass_recovery.html" class="forgot-pass-link">¿Has olvidado tu contraseña?</a>
                                </div>

                            </div>
                        </form>
                        <?php include('includes/terminos-condiciones.php')?>
                    </div>                    
                </div>
            </div>
        </div>
        <div class="form-image">
            <div class="l-image">
            </div>
        </div>
    </div>

    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="<?=base_url()?>assets/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="<?=base_url()?>assets/bootstrap/js/popper.min.js"></script>
    <script src="<?=base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="<?=base_url()?>assets/assets/js/authentication/form-1.js"></script>
	
	<script>
		$(function() {
            let form_sesion = document.querySelector("#form_sesion");
            form_sesion.addEventListener('submit', function(event){
                event.preventDefault();

                $.ajax({
                    type        : 'POST',
                    url         :  '<?=base_url()?>iniciar_sesion/logueo',
                    data		: $('#form_sesion').serialize(),
                    dataType    : 'json',
                    success: function(data){
                        
                    }
                });
            });
		});
	</script>
</body>
</html>