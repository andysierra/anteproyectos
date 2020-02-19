<div class="card col-12 col-sm-12 col-md-9 col-lg-9
     mx-auto px-0">                
    <div class="card-header py-0">
        <a class="text-primary py-0" href="#">Todos los estudiantes</a>
        <a class="text-primary py-0 ml-3" href="#">Estudiantes y proyectos</a>
    </div>
    <div class="card-body px-1 py-2">
        <h4 class="segan ml-2 pb-3">Configuración</h4>
        <?php 
            if(!empty($_GET['list_name']))
            {
                if(base64_decode($_GET['list_name']) == 'list_students_projects')
                    include "lists/List_Students_Projects.php";
            }
            else include "lists/List_Students.php";
        ?>
    </div>
</div>
