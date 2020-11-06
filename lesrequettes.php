<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>Exercice avec REQUEST</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    </head>
    <body>
    <h2>Récupération des données par $_POST et $_GET</h2>
    <?php
        if (isset($_REQUEST["nom"])) {
            echo "Votre nom est:".$_REQUEST['nom']."<br />";
        }
        if (isset($_REQUEST["prenom"])) {
            echo "Votre prénom est:".$_REQUEST['prenom'];
        }
    ?>
    </body>
</html>