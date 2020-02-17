<?php
require_once 'logic/project/Project.php';
require_once 'presentation/admin/modals/Modal_SetTutor.php';


    $infoStudent = new Student($_GET['userid'],
            "",
            "",
            "",
            "",
            "",
            "");
    $infoStudent->retrieveAccountData(true);
       
if(!empty($_GET['selected_professor'])) {
    
}
?>
<script type="text/javascript">
    function grabIdprojects(evt) {
        alert($(evt).attr('id'));
    }
</script>
<body class="">
  
    <div class="container">
        <div class="row">
            
            <div class="card col-12 col-sm-12 col-md-9 col-lg-9
                 mx-auto px-0">                
                <div class="card-header">
                    <h4 class="segan ml-2 p-0">
                        <span class="fas fa-user"></span>
                        &nbsp;<?=$infoStudent->getCol("Nombre Completo")?>
                    </h4>
                </div>
                <table class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th scope="col">
                                ID
                            </th>
                            <th scope="col">
                                Título
                            </th>
                            <th scope="col">
                                Resumen
                            </th>
                            <th scope="col">
                                Planteamiento
                            </th>
                            <th scope="col">
                                Objetivos
                            </th>
                            <th scope="col">
                                PDF
                            </th>
                            <th scope="col">
                                Estado
                            </th>
                            <th scope="col">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <?php
                    if(!empty($infoStudent->getProjectsByStudentId()))
                        foreach($infoStudent->getProjectsByStudentId() as $project) {
                            echo "<tr>";
                                echo "<td>".$project->getIdprojects()."</td>";
                                echo "<td>".$project->getTitle()."</td>";
                                echo "<td>".$project->getAbstract()."</td>";
                                echo "<td>".$project->getProblem_statement()."</td>";
                                echo "<td>".$project->getObjectives()."</td>";
                                echo "<td>".$project->getPdf_url()."</td>";
                                echo "<td id='capita".$project->getIdprojects()."'>".$project->getState()."</td>";
                                
                                echo "<td>";
                                    echo "<a href='#' onclick='grabIdprojects(this)' id='".$project->getIdprojects()."'"
                                            . "data-toggle='modal' data-target='#modal_setTutor'"
                                            . "data-backdrop='static' data-keyboard='false'>";
                                        echo "<span class='fas fa-user-plus'></span>";
                                    echo "</a>";
                                echo "</td>";
                            echo "</tr>";
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>