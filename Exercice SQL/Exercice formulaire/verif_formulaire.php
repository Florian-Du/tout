<?php

    if (isset($_POST["checkbox"])) {
        if ($_POST["checkbox"] == "on") {
            if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['Intitule']) && isset($_POST['Date_debut']) && isset($_POST['Date_fin']) && isset($_POST['Email'])) {
                try {
                       
                        $base = new PDO('mysql:host=127.0.0.1;dbname=base1', 'root', 'root');
                        $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        $sql = "INSERT INTO formulaire_inscription (Nom, Prenom, Intitule, Date_debut, Date_fin, Email) VALUES (:nom, :prenom, :Intitule, :Date_debut, :Date_fin, :Email)";
                        // Préparation de la requête avec les marqueurs
                        $resultat = $base->prepare($sql);
                        $resultat->execute(array('nom' => $_POST['nom'],'prenom' => $_POST['prenom'],'Intitule' => $_POST['Intitule'],'Date_debut' => $_POST['Date_debut'], 'Date_fin' => $_POST['Date_fin'], 'Email' => $_POST['Email']));
                        $resultat->closeCursor();
                        header("location:./formulaire.php?formulaire=OK");
                    }
                catch(Exception $e)
                {
                    // message en cas d'erreur
                    die('Erreur : '.$e->getMessage());
                }
            }
        }
    }else {
        header("location:./formulaire.php?checkbox=off");
    }
?>