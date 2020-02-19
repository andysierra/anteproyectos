<div class="modal fade" id="modal_createProfessor" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <h4 class="segan">Crear Profesor</h4>
                <button class="btn btn-danger" data-dismiss="modal">
                    <span class="fas fa-times"></span>
                </button>
            </div>
            
            <div class="modal-body">
                <div class="w-50 mx-auto">
                    <?php include "presentation/admin/forms/Form_CreateProfessor.php"; ?>
                </div>
            </div>
            
            <div class="modal-footer">
                <p class="segan">Por favor, tenga en cuenta que el usuario
                                 recibirá un correo electrónico para la activación
                                 de esta nueva cuenta de estudiante.</p>
            </div>
            
        </div>
    </div>
</div>

