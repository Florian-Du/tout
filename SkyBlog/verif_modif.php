<?php
        // on start la session pour avoir l'id de la personne connecter et l'id du post a modifier
        session_start();
        // si la personne est connecter et qu'il y a un post un modifier on passe
        if (isset($_SESSION['id_personne'])) {
            if (isset($_SESSION['id_post'])) {
                if (isset($_POST['Titre']) && isset($_POST['Commentaire']) && isset($_FILES['Image'])) { // on verifie que la personne a tous bien remplie le formulaire
                    $commentaire = htmlspecialchars($_POST['Commentaire']);
                    $Titre = htmlspecialchars($_POST['Titre']);
                    // requete pour envoyer le post sur la base de donnee 

                    try
                    {
                        include 'include.php';
                        $sql = "SELECT Libelle_Image , Id_post FROM post WHERE Id_post = ?";
                        // Préparation de la requête avec les marqueurs
                        $resultat = $base->prepare($sql);
                        $resultat->execute(array($_SESSION['id_post']));
                        while ($ligne = $resultat->fetch())
                        {
                            $chemin_destination = './Image/';
                            unlink($chemin_destination.$ligne['Id_post'].$ligne['Libelle_Image']);
                            $id = $ligne['Id_post'];
                            try
                                {
                                include 'include.php';
                                $sql = 'UPDATE post SET Titre = :titre , Commentaire = :commentaire , Libelle_Image = :libelle_image WHERE Id_post = "'.$_SESSION['id_post'].'"';
                                // Préparation de la requête avec les marqueurs
                                $resultat = $base->prepare($sql);
                                $resultat->execute(array('titre' => $_POST['Titre'], 'commentaire' => $_POST['Commentaire'], 'libelle_image' => '.'.substr(strrchr($_FILES['Image']['name'], '.'), 1 )));

                                $_FILES['Image']['name'] = $id.'.'.substr(strrchr($_FILES['Image']['name'], '.'), 1 );
                                $chemin_destination = './Image/';
                                move_uploaded_file($_FILES['Image']['tmp_name'],$chemin_destination.$_FILES['Image']['name']);
                                
                                
                                
                                echo 'Personne modifiée.';
                                
                                $resultat->closeCursor();
                                header("Location:./index.php?modif=OK");
                                }
                                Catch(Exception $e)
                                {
                                    // message en cas d’erreur
                                    die('Erreur : '.$e->getMessage());
                                }
                        }
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
            }else {
                header("Location:./index.php?poste=null");
            }
        }else { // Si la personne n'est pas connectez on l'envoie a la page se connecter
            header("Location:./login.php?connected=NOT");
        }
    ?>