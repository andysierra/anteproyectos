<?php
require_once 'logic/project/Project.php';

$infoProject = new Project($_GET['idprojects'],"","","","","","");
$infoProject->retrieveData($_GET['idprojects']);

?>

<body class="">
  
    <div class="container">
        <div class="row">
            
            <div class="card col-12 col-sm-12 col-md-9 col-lg-9
                 mx-auto px-0">                
                <div class="card-header">
                    <h4 class="segan ml-2 p-0">
                        <span class="fas fa-user"></span>
                        &nbsp;<?=$infoProject->getCol("Título")?>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>
                                Título
                            </th>
                            <td>
                                <?=$infoProject->getCol('Título')?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Resumen
                            </th>
                            <td>
                                <?=$infoProject->getCol('Título')?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Planteamiento del problema
                            </th>
                            <td>
                                <?=$infoProject->getCol('Planteamiento')?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Objetivos
                            </th>
                            <td>
                                <?=$infoProject->getCol('Objetivos')?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                PDF
                            </th>
                            <td>
                                <?=$infoProject->getCol('PDF')?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Estado
                            </th>
                            <td>
                                <?=$infoProject->getCol('Estado')?>
                            </td>
                        </tr>
                    </table>
                    <?php 
                        include "presentation/admin/forms/Form_SetTutor.php";
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>