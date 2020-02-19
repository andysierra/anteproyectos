<?php

    $cols = array();
    $cols[0] = "ID";
    $cols[1] = "Username";
    $cols[2] = "Nombre Completo";
    $cols[3] = "Correo Electrónico";
    $cols[4] = "Activo"; 
    
    //echo "GLOBAL SEARCHING FOR FILTER: ".$_GET['filter']."<br>";
    
    if(empty($_GET['filter']))
        $students = (new Student())->search("");
    else
        $students = (new Student())->search($_GET['filter']);

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
            if($students != null)
                foreach($students as $student) {
                    include "List_Students_Row.php";
                }
        ?>
        
    </tbody>
</table>