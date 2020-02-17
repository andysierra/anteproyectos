<form action="index.php" method="POST">
    <input type="hidden" name="form_create_project" 
           value="form_create_project"/>
    
    <div class="form-group">
        <label for="form_create_project_title">
            <span class="fas fa-heading"></span>
            Título: 
        </label>
        <input type="text"
               name="form_create_project_title"
               class="form-control"
               maxlength="400"
               placeholder="Título del proyecto"
               required/>
    </div>
    
    <div class="form-group">
        <label for="form_create_project_abstract">
            <span class="fas fa-book-reader"></span>
            Abstract: 
        </label>
        <textarea class="form-control"
                  name="form_create_project_abstract"></textarea>
    </div>
    
    <div class="form-group">
        <label for="form_create_project_problem_statement">
            <span class="fas fa-hammer"></span>
            Planteamiento del problema: 
        </label>
        <textarea class="form-control"
                  name="form_create_project_problem_statement"></textarea>
    </div>
    
    <div class="form-group">
        <label for="form_create_project_objectives">
            <span class="fas fa-tasks"></span>
            Objetivos: 
        </label>
        <textarea class="form-control"
                  name="form_create_project_objectives"></textarea>
    </div>
    
    <div class="form-group">
        <label for="form_create_project_pdf_url">
            <span class="fas fa-heading"></span>
            Archivo PDF: 
        </label>
        <input type="file"
               name="form_create_project_pdf_url"
               class="form-control"
               required/>
    </div>
    
    <input type="submit" class="btn btn-primary" value="Crear Proyecto"/>
</form>