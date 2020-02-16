<nav class="navbar navbar-expand-md bg-light sticky-top">
    <div class="col-12 col-sm-12 col-md-9 col-lg-9 px-0
                mx-auto d-flex flex-row justify-content-between">
        
        <div class="flex-shrink-0 mr-2">
            <a class="nav-brand text-primary" href="#">Proyecto 1</a>
        </div>
        
        <div class="collapse navbar-collapse flex-fill overflow-auto px-1" id="collapsible">
            <ul class="navbar-nav border-left">
                <li class="nav-item pl-3">
                    <a class="text-primary" href="#">perro</a>
                </li>
            </ul>
        </div>
        
        <div class="text-center overflow-hidden mx-2">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="text-primary" href="index.php?exit=1"><?=$user->getFullname()?></a>
                </li>
            </ul>
        </div>
        
        <div class="">
            <button class="navbar-toggler py-0" type="button" data-toggle="collapse" data-target="#collapsible">
                <span class="fas fa-ellipsis-h"></span>
            </button>
        </div>
    </div>
        
</nav>