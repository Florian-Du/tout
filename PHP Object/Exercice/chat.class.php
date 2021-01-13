<?php
    class Chat extends Animal
    {
        private $race; //race du chat
        //accesseurs
        public function getRace()
        {
            return $this->race; //retourne la race
        }
        public function setRace($race)
        {
            $this->race = $race; //écrit dans l'attribut race
        }
        //méthode
        public function miauler()
        {
            echo "Miaou <br />";
        }
        public function respire()
        {
            echo "Le chat respire.<br />";
        }
    }

?>