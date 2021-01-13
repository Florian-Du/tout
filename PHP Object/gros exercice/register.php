<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>

    <?php
    session_start();
    include "Autoload.php";
    $langue = new config_manager();
    $json = $langue->getconfig();
    echo '
    <h1>'.$json->{'langue'}->{$langue->getLanguage()}->{'enregistrer'}.'</h1>
    <p>
        <form action="modif_langue.php" method="POST" name="formulaire">
            <input type="hidden" name="location" value="register.php"/>
            <button type="submit" name="langue" value="FR"> FR </button> 
        </form>
        <form action="modif_langue.php" method="POST" name="formulaire">
            <input type="hidden" name="location" value="register.php"/>
            <button type="submit" name="langue" value="EN"> EN </button> 
        </form>
    </p>
    <form action="verif_register.php" method="POST" name="formulaire">
        <label for="Identifiant">'.$json->{'langue'}->{$langue->getLanguage()}->{'Identifiant'}.'</label>
        <input type="text" id="Identifiant" name="Identifiant" placeholder="'.$json->{'langue'}->{$langue->getLanguage()}->{'Identifiant'}.'" />
        <label for="passeword">'.$json->{'langue'}->{$langue->getLanguage()}->{'MotDePasse'}.'</label>
        <input type="password" id="passeword" name="passeword" placeholder="'.$json->{'langue'}->{$langue->getLanguage()}->{'MotDePasse'}.'"/>
        <label for="confirm_passeword">'.$json->{'langue'}->{$langue->getLanguage()}->{'ConfirmerMotDePasse'}.'</label>
        <input type="password" id="confirm_passeword" name="confirm_passeword" placeholder="'.$json->{'langue'}->{$langue->getLanguage()}->{'ConfirmerMotDePasse'}.'"/>
        <button type="submit" name="ok" value="envoyer">'.$json->{'langue'}->{$langue->getLanguage()}->{'enregistrer'}.'</button>
    </form>
    <p><a href="login.php">'.$json->{'langue'}->{$langue->getLanguage()}->{'h1_connexion'}.'</a></p>
    ';
    // si un identifiant est deja utiliser on met une erreur et on affiche comme quoi cet identifiant est deja utiliser
     if (isset($_REQUEST['register'])){
         if ($_REQUEST['register'] == "already"){
             echo "Cet identifiant est deja utiliser essayer de vous connecter avec le bouton ci-dessus";
         }
     }
    if (isset($_REQUEST['register'])){
        if ($_REQUEST['register'] == "ERREUR"){
            echo "Une erreur est survenue";
        }
    }
    ?>
</body>
</html>