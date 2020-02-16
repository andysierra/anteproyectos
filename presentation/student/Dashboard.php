<body class="">
  <!-- ESPACIO PARA ALERTAS -->
<div class="alert alert-warning alert-dismissible fade <?php if($error==4) echo 'show'; else echo 'd-none'; ?>" role="alert">
  <strong>Mal correo electrónico!</strong> El usuario al que hace referencia el enlace del correo electrónico es inválido, por favor, contáctese con el administrador
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
  <!---->
  
    <div class="container">
        <div class="row">
            
            <div class="card col-12 col-sm-12 col-md-9 col-lg-9
                 mx-auto px-0">                
                <div class="card-header py-0">
                    <a class="text-primary py-0" href="#">PrimeraListaEstudiante</a>
                    <a class="text-primary py-0 ml-3" href="#">SegundaListaEstudiante</a>
                </div>
                <div class="card-body px-1 py-2">
                    <h4 class="segan ml-2 pb-3">Proyectos</h4>
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
        </div>
    </div>
</body>