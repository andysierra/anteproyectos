<div>
    <table class="table table-sm table-striped">
        <?php
            $professorList = (new Professor())->staticAdvancedSearch(array("fullname" => $_GET['filter'], "active" => 1));
            if(!empty($professorList))
                foreach($professorList as $professor) {
                    echo "<tr>";
                        echo "<td>";
                            echo "<a href='index.php?tid=".
                                    base64_encode('presentation/admin/Tab_ProjectInfo.php').
                                    "&selected_professor=".base64_encode($professor->getCol("ID"))."&userid=".$_GET['userid'].""
                                    . "&idprojects=".$_GET['idprojects']."'"
                                    . "class='text-light'>".
                                        $professor->getCol("Nombre Completo").
                                    "</a>";
                        echo "</td>";
                    echo "</tr>";
                }
            else {
                echo "<tr>";
                    echo "<td>";
                        echo "No hay registros";
                    echo "</td>";
                echo "</tr>";
            }
        ?>
    </table>
</div>
