<?php 

$moins50 = 0;
$moins100 = 0;
$moins500 = 0;
$moins1000 = 0;
$plus1000 = 0;

if ($pointeur = opendir("./Image")) {
    chdir("./Image");
    while (false !== ($fichier = readdir($pointeur))) { //tant qu'il existe un fichier dans le répertoire
        if ($fichier != "." && $fichier != "..") {
            $tailleFichier = filesize($fichier)/1024;
            if ($tailleFichier < 50) {
                $moins50++;
            }
            else if ($tailleFichier < 100) {
                $moins100++;
            }
            else if ($tailleFichier < 500) {
                $moins500++;
            }
            else if ($tailleFichier < 1000) {
                $moins1000++;
            }
            else if ($tailleFichier > 1000) {
                $plus1000++;
            }
        }
    }
}
header("Content-type: image/png");

$tableau_visites = array($moins50, $moins100, $moins500, $moins1000, $plus1000);  

$largeurImage = 1000;  
$hauteurImage = 600;  
$image = imagecreate($largeurImage, $hauteurImage);  
$blanc = imagecolorallocate($image, 255, 255, 255);  
$noir = imagecolorallocate($image, 0, 0, 0);  
$rouge = imagecolorallocate($image, 255, 0, 0);  

// trait horizontal pour représenter l'axe des jours  
imageline($image, 30, $hauteurImage-30, $largeurImage-30, $hauteurImage-30,  $noir);  

// Affichage du numéro des jours  
$tableauValeur = array("< 50 ko","< 100 ko","< 500 ko","< 1000 ko","> 100 ko");
for ($jour=1; $jour<=5; $jour++) {  
    imagestring($image, 0, $jour*145, $hauteurImage-10, $tableauValeur[$jour-1], $noir);
}  

// trait vertical représentant le nombre de visites  
imageline($image, 30, 30, 30, $hauteurImage-30, $noir); 

// le nombre maximum de visites proportionnel à la hauteur de l'image 
$leplusgrand = 0;
for ($j=0; $j < count($tableau_visites); $j++) { 
    if ($leplusgrand < $tableau_visites[$j]) {
        $leplusgrand = $tableau_visites[$j];
    }
}
$visites_maximum = $leplusgrand+5;  
$leplusgrand = 0;

// tracé des rectangles  
for ($jour=1; $jour<=5; $jour++) {  
    $hauteurRectangle = round(($tableau_visites[$jour-1]*$hauteurImage)/$visites_maximum);  
    imagefilledrectangle($image, $jour*150-10, $hauteurImage-$hauteurRectangle, $jour*150+20, $hauteurImage-30, $rouge);  
    imagestring($image, 0, $jour*150-10, $hauteurImage-$hauteurRectangle-20,  $tableau_visites[$jour-1], $noir);  
}  

imagePng($image);  
imagedestroy($image);
?>
