<?php
    // On start la session pour pouvoir mettre l'identifiant du compte dedans
    session_start();

    //on verifie que la personne a bien remplie le formulaire 
    if (isset($_POST['Identifiant']) && isset($_POST['passeword'])) {
    $Identifiant = htmlspecialchars($_POST['Identifiant']);
    $passeword = htmlspecialchars($_POST['passeword']);
    //variables "clefs de passage" 
    $passe = 0;
        //requete peremttant d'aller chercher l'identifiant de la personne 
        try
        {
            include 'include.php';
            $sql = "SELECT Id_Login , Identifiant, Passeword FROM login_passeword WHERE Identifiant = ? AND Passeword = ?";
            // Préparation de la requête avec les marqueurs
            $resultat = $base->prepare($sql);
            $resultat->execute(array($Identifiant,hash("sha256",$passeword)));
            while ($ligne = $resultat->fetch())
            {
                //si le mdp de l'identifiant est bon Alors on met la clefs de passage a 1 et on met l'id de la personne dans la session
                if ($ligne['Identifiant'] == $Identifiant && $ligne['Passeword'] == hash("sha256",$passeword)) {
                    $passe = 1;
                    $_SESSION['id_personne'] = $ligne['Id_Login'];
                }
            }
            //si la clefs de passage est a 1 on renvoie a index
            if ($passe == 1) {
                header("Location:./index.php");
            }else { // sinon on renvoie a la page de conenxion avec identifiant incorrect
                header("Location:./login.php?Identifiant=incorrect"); 
            }

                $resultat->closeCursor();
                
            }
                
                catch(Exception $e)
            {
            // message en cas d'erreur
            die('Erreur : '.$e->getMessage());
            
        }
    }else { // Sinon on la renvoie re-remplir le formulaire avec un message d'erreur
        header("Location:./login.php?connected=ERREUR");
    }
?>