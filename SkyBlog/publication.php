<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publiez</title>
</head>
<body>
    <form action="verif_publication.php" method="POST" name="formulaire">
        <input type="text" name="id_utilisateur" placeholder="Identifiant" />
        <input type="text" name="passeword" placeholder="Mot De Passe"/>
        <button type="submit" name="ok" value="envoyer"> Envoyer </button>
    </form>
    <?php
        session_start();
        if ($_SESSION['id_personne'] >= 1 ) {

        }
    ?>
</body>
</html>
