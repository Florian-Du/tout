<?php
    class Voiture extends Quatre_roues
    {
        private int $nombre_pneu_neige = 0;

        //accesseurs
        public function getNombre_pneu_neige() : int
        {
            return $this->nombre_pneu_neige;
        }

        //methodes
        public function ajouter_pneu_neige($nombre) {
            if ($this->nombre_pneu_neige + $nombre >= 4) {
                $this->nombre_pneu_neige = 4;
            }else {
                $this->nombre_pneu_neige = $this->nombre_pneu_neige + $nombre;
            }
        }
        public function enlever_pneu_neige($nombre) {
            if ($this->nombre_pneu_neige - $nombre <= 0) {
                $this->nombre_pneu_neige = 0;
            }else {
                $this->nombre_pneu_neige = $this->nombre_pneu_neige - $nombre;
            }
        }
        public function ajouter_personne($poids_personne)
        {
            parent::ajouter_personne($poids_personne);
            if ($this->getPoids()>1500 && $this->nombre_pneu_neige<=2) {
                echo "Attention, veuillez mettre 4 pneus neige";
            }
        }
    }