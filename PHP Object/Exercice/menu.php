<?php
    //chargement des classes
    include('Animal.class.php');
    include('Poisson.class.php');
    include('Chat.class.php');
    //instanciation de la classe Poisson qui appelle le constructeur de la classe Animal
    $poisson = new Poisson("gris",8);
    //instanciation de la classe Chat qui appelle le constructeur de la classe Animal
    $chat = new Chat("blanc",4);
    //appelle de la méthode respire()
    $poisson->respire();
    $chat->respire();
?>