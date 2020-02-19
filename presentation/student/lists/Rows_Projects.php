<?php
require_once 'logic/project/Project.php';

$cols = array();
    $cols[0] = "ID";
    $cols[1] = "Título";
    $cols[2] = "PDF";
    $cols[3] = "Estado";

if(empty($_GET['filter']))
    $projects = (new Project())->searchByStudent("", $_SESSION['id'], 1);
else
    $projects = (new Project())->searchByStudent($_GET['filter'], $_SESSION['id'], 1);
    
if($projects != null)
    foreach($projects as $project)
        include "ListRow_ProjectRow.php";