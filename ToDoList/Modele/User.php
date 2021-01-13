<?php

require_once 'Modele/Modele.php';
class User extends Modele
{
    //pour suppriemr le billet
    public function Connect($identifiant, $mdp) {
        $password = hash("sha256",$mdp);
        $sql = 'select id , username , password from user where username=? AND password=?';
        $user = $this->executerRequete($sql, array($identifiant,$password));
        $ligne = $user->rowcount();
        if ($ligne > 0) {
            return $user->fetch();
        }else {
            return "erreur";
        }
    }

    public function createUser($identifiant, $mdp) {
        $password = hash("sha256",$mdp);
        $sql = 'INSERT INTO user (username, password) VALUES (:username, :password)';
        $usercreated = $this->executerRequete($sql, array(":username" => $identifiant, ":password" => $password));
        $compteur = $usercreated->rowCount();//mettre avec le dernier utilisateur creer si oui alros renvoyer a la page connexion
        if ($compteur > 0){

        }
    }
}