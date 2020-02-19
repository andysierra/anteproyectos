<body class="">
  <!-- ESPACIO PARA ALERTAS -->
<div class="alert alert-danger alert-dismissible fade <?php if($error==10) echo 'show'; else echo 'd-none'; ?>" role="alert">
  <strong>Hay un problema!</strong> No se pudo crear ese nuevo proyecto ya que el título es el mismo a uno ya existente.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="alert alert-success alert-dismissible fade <?php if($error==-10) echo 'show'; else echo 'd-none'; ?>" role="alert">
  <strong>Proyecto creado!</strong> Elija un tutor para que el administrador lo asigne a su nuevo proyecto
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="alert alert-warning alert-dismissible fade <?php if($error==4) echo 'show'; else echo 'd-none'; ?>" role="alert">
  <strong>Mal correo electrónico!</strong> El usuario al que hace referencia el enlace del correo electrónico es inválido, por favor, contáctese con el administrador
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
  
    <div class="container">
        <div class="row" id="tab-content">
            
            <?php
                include $tabid;
            ?>
            
        </div>
    </div>
</body>