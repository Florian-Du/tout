<?php
    header("Content-type: image/png");
    $image = imagecreate(300,150);
    $couleur_fond = imagecolorallocate($image, 0, 255, 0);
    imagepng($image);
?>
