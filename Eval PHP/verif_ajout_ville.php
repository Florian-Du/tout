<?php
    //condition pour recuperer les villes du fichier villes.txt et ecrire la nouvelle pour ensuite y renvoyer
    //ATTENTION : Tout les utilisateurs voie les memes villes et il peut y avoir des doublon
    if (isset($_POST['Ville'])) {
        $content = file_get_contents("villes.txt");
        $content = $content.$_POST['Ville'].PHP_EOL;
        file_put_contents("villes.txt" , $content);
        header("Location:./ajout_ville.php"); 
    }else {
        header("Location:./ajout_ville.php"); 
    }
?>