<?php
    header('Location: http://localhost:8000/'.$_POST['entity'].'/'.$_POST['crud_method'].'/'.$_POST['id']);
    exit();
?>