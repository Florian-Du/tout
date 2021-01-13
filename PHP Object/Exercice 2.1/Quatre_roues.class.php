<?php
    class Quatre_roues extends Vehicule 
    {
        private int $nombre_porte = 0;

        //constructeur
        public function __construct($couleur,$poids,$nombre_portes)
        {
            parent::__construct($couleur, $poids);
            $this->setNombre_Portes($nombre_portes);
        }

        //accesseurs
        public function getNombre_portes(): int
        {
            return $this->nombre_porte;
        }

        public function setNombre_Portes($nombre_portes) 
        {
            $this->nombre_porte = $nombre_portes;
        }

        //methodes
        public function repeindre($peinture)
        {
            $this->setCouleur($peinture);
            echo "La voiture a ete repeinte </br>";
        }
        public function ajouter_personne($poids_personne)
        {
            $poids = $this->getPoids();
            $poids = $poids + $poids_personne;
            $this->setPoids($poids);
        }
    }
