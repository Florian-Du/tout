<?php


class manager_article
{
    //variables

    private PDO $base;

    //constructor
    public function __construct($base)
    {
        $this->base = $base;
    }

    //methodes
    public function insert(Article $article) { // fonction pour inserer un article
        // on dit au code de prendre le texte comme caractere et pas comme du code
        $commentaire = htmlspecialchars($article->getCommentaire());
        $Titre = htmlspecialchars($article->getTitre());
        try
        {
            // on insere l'article
            $sql = "INSERT INTO post (Titre, Commentaire ,post_date ,Libelle_Image ,id_utilisateur ,id_post) VALUES (:Titre, :Commentaire, NOW(), :Libelle_Image, :id_utilisateur, :id_post)";
            // Préparation de la requête avec les marqueurs
            $resultat = $this->base->prepare($sql);
            $resultat->execute(array('Titre' => $Titre,'Commentaire' => $commentaire, 'Libelle_Image' => $article->getLibelle(), 'id_utilisateur' => $article->getId_utilisateur(), 'id_post' => $article->getId()));
            $resultat->closeCursor();

        }
        catch(Exception $e)
        {
            // message en cas d'erreur
            die('Erreur : '.$e->getMessage());
        }
    }
    public function getArticle() :array { // fonction pour recupere tous les articles de la base de donnee
        try
        {

            $sql = "SELECT * FROM post INNER JOIN login_passeword ON login_passeword.Id_Login = post.id_utilisateur";
            // Préparation de la requête avec les marqueurs
            $resultat = $this->base->prepare($sql);
            $resultat->execute();
            $tableau = array();
            while ($ligne = $resultat->fetch())
            {
                // on creer tous les articles au fur et a mesure tant qu'il y en a
                $a = new Article();
                $a->setId($ligne["Id_post"]);
                $a->setUtilisateur($ligne["Identifiant"]);
                $a->setId_utilisateur($ligne["id_utilisateur"]);
                $a->setlibelle($ligne["Libelle_Image"]);
                $a->setDate($ligne["post_date"]);
                $a->setCommentaire($ligne["Commentaire"]);
                $a->setTitre($ligne["Titre"]);
                $a->createImage($ligne["Id_post"].$ligne["Libelle_Image"]);
                array_push($tableau,$a);
            }
            $resultat->closeCursor();
        }
        catch(Exception $e)
        {
            // message en cas d'erreur
            die('Erreur : '.$e->getMessage());
        }
        return $tableau;
    }

    public function getSpecificArticle($id) :object{ // on recupere un article specifique
        try
        {

            $sql = "SELECT * FROM post INNER JOIN login_passeword ON login_passeword.Id_Login = post.id_utilisateur WHERE Id_post = ?";
            // Préparation de la requête avec les marqueurs
            $resultat = $this->base->prepare($sql);
            $resultat->execute(array($id));
            $ligne = $resultat->fetch();
            $a = new Article();
            $a->setId($ligne["Id_post"]);
            $a->setUtilisateur($ligne["Identifiant"]);
            $a->setId_utilisateur($ligne["id_utilisateur"]);
            $a->setlibelle($ligne["Libelle_Image"]);
            $a->setDate($ligne["post_date"]);
            $a->setCommentaire($ligne["Commentaire"]);
            $a->setTitre($ligne["Titre"]);
            $a->createImage($ligne["Id_post"].$ligne["Libelle_Image"]);
            $resultat->closeCursor();
            // on creer l'article puis on return l'article
            return $a;
        }
        catch(Exception $e)
        {
            // message en cas d'erreur
            die('Erreur : '.$e->getMessage());
        }
    }

