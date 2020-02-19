<form action="index.php" method="POST">
    <input type="hidden" name="form_review_project" value="form_review_project"/>
    <input type="hidden" name="form_review_project_idprojects" value="<?=$project->getIdProjects()?>"/>
    
    <div class="form-group">
        <label for="form_review_project_review">
            <span class="fas fa-feather-alt"></span>
            &nbsp;Observaciones
        </label>
        <textarea class="form-control" 
                  name="form_review_project_review"
                  required></textarea>
    </div>
    
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-success active">
          <input type="radio" 
                 name="form_review_project_approval" 
                 id="form_review_project_approval_yes" 
                 autocomplete="off" 
                 required> 
          <span class="fas fa-thumbs-up"></span>&nbsp;Aprobar
        </label>
        <label class="btn btn-danger">
          <input type="radio" 
                 name="form_review_project_approval" 
                 id="form_review_project_approval_no" 
                 autocomplete="off"
                 required> 
          <span class="fas fa-thumbs-down"></span>&nbsp;Rechazar
        </label>
    </div>
        
    <br>
    <br>
    
    <input type="submit" 
           class="mx-auto btn btn-sm btn-primary"
           value="Marcar como revisado"/>
</form>
