<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modif</title>
</head>
<body>
    <form action="verif_modif.php" method="POST" name="formulaire" enctype="multipart/form-data" style="display: block;">
        <?php
            //start la session
            session_start();
            // si la session existe
            if ($_SESSION['id_personne']){
                //include
                include "Autoload.php";

                //on creer le manager article , avec la base de donnee en paramatres avec l'include base.connexion.php
                $m = new manager_article($base);
                //on recuperere un article precis grace a la methode dans manager_article.php
                $article = $m->getSpecificArticle($_REQUEST['id_post']);
                // on creer le formulaire avec les donnee preremplie
                echo '<input type="hidden" name="id_post" value="'.$article->getId().'"/>';
                echo ' <label for="Titre">Titre :</label>';
                echo '<input type="text" name="Titre" id="Titre" placeholder="Titre du post" value="'.$article->getTitre().'"/>';
                echo ' <label for="Commentaire">Commentaire :</label>';
                echo '<textarea name="Commentaire" id="Commentaire" cols="90" rows="10" placeholder="Commentaire" value="">'.$article->getCommentaire().'</textarea>';
                echo '<input type="hidden" name="MAX_FILE_SIZE" value="3097152"/>';
                echo '<input type="file" name="Image"/>';
            }else { // sinon on renvoie a la page de connexion
                header("Location:./login.php?connected=NOTH");
            }

        ?>
        <button type="submit" name="ok" value="envoyer" style="display: block;"> Envoyer </button>
    </form>
    <p><a href="menu.php">Retournez au fil d'actualité</a></p>
</body>
</html>

    