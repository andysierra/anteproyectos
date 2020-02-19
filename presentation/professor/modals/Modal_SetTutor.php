<?php
?>
<div class="modal fade" id="modal_setTutor" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <h4 class="segan">Asignar un tutor</h4>
                <button class="btn btn-danger" data-dismiss="modal">
                    <span class="fas fa-times"></span>
                </button>
            </div>
            
            <div class="modal-body">
                <div class="w-50 mx-auto">
                    <?php
                        $userId = $_GET['userid'];
                        include "presentation/admin/forms/Form_SetTutor.php"; 
                        ?>
                </div>
            </div>
            
            <div class="modal-footer">
                <p class="segan">El profesor seleccionada figurará como tutor para este anteproyecto.</p>
            </div>
            
        </div>
    </div>
</div>