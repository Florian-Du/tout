<?php
    //include pour se coonecter a la BDD et avoir a le modifier juste ici
    $base = new PDO('mysql:host=127.0.0.1;dbname=eval-lyon-php', 'root', 'root');
    $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>