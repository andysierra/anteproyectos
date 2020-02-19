<?php
require_once 'logic/project/Project.php';
 $cols = array();
    $cols[0] = "ID";
    $cols[1] = "Título";
    $cols[2] = "Resumen";
    $cols[3] = "Planteamiento";
    $cols[4] = "Objetivos";
    $cols[5] = "PDF";
    $cols[6] = "Estado";
    $cols[7] = "Acciones";
    

$projectAjaxieCapita = new Project($_GET['idprojects'],"","","","","","");
$projectAjaxieCapita->retrieveData($_GET['idprojects']);
$projectAjaxieCapita->updateState();

switch($projectAjaxieCapita->getCol($cols[6], true)) {
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