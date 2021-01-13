<?php


class Article
{
    //variables
    private string $Id;
    private string $Titre;
    private string $Commentaire;
    private string $Image_nom;
    private string $libelle;
    private string $utilisateur;
    private int $id_utilisateur;
    private string $post_date;

    //Constructor

    public function __construct()
    {

    }

    //Accesseur

    public function getImage_nom() :string{
        return $this->Image_nom;
    }
    public function getLibelle() :string{
        return $this->libelle;
    }
    public function setlibelle($libelle) :void{
        $this->libelle = $libelle;
    }
    public function  getId() :string{
        return $this->Id;
    }
    public function  setId($id) :void{
        $this->Id = $id;
    }
    public function getUtilisateur() :string{
        return $this->utilisateur;
    }
    public function setUtilisateur($user) :void{
        $this->utilisateur = $user;
    }
    public function getId_utilisateur() :int{
        return $this->id_utilisateur;
    }
    public function setId_utilisateur($user) :void{
        $this->id_utilisateur = $user;
    }
    public function  getDate() :string{
        return $this->post_date;
    }
    public function  setDate($date) :void{
        $this->post_date = $date;
    }
    public function createId() :void{
        $id = uniqid();
        $this->Id = $id;
    }
    public function  getTitre() :string {
        return $this->Titre;
    }
    public function  setTitre($titre) :void{
        $this->Titre = $titre;
    }
    public function  getCommentaire() :string {
        return $this->Commentaire;
    }
    public function  setCommentaire($commentaire) :void{
        $this->Commentaire = $commentaire;
    }
    public function  getImage() :string{
        return $this->Image_nom;
    }
    public function  createImage($limage) :void{
        $this->Image_nom = $limage;
    }
    public function  setImage($image) :void{ // fonction pour renommer l'image et la mettre dans le repertoire a la creation d'un post ou a la modification et on attribts dans les variabales sont type = libelle et son nom
        $image['name'] = $this->getId().'.'.substr(strrchr($image['name'], '.'), 1 );
        $chemin_destination = './Image/';
        move_uploaded_file($image['tmp_name'],$chemin_destination.$image['name']);
        $this->Image_nom = $image['name'];
        $this->libelle = '.'.substr(strrchr($image['name'], '.'), 1 );
    }

    // Methodes
}