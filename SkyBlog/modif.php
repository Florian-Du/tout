<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifiez POST</title>
</head>
<body>
    <form action="verif_modif.php" method="POST" name="formulaire" enctype="multipart/form-data">
        <input type="text" name="Titre" placeholder="Titre du post" value="<?php
            try
            {
                include 'include.php';
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
            try
            {
                include 'include.php';
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
        <input type="file" name="Image"/>
        <button type="submit" name="ok" value="envoyer"> Envoyer </button>
    </form>
    <?php
        session_start();

        $_SESSION['id_post'] = $_POST['id_post'];
    ?>
</body>
</html>
