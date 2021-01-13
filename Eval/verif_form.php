<?php
    // si tous les champs du formulaire sont remplie 
    if (isset($_POST['Nom']) && isset($_POST['prenom']) && isset($_POST['nationalite']) && isset($_POST['type_formation']) && isset($_POST['checkbox']) && isset($_POST['date_debut']) && isset($_POST['date_fin'])) {
        // je me connecte a la BDD
        include "include.php";
         // Je creer le stagiaire
         try
         {
            // si le nom est strictement inferieur a 30
             if ($_POST['Nom'] < 30) {
                 // si le prenom est strictement inferieur a 30
                 if ($_POST['prenom'] < 30) {
                    $sql = "INSERT INTO stagiaire (Nom, Prenom, Id_nationalite, Id_type_formation) VALUES (:nom, :prenom, :nationalite, :type_formation)";
                    // Préparation de la requête avec les marqueurs
                    $resultat = $base->prepare($sql);
                    $resultat->execute(array('nom' => htmlspecialchars($_POST['Nom']),'prenom' => htmlspecialchars($_POST['prenom']),'nationalite' => htmlspecialchars($_POST['nationalite']),'type_formation' => htmlspecialchars($_POST['type_formation'])));
                    echo "L'identifiant de la dernière personne ajoutée est:";
                    echo $base->lastInsertId();
                    $clefs = $base->lastInsertId();
                    $resultat->closeCursor();
                 }else { // sinon on renvoie a la page index avec une erreur
                    header("Location:./index.php?type=length_Prenom");
                 }
             }else { // sinon on renvoie a la page index avec une erreur
                header("Location:./index.php?type=length_Nom");
             }
             
         }
         catch(Exception $e)
         {
             // message en cas d'erreur
             die('Erreur : '.$e->getMessage());
         }
        // Je boucle pour toutes les formations auxquels il est inscrit
        for ($i=0; $i < count($_POST['checkbox']) ; $i++) { 
           
            echo $base->lastInsertId();
            // J'insert toutes les formations auxquels il est inscrit
            try
            {
                // Verification du format de la date et de la longueur  !!! Je crois qu'il y a une erreur avec la regex et quelle ne marche pas !!!
                if (preg_match('^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$' , $_POST['date_debut'][$i]) && preg_match('^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$' , $_POST['date_fin'][$i]) && $_POST['date_fin'][$i] < 11 && $_POST['date_debut'][$i] < 11) {
                    $sql2 = "INSERT INTO stagiaire_formateur (Id_stagiaire, Id_formateur, Date_debut, Date_fin) VALUES (:Id_stagiaire, :Id_formateur, :Date_debut, :Date_fin)";
                    // Préparation de la requête avec les marqueurs
                    $resultat2 = $base->prepare($sql2);
                    $resultat2->execute(array('Id_stagiaire' => $clefs,'Id_formateur' => htmlspecialchars($_POST['checkbox'][$i]),'Date_debut' => htmlspecialchars($_POST['date_debut'][$i]),'Date_fin' => htmlspecialchars($_POST['date_fin'][$i])));
                    echo "L'identifiant de la dernière personne ajoutée est:";
                    echo $base->lastInsertId().".";
                    $resultat2->closeCursor();
                }else { // sinon je renvoie a la page index avec une erreur
                    header("Location:./index.php?type=not_date");
                }
                
            }
            catch(Exception $e)
            {
                // message en cas d'erreur
                die('Erreur : '.$e->getMessage());
            }
        }
        // puis je renvoie a l'index
        header("Location:./index.php");
    }else {
        header("Location:./index.php?type=error");
    }
    
    
?>