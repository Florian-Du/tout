<?php
    // si l'input checkbox 
    if (isset($_POST["checkbox"])) {
        // je boucle pour avoir tous les checkbox selectionner 
        for ($i=0; $i < count($_POST["checkbox"]); $i++) {
            // je me connecte a la BDD
            include "include.php";
            for ($z=0; $z < count($_POST["checkbox"]); $z++) { 
                // je boucle pour supprimer tous les formateurs auquels le stagiaire etait inscrit
                try
                {
                    $sql = "DELETE FROM stagiaire_formateur WHERE Id_stagiaire = :id";
                    // Préparation de la requête avec les marqueurs
                    $resultat = $base->prepare($sql);
                    $resultat->execute(array('id' => $_POST["checkbox"][$z]));
                    echo "Personne supprimée: " . $resultat->rowCount();
                    $resultat->closeCursor();
                }
                catch(Exception $e)
                {
                    // message en cas d'erreur
                    die('Erreur : '.$e->getMessage());
                }
            }
            // puis je supprime le stagiaire
            try
            {
                $sql = "DELETE FROM stagiaire WHERE Id = :lid";
                // Préparation de la requête avec les marqueurs
                $resultat = $base->prepare($sql);
                $resultat->execute(array('lid' => $_POST["checkbox"][$i]));
                echo "Personne supprimée: " . $resultat->rowCount();
                $resultat->closeCursor();
            }
            catch(Exception $e)
            {
                // message en cas d'erreur
                die('Erreur : '.$e->getMessage());
            }
        }
        // puis je renvoie a la page index
        header("Location:./index.php");
    }else {
        header("Location:./supprimer.php?type=error");
    }
?>