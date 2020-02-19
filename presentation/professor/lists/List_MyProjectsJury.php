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
    
    //echo "GLOBAL SEARCHING FOR FILTER: ".$_GET['filter']."<br>";
    
    if(empty($_GET['filter']))
        $projects = (new Project())->searchByInterest("", $_SESSION['id'], 0);
    else
        $projects = (new Project())->searchByInterest($_GET['filter'], $_SESSION['id'], 0);

?>


<table class="card-body table table-sm table-striped">
    <thead>
        <tr>
            <?php
                foreach($cols as $col)
                    echo "<th scope='col'>".$col."</th>";
            ?>
        </tr>
    </thead>
    <tbody>
        
        <?php
            if($projects != null)
                foreach($projects as $project) {
                    include "List_MyProjectsJury_Row.php";
                }
        ?>
        
    </tbody>
</table>