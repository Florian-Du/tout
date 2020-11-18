<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <!-- Formulaire de connexion -->
    <form action="verif_login.php" method="POST" name="formulaire">
        <input type="text" name="Identifiant" placeholder="Identifiant" />
        <input type="passeword" name="passeword" placeholder="Mot De Passe"/>
        <button type="submit" name="ok" value="envoyer"> Envoyer </button>
        <p><a href="index.php">Regardez sans se connecter</a></p>
    </form>
    <?php
    session_start();
    session_destroy();
    // si l'identifiant est incorrect afficher le message "identifiant incorrect"
    if (isset($_REQUEST['Identifiant'])) {
        if ($_REQUEST['Identifiant'] == "incorrect") {
            echo '<p> !!! identifiant incorrect !!! </p>';
        }else if ($_REQUEST['connected'] == "NOT"){
            echo '<p> !!! Connectez-vous pour acceder a cet page !!!</p>';
        }
        else if ($_REQUEST['connected'] == "ERREUR"){
            echo '<p>!!! Formulaire mal remplie !!!</p>';
        }
    }
        
    ?>
</body>
</html>