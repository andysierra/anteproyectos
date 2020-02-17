<body class="">
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
<div class="alert alert-warning alert-dismissible fade <?php if($error==4) echo 'show'; else echo 'd-none'; ?>" role="alert">
  <strong>Mal correo electrónico!</strong> El usuario al que hace referencia el enlace del correo electrónico es inválido, por favor, contáctese con el administrador
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
  
    <div class="container">
        <div class="row" id="tab-content">
            
            <?php
                include base64_decode($tabid);
            ?>
            
        </div>
    </div>
</body>