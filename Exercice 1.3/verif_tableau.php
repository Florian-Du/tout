<?php
    if (isset($_POST["pays"])) {
        header("Location:./tableau.php?Pays=".$_POST["pays"]); 
    }
?>