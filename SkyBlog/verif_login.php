<?php
    session_start();


    if (isset($_POST['Identifiant']) && isset($_POST['passeword'])) {
    $passe = 0;
        try
        {
            $base = new PDO('mysql:host=127.0.0.1;dbname=SkyBlog', 'root', 'root');
            $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT Id_Login , Identifiant, Passeword FROM login_passeword WHERE Identifiant = ? AND Passeword = ?";
            // Préparation de la requête avec les marqueurs
            $resultat = $base->prepare($sql);
            $resultat->execute(array($_POST['Identifiant'],hash("sha256",$_POST['passeword'])));
            while ($ligne = $resultat->fetch())
            {
                if ($ligne['Identifiant'] == $_POST['Identifiant'] && $ligne['Passeword'] == hash("sha256",$_POST['passeword'])) {
                    $passe = 1;
                    $_SESSION['id_personne'] = $ligne['Id_Login'];
                }
            }
            if ($passe == 1) {
                header("Location:./index.php");
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