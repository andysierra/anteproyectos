<script>
    function searchie(){
        var route = "indexAjax.php?sid=<?=base64_encode('presentation/admin/ajax/Ajaxie_ProfessorList.php')?>"+
                "&filter="+$('#form_set_tutor_search').val()+"&userid=<?=$userId?>";
        $('#professorList').load(route);
    }
</script>

<form action="index.php" method="POST">
    <input type="hidden" name="form_set_tutor" value="form_set_tutor">
    <div class="form-group">
        <label for="form_set_tutor_search">
            <span class="fas fa-user-plus"></span>
            &nbsp;Buscar profesor
            <input type="text"
                   class="form-control"
                   name="form_set_tutor_search"
                   id="form_set_tutor_search"
                   oninput="searchie()"/>
            
            <table class="table table-sm table-striped" id="professorList">
            </table>
        </label>
    </div>
</form>