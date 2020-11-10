<?php
    if (isset($_POST['recherche']) ) {
        try
        {
            $base = new PDO('mysql:host=127.0.0.1;dbname=uber_tkt', 'root', 'root');
            $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT plat.id_plat , plat.libelle  AS libelle_plat , origine.libelle AS libelle_origine , type_plat.libelle AS libelle_type_plat , type_nourriture.libelle AS libelle_type_nourriture , poids , prix FROM plat INNER JOIN origine ON plat.id_origine = origine.id_origine INNER JOIN type_plat ON plat.id_type_plat = type_plat.id_type_plat INNER JOIN type_nourriture ON plat.id_type_nourriture = type_nourriture.id_type_nourriture WHERE plat.libelle LIKE ?";
            // Préparation de la requête avec les marqueurs
            $resultat = $base->prepare($sql);
            $resultat->execute(array('%'.$_POST['recherche'].'%'));
            while ($ligne = $resultat->fetch())
            {
                echo '<div>';
                    echo '<h1>'.$ligne["libelle_plat"].'</h1>';
                    echo '<form action="panier.php" method="POST" name="formulaire">';
                        echo '<input type="number" name="ajout_panier_quantite" placeholder="combien ?" />';
                        echo '<input type="text" name="id_plat_panier" placeholder="combien ?" style="display:none;" value="'.$ligne["id_plat"].'" />';
                        echo '<button type="submit" name="ok" value="envoyer"> Ajouter </button>';
                    echo '</form>';
                    echo '<p>'.$ligne["libelle_type_nourriture"].'</p>';
                    echo '<p>'.$ligne["prix"].'€</p>';
                    echo '<p>'.$ligne["libelle_type_plat"].'</p>';
                    echo '<p>'.$ligne["poids"].'</p>';
                    echo '<p>'.$ligne["libelle_origine"].'</p>';
                    echo '<p>';
                    $sql2 = "SELECT plat_ingredient.id_ingredient , ingredient.libelle AS libelle_ingredient FROM Ingredient INNER JOIN plat_ingredient ON ingredient.id_ingredient = plat_ingredient.id_ingredient WHERE plat_ingredient.id_plat = ?";
                    // Préparation de la requête avec les marqueurs
                    $resultat2 = $base->prepare($sql2);
                    $resultat2->execute(array($ligne['id_plat']));
                    while ($ligne2 = $resultat2->fetch()) {
                        
                            
                            echo $ligne2["libelle_ingredient"].", " ;
                            

                        
                    }
                    echo '</p>';
                echo '</div>';
            }
            

                $resultat->closeCursor();
                
            }
                
                catch(Exception $e)
            {
            // message en cas d'erreur
            die('Erreur : '.$e->getMessage());
            
        }
    }
?>