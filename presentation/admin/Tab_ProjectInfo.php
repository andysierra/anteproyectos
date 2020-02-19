<?php
require_once 'logic/project/Project.php';
require_once 'logic/professor/Professor.php';

$infoProject = new Project($_GET['idprojects'],"","","","","","");
$infoProject->retrieveData($_GET['idprojects']);
$userid = $_GET['userid'];
$idprojects = $_GET['idprojects'];

if(!empty($_GET['selected_professor']))
    $infoProject->updateState(base64_decode($_GET['selected_professor']));
?>

<body class="">
  
    <div class="container">
        <div class="row">
            
            <div class="card col-12 col-sm-12 col-md-10 col-lg-10
                 mx-auto px-0">                
                <div class="card-header">
                    <h4 class="segan ml-2 p-0">
                        <span class="fas fa-project-diagram"></span>
                        &nbsp;<?=$infoProject->getCol("Título")?>
                    </h4>
                </div>
                <div>
                    <div class="py-2 px-4 m-1 border-bottom">
                        <p class="segan minifont">
                            <b>Estado:&nbsp;&nbsp;</b>
                                <?php
                                    switch($infoProject->getCol('Estado')) {
                                        case 0:
                                            echo "Creado por el estudiante";
                                            break;
                                        case 1:
                                            echo "Asignado a tutor";
                                            break;
                                        case 2:
                                            echo "Revisado por tutor";
                                            break;
                                        case 3:
                                            echo "Asignado a Jurado";
                                            break;
                                        case 4:
                                            echo "Aprobado por Jurado";
                                            break;
                                        default:
                                            echo "Desconocido";
                                            break;
                                    }
                                ?>
                        </p>
                    </div>
                    <div class="card-body d-flex flex-row flex-nowrap justify-content-between">
                        <table class="table table-striped flex-grow-1">
                            <tr>
                                <th>
                                    Título
                                </th>
                                <td class="">
                                    <?=$infoProject->getCol('Título')?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Resumen
                                </th>
                                <td>
                                    <?=$infoProject->getCol('Resumen',true)?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Planteamiento del problema
                                </th>
                                <td>
                                    <?=$infoProject->getCol('Planteamiento',true)?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Objetivos
                                </th>
                                <td>
                                    <?=$infoProject->getCol('Objetivos',true)?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    PDF
                                </th>
                                <td>
                                    <a href="#"><?=$infoProject->getCol('PDF')?></a>
                                </td>
                            </tr>
                        </table>

                        <div class="ml-2 pl-2 border-left flex-shrink-0">
                            <?php
                            
                                // PROJECT'S TUTOR SELECTION
                                $professor_x_project_turn = 0;
                            
                                if($infoProject->getTutor()!=null) {
                                    $selectedTutor = new Professor($infoProject->getTutor(),'','','','','','');
                                    $selectedTutor->retrieveAccountData(true);
                                    echo ""
                                            . "<p><span class='fas fa-chalkboard-teacher'></span>"
                                            . "&nbsp;<b>Tutor: </b>"
                                            . "<a href='#'>"
                                            . "".$selectedTutor->getFullname().""
                                            . "</a>"
                                            . "</p>";
                                }
                                else {
                                    // SI ESTE PROYECTO NO TIENE UN TUTOR ASIGNADO
                                    echo "<p class='segan'>"
                                            . "<span class='fas fa-exclamation-circle'></span>"
                                            . "&nbspEste proyecto no tiene un tutor asignado"
                                       . "</p>";
                                    include "presentation/admin/forms/Form_SetProfessor_x_Project.php";
                                }
                                
                                
                                // PROJECT'S JURIES SELECTION
                                $professor_x_project_turn = 1;
                                
                                $juries = $infoProject->getJury();
                                if(!empty($juries)) {
                                    echo "<p><span class='fas fa-user-plus'></span>Jurados de este proyecto</p>"
                                        . "<table class='table table-sm table-striped'>";
                                    
                                    foreach($juries as $jury) {
                                        $juryProfessor = new Professor($jury, "","","","","","");
                                        $juryProfessor->retrieveAccountData(true);
                                        echo ""
                                            . "<tr>"
                                                . "<a href='#'>"
                                                    . $juryProfessor->getFullname()
                                                . "</a>"
                                            . "</tr>";
                                    }
                                    
                                    echo "</table>";
                                    
                                    if(count($juries)<=3) 
                                        include "presentation/admin/forms/Form_SetProfessor_x_Project.php";
                                }
                                else {
                                    if($infoProject->getState()>1){
                                        echo ""
                                        . "<p class='segan minitext'>"
                                                . "<span class='fas fa-exclamation-circle'></span>&nbsp"
                                                . "No hay jurados seleccionados para este proyecto"
                                        . "</p>";
                                        include "presentation/admin/forms/Form_SetProfessor_x_Project.php";
                                    }
                                    else echo ""
                                        . "<p class='segan minitext'>"
                                                . "<span class='fas fa-exclamation-circle'></span>&nbsp"
                                                . "Aún no puedes seleccionar jurados para este proyecto"
                                        . "</p>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>