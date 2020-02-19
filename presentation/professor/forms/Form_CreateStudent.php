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
        <select id="form_create_student_program"
                name="form_create_student_program"
                class="custom-select custom-select-sm"
                required>
            <option disabled selected hidden value=''>Seleccione</option>
            <?php 
                $i=1;
                foreach((new Program("", "", ""))->fetchProgramNames() as $name) {
                    echo "<option value='".$i."'>".$name."</option>";
                    $i++;
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="form_create_student_email">
            <span class="fas fa-envelope"></span>
            Correo electrónico: </label>
        <input type="email"
               name="form_create_student_email"
               class="form-control"
               maxlength="45"
               placeholder="Correo electrónico"
               required/>
    </div>
    
    <input type="submit" class="btn btn-primary" value="Crear usuario"/>
</form>