<!-- ESPACIO PARA ALERTAS -->
<div class="alert alert-danger alert-dismissible fade <?php if($error==1) echo 'show'; else echo 'd-none' ?>" role="alert">
  <strong>Hay un problema!</strong> nombre de usuario o contraseña incorrectos, puede que el usuario se encuentre inactivo
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="alert alert-danger alert-dismissible fade <?php if($error==4) echo 'show'; else echo 'd-none'; ?>" role="alert">
  <strong>Mal correo electrónico!</strong> El usuario al que hace referencia el enlace del correo electrónico es inválido, por favor, contáctese con el administrador
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="alert alert-success alert-dismissible fade <?php if($error==-5) echo 'show'; else echo 'd-none'; ?>" role="alert">
  <strong>Nuevo usuario activo!</strong> Ahora puede iniciar sesión con su nueva cuenta.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="alert alert-danger alert-dismissible fade <?php if($error==5) echo 'show'; else echo 'd-none'; ?>" role="alert">
  <strong>Error al confirmar nuevo usuario!</strong> Por favor contacte con el administrador.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="alert alert-success alert-dismissible fade <?php if($error==-6) echo 'show'; else echo 'd-none'; ?>" role="alert">
  <strong>Nuevo profesor activo!</strong> Ahora puede iniciar sesión con su nueva cuenta.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<!---->

<body style="background: URL('src/img/pattern.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-9 col-lg-6 mx-auto bg-light rounded shadow px-5 py-2">
                <p class="display-4">Iniciar sesión</p>
                <?php include "forms/FormLogin.php" ?>
            </div>
        </div>
    </div>
</body>

