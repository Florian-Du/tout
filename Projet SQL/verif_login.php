<?php
    session_start();


    if (isset($_POST['Identifiant']) && isset($_POST['passeword'])) {
    $passe = 0;
        try
        {
            $base = new PDO('mysql:host=127.0.0.1;dbname=uber_tkt', 'root', 'root');
            $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT id_personne , nom, mdp FROM login_passeword WHERE nom = ? AND mdp = ?";
            // Préparation de la requête avec les marqueurs
            $resultat = $base->prepare($sql);
            $resultat->execute(array($_POST['Identifiant'],$_POST['passeword']));
            while ($ligne = $resultat->fetch())
            {
                if ($ligne['nom'] == $_POST['Identifiant'] && $ligne['mdp'] == $_POST['passeword']) {
                    $passe = 1;
                    $_SESSION['id_personne'] = $ligne['id_personne'];
                }
            }
            if ($passe == 1) {
                header("Location:./menu.php");
            }else {
                header("Location:./login.php?Identifiant=incorrect"); 
            }

                $resultat->closeCursor();
                
            }
                
                catch(Exception $e)
            {
            // message en cas d'erreur
            die('Erreur : '.$e->getMessage());
            
        }
    }
?>