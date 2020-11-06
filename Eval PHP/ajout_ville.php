<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout ville</title>
</head>
<body>
    <!-- formulaire pour ajouter des villes dans le villes.txt -->
    <?php
        session_start();
        if ($_SESSION['login'] == 'true') {
            echo '  <form action="verif_ajout_ville.php" method="POST" name="formulaire">
                        <input type="text" name="Ville" placeholder="Ville" />
                        <button type="submit" name="ok" value="envoyer"> Envoyer </button>
                    </form>';
        }else {
            header("Location:./formulaire.php?Identifiant=unconnected"); 
        }
    ?>
    
</body>
</html>