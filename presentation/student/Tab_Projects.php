<div class="card col-12 col-sm-12 col-md-9 col-lg-9
     mx-auto px-0">                
    <div class="card-header py-0">
        <a class="text-primary py-0" href="index.php?tid=<?=base64_encode('presentation/student/Tab_Projects.php')?>">
            Todos los proyectos
        </a>
    </div>
    <div class="card-body px-1 py-2">
        <h4 class="segan ml-2 pb-3">Mis Proyectos</h4>
        <?php 
            include "lists/List_Projects.php";
        ?>
    </div>
</div>
