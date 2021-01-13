<?php

require_once 'Modele/liste.php';
require_once 'Vue/Vue.php';

class ControleurListe
{

    private $Liste;

    public function __construct() {
        $this->Liste = new Liste();
    }

    public function Listes() {
        $Listes = $this->Liste->getListes();
        $vue = new Vue("Acceuil");
        $vue->generer(array('Acceuil' => $Listes));
    }
}