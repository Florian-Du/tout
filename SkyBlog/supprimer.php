<?php
    session_start();

    if (isset($_SESSION['id_personne'])) {
        if (isset($_POST['id_post'])) {
            try
                {
                    include 'include.php';
                    $sql = "SELECT Libelle_Image , Id_post FROM post WHERE Id_post = ?";
                    // Préparation de la requête avec les marqueurs
                    $resultat = $base->prepare($sql);
                    $resultat->execute(array($_POST['id_post']));
                    while ($ligne = $resultat->fetch())
                    {
                        try
                        {
                            include 'include.php';
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
            

        }else {
            header("Location:./index.php?sup=ERREUR");
        }
    }else {
        header("Location:./login.php?connected=NOT");
    }
?>