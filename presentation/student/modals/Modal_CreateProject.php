<div class="modal fade" id="modal_createProject" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <h4 class="segan">Crear nuevo Proyecto</h4>
                <button class="btn btn-danger" data-dismiss="modal">
                    <span class="fas fa-times"></span>
                </button>
            </div>
            
            <div class="modal-body">
                <div class="w-50 mx-auto">
                    <?php include "presentation/student/forms/Form_CreateProject.php"; ?>
                </div>
            </div>
            
            <div class="modal-footer">
                <p class="segan">Por favor, tenga en cuenta que el proyecto puede tener los siguientes
                estados: “Asignado a tutor”, “Revisado por tutor”, “Asignado a Jurado”, “Aprobado por Jurado”.</p>
            </div>
            
        </div>
    </div>
</div>