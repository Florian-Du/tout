<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifiez POST</title>
</head>
<body>
    <h1>SkyBlog</h1>
    <h2>Modifiez un post ! </h2>
    <p><a href="./index.php">Retournez au menu</a></p>
    <!-- Formulaire de modification -->
    <form action="verif_modif.php" method="POST" name="formulaire" enctype="multipart/form-data">
        <input type="text" name="Titre" placeholder="Titre du post" value="<?php
        // include pour se connecter a la BDD
        include 'include.php';
            //Requete pour recuperer le champ Titre du poste pour pre-remplir
            try
            {
                $sql = "SELECT Id_post , Titre FROM post WHERE Id_post = ?";
                // Préparation de la requête avec les marqueurs
                $resultat = $base->prepare($sql);
                $resultat->execute(array($_POST['id_post']));
                while ($ligne = $resultat->fetch())
                {
                    echo $ligne['Titre'];
                }
                $resultat->closeCursor();
            }
            catch(Exception $e)
            {
                // message en cas d'erreur
                die('Erreur : '.$e->getMessage());
            }
            
        ?>"/>
        <input type="text" name="Commentaire" placeholder="Commentaire du post" value="<?php
            //Requete pour recuperer le champ Commentaire du poste pour pre-remplir
            try
            {
                $sql = "SELECT Id_post , Commentaire FROM post WHERE Id_post = ?";
                // Préparation de la requête avec les marqueurs
                $resultat = $base->prepare($sql);
                $resultat->execute(array($_POST['id_post']));
                while ($ligne = $resultat->fetch())
                {
                    echo $ligne['Commentaire'];
                }
                $resultat->closeCursor();
            }
            catch(Exception $e)
            {
                // message en cas d'erreur
                die('Erreur : '.$e->getMessage());
            }
            
        ?>"/>
        <input type="hidden" name="MAX_FILE_SIZE" value="3097152"/>
        <input type="file" name="Image_modif"/>
        <button type="submit" name="ok" value="envoyer"> Envoyer </button>
    </form>
    <?php
        // Je start la session 
        session_start();
        //Je met l'id du post dans la session
        $_SESSION['id_post'] = $_POST['id_post'];
    ?>
</body>
</html>
