<?php
require_once 'presentation/admin/modals/Modal_ShowStudent.php';
?>

<tr>
    <td>
        <a href="index.php?tid=<?=base64_encode('presentation/admin/Tab_StudentInfo.php')?>&userid=<?=$student->getCol($cols[0]);?>">
            <?=$student->getCol($cols[0]);?>
        </a>
    </td>
    <td>
        <?=$student->getCol($cols[1]);?>
    </td>
    <td>
        <?=$student->getCol($cols[2]);?>
    </td>
    <td>
        <?=$student->getCol($cols[3]);?>
    </td>
    <td>
        <?=$student->getCol($cols[4]);?>
    </td>
</tr>

<script type="text/javascript">
    $('#modal_showStudent').on('show.bs.modal', (event)=>{
        $('#titulo').text($(event.relatedTarget).attr('data-fullname'));
    });
</script>