<!-- ESPACIO PARA ALERTAS -->
<div class="alert alert-warning alert-dismissible fade <?php if($error==3) echo 'show'; else echo 'd-none' ?>" role="alert">
  <strong>Alerta!</strong> La sesión que tenías abierta ha sido cerrada
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<!---->

<body style="background: URL('src/img/pattern.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-9 col-lg-6 mx-auto bg-light rounded shadow px-5 py-2">
                <h1 class="segan">Activación de nuevo usuario</h1>
                <hr>
                <p class="segan">
                    <?php if($newConfirmation==1) 
                        echo "Por favor, diligencie estos datos para activar su nueva cuenta de estudiante.";
                        else
                        echo "Por favor, diligencie estos datos para activar su nueva cuenta de profesor."?>
                </p>
                <?php include "forms/FormConfirmUser.php" ?>
            </div>
        </div>
    </div>
</body>

