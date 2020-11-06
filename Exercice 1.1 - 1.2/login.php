<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="verif_login.php" method="POST" name="formulaire">
        <input type="text" name="Identifiant" placeholder="Identifiant" />
        <input type="passeword" name="passeword" placeholder="Mot De Passe"/>
        <button type="submit" name="ok" value="envoyer"> Envoyer </button>
    </form>
    <?php
        session_start();
        if (isset($_REQUEST["Identifiant"])) {
            if ($_REQUEST["Identifiant"] == "incorrect") {
                echo "<p> Identifiant incorrect </p>";
                for ($i=0; $i < count($_SESSION['identifiant']); $i++) { 
                    echo "<p> essaie numero ".$i."</p>";
                    echo "<p>".$_SESSION['identifiant'][$i]." - ".$_SESSION['passeword'][$i]."</p>";
                }
            }
        }
        
    ?>
</body>
</html>