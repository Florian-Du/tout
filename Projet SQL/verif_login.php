<?php
    session_start();


    if (isset($_POST['Identifiant']) && isset($_POST['passeword'])) {
    $passe = 0;
        try
        {
            $base = new PDO('mysql:host=127.0.0.1;dbname=uber_tkt', 'root', 'root');
            $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT Id , Identifiant, Passeword FROM login_passeword WHERE Identifiant = ? AND Passeword = ?";
            // Préparation de la requête avec les marqueurs
            $resultat = $base->prepare($sql);
            $resultat->execute(array($_POST['Identifiant'],$_POST['passeword']));
            while ($ligne = $resultat->fetch())
            {
                if ($ligne['Identifiant'] == $_POST['Identifiant'] && $ligne['Passeword'] == $_POST['passeword']) {
                    $passe = 1;
                    $_SESSION['id_personne'] = $ligne['id_personne'];
                }
            }
            if ($passe == 1) {
                echo 'correct';
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