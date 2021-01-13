<?php


class Base
{
    static public function getBase() :object { // function pour recuperer la connexion a la base
        //include pour se connecter a la BDD
        $base = new PDO('mysql:host=127.0.0.1;dbname=skyblog', 'root', '');
        $base->exec("SET NAMES utf8");
        $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $base;
    }
}