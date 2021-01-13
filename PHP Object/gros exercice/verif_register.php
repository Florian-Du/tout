<?php
// on start la session pour recuperer les identifiants
session_start();
// si tous les champ sont remplie
 if (isset($_POST['Identifiant']) && isset($_POST['passeword']) && isset($_POST['confirm_passeword'])) {
     // et que le champ mot de passe = au champ confirmez le mot de passe
     if ($_POST['passeword'] == $_POST['confirm_passeword']){
         // on include toutes les classes + la connexion a la base de donne
         include "Autoload.php";
         // on creer un manager user
         $m = new manager_user();
         // on creer un utlisateur
         $u = new utilisateur();
         // on set le libelle user dans l'user
         $u->setLibelle_user($_POST['Identifiant']);
         // on set le password user dans l'user
         $u->setPasseword($_POST['passeword']);
         // on creer l'user dans la bdd et on stock que la fonction return dans $return
         $return = $_SESSION['id_personne'] = $m::createUser($u);
         if ($return == 4){ // si la fonction return 4 ca veut dire qu'un profil existe deja avec cet identifiant
             // alors on renvoie a la page register avec un messgae comme quoi cet identifiant est deja utiliser
             header("Location:./register.php?register=already");
         }else { // si tout est bon
             // on stock le libelle user dans la session
             $_SESSION['LibelleUser'] = $_POST['Identifiant'];
             //et on renvoie au menu
             header("Location:./menu.php");
         }
     }
 }else {
     // sinon on renvoie a la page register avec une erreur
     header("Location:./register.php?register=ERREUR");
 }