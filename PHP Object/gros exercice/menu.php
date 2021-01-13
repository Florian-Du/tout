<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
</head>
<body>

    <?php
        // on start la session pour avoir l'id de connexion et le libelle de l'user
        session_start();
        // on include toutes les classes
        include "Autoload.php";
        $langue = new config_manager();
        $json = $langue->getconfig();
        echo '<h1>'.$json->{'langue'}->{$langue->getLanguage()}->{'h1_menu'}.'</h1>';
        echo '<p>
                <form action="modif_langue.php" method="POST" name="formulaire">
                    <input type="hidden" name="location" value="menu.php"/>
                    <button type="submit" name="langue" value="FR"> FR </button> 
                </form>
                <form action="modif_langue.php" method="POST" name="formulaire">
                    <input type="hidden" name="location" value="menu.php"/>
                    <button type="submit" name="langue" value="EN"> EN </button> 
                </form>
            </p>';

        // on recupere la base grace a la fonction static dans manager_article.php
        $base = Base::getBase();
        //on creer un manager_article avec la base de donnee en parametre recupere juste au dessus
        $m = new manager_article($base);
        // on recupere tout les articles que l'on met dans un tableau
        $tableau = $m->getArticle();
        // si on est connecter
        if (isset($_SESSION['id_personne'])) {
            // on affiche avec quel compte on est connecter
            echo $json->{'langue'}->{$langue->getLanguage()}->{'connectez'}." @".$_SESSION['LibelleUser'];
            // on affiche un lien pour aller sur la page insertion.php
            echo "<p><a href='insertion.php'>".$json->{'langue'}->{$langue->getLanguage()}->{'ajoutez'}."</a></p>";
            // on affiche un boutton se deconnecter qui redirige vers la page login.php
            echo "<p><a href='login.php'>".$json->{'langue'}->{$langue->getLanguage()}->{'deconnexion'}."</a></p>";
        }else { // si on est pas connecter on affiche un boutton se connecter qui redirige vers login.php
            echo '<p><a href="login.php">Se connecter</a></p>';
        }

        // si la modif c'est bien effectuer on marque un message en le disant
        if (isset($_REQUEST['modif'])){
            if ($_REQUEST['modif'] == 'OK'){
                echo "'article a bien ete modifier";
            }
        }
        // si l'insertion c'est bien effectuer on marque un message en le disant
        if (isset($_REQUEST['post'])){
            if ($_REQUEST['post'] == 'OK'){
                echo "'votre post a bien ete ajouter";
            }
        }
        // on boucle le tableau des articles et on creer tous les articles dynamiquement avec :
        for ($i = 0; $i < count($tableau); $i++) {
            echo '<div>';
                echo '<h3>'.$tableau[$i]->getTitre().'</h3>'; // le titre
                echo '<p>@'.$tableau[$i]->getUtilisateur().'</p>'; // le nom d'utilisateur qui a creer l'article
                echo '<p>'.$tableau[$i]->getCommentaire().'</p>'; // le commentaire du post
                echo '<img src="./Image/'.$tableau[$i]->getImage_nom().'"/>'; // l'image du post
                echo '<p><i>'.$tableau[$i]->getDate().'</i></p>'; // la date du post
                if (isset($_SESSION['id_personne'])) { // si on est connecter
                    if ($_SESSION['id_personne'] == $tableau[$i]->getId_utilisateur()) { // et si c'est l'utilisateur qui a creer le post alors il peut le modifier ou le supprimer
                        echo '<form action="modif.php" method="POST" name="formulaire">'; // formulaire pour modifier
                            echo '<input type="hidden" name="id_post" value="'.$tableau[$i]->getId().'"/>';
                            echo '<button type="submit" name="ok" value="envoyer">'.$json->{'langue'}->{$langue->getLanguage()}->{'modification'}.'</button>';
                        echo '</form>';
                        echo '<form action="supprimer.php" method="POST" name="formulaire">'; // formulaire pour supprimer
                            echo '<input type="hidden" name="id_post" value="'.$tableau[$i]->getId().'"/>';
                            echo '<button type="submit" name="ok" value="envoyer">'.$json->{'langue'}->{$langue->getLanguage()}->{'supprimer'}.'</button>';
                        echo '</form>';
                    }
                }
            echo '</div>';
        }


    ?>
</body>
    <style>
        img {
            width: 40%;
        }
    </style>
</html>
