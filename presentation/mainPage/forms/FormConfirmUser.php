<?php if ($newConfirmation==1) {?>
    
<form action="index.php" method="POST">
    <input type="hidden" name="form_confirm_student" value="<?=$_GET['email_activatestudent']?>"/>
    
    <div class="form-group">
        <label for="form_confirm_student_password">
            <span class="fas fa-key"></span>
            <b class="text-danger">* </b>Ingrese una nueva contraseña: 
        </label>
        <input type="password"
               name="form_confirm_student_password"
               class="form-control"
               maxlength="45"
               pattern="[a-zA-Z0-9]+"
               placeholder="Nueva contraseña"
               oninput="document.getElementById('form_confirm_student_password2').pattern = this.value.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, '\\$&')"
               required/>
    </div>
    <div class="form-group">
        <label for="form_confirm_student_password2">
            <span class="fas fa-key"></span>
            <b class="text-danger">* </b>Repita la contraseña: </label>
        <input type="password"
               name="form_confirm_student_password2"
               id="form_confirm_student_password2"
               title="Ambos campos de contraseña deben coincidir"
               class="form-control"
               maxlength="45"
               pattern="[a-zA-Z0-9]+"
               placeholder="Reptita la contraseña"
               required/>
    </div>
    <div class="form-group">
        <label for="form_confirm_student_email">
            <span class="fas fa-envelope"></span>
            <b class="text-danger">* </b>Correo electónico: </label>
        <input type="email"
               name="form_confirm_student_email"
               class="form-control"
               placeholder="Correo electrónico"
               required/>
    </div>
    <div class="form-group">
        <label for="form_confirm_student_profilepic">
            <span class="fas fa-portrait"></span>
            Imagen de perfil: </label>
        <input type="file" 
               name="form_confirm_student_profilepic"
               value="Ingrese una foto de perfil">
    </div>
    
    <a class="btn btn-danger" href="index.php">Cancelar</a>
    <input type="submit" class="btn btn-success" value="Activar usuario" />
</form>
    
<?php } else if ($newConfirmation==2) {?>
    
<form action="index.php" method="POST">
    <input type="hidden" name="form_confirm_professor" value="<?=$_GET['email_activateprofessor']?>"/>
    
    <div class="form-group">
        <label for="form_confirm_professor_password">
            <span class="fas fa-key"></span>
            <b class="text-danger">* </b>Ingrese una nueva contraseña: 
        </label>
        <input type="password"
               name="form_confirm_professor_password"
               class="form-control"
               maxlength="45"
               pattern="[a-zA-Z0-9]+"
               placeholder="Nueva contraseña"
               oninput="document.getElementById('form_confirm_professor_password2').pattern = this.value.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, '\\$&')"
               required/>
    </div>
    <div class="form-group">
        <label for="form_confirm_professor_password2">
            <span class="fas fa-key"></span>
            <b class="text-danger">* </b>Repita la contraseña: </label>
        <input type="password"
               name="form_confirm_professor_password2"
               id="form_confirm_student_password2"
               title="Ambos campos de contraseña deben coincidir"
               class="form-control"
               maxlength="45"
               pattern="[a-zA-Z0-9]+"
               placeholder="Reptita la contraseña"
               required/>
    </div>
    <div class="form-group">
        <label for="form_confirm_professor_email">
            <span class="fas fa-envelope"></span>
            <b class="text-danger">* </b>Correo electónico: </label>
        <input type="email"
               name="form_confirm_professor_email"
               class="form-control"
               placeholder="Correo electrónico"
               required/>
    </div>
    <div class="form-group">
        <label for="form_confirm_professor_profilepic">
            <span class="fas fa-portrait"></span>
            Imagen de perfil: </label>
        <input type="file" 
               name="form_confirm_professor_profilepic"
               value="Ingrese una foto de perfil">
    </div>
    
    <a class="btn btn-danger" href="index.php">Cancelar</a>
    <input type="submit" class="btn btn-success" value="Activar usuario" />
</form>

<?php } ?>
