<?php
        // on start la session pour avoir l'id de la personne connecter et l'id du post a modifier
        session_start();
        // include pour se connecter a la BDD
        include 'include.php';
        // si la personne est connecter
        if (isset($_SESSION['id_personne'])) {
            // si il y a un post un modifier on passe
            if (isset($_SESSION['id_post'])) {
                // si on a la requete en poste du titre de commentaire et que le Files on modifie sans toucher a l'image
                if (isset($_POST['Titre']) && isset($_POST['Commentaire']) && isset($_FILES['Image_modif']) && $_FILES['Image_modif']['name'] != '') { // on verifie que la personne a tous bien remplie le formulaire
                    $commentaire = htmlspecialchars($_POST['Commentaire']);
                    $Titre = htmlspecialchars($_POST['Titre']);
                    // requete pour envoyer la modif du post sur la base de donnee avec l'image
                    try
                    {
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
                                $sql = 'UPDATE post SET Titre = :titre , Commentaire = :commentaire , Libelle_Image = :libelle_image WHERE Id_post = "'.$_SESSION['id_post'].'"';
                                // Préparation de la requête avec les marqueurs
                                $resultat = $base->prepare($sql);
                                $resultat->execute(array('titre' => $_POST['Titre'], 'commentaire' => $_POST['Commentaire'], 'libelle_image' => '.'.substr(strrchr($_FILES['Image_modif']['name'], '.'), 1 )));
                                // rename du fichier et on le met dans le dossier
                                $_FILES['Image_modif']['name'] = $id.'.'.substr(strrchr($_FILES['Image_modif']['name'], '.'), 1 );
                                $chemin_destination = './Image/';
                                move_uploaded_file($_FILES['Image_modif']['tmp_name'],$chemin_destination.$_FILES['Image_modif']['name']);
                                
                                
                                
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

                    
                }else if ($_FILES['Image_modif']['name'] == '') {
                    //requete de la modif du post sans l'image
                    $commentaire = htmlspecialchars($_POST['Commentaire']);
                    $Titre = htmlspecialchars($_POST['Titre']);
                    try
                        {
                        $sql = 'UPDATE post SET Titre = :titre , Commentaire = :commentaire WHERE Id_post = "'.$_SESSION['id_post'].'"';
                        // Préparation de la requête avec les marqueurs
                        $resultat = $base->prepare($sql);
                        $resultat->execute(array('titre' => $Titre, 'commentaire' => $commentaire));                      
                        
                        
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
                else { // sinon on renvoie la personne pour reessayer
                    header("Location:./publication.php?poste=ERREUR");
                }
            }else {
                header("Location:./index.php?poste=null");
            }
        }else { // Si la personne n'est pas connectez on l'envoie a la page se connecter
            header("Location:./login.php?connected=NOT");
        }
    ?>