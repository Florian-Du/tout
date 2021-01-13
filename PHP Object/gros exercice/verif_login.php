<?php
    //on include toutes les classes
    include "Autoload.php";
    // on creer un utilisateur
    $user = new utilisateur();
    // on lui definie ses identifiants
    $user->setLibelle_user($_POST["Identifiant"]);
    $user->setPasseword($_POST["password"]);
    // on creer un manager_user
    $m = new manager_user();
    // on se connecte et on stock ce que la fonction return dans la variables $connexion
    $connexion = manager_user::connexion($user);
    if ($connexion == "ok") { // si la connexion est ok
        // on renvoie au menu
        header("Location:./menu.php");
    }else if ($connexion == "incorrect"){ // si la connexion est incorrect
        // on renvoie a la page login avec un essgae d'erreur
        header("Location:./login.php?Identifiant=incorrect");
    }
