<div>
    <table class="table table-sm table-striped">
        <?php
            $professorList = (new Professor())->staticListAllProfessorsByPair("fullname",$_GET['filter']);
            if(!empty($professorList))
                foreach($professorList as $professor) {
                    echo "<tr>";
                        echo "<td>";
                            echo "<a href='index.php?tid=".
                                    base64_encode('presentation/admin/Tab_StudentInfo.php').
                                    "&selected_professor=".$professor->getCol("Nombre Completo")."&userid=".$_GET['userid']."'>".
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
