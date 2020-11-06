<?php
    if ((isset($_FILES['file']['name'])&&($_FILES['file']['error'] == UPLOAD_ERR_OK))) {
        move_uploaded_file($_FILES['file']['tmp_name'], "./Image/".$_FILES['file']['name']);
        header("Location:./graphique.php?"); 
    }
?>