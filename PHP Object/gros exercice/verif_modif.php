<?php
    // on start la session pour recuperer les identifiants
    session_start();
    // on include toutes les classes
    include "Autoload.php";
    // si on est connecter
    if ($_SESSION['id_personne']) {
        // si on a le titre et le commentaire
        if (isset($_POST["Titre"]) && isset($_POST['Commentaire'])) {
            // on creer un nouvelles articles et on lui attributs :
            $a = new Article();
            $a->setId($_POST["id_post"]); // son id
            $a->setTitre($_POST["Titre"]); // son Titre
            $a->setCommentaire($_POST["Commentaire"]); // son Commentaire
            // si on a pas remplie le fichier
            if ($_FILES['Image']['name'] == '') {
                // on creer un manager_article avec la base en parametre
                $m = new manager_article($base);
                // on modifie l'article et on stock ce qu'il return dans $modif
                $modif = $m->modifierArticle($a);
                // si il return ok
                if ($modif == 'ok') {
                    // on renvoie au menu avec un message
                    header("Location:./menu.php?modif=OK");
                }

            } else { // sinon si on a mit une image
                // on definie l'image dans l'article
                $a->setImage($_FILES['Image']);
                // on creer un manger article avec la base en parametre
                $m = new manager_article($base);
                // on modifie l'article avec l'image et on stock ce qu'il return
                $modif = $m->modifierArticleWithImage($a);
                if ($modif == 'ok') { // si la modif c'est bien passer
                    // on renvoie au menu avec un message
                    header("Location:./menu.php?modif=OK");
                }
            }
        }
    }



