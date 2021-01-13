<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertion</title>
</head>
<body>
<?php
    session_start();
    include "Autoload.php";
        $langue = new config_manager();
        $json = $langue->getconfig();
        echo '<h1>'.$json->{'langue'}->{$langue->getLanguage()}->{'h1_connexion'}.'</h1>';
        echo '<p>
                <form action="modif_langue.php" method="POST" name="formulaire">
                    <input type="hidden" name="location" value="login.php"/>
                    <button type="submit" name="langue" value="FR"> FR </button> 
                </form>
                <form action="modif_langue.php" method="POST" name="formulaire">
                    <input type="hidden" name="location" value="login.php"/>
                    <button type="submit" name="langue" value="EN"> EN </button> 
                </form>
            </p>';
        echo '
        <form action="verif_login.php" method="POST" name="formulaire" style="display: block;">
            <label for="Identifiant">'.$json->{'langue'}->{$langue->getLanguage()}->{'Identifiant'}.'</label>
            <input type="text" name="Identifiant" id="Identifiant" placeholder="'.$json->{'langue'}->{$langue->getLanguage()}->{'Identifiant'}.'" style="display: block;"/>
            <label for="password">'.$json->{'langue'}->{$langue->getLanguage()}->{'MotDePasse'}.'</label>
            <input type="password" name="password" id="password" placeholder="'.$json->{'langue'}->{$langue->getLanguage()}->{'MotDePasse'}.'" style="display: block;"/>
            <button type="submit" name="ok" value="envoyer" style="display: block;">'.$json->{'langue'}->{$langue->getLanguage()}->{'h1_connexion'}.'</button>
        </form>
        <p><a href="menu.php">'.$json->{'langue'}->{$langue->getLanguage()}->{'VoirSansConnexion'}.'</a></p>
        <p><a href="register.php">'.$json->{'langue'}->{$langue->getLanguage()}->{'enregistrer'}.'</a></p>
        ';

    // on start la session puis on la detruit pour etre sur qu'il n'y est pas de conflits et pour se deconnecter
    session_destroy();
    // si on est pas connecter pour acceder a certaines page on dit qu'il faut etre connecter pour y aller
    if (isset($_REQUEST["connected"])) {
        if ($_REQUEST["connected"] == "NOTH"){
            echo "Connectez vous pour acceder a cette page";
        }
    }
    // si les identifiants sont incorrect
    if (isset($_REQUEST["Identifiant"])) {
        if ($_REQUEST["Identifiant"] == "incorrect"){
            echo "Identifiants incorrect";
        }
    }
?>
</body>
</html>
