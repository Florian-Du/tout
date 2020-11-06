<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Florian test</title>
</head>
<body>  
    <?php
    if (file_get_contents("nombre.txt")) {
        $contenue = file_get_contents("nombre.txt");
        $contenue+=1;
        file_put_contents("nombre.txt",$contenue);
        # echo $contenue;
    }
    ?>
    <?php
 
        if (is_dir(".\Image")) {
           $directory = opendir(".\Image");
           chdir(".\/");
           $ContenueImage = "";
           while (false !== ($fichier = readdir($directory))) {
                if ($fichier != "." && $fichier != "..") {
                    $ContenueImage = $ContenueImage.$fichier." : ".filesize(".\Image\/".$fichier)." Kb".PHP_EOL;
                }
           }
           file_put_contents("image.txt",$ContenueImage);
           $time1 = microtime(true);
           $directory = opendir(".\Image");
           chdir(".\/");
           while (false !== ($fichier = readdir($directory))) {
                if ($fichier != "." && $fichier != "..") {
                    copy(".\Image\/".$fichier,".\archive\/".$fichier);
                    if(file_exists(".\Image\/".$fichier)){
                        unlink(".\Image\/".$fichier);
                    }
                }
            }
            $time2 = microtime(true);
            $totalTemps = $time2 - $time1;
            file_put_contents("log.txt","Cela a prit --> ".$totalTemps."s pour copier coller les fichier d'un repertoire a un autre");

        }else {
            echo "le fichier n'existe pas";
        }
    ?>
</body>
</html>