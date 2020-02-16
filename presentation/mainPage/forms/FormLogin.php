<form action="index.php" method="POST">
    <input type="hidden" name="form_login" value="form_login"/>
    
    <!-- form_login_username -->
    <div class="form-group">
        <label for="form_login_username">
            <span class="fas fa-user"></span>
            Nombre de usuario: 
        </label>
        <input type="text" 
               name="form_login_username" 
               class="form-control"
               maxlength="45"
               required>
    </div>
    
    <!-- form_login_password -->
    <div class="form-group">
        <label for="form_login_password">
            <span class="fas fa-key"></span>
            Contraseña: 
        </label>
        <input type="password" 
               name="form_login_password" 
               class="form-control"
               maxlength="45"
               pattern="[a-zA-Z0-9]+"
               required>
    </div>
    
    <input type="submit" class="btn btn-primary" value="Iniciar Sesión">
    
    <hr>
    
    <a href="#">Has olvidado tu contraseña?</a>
</form>

