<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./SCSS/style.css" type="text/css" rel="stylesheet"></link>
    <title>SkyBlog</title>
</head>
<body>
    <h1>Bienvenue sur SkyBlog le blog de tes rêves !!!</h1>
    
    <?php
            //session start pour avoir l'id du compte
            session_start();
            //si la personne est connecter alros on affiche le lien pour voir son compte et tous ses poste ainsi qu'un bouton pour poster
            if (isset($_SESSION['id_personne'])) {
                try
                {
                    include 'include.php';
                    $sql = "SELECT Id_Login , Identifiant FROM login_passeword WHERE Id_Login = ?";
                    // Préparation de la requête avec les marqueurs
                    $resultat = $base->prepare($sql);
                    $resultat->execute(array($_SESSION['id_personne']));
                    while ($ligne = $resultat->fetch())
                    {
                        echo '<p> Connectez en tant que <b>@'.$ligne['Identifiant'].'</b></p>';
                        echo '<p><a href="account.php"> Accedez a votre compte </a></p>';
                        echo '<p><a href="publication.php"> Publiez un poste </a></p>';
                        echo '<p><a href="login.php"> Se deconnecter </a></p>';
                    }
                        $resultat->closeCursor();
                        
                } 
                    catch(Exception $e)
                {
                // message en cas d'erreur
                die('Erreur : '.$e->getMessage());
                    
                }
                
                
            }else { //sinon on affiche le bouton pour aller a la page se connecter 
                echo '<a href="./login.php"> Se connecter</a>';
            }
            // on recupere les informations une fois le poste envoyer pour dire a l'utilisateur a bien envoyer son poste 
            if (isset($_REQUEST['poste']) && $_REQUEST['poste'] == 'OK') {
                echo '!!! Votre poste a bien ete envoyer !!! ';
            }else if (isset($_REQUEST['poste']) && $_REQUEST['poste'] == 'null') {
                echo "!!! une erreur c'est produite desoler !!!";
            }else if (isset($_REQUEST['sup']) && $_REQUEST['sup'] == 'OK') {
                echo "!!! Votre poste a bien ete supprimer !!!";
            }else if (isset($_REQUEST['sup']) && $_REQUEST['sup'] == 'ERREUR') {
                echo "!!! le poste na pas pu etre supprimer !!!";
            }else if (isset($_REQUEST['modif']) && $_REQUEST['modif'] == 'OK') {
                echo "!!! Le poste  bien ete supprimer !!!";
            }
            
            //requete permettant d'afficher tous les postes du plus recent au plus vieux 
            try
            {
                include 'include.php';
                $sql = "SELECT post.Id_post AS Id_image , id_utilisateur , Libelle_Image , post_date , Commentaire , Titre , login_passeword.Identifiant AS Identifiant FROM post INNER JOIN login_passeword ON post.id_utilisateur = login_passeword.Id_Login ORDER BY post_date DESC";
                // Préparation de la requête avec les marqueurs
                $resultat = $base->prepare($sql);
                $resultat->execute();
                while ($ligne = $resultat->fetch())
                {
                    echo '<div>';
                        echo "<h3>".$ligne["Titre"]."</h3>";
                        echo "<h4>@".$ligne["Identifiant"]."</h4>";
                        echo "<p>".$ligne["Commentaire"]."</p>";
                        echo "<p><i>".$ligne["post_date"]."</i></p>";
                        echo "<img src='./Image/".$ligne["Id_image"].$ligne["Libelle_Image"]."'></img>";
                    if (isset($_SESSION["id_personne"])) {
                        if ($ligne['id_utilisateur'] == $_SESSION["id_personne"]) {
                            echo '<form action="modif.php" method="POST" name="formulaire">';
                                echo '<input type="hidden" name="id_post" value="'.$ligne["Id_image"].'"/>';
                                echo '<button type="submit" name="ok" value="envoyer"> modifier </button>';
                            echo '</form>';
                            echo '<form action="supprimer.php" method="POST" name="formulaire">';
                                echo '<input type="hidden" name="id_post" value="'.$ligne["Id_image"].'"/>';
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
            
    ?>

</body>
</html>