    public function supprimerArticle($id) :string{ // fonction pour supprimer un article
        // on recupere l'article pour avoir le libelle et l'image
        try
        {
            $sql = "SELECT Libelle_Image , Id_post FROM post WHERE Id_post = ?";
            // Préparation de la requête avec les marqueurs
            $resultat = $this->base->prepare($sql);
            $resultat->execute(array($id));
            $ligne = $resultat->fetch();
            $json = new config_manager();
            $json = $json->getconfig();
            $chemin_destination = $json->{'config'}->{'chemin'};
            unlink($chemin_destination.$ligne['Id_post'].$ligne['Libelle_Image']);
            //on supprime le post
            try
            {
                $sql = "DELETE FROM post WHERE Id_post =:id";
                // Préparation de la requête avec les marqueurs
                $resultat = $this->base->prepare($sql);
                $resultat->execute(array('id' => $id));
                $resultat->closeCursor();
                $resultat->closeCursor();
                return "ok";
            }
            catch(Exception $e)
            {
                // message en cas d'erreur
                die('Erreur : '.$e->getMessage());
            }
            //et on supprime l'image dans le dossier

        }
        catch(Exception $e)
        {
            // message en cas d'erreur
            die('Erreur : '.$e->getMessage());
        }
    }
    public function modifierArticle($article) :string{ // function pour modifier l'article
        // on dit au code de prendre le texte comme caractere et pas comme du code
        $commentaire = htmlspecialchars($article->getCommentaire());
        $Titre = htmlspecialchars($article->getTitre());
        //requete de la modif du post sans l'image
        try
        {
            $sql = 'UPDATE post SET Titre = :titre , Commentaire = :commentaire WHERE Id_post = "'.$article->getId().'"';
            // Préparation de la requête avec les marqueurs
            $resultat = $this->base->prepare($sql);
            $resultat->execute(array('titre' => $Titre, 'commentaire' => $commentaire));
            $resultat->closeCursor();
            return 'ok';
        }
        Catch(Exception $e)
        {
            // message en cas d’erreur
            die('Erreur : '.$e->getMessage());
        }
    }
    public function modifierArticleWithImage($article) :string {
        // on dit au code de prendre le texte comme caractere et pas comme du code
        $commentaire = htmlspecialchars($article->getCommentaire());
        $Titre = htmlspecialchars($article->getTitre());
        // requete pour envoyer la modif du post sur la base de donnee avec l'image
        try
        {
            $sql = "SELECT Libelle_Image , Id_post FROM post WHERE Id_post = ?";
            // Préparation de la requête avec les marqueurs
            $resultat = $this->base->prepare($sql);
            $resultat->execute(array($article->getId()));
            $ligne = $resultat->fetch();
            $json = new config_manager();
            $json = $json->getconfig();
            $chemin_destination = $json->{'config'}->{'chemin'};
            unlink($chemin_destination.$ligne['Id_post'].$ligne['Libelle_Image']);
            $id = $ligne['Id_post'];
            // requete pour modifier l'article
            try
            {
                $sql = 'UPDATE post SET Titre = :titre , Commentaire = :commentaire , Libelle_Image = :libelle_image WHERE Id_post = "'.$article->getId().'"';
                // Préparation de la requête avec les marqueurs
                $resultat = $this->base->prepare($sql);
                $resultat->execute(array('titre' => $Titre, 'commentaire' => $commentaire, 'libelle_image' => $article->getLibelle()));
                // rename du fichier et on le met dans le dossier
                $_FILES['Image_modif']['name'] = $id.'.'.substr(strrchr($_FILES['Image_modif']['name'], '.'), 1 );
                $json = new config_manager();
                $json = $json->getconfig();
                $chemin_destination = $json->{'config'}->{'chemin'};
                move_uploaded_file($_FILES['Image_modif']['tmp_name'],$chemin_destination.$_FILES['Image_modif']['name']);
                $resultat->closeCursor();
                $resultat->closeCursor();
                return "ok";
            }
            Catch(Exception $e)
            {
                // message en cas d’erreur
                die('Erreur : '.$e->getMessage());
            }


        }
        catch(Exception $e)
        {
            // message en cas d'erreur
            die('Erreur : '.$e->getMessage());
        }
    }
}