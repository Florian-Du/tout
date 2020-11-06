<?php
    // Recuperation du fichier pour le login et le mot de passe
    $tableauUser = file("user.txt");
    // condition pour le login
    if (isset($_POST['Identifiant']) && isset($_POST['passeword'])) {
        // Manipulation pour enlever le saut de ligne du file() sur le login
        $userVerif = $tableauUser[0];
        $userVerif = trim($userVerif);
        $utilisateur = "login:".$_POST['Identifiant'];
        // Manipulation pour enlever le saut de ligne du file() sur le mdp
        $passewordVerif = $tableauUser[1];
        $passewordVerif = trim($passewordVerif);
        $passeword = "Passeword:".$_POST['passeword'];

        //si le mdp et le login est bon on revoit a la page ajout_ville.php sinon renvoyer a la page formulaire avec une erreur
        if ($userVerif == $utilisateur && $passewordVerif == $passeword) {
            session_start();
            $_SESSION['login'] = 'true';
            header("Location:./ajout_ville.php"); 
        }else {
            header("Location:./formulaire.php?Identifiant=incorrect"); 
        }
    }

?>