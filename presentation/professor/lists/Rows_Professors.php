<?php
require_once 'logic/professor/Professor.php';

$cols = array();
$cols[0] = "ID";
$cols[1] = "Username";
$cols[2] = "Nombre Completo";
$cols[3] = "Correo Electrónico";
$cols[4] = "Activo";

if(empty($_GET['filter']))
    $professors = (new Professor())->search("");
else
    $professors = (new Professor())->search($_GET['filter']);
    if($professors != null)
        foreach($professors as $professor)
            include "ListRow_ProfessorRow.php";

