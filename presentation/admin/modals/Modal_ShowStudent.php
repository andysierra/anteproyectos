<?php
    require_once 'logic/student/Student.php';
?>
<div class="modal fade" id="modal_showStudent" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <h4><span class="fas fa-user"></span></h4>
                <h4 class="segan" id="titulo"></h4>
                <button class="btn btn-danger" data-dismiss="modal">
                    <span class="fas fa-times"></span>
                </button>
            </div>
            
            <div class="modal-body">
                <div class="">
                    <?php
                         echo "<p>".$_GET['modal_showstudent_id']."</p>";
                    ?>
                </div>
            </div>

        </div>
    </div>
</div>