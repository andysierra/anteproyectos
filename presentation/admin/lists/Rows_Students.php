<?php
require_once 'logic/student/Student.php';

$cols = array();
$cols[0] = "ID";
$cols[1] = "Username";
$cols[2] = "Nombre Completo";
$cols[3] = "Correo Electrónico";
$cols[4] = "Activo";

if(empty($_GET['filter']))
    $students = (new Student())->search("");
else
    $students = (new Student())->search($_GET['filter']);
    if($students != null)
        foreach($students as $student)
            include "ListRow_StudentRow.php";

