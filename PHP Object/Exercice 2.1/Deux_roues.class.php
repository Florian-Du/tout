<?php
    class Deux_roues extends Vehicule
    {
        private int $cylindree = 0;

        //accesseurs
        public function getCylindree() : int
        {
            return $this->cylindree;
        }
        public function setCylindree($cylindree)
        {
            $this->cylindree = $cylindree;
        }

        //methodes
        public function mettre_essence($nombre_litre)
        {
            $poids = $this->getPoids();
            $poids = $poids + $nombre_litre;
            $this->setPoids($poids);
            echo "Le plein est fait </br>";
        }
        public function ajouter_personne($poids_personne)
        {
            $poids = $this->getPoids();
            $poids = $poids + $poids_personne + 2;
            $this->setPoids($poids);
        }
    }
