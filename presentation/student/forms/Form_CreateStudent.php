<form action="index.php" method="POST">
    <input type="hidden" name="form_create_student" 
           value="form_create_student"/>
    <div class="form-group">
        <label for="form_create_student_username">
            <span class="fas fa-user"></span>
            Nombre de inicio de sesión: 
        </label>
        <input type="text"
               name="form_create_student_username"
               class="form-control"
               maxlength="45"
               pattern="[a-zA-Z0-9]+"
               placeholder="Nombre de usuario"/>
    </div>
    <div class="form-group">
        <label for="form_create_student_fullname">
            <span class="fas fa-id-card"></span>
            Nombre completo del nuevo estudiante: </label>
        <input type="text"
               name="form_create_student_fullname"
               class="form-control"
               maxlength="45"
               placeholder="Nombre completo"/>
    </div>
    <div class="form-group">
        <label for="form_create_student_program">
            <span class="fas fa-book"></span>
            Carrera del estudiante: </label>
        <input type="text"
               name="form_create_student_program"
               class="form-control"
               maxlength="45"
               placeholder="Programa académico"/>
    </div>
    
    <input type="submit" class="btn btn-primary" value="Crear usuario"/>
</form>