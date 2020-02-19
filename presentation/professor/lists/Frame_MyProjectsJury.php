<?php
    $cols = array();
    $cols[0] = "ID";
    $cols[1] = "Título";
    $cols[2] = "Resumen";
    $cols[3] = "Planteamiento";
    $cols[4] = "Objetivos";
    $cols[5] = "PDF";
    $cols[6] = "Estado";
    $cols[7] = "Acciones";
    
?>
<script type="text/javascript">
    function globalSearch(){
        var filter = $('#search_list_projects').val();
        var route = "indexAjax.php?sid=<?=base64_encode('presentation/professor/lists/List_MyProjectsTutor.php')?>&filter="+filter;
        $("#search-lines").load(route);
    }
</script>

<div class="card mx-auto">
    <div class="card-header bg-primary py-1 px-2 d-flex flex-row justify-content-between">
        
        <div class="testgreen flex-shrink-0">
            <!-- EMPTY CREATE BUTTON -->
        </div>
        
        <div class="d-flex flex-row flex-nowrap justify-content-end flex-grow-1">
            <button class="btn btn-sm btn-light py-0">
                <b class="segan">Avanzado</b>
            </button>
            
            <input type="text"
                   name="search_list_projects"
                   id="search_list_projects"
                   class="form-control input-sm minitext ml-2 w-25"
                   pattern="[a-zA-Z0-9]+"
                   placeholder="Buscar"/>
                
            <!-- GLOBAL SEARCH BUTTON -->
            <button class="btn btn-sm btn-light py-0" onclick="globalSearch()">
                <span class="fas fa-search"></span>
            </button>
        </div>    
    </div>
    
    <div id="search-lines">
        <!-- INCLUDING HERE THE LIST WITHOUT FILTER, AJAX WILL INCLUDE THE LIST WITH FILTER -->
        <?php include "List_MyProjectsJury.php"; ?>
    </div>
</div>
