<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if (isset($_POST['Ingredient']) ) {
            try
            {
                $base = new PDO('mysql:host=127.0.0.1;dbname=uber_tkt', 'root', 'root');
                $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT poids , prix , plat.id_plat , origine.libelle AS libelle_origine , type_plat.libelle AS libelle_type_plat , type_nourriture.libelle AS libelle_type_nourriture , plat.libelle FROM plat INNER JOIN origine ON plat.id_origine = origine.id_origine INNER JOIN type_plat ON plat.id_type_plat = type_plat.id_type_plat INNER JOIN type_nourriture ON plat.id_type_nourriture = type_nourriture.id_type_nourriture INNER JOIN plat_ingredient ON plat.id_plat = plat_ingredient.id_plat WHERE plat_ingredient.id_ingredient = ?;";
                // Préparation de la requête avec les marqueurs
                $resultat = $base->prepare($sql);
                $resultat->execute(array($_POST['Ingredient']));
                while ($ligne = $resultat->fetch())
                {
                    echo '<div>';
                            echo '<h1>'.$ligne["libelle"].'</h1>';
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
</body>
</html>