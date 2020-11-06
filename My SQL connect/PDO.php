
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
    try
    {
    // Connexion à la base de données
    $base = new PDO('mysql:host=127.0.0.1;dbname=base1', 'root', 'root');
    $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //appelle de la procédure stockée et de la requête récupérant le paramètre de sortie.
    $statement = $base->prepare('CALL cube(:entree, @sortie); SELECT @sortie AS sortie;');
    $entree = 3;
    $statement->bindParam(':entree', $entree);
    //exécution de la procédure stockée
    $statement->execute();
    $statement->nextRowset();
    //lecture du paramètre de sortie
    $row = $statement->fetchObject();
    echo "La valeur ".$entree." au cube est:".$row->sortie;
    }
    catch(Exception $e)
    {
    // message en cas d'erreur
    die('Erreur : '.$e->getMessage());
    }
?>
</body>
</html>
