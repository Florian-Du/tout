<?php
    //on start la session pour avoir l'id du compte
    session_start();
    
    //on verifie si la personne est bien connecter
    if (isset($_SESSION['id_personne'])) {
        // On verifie si on a bien l'id du post
        if (isset($_POST['id_post'])) {
            //include pour se connecter a la BDD
            include 'include.php';
            // Requete pour recuperer le libelle de l'img (ex : .jpeg , .png , etc ...)
            try
                {
                    $sql = "SELECT Libelle_Image , Id_post FROM post WHERE Id_post = ?";
                    // Préparation de la requête avec les marqueurs
                    $resultat = $base->prepare($sql);
                    $resultat->execute(array($_POST['id_post']));
                    while ($ligne = $resultat->fetch())
                    {  
                        //on supprime le post
                        try
                        {
                            $sql = "DELETE FROM post WHERE Id_post =:id";
                            // Préparation de la requête avec les marqueurs
                            $resultat = $base->prepare($sql);
                            $resultat->execute(array('id' => $_POST['id_post']));
                            $resultat->closeCursor();
                            header("Location:./index.php?sup=OK");

                        }
                        catch(Exception $e)
                        {
                            // message en cas d'erreur
                            die('Erreur : '.$e->getMessage());
                        }
                        //et on supprime l'image dans le dossier
                        $chemin_destination = './Image/';
                        unlink($chemin_destination.$ligne['Id_post'].$ligne['Libelle_Image']);
                    }
                    $resultat->closeCursor();
                }
                catch(Exception $e)
                {
                    // message en cas d'erreur
                    die('Erreur : '.$e->getMessage());
                }
            

        }else { // Sinon on renvoie a la page index avec une erreur 
            header("Location:./index.php?sup=ERREUR");
        }
    }else { // Sinon on renvoie a la page connexion avec un message erreur
        header("Location:./login.php?connected=NOT");
    }
?>