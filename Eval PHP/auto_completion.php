<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto ville</title>
</head>
<body>
    <!-- Formulaire pour l'auto complete -->
    <form action="verif_auto_ville.php" method="POST" name="formulaire">
        <input list="pays" type="text">
        <datalist id="pays">
            <?php
                $tableau = file('villes.txt');
                for ($i=0; $i < 3; $i++) { 
                    echo '<option value='.$tableau[$i].'>'.$tableau[$i].'</option>';
                }
            ?>
        </datalist>
    </form>
</body>
</html>