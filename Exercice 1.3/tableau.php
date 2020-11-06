<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Truc pays</title>
</head>
<body>
    <?php
        $pays = array('USA','Italie','Allemagne','Russie');

        $villes['USA'][0] = "Paris";
        $villes['USA'][1] = "Lyon";
        $villes['USA'][2] = "Marseille";
        $villes['Italie'][0] = "Rome";
        $villes['Italie'][1] = "Milan";
        $villes['Italie'][2] = "Naples";
        $villes['Allemagne'][0] = "Berlin";
        $villes['Allemagne'][1] = "Munich";
        $villes['Allemagne'][2] = "Francfort";
        $villes['Russie'][0] = "Moscou";
        $villes['Russie'][1] = "Saint-Pétersbourg";
        $villes['Russie'][2] = "Nizhny-Novgorod" ;

        echo "<form action='verif_tableau.php' method='POST'>";
            echo "<select name='pays'>";
                for ($i=0; $i < count($pays); $i++) { 
                    echo "<option value=".$pays[$i].">".$pays[$i]."</option>";
                }
            echo "</select>";
            echo "<button type='submit'> Envoyer </button>";
        echo "</form>";
        
        if (isset($_REQUEST["Pays"])) {
            echo "<div>";
                for ($i=0; $i < count($villes[$_REQUEST["Pays"]]); $i++) { 
                    echo "<option value=".$villes[$_REQUEST["Pays"]][$i].">".$villes[$_REQUEST["Pays"]][$i]."</option>";
                }
            echo "</div>";
        }else {
            echo "<div>";
                for ($i=0; $i < count($villes[$pays[0]]); $i++) { 
                    echo "<option value=".$villes[$pays[0]][$i].">".$villes[$pays[0]][$i]."</option>";
                }
            echo "</div>";
        }
    ?>
</body>
</html>