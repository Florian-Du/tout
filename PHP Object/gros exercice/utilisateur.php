<?php


class utilisateur
{
    //variables
    private int $Id;
    private string $libelle_user;
    private string $Passeword;

    //accessor
    public function getId() :int{
        return $this->Id;
    }
    public function setId($id) :void{
        $this->Id = $id;
    }
    public function getLibelle_user() :string{
        return $this->libelle_user;
    }
    public function setLibelle_user($libelle) :void{
        $this->libelle_user = $libelle;
    }
    public function getPasseword() :string{
        return $this->Passeword;
    }
    public function setPasseword($passeword) :void{
        $this->Passeword = $passeword;
    }

}