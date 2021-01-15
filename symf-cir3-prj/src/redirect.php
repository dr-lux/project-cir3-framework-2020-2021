<?php
    if ($_POST['crud_method'] == 'edit')
    {
        header('Location: http://localhost:8000/'.$_POST['entity'].'/'.$_POST['crud_method'].'/check/'.$_POST['id']);
    }
    else
    {
        header('Location: http://localhost:8000/'.$_POST['entity'].'/'.$_POST['crud_method'].'/'.$_POST['id']);
    }
    exit();
?>