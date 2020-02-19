<?php
$role = "";
$sid = "";
    
    $disabled = ($infoProject->getState()==0 && $professor_x_project_turn !=0);
    
    switch($professor_x_project_turn) {
        case 0:
            $role = "tutor";
            break;
        case 1:
            $role = "jurado";
            break;
    }
?>

<script>
    function searchie(){
        var route = "indexAjax.php?sid=<?=base64_encode('presentation/admin/ajax/Ajaxie_Form_SetProfessor.php')?>"+
                    "&filter="+$('#form_set_activeProfessors_search').val()+
                    "&userid=<?=$userid?>&idprojects=<?=$idprojects?>"+
                    "&role=<?=$role?>";
        $('#professorList').load(route);
    }
</script>

<form action="index.php" method="POST" 
      class="rounded shadow p-2 
          <?=($disabled) ? 'bg-secondary' : 'bg-primary' ?> text-light">
    
    <div class="form-group">
        <label for="form_set_activeProfessors_search">
            <span class="fas fa-user-plus"></span>
        </label>
            &nbsp;Seleccione un <?=$role?>:
            <input type="text"
                   class="form-control"
                   name="form_set_activeProfessors_search"
                   id="form_set_activeProfessors_search"
                   oninput="searchie()"
                   autocomplete="off"
                   value=""
                   <?php if($disabled) echo 'disabled'?>/>
            
            <?= (!$disabled) ? "<table class='table table-sm table-striped' id='professorList'></table>" :
                               "<p class='segan minitext'>Selecciona los jurados cuando el estado esté en 'Revisado por el tutor'</p>"
                           ?>
            
            <table class="table table-sm table-striped" id="professorList">
            </table>
    </div>
</form>