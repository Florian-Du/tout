<?php

require_once 'Modele/User.php';
require_once 'Vue/Vue.php';
class ControleurUser
{
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function login() {
        $vue = new Vue("Login");
        $vue->generer(array());
    }

    public function Register() {
        $vue = new Vue("Register");
        $vue->generer(array());
    }

    public function connexion($identifiant, $mdp) {
        $requete = $this->user->Connect($identifiant,$mdp);
        if ($requete === "erreur") {
            header("Location:index.php?action=erreurConnect");
        }else {
            $_SESSION['Id_User'] = $requete['id'];
            header("Location:index.php?action=listes");
        }
    }

    public function enrengistrer($identifiant, $mdp) {
        $this->user->createUser($identifiant , $mdp);


    }
}