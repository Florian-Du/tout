<?php
    // connexion a la base de donnee
    include "config_manager.php";
    $json = new config_manager();
    $json = $json->getconfig();
    $json->{'config'}->{'chemin'};
    $base = new PDO('mysql:'.$json->{'config'}->{'mysql'}.';dbname='.$json->{'config'}->{'dbname'}, $json->{'config'}->{'username'}, $json->{'config'}->{'passwd'});
    $base->exec("SET NAMES utf8");
    $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);