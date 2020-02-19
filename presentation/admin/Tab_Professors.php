<!-- ESPACIO PARA ALERTAS -->
    <div class="alert alert-danger alert-dismissible fade <?php if($error==2) echo 'show'; else echo 'd-none'; ?>" role="alert">
      <strong>Hay un problema!</strong> El nombre de usuario ya existe!, vuelva a intentar con otro nombre de usuario.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="alert alert-success alert-dismissible fade <?php if($error==-2) echo 'show'; else echo 'd-none'; ?>" role="alert">
      <strong>Usuario creado!</strong> Se le ha enviado un correo electrónico para establecer una contraseña y activar el usuario
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
<!---->

<div class="card col-12 col-sm-12 col-md-9 col-lg-9
     mx-auto px-0">                
    <div class="card-header py-0">
        <a class="text-primary py-0" href="#">Todos los profesores</a>
    </div>
    <div class="card-body px-1 py-2">
        <h4 class="segan ml-2 pb-3">Profesores</h4>
        <?php 
            if(!empty($_GET['list_name']))
            {
                if(base64_decode($_GET['list_name']) == 'list_professors_projects')
                    include "lists/List_Professors_Projects.php";
            }
            else include "lists/List_Professors.php";
        ?>
    </div>
</div>
