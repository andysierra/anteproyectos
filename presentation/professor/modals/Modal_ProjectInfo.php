<?php 
require_once 'logic/project/Project.php';
    $studentInfo = new Student ($project->getIdCreator(), "","","","","","");
    $studentInfo->retrieveAccountData(true); 
?>

<div class="modal fade" id="modal_projectinfo<?=$project->getIdprojects()?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            
            <div class="modal-header pb-0 mb-0">
                <div>
                    <h4 class="segan ml-2 p-0">
                        <span class="fas fa-project-diagram"></span>
                        &nbsp;<?=$project->getCol("Título")?>
                    </h4>

                    <h6 class="segan text-muted">
                        <em>
                            Creado por el estudiante <a href="#"><?=$studentInfo->getFullname()?></a>
                        </em>
                    </h6>
                    
                    <p class="segan minifont my-0 py-0">
                        <b>Estado:&nbsp;&nbsp;</b>
                            <?php
                                switch($project->getCol('Estado')) {
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
                    <small><b>PDF:</b></small>
                    <a href="#"><small><?=$project->getPdf_url()?></small></a>
                </div>
                
                <button class="btn btn-danger" data-dismiss="modal">
                    <span class="fas fa-times"></span>
                </button>
                
            </div>
            
            <div class="modal-body d-flex flex-row flex-nowrap">
                
                <div class="mx-auto d-flex flex-column w-75">
                    <div class="d-flex flex-row flex-nowrap mt-2">
                        <div class="text-right pr-2" style="width: 20%;">
                            <small><b>Título:</b></small>
                        </div>
                        <div style="width: 75%" class="pr-1">
                            <small class="segan"><?=$project->getCol('Título')?></small>
                        </div>
                    </div>
                    <div class="d-flex flex-row flex-nowrap mt-2">
                        <div class="text-right pr-2" style="width: 20%;">
                            <small><b>Resumen:</b></small>
                        </div>
                        <div style="width: 75%" class="pr-1">
                            <small class="segan"><?=$project->getAbstract()?></small>
                        </div>
                    </div>
                    <div class="d-flex flex-row flex-nowrap mt-2">
                        <div class="text-right pr-2" style="width: 20%;">
                            <small><b>Planteamiento del problema:</b></small>
                        </div>
                        <div style="width: 75%" class="pr-1">
                            <small class="segan"><?=$project->getProblem_statement()?></small>
                        </div>
                    </div>
                    <div class="d-flex flex-row flex-nowrap mt-2">
                        <div class="text-right pr-2" style="width: 20%;">
                            <small><b>Objetivos:</b></small>
                        </div>
                        <div style="width: 75%" class="pr-1">
                            <small class="segan"><?=$project->getObjectives()?></small>
                        </div>
                    </div>
                </div>
                
                <div class="">
                    
                    <?php
                    if($project->getTutor()!=null) {
                        $selectedTutor = new Professor($project->getTutor(),'','','','','','');
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
                    }
                    
                    $juries = $project->getJury();
                    if(!empty($juries)) {
                        echo "<p><span class='fas fa-user-plus'></span>Jurados de este proyecto</p>"
                            . "<ul>";
                        
                        foreach($juries as $jury) {
                            $juryProfessor = new Professor($jury, "","","","","","");
                            $juryProfessor->retrieveAccountData(true);
                            echo ""
                                . "<li>"
                                    . "<a href='#'>"
                                        . $juryProfessor->getFullname()
                                    . "</a>"
                                . "</li>";
                        }
                        
                        echo "</ul>";
                    }
                    else {
                        echo "<p><span class='fas fa-exclamation-circle'></span>"
                            . "Este proyecto no tiene jurados</p>";
                    }
                    ?>
                    
                </div>
                
            </div>
        </div>
    </div>
</div>

