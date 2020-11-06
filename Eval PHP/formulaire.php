<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
</head>
<body>
    <!-- Formulaire de connexion -->
    <form action="verif_login.php" method="POST" name="formulaire">
        <input type="text" name="Identifiant" placeholder="Identifiant" />
        <input type="passeword" name="passeword" placeholder="Mot De Passe"/>
        <button type="submit" name="ok" value="envoyer"> Envoyer </button>
    </form>
    <?php
    // si l'identifiant est incorrect afficher le message "identifiant incorrect"
    if (isset($_REQUEST['Identifiant'])) {
        if ($_REQUEST['Identifiant'] == "incorrect") {
            echo '<p> identifiant incorrect </p>';
        }else if ($_REQUEST['Identifiant'] == "unconnected"){
            echo '<p> Connectez-vous pour accedez a cet page </p>';
        }
    }
        
    ?>
</body>
</html>