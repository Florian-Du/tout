<?php
    if ($_FILES['photo']['error']) {
        switch ($_FILES['photo']['error']){
        case 1:
            echo "La taille du fichier est plus grande que la limite autorisée par le serveur (paramètre upload_max_filesize du fichier php.ini).";
            break;
        case 2:
            echo "La taille du fichier est plus grande que la limite autorisée par le formulaire (paramètre post_max_size du fichier php.ini).";
            break;
        case 3:
            echo "L'envoi du fichier a été interrompu pendant le transfert.";
            break;
        case 4:
            echo "La taille du fichier que vous avez envoyé est nulle." ; break;
        }
    } 
    else {
        echo "Aucune erreur dans l'upload du fichier.<br/>";
        if ((isset($_FILES['photo']['name'])&&($_FILES['photo']['error'] == UPLOAD_ERR_OK))) {
            $chemin_destination = 'fichiers/';
            move_uploaded_file($_FILES['photo']['tmp_name'], $chemin_destination.$_FILES['photo']['name']);
            echo "Le fichier ".$_FILES['photo']['name']." a été copié dans le répertoire fichiers";
        }
        else {
            echo "Le fichier n'a pas pu être copié dans le répertoire fichiers.";
        }
    }
?>