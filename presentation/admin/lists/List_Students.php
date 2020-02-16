<?php include "presentation/admin/modals/Modal_CreateStudent.php"; ?>

<div class="card mx-auto">
    <div class="card-header bg-primary py-1 px-2 d-flex flex-row justify-content-between">
        
        <div class="testgreen flex-shrink-0">
            <button class="btn btn-sm btn-light py-0" data-toggle="modal" data-target="#modal_createStudent"
                    data-backdrop="static" data-keyboard="false">
                <b class="segan">Crear Estudiante</b>
            </button>
        </div>
        
        <div class="d-flex flex-row flex-nowrap justify-content-end flex-grow-1">
            <button class="btn btn-sm btn-light py-0">
                <b class="segan">Avanzado</b>
            </button>
            
            <input type="text"
                   name="search_list_students"
                   class="form-control input-sm minitext ml-2 w-25"
                   pattern="[a-zA-Z0-9]+"
                   placeholder="Buscar"/>
                
            <button class="btn btn-sm btn-light py-0">
                <span class="fas fa-search"></span>
            </button>
        </div>
        
    </div>
    <div class="card-body">
        
    </div>
</div>