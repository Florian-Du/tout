<?php
    abstract class Vehicule
    {
        private string $couleur = "";
        private int $poids = 0;
        const SAUT_DE_LIGNE = "</br>";
        protected static int $nombre_changement_couleur = 0;

        //constructeur
        public function __construct($couleur , $poids)
        {
            echo "appelle du constructeur </br>";
            $this->setCouleur($couleur);
            $this->setPoids($poids);
        }

        //accesseurs
        public function getCouleur(): string
        {
            return $this->couleur;
        }
        public function setCouleur($couleur)
        {
            $this->couleur = $couleur;
            Vehicule::$nombre_changement_couleur++;
        }
        public function getPoids() : int
        {
            return $this->poids;
        }
        public function setPoids($poids) 
        {
            if ($this->poids >= 2100) {
                $this->poids = 2100;
            }else {
                $this->poids = $poids;
            }
        }

        // methodes
        public function rouler() {
            echo "le vehiclue roule </br>";
        }
        public static function afficher_attribut(Vehicule $object)
        {
            if (method_exists($object,'getCouleur')) {
                echo "La couleur du vehicule est ".$object->getCouleur().Vehicule::SAUT_DE_LIGNE;
            }
            if (method_exists($object,'getPoids')) {
                echo "Le poids du vehicule est de ".$object->getPoids()." Kg".Vehicule::SAUT_DE_LIGNE;
            }
            if (method_exists($object,'getNombre_portes')) {
                echo "Le vehicule a ".$object->getNombre_portes()." portes".Vehicule::SAUT_DE_LIGNE;
            }
            if (method_exists($object,'getCylindree')) {
                echo "Le vehicule est un ".$object->getCylindree()." cylindree".Vehicule::SAUT_DE_LIGNE;
            }
            if (method_exists($object,'getLongueur')) {
                echo "Le vehicule mesure ".$object->getLongueur()." mètres".Vehicule::SAUT_DE_LIGNE;
            }
            if (method_exists($object,'getNombre_pneu_neige')) {
                echo "Le vehicule est equipé de ".$object->getNombre_pneu_neige()." pneu neiges".Vehicule::SAUT_DE_LIGNE;
            }
            echo "la couleur de la voiture a ete changée ".Vehicule::$nombre_changement_couleur." fois".Vehicule::SAUT_DE_LIGNE;
        }
        
        abstract public function ajouter_personne($poids_personne);
    }
