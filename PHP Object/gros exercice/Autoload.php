<?php

    spl_autoload_register('monAutoload');
    function monAutoload($className)
    {
        //Les classes sont dans le dossier class
        $path = './';
        //Le nom des fichiers doit correspondre au nom de la classe
        include $path.$className.'.php';
    }
    include "base.connexion.php";