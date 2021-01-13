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
    // on include toutes les classes
    include "Autoload.php";
    $langue = new config_manager();
    $json = $langue->getconfig();
    echo '<h1>'.$json->{'langue'}->{$langue->getLanguage()}->{'insertion'}.'</h1>';
    echo '<p>
                <form action="modif_langue.php" method="POST" name="formulaire">
                    <input type="hidden" name="location" value="insertion.php"/>
                    <button type="submit" name="langue" value="FR"> FR </button> 
                </form>
                <form action="modif_langue.php" method="POST" name="formulaire">
                    <input type="hidden" name="location" value="insertion.php"/>
                    <button type="submit" name="langue" value="EN"> EN </button> 
                </form>
            </p>';
    echo '
        <form action="insert.php" method="POST" name="formulaire" enctype="multipart/form-data" style="display: block;">
            <label for="Titre">'.$json->{'langue'}->{$langue->getLanguage()}->{'titre'}.'</label>
            <input type="text" name="Titre" id="Titre" placeholder="'.$json->{'langue'}->{$langue->getLanguage()}->{'titre'}.'" style="display: block;"/>
            <label for="Commentaire">'.$json->{'langue'}->{$langue->getLanguage()}->{'commentaire'}.'</label>
            <textarea name="Commentaire" id="Commentaire" cols="90" rows="10" placeholder="'.$json->{'langue'}->{$langue->getLanguage()}->{'commentaire'}.'" style="display: block;"></textarea>
            <input type="hidden" name="MAX_FILE_SIZE" value="3097152"/>
            <input type="file" name="Image"/>
            <button type="submit" name="ok" value="envoyer" style="display: block;">'.$json->{'langue'}->{$langue->getLanguage()}->{'ajoutez'}.'</button>
        </form>
        <p><a href="menu.php">'.$json->{'langue'}->{$langue->getLanguage()}->{'retourner'}.'</a></p>
    ';
        // si il y a une erreur dans le post on affiche qu'une erreur est survenue
        if (isset($_REQUEST['post'])) {
            if ($_REQUEST['post'] == 'ERREUR') {
                echo 'Une erreur est survenue reessayer';
            }
        }
    ?>
</body>
</html>