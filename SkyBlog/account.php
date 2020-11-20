<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./SCSS/style.css" type="text/css" rel="stylesheet"></link>
    <title>Account</title>
</head>
<body>
    <h1>SkyBlog</h1>
    <h2>Votre compte</h2>
    <p><a href="./index.php">Retournez au menu</a></p>
    <?php
        // On recupere l'id de la session 
        session_start();
        // si la personne est connecter on passe 
        if (isset($_SESSION['id_personne'])) {
            // requete pour afficher tous et que les post de la personne connecter
            try
                {
                    include 'include.php';
                    $sql = "SELECT Id_post, id_utilisateur , Libelle_Image , post_date , Commentaire , Titre , login_passeword.Identifiant AS Identifiant FROM post INNER JOIN login_passeword ON post.id_utilisateur = login_passeword.Id_Login WHERE id_utilisateur = ? ORDER BY post_date DESC";
                    // Préparation de la requête avec les marqueurs
                    $resultat = $base->prepare($sql);
                    $resultat->execute(array($_SESSION['id_personne']));
                    while ($ligne = $resultat->fetch())
                    {
                        echo '<div>';
                            echo "<h3>".$ligne["Titre"]."</h3>";
                            echo "<h4>@".$ligne["Identifiant"]."</h4>";
                            echo "<p>".$ligne["Commentaire"]."</p>";
                            echo "<img src='./Image/".$ligne["Id_post"].$ligne["Libelle_Image"]."'></img>";
                            echo "<p><i>".$ligne["post_date"]."</i></p>";
                            // si on est coonecter on peux modifier les post et les supprimer
                            if (isset($_SESSION["id_personne"])) {
                                if ($ligne['id_utilisateur'] == $_SESSION["id_personne"]) {
                                    echo '<form action="modif.php" method="POST" name="formulaire">';
                                        echo '<input type="hidden" name="id_post" value="'.$ligne["Id_post"].'"/>';
                                        echo '<button type="submit" name="ok" value="envoyer"> modifier </button>';
                                    echo '</form>';
                                    echo '<form action="supprimer.php" method="POST" name="formulaire">';
                                        echo '<input type="hidden" name="id_post" value="'.$ligne["Id_post"].'"/>';
                                        echo '<button type="submit" name="ok" value="envoyer"> Supprimer </button>';
                                    echo '</form>';
                                }
                            }
                        echo '</div>';
                        
                    }
                    $resultat->closeCursor();
                }
                catch(Exception $e)
                {
                    // message en cas d'erreur
                    die('Erreur : '.$e->getMessage());
                }
        }else {// Si la personne n'est pas connecter on l'envoie a la page se connecter
            header("Location:./login.php?connected=NOT");
        }

    ?>
</body>
</html>
