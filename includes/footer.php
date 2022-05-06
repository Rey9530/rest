
<div class="footer-wrapper">
    <div class="footer-section f-section-1">
        <p class="">Copyright © <?=date('Y')?> <a target="_blank" href="https://designreset.com">DesignReset</a>, Todos los derechos reservados.</p>
    </div>
    <div class="footer-section f-section-2">
        <p class="">Codigo con <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"></div> 
<div class="modal fade bd-example-modal-xl" id="modal_xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true"></div>


<!-- START GLOBAL MANDATORY SCRIPTS -->
<script src="<?=base_url()?>assets/assets/js/libs/jquery-3.1.1.min.js"></script>
<script src="<?=base_url()?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?=base_url()?>assets/bootstrap/js/popper.min.js"></script>
<script src="<?=base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>assets/assets/js/app.js"></script>

<script>
$(document).ready(function() {
    App.init();
});
function cargando_swal (cargando=true){
    if(cargando){
        swal({
            title: 'Procesando!',
            text: 'Por favor espere',  
            allowOutsideClick: false,
            padding: '2em',
            onOpen: function () {
                swal.showLoading()
            }
        }).then(function (result) {
                
        })
    }else{
        swal.close();
    }
}
</script>
<script src="<?=base_url()?>assets/assets/js/custom.js"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<<<<<<< Updated upstream
=======
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=base_url()?>assets/plugins/fullcalendar/moment.min.js"></script>
<script src="<?=base_url()?>assets/plugins/flatpickr/flatpickr.js"></script>
<script src="<?=base_url()?>assets/plugins/fullcalendar/fullcalendar.min.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->


>>>>>>> Stashed changes
<!--  BEGIN CUSTOM SCRIPTS FILE  -->
<script src="<?=base_url()?>assets/assets/js/scrollspyNav.js"></script>
<script src="<?=base_url()?>assets/plugins/select2/custom-select.min.js"></script>
<script src="<?=base_url()?>assets/plugins/select2/bootstrap-select.min.js"></script>
<!--  BEGIN CUSTOM SCRIPTS FILE  -->

<<<<<<< Updated upstream
=======
 

<script src="<?=base_url()?>assets/plugins/input-mask/jquery.inputmask.bundle.min.js"></script>
<script src="<?=base_url()?>assets/plugins/input-mask/input-mask.js"></script>

>>>>>>> Stashed changes
<script src="<?=base_url()?>assets/plugins/font-icons/feather/feather.min.js"></script>

<script src="<?=base_url()?>assets/plugins/sweetalerts/promise-polyfill.js"></script>
<!-- BEGIN THEME GLOBAL STYLE -->
<script src="<?=base_url()?>assets/assets/js/scrollspyNav.js"></script>
<script src="<?=base_url()?>assets/plugins/sweetalerts/sweetalert2.min.js"></script>
<script src="<?=base_url()?>assets/plugins/sweetalerts/custom-sweetalert.js"></script>
<!-- END THEME GLOBAL STYLE -->    

        
<script src="<?=base_url()?>assets/plugins/input-mask/jquery.inputmask.bundle.min.js"></script>
<script src="<?=base_url()?>assets/plugins/fullcalendar/moment.min.js"></script>
<script src="<?=base_url()?>assets/plugins/flatpickr/flatpickr.js"></script>
<script src="<?=base_url()?>assets/plugins/fullcalendar/fullcalendar.min.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<!--  BEGIN CUSTOM SCRIPTS FILE  -->
<!--  END CUSTOM SCRIPTS FILE  -->
<script src="<?=base_url()?>js/agenda/fullcalendar.js?<?=time()?>"></script>