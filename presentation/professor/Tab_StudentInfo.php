<?php
require_once 'logic/project/Project.php';
$userid = $_GET['userid'];
$infoStudent = new Student($_GET['userid'],
        "",
        "",
        "",
        "",
        "",
        "");
$infoStudent->retrieveAccountData(true);   
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
                 mx-auto px-0 ">                
                <div class="card-header">
                    <h4 class="segan ml-2 p-0">
                        <span class="fas fa-user"></span>
                        &nbsp;Proyectos de <?=$infoStudent->getCol("Nombre Completo")?>
                    </h4>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm table-striped m-0">
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

                                $state = "";
                                switch($project->getCol('Estado')) {
                                    case 0:
                                        $state =  "Creado por el estudiante";
                                        break;
                                    case 1:
                                        $state =  "Asignado a tutor";
                                        break;
                                    case 2:
                                        $state =  "Revisado por tutor";
                                        break;
                                    case 3:
                                        $state =  "Asignado a Jurado";
                                        break;
                                    case 4:
                                        $state =  "Aprobado por Jurado";
                                        break;
                                    default:
                                        $state =  "Desconocido";
                                        break;
                                }

                                echo "<tr>";
                                    echo "<td>".$project->getIdprojects()."</td>";
                                    echo "<td>".$project->getTitle()."</td>";
                                    echo "<td>".substr($project->getAbstract(),0,100)."...</td>";
                                    echo "<td>".substr($project->getProblem_statement(),0,100)."...</td>";
                                    echo "<td>".substr($project->getObjectives(),0,100)."...</td>";
                                    echo "<td>".substr($project->getPdf_url(),0,100)."</td>";
                                    echo "<td id='capita".$project->getIdprojects()."'>".$state."</td>";

                                    echo "<td>";
                                        echo "<a href='index.php?tid=". 
                                                base64_encode("presentation/admin/Tab_ProjectInfo.php").
                                                "&idprojects=".$project->getIdprojects()."&userid=".$userid."'>";
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
    </div>
</body>