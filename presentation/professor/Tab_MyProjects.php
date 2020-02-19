<!-- ESPACIO PARA ALERTAS -->

<!---->

<div class="card col-12 col-sm-12 col-md-11 col-lg-11
     mx-auto px-0">                
    
    <div class="card-header py-0">
        <a class="text-primary py-0" 
           href="index.php?tid=<?=base64_encode('presentation/professor/Tab_MyProjects.php')?>&list_name=<?=base64_encode('list_tutor')?>">
            Mis proyectos como tutor
        </a>
        <span>&nbsp&nbsp&nbsp</span>
        <a class="text-primary py-0" 
           href="index.php?tid=<?=base64_encode('presentation/professor/Tab_MyProjects.php')?>&list_name=<?=base64_encode('list_jury')?>">
            Mis proyectos como jurado
        </a>
    </div>
    <div class="card-body px-1 py-2">
        <h4 class="segan ml-2 pb-3"><span class="fas fa-project-diagram"></span>&nbsp;&nbsp;Mis Proyectos</h4>
        <?php 
            if(!empty($_GET['list_name'])) {
                switch(base64_decode($_GET['list_name'])) {
                    case "list_tutor":
                        include "lists/Frame_MyProjectsTutor.php";
                        break;
                    case "list_jury":
                        include "lists/Frame_MyProjectsJury.php";
                        break;
                }
            }
            else include "lists/Frame_MyProjectsHome.php";
        ?>
    </div>
    
</div>
