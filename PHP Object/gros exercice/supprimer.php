<?php
    // on start la session  pour avoir les identifiants
    session_start();
    //Affectation de la fonction gérant l’autoload
    include "Autoload.php";
    // si la personne est conencter
    if ($_SESSION['id_personne']){
        // on creer un manager article avec la connexion a la base de donnee en parametre
        $m = new manager_article($base);
        // on supprime le post et on stock le return dans la variables $supprimer
        $supprimer = $m->supprimerArticle($_POST['id_post']);
        // si elle return ok
        if ($supprimer = "ok"){
            // alors on renvoie au menu avec un message disant que le post a bien ete supprimer
            header("Location:./menu.php?sup=OK");
        }
    }else { // sinon on l'nevoie se connecter en disant qu'elle ne peut pas acceder a cet page si elle n'est pas connecter
        header("Location:./login.php?connected=NOTH");
    }
