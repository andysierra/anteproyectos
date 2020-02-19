<div class="navbar navbar-expand-lg navbar-light bg-primary sticky-top">
    <div class="col-12 col-sm-12 col-md-8 col-lg-8 px-0
         mx-auto d-flex flex-row justify-content-start">
        
        <ul class="nav d-flex flex-wrap">
            <li class="nav-item mx-2">
                <a href="index.php?tid=<?=base64_encode('presentation/professor/Tab_Home.php')?>" 
                   type="button" class="btn btn-primary tab">
                    <span class="fas fa-home mt-1"></span>
                </a>
            </li>
            <li class="nav-item mx-2">
                <a href="index.php?tid=<?=base64_encode('presentation/professor/Tab_MyProjects.php')?>" 
                   type="button" class="btn btn-primary tab">
                    Mis Proyectos
                </a>
            </li>
            <li class="nav-item mx-2">
                <a href="index.php?tid=<?=base64_encode('presentation/professor/Tab_Settings.php')?>" 
                   type="button" class="btn btn-primary tab">
                    Configuración
                </a>
            </li>
        </ul>
    </div>
</div>