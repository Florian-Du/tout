<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./SCSS/style.scss" type="text/css" rel="stylesheet"></link>
    <title>SkyBlog</title>
</head>
<body>
    <h1>Bienvenue sur SkyBlog le blog de tes rêves !!!</h1>
    
    <?php
            session_start();

            if ($_SESSION['id_personne'] >= 1 ) {
                try
                {
                    $base = new PDO('mysql:host=127.0.0.1;dbname=SkyBlog', 'root', 'root');
                    $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    $sql = "SELECT Id_Login , Identifiant FROM login_passeword WHERE Id_Login = ?";
                    // Préparation de la requête avec les marqueurs
                    $resultat = $base->prepare($sql);
                    $resultat->execute(array($_SESSION['id_personne']));
                    while ($ligne = $resultat->fetch())
                    {
                        echo '<p> Connectez en tant que <b>'.$ligne['Identifiant'].'</b></p>';
                        echo '<p><a href="account.php"> Accedez a votre compte </a></p>';
                        echo '<p><a href="publication.php"> Publiez un poste </a></p>';
                    }
                        $resultat->closeCursor();
                        
                } 
                    catch(Exception $e)
                {
                // message en cas d'erreur
                die('Erreur : '.$e->getMessage());
                    
                }
                
                
            }else {
                echo '<a href="./login.php"> Se connecter</a>';
            }

            try
            {
                $base = new PDO('mysql:host=127.0.0.1;dbname=SkyBlog', 'root', 'root');
                $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT post.Image AS post_image , post.Date AS post_date , Commentaire , Titre , login_passeword.Identifiant AS Identifiant FROM post INNER JOIN login_passeword ON post.id_utilisateur = login_passeword.Id_Login";
                // Préparation de la requête avec les marqueurs
                $resultat = $base->prepare($sql);
                $resultat->execute();
                while ($ligne = $resultat->fetch())
                {
                    echo '<div>';
                        echo "<h3>".$ligne["Titre"]."</h3>";
                        echo "<h4>".$ligne["Identifiant"]."</h4>";
                        echo "<p>".$ligne["Commentaire"]."</p>";
                        echo "<p><i>".$ligne["post_date"]."</i></p>";
                        echo "<img src='./Image/".$ligne["post_image"].".jpg'></img>";
                    echo '</div>';
                }
                

                    $resultat->closeCursor();
                    
                }
                    
                    catch(Exception $e)
                {
                // message en cas d'erreur
                die('Erreur : '.$e->getMessage());
                
            }
    ?>

</body>
</html>