<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Prenom:<?php echo $_POST["prenom"];?><br />
    Nom:<?php echo $_POST["nom"];?><br />
    <?php echo $_POST["champ1"]; ?>
    <?php echo $_POST["champ2"]; ?>
    <?php echo $_POST["pays"]; ?>
    <?php
    if (isset($_POST["pay"])) {
        print_r($_POST["pay"]); 
    }
    else {
        echo "<p> Aucun pays selectionner </p>";
    }
    ?>
    <?php
    if (isset($_POST["payss"])) {
        print_r($_POST["payss"]); 
    }
    else {
        echo "<p> Aucun pays selectionner </p>";
    }
     ?>
     <?php echo $_POST["payy"]; ?>
</body>
</html>
