<?php

require_once 'Controleur/ControleurAcceuil.php';
require_once 'Controleur/ControleurListe.php';
require_once 'Controleur/ControleurUser.php';
require_once 'Vue/Vue.php';
class Routeur {

    private $ctrlAccueil;
    private $ctrlListe;
    private $ctrlUser;

    public function __construct() {
        $this->ctrlAccueil = new ControleurAcceuil();
        $this->ctrlListe = new ControleurListe();
        $this->ctrlUser = new ControleurUser();
    }

    // Route une requête entrante : exécution l'action associée
    public function routerRequete() {
        try {
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'listes') {
                    $this->ctrlAccueil->Acceuil();
                }else if ($_GET['action'] == 'Login') {
                    if (isset($_POST['Identifiant']) && isset($_POST['mdp'])) {
                        $this->ctrlUser->connexion($_POST['Identifiant'],$_POST['mdp']);
                    }
                }else if ($_GET['action'] == 'connexion') {
                    $this->ctrlUser->login();
                }else if ($_GET['action'] == 'pageRegister') {
                    $this->ctrlUser->Register();
                }else if ($_GET['action'] == 'ajouterUser') {
                    if (isset($_POST['Identifiant']) && isset($_POST['mdp']) && isset($_POST['confirm_mdp'])) {
                        if ($_POST['mdp'] === $_POST['confirm_mdp']) {
                            $this->ctrlUser->enrengistrer($_POST['Identifiant'] , $_POST['mdp']);
                        }
                    }
                }
                else
                    throw new Exception("Action non valide");
            }
            else {  // aucune action définie : affichage de l'accueil
                $this->ctrlAccueil->Acceuil();
            }
        }
        catch (Exception $e) {
            $this->erreur($e->getMessage());
        }
    }

    // Affiche une erreur
    private function erreur($msgErreur) {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }

    // Recherche un paramètre dans un tableau
    private function getParametre($tableau, $nom) {
        if (isset($tableau[$nom])) {
            return $tableau[$nom];
        }
        else
            throw new Exception("Paramètre '$nom' absent");
    }

}
