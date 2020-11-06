<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
</head>
<body>
    <form action="verif_form1.php" method="POST" name="formulaire">
        <p>Liste des plats contenant l'ingrédiant suivant : <select name="Ingredient" id="ingredient-select"></p>
            <option>--Please choose an option--</option>
            <?php
                try
                {
                    $base = new PDO('mysql:host=127.0.0.1;dbname=uber_tkt', 'root', 'root');
                    $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    $sql = "SELECT id_ingredient , libelle FROM ingredient";
                    // Préparation de la requête avec les marqueurs
                    $resultat = $base->prepare($sql);
                    $resultat->execute();
                    while ($ligne = $resultat->fetch())
                    {
                        echo '<option value="'.$ligne['id_ingredient'].'">'.$ligne['libelle'].'</option>';
                    }
                    $resultat->closeCursor();
                }
                catch(Exception $e)
                {
                // message en cas d'erreur
                    die('Erreur : '.$e->getMessage());
                }
            ?>
        </select>
        <button type="submit" name="ok" value="envoyer"> Ok </button>
    </form>

    <form action="verif_recherche.php" method="POST" name="formulaire">
        <p> Chercher un plat : <input type="texte" name="recherche" /><button type="submit" name="ok" value="envoyer"> Ok </button></p>
        
    </form>

    <form action="verif_form2.php" method="POST" name="formulaire">
        <p> Liste des plats par fourchette de prix, par categorie de plat , type de plat et par origine de plat</p>
        <p> Choisir prix maxi : <input type="number" name="prix_mini" /></p>
        <p> Choisir prix mini : <input type="number" name="prix_maxi" /></p>
        <p> Choisir une categorie de plat : <select name="categorie_plat" id="categorie_plat-select"></p>
            <?php
                try
                {
                    $base = new PDO('mysql:host=127.0.0.1;dbname=uber_tkt', 'root', 'root');
                    $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    $sql = "SELECT id_type_nourriture , libelle FROM type_nourriture";
                    // Préparation de la requête avec les marqueurs
                    $resultat = $base->prepare($sql);
                    $resultat->execute();
                    while ($ligne = $resultat->fetch())
                    {
                        echo '<option value="'.$ligne['id_type_nourriture'].'">'.$ligne['libelle'].'</option>';
                    }
                    $resultat->closeCursor();
                }
                catch(Exception $e)
                {
                // message en cas d'erreur
                    die('Erreur : '.$e->getMessage());
                }
            ?>
        </select>
        <p> Choisir un type de plat : <select name="type_plat" id="type_plat-select"></p>
            <?php
                try
                {
                    $base = new PDO('mysql:host=127.0.0.1;dbname=uber_tkt', 'root', 'root');
                    $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    $sql = "SELECT id_type_plat , libelle FROM type_plat";
                    // Préparation de la requête avec les marqueurs
                    $resultat = $base->prepare($sql);
                    $resultat->execute();
                    while ($ligne = $resultat->fetch())
                    {
                        echo '<option value="'.$ligne['id_type_plat'].'">'.$ligne['libelle'].'</option>';
                    }
                    $resultat->closeCursor();
                }
                catch(Exception $e)
                {
                // message en cas d'erreur
                    die('Erreur : '.$e->getMessage());
                }
            ?>
        </select>
        <p> Choisir origine : <select name="origine" id="origine-select"></p>
            <?php
                try
                {
                    $base = new PDO('mysql:host=127.0.0.1;dbname=uber_tkt', 'root', 'root');
                    $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    $sql = "SELECT id_origine , libelle FROM origine";
                    // Préparation de la requête avec les marqueurs
                    $resultat = $base->prepare($sql);
                    $resultat->execute();
                    while ($ligne = $resultat->fetch())
                    {
                        echo '<option value="'.$ligne['id_origine'].'">'.$ligne['libelle'].'</option>';
                    }
                    $resultat->closeCursor();
                }
                catch(Exception $e)
                {
                // message en cas d'erreur
                    die('Erreur : '.$e->getMessage());
                }
            ?>
        </select>
        <button type="submit" name="ok" value="envoyer"> Ok </button>
    </form>
</body>
</html>