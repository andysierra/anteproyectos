<div class="card col-12 col-sm-12 col-md-9 col-lg-9
     mx-auto px-0">                
    <div class="card-header py-0">
        <a class="text-primary py-0" href="index.php?tid=<?=base64_encode('presentation/admin/Tab_Students.php')?>">
            Todos los estudiantes
        </a>
    </div>
    <div class="card-body px-1 py-2">
        <h4 class="segan ml-2 pb-3">Estudiantes</h4>
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
