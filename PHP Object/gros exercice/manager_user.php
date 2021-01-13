<?php


class manager_user
{
    static private PDO $base;
    //constructor

    //accessor
    static public function getBase() :PDO{
        return self::$base;
    }
    static public function setBase($base) :void{
        self::$base = $base;
    }
    //methodes
    static public function connexion($user) :string { // function pour se connecter
        // on start la session pour mettre les identifiants dedans
        session_start();
        // on recupere la connexion a la base de donnee avec la fonction manager_article
        self::setBase(Base::getBase());
        // on dit au code de prendre le texte comme caractere et pas comme du code
        $Identifiant = htmlspecialchars($user->getLibelle_user());
        $passeword = htmlspecialchars($user->getPasseword());
        //variables "clefs de passage"
        $passe = 0;
        // on se recupere les identifiants
        try
        {
            $sql = "SELECT Id_Login , Identifiant, Passeword FROM login_passeword WHERE Identifiant = ? AND Passeword = ?";
            // Préparation de la requête avec les marqueurs
            $resultat = self::$base->prepare($sql);
            $resultat->execute(array($Identifiant,hash("sha256",$passeword)));
            while ($ligne = $resultat->fetch())
            {
                //si le mdp de l'identifiant est bon Alors on met la clefs de passage a 1 et on met l'id et le libelle de de la personne dans la session
                if ($ligne['Identifiant'] == $Identifiant && $ligne['Passeword'] == hash("sha256",$passeword)) {
                    $passe = 1;
                    $_SESSION['id_personne'] = $ligne['Id_Login'];
                    $_SESSION['LibelleUser'] = $ligne['Identifiant'];
                }
            }
            //si la clefs de passage est a 1 on return ok
            if ($passe == 1) {
                $resultat->closeCursor();
                return "ok";
            }else { // sinon on return incorrect
                $resultat->closeCursor();
                return "incorrect";
            }



        }

        catch(Exception $e)
        {
            // message en cas d'erreur
            die('Erreur : '.$e->getMessage());

        }
    }
    static public function createUser($user){ // fonction pour creer un utilisateur
        // on recupere la connexion a la base de donnee avec le manager_article
        self::setBase(Base::getBase());
        // on recupere les utilsateur pour verifier qu'il n'y en as as deux qui ont les memes identifiants
        try
        {
            $sql = "SELECT * FROM login_passeword WHERE Identifiant = ?";
            // Préparation de la requête avec les marqueurs
            $resultat2 = self::getBase()->prepare($sql);
            $resultat2->execute(array($user->getLibelle_user()));
            $ligne = $resultat2->fetch();
            // si il n'y as pas d'autres utilisateur avec le meme identifiants
            if ($ligne === false){
                // on dit au code de prendre le texte comme caractere et pas comme du code
                $Identifiant = htmlspecialchars($user->getLibelle_user());
                $Passeword = hash("sha256",htmlspecialchars($user->getPasseword()));
                // et on insert un nouvelle utilisateur
                try
                {
                    $sql = "INSERT INTO login_passeword (Identifiant, Passeword) VALUES (:Identifiant, :Passeword)";
                    // Préparation de la requête avec les marqueurs
                    $resultat = self::$base->prepare($sql);
                    $resultat->execute(array('Identifiant' => $Identifiant,'Passeword' => $Passeword));
                    $resultat2->closeCursor();
                    return self::$base->lastInsertId();
                }
                catch(Exception $e)
                {
                    // message en cas d'erreur
                    die('Erreur : '.$e->getMessage());
                }

            }else {
                $resultat2->closeCursor();
                return 4;
            }


        }
        catch(Exception $e)
        {
            // message en cas d'erreur
            die('Erreur : '.$e->getMessage());
        }


    }
}