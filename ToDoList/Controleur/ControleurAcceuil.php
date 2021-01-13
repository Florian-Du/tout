<?php
require_once 'Modele/Liste.php';
require_once 'Vue/Vue.php';

class ControleurAcceuil
{
    private $Listes;

    public function __construct() {
        $this->Listes = new liste();
    }

// Affiche la liste de tous les billets du blog
    public function Acceuil() {
        $Listes = $this->Listes->getListes();
        $vue = new Vue("Acceuil");
        $vue->generer(array('Listes' => $Listes));
    }
}