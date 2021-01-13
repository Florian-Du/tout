<?php

require_once 'Modele/Modele.php';

class liste extends Modele
{
    public function getListes() {
        $sql = 'select id , nom , user_id FROM list order by id desc';
        $Listes = $this->executerRequete($sql);
        return $Listes;
    }
}