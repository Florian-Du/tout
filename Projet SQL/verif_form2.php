<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if (isset($_POST['prix_mini']) && isset($_POST['prix_maxi']) && isset($_POST['categorie_plat']) && isset($_POST['type_plat']) && isset($_POST['origine'])) {
            try
            {
                $base = new PDO('mysql:host=127.0.0.1;dbname=uber_tkt', 'root', 'root');
                $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT prix , plat.id_type_nourriture , plat.id_type_plat , plat.id_origine , poids , prix , plat.id_plat , origine.libelle AS libelle_origine , type_plat.libelle AS libelle_type_plat , type_nourriture.libelle AS libelle_type_nourriture , plat.libelle FROM plat INNER JOIN origine ON plat.id_origine = origine.id_origine INNER JOIN type_plat ON plat.id_type_plat = type_plat.id_type_plat INNER JOIN type_nourriture ON plat.id_type_nourriture = type_nourriture.id_type_nourriture WHERE prix <= ? AND prix >= ? AND plat.id_type_nourriture = ? AND plat.id_type_plat = ? AND plat.id_origine = ?";
                // Préparation de la requête avec les marqueurs
                $resultat = $base->prepare($sql);
                $resultat->execute(array($_POST['prix_mini'],$_POST['prix_maxi'],$_POST['categorie_plat'],$_POST['type_plat'],$_POST['origine']));
                while ($ligne = $resultat->fetch())
                {
                    echo '<div>';
                        echo '<h1>'.$ligne["libelle"].'</h1>';
                        echo '<p>'.$ligne["libelle_type_nourriture"].'</p>';
                        echo '<p>'.$ligne["prix"].'€</p>';
                        echo '<p>'.$ligne["libelle_type_plat"].'</p>';
                        echo '<p>'.$ligne["poids"].'</p>';
                        echo '<p>'.$ligne["libelle_origine"].'</p>';
                        //echo '<p>'.$ligne["Ingredient"].'</p>';
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