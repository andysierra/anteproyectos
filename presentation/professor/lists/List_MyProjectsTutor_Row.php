<?php 
include "presentation/professor/modals/Modal_ProjectInfo.php"; 
?>

<script>
function clickReviewAjax(trigger) {
    var route = "indexAjax.php?sid=<?= base64_encode('presentation/professor/ajax/Ajaxie_Capita.php')?>"+
            "&idprojects="+trigger;
    $('#capita'+trigger).load(route);
}
</script>

<tr>
    <td>
        <a href="#" 
           data-toggle="modal" data-target="#modal_projectinfo<?=$project->getCol($cols[0])?>"
           data-backdrop="static" data-keyboard="false">
            <?=$project->getCol($cols[0]);?>
        </a>
    </td>
    <td>
        <?=$project->getCol($cols[1], true);?>    
    </td>   
    <td>
        <?=$project->getCol($cols[2], true);?>
    </td>
    <td>
        <?=$project->getCol($cols[3], true);?>
    </td>
    <td>
        <?=$project->getCol($cols[4], true);?>
    </td>
    <td>
        <?=$project->getCol($cols[5], true);?>
    </td>
    <td id="capita<?=$project->getCol($cols[0]);?>">
        <?php
            switch($project->getCol($cols[6], true)) {
                case 0:
                    echo "Creado por estudiante";
                    break;
                case 1:
                    echo "Asignado a tutor";
                    break;
                case 2:
                    echo "Revisado por tutor";
                    break;
                case 3:
                    echo "Asignado a jurado";
                    break;
                case 4:
                    echo "Aprobado por jurado";
                    break;
            }
        ?>
    </td>
    <td>
        <a href="#" id="<?=$project->getCol($cols[0])?>" 
           onclick="clickReviewAjax(this.id)"><span class="fas fa-check"></span></a>
    </td>
</tr>