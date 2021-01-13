<?php
        // on start la session pour avoir l'id de la personne connecter
        session_start();
        // si la personne est connecter on passe
        if (isset($_SESSION['id_personne'])) {
            if (isset($_POST['Titre']) && isset($_POST['Commentaire']) && isset($_FILES['Image'])) { // on verifie que la personne a tous bien remplie le formulaire
                $commentaire = htmlspecialchars($_POST['Commentaire']);
                $Titre = htmlspecialchars($_POST['Titre']);
                // requete pour envoyer le post sur la base de donnee 
                try
                    {
                        $id = uniqid();
                        include 'include.php';
                        $sql = "INSERT INTO post (Id_post, id_utilisateur, Libelle_Image , post_date , Commentaire , Titre ) VALUES (:Id , :id_utilisateur, :Libelle_Image, NOW() , :Commentaire , :Titre)";
                        // Préparation de la requête avec les marqueurs
                        $resultat = $base->prepare($sql);
                        $resultat->execute(array('Id' => $id , 'id_utilisateur' => $_SESSION['id_personne'],'Libelle_Image' => '.'.substr(strrchr($_FILES['Image']['name'], '.'), 1 ),'Commentaire' => $commentaire,'Titre' => $Titre));
                        $base->lastInsertId();
                        //On change le nom du fichier avec l'id du post et on le met dans le fichier image
                        $_FILES['Image']['name'] = $id.'.'.substr(strrchr($_FILES['Image']['name'], '.'), 1 );
                        $chemin_destination = './Image/';
                        move_uploaded_file($_FILES['Image']['tmp_name'],$chemin_destination.$_FILES['Image']['name']);
                        
                        header("Location:./index.php?poste=OK");
                        $resultat->closeCursor();
                    }
                    catch(Exception $e)
                    {
                        // message en cas d'erreur
                        die('Erreur : '.$e->getMessage());
                        
                    } 
            }else { // sinon on renvoie la personne pour reessayer
                header("Location:./publication.php?poste=ERREUR");
            }
        }else { // Si la personne n'est pas connectez on l'envoie a la page se connecter 
            header("Location:./login.php?connected=NOT");
        }
    ?>