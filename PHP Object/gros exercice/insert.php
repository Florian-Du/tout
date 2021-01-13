<?php
    // on start la session pour recuperer les identifiants
    session_start();
    // on includes les classe
    include "Autoload.php";
    // si l'on est connecter
    if ($_SESSION['id_personne']){
        // si on a remplie tous le formulaire d'insertion
        if (isset($_POST["Titre"]) && isset($_POST["Commentaire"]) && isset($_FILES["Image"])) {
            // et que titre et commentaire on minimum un caractere
            if ($_POST["Titre"] != "" && $_POST["Commentaire"] != "") {
                // on recupere la connexion a la base de donnee
                $base = Base::getBase();
                // on creer le manager_article
                $m = new manager_article($base);
                // on creer le nouvelle article
                $a = new Article();
                // on lui attribut un id
                $a->createId();
                // quels personne l'a creer
                $a->setId_utilisateur($_SESSION['id_personne']);
                // le titre
                $a->setTitre($_POST["Titre"]);
                //le commentaire
                $a->setCommentaire($_POST["Commentaire"]);
                // on parametre l'image
                $a->setImage($_FILES['Image']);
                // puis on insert dans la base de donnee avec le manager_article avec en parametre l'article en question
                $m->insert($a);

                header("Location:./menu.php?post=OK");
            }else {
                header("Location:./insertion.php?post=ERREUR");
            }
        }else {
            header("Location:./insertion.php?post=ERREUR");
        }
    }else { // sinon l'on est pas connecter on renvoie a la page login.php
        header("Location:./login.php?connected=NOTH");
    }

