<?php
    if (isset($_POST['number'])) {
        header("Location:./formulaire.php?Nombre=".$_POST["number"]); 
    }
?>