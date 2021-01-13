<?php
    // Je me connecte a la BDD
    include "include.php";
    // Je boucle pour modifier tous les stagiaires cocher 
    if (isset($_POST['checkbox'])) {
        for ($i=0; $i < count($_POST['checkbox']); $i++) { 
            // Je modifie la table stagiaire avec les info actuel
            try
            {
                $sql = 'UPDATE Stagiaire SET Nom = :nom , Prenom = :prenom , Id_nationalite = :Id_nationalite , Id_type_formation = :Id_type_formation WHERE Id = :id';
                // Préparation de la requête avec les marqueurs
                $resultat = $base->prepare($sql);
                $resultat->execute(array('nom' => htmlspecialchars($_POST['Nom'][$_POST['checkbox'][$i]]), 'prenom' => htmlspecialchars($_POST['Prenom'][$_POST['checkbox'][$i]]), 'Id_nationalite' => htmlspecialchars($_POST['nationalite'][$_POST['checkbox'][$i]]), 'Id_type_formation' => htmlspecialchars($_POST['type_formation'][$_POST['checkbox'][$i]]), 'id' => htmlspecialchars($_POST['Id'][$_POST['checkbox'][$i]])));
                echo 'Personne modifiée.';
                $resultat->closeCursor();
            }
            Catch(Exception $e)
            {
            // message en cas d’erreur
            die('Erreur : '.$e->getMessage());
            }
           /* //Boucle pour les chackbox des formateur cocher
            for ($j=0; $j < count($_POST['checkbox_date']) ; $j++) { 
                // Update pour modifier le tableau stagiaire_formateur en fonction des info recuperer
                try
                {
                    $sql = 'UPDATE Stagiaire_formateur SET Id_stagiaire = :Id_stagiaire , Id_formateur = :Id_formateur , Date_debut = :Date_debut , Date_fin = :Date_fin WHERE Id_stagiaire = :id';
                    // Préparation de la requête avec les marqueurs
                    $resultat = $base->prepare($sql);
                    $resultat->execute(array('Id_stagiaire' => htmlspecialchars($_POST['Id'][$_POST['checkbox_date'][$j]]), 'Id_formateur' => htmlspecialchars($_POST['id_formateur'][$_POST['checkbox_date'][$j]]), 'Date_debut' => htmlspecialchars($_POST['date_debut'][$_POST['checkbox_date'][$j]]), 'Date_fin' => htmlspecialchars($_POST['date_fin'][$_POST['checkbox_date'][$j]]), 'id' => htmlspecialchars($_POST['Id'][$_POST['checkbox'][$i]])));
                    echo 'Personne modifiée.';
                    $resultat->closeCursor();
                }
                Catch(Exception $e)
                {
                // message en cas d’erreur
                die('Erreur : '.$e->getMessage());
                }
            }*/ // FONCTION NON FONCTIONELS CAR MANQUE DE TEMPS
        }
        // une fois que c'est fait je renvoie a la page index
        header("Location:./index.php");
    }else { // sinon je renvoue a la page modifier avec une erreur
        header("Location:./modifier.php?type=error");
    }
    // sur le verif modif il est possible de modifier que la table stagiaire mais il est pour l'instant impossible de modifier la table stagiaire_formateur
?>