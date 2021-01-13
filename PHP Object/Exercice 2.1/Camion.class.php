<?php
    class Camion extends Quatre_roues implements Action
    {
        private int $longeur = 5;

        //accesseurs
        public function getLongueur(): int
        {
            return $this->longeur;
        }
        public function setLongueur($longueur) 
        {
            $this->longeur = $longueur;
        }

        //methodes
        public function ajouter_remorque($longueur_remorque)
        {
            $this->longeur = $this->longeur + $longueur_remorque;
        }
        public function mettre_essence($nombre_litre)
        {
            $poids = $this->getPoids();
            $poids = $poids + $nombre_litre;
            $this->setPoids($poids);
            echo "Le plein est fait </br>";
        }
    }
