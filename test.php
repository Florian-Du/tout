<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel='stylesheet' href="./test.css">
    <title>TEST</title>
</head>
<body>
    <?php
        define("VITESSE_LUMIERE","299792 km/s");
        echo "<p>La vitesse de la lumière est " .VITESSE_LUMIERE."</p>";

        define("PI","3.141592");
        echo"<p>La valeur entière de PI est " .PI."</p>";

        for ($i=1; $i < 21; $i++) {
            if ($i <= 10) {
                echo "<p class='Moins10'>".$i."</p>";
            } else {
                echo "<p class='Plus10'>".$i."</p>";
            }
            
        }
        
    ?>
    </br>
    <?php
        $tableau = array();
        $tableau2 = array();
        $tableau3 = array();
        for ($j=1; $j < 21; $j++) {
            if ($j < 11) {
                array_push($tableau,$j);
            } else {
                array_push($tableau2,$j);
            } 
        }
        for ($k=0; $k < count($tableau); $k++) {
            array_push($tableau3,$tableau[$k]+$tableau2[$k]);
        }
        for ($l=0; $l < count($tableau3); $l++) { 
            echo "<p class='Plus'>".$tableau3[$l]."</p>";
        }
    ?>
    
    <table border="1">
        <?php
            $tab_caracteristique_dupont = array("prénom" => "PAUL","profession" => "ministre","age" => 50);
            $tab_caracteristique_durand = array("prénom" => "ROBERT","profession" => "agriculteur","age" => 45);
            $tab_caracteristique_martie = array("prénom" => "FLORENT","profession" => "guignol","age" => 17, "Qi" => "negatif");
            $tab_personne['DUPONT'] = $tab_caracteristique_dupont;
            $tab_personne['DURAND'] = $tab_caracteristique_durand;    
            $tab_personne['MARTIE'] = $tab_caracteristique_martie;

            echo "<tr>";
                echo "<th>Cle</th>";
                echo "<th colspan=2>Valeur</th>";
            echo "</tr>";
            foreach ($tab_personne as $key => $value) {
                echo "<th rowspan=".(count($tab_personne[$key])+1).">".$key."</th>";
                echo "<th>Clé</th>";
                echo "<th>Valeur</th>";
                foreach ($value as $key2 => $value2) {
                    echo "<tr>";
                        echo "<th>".$key2."</th>";
                        echo "<th>".$value2."</th>";
                    echo "</tr>";
                } 
            }
        ?>
    </table>
    <?php
        $tab1 = array(6,25,35,61);
        $tab2 = array(12,24,46);
        $total = 0;
        
        for ($b=0; $b < count($tab1); $b++) { 
            for ($n=0; $n < count($tab2); $n++) { 
                $total += ($tab1[$b]*$tab2[$n]);
            }
        }
        echo "<p class='Plus'>".$total."</p>";
    ?>
    <?php
        $tabBannieres = array(
            1 => array('https://www.w3schools.com/' ,'./Image/lossantos.jpeg' ,'La ville de lossantos est a toi'),
            2 => array('https://www.w3schools.com/','./Image/troy.jpeg','Deviens le meilleur guerrier de troy'),
            3 => array('https://www.w3schools.com/','./Image/onepiece.jpg','Deviens le plus grand roi des pirates')
        );

        $hasard = array_rand($tabBannieres,1);
        echo "<a class='Limage' href=\"".$tabBannieres[$hasard][0]."\">
            <img class='Limage' src=\"".$tabBannieres[$hasard][1]."\" alt=\"".$tabBannieres[$hasard][2]."\"/>
        </a>";
    ?>
    <?php
        $phrase = "Bonjour Monsieur Dupont";
        $phrase = strtoupper($phrase);
        $phrase = str_replace("DUPONT","DURAND",$phrase);
        echo "<p>".$phrase." Contient ".strlen($phrase)." lettres</p>";
    ?>
    <?php
        $email = ".jean.dupont@france.fr";
        if (strpos($email,"@") && strrpos($email,".")) {
            echo "Email correct";
        }else {
            echo "Email incorrect";
        }
    ?>
    <?php
        $nombre = 15;
        if (preg_match("/^-?[0-9]{1,3}$/",$nombre)) {
            echo "<p>OUI</p>";
        }else {
            echo "<p>NON</p>";
        }
    ?>
    <?php
        $date = "20/10/2020";
        if (preg_match("/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{2,4}$/",$date)) {
            echo "<p>La date est juste</p>";
        }else {
            echo "<p>La date est fausse</p>";
        }
    ?>
    <?php
        echo facto(5);
        function facto($n) {
            $total = 1;
            for ($i=1; $i < $n+1; $i++) { 
                $total = $total*$i;
            }
            return $total;
        }
    ?>
    <?php
        echo toEuros(500);
        function toEuros($franc) {
            $euro = $franc/6.5596;
            return $euro;
        }
    ?>
    <table border="1">
        <?php
            for ($but=0; $but < 1050; $but += 50) { 
                echo "<tr>";
                    echo "<th>".$but."</th>";
                    echo "<th>".toEuros($but)."</th>";
                echo "<tr>";
            }
        ?>
    </table>
    <?php  
        echo factoRecursif(20);
        function factoRecursif($n ,$total=1) {
            if ($n > 0) {
                $total = $total*$n;
                $n--;
                return factoRecursif($n , $total);
            }else {
                return $total;
            }
        }
    ?>
    <?php
        $tab = array(5,66,8,59,91,70,5,24,44,69);
        $leplusgrand = 0;
        
        $pos = 0;
        $pos2 = 0;
        for ($i=count($tab)-1; $i > 0; $i--) { 
            $leplusgrand = 0;
            for ($a=0; $a <= $i; $a++) { 
                if ($leplusgrand < $tab[$a]) {
                    $leplusgrand = $tab[$a];
                    $pos = $a;
                }
            }
            $pos2 = $i;
            echange($pos,$pos2,$tab);
        }
        var_dump($tab);

        function echange($pos,$pos2,&$tab) {
            $echange = 0;
            $echange = $tab[$pos2];
            $tab[$pos2] = $tab[$pos];
            $tab[$pos] = $echange;
        }
    ?>
    <?php
        $tableauDeMot = array("Bonjour","Monsieur","ou","Madame","Lewandoski");

        echo "<p class='Plus'>";
            for ($z=count($tableauDeMot); $z > 0 ; $z--) { 
                $cle = array_rand($tableauDeMot);
                echo " ".$tableauDeMot[$cle];
                unset($tableauDeMot[$cle]);
            }
        echo "</p>"
        
    ?>
    <?php

        $tableauA = array(3,8,15,16);
        $tableauB = array();
            echo "<table border=1>";
        for ($e=1; $e < 21; $e++) { 
            
                if ($e != $tableauA[0] && $e != $tableauA[1] && $e != $tableauA[2] && $e != $tableauA[3]) {
                    array_push($tableauB , $e);
                    echo "<tr>";
                        echo "<th>".$e."</th>";
                        echo "<th>".auCube($e)."</th>";
                    echo "</tr>";
                }
            
        }
        var_dump($tableauB);
        echo "</table>";

        function auCube($chiffreAuCube) {
            $total = $chiffreAuCube**3;
            return $total;
        }
    ?>
    <?php
        $contenue = file_get_contents('file.txt');
        echo "<p>".$contenue."</p>";
        $exemplee = readfile("file.txt");
        echo "<p>".$exemplee."</p>";
        $tableauLigne = file("file.txt");
        foreach ($tableauLigne as $Ligne) {
            echo "<p>".$Ligne."</p>";
        }
        $contenu = "Bonjour Mr Florian";
        file_put_contents("file.txt",$contenu);

        $ressource = fopen('file.txt', 'r');
        if (!$ressource) { //vérifie si le fichier est bien ouvert
            echo "Impossible d'ouvrir le fichier fichier.txt";
        }
        //boucle tant qu'il y a un caractère
        while (false !== ($char = fgetc($ressource))) {
            echo $char;
        }
        fclose($ressource); 
    ?>
    <?php
        $ressource = fopen('file.txt', 'w');
        if ($ressource) {
            fwrite($ressource, 'Bonjour Madame Durand.'.PHP_EOL);
        }
        fclose($ressource); 
    ?>
</body>
</html>